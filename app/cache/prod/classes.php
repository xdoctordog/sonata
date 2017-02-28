<?php 
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
interface SessionStorageInterface
{
public function start();
public function isStarted();
public function getId();
public function setId($id);
public function getName();
public function setName($name);
public function regenerate($destroy = false, $lifetime = null);
public function save();
public function clear();
public function getBag($name);
public function registerBag(SessionBagInterface $bag);
public function getMetadataBag();
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\NativeProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy;
class NativeSessionStorage implements SessionStorageInterface
{
protected $bags;
protected $started = false;
protected $closed = false;
protected $saveHandler;
protected $metadataBag;
public function __construct(array $options = array(), $handler = null, MetadataBag $metaBag = null)
{
session_cache_limiter(''); ini_set('session.use_cookies', 1);
if (PHP_VERSION_ID >= 50400) {
session_register_shutdown();
} else {
register_shutdown_function('session_write_close');
}
$this->setMetadataBag($metaBag);
$this->setOptions($options);
$this->setSaveHandler($handler);
}
public function getSaveHandler()
{
return $this->saveHandler;
}
public function start()
{
if ($this->started) {
return true;
}
if (PHP_VERSION_ID >= 50400 && \PHP_SESSION_ACTIVE === session_status()) {
throw new \RuntimeException('Failed to start the session: already started by PHP.');
}
if (PHP_VERSION_ID < 50400 && !$this->closed && isset($_SESSION) && session_id()) {
throw new \RuntimeException('Failed to start the session: already started by PHP ($_SESSION is set).');
}
if (ini_get('session.use_cookies') && headers_sent($file, $line)) {
throw new \RuntimeException(sprintf('Failed to start the session because headers have already been sent by "%s" at line %d.', $file, $line));
}
if (!session_start()) {
throw new \RuntimeException('Failed to start the session');
}
$this->loadSession();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(true);
}
return true;
}
public function getId()
{
return $this->saveHandler->getId();
}
public function setId($id)
{
$this->saveHandler->setId($id);
}
public function getName()
{
return $this->saveHandler->getName();
}
public function setName($name)
{
$this->saveHandler->setName($name);
}
public function regenerate($destroy = false, $lifetime = null)
{
if (null !== $lifetime) {
ini_set('session.cookie_lifetime', $lifetime);
}
if ($destroy) {
$this->metadataBag->stampNew();
}
return session_regenerate_id($destroy);
}
public function save()
{
session_write_close();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(false);
}
$this->closed = true;
$this->started = false;
}
public function clear()
{
foreach ($this->bags as $bag) {
$bag->clear();
}
$_SESSION = array();
$this->loadSession();
}
public function registerBag(SessionBagInterface $bag)
{
$this->bags[$bag->getName()] = $bag;
}
public function getBag($name)
{
if (!isset($this->bags[$name])) {
throw new \InvalidArgumentException(sprintf('The SessionBagInterface %s is not registered.', $name));
}
if ($this->saveHandler->isActive() && !$this->started) {
$this->loadSession();
} elseif (!$this->started) {
$this->start();
}
return $this->bags[$name];
}
public function setMetadataBag(MetadataBag $metaBag = null)
{
if (null === $metaBag) {
$metaBag = new MetadataBag();
}
$this->metadataBag = $metaBag;
}
public function getMetadataBag()
{
return $this->metadataBag;
}
public function isStarted()
{
return $this->started;
}
public function setOptions(array $options)
{
$validOptions = array_flip(array('cache_limiter','cookie_domain','cookie_httponly','cookie_lifetime','cookie_path','cookie_secure','entropy_file','entropy_length','gc_divisor','gc_maxlifetime','gc_probability','hash_bits_per_character','hash_function','name','referer_check','serialize_handler','use_cookies','use_only_cookies','use_trans_sid','upload_progress.enabled','upload_progress.cleanup','upload_progress.prefix','upload_progress.name','upload_progress.freq','upload_progress.min-freq','url_rewriter.tags',
));
foreach ($options as $key => $value) {
if (isset($validOptions[$key])) {
ini_set('session.'.$key, $value);
}
}
}
public function setSaveHandler($saveHandler = null)
{
if (!$saveHandler instanceof AbstractProxy &&
!$saveHandler instanceof NativeSessionHandler &&
!$saveHandler instanceof \SessionHandlerInterface &&
null !== $saveHandler) {
throw new \InvalidArgumentException('Must be instance of AbstractProxy or NativeSessionHandler; implement \SessionHandlerInterface; or be null.');
}
if (!$saveHandler instanceof AbstractProxy && $saveHandler instanceof \SessionHandlerInterface) {
$saveHandler = new SessionHandlerProxy($saveHandler);
} elseif (!$saveHandler instanceof AbstractProxy) {
$saveHandler = PHP_VERSION_ID >= 50400 ?
new SessionHandlerProxy(new \SessionHandler()) : new NativeProxy();
}
$this->saveHandler = $saveHandler;
if ($this->saveHandler instanceof \SessionHandlerInterface) {
if (PHP_VERSION_ID >= 50400) {
session_set_save_handler($this->saveHandler, false);
} else {
session_set_save_handler(
array($this->saveHandler,'open'),
array($this->saveHandler,'close'),
array($this->saveHandler,'read'),
array($this->saveHandler,'write'),
array($this->saveHandler,'destroy'),
array($this->saveHandler,'gc')
);
}
}
}
protected function loadSession(array &$session = null)
{
if (null === $session) {
$session = &$_SESSION;
}
$bags = array_merge($this->bags, array($this->metadataBag));
foreach ($bags as $bag) {
$key = $bag->getStorageKey();
$session[$key] = isset($session[$key]) ? $session[$key] : array();
$bag->initialize($session[$key]);
}
$this->started = true;
$this->closed = false;
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
class PhpBridgeSessionStorage extends NativeSessionStorage
{
public function __construct($handler = null, MetadataBag $metaBag = null)
{
$this->setMetadataBag($metaBag);
$this->setSaveHandler($handler);
}
public function start()
{
if ($this->started) {
return true;
}
$this->loadSession();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(true);
}
return true;
}
public function clear()
{
foreach ($this->bags as $bag) {
$bag->clear();
}
$this->loadSession();
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Handler
{
if (PHP_VERSION_ID >= 50400) {
class NativeSessionHandler extends \SessionHandler
{
}
} else {
class NativeSessionHandler
{
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Handler
{
class NativeFileSessionHandler extends NativeSessionHandler
{
public function __construct($savePath = null)
{
if (null === $savePath) {
$savePath = ini_get('session.save_path');
}
$baseDir = $savePath;
if ($count = substr_count($savePath,';')) {
if ($count > 2) {
throw new \InvalidArgumentException(sprintf('Invalid argument $savePath \'%s\'', $savePath));
}
$baseDir = ltrim(strrchr($savePath,';'),';');
}
if ($baseDir && !is_dir($baseDir)) {
mkdir($baseDir, 0777, true);
}
ini_set('session.save_path', $savePath);
ini_set('session.save_handler','files');
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy
{
abstract class AbstractProxy
{
protected $wrapper = false;
protected $active = false;
protected $saveHandlerName;
public function getSaveHandlerName()
{
return $this->saveHandlerName;
}
public function isSessionHandlerInterface()
{
return ($this instanceof \SessionHandlerInterface);
}
public function isWrapper()
{
return $this->wrapper;
}
public function isActive()
{
if (PHP_VERSION_ID >= 50400) {
return $this->active = \PHP_SESSION_ACTIVE === session_status();
}
return $this->active;
}
public function setActive($flag)
{
if (PHP_VERSION_ID >= 50400) {
throw new \LogicException('This method is disabled in PHP 5.4.0+');
}
$this->active = (bool) $flag;
}
public function getId()
{
return session_id();
}
public function setId($id)
{
if ($this->isActive()) {
throw new \LogicException('Cannot change the ID of an active session');
}
session_id($id);
}
public function getName()
{
return session_name();
}
public function setName($name)
{
if ($this->isActive()) {
throw new \LogicException('Cannot change the name of an active session');
}
session_name($name);
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy
{
class SessionHandlerProxy extends AbstractProxy implements \SessionHandlerInterface
{
protected $handler;
public function __construct(\SessionHandlerInterface $handler)
{
$this->handler = $handler;
$this->wrapper = ($handler instanceof \SessionHandler);
$this->saveHandlerName = $this->wrapper ? ini_get('session.save_handler') :'user';
}
public function open($savePath, $sessionName)
{
$return = (bool) $this->handler->open($savePath, $sessionName);
if (true === $return) {
$this->active = true;
}
return $return;
}
public function close()
{
$this->active = false;
return (bool) $this->handler->close();
}
public function read($sessionId)
{
return (string) $this->handler->read($sessionId);
}
public function write($sessionId, $data)
{
return (bool) $this->handler->write($sessionId, $data);
}
public function destroy($sessionId)
{
return (bool) $this->handler->destroy($sessionId);
}
public function gc($maxlifetime)
{
return (bool) $this->handler->gc($maxlifetime);
}
}
}
namespace Symfony\Component\HttpFoundation\Session
{
use Symfony\Component\HttpFoundation\Session\Storage\MetadataBag;
interface SessionInterface
{
public function start();
public function getId();
public function setId($id);
public function getName();
public function setName($name);
public function invalidate($lifetime = null);
public function migrate($destroy = false, $lifetime = null);
public function save();
public function has($name);
public function get($name, $default = null);
public function set($name, $value);
public function all();
public function replace(array $attributes);
public function remove($name);
public function clear();
public function isStarted();
public function registerBag(SessionBagInterface $bag);
public function getBag($name);
public function getMetadataBag();
}
}
namespace Symfony\Component\HttpFoundation\Session
{
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
class Session implements SessionInterface, \IteratorAggregate, \Countable
{
protected $storage;
private $flashName;
private $attributeName;
public function __construct(SessionStorageInterface $storage = null, AttributeBagInterface $attributes = null, FlashBagInterface $flashes = null)
{
$this->storage = $storage ?: new NativeSessionStorage();
$attributes = $attributes ?: new AttributeBag();
$this->attributeName = $attributes->getName();
$this->registerBag($attributes);
$flashes = $flashes ?: new FlashBag();
$this->flashName = $flashes->getName();
$this->registerBag($flashes);
}
public function start()
{
return $this->storage->start();
}
public function has($name)
{
return $this->storage->getBag($this->attributeName)->has($name);
}
public function get($name, $default = null)
{
return $this->storage->getBag($this->attributeName)->get($name, $default);
}
public function set($name, $value)
{
$this->storage->getBag($this->attributeName)->set($name, $value);
}
public function all()
{
return $this->storage->getBag($this->attributeName)->all();
}
public function replace(array $attributes)
{
$this->storage->getBag($this->attributeName)->replace($attributes);
}
public function remove($name)
{
return $this->storage->getBag($this->attributeName)->remove($name);
}
public function clear()
{
$this->storage->getBag($this->attributeName)->clear();
}
public function isStarted()
{
return $this->storage->isStarted();
}
public function getIterator()
{
return new \ArrayIterator($this->storage->getBag($this->attributeName)->all());
}
public function count()
{
return count($this->storage->getBag($this->attributeName)->all());
}
public function invalidate($lifetime = null)
{
$this->storage->clear();
return $this->migrate(true, $lifetime);
}
public function migrate($destroy = false, $lifetime = null)
{
return $this->storage->regenerate($destroy, $lifetime);
}
public function save()
{
$this->storage->save();
}
public function getId()
{
return $this->storage->getId();
}
public function setId($id)
{
$this->storage->setId($id);
}
public function getName()
{
return $this->storage->getName();
}
public function setName($name)
{
$this->storage->setName($name);
}
public function getMetadataBag()
{
return $this->storage->getMetadataBag();
}
public function registerBag(SessionBagInterface $bag)
{
$this->storage->registerBag($bag);
}
public function getBag($name)
{
return $this->storage->getBag($name);
}
public function getFlashBag()
{
return $this->getBag($this->flashName);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
class GlobalVariables
{
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function getSecurity()
{
if ($this->container->has('security.context')) {
return $this->container->get('security.context');
}
}
public function getUser()
{
if (!$this->container->has('security.token_storage')) {
return;
}
$tokenStorage = $this->container->get('security.token_storage');
if (!$token = $tokenStorage->getToken()) {
return;
}
$user = $token->getUser();
if (!is_object($user)) {
return;
}
return $user;
}
public function getRequest()
{
if ($this->container->has('request_stack')) {
return $this->container->get('request_stack')->getCurrentRequest();
}
}
public function getSession()
{
if ($request = $this->getRequest()) {
return $request->getSession();
}
}
public function getEnvironment()
{
return $this->container->getParameter('kernel.environment');
}
public function getDebug()
{
return (bool) $this->container->getParameter('kernel.debug');
}
}
}
namespace Symfony\Component\Templating
{
interface TemplateReferenceInterface
{
public function all();
public function set($name, $value);
public function get($name);
public function getPath();
public function getLogicalName();
public function __toString();
}
}
namespace Symfony\Component\Templating
{
class TemplateReference implements TemplateReferenceInterface
{
protected $parameters;
public function __construct($name = null, $engine = null)
{
$this->parameters = array('name'=> $name,'engine'=> $engine,
);
}
public function __toString()
{
return $this->getLogicalName();
}
public function set($name, $value)
{
if (array_key_exists($name, $this->parameters)) {
$this->parameters[$name] = $value;
} else {
throw new \InvalidArgumentException(sprintf('The template does not support the "%s" parameter.', $name));
}
return $this;
}
public function get($name)
{
if (array_key_exists($name, $this->parameters)) {
return $this->parameters[$name];
}
throw new \InvalidArgumentException(sprintf('The template does not support the "%s" parameter.', $name));
}
public function all()
{
return $this->parameters;
}
public function getPath()
{
return $this->parameters['name'];
}
public function getLogicalName()
{
return $this->parameters['name'];
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\Templating\TemplateReference as BaseTemplateReference;
class TemplateReference extends BaseTemplateReference
{
public function __construct($bundle = null, $controller = null, $name = null, $format = null, $engine = null)
{
$this->parameters = array('bundle'=> $bundle,'controller'=> $controller,'name'=> $name,'format'=> $format,'engine'=> $engine,
);
}
public function getPath()
{
$controller = str_replace('\\','/', $this->get('controller'));
$path = (empty($controller) ?'': $controller.'/').$this->get('name').'.'.$this->get('format').'.'.$this->get('engine');
return empty($this->parameters['bundle']) ?'views/'.$path :'@'.$this->get('bundle').'/Resources/views/'.$path;
}
public function getLogicalName()
{
return sprintf('%s:%s:%s.%s.%s', $this->parameters['bundle'], $this->parameters['controller'], $this->parameters['name'], $this->parameters['format'], $this->parameters['engine']);
}
}
}
namespace Symfony\Component\Templating
{
interface TemplateNameParserInterface
{
public function parse($name);
}
}
namespace Symfony\Component\Templating
{
class TemplateNameParser implements TemplateNameParserInterface
{
public function parse($name)
{
if ($name instanceof TemplateReferenceInterface) {
return $name;
}
$engine = null;
if (false !== $pos = strrpos($name,'.')) {
$engine = substr($name, $pos + 1);
}
return new TemplateReference($name, $engine);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\Templating\TemplateReferenceInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Templating\TemplateNameParser as BaseTemplateNameParser;
class TemplateNameParser extends BaseTemplateNameParser
{
protected $kernel;
protected $cache = array();
public function __construct(KernelInterface $kernel)
{
$this->kernel = $kernel;
}
public function parse($name)
{
if ($name instanceof TemplateReferenceInterface) {
return $name;
} elseif (isset($this->cache[$name])) {
return $this->cache[$name];
}
$name = str_replace(':/',':', preg_replace('#/{2,}#','/', strtr($name,'\\','/')));
if (false !== strpos($name,'..')) {
throw new \RuntimeException(sprintf('Template name "%s" contains invalid characters.', $name));
}
if (!preg_match('/^([^:]*):([^:]*):(.+)\.([^\.]+)\.([^\.]+)$/', $name, $matches)) {
return parent::parse($name);
}
$template = new TemplateReference($matches[1], $matches[2], $matches[3], $matches[4], $matches[5]);
if ($template->get('bundle')) {
try {
$this->kernel->getBundle($template->get('bundle'));
} catch (\Exception $e) {
throw new \InvalidArgumentException(sprintf('Template name "%s" is not valid.', $name), 0, $e);
}
}
return $this->cache[$name] = $template;
}
}
}
namespace Symfony\Component\Config
{
interface FileLocatorInterface
{
public function locate($name, $currentPath = null, $first = true);
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating\Loader
{
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Templating\TemplateReferenceInterface;
class TemplateLocator implements FileLocatorInterface
{
protected $locator;
protected $cache;
public function __construct(FileLocatorInterface $locator, $cacheDir = null)
{
if (null !== $cacheDir && is_file($cache = $cacheDir.'/templates.php')) {
$this->cache = require $cache;
}
$this->locator = $locator;
}
protected function getCacheKey($template)
{
return $template->getLogicalName();
}
public function locate($template, $currentPath = null, $first = true)
{
if (!$template instanceof TemplateReferenceInterface) {
throw new \InvalidArgumentException('The template must be an instance of TemplateReferenceInterface.');
}
$key = $this->getCacheKey($template);
if (isset($this->cache[$key])) {
return $this->cache[$key];
}
try {
return $this->cache[$key] = $this->locator->locate($template->getPath(), $currentPath);
} catch (\InvalidArgumentException $e) {
throw new \InvalidArgumentException(sprintf('Unable to find template "%s" : "%s".', $template, $e->getMessage()), 0, $e);
}
}
}
}
namespace Symfony\Component\Routing\Generator
{
interface ConfigurableRequirementsInterface
{
public function setStrictRequirements($enabled);
public function isStrictRequirements();
}
}
namespace Symfony\Component\Routing\Generator
{
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Psr\Log\LoggerInterface;
class UrlGenerator implements UrlGeneratorInterface, ConfigurableRequirementsInterface
{
protected $routes;
protected $context;
protected $strictRequirements = true;
protected $logger;
protected $decodedChars = array('%2F'=>'/','%40'=>'@','%3A'=>':','%3B'=>';','%2C'=>',','%3D'=>'=','%2B'=>'+','%21'=>'!','%2A'=>'*','%7C'=>'|',
);
public function __construct(RouteCollection $routes, RequestContext $context, LoggerInterface $logger = null)
{
$this->routes = $routes;
$this->context = $context;
$this->logger = $logger;
}
public function setContext(RequestContext $context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function setStrictRequirements($enabled)
{
$this->strictRequirements = null === $enabled ? null : (bool) $enabled;
}
public function isStrictRequirements()
{
return $this->strictRequirements;
}
public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
{
if (null === $route = $this->routes->get($name)) {
throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
}
$compiledRoute = $route->compile();
return $this->doGenerate($compiledRoute->getVariables(), $route->getDefaults(), $route->getRequirements(), $compiledRoute->getTokens(), $parameters, $name, $referenceType, $compiledRoute->getHostTokens(), $route->getSchemes());
}
protected function doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, array $requiredSchemes = array())
{
$variables = array_flip($variables);
$mergedParams = array_replace($defaults, $this->context->getParameters(), $parameters);
if ($diff = array_diff_key($variables, $mergedParams)) {
throw new MissingMandatoryParametersException(sprintf('Some mandatory parameters are missing ("%s") to generate a URL for route "%s".', implode('", "', array_keys($diff)), $name));
}
$url ='';
$optional = true;
foreach ($tokens as $token) {
if ('variable'=== $token[0]) {
if (!$optional || !array_key_exists($token[3], $defaults) || null !== $mergedParams[$token[3]] && (string) $mergedParams[$token[3]] !== (string) $defaults[$token[3]]) {
if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#', $mergedParams[$token[3]])) {
$message = sprintf('Parameter "%s" for route "%s" must match "%s" ("%s" given) to generate a corresponding URL.', $token[3], $name, $token[2], $mergedParams[$token[3]]);
if ($this->strictRequirements) {
throw new InvalidParameterException($message);
}
if ($this->logger) {
$this->logger->error($message);
}
return;
}
$url = $token[1].$mergedParams[$token[3]].$url;
$optional = false;
}
} else {
$url = $token[1].$url;
$optional = false;
}
}
if (''=== $url) {
$url ='/';
}
$url = strtr(rawurlencode($url), $this->decodedChars);
$url = strtr($url, array('/../'=>'/%2E%2E/','/./'=>'/%2E/'));
if ('/..'=== substr($url, -3)) {
$url = substr($url, 0, -2).'%2E%2E';
} elseif ('/.'=== substr($url, -2)) {
$url = substr($url, 0, -1).'%2E';
}
$schemeAuthority ='';
if ($host = $this->context->getHost()) {
$scheme = $this->context->getScheme();
if ($requiredSchemes) {
$schemeMatched = false;
foreach ($requiredSchemes as $requiredScheme) {
if ($scheme === $requiredScheme) {
$schemeMatched = true;
break;
}
}
if (!$schemeMatched) {
$referenceType = self::ABSOLUTE_URL;
$scheme = current($requiredSchemes);
}
} elseif (isset($requirements['_scheme']) && ($req = strtolower($requirements['_scheme'])) && $scheme !== $req) {
$referenceType = self::ABSOLUTE_URL;
$scheme = $req;
}
if ($hostTokens) {
$routeHost ='';
foreach ($hostTokens as $token) {
if ('variable'=== $token[0]) {
if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#i', $mergedParams[$token[3]])) {
$message = sprintf('Parameter "%s" for route "%s" must match "%s" ("%s" given) to generate a corresponding URL.', $token[3], $name, $token[2], $mergedParams[$token[3]]);
if ($this->strictRequirements) {
throw new InvalidParameterException($message);
}
if ($this->logger) {
$this->logger->error($message);
}
return;
}
$routeHost = $token[1].$mergedParams[$token[3]].$routeHost;
} else {
$routeHost = $token[1].$routeHost;
}
}
if ($routeHost !== $host) {
$host = $routeHost;
if (self::ABSOLUTE_URL !== $referenceType) {
$referenceType = self::NETWORK_PATH;
}
}
}
if (self::ABSOLUTE_URL === $referenceType || self::NETWORK_PATH === $referenceType) {
$port ='';
if ('http'=== $scheme && 80 != $this->context->getHttpPort()) {
$port =':'.$this->context->getHttpPort();
} elseif ('https'=== $scheme && 443 != $this->context->getHttpsPort()) {
$port =':'.$this->context->getHttpsPort();
}
$schemeAuthority = self::NETWORK_PATH === $referenceType ?'//': "$scheme://";
$schemeAuthority .= $host.$port;
}
}
if (self::RELATIVE_PATH === $referenceType) {
$url = self::getRelativePath($this->context->getPathInfo(), $url);
} else {
$url = $schemeAuthority.$this->context->getBaseUrl().$url;
}
$extra = array_diff_key($parameters, $variables, $defaults);
if ($extra && $query = http_build_query($extra,'','&')) {
$url .='?'.strtr($query, array('%2F'=>'/'));
}
return $url;
}
public static function getRelativePath($basePath, $targetPath)
{
if ($basePath === $targetPath) {
return'';
}
$sourceDirs = explode('/', isset($basePath[0]) &&'/'=== $basePath[0] ? substr($basePath, 1) : $basePath);
$targetDirs = explode('/', isset($targetPath[0]) &&'/'=== $targetPath[0] ? substr($targetPath, 1) : $targetPath);
array_pop($sourceDirs);
$targetFile = array_pop($targetDirs);
foreach ($sourceDirs as $i => $dir) {
if (isset($targetDirs[$i]) && $dir === $targetDirs[$i]) {
unset($sourceDirs[$i], $targetDirs[$i]);
} else {
break;
}
}
$targetDirs[] = $targetFile;
$path = str_repeat('../', count($sourceDirs)).implode('/', $targetDirs);
return''=== $path ||'/'=== $path[0]
|| false !== ($colonPos = strpos($path,':')) && ($colonPos < ($slashPos = strpos($path,'/')) || false === $slashPos)
? "./$path" : $path;
}
}
}
namespace Symfony\Component\Routing\Matcher
{
interface RedirectableUrlMatcherInterface
{
public function redirect($path, $route, $scheme = null);
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
class UrlMatcher implements UrlMatcherInterface, RequestMatcherInterface
{
const REQUIREMENT_MATCH = 0;
const REQUIREMENT_MISMATCH = 1;
const ROUTE_MATCH = 2;
protected $context;
protected $allow = array();
protected $routes;
protected $request;
protected $expressionLanguage;
protected $expressionLanguageProviders = array();
public function __construct(RouteCollection $routes, RequestContext $context)
{
$this->routes = $routes;
$this->context = $context;
}
public function setContext(RequestContext $context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function match($pathinfo)
{
$this->allow = array();
if ($ret = $this->matchCollection(rawurldecode($pathinfo), $this->routes)) {
return $ret;
}
throw 0 < count($this->allow)
? new MethodNotAllowedException(array_unique(array_map('strtoupper', $this->allow)))
: new ResourceNotFoundException(sprintf('No routes found for "%s".', $pathinfo));
}
public function matchRequest(Request $request)
{
$this->request = $request;
$ret = $this->match($request->getPathInfo());
$this->request = null;
return $ret;
}
public function addExpressionLanguageProvider(ExpressionFunctionProviderInterface $provider)
{
$this->expressionLanguageProviders[] = $provider;
}
protected function matchCollection($pathinfo, RouteCollection $routes)
{
foreach ($routes as $name => $route) {
$compiledRoute = $route->compile();
if (''!== $compiledRoute->getStaticPrefix() && 0 !== strpos($pathinfo, $compiledRoute->getStaticPrefix())) {
continue;
}
if (!preg_match($compiledRoute->getRegex(), $pathinfo, $matches)) {
continue;
}
$hostMatches = array();
if ($compiledRoute->getHostRegex() && !preg_match($compiledRoute->getHostRegex(), $this->context->getHost(), $hostMatches)) {
continue;
}
if ($req = $route->getRequirement('_method')) {
if ('HEAD'=== $method = $this->context->getMethod()) {
$method ='GET';
}
if (!in_array($method, $req = explode('|', strtoupper($req)))) {
$this->allow = array_merge($this->allow, $req);
continue;
}
}
$status = $this->handleRouteRequirements($pathinfo, $name, $route);
if (self::ROUTE_MATCH === $status[0]) {
return $status[1];
}
if (self::REQUIREMENT_MISMATCH === $status[0]) {
continue;
}
return $this->getAttributes($route, $name, array_replace($matches, $hostMatches));
}
}
protected function getAttributes(Route $route, $name, array $attributes)
{
$attributes['_route'] = $name;
return $this->mergeDefaults($attributes, $route->getDefaults());
}
protected function handleRouteRequirements($pathinfo, $name, Route $route)
{
if ($route->getCondition() && !$this->getExpressionLanguage()->evaluate($route->getCondition(), array('context'=> $this->context,'request'=> $this->request))) {
return array(self::REQUIREMENT_MISMATCH, null);
}
$scheme = $this->context->getScheme();
$status = $route->getSchemes() && !$route->hasScheme($scheme) ? self::REQUIREMENT_MISMATCH : self::REQUIREMENT_MATCH;
return array($status, null);
}
protected function mergeDefaults($params, $defaults)
{
foreach ($params as $key => $value) {
if (!is_int($key)) {
$defaults[$key] = $value;
}
}
return $defaults;
}
protected function getExpressionLanguage()
{
if (null === $this->expressionLanguage) {
if (!class_exists('Symfony\Component\ExpressionLanguage\ExpressionLanguage')) {
throw new \RuntimeException('Unable to use expressions as the Symfony ExpressionLanguage component is not installed.');
}
$this->expressionLanguage = new ExpressionLanguage(null, $this->expressionLanguageProviders);
}
return $this->expressionLanguage;
}
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Route;
abstract class RedirectableUrlMatcher extends UrlMatcher implements RedirectableUrlMatcherInterface
{
public function match($pathinfo)
{
try {
$parameters = parent::match($pathinfo);
} catch (ResourceNotFoundException $e) {
if ('/'=== substr($pathinfo, -1) || !in_array($this->context->getMethod(), array('HEAD','GET'))) {
throw $e;
}
try {
parent::match($pathinfo.'/');
return $this->redirect($pathinfo.'/', null);
} catch (ResourceNotFoundException $e2) {
throw $e;
}
}
return $parameters;
}
protected function handleRouteRequirements($pathinfo, $name, Route $route)
{
if ($route->getCondition() && !$this->getExpressionLanguage()->evaluate($route->getCondition(), array('context'=> $this->context,'request'=> $this->request))) {
return array(self::REQUIREMENT_MISMATCH, null);
}
$scheme = $this->context->getScheme();
$schemes = $route->getSchemes();
if ($schemes && !$route->hasScheme($scheme)) {
return array(self::ROUTE_MATCH, $this->redirect($pathinfo, $name, current($schemes)));
}
return array(self::REQUIREMENT_MATCH, null);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Routing
{
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher as BaseMatcher;
class RedirectableUrlMatcher extends BaseMatcher
{
public function redirect($path, $route, $scheme = null)
{
return array('_controller'=>'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::urlRedirectAction','path'=> $path,'permanent'=> true,'scheme'=> $scheme,'httpPort'=> $this->context->getHttpPort(),'httpsPort'=> $this->context->getHttpsPort(),'_route'=> $route,
);
}
}
}
namespace Symfony\Component\Config
{
class FileLocator implements FileLocatorInterface
{
protected $paths;
public function __construct($paths = array())
{
$this->paths = (array) $paths;
}
public function locate($name, $currentPath = null, $first = true)
{
if (''== $name) {
throw new \InvalidArgumentException('An empty file name is not valid to be located.');
}
if ($this->isAbsolutePath($name)) {
if (!file_exists($name)) {
throw new \InvalidArgumentException(sprintf('The file "%s" does not exist.', $name));
}
return $name;
}
$filepaths = array();
if (null !== $currentPath && file_exists($file = $currentPath.DIRECTORY_SEPARATOR.$name)) {
if (true === $first) {
return $file;
}
$filepaths[] = $file;
}
foreach ($this->paths as $path) {
if (file_exists($file = $path.DIRECTORY_SEPARATOR.$name)) {
if (true === $first) {
return $file;
}
$filepaths[] = $file;
}
}
if (!$filepaths) {
throw new \InvalidArgumentException(sprintf('The file "%s" does not exist (in: %s%s).', $name, null !== $currentPath ? $currentPath.', ':'', implode(', ', $this->paths)));
}
return array_values(array_unique($filepaths));
}
private function isAbsolutePath($file)
{
if ($file[0] ==='/'|| $file[0] ==='\\'|| (strlen($file) > 3 && ctype_alpha($file[0])
&& $file[1] ===':'&& ($file[2] ==='\\'|| $file[2] ==='/')
)
|| null !== parse_url($file, PHP_URL_SCHEME)
) {
return true;
}
return false;
}
}
}
namespace Symfony\Component\HttpKernel\Controller
{
use Symfony\Component\HttpFoundation\Request;
interface ControllerResolverInterface
{
public function getController(Request $request);
public function getArguments(Request $request, $controller);
}
}
namespace Symfony\Component\HttpKernel\Controller
{
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
class ControllerResolver implements ControllerResolverInterface
{
private $logger;
public function __construct(LoggerInterface $logger = null)
{
$this->logger = $logger;
}
public function getController(Request $request)
{
if (!$controller = $request->attributes->get('_controller')) {
if (null !== $this->logger) {
$this->logger->warning('Unable to look for the controller as the "_controller" parameter is missing');
}
return false;
}
if (is_array($controller)) {
return $controller;
}
if (is_object($controller)) {
if (method_exists($controller,'__invoke')) {
return $controller;
}
throw new \InvalidArgumentException(sprintf('Controller "%s" for URI "%s" is not callable.', get_class($controller), $request->getPathInfo()));
}
if (false === strpos($controller,':')) {
if (method_exists($controller,'__invoke')) {
return $this->instantiateController($controller);
} elseif (function_exists($controller)) {
return $controller;
}
}
$callable = $this->createController($controller);
if (!is_callable($callable)) {
throw new \InvalidArgumentException(sprintf('Controller "%s" for URI "%s" is not callable.', $controller, $request->getPathInfo()));
}
return $callable;
}
public function getArguments(Request $request, $controller)
{
if (is_array($controller)) {
$r = new \ReflectionMethod($controller[0], $controller[1]);
} elseif (is_object($controller) && !$controller instanceof \Closure) {
$r = new \ReflectionObject($controller);
$r = $r->getMethod('__invoke');
} else {
$r = new \ReflectionFunction($controller);
}
return $this->doGetArguments($request, $controller, $r->getParameters());
}
protected function doGetArguments(Request $request, $controller, array $parameters)
{
$attributes = $request->attributes->all();
$arguments = array();
foreach ($parameters as $param) {
if (array_key_exists($param->name, $attributes)) {
$arguments[] = $attributes[$param->name];
} elseif ($param->getClass() && $param->getClass()->isInstance($request)) {
$arguments[] = $request;
} elseif ($param->isDefaultValueAvailable()) {
$arguments[] = $param->getDefaultValue();
} else {
if (is_array($controller)) {
$repr = sprintf('%s::%s()', get_class($controller[0]), $controller[1]);
} elseif (is_object($controller)) {
$repr = get_class($controller);
} else {
$repr = $controller;
}
throw new \RuntimeException(sprintf('Controller "%s" requires that you provide a value for the "$%s" argument (because there is no default value or because there is a non optional argument after this one).', $repr, $param->name));
}
}
return $arguments;
}
protected function createController($controller)
{
if (false === strpos($controller,'::')) {
throw new \InvalidArgumentException(sprintf('Unable to find controller "%s".', $controller));
}
list($class, $method) = explode('::', $controller, 2);
if (!class_exists($class)) {
throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $class));
}
return array($this->instantiateController($class), $method);
}
protected function instantiateController($class)
{
return new $class();
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\Event;
class KernelEvent extends Event
{
private $kernel;
private $request;
private $requestType;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType)
{
$this->kernel = $kernel;
$this->request = $request;
$this->requestType = $requestType;
}
public function getKernel()
{
return $this->kernel;
}
public function getRequest()
{
return $this->request;
}
public function getRequestType()
{
return $this->requestType;
}
public function isMasterRequest()
{
return HttpKernelInterface::MASTER_REQUEST === $this->requestType;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
class FilterControllerEvent extends KernelEvent
{
private $controller;
public function __construct(HttpKernelInterface $kernel, $controller, Request $request, $requestType)
{
parent::__construct($kernel, $request, $requestType);
$this->setController($controller);
}
public function getController()
{
return $this->controller;
}
public function setController($controller)
{
if (!is_callable($controller)) {
throw new \LogicException(sprintf('The controller must be a callable (%s given).', $this->varToString($controller)));
}
$this->controller = $controller;
}
private function varToString($var)
{
if (is_object($var)) {
return sprintf('Object(%s)', get_class($var));
}
if (is_array($var)) {
$a = array();
foreach ($var as $k => $v) {
$a[] = sprintf('%s => %s', $k, $this->varToString($v));
}
return sprintf("Array(%s)", implode(', ', $a));
}
if (is_resource($var)) {
return sprintf('Resource(%s)', get_resource_type($var));
}
if (null === $var) {
return'null';
}
if (false === $var) {
return'false';
}
if (true === $var) {
return'true';
}
return (string) $var;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class FilterResponseEvent extends KernelEvent
{
private $response;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, Response $response)
{
parent::__construct($kernel, $request, $requestType);
$this->setResponse($response);
}
public function getResponse()
{
return $this->response;
}
public function setResponse(Response $response)
{
$this->response = $response;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpFoundation\Response;
class GetResponseEvent extends KernelEvent
{
private $response;
public function getResponse()
{
return $this->response;
}
public function setResponse(Response $response)
{
$this->response = $response;
$this->stopPropagation();
}
public function hasResponse()
{
return null !== $this->response;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
class GetResponseForControllerResultEvent extends GetResponseEvent
{
private $controllerResult;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, $controllerResult)
{
parent::__construct($kernel, $request, $requestType);
$this->controllerResult = $controllerResult;
}
public function getControllerResult()
{
return $this->controllerResult;
}
public function setControllerResult($controllerResult)
{
$this->controllerResult = $controllerResult;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
class GetResponseForExceptionEvent extends GetResponseEvent
{
private $exception;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, \Exception $e)
{
parent::__construct($kernel, $request, $requestType);
$this->setException($e);
}
public function getException()
{
return $this->exception;
}
public function setException(\Exception $exception)
{
$this->exception = $exception;
}
}
}
namespace Symfony\Component\HttpKernel\Config
{
use Symfony\Component\Config\FileLocator as BaseFileLocator;
use Symfony\Component\HttpKernel\KernelInterface;
class FileLocator extends BaseFileLocator
{
private $kernel;
private $path;
public function __construct(KernelInterface $kernel, $path = null, array $paths = array())
{
$this->kernel = $kernel;
if (null !== $path) {
$this->path = $path;
$paths[] = $path;
}
parent::__construct($paths);
}
public function locate($file, $currentPath = null, $first = true)
{
if (isset($file[0]) &&'@'=== $file[0]) {
return $this->kernel->locateResource($file, $this->path, $first);
}
return parent::locate($file, $currentPath, $first);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Controller
{
use Symfony\Component\HttpKernel\KernelInterface;
class ControllerNameParser
{
protected $kernel;
public function __construct(KernelInterface $kernel)
{
$this->kernel = $kernel;
}
public function parse($controller)
{
$originalController = $controller;
if (3 !== count($parts = explode(':', $controller))) {
throw new \InvalidArgumentException(sprintf('The "%s" controller is not a valid "a:b:c" controller string.', $controller));
}
list($bundle, $controller, $action) = $parts;
$controller = str_replace('/','\\', $controller);
$bundles = array();
try {
$allBundles = $this->kernel->getBundle($bundle, false);
} catch (\InvalidArgumentException $e) {
$message = sprintf('The "%s" (from the _controller value "%s") does not exist or is not enabled in your kernel!',
$bundle,
$originalController
);
if ($alternative = $this->findAlternative($bundle)) {
$message .= sprintf(' Did you mean "%s:%s:%s"?', $alternative, $controller, $action);
}
throw new \InvalidArgumentException($message, 0, $e);
}
foreach ($allBundles as $b) {
$try = $b->getNamespace().'\\Controller\\'.$controller.'Controller';
if (class_exists($try)) {
return $try.'::'.$action.'Action';
}
$bundles[] = $b->getName();
$msg = sprintf('The _controller value "%s:%s:%s" maps to a "%s" class, but this class was not found. Create this class or check the spelling of the class and its namespace.', $bundle, $controller, $action, $try);
}
if (count($bundles) > 1) {
$msg = sprintf('Unable to find controller "%s:%s" in bundles %s.', $bundle, $controller, implode(', ', $bundles));
}
throw new \InvalidArgumentException($msg);
}
public function build($controller)
{
if (0 === preg_match('#^(.*?\\\\Controller\\\\(.+)Controller)::(.+)Action$#', $controller, $match)) {
throw new \InvalidArgumentException(sprintf('The "%s" controller is not a valid "class::method" string.', $controller));
}
$className = $match[1];
$controllerName = $match[2];
$actionName = $match[3];
foreach ($this->kernel->getBundles() as $name => $bundle) {
if (0 !== strpos($className, $bundle->getNamespace())) {
continue;
}
return sprintf('%s:%s:%s', $name, $controllerName, $actionName);
}
throw new \InvalidArgumentException(sprintf('Unable to find a bundle that defines controller "%s".', $controller));
}
private function findAlternative($nonExistentBundleName)
{
$bundleNames = array_map(function ($b) {
return $b->getName();
}, $this->kernel->getBundles());
$alternative = null;
$shortest = null;
foreach ($bundleNames as $bundleName) {
if (false !== strpos($bundleName, $nonExistentBundleName)) {
return $bundleName;
}
$lev = levenshtein($nonExistentBundleName, $bundleName);
if ($lev <= strlen($nonExistentBundleName) / 3 && ($alternative === null || $lev < $shortest)) {
$alternative = $bundleName;
}
}
return $alternative;
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Controller
{
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
class ControllerResolver extends BaseControllerResolver
{
protected $container;
protected $parser;
public function __construct(ContainerInterface $container, ControllerNameParser $parser, LoggerInterface $logger = null)
{
$this->container = $container;
$this->parser = $parser;
parent::__construct($logger);
}
protected function createController($controller)
{
if (false === strpos($controller,'::')) {
$count = substr_count($controller,':');
if (2 == $count) {
$controller = $this->parser->parse($controller);
} elseif (1 == $count) {
list($service, $method) = explode(':', $controller, 2);
return array($this->container->get($service), $method);
} elseif ($this->container->has($controller) && method_exists($service = $this->container->get($controller),'__invoke')) {
return $service;
} else {
throw new \LogicException(sprintf('Unable to parse the controller name "%s".', $controller));
}
}
list($class, $method) = explode('::', $controller, 2);
if (!class_exists($class)) {
throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $class));
}
$controller = $this->instantiateController($class);
if ($controller instanceof ContainerAwareInterface) {
$controller->setContainer($this->container);
}
return array($controller, $method);
}
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpFoundation\Request;
interface AccessMapInterface
{
public function getPatterns(Request $request);
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\HttpFoundation\Request;
class AccessMap implements AccessMapInterface
{
private $map = array();
public function add(RequestMatcherInterface $requestMatcher, array $attributes = array(), $channel = null)
{
$this->map[] = array($requestMatcher, $attributes, $channel);
}
public function getPatterns(Request $request)
{
foreach ($this->map as $elements) {
if (null === $elements[0] || $elements[0]->matches($request)) {
return array($elements[1], $elements[2]);
}
}
return array(null, null);
}
}
}
namespace Symfony\Component\Security\Core\Authentication\Token\Storage
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
interface TokenStorageInterface
{
public function getToken();
public function setToken(TokenInterface $token = null);
}
}
namespace Symfony\Component\Security\Core\Authorization
{
interface AuthorizationCheckerInterface
{
public function isGranted($attributes, $object = null);
}
}
namespace Symfony\Component\Security\Core
{
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
interface SecurityContextInterface extends TokenStorageInterface, AuthorizationCheckerInterface
{
const ACCESS_DENIED_ERROR = Security::ACCESS_DENIED_ERROR;
const AUTHENTICATION_ERROR = Security::AUTHENTICATION_ERROR;
const LAST_USERNAME = Security::LAST_USERNAME;
}
}
namespace Symfony\Component\Security\Core
{
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
class SecurityContext implements SecurityContextInterface
{
private $tokenStorage;
private $authorizationChecker;
public function __construct($tokenStorage, $authorizationChecker, $alwaysAuthenticate = false)
{
$oldSignature = $tokenStorage instanceof AuthenticationManagerInterface && $authorizationChecker instanceof AccessDecisionManagerInterface;
$newSignature = $tokenStorage instanceof TokenStorageInterface && $authorizationChecker instanceof AuthorizationCheckerInterface;
if (!$oldSignature && !$newSignature) {
throw new \BadMethodCallException('Unable to construct SecurityContext, please provide the correct arguments');
}
if ($oldSignature) {
$authenticationManager = $tokenStorage;
$accessDecisionManager = $authorizationChecker;
$tokenStorage = new TokenStorage();
$authorizationChecker = new AuthorizationChecker($tokenStorage, $authenticationManager, $accessDecisionManager, $alwaysAuthenticate);
}
$this->tokenStorage = $tokenStorage;
$this->authorizationChecker = $authorizationChecker;
}
public function getToken()
{
return $this->tokenStorage->getToken();
}
public function setToken(TokenInterface $token = null)
{
return $this->tokenStorage->setToken($token);
}
public function isGranted($attributes, $object = null)
{
return $this->authorizationChecker->isGranted($attributes, $object);
}
}
}
namespace Symfony\Component\Security\Core\User
{
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
interface UserProviderInterface
{
public function loadUserByUsername($username);
public function refreshUser(UserInterface $user);
public function supportsClass($class);
}
}
namespace Symfony\Component\Security\Core\Authentication
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
interface AuthenticationManagerInterface
{
public function authenticate(TokenInterface $token);
}
}
namespace Symfony\Component\Security\Core\Authentication
{
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\ProviderNotFoundException;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class AuthenticationProviderManager implements AuthenticationManagerInterface
{
private $providers;
private $eraseCredentials;
private $eventDispatcher;
public function __construct(array $providers, $eraseCredentials = true)
{
if (!$providers) {
throw new \InvalidArgumentException('You must at least add one authentication provider.');
}
$this->providers = $providers;
$this->eraseCredentials = (bool) $eraseCredentials;
}
public function setEventDispatcher(EventDispatcherInterface $dispatcher)
{
$this->eventDispatcher = $dispatcher;
}
public function authenticate(TokenInterface $token)
{
$lastException = null;
$result = null;
foreach ($this->providers as $provider) {
if (!$provider->supports($token)) {
continue;
}
try {
$result = $provider->authenticate($token);
if (null !== $result) {
break;
}
} catch (AccountStatusException $e) {
$e->setToken($token);
throw $e;
} catch (AuthenticationException $e) {
$lastException = $e;
}
}
if (null !== $result) {
if (true === $this->eraseCredentials) {
$result->eraseCredentials();
}
if (null !== $this->eventDispatcher) {
$this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_SUCCESS, new AuthenticationEvent($result));
}
return $result;
}
if (null === $lastException) {
$lastException = new ProviderNotFoundException(sprintf('No Authentication Provider found for token of class "%s".', get_class($token)));
}
if (null !== $this->eventDispatcher) {
$this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_FAILURE, new AuthenticationFailureEvent($token, $lastException));
}
$lastException->setToken($token);
throw $lastException;
}
}
}
namespace Symfony\Component\Security\Core\Authentication\Token\Storage
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class TokenStorage implements TokenStorageInterface
{
private $token;
public function getToken()
{
return $this->token;
}
public function setToken(TokenInterface $token = null)
{
$this->token = $token;
}
}
}
namespace Symfony\Component\Security\Core\Authorization
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
interface AccessDecisionManagerInterface
{
public function decide(TokenInterface $token, array $attributes, $object = null);
public function supportsAttribute($attribute);
public function supportsClass($class);
}
}
namespace Symfony\Component\Security\Core\Authorization
{
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class AccessDecisionManager implements AccessDecisionManagerInterface
{
const STRATEGY_AFFIRMATIVE ='affirmative';
const STRATEGY_CONSENSUS ='consensus';
const STRATEGY_UNANIMOUS ='unanimous';
private $voters;
private $strategy;
private $allowIfAllAbstainDecisions;
private $allowIfEqualGrantedDeniedDecisions;
public function __construct(array $voters, $strategy = self::STRATEGY_AFFIRMATIVE, $allowIfAllAbstainDecisions = false, $allowIfEqualGrantedDeniedDecisions = true)
{
if (!$voters) {
throw new \InvalidArgumentException('You must at least add one voter.');
}
$strategyMethod ='decide'.ucfirst($strategy);
if (!is_callable(array($this, $strategyMethod))) {
throw new \InvalidArgumentException(sprintf('The strategy "%s" is not supported.', $strategy));
}
$this->voters = $voters;
$this->strategy = $strategyMethod;
$this->allowIfAllAbstainDecisions = (bool) $allowIfAllAbstainDecisions;
$this->allowIfEqualGrantedDeniedDecisions = (bool) $allowIfEqualGrantedDeniedDecisions;
}
public function decide(TokenInterface $token, array $attributes, $object = null)
{
return $this->{$this->strategy}($token, $attributes, $object);
}
public function supportsAttribute($attribute)
{
foreach ($this->voters as $voter) {
if ($voter->supportsAttribute($attribute)) {
return true;
}
}
return false;
}
public function supportsClass($class)
{
foreach ($this->voters as $voter) {
if ($voter->supportsClass($class)) {
return true;
}
}
return false;
}
private function decideAffirmative(TokenInterface $token, array $attributes, $object = null)
{
$deny = 0;
foreach ($this->voters as $voter) {
$result = $voter->vote($token, $object, $attributes);
switch ($result) {
case VoterInterface::ACCESS_GRANTED:
return true;
case VoterInterface::ACCESS_DENIED:
++$deny;
break;
default:
break;
}
}
if ($deny > 0) {
return false;
}
return $this->allowIfAllAbstainDecisions;
}
private function decideConsensus(TokenInterface $token, array $attributes, $object = null)
{
$grant = 0;
$deny = 0;
$abstain = 0;
foreach ($this->voters as $voter) {
$result = $voter->vote($token, $object, $attributes);
switch ($result) {
case VoterInterface::ACCESS_GRANTED:
++$grant;
break;
case VoterInterface::ACCESS_DENIED:
++$deny;
break;
default:
++$abstain;
break;
}
}
if ($grant > $deny) {
return true;
}
if ($deny > $grant) {
return false;
}
if ($grant == $deny && $grant != 0) {
return $this->allowIfEqualGrantedDeniedDecisions;
}
return $this->allowIfAllAbstainDecisions;
}
private function decideUnanimous(TokenInterface $token, array $attributes, $object = null)
{
$grant = 0;
foreach ($attributes as $attribute) {
foreach ($this->voters as $voter) {
$result = $voter->vote($token, $object, array($attribute));
switch ($result) {
case VoterInterface::ACCESS_GRANTED:
++$grant;
break;
case VoterInterface::ACCESS_DENIED:
return false;
default:
break;
}
}
}
if ($grant > 0) {
return true;
}
return $this->allowIfAllAbstainDecisions;
}
}
}
namespace Symfony\Component\Security\Core\Authorization
{
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
class AuthorizationChecker implements AuthorizationCheckerInterface
{
private $tokenStorage;
private $accessDecisionManager;
private $authenticationManager;
private $alwaysAuthenticate;
public function __construct(TokenStorageInterface $tokenStorage, AuthenticationManagerInterface $authenticationManager, AccessDecisionManagerInterface $accessDecisionManager, $alwaysAuthenticate = false)
{
$this->tokenStorage = $tokenStorage;
$this->authenticationManager = $authenticationManager;
$this->accessDecisionManager = $accessDecisionManager;
$this->alwaysAuthenticate = $alwaysAuthenticate;
}
final public function isGranted($attributes, $object = null)
{
if (null === ($token = $this->tokenStorage->getToken())) {
throw new AuthenticationCredentialsNotFoundException('The token storage contains no authentication token. One possible reason may be that there is no firewall configured for this URL.');
}
if ($this->alwaysAuthenticate || !$token->isAuthenticated()) {
$this->tokenStorage->setToken($token = $this->authenticationManager->authenticate($token));
}
if (!is_array($attributes)) {
$attributes = array($attributes);
}
return $this->accessDecisionManager->decide($token, $attributes, $object);
}
}
}
namespace Symfony\Component\Security\Core\Authorization\Voter
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
interface VoterInterface
{
const ACCESS_GRANTED = 1;
const ACCESS_ABSTAIN = 0;
const ACCESS_DENIED = -1;
public function supportsAttribute($attribute);
public function supportsClass($class);
public function vote(TokenInterface $token, $object, array $attributes);
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpFoundation\Request;
interface FirewallMapInterface
{
public function getListeners(Request $request);
}
}
namespace Symfony\Bundle\SecurityBundle\Security
{
use Symfony\Component\Security\Http\FirewallMapInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
class FirewallMap implements FirewallMapInterface
{
protected $container;
protected $map;
public function __construct(ContainerInterface $container, array $map)
{
$this->container = $container;
$this->map = $map;
}
public function getListeners(Request $request)
{
foreach ($this->map as $contextId => $requestMatcher) {
if (null === $requestMatcher || $requestMatcher->matches($request)) {
return $this->container->get($contextId)->getContext();
}
}
return array(array(), null);
}
}
}
namespace Symfony\Bundle\SecurityBundle\Security
{
use Symfony\Component\Security\Http\Firewall\ExceptionListener;
class FirewallContext
{
private $listeners;
private $exceptionListener;
public function __construct(array $listeners, ExceptionListener $exceptionListener = null)
{
$this->listeners = $listeners;
$this->exceptionListener = $exceptionListener;
}
public function getContext()
{
return array($this->listeners, $this->exceptionListener);
}
}
}
namespace Symfony\Component\HttpFoundation
{
interface RequestMatcherInterface
{
public function matches(Request $request);
}
}
namespace Symfony\Component\HttpFoundation
{
class RequestMatcher implements RequestMatcherInterface
{
private $path;
private $host;
private $methods = array();
private $ips = array();
private $attributes = array();
private $schemes = array();
public function __construct($path = null, $host = null, $methods = null, $ips = null, array $attributes = array(), $schemes = null)
{
$this->matchPath($path);
$this->matchHost($host);
$this->matchMethod($methods);
$this->matchIps($ips);
$this->matchScheme($schemes);
foreach ($attributes as $k => $v) {
$this->matchAttribute($k, $v);
}
}
public function matchScheme($scheme)
{
$this->schemes = array_map('strtolower', (array) $scheme);
}
public function matchHost($regexp)
{
$this->host = $regexp;
}
public function matchPath($regexp)
{
$this->path = $regexp;
}
public function matchIp($ip)
{
$this->matchIps($ip);
}
public function matchIps($ips)
{
$this->ips = (array) $ips;
}
public function matchMethod($method)
{
$this->methods = array_map('strtoupper', (array) $method);
}
public function matchAttribute($key, $regexp)
{
$this->attributes[$key] = $regexp;
}
public function matches(Request $request)
{
if ($this->schemes && !in_array($request->getScheme(), $this->schemes)) {
return false;
}
if ($this->methods && !in_array($request->getMethod(), $this->methods)) {
return false;
}
foreach ($this->attributes as $key => $pattern) {
if (!preg_match('{'.$pattern.'}', $request->attributes->get($key))) {
return false;
}
}
if (null !== $this->path && !preg_match('{'.$this->path.'}', rawurldecode($request->getPathInfo()))) {
return false;
}
if (null !== $this->host && !preg_match('{'.$this->host.'}i', $request->getHost())) {
return false;
}
if (IpUtils::checkIp($request->getClientIp(), $this->ips)) {
return true;
}
return count($this->ips) === 0;
}
}
}
namespace
{
class Twig_Environment
{
const VERSION ='1.18.0';
protected $charset;
protected $loader;
protected $debug;
protected $autoReload;
protected $cache;
protected $lexer;
protected $parser;
protected $compiler;
protected $baseTemplateClass;
protected $extensions;
protected $parsers;
protected $visitors;
protected $filters;
protected $tests;
protected $functions;
protected $globals;
protected $runtimeInitialized;
protected $extensionInitialized;
protected $loadedTemplates;
protected $strictVariables;
protected $unaryOperators;
protected $binaryOperators;
protected $templateClassPrefix ='__TwigTemplate_';
protected $functionCallbacks;
protected $filterCallbacks;
protected $staging;
public function __construct(Twig_LoaderInterface $loader = null, $options = array())
{
if (null !== $loader) {
$this->setLoader($loader);
}
$options = array_merge(array('debug'=> false,'charset'=>'UTF-8','base_template_class'=>'Twig_Template','strict_variables'=> false,'autoescape'=>'html','cache'=> false,'auto_reload'=> null,'optimizations'=> -1,
), $options);
$this->debug = (bool) $options['debug'];
$this->charset = strtoupper($options['charset']);
$this->baseTemplateClass = $options['base_template_class'];
$this->autoReload = null === $options['auto_reload'] ? $this->debug : (bool) $options['auto_reload'];
$this->strictVariables = (bool) $options['strict_variables'];
$this->runtimeInitialized = false;
$this->setCache($options['cache']);
$this->functionCallbacks = array();
$this->filterCallbacks = array();
$this->addExtension(new Twig_Extension_Core());
$this->addExtension(new Twig_Extension_Escaper($options['autoescape']));
$this->addExtension(new Twig_Extension_Optimizer($options['optimizations']));
$this->extensionInitialized = false;
$this->staging = new Twig_Extension_Staging();
}
public function getBaseTemplateClass()
{
return $this->baseTemplateClass;
}
public function setBaseTemplateClass($class)
{
$this->baseTemplateClass = $class;
}
public function enableDebug()
{
$this->debug = true;
}
public function disableDebug()
{
$this->debug = false;
}
public function isDebug()
{
return $this->debug;
}
public function enableAutoReload()
{
$this->autoReload = true;
}
public function disableAutoReload()
{
$this->autoReload = false;
}
public function isAutoReload()
{
return $this->autoReload;
}
public function enableStrictVariables()
{
$this->strictVariables = true;
}
public function disableStrictVariables()
{
$this->strictVariables = false;
}
public function isStrictVariables()
{
return $this->strictVariables;
}
public function getCache()
{
return $this->cache;
}
public function setCache($cache)
{
$this->cache = $cache ? $cache : false;
}
public function getCacheFilename($name)
{
if (false === $this->cache) {
return false;
}
$class = substr($this->getTemplateClass($name), strlen($this->templateClassPrefix));
return $this->getCache().'/'.substr($class, 0, 2).'/'.substr($class, 2, 2).'/'.substr($class, 4).'.php';
}
public function getTemplateClass($name, $index = null)
{
return $this->templateClassPrefix.hash('sha256', $this->getLoader()->getCacheKey($name)).(null === $index ?'':'_'.$index);
}
public function getTemplateClassPrefix()
{
return $this->templateClassPrefix;
}
public function render($name, array $context = array())
{
return $this->loadTemplate($name)->render($context);
}
public function display($name, array $context = array())
{
$this->loadTemplate($name)->display($context);
}
public function loadTemplate($name, $index = null)
{
$cls = $this->getTemplateClass($name, $index);
if (isset($this->loadedTemplates[$cls])) {
return $this->loadedTemplates[$cls];
}
if (!class_exists($cls, false)) {
if (false === $cache = $this->getCacheFilename($name)) {
eval('?>'.$this->compileSource($this->getLoader()->getSource($name), $name));
} else {
if (!is_file($cache) || ($this->isAutoReload() && !$this->isTemplateFresh($name, filemtime($cache)))) {
$this->writeCacheFile($cache, $this->compileSource($this->getLoader()->getSource($name), $name));
}
require_once $cache;
}
}
if (!$this->runtimeInitialized) {
$this->initRuntime();
}
return $this->loadedTemplates[$cls] = new $cls($this);
}
public function createTemplate($template)
{
$name = sprintf('__string_template__%s', hash('sha256', uniqid(mt_rand(), true), false));
$loader = new Twig_Loader_Chain(array(
new Twig_Loader_Array(array($name => $template)),
$current = $this->getLoader(),
));
$this->setLoader($loader);
try {
$template = $this->loadTemplate($name);
} catch (Exception $e) {
$this->setLoader($current);
throw $e;
}
$this->setLoader($current);
return $template;
}
public function isTemplateFresh($name, $time)
{
foreach ($this->extensions as $extension) {
$r = new ReflectionObject($extension);
if (filemtime($r->getFileName()) > $time) {
return false;
}
}
return $this->getLoader()->isFresh($name, $time);
}
public function resolveTemplate($names)
{
if (!is_array($names)) {
$names = array($names);
}
foreach ($names as $name) {
if ($name instanceof Twig_Template) {
return $name;
}
try {
return $this->loadTemplate($name);
} catch (Twig_Error_Loader $e) {
}
}
if (1 === count($names)) {
throw $e;
}
throw new Twig_Error_Loader(sprintf('Unable to find one of the following templates: "%s".', implode('", "', $names)));
}
public function clearTemplateCache()
{
$this->loadedTemplates = array();
}
public function clearCacheFiles()
{
if (false === $this->cache) {
return;
}
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->cache), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
if ($file->isFile()) {
@unlink($file->getPathname());
}
}
}
public function getLexer()
{
if (null === $this->lexer) {
$this->lexer = new Twig_Lexer($this);
}
return $this->lexer;
}
public function setLexer(Twig_LexerInterface $lexer)
{
$this->lexer = $lexer;
}
public function tokenize($source, $name = null)
{
return $this->getLexer()->tokenize($source, $name);
}
public function getParser()
{
if (null === $this->parser) {
$this->parser = new Twig_Parser($this);
}
return $this->parser;
}
public function setParser(Twig_ParserInterface $parser)
{
$this->parser = $parser;
}
public function parse(Twig_TokenStream $stream)
{
return $this->getParser()->parse($stream);
}
public function getCompiler()
{
if (null === $this->compiler) {
$this->compiler = new Twig_Compiler($this);
}
return $this->compiler;
}
public function setCompiler(Twig_CompilerInterface $compiler)
{
$this->compiler = $compiler;
}
public function compile(Twig_NodeInterface $node)
{
return $this->getCompiler()->compile($node)->getSource();
}
public function compileSource($source, $name = null)
{
try {
return $this->compile($this->parse($this->tokenize($source, $name)));
} catch (Twig_Error $e) {
$e->setTemplateFile($name);
throw $e;
} catch (Exception $e) {
throw new Twig_Error_Syntax(sprintf('An exception has been thrown during the compilation of a template ("%s").', $e->getMessage()), -1, $name, $e);
}
}
public function setLoader(Twig_LoaderInterface $loader)
{
$this->loader = $loader;
}
public function getLoader()
{
if (null === $this->loader) {
throw new LogicException('You must set a loader first.');
}
return $this->loader;
}
public function setCharset($charset)
{
$this->charset = strtoupper($charset);
}
public function getCharset()
{
return $this->charset;
}
public function initRuntime()
{
$this->runtimeInitialized = true;
foreach ($this->getExtensions() as $extension) {
$extension->initRuntime($this);
}
}
public function hasExtension($name)
{
return isset($this->extensions[$name]);
}
public function getExtension($name)
{
if (!isset($this->extensions[$name])) {
throw new Twig_Error_Runtime(sprintf('The "%s" extension is not enabled.', $name));
}
return $this->extensions[$name];
}
public function addExtension(Twig_ExtensionInterface $extension)
{
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to register extension "%s" as extensions have already been initialized.', $extension->getName()));
}
$this->extensions[$extension->getName()] = $extension;
}
public function removeExtension($name)
{
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to remove extension "%s" as extensions have already been initialized.', $name));
}
unset($this->extensions[$name]);
}
public function setExtensions(array $extensions)
{
foreach ($extensions as $extension) {
$this->addExtension($extension);
}
}
public function getExtensions()
{
return $this->extensions;
}
public function addTokenParser(Twig_TokenParserInterface $parser)
{
if ($this->extensionInitialized) {
throw new LogicException('Unable to add a token parser as extensions have already been initialized.');
}
$this->staging->addTokenParser($parser);
}
public function getTokenParsers()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->parsers;
}
public function getTags()
{
$tags = array();
foreach ($this->getTokenParsers()->getParsers() as $parser) {
if ($parser instanceof Twig_TokenParserInterface) {
$tags[$parser->getTag()] = $parser;
}
}
return $tags;
}
public function addNodeVisitor(Twig_NodeVisitorInterface $visitor)
{
if ($this->extensionInitialized) {
throw new LogicException('Unable to add a node visitor as extensions have already been initialized.');
}
$this->staging->addNodeVisitor($visitor);
}
public function getNodeVisitors()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->visitors;
}
public function addFilter($name, $filter = null)
{
if (!$name instanceof Twig_SimpleFilter && !($filter instanceof Twig_SimpleFilter || $filter instanceof Twig_FilterInterface)) {
throw new LogicException('A filter must be an instance of Twig_FilterInterface or Twig_SimpleFilter');
}
if ($name instanceof Twig_SimpleFilter) {
$filter = $name;
$name = $filter->getName();
}
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to add filter "%s" as extensions have already been initialized.', $name));
}
$this->staging->addFilter($name, $filter);
}
public function getFilter($name)
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
if (isset($this->filters[$name])) {
return $this->filters[$name];
}
foreach ($this->filters as $pattern => $filter) {
$pattern = str_replace('\\*','(.*?)', preg_quote($pattern,'#'), $count);
if ($count) {
if (preg_match('#^'.$pattern.'$#', $name, $matches)) {
array_shift($matches);
$filter->setArguments($matches);
return $filter;
}
}
}
foreach ($this->filterCallbacks as $callback) {
if (false !== $filter = call_user_func($callback, $name)) {
return $filter;
}
}
return false;
}
public function registerUndefinedFilterCallback($callable)
{
$this->filterCallbacks[] = $callable;
}
public function getFilters()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->filters;
}
public function addTest($name, $test = null)
{
if (!$name instanceof Twig_SimpleTest && !($test instanceof Twig_SimpleTest || $test instanceof Twig_TestInterface)) {
throw new LogicException('A test must be an instance of Twig_TestInterface or Twig_SimpleTest');
}
if ($name instanceof Twig_SimpleTest) {
$test = $name;
$name = $test->getName();
}
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to add test "%s" as extensions have already been initialized.', $name));
}
$this->staging->addTest($name, $test);
}
public function getTests()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->tests;
}
public function getTest($name)
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
if (isset($this->tests[$name])) {
return $this->tests[$name];
}
return false;
}
public function addFunction($name, $function = null)
{
if (!$name instanceof Twig_SimpleFunction && !($function instanceof Twig_SimpleFunction || $function instanceof Twig_FunctionInterface)) {
throw new LogicException('A function must be an instance of Twig_FunctionInterface or Twig_SimpleFunction');
}
if ($name instanceof Twig_SimpleFunction) {
$function = $name;
$name = $function->getName();
}
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to add function "%s" as extensions have already been initialized.', $name));
}
$this->staging->addFunction($name, $function);
}
public function getFunction($name)
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
if (isset($this->functions[$name])) {
return $this->functions[$name];
}
foreach ($this->functions as $pattern => $function) {
$pattern = str_replace('\\*','(.*?)', preg_quote($pattern,'#'), $count);
if ($count) {
if (preg_match('#^'.$pattern.'$#', $name, $matches)) {
array_shift($matches);
$function->setArguments($matches);
return $function;
}
}
}
foreach ($this->functionCallbacks as $callback) {
if (false !== $function = call_user_func($callback, $name)) {
return $function;
}
}
return false;
}
public function registerUndefinedFunctionCallback($callable)
{
$this->functionCallbacks[] = $callable;
}
public function getFunctions()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->functions;
}
public function addGlobal($name, $value)
{
if ($this->extensionInitialized || $this->runtimeInitialized) {
if (null === $this->globals) {
$this->globals = $this->initGlobals();
}
}
if ($this->extensionInitialized || $this->runtimeInitialized) {
$this->globals[$name] = $value;
} else {
$this->staging->addGlobal($name, $value);
}
}
public function getGlobals()
{
if (!$this->runtimeInitialized && !$this->extensionInitialized) {
return $this->initGlobals();
}
if (null === $this->globals) {
$this->globals = $this->initGlobals();
}
return $this->globals;
}
public function mergeGlobals(array $context)
{
foreach ($this->getGlobals() as $key => $value) {
if (!array_key_exists($key, $context)) {
$context[$key] = $value;
}
}
return $context;
}
public function getUnaryOperators()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->unaryOperators;
}
public function getBinaryOperators()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->binaryOperators;
}
public function computeAlternatives($name, $items)
{
$alternatives = array();
foreach ($items as $item) {
$lev = levenshtein($name, $item);
if ($lev <= strlen($name) / 3 || false !== strpos($item, $name)) {
$alternatives[$item] = $lev;
}
}
asort($alternatives);
return array_keys($alternatives);
}
protected function initGlobals()
{
$globals = array();
foreach ($this->extensions as $extension) {
$extGlob = $extension->getGlobals();
if (!is_array($extGlob)) {
throw new UnexpectedValueException(sprintf('"%s::getGlobals()" must return an array of globals.', get_class($extension)));
}
$globals[] = $extGlob;
}
$globals[] = $this->staging->getGlobals();
return call_user_func_array('array_merge', $globals);
}
protected function initExtensions()
{
if ($this->extensionInitialized) {
return;
}
$this->extensionInitialized = true;
$this->parsers = new Twig_TokenParserBroker();
$this->filters = array();
$this->functions = array();
$this->tests = array();
$this->visitors = array();
$this->unaryOperators = array();
$this->binaryOperators = array();
foreach ($this->extensions as $extension) {
$this->initExtension($extension);
}
$this->initExtension($this->staging);
}
protected function initExtension(Twig_ExtensionInterface $extension)
{
foreach ($extension->getFilters() as $name => $filter) {
if ($name instanceof Twig_SimpleFilter) {
$filter = $name;
$name = $filter->getName();
} elseif ($filter instanceof Twig_SimpleFilter) {
$name = $filter->getName();
}
$this->filters[$name] = $filter;
}
foreach ($extension->getFunctions() as $name => $function) {
if ($name instanceof Twig_SimpleFunction) {
$function = $name;
$name = $function->getName();
} elseif ($function instanceof Twig_SimpleFunction) {
$name = $function->getName();
}
$this->functions[$name] = $function;
}
foreach ($extension->getTests() as $name => $test) {
if ($name instanceof Twig_SimpleTest) {
$test = $name;
$name = $test->getName();
} elseif ($test instanceof Twig_SimpleTest) {
$name = $test->getName();
}
$this->tests[$name] = $test;
}
foreach ($extension->getTokenParsers() as $parser) {
if ($parser instanceof Twig_TokenParserInterface) {
$this->parsers->addTokenParser($parser);
} elseif ($parser instanceof Twig_TokenParserBrokerInterface) {
$this->parsers->addTokenParserBroker($parser);
} else {
throw new LogicException('getTokenParsers() must return an array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances');
}
}
foreach ($extension->getNodeVisitors() as $visitor) {
$this->visitors[] = $visitor;
}
if ($operators = $extension->getOperators()) {
if (2 !== count($operators)) {
throw new InvalidArgumentException(sprintf('"%s::getOperators()" does not return a valid operators array.', get_class($extension)));
}
$this->unaryOperators = array_merge($this->unaryOperators, $operators[0]);
$this->binaryOperators = array_merge($this->binaryOperators, $operators[1]);
}
}
protected function writeCacheFile($file, $content)
{
$dir = dirname($file);
if (!is_dir($dir)) {
if (false === @mkdir($dir, 0777, true)) {
clearstatcache(false, $dir);
if (!is_dir($dir)) {
throw new RuntimeException(sprintf("Unable to create the cache directory (%s).", $dir));
}
}
} elseif (!is_writable($dir)) {
throw new RuntimeException(sprintf("Unable to write in the cache directory (%s).", $dir));
}
$tmpFile = tempnam($dir, basename($file));
if (false !== @file_put_contents($tmpFile, $content)) {
if (@rename($tmpFile, $file) || (@copy($tmpFile, $file) && unlink($tmpFile))) {
@chmod($file, 0666 & ~umask());
return;
}
}
throw new RuntimeException(sprintf('Failed to write cache file "%s".', $file));
}
}
}
namespace
{
interface Twig_ExtensionInterface
{
public function initRuntime(Twig_Environment $environment);
public function getTokenParsers();
public function getNodeVisitors();
public function getFilters();
public function getTests();
public function getFunctions();
public function getOperators();
public function getGlobals();
public function getName();
}
}
namespace
{
abstract class Twig_Extension implements Twig_ExtensionInterface
{
public function initRuntime(Twig_Environment $environment)
{
}
public function getTokenParsers()
{
return array();
}
public function getNodeVisitors()
{
return array();
}
public function getFilters()
{
return array();
}
public function getTests()
{
return array();
}
public function getFunctions()
{
return array();
}
public function getOperators()
{
return array();
}
public function getGlobals()
{
return array();
}
}
}
namespace
{
if (!defined('ENT_SUBSTITUTE')) {
define('ENT_SUBSTITUTE', 0);
}
class Twig_Extension_Core extends Twig_Extension
{
protected $dateFormats = array('F j, Y H:i','%d days');
protected $numberFormat = array(0,'.',',');
protected $timezone = null;
protected $escapers = array();
public function setEscaper($strategy, $callable)
{
$this->escapers[$strategy] = $callable;
}
public function getEscapers()
{
return $this->escapers;
}
public function setDateFormat($format = null, $dateIntervalFormat = null)
{
if (null !== $format) {
$this->dateFormats[0] = $format;
}
if (null !== $dateIntervalFormat) {
$this->dateFormats[1] = $dateIntervalFormat;
}
}
public function getDateFormat()
{
return $this->dateFormats;
}
public function setTimezone($timezone)
{
$this->timezone = $timezone instanceof DateTimeZone ? $timezone : new DateTimeZone($timezone);
}
public function getTimezone()
{
if (null === $this->timezone) {
$this->timezone = new DateTimeZone(date_default_timezone_get());
}
return $this->timezone;
}
public function setNumberFormat($decimal, $decimalPoint, $thousandSep)
{
$this->numberFormat = array($decimal, $decimalPoint, $thousandSep);
}
public function getNumberFormat()
{
return $this->numberFormat;
}
public function getTokenParsers()
{
return array(
new Twig_TokenParser_For(),
new Twig_TokenParser_If(),
new Twig_TokenParser_Extends(),
new Twig_TokenParser_Include(),
new Twig_TokenParser_Block(),
new Twig_TokenParser_Use(),
new Twig_TokenParser_Filter(),
new Twig_TokenParser_Macro(),
new Twig_TokenParser_Import(),
new Twig_TokenParser_From(),
new Twig_TokenParser_Set(),
new Twig_TokenParser_Spaceless(),
new Twig_TokenParser_Flush(),
new Twig_TokenParser_Do(),
new Twig_TokenParser_Embed(),
);
}
public function getFilters()
{
$filters = array(
new Twig_SimpleFilter('date','twig_date_format_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('date_modify','twig_date_modify_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('format','sprintf'),
new Twig_SimpleFilter('replace','strtr'),
new Twig_SimpleFilter('number_format','twig_number_format_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('abs','abs'),
new Twig_SimpleFilter('round','twig_round'),
new Twig_SimpleFilter('url_encode','twig_urlencode_filter'),
new Twig_SimpleFilter('json_encode','twig_jsonencode_filter'),
new Twig_SimpleFilter('convert_encoding','twig_convert_encoding'),
new Twig_SimpleFilter('title','twig_title_string_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('capitalize','twig_capitalize_string_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('upper','strtoupper'),
new Twig_SimpleFilter('lower','strtolower'),
new Twig_SimpleFilter('striptags','strip_tags'),
new Twig_SimpleFilter('trim','trim'),
new Twig_SimpleFilter('nl2br','nl2br', array('pre_escape'=>'html','is_safe'=> array('html'))),
new Twig_SimpleFilter('join','twig_join_filter'),
new Twig_SimpleFilter('split','twig_split_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('sort','twig_sort_filter'),
new Twig_SimpleFilter('merge','twig_array_merge'),
new Twig_SimpleFilter('batch','twig_array_batch'),
new Twig_SimpleFilter('reverse','twig_reverse_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('length','twig_length_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('slice','twig_slice', array('needs_environment'=> true)),
new Twig_SimpleFilter('first','twig_first', array('needs_environment'=> true)),
new Twig_SimpleFilter('last','twig_last', array('needs_environment'=> true)),
new Twig_SimpleFilter('default','_twig_default_filter', array('node_class'=>'Twig_Node_Expression_Filter_Default')),
new Twig_SimpleFilter('keys','twig_get_array_keys_filter'),
new Twig_SimpleFilter('escape','twig_escape_filter', array('needs_environment'=> true,'is_safe_callback'=>'twig_escape_filter_is_safe')),
new Twig_SimpleFilter('e','twig_escape_filter', array('needs_environment'=> true,'is_safe_callback'=>'twig_escape_filter_is_safe')),
);
if (function_exists('mb_get_info')) {
$filters[] = new Twig_SimpleFilter('upper','twig_upper_filter', array('needs_environment'=> true));
$filters[] = new Twig_SimpleFilter('lower','twig_lower_filter', array('needs_environment'=> true));
}
return $filters;
}
public function getFunctions()
{
return array(
new Twig_SimpleFunction('max','max'),
new Twig_SimpleFunction('min','min'),
new Twig_SimpleFunction('range','range'),
new Twig_SimpleFunction('constant','twig_constant'),
new Twig_SimpleFunction('cycle','twig_cycle'),
new Twig_SimpleFunction('random','twig_random', array('needs_environment'=> true)),
new Twig_SimpleFunction('date','twig_date_converter', array('needs_environment'=> true)),
new Twig_SimpleFunction('include','twig_include', array('needs_environment'=> true,'needs_context'=> true,'is_safe'=> array('all'))),
new Twig_SimpleFunction('source','twig_source', array('needs_environment'=> true,'is_safe'=> array('all'))),
);
}
public function getTests()
{
return array(
new Twig_SimpleTest('even', null, array('node_class'=>'Twig_Node_Expression_Test_Even')),
new Twig_SimpleTest('odd', null, array('node_class'=>'Twig_Node_Expression_Test_Odd')),
new Twig_SimpleTest('defined', null, array('node_class'=>'Twig_Node_Expression_Test_Defined')),
new Twig_SimpleTest('sameas', null, array('node_class'=>'Twig_Node_Expression_Test_Sameas')),
new Twig_SimpleTest('same as', null, array('node_class'=>'Twig_Node_Expression_Test_Sameas')),
new Twig_SimpleTest('none', null, array('node_class'=>'Twig_Node_Expression_Test_Null')),
new Twig_SimpleTest('null', null, array('node_class'=>'Twig_Node_Expression_Test_Null')),
new Twig_SimpleTest('divisibleby', null, array('node_class'=>'Twig_Node_Expression_Test_Divisibleby')),
new Twig_SimpleTest('divisible by', null, array('node_class'=>'Twig_Node_Expression_Test_Divisibleby')),
new Twig_SimpleTest('constant', null, array('node_class'=>'Twig_Node_Expression_Test_Constant')),
new Twig_SimpleTest('empty','twig_test_empty'),
new Twig_SimpleTest('iterable','twig_test_iterable'),
);
}
public function getOperators()
{
return array(
array('not'=> array('precedence'=> 50,'class'=>'Twig_Node_Expression_Unary_Not'),'-'=> array('precedence'=> 500,'class'=>'Twig_Node_Expression_Unary_Neg'),'+'=> array('precedence'=> 500,'class'=>'Twig_Node_Expression_Unary_Pos'),
),
array('or'=> array('precedence'=> 10,'class'=>'Twig_Node_Expression_Binary_Or','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'and'=> array('precedence'=> 15,'class'=>'Twig_Node_Expression_Binary_And','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-or'=> array('precedence'=> 16,'class'=>'Twig_Node_Expression_Binary_BitwiseOr','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-xor'=> array('precedence'=> 17,'class'=>'Twig_Node_Expression_Binary_BitwiseXor','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-and'=> array('precedence'=> 18,'class'=>'Twig_Node_Expression_Binary_BitwiseAnd','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'=='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Equal','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'!='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_NotEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'<'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Less','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'>'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Greater','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'>='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_GreaterEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'<='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_LessEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'not in'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_NotIn','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'in'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_In','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'matches'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Matches','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'starts with'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_StartsWith','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'ends with'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_EndsWith','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'..'=> array('precedence'=> 25,'class'=>'Twig_Node_Expression_Binary_Range','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'+'=> array('precedence'=> 30,'class'=>'Twig_Node_Expression_Binary_Add','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'-'=> array('precedence'=> 30,'class'=>'Twig_Node_Expression_Binary_Sub','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'~'=> array('precedence'=> 40,'class'=>'Twig_Node_Expression_Binary_Concat','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'*'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Mul','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'/'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Div','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'//'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_FloorDiv','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'%'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Mod','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'is'=> array('precedence'=> 100,'callable'=> array($this,'parseTestExpression'),'associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'is not'=> array('precedence'=> 100,'callable'=> array($this,'parseNotTestExpression'),'associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'**'=> array('precedence'=> 200,'class'=>'Twig_Node_Expression_Binary_Power','associativity'=> Twig_ExpressionParser::OPERATOR_RIGHT),
),
);
}
public function parseNotTestExpression(Twig_Parser $parser, Twig_NodeInterface $node)
{
return new Twig_Node_Expression_Unary_Not($this->parseTestExpression($parser, $node), $parser->getCurrentToken()->getLine());
}
public function parseTestExpression(Twig_Parser $parser, Twig_NodeInterface $node)
{
$stream = $parser->getStream();
$name = $this->getTestName($parser, $node->getLine());
$class = $this->getTestNodeClass($parser, $name);
$arguments = null;
if ($stream->test(Twig_Token::PUNCTUATION_TYPE,'(')) {
$arguments = $parser->getExpressionParser()->parseArguments(true);
}
return new $class($node, $name, $arguments, $parser->getCurrentToken()->getLine());
}
protected function getTestName(Twig_Parser $parser, $line)
{
$stream = $parser->getStream();
$name = $stream->expect(Twig_Token::NAME_TYPE)->getValue();
$env = $parser->getEnvironment();
$testMap = $env->getTests();
if (isset($testMap[$name])) {
return $name;
}
if ($stream->test(Twig_Token::NAME_TYPE)) {
$name = $name.' '.$parser->getCurrentToken()->getValue();
if (isset($testMap[$name])) {
$parser->getStream()->next();
return $name;
}
}
$message = sprintf('The test "%s" does not exist', $name);
if ($alternatives = $env->computeAlternatives($name, array_keys($testMap))) {
$message = sprintf('%s. Did you mean "%s"', $message, implode('", "', $alternatives));
}
throw new Twig_Error_Syntax($message, $line, $parser->getFilename());
}
protected function getTestNodeClass(Twig_Parser $parser, $name)
{
$env = $parser->getEnvironment();
$testMap = $env->getTests();
if ($testMap[$name] instanceof Twig_SimpleTest) {
return $testMap[$name]->getNodeClass();
}
return $testMap[$name] instanceof Twig_Test_Node ? $testMap[$name]->getClass() :'Twig_Node_Expression_Test';
}
public function getName()
{
return'core';
}
}
function twig_cycle($values, $position)
{
if (!is_array($values) && !$values instanceof ArrayAccess) {
return $values;
}
return $values[$position % count($values)];
}
function twig_random(Twig_Environment $env, $values = null)
{
if (null === $values) {
return mt_rand();
}
if (is_int($values) || is_float($values)) {
return $values < 0 ? mt_rand($values, 0) : mt_rand(0, $values);
}
if ($values instanceof Traversable) {
$values = iterator_to_array($values);
} elseif (is_string($values)) {
if (''=== $values) {
return'';
}
if (null !== $charset = $env->getCharset()) {
if ('UTF-8'!= $charset) {
$values = twig_convert_encoding($values,'UTF-8', $charset);
}
$values = preg_split('/(?<!^)(?!$)/u', $values);
if ('UTF-8'!= $charset) {
foreach ($values as $i => $value) {
$values[$i] = twig_convert_encoding($value, $charset,'UTF-8');
}
}
} else {
return $values[mt_rand(0, strlen($values) - 1)];
}
}
if (!is_array($values)) {
return $values;
}
if (0 === count($values)) {
throw new Twig_Error_Runtime('The random function cannot pick from an empty array.');
}
return $values[array_rand($values, 1)];
}
function twig_date_format_filter(Twig_Environment $env, $date, $format = null, $timezone = null)
{
if (null === $format) {
$formats = $env->getExtension('core')->getDateFormat();
$format = $date instanceof DateInterval ? $formats[1] : $formats[0];
}
if ($date instanceof DateInterval) {
return $date->format($format);
}
return twig_date_converter($env, $date, $timezone)->format($format);
}
function twig_date_modify_filter(Twig_Environment $env, $date, $modifier)
{
$date = twig_date_converter($env, $date, false);
$resultDate = $date->modify($modifier);
return null === $resultDate ? $date : $resultDate;
}
function twig_date_converter(Twig_Environment $env, $date = null, $timezone = null)
{
if (false !== $timezone) {
if (null === $timezone) {
$timezone = $env->getExtension('core')->getTimezone();
} elseif (!$timezone instanceof DateTimeZone) {
$timezone = new DateTimeZone($timezone);
}
}
if ($date instanceof DateTimeImmutable) {
return false !== $timezone ? $date->setTimezone($timezone) : $date;
}
if ($date instanceof DateTime || $date instanceof DateTimeInterface) {
$date = clone $date;
if (false !== $timezone) {
$date->setTimezone($timezone);
}
return $date;
}
$asString = (string) $date;
if (ctype_digit($asString) || (!empty($asString) &&'-'=== $asString[0] && ctype_digit(substr($asString, 1)))) {
$date ='@'.$date;
}
$date = new DateTime($date, $env->getExtension('core')->getTimezone());
if (false !== $timezone) {
$date->setTimezone($timezone);
}
return $date;
}
function twig_round($value, $precision = 0, $method ='common')
{
if ('common'== $method) {
return round($value, $precision);
}
if ('ceil'!= $method &&'floor'!= $method) {
throw new Twig_Error_Runtime('The round filter only supports the "common", "ceil", and "floor" methods.');
}
return $method($value * pow(10, $precision)) / pow(10, $precision);
}
function twig_number_format_filter(Twig_Environment $env, $number, $decimal = null, $decimalPoint = null, $thousandSep = null)
{
$defaults = $env->getExtension('core')->getNumberFormat();
if (null === $decimal) {
$decimal = $defaults[0];
}
if (null === $decimalPoint) {
$decimalPoint = $defaults[1];
}
if (null === $thousandSep) {
$thousandSep = $defaults[2];
}
return number_format((float) $number, $decimal, $decimalPoint, $thousandSep);
}
function twig_urlencode_filter($url)
{
if (is_array($url)) {
if (defined('PHP_QUERY_RFC3986')) {
return http_build_query($url,'','&', PHP_QUERY_RFC3986);
}
return http_build_query($url,'','&');
}
return rawurlencode($url);
}
if (version_compare(PHP_VERSION,'5.3.0','<')) {
function twig_jsonencode_filter($value, $options = 0)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
} elseif (is_array($value)) {
array_walk_recursive($value,'_twig_markup2string');
}
return json_encode($value);
}
} else {
function twig_jsonencode_filter($value, $options = 0)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
} elseif (is_array($value)) {
array_walk_recursive($value,'_twig_markup2string');
}
return json_encode($value, $options);
}
}
function _twig_markup2string(&$value)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
}
}
function twig_array_merge($arr1, $arr2)
{
if (!is_array($arr1) || !is_array($arr2)) {
throw new Twig_Error_Runtime(sprintf('The merge filter only works with arrays or hashes; %s and %s given.', gettype($arr1), gettype($arr2)));
}
return array_merge($arr1, $arr2);
}
function twig_slice(Twig_Environment $env, $item, $start, $length = null, $preserveKeys = false)
{
if ($item instanceof Traversable) {
if ($item instanceof IteratorAggregate) {
$item = $item->getIterator();
}
if ($start >= 0 && $length >= 0) {
try {
return iterator_to_array(new LimitIterator($item, $start, $length === null ? -1 : $length), $preserveKeys);
} catch (OutOfBoundsException $exception) {
return array();
}
}
$item = iterator_to_array($item, $preserveKeys);
}
if (is_array($item)) {
return array_slice($item, $start, $length, $preserveKeys);
}
$item = (string) $item;
if (function_exists('mb_get_info') && null !== $charset = $env->getCharset()) {
return (string) mb_substr($item, $start, null === $length ? mb_strlen($item, $charset) - $start : $length, $charset);
}
return (string) (null === $length ? substr($item, $start) : substr($item, $start, $length));
}
function twig_first(Twig_Environment $env, $item)
{
$elements = twig_slice($env, $item, 0, 1, false);
return is_string($elements) ? $elements : current($elements);
}
function twig_last(Twig_Environment $env, $item)
{
$elements = twig_slice($env, $item, -1, 1, false);
return is_string($elements) ? $elements : current($elements);
}
function twig_join_filter($value, $glue ='')
{
if ($value instanceof Traversable) {
$value = iterator_to_array($value, false);
}
return implode($glue, (array) $value);
}
function twig_split_filter(Twig_Environment $env, $value, $delimiter, $limit = null)
{
if (!empty($delimiter)) {
return null === $limit ? explode($delimiter, $value) : explode($delimiter, $value, $limit);
}
if (!function_exists('mb_get_info') || null === $charset = $env->getCharset()) {
return str_split($value, null === $limit ? 1 : $limit);
}
if ($limit <= 1) {
return preg_split('/(?<!^)(?!$)/u', $value);
}
$length = mb_strlen($value, $charset);
if ($length < $limit) {
return array($value);
}
$r = array();
for ($i = 0; $i < $length; $i += $limit) {
$r[] = mb_substr($value, $i, $limit, $charset);
}
return $r;
}
function _twig_default_filter($value, $default ='')
{
if (twig_test_empty($value)) {
return $default;
}
return $value;
}
function twig_get_array_keys_filter($array)
{
if (is_object($array) && $array instanceof Traversable) {
return array_keys(iterator_to_array($array));
}
if (!is_array($array)) {
return array();
}
return array_keys($array);
}
function twig_reverse_filter(Twig_Environment $env, $item, $preserveKeys = false)
{
if (is_object($item) && $item instanceof Traversable) {
return array_reverse(iterator_to_array($item), $preserveKeys);
}
if (is_array($item)) {
return array_reverse($item, $preserveKeys);
}
if (null !== $charset = $env->getCharset()) {
$string = (string) $item;
if ('UTF-8'!= $charset) {
$item = twig_convert_encoding($string,'UTF-8', $charset);
}
preg_match_all('/./us', $item, $matches);
$string = implode('', array_reverse($matches[0]));
if ('UTF-8'!= $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
}
return strrev((string) $item);
}
function twig_sort_filter($array)
{
asort($array);
return $array;
}
function twig_in_filter($value, $compare)
{
if (is_array($compare)) {
return in_array($value, $compare, is_object($value) || is_resource($value));
} elseif (is_string($compare) && (is_string($value) || is_int($value) || is_float($value))) {
return''=== $value || false !== strpos($compare, (string) $value);
} elseif ($compare instanceof Traversable) {
return in_array($value, iterator_to_array($compare, false), is_object($value) || is_resource($value));
}
return false;
}
function twig_escape_filter(Twig_Environment $env, $string, $strategy ='html', $charset = null, $autoescape = false)
{
if ($autoescape && $string instanceof Twig_Markup) {
return $string;
}
if (!is_string($string)) {
if (is_object($string) && method_exists($string,'__toString')) {
$string = (string) $string;
} else {
return $string;
}
}
if (null === $charset) {
$charset = $env->getCharset();
}
switch ($strategy) {
case'html':
static $htmlspecialcharsCharsets;
if (null === $htmlspecialcharsCharsets) {
if (defined('HHVM_VERSION')) {
$htmlspecialcharsCharsets = array('utf-8'=> true,'UTF-8'=> true);
} else {
$htmlspecialcharsCharsets = array('ISO-8859-1'=> true,'ISO8859-1'=> true,'ISO-8859-15'=> true,'ISO8859-15'=> true,'utf-8'=> true,'UTF-8'=> true,'CP866'=> true,'IBM866'=> true,'866'=> true,'CP1251'=> true,'WINDOWS-1251'=> true,'WIN-1251'=> true,'1251'=> true,'CP1252'=> true,'WINDOWS-1252'=> true,'1252'=> true,'KOI8-R'=> true,'KOI8-RU'=> true,'KOI8R'=> true,'BIG5'=> true,'950'=> true,'GB2312'=> true,'936'=> true,'BIG5-HKSCS'=> true,'SHIFT_JIS'=> true,'SJIS'=> true,'932'=> true,'EUC-JP'=> true,'EUCJP'=> true,'ISO8859-5'=> true,'ISO-8859-5'=> true,'MACROMAN'=> true,
);
}
}
if (isset($htmlspecialcharsCharsets[$charset])) {
return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
}
if (isset($htmlspecialcharsCharsets[strtoupper($charset)])) {
$htmlspecialcharsCharsets[$charset] = true;
return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
}
$string = twig_convert_encoding($string,'UTF-8', $charset);
$string = htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8');
return twig_convert_encoding($string, $charset,'UTF-8');
case'js':
if ('UTF-8'!= $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : (1 == preg_match('/^./su', $string) ? false : true)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9,\._]#Su','_twig_escape_js_callback', $string);
if ('UTF-8'!= $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'css':
if ('UTF-8'!= $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : (1 == preg_match('/^./su', $string) ? false : true)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9]#Su','_twig_escape_css_callback', $string);
if ('UTF-8'!= $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'html_attr':
if ('UTF-8'!= $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : (1 == preg_match('/^./su', $string) ? false : true)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9,\.\-_]#Su','_twig_escape_html_attr_callback', $string);
if ('UTF-8'!= $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'url':
if (PHP_VERSION <'5.3.0') {
return str_replace('%7E','~', rawurlencode($string));
}
return rawurlencode($string);
default:
static $escapers;
if (null === $escapers) {
$escapers = $env->getExtension('core')->getEscapers();
}
if (isset($escapers[$strategy])) {
return call_user_func($escapers[$strategy], $env, $string, $charset);
}
$validStrategies = implode(', ', array_merge(array('html','js','url','css','html_attr'), array_keys($escapers)));
throw new Twig_Error_Runtime(sprintf('Invalid escaping strategy "%s" (valid ones: %s).', $strategy, $validStrategies));
}
}
function twig_escape_filter_is_safe(Twig_Node $filterArgs)
{
foreach ($filterArgs as $arg) {
if ($arg instanceof Twig_Node_Expression_Constant) {
return array($arg->getAttribute('value'));
}
return array();
}
return array('html');
}
if (function_exists('mb_convert_encoding')) {
function twig_convert_encoding($string, $to, $from)
{
return mb_convert_encoding($string, $to, $from);
}
} elseif (function_exists('iconv')) {
function twig_convert_encoding($string, $to, $from)
{
return iconv($from, $to, $string);
}
} else {
function twig_convert_encoding($string, $to, $from)
{
throw new Twig_Error_Runtime('No suitable convert encoding function (use UTF-8 as your encoding or install the iconv or mbstring extension).');
}
}
function _twig_escape_js_callback($matches)
{
$char = $matches[0];
if (!isset($char[1])) {
return'\\x'.strtoupper(substr('00'.bin2hex($char), -2));
}
$char = twig_convert_encoding($char,'UTF-16BE','UTF-8');
return'\\u'.strtoupper(substr('0000'.bin2hex($char), -4));
}
function _twig_escape_css_callback($matches)
{
$char = $matches[0];
if (!isset($char[1])) {
$hex = ltrim(strtoupper(bin2hex($char)),'0');
if (0 === strlen($hex)) {
$hex ='0';
}
return'\\'.$hex.' ';
}
$char = twig_convert_encoding($char,'UTF-16BE','UTF-8');
return'\\'.ltrim(strtoupper(bin2hex($char)),'0').' ';
}
function _twig_escape_html_attr_callback($matches)
{
static $entityMap = array(
34 =>'quot',
38 =>'amp',
60 =>'lt',
62 =>'gt',
);
$chr = $matches[0];
$ord = ord($chr);
if (($ord <= 0x1f && $chr !="\t"&& $chr !="\n"&& $chr !="\r") || ($ord >= 0x7f && $ord <= 0x9f)) {
return'&#xFFFD;';
}
if (strlen($chr) == 1) {
$hex = strtoupper(substr('00'.bin2hex($chr), -2));
} else {
$chr = twig_convert_encoding($chr,'UTF-16BE','UTF-8');
$hex = strtoupper(substr('0000'.bin2hex($chr), -4));
}
$int = hexdec($hex);
if (array_key_exists($int, $entityMap)) {
return sprintf('&%s;', $entityMap[$int]);
}
return sprintf('&#x%s;', $hex);
}
if (function_exists('mb_get_info')) {
function twig_length_filter(Twig_Environment $env, $thing)
{
return is_scalar($thing) ? mb_strlen($thing, $env->getCharset()) : count($thing);
}
function twig_upper_filter(Twig_Environment $env, $string)
{
if (null !== ($charset = $env->getCharset())) {
return mb_strtoupper($string, $charset);
}
return strtoupper($string);
}
function twig_lower_filter(Twig_Environment $env, $string)
{
if (null !== ($charset = $env->getCharset())) {
return mb_strtolower($string, $charset);
}
return strtolower($string);
}
function twig_title_string_filter(Twig_Environment $env, $string)
{
if (null !== ($charset = $env->getCharset())) {
return mb_convert_case($string, MB_CASE_TITLE, $charset);
}
return ucwords(strtolower($string));
}
function twig_capitalize_string_filter(Twig_Environment $env, $string)
{
if (null !== ($charset = $env->getCharset())) {
return mb_strtoupper(mb_substr($string, 0, 1, $charset), $charset).
mb_strtolower(mb_substr($string, 1, mb_strlen($string, $charset), $charset), $charset);
}
return ucfirst(strtolower($string));
}
}
else {
function twig_length_filter(Twig_Environment $env, $thing)
{
return is_scalar($thing) ? strlen($thing) : count($thing);
}
function twig_title_string_filter(Twig_Environment $env, $string)
{
return ucwords(strtolower($string));
}
function twig_capitalize_string_filter(Twig_Environment $env, $string)
{
return ucfirst(strtolower($string));
}
}
function twig_ensure_traversable($seq)
{
if ($seq instanceof Traversable || is_array($seq)) {
return $seq;
}
return array();
}
function twig_test_empty($value)
{
if ($value instanceof Countable) {
return 0 == count($value);
}
return''=== $value || false === $value || null === $value || array() === $value;
}
function twig_test_iterable($value)
{
return $value instanceof Traversable || is_array($value);
}
function twig_include(Twig_Environment $env, $context, $template, $variables = array(), $withContext = true, $ignoreMissing = false, $sandboxed = false)
{
$alreadySandboxed = false;
$sandbox = null;
if ($withContext) {
$variables = array_merge($context, $variables);
}
if ($isSandboxed = $sandboxed && $env->hasExtension('sandbox')) {
$sandbox = $env->getExtension('sandbox');
if (!$alreadySandboxed = $sandbox->isSandboxed()) {
$sandbox->enableSandbox();
}
}
try {
return $env->resolveTemplate($template)->render($variables);
} catch (Twig_Error_Loader $e) {
if (!$ignoreMissing) {
throw $e;
}
}
if ($isSandboxed && !$alreadySandboxed) {
$sandbox->disableSandbox();
}
}
function twig_source(Twig_Environment $env, $name)
{
return $env->getLoader()->getSource($name);
}
function twig_constant($constant, $object = null)
{
if (null !== $object) {
$constant = get_class($object).'::'.$constant;
}
return constant($constant);
}
function twig_array_batch($items, $size, $fill = null)
{
if ($items instanceof Traversable) {
$items = iterator_to_array($items, false);
}
$size = ceil($size);
$result = array_chunk($items, $size, true);
if (null !== $fill) {
$last = count($result) - 1;
if ($fillCount = $size - count($result[$last])) {
$result[$last] = array_merge(
$result[$last],
array_fill(0, $fillCount, $fill)
);
}
}
return $result;
}
}
namespace
{
class Twig_Extension_Escaper extends Twig_Extension
{
protected $defaultStrategy;
public function __construct($defaultStrategy ='html')
{
$this->setDefaultStrategy($defaultStrategy);
}
public function getTokenParsers()
{
return array(new Twig_TokenParser_AutoEscape());
}
public function getNodeVisitors()
{
return array(new Twig_NodeVisitor_Escaper());
}
public function getFilters()
{
return array(
new Twig_SimpleFilter('raw','twig_raw_filter', array('is_safe'=> array('all'))),
);
}
public function setDefaultStrategy($defaultStrategy)
{
if (true === $defaultStrategy) {
$defaultStrategy ='html';
}
if ('filename'=== $defaultStrategy) {
$defaultStrategy = array('Twig_FileExtensionEscapingStrategy','guess');
}
$this->defaultStrategy = $defaultStrategy;
}
public function getDefaultStrategy($filename)
{
if (!is_string($this->defaultStrategy) && is_callable($this->defaultStrategy)) {
return call_user_func($this->defaultStrategy, $filename);
}
return $this->defaultStrategy;
}
public function getName()
{
return'escaper';
}
}
function twig_raw_filter($string)
{
return $string;
}
}
namespace
{
class Twig_Extension_Optimizer extends Twig_Extension
{
protected $optimizers;
public function __construct($optimizers = -1)
{
$this->optimizers = $optimizers;
}
public function getNodeVisitors()
{
return array(new Twig_NodeVisitor_Optimizer($this->optimizers));
}
public function getName()
{
return'optimizer';
}
}
}
namespace
{
interface Twig_LoaderInterface
{
public function getSource($name);
public function getCacheKey($name);
public function isFresh($name, $time);
}
}
namespace
{
class Twig_Markup implements Countable
{
protected $content;
protected $charset;
public function __construct($content, $charset)
{
$this->content = (string) $content;
$this->charset = $charset;
}
public function __toString()
{
return $this->content;
}
public function count()
{
return function_exists('mb_get_info') ? mb_strlen($this->content, $this->charset) : strlen($this->content);
}
}
}
namespace Monolog\Formatter
{
interface FormatterInterface
{
public function format(array $record);
public function formatBatch(array $records);
}
}
namespace Monolog\Formatter
{
use Exception;
class NormalizerFormatter implements FormatterInterface
{
const SIMPLE_DATE ="Y-m-d H:i:s";
protected $dateFormat;
public function __construct($dateFormat = null)
{
$this->dateFormat = $dateFormat ?: static::SIMPLE_DATE;
if (!function_exists('json_encode')) {
throw new \RuntimeException('PHP\'s json extension is required to use Monolog\'s NormalizerFormatter');
}
}
public function format(array $record)
{
return $this->normalize($record);
}
public function formatBatch(array $records)
{
foreach ($records as $key => $record) {
$records[$key] = $this->format($record);
}
return $records;
}
protected function normalize($data)
{
if (null === $data || is_scalar($data)) {
if (is_float($data)) {
if (is_infinite($data)) {
return ($data > 0 ?'':'-') .'INF';
}
if (is_nan($data)) {
return'NaN';
}
}
return $data;
}
if (is_array($data) || $data instanceof \Traversable) {
$normalized = array();
$count = 1;
foreach ($data as $key => $value) {
if ($count++ >= 1000) {
$normalized['...'] ='Over 1000 items, aborting normalization';
break;
}
$normalized[$key] = $this->normalize($value);
}
return $normalized;
}
if ($data instanceof \DateTime) {
return $data->format($this->dateFormat);
}
if (is_object($data)) {
if ($data instanceof Exception) {
return $this->normalizeException($data);
}
return sprintf("[object] (%s: %s)", get_class($data), $this->toJson($data, true));
}
if (is_resource($data)) {
return'[resource]';
}
return'[unknown('.gettype($data).')]';
}
protected function normalizeException(Exception $e)
{
$data = array('class'=> get_class($e),'message'=> $e->getMessage(),'code'=> $e->getCode(),'file'=> $e->getFile().':'.$e->getLine(),
);
$trace = $e->getTrace();
foreach ($trace as $frame) {
if (isset($frame['file'])) {
$data['trace'][] = $frame['file'].':'.$frame['line'];
} else {
$data['trace'][] = $this->toJson($this->normalize($frame), true);
}
}
if ($previous = $e->getPrevious()) {
$data['previous'] = $this->normalizeException($previous);
}
return $data;
}
protected function toJson($data, $ignoreErrors = false)
{
if ($ignoreErrors) {
if (version_compare(PHP_VERSION,'5.4.0','>=')) {
return @json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
return @json_encode($data);
}
if (version_compare(PHP_VERSION,'5.4.0','>=')) {
return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
return json_encode($data);
}
}
}
namespace Monolog\Formatter
{
use Exception;
class LineFormatter extends NormalizerFormatter
{
const SIMPLE_FORMAT ="[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
protected $format;
protected $allowInlineLineBreaks;
protected $ignoreEmptyContextAndExtra;
protected $includeStacktraces;
public function __construct($format = null, $dateFormat = null, $allowInlineLineBreaks = false, $ignoreEmptyContextAndExtra = false)
{
$this->format = $format ?: static::SIMPLE_FORMAT;
$this->allowInlineLineBreaks = $allowInlineLineBreaks;
$this->ignoreEmptyContextAndExtra = $ignoreEmptyContextAndExtra;
parent::__construct($dateFormat);
}
public function includeStacktraces($include = true)
{
$this->includeStacktraces = $include;
if ($this->includeStacktraces) {
$this->allowInlineLineBreaks = true;
}
}
public function allowInlineLineBreaks($allow = true)
{
$this->allowInlineLineBreaks = $allow;
}
public function ignoreEmptyContextAndExtra($ignore = true)
{
$this->ignoreEmptyContextAndExtra = $ignore;
}
public function format(array $record)
{
$vars = parent::format($record);
$output = $this->format;
foreach ($vars['extra'] as $var => $val) {
if (false !== strpos($output,'%extra.'.$var.'%')) {
$output = str_replace('%extra.'.$var.'%', $this->stringify($val), $output);
unset($vars['extra'][$var]);
}
}
if ($this->ignoreEmptyContextAndExtra) {
if (empty($vars['context'])) {
unset($vars['context']);
$output = str_replace('%context%','', $output);
}
if (empty($vars['extra'])) {
unset($vars['extra']);
$output = str_replace('%extra%','', $output);
}
}
foreach ($vars as $var => $val) {
if (false !== strpos($output,'%'.$var.'%')) {
$output = str_replace('%'.$var.'%', $this->stringify($val), $output);
}
}
return $output;
}
public function formatBatch(array $records)
{
$message ='';
foreach ($records as $record) {
$message .= $this->format($record);
}
return $message;
}
public function stringify($value)
{
return $this->replaceNewlines($this->convertToString($value));
}
protected function normalizeException(Exception $e)
{
$previousText ='';
if ($previous = $e->getPrevious()) {
do {
$previousText .=', '.get_class($previous).'(code: '.$previous->getCode().'): '.$previous->getMessage().' at '.$previous->getFile().':'.$previous->getLine();
} while ($previous = $previous->getPrevious());
}
$str ='[object] ('.get_class($e).'(code: '.$e->getCode().'): '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine().$previousText.')';
if ($this->includeStacktraces) {
$str .="\n[stacktrace]\n".$e->getTraceAsString();
}
return $str;
}
protected function convertToString($data)
{
if (null === $data || is_bool($data)) {
return var_export($data, true);
}
if (is_scalar($data)) {
return (string) $data;
}
if (version_compare(PHP_VERSION,'5.4.0','>=')) {
return $this->toJson($data, true);
}
return str_replace('\\/','/', @json_encode($data));
}
protected function replaceNewlines($str)
{
if ($this->allowInlineLineBreaks) {
return $str;
}
return strtr($str, array("\r\n"=>' ',"\r"=>' ',"\n"=>' '));
}
}
}
namespace Monolog\Handler
{
use Monolog\Logger;
class FilterHandler extends AbstractHandler
{
protected $handler;
protected $acceptedLevels;
protected $bubble;
public function __construct($handler, $minLevelOrList = Logger::DEBUG, $maxLevel = Logger::EMERGENCY, $bubble = true)
{
$this->handler = $handler;
$this->bubble = $bubble;
$this->setAcceptedLevels($minLevelOrList, $maxLevel);
if (!$this->handler instanceof HandlerInterface && !is_callable($this->handler)) {
throw new \RuntimeException("The given handler (".json_encode($this->handler).") is not a callable nor a Monolog\Handler\HandlerInterface object");
}
}
public function getAcceptedLevels()
{
return array_flip($this->acceptedLevels);
}
public function setAcceptedLevels($minLevelOrList = Logger::DEBUG, $maxLevel = Logger::EMERGENCY)
{
if (is_array($minLevelOrList)) {
$acceptedLevels = array_map('Monolog\Logger::toMonologLevel', $minLevelOrList);
} else {
$minLevelOrList = Logger::toMonologLevel($minLevelOrList);
$maxLevel = Logger::toMonologLevel($maxLevel);
$acceptedLevels = array_values(array_filter(Logger::getLevels(), function ($level) use ($minLevelOrList, $maxLevel) {
return $level >= $minLevelOrList && $level <= $maxLevel;
}));
}
$this->acceptedLevels = array_flip($acceptedLevels);
}
public function isHandling(array $record)
{
return isset($this->acceptedLevels[$record['level']]);
}
public function handle(array $record)
{
if (!$this->isHandling($record)) {
return false;
}
if (!$this->handler instanceof HandlerInterface) {
$this->handler = call_user_func($this->handler, $record, $this);
if (!$this->handler instanceof HandlerInterface) {
throw new \RuntimeException("The factory callable should return a HandlerInterface");
}
}
if ($this->processors) {
foreach ($this->processors as $processor) {
$record = call_user_func($processor, $record);
}
}
$this->handler->handle($record);
return false === $this->bubble;
}
public function handleBatch(array $records)
{
$filtered = array();
foreach ($records as $record) {
if ($this->isHandling($record)) {
$filtered[] = $record;
}
}
$this->handler->handleBatch($filtered);
}
}
}
namespace Monolog\Handler
{
use Monolog\Logger;
class TestHandler extends AbstractProcessingHandler
{
protected $records = array();
protected $recordsByLevel = array();
public function getRecords()
{
return $this->records;
}
public function hasEmergency($record)
{
return $this->hasRecord($record, Logger::EMERGENCY);
}
public function hasAlert($record)
{
return $this->hasRecord($record, Logger::ALERT);
}
public function hasCritical($record)
{
return $this->hasRecord($record, Logger::CRITICAL);
}
public function hasError($record)
{
return $this->hasRecord($record, Logger::ERROR);
}
public function hasWarning($record)
{
return $this->hasRecord($record, Logger::WARNING);
}
public function hasNotice($record)
{
return $this->hasRecord($record, Logger::NOTICE);
}
public function hasInfo($record)
{
return $this->hasRecord($record, Logger::INFO);
}
public function hasDebug($record)
{
return $this->hasRecord($record, Logger::DEBUG);
}
public function hasEmergencyRecords()
{
return isset($this->recordsByLevel[Logger::EMERGENCY]);
}
public function hasAlertRecords()
{
return isset($this->recordsByLevel[Logger::ALERT]);
}
public function hasCriticalRecords()
{
return isset($this->recordsByLevel[Logger::CRITICAL]);
}
public function hasErrorRecords()
{
return isset($this->recordsByLevel[Logger::ERROR]);
}
public function hasWarningRecords()
{
return isset($this->recordsByLevel[Logger::WARNING]);
}
public function hasNoticeRecords()
{
return isset($this->recordsByLevel[Logger::NOTICE]);
}
public function hasInfoRecords()
{
return isset($this->recordsByLevel[Logger::INFO]);
}
public function hasDebugRecords()
{
return isset($this->recordsByLevel[Logger::DEBUG]);
}
protected function hasRecord($record, $level)
{
if (!isset($this->recordsByLevel[$level])) {
return false;
}
if (is_array($record)) {
$record = $record['message'];
}
foreach ($this->recordsByLevel[$level] as $rec) {
if ($rec['message'] === $record) {
return true;
}
}
return false;
}
protected function write(array $record)
{
$this->recordsByLevel[$record['level']][] = $record;
$this->records[] = $record;
}
}
}
namespace Symfony\Bridge\Monolog\Handler
{
use Monolog\Logger;
use Monolog\Handler\TestHandler;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
class DebugHandler extends TestHandler implements DebugLoggerInterface
{
public function getLogs()
{
$records = array();
foreach ($this->records as $record) {
$records[] = array('timestamp'=> $record['datetime']->getTimestamp(),'message'=> $record['message'],'priority'=> $record['level'],'priorityName'=> $record['level_name'],'context'=> $record['context'],
);
}
return $records;
}
public function countErrors()
{
$cnt = 0;
$levels = array(Logger::ERROR, Logger::CRITICAL, Logger::ALERT, Logger::EMERGENCY);
foreach ($levels as $level) {
if (isset($this->recordsByLevel[$level])) {
$cnt += count($this->recordsByLevel[$level]);
}
}
return $cnt;
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Request;
interface ParamConverterInterface
{
function apply(Request $request, ConfigurationInterface $configuration);
function supports(ConfigurationInterface $configuration);
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DateTime;
class DateTimeParamConverter implements ParamConverterInterface
{
public function apply(Request $request, ConfigurationInterface $configuration)
{
$param = $configuration->getName();
if (!$request->attributes->has($param)) {
return false;
}
$options = $configuration->getOptions();
$value = $request->attributes->get($param);
$date = isset($options['format'])
? DateTime::createFromFormat($options['format'], $value)
: new DateTime($value);
if (!$date) {
throw new NotFoundHttpException('Invalid date given.');
}
$request->attributes->set($param, $date);
return true;
}
public function supports(ConfigurationInterface $configuration)
{
if (null === $configuration->getClass()) {
return false;
}
return"DateTime"=== $configuration->getClass();
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
class DoctrineParamConverter implements ParamConverterInterface
{
protected $registry;
public function __construct(ManagerRegistry $registry = null)
{
$this->registry = $registry;
}
public function apply(Request $request, ConfigurationInterface $configuration)
{
$name = $configuration->getName();
$class = $configuration->getClass();
$options = $this->getOptions($configuration);
if (null === $request->attributes->get($name, false)) {
$configuration->setIsOptional(true);
}
if (false === $object = $this->find($class, $request, $options, $name)) {
if (false === $object = $this->findOneBy($class, $request, $options)) {
if ($configuration->isOptional()) {
$object = null;
} else {
throw new \LogicException('Unable to guess how to get a Doctrine instance from the request information.');
}
}
}
if (null === $object && false === $configuration->isOptional()) {
throw new NotFoundHttpException(sprintf('%s object not found.', $class));
}
$request->attributes->set($name, $object);
return true;
}
protected function find($class, Request $request, $options, $name)
{
if ($options['mapping'] || $options['exclude']) {
return false;
}
$id = $this->getIdentifier($request, $options, $name);
if (false === $id || null === $id) {
return false;
}
if (isset($options['repository_method'])) {
$method = $options['repository_method'];
} else {
$method ='find';
}
return $this->getManager($options['entity_manager'], $class)->getRepository($class)->$method($id);
}
protected function getIdentifier(Request $request, $options, $name)
{
if (isset($options['id'])) {
if (!is_array($options['id'])) {
$name = $options['id'];
} elseif (is_array($options['id'])) {
$id = array();
foreach ($options['id'] as $field) {
$id[$field] = $request->attributes->get($field);
}
return $id;
}
}
if ($request->attributes->has($name)) {
return $request->attributes->get($name);
}
if ($request->attributes->has('id')) {
return $request->attributes->get('id');
}
return false;
}
protected function findOneBy($class, Request $request, $options)
{
if (!$options['mapping']) {
$keys = $request->attributes->keys();
$options['mapping'] = $keys ? array_combine($keys, $keys) : array();
}
foreach ($options['exclude'] as $exclude) {
unset($options['mapping'][$exclude]);
}
if (!$options['mapping']) {
return false;
}
$criteria = array();
$em = $this->getManager($options['entity_manager'], $class);
$metadata = $em->getClassMetadata($class);
foreach ($options['mapping'] as $attribute => $field) {
if ($metadata->hasField($field) || ($metadata->hasAssociation($field) && $metadata->isSingleValuedAssociation($field))) {
$criteria[$field] = $request->attributes->get($attribute);
}
}
if ($options['strip_null']) {
$criteria = array_filter($criteria, function ($value) { return !is_null($value); });
}
if (!$criteria) {
return false;
}
if (isset($options['repository_method'])) {
$method = $options['repository_method'];
} else {
$method ='findOneBy';
}
return $em->getRepository($class)->$method($criteria);
}
public function supports(ConfigurationInterface $configuration)
{
if (!$configuration instanceof ParamConverter) {
return false;
}
if (null === $this->registry || !count($this->registry->getManagers())) {
return false;
}
if (null === $configuration->getClass()) {
return false;
}
$options = $this->getOptions($configuration);
$em = $this->getManager($options['entity_manager'], $configuration->getClass());
if (null === $em) {
return false;
}
return ! $em->getMetadataFactory()->isTransient($configuration->getClass());
}
protected function getOptions(ConfigurationInterface $configuration)
{
return array_replace(array('entity_manager'=> null,'exclude'=> array(),'mapping'=> array(),'strip_null'=> false,
), $configuration->getOptions());
}
private function getManager($name, $class)
{
if (null === $name) {
return $this->registry->getManagerForClass($class);
}
return $this->registry->getManager($name);
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
class ParamConverterManager
{
protected $converters = array();
protected $namedConverters = array();
public function apply(Request $request, $configurations)
{
if (is_object($configurations)) {
$configurations = array($configurations);
}
foreach ($configurations as $configuration) {
$this->applyConverter($request, $configuration);
}
}
protected function applyConverter(Request $request, ConfigurationInterface $configuration)
{
$value = $request->attributes->get($configuration->getName());
$className = $configuration->getClass();
if (is_object($value) && $value instanceof $className) {
return;
}
if ($converterName = $configuration->getConverter()) {
if (!isset($this->namedConverters[$converterName])) {
throw new \RuntimeException(sprintf("No converter named '%s' found for conversion of parameter '%s'.",
$converterName, $configuration->getName()
));
}
$converter = $this->namedConverters[$converterName];
if (!$converter->supports($configuration)) {
throw new \RuntimeException(sprintf("Converter '%s' does not support conversion of parameter '%s'.",
$converterName, $configuration->getName()
));
}
$converter->apply($request, $configuration);
return;
}
foreach ($this->all() as $converter) {
if ($converter->supports($configuration)) {
if ($converter->apply($request, $configuration)) {
return;
}
}
}
}
public function add(ParamConverterInterface $converter, $priority = 0, $name = null)
{
if ($priority !== null) {
if (!isset($this->converters[$priority])) {
$this->converters[$priority] = array();
}
$this->converters[$priority][] = $converter;
}
if (null !== $name) {
$this->namedConverters[$name] = $converter;
}
}
public function all()
{
krsort($this->converters);
$converters = array();
foreach ($this->converters as $all) {
$converters = array_merge($converters, $all);
}
return $converters;
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Configuration
{
interface ConfigurationInterface
{
function getAliasName();
function allowArray();
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Configuration
{
abstract class ConfigurationAnnotation implements ConfigurationInterface
{
public function __construct(array $values)
{
foreach ($values as $k => $v) {
if (!method_exists($this, $name ='set'.$k)) {
throw new \RuntimeException(sprintf('Unknown key "%s" for annotation "@%s".', $k, get_class($this)));
}
$this->$name($v);
}
}
}
}
namespace Assetic
{
interface ValueSupplierInterface
{
public function getValues();
}
}
namespace Symfony\Bundle\AsseticBundle
{
use Assetic\ValueSupplierInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class DefaultValueSupplier implements ValueSupplierInterface
{
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function getValues()
{
if (!$this->container->isScopeActive('request')) {
return array();
}
$request = $this->container->get('request');
return array('locale'=> $request->getLocale(),'env'=> $this->container->getParameter('kernel.environment'),
);
}
}
}
namespace Assetic\Factory
{
use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetCollectionInterface;
use Assetic\Asset\AssetInterface;
use Assetic\Asset\AssetReference;
use Assetic\Asset\FileAsset;
use Assetic\Asset\GlobAsset;
use Assetic\Asset\HttpAsset;
use Assetic\AssetManager;
use Assetic\Factory\Worker\WorkerInterface;
use Assetic\Filter\DependencyExtractorInterface;
use Assetic\FilterManager;
class AssetFactory
{
private $root;
private $debug;
private $output;
private $workers;
private $am;
private $fm;
public function __construct($root, $debug = false)
{
$this->root = rtrim($root,'/');
$this->debug = $debug;
$this->output ='assetic/*';
$this->workers = array();
}
public function setDebug($debug)
{
$this->debug = $debug;
}
public function isDebug()
{
return $this->debug;
}
public function setDefaultOutput($output)
{
$this->output = $output;
}
public function addWorker(WorkerInterface $worker)
{
$this->workers[] = $worker;
}
public function getAssetManager()
{
return $this->am;
}
public function setAssetManager(AssetManager $am)
{
$this->am = $am;
}
public function getFilterManager()
{
return $this->fm;
}
public function setFilterManager(FilterManager $fm)
{
$this->fm = $fm;
}
public function createAsset($inputs = array(), $filters = array(), array $options = array())
{
if (!is_array($inputs)) {
$inputs = array($inputs);
}
if (!is_array($filters)) {
$filters = array($filters);
}
if (!isset($options['output'])) {
$options['output'] = $this->output;
}
if (!isset($options['vars'])) {
$options['vars'] = array();
}
if (!isset($options['debug'])) {
$options['debug'] = $this->debug;
}
if (!isset($options['root'])) {
$options['root'] = array($this->root);
} else {
if (!is_array($options['root'])) {
$options['root'] = array($options['root']);
}
$options['root'][] = $this->root;
}
if (!isset($options['name'])) {
$options['name'] = $this->generateAssetName($inputs, $filters, $options);
}
$asset = $this->createAssetCollection(array(), $options);
$extensions = array();
foreach ($inputs as $input) {
if (is_array($input)) {
$asset->add(call_user_func_array(array($this,'createAsset'), $input));
} else {
$asset->add($this->parseInput($input, $options));
$extensions[pathinfo($input, PATHINFO_EXTENSION)] = true;
}
}
foreach ($filters as $filter) {
if ('?'!= $filter[0]) {
$asset->ensureFilter($this->getFilter($filter));
} elseif (!$options['debug']) {
$asset->ensureFilter($this->getFilter(substr($filter, 1)));
}
}
if (!empty($options['vars'])) {
$toAdd = array();
foreach ($options['vars'] as $var) {
if (false !== strpos($options['output'],'{'.$var.'}')) {
continue;
}
$toAdd[] ='{'.$var.'}';
}
if ($toAdd) {
$options['output'] = str_replace('*','*.'.implode('.', $toAdd), $options['output']);
}
}
if (1 == count($extensions) && !pathinfo($options['output'], PATHINFO_EXTENSION) && $extension = key($extensions)) {
$options['output'] .='.'.$extension;
}
$asset->setTargetPath(str_replace('*', $options['name'], $options['output']));
return $this->applyWorkers($asset);
}
public function generateAssetName($inputs, $filters, $options = array())
{
foreach (array_diff(array_keys($options), array('output','debug','root')) as $key) {
unset($options[$key]);
}
ksort($options);
return substr(sha1(serialize($inputs).serialize($filters).serialize($options)), 0, 7);
}
public function getLastModified(AssetInterface $asset)
{
$mtime = 0;
foreach ($asset instanceof AssetCollectionInterface ? $asset : array($asset) as $leaf) {
$mtime = max($mtime, $leaf->getLastModified());
if (!$filters = $leaf->getFilters()) {
continue;
}
$prevFilters = array();
foreach ($filters as $filter) {
$prevFilters[] = $filter;
if (!$filter instanceof DependencyExtractorInterface) {
continue;
}
$clone = clone $leaf;
$clone->clearFilters();
foreach (array_slice($prevFilters, 0, -1) as $prevFilter) {
$clone->ensureFilter($prevFilter);
}
$clone->load();
foreach ($filter->getChildren($this, $clone->getContent(), $clone->getSourceDirectory()) as $child) {
$mtime = max($mtime, $this->getLastModified($child));
}
}
}
return $mtime;
}
protected function parseInput($input, array $options = array())
{
if ('@'== $input[0]) {
return $this->createAssetReference(substr($input, 1));
}
if (false !== strpos($input,'://') || 0 === strpos($input,'//')) {
return $this->createHttpAsset($input, $options['vars']);
}
if (self::isAbsolutePath($input)) {
if ($root = self::findRootDir($input, $options['root'])) {
$path = ltrim(substr($input, strlen($root)),'/');
} else {
$path = null;
}
} else {
$root = $this->root;
$path = $input;
$input = $this->root.'/'.$path;
}
if (false !== strpos($input,'*')) {
return $this->createGlobAsset($input, $root, $options['vars']);
}
return $this->createFileAsset($input, $root, $path, $options['vars']);
}
protected function createAssetCollection(array $assets = array(), array $options = array())
{
return new AssetCollection($assets, array(), null, isset($options['vars']) ? $options['vars'] : array());
}
protected function createAssetReference($name)
{
if (!$this->am) {
throw new \LogicException('There is no asset manager.');
}
return new AssetReference($this->am, $name);
}
protected function createHttpAsset($sourceUrl, $vars)
{
return new HttpAsset($sourceUrl, array(), false, $vars);
}
protected function createGlobAsset($glob, $root = null, $vars)
{
return new GlobAsset($glob, array(), $root, $vars);
}
protected function createFileAsset($source, $root = null, $path = null, $vars)
{
return new FileAsset($source, array(), $root, $path, $vars);
}
protected function getFilter($name)
{
if (!$this->fm) {
throw new \LogicException('There is no filter manager.');
}
return $this->fm->get($name);
}
private function applyWorkers(AssetCollectionInterface $asset)
{
foreach ($asset as $leaf) {
foreach ($this->workers as $worker) {
$retval = $worker->process($leaf, $this);
if ($retval instanceof AssetInterface && $leaf !== $retval) {
$asset->replaceLeaf($leaf, $retval);
}
}
}
foreach ($this->workers as $worker) {
$retval = $worker->process($asset, $this);
if ($retval instanceof AssetInterface) {
$asset = $retval;
}
}
return $asset instanceof AssetCollectionInterface ? $asset : $this->createAssetCollection(array($asset));
}
private static function isAbsolutePath($path)
{
return'/'== $path[0] ||'\\'== $path[0] || (3 < strlen($path) && ctype_alpha($path[0]) && $path[1] ==':'&& ('\\'== $path[2] ||'/'== $path[2]));
}
private static function findRootDir($path, array $roots)
{
foreach ($roots as $root) {
if (0 === strpos($path, $root)) {
return $root;
}
}
}
}
}
namespace Symfony\Bundle\AsseticBundle\Factory
{
use Assetic\Factory\AssetFactory as BaseAssetFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\KernelInterface;
class AssetFactory extends BaseAssetFactory
{
private $kernel;
private $container;
private $parameterBag;
public function __construct(KernelInterface $kernel, ContainerInterface $container, ParameterBagInterface $parameterBag, $baseDir, $debug = false)
{
$this->kernel = $kernel;
$this->container = $container;
$this->parameterBag = $parameterBag;
parent::__construct($baseDir, $debug);
}
protected function parseInput($input, array $options = array())
{
$input = $this->parameterBag->resolveValue($input);
if ('@'== $input[0] && false !== strpos($input,'/')) {
$bundle = substr($input, 1);
if (false !== $pos = strpos($bundle,'/')) {
$bundle = substr($bundle, 0, $pos);
}
$options['root'] = array($this->kernel->getBundle($bundle)->getPath());
if (false !== $pos = strpos($input,'*')) {
list($before, $after) = explode('*', $input, 2);
$input = $this->kernel->locateResource($before).'*'.$after;
} else {
$input = $this->kernel->locateResource($input);
}
}
return parent::parseInput($input, $options);
}
protected function createAssetReference($name)
{
if (!$this->getAssetManager()) {
$this->setAssetManager($this->container->get('assetic.asset_manager'));
}
return parent::createAssetReference($name);
}
protected function getFilter($name)
{
if (!$this->getFilterManager()) {
$this->setFilterManager($this->container->get('assetic.filter_manager'));
}
return parent::getFilter($name);
}
}
}
namespace Doctrine\Common\Lexer
{
abstract class AbstractLexer
{
private $input;
private $tokens = array();
private $position = 0;
private $peek = 0;
public $lookahead;
public $token;
public function setInput($input)
{
$this->input = $input;
$this->tokens = array();
$this->reset();
$this->scan($input);
}
public function reset()
{
$this->lookahead = null;
$this->token = null;
$this->peek = 0;
$this->position = 0;
}
public function resetPeek()
{
$this->peek = 0;
}
public function resetPosition($position = 0)
{
$this->position = $position;
}
public function getInputUntilPosition($position)
{
return substr($this->input, 0, $position);
}
public function isNextToken($token)
{
return null !== $this->lookahead && $this->lookahead['type'] === $token;
}
public function isNextTokenAny(array $tokens)
{
return null !== $this->lookahead && in_array($this->lookahead['type'], $tokens, true);
}
public function moveNext()
{
$this->peek = 0;
$this->token = $this->lookahead;
$this->lookahead = (isset($this->tokens[$this->position]))
? $this->tokens[$this->position++] : null;
return $this->lookahead !== null;
}
public function skipUntil($type)
{
while ($this->lookahead !== null && $this->lookahead['type'] !== $type) {
$this->moveNext();
}
}
public function isA($value, $token)
{
return $this->getType($value) === $token;
}
public function peek()
{
if (isset($this->tokens[$this->position + $this->peek])) {
return $this->tokens[$this->position + $this->peek++];
} else {
return null;
}
}
public function glimpse()
{
$peek = $this->peek();
$this->peek = 0;
return $peek;
}
protected function scan($input)
{
static $regex;
if ( ! isset($regex)) {
$regex = sprintf('/(%s)|%s/%s',
implode(')|(', $this->getCatchablePatterns()),
implode('|', $this->getNonCatchablePatterns()),
$this->getModifiers()
);
}
$flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
$matches = preg_split($regex, $input, -1, $flags);
foreach ($matches as $match) {
$type = $this->getType($match[0]);
$this->tokens[] = array('value'=> $match[0],'type'=> $type,'position'=> $match[1],
);
}
}
public function getLiteral($token)
{
$className = get_class($this);
$reflClass = new \ReflectionClass($className);
$constants = $reflClass->getConstants();
foreach ($constants as $name => $value) {
if ($value === $token) {
return $className .'::'. $name;
}
}
return $token;
}
protected function getModifiers()
{
return'i';
}
abstract protected function getCatchablePatterns();
abstract protected function getNonCatchablePatterns();
abstract protected function getType(&$value);
}
}
namespace Doctrine\Common\Annotations
{
use Doctrine\Common\Lexer\AbstractLexer;
final class DocLexer extends AbstractLexer
{
const T_NONE = 1;
const T_INTEGER = 2;
const T_STRING = 3;
const T_FLOAT = 4;
const T_IDENTIFIER = 100;
const T_AT = 101;
const T_CLOSE_CURLY_BRACES = 102;
const T_CLOSE_PARENTHESIS = 103;
const T_COMMA = 104;
const T_EQUALS = 105;
const T_FALSE = 106;
const T_NAMESPACE_SEPARATOR = 107;
const T_OPEN_CURLY_BRACES = 108;
const T_OPEN_PARENTHESIS = 109;
const T_TRUE = 110;
const T_NULL = 111;
const T_COLON = 112;
protected $noCase = array('@'=> self::T_AT,','=> self::T_COMMA,'('=> self::T_OPEN_PARENTHESIS,')'=> self::T_CLOSE_PARENTHESIS,'{'=> self::T_OPEN_CURLY_BRACES,'}'=> self::T_CLOSE_CURLY_BRACES,'='=> self::T_EQUALS,':'=> self::T_COLON,'\\'=> self::T_NAMESPACE_SEPARATOR
);
protected $withCase = array('true'=> self::T_TRUE,'false'=> self::T_FALSE,'null'=> self::T_NULL
);
protected function getCatchablePatterns()
{
return array('[a-z_\\\][a-z0-9_\:\\\]*[a-z_][a-z0-9_]*','(?:[+-]?[0-9]+(?:[\.][0-9]+)*)(?:[eE][+-]?[0-9]+)?','"(?:""|[^"])*+"',
);
}
protected function getNonCatchablePatterns()
{
return array('\s+','\*+','(.)');
}
protected function getType(&$value)
{
$type = self::T_NONE;
if ($value[0] ==='"') {
$value = str_replace('""','"', substr($value, 1, strlen($value) - 2));
return self::T_STRING;
}
if (isset($this->noCase[$value])) {
return $this->noCase[$value];
}
if ($value[0] ==='_'|| $value[0] ==='\\'|| ctype_alpha($value[0])) {
return self::T_IDENTIFIER;
}
$lowerValue = strtolower($value);
if (isset($this->withCase[$lowerValue])) {
return $this->withCase[$lowerValue];
}
if (is_numeric($value)) {
return (strpos($value,'.') !== false || stripos($value,'e') !== false)
? self::T_FLOAT : self::T_INTEGER;
}
return $type;
}
}
}
namespace Doctrine\Common\Annotations
{
interface Reader
{
function getClassAnnotations(\ReflectionClass $class);
function getClassAnnotation(\ReflectionClass $class, $annotationName);
function getMethodAnnotations(\ReflectionMethod $method);
function getMethodAnnotation(\ReflectionMethod $method, $annotationName);
function getPropertyAnnotations(\ReflectionProperty $property);
function getPropertyAnnotation(\ReflectionProperty $property, $annotationName);
}
}
namespace Doctrine\Common\Annotations
{
class FileCacheReader implements Reader
{
private $reader;
private $dir;
private $debug;
private $loadedAnnotations = array();
private $classNameHashes = array();
public function __construct(Reader $reader, $cacheDir, $debug = false)
{
$this->reader = $reader;
if (!is_dir($cacheDir) && !@mkdir($cacheDir, 0777, true)) {
throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist and could not be created.', $cacheDir));
}
$this->dir = rtrim($cacheDir,'\\/');
$this->debug = $debug;
}
public function getClassAnnotations(\ReflectionClass $class)
{
if ( ! isset($this->classNameHashes[$class->name])) {
$this->classNameHashes[$class->name] = sha1($class->name);
}
$key = $this->classNameHashes[$class->name];
if (isset($this->loadedAnnotations[$key])) {
return $this->loadedAnnotations[$key];
}
$path = $this->dir.'/'.strtr($key,'\\','-').'.cache.php';
if (!is_file($path)) {
$annot = $this->reader->getClassAnnotations($class);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
if ($this->debug
&& (false !== $filename = $class->getFilename())
&& filemtime($path) < filemtime($filename)) {
@unlink($path);
$annot = $this->reader->getClassAnnotations($class);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
return $this->loadedAnnotations[$key] = include $path;
}
public function getPropertyAnnotations(\ReflectionProperty $property)
{
$class = $property->getDeclaringClass();
if ( ! isset($this->classNameHashes[$class->name])) {
$this->classNameHashes[$class->name] = sha1($class->name);
}
$key = $this->classNameHashes[$class->name].'$'.$property->getName();
if (isset($this->loadedAnnotations[$key])) {
return $this->loadedAnnotations[$key];
}
$path = $this->dir.'/'.strtr($key,'\\','-').'.cache.php';
if (!is_file($path)) {
$annot = $this->reader->getPropertyAnnotations($property);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
if ($this->debug
&& (false !== $filename = $class->getFilename())
&& filemtime($path) < filemtime($filename)) {
@unlink($path);
$annot = $this->reader->getPropertyAnnotations($property);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
return $this->loadedAnnotations[$key] = include $path;
}
public function getMethodAnnotations(\ReflectionMethod $method)
{
$class = $method->getDeclaringClass();
if ( ! isset($this->classNameHashes[$class->name])) {
$this->classNameHashes[$class->name] = sha1($class->name);
}
$key = $this->classNameHashes[$class->name].'#'.$method->getName();
if (isset($this->loadedAnnotations[$key])) {
return $this->loadedAnnotations[$key];
}
$path = $this->dir.'/'.strtr($key,'\\','-').'.cache.php';
if (!is_file($path)) {
$annot = $this->reader->getMethodAnnotations($method);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
if ($this->debug
&& (false !== $filename = $class->getFilename())
&& filemtime($path) < filemtime($filename)) {
@unlink($path);
$annot = $this->reader->getMethodAnnotations($method);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
return $this->loadedAnnotations[$key] = include $path;
}
private function saveCacheFile($path, $data)
{
if (!is_writable($this->dir)) {
throw new \InvalidArgumentException(sprintf('The directory "%s" is not writable. Both, the webserver and the console user need access. You can manage access rights for multiple users with "chmod +a". If your system does not support this, check out the acl package.', $this->dir));
}
$tempfile = tempnam($this->dir, uniqid('', true));
if (false === $tempfile) {
throw new \RuntimeException(sprintf('Unable to create tempfile in directory: %s', $this->dir));
}
$written = file_put_contents($tempfile,'<?php return unserialize('.var_export(serialize($data), true).');');
if (false === $written) {
throw new \RuntimeException(sprintf('Unable to write cached file to: %s', $tempfile));
}
if (false === rename($tempfile, $path)) {
throw new \RuntimeException(sprintf('Unable to rename %s to %s', $tempfile, $path));
}
@chmod($path, 0666 & ~umask());
@unlink($tempfile);
}
public function getClassAnnotation(\ReflectionClass $class, $annotationName)
{
$annotations = $this->getClassAnnotations($class);
foreach ($annotations as $annotation) {
if ($annotation instanceof $annotationName) {
return $annotation;
}
}
return null;
}
public function getMethodAnnotation(\ReflectionMethod $method, $annotationName)
{
$annotations = $this->getMethodAnnotations($method);
foreach ($annotations as $annotation) {
if ($annotation instanceof $annotationName) {
return $annotation;
}
}
return null;
}
public function getPropertyAnnotation(\ReflectionProperty $property, $annotationName)
{
$annotations = $this->getPropertyAnnotations($property);
foreach ($annotations as $annotation) {
if ($annotation instanceof $annotationName) {
return $annotation;
}
}
return null;
}
public function clearLoadedAnnotations()
{
$this->loadedAnnotations = array();
}
}
}
namespace Doctrine\Common\Annotations
{
use SplFileObject;
final class PhpParser
{
public function parseClass(\ReflectionClass $class)
{
if (method_exists($class,'getUseStatements')) {
return $class->getUseStatements();
}
if (false === $filename = $class->getFilename()) {
return array();
}
$content = $this->getFileContent($filename, $class->getStartLine());
if (null === $content) {
return array();
}
$namespace = preg_quote($class->getNamespaceName());
$content = preg_replace('/^.*?(\bnamespace\s+'. $namespace .'\s*[;{].*)$/s','\\1', $content);
$tokenizer = new TokenParser('<?php '. $content);
$statements = $tokenizer->parseUseStatements($class->getNamespaceName());
return $statements;
}
private function getFileContent($filename, $lineNumber)
{
if ( ! is_file($filename)) {
return null;
}
$content ='';
$lineCnt = 0;
$file = new SplFileObject($filename);
while (!$file->eof()) {
if ($lineCnt++ == $lineNumber) {
break;
}
$content .= $file->fgets();
}
return $content;
}
}
}
namespace Doctrine\Common
{
use Doctrine\Common\Lexer\AbstractLexer;
abstract class Lexer extends AbstractLexer
{
}
}
namespace Doctrine\Common\Persistence
{
interface Proxy
{
const MARKER ='__CG__';
const MARKER_LENGTH = 6;
public function __load();
public function __isInitialized();
}
}
namespace Doctrine\Common\Util
{
use Doctrine\Common\Persistence\Proxy;
class ClassUtils
{
public static function getRealClass($class)
{
if (false === $pos = strrpos($class,'\\'.Proxy::MARKER.'\\')) {
return $class;
}
return substr($class, $pos + Proxy::MARKER_LENGTH + 2);
}
public static function getClass($object)
{
return self::getRealClass(get_class($object));
}
public static function getParentClass($className)
{
return get_parent_class( self::getRealClass( $className ) );
}
public static function newReflectionClass($class)
{
return new \ReflectionClass( self::getRealClass( $class ) );
}
public static function newReflectionObject($object)
{
return self::newReflectionClass( self::getClass( $object ) );
}
public static function generateProxyClassName($className, $proxyNamespace)
{
return rtrim($proxyNamespace,'\\') .'\\'.Proxy::MARKER.'\\'. ltrim($className,'\\');
}
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
interface BlockServiceInterface
{
public function buildEditForm(FormMapper $form, BlockInterface $block);
public function buildCreateForm(FormMapper $form, BlockInterface $block);
public function execute(BlockContextInterface $blockContext, Response $response = null);
public function validateBlock(ErrorElement $errorElement, BlockInterface $block);
public function getName();
public function setDefaultSettings(OptionsResolverInterface $resolver);
public function load(BlockInterface $block);
public function getJavascripts($media);
public function getStylesheets($media);
public function getCacheKeys(BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
abstract class BaseBlockService implements BlockServiceInterface
{
protected $name;
protected $templating;
public function __construct($name, EngineInterface $templating)
{
$this->name = $name;
$this->templating = $templating;
}
public function renderResponse($view, array $parameters = array(), Response $response = null)
{
return $this->getTemplating()->renderResponse($view, $parameters, $response);
}
public function renderPrivateResponse($view, array $parameters = array(), Response $response = null)
{
return $this->renderResponse($view, $parameters, $response)
->setTtl(0)
->setPrivate()
;
}
public function getName()
{
return $this->name;
}
public function getTemplating()
{
return $this->templating;
}
public function buildCreateForm(FormMapper $formMapper, BlockInterface $block)
{
$this->buildEditForm($formMapper, $block);
}
public function getCacheKeys(BlockInterface $block)
{
return array('block_id'=> $block->getId(),'updated_at'=> $block->getUpdatedAt() ? $block->getUpdatedAt()->format('U') : strtotime('now'),
);
}
public function prePersist(BlockInterface $block)
{
}
public function postPersist(BlockInterface $block)
{
}
public function preUpdate(BlockInterface $block)
{
}
public function postUpdate(BlockInterface $block)
{
}
public function preRemove(BlockInterface $block)
{
}
public function postRemove(BlockInterface $block)
{
}
public function load(BlockInterface $block)
{
}
public function getJavascripts($media)
{
return array();
}
public function getStylesheets($media)
{
return array();
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return $this->renderResponse($blockContext->getTemplate(), array('block_context'=> $blockContext,'block'=> $blockContext->getBlock(),
), $response);
}
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
}
}
namespace Sonata\PageBundle\Block
{
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Templating\EngineInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\PageBundle\Exception\PageNotFoundException;
use Sonata\PageBundle\Site\SiteSelectorInterface;
use Sonata\PageBundle\CmsManager\CmsManagerSelectorInterface;
class ChildrenPagesBlockService extends BaseBlockService
{
protected $siteSelector;
protected $cmsManagerSelector;
public function __construct($name, EngineInterface $templating, SiteSelectorInterface $siteSelector, CmsManagerSelectorInterface $cmsManagerSelector)
{
parent::__construct($name, $templating);
$this->siteSelector = $siteSelector;
$this->cmsManagerSelector = $cmsManagerSelector;
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$settings = $blockContext->getSettings();
$cmsManager = $this->cmsManagerSelector->retrieve();
if ($settings['current']) {
$page = $cmsManager->getCurrentPage();
} elseif ($settings['pageId']) {
$page = $settings['pageId'];
} else {
try {
$page = $cmsManager->getPage($this->siteSelector->retrieve(),'/');
} catch (PageNotFoundException $e) {
$page = false;
}
}
return $this->renderResponse($blockContext->getTemplate(), array('page'=> $page,'block'=> $blockContext->getBlock(),'settings'=> $settings
), $response);
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('settings','sonata_type_immutable_array', array('keys'=> array(
array('title','text', array('required'=> false
)),
array('current','checkbox', array('required'=> false
)),
array('pageId','sonata_page_selector', array('model_manager'=> $formMapper->getAdmin()->getModelManager(),'class'=> $formMapper->getAdmin()->getClass(),'site'=> $block->getPage()->getSite(),'required'=> false
)),
array('class','text', array('required'=> false
)),
)
));
}
public function getName()
{
return'Children Page (core)';
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('current'=> true,'pageId'=> null,'title'=>'','class'=>'','template'=>'SonataPageBundle:Block:block_core_children_pages.html.twig'));
}
public function prePersist(BlockInterface $block)
{
$block->setSetting('pageId', is_object($block->getSetting('pageId')) ? $block->getSetting('pageId')->getId() : null);
}
public function preUpdate(BlockInterface $block)
{
$block->setSetting('pageId', is_object($block->getSetting('pageId')) ? $block->getSetting('pageId')->getId() : null);
}
public function load(BlockInterface $block)
{
if (is_numeric($block->getSetting('pageId', null))) {
$cmsManager = $this->cmsManagerSelector->retrieve();
$site = $block->getPage()->getSite();
$block->setSetting('pageId', $cmsManager->getPage($site, $block->getSetting('pageId')));
}
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ContainerBlockService extends BaseBlockService
{
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('enabled');
$formMapper->add('settings','sonata_type_immutable_array', array('keys'=> array(
array('code','text', array('required'=> false)),
array('layout','textarea', array()),
array('class','text', array('required'=> false)),
array('template','sonata_type_container_template_choice', array())
)
));
$formMapper->add('children','sonata_type_collection', array(), array('admin_code'=>'sonata.page.admin.block','edit'=>'inline','inline'=>'table','sortable'=>'position'));
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return $this->renderResponse($blockContext->getTemplate(), array('block'=> $blockContext->getBlock(),'decorator'=> $this->getDecorator($blockContext->getSetting('layout')),'settings'=> $blockContext->getSettings(),
), $response);
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('code'=>'','layout'=>'{{ CONTENT }}','class'=>'','template'=>'SonataBlockBundle:Block:block_container.html.twig',
));
}
public function getName()
{
return $this->name;
}
protected function getDecorator($layout)
{
$key ='{{ CONTENT }}';
if (strpos($layout, $key) === false) {
return array();
}
$segments = explode($key, $layout);
$decorator = array('pre'=> isset($segments[0]) ? $segments[0] :'','post'=> isset($segments[1]) ? $segments[1] :'',
);
return $decorator;
}
}
}
namespace Sonata\PageBundle\Block
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\Service\ContainerBlockService as BaseContainerBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ContainerBlockService extends BaseContainerBlockService
{
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('code'=>'','layout'=>'{{ CONTENT }}','class'=>'','template'=>'SonataPageBundle:Block:block_container.html.twig',
));
}
}
}
namespace Sonata\Cache
{
interface CacheAdapterInterface
{
function get(array $keys);
function has(array $keys);
function set(array $keys, $value, $ttl = CacheElement::DAY, array $contextualKeys = array());
function flush(array $keys = array());
function flushAll();
function isContextual();
}}
namespace Sonata\CacheBundle\Adapter
{
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Sonata\Cache\CacheAdapterInterface;
use Sonata\Cache\CacheElement;
use Symfony\Component\HttpFoundation\Request;
class VarnishCache implements CacheAdapterInterface
{
protected $token;
protected $servers;
protected $router;
protected $purgeInstruction;
protected $resolver;
public function __construct($token, array $servers, RouterInterface $router, $purgeInstruction, ControllerResolverInterface $resolver = null)
{
$this->token = $token;
$this->servers = $servers;
$this->router = $router;
$this->purgeInstruction = $purgeInstruction;
$this->resolver = $resolver;
}
public function flushAll()
{
return $this->runCommand(
$this->purgeInstruction =='ban'?'ban.url':'purge',
$this->purgeInstruction =='ban'?'.*':'req.url ~ .*');
}
protected function runCommand($command, $expression)
{
$return = true;
foreach ($this->servers as $server) {
$command = str_replace(array('{{ COMMAND }}','{{ EXPRESSION }}'), array($command, $expression), $server);
$process = new Process($command);
if ($process->run() == 0) {
continue;
}
$return = false;
}
return $return;
}
public function flush(array $keys = array())
{
$parameters = array();
foreach ($keys as $key => $value) {
$parameters[] = sprintf('obj.http.%s ~ %s', $this->normalize($key), $value);
}
$purge = implode(" && ", $parameters);
return $this->runCommand($this->purgeInstruction, $purge);
}
public function has(array $keys)
{
return true;
}
public function get(array $keys)
{
if (!isset($keys['controller'])) {
throw new \RuntimeException('Please define a controller key');
}
if (!isset($keys['parameters'])) {
throw new \RuntimeException('Please define a parameters key');
}
$content = sprintf('<esi:include src="%s"/>', $this->getUrl($keys));
return new CacheElement($keys, new Response($content));
}
public function set(array $keys, $data, $ttl = CacheElement::DAY, array $contextualKeys = array())
{
return new CacheElement($keys, $data, $ttl, $contextualKeys);
}
protected function getUrl(array $keys)
{
$parameters = array('token'=> $this->computeHash($keys),'parameters'=> $keys
);
return $this->router->generate('sonata_cache_esi', $parameters, false);
}
protected function computeHash(array $keys)
{
ksort($keys);
return hash('sha256', $this->token.serialize($keys));
}
protected function normalize($key)
{
return sprintf('x-sonata-cache-%s', str_replace(array('_','\\'),'-', strtolower($key)));
}
public function cacheAction(Request $request)
{
$parameters = $request->get('parameters', array());
if ($request->get('token') != $this->computeHash($parameters)) {
throw new AccessDeniedHttpException('Invalid token');
}
$subRequest = Request::create('','get', $parameters, $request->cookies->all(), array(), $request->server->all());
$controller = $this->resolver->getController($subRequest);
$subRequest->attributes->add(array('_controller'=> $parameters['controller']));
$subRequest->attributes->add($parameters['parameters']);
$arguments = $this->resolver->getArguments($subRequest, $controller);
return call_user_func_array($controller, $arguments);
}
public function isContextual()
{
return true;
}
}
}
namespace Sonata\PageBundle\Cache
{
use Sonata\BlockBundle\Block\BlockContextManagerInterface;
use Sonata\Cache\Invalidation\Recorder;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sonata\Cache\CacheElement;
use Sonata\BlockBundle\Block\BlockRendererInterface;
use Sonata\CacheBundle\Adapter\VarnishCache;
class BlockEsiCache extends VarnishCache
{
protected $blockRenderer;
protected $managers;
protected $contextManager;
protected $recorder;
public function __construct($token, array $servers, RouterInterface $router, $purgeInstruction, BlockRendererInterface $blockRenderer, BlockContextManagerInterface $contextManager, array $managers = array(), Recorder $recorder = null)
{
parent::__construct($token, $servers, $router, $purgeInstruction, null);
$this->blockRenderer = $blockRenderer;
$this->managers = $managers;
$this->contextManager = $contextManager;
$this->recorder = $recorder;
}
private function validateKeys(array $keys)
{
foreach (array('block_id','page_id','manager','updated_at') as $key) {
if (!isset($keys[$key])) {
throw new \RuntimeException(sprintf('Please define a `%s` key', $key));
}
}
}
public function get(array $keys)
{
$this->validateKeys($keys);
$keys['_token'] = $this->computeHash($keys);
$content = sprintf('<esi:include src="%s" />', $this->router->generate('sonata_page_cache_esi', $keys, true));
return new CacheElement($keys, new Response($content));
}
public function set(array $keys, $data, $ttl = CacheElement::DAY, array $contextualKeys = array())
{
$this->validateKeys($keys);
return new CacheElement($keys, $data, $ttl, $contextualKeys);
}
protected function computeHash(array $keys)
{
return hash('sha256', $this->token . serialize(array('manager'=> (string)$keys['manager'],'page_id'=> (string)$keys['page_id'],'block_id'=> (string)$keys['block_id'],'updated_at'=> (string)$keys['updated_at'],
)));
}
public function cacheAction(Request $request)
{
$parameters = array_merge($request->query->all(), $request->attributes->all());
if ($request->get('_token') != $this->computeHash($parameters)) {
throw new AccessDeniedHttpException('Invalid token');
}
$manager = $this->getManager($request);
$page = $manager->getPageById($request->get('page_id'));
if (!$page) {
throw new NotFoundHttpException(sprintf('Page not found : %s', $request->get('page_id')));
}
$block = $manager->getBlock($request->get('block_id'));
$blockContext = $this->contextManager->get($block);
if ($this->recorder) {
$this->recorder->add($blockContext->getBlock());
$this->recorder->push();
}
$response = $this->blockRenderer->render($blockContext);
if ($this->recorder) {
$keys = $this->recorder->pop();
$keys['page_id'] = $page->getId();
$keys['block_id'] = $block->getId();
foreach ($keys as $key => $value) {
$response->headers->set($this->normalize($key), $value);
}
}
$response->headers->set('x-sonata-page-not-decorable', true);
return $response;
}
private function getManager(Request $request)
{
if (!isset($this->managers[$request->get('manager')])) {
throw new NotFoundHttpException(sprintf('The manager `%s` does not exist', $request->get('manager')));
}
return $this->managers[$request->get('manager')];
}
}
}
namespace Sonata\PageBundle\Cache
{
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sonata\BlockBundle\Block\BlockContextManagerInterface;
use Sonata\BlockBundle\Block\BlockRendererInterface;
use Sonata\PageBundle\CmsManager\CmsManagerSelectorInterface;
use Sonata\PageBundle\Exception\PageNotFoundException;
use Sonata\Cache\CacheAdapterInterface;
use Sonata\Cache\CacheElement;
class BlockJsCache implements CacheAdapterInterface
{
protected $router;
protected $sync;
protected $cmsSelector;
protected $blockRenderer;
protected $contextManager;
public function __construct(RouterInterface $router, CmsManagerSelectorInterface $cmsSelector, BlockRendererInterface $blockRenderer, BlockContextManagerInterface $contextManager, $sync = false)
{
$this->router = $router;
$this->sync = $sync;
$this->cmsSelector = $cmsSelector;
$this->blockRenderer = $blockRenderer;
$this->contextManager = $contextManager;
}
public function flushAll()
{
return true;
}
public function flush(array $keys = array())
{
return true;
}
public function has(array $keys)
{
return true;
}
public function get(array $keys)
{
$this->validateKeys($keys);
return new CacheElement($keys, new Response($this->sync ? $this->getSync($keys) : $this->getAsync($keys)));
}
private function validateKeys(array $keys)
{
foreach (array('block_id','page_id','manager','updated_at') as $key) {
if (!isset($keys[$key])) {
throw new \RuntimeException(sprintf('Please define a `%s` key, provided: %s', $key, json_encode(array_keys($keys))));
}
}
}
protected function getSync(array $keys)
{
return sprintf('<div id="block-cms-%s" >
    <script>
        /*<![CDATA[*/
            (function () {
                var block, xhr;
                block = document.getElementById("block-cms-%s");
                if (window.XMLHttpRequest) {
                    xhr = new XMLHttpRequest();
                } else {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xhr.open("GET", "%s", false);
                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                xhr.send("");

                // create an empty element
                var div = document.createElement("div");
                div.innerHTML = xhr.responseText;

                fo  r (var node in div.childNodes) {
                    if (div.childNodes[node] && div.childNodes[node].nodeType == 1) {
                        block.parentNode.replaceChild(div.childNodes[node], block);
                    }
                }
            })();
        /*]]>*/
    </script>
</div>', $keys['block_id'], $keys['block_id'], $this->router->generate('sonata_page_js_sync_cache', $keys, true));
}
protected function getAsync(array $keys)
{
return sprintf('<div id="block-cms-%s" >
    <script>
        /*<![CDATA[*/
            (function() {
                var b = document.createElement("script");
                b.type = "text/javascript";
                b.async = true;
                b.src = "%s"
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(b, s);
            })();

        /*]]>*/
    </script>
</div>', $keys['block_id'], $this->router->generate('sonata_page_js_async_cache', $keys, true));
}
public function set(array $keys, $data, $ttl = CacheElement::DAY, array $contextualKeys = array())
{
$this->validateKeys($keys);
return new CacheElement($keys, $data, $ttl, $contextualKeys);
}
public function cacheAction(Request $request)
{
$cms = $this->cmsSelector->retrieve();
try {
$page = $cms->getPageById($request->get('page_id'));
} catch (PageNotFoundException $e) {
$page = false;
}
$block = $cms->getBlock($request->get('block_id'));
if (!$page || !$block) {
return new Response('', 404);
}
$options = array();
$blockContext = $this->contextManager->get($block, $options);
$response = $this->blockRenderer->render($blockContext);
$response->setPrivate();
if ($this->sync) {
return $response;
}
$response->setContent(sprintf('
    (function () {
        var block = document.getElementById("block-cms-%s");

        var div = document.createElement("div");
        div.innerHTML = %s;

        for (var node in div.childNodes) {
            if (div.childNodes[node] && div.childNodes[node].nodeType == 1) {
                block.parentNode.replaceChild(div.childNodes[node], block);
            }
        }
    })();
', $block->getId(), json_encode($response->getContent())));
$response->headers->set('Content-Type','application/javascript');
return $response;
}
public function isContextual()
{
return false;
}
}
}
namespace Sonata\CacheBundle\Adapter
{
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Sonata\Cache\CacheAdapterInterface;
use Sonata\Cache\CacheElement;
use Symfony\Component\HttpFoundation\Request;
class SsiCache implements CacheAdapterInterface
{
protected $router;
protected $servers;
protected $resolver;
protected $token;
public function __construct($token, RouterInterface $router, ControllerResolverInterface $resolver = null)
{
$this->token = $token;
$this->router = $router;
$this->resolver = $resolver;
}
public function flushAll()
{
return true; }
public function flush(array $keys = array())
{
return true; }
public function has(array $keys)
{
return true;
}
public function get(array $keys)
{
if (!isset($keys['controller'])) {
throw new \RuntimeException('Please define a controller key');
}
if (!isset($keys['parameters'])) {
throw new \RuntimeException('Please define a parameters key');
}
$content = sprintf('<!--# include virtual="%s" -->', $this->getUrl($keys));
return new CacheElement($keys, new Response($content));
}
public function set(array $keys, $data, $ttl = CacheElement::DAY, array $contextualKeys = array())
{
return new CacheElement($keys, $data, $ttl, $contextualKeys);
}
protected function getUrl(array $keys)
{
$parameters = array('token'=> $this->computeHash($keys),'parameters'=> $keys
);
return $this->router->generate('sonata_cache_ssi', $parameters, false);
}
protected function computeHash(array $keys)
{
ksort($keys);
return hash('sha256', $this->token.serialize($keys));
}
public function cacheAction(Request $request)
{
$parameters = $request->get('parameters', array());
if ($request->get('token') != $this->computeHash($parameters)) {
throw new AccessDeniedHttpException('Invalid token');
}
$subRequest = Request::create('','get', $parameters, $request->cookies->all(), array(), $request->server->all());
$controller = $this->resolver->getController($subRequest);
$subRequest->attributes->add(array('_controller'=> $parameters['controller']));
$subRequest->attributes->add($parameters['parameters']);
$arguments = $this->resolver->getArguments($subRequest, $controller);
return call_user_func_array($controller, $arguments);
}
public function isContextual()
{
return true;
}
}
}
namespace Sonata\PageBundle\Cache
{
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sonata\BlockBundle\Block\BlockRendererInterface;
use Sonata\BlockBundle\Block\BlockContextManagerInterface;
use Sonata\PageBundle\CmsManager\CmsManagerInterface;
use Sonata\Cache\CacheElement;
use Sonata\CacheBundle\Adapter\SsiCache;
class BlockSsiCache extends SsiCache
{
protected $blockRenderer;
protected $managers;
protected $contextManager;
public function __construct($token, RouterInterface $router, BlockRendererInterface $blockRenderer, BlockContextManagerInterface $contextManager, array $managers = array())
{
parent::__construct($token, $router, null);
$this->managers = $managers;
$this->blockRenderer = $blockRenderer;
$this->contextManager = $contextManager;
}
private function validateKeys(array $keys)
{
foreach (array('block_id','page_id','manager','updated_at') as $key) {
if (!isset($keys[$key])) {
throw new \RuntimeException(sprintf('Please define a `%s` key', $key));
}
}
}
public function get(array $keys)
{
$this->validateKeys($keys);
$keys['_token'] = $this->computeHash($keys);
$content = sprintf('<!--# include virtual="%s" -->', $this->router->generate('sonata_page_cache_ssi', $keys, false));
return new CacheElement($keys, new Response($content));
}
public function set(array $keys, $data, $ttl = CacheElement::DAY, array $contextualKeys = array())
{
$this->validateKeys($keys);
return new CacheElement($keys, $data, $ttl, $contextualKeys);
}
protected function computeHash(array $keys)
{
return hash('sha256', $this->token.serialize(array('manager'=> (string) $keys['manager'],'page_id'=> (string) $keys['page_id'],'block_id'=> (string) $keys['block_id'],'updated_at'=> (string) $keys['updated_at'],
)));
}
public function cacheAction(Request $request)
{
$parameters = array_merge($request->query->all(), $request->attributes->all());
if ($request->get('_token') != $this->computeHash($parameters)) {
throw new AccessDeniedHttpException('Invalid token');
}
$manager = $this->getManager($request);
$page = $manager->getPageById($request->get('page_id'));
if (!$page) {
throw new NotFoundHttpException(sprintf('Page not found : %s', $request->get('page_id')));
}
$block = $manager->getBlock($request->get('block_id'));
$blockContext = $this->contextManager->get($block);
$response = $this->blockRenderer->render($blockContext);
$response->headers->set('x-sonata-page-not-decorable', true);
return $response;
}
private function getManager(Request $request)
{
if (!isset($this->managers[$request->get('manager')])) {
throw new NotFoundHttpException(sprintf('The manager `%s` does not exist', $request->get('manager')));
}
return $this->managers[$request->get('manager')];
}
}
}
namespace Sonata\PageBundle\CmsManager
{
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SiteInterface;
use Symfony\Component\HttpFoundation\Request;
interface CmsManagerInterface
{
public function findContainer($name, PageInterface $page, BlockInterface $parentContainer = null);
public function getPageByUrl(SiteInterface $site, $slug);
public function getPageByRouteName(SiteInterface $site, $routeName);
public function getPageByPageAlias(SiteInterface $site, $pageAlias);
public function getInternalRoute(SiteInterface $site, $routeName);
public function getPageByName(SiteInterface $site, $name);
public function getPageById($id);
public function getBlock($id);
public function getCurrentPage();
public function setCurrentPage(PageInterface $page);
public function getBlocks();
public function getPage(SiteInterface $site, $page);
}
}
namespace Sonata\PageBundle\CmsManager
{
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SiteInterface;
abstract class BaseCmsPageManager implements CmsManagerInterface
{
protected $currentPage;
protected $blocks = array();
public function getCurrentPage()
{
return $this->currentPage;
}
public function setCurrentPage(PageInterface $page)
{
$this->currentPage = $page;
}
public function getBlocks()
{
return $this->blocks;
}
public function getPageByUrl(SiteInterface $site, $url)
{
return $this->getPageBy($site,'url', $url);
}
public function getPageByRouteName(SiteInterface $site, $routeName)
{
return $this->getPageBy($site,'routeName', $routeName);
}
public function getPageByPageAlias(SiteInterface $site, $pageAlias)
{
return $this->getPageBy($site,'pageAlias', $pageAlias);
}
public function getPageByName(SiteInterface $site, $name)
{
return $this->getPageBy($site,'name', $name);
}
public function getPageById($id)
{
return $this->getPageBy(null,'id', $id);
}
abstract protected function getPageBy(SiteInterface $site = null, $fieldName, $value);
}
}
namespace Sonata\PageBundle\CmsManager
{
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\PageManagerInterface;
use Sonata\PageBundle\Model\SiteInterface;
use Sonata\PageBundle\Exception\PageNotFoundException;
use Sonata\PageBundle\Model\BlockInteractorInterface;
class CmsPageManager extends BaseCmsPageManager
{
protected $blockInteractor;
protected $pageManager;
protected $pageReferences = array();
protected $pages = array();
public function __construct(PageManagerInterface $pageManager, BlockInteractorInterface $blockInteractor)
{
$this->pageManager = $pageManager;
$this->blockInteractor = $blockInteractor;
}
public function getPage(SiteInterface $site, $page)
{
if (is_string($page) && substr($page, 0, 1) =='/') {
$page = $this->getPageByUrl($site, $page);
} elseif (is_string($page)) { $page = $this->getPageByRouteName($site, $page);
} elseif (is_numeric($page)) {
$page = $this->getPageById($page);
} elseif (!$page) { $page = $this->getCurrentPage();
}
if (!$page instanceof PageInterface) {
throw new PageNotFoundException('Unable to retrieve the page');
}
return $page;
}
public function getInternalRoute(SiteInterface $site, $pageName)
{
if (substr($pageName, 0, 5) =='error') {
throw new \RuntimeException(sprintf('Illegal internal route name : %s, an internal page cannot start with `error`', $pageName));
}
$routeName = sprintf('_page_internal_%s', $pageName);
try {
$page = $this->getPageByRouteName($site, $routeName);
} catch (PageNotFoundException $e) {
$page = $this->pageManager->create(array('url'=> null,'routeName'=> $routeName,'name'=> sprintf(sprintf('Internal Page : %s', $pageName)),'decorate'=> false,
));
$page->setSite($site);
$this->pageManager->save($page);
}
return $page;
}
public function findContainer($code, PageInterface $page, BlockInterface $parentContainer = null)
{
$container = null;
if ($parentContainer) {
$container = $parentContainer;
}
if (!$container && $page->getBlocks()) {
foreach ($page->getBlocks() as $block) {
if ($block->getSetting('code') == $code) {
$container = $block;
break;
}
}
}
if (!$container) {
$container = $this->blockInteractor->createNewContainer(array('enabled'=> true,'page'=> $page,'code'=> $code,'position'=> 1,'parent'=> $parentContainer
));
}
return $container;
}
protected function getPageBy(SiteInterface $site = null, $fieldName, $value)
{
if ('id'== $fieldName) {
$id = $value;
} elseif (isset($this->pageReferences[$fieldName][$value])) {
$id = $this->pageReferences[$fieldName][$value];
} else {
$id = null;
}
if (null === $id || !isset($this->pages[$id])) {
$this->pages[$id] = false;
$parameters = array(
$fieldName => $value,
);
if ($site) {
$parameters['site'] = $site->getId();
}
$page = $this->pageManager->findOneBy($parameters);
if (!$page) {
throw new PageNotFoundException(sprintf('Unable to find the page : %s = %s', $fieldName, $value));
}
$this->loadBlocks($page);
$id = $page->getId();
if ($fieldName !='id') {
$this->pageReferences[$fieldName][$value] = $id;
}
$this->pages[$id] = $page;
}
return $this->pages[$id];
}
public function getBlock($id)
{
if (!isset($this->blocks[$id])) {
$this->blocks[$id] = $this->blockInteractor->getBlock($id);
}
return $this->blocks[$id];
}
private function loadBlocks(PageInterface $page)
{
$blocks = $this->blockInteractor->loadPageBlocks($page);
foreach ($blocks as $block) {
$this->blocks[$block->getId()] = $block;
}
}
}
}
namespace Sonata\PageBundle\CmsManager
{
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SnapshotManagerInterface;
use Sonata\PageBundle\Model\SnapshotPageProxy;
use Sonata\PageBundle\Model\TransformerInterface;
use Sonata\BlockBundle\Util\RecursiveBlockIterator;
use Sonata\PageBundle\Model\SiteInterface;
use Sonata\PageBundle\Exception\PageNotFoundException;
class CmsSnapshotManager extends BaseCmsPageManager
{
protected $snapshotManager;
protected $transformer;
protected $pageReferences = array();
protected $pages = array();
public function __construct(SnapshotManagerInterface $snapshotManager, TransformerInterface $transformer)
{
$this->snapshotManager = $snapshotManager;
$this->transformer = $transformer;
}
public function getPage(SiteInterface $site, $page)
{
if (is_string($page) && substr($page, 0, 1) =='/') {
$page = $this->getPageByUrl($site, $page);
} elseif (is_string($page)) { $page = $this->getPageByRouteName($site, $page);
} elseif (is_numeric($page)) {
$page = $this->getPageById($page);
} elseif (!$page) { $page = $this->getCurrentPage();
}
if (!$page instanceof PageInterface) {
throw new PageNotFoundException('Unable to retrieve the snapshot');
}
return $page;
}
public function getInternalRoute(SiteInterface $site, $pageName)
{
return $this->getPageByRouteName($site, sprintf('_page_internal_%s', $pageName));
}
public function findContainer($code, PageInterface $page, BlockInterface $parentContainer = null)
{
$container = null;
if ($parentContainer) {
$container = $parentContainer;
}
if (!$container && $page->getBlocks()) {
foreach ($page->getBlocks() as $block) {
if ($block->getSetting('code') == $code) {
$container = $block;
break;
}
}
}
return $container;
}
protected function getPageBy(SiteInterface $site = null, $fieldName, $value)
{
if ('id'== $fieldName) {
$fieldName ='pageId';
$id = $value;
} elseif (isset($this->pageReferences[$fieldName][$value])) {
$id = $this->pageReferences[$fieldName][$value];
} else {
$id = null;
}
if (null === $id || !isset($this->pages[$id])) {
$parameters = array($fieldName => $value);
if ($site) {
$parameters['site'] = $site->getId();
}
$snapshot = $this->snapshotManager->findEnableSnapshot($parameters);
if (!$snapshot) {
throw new PageNotFoundException();
}
$page = new SnapshotPageProxy($this->snapshotManager, $this->transformer, $snapshot);
$this->pages[$id] = false;
if ($page) {
$this->loadBlocks($page);
$id = $page->getId();
if ($fieldName !='id') {
$this->pageReferences[$fieldName][$value] = $id;
}
$this->pages[$id] = $page;
}
}
return $this->pages[$id];
}
private function loadBlocks(PageInterface $page)
{
$i = new \RecursiveIteratorIterator(new RecursiveBlockIterator($page->getBlocks()), \RecursiveIteratorIterator::SELF_FIRST);
foreach ($i as $block) {
$this->blocks[$block->getId()] = $block;
}
}
public function getBlock($id)
{
if (isset($this->blocks[$id])) {
return $this->blocks[$id];
}
return null;
}
}
}
namespace Sonata\BlockBundle\Model
{
interface BlockInterface
{
public function setId($id);
public function getId();
public function setName($name);
public function getName();
public function setType($type);
public function getType();
public function setEnabled($enabled);
public function getEnabled();
public function setPosition($position);
public function getPosition();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function getTtl();
public function setSettings(array $settings = array());
public function getSettings();
public function setSetting($name, $value);
public function getSetting($name, $default = null);
public function addChildren(BlockInterface $children);
public function getChildren();
public function hasChildren();
public function setParent(BlockInterface $parent = null);
public function getParent();
public function hasParent();
}
}
namespace Sonata\PageBundle\Model
{
use Sonata\BlockBundle\Model\BlockInterface;
interface PageBlockInterface extends BlockInterface
{
public function getPage();
public function setPage(PageInterface $page = null);
}
}
namespace Sonata\BlockBundle\Model
{
abstract class BaseBlock implements BlockInterface
{
protected $name;
protected $settings;
protected $enabled;
protected $position;
protected $parent;
protected $children;
protected $createdAt;
protected $updatedAt;
protected $type;
protected $ttl;
public function __construct()
{
$this->settings = array();
$this->enabled = false;
$this->children = array();
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setType($type)
{
$this->type = $type;
}
public function getType()
{
return $this->type;
}
public function setSettings(array $settings = array())
{
$this->settings = $settings;
}
public function getSettings()
{
return $this->settings;
}
public function setSetting($name, $value)
{
$this->settings[$name] = $value;
}
public function getSetting($name, $default = null)
{
return isset($this->settings[$name]) ? $this->settings[$name] : $default;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setPosition($position)
{
$this->position = $position;
}
public function getPosition()
{
return $this->position;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function addChildren(BlockInterface $child)
{
$this->children[] = $child;
$child->setParent($this);
}
public function getChildren()
{
return $this->children;
}
public function setParent(BlockInterface $parent = null)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function hasParent()
{
return $this->getParent() instanceof self;
}
public function __toString()
{
return sprintf("%s ~ #%s", $this->getname(), $this->getId());
}
public function getTtl()
{
if (!$this->getSetting('use_cache', true)) {
return 0;
}
$ttl = $this->getSetting('ttl', 86400);
foreach ($this->getChildren() as $block) {
$blockTtl = $block->getTtl();
$ttl = ($blockTtl < $ttl) ? $blockTtl : $ttl;
}
$this->ttl = $ttl;
return $this->ttl;
}
public function hasChildren()
{
return count($this->children) > 0;
}
}
}
namespace Sonata\PageBundle\Model
{
use Sonata\BlockBundle\Model\BaseBlock;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\PageBlockInterface;
use Sonata\BlockBundle\Model\BlockInterface;
abstract class Block extends BaseBlock implements PageBlockInterface
{
protected $page;
public function addChildren(BlockInterface $child)
{
$this->children[] = $child;
$child->setParent($this);
if ($child instanceof PageBlockInterface) {
$child->setPage($this->getPage());
}
}
public function setPage(PageInterface $page = null)
{
$this->page = $page;
}
public function getPage()
{
return $this->page;
}
public function disableChildrenLazyLoading()
{
if (is_object($this->children)) {
$this->children->setInitialized(true);
}
}
}
}
namespace Sonata\PageBundle\Entity
{
use Sonata\PageBundle\Model\Block;
use Doctrine\Common\Collections\ArrayCollection;
abstract class BaseBlock extends Block
{
public function setId($id)
{
$this->id = $id;
}
public function __construct()
{
$this->children = new ArrayCollection;
parent::__construct();
}
public function prePersist()
{
$this->createdAt = new \DateTime;
$this->updatedAt = new \DateTime;
}
public function preUpdate()
{
$this->updatedAt = new \DateTime;
}
public function setChildren($children)
{
$this->children = new ArrayCollection;
foreach ($children as $child) {
$this->addChildren($child);
}
}
}
}
namespace Sonata\PageBundle\Model
{
interface SiteInterface
{
public function getId();
public function setName($name);
public function getName();
public function setHost($host);
public function getHost();
public function getLocale();
public function setLocale($locale);
public function getEnabledFrom();
public function setEnabledFrom(\DateTime $enabledFrom = null);
public function getEnabledTo();
public function setEnabledTo(\DateTime $enabledTo = null);
public function getIsDefault();
public function setIsDefault($default);
public function setRelativePath($path);
public function getRelativePath();
public function setEnabled($enabled);
public function getEnabled();
public function isEnabled();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function __toString();
public function getUrl();
public function isLocalhost();
public function setMetaDescription($metaDescription);
public function getMetaDescription();
public function setMetaKeywords($metaKeywords);
public function getMetaKeywords();
public function setTitle($title);
public function getTitle();
}
}
namespace Sonata\PageBundle\Model
{
abstract class Site implements SiteInterface
{
protected $enabled;
protected $createdAt;
protected $updatedAt;
protected $name;
protected $host;
protected $relativePath;
protected $enabledFrom;
protected $enabledTo;
protected $isDefault;
protected $formats = array();
protected $locale;
protected $title;
protected $metaKeywords;
protected $metaDescription;
public function setId($id)
{
$this->id = $id;
}
public function __construct()
{
$this->enabled = false;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function isEnabled()
{
$now = new \DateTime;
if ($this->getEnabledFrom() instanceof \DateTime && $this->getEnabledFrom()->format('U') > $now->format('U')) {
return false;
}
if ($this->getEnabledTo() instanceof \DateTime && $now->format('U') > $this->getEnabledTo()->format('U')) {
return false;
}
return $this->enabled;
}
public function getUrl()
{
if ($this->isLocalhost()) {
return $this->getRelativePath();
}
return sprintf('http://%s%s', $this->getHost(), $this->getRelativePath());
}
public function isLocalhost()
{
return $this->getHost() =='localhost';
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function __toString()
{
return $this->getName() ? :'n/a';
}
public function setHost($host)
{
$this->host = $host;
}
public function getHost()
{
return $this->host;
}
public function setFormats($formats)
{
$this->formats = $formats;
}
public function getFormats()
{
return $this->formats;
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setRelativePath($relativePath)
{
$this->relativePath = $relativePath;
}
public function getRelativePath()
{
return $this->relativePath;
}
public function setIsDefault($default)
{
$this->isDefault = $default;
}
public function getIsDefault()
{
return $this->isDefault;
}
public function setEnabledFrom(\DateTime $enabledFrom = null)
{
$this->enabledFrom = $enabledFrom;
}
public function getEnabledFrom()
{
return $this->enabledFrom;
}
public function setEnabledTo(\DateTime $enabledTo = null)
{
$this->enabledTo = $enabledTo;
}
public function getEnabledTo()
{
return $this->enabledTo;
}
public function setLocale($locale)
{
$this->locale = $locale;
}
public function getLocale()
{
return $this->locale;
}
public function setMetaDescription($metaDescription)
{
$this->metaDescription = $metaDescription;
}
public function getMetaDescription()
{
return $this->metaDescription;
}
public function setMetaKeywords($metaKeywords)
{
$this->metaKeywords = $metaKeywords;
}
public function getMetaKeywords()
{
return $this->metaKeywords;
}
public function setTitle($title)
{
$this->title = $title;
}
public function getTitle()
{
return $this->title;
}
}
}
namespace Sonata\PageBundle\Entity
{
use Sonata\PageBundle\Model\Site;
abstract class BaseSite extends Site
{
public function prePersist()
{
$this->createdAt = new \DateTime;
$this->updatedAt = new \DateTime;
}
public function preUpdate()
{
$this->updatedAt = new \DateTime;
}
}
}
namespace Sonata\PageBundle\Model
{
interface SnapshotInterface
{
public function setRouteName($routeName);
public function getRouteName();
public function getPageAlias();
public function setPageAlias($pageAlias);
public function getType();
public function setType($type);
public function setEnabled($enabled);
public function getEnabled();
public function setName($name);
public function getName();
public function setUrl($url);
public function getUrl();
public function setPublicationDateStart(\DateTime $publicationDateStart = null);
public function getPublicationDateStart();
public function setPublicationDateEnd(\DateTime $publicationDateEnd = null);
public function getPublicationDateEnd();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function setDecorate($decorate);
public function getDecorate();
public function isHybrid();
public function setPosition($position);
public function getPosition();
public function setPage(PageInterface $page = null);
public function getPage();
public function setSite(SiteInterface $site);
public function getSite();
public function getContent();
}
}
namespace Sonata\PageBundle\Model
{
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SnapshotInterface;
abstract class Snapshot implements SnapshotInterface
{
protected $createdAt;
protected $updatedAt;
protected $routeName;
protected $pageAlias;
protected $type;
protected $name;
protected $url;
protected $enabled;
protected $publicationDateStart;
protected $publicationDateEnd;
protected $position = 1;
protected $decorate = true;
protected $content = array();
protected $page;
protected $children = array();
protected $parent;
protected $parentId;
protected $sources;
protected $target;
protected $targetId;
protected $site;
public function setRouteName($routeName)
{
$this->routeName = $routeName;
}
public function getRouteName()
{
return $this->routeName;
}
public function setPageAlias($pageAlias)
{
$this->pageAlias = $pageAlias;
}
public function getPageAlias()
{
return $this->pageAlias;
}
public function setType($type)
{
$this->type = $type;
}
public function getType()
{
return $this->type;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setPublicationDateStart(\DateTime $publicationDateStart = null)
{
$this->publicationDateStart = $publicationDateStart;
}
public function getPublicationDateStart()
{
return $this->publicationDateStart;
}
public function setPublicationDateEnd(\DateTime $publicationDateEnd = null)
{
$this->publicationDateEnd = $publicationDateEnd;
}
public function getPublicationDateEnd()
{
return $this->publicationDateEnd;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function setDecorate($decorate)
{
$this->decorate = $decorate;
}
public function getDecorate()
{
return $this->decorate;
}
public function isHybrid()
{
return $this->getRouteName() != self::PAGE_ROUTE_CMS_NAME;
}
public function __toString()
{
return $this->getName()?:'-';
}
public function setPosition($position)
{
$this->position = $position;
}
public function getPosition()
{
return $this->position;
}
public function setContent($content)
{
$this->content = $content;
}
public function getContent()
{
return $this->content;
}
public function setPage(PageInterface $page = null)
{
$this->page = $page;
}
public function getPage()
{
return $this->page;
}
public function setChildren($children)
{
$this->children = $children;
}
public function getChildren()
{
return $this->children;
}
public function setParent($parent)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function setParentId($parentId)
{
$this->parentId = $parentId;
}
public function getParentId()
{
return $this->parentId;
}
public function setSources($sources)
{
$this->sources = $sources;
}
public function getSource()
{
return $this->sources;
}
public function setTarget($target)
{
$this->target = $target;
}
public function getTarget()
{
return $this->target;
}
public function setTargetId($targetId)
{
$this->targetId = $targetId;
}
public function getTargetId()
{
return $this->targetId;
}
public function setUrl($url)
{
$this->url = $url;
}
public function getUrl()
{
return $this->url;
}
public function setSite(SiteInterface $site)
{
$this->site = $site;
}
public function getSite()
{
return $this->site;
}
}
}
namespace Sonata\PageBundle\Entity
{
use Sonata\PageBundle\Model\Snapshot;
abstract class BaseSnapshot extends Snapshot
{
public function prePersist()
{
$this->createdAt = new \DateTime;
$this->updatedAt = new \DateTime;
}
public function preUpdate()
{
$this->updatedAt = new \DateTime;
}
}
}
namespace Sonata\PageBundle\Model
{
interface BlockInteractorInterface
{
public function getBlock($id);
public function getBlocksById(PageInterface $page);
public function loadPageBlocks(PageInterface $page);
public function saveBlocksPosition(array $data = array(), $partial = true);
public function createNewContainer(array $values = array(), \Closure $alter = null);
}
}
namespace Sonata\PageBundle\Entity
{
use Symfony\Bridge\Doctrine\RegistryInterface;
use Sonata\BlockBundle\Model\BlockManagerInterface;
use Sonata\PageBundle\Model\BlockInteractorInterface;
use Sonata\PageBundle\Model\PageInterface;
class BlockInteractor implements BlockInteractorInterface
{
protected $pageBlocksLoaded = array();
protected $registry;
protected $blockManager;
public function __construct(RegistryInterface $registry, BlockManagerInterface $blockManager)
{
$this->blockManager = $blockManager;
$this->registry = $registry;
}
public function getBlock($id)
{
$blocks = $this->getEntityManager()->createQueryBuilder()
->select('b')
->from($this->blockManager->getClass(),'b')
->where('b.id = :id')
->setParameters(array('id'=> $id
))
->getQuery()
->execute();
return count($blocks) > 0 ? $blocks[0] : false;
}
public function getBlocksById(PageInterface $page)
{
$blocks = $this->getEntityManager()
->createQuery(sprintf('SELECT b FROM %s b INDEX BY b.id WHERE b.page = :page ORDER BY b.position ASC', $this->blockManager->getClass()))
->setParameters(array('page'=> $page->getId()
))
->execute();
return $blocks;
}
public function saveBlocksPosition(array $data = array(), $partial = true)
{
$em = $this->getEntityManager();
$em->getConnection()->beginTransaction();
try {
foreach ($data as $block) {
if (!$block['id'] or !array_key_exists('position', $block) or !$block['parent_id'] or !$block['page_id']) {
continue;
}
$this->blockManager->updatePosition($block['id'], $block['position'], $block['parent_id'], $block['page_id'], $partial);
}
$em->flush();
$em->getConnection()->commit();
} catch (\Exception $e) {
$em->getConnection()->rollback();
throw $e;
}
return true;
}
public function createNewContainer(array $values = array(), \Closure $alter = null)
{
$container = $this->blockManager->create();
$container->setEnabled(isset($values['enabled']) ? $values['enabled'] : true);
$container->setCreatedAt(new \DateTime);
$container->setUpdatedAt(new \DateTime);
$container->setType('sonata.page.block.container');
if (isset($values['page'])) {
$container->setPage($values['page']);
}
if (isset($values['name'])) {
$container->setName($values['name']);
} else {
$container->setName(isset($values['code']) ? $values['code'] :'No name defined');
}
$container->setSettings(array('code'=> isset($values['code']) ? $values['code'] :'no code defined'));
$container->setPosition(isset($values['position']) ? $values['position'] : 1);
if (isset($values['parent'])) {
$container->setParent($values['parent']);
}
if ($alter) {
$alter($container);
}
$this->blockManager->save($container);
return $container;
}
public function loadPageBlocks(PageInterface $page)
{
if (isset($this->pageBlocksLoaded[$page->getId()])) {
return array();
}
$blocks = $this->getBlocksById($page);
$page->disableBlockLazyLoading();
foreach ($blocks as $block) {
$parent = $block->getParent();
$block->disableChildrenLazyLoading();
if (!$parent) {
$page->addBlocks($block);
continue;
}
$blocks[$block->getParent()->getId()]->disableChildrenLazyLoading();
$blocks[$block->getParent()->getId()]->addChildren($block);
}
$this->pageBlocksLoaded[$page->getId()] = true;
return $blocks;
}
private function getEntityManager()
{
return $this->registry->getManagerForClass($this->blockManager->getClass());
}
}
}
namespace Sonata\BlockBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\CoreBundle\Model\PageableManagerInterface;
interface BlockManagerInterface extends ManagerInterface, PageableManagerInterface
{
}
}
namespace Sonata\PageBundle\Entity
{
use Sonata\BlockBundle\Model\BlockManagerInterface;
use Sonata\CoreBundle\Model\BaseEntityManager;
use Sonata\DatagridBundle\Pager\Doctrine\Pager;
use Sonata\DatagridBundle\ProxyQuery\Doctrine\ProxyQuery;
class BlockManager extends BaseEntityManager implements BlockManagerInterface
{
public function save($page, $andFlush = true)
{
parent::save($page, $andFlush);
return $page;
}
public function updatePosition($id, $position, $parentId = null, $pageId = null, $partial = true)
{
if ($partial) {
$meta = $this->getEntityManager()->getClassMetadata($this->getClass());
$block = $this->getEntityManager()->getReference($this->getClass(), $id);
$pageRelation = $meta->getAssociationMapping('page');
$page = $this->getEntityManager()->getPartialReference($pageRelation['targetEntity'], $pageId);
$parentRelation = $meta->getAssociationMapping('parent');
$parent = $this->getEntityManager()->getPartialReference($parentRelation['targetEntity'], $parentId);
$block->setPage($page);
$block->setParent($parent);
} else {
$block = $this->find($id);
}
$block->setPosition($position);
$this->getEntityManager()->persist($block);
return $block;
}
public function getPager(array $criteria, $page, $limit = 10, array $sort = array())
{
$query = $this->getRepository()
->createQueryBuilder('b')
->select('b');
$parameters = array();
if (isset($criteria['enabled'])) {
$query->andWhere('p.enabled = :enabled');
$parameters['enabled'] = $criteria['enabled'];
}
if (isset($criteria['type'])) {
$query->andWhere('p.type = :type');
$parameters['type'] = $criteria['type'];
}
$query->setParameters($parameters);
$pager = new Pager();
$pager->setMaxPerPage($limit);
$pager->setQuery(new ProxyQuery($query));
$pager->setPage($page);
$pager->init();
return $pager;
}
}
}
namespace Sonata\PageBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\CoreBundle\Model\PageableManagerInterface;
interface PageManagerInterface extends ManagerInterface, PageableManagerInterface
{
public function getPageByUrl(SiteInterface $site, $url);
public function loadPages(SiteInterface $site);
public function fixUrl(PageInterface $page);
}
}
namespace Sonata\PageBundle\Entity
{
use Doctrine\Common\Persistence\ManagerRegistry;
use Sonata\CoreBundle\Model\BaseEntityManager;
use Sonata\PageBundle\Model\PageManagerInterface;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SiteInterface;
use Sonata\PageBundle\Model\Page;
use Sonata\DatagridBundle\Pager\Doctrine\Pager;
use Sonata\DatagridBundle\ProxyQuery\Doctrine\ProxyQuery;
class PageManager extends BaseEntityManager implements PageManagerInterface
{
protected $pageDefaults;
protected $defaults;
public function __construct($class, ManagerRegistry $registry, array $defaults = array(), array $pageDefaults = array())
{
parent::__construct($class, $registry);
$this->defaults = $defaults;
$this->pageDefaults = $pageDefaults;
}
public function getPageByUrl(SiteInterface $site, $url)
{
return $this->findOneBy(array('url'=> $url,'site'=> $site->getId()
));
}
public function getPager(array $criteria, $page, $limit = 10, array $sort = array())
{
$query = $this->getRepository()
->createQueryBuilder('p')
->select('p');
$fields = $this->getEntityManager()->getClassMetadata($this->class)->getFieldNames();
foreach ($sort as $field => $direction) {
if (!in_array($field, $fields)) {
throw new \RuntimeException(sprintf("Invalid sort field '%s' in '%s' class", $field, $this->class));
}
}
if (count($sort) == 0) {
$sort = array('name'=>'ASC');
}
foreach ($sort as $field => $direction) {
$query->orderBy(sprintf('p.%s', $field), strtoupper($direction));
}
$parameters = array();
if (isset($criteria['enabled'])) {
$query->andWhere('p.enabled = :enabled');
$parameters['enabled'] = $criteria['enabled'];
}
if (isset($criteria['edited'])) {
$query->andWhere('p.edited = :edited');
$parameters['edited'] = $criteria['edited'];
}
if (isset($criteria['site'])) {
$query->join('p.site','s');
$query->andWhere('s.id = :siteId');
$parameters['siteId'] = $criteria['site'];
}
if (isset($criteria['parent'])) {
$query->join('p.parent','pa');
$query->andWhere('pa.id = :parentId');
$parameters['parentId'] = $criteria['parent'];
}
if (isset($criteria['root'])) {
$isRoot = (bool) $criteria['root'];
if ($isRoot) {
$query->andWhere('p.parent IS NULL');
} else {
$query->andWhere('p.parent IS NOT NULL');
}
}
$query->setParameters($parameters);
$pager = new Pager();
$pager->setMaxPerPage($limit);
$pager->setQuery(new ProxyQuery($query));
$pager->setPage($page);
$pager->init();
return $pager;
}
public function create(array $defaults = array())
{
$class = $this->getClass();
$page = new $class;
if (isset($defaults['routeName']) && isset($this->pageDefaults[$defaults['routeName']])) {
$defaults = array_merge($this->pageDefaults[$defaults['routeName']], $defaults);
} else {
$defaults = array_merge($this->defaults, $defaults);
}
foreach ($defaults as $key => $value) {
$method ='set'. ucfirst($key);
$page->$method($value);
}
return $page;
}
public function fixUrl(PageInterface $page)
{
if ($page->isInternal()) {
$page->setUrl(null);
return;
}
if (!$page->isHybrid()) {
if ($page->getParent()) {
if (!$page->getSlug()) {
$page->setSlug(Page::slugify($page->getName()));
}
if ($page->getParent()->getUrl() =='/') {
$base ='/';
} elseif (substr($page->getParent()->getUrl(), -1) !='/') {
$base = $page->getParent()->getUrl().'/';
} else {
$base = $page->getParent()->getUrl();
}
$page->setUrl($base.$page->getSlug()) ;
} else {
$page->setSlug(null);
$page->setUrl('/'.$page->getSlug());
}
}
foreach ($page->getChildren() as $child) {
$this->fixUrl($child);
}
}
public function save($page, $andFlush = true)
{
if (!$page->isHybrid()) {
$this->fixUrl($page);
}
parent::save($page, $andFlush);
return $page;
}
public function loadPages(SiteInterface $site)
{
$pages = $this->getEntityManager()
->createQuery(sprintf('SELECT p FROM %s p INDEX BY p.id WHERE p.site = %d ORDER BY p.position ASC', $this->class, $site->getId()))
->execute();
foreach ($pages as $page) {
$parent = $page->getParent();
$page->disableChildrenLazyLoading();
if (!$parent) {
continue;
}
$pages[$parent->getId()]->disableChildrenLazyLoading();
$pages[$parent->getId()]->addChildren($page);
}
return $pages;
}
public function getHybridPages(SiteInterface $site)
{
return $this->getEntityManager()->createQueryBuilder()
->select('p')
->from( $this->class,'p')
->where('p.routeName <> :routeName and p.site = :site')
->setParameters(array('routeName'=> PageInterface::PAGE_ROUTE_CMS_NAME,'site'=> $site->getId()
))
->getQuery()
->execute();
}
}
}
namespace Sonata\PageBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\CoreBundle\Model\PageableManagerInterface;
interface SnapshotManagerInterface extends ManagerInterface, PageableManagerInterface
{
function findEnableSnapshot(array $criteria);
function enableSnapshots(array $snapshots, \DateTime $date = null);
function cleanup(PageInterface $page, $keep);
}
}
namespace Sonata\PageBundle\Entity
{
use Doctrine\Common\Persistence\ManagerRegistry;
use Sonata\CoreBundle\Model\BaseEntityManager;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SnapshotManagerInterface;
use Sonata\PageBundle\Model\SnapshotPageProxy;
use Sonata\DatagridBundle\Pager\Doctrine\Pager;
use Sonata\DatagridBundle\ProxyQuery\Doctrine\ProxyQuery;
class SnapshotManager extends BaseEntityManager implements SnapshotManagerInterface
{
protected $children = array();
protected $templates = array();
public function __construct($class, ManagerRegistry $registry, $templates = array())
{
parent::__construct($class, $registry);
$this->templates = $templates;
}
public function save($snapshot, $andFlush = true)
{
parent::save($snapshot);
return $snapshot;
}
public function enableSnapshots(array $snapshots, \DateTime $date = null)
{
if (count($snapshots) == 0) {
return;
}
$date = $date ?: new \DateTime();
$pageIds = $snapshotIds = array();
foreach ($snapshots as $snapshot) {
$pageIds[] = $snapshot->getPage()->getId();
$snapshotIds[] = $snapshot->getId();
$snapshot->setPublicationDateStart($date);
$snapshot->setPublicationDateEnd(null);
$this->getEntityManager()->persist($snapshot);
}
$this->getEntityManager()->flush();
$sql = sprintf("UPDATE %s SET publication_date_end = '%s' WHERE id NOT IN(%s) AND page_id IN (%s)",
$this->getTableName(),
$date->format('Y-m-d H:i:s'),
implode(',', $snapshotIds),
implode(',', $pageIds)
);
$this->getConnection()->query($sql);
}
public function findEnableSnapshot(array $criteria)
{
$date = new \Datetime;
$parameters = array('publicationDateStart'=> $date,'publicationDateEnd'=> $date,
);
$query = $this->getRepository()
->createQueryBuilder('s')
->andWhere('s.publicationDateStart <= :publicationDateStart AND ( s.publicationDateEnd IS NULL OR s.publicationDateEnd >= :publicationDateEnd )');
if (isset($criteria['site'])) {
$query->andWhere('s.site = :site');
$parameters['site'] = $criteria['site'];
}
if (isset($criteria['pageId'])) {
$query->andWhere('s.page = :page');
$parameters['page'] = $criteria['pageId'];
} elseif (isset($criteria['url'])) {
$query->andWhere('s.url = :url');
$parameters['url'] = $criteria['url'];
} elseif (isset($criteria['routeName'])) {
$query->andWhere('s.routeName = :routeName');
$parameters['routeName'] = $criteria['routeName'];
} elseif (isset($criteria['pageAlias'])) {
$query->andWhere('s.pageAlias = :pageAlias');
$parameters['pageAlias'] = $criteria['pageAlias'];
} elseif (isset($criteria['name'])) {
$query->andWhere('s.name = :name');
$parameters['name'] = $criteria['name'];
} else {
throw new \RuntimeException('please provide a `pageId`, `url`, `routeName` or `name` as criteria key');
}
$query->setMaxResults(1);
$query->setParameters($parameters);
return $query->getQuery()->getOneOrNullResult();
}
public function getPageByName($routeName)
{
$snapshots = $this->getEntityManager()->createQueryBuilder()
->select('s')
->from($this->class,'s')
->where('s.routeName = :routeName')
->setParameters(array('routeName'=> $routeName
))
->getQuery()
->execute();
$snapshot = count($snapshots) > 0 ? $snapshots[0] : false;
if ($snapshot) {
return new SnapshotPageProxy($this, $snapshot);
}
return false;
}
public function setTemplates($templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
public function getTemplate($code)
{
if (!isset($this->templates[$code])) {
throw new \RunTimeException(sprintf('No template references with the code : %s', $code));
}
return $this->templates[$code];
}
public function cleanup(PageInterface $page, $keep)
{
if (!is_numeric($keep)) {
throw new \RuntimeException(sprintf('Please provide an integer value, %s given', gettype($keep)));
}
$tableName = $this->getTableName();
$platform = $this->getConnection()->getDatabasePlatform()->getName();
if ('mysql'=== $platform) {
return $this->getConnection()->exec(sprintf('DELETE FROM %s
                WHERE
                    page_id = %d
                    AND id NOT IN (
                        SELECT id
                        FROM (
                            SELECT id, publication_date_end
                            FROM %s
                            WHERE
                                page_id = %d
                            ORDER BY
                                publication_date_end IS NULL DESC,
                                publication_date_end DESC
                            LIMIT %d
                        ) AS table_alias
                )',
$tableName,
$page->getId(),
$tableName,
$page->getId(),
$keep
));
}
if ('oracle'=== $platform) {
return $this->getConnection()->exec(sprintf('DELETE FROM %s
                WHERE
                    page_id = %d
                    AND id NOT IN (
                        SELECT id
                        FROM (
                            SELECT id, publication_date_end
                            FROM %s
                            WHERE
                                page_id = %d
                                AND rownum <= %d
                            ORDER BY publication_date_end DESC
                        ) AS table_alias
                )',
$tableName,
$page->getId(),
$tableName,
$page->getId(),
$keep
));
}
throw new \RuntimeException(sprintf('The %s database platform has not been tested yet. Please report us if it works and feel free to create a pull request to handle it ;-)', $platform));
}
public function getPager(array $criteria, $page, $limit = 10, array $sort = array())
{
$query = $this->getRepository()
->createQueryBuilder('s')
->select('s');
$parameters = array();
if (isset($criteria['enabled'])) {
$query->andWhere('s.enabled = :enabled');
$parameters['enabled'] = $criteria['enabled'];
}
if (isset($criteria['site'])) {
$query->join('s.site','si');
$query->andWhere('si.id = :siteId');
$parameters['siteId'] = $criteria['site'];
}
if (isset($criteria['page_id'])) {
$query->join('s.page','p');
$query->andWhere('p.id = :pageId');
$parameters['pageId'] = $criteria['page_id'];
}
if (isset($criteria['parent'])) {
$query->join('s.parent','pa');
$query->andWhere('pa.id = :parentId');
$parameters['parentId'] = $criteria['parent'];
}
if (isset($criteria['root'])) {
$isRoot = (bool) $criteria['root'];
if ($isRoot) {
$query->andWhere('s.parent IS NULL');
} else {
$query->andWhere('s.parent IS NOT NULL');
}
}
$query->setParameters($parameters);
$pager = new Pager();
$pager->setMaxPerPage($limit);
$pager->setQuery(new ProxyQuery($query));
$pager->setPage($page);
$pager->init();
return $pager;
}
}
}
namespace Sonata\PageBundle\Model
{
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SnapshotInterface;
interface TransformerInterface
{
public function load(SnapshotInterface $snapshot);
public function create(PageInterface $page);
public function getChildren(PageInterface $page);
public function loadBlock(array $content, PageInterface $page);
}}
namespace Sonata\PageBundle\Entity
{
use Doctrine\ORM\EntityManagerInterface;
use Sonata\BlockBundle\Model\BlockManagerInterface;
use Sonata\PageBundle\Model\PageManagerInterface;
use Sonata\PageBundle\Model\SnapshotManagerInterface;
use Sonata\PageBundle\Model\TransformerInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Model\SnapshotInterface;
use Sonata\PageBundle\Model\SnapshotPageProxy;
use Symfony\Bridge\Doctrine\RegistryInterface;
class Transformer implements TransformerInterface
{
protected $snapshotManager;
protected $pageManager;
protected $blockManager;
protected $children = array();
public function __construct(SnapshotManagerInterface $snapshotManager, PageManagerInterface $pageManager, BlockManagerInterface $blockManager, RegistryInterface $registry)
{
$this->snapshotManager = $snapshotManager;
$this->pageManager = $pageManager;
$this->blockManager = $blockManager;
$this->registry = $registry;
}
public function create(PageInterface $page)
{
$snapshot = $this->snapshotManager->create();
$snapshot->setPage($page);
$snapshot->setUrl($page->getUrl());
$snapshot->setEnabled($page->getEnabled());
$snapshot->setRouteName($page->getRouteName());
$snapshot->setPageAlias($page->getPageAlias());
$snapshot->setType($page->getType());
$snapshot->setName($page->getName());
$snapshot->setPosition($page->getPosition());
$snapshot->setDecorate($page->getDecorate());
if (!$page->getSite()) {
throw new \RuntimeException(sprintf('No site linked to the page.id=%s', $page->getId()));
}
$snapshot->setSite($page->getSite());
if ($page->getParent()) {
$snapshot->setParentId($page->getParent()->getId());
}
if ($page->getTarget()) {
$snapshot->setTargetId($page->getTarget()->getId());
}
$content = array();
$content['id'] = $page->getId();
$content['name'] = $page->getName();
$content['javascript'] = $page->getJavascript();
$content['stylesheet'] = $page->getStylesheet();
$content['raw_headers'] = $page->getRawHeaders();
$content['title'] = $page->getTitle();
$content['meta_description'] = $page->getMetaDescription();
$content['meta_keyword'] = $page->getMetaKeyword();
$content['template_code'] = $page->getTemplateCode();
$content['request_method'] = $page->getRequestMethod();
$content['created_at'] = $page->getCreatedAt()->format('U');
$content['updated_at'] = $page->getUpdatedAt()->format('U');
$content['slug'] = $page->getSlug();
$content['parent_id'] = $page->getParent() ? $page->getParent()->getId() : null;
$content['target_id'] = $page->getTarget() ? $page->getTarget()->getId() : null;
$content['blocks'] = array();
foreach ($page->getBlocks() as $block) {
if ($block->getParent()) { continue;
}
$content['blocks'][] = $this->createBlocks($block);
}
$snapshot->setContent($content);
return $snapshot;
}
public function load(SnapshotInterface $snapshot)
{
$page = $this->pageManager->create();
$page->setRouteName($snapshot->getRouteName());
$page->setPageAlias($snapshot->getPageAlias());
$page->setType($snapshot->getType());
$page->setCustomUrl($snapshot->getUrl());
$page->setUrl($snapshot->getUrl());
$page->setPosition($snapshot->getPosition());
$page->setDecorate($snapshot->getDecorate());
$page->setSite($snapshot->getSite());
$page->setEnabled($snapshot->getEnabled());
$content = $this->fixPageContent($snapshot->getContent());
$page->setId($content['id']);
$page->setJavascript($content['javascript']);
$page->setStylesheet($content['stylesheet']);
$page->setRawHeaders($content['raw_headers']);
$page->setTitle($content['title']);
$page->setMetaDescription($content['meta_description']);
$page->setMetaKeyword($content['meta_keyword']);
$page->setName($content['name']);
$page->setSlug($content['slug']);
$page->setTemplateCode($content['template_code']);
$page->setRequestMethod($content['request_method']);
$createdAt = new \DateTime;
$createdAt->setTimestamp($content['created_at']);
$page->setCreatedAt($createdAt);
$updatedAt = new \DateTime;
$updatedAt->setTimestamp($content['updated_at']);
$page->setUpdatedAt($updatedAt);
return $page;
}
protected function fixPageContent(array $content)
{
if (!array_key_exists('title', $content)) {
$content['title'] = null;
}
return $content;
}
protected function fixBlockContent(array $content)
{
if (!array_key_exists('name', $content)) {
$content['name'] = null;
}
return $content;
}
public function loadBlock(array $content, PageInterface $page)
{
$block = $this->blockManager->create();
$content = $this->fixBlockContent($content);
$block->setPage($page);
$block->setId($content['id']);
$block->setName($content['name']);
$block->setEnabled($content['enabled']);
$block->setPosition($content['position']);
$block->setSettings($content['settings']);
$block->setType($content['type']);
$createdAt = new \DateTime;
$createdAt->setTimestamp($content['created_at']);
$block->setCreatedAt($createdAt);
$updatedAt = new \DateTime;
$updatedAt->setTimestamp($content['updated_at']);
$block->setUpdatedAt($updatedAt);
foreach ($content['blocks'] as $child) {
$block->addChildren($this->loadBlock($child, $page));
}
return $block;
}
protected function createBlocks(BlockInterface $block)
{
$content = array();
$content['id'] = $block->getId();
$content['name'] = $block->getName();
$content['enabled'] = $block->getEnabled();
$content['position'] = $block->getPosition();
$content['settings'] = $block->getSettings();
$content['type'] = $block->getType();
$content['created_at'] = $block->getCreatedAt()->format('U');
$content['updated_at'] = $block->getUpdatedAt()->format('U');
$content['blocks'] = array();
foreach ($block->getChildren() as $child) {
$content['blocks'][] = $this->createBlocks($child);
}
return $content;
}
public function getChildren(PageInterface $parent)
{
if (!isset($this->children[$parent->getId()])) {
$date = new \Datetime;
$parameters = array('publicationDateStart'=> $date,'publicationDateEnd'=> $date,'parentId'=> $parent->getId(),
);
$manager = $this->registry->getManagerForClass($this->snapshotManager->getClass());
if (!$manager instanceof EntityManagerInterface) {
throw new \RuntimeException("Invalid entity manager type");
}
$snapshots = $manager->createQueryBuilder()
->select('s')
->from($this->snapshotManager->getClass(),'s')
->where('s.parentId = :parentId and s.enabled = 1')
->andWhere('s.publicationDateStart <= :publicationDateStart AND ( s.publicationDateEnd IS NULL OR s.publicationDateEnd >= :publicationDateEnd )')
->orderBy('s.position')
->setParameters($parameters)
->getQuery()
->execute();
$pages = array();
foreach ($snapshots as $snapshot) {
$page = new SnapshotPageProxy($this->snapshotManager, $this, $snapshot);
$pages[$page->getId()] = $page;
}
$this->children[$parent->getId()] = new \Doctrine\Common\Collections\ArrayCollection($pages);
}
return $this->children[$parent->getId()];
}
}}
namespace Sonata\PageBundle\Generator
{
class Mustache
{
public static function replace($string, array $parameters)
{
$replacer = function ($match) use ($parameters) {
return isset($parameters[$match[1]]) ? $parameters[$match[1]] : $match[0];
};
return preg_replace_callback('/{{\s*(.+?)\s*}}/', $replacer, $string);
}
}
}
namespace Sonata\PageBundle\Listener
{
use Sonata\PageBundle\CmsManager\CmsManagerSelectorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\PageBundle\Site\SiteSelectorInterface;
use Sonata\PageBundle\Exception\InternalErrorException;
use Sonata\PageBundle\Page\PageServiceManagerInterface;
use Sonata\PageBundle\CmsManager\DecoratorStrategyInterface;
use Symfony\Component\Templating\EngineInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
class ExceptionListener
{
protected $siteSelector;
protected $cmsManagerSelector;
protected $debug;
protected $templating;
protected $pageServiceManager;
protected $decoratorStrategy;
protected $httpErrorCodes;
protected $logger;
protected $status;
public function __construct(SiteSelectorInterface $siteSelector,
CmsManagerSelectorInterface $cmsManagerSelector,
$debug,
EngineInterface $templating,
PageServiceManagerInterface $pageServiceManager,
DecoratorStrategyInterface $decoratorStrategy,
array $httpErrorCodes,
LoggerInterface $logger = null)
{
$this->siteSelector = $siteSelector;
$this->cmsManagerSelector = $cmsManagerSelector;
$this->debug = $debug;
$this->templating = $templating;
$this->pageServiceManager = $pageServiceManager;
$this->decoratorStrategy = $decoratorStrategy;
$this->httpErrorCodes = $httpErrorCodes;
$this->logger = $logger;
}
public function getHttpErrorCodes()
{
return $this->httpErrorCodes;
}
public function hasErrorCode($statusCode)
{
return array_key_exists($statusCode, $this->httpErrorCodes);
}
public function getErrorCodePage($statusCode)
{
if (!$this->hasErrorCode($statusCode)) {
throw new InternalErrorException(sprintf('There is not page configured to handle the status code %d', $statusCode));
}
$cms = $this->cmsManagerSelector->retrieve();
$site = $this->siteSelector->retrieve();
if (!$site) {
throw new \RuntimeException('No site available');
}
return $cms->getPageByRouteName($site, $this->httpErrorCodes[$statusCode]);
}
public function onKernelException(GetResponseForExceptionEvent $event)
{
if ($event->getException() instanceof NotFoundHttpException && $this->cmsManagerSelector->isEditor()) {
$pathInfo = $event->getRequest()->getPathInfo();
$creatable = !$event->getRequest()->get('_route') && $this->decoratorStrategy->isRouteUriDecorable($pathInfo);
if ($creatable) {
$response = new Response($this->templating->render('SonataPageBundle:Page:create.html.twig', array('pathInfo'=> $pathInfo,'site'=> $this->siteSelector->retrieve(),'creatable'=> $creatable
)), 404);
$event->setResponse($response);
$event->stopPropagation();
return;
}
}
if ($event->getException() instanceof InternalErrorException) {
$this->handleInternalError($event);
} else {
$this->handleNativeError($event);
}
}
private function handleInternalError(GetResponseForExceptionEvent $event)
{
$content = $this->templating->render('SonataPageBundle::internal_error.html.twig', array('exception'=> $event->getException()
));
$event->setResponse(new Response($content, 500));
}
private function handleNativeError(GetResponseForExceptionEvent $event)
{
if (true === $this->debug) {
return;
}
if (true === $this->status) {
return;
}
$this->status = true;
$exception = $event->getException();
$statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;
$cmsManager = $this->cmsManagerSelector->retrieve();
if ($event->getRequest()->get('_route') && !$this->decoratorStrategy->isRouteNameDecorable($event->getRequest()->get('_route'))) {
return;
}
if (!$this->decoratorStrategy->isRouteUriDecorable($event->getRequest()->getPathInfo())) {
return;
}
if (!$this->hasErrorCode($statusCode)) {
return;
}
$message = sprintf('%s: %s (uncaught exception) at %s line %s', get_class($exception), $exception->getMessage(), $exception->getFile(), $exception->getLine());
$this->logException($exception, $exception, $message);
try {
$page = $this->getErrorCodePage($statusCode);
$cmsManager->setCurrentPage($page);
if ($page->getSite()->getLocale() !== $event->getRequest()->getLocale()) {
$event->getRequest()->setLocale($page->getSite()->getLocale());
}
$response = $this->pageServiceManager->execute($page, $event->getRequest(), array(), new Response('', $statusCode));
} catch (\Exception $e) {
$this->logException($exception, $e);
$event->setException($e);
$this->handleInternalError($event);
return;
}
$event->setResponse($response);
}
private function logException(\Exception $originalException, \Exception $generatedException, $message = null)
{
if (!$message) {
$message = sprintf('Exception thrown when handling an exception (%s: %s)', get_class($generatedException), $generatedException->getMessage());
}
if (null !== $this->logger) {
if (!$originalException instanceof HttpExceptionInterface || $originalException->getStatusCode() >= 500) {
$this->logger->crit($message, array('exception'=> $originalException ));
} else {
$this->logger->err($message, array('exception'=> $originalException ));
}
} else {
error_log($message);
}
}
}
}
namespace Sonata\PageBundle\Listener
{
use Sonata\PageBundle\CmsManager\CmsManagerSelectorInterface;
use Sonata\PageBundle\Site\SiteSelectorInterface;
use Sonata\PageBundle\Exception\InternalErrorException;
use Sonata\PageBundle\Exception\PageNotFoundException;
use Sonata\PageBundle\CmsManager\DecoratorStrategyInterface;
use Sonata\PageBundle\Model\PageInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Request;
class RequestListener
{
protected $cmsSelector;
protected $siteSelector;
protected $decoratorStrategy;
public function __construct(CmsManagerSelectorInterface $cmsSelector, SiteSelectorInterface $siteSelector, DecoratorStrategyInterface $decoratorStrategy)
{
$this->cmsSelector = $cmsSelector;
$this->siteSelector = $siteSelector;
$this->decoratorStrategy = $decoratorStrategy;
}
public function onCoreRequest(GetResponseEvent $event)
{
$request = $event->getRequest();
$cms = $this->cmsSelector->retrieve();
if (!$cms) {
throw new InternalErrorException('No CMS Manager available');
}
if ($request->get('_route') == PageInterface::PAGE_ROUTE_CMS_NAME) {
return;
}
if (!$this->decoratorStrategy->isRequestDecorable($request)) {
return;
}
$site = $this->siteSelector->retrieve();
if (!$site) {
throw new InternalErrorException('No site available for the current request with uri '.htmlspecialchars($request->getUri(), ENT_QUOTES));
}
if ($site->getLocale() && $site->getLocale() != $request->get('_locale')) {
throw new PageNotFoundException(sprintf('Invalid locale - site.locale=%s - request._locale=%s', $site->getLocale(), $request->get('_locale')));
}
try {
$page = $cms->getPageByRouteName($site, $request->get('_route'));
if (!$page->getEnabled() && !$this->cmsSelector->isEditor()) {
throw new PageNotFoundException(sprintf('The page is not enabled : id=%s', $page->getId()));
}
$cms->setCurrentPage($page);
} catch (PageNotFoundException $e) {
return;
}
}
}
}
namespace Sonata\PageBundle\Listener
{
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Sonata\PageBundle\Page\PageServiceManagerInterface;
use Sonata\PageBundle\CmsManager\CmsManagerSelectorInterface;
use Sonata\PageBundle\Exception\InternalErrorException;
use Sonata\PageBundle\CmsManager\DecoratorStrategyInterface;
class ResponseListener
{
protected $cmsSelector;
protected $pageServiceManager;
protected $decoratorStrategy;
protected $templating;
public function __construct(CmsManagerSelectorInterface $cmsSelector,
PageServiceManagerInterface $pageServiceManager,
DecoratorStrategyInterface $decoratorStrategy,
EngineInterface $templating)
{
$this->cmsSelector = $cmsSelector;
$this->pageServiceManager = $pageServiceManager;
$this->decoratorStrategy = $decoratorStrategy;
$this->templating = $templating;
}
public function onCoreResponse(FilterResponseEvent $event)
{
$cms = $this->cmsSelector->retrieve();
$response = $event->getResponse();
$request = $event->getRequest();
if ($this->cmsSelector->isEditor()) {
$response->setPrivate();
if (!$request->cookies->has('sonata_page_is_editor')) {
$response->headers->setCookie(new Cookie('sonata_page_is_editor', 1));
}
}
$page = $cms->getCurrentPage();
if ($page && $response->isRedirection() && $this->cmsSelector->isEditor() && !$request->get('_sonata_page_skip')) {
$response = new Response($this->templating->render('SonataPageBundle:Page:redirect.html.twig', array('response'=> $response,'page'=> $page,
)));
$response->setPrivate();
$event->setResponse($response);
return;
}
if (!$this->decoratorStrategy->isDecorable($event->getRequest(), $event->getRequestType(), $response)) {
return;
}
if (!$this->cmsSelector->isEditor() && $request->cookies->has('sonata_page_is_editor')) {
$response->headers->clearCookie('sonata_page_is_editor');
}
if (!$page) {
throw new InternalErrorException('No page instance available for the url, run the sonata:page:update-core-routes and sonata:page:create-snapshots commands');
}
if (!$page->isHybrid() || !$page->getDecorate()) {
return;
}
$parameters = array('content'=> $response->getContent()
);
$response = $this->pageServiceManager->execute($page, $request, $parameters, $response);
if (!$this->cmsSelector->isEditor() && $page->isCms()) {
$response->setTtl($page->getTtl());
}
$event->setResponse($response);
}
}
}
namespace Sonata\PageBundle\Model
{
class SnapshotChildrenCollection implements \Countable, \IteratorAggregate, \ArrayAccess
{
protected $transformer;
protected $page;
protected $collection;
public function __construct(TransformerInterface $transformer, PageInterface $page)
{
$this->transformer = $transformer;
$this->page = $page;
}
private function load()
{
if ($this->collection == null) {
$this->collection = $this->transformer->getChildren($this->page);
}
}
public function offsetUnset($offset)
{
$this->load();
return $this->collection->offsetUnset($offset);
}
public function offsetSet($offset, $value)
{
$this->load();
return $this->collection->offsetSet($offset, $value);
}
public function offsetGet($offset)
{
$this->load();
return $this->collection->offsetGet($offset);
}
public function offsetExists($offset)
{
$this->load();
return $this->collection->offsetExists($offset);
}
public function getIterator()
{
$this->load();
return $this->collection->getIterator();
}
public function count()
{
$this->load();
return $this->collection->count();
}
}
}
namespace Sonata\PageBundle\Model
{
use Sonata\PageBundle\Model\PageBlockInterface;
use Serializable;
class SnapshotPageProxy implements PageInterface, Serializable
{
private $manager;
private $snapshot;
private $page;
private $target;
private $parents;
public function __construct(SnapshotManagerInterface $manager, TransformerInterface $transformer, SnapshotInterface $snapshot)
{
$this->manager = $manager;
$this->snapshot = $snapshot;
$this->transformer = $transformer;
}
public function getPage()
{
$this->load();
return $this->page;
}
private function load()
{
if (!$this->page && $this->transformer) {
$this->page = $this->transformer->load($this->snapshot);
}
}
public function __call($method, $arguments)
{
return call_user_func_array(array($this->getPage(), $method), $arguments);
}
public function addChildren(PageInterface $children)
{
$this->getPage()->addChildren($children);
}
public function setHeaders(array $headers = array())
{
$this->getPage()->setHeaders($headers);
}
public function addHeader($name, $value)
{
$this->getPage()->addHeader($name, $value);
}
public function getHeaders()
{
return $this->getPage()->getHeaders();
}
public function getChildren()
{
if (!$this->getPage()->getChildren()->count()) {
$this->getPage()->setChildren(new SnapshotChildrenCollection($this->transformer, $this->getPage()));
}
return $this->getPage()->getChildren();
}
public function addBlocks(PageBlockInterface $block)
{
$this->getPage()->addBlocks($block);
}
public function getBlocks()
{
if (!count($this->getPage()->getBlocks())) {
$content = $this->snapshot->getContent();
foreach ($content['blocks'] as $block) {
$b = $this->transformer->loadBlock($block, $this);
$this->addBlocks($b);
$b->setPage($this);
}
}
return $this->getPage()->getBlocks();
}
public function setTarget(PageInterface $target = null)
{
$this->target = $target;
}
public function getTarget()
{
if ($this->target === null) {
$content = $this->snapshot->getContent();
if (isset($content['target_id'])) {
$target = $this->manager->findEnableSnapshot(array('pageId'=> $content['target_id']
));
if ($target) {
$this->setTarget(new SnapshotPageProxy($this->manager, $this->transformer, $target));
} else {
$this->target = false;
}
}
}
return $this->target ?: null;
}
public function getParent($level = -1)
{
$parents = $this->getParents();
if ($level < 0) {
$level = count($parents) + $level;
}
return isset($parents[$level]) ? $parents[$level] : null;
}
public function setParents(array $parents)
{
$this->parents = $parents;
}
public function getParents()
{
if (!$this->parents) {
$parents = array();
$snapshot = $this->snapshot;
while ($snapshot) {
$content = $snapshot->getContent();
if (!$content['parent_id']) {
break;
}
$snapshot = $this->manager->findEnableSnapshot(array('pageId'=> $content['parent_id']
));
if (!$snapshot) {
break;
}
$parents[] = new SnapshotPageProxy($this->manager, $this->transformer, $snapshot);
}
$this->setParents(array_reverse($parents));
}
return $this->parents;
}
public function setParent(PageInterface $parent = null)
{
$this->getPage()->setParent($parent);
}
public function setTemplateCode($templateCode)
{
$this->getPage()->setTemplateCode($templateCode);
}
public function getTemplateCode()
{
return $this->getPage()->getTemplateCode();
}
public function setDecorate($decorate)
{
$this->getPage()->setDecorate($decorate);
}
public function getDecorate()
{
return $this->getPage()->getDecorate();
}
public function isHybrid()
{
return $this->getPage()->isHybrid();
}
public function setPosition($position)
{
$this->getPage()->setPosition($position);
}
public function getPosition()
{
return $this->getPage()->getPosition();
}
public function setRequestMethod($method)
{
$this->getPage()->setRequestMethod($method);
}
public function getRequestMethod()
{
return $this->getPage()->getRequestMethod();
}
public function getId()
{
return $this->getPage()->getId();
}
public function setId($id)
{
$this->getPage()->setId($id);
}
public function getRouteName()
{
return $this->getPage()->getRouteName();
}
public function setRouteName($routeName)
{
$this->getPage()->setRouteName($routeName);
}
public function setEnabled($enabled)
{
$this->getPage()->setEnabled($enabled);
}
public function getEnabled()
{
return $this->getPage()->getEnabled();
}
public function setName($name)
{
$this->getPage()->setName($name);
}
public function getName()
{
return $this->getPage()->getName();
}
public function setSlug($slug)
{
$this->getPage()->setSlug($slug);
}
public function getSlug()
{
return $this->getPage()->getSlug();
}
public function setUrl($url)
{
$this->getPage()->setUrl($url);
}
public function getUrl()
{
return $this->getPage()->getUrl();
}
public function setCustomUrl($customUrl)
{
$this->getPage()->setCustomUrl($customUrl);
}
public function getCustomUrl()
{
return $this->getPage()->getCustomUrl();
}
public function setMetaKeyword($metaKeyword)
{
$this->getPage()->setMetaKeyword($metaKeyword);
}
public function getMetaKeyword()
{
return $this->getPage()->getMetaKeyword();
}
public function setMetaDescription($metaDescription)
{
$this->getPage()->setMetaDescription($metaDescription);
}
public function getMetaDescription()
{
return $this->getPage()->getMetaDescription();
}
public function setJavascript($javascript)
{
$this->getPage()->setJavascript($javascript);
}
public function getJavascript()
{
return $this->getPage()->getJavascript();
}
public function setStylesheet($stylesheet)
{
$this->getPage()->setStylesheet($stylesheet);
}
public function getStylesheet()
{
return $this->getPage()->getStylesheet();
}
public function getPageAlias()
{
return $this->getPage()->getPageAlias();
}
public function setPageAlias($pageAlias)
{
return $this->getPage()->setPageAlias($pageAlias);
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->getPage()->setCreatedAt($createdAt);
}
public function getCreatedAt()
{
return $this->getPage()->getCreatedAt();
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->getPage()->setUpdatedAt($updatedAt);
}
public function getUpdatedAt()
{
return $this->getPage()->getUpdatedAt();
}
public function isDynamic()
{
return $this->getPage()->isDynamic();
}
public function isCms()
{
return $this->getPage()->isCms();
}
public function isInternal()
{
return $this->getPage()->isInternal();
}
public function hasRequestMethod($method)
{
return $this->getPage()->hasRequestMethod($method);
}
public function setSite(SiteInterface $site)
{
$this->getPage()->setSite($site);
}
public function getSite()
{
return $this->getPage()->getSite();
}
public function setRawHeaders($headers)
{
$this->getPage()->setRawHeaders($headers);
}
public function getEdited()
{
return $this->getPage()->getEdited();
}
public function setEdited($edited)
{
$this->getPage()->setEdited($edited);
}
public function isError()
{
return $this->getPage()->isError();
}
public function getTitle()
{
return $this->getPage()->getTitle();
}
public function setTitle($title)
{
$this->getPage()->setTitle($title);
}
public function setType($type)
{
$this->getPage()->setType($type);
}
public function getType()
{
return $this->getPage()->getType();
}
public function __toString()
{
return $this->getPage()->__toString();
}
public function serialize()
{
if ($this->manager) {
return serialize(array('pageId'=> $this->getPage()->getId(),'snapshotId'=> $this->snapshot->getId(),
));
}
return serialize(array());
}
public function unserialize($serialized)
{
}
}
}
namespace Sonata\PageBundle\Model
{
class Template
{
protected $path;
protected $name;
protected $containers;
const TYPE_STATIC = 1;
const TYPE_DYNAMIC = 2;
public function __construct($name, $path, array $containers = array())
{
$this->name = $name;
$this->path = $path;
$this->containers = $containers;
foreach ($this->containers as &$container) {
$container = $this->normalize($container);
}
}
public function getContainers()
{
return $this->containers;
}
public function addContainer($code, $meta)
{
$this->containers[$code] = $this->normalize($meta);
}
protected function normalize(array $meta)
{
return array('name'=> isset($meta['name']) ? $meta['name'] :'n/a','type'=> isset($meta['type']) ? $meta['type'] : self::TYPE_STATIC,'blocks'=> isset($meta['blocks']) ? $meta['blocks'] : array(),'placement'=> isset($meta['placement']) ? $meta['placement'] : array(),'shared'=> isset($meta['shared']) ? $meta['shared'] : false,
);
}
public function getName()
{
return $this->name;
}
public function getPath()
{
return $this->path;
}
}
}
namespace Sonata\PageBundle\Page
{
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Page\Service\PageServiceInterface;
interface PageServiceManagerInterface
{
public function add($type, PageServiceInterface $service);
public function get($type);
public function getAll();
public function setDefault(PageServiceInterface $service);
public function execute(PageInterface $page, Request $request, array $parameters = array(), Response $response = null);
}
}
namespace Sonata\PageBundle\Page
{
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Page\Service\PageServiceInterface;
use Sonata\PageBundle\Page\PageServiceManagerInterface;
class PageServiceManager implements PageServiceManagerInterface
{
protected $services = array();
protected $default;
protected $router;
public function __construct(RouterInterface $router)
{
$this->router = $router;
}
public function add($type, PageServiceInterface $service)
{
$this->services[$type] = $service;
}
public function get($type)
{
if ($type instanceof PageInterface) {
$type = $type->getType();
}
if (!isset($this->services[$type])) {
if (!$this->default) {
throw new \RuntimeException(sprintf('unable to find a default service for type "%s"', $type));
}
return $this->default;
}
return $this->services[$type];
}
public function getAll()
{
return $this->services;
}
public function setDefault(PageServiceInterface $service)
{
$this->default = $service;
}
public function execute(PageInterface $page, Request $request, array $parameters = array(), Response $response = null)
{
$service = $this->get($page);
$response = $response ?: $this->createResponse($page);
if ($response->isRedirection()) {
return $response;
}
$parameters['page'] = $page;
$parameters['site'] = $page->getSite();
$response = $service->execute($page, $request, $parameters, $response);
return $response;
}
protected function createResponse(PageInterface $page)
{
if ($page->getTarget()) {
$page->addHeader('Location', $this->router->generate($page->getTarget()));
$response = new Response('', 302, $page->getHeaders() ?: array());
} else {
$response = new Response('', 200, $page->getHeaders() ?: array());
}
return $response;
}
}
}
namespace Sonata\PageBundle\Page\Service
{
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sonata\PageBundle\Model\PageInterface;
interface PageServiceInterface
{
public function getName();
public function execute(PageInterface $page, Request $request, array $parameters = array(), Response $response = null);
}
}
namespace Sonata\PageBundle\Page\Service
{
abstract class BasePageService implements PageServiceInterface
{
protected $name;
public function __construct($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
}
}
namespace Sonata\PageBundle\Page\Service
{
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sonata\SeoBundle\Seo\SeoPageInterface;
use Sonata\PageBundle\Page\Service\BasePageService;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\Page\TemplateManagerInterface;
class DefaultPageService extends BasePageService
{
protected $templateManager;
protected $seoPage;
public function __construct($name, TemplateManagerInterface $templateManager, SeoPageInterface $seoPage = null)
{
$this->name = $name;
$this->templateManager = $templateManager;
$this->seoPage = $seoPage;
}
public function execute(PageInterface $page, Request $request, array $parameters = array(), Response $response = null)
{
$this->updateSeoPage($page);
$response = $this->templateManager->renderResponse($page->getTemplateCode(), $parameters, $response);
return $response;
}
protected function updateSeoPage(PageInterface $page)
{
if (!$this->seoPage) {
return;
}
if ($page->getTitle()) {
$this->seoPage->setTitle($page->getTitle() ?: $page->getName());
}
if ($page->getMetaDescription()) {
$this->seoPage->addMeta('name','description', $page->getMetaDescription());
}
if ($page->getMetaKeyword()) {
$this->seoPage->addMeta('name','keywords', $page->getMetaKeyword());
}
$this->seoPage->addMeta('property','og:type','article');
$this->seoPage->addHtmlAttributes('prefix','og: http://ogp.me/ns#');
}
}
}
namespace Sonata\PageBundle\Page
{
use Symfony\Component\HttpFoundation\Response;
use Sonata\PageBundle\Model\Template;
interface TemplateManagerInterface
{
public function renderResponse($code, array $parameters = array(), Response $response = null);
public function add($code, Template $template);
public function get($code);
public function setDefaultTemplateCode($code);
public function getDefaultTemplateCode();
public function setAll($templates);
public function getAll();
}
}
namespace Sonata\PageBundle\Page
{
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\StreamingEngineInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Sonata\PageBundle\Model\Template;
class TemplateManager implements TemplateManagerInterface
{
protected $engine;
protected $defaultParameters;
protected $templates;
protected $defaultTemplateCode ='default';
protected $defaultTemplatePath ='SonataPageBundle::layout.html.twig';
public function __construct(EngineInterface $engine, array $defaultParameters = array())
{
$this->engine = $engine;
$this->defaultParameters = $defaultParameters;
}
public function add($code, Template $template)
{
$this->templates[$code] = $template;
}
public function get($code)
{
if (!isset($this->templates[$code])) {
return null;
}
return $this->templates[$code];
}
public function setDefaultTemplateCode($code)
{
$this->defaultTemplateCode = $code;
}
public function getDefaultTemplateCode()
{
return $this->defaultTemplateCode;
}
public function setAll($templates)
{
$this->templates = $templates;
}
public function getAll()
{
return $this->templates;
}
public function renderResponse($code, array $parameters = array(), Response $response = null)
{
return $this->engine->renderResponse(
$this->getTemplatePath($code),
array_merge($this->defaultParameters, $parameters),
$response
);
}
protected function getTemplatePath($code)
{
$code = $code ?: $this->getDefaultTemplateCode();
$template = $this->get($code);
return $template ? $template->getPath() : $this->defaultTemplatePath;
}
}
}
namespace Sonata\PageBundle\Request
{
interface SiteRequestInterface
{
public function setPathInfo($pathInfo);
public function setBaseUrl($baseUrl);
}
}
namespace Sonata\PageBundle\Request
{
use Symfony\Component\HttpFoundation\Request as BaseRequest;
class SiteRequest extends BaseRequest implements SiteRequestInterface
{
public function setPathInfo($pathInfo)
{
$this->pathInfo = $pathInfo;
}
public function setBaseUrl($baseUrl)
{
$this->baseUrl = $baseUrl;
}
}
}
namespace Sonata\PageBundle\Site
{
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
class HostSiteSelector extends BaseSiteSelector
{
public function handleKernelRequest(GetResponseEvent $event)
{
foreach ($this->getSites($event->getRequest()) as $site) {
if (!$site->isEnabled()) {
continue;
}
$this->site = $site;
if (!$this->site->isLocalhost()) {
break;
}
}
if ($this->site && $this->site->getLocale()) {
$event->getRequest()->attributes->set('_locale', $this->site->getLocale());
}
}
}
}
namespace Sonata\PageBundle\Twig\Extension
{
use Sonata\PageBundle\Cache\HttpCacheHandlerInterface;
use Sonata\PageBundle\Model\PageBlockInterface;
use Sonata\PageBundle\Model\PageInterface;
use Sonata\PageBundle\CmsManager\CmsManagerSelectorInterface;
use Sonata\PageBundle\Site\SiteSelectorInterface;
use Sonata\PageBundle\Exception\PageNotFoundException;
use Sonata\PageBundle\Model\SnapshotPageProxy;
use Symfony\Bridge\Twig\Extension\HttpKernelExtension;
use Symfony\Component\Routing\RouterInterface;
use Sonata\BlockBundle\Templating\Helper\BlockHelper;
class PageExtension extends \Twig_Extension
{
private $cmsManagerSelector;
private $siteSelector;
private $resources;
private $environment;
private $router;
private $blockHelper;
private $httpKernelExtension;
public function __construct(CmsManagerSelectorInterface $cmsManagerSelector, SiteSelectorInterface $siteSelector, RouterInterface $router, BlockHelper $blockHelper, HttpKernelExtension $httpKernelExtension)
{
$this->cmsManagerSelector = $cmsManagerSelector;
$this->siteSelector = $siteSelector;
$this->router = $router;
$this->blockHelper = $blockHelper;
$this->httpKernelExtension = $httpKernelExtension;
}
public function getFunctions()
{
return array('sonata_page_ajax_url'=> new \Twig_Function_Method($this,'ajaxUrl'),'sonata_page_url'=> new \Twig_Function_Method($this,'url'),'sonata_page_breadcrumb'=> new \Twig_Function_Method($this,'breadcrumb', array('is_safe'=> array('html'))),'sonata_page_render_container'=> new \Twig_Function_Method($this,'renderContainer', array('is_safe'=> array('html'))),'sonata_page_render_block'=> new \Twig_Function_Method($this,'renderBlock', array('is_safe'=> array('html'))),
new \Twig_SimpleFunction('controller', array($this,'controller'))
);
}
public function initRuntime(\Twig_Environment $environment)
{
$this->environment = $environment;
}
public function getName()
{
return'sonata_page';
}
public function breadcrumb(PageInterface $page = null, array $options = array())
{
if (!$page) {
$page = $this->cmsManagerSelector->retrieve()->getCurrentPage();
}
$options = array_merge(array('separator'=>'','current_class'=>'','last_separator'=>'','force_view_home_page'=> true,'container_attr'=> array('class'=>'sonata-page-breadcrumbs'),'elements_attr'=> array(),'template'=>'SonataPageBundle:Page:breadcrumb.html.twig',
), $options);
$breadcrumbs = array();
if ($page) {
$breadcrumbs = $page->getParents();
if ($options['force_view_home_page'] && (!isset($breadcrumbs[0]) || $breadcrumbs[0]->getRouteName() !='homepage')) {
try {
$homePage = $this->cmsManagerSelector->retrieve()->getPageByRouteName($this->siteSelector->retrieve(),'homepage');
} catch (PageNotFoundException $e) {
$homePage = false;
}
if ($homePage) {
array_unshift($breadcrumbs, $homePage);
}
}
}
return $this->render($options['template'], array('page'=> $page,'breadcrumbs'=> $breadcrumbs,'options'=> $options
));
}
public function ajaxUrl(PageBlockInterface $block, $parameters = array(), $absolute = false)
{
$parameters['blockId'] = $block->getId();
if ($block->getPage() instanceof PageInterface) {
$parameters['pageId'] = $block->getPage()->getId();
}
return $this->router->generate('sonata_page_ajax_block', $parameters, $absolute);
}
private function render($template, array $parameters = array())
{
if (!isset($this->resources[$template])) {
$this->resources[$template] = $this->environment->loadTemplate($template);
}
return $this->resources[$template]->render($parameters);
}
public function renderContainer($name, $page = null, array $options = array())
{
$cms = $this->cmsManagerSelector->retrieve();
$site = $this->siteSelector->retrieve();
$targetPage = false;
try {
if ($page === null) {
$targetPage = $cms->getCurrentPage();
} else if (!$page instanceof PageInterface && is_string($page)) {
$targetPage = $cms->getInternalRoute($site, $page);
} else if ($page instanceof PageInterface) {
$targetPage = $page;
}
} catch (PageNotFoundException $e) {
$targetPage = false;
}
if (!$targetPage) {
return"";
}
$container = $cms->findContainer($name, $targetPage);
if (!$container) {
return"";
}
return $this->renderBlock($container, $options);
}
public function renderBlock(PageBlockInterface $block, array $options = array())
{
if ($block->getEnabled() === false && !$this->cmsManagerSelector->isEditor()) {
return'';
}
$pageCacheKeys = array('manager'=> $block->getPage() instanceof SnapshotPageProxy ?'snapshot':'page','page_id'=> $block->getPage()->getId(),
);
$options = array_merge(array('use_cache'=> isset($options['use_cache']) ? $options['use_cache'] : true,'extra_cache_keys'=> array()
), $pageCacheKeys, $options);
$options['extra_cache_keys'] = array_merge($options['extra_cache_keys'], $pageCacheKeys);
return $this->blockHelper->render($block, $options);
}
public function controller($controller, $attributes = array(), $query = array())
{
$globals = $this->environment->getGlobals();
if (!isset($attributes['pathInfo'])) {
$sitePath = $this->siteSelector->retrieve()->getRelativePath();
$currentPathInfo = $globals['app']->getRequest()->getPathInfo();
$attributes['pathInfo'] = $sitePath . $currentPathInfo;
}
return $this->httpKernelExtension->controller($controller, $attributes, $query);
}
}
}
namespace Sonata\PageBundle\Twig
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class GlobalVariables
{
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function getSiteAvailables()
{
return $this->container->get('sonata.page.manager.site')->findBy(array('enabled'=> true
));
}
public function getCmsManager()
{
return $this->container->get('sonata.page.cms_manager_selector')->retrieve();
}
public function getCurrentSite()
{
return $this->container->get('sonata.page.site.selector')->retrieve();
}
public function isEditor()
{
return $this->container->get('sonata.page.cms_manager_selector')->isEditor();
}
public function getDefaultTemplate()
{
$templateManager = $this->container->get('sonata.page.template_manager');
return $templateManager->get($templateManager->getDefaultTemplateCode())->getPath();
}
public function getAssets()
{
return $this->container->getParameter('sonata.page.assets');
}
public function isInlineEditionOn()
{
return $this->container->getParameter('sonata.page.is_inline_edition_on');
}
}
}
namespace Sonata\MediaBundle\CDN
{
interface CDNInterface
{
const STATUS_OK = 1;
const STATUS_TO_SEND = 2;
const STATUS_TO_FLUSH = 3;
const STATUS_ERROR = 4;
const STATUS_WAITING = 5;
public function getPath($relativePath, $isFlushable);
public function flush($string);
public function flushByString($string);
public function flushPaths(array $paths);
}
}
namespace Sonata\MediaBundle\CDN
{
class Fallback implements CDNInterface
{
protected $cdn;
protected $fallback;
public function __construct(CDNInterface $cdn, CDNInterface $fallback)
{
$this->cdn = $cdn;
$this->fallback = $fallback;
}
public function getPath($relativePath, $isFlushable)
{
if ($isFlushable) {
return $this->fallback->getPath($relativePath, $isFlushable);
}
return $this->cdn->getPath($relativePath, $isFlushable);
}
public function flushByString($string)
{
$this->cdn->flushByString($string);
}
public function flush($string)
{
$this->cdn->flush($string);
}
public function flushPaths(array $paths)
{
$this->cdn->flushPaths($paths);
}
}
}
namespace Sonata\MediaBundle\CDN
{
class PantherPortal implements CDNInterface
{
protected $path;
protected $username;
protected $password;
protected $siteId;
protected $client;
protected $wsdl;
public function __construct($path, $username, $password, $siteId, $wsdl ="https://pantherportal.cdnetworks.com/wsdl/flush.wsdl")
{
$this->path = $path;
$this->username = $username;
$this->password = $password;
$this->siteId = $siteId;
$this->wsdl = $wsdl;
}
public function getPath($relativePath, $isFlushable)
{
return sprintf('%s/%s', $this->path, $relativePath);
}
public function flushByString($string)
{
$this->flushPaths(array($string));
}
public function flush($string)
{
$this->flushPaths(array($string));
}
public function flushPaths(array $paths)
{
$result = $this->getClient()->flush($this->username, $this->password,"paths", $this->siteId, implode("\n", $paths), true, false);
if ($result !="Flush successfully submitted.") {
throw new \RuntimeException('Unable to flush : '. $result);
}
}
private function getClient()
{
if (!$this->client) {
$this->client = new \SoapClient($this->wsdl);
}
return $this->client;
}
public function setClient($client)
{
$this->client = $client;
}
}
}
namespace Sonata\MediaBundle\CDN
{
class Server implements CDNInterface
{
protected $path;
public function __construct($path)
{
$this->path = $path;
}
public function getPath($relativePath, $isFlushable)
{
return sprintf('%s/%s', rtrim($this->path,'/'), ltrim($relativePath,'/'));
}
public function flushByString($string)
{
}
public function flush($string)
{
}
public function flushPaths(array $paths)
{
}
}
}
namespace Sonata\MediaBundle\Extra
{
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Symfony\Component\Routing\RouterInterface;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class Pixlr
{
protected $referrer;
protected $secret;
protected $mediaManager;
protected $router;
protected $pool;
protected $templating;
protected $container;
protected $validFormats;
protected $allowEreg;
public function __construct($referrer, $secret, Pool $pool, MediaManagerInterface $mediaManager, RouterInterface $router, EngineInterface $templating, ContainerInterface $container)
{
$this->referrer = $referrer;
$this->secret = $secret;
$this->mediaManager = $mediaManager;
$this->router = $router;
$this->pool = $pool;
$this->templating = $templating;
$this->container = $container;
$this->validFormats = array('jpg','jpeg','png');
$this->allowEreg ='@http://([a-zA-Z0-9]*).pixlr.com/_temp/[0-9a-z]{24}\.[a-z]*@';
}
private function generateHash(MediaInterface $media)
{
return sha1($media->getId() . $media->getCreatedAt()->format('u') . $this->secret);
}
private function getMedia($id)
{
$media = $this->mediaManager->findOneBy(array('id'=> $id));
if (!$media) {
throw new NotFoundHttpException('Media not found');
}
return $media;
}
private function checkMedia($hash, MediaInterface $media)
{
if ($hash != $this->generateHash($media)) {
throw new NotFoundHttpException('Invalid hash');
}
if (!$this->isEditable($media)) {
throw new NotFoundHttpException('Media is not editable');
}
}
private function buildQuery(array $parameters = array())
{
$query = array();
foreach ($parameters as $name => $value) {
$query[] = sprintf('%s=%s', $name, $value);
}
return implode('&', $query);
}
public function editAction($id, $mode)
{
if (!in_array($mode, array('express','editor'))) {
throw new NotFoundHttpException('Invalid mode');
}
$media = $this->getMedia($id);
$provider = $this->pool->getProvider($media->getProviderName());
$hash = $this->generateHash($media);
$parameters = array('s'=>'c','referrer'=> $this->referrer,'exit'=> $this->router->generate('sonata_media_pixlr_exit', array('hash'=> $hash,'id'=> $media->getId()), true),'image'=> $provider->generatePublicUrl($media,'reference'),'title'=> $media->getName(),'target'=> $this->router->generate('sonata_media_pixlr_target', array('hash'=> $hash,'id'=> $media->getId()), true),'locktitle'=> true,'locktarget'=> true,
);
$url = sprintf('http://pixlr.com/%s/?%s', $mode, $this->buildQuery($parameters));
return new RedirectResponse($url);
}
public function exitAction($hash, $id)
{
$media = $this->getMedia($id);
$this->checkMedia($hash, $media);
return new Response($this->templating->render('SonataMediaBundle:Extra:pixlr_exit.html.twig'));
}
public function targetAction(Request $request, $hash, $id)
{
$media = $this->getMedia($id);
$this->checkMedia($hash, $media);
$provider = $this->pool->getProvider($media->getProviderName());
if (!preg_match($this->allowEreg, $request->get('image'), $matches)) {
throw new NotFoundHttpException(sprintf('Invalid image host : %s', $request->get('image')));
}
$file = $provider->getReferenceFile($media);
$file->setContent(file_get_contents($request->get('image')));
$provider->updateMetadata($media);
$provider->generateThumbnails($media);
$this->mediaManager->save($media);
return new Response($this->templating->render('SonataMediaBundle:Extra:pixlr_exit.html.twig'));
}
public function isEditable(MediaInterface $media)
{
if (!$this->container->get('sonata.media.admin.media')->isGranted('EDIT', $media)) {
return false;
}
return in_array(strtolower($media->getExtension()), $this->validFormats);
}
public function openEditorAction($id)
{
$media = $this->getMedia($id);
if (!$this->isEditable($media)) {
throw new NotFoundHttpException('The media is not editable');
}
return new Response($this->templating->render('SonataMediaBundle:Extra:pixlr_editor.html.twig', array('media'=> $media,'admin_pool'=> $this->container->get('sonata.admin.pool'),
)));
}
}
}
namespace Gaufrette\Adapter
{
interface ChecksumCalculator
{
public function checksum($key);
}
}
namespace Gaufrette\Adapter
{
interface StreamFactory
{
public function createStream($key);
}
}
namespace Gaufrette
{
interface Adapter
{
public function read($key);
public function write($key, $content);
public function exists($key);
public function keys();
public function mtime($key);
public function delete($key);
public function rename($sourceKey, $targetKey);
public function isDirectory($key);
}
}
namespace Gaufrette\Adapter
{
use Gaufrette\Util;
use Gaufrette\Adapter;
use Gaufrette\Stream;
use Gaufrette\Adapter\StreamFactory;
use Gaufrette\Exception;
class Local implements Adapter,
StreamFactory,
ChecksumCalculator
{
protected $directory;
private $create;
public function __construct($directory, $create = false)
{
$this->directory = Util\Path::normalize($directory);
if (is_link($this->directory)) {
$this->directory = realpath($this->directory);
}
$this->create = $create;
}
public function read($key)
{
return file_get_contents($this->computePath($key));
}
public function write($key, $content)
{
$path = $this->computePath($key);
$this->ensureDirectoryExists(dirname($path), true);
return file_put_contents($path, $content);
}
public function rename($sourceKey, $targetKey)
{
$targetPath = $this->computePath($targetKey);
$this->ensureDirectoryExists(dirname($targetPath), true);
return rename($this->computePath($sourceKey), $targetPath);
}
public function exists($key)
{
return file_exists($this->computePath($key));
}
public function keys()
{
$this->ensureDirectoryExists($this->directory, $this->create);
try {
$iterator = new \RecursiveIteratorIterator(
new \RecursiveDirectoryIterator(
$this->directory,
\FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS
)
);
} catch (\Exception $e) {
$iterator = new \EmptyIterator;
}
$files = iterator_to_array($iterator);
$keys = array();
foreach ($files as $file) {
$keys[] = $key = $this->computeKey($file);
if ('.'!== dirname($key)) {
$keys[] = dirname($key);
}
}
sort($keys);
return $keys;
}
public function mtime($key)
{
return filemtime($this->computePath($key));
}
public function delete($key)
{
if ($this->isDirectory($key)) {
return rmdir($this->computePath($key));
}
return unlink($this->computePath($key));
}
public function isDirectory($key)
{
return is_dir($this->computePath($key));
}
public function createStream($key)
{
return new Stream\Local($this->computePath($key));
}
public function checksum($key)
{
return Util\Checksum::fromFile($this->computePath($key));
}
public function computeKey($path)
{
$path = $this->normalizePath($path);
return ltrim(substr($path, strlen($this->directory)),'/');
}
protected function computePath($key)
{
$this->ensureDirectoryExists($this->directory, $this->create);
return $this->normalizePath($this->directory .'/'. $key);
}
protected function normalizePath($path)
{
$path = Util\Path::normalize($path);
if (0 !== strpos($path, $this->directory)) {
throw new \OutOfBoundsException(sprintf('The path "%s" is out of the filesystem.', $path));
}
return $path;
}
protected function ensureDirectoryExists($directory, $create = false)
{
if (!is_dir($directory)) {
if (!$create) {
throw new \RuntimeException(sprintf('The directory "%s" does not exist.', $directory));
}
$this->createDirectory($directory);
}
}
protected function createDirectory($directory)
{
$umask = umask(0);
$created = mkdir($directory, 0777, true);
umask($umask);
if (!$created) {
throw new \RuntimeException(sprintf('The directory \'%s\' could not be created.', $directory));
}
}
}
}
namespace Sonata\MediaBundle\Filesystem
{
use Gaufrette\Adapter\Local as BaseLocal;
class Local extends BaseLocal
{
public function getDirectory()
{
return $this->directory;
}
}
}
namespace Gaufrette\Adapter
{
interface MetadataSupporter
{
public function setMetadata($key, $content);
public function getMetadata($key);
}
}
namespace Sonata\MediaBundle\Filesystem
{
use Gaufrette\Adapter as AdapterInterface;
use Gaufrette\Adapter\MetadataSupporter;
use Gaufrette\Filesystem;
use Psr\Log\LoggerInterface;
class Replicate implements AdapterInterface, MetadataSupporter
{
protected $master;
protected $slave;
protected $logger;
public function __construct(AdapterInterface $master, AdapterInterface $slave, LoggerInterface $logger = null)
{
$this->master = $master;
$this->slave = $slave;
$this->logger = $logger;
}
public function delete($key)
{
$ok = true;
try {
$this->slave->delete($key);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf("Unable to delete %s, error: %s", $key, $e->getMessage()));
}
$ok = false;
}
try {
$this->master->delete($key);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf("Unable to delete %s, error: %s", $key, $e->getMessage()));
}
$ok = false;
}
return $ok;
}
public function mtime($key)
{
return $this->master->mtime($key);
}
public function keys()
{
return $this->master->keys();
}
public function exists($key)
{
return $this->master->exists($key);
}
public function write($key, $content, array $metadata = null)
{
$ok = true;
$return = false;
try {
$return = $this->master->write($key, $content, $metadata);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf("Unable to write %s, error: %s", $key, $e->getMessage()));
}
$ok = false;
}
try {
$return = $this->slave->write($key, $content, $metadata);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf("Unable to write %s, error: %s", $key, $e->getMessage()));
}
$ok = false;
}
return $ok && $return;
}
public function read($key)
{
return $this->master->read($key);
}
public function rename($key, $new)
{
$ok = true;
try {
$this->master->rename($key, $new);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf("Unable to rename %s, error: %s", $key, $e->getMessage()));
}
$ok = false;
}
try {
$this->slave->rename($key, $new);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf("Unable to rename %s, error: %s", $key, $e->getMessage()));
}
$ok = false;
}
return $ok;
}
public function supportsMetadata()
{
return $this->master instanceof MetadataSupporter || $this->slave instanceof MetadataSupporter;
}
public function setMetadata($key, $metadata)
{
if ($this->master instanceof MetadataSupporter) {
$this->master->setMetadata($key, $metadata);
}
if ($this->slave instanceof MetadataSupporter) {
$this->slave->setMetadata($key, $metadata);
}
}
public function getMetadata($key)
{
if ($this->master instanceof MetadataSupporter) {
return $this->master->getMetadata($key);
} elseif ($this->slave instanceof MetadataSupporter) {
return $this->slave->getMetadata($key);
}
return array();
}
public function getAdapterClassNames()
{
return array(
get_class($this->master),
get_class($this->slave),
);
}
public function createFile($key, Filesystem $filesystem)
{
return $this->master->createFile($key, $filesystem);
}
public function createFileStream($key, Filesystem $filesystem)
{
return $this->master->createFileStream($key, $filesystem);
}
public function listDirectory($directory ='')
{
return $this->master->listDirectory($directory);
}
public function isDirectory($key)
{
return $this->master->isDirectory($key);
}
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
interface GeneratorInterface
{
public function generatePath(MediaInterface $media);
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
class DefaultGenerator implements GeneratorInterface
{
protected $firstLevel;
protected $secondLevel;
public function __construct($firstLevel = 100000, $secondLevel = 1000)
{
$this->firstLevel = $firstLevel;
$this->secondLevel = $secondLevel;
}
public function generatePath(MediaInterface $media)
{
$rep_first_level = (int) ($media->getId() / $this->firstLevel);
$rep_second_level = (int) (($media->getId() - ($rep_first_level * $this->firstLevel)) / $this->secondLevel);
return sprintf('%s/%04s/%02s', $media->getContext(), $rep_first_level + 1, $rep_second_level + 1);
}
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
class ODMGenerator implements GeneratorInterface
{
public function generatePath(MediaInterface $media)
{
$id = $media->getId();
return sprintf('%s/%04s/%02s', $media->getContext(), substr($id, 0, 4), substr($id, 4, 2));
}
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
class PHPCRGenerator implements GeneratorInterface
{
public function generatePath(MediaInterface $media)
{
$segments = preg_split('#/#', $media->getId(), null, PREG_SPLIT_NO_EMPTY);
if (count($segments) > 1) {
array_pop($segments);
$path = join($segments,'/');
} else {
$path ='';
}
return $path ? sprintf('%s/%s', $media->getContext(), $path) : $media->getContext();
}
}
}
namespace Sonata\MediaBundle\Metadata
{
use Sonata\MediaBundle\Model\MediaInterface;
interface MetadataBuilderInterface
{
public function get(MediaInterface $media, $filename);
}
}
namespace Sonata\MediaBundle\Metadata
{
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use \AmazonS3 as AmazonS3;
use \CFMimeTypes;
class AmazonMetadataBuilder implements MetadataBuilderInterface
{
protected $settings;
protected $acl = array('private'=> AmazonS3::ACL_PRIVATE,'public'=> AmazonS3::ACL_PUBLIC,'open'=> AmazonS3::ACL_OPEN,'auth_read'=> AmazonS3::ACL_AUTH_READ,'owner_read'=> AmazonS3::ACL_OWNER_READ,'owner_full_control'=> AmazonS3::ACL_OWNER_FULL_CONTROL,
);
public function __construct(array $settings)
{
$this->settings = $settings;
}
protected function getDefaultMetadata()
{
$output = array();
if (isset($this->settings['acl']) && !empty($this->settings['acl'])) {
$output['acl'] = $this->acl[$this->settings['acl']];
}
if (isset($this->settings['storage'])) {
if ($this->settings['storage'] =='standard') {
$output['storage'] = AmazonS3::STORAGE_STANDARD;
} elseif ($this->settings['storage'] =='reduced') {
$output['storage'] = AmazonS3::STORAGE_REDUCED;
}
}
if (isset($this->settings['meta']) && !empty($this->settings['meta'])) {
$output['meta'] = $this->settings['meta'];
}
if (isset($this->settings['cache_control']) && !empty($this->settings['cache_control'])) {
$output['headers']['Cache-Control'] = $this->settings['cache_control'];
}
if (isset($this->settings['encryption']) && !empty($this->settings['encryption'])) {
if ($this->settings['encryption'] =='aes256') {
$output['encryption'] ='AES256';
}
}
return $output;
}
protected function getContentType($filename)
{
$extension = pathinfo($filename, PATHINFO_EXTENSION);
$contentType = CFMimeTypes::get_mimetype($extension);
return array('contentType'=> $contentType);
}
public function get(MediaInterface $media, $filename)
{
return array_replace_recursive(
$this->getDefaultMetadata(),
$this->getContentType($filename)
);
}
}
}
namespace Sonata\MediaBundle\Metadata
{
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
class NoopMetadataBuilder implements MetadataBuilderInterface
{
public function get(MediaInterface $media, $filename)
{
return array();
}
}
}
namespace Sonata\MediaBundle\Metadata
{
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Filesystem\Replicate;
use Symfony\Component\DependencyInjection\ContainerInterface;
class ProxyMetadataBuilder implements MetadataBuilderInterface
{
private $container;
private $map;
private $metadata;
public function __construct(ContainerInterface $container, array $map)
{
$this->container = $container;
$this->map = $map;
}
public function get(MediaInterface $media, $filename)
{
if (!$this->container->has($media->getProviderName())) {
return array();
}
if ($meta = $this->getAmazonBuilder($media, $filename)) {
return $meta;
}
if (!$this->container->has('sonata.media.metadata.noop')) {
return array();
}
return $this->container->get('sonata.media.metadata.noop')->get($media, $filename);
}
protected function getAmazonBuilder(MediaInterface $media, $filename)
{
$adapter = $this->container->get($media->getProviderName())->getFilesystem()->getAdapter();
if ($adapter instanceof Replicate) {
$adapterClassNames = $adapter->getAdapterClassNames();
} else {
$adapterClassNames = array(get_class($adapter));
}
if (!in_array('Gaufrette\Adapter\AmazonS3', $adapterClassNames) || !$this->container->has('sonata.media.metadata.amazon')) {
return false;
}
return $this->container->get('sonata.media.metadata.amazon')->get($media, $filename);
}
}
}
namespace Sonata\MediaBundle\Model
{
interface GalleryInterface
{
public function setName($name);
public function getContext();
public function setContext($context);
public function getName();
public function setEnabled($enabled);
public function getEnabled();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function setDefaultFormat($defaultFormat);
public function getDefaultFormat();
public function setGalleryHasMedias($galleryHasMedias);
public function getGalleryHasMedias();
public function addGalleryHasMedias(GalleryHasMediaInterface $galleryHasMedia);
public function __toString();
}
}
namespace Sonata\MediaBundle\Model
{
use Doctrine\Common\Collections\ArrayCollection;
abstract class Gallery implements GalleryInterface
{
protected $context;
protected $name;
protected $enabled;
protected $updatedAt;
protected $createdAt;
protected $defaultFormat;
protected $galleryHasMedias;
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setDefaultFormat($defaultFormat)
{
$this->defaultFormat = $defaultFormat;
}
public function getDefaultFormat()
{
return $this->defaultFormat;
}
public function setGalleryHasMedias($galleryHasMedias)
{
$this->galleryHasMedias = new ArrayCollection();
foreach ($galleryHasMedias as $galleryHasMedia) {
$this->addGalleryHasMedias($galleryHasMedia);
}
}
public function getGalleryHasMedias()
{
return $this->galleryHasMedias;
}
public function addGalleryHasMedias(GalleryHasMediaInterface $galleryHasMedia)
{
$galleryHasMedia->setGallery($this);
$this->galleryHasMedias[] = $galleryHasMedia;
}
public function __toString()
{
return $this->getName() ?:'-';
}
public function setContext($context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
}
}
namespace Sonata\MediaBundle\Model
{
interface GalleryHasMediaInterface
{
public function setEnabled($enabled);
public function getEnabled();
public function setGallery(GalleryInterface $gallery = null);
public function getGallery();
public function setMedia(MediaInterface $media = null);
public function getMedia();
public function setPosition($position);
public function getPosition();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function __toString();
}
}
namespace Sonata\MediaBundle\Model
{
abstract class GalleryHasMedia implements GalleryHasMediaInterface
{
protected $media;
protected $gallery;
protected $position;
protected $updatedAt;
protected $createdAt;
protected $enabled;
public function __construct()
{
$this->position = 0;
$this->enabled = false;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setGallery(GalleryInterface $gallery = null)
{
$this->gallery = $gallery;
}
public function getGallery()
{
return $this->gallery;
}
public function setMedia(MediaInterface $media = null)
{
$this->media = $media;
}
public function getMedia()
{
return $this->media;
}
public function setPosition($position)
{
$this->position = $position;
}
public function getPosition()
{
return $this->position;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function __toString()
{
return $this->getGallery().' | '.$this->getMedia();
}
}
}
namespace Sonata\MediaBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
interface GalleryManagerInterface extends ManagerInterface
{
}
}
namespace Sonata\MediaBundle\Model
{
abstract class GalleryManager implements GalleryManagerInterface
{
public function create()
{
$class = $this->getClass();
return new $class;
}
}
}
namespace Sonata\MediaBundle\Model
{
interface MediaInterface
{
const STATUS_OK = 1;
const STATUS_SENDING = 2;
const STATUS_PENDING = 3;
const STATUS_ERROR = 4;
const STATUS_ENCODING = 5;
public function setBinaryContent($binaryContent);
public function getBinaryContent();
public function getMetadataValue($name, $default = null);
public function setMetadataValue($name, $value);
public function unsetMetadataValue($name);
public function getId();
public function setName($name);
public function getName();
public function setDescription($description);
public function getDescription();
public function setEnabled($enabled);
public function getEnabled();
public function setProviderName($providerName);
public function getProviderName();
public function setProviderStatus($providerStatus);
public function getProviderStatus();
public function setProviderReference($providerReference);
public function getProviderReference();
public function setProviderMetadata(array $providerMetadata = array());
public function getProviderMetadata();
public function setWidth($width);
public function getWidth();
public function setHeight($height);
public function getHeight();
public function setLength($length);
public function getLength();
public function setCopyright($copyright);
public function getCopyright();
public function setAuthorName($authorName);
public function getAuthorName();
public function setContext($context);
public function getContext();
public function setCdnIsFlushable($cdnIsFlushable);
public function getCdnIsFlushable();
public function setCdnFlushAt(\Datetime $cdnFlushAt = null);
public function getCdnFlushAt();
public function setUpdatedAt(\Datetime $updatedAt = null);
public function getUpdatedAt();
public function setCreatedAt(\Datetime $createdAt = null);
public function getCreatedAt();
public function setContentType($contentType);
public function getExtension();
public function getContentType();
public function setSize($size);
public function getSize();
public function setCdnStatus($cdnStatus);
public function getCdnStatus();
public function getBox();
public function setGalleryHasMedias($galleryHasMedias);
public function getGalleryHasMedias();
public function getPreviousProviderReference();
}
}
namespace Sonata\MediaBundle\Model
{
use Imagine\Image\Box;
use Symfony\Component\Validator\ExecutionContextInterface;
abstract class Media implements MediaInterface
{
protected $name;
protected $description;
protected $enabled = false;
protected $providerName;
protected $providerStatus;
protected $providerReference;
protected $providerMetadata = array();
protected $width;
protected $height;
protected $length;
protected $copyright;
protected $authorName;
protected $context;
protected $cdnIsFlushable;
protected $cdnFlushAt;
protected $cdnStatus;
protected $updatedAt;
protected $createdAt;
protected $binaryContent;
protected $previousProviderReference;
protected $contentType;
protected $size;
protected $galleryHasMedias;
public function prePersist()
{
$this->setCreatedAt(new \DateTime);
$this->setUpdatedAt(new \DateTime);
}
public function preUpdate()
{
$this->setUpdatedAt(new \DateTime);
}
public static function getStatusList()
{
return array(
self::STATUS_OK =>'ok',
self::STATUS_SENDING =>'sending',
self::STATUS_PENDING =>'pending',
self::STATUS_ERROR =>'error',
self::STATUS_ENCODING =>'encoding',
);
}
public function setBinaryContent($binaryContent)
{
$this->previousProviderReference = $this->providerReference;
$this->providerReference = null;
$this->binaryContent = $binaryContent;
}
public function getBinaryContent()
{
return $this->binaryContent;
}
public function getMetadataValue($name, $default = null)
{
$metadata = $this->getProviderMetadata();
return isset($metadata[$name]) ? $metadata[$name] : $default;
}
public function setMetadataValue($name, $value)
{
$metadata = $this->getProviderMetadata();
$metadata[$name] = $value;
$this->setProviderMetadata($metadata);
}
public function unsetMetadataValue($name)
{
$metadata = $this->getProviderMetadata();
unset($metadata[$name]);
$this->setProviderMetadata($metadata);
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setDescription($description)
{
$this->description = $description;
}
public function getDescription()
{
return $this->description;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setProviderName($providerName)
{
$this->providerName = $providerName;
}
public function getProviderName()
{
return $this->providerName;
}
public function setProviderStatus($providerStatus)
{
$this->providerStatus = $providerStatus;
}
public function getProviderStatus()
{
return $this->providerStatus;
}
public function setProviderReference($providerReference)
{
$this->providerReference = $providerReference;
}
public function getProviderReference()
{
return $this->providerReference;
}
public function setProviderMetadata(array $providerMetadata = array())
{
$this->providerMetadata = $providerMetadata;
}
public function getProviderMetadata()
{
return $this->providerMetadata;
}
public function setWidth($width)
{
$this->width = $width;
}
public function getWidth()
{
return $this->width;
}
public function setHeight($height)
{
$this->height = $height;
}
public function getHeight()
{
return $this->height;
}
public function setLength($length)
{
$this->length = $length;
}
public function getLength()
{
return $this->length;
}
public function setCopyright($copyright)
{
$this->copyright = $copyright;
}
public function getCopyright()
{
return $this->copyright;
}
public function setAuthorName($authorName)
{
$this->authorName = $authorName;
}
public function getAuthorName()
{
return $this->authorName;
}
public function setContext($context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function setCdnIsFlushable($cdnIsFlushable)
{
$this->cdnIsFlushable = $cdnIsFlushable;
}
public function getCdnIsFlushable()
{
return $this->cdnIsFlushable;
}
public function setCdnFlushAt(\DateTime $cdnFlushAt = null)
{
$this->cdnFlushAt = $cdnFlushAt;
}
public function getCdnFlushAt()
{
return $this->cdnFlushAt;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setContentType($contentType)
{
$this->contentType = $contentType;
}
public function getContentType()
{
return $this->contentType;
}
public function getExtension()
{
return pathinfo($this->getProviderReference(), PATHINFO_EXTENSION);
}
public function setSize($size)
{
$this->size = $size;
}
public function getSize()
{
return $this->size;
}
public function setCdnStatus($cdnStatus)
{
$this->cdnStatus = $cdnStatus;
}
public function getCdnStatus()
{
return $this->cdnStatus;
}
public function getBox()
{
return new Box($this->width, $this->height);
}
public function __toString()
{
return $this->getName() ?:'n/a';
}
public function setGalleryHasMedias($galleryHasMedias)
{
$this->galleryHasMedias = $galleryHasMedias;
}
public function getGalleryHasMedias()
{
return $this->galleryHasMedias;
}
public function getPreviousProviderReference()
{
return $this->previousProviderReference;
}
public function isStatusErroneous(ExecutionContextInterface $context)
{
if ($this->getBinaryContent() && $this->getProviderStatus() == self::STATUS_ERROR) {
$context->addViolationAt('binaryContent','invalid', array(), null);
}
}
}
}
namespace Sonata\MediaBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
interface MediaManagerInterface extends ManagerInterface
{
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\MetadataInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Resizer\ResizerInterface;
use Gaufrette\Filesystem;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\Form\FormBuilder;
interface MediaProviderInterface
{
public function addFormat($name, $format);
public function getFormat($name);
public function requireThumbnails();
public function generateThumbnails(MediaInterface $media);
public function removeThumbnails(MediaInterface $media);
public function getReferenceFile(MediaInterface $media);
public function getFormatName(MediaInterface $media, $format);
public function getReferenceImage(MediaInterface $media);
public function preUpdate(MediaInterface $media);
public function postUpdate(MediaInterface $media);
public function preRemove(MediaInterface $media);
public function postRemove(MediaInterface $media);
public function buildCreateForm(FormMapper $formMapper);
public function buildEditForm(FormMapper $formMapper);
public function prePersist(MediaInterface $media);
public function postPersist(MediaInterface $media);
public function getHelperProperties(MediaInterface $media, $format);
public function generatePath(MediaInterface $media);
public function generatePublicUrl(MediaInterface $media, $format);
public function generatePrivateUrl(MediaInterface $media, $format);
public function getFormats();
public function setName($name);
public function getName();
public function getProviderMetadata();
public function setTemplates(array $templates);
public function getTemplates();
public function getTemplate($name);
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array());
public function getResizer();
public function getFilesystem();
public function getCdnPath($relativePath, $isFlushable);
public function transform(MediaInterface $media);
public function validate(ErrorElement $errorElement, MediaInterface $media);
public function buildMediaType(FormBuilder $formBuilder);
public function updateMetadata(MediaInterface $media, $force = false);
}
}
namespace Sonata\MediaBundle\Provider
{
use Gaufrette\Filesystem;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Resizer\ResizerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
abstract class BaseProvider implements MediaProviderInterface
{
protected $formats = array();
protected $templates = array();
protected $resizer;
protected $filesystem;
protected $pathGenerator;
protected $cdn;
protected $thumbnail;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail)
{
$this->name = $name;
$this->filesystem = $filesystem;
$this->cdn = $cdn;
$this->pathGenerator = $pathGenerator;
$this->thumbnail = $thumbnail;
}
abstract protected function doTransform(MediaInterface $media);
final public function transform(MediaInterface $media)
{
if (null === $media->getBinaryContent()) {
return;
}
$this->doTransform($media);
}
public function addFormat($name, $format)
{
$this->formats[$name] = $format;
}
public function getFormat($name)
{
return isset($this->formats[$name]) ? $this->formats[$name] : false;
}
public function requireThumbnails()
{
return $this->getResizer() !== null;
}
public function generateThumbnails(MediaInterface $media)
{
$this->thumbnail->generate($this, $media);
}
public function removeThumbnails(MediaInterface $media)
{
$this->thumbnail->delete($this, $media);
}
public function getFormatName(MediaInterface $media, $format)
{
if ($format =='admin') {
return'admin';
}
if ($format =='reference') {
return'reference';
}
$baseName = $media->getContext().'_';
if (substr($format, 0, strlen($baseName)) == $baseName) {
return $format;
}
return $baseName.$format;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().".description", null,"SonataMediaBundle", array('class'=>'fa fa-file'));
}
public function preRemove(MediaInterface $media)
{
$path = $this->getReferenceImage($media);
if ($this->getFilesystem()->has($path)) {
$this->getFilesystem()->delete($path);
}
if ($this->requireThumbnails()) {
$this->thumbnail->delete($this, $media);
}
}
public function postRemove(MediaInterface $media)
{
}
public function generatePath(MediaInterface $media)
{
return $this->pathGenerator->generatePath($media);
}
public function getFormats()
{
return $this->formats;
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setTemplates(array $templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
public function getTemplate($name)
{
return isset($this->templates[$name]) ? $this->templates[$name] : null;
}
public function getResizer()
{
return $this->resizer;
}
public function getFilesystem()
{
return $this->filesystem;
}
public function getCdn()
{
return $this->cdn;
}
public function getCdnPath($relativePath, $isFlushable)
{
return $this->getCdn()->getPath($relativePath, $isFlushable);
}
public function setResizer(ResizerInterface $resizer)
{
$this->resizer = $resizer;
}
public function prePersist(MediaInterface $media)
{
$media->setCreatedAt(new \Datetime());
$media->setUpdatedAt(new \Datetime());
}
public function preUpdate(MediaInterface $media)
{
$media->setUpdatedAt(new \Datetime());
}
public function validate(ErrorElement $errorElement, MediaInterface $media)
{
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Gaufrette\Filesystem;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Buzz\Browser;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Symfony\Component\Form\FormBuilder;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
abstract class BaseVideoProvider extends BaseProvider
{
protected $browser;
protected $metadata;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, Browser $browser, MetadataBuilderInterface $metadata = null)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail);
$this->browser = $browser;
$this->metadata = $metadata;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().".description", null,"SonataMediaBundle", array('class'=>'fa fa-video-camera'));
}
public function getReferenceImage(MediaInterface $media)
{
return $media->getMetadataValue('thumbnail_url');
}
public function getReferenceFile(MediaInterface $media)
{
$key = $this->generatePrivateUrl($media,'reference');
if ($this->getFilesystem()->has($key)) {
$referenceFile = $this->getFilesystem()->get($key);
} else {
$referenceFile = $this->getFilesystem()->get($key, true);
$metadata = $this->metadata ? $this->metadata->get($media, $referenceFile->getName()) : array();
$referenceFile->setContent($this->browser->get($this->getReferenceImage($media))->getContent(), $metadata);
}
return $referenceFile;
}
public function generatePublicUrl(MediaInterface $media, $format)
{
return $this->getCdn()->getPath(sprintf('%s/thumb_%d_%s.jpg',
$this->generatePath($media),
$media->getId(),
$format
), $media->getCdnIsFlushable());
}
public function generatePrivateUrl(MediaInterface $media, $format)
{
return sprintf('%s/thumb_%d_%s.jpg',
$this->generatePath($media),
$media->getId(),
$format
);
}
public function buildEditForm(FormMapper $formMapper)
{
$formMapper->add('name');
$formMapper->add('enabled', null, array('required'=> false));
$formMapper->add('authorName');
$formMapper->add('cdnIsFlushable');
$formMapper->add('description');
$formMapper->add('copyright');
$formMapper->add('binaryContent','text', array('required'=> false));
}
public function buildCreateForm(FormMapper $formMapper)
{
$formMapper->add('binaryContent','text', array('constraints'=> array(
new NotBlank(),
new NotNull()
)
));
}
public function buildMediaType(FormBuilder $formBuilder)
{
$formBuilder->add('binaryContent','text');
}
public function postUpdate(MediaInterface $media)
{
$this->postPersist($media);
}
public function postPersist(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
$this->generateThumbnails($media);
}
public function postRemove(MediaInterface $media)
{
}
protected function getMetadata(MediaInterface $media, $url)
{
try {
$response = $this->browser->get($url);
} catch (\RuntimeException $e) {
throw new \RuntimeException('Unable to retrieve the video information for :'. $url, null, $e);
}
$metadata = json_decode($response->getContent(), true);
if (!$metadata) {
throw new \RuntimeException('Unable to decode the video information for :'. $url);
}
return $metadata;
}
protected function getBoxHelperProperties(MediaInterface $media, $format, $options = array())
{
if ($format =='reference') {
return $media->getBox();
}
if (isset($options['width']) || isset($options['height'])) {
$settings = array('width'=> isset($options['width']) ? $options['width'] : null,'height'=> isset($options['height']) ? $options['height'] : null,
);
} else {
$settings = $this->getFormat($format);
}
return $this->resizer->getBox($media, $settings);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
class DailyMotionProvider extends BaseVideoProvider
{
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
$defaults = array('related'=> 0,'explicit'=> 0,'autoPlay'=> 0,'autoMute'=> 0,'unmuteOnMouseOver'=> 0,'start'=> 0,'enableApi'=> 0,'chromeless'=> 0,'expendVideo'=> 0,'color2'=> null,'foreground'=> null,'background'=> null,'highlight'=> null,
);
$player_parameters = array_merge($defaults, isset($options['player_parameters']) ? $options['player_parameters'] : array());
$box = $this->getBoxHelperProperties($media, $format, $options);
$params = array('player_parameters'=> http_build_query($player_parameters),'allowFullScreen'=> isset($options['allowFullScreen']) ? $options['allowFullScreen'] :'true','allowScriptAccess'=> isset($options['allowScriptAccess']) ? $options['allowScriptAccess'] :'always','width'=> $box->getWidth(),'height'=> $box->getHeight(),
);
return $params;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().".description","bundles/sonatamedia/dailymotion-icon.png","SonataMediaBundle");
}
protected function fixBinaryContent(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
if (preg_match("/www.dailymotion.com\/video\/([0-9a-zA-Z]*)_/", $media->getBinaryContent(), $matches)) {
$media->setBinaryContent($matches[1]);
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
if (!$media->getBinaryContent()) {
return;
}
$media->setProviderName($this->name);
$media->setProviderStatus(MediaInterface::STATUS_OK);
$media->setProviderReference($media->getBinaryContent());
$this->updateMetadata($media, true);
}
public function updateMetadata(MediaInterface $media, $force = false)
{
$url = sprintf('http://www.dailymotion.com/services/oembed?url=http://www.dailymotion.com/video/%s&format=json', $media->getProviderReference());
try {
$metadata = $this->getMetadata($media, $url);
} catch (\RuntimeException $e) {
$media->setEnabled(false);
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$media->setProviderMetadata($metadata);
if ($force) {
$media->setName($metadata['title']);
$media->setAuthorName($metadata['author_name']);
}
$media->setHeight($metadata['height']);
$media->setWidth($metadata['width']);
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
return new RedirectResponse(sprintf('http://www.dailymotion.com/video/%s', $media->getProviderReference()), 302, $headers);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Gaufrette\Adapter\Local;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Form\FormBuilder;
use Gaufrette\Filesystem;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
class FileProvider extends BaseProvider
{
protected $allowedExtensions;
protected $allowedMimeTypes;
protected $metadata;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, array $allowedExtensions = array(), array $allowedMimeTypes = array(), MetadataBuilderInterface $metadata = null)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail);
$this->allowedExtensions = $allowedExtensions;
$this->allowedMimeTypes = $allowedMimeTypes;
$this->metadata = $metadata;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().".description", null,"SonataMediaBundle", array('class'=>'fa fa-file-text-o'));
}
public function getReferenceImage(MediaInterface $media)
{
return sprintf('%s/%s',
$this->generatePath($media),
$media->getProviderReference()
);
}
public function getReferenceFile(MediaInterface $media)
{
return $this->getFilesystem()->get($this->getReferenceImage($media), true);
}
public function buildEditForm(FormMapper $formMapper)
{
$formMapper->add('name');
$formMapper->add('enabled', null, array('required'=> false));
$formMapper->add('authorName');
$formMapper->add('cdnIsFlushable');
$formMapper->add('description');
$formMapper->add('copyright');
$formMapper->add('binaryContent','file', array('required'=> false));
}
public function buildCreateForm(FormMapper $formMapper)
{
$formMapper->add('binaryContent','file', array('constraints'=> array(
new NotBlank(),
new NotNull()
)
));
}
public function buildMediaType(FormBuilder $formBuilder)
{
$formBuilder->add('binaryContent','file');
}
public function postPersist(MediaInterface $media)
{
if ($media->getBinaryContent() === null) {
return;
}
$this->setFileContents($media);
$this->generateThumbnails($media);
}
public function postUpdate(MediaInterface $media)
{
if (!$media->getBinaryContent() instanceof \SplFileInfo) {
return;
}
$oldMedia = clone $media;
$oldMedia->setProviderReference($media->getPreviousProviderReference());
$path = $this->getReferenceImage($oldMedia);
if ($this->getFilesystem()->has($path)) {
$this->getFilesystem()->delete($path);
}
$this->fixBinaryContent($media);
$this->setFileContents($media);
$this->generateThumbnails($media);
}
protected function fixBinaryContent(MediaInterface $media)
{
if ($media->getBinaryContent() === null) {
return;
}
if (!$media->getBinaryContent() instanceof File) {
if (!is_file($media->getBinaryContent())) {
throw new \RuntimeException('The file does not exist : '. $media->getBinaryContent());
}
$binaryContent = new File($media->getBinaryContent());
$media->setBinaryContent($binaryContent);
}
}
protected function fixFilename(MediaInterface $media)
{
if ($media->getBinaryContent() instanceof UploadedFile) {
$media->setName($media->getName() ?: $media->getBinaryContent()->getClientOriginalName());
$media->setMetadataValue('filename', $media->getBinaryContent()->getClientOriginalName());
} elseif ($media->getBinaryContent() instanceof File) {
$media->setName($media->getName() ?: $media->getBinaryContent()->getBasename());
$media->setMetadataValue('filename', $media->getBinaryContent()->getBasename());
}
if (!$media->getName()) {
throw new \RuntimeException('Please define a valid media\'s name');
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
$this->fixFilename($media);
if (!$media->getProviderReference()) {
$media->setProviderReference($this->generateReferenceName($media));
}
if ($media->getBinaryContent()) {
$media->setContentType($media->getBinaryContent()->getMimeType());
$media->setSize($media->getBinaryContent()->getSize());
}
$media->setProviderStatus(MediaInterface::STATUS_OK);
}
public function updateMetadata(MediaInterface $media, $force = true)
{
$path = tempnam(sys_get_temp_dir(),'sonata_update_metadata');
$fileObject = new \SplFileObject($path,'w');
$fileObject->fwrite($this->getReferenceFile($media)->getContent());
$media->setSize($fileObject->getSize());
}
public function generatePublicUrl(MediaInterface $media, $format)
{
if ($format =='reference') {
$path = $this->getReferenceImage($media);
} else {
$path = sprintf('sonatamedia/files/%s/file.png', $format);
}
return $this->getCdn()->getPath($path, $media->getCdnIsFlushable());
}
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
return array_merge(array('title'=> $media->getName(),'thumbnail'=> $this->getReferenceImage($media),'file'=> $this->getReferenceImage($media),
), $options);
}
public function generatePrivateUrl(MediaInterface $media, $format)
{
if ($format =='reference') {
return $this->getReferenceImage($media);
}
return false;
}
protected function setFileContents(MediaInterface $media, $contents = null)
{
$file = $this->getFilesystem()->get(sprintf('%s/%s', $this->generatePath($media), $media->getProviderReference()), true);
if (!$contents) {
$contents = $media->getBinaryContent()->getRealPath();
}
$metadata = $this->metadata ? $this->metadata->get($media, $file->getName()) : array();
$file->setContent(file_get_contents($contents), $metadata);
}
protected function generateReferenceName(MediaInterface $media)
{
return sha1($media->getName() . rand(11111, 99999)) .'.'. $media->getBinaryContent()->guessExtension();
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
$headers = array_merge(array('Content-Type'=> $media->getContentType(),'Content-Disposition'=> sprintf('attachment; filename="%s"', $media->getMetadataValue('filename')),
), $headers);
if (!in_array($mode, array('http','X-Sendfile','X-Accel-Redirect'))) {
throw new \RuntimeException('Invalid mode provided');
}
if ($mode =='http') {
if ($format =='reference') {
$file = $this->getReferenceFile($media);
} else {
$file = $this->getFilesystem()->get($this->generatePrivateUrl($media, $format));
}
return new StreamedResponse(function() use ($file) {
echo $file->getContent();
}, 200, $headers);
}
if (!$this->getFilesystem()->getAdapter() instanceof \Sonata\MediaBundle\Filesystem\Local) {
throw new \RuntimeException('Cannot use X-Sendfile or X-Accel-Redirect with non \Sonata\MediaBundle\Filesystem\Local');
}
$filename = sprintf('%s/%s',
$this->getFilesystem()->getAdapter()->getDirectory(),
$this->generatePrivateUrl($media, $format)
);
return new BinaryFileResponse($filename, 200, $headers);
}
public function validate(ErrorElement $errorElement, MediaInterface $media)
{
if (!$media->getBinaryContent() instanceof \SplFileInfo) {
return;
}
if ($media->getBinaryContent() instanceof UploadedFile) {
$fileName = $media->getBinaryContent()->getClientOriginalName();
} elseif ($media->getBinaryContent() instanceof File) {
$fileName = $media->getBinaryContent()->getFilename();
} else {
throw new \RuntimeException(sprintf('Invalid binary content type: %s', get_class($media->getBinaryContent())));
}
if (!in_array(strtolower(pathinfo($fileName, PATHINFO_EXTENSION)), $this->allowedExtensions)) {
$errorElement
->with('binaryContent')
->addViolation('Invalid extensions')
->end();
}
if (!in_array($media->getBinaryContent()->getMimeType(), $this->allowedMimeTypes)) {
$errorElement
->with('binaryContent')
->addViolation('Invalid mime type : '. $media->getBinaryContent()->getMimeType())
->end();
}
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Imagine\Image\ImagineInterface;
use Gaufrette\Filesystem;
class ImageProvider extends FileProvider
{
protected $imagineAdapter;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, array $allowedExtensions = array(), array $allowedMimeTypes = array(), ImagineInterface $adapter, MetadataBuilderInterface $metadata = null)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail, $allowedExtensions, $allowedMimeTypes, $metadata);
$this->imagineAdapter = $adapter;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().".description", null,"SonataMediaBundle", array('class'=>'fa fa-picture-o'));
}
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
if ($format =='reference') {
$box = $media->getBox();
} else {
$resizerFormat = $this->getFormat($format);
if ($resizerFormat === false) {
throw new \RuntimeException(sprintf('The image format "%s" is not defined.
                        Is the format registered in your ``sonata_media`` configuration?', $format));
}
$box = $this->resizer->getBox($media, $resizerFormat);
}
return array_merge(array('alt'=> $media->getName(),'title'=> $media->getName(),'src'=> $this->generatePublicUrl($media, $format),'width'=> $box->getWidth(),'height'=> $box->getHeight()
), $options);
}
public function getReferenceImage(MediaInterface $media)
{
return sprintf('%s/%s',
$this->generatePath($media),
$media->getProviderReference()
);
}
protected function doTransform(MediaInterface $media)
{
parent::doTransform($media);
if (!is_object($media->getBinaryContent()) && !$media->getBinaryContent()) {
return;
}
try {
$image = $this->imagineAdapter->open($media->getBinaryContent()->getPathname());
} catch (\RuntimeException $e) {
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$size = $image->getSize();
$media->setWidth($size->getWidth());
$media->setHeight($size->getHeight());
$media->setProviderStatus(MediaInterface::STATUS_OK);
}
public function updateMetadata(MediaInterface $media, $force = true)
{
try {
$path = tempnam(sys_get_temp_dir(),'sonata_update_metadata');
$fileObject = new \SplFileObject($path,'w');
$fileObject->fwrite($this->getReferenceFile($media)->getContent());
$image = $this->imagineAdapter->open($fileObject->getPathname());
$size = $image->getSize();
$media->setSize($fileObject->getSize());
$media->setWidth($size->getWidth());
$media->setHeight($size->getHeight());
} catch (\LogicException $e) {
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
$media->setSize(0);
$media->setWidth(0);
$media->setHeight(0);
}
}
public function generatePublicUrl(MediaInterface $media, $format)
{
if ($format =='reference') {
$path = $this->getReferenceImage($media);
} else {
$path = $this->thumbnail->generatePublicUrl($this, $media, $format);
}
return $this->getCdn()->getPath($path, $media->getCdnIsFlushable());
}
public function generatePrivateUrl(MediaInterface $media, $format)
{
return $this->thumbnail->generatePrivateUrl($this, $media, $format);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Sonata\MediaBundle\Security\DownloadStrategyInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
class Pool
{
protected $providers = array();
protected $contexts = array();
protected $downloadSecurities = array();
protected $defaultContext;
public function __construct($context)
{
$this->defaultContext = $context;
}
public function getProvider($name)
{
if (!isset($this->providers[$name])) {
throw new \RuntimeException(sprintf('unable to retrieve the provider named : `%s`', $name));
}
return $this->providers[$name];
}
public function addProvider($name, MediaProviderInterface $instance)
{
$this->providers[$name] = $instance;
}
public function addDownloadSecurity($name, DownloadStrategyInterface $security)
{
$this->downloadSecurities[$name] = $security;
}
public function setProviders($providers)
{
$this->providers = $providers;
}
public function getProviders()
{
return $this->providers;
}
public function addContext($name, array $providers = array(), array $formats = array(), array $download = array())
{
if (!$this->hasContext($name)) {
$this->contexts[$name] = array('providers'=> array(),'formats'=> array(),'download'=> array(),
);
}
$this->contexts[$name]['providers'] = $providers;
$this->contexts[$name]['formats'] = $formats;
$this->contexts[$name]['download'] = $download;
}
public function hasContext($name)
{
return isset($this->contexts[$name]);
}
public function getContext($name)
{
if (!$this->hasContext($name)) {
return null;
}
return $this->contexts[$name];
}
public function getContexts()
{
return $this->contexts;
}
public function getProviderNamesByContext($name)
{
$context = $this->getContext($name);
if (!$context) {
return null;
}
return $context['providers'];
}
public function getFormatNamesByContext($name)
{
$context = $this->getContext($name);
if (!$context) {
return null;
}
return $context['formats'];
}
public function getProvidersByContext($name)
{
$providers = array();
if (!$this->hasContext($name)) {
return $providers;
}
foreach ($this->getProviderNamesByContext($name) as $name) {
$providers[] = $this->getProvider($name);
}
return $providers;
}
public function getProviderList()
{
$choices = array();
foreach (array_keys($this->providers) as $name) {
$choices[$name] = $name;
}
return $choices;
}
public function getDownloadSecurity(MediaInterface $media)
{
$context = $this->getContext($media->getContext());
$id = $context['download']['strategy'];
if (!isset($this->downloadSecurities[$id])) {
throw new \RuntimeException('Unable to retrieve the download security : '. $id);
}
return $this->downloadSecurities[$id];
}
public function getDownloadMode(MediaInterface $media)
{
$context = $this->getContext($media->getContext());
return $context['download']['mode'];
}
public function getDefaultContext()
{
return $this->defaultContext;
}
public function validate(ErrorElement $errorElement, MediaInterface $media)
{
$provider = $this->getProvider($media->getProviderName());
$provider->validate($errorElement, $media);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
class VimeoProvider extends BaseVideoProvider
{
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
$defaults = array('fp_version'=> 10,'fullscreen'=> true,'title'=> true,'byline'=> 0,'portrait'=> true,'color'=> null,'hd_off'=> 0,'js_api'=> null,'js_onLoad'=> 0,'js_swf_id'=> uniqid('vimeo_player_'),
);
$player_parameters = array_merge($defaults, isset($options['player_parameters']) ? $options['player_parameters'] : array());
$box = $this->getBoxHelperProperties($media, $format, $options);
$params = array('src'=> http_build_query($player_parameters),'id'=> $player_parameters['js_swf_id'],'frameborder'=> isset($options['frameborder']) ? $options['frameborder'] : 0,'width'=> $box->getWidth(),'height'=> $box->getHeight(),
);
return $params;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().".description", null,"SonataMediaBundle", array('class'=>'fa fa-vimeo-square'));
}
protected function fixBinaryContent(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
if (preg_match("/vimeo\.com\/(\d+)/", $media->getBinaryContent(), $matches)) {
$media->setBinaryContent($matches[1]);
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
if (!$media->getBinaryContent()) {
return;
}
$media->setProviderName($this->name);
$media->setProviderReference($media->getBinaryContent());
$media->setProviderStatus(MediaInterface::STATUS_OK);
$this->updateMetadata($media, true);
}
public function updateMetadata(MediaInterface $media, $force = false)
{
$url = sprintf('http://vimeo.com/api/oembed.json?url=http://vimeo.com/%s', $media->getProviderReference());
try {
$metadata = $this->getMetadata($media, $url);
} catch (\RuntimeException $e) {
$media->setEnabled(false);
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$media->setProviderMetadata($metadata);
if ($force) {
$media->setName($metadata['title']);
$media->setDescription($metadata['description']);
$media->setAuthorName($metadata['author_name']);
}
$media->setHeight($metadata['height']);
$media->setWidth($metadata['width']);
$media->setLength($metadata['duration']);
$media->setContentType('video/x-flv');
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
return new RedirectResponse(sprintf('http://vimeo.com/%s', $media->getProviderReference()), 302, $headers);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Gaufrette\Filesystem;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Buzz\Browser;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
class YouTubeProvider extends BaseVideoProvider
{
protected $html5;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, Browser $browser, MetadataBuilderInterface $metadata = null, $html5 = false)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail, $browser, $metadata);
$this->html5 = $html5;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().".description", null,"SonataMediaBundle", array('class'=>'fa fa-youtube'));
}
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
if (!isset($options['html5'])) {
$options['html5'] = $this->html5;
}
$default_player_url_parameters = array('rel'=> 0,'autoplay'=> 0,'loop'=> 0,'enablejsapi'=> 0,'playerapiid'=> null,'disablekb'=> 0,'egm'=> 0,'border'=> 0,'color1'=> null,'color2'=> null,'fs'=> 1,'start'=> 0,'hd'=> 1,'showsearch'=> 0,'showinfo'=> 0,'iv_load_policy'=> 1,'cc_load_policy'=> 1,'wmode'=>'window');
$default_player_parameters = array('border'=> $default_player_url_parameters['border'],'allowFullScreen'=> $default_player_url_parameters['fs'] =='1'? true : false,'allowScriptAccess'=> isset($options['allowScriptAccess']) ? $options['allowScriptAccess'] :'always','wmode'=> $default_player_url_parameters['wmode']
);
$player_url_parameters = array_merge($default_player_url_parameters, isset($options['player_url_parameters']) ? $options['player_url_parameters'] : array());
$box = $this->getBoxHelperProperties($media, $format, $options);
$player_parameters = array_merge($default_player_parameters, isset($options['player_parameters']) ? $options['player_parameters'] : array(), array('width'=> $box->getWidth(),'height'=> $box->getHeight()
));
$params = array('html5'=> $options['html5'],'player_url_parameters'=> http_build_query($player_url_parameters),'player_parameters'=> $player_parameters
);
return $params;
}
protected function fixBinaryContent(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
if (preg_match("/(?<=v(\=|\/))([-a-zA-Z0-9_]+)|(?<=youtu\.be\/)([-a-zA-Z0-9_]+)/", $media->getBinaryContent(), $matches)) {
$media->setBinaryContent($matches[2]);
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
if (!$media->getBinaryContent()) {
return;
}
$media->setProviderName($this->name);
$media->setProviderStatus(MediaInterface::STATUS_OK);
$media->setProviderReference($media->getBinaryContent());
$this->updateMetadata($media, true);
}
public function updateMetadata(MediaInterface $media, $force = false)
{
$url = sprintf('http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=%s&format=json', $media->getProviderReference());
try {
$metadata = $this->getMetadata($media, $url);
} catch (\RuntimeException $e) {
$media->setEnabled(false);
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$media->setProviderMetadata($metadata);
if ($force) {
$media->setName($metadata['title']);
$media->setAuthorName($metadata['author_name']);
}
$media->setHeight($metadata['height']);
$media->setWidth($metadata['width']);
$media->setContentType('video/x-flv');
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
return new RedirectResponse(sprintf('http://www.youtube.com/watch?v=%s', $media->getProviderReference()), 302, $headers);
}
}
}
namespace Sonata\MediaBundle\Resizer
{
use Gaufrette\File;
use Sonata\MediaBundle\Model\MediaInterface;
interface ResizerInterface
{
public function resize(MediaInterface $media, File $in, File $out, $format, array $settings);
public function getBox(MediaInterface $media, array $settings);
}
}
namespace Sonata\MediaBundle\Resizer
{
use Imagine\Image\ImagineInterface;
use Imagine\Image\Box;
use Gaufrette\File;
use Sonata\MediaBundle\Model\MediaInterface;
use Imagine\Image\ImageInterface;
use Imagine\Exception\InvalidArgumentException;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
class SimpleResizer implements ResizerInterface
{
protected $adapter;
protected $mode;
protected $metadata;
public function __construct(ImagineInterface $adapter, $mode, MetadataBuilderInterface $metadata)
{
$this->adapter = $adapter;
$this->mode = $mode;
$this->metadata = $metadata;
}
public function resize(MediaInterface $media, File $in, File $out, $format, array $settings)
{
if (!isset($settings['width'])) {
throw new \RuntimeException(sprintf('Width parameter is missing in context "%s" for provider "%s"', $media->getContext(), $media->getProviderName()));
}
$image = $this->adapter->load($in->getContent());
$content = $image
->thumbnail($this->getBox($media, $settings), $this->mode)
->get($format, array('quality'=> $settings['quality']));
$out->setContent($content, $this->metadata->get($media, $out->getName()));
}
public function getBox(MediaInterface $media, array $settings)
{
$size = $media->getBox();
if ($settings['width'] == null && $settings['height'] == null) {
throw new \RuntimeException(sprintf('Width/Height parameter is missing in context "%s" for provider "%s". Please add at least one parameter.', $media->getContext(), $media->getProviderName()));
}
if ($settings['height'] == null) {
$settings['height'] = (int) ($settings['width'] * $size->getHeight() / $size->getWidth());
}
if ($settings['width'] == null) {
$settings['width'] = (int) ($settings['height'] * $size->getWidth() / $size->getHeight());
}
return $this->computeBox($media, $settings);
}
private function computeBox(MediaInterface $media, array $settings)
{
if ($this->mode !== ImageInterface::THUMBNAIL_INSET && $this->mode !== ImageInterface::THUMBNAIL_OUTBOUND) {
throw new InvalidArgumentException('Invalid mode specified');
}
$size = $media->getBox();
$ratios = array(
$settings['width'] / $size->getWidth(),
$settings['height'] / $size->getHeight()
);
if ($this->mode === ImageInterface::THUMBNAIL_INSET) {
$ratio = min($ratios);
} else {
$ratio = max($ratios);
}
return $size->scale($ratio);
}
}
}
namespace Sonata\MediaBundle\Resizer
{
use Imagine\Image\ImagineInterface;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Gaufrette\File;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
class SquareResizer implements ResizerInterface
{
protected $adapter;
protected $mode;
public function __construct(ImagineInterface $adapter, $mode, MetadataBuilderInterface $metadata)
{
$this->adapter = $adapter;
$this->mode = $mode;
$this->metadata = $metadata;
}
public function resize(MediaInterface $media, File $in, File $out, $format, array $settings)
{
if (!isset($settings['width'])) {
throw new \RuntimeException(sprintf('Width parameter is missing in context "%s" for provider "%s"', $media->getContext(), $media->getProviderName()));
}
$image = $this->adapter->load($in->getContent());
$size = $media->getBox();
if (null != $settings['height']) {
if ($size->getHeight() > $size->getWidth()) {
$higher = $size->getHeight();
$lower = $size->getWidth();
} else {
$higher = $size->getWidth();
$lower = $size->getHeight();
}
$crop = $higher - $lower;
if ($crop > 0) {
$point = $higher == $size->getHeight() ? new Point(0, 0) : new Point($crop / 2, 0);
$image->crop($point, new Box($lower, $lower));
$size = $image->getSize();
}
}
$settings['height'] = (int) ($settings['width'] * $size->getHeight() / $size->getWidth());
if ($settings['height'] < $size->getHeight() && $settings['width'] < $size->getWidth()) {
$content = $image
->thumbnail(new Box($settings['width'], $settings['height']), $this->mode)
->get($format, array('quality'=> $settings['quality']));
} else {
$content = $image->get($format, array('quality'=> $settings['quality']));
}
$out->setContent($content, $this->metadata->get($media, $out->getName()));
}
public function getBox(MediaInterface $media, array $settings)
{
$size = $media->getBox();
if (null != $settings['height']) {
if ($size->getHeight() > $size->getWidth()) {
$higher = $size->getHeight();
$lower = $size->getWidth();
} else {
$higher = $size->getWidth();
$lower = $size->getHeight();
}
if ($higher - $lower > 0) {
return new Box($lower, $lower);
}
}
$settings['height'] = (int) ($settings['width'] * $size->getHeight() / $size->getWidth());
if ($settings['height'] < $size->getHeight() && $settings['width'] < $size->getWidth()) {
return new Box($settings['width'], $settings['height']);
}
return $size;
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
interface DownloadStrategyInterface
{
public function isGranted(MediaInterface $media, Request $request);
public function getDescription();
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
class ForbiddenDownloadStrategy implements DownloadStrategyInterface
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
return false;
}
public function getDescription()
{
return $this->translator->trans('description.forbidden_download_strategy', array(),'SonataMediaBundle');
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
class PublicDownloadStrategy implements DownloadStrategyInterface
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
return true;
}
public function getDescription()
{
return $this->translator->trans('description.public_download_strategy', array(),'SonataMediaBundle');
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Translation\TranslatorInterface;
class RolesDownloadStrategy implements DownloadStrategyInterface
{
protected $roles;
protected $security;
protected $translator;
public function __construct(TranslatorInterface $translator, SecurityContextInterface $security, array $roles = array())
{
$this->roles = $roles;
$this->security = $security;
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
return $this->security->getToken() && $this->security->isGranted($this->roles);
}
public function getDescription()
{
return $this->translator->trans('description.roles_download_strategy', array('%roles%'=>'<code>'.implode('</code>, <code>', $this->roles).'</code>'),'SonataMediaBundle');
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class SessionDownloadStrategy implements DownloadStrategyInterface
{
protected $container;
protected $translator;
protected $times;
protected $sessionKey ='sonata/media/session/times';
public function __construct(TranslatorInterface $translator, ContainerInterface $container, $times)
{
$this->times = $times;
$this->container = $container;
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
if (!$this->container->has('session')) {
return false;
}
$times = $this->getSession()->get($this->sessionKey, 0);
if ($times >= $this->times) {
return false;
}
$times++;
$this->getSession()->set($this->sessionKey, $times);
return true;
}
public function getDescription()
{
return $this->translator->trans('description.session_download_strategy', array('%times%'=> $this->times),'SonataMediaBundle');
}
private function getSession()
{
return $this->container->get('session');
}
}
}
namespace Symfony\Component\Templating\Helper
{
interface HelperInterface
{
public function getName();
public function setCharset($charset);
public function getCharset();
}
}
namespace Symfony\Component\Templating\Helper
{
abstract class Helper implements HelperInterface
{
protected $charset ='UTF-8';
public function setCharset($charset)
{
$this->charset = $charset;
}
public function getCharset()
{
return $this->charset;
}
}
}
namespace Sonata\MediaBundle\Templating\Helper
{
use Symfony\Component\Templating\Helper\Helper;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\Templating\EngineInterface;
class MediaHelper extends Helper
{
protected $pool = null;
protected $templating = null;
public function __construct(Pool $pool, EngineInterface $templating)
{
$this->pool = $pool;
$this->templating = $templating;
}
public function getName()
{
return'sonata_media';
}
public function media($media, $format, $options = array())
{
if (!$media) {
return'';
}
$provider = $this->getProvider($media);
$format = $provider->getFormatName($media, $format);
$options = $provider->getHelperProperties($media, $format, $options);
return $this->templating->render($provider->getTemplate('helper_view'), array('media'=> $media,'format'=> $format,'options'=> $options,
));
}
private function getProvider(MediaInterface $media)
{
return $this->pool->getProvider($media->getProviderName());
}
public function thumbnail($media, $format, $options = array())
{
if (!$media) {
return'';
}
$provider = $this->getProvider($media);
$format = $provider->getFormatName($media, $format);
$formatDefinition = $provider->getFormat($format);
$options = array_merge(array('title'=> $media->getName(),'width'=> $formatDefinition['width'],
), $options);
$options['src'] = $provider->generatePublicUrl($media, $format);
return $this->getTemplating()->render($provider->getTemplate('helper_thumbnail'), array('media'=> $media,'options'=> $options,
));
}
public function path($media, $format)
{
if (!$media) {
return'';
}
$provider = $this->getProvider($media);
$format = $provider->getFormatName($media, $format);
return $provider->generatePublicUrl($media, $format);
}
}
}
namespace Sonata\MediaBundle\Thumbnail
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
interface ThumbnailInterface
{
public function generatePublicUrl(MediaProviderInterface $provider, MediaInterface $media, $format);
public function generatePrivateUrl(MediaProviderInterface $provider, MediaInterface $media, $format);
public function generate(MediaProviderInterface $provider, MediaInterface $media);
public function delete(MediaProviderInterface $provider, MediaInterface $media);
}
}
namespace Sonata\MediaBundle\Thumbnail
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Sonata\NotificationBundle\Backend\BackendInterface;
class ConsumerThumbnail implements ThumbnailInterface
{
protected $id;
protected $thumbnail;
protected $backend;
public function __construct($id, ThumbnailInterface $thumbnail, BackendInterface $backend)
{
$this->id = $id;
$this->thumbnail = $thumbnail;
$this->backend = $backend;
}
public function generatePublicUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
return $this->thumbnail->generatePrivateUrl($provider, $media, $format);
}
public function generatePrivateUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
return $this->thumbnail->generatePrivateUrl($provider, $media, $format);
}
public function generate(MediaProviderInterface $provider, MediaInterface $media)
{
$this->backend->createAndPublish('sonata.media.create_thumbnail', array('thumbnailId'=> $this->id,'mediaId'=> $media->getId(),'providerReference'=> $media->getProviderReference(),
));
}
public function delete(MediaProviderInterface $provider, MediaInterface $media)
{
return $this->thumbnail->delete($provider, $media);
}
}
}
namespace Sonata\MediaBundle\Thumbnail
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
class FormatThumbnail implements ThumbnailInterface
{
private $defaultFormat;
public function __construct($defaultFormat)
{
$this->defaultFormat = $defaultFormat;
}
public function generatePublicUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
if ($format =='reference') {
$path = $provider->getReferenceImage($media);
} else {
$path = sprintf('%s/thumb_%s_%s.%s', $provider->generatePath($media), $media->getId(), $format, $this->getExtension($media));
}
return $path;
}
public function generatePrivateUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
return sprintf('%s/thumb_%s_%s.%s',
$provider->generatePath($media),
$media->getId(),
$format,
$this->getExtension($media)
);
}
public function generate(MediaProviderInterface $provider, MediaInterface $media)
{
if (!$provider->requireThumbnails()) {
return;
}
$referenceFile = $provider->getReferenceFile($media);
if (!$referenceFile->exists()) {
return;
}
foreach ($provider->getFormats() as $format => $settings) {
if (substr($format, 0, strlen($media->getContext())) == $media->getContext() || $format ==='admin') {
$provider->getResizer()->resize(
$media,
$referenceFile,
$provider->getFilesystem()->get($provider->generatePrivateUrl($media, $format), true),
$this->getExtension($media),
$settings
);
}
}
}
public function delete(MediaProviderInterface $provider, MediaInterface $media)
{
foreach ($provider->getFormats() as $format => $definition) {
$path = $provider->generatePrivateUrl($media, $format);
if ($path && $provider->getFilesystem()->has($path)) {
$provider->getFilesystem()->delete($path);
}
}
}
protected function getExtension(MediaInterface $media)
{
$ext = $media->getExtension();
if (!is_string($ext) || strlen($ext) < 3) {
$ext = $this->defaultFormat;
}
return $ext;
}
}
}
namespace Sonata\MediaBundle\Twig\Extension
{
use Sonata\MediaBundle\Twig\TokenParser\MediaTokenParser;
use Sonata\MediaBundle\Twig\TokenParser\ThumbnailTokenParser;
use Sonata\MediaBundle\Twig\TokenParser\PathTokenParser;
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
class MediaExtension extends \Twig_Extension
{
protected $mediaService;
protected $resources = array();
protected $mediaManager;
protected $environment;
public function __construct(Pool $mediaService, ManagerInterface $mediaManager)
{
$this->mediaService = $mediaService;
$this->mediaManager = $mediaManager;
}
public function getTokenParsers()
{
return array(
new MediaTokenParser($this->getName()),
new ThumbnailTokenParser($this->getName()),
new PathTokenParser($this->getName()),
);
}
public function initRuntime(\Twig_Environment $environment)
{
$this->environment = $environment;
}
public function getName()
{
return'sonata_media';
}
public function media($media = null, $format, $options = array())
{
$media = $this->getMedia($media);
if (!$media) {
return'';
}
$provider = $this
->getMediaService()
->getProvider($media->getProviderName());
$format = $provider->getFormatName($media, $format);
$options = $provider->getHelperProperties($media, $format, $options);
return $this->render($provider->getTemplate('helper_view'), array('media'=> $media,'format'=> $format,'options'=> $options,
));
}
private function getMedia($media)
{
if (!$media instanceof MediaInterface && strlen($media) > 0) {
$media = $this->mediaManager->findOneBy(array('id'=> $media
));
}
if (!$media instanceof MediaInterface) {
return false;
}
if ($media->getProviderStatus() !== MediaInterface::STATUS_OK) {
return false;
}
return $media;
}
public function thumbnail($media = null, $format, $options = array())
{
$media = $this->getMedia($media);
if (!$media) {
return'';
}
$provider = $this->getMediaService()
->getProvider($media->getProviderName());
$format = $provider->getFormatName($media, $format);
$format_definition = $provider->getFormat($format);
$defaultOptions = array('title'=> $media->getName(),
);
if ($format_definition['width']) {
$defaultOptions['width'] = $format_definition['width'];
}
if ($format_definition['height']) {
$defaultOptions['height'] = $format_definition['height'];
}
$options = array_merge($defaultOptions, $options);
$options['src'] = $provider->generatePublicUrl($media, $format);
return $this->render($provider->getTemplate('helper_thumbnail'), array('media'=> $media,'options'=> $options,
));
}
public function render($template, array $parameters = array())
{
if (!isset($this->resources[$template])) {
$this->resources[$template] = $this->environment->loadTemplate($template);
}
return $this->resources[$template]->render($parameters);
}
public function path($media = null, $format)
{
$media = $this->getMedia($media);
if (!$media) {
return'';
}
$provider = $this->getMediaService()
->getProvider($media->getProviderName());
$format = $provider->getFormatName($media, $format);
return $provider->generatePublicUrl($media, $format);
}
public function getMediaService()
{
return $this->mediaService;
}
}
}
namespace
{
interface Twig_NodeInterface extends Countable, IteratorAggregate
{
public function compile(Twig_Compiler $compiler);
public function getLine();
public function getNodeTag();
}
}
namespace
{
class Twig_Node implements Twig_NodeInterface
{
protected $nodes;
protected $attributes;
protected $lineno;
protected $tag;
public function __construct(array $nodes = array(), array $attributes = array(), $lineno = 0, $tag = null)
{
$this->nodes = $nodes;
$this->attributes = $attributes;
$this->lineno = $lineno;
$this->tag = $tag;
}
public function __toString()
{
$attributes = array();
foreach ($this->attributes as $name => $value) {
$attributes[] = sprintf('%s: %s', $name, str_replace("\n",'', var_export($value, true)));
}
$repr = array(get_class($this).'('.implode(', ', $attributes));
if (count($this->nodes)) {
foreach ($this->nodes as $name => $node) {
$len = strlen($name) + 4;
$noderepr = array();
foreach (explode("\n", (string) $node) as $line) {
$noderepr[] = str_repeat(' ', $len).$line;
}
$repr[] = sprintf('  %s: %s', $name, ltrim(implode("\n", $noderepr)));
}
$repr[] =')';
} else {
$repr[0] .=')';
}
return implode("\n", $repr);
}
public function toXml($asDom = false)
{
$dom = new DOMDocument('1.0','UTF-8');
$dom->formatOutput = true;
$dom->appendChild($xml = $dom->createElement('twig'));
$xml->appendChild($node = $dom->createElement('node'));
$node->setAttribute('class', get_class($this));
foreach ($this->attributes as $name => $value) {
$node->appendChild($attribute = $dom->createElement('attribute'));
$attribute->setAttribute('name', $name);
$attribute->appendChild($dom->createTextNode($value));
}
foreach ($this->nodes as $name => $n) {
if (null === $n) {
continue;
}
$child = $n->toXml(true)->getElementsByTagName('node')->item(0);
$child = $dom->importNode($child, true);
$child->setAttribute('name', $name);
$node->appendChild($child);
}
return $asDom ? $dom : $dom->saveXml();
}
public function compile(Twig_Compiler $compiler)
{
foreach ($this->nodes as $node) {
$node->compile($compiler);
}
}
public function getLine()
{
return $this->lineno;
}
public function getNodeTag()
{
return $this->tag;
}
public function hasAttribute($name)
{
return array_key_exists($name, $this->attributes);
}
public function getAttribute($name)
{
if (!array_key_exists($name, $this->attributes)) {
throw new LogicException(sprintf('Attribute "%s" does not exist for Node "%s".', $name, get_class($this)));
}
return $this->attributes[$name];
}
public function setAttribute($name, $value)
{
$this->attributes[$name] = $value;
}
public function removeAttribute($name)
{
unset($this->attributes[$name]);
}
public function hasNode($name)
{
return array_key_exists($name, $this->nodes);
}
public function getNode($name)
{
if (!array_key_exists($name, $this->nodes)) {
throw new LogicException(sprintf('Node "%s" does not exist for Node "%s".', $name, get_class($this)));
}
return $this->nodes[$name];
}
public function setNode($name, $node = null)
{
$this->nodes[$name] = $node;
}
public function removeNode($name)
{
unset($this->nodes[$name]);
}
public function count()
{
return count($this->nodes);
}
public function getIterator()
{
return new ArrayIterator($this->nodes);
}
}
}
namespace Sonata\MediaBundle\Twig\Node
{
class MediaNode extends \Twig_Node
{
protected $extensionName;
public function __construct($extensionName, \Twig_Node_Expression $media, \Twig_Node_Expression $format, \Twig_Node_Expression $attributes, $lineno, $tag = null)
{
$this->extensionName = $extensionName;
parent::__construct(array('media'=> $media,'format'=> $format,'attributes'=> $attributes), array(), $lineno, $tag);
}
public function compile(\Twig_Compiler $compiler)
{
$compiler
->addDebugInfo($this)
->write(sprintf("echo \$this->env->getExtension('%s')->media(", $this->extensionName))
->subcompile($this->getNode('media'))
->raw(', ')
->subcompile($this->getNode('format'))
->raw(', ')
->subcompile($this->getNode('attributes'))
->raw(");\n")
;
}
}
}
namespace Sonata\MediaBundle\Twig\Node
{
class PathNode extends \Twig_Node
{
protected $extensionName;
public function __construct($extensionName, \Twig_Node_Expression $media, \Twig_Node_Expression $format, $lineno, $tag = null)
{
$this->extensionName = $extensionName;
parent::__construct(array('media'=> $media,'format'=> $format), array(), $lineno, $tag);
}
public function compile(\Twig_Compiler $compiler)
{
$compiler
->addDebugInfo($this)
->write(sprintf("echo \$this->env->getExtension('%s')->path(", $this->extensionName))
->subcompile($this->getNode('media'))
->raw(', ')
->subcompile($this->getNode('format'))
->raw(");\n")
;
}
}
}
namespace Sonata\MediaBundle\Twig\Node
{
class ThumbnailNode extends \Twig_Node
{
protected $extensionName;
public function __construct($extensionName, \Twig_Node_Expression $media, \Twig_Node_Expression $format, \Twig_Node_Expression $attributes, $lineno, $tag = null)
{
$this->extensionName = $extensionName;
parent::__construct(array('media'=> $media,'format'=> $format,'attributes'=> $attributes), array(), $lineno, $tag);
}
public function compile(\Twig_Compiler $compiler)
{
$compiler
->addDebugInfo($this)
->write(sprintf("echo \$this->env->getExtension('%s')->thumbnail(", $this->extensionName))
->subcompile($this->getNode('media'))
->raw(', ')
->subcompile($this->getNode('format'))
->raw(', ')
->subcompile($this->getNode('attributes'))
->raw(");\n")
;
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Translator\LabelTranslatorStrategyInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;
use Knp\Menu\FactoryInterface as MenuFactoryInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
interface AdminInterface
{
public function setFormContractor(FormContractorInterface $formContractor);
public function setListBuilder(ListBuilderInterface $listBuilder);
public function getListBuilder();
public function setDatagridBuilder(DatagridBuilderInterface $datagridBuilder);
public function getDatagridBuilder();
public function setTranslator(TranslatorInterface $translator);
public function getTranslator();
public function setRequest(Request $request);
public function setConfigurationPool(Pool $pool);
public function setRouteGenerator(RouteGeneratorInterface $routeGenerator);
public function getClass();
public function attachAdminClass(FieldDescriptionInterface $fieldDescription);
public function getDatagrid();
public function setBaseControllerName($baseControllerName);
public function getBaseControllerName();
public function generateObjectUrl($name, $object, array $parameters = array(), $absolute = false);
public function generateUrl($name, array $parameters = array(), $absolute = false);
public function generateMenuUrl($name, array $parameters = array(), $absolute = false);
public function getModelManager();
public function getManagerType();
public function createQuery($context ='list');
public function getFormBuilder();
public function getFormFieldDescription($name);
public function getFormFieldDescriptions();
public function getForm();
public function getRequest();
public function hasRequest();
public function getCode();
public function getBaseCodeRoute();
public function getSecurityInformation();
public function setParentFieldDescription(FieldDescriptionInterface $parentFieldDescription);
public function getParentFieldDescription();
public function hasParentFieldDescription();
public function trans($id, array $parameters = array(), $domain = null, $locale = null);
public function getRoutes();
public function getRouterIdParameter();
public function getIdParameter();
public function hasShowFieldDescription($name);
public function addShowFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeShowFieldDescription($name);
public function addListFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeListFieldDescription($name);
public function hasFilterFieldDescription($name);
public function addFilterFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeFilterFieldDescription($name);
public function getFilterFieldDescriptions();
public function getList();
public function setSecurityHandler(SecurityHandlerInterface $securityHandler);
public function getSecurityHandler();
public function isGranted($name, $object = null);
public function getUrlsafeIdentifier($entity);
public function getNormalizedIdentifier($entity);
public function id($entity);
public function setValidator(ValidatorInterface $validator);
public function getValidator();
public function getShow();
public function setFormTheme(array $formTheme);
public function getFormTheme();
public function setFilterTheme(array $filterTheme);
public function getFilterTheme();
public function addExtension(AdminExtensionInterface $extension);
public function getExtensions();
public function setMenuFactory(MenuFactoryInterface $menuFactory);
public function getMenuFactory();
public function setRouteBuilder(RouteBuilderInterface $routeBuilder);
public function getRouteBuilder();
public function toString($object);
public function setLabelTranslatorStrategy(LabelTranslatorStrategyInterface $labelTranslatorStrategy);
public function getLabelTranslatorStrategy();
public function supportsPreviewMode();
public function addChild(AdminInterface $child);
public function hasChild($code);
public function getChildren();
public function getChild($code);
public function getNewInstance();
public function setUniqid($uniqId);
public function getUniqid();
public function getObject($id);
public function setSubject($subject);
public function getSubject();
public function getListFieldDescription($name);
public function hasListFieldDescription($name);
public function getListFieldDescriptions();
public function getExportFormats();
public function getDataSourceIterator();
public function configure();
public function update($object);
public function create($object);
public function delete($object);
public function preUpdate($object);
public function postUpdate($object);
public function prePersist($object);
public function postPersist($object);
public function preRemove($object);
public function postRemove($object);
public function preBatchAction($actionName, ProxyQueryInterface $query, array & $idx, $allElements);
public function getFilterParameters();
public function hasSubject();
public function validate(ErrorElement $errorElement, $object);
public function showIn($context);
public function createObjectSecurity($object);
public function getParent();
public function setParent(AdminInterface $admin);
public function isChild();
public function getTemplate($name);
public function setTranslationDomain($translationDomain);
public function getTranslationDomain();
public function getFormGroups();
public function setFormGroups(array $formGroups);
public function getFormTabs();
public function setFormTabs(array $formTabs);
public function getShowTabs();
public function setShowTabs(array $showTabs);
public function removeFieldFromFormGroup($key);
public function getShowGroups();
public function setShowGroups(array $showGroups);
public function reorderShowGroup($group, array $keys);
public function addFormFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeFormFieldDescription($name);
public function isAclEnabled();
public function setSubClasses(array $subClasses);
public function hasSubClass($name);
public function hasActiveSubClass();
public function getActiveSubClass();
public function getActiveSubclassCode();
public function getBatchActions();
public function getLabel();
public function getPersistentParameters();
public function getBreadcrumbs($action);
public function setCurrentChild($currentChild);
public function getCurrentChild();
public function getTranslationLabel($label, $context ='', $type ='');
public function buildSideMenu($action, AdminInterface $childAdmin = null);
public function buildTabMenu($action, AdminInterface $childAdmin = null);
public function getObjectMetadata($object);
}
}
namespace Symfony\Component\Security\Acl\Model
{
interface DomainObjectInterface
{
public function getObjectIdentifier();
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Route\RoutesCache;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Validator\Constraints\InlineConstraint;
use Sonata\AdminBundle\Translator\LabelTranslatorStrategyInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Builder\ShowBuilderInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;
use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Knp\Menu\FactoryInterface as MenuFactoryInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Doctrine\Common\Util\ClassUtils;
abstract class Admin implements AdminInterface, DomainObjectInterface
{
const CONTEXT_MENU ='menu';
const CONTEXT_DASHBOARD ='dashboard';
const CLASS_REGEX ='@([A-Za-z0-9]*)\\\(Bundle\\\)?([A-Za-z0-9]+)Bundle\\\(Entity|Document|Model|PHPCR|CouchDocument|Phpcr|Doctrine\\\Orm|Doctrine\\\Phpcr|Doctrine\\\MongoDB|Doctrine\\\CouchDB)\\\(.*)@';
private $class;
private $subClasses = array();
private $list;
protected $listFieldDescriptions = array();
private $show;
protected $showFieldDescriptions = array();
private $form;
protected $formFieldDescriptions = array();
private $filter;
protected $filterFieldDescriptions = array();
protected $maxPerPage = 25;
protected $maxPageLinks = 25;
protected $baseRouteName;
protected $baseRoutePattern;
protected $baseControllerName;
private $formGroups = false;
private $formTabs = false;
private $showGroups = false;
private $showTabs = false;
protected $classnameLabel;
protected $translationDomain ='messages';
protected $formOptions = array();
protected $datagridValues = array('_page'=> 1,'_per_page'=> 25,
);
protected $perPageOptions = array(15, 25, 50, 100, 150, 200);
protected $code;
protected $label;
protected $persistFilters = false;
protected $routes;
protected $subject;
protected $children = array();
protected $parent = null;
protected $baseCodeRoute ='';
protected $parentAssociationMapping = null;
protected $parentFieldDescription;
protected $currentChild = false;
protected $uniqid;
protected $modelManager;
private $managerType;
protected $request;
protected $translator;
protected $formContractor;
protected $listBuilder;
protected $showBuilder;
protected $datagridBuilder;
protected $routeBuilder;
protected $datagrid;
protected $routeGenerator;
protected $breadcrumbs = array();
protected $securityHandler = null;
protected $validator = null;
protected $configurationPool;
protected $menu;
protected $menuFactory;
protected $loaded = array('view_fields'=> false,'view_groups'=> false,'routes'=> false,'tab_menu'=> false,
);
protected $formTheme = array();
protected $filterTheme = array();
protected $templates = array();
protected $extensions = array();
protected $labelTranslatorStrategy;
protected $supportsPreviewMode = false;
protected $securityInformation = array();
protected $cacheIsGranted = array();
protected function configureFormFields(FormMapper $form)
{
}
protected function configureListFields(ListMapper $list)
{
}
protected function configureDatagridFilters(DatagridMapper $filter)
{
}
protected function configureShowFields(ShowMapper $filter)
{
}
protected function configureRoutes(RouteCollection $collection)
{
}
protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
}
protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
$this->configureSideMenu($menu, $action, $childAdmin);
}
public function getExportFormats()
{
return array('json','xml','csv','xls');
}
public function getExportFields()
{
return $this->getModelManager()->getExportFields($this->getClass());
}
public function getDataSourceIterator()
{
$datagrid = $this->getDatagrid();
$datagrid->buildPager();
return $this->getModelManager()->getDataSourceIterator($datagrid, $this->getExportFields());
}
public function validate(ErrorElement $errorElement, $object)
{
}
public function __construct($code, $class, $baseControllerName)
{
$this->code = $code;
$this->class = $class;
$this->baseControllerName = $baseControllerName;
$this->predefinePerPageOptions();
$this->datagridValues['_per_page'] = $this->maxPerPage;
}
public function initialize()
{
if (!$this->classnameLabel) {
$this->classnameLabel = substr($this->getClass(), strrpos($this->getClass(),'\\') + 1);
}
$this->baseCodeRoute = $this->getCode();
$this->configure();
}
public function configure()
{
}
public function update($object)
{
$this->preUpdate($object);
foreach ($this->extensions as $extension) {
$extension->preUpdate($this, $object);
}
$result = $this->getModelManager()->update($object);
if (null !== $result) {
$object = $result;
}
$this->postUpdate($object);
foreach ($this->extensions as $extension) {
$extension->postUpdate($this, $object);
}
return $object;
}
public function create($object)
{
$this->prePersist($object);
foreach ($this->extensions as $extension) {
$extension->prePersist($this, $object);
}
$result = $this->getModelManager()->create($object);
if (null !== $result) {
$object = $result;
}
$this->postPersist($object);
foreach ($this->extensions as $extension) {
$extension->postPersist($this, $object);
}
$this->createObjectSecurity($object);
return $object;
}
public function delete($object)
{
$this->preRemove($object);
foreach ($this->extensions as $extension) {
$extension->preRemove($this, $object);
}
$this->getSecurityHandler()->deleteObjectSecurity($this, $object);
$this->getModelManager()->delete($object);
$this->postRemove($object);
foreach ($this->extensions as $extension) {
$extension->postRemove($this, $object);
}
}
public function preUpdate($object)
{}
public function postUpdate($object)
{}
public function prePersist($object)
{}
public function postPersist($object)
{}
public function preRemove($object)
{}
public function postRemove($object)
{}
public function preBatchAction($actionName, ProxyQueryInterface $query, array & $idx, $allElements)
{
}
protected function buildShow()
{
if ($this->show) {
return;
}
$this->show = new FieldDescriptionCollection();
$mapper = new ShowMapper($this->showBuilder, $this->show, $this);
$this->configureShowFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureShowFields($mapper);
}
}
protected function buildList()
{
if ($this->list) {
return;
}
$this->list = $this->getListBuilder()->getBaseList();
$mapper = new ListMapper($this->getListBuilder(), $this->list, $this);
if (count($this->getBatchActions()) > 0) {
$fieldDescription = $this->getModelManager()->getNewFieldDescriptionInstance($this->getClass(),'batch', array('label'=>'batch','code'=>'_batch','sortable'=> false
));
$fieldDescription->setAdmin($this);
$fieldDescription->setTemplate($this->getTemplate('batch'));
$mapper->add($fieldDescription,'batch');
}
$this->configureListFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureListFields($mapper);
}
if ($this->hasRequest() && $this->getRequest()->isXmlHttpRequest()) {
$fieldDescription = $this->getModelManager()->getNewFieldDescriptionInstance($this->getClass(),'select', array('label'=> false,'code'=>'_select','sortable'=> false,
));
$fieldDescription->setAdmin($this);
$fieldDescription->setTemplate($this->getTemplate('select'));
$mapper->add($fieldDescription,'select');
}
}
public function getFilterParameters()
{
$parameters = array();
if ($this->hasRequest()) {
$filters = $this->request->query->get('filter', array());
if ($this->persistFilters) {
if ($filters == array() && $this->request->query->get('filters') !='reset') {
$filters = $this->request->getSession()->get($this->getCode().'.filter.parameters', array());
} else {
$this->request->getSession()->set($this->getCode().'.filter.parameters', $filters);
}
}
$parameters = array_merge(
$this->getModelManager()->getDefaultSortValues($this->getClass()),
$this->datagridValues,
$filters
);
if (!$this->determinedPerPageValue($parameters['_per_page'])) {
$parameters['_per_page'] = $this->maxPerPage;
}
if ($this->isChild() && $this->getParentAssociationMapping()) {
$name = str_replace('.','__', $this->getParentAssociationMapping());
$parameters[$name] = array('value'=> $this->request->get($this->getParent()->getIdParameter()));
}
}
return $parameters;
}
public function buildDatagrid()
{
if ($this->datagrid) {
return;
}
$filterParameters = $this->getFilterParameters();
if (isset($filterParameters['_sort_by']) && is_string($filterParameters['_sort_by'])) {
if ($this->hasListFieldDescription($filterParameters['_sort_by'])) {
$filterParameters['_sort_by'] = $this->getListFieldDescription($filterParameters['_sort_by']);
} else {
$filterParameters['_sort_by'] = $this->getModelManager()->getNewFieldDescriptionInstance(
$this->getClass(),
$filterParameters['_sort_by'],
array()
);
$this->getListBuilder()->buildField(null, $filterParameters['_sort_by'], $this);
}
}
$this->datagrid = $this->getDatagridBuilder()->getBaseDatagrid($this, $filterParameters);
$this->datagrid->getPager()->setMaxPageLinks($this->maxPageLinks);
$mapper = new DatagridMapper($this->getDatagridBuilder(), $this->datagrid, $this);
$this->configureDatagridFilters($mapper);
if ($this->isChild() && $this->getParentAssociationMapping() && !$mapper->has($this->getParentAssociationMapping())) {
$mapper->add($this->getParentAssociationMapping(), null, array('label'=> false,'field_type'=>'sonata_type_model_hidden','field_options'=> array('model_manager'=> $this->getModelManager()
),'operator_type'=>'hidden'));
}
foreach ($this->getExtensions() as $extension) {
$extension->configureDatagridFilters($mapper);
}
}
public function getParentAssociationMapping()
{
return $this->parentAssociationMapping;
}
protected function buildForm()
{
if ($this->form) {
return;
}
if ($this->isChild() && $this->getParentAssociationMapping()) {
$parent = $this->getParent()->getObject($this->request->get($this->getParent()->getIdParameter()));
$propertyAccessor = PropertyAccess::createPropertyAccessor();
$propertyPath = new PropertyPath($this->getParentAssociationMapping());
$object = $this->getSubject();
$value = $propertyAccessor->getValue($object, $propertyPath);
if (is_array($value) || ($value instanceof \Traversable && $value instanceof \ArrayAccess)) {
$value[] = $parent;
$propertyAccessor->setValue($object, $propertyPath, $value);
} else {
$propertyAccessor->setValue($object, $propertyPath, $parent);
}
}
$this->form = $this->getFormBuilder()->getForm();
}
public function getBaseRoutePattern()
{
if (!$this->baseRoutePattern) {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Please define a default `baseRoutePattern` value for the admin class `%s`', get_class($this)));
}
if ($this->isChild()) { $this->baseRoutePattern = sprintf('%s/{id}/%s',
$this->getParent()->getBaseRoutePattern(),
$this->urlize($matches[5],'-')
);
} else {
$this->baseRoutePattern = sprintf('/%s/%s/%s',
$this->urlize($matches[1],'-'),
$this->urlize($matches[3],'-'),
$this->urlize($matches[5],'-')
);
}
}
return $this->baseRoutePattern;
}
public function getBaseRouteName()
{
if (!$this->baseRouteName) {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Cannot automatically determine base route name, please define a default `baseRouteName` value for the admin class `%s`', get_class($this)));
}
if ($this->isChild()) { $this->baseRouteName = sprintf('%s_%s',
$this->getParent()->getBaseRouteName(),
$this->urlize($matches[5])
);
} else {
$this->baseRouteName = sprintf('admin_%s_%s_%s',
$this->urlize($matches[1]),
$this->urlize($matches[3]),
$this->urlize($matches[5])
);
}
}
return $this->baseRouteName;
}
public function urlize($word, $sep ='_')
{
return strtolower(preg_replace('/[^a-z0-9_]/i', $sep.'$1', $word));
}
public function getClass()
{
if ($this->hasSubject() && is_object($this->getSubject())) {
return ClassUtils::getClass($this->getSubject());
}
if (!$this->hasActiveSubClass()) {
if (count($this->getSubClasses()) > 0) {
$subject = $this->getSubject();
if ($subject && is_object($subject)) {
return ClassUtils::getClass($subject);
}
}
return $this->class;
}
if ($this->getParentFieldDescription() && $this->hasActiveSubClass()) {
throw new \RuntimeException('Feature not implemented: an embedded admin cannot have subclass');
}
$subClass = $this->getRequest()->query->get('subclass');
return $this->getSubClass($subClass);
}
public function getSubClasses()
{
return $this->subClasses;
}
public function setSubClasses(array $subClasses)
{
$this->subClasses = $subClasses;
}
protected function getSubClass($name)
{
if ($this->hasSubClass($name)) {
return $this->subClasses[$name];
}
throw new \RuntimeException(sprintf('Unable to find the subclass `%s` for admin `%s`', $name, get_class($this)));
}
public function hasSubClass($name)
{
return isset($this->subClasses[$name]);
}
public function hasActiveSubClass()
{
if (count($this->subClasses) > 0 && $this->request) {
return null !== $this->getRequest()->query->get('subclass');
}
return false;
}
public function getActiveSubClass()
{
if (!$this->hasActiveSubClass()) {
return null;
}
return $this->getClass();
}
public function getActiveSubclassCode()
{
if (!$this->hasActiveSubClass()) {
return null;
}
$subClass = $this->getRequest()->query->get('subclass');
if (!$this->hasSubClass($subClass)) {
return null;
}
return $subClass;
}
public function getBatchActions()
{
$actions = array();
if ($this->hasRoute('delete') && $this->isGranted('DELETE')) {
$actions['delete'] = array('label'=> $this->trans('action_delete', array(),'SonataAdminBundle'),'ask_confirmation'=> true, );
}
return $actions;
}
public function getRoutes()
{
$this->buildRoutes();
return $this->routes;
}
public function getRouterIdParameter()
{
return $this->isChild() ?'{childId}':'{id}';
}
public function getIdParameter()
{
return $this->isChild() ?'childId':'id';
}
private function buildRoutes()
{
if ($this->loaded['routes']) {
return;
}
$this->loaded['routes'] = true;
$this->routes = new RouteCollection(
$this->getBaseCodeRoute(),
$this->getBaseRouteName(),
$this->getBaseRoutePattern(),
$this->getBaseControllerName()
);
$this->routeBuilder->build($this, $this->routes);
$this->configureRoutes($this->routes);
foreach ($this->getExtensions() as $extension) {
$extension->configureRoutes($this, $this->routes);
}
}
public function hasRoute($name)
{
if (!$this->routeGenerator) {
throw new \RuntimeException('RouteGenerator cannot be null');
}
return $this->routeGenerator->hasAdminRoute($this, $name);
}
public function generateObjectUrl($name, $object, array $parameters = array(), $absolute = false)
{
$parameters['id'] = $this->getUrlsafeIdentifier($object);
return $this->generateUrl($name, $parameters, $absolute);
}
public function generateUrl($name, array $parameters = array(), $absolute = false)
{
return $this->routeGenerator->generateUrl($this, $name, $parameters, $absolute);
}
public function generateMenuUrl($name, array $parameters = array(), $absolute = false)
{
return $this->routeGenerator->generateMenuUrl($this, $name,$parameters, $absolute);
}
public function setTemplates(array $templates)
{
$this->templates = $templates;
}
public function setTemplate($name, $template)
{
$this->templates[$name] = $template;
}
public function getTemplates()
{
return $this->templates;
}
public function getTemplate($name)
{
if (isset($this->templates[$name])) {
return $this->templates[$name];
}
return null;
}
public function getNewInstance()
{
$object = $this->getModelManager()->getModelInstance($this->getClass());
foreach ($this->getExtensions() as $extension) {
$extension->alterNewInstance($this, $object);
}
return $object;
}
public function getFormBuilder()
{
$this->formOptions['data_class'] = $this->getClass();
$formBuilder = $this->getFormContractor()->getFormBuilder(
$this->getUniqid(),
$this->formOptions
);
$this->defineFormBuilder($formBuilder);
return $formBuilder;
}
public function defineFormBuilder(FormBuilder $formBuilder)
{
$mapper = new FormMapper($this->getFormContractor(), $formBuilder, $this);
$this->configureFormFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureFormFields($mapper);
}
$this->attachInlineValidator();
}
protected function attachInlineValidator()
{
$admin = $this;
$metadata = $this->validator->getMetadataFactory()->getMetadataFor($this->getClass());
$metadata->addConstraint(new InlineConstraint(array('service'=> $this,'method'=> function(ErrorElement $errorElement, $object) use ($admin) {
if ($admin->hasSubject() && spl_object_hash($object) !== spl_object_hash($admin->getSubject())) {
return;
}
$admin->validate($errorElement, $object);
foreach ($admin->getExtensions() as $extension) {
$extension->validate($admin, $errorElement, $object);
}
}
)));
}
public function attachAdminClass(FieldDescriptionInterface $fieldDescription)
{
$pool = $this->getConfigurationPool();
$adminCode = $fieldDescription->getOption('admin_code');
if ($adminCode !== null) {
$admin = $pool->getAdminByAdminCode($adminCode);
} else {
$admin = $pool->getAdminByClass($fieldDescription->getTargetEntity());
}
if (!$admin) {
return;
}
if ($this->hasRequest()) {
$admin->setRequest($this->getRequest());
}
$fieldDescription->setAssociationAdmin($admin);
}
public function getObject($id)
{
$object = $this->getModelManager()->find($this->getClass(), $id);
foreach ($this->getExtensions() as $extension) {
$extension->alterObject($this, $object);
}
return $object;
}
public function getForm()
{
$this->buildForm();
return $this->form;
}
public function getList()
{
$this->buildList();
return $this->list;
}
public function createQuery($context ='list')
{
$query = $this->getModelManager()->createQuery($this->class);
foreach ($this->extensions as $extension) {
$extension->configureQuery($this, $query, $context);
}
return $query;
}
public function getDatagrid()
{
$this->buildDatagrid();
return $this->datagrid;
}
public function buildTabMenu($action, AdminInterface $childAdmin = null)
{
if ($this->loaded['tab_menu']) {
return;
}
$this->loaded['tab_menu'] = true;
$menu = $this->menuFactory->createItem('root');
$menu->setChildrenAttribute('class','nav navbar-nav');
if (method_exists($menu,"setCurrentUri")) {
$menu->setCurrentUri($this->getRequest()->getBaseUrl().$this->getRequest()->getPathInfo());
}
$this->configureTabMenu($menu, $action, $childAdmin);
foreach ($this->getExtensions() as $extension) {
$extension->configureTabMenu($this, $menu, $action, $childAdmin);
}
$this->menu = $menu;
}
public function buildSideMenu($action, AdminInterface $childAdmin = null)
{
return $this->buildTabMenu($action, $childAdmin);
}
public function getSideMenu($action, AdminInterface $childAdmin = null)
{
if ($this->isChild()) {
return $this->getParent()->getSideMenu($action, $this);
}
$this->buildSideMenu($action, $childAdmin);
return $this->menu;
}
public function getRootCode()
{
return $this->getRoot()->getCode();
}
public function getRoot()
{
$parentFieldDescription = $this->getParentFieldDescription();
if (!$parentFieldDescription) {
return $this;
}
return $parentFieldDescription->getAdmin()->getRoot();
}
public function setBaseControllerName($baseControllerName)
{
$this->baseControllerName = $baseControllerName;
}
public function getBaseControllerName()
{
return $this->baseControllerName;
}
public function setLabel($label)
{
$this->label = $label;
}
public function getLabel()
{
return $this->label;
}
public function setPersistFilters($persist)
{
$this->persistFilters = $persist;
}
public function setMaxPerPage($maxPerPage)
{
$this->maxPerPage = $maxPerPage;
}
public function getMaxPerPage()
{
return $this->maxPerPage;
}
public function setMaxPageLinks($maxPageLinks)
{
$this->maxPageLinks = $maxPageLinks;
}
public function getMaxPageLinks()
{
return $this->maxPageLinks;
}
public function getFormGroups()
{
return $this->formGroups;
}
public function setFormGroups(array $formGroups)
{
$this->formGroups = $formGroups;
}
public function removeFieldFromFormGroup($key)
{
foreach ($this->formGroups as $name => $formGroup) {
unset($this->formGroups[$name]['fields'][$key]);
if (empty($this->formGroups[$name]['fields'])) {
unset($this->formGroups[$name]);
}
}
}
public function reorderFormGroup($group, array $keys)
{
$formGroups = $this->getFormGroups();
$formGroups[$group]['fields'] = array_merge(array_flip($keys), $formGroups[$group]['fields']);
$this->setFormGroups($formGroups);
}
public function getFormTabs()
{
return $this->formTabs;
}
public function setFormTabs(array $formTabs)
{
$this->formTabs = $formTabs;
}
public function getShowTabs()
{
return $this->showTabs;
}
public function setShowTabs(array $showTabs)
{
$this->showTabs = $showTabs;
}
public function getShowGroups()
{
return $this->showGroups;
}
public function setShowGroups(array $showGroups)
{
$this->showGroups = $showGroups;
}
public function reorderShowGroup($group, array $keys)
{
$showGroups = $this->getShowGroups();
$showGroups[$group]['fields'] = array_merge(array_flip($keys), $showGroups[$group]['fields']);
$this->setShowGroups($showGroups);
}
public function setParentFieldDescription(FieldDescriptionInterface $parentFieldDescription)
{
$this->parentFieldDescription = $parentFieldDescription;
}
public function getParentFieldDescription()
{
return $this->parentFieldDescription;
}
public function hasParentFieldDescription()
{
return $this->parentFieldDescription instanceof FieldDescriptionInterface;
}
public function setSubject($subject)
{
$this->subject = $subject;
}
public function getSubject()
{
if ($this->subject === null && $this->request) {
$id = $this->request->get($this->getIdParameter());
if (!preg_match('#^[0-9A-Fa-f]+$#', $id)) {
$this->subject = false;
} else {
$this->subject = $this->getModelManager()->find($this->class, $id);
}
}
return $this->subject;
}
public function hasSubject()
{
return $this->subject != null;
}
public function getFormFieldDescriptions()
{
$this->buildForm();
return $this->formFieldDescriptions;
}
public function getFormFieldDescription($name)
{
return $this->hasFormFieldDescription($name) ? $this->formFieldDescriptions[$name] : null;
}
public function hasFormFieldDescription($name)
{
return array_key_exists($name, $this->formFieldDescriptions) ? true : false;
}
public function addFormFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->formFieldDescriptions[$name] = $fieldDescription;
}
public function removeFormFieldDescription($name)
{
unset($this->formFieldDescriptions[$name]);
}
public function getShowFieldDescriptions()
{
$this->buildShow();
return $this->showFieldDescriptions;
}
public function getShowFieldDescription($name)
{
$this->buildShow();
return $this->hasShowFieldDescription($name) ? $this->showFieldDescriptions[$name] : null;
}
public function hasShowFieldDescription($name)
{
return array_key_exists($name, $this->showFieldDescriptions);
}
public function addShowFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->showFieldDescriptions[$name] = $fieldDescription;
}
public function removeShowFieldDescription($name)
{
unset($this->showFieldDescriptions[$name]);
}
public function getListFieldDescriptions()
{
$this->buildList();
return $this->listFieldDescriptions;
}
public function getListFieldDescription($name)
{
return $this->hasListFieldDescription($name) ? $this->listFieldDescriptions[$name] : null;
}
public function hasListFieldDescription($name)
{
$this->buildList();
return array_key_exists($name, $this->listFieldDescriptions) ? true : false;
}
public function addListFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->listFieldDescriptions[$name] = $fieldDescription;
}
public function removeListFieldDescription($name)
{
unset($this->listFieldDescriptions[$name]);
}
public function getFilterFieldDescription($name)
{
return $this->hasFilterFieldDescription($name) ? $this->filterFieldDescriptions[$name] : null;
}
public function hasFilterFieldDescription($name)
{
return array_key_exists($name, $this->filterFieldDescriptions) ? true : false;
}
public function addFilterFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->filterFieldDescriptions[$name] = $fieldDescription;
}
public function removeFilterFieldDescription($name)
{
unset($this->filterFieldDescriptions[$name]);
}
public function getFilterFieldDescriptions()
{
$this->buildDatagrid();
return $this->filterFieldDescriptions;
}
public function addChild(AdminInterface $child)
{
$this->children[$child->getCode()] = $child;
$child->setBaseCodeRoute($this->getCode().'|'.$child->getCode());
$child->setParent($this);
}
public function hasChild($code)
{
return isset($this->children[$code]);
}
public function getChildren()
{
return $this->children;
}
public function getChild($code)
{
return $this->hasChild($code) ? $this->children[$code] : null;
}
public function setParent(AdminInterface $parent)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function isChild()
{
return $this->parent instanceof AdminInterface;
}
public function hasChildren()
{
return count($this->children) > 0;
}
public function setUniqid($uniqid)
{
$this->uniqid = $uniqid;
}
public function getUniqid()
{
if (!$this->uniqid) {
$this->uniqid ="s".uniqid();
}
return $this->uniqid;
}
public function getClassnameLabel()
{
return $this->classnameLabel;
}
public function getPersistentParameters()
{
$parameters = array();
foreach ($this->getExtensions() as $extension) {
$params = $extension->getPersistentParameters($this);
if (!is_array($params)) {
throw new \RuntimeException(sprintf('The %s::getPersistentParameters must return an array', get_class($extension)));
}
$parameters = array_merge($parameters, $params);
}
return $parameters;
}
public function getPersistentParameter($name)
{
$parameters = $this->getPersistentParameters();
return isset($parameters[$name]) ? $parameters[$name] : null;
}
public function getBreadcrumbs($action)
{
if ($this->isChild()) {
return $this->getParent()->getBreadcrumbs($action);
}
$menu = $this->buildBreadcrumbs($action);
do {
$breadcrumbs[] = $menu;
} while ($menu = $menu->getParent());
$breadcrumbs = array_reverse($breadcrumbs);
array_shift($breadcrumbs);
return $breadcrumbs;
}
public function buildBreadcrumbs($action, MenuItemInterface $menu = null)
{
if (isset($this->breadcrumbs[$action])) {
return $this->breadcrumbs[$action];
}
if (!$menu) {
$menu = $this->menuFactory->createItem('root');
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel('dashboard','breadcrumb','link'), array(),'SonataAdminBundle'),
array('uri'=> $this->routeGenerator->generate('sonata_admin_dashboard'))
);
}
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_list', $this->getClassnameLabel()),'breadcrumb','link')),
array('uri'=> $this->hasRoute('list') && $this->isGranted('LIST') ? $this->generateUrl('list') : null)
);
$childAdmin = $this->getCurrentChildAdmin();
if ($childAdmin) {
$id = $this->request->get($this->getIdParameter());
$menu = $menu->addChild(
$this->toString($this->getSubject()),
array('uri'=> $this->hasRoute('edit') && $this->isGranted('EDIT') ? $this->generateUrl('edit', array('id'=> $id)) : null)
);
return $childAdmin->buildBreadcrumbs($action, $menu);
} elseif ($this->isChild()) {
if ($action =='list') {
$menu->setUri(false);
} elseif ($action !='create'&& $this->hasSubject()) {
$menu = $menu->addChild($this->toString($this->getSubject()));
} else {
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_%s', $this->getClassnameLabel(), $action),'breadcrumb','link'))
);
}
} elseif ($action !='list'&& $this->hasSubject()) {
$menu = $menu->addChild($this->toString($this->getSubject()));
} elseif ($action !='list') {
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_%s', $this->getClassnameLabel(), $action),'breadcrumb','link'))
);
}
return $this->breadcrumbs[$action] = $menu;
}
public function setCurrentChild($currentChild)
{
$this->currentChild = $currentChild;
}
public function getCurrentChild()
{
return $this->currentChild;
}
public function getCurrentChildAdmin()
{
foreach ($this->children as $children) {
if ($children->getCurrentChild()) {
return $children;
}
}
return null;
}
public function trans($id, array $parameters = array(), $domain = null, $locale = null)
{
$domain = $domain ?: $this->getTranslationDomain();
if (!$this->translator) {
return $id;
}
return $this->translator->trans($id, $parameters, $domain, $locale);
}
public function transChoice($id, $count, array $parameters = array(), $domain = null, $locale = null)
{
$domain = $domain ?: $this->getTranslationDomain();
if (!$this->translator) {
return $id;
}
return $this->translator->transChoice($id, $count, $parameters, $domain, $locale);
}
public function setTranslationDomain($translationDomain)
{
$this->translationDomain = $translationDomain;
}
public function getTranslationDomain()
{
return $this->translationDomain;
}
public function setTranslator(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getTranslator()
{
return $this->translator;
}
public function getTranslationLabel($label, $context ='', $type ='')
{
return $this->getLabelTranslatorStrategy()->getLabel($label, $context, $type);
}
public function setRequest(Request $request)
{
$this->request = $request;
foreach ($this->getChildren() as $children) {
$children->setRequest($request);
}
}
public function getRequest()
{
if (!$this->request) {
throw new \RuntimeException('The Request object has not been set');
}
return $this->request;
}
public function hasRequest()
{
return $this->request !== null;
}
public function setFormContractor(FormContractorInterface $formBuilder)
{
$this->formContractor = $formBuilder;
}
public function getFormContractor()
{
return $this->formContractor;
}
public function setDatagridBuilder(DatagridBuilderInterface $datagridBuilder)
{
$this->datagridBuilder = $datagridBuilder;
}
public function getDatagridBuilder()
{
return $this->datagridBuilder;
}
public function setListBuilder(ListBuilderInterface $listBuilder)
{
$this->listBuilder = $listBuilder;
}
public function getListBuilder()
{
return $this->listBuilder;
}
public function setShowBuilder(ShowBuilderInterface $showBuilder)
{
$this->showBuilder = $showBuilder;
}
public function getShowBuilder()
{
return $this->showBuilder;
}
public function setConfigurationPool(Pool $configurationPool)
{
$this->configurationPool = $configurationPool;
}
public function getConfigurationPool()
{
return $this->configurationPool;
}
public function setRouteGenerator(RouteGeneratorInterface $routeGenerator)
{
$this->routeGenerator = $routeGenerator;
}
public function getRouteGenerator()
{
return $this->routeGenerator;
}
public function getCode()
{
return $this->code;
}
public function setBaseCodeRoute($baseCodeRoute)
{
$this->baseCodeRoute = $baseCodeRoute;
}
public function getBaseCodeRoute()
{
return $this->baseCodeRoute;
}
public function getModelManager()
{
return $this->modelManager;
}
public function setModelManager(ModelManagerInterface $modelManager)
{
$this->modelManager = $modelManager;
}
public function getManagerType()
{
return $this->managerType;
}
public function setManagerType($type)
{
$this->managerType = $type;
}
public function getObjectIdentifier()
{
return $this->getCode();
}
public function setSecurityInformation(array $information)
{
$this->securityInformation = $information;
}
public function getSecurityInformation()
{
return $this->securityInformation;
}
public function getPermissionsShow($context)
{
switch ($context) {
case self::CONTEXT_DASHBOARD:
case self::CONTEXT_MENU:
default:
return array('LIST');
}
}
public function showIn($context)
{
switch ($context) {
case self::CONTEXT_DASHBOARD:
case self::CONTEXT_MENU:
default:
return $this->isGranted($this->getPermissionsShow($context));
}
}
public function createObjectSecurity($object)
{
$this->getSecurityHandler()->createObjectSecurity($this, $object);
}
public function setSecurityHandler(SecurityHandlerInterface $securityHandler)
{
$this->securityHandler = $securityHandler;
}
public function getSecurityHandler()
{
return $this->securityHandler;
}
public function isGranted($name, $object = null)
{
$key = md5(json_encode($name) . ($object ?'/'.spl_object_hash($object) :''));
if (!array_key_exists($key, $this->cacheIsGranted)) {
$this->cacheIsGranted[$key] = $this->securityHandler->isGranted($this, $name, $object ?: $this);
}
return $this->cacheIsGranted[$key];
}
public function getUrlsafeIdentifier($entity)
{
return $this->getModelManager()->getUrlsafeIdentifier($entity);
}
public function getNormalizedIdentifier($entity)
{
return $this->getModelManager()->getNormalizedIdentifier($entity);
}
public function id($entity)
{
return $this->getNormalizedIdentifier($entity);
}
public function setValidator(ValidatorInterface $validator)
{
$this->validator = $validator;
}
public function getValidator()
{
return $this->validator;
}
public function getShow()
{
$this->buildShow();
return $this->show;
}
public function setFormTheme(array $formTheme)
{
$this->formTheme = $formTheme;
}
public function getFormTheme()
{
return $this->formTheme;
}
public function setFilterTheme(array $filterTheme)
{
$this->filterTheme = $filterTheme;
}
public function getFilterTheme()
{
return $this->filterTheme;
}
public function addExtension(AdminExtensionInterface $extension)
{
$this->extensions[] = $extension;
}
public function getExtensions()
{
return $this->extensions;
}
public function setMenuFactory(MenuFactoryInterface $menuFactory)
{
$this->menuFactory = $menuFactory;
}
public function getMenuFactory()
{
return $this->menuFactory;
}
public function setRouteBuilder(RouteBuilderInterface $routeBuilder)
{
$this->routeBuilder = $routeBuilder;
}
public function getRouteBuilder()
{
return $this->routeBuilder;
}
public function toString($object)
{
if (!is_object($object)) {
return'';
}
if (method_exists($object,'__toString') && null !== $object->__toString()) {
return (string) $object;
}
return sprintf("%s:%s", ClassUtils::getClass($object), spl_object_hash($object));
}
public function setLabelTranslatorStrategy(LabelTranslatorStrategyInterface $labelTranslatorStrategy)
{
$this->labelTranslatorStrategy = $labelTranslatorStrategy;
}
public function getLabelTranslatorStrategy()
{
return $this->labelTranslatorStrategy;
}
public function supportsPreviewMode()
{
return $this->supportsPreviewMode;
}
public function setPerPageOptions(array $options)
{
$this->perPageOptions = $options;
}
public function getPerPageOptions()
{
return $this->perPageOptions;
}
public function determinedPerPageValue($perPage)
{
return in_array($perPage, $this->perPageOptions);
}
protected function predefinePerPageOptions()
{
array_unshift($this->perPageOptions, $this->maxPerPage);
$this->perPageOptions = array_unique($this->perPageOptions);
sort($this->perPageOptions);
}
public function isAclEnabled()
{
return $this->getSecurityHandler() instanceof AclSecurityHandlerInterface;
}
public function getObjectMetadata($object)
{
return new Metadata($this->toString($object));
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
interface AdminExtensionInterface
{
public function configureFormFields(FormMapper $form);
public function configureListFields(ListMapper $list);
public function configureDatagridFilters(DatagridMapper $filter);
public function configureShowFields(ShowMapper $filter);
public function configureRoutes(AdminInterface $admin, RouteCollection $collection);
public function configureSideMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null);
public function configureTabMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null);
public function validate(AdminInterface $admin, ErrorElement $errorElement, $object);
public function configureQuery(AdminInterface $admin, ProxyQueryInterface $query, $context ='list');
public function alterNewInstance(AdminInterface $admin, $object);
public function alterObject(AdminInterface $admin, $object);
public function getPersistentParameters(AdminInterface $admin);
public function preUpdate(AdminInterface $admin, $object);
public function postUpdate(AdminInterface $admin, $object);
public function prePersist(AdminInterface $admin, $object);
public function postPersist(AdminInterface $admin, $object);
public function preRemove(AdminInterface $admin, $object);
public function postRemove(AdminInterface $admin, $object);
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
abstract class AdminExtension implements AdminExtensionInterface
{
public function configureFormFields(FormMapper $form)
{}
public function configureListFields(ListMapper $list)
{}
public function configureDatagridFilters(DatagridMapper $filter)
{}
public function configureShowFields(ShowMapper $filter)
{}
public function configureRoutes(AdminInterface $admin, RouteCollection $collection)
{}
public function configureSideMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{}
public function configureTabMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
$this->configureSideMenu($admin, $menu, $action, $childAdmin);
}
public function validate(AdminInterface $admin, ErrorElement $errorElement, $object)
{}
public function configureQuery(AdminInterface $admin, ProxyQueryInterface $query, $context ='list')
{}
public function alterNewInstance(AdminInterface $admin, $object)
{}
public function alterObject(AdminInterface $admin, $object)
{}
public function getPersistentParameters(AdminInterface $admin)
{
return array();
}
public function preUpdate(AdminInterface $admin, $object)
{}
public function postUpdate(AdminInterface $admin, $object)
{}
public function prePersist(AdminInterface $admin, $object)
{}
public function postPersist(AdminInterface $admin, $object)
{}
public function preRemove(AdminInterface $admin, $object)
{}
public function postRemove(AdminInterface $admin, $object)
{}
}
}
namespace Sonata\AdminBundle\Admin
{
use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Sonata\AdminBundle\Exception\NoValueException;
use Sonata\AdminBundle\Util\FormViewIterator;
use Sonata\AdminBundle\Util\FormBuilderIterator;
use Sonata\AdminBundle\Admin\BaseFieldDescription;
class AdminHelper
{
protected $pool;
public function __construct(Pool $pool)
{
$this->pool = $pool;
}
public function getChildFormBuilder(FormBuilder $formBuilder, $elementId)
{
foreach (new FormBuilderIterator($formBuilder) as $name => $formBuilder) {
if ($name == $elementId) {
return $formBuilder;
}
}
return null;
}
public function getChildFormView(FormView $formView, $elementId)
{
foreach (new \RecursiveIteratorIterator(new FormViewIterator($formView), \RecursiveIteratorIterator::SELF_FIRST) as $name => $formView) {
if ($name === $elementId) {
return $formView;
}
}
return null;
}
public function getAdmin($code)
{
return $this->pool->getInstance($code);
}
public function appendFormFieldElement(AdminInterface $admin, $subject, $elementId)
{
$formBuilder = $admin->getFormBuilder();
$form = $formBuilder->getForm();
$form->setData($subject);
$form->submit($admin->getRequest());
$childFormBuilder = $this->getChildFormBuilder($formBuilder, $elementId);
$fieldDescription = $admin->getFormFieldDescription($childFormBuilder->getName());
try {
$value = $fieldDescription->getValue($form->getData());
} catch (NoValueException $e) {
$value = null;
}
$data = $admin->getRequest()->get($formBuilder->getName());
if (!isset($data[$childFormBuilder->getName()])) {
$data[$childFormBuilder->getName()] = array();
}
$objectCount = count($value);
$postCount = count($data[$childFormBuilder->getName()]);
$fields = array_keys($fieldDescription->getAssociationAdmin()->getFormFieldDescriptions());
$value = array();
foreach ($fields as $name) {
$value[$name] ='';
}
while ($objectCount < $postCount) {
$this->addNewInstance($form->getData(), $fieldDescription);
$objectCount++;
}
$this->addNewInstance($form->getData(), $fieldDescription);
$data[$childFormBuilder->getName()][] = $value;
$finalForm = $admin->getFormBuilder()->getForm();
$finalForm->setData($subject);
$finalForm->setData($form->getData());
return array($fieldDescription, $finalForm);
}
public function addNewInstance($object, FieldDescriptionInterface $fieldDescription)
{
$instance = $fieldDescription->getAssociationAdmin()->getNewInstance();
$mapping = $fieldDescription->getAssociationMapping();
$method = sprintf('add%s', $this->camelize($mapping['fieldName']));
if (!method_exists($object, $method)) {
$method = rtrim($method,'s');
if (!method_exists($object, $method)) {
$method = sprintf('add%s', $this->camelize(Inflector::singularize($mapping['fieldName'])));
if (!method_exists($object, $method)) {
throw new \RuntimeException(sprintf('Please add a method %s in the %s class!', $method, ClassUtils::getClass($object)));
}
}
}
$object->$method($instance);
}
public function camelize($property)
{
return BaseFieldDescription::camelize($property);
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Admin\AdminInterface;
interface FieldDescriptionInterface
{
public function setFieldName($fieldName);
public function getFieldName();
public function setName($name);
public function getName();
public function getOption($name, $default = null);
public function setOption($name, $value);
public function setOptions(array $options);
public function getOptions();
public function setTemplate($template);
public function getTemplate();
public function setType($type);
public function getType();
public function setParent(AdminInterface $parent);
public function getParent();
public function setAssociationMapping($associationMapping);
public function getAssociationMapping();
public function getTargetEntity();
public function setFieldMapping($fieldMapping);
public function getFieldMapping();
public function setParentAssociationMappings(array $parentAssociationMappings);
public function getParentAssociationMappings();
public function setAssociationAdmin(AdminInterface $associationAdmin);
public function getAssociationAdmin();
public function isIdentifier();
public function getValue($object);
public function setAdmin(AdminInterface $admin);
public function getAdmin();
public function mergeOption($name, array $options = array());
public function mergeOptions(array $options = array());
public function setMappingType($mappingType);
public function getMappingType();
public function getLabel();
public function getTranslationDomain();
public function isSortable();
public function getSortFieldMapping();
public function getSortParentAssociationMapping();
public function getFieldValue($object, $fieldName);
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Exception\NoValueException;
use Symfony\Component\DependencyInjection\Container;
abstract class BaseFieldDescription implements FieldDescriptionInterface
{
protected $name;
protected $type;
protected $mappingType;
protected $fieldName;
protected $associationMapping;
protected $fieldMapping;
protected $parentAssociationMappings;
protected $template;
protected $options = array();
protected $parent = null;
protected $admin;
protected $associationAdmin;
protected $help;
public function setFieldName($fieldName)
{
$this->fieldName = $fieldName;
}
public function getFieldName()
{
return $this->fieldName;
}
public function setName($name)
{
$this->name = $name;
if (!$this->getFieldName()) {
$this->setFieldName(substr(strrchr('.'. $name,'.'), 1));
}
}
public function getName()
{
return $this->name;
}
public function getOption($name, $default = null)
{
return isset($this->options[$name]) ? $this->options[$name] : $default;
}
public function setOption($name, $value)
{
$this->options[$name] = $value;
}
public function setOptions(array $options)
{
if (isset($options['type'])) {
$this->setType($options['type']);
unset($options['type']);
}
if (isset($options['template'])) {
$this->setTemplate($options['template']);
unset($options['template']);
}
if (isset($options['help'])) {
$this->setHelp($options['help']);
unset($options['help']);
}
if (!isset($options['placeholder'])) {
$options['placeholder'] ='short_object_description_placeholder';
}
if (!isset($options['link_parameters'])) {
$options['link_parameters'] = array();
}
$this->options = $options;
}
public function getOptions()
{
return $this->options;
}
public function setTemplate($template)
{
$this->template = $template;
}
public function getTemplate()
{
return $this->template;
}
public function setType($type)
{
$this->type = $type;
}
public function getType()
{
return $this->type;
}
public function setParent(AdminInterface $parent)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function getAssociationMapping()
{
return $this->associationMapping;
}
public function getFieldMapping()
{
return $this->fieldMapping;
}
public function getParentAssociationMappings()
{
return $this->parentAssociationMappings;
}
public function setAssociationAdmin(AdminInterface $associationAdmin)
{
$this->associationAdmin = $associationAdmin;
$this->associationAdmin->setParentFieldDescription($this);
}
public function getAssociationAdmin()
{
return $this->associationAdmin;
}
public function hasAssociationAdmin()
{
return $this->associationAdmin !== null;
}
public function getFieldValue($object, $fieldName)
{
$camelizedFieldName = self::camelize($fieldName);
$getters = array();
$parameters = array();
if ($this->getOption('code')) {
$getters[] = $this->getOption('code');
}
if ($this->getOption('parameters')) {
$parameters = $this->getOption('parameters');
}
$getters[] ='get'. $camelizedFieldName;
$getters[] ='is'. $camelizedFieldName;
foreach ($getters as $getter) {
if (method_exists($object, $getter)) {
return call_user_func_array(array($object, $getter), $parameters);
}
}
if (isset($object->{$fieldName})) {
return $object->{$fieldName};
}
throw new NoValueException(sprintf('Unable to retrieve the value of `%s`', $this->getName()));
}
public function setAdmin(AdminInterface $admin)
{
$this->admin = $admin;
}
public function getAdmin()
{
return $this->admin;
}
public function mergeOption($name, array $options = array())
{
if (!isset($this->options[$name])) {
$this->options[$name] = array();
}
if (!is_array($this->options[$name])) {
throw new \RuntimeException(sprintf('The key `%s` does not point to an array value', $name));
}
$this->options[$name] = array_merge($this->options[$name], $options);
}
public function mergeOptions(array $options = array())
{
$this->setOptions(array_merge_recursive($this->options, $options));
}
public function setMappingType($mappingType)
{
$this->mappingType = $mappingType;
}
public function getMappingType()
{
return $this->mappingType;
}
public static function camelize($property)
{
return preg_replace_callback('/(^|[_. ])+(.)/', function ($match) {
return ('.'=== $match[1] ?'_':'') . strtoupper($match[2]);
}, $property);
}
public function setHelp($help)
{
$this->help = $help;
}
public function getHelp()
{
return $this->help;
}
public function getLabel()
{
return $this->getOption('label');
}
public function isSortable()
{
return false !== $this->getOption('sortable', false);
}
public function getSortFieldMapping()
{
return $this->getOption('sort_field_mapping');
}
public function getSortParentAssociationMapping()
{
return $this->getOption('sort_parent_association_mappings');
}
public function getTranslationDomain()
{
return $this->getOption('translation_domain') ? : $this->getAdmin()->getTranslationDomain();
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
class FieldDescriptionCollection implements \ArrayAccess, \Countable
{
protected $elements = array();
public function add(FieldDescriptionInterface $fieldDescription)
{
$this->elements[$fieldDescription->getName()] = $fieldDescription;
}
public function getElements()
{
return $this->elements;
}
public function has($name)
{
return array_key_exists($name, $this->elements);
}
public function get($name)
{
if ($this->has($name)) {
return $this->elements[$name];
}
throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
}
public function remove($name)
{
if ($this->has($name)) {
unset($this->elements[$name]);
}
}
public function offsetExists($offset)
{
return $this->has($offset);
}
public function offsetGet($offset)
{
return $this->get($offset);
}
public function offsetSet($offset, $value)
{
throw new \RunTimeException('Cannot set value, use add');
}
public function offsetUnset($offset)
{
$this->remove($offset);
}
public function count()
{
return count($this->elements);
}
public function reorder(array $keys)
{
if ($this->has('batch')) {
array_unshift($keys,'batch');
}
$this->elements = array_merge(array_flip($keys), $this->elements);
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class Pool
{
protected $container = null;
protected $adminServiceIds = array();
protected $adminGroups = array();
protected $adminClasses = array();
protected $templates = array();
protected $assets = array();
protected $title;
protected $titleLogo;
protected $options;
public function __construct(ContainerInterface $container, $title, $logoTitle, $options = array())
{
$this->container = $container;
$this->title = $title;
$this->titleLogo = $logoTitle;
$this->options = $options;
}
public function getGroups()
{
$groups = $this->adminGroups;
foreach ($this->adminGroups as $name => $adminGroup) {
foreach ($adminGroup as $id => $options) {
$groups[$name][$id] = $this->getInstance($id);
}
}
return $groups;
}
public function hasGroup($group)
{
return isset($this->adminGroups[$group]);
}
public function getDashboardGroups()
{
$groups = $this->adminGroups;
foreach ($this->adminGroups as $name => $adminGroup) {
if (isset($adminGroup['items'])) {
foreach ($adminGroup['items'] as $key => $id) {
$admin = $this->getInstance($id);
if ($admin->showIn(Admin::CONTEXT_DASHBOARD)) {
$groups[$name]['items'][$key] = $admin;
} else {
unset($groups[$name]['items'][$key]);
}
}
}
if (empty($groups[$name]['items'])) {
unset($groups[$name]);
}
}
return $groups;
}
public function getAdminsByGroup($group)
{
if (!isset($this->adminGroups[$group])) {
throw new \InvalidArgumentException(sprintf('Group "%s" not found in admin pool.', $group));
}
$admins = array();
if (!isset($this->adminGroups[$group]['items'])) {
return $admins;
}
foreach ($this->adminGroups[$group]['items'] as $id) {
$admins[] = $this->getInstance($id);
}
return $admins;
}
public function getAdminByClass($class)
{
if (!$this->hasAdminByClass($class)) {
return null;
}
if (!is_array($this->adminClasses[$class])) {
throw new \RuntimeException("Invalid format for the Pool::adminClass property");
}
if (count($this->adminClasses[$class]) > 1) {
throw new \RuntimeException(sprintf('Unable to found a valid admin for the class: %s, get too many admin registered: %s', $class, implode(",", $this->adminClasses[$class])));
}
return $this->getInstance($this->adminClasses[$class][0]);
}
public function hasAdminByClass($class)
{
return isset($this->adminClasses[$class]);
}
public function getAdminByAdminCode($adminCode)
{
$codes = explode('|', $adminCode);
$admin = false;
foreach ($codes as $code) {
if ($admin == false) {
$admin = $this->getInstance($code);
} elseif ($admin->hasChild($code)) {
$admin = $admin->getChild($code);
}
}
return $admin;
}
public function getInstance($id)
{
if (!in_array($id, $this->adminServiceIds)) {
throw new \InvalidArgumentException(sprintf('Admin service "%s" not found in admin pool.', $id));
}
return $this->container->get($id);
}
public function getContainer()
{
return $this->container;
}
public function setAdminGroups(array $adminGroups)
{
$this->adminGroups = $adminGroups;
}
public function getAdminGroups()
{
return $this->adminGroups;
}
public function setAdminServiceIds(array $adminServiceIds)
{
$this->adminServiceIds = $adminServiceIds;
}
public function getAdminServiceIds()
{
return $this->adminServiceIds;
}
public function setAdminClasses(array $adminClasses)
{
$this->adminClasses = $adminClasses;
}
public function getAdminClasses()
{
return $this->adminClasses;
}
public function setTemplates(array $templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
public function getTemplate($name)
{
if (isset($this->templates[$name])) {
return $this->templates[$name];
}
return null;
}
public function getTitleLogo()
{
return $this->titleLogo;
}
public function getTitle()
{
return $this->title;
}
public function getOption($name, $default = null)
{
if (isset($this->options[$name])) {
return $this->options[$name];
}
return $default;
}
}
}
namespace Sonata\AdminBundle\Block
{
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class AdminListBlockService extends BaseBlockService
{
protected $pool;
public function __construct($name, EngineInterface $templating, Pool $pool)
{
parent::__construct($name, $templating);
$this->pool = $pool;
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$dashboardGroups = $this->pool->getDashboardGroups();
$settings = $blockContext->getSettings();
$visibleGroups = array();
foreach ($dashboardGroups as $name => $dashboardGroup) {
if (!$settings['groups'] || in_array($name, $settings['groups'])) {
$visibleGroups[] = $dashboardGroup;
}
}
return $this->renderPrivateResponse($this->pool->getTemplate('list_block'), array('block'=> $blockContext->getBlock(),'settings'=> $settings,'admin_pool'=> $this->pool,'groups'=> $visibleGroups
), $response);
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
}
public function getName()
{
return'Admin List';
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('groups'=> false
));
$resolver->setAllowedTypes(array('groups'=> array('bool','array')
));
}
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
interface BuilderInterface
{
public function fixFieldDescription(AdminInterface $admin, FieldDescriptionInterface $fieldDescription);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
interface DatagridBuilderInterface extends BuilderInterface
{
public function addFilter(DatagridInterface $datagrid, $type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
public function getBaseDatagrid(AdminInterface $admin, array $values = array());
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
interface FormContractorInterface extends BuilderInterface
{
public function __construct(FormFactoryInterface $formFactory);
public function getFormBuilder($name, array $options = array());
public function getDefaultOptions($type, FieldDescriptionInterface $fieldDescription);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
interface ListBuilderInterface extends BuilderInterface
{
public function getBaseList(array $options = array());
public function buildField($type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
public function addField(FieldDescriptionCollection $list, $type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;
interface RouteBuilderInterface
{
public function build(AdminInterface $admin, RouteCollection $collection);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
interface ShowBuilderInterface extends BuilderInterface
{
public function getBaseList(array $options = array());
public function addField(FieldDescriptionCollection $list, $type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Filter\FilterInterface;
interface DatagridInterface
{
public function getPager();
public function getQuery();
public function getResults();
public function buildPager();
public function addFilter(FilterInterface $filter);
public function getFilters();
public function reorderFilters(array $keys);
public function getValues();
public function getColumns();
public function setValue($name, $operator, $value);
public function getForm();
public function getFilter($name);
public function hasFilter($name);
public function removeFilter($name);
public function hasActiveFilters();
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Filter\FilterInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\CallbackTransformer;
class Datagrid implements DatagridInterface
{
protected $filters = array();
protected $values;
protected $columns;
protected $pager;
protected $bound = false;
protected $query;
protected $formBuilder;
protected $form;
protected $results;
public function __construct(ProxyQueryInterface $query, FieldDescriptionCollection $columns, PagerInterface $pager, FormBuilder $formBuilder, array $values = array())
{
$this->pager = $pager;
$this->query = $query;
$this->values = $values;
$this->columns = $columns;
$this->formBuilder = $formBuilder;
}
public function getPager()
{
return $this->pager;
}
public function getResults()
{
$this->buildPager();
if (!$this->results) {
$this->results = $this->pager->getResults();
}
return $this->results;
}
public function buildPager()
{
if ($this->bound) {
return;
}
foreach ($this->getFilters() as $name => $filter) {
list($type, $options) = $filter->getRenderSettings();
$this->formBuilder->add($filter->getFormName(), $type, $options);
}
$this->formBuilder->add('_sort_by','hidden');
$this->formBuilder->get('_sort_by')->addViewTransformer(new CallbackTransformer(
function ($value) { return $value; },
function ($value) { return $value instanceof FieldDescriptionInterface ? $value->getName() : $value; }
));
$this->formBuilder->add('_sort_order','hidden');
$this->formBuilder->add('_page','hidden');
$this->formBuilder->add('_per_page','hidden');
$this->form = $this->formBuilder->getForm();
$this->form->submit($this->values);
$data = $this->form->getData();
foreach ($this->getFilters() as $name => $filter) {
$this->values[$name] = isset($this->values[$name]) ? $this->values[$name] : null;
$filter->apply($this->query, $data[$filter->getFormName()]);
}
if (isset($this->values['_sort_by'])) {
if (!$this->values['_sort_by'] instanceof FieldDescriptionInterface) {
throw new UnexpectedTypeException($this->values['_sort_by'],'FieldDescriptionInterface');
}
if ($this->values['_sort_by']->isSortable()) {
$this->query->setSortBy($this->values['_sort_by']->getSortParentAssociationMapping(), $this->values['_sort_by']->getSortFieldMapping());
$this->query->setSortOrder(isset($this->values['_sort_order']) ? $this->values['_sort_order'] : null);
}
}
$maxPerPage = 25;
if (isset($this->values['_per_page'])) {
if (is_array($this->values['_per_page'])) {
if (isset($this->values['_per_page']['value'])) {
$maxPerPage = $this->values['_per_page']['value'];
}
} else {
$maxPerPage = $this->values['_per_page'];
}
}
$this->pager->setMaxPerPage($maxPerPage);
$page = 1;
if (isset($this->values['_page'])) {
if (is_array($this->values['_page'])) {
if (isset($this->values['_page']['value'])) {
$page = $this->values['_page']['value'];
}
} else {
$page = $this->values['_page'];
}
}
$this->pager->setPage($page);
$this->pager->setQuery($this->query);
$this->pager->init();
$this->bound = true;
}
public function addFilter(FilterInterface $filter)
{
$this->filters[$filter->getName()] = $filter;
}
public function hasFilter($name)
{
return isset($this->filters[$name]);
}
public function removeFilter($name)
{
unset($this->filters[$name]);
}
public function getFilter($name)
{
return $this->hasFilter($name) ? $this->filters[$name] : null;
}
public function getFilters()
{
return $this->filters;
}
public function reorderFilters(array $keys)
{
$this->filters = array_merge(array_flip($keys), $this->filters);
}
public function getValues()
{
return $this->values;
}
public function setValue($name, $operator, $value)
{
$this->values[$name] = array('type'=> $operator,'value'=> $value
);
}
public function hasActiveFilters()
{
foreach ($this->filters as $name => $filter) {
if ($filter->isActive()) {
return true;
}
}
return false;
}
public function getColumns()
{
return $this->columns;
}
public function getQuery()
{
return $this->query;
}
public function getForm()
{
$this->buildPager();
return $this->form;
}
}
}
namespace Sonata\AdminBundle\Mapper
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\BuilderInterface;
abstract class BaseMapper
{
protected $admin;
protected $builder;
public function __construct(BuilderInterface $builder, AdminInterface $admin)
{
$this->builder = $builder;
$this->admin = $admin;
}
public function getAdmin()
{
return $this->admin;
}
abstract public function get($key);
abstract public function has($key);
abstract public function remove($key);
abstract public function reorder(array $keys);
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseMapper;
class DatagridMapper extends BaseMapper
{
protected $datagrid;
public function __construct(DatagridBuilderInterface $datagridBuilder, DatagridInterface $datagrid, AdminInterface $admin)
{
parent::__construct($datagridBuilder, $admin);
$this->datagrid = $datagrid;
}
public function add($name, $type = null, array $filterOptions = array(), $fieldType = null, $fieldOptions = null)
{
if (is_array($fieldOptions)) {
$filterOptions['field_options'] = $fieldOptions;
}
if ($fieldType) {
$filterOptions['field_type'] = $fieldType;
}
$filterOptions['field_name'] = isset($filterOptions['field_name']) ? $filterOptions['field_name'] : substr(strrchr('.'.$name,'.'), 1);
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($filterOptions);
} elseif (is_string($name) && !$this->admin->hasFilterFieldDescription($name)) {
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$filterOptions
);
} elseif (is_string($name) && $this->admin->hasFilterFieldDescription($name)) {
throw new \RuntimeException(sprintf('The field "%s" is already defined', $name));
} else {
throw new \RuntimeException('invalid state');
}
$this->builder->addFilter($this->datagrid, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->datagrid->getFilter($name);
}
public function has($key)
{
return $this->datagrid->hasFilter($key);
}
public function remove($key)
{
$this->admin->removeFilterFieldDescription($key);
$this->datagrid->removeFilter($key);
return $this;
}
public function reorder(array $keys)
{
$this->datagrid->reorderFilters($keys);
return $this;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseMapper;
class ListMapper extends BaseMapper
{
protected $list;
public function __construct(ListBuilderInterface $listBuilder, FieldDescriptionCollection $list, AdminInterface $admin)
{
parent::__construct($listBuilder, $admin);
$this->list = $list;
}
public function addIdentifier($name, $type = null, array $fieldDescriptionOptions = array())
{
$fieldDescriptionOptions['identifier'] = true;
if (!isset($fieldDescriptionOptions['route']['name'])) {
$routeName = $this->admin->isGranted('EDIT') ?'edit':'show';
$fieldDescriptionOptions['route']['name'] = $routeName;
}
if (!isset($fieldDescriptionOptions['route']['parameters'])) {
$fieldDescriptionOptions['route']['parameters'] = array();
}
return $this->add($name, $type, $fieldDescriptionOptions);
}
public function add($name, $type = null, array $fieldDescriptionOptions = array())
{
if ($name =='_action'&& $type =='actions') {
if (isset($fieldDescriptionOptions['actions']['view'])) {
trigger_error('Inline action "view" is deprecated since version 2.2.4. Use inline action "show" instead.', E_USER_DEPRECATED);
$fieldDescriptionOptions['actions']['show'] = $fieldDescriptionOptions['actions']['view'];
unset($fieldDescriptionOptions['actions']['view']);
}
}
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($fieldDescriptionOptions);
} elseif (is_string($name)) {
if ($this->admin->hasListFieldDescription($name)) {
throw new \RuntimeException(sprintf('Duplicate field name "%s" in list mapper. Names should be unique.', $name));
}
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$fieldDescriptionOptions
);
} else {
throw new \RuntimeException('Unknown field name in list mapper. Field name should be either of FieldDescriptionInterface interface or string.');
}
if (!$fieldDescription->getLabel()) {
$fieldDescription->setOption('label', $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'list','label'));
}
$this->builder->addField($this->list, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->list->get($name);
}
public function has($key)
{
return $this->list->has($key);
}
public function remove($key)
{
$this->admin->removeListFieldDescription($key);
$this->list->remove($key);
return $this;
}
public function reorder(array $keys)
{
$this->list->reorder($keys);
return $this;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
interface PagerInterface
{
public function init();
public function getMaxPerPage();
public function setMaxPerPage($max);
public function setPage($page);
public function setQuery($query);
public function getResults();
}
}
namespace Sonata\AdminBundle\Datagrid
{
abstract class Pager implements \Iterator, \Countable, \Serializable, PagerInterface
{
protected $page = 1;
protected $maxPerPage = 0;
protected $lastPage = 1;
protected $nbResults = 0;
protected $cursor = 1;
protected $parameters = array();
protected $currentMaxLink = 1;
protected $maxRecordLimit = false;
protected $maxPageLinks = 0;
protected $results = null;
protected $resultsCounter = 0;
protected $query = null;
protected $countColumn = array('id');
public function __construct($maxPerPage = 10)
{
$this->setMaxPerPage($maxPerPage);
}
public function getCurrentMaxLink()
{
return $this->currentMaxLink;
}
public function getMaxRecordLimit()
{
return $this->maxRecordLimit;
}
public function setMaxRecordLimit($limit)
{
$this->maxRecordLimit = $limit;
}
public function getLinks($nbLinks = null)
{
if ($nbLinks == null) {
$nbLinks = $this->getMaxPageLinks();
}
$links = array();
$tmp = $this->page - floor($nbLinks / 2);
$check = $this->lastPage - $nbLinks + 1;
$limit = $check > 0 ? $check : 1;
$begin = $tmp > 0 ? ($tmp > $limit ? $limit : $tmp) : 1;
$i = (int) $begin;
while ($i < $begin + $nbLinks && $i <= $this->lastPage) {
$links[] = $i++;
}
$this->currentMaxLink = count($links) ? $links[count($links) - 1] : 1;
return $links;
}
public function haveToPaginate()
{
return $this->getMaxPerPage() && $this->getNbResults() > $this->getMaxPerPage();
}
public function getCursor()
{
return $this->cursor;
}
public function setCursor($pos)
{
if ($pos < 1) {
$this->cursor = 1;
} else {
if ($pos > $this->nbResults) {
$this->cursor = $this->nbResults;
} else {
$this->cursor = $pos;
}
}
}
public function getObjectByCursor($pos)
{
$this->setCursor($pos);
return $this->getCurrent();
}
public function getCurrent()
{
return $this->retrieveObject($this->cursor);
}
public function getNext()
{
if ($this->cursor + 1 > $this->nbResults) {
return null;
} else {
return $this->retrieveObject($this->cursor + 1);
}
}
public function getPrevious()
{
if ($this->cursor - 1 < 1) {
return null;
} else {
return $this->retrieveObject($this->cursor - 1);
}
}
public function getFirstIndice()
{
if ($this->page == 0) {
return 1;
} else {
return ($this->page - 1) * $this->maxPerPage + 1;
}
}
public function getLastIndice()
{
if ($this->page == 0) {
return $this->nbResults;
} else {
if ($this->page * $this->maxPerPage >= $this->nbResults) {
return $this->nbResults;
} else {
return $this->page * $this->maxPerPage;
}
}
}
public function getNbResults()
{
return $this->nbResults;
}
protected function setNbResults($nb)
{
$this->nbResults = $nb;
}
public function getFirstPage()
{
return 1;
}
public function getLastPage()
{
return $this->lastPage;
}
protected function setLastPage($page)
{
$this->lastPage = $page;
if ($this->getPage() > $page) {
$this->setPage($page);
}
}
public function getPage()
{
return $this->page;
}
public function getNextPage()
{
return min($this->getPage() + 1, $this->getLastPage());
}
public function getPreviousPage()
{
return max($this->getPage() - 1, $this->getFirstPage());
}
public function setPage($page)
{
$this->page = intval($page);
if ($this->page <= 0) {
$this->page = $this->getMaxPerPage() ? 1 : 0;
}
}
public function getMaxPerPage()
{
return $this->maxPerPage;
}
public function setMaxPerPage($max)
{
if ($max > 0) {
$this->maxPerPage = $max;
if ($this->page == 0) {
$this->page = 1;
}
} else {
if ($max == 0) {
$this->maxPerPage = 0;
$this->page = 0;
} else {
$this->maxPerPage = 1;
if ($this->page == 0) {
$this->page = 1;
}
}
}
}
public function getMaxPageLinks()
{
return $this->maxPageLinks;
}
public function setMaxPageLinks($maxPageLinks)
{
$this->maxPageLinks = $maxPageLinks;
}
public function isFirstPage()
{
return 1 == $this->page;
}
public function isLastPage()
{
return $this->page == $this->lastPage;
}
public function getParameters()
{
return $this->parameters;
}
public function getParameter($name, $default = null)
{
return isset($this->parameters[$name]) ? $this->parameters[$name] : $default;
}
public function hasParameter($name)
{
return isset($this->parameters[$name]);
}
public function setParameter($name, $value)
{
$this->parameters[$name] = $value;
}
protected function isIteratorInitialized()
{
return null !== $this->results;
}
protected function initializeIterator()
{
$this->results = $this->getResults();
$this->resultsCounter = count($this->results);
}
protected function resetIterator()
{
$this->results = null;
$this->resultsCounter = 0;
}
public function current()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
return current($this->results);
}
public function key()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
return key($this->results);
}
public function next()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
--$this->resultsCounter;
return next($this->results);
}
public function rewind()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
$this->resultsCounter = count($this->results);
return reset($this->results);
}
public function valid()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
return $this->resultsCounter > 0;
}
public function count()
{
return $this->getNbResults();
}
public function serialize()
{
$vars = get_object_vars($this);
unset($vars['query']);
return serialize($vars);
}
public function unserialize($serialized)
{
$array = unserialize($serialized);
foreach ($array as $name => $values) {
$this->$name = $values;
}
}
public function getCountColumn()
{
return $this->countColumn;
}
public function setCountColumn(array $countColumn)
{
return $this->countColumn = $countColumn;
}
protected function retrieveObject($offset)
{
$queryForRetrieve = clone $this->getQuery();
$queryForRetrieve
->setFirstResult($offset - 1)
->setMaxResults(1);
$results = $queryForRetrieve->execute();
return $results[0];
}
public function setQuery($query)
{
$this->query = $query;
}
public function getQuery()
{
return $this->query;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
interface ProxyQueryInterface
{
public function execute(array $params = array(), $hydrationMode = null);
public function __call($name, $args);
public function setSortBy($parentAssociationMappings, $fieldMapping);
public function getSortBy();
public function setSortOrder($sortOrder);
public function getSortOrder();
public function getSingleScalarResult();
public function setFirstResult($firstResult);
public function getFirstResult();
public function setMaxResults($maxResults);
public function getMaxResults();
public function getUniqueParameterId();
public function entityJoin(array $associationMappings);
}
}
namespace Sonata\AdminBundle\Exception
{
class ModelManagerException extends \Exception
{
}
}
namespace Sonata\AdminBundle\Exception
{
class NoValueException extends \Exception
{
}
}
namespace Sonata\CoreBundle\Exporter
{
use Exporter\Source\SourceIteratorInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Exporter\Writer\XlsWriter;
use Exporter\Writer\XmlWriter;
use Exporter\Writer\JsonWriter;
use Exporter\Writer\CsvWriter;
class Exporter
{
public function getResponse($format, $filename, SourceIteratorInterface $source)
{
switch ($format) {
case'xls':
$writer = new XlsWriter('php://output');
$contentType ='application/vnd.ms-excel';
break;
case'xml':
$writer = new XmlWriter('php://output');
$contentType ='text/xml';
break;
case'json':
$writer = new JsonWriter('php://output');
$contentType ='application/json';
break;
case'csv':
$writer = new CsvWriter('php://output',',','"',"", true, true);
$contentType ='text/csv';
break;
default:
throw new \RuntimeException('Invalid format');
}
$callback = function() use ($source, $writer) {
$handler = \Exporter\Handler::create($source, $writer);
$handler->export();
};
return new StreamedResponse($callback, 200, array('Content-Type'=> $contentType,'Content-Disposition'=> sprintf('attachment; filename=%s', $filename)
));
}
}
}
namespace Sonata\AdminBundle\Export
{
use Symfony\Component\HttpFoundation\StreamedResponse;
use Sonata\CoreBundle\Exporter\Exporter as BaseExporter;
class Exporter extends BaseExporter
{
}
}
namespace Sonata\AdminBundle\Filter
{
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
interface FilterInterface
{
const CONDITION_OR ='OR';
const CONDITION_AND ='AND';
public function filter(ProxyQueryInterface $queryBuilder, $alias, $field, $value);
public function apply($query, $value);
public function getName();
public function getFormName();
public function getLabel();
public function setLabel($label);
public function getDefaultOptions();
public function getOption($name, $default = null);
public function setOption($name, $value);
public function initialize($name, array $options = array());
public function getFieldName();
public function getParentAssociationMappings();
public function getFieldMapping();
public function getAssociationMapping();
public function getFieldOptions();
public function getFieldType();
public function getRenderSettings();
public function isActive();
public function setCondition($condition);
public function getCondition();
public function getTranslationDomain();
}
}
namespace Sonata\AdminBundle\Filter
{
use Sonata\AdminBundle\Filter\FilterInterface;
abstract class Filter implements FilterInterface
{
protected $name = null;
protected $value = null;
protected $options = array();
protected $condition;
public function initialize($name, array $options = array())
{
$this->name = $name;
$this->setOptions($options);
}
public function getName()
{
return $this->name;
}
public function getFormName()
{
return str_replace('.','__', $this->name);
}
public function getOption($name, $default = null)
{
if (array_key_exists($name, $this->options)) {
return $this->options[$name];
}
return $default;
}
public function setOption($name, $value)
{
$this->options[$name] = $value;
}
public function getFieldType()
{
return $this->getOption('field_type','text');
}
public function getFieldOptions()
{
return $this->getOption('field_options', array('required'=> false));
}
public function getLabel()
{
return $this->getOption('label');
}
public function setLabel($label)
{
$this->setOption('label', $label);
}
public function getFieldName()
{
$fieldName = $this->getOption('field_name');
if (!$fieldName) {
throw new \RuntimeException(sprintf('The option `field_name` must be set for field: `%s`', $this->getName()));
}
return $fieldName;
}
public function getParentAssociationMappings()
{
return $this->getOption('parent_association_mappings', array());
}
public function getFieldMapping()
{
$fieldMapping = $this->getOption('field_mapping');
if (!$fieldMapping) {
throw new \RuntimeException(sprintf('The option `field_mapping` must be set for field: `%s`', $this->getName()));
}
return $fieldMapping;
}
public function getAssociationMapping()
{
$associationMapping = $this->getOption('association_mapping');
if (!$associationMapping) {
throw new \RuntimeException(sprintf('The option `association_mapping` must be set for field: `%s`', $this->getName()));
}
return $associationMapping;
}
public function setOptions(array $options)
{
$this->options = array_merge($this->getDefaultOptions(), $options);
}
public function getOptions()
{
return $this->options;
}
public function setValue($value)
{
$this->value = $value;
}
public function getValue()
{
return $this->value;
}
public function isActive()
{
$values = $this->getValue();
return isset($values['value'])
&& false !== $values['value']
&&""!== $values['value'];
}
public function setCondition($condition)
{
$this->condition = $condition;
}
public function getCondition()
{
return $this->condition;
}
public function getTranslationDomain()
{
return $this->getOption('translation_domain');
}
}
}
namespace Sonata\AdminBundle\Filter
{
interface FilterFactoryInterface
{
public function create($name, $type, array $options = array());
}
}
namespace Sonata\AdminBundle\Filter
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class FilterFactory implements FilterFactoryInterface
{
protected $container;
protected $types;
public function __construct(ContainerInterface $container, array $types = array())
{
$this->container = $container;
$this->types = $types;
}
public function create($name, $type, array $options = array())
{
if (!$type) {
throw new \RunTimeException('The type must be defined');
}
$id = isset($this->types[$type]) ? $this->types[$type] : false;
if (!$id) {
throw new \RunTimeException(sprintf('No attached service to type named `%s`', $type));
}
$filter = $this->container->get($id);
if (!$filter instanceof FilterInterface) {
throw new \RunTimeException(sprintf('The service `%s` must implement `FilterInterface`', $id));
}
$filter->initialize($name, $options);
return $filter;
}
}
}
namespace Symfony\Component\Form\Extension\Core\ChoiceList
{
interface ChoiceListInterface
{
public function getChoices();
public function getValues();
public function getPreferredViews();
public function getRemainingViews();
public function getChoicesForValues(array $values);
public function getValuesForChoices(array $choices);
public function getIndicesForChoices(array $choices);
public function getIndicesForValues(array $values);
}
}
namespace Symfony\Component\Form\Extension\Core\ChoiceList
{
use Symfony\Component\Form\FormConfigBuilder;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;
class ChoiceList implements ChoiceListInterface
{
protected $choices = array();
protected $values = array();
private $preferredViews = array();
private $remainingViews = array();
public function __construct($choices, array $labels, array $preferredChoices = array())
{
if (!is_array($choices) && !$choices instanceof \Traversable) {
throw new UnexpectedTypeException($choices,'array or \Traversable');
}
$this->initialize($choices, $labels, $preferredChoices);
}
protected function initialize($choices, array $labels, array $preferredChoices)
{
$this->choices = array();
$this->values = array();
$this->preferredViews = array();
$this->remainingViews = array();
$this->addChoices(
$this->preferredViews,
$this->remainingViews,
$choices,
$labels,
$preferredChoices
);
}
public function getChoices()
{
return $this->choices;
}
public function getValues()
{
return $this->values;
}
public function getPreferredViews()
{
return $this->preferredViews;
}
public function getRemainingViews()
{
return $this->remainingViews;
}
public function getChoicesForValues(array $values)
{
$values = $this->fixValues($values);
$choices = array();
foreach ($values as $i => $givenValue) {
foreach ($this->values as $j => $value) {
if ($value === $givenValue) {
$choices[$i] = $this->choices[$j];
unset($values[$i]);
if (0 === count($values)) {
break 2;
}
}
}
}
return $choices;
}
public function getValuesForChoices(array $choices)
{
$choices = $this->fixChoices($choices);
$values = array();
foreach ($choices as $i => $givenChoice) {
foreach ($this->choices as $j => $choice) {
if ($choice === $givenChoice) {
$values[$i] = $this->values[$j];
unset($choices[$i]);
if (0 === count($choices)) {
break 2;
}
}
}
}
return $values;
}
public function getIndicesForChoices(array $choices)
{
$choices = $this->fixChoices($choices);
$indices = array();
foreach ($choices as $i => $givenChoice) {
foreach ($this->choices as $j => $choice) {
if ($choice === $givenChoice) {
$indices[$i] = $j;
unset($choices[$i]);
if (0 === count($choices)) {
break 2;
}
}
}
}
return $indices;
}
public function getIndicesForValues(array $values)
{
$values = $this->fixValues($values);
$indices = array();
foreach ($values as $i => $givenValue) {
foreach ($this->values as $j => $value) {
if ($value === $givenValue) {
$indices[$i] = $j;
unset($values[$i]);
if (0 === count($values)) {
break 2;
}
}
}
}
return $indices;
}
protected function addChoices(array &$bucketForPreferred, array &$bucketForRemaining, $choices, array $labels, array $preferredChoices)
{
foreach ($choices as $group => $choice) {
if (!array_key_exists($group, $labels)) {
throw new InvalidArgumentException('The structures of the choices and labels array do not match.');
}
if (is_array($choice)) {
if (count($choice) > 0) {
$this->addChoiceGroup(
$group,
$bucketForPreferred,
$bucketForRemaining,
$choice,
$labels[$group],
$preferredChoices
);
}
} else {
$this->addChoice(
$bucketForPreferred,
$bucketForRemaining,
$choice,
$labels[$group],
$preferredChoices
);
}
}
}
protected function addChoiceGroup($group, array &$bucketForPreferred, array &$bucketForRemaining, array $choices, array $labels, array $preferredChoices)
{
$bucketForPreferred[$group] = array();
$bucketForRemaining[$group] = array();
$this->addChoices(
$bucketForPreferred[$group],
$bucketForRemaining[$group],
$choices,
$labels,
$preferredChoices
);
if (empty($bucketForPreferred[$group])) {
unset($bucketForPreferred[$group]);
}
if (empty($bucketForRemaining[$group])) {
unset($bucketForRemaining[$group]);
}
}
protected function addChoice(array &$bucketForPreferred, array &$bucketForRemaining, $choice, $label, array $preferredChoices)
{
$index = $this->createIndex($choice);
if (''=== $index || null === $index || !FormConfigBuilder::isValidName((string) $index)) {
throw new InvalidConfigurationException(sprintf('The index "%s" created by the choice list is invalid. It should be a valid, non-empty Form name.', $index));
}
$value = $this->createValue($choice);
if (!is_string($value)) {
throw new InvalidConfigurationException(sprintf('The value created by the choice list is of type "%s", but should be a string.', gettype($value)));
}
$view = new ChoiceView($choice, $value, $label);
$this->choices[$index] = $this->fixChoice($choice);
$this->values[$index] = $value;
if ($this->isPreferred($choice, $preferredChoices)) {
$bucketForPreferred[$index] = $view;
} else {
$bucketForRemaining[$index] = $view;
}
}
protected function isPreferred($choice, array $preferredChoices)
{
return in_array($choice, $preferredChoices, true);
}
protected function createIndex($choice)
{
return count($this->choices);
}
protected function createValue($choice)
{
return (string) count($this->values);
}
protected function fixValue($value)
{
return (string) $value;
}
protected function fixValues(array $values)
{
foreach ($values as $i => $value) {
$values[$i] = $this->fixValue($value);
}
return $values;
}
protected function fixIndex($index)
{
if (is_bool($index) || (string) (int) $index === (string) $index) {
return (int) $index;
}
return (string) $index;
}
protected function fixIndices(array $indices)
{
foreach ($indices as $i => $index) {
$indices[$i] = $this->fixIndex($index);
}
return $indices;
}
protected function fixChoice($choice)
{
return $choice;
}
protected function fixChoices(array $choices)
{
return $choices;
}
}
}
namespace Symfony\Component\Form\Extension\Core\ChoiceList
{
class SimpleChoiceList extends ChoiceList
{
public function __construct(array $choices, array $preferredChoices = array())
{
parent::__construct($choices, $choices, array_flip($preferredChoices));
}
public function getChoicesForValues(array $values)
{
$values = $this->fixValues($values);
return $this->fixChoices(array_intersect($values, $this->getValues()));
}
public function getValuesForChoices(array $choices)
{
$choices = $this->fixChoices($choices);
return $this->fixValues(array_intersect($choices, $this->getValues()));
}
protected function addChoices(array &$bucketForPreferred, array &$bucketForRemaining, $choices, array $labels, array $preferredChoices)
{
foreach ($choices as $choice => $label) {
if (is_array($label)) {
if (count($label) > 0) {
$this->addChoiceGroup(
$choice,
$bucketForPreferred,
$bucketForRemaining,
$label,
$label,
$preferredChoices
);
}
} else {
$this->addChoice(
$bucketForPreferred,
$bucketForRemaining,
$choice,
$label,
$preferredChoices
);
}
}
}
protected function isPreferred($choice, array $preferredChoices)
{
return isset($preferredChoices[$choice]);
}
protected function fixChoice($choice)
{
return $this->fixIndex($choice);
}
protected function fixChoices(array $choices)
{
return $this->fixIndices($choices);
}
protected function createValue($choice)
{
return (string) $choice;
}
}
}
namespace Sonata\AdminBundle\Form\ChoiceList
{
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Sonata\AdminBundle\Model\ModelManagerInterface;
class ModelChoiceList extends SimpleChoiceList
{
private $modelManager;
private $class;
private $entities = array();
private $query;
private $identifier = array();
private $reflProperties = array();
private $propertyPath;
public function __construct(ModelManagerInterface $modelManager, $class, $property = null, $query = null, $choices = array())
{
$this->modelManager = $modelManager;
$this->class = $class;
$this->query = $query;
$this->identifier = $this->modelManager->getIdentifierFieldNames($this->class);
if ($property) {
$this->propertyPath = new PropertyPath($property);
}
parent::__construct($this->load($choices));
}
protected function load($choices)
{
if (is_array($choices)) {
$entities = $choices;
} elseif ($this->query) {
$entities = $this->modelManager->executeQuery($this->query);
} else {
$entities = $this->modelManager->findBy($this->class);
}
$choices = array();
$this->entities = array();
foreach ($entities as $key => $entity) {
if ($this->propertyPath) {
$propertyAccessor = PropertyAccess::createPropertyAccessor();
$value = $propertyAccessor->getValue($entity, $this->propertyPath);
} else {
try {
$value = (string) $entity;
} catch (\Exception $e) {
throw new RuntimeException(sprintf("Unable to convert the entity %s to String, entity must have a '__toString()' method defined", ClassUtils::getClass($entity)), 0, $e);
}
}
if (count($this->identifier) > 1) {
$choices[$key] = $value;
$this->entities[$key] = $entity;
} else {
$id = current($this->getIdentifierValues($entity));
$choices[$id] = $value;
$this->entities[$id] = $entity;
}
}
return $choices;
}
public function getIdentifier()
{
return $this->identifier;
}
public function getEntities()
{
return $this->entities;
}
public function getEntity($key)
{
if (count($this->identifier) > 1) {
$entities = $this->getEntities();
return isset($entities[$key]) ? $entities[$key] : null;
} elseif ($this->entities) {
return isset($this->entities[$key]) ? $this->entities[$key] : null;
}
return $this->modelManager->find($this->class, $key);
}
private function getReflProperty($property)
{
if (!isset($this->reflProperties[$property])) {
$this->reflProperties[$property] = new \ReflectionProperty($this->class, $property);
$this->reflProperties[$property]->setAccessible(true);
}
return $this->reflProperties[$property];
}
public function getIdentifierValues($entity)
{
try {
return $this->modelManager->getIdentifierValues($entity);
} catch (\Exception $e) {
throw new InvalidArgumentException(sprintf("Unable to retrieve the identifier values for entity %s", ClassUtils::getClass($entity)), 0, $e);
}
}
public function getModelManager()
{
return $this->modelManager;
}
public function getClass()
{
return $this->class;
}
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\Form\Exception\TransformationFailedException;
interface DataTransformerInterface
{
public function transform($value);
public function reverseTransform($value);
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Symfony\Component\Form\DataTransformerInterface;
use Sonata\AdminBundle\Model\ModelManagerInterface;
class ArrayToModelTransformer implements DataTransformerInterface
{
protected $modelManager;
protected $className;
public function __construct(ModelManagerInterface $modelManager, $className)
{
$this->modelManager = $modelManager;
$this->className = $className;
}
public function reverseTransform($array)
{
if ($array instanceof $this->className) {
return $array;
}
$instance = new $this->className;
if (!is_array($array)) {
return $instance;
}
return $this->modelManager->modelReverseTransform($this->className, $array);
}
public function transform($value)
{
return $value;
}
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\DataTransformerInterface;
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceList;
class ModelsToArrayTransformer implements DataTransformerInterface
{
protected $choiceList;
public function __construct(ModelChoiceList $choiceList)
{
$this->choiceList = $choiceList;
}
public function transform($collection)
{
if (null === $collection) {
return array();
}
$array = array();
if (count($this->choiceList->getIdentifier()) > 1) {
$availableEntities = $this->choiceList->getEntities();
foreach ($collection as $entity) {
$key = array_search($entity, $availableEntities);
$array[] = $key;
}
} else {
foreach ($collection as $entity) {
$array[] = current($this->choiceList->getIdentifierValues($entity));
}
}
return $array;
}
public function reverseTransform($keys)
{
$collection = $this->choiceList->getModelManager()->getModelCollectionInstance(
$this->choiceList->getClass()
);
if (!$collection instanceof \ArrayAccess) {
throw new UnexpectedTypeException($collection,'\ArrayAccess');
}
if (''=== $keys || null === $keys) {
return $collection;
}
if (!is_array($keys)) {
throw new UnexpectedTypeException($keys,'array');
}
$notFound = array();
foreach ($keys as $key) {
if ($entity = $this->choiceList->getEntity($key)) {
$collection[] = $entity;
} else {
$notFound[] = $key;
}
}
if (count($notFound) > 0) {
throw new TransformationFailedException(sprintf('The entities with keys "%s" could not be found', implode('", "', $notFound)));
}
return $collection;
}
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Symfony\Component\Form\DataTransformerInterface;
use Sonata\AdminBundle\Model\ModelManagerInterface;
class ModelToIdTransformer implements DataTransformerInterface
{
protected $modelManager;
protected $className;
public function __construct(ModelManagerInterface $modelManager, $className)
{
$this->modelManager = $modelManager;
$this->className = $className;
}
public function reverseTransform($newId)
{
if (empty($newId) && !in_array($newId, array("0", 0), true)) {
return null;
}
return $this->modelManager->find($this->className, $newId);
}
public function transform($entity)
{
if (empty($entity)) {
return null;
}
return $this->modelManager->getNormalizedIdentifier($entity);
}
}
}
namespace Sonata\AdminBundle\Form\EventListener
{
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Sonata\AdminBundle\Model\ModelManagerInterface;
class MergeCollectionListener implements EventSubscriberInterface
{
protected $modelManager;
public function __construct(ModelManagerInterface $modelManager)
{
$this->modelManager = $modelManager;
}
public static function getSubscribedEvents()
{
return array(
FormEvents::SUBMIT => array('onBind', 10),
);
}
public function onBind(FormEvent $event)
{
$collection = $event->getForm()->getData();
$data = $event->getData();
$event->stopPropagation();
if (!$collection) {
$collection = $data;
} elseif (count($data) === 0) {
$this->modelManager->collectionClear($collection);
} else {
foreach ($collection as $entity) {
if (!$this->modelManager->collectionHasElement($data, $entity)) {
$this->modelManager->collectionRemoveElement($collection, $entity);
} else {
$this->modelManager->collectionRemoveElement($data, $entity);
}
}
foreach ($data as $entity) {
$this->modelManager->collectionAddElement($collection, $entity);
}
}
$event->setData($collection);
}
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
interface FormTypeExtensionInterface
{
public function buildForm(FormBuilderInterface $builder, array $options);
public function buildView(FormView $view, FormInterface $form, array $options);
public function finishView(FormView $view, FormInterface $form, array $options);
public function setDefaultOptions(OptionsResolverInterface $resolver);
public function getExtendedType();
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
abstract class AbstractTypeExtension implements FormTypeExtensionInterface
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
}
public function finishView(FormView $view, FormInterface $form, array $options)
{
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
}
}
}
namespace Sonata\AdminBundle\Form\Extension\Field\Type
{
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Exception\NoValueException;
class FormTypeFieldExtension extends AbstractTypeExtension
{
protected $defaultClasses = array();
public function __construct(array $defaultClasses = array())
{
$this->defaultClasses = $defaultClasses;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$sonataAdmin = array('name'=> null,'admin'=> null,'value'=> null,'edit'=>'standard','inline'=>'natural','field_description'=> null,'block_name'=> false
);
$builder->setAttribute('sonata_admin_enabled', false);
$builder->setAttribute('sonata_help', false);
if ($options['sonata_field_description'] instanceof FieldDescriptionInterface) {
$fieldDescription = $options['sonata_field_description'];
$sonataAdmin['admin'] = $fieldDescription->getAdmin();
$sonataAdmin['field_description'] = $fieldDescription;
$sonataAdmin['name'] = $fieldDescription->getName();
$sonataAdmin['edit'] = $fieldDescription->getOption('edit','standard');
$sonataAdmin['inline'] = $fieldDescription->getOption('inline','natural');
$sonataAdmin['block_name'] = $fieldDescription->getOption('block_name', false);
$sonataAdmin['class'] = $this->getClass($builder);
$builder->setAttribute('sonata_admin_enabled', true);
}
$builder->setAttribute('sonata_admin', $sonataAdmin);
}
protected function getClass(FormBuilderInterface $formBuilder)
{
foreach ($this->getTypes($formBuilder) as $type) {
if (isset($this->defaultClasses[$type->getName()])) {
return $this->defaultClasses[$type->getName()];
}
}
return'';
}
protected function getTypes(FormBuilderInterface $formBuilder)
{
$types = array();
for ($type = $formBuilder->getType(); null !== $type; $type = $type->getParent()) {
array_unshift($types, $type->getInnerType());
}
return $types;
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$sonataAdmin = $form->getConfig()->getAttribute('sonata_admin');
$sonataAdminHelp = isset($options['sonata_help']) ? $options['sonata_help'] : null;
if ($sonataAdmin && $form->getConfig()->getAttribute('sonata_admin_enabled', true)) {
$sonataAdmin['value'] = $form->getData();
$block_prefixes = $view->vars['block_prefixes'];
$baseName = str_replace('.','_', $sonataAdmin['admin']->getCode());
$baseType = $block_prefixes[count($block_prefixes) - 2];
$blockSuffix = preg_replace("#^_([a-z0-9]{14})_(.++)$#","\$2", array_pop($block_prefixes));
$block_prefixes[] = sprintf('%s_%s', $baseName, $baseType);
$block_prefixes[] = sprintf('%s_%s_%s', $baseName, $sonataAdmin['name'], $baseType);
$block_prefixes[] = sprintf('%s_%s_%s_%s', $baseName, $sonataAdmin['name'], $baseType, $blockSuffix);
if (isset($sonataAdmin['block_name']) && $sonataAdmin['block_name'] !== false) {
$block_prefixes[] = $sonataAdmin['block_name'];
}
$view->vars['block_prefixes'] = $block_prefixes;
$view->vars['sonata_admin_enabled'] = true;
$view->vars['sonata_admin'] = $sonataAdmin;
$attr = $view->vars['attr'];
if (!isset($attr['class']) && isset($sonataAdmin['class'])) {
$attr['class'] = $sonataAdmin['class'];
}
$view->vars['attr'] = $attr;
} else {
$view->vars['sonata_admin_enabled'] = false;
}
$view->vars['sonata_help'] = $sonataAdminHelp;
$view->vars['sonata_admin'] = $sonataAdmin;
}
public function getExtendedType()
{
return'field';
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('sonata_admin'=> null,'sonata_field_description'=> null,'label_render'=> true,'sonata_help'=> null
));
}
public function getValueFromFieldDescription($object, FieldDescriptionInterface $fieldDescription)
{
$value = null;
if (!$object) {
return $value;
}
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
if ($fieldDescription->getAssociationAdmin()) {
$value = $fieldDescription->getAssociationAdmin()->getNewInstance();
}
}
return $value;
}
}
}
namespace Sonata\AdminBundle\Mapper
{
abstract class BaseGroupedMapper extends BaseMapper
{
protected $currentGroup;
protected $currentTab;
abstract protected function getGroups();
abstract protected function getTabs();
abstract protected function setGroups(array $groups);
abstract protected function setTabs(array $tabs);
public function with($name, array $options = array())
{
$defaultOptions = array('collapsed'=> false,'class'=> false,'description'=> false,'translation_domain'=> null,'name'=> $name,
);
$code = $name;
if (array_key_exists('tab', $options) && $options['tab']) {
$tabs = $this->getTabs();
if ($this->currentTab) {
if (isset($tabs[$this->currentTab]['auto_created']) && true === $tabs[$this->currentTab]['auto_created']) {
throw new \RuntimeException('New tab was added automatically when you have added field or group. You should close current tab before adding new one OR add tabs before adding groups and fields.');
} else {
throw new \RuntimeException(sprintf('You should close previous tab "%s" with end() before adding new tab "%s".', $this->currentTab, $name));
}
} elseif ($this->currentGroup) {
throw new \RuntimeException(sprintf('You should open tab before adding new group "%s".', $name));
}
if (!isset($tabs[$name])) {
$tabs[$name] = array();
}
$tabs[$code] = array_merge($defaultOptions, array('auto_created'=> false,'groups'=> array(),
), $tabs[$code], $options);
$this->currentTab = $code;
} else {
if ($this->currentGroup) {
throw new \RuntimeException(sprintf('You should close previous group "%s" with end() before adding new tab "%s".', $this->currentGroup, $name));
}
if (!$this->currentTab) {
$this->with('default', array('tab'=> true,'auto_created'=> true,'translation_domain'=> isset($options['translation_domain']) ? $options['translation_domain'] : null
)); }
if ($this->currentTab !=='default') {
$code = $this->currentTab.'.'.$name; }
$groups = $this->getGroups();
if (!isset($groups[$code])) {
$groups[$code] = array();
}
$groups[$code] = array_merge($defaultOptions, array('fields'=> array(),
), $groups[$code], $options);
$this->currentGroup = $code;
$this->setGroups($groups);
$tabs = $this->getTabs();
}
if ($this->currentGroup && isset($tabs[$this->currentTab]) && !in_array($this->currentGroup, $tabs[$this->currentTab]['groups'])) {
$tabs[$this->currentTab]['groups'][] = $this->currentGroup;
}
$this->setTabs($tabs);
return $this;
}
public function tab($name, array $options = array())
{
return $this->with($name, array_merge($options, array('tab'=> true)));
}
public function end()
{
if ($this->currentGroup !== null) {
$this->currentGroup = null;
} elseif ($this->currentTab !== null) {
$this->currentTab = null;
} else {
throw new \RuntimeException('No open tabs or groups, you cannot use end()');
}
return $this;
}
protected function addFieldToCurrentGroup($fieldName)
{
$currentGroup = $this->getCurrentGroupName();
$groups = $this->getGroups();
$groups[$currentGroup]['fields'][$fieldName] = $fieldName;
$this->setGroups($groups);
return $groups[$currentGroup];
}
protected function getCurrentGroupName()
{
if (!$this->currentGroup) {
$this->with($this->admin->getLabel(), array('auto_created'=> true));
}
return $this->currentGroup;
}
}
}
namespace Sonata\AdminBundle\Form
{
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Form\FormBuilder;
use Sonata\AdminBundle\Mapper\BaseGroupedMapper;
class FormMapper extends BaseGroupedMapper
{
protected $formBuilder;
public function __construct(FormContractorInterface $formContractor, FormBuilder $formBuilder, AdminInterface $admin)
{
parent::__construct($formContractor, $admin);
$this->formBuilder = $formBuilder;
}
public function reorder(array $keys)
{
$this->admin->reorderFormGroup($this->getCurrentGroupName(), $keys);
return $this;
}
public function add($name, $type = null, array $options = array(), array $fieldDescriptionOptions = array())
{
if ($name instanceof FormBuilder) {
$fieldName = $name->getName();
} else {
$fieldName = $name;
}
if (!$name instanceof FormBuilder && strpos($fieldName,'.')!==false && !isset($options['property_path'])) {
$options['property_path'] = $fieldName;
$fieldName = str_replace('.','__', $fieldName);
}
if ($type =='collection') {
$type ='sonata_type_native_collection';
}
$label = $fieldName;
$group = $this->addFieldToCurrentGroup($label);
if (!isset($fieldDescriptionOptions['type']) && is_string($type)) {
$fieldDescriptionOptions['type'] = $type;
}
if ($group['translation_domain'] && !isset($fieldDescriptionOptions['translation_domain'])) {
$fieldDescriptionOptions['translation_domain'] = $group['translation_domain'];
}
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name instanceof FormBuilder ? $name->getName() : $name,
$fieldDescriptionOptions
);
$this->builder->fixFieldDescription($this->admin, $fieldDescription, $fieldDescriptionOptions);
if ($fieldName != $name) {
$fieldDescription->setName($fieldName);
}
$this->admin->addFormFieldDescription($fieldName, $fieldDescription);
if ($name instanceof FormBuilder) {
$this->formBuilder->add($name);
} else {
$options = array_replace_recursive($this->builder->getDefaultOptions($type, $fieldDescription), $options);
if (!isset($options['label_render'])) {
$options['label_render'] = false;
}
if (!isset($options['label'])) {
$options['label'] = $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'form','label');
}
$help = null;
if (isset($options['help'])) {
$help = $options['help'];
unset($options['help']);
}
$this->formBuilder->add($fieldDescription->getName(), $type, $options);
if (null !== $help) {
$this->admin->getFormFieldDescription($fieldDescription->getName())->setHelp($help);
}
}
return $this;
}
public function get($name)
{
return $this->formBuilder->get($name);
}
public function has($key)
{
return $this->formBuilder->has($key);
}
public function remove($key)
{
$this->admin->removeFormFieldDescription($key);
$this->admin->removeFieldFromFormGroup($key);
$this->formBuilder->remove($key);
return $this;
}
public function getFormBuilder()
{
return $this->formBuilder;
}
public function create($name, $type = null, array $options = array())
{
return $this->formBuilder->create($name, $type, $options);
}
public function setHelps(array $helps = array())
{
foreach ($helps as $name => $help) {
if ($this->admin->hasFormFieldDescription($name)) {
$this->admin->getFormFieldDescription($name)->setHelp($help);
}
}
return $this;
}
protected function getGroups()
{
return $this->admin->getFormGroups();
}
protected function setGroups(array $groups)
{
$this->admin->setFormGroups($groups);
}
protected function getTabs()
{
return $this->admin->getFormTabs();
}
protected function setTabs(array $tabs)
{
$this->admin->setFormTabs($tabs);
}
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
interface FormTypeInterface
{
public function buildForm(FormBuilderInterface $builder, array $options);
public function buildView(FormView $view, FormInterface $form, array $options);
public function finishView(FormView $view, FormInterface $form, array $options);
public function setDefaultOptions(OptionsResolverInterface $resolver);
public function getParent();
public function getName();
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
abstract class AbstractType implements FormTypeInterface
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
}
public function finishView(FormView $view, FormInterface $form, array $options)
{
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
}
public function getParent()
{
return'form';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Form\DataTransformer\ArrayToModelTransformer;
class AdminType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$admin = clone $this->getAdmin($options);
if ($admin->hasParentFieldDescription()) {
$admin->getParentFieldDescription()->setAssociationAdmin($admin);
}
if ($options['delete'] && $admin->isGranted('DELETE')) {
if (!array_key_exists('translation_domain', $options['delete_options']['type_options'])) {
$options['delete_options']['type_options']['translation_domain'] = $admin->getTranslationDomain();
}
$builder->add('_delete', $options['delete_options']['type'], $options['delete_options']['type_options']);
}
$admin->setSubject($builder->getData());
$admin->defineFormBuilder($builder);
$builder->addModelTransformer(new ArrayToModelTransformer($admin->getModelManager(), $admin->getClass()));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('delete'=> function (Options $options) {
return ($options['btn_delete'] !== false);
},'delete_options'=> array('type'=>'checkbox','type_options'=> array('required'=> false,'mapped'=> false,
),
),'auto_initialize'=> false,'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle'));
}
protected function getFieldDescription(array $options)
{
if (!isset($options['sonata_field_description'])) {
throw new \RuntimeException('Please provide a valid `sonata_field_description` option');
}
return $options['sonata_field_description'];
}
protected function getAdmin(array $options)
{
return $this->getFieldDescription($options)->getAssociationAdmin();
}
public function getName()
{
return'sonata_type_admin';
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ChoiceType extends AbstractType
{
const TYPE_CONTAINS = 1;
const TYPE_NOT_CONTAINS = 2;
const TYPE_EQUAL = 3;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_choice';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_CONTAINS => $this->translator->trans('label_type_contains', array(),'SonataAdminBundle'),
self::TYPE_NOT_CONTAINS => $this->translator->trans('label_type_not_contains', array(),'SonataAdminBundle'),
self::TYPE_EQUAL => $this->translator->trans('label_type_equals', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'choice','field_options'=> array()
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DateRangeType extends AbstractType
{
const TYPE_BETWEEN = 1;
const TYPE_NOT_BETWEEN = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_date_range';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_BETWEEN => $this->translator->trans('label_date_type_between', array(),'SonataAdminBundle'),
self::TYPE_NOT_BETWEEN => $this->translator->trans('label_date_type_not_between', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array('field_options'=> $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'sonata_type_date_range','field_options'=> array('format'=>'yyyy-MM-dd')
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DateTimeRangeType extends AbstractType
{
const TYPE_BETWEEN = 1;
const TYPE_NOT_BETWEEN = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_datetime_range';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_BETWEEN => $this->translator->trans('label_date_type_between', array(),'SonataAdminBundle'),
self::TYPE_NOT_BETWEEN => $this->translator->trans('label_date_type_not_between', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array('field_options'=> $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'sonata_type_datetime_range','field_options'=> array('date_format'=>'yyyy-MM-dd')
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DateTimeType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
const TYPE_NULL = 6;
const TYPE_NOT_NULL = 7;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_datetime';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_EQUAL => $this->translator->trans('label_date_type_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_EQUAL => $this->translator->trans('label_date_type_greater_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_THAN => $this->translator->trans('label_date_type_greater_than', array(),'SonataAdminBundle'),
self::TYPE_LESS_EQUAL => $this->translator->trans('label_date_type_less_equal', array(),'SonataAdminBundle'),
self::TYPE_LESS_THAN => $this->translator->trans('label_date_type_less_than', array(),'SonataAdminBundle'),
self::TYPE_NULL => $this->translator->trans('label_date_type_null', array(),'SonataAdminBundle'),
self::TYPE_NOT_NULL => $this->translator->trans('label_date_type_not_null', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'datetime','field_options'=> array('date_format'=>'yyyy-MM-dd')
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Optionsresolver\OptionsResolverInterface;
class DateType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
const TYPE_NULL = 6;
const TYPE_NOT_NULL = 7;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_date';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_EQUAL => $this->translator->trans('label_date_type_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_EQUAL => $this->translator->trans('label_date_type_greater_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_THAN => $this->translator->trans('label_date_type_greater_than', array(),'SonataAdminBundle'),
self::TYPE_LESS_EQUAL => $this->translator->trans('label_date_type_less_equal', array(),'SonataAdminBundle'),
self::TYPE_LESS_THAN => $this->translator->trans('label_date_type_less_than', array(),'SonataAdminBundle'),
self::TYPE_NULL => $this->translator->trans('label_date_type_null', array(),'SonataAdminBundle'),
self::TYPE_NOT_NULL => $this->translator->trans('label_date_type_not_null', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'date','field_options'=> array('date_format'=>'yyyy-MM-dd')
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DefaultType extends AbstractType
{
public function getName()
{
return'sonata_type_filter_default';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('type', $options['operator_type'], array_merge(array('required'=> false), $options['operator_options']))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('operator_type'=>'hidden','operator_options'=> array(),'field_type'=>'text','field_options'=> array()
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class NumberType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_number';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_EQUAL => $this->translator->trans('label_type_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_EQUAL => $this->translator->trans('label_type_greater_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_THAN => $this->translator->trans('label_type_greater_than', array(),'SonataAdminBundle'),
self::TYPE_LESS_EQUAL => $this->translator->trans('label_type_less_equal', array(),'SonataAdminBundle'),
self::TYPE_LESS_THAN => $this->translator->trans('label_type_less_than', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'number','field_options'=> array(),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
class ModelReferenceType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder->addModelTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']));
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('compound'=> false,'model_manager'=> null,'class'=> null,
));
}
public function getParent()
{
return'text';
}
public function getName()
{
return'sonata_type_model_reference';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Form\EventListener\MergeCollectionListener;
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceList;
use Sonata\AdminBundle\Form\DataTransformer\ModelsToArrayTransformer;
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
class ModelType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
if ($options['multiple']) {
$builder
->addEventSubscriber(new MergeCollectionListener($options['model_manager']))
->addViewTransformer(new ModelsToArrayTransformer($options['choice_list']), true);
} else {
$builder
->addViewTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']), true)
;
}
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('compound'=> function (Options $options) {
if (isset($options['multiple']) && $options['multiple']) {
if (isset($options['expanded']) && $options['expanded']) {
return true;
}
return false;
}
if (isset($options['expanded']) && $options['expanded']) {
return true;
}
return false;
},'template'=>'choice','multiple'=> false,'expanded'=> false,'model_manager'=> null,'class'=> null,'property'=> null,'query'=> null,'choices'=> null,'preferred_choices'=> array(),'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle','choice_list'=> function (Options $options, $previousValue) {
if ($previousValue instanceof ChoiceListInterface && count($choices = $previousValue->getChoices())) {
return $choices;
}
return new ModelChoiceList(
$options['model_manager'],
$options['class'],
$options['property'],
$options['query'],
$options['choices']
);
}
));
}
public function getParent()
{
return'choice';
}
public function getName()
{
return'sonata_type_model';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
class ModelTypeList extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->resetViewTransformers()
->addViewTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
if (isset($view->vars['sonata_admin'])) {
$view->vars['sonata_admin']['edit'] ='list';
}
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('model_manager'=> null,'class'=> null,'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle'));
}
public function getParent()
{
return'text';
}
public function getName()
{
return'sonata_type_model_list';
}
}
}
namespace Sonata\AdminBundle\Guesser
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
interface TypeGuesserInterface
{
public function guessType($class, $property, ModelManagerInterface $modelManager);
}
}
namespace Sonata\AdminBundle\Guesser
{
use Sonata\AdminBundle\Guesser\TypeGuesserInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Guess\Guess;
use Sonata\AdminBundle\Model\ModelManagerInterface;
class TypeGuesserChain implements TypeGuesserInterface
{
protected $guessers = array();
public function __construct(array $guessers)
{
foreach ($guessers as $guesser) {
if (!$guesser instanceof TypeGuesserInterface) {
throw new UnexpectedTypeException($guesser,'Sonata\AdminBundle\Guesser\TypeGuesserInterface');
}
if ($guesser instanceof self) {
$this->guessers = array_merge($this->guessers, $guesser->guessers);
} else {
$this->guessers[] = $guesser;
}
}
}
public function guessType($class, $property, ModelManagerInterface $modelManager)
{
return $this->guess(function ($guesser) use ($class, $property, $modelManager) {
return $guesser->guessType($class, $property, $modelManager);
});
}
private function guess(\Closure $closure)
{
$guesses = array();
foreach ($this->guessers as $guesser) {
if ($guess = $closure($guesser)) {
$guesses[] = $guess;
}
}
return Guess::getBestGuess($guesses);
}
}
}
namespace Sonata\AdminBundle\Model
{
interface AuditManagerInterface
{
public function setReader($serviceId, array $classes);
public function hasReader($class);
public function getReader($class);
}
}
namespace Sonata\AdminBundle\Model
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class AuditManager implements AuditManagerInterface
{
protected $classes = array();
protected $readers = array();
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function setReader($serviceId, array $classes)
{
$this->readers[$serviceId] = $classes;
}
public function hasReader($class)
{
foreach ($this->readers as $classes) {
if (in_array($class, $classes)) {
return true;
}
}
return false;
}
public function getReader($class)
{
foreach ($this->readers as $readerId => $classes) {
if (in_array($class, $classes)) {
return $this->container->get($readerId);
}
}
throw new \RuntimeException(sprintf('The class "%s" does not have any reader manager', $class));
}
}
}
namespace Sonata\AdminBundle\Model
{
interface AuditReaderInterface
{
public function find($className, $id, $revision);
public function findRevisionHistory($className, $limit = 20, $offset = 0);
public function findRevision($classname, $revision);
public function findRevisions($className, $id);
public function diff($className, $id, $oldRevision, $newRevision);
}
}
namespace Sonata\AdminBundle\Model
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
interface ModelManagerInterface
{
public function getNewFieldDescriptionInstance($class, $name, array $options = array());
public function create($object);
public function update($object);
public function delete($object);
public function findBy($class, array $criteria = array());
public function findOneBy($class, array $criteria = array());
public function find($class, $id);
public function batchDelete($class, ProxyQueryInterface $queryProxy);
public function getParentFieldDescription($parentAssociationMapping, $class);
public function createQuery($class, $alias ='o');
public function getModelIdentifier($class);
public function getIdentifierValues($model);
public function getIdentifierFieldNames($class);
public function getNormalizedIdentifier($model);
public function getUrlsafeIdentifier($model);
public function getModelInstance($class);
public function getModelCollectionInstance($class);
public function collectionRemoveElement(&$collection, &$element);
public function collectionAddElement(&$collection, &$element);
public function collectionHasElement(&$collection, &$element);
public function collectionClear(&$collection);
public function getSortParameters(FieldDescriptionInterface $fieldDescription, DatagridInterface $datagrid);
public function getDefaultSortValues($class);
public function modelReverseTransform($class, array $array = array());
public function modelTransform($class, $instance);
public function executeQuery($query);
public function getDataSourceIterator(DatagridInterface $datagrid, array $fields, $firstResult = null, $maxResult = null);
public function getExportFields($class);
public function getPaginationParameters(DatagridInterface $datagrid, $page);
public function addIdentifiersToQuery($class, ProxyQueryInterface $query, array $idx);
}
}
namespace Symfony\Component\Config\Loader
{
interface LoaderInterface
{
public function load($resource, $type = null);
public function supports($resource, $type = null);
public function getResolver();
public function setResolver(LoaderResolverInterface $resolver);
}
}
namespace Symfony\Component\Config\Loader
{
use Symfony\Component\Config\Exception\FileLoaderLoadException;
abstract class Loader implements LoaderInterface
{
protected $resolver;
public function getResolver()
{
return $this->resolver;
}
public function setResolver(LoaderResolverInterface $resolver)
{
$this->resolver = $resolver;
}
public function import($resource, $type = null)
{
return $this->resolve($resource, $type)->load($resource, $type);
}
public function resolve($resource, $type = null)
{
if ($this->supports($resource, $type)) {
return $this;
}
$loader = null === $this->resolver ? false : $this->resolver->resolve($resource, $type);
if (false === $loader) {
throw new FileLoaderLoadException($resource);
}
return $loader;
}
}
}
namespace Symfony\Component\Config\Loader
{
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Config\Exception\FileLoaderLoadException;
use Symfony\Component\Config\Exception\FileLoaderImportCircularReferenceException;
abstract class FileLoader extends Loader
{
protected static $loading = array();
protected $locator;
private $currentDir;
public function __construct(FileLocatorInterface $locator)
{
$this->locator = $locator;
}
public function setCurrentDir($dir)
{
$this->currentDir = $dir;
}
public function getLocator()
{
return $this->locator;
}
public function import($resource, $type = null, $ignoreErrors = false, $sourceResource = null)
{
try {
$loader = $this->resolve($resource, $type);
if ($loader instanceof FileLoader && null !== $this->currentDir) {
$locator = $loader->getLocator() ?: $this->locator;
$resource = $locator->locate($resource, $this->currentDir, false);
}
$resources = is_array($resource) ? $resource : array($resource);
for ($i = 0; $i < $resourcesCount = count($resources); $i++) {
if (isset(self::$loading[$resources[$i]])) {
if ($i == $resourcesCount-1) {
throw new FileLoaderImportCircularReferenceException(array_keys(self::$loading));
}
} else {
$resource = $resources[$i];
break;
}
}
self::$loading[$resource] = true;
$ret = $loader->load($resource, $type);
unset(self::$loading[$resource]);
return $ret;
} catch (FileLoaderImportCircularReferenceException $e) {
throw $e;
} catch (\Exception $e) {
if (!$ignoreErrors) {
if ($e instanceof FileLoaderLoadException) {
throw $e;
}
throw new FileLoaderLoadException($resource, $sourceResource, null, $e);
}
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Symfony\Component\Routing\RouteCollection as SymfonyRouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Config\Resource\FileResource;
use Sonata\AdminBundle\Admin\Pool;
use Symfony\Component\DependencyInjection\ContainerInterface;
class AdminPoolLoader extends FileLoader
{
protected $pool;
protected $adminServiceIds = array();
protected $container;
public function __construct(Pool $pool, $adminServiceIds, ContainerInterface $container)
{
$this->pool = $pool;
$this->adminServiceIds = $adminServiceIds;
$this->container = $container;
}
public function supports($resource, $type = null)
{
if ($type =='sonata_admin') {
return true;
}
return false;
}
public function load($resource, $type = null)
{
$collection = new SymfonyRouteCollection;
foreach ($this->adminServiceIds as $id) {
$admin = $this->pool->getInstance($id);
foreach ($admin->getRoutes()->getElements() as $code => $route) {
$collection->add($route->getDefault('_sonata_name'), $route);
}
$reflection = new \ReflectionObject($admin);
$collection->addResource(new FileResource($reflection->getFileName()));
}
$reflection = new \ReflectionObject($this->container);
$collection->addResource(new FileResource($reflection->getFileName()));
return $collection;
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
interface RouteGeneratorInterface
{
public function generateUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false);
public function generateMenuUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false);
public function generate($name, array $parameters = array(), $absolute = false);
public function hasAdminRoute(AdminInterface $admin, $name);
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Routing\RouterInterface;
class DefaultRouteGenerator implements RouteGeneratorInterface
{
private $router;
private $cache;
private $caches = array();
private $loaded = array();
public function __construct(RouterInterface $router, RoutesCache $cache)
{
$this->router = $router;
$this->cache = $cache;
}
public function generate($name, array $parameters = array(), $absolute = false)
{
return $this->router->generate($name, $parameters, $absolute);
}
public function generateUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false)
{
$arrayRoute = $this->generateMenuUrl($admin, $name, $parameters, $absolute);
return $this->router->generate($arrayRoute['route'], $arrayRoute['routeParameters'], $arrayRoute['routeAbsolute']);
}
public function generateMenuUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false)
{
if ($admin->isChild() && $admin->hasRequest() && $admin->getRequest()->attributes->has($admin->getParent()->getIdParameter())) {
if (isset($parameters['id'])) {
$parameters[$admin->getIdParameter()] = $parameters['id'];
unset($parameters['id']);
}
$parameters[$admin->getParent()->getIdParameter()] = $admin->getRequest()->attributes->get($admin->getParent()->getIdParameter());
}
if ($admin->hasParentFieldDescription()) {
$parameters = array_merge($parameters, $admin->getParentFieldDescription()->getOption('link_parameters', array()));
$parameters['uniqid'] = $admin->getUniqid();
$parameters['code'] = $admin->getCode();
$parameters['pcode'] = $admin->getParentFieldDescription()->getAdmin()->getCode();
$parameters['puniqid'] = $admin->getParentFieldDescription()->getAdmin()->getUniqid();
}
if ($name =='update'|| substr($name, -7) =='|update') {
$parameters['uniqid'] = $admin->getUniqid();
$parameters['code'] = $admin->getCode();
}
if ($admin->hasRequest()) {
$parameters = array_merge($admin->getPersistentParameters(), $parameters);
}
$code = $this->getCode($admin, $name);
if (!array_key_exists($code, $this->caches)) {
throw new \RuntimeException(sprintf('unable to find the route `%s`', $code));
}
return array('route'=> $this->caches[$code],'routeParameters'=> $parameters,'routeAbsolute'=> $absolute
);
}
public function hasAdminRoute(AdminInterface $admin, $name)
{
return array_key_exists($this->getCode($admin, $name), $this->caches);
}
private function getCode(AdminInterface $admin, $name)
{
$this->loadCache($admin);
if ($admin->isChild()) {
return $admin->getBaseCodeRoute().'.'.$name;
}
if (array_key_exists($name, $this->caches)) {
return $name;
}
if (strpos($name,'.')) {
return $admin->getCode().'|'.$name;
}
return $admin->getCode().'.'.$name;
}
private function loadCache(AdminInterface $admin)
{
if (in_array($admin->getCode(), $this->loaded)) {
return;
}
$this->caches = array_merge($this->cache->load($admin), $this->caches);
$this->loaded[] = $admin->getCode();
if ($admin->isChild()) {
$this->loadCache($admin->getParent());
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Model\AuditManagerInterface;
class PathInfoBuilder implements RouteBuilderInterface
{
protected $manager;
public function __construct(AuditManagerInterface $manager)
{
$this->manager = $manager;
}
public function build(AdminInterface $admin, RouteCollection $collection)
{
$collection->add('list');
$collection->add('create');
$collection->add('batch');
$collection->add('edit', $admin->getRouterIdParameter().'/edit');
$collection->add('delete', $admin->getRouterIdParameter().'/delete');
$collection->add('show', $admin->getRouterIdParameter().'/show');
$collection->add('export');
if ($this->manager->hasReader($admin->getClass())) {
$collection->add('history', $admin->getRouterIdParameter().'/history');
$collection->add('history_view_revision', $admin->getRouterIdParameter().'/history/{revision}/view');
$collection->add('history_compare_revisions', $admin->getRouterIdParameter().'/history/{base_revision}/{compare_revision}/compare');
}
if ($admin->isAclEnabled()) {
$collection->add('acl', $admin->getRouterIdParameter().'/acl');
}
if ($admin->getParent()) {
return;
}
foreach ($admin->getChildren() as $children) {
$collection->addCollection($children->getRoutes());
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Model\AuditManagerInterface;
class QueryStringBuilder implements RouteBuilderInterface
{
protected $manager;
public function __construct(AuditManagerInterface $manager)
{
$this->manager = $manager;
}
public function build(AdminInterface $admin, RouteCollection $collection)
{
$collection->add('list');
$collection->add('create');
$collection->add('batch');
$collection->add('edit');
$collection->add('delete');
$collection->add('show');
$collection->add('export');
if ($this->manager->hasReader($admin->getClass())) {
$collection->add('history','/audit-history');
$collection->add('history_view_revision','/audit-history-view');
$collection->add('history_compare_revisions','/audit-history-compare');
}
if ($admin->isAclEnabled()) {
$collection->add('acl', $admin->getRouterIdParameter().'/acl');
}
if ($admin->getParent()) {
return;
}
foreach ($admin->getChildren() as $children) {
$collection->addCollection($children->getRoutes());
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Symfony\Component\Routing\Route;
class RouteCollection
{
protected $elements = array();
protected $baseCodeRoute;
protected $baseRouteName;
protected $baseControllerName;
protected $baseRoutePattern;
public function __construct($baseCodeRoute, $baseRouteName, $baseRoutePattern, $baseControllerName)
{
$this->baseCodeRoute = $baseCodeRoute;
$this->baseRouteName = $baseRouteName;
$this->baseRoutePattern = $baseRoutePattern;
$this->baseControllerName = $baseControllerName;
}
public function add($name, $pattern = null, array $defaults = array(), array $requirements = array(), array $options = array())
{
$pattern = $this->baseRoutePattern .'/'. ($pattern ?: $name);
$code = $this->getCode($name);
$routeName = $this->baseRouteName .'_'. $name;
if (!isset($defaults['_controller'])) {
$defaults['_controller'] = $this->baseControllerName .':'. $this->actionify($code);
}
if (!isset($defaults['_sonata_admin'])) {
$defaults['_sonata_admin'] = $this->baseCodeRoute;
}
$defaults['_sonata_name'] = $routeName;
$this->elements[$this->getCode($name)] = function() use ($pattern, $defaults, $requirements, $options) {
return new Route($pattern, $defaults, $requirements, $options);
};
return $this;
}
public function getCode($name)
{
if (strrpos($name,'.') !== false) {
return $name;
}
return $this->baseCodeRoute .'.'. $name;
}
public function addCollection(RouteCollection $collection)
{
foreach ($collection->getElements() as $code => $route) {
$this->elements[$code] = $route;
}
return $this;
}
private function resolve($element)
{
if (is_callable($element)) {
return call_user_func($element);
}
return $element;
}
public function getElements()
{
foreach ($this->elements as $name => $element) {
$this->elements[$name] = $this->resolve($element);
}
return $this->elements;
}
public function has($name)
{
return array_key_exists($this->getCode($name), $this->elements);
}
public function get($name)
{
if ($this->has($name)) {
$code = $this->getCode($name);
$this->elements[$code] = $this->resolve($this->elements[$code]);
return $this->elements[$code];
}
throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
}
public function remove($name)
{
unset($this->elements[$this->getCode($name)]);
return $this;
}
public function clearExcept(array $routeList)
{
$routeCodeList = array();
foreach ($routeList as $name) {
$routeCodeList[] = $this->getCode($name);
}
$elements = $this->elements;
foreach ($elements as $key => $element) {
if (!in_array($key, $routeCodeList)) {
unset($this->elements[$key]);
}
}
return $this;
}
public function clear()
{
$this->elements = array();
return $this;
}
public function actionify($action)
{
if (($pos = strrpos($action,'.')) !== false) {
$action = substr($action, $pos + 1);
}
if (strpos($this->baseControllerName,':') === false) {
$action .='Action';
}
return lcfirst(str_replace(' ','', ucwords(strtr($action,'_-','  '))));
}
public function getBaseCodeRoute()
{
return $this->baseCodeRoute;
}
public function getBaseControllerName()
{
return $this->baseControllerName;
}
public function getBaseRouteName()
{
return $this->baseRouteName;
}
public function getBaseRoutePattern()
{
return $this->baseRoutePattern;
}
}}
namespace Symfony\Component\Security\Acl\Permission
{
interface PermissionMapInterface
{
public function getMasks($permission, $object);
public function contains($permission);
}
}
namespace Sonata\AdminBundle\Security\Acl\Permission
{
use Symfony\Component\Security\Acl\Permission\PermissionMapInterface;
class AdminPermissionMap implements PermissionMapInterface
{
const PERMISSION_VIEW ='VIEW';
const PERMISSION_EDIT ='EDIT';
const PERMISSION_CREATE ='CREATE';
const PERMISSION_DELETE ='DELETE';
const PERMISSION_UNDELETE ='UNDELETE';
const PERMISSION_LIST ='LIST';
const PERMISSION_EXPORT ='EXPORT';
const PERMISSION_OPERATOR ='OPERATOR';
const PERMISSION_MASTER ='MASTER';
const PERMISSION_OWNER ='OWNER';
private $map = array(
self::PERMISSION_VIEW => array(
MaskBuilder::MASK_VIEW,
MaskBuilder::MASK_LIST,
MaskBuilder::MASK_EDIT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_EDIT => array(
MaskBuilder::MASK_EDIT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_CREATE => array(
MaskBuilder::MASK_CREATE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_DELETE => array(
MaskBuilder::MASK_DELETE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_UNDELETE => array(
MaskBuilder::MASK_UNDELETE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_LIST => array(
MaskBuilder::MASK_LIST,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_EXPORT => array(
MaskBuilder::MASK_EXPORT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_OPERATOR => array(
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER
),
self::PERMISSION_MASTER => array(
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_OWNER => array(
MaskBuilder::MASK_OWNER,
),
);
public function getMasks($permission, $object)
{
if (!isset($this->map[$permission])) {
return null;
}
return $this->map[$permission];
}
public function contains($permission)
{
return isset($this->map[$permission]);
}
}
}
namespace Symfony\Component\Security\Acl\Permission
{
class MaskBuilder
{
const MASK_VIEW = 1; const MASK_CREATE = 2; const MASK_EDIT = 4; const MASK_DELETE = 8; const MASK_UNDELETE = 16; const MASK_OPERATOR = 32; const MASK_MASTER = 64; const MASK_OWNER = 128; const MASK_IDDQD = 1073741823;
const CODE_VIEW ='V';
const CODE_CREATE ='C';
const CODE_EDIT ='E';
const CODE_DELETE ='D';
const CODE_UNDELETE ='U';
const CODE_OPERATOR ='O';
const CODE_MASTER ='M';
const CODE_OWNER ='N';
const ALL_OFF ='................................';
const OFF ='.';
const ON ='*';
private $mask;
public function __construct($mask = 0)
{
if (!is_int($mask)) {
throw new \InvalidArgumentException('$mask must be an integer.');
}
$this->mask = $mask;
}
public function add($mask)
{
$this->mask |= $this->getMask($mask);
return $this;
}
public function get()
{
return $this->mask;
}
public function getPattern()
{
$pattern = self::ALL_OFF;
$length = strlen($pattern);
$bitmask = str_pad(decbin($this->mask), $length,'0', STR_PAD_LEFT);
for ($i = $length-1; $i >= 0; $i--) {
if ('1'=== $bitmask[$i]) {
try {
$pattern[$i] = self::getCode(1 << ($length - $i - 1));
} catch (\Exception $notPredefined) {
$pattern[$i] = self::ON;
}
}
}
return $pattern;
}
public function remove($mask)
{
$this->mask &= ~$this->getMask($mask);
return $this;
}
public function reset()
{
$this->mask = 0;
return $this;
}
public static function getCode($mask)
{
if (!is_int($mask)) {
throw new \InvalidArgumentException('$mask must be an integer.');
}
$reflection = new \ReflectionClass(get_called_class());
foreach ($reflection->getConstants() as $name => $cMask) {
if (0 !== strpos($name,'MASK_') || $mask !== $cMask) {
continue;
}
if (!defined($cName ='static::CODE_'.substr($name, 5))) {
throw new \RuntimeException('There was no code defined for this mask.');
}
return constant($cName);
}
throw new \InvalidArgumentException(sprintf('The mask "%d" is not supported.', $mask));
}
private function getMask($code)
{
if (is_string($code)) {
if (!defined($name = sprintf('static::MASK_%s', strtoupper($code)))) {
throw new \InvalidArgumentException(sprintf('The code "%s" is not supported', $code));
}
return constant($name);
}
if (!is_int($code)) {
throw new \InvalidArgumentException('$code must be an integer.');
}
return $code;
}
}
}
namespace Sonata\AdminBundle\Security\Acl\Permission
{
use Symfony\Component\Security\Acl\Permission\MaskBuilder as BaseMaskBuilder;
class MaskBuilder extends BaseMaskBuilder
{
const MASK_LIST = 4096; const MASK_EXPORT = 8192;
const CODE_LIST ='L';
const CODE_EXPORT ='E';
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
interface SecurityHandlerInterface
{
public function isGranted(AdminInterface $admin, $attributes, $object = null);
public function getBaseRole(AdminInterface $admin);
public function buildSecurityInformation(AdminInterface $admin);
public function createObjectSecurity(AdminInterface $admin, $object);
public function deleteObjectSecurity(AdminInterface $admin, $object);
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Model\ObjectIdentityInterface;
interface AclSecurityHandlerInterface extends SecurityHandlerInterface
{
public function setAdminPermissions(array $permissions);
public function getAdminPermissions();
public function setObjectPermissions(array $permissions);
public function getObjectPermissions();
public function getObjectAcl(ObjectIdentityInterface $objectIdentity);
public function findObjectAcls(\Traversable $oids, array $sids = array());
public function addObjectOwner(AclInterface $acl, UserSecurityIdentity $securityIdentity = null);
public function addObjectClassAces(AclInterface $acl, array $roleInformation = array());
public function createAcl(ObjectIdentityInterface $objectIdentity);
public function updateAcl(AclInterface $acl);
public function deleteAcl(ObjectIdentityInterface $objectIdentity);
public function findClassAceIndexByRole(AclInterface $acl, $role);
public function findClassAceIndexByUsername(AclInterface $acl, $username);
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Acl\Model\MutableAclProviderInterface;
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Model\ObjectIdentityInterface;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;
use Symfony\Component\Security\Acl\Exception\NotAllAclsFoundException;
use Sonata\AdminBundle\Admin\AdminInterface;
class AclSecurityHandler implements AclSecurityHandlerInterface
{
protected $securityContext;
protected $aclProvider;
protected $superAdminRoles;
protected $adminPermissions;
protected $objectPermissions;
protected $maskBuilderClass;
public function __construct(SecurityContextInterface $securityContext, MutableAclProviderInterface $aclProvider, $maskBuilderClass, array $superAdminRoles)
{
$this->securityContext = $securityContext;
$this->aclProvider = $aclProvider;
$this->maskBuilderClass = $maskBuilderClass;
$this->superAdminRoles = $superAdminRoles;
}
public function setAdminPermissions(array $permissions)
{
$this->adminPermissions = $permissions;
}
public function getAdminPermissions()
{
return $this->adminPermissions;
}
public function setObjectPermissions(array $permissions)
{
$this->objectPermissions = $permissions;
}
public function getObjectPermissions()
{
return $this->objectPermissions;
}
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
if (!is_array($attributes)) {
$attributes = array($attributes);
}
try {
return $this->securityContext->isGranted($this->superAdminRoles) || $this->securityContext->isGranted($attributes, $object);
} catch (AuthenticationCredentialsNotFoundException $e) {
return false;
} catch (\Exception $e) {
throw $e;
}
}
public function getBaseRole(AdminInterface $admin)
{
return'ROLE_'. str_replace('.','_', strtoupper($admin->getCode())) .'_%s';
}
public function buildSecurityInformation(AdminInterface $admin)
{
$baseRole = $this->getBaseRole($admin);
$results = array();
foreach ($admin->getSecurityInformation() as $role => $permissions) {
$results[sprintf($baseRole, $role)] = $permissions;
}
return $results;
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
$objectIdentity = ObjectIdentity::fromDomainObject($object);
$acl = $this->getObjectAcl($objectIdentity);
if (is_null($acl)) {
$acl = $this->createAcl($objectIdentity);
}
$user = $this->securityContext->getToken()->getUser();
$securityIdentity = UserSecurityIdentity::fromAccount($user);
$this->addObjectOwner($acl, $securityIdentity);
$this->addObjectClassAces($acl, $this->buildSecurityInformation($admin));
$this->updateAcl($acl);
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
$objectIdentity = ObjectIdentity::fromDomainObject($object);
$this->deleteAcl($objectIdentity);
}
public function getObjectAcl(ObjectIdentityInterface $objectIdentity)
{
try {
$acl = $this->aclProvider->findAcl($objectIdentity);
} catch (AclNotFoundException $e) {
return null;
}
return $acl;
}
public function findObjectAcls(\Traversable $oids, array $sids = array())
{
try {
$acls = $this->aclProvider->findAcls(iterator_to_array($oids), $sids);
} catch (\Exception $e) {
if ($e instanceof NotAllAclsFoundException) {
$acls = $e->getPartialResult();
} elseif ($e instanceof AclNotFoundException) {
$acls = new \SplObjectStorage();
} else {
throw $e;
}
}
return $acls;
}
public function addObjectOwner(AclInterface $acl, UserSecurityIdentity $securityIdentity = null)
{
if (false === $this->findClassAceIndexByUsername($acl, $securityIdentity->getUsername())) {
$acl->insertObjectAce($securityIdentity, constant("$this->maskBuilderClass::MASK_OWNER"));
}
}
public function addObjectClassAces(AclInterface $acl, array $roleInformation = array())
{
$builder = new $this->maskBuilderClass();
foreach ($roleInformation as $role => $permissions) {
$aceIndex = $this->findClassAceIndexByRole($acl, $role);
$hasRole = false;
foreach ($permissions as $permission) {
if (in_array($permission, $this->getObjectPermissions())) {
$builder->add($permission);
$hasRole = true;
}
}
if ($hasRole) {
if ($aceIndex === false) {
$acl->insertClassAce(new RoleSecurityIdentity($role), $builder->get());
} else {
$acl->updateClassAce($aceIndex, $builder->get());
}
$builder->reset();
} elseif ($aceIndex !== false) {
$acl->deleteClassAce($aceIndex);
}
}
}
public function createAcl(ObjectIdentityInterface $objectIdentity)
{
return $this->aclProvider->createAcl($objectIdentity);
}
public function updateAcl(AclInterface $acl)
{
$this->aclProvider->updateAcl($acl);
}
public function deleteAcl(ObjectIdentityInterface $objectIdentity)
{
$this->aclProvider->deleteAcl($objectIdentity);
}
public function findClassAceIndexByRole(AclInterface $acl, $role)
{
foreach ($acl->getClassAces() as $index => $entry) {
if ($entry->getSecurityIdentity() instanceof RoleSecurityIdentity && $entry->getSecurityIdentity()->getRole() === $role) {
return $index;
}
}
return false;
}
public function findClassAceIndexByUsername(AclInterface $acl, $username)
{
foreach ($acl->getClassAces() as $index => $entry) {
if ($entry->getSecurityIdentity() instanceof UserSecurityIdentity && $entry->getSecurityIdentity()->getUsername() === $username) {
return $index;
}
}
return false;
}
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
class NoopSecurityHandler implements SecurityHandlerInterface
{
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
return true;
}
public function getBaseRole(AdminInterface $admin)
{
return'';
}
public function buildSecurityInformation(AdminInterface $admin)
{
return array();
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
}
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Sonata\AdminBundle\Admin\AdminInterface;
class RoleSecurityHandler implements SecurityHandlerInterface
{
protected $securityContext;
protected $superAdminRoles;
public function __construct(SecurityContextInterface $securityContext, array $superAdminRoles)
{
$this->securityContext = $securityContext;
$this->superAdminRoles = $superAdminRoles;
}
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
if (!is_array($attributes)) {
$attributes = array($attributes);
}
foreach ($attributes as $pos => $attribute) {
$attributes[$pos] = sprintf($this->getBaseRole($admin), $attribute);
}
try {
return $this->securityContext->isGranted($this->superAdminRoles)
|| $this->securityContext->isGranted($attributes, $object);
} catch (AuthenticationCredentialsNotFoundException $e) {
return false;
} catch (\Exception $e) {
throw $e;
}
}
public function getBaseRole(AdminInterface $admin)
{
return'ROLE_'. str_replace('.','_', strtoupper($admin->getCode())) .'_%s';
}
public function buildSecurityInformation(AdminInterface $admin)
{
return array();
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
}
}
}
namespace Sonata\AdminBundle\Show
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Builder\ShowBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseGroupedMapper;
class ShowMapper extends BaseGroupedMapper
{
protected $list;
public function __construct(ShowBuilderInterface $showBuilder, FieldDescriptionCollection $list, AdminInterface $admin)
{
parent::__construct($showBuilder, $admin);
$this->list = $list;
}
public function add($name, $type = null, array $fieldDescriptionOptions = array())
{
$fieldKey = ($name instanceof FieldDescriptionInterface) ? $name->getName() : $name;
$this->addFieldToCurrentGroup($fieldKey);
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($fieldDescriptionOptions);
} elseif (is_string($name) && !$this->admin->hasShowFieldDescription($name)) {
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$fieldDescriptionOptions
);
} else {
throw new \RuntimeException('invalid state');
}
if (!$fieldDescription->getLabel()) {
$fieldDescription->setOption('label', $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'show','label'));
}
$fieldDescription->setOption('safe', $fieldDescription->getOption('safe', false));
$this->builder->addField($this->list, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->list->get($name);
}
public function has($key)
{
return $this->list->has($key);
}
public function remove($key)
{
$this->admin->removeShowFieldDescription($key);
$this->list->remove($key);
return $this;
}
public function reorder(array $keys)
{
$this->admin->reorderShowGroup($this->getCurrentGroupName(), $keys);
return $this;
}
protected function getGroups()
{
return $this->admin->getShowGroups();
}
protected function setGroups(array $groups)
{
$this->admin->setShowGroups($groups);
}
protected function getTabs()
{
return $this->admin->getShowTabs();
}
protected function setTabs(array $tabs)
{
$this->admin->setShowTabs($tabs);
}
}
}
namespace Sonata\AdminBundle\Translator
{
interface LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='');
}
}
namespace Sonata\AdminBundle\Translator
{
class BCLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
if ($context =='breadcrumb') {
return sprintf('%s.%s_%s', $context, $type, strtolower($label));
}
return ucfirst(strtolower($label));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class FormLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
return ucfirst(strtolower($label));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class NativeLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
$label = str_replace(array('_','.'),' ', $label);
$label = strtolower(preg_replace('~(?<=\\w)([A-Z])~','_$1', $label));
return trim(ucwords(str_replace('_',' ', $label)));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class NoopLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
return $label;
}
}
}
namespace Sonata\AdminBundle\Translator
{
class UnderscoreLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
$label = str_replace('.','_', $label);
return sprintf('%s.%s_%s', $context, $type, strtolower(preg_replace('~(?<=\\w)([A-Z])~','_$1', $label)));
}
}
}
namespace Sonata\AdminBundle\Twig\Extension
{
use Doctrine\Common\Util\ClassUtils;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Exception\NoValueException;
use Sonata\AdminBundle\Admin\Pool;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Psr\Log\LoggerInterface;
class SonataAdminExtension extends \Twig_Extension
{
protected $environment;
protected $pool;
protected $logger;
public function __construct(Pool $pool, LoggerInterface $logger = null)
{
$this->pool = $pool;
$this->logger = $logger;
}
public function initRuntime(\Twig_Environment $environment)
{
$this->environment = $environment;
}
public function getFilters()
{
return array('render_list_element'=> new \Twig_Filter_Method($this,'renderListElement', array('is_safe'=> array('html'))),'render_view_element'=> new \Twig_Filter_Method($this,'renderViewElement', array('is_safe'=> array('html'))),'render_view_element_compare'=> new \Twig_Filter_Method($this,'renderViewElementCompare', array('is_safe'=> array('html'))),'render_relation_element'=> new \Twig_Filter_Method($this,'renderRelationElement'),'sonata_urlsafeid'=> new \Twig_Filter_Method($this,'getUrlsafeIdentifier'),'sonata_xeditable_type'=> new \Twig_Filter_Method($this,'getXEditableType'),
);
}
public function getTokenParsers()
{
return array();
}
public function getName()
{
return'sonata_admin';
}
protected function getTemplate(FieldDescriptionInterface $fieldDescription, $defaultTemplate)
{
$templateName = $fieldDescription->getTemplate() ?: $defaultTemplate;
try {
$template = $this->environment->loadTemplate($templateName);
} catch (\Twig_Error_Loader $e) {
$template = $this->environment->loadTemplate($defaultTemplate);
if (null !== $this->logger) {
$this->logger->warning(sprintf('An error occured trying to load the template "%s" for the field "%s", the default template "%s" was used instead: "%s". ', $templateName, $fieldDescription->getFieldName(), $defaultTemplate, $e->getMessage()));
}
}
return $template;
}
public function renderListElement($object, FieldDescriptionInterface $fieldDescription, $params = array())
{
$template = $this->getTemplate($fieldDescription, $fieldDescription->getAdmin()->getTemplate('base_list_field'));
return $this->output($fieldDescription, $template, array_merge($params, array('admin'=> $fieldDescription->getAdmin(),'object'=> $object,'value'=> $this->getValueFromFieldDescription($object, $fieldDescription),'field_description'=> $fieldDescription
)));
}
public function output(FieldDescriptionInterface $fieldDescription, \Twig_TemplateInterface $template, array $parameters = array())
{
$content = $template->render($parameters);
if ($this->environment->isDebug()) {
return sprintf("\n<!-- START  \n  fieldName: %s\n  template: %s\n  compiled template: %s\n -->\n%s\n<!-- END - fieldName: %s -->",
$fieldDescription->getFieldName(),
$fieldDescription->getTemplate(),
$template->getTemplateName(),
$content,
$fieldDescription->getFieldName()
);
}
return $content;
}
public function getValueFromFieldDescription($object, FieldDescriptionInterface $fieldDescription, array $params = array())
{
if (isset($params['loop']) && $object instanceof \ArrayAccess) {
throw new \RuntimeException('remove the loop requirement');
}
$value = null;
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
if ($fieldDescription->getAssociationAdmin()) {
$value = $fieldDescription->getAssociationAdmin()->getNewInstance();
}
}
return $value;
}
public function renderViewElement(FieldDescriptionInterface $fieldDescription, $object)
{
$template = $this->getTemplate($fieldDescription,'SonataAdminBundle:CRUD:base_show_field.html.twig');
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
$value = null;
}
return $this->output($fieldDescription, $template, array('field_description'=> $fieldDescription,'object'=> $object,'value'=> $value,'admin'=> $fieldDescription->getAdmin()
));
}
public function renderViewElementCompare(FieldDescriptionInterface $fieldDescription, $baseObject, $compareObject)
{
$template = $this->getTemplate($fieldDescription,'SonataAdminBundle:CRUD:base_show_field.html.twig');
try {
$baseValue = $fieldDescription->getValue($baseObject);
} catch (NoValueException $e) {
$baseValue = null;
}
try {
$compareValue = $fieldDescription->getValue($compareObject);
} catch (NoValueException $e) {
$compareValue = null;
}
$baseValueOutput = $template->render(array('admin'=> $fieldDescription->getAdmin(),'field_description'=> $fieldDescription,'value'=> $baseValue
));
$compareValueOutput = $template->render(array('field_description'=> $fieldDescription,'admin'=> $fieldDescription->getAdmin(),'value'=> $compareValue
));
$isDiff = $baseValueOutput !== $compareValueOutput;
return $this->output($fieldDescription, $template, array('field_description'=> $fieldDescription,'value'=> $baseValue,'value_compare'=> $compareValue,'is_diff'=> $isDiff,'admin'=> $fieldDescription->getAdmin()
));
}
public function renderRelationElement($element, FieldDescriptionInterface $fieldDescription)
{
if (!is_object($element)) {
return $element;
}
$propertyPath = $fieldDescription->getOption('associated_property');
if (null === $propertyPath) {
$method = $fieldDescription->getOption('associated_tostring','__toString');
if (!method_exists($element, $method)) {
throw new \RuntimeException(sprintf('You must define an `associated_property` option or create a `%s::__toString` method to the field option %s from service %s is ',
get_class($element),
$fieldDescription->getName(),
$fieldDescription->getAdmin()->getCode()
));
}
return call_user_func(array($element, $method));
}
return PropertyAccess::createPropertyAccessor()->getValue($element, $propertyPath);
}
public function getUrlsafeIdentifier($model)
{
$admin = $this->pool->getAdminByClass(
ClassUtils::getClass($model)
);
return $admin->getUrlsafeIdentifier($model);
}
public function getXEditableType($type)
{
$mapping = array('boolean'=>'select','text'=>'text','textarea'=>'textarea','email'=>'email','string'=>'text','smallint'=>'text','bigint'=>'text','integer'=>'number','decimal'=>'number','currency'=>'number','percent'=>'number','url'=>'url',
);
return isset($mapping[$type]) ? $mapping[$type] : false;
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
interface AdminAclManipulatorInterface
{
public function configureAcls(OutputInterface $output, AdminInterface $admin);
public function addAdminClassAces(OutputInterface $output, AclInterface $acl, AclSecurityHandlerInterface $securityHandler, array $roleInformation = array());
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
class AdminAclManipulator implements AdminAclManipulatorInterface
{
protected $maskBuilderClass;
public function __construct($maskBuilderClass)
{
$this->maskBuilderClass = $maskBuilderClass;
}
public function configureAcls(OutputInterface $output, AdminInterface $admin)
{
$securityHandler = $admin->getSecurityHandler();
if (!$securityHandler instanceof AclSecurityHandlerInterface) {
$output->writeln(sprintf('Admin `%s` is not configured to use ACL : <info>ignoring</info>', $admin->getCode()));
return;
}
$objectIdentity = ObjectIdentity::fromDomainObject($admin);
$newAcl = false;
if (is_null($acl = $securityHandler->getObjectAcl($objectIdentity))) {
$acl = $securityHandler->createAcl($objectIdentity);
$newAcl = true;
}
$output->writeln(sprintf(' > install ACL for %s', $admin->getCode()));
$configResult = $this->addAdminClassAces($output, $acl, $securityHandler, $securityHandler->buildSecurityInformation($admin));
if ($configResult) {
$securityHandler->updateAcl($acl);
} else {
$output->writeln(sprintf('   - %s , no roles and permissions found', ($newAcl ?'skip':'removed')));
$securityHandler->deleteAcl($objectIdentity);
}
}
public function addAdminClassAces(OutputInterface $output, AclInterface $acl, AclSecurityHandlerInterface $securityHandler, array $roleInformation = array())
{
if (count($securityHandler->getAdminPermissions()) > 0) {
$builder = new $this->maskBuilderClass();
foreach ($roleInformation as $role => $permissions) {
$aceIndex = $securityHandler->findClassAceIndexByRole($acl, $role);
$roleAdminPermissions = array();
foreach ($permissions as $permission) {
if (in_array($permission, $securityHandler->getAdminPermissions())) {
$builder->add($permission);
$roleAdminPermissions[] = $permission;
}
}
if (count($roleAdminPermissions) > 0) {
if ($aceIndex === false) {
$acl->insertClassAce(new RoleSecurityIdentity($role), $builder->get());
$action ='add';
} else {
$acl->updateClassAce($aceIndex, $builder->get());
$action ='update';
}
if (!is_null($output)) {
$output->writeln(sprintf('   - %s role: %s, permissions: %s', $action, $role, json_encode($roleAdminPermissions)));
}
$builder->reset();
} elseif ($aceIndex !== false) {
$acl->deleteClassAce($aceIndex);
if (!is_null($output)) {
$output->writeln(sprintf('   - remove role: %s', $role));
}
}
}
return true;
} else {
return false;
}
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Form\FormBuilder;
class FormBuilderIterator extends \RecursiveArrayIterator
{
protected static $reflection;
protected $formBuilder;
protected $keys = array();
protected $prefix;
public function __construct(FormBuilder $formBuilder, $prefix = false)
{
$this->formBuilder = $formBuilder;
$this->prefix = $prefix ? $prefix : $formBuilder->getName();
$this->iterator = new \ArrayIterator(self::getKeys($formBuilder));
}
private static function getKeys(FormBuilder $formBuilder)
{
if (!self::$reflection) {
self::$reflection = new \ReflectionProperty(get_class($formBuilder),'children');
self::$reflection->setAccessible(true);
}
return array_keys(self::$reflection->getValue($formBuilder));
}
public function rewind()
{
$this->iterator->rewind();
}
public function valid()
{
return $this->iterator->valid();
}
public function key()
{
$name = $this->iterator->current();
return sprintf('%s_%s', $this->prefix, $name);
}
public function next()
{
$this->iterator->next();
}
public function current()
{
return $this->formBuilder->get($this->iterator->current());
}
public function getChildren()
{
return new self($this->formBuilder->get($this->iterator->current()), $this->current());
}
public function hasChildren()
{
return count(self::getKeys($this->current())) > 0;
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Form\FormView;
class FormViewIterator implements \RecursiveIterator
{
protected $formView;
public function __construct(FormView $formView)
{
$this->iterator = $formView->getIterator();
}
public function getChildren()
{
return new FormViewIterator($this->current());
}
public function hasChildren()
{
return count($this->current()->children) > 0;
}
public function current()
{
return $this->iterator->current();
}
public function next()
{
$this->iterator->next();
}
public function key()
{
return $this->current()->vars['id'];
}
public function valid()
{
return $this->iterator->valid();
}
public function rewind()
{
$this->iterator->rewind();
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Console\Output\OutputInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
interface ObjectAclManipulatorInterface
{
public function batchConfigureAcls(OutputInterface $output, AdminInterface $admin, UserSecurityIdentity $securityIdentity = null);
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
abstract class ObjectAclManipulator implements ObjectAclManipulatorInterface
{
public function configureAcls(OutputInterface $output, AdminInterface $admin, \Traversable $oids, UserSecurityIdentity $securityIdentity = null)
{
$countAdded = 0;
$countUpdated = 0;
$securityHandler = $admin->getSecurityHandler();
if (!$securityHandler instanceof AclSecurityHandlerInterface) {
$output->writeln(sprintf('Admin `%s` is not configured to use ACL : <info>ignoring</info>', $admin->getCode()));
return array(0, 0);
}
$acls = $securityHandler->findObjectAcls($oids);
foreach ($oids as $oid) {
if ($acls->contains($oid)) {
$acl = $acls->offsetGet($oid);
$countUpdated++;
} else {
$acl = $securityHandler->createAcl($oid);
$countAdded++;
}
if (!is_null($securityIdentity)) {
$securityHandler->addObjectOwner($acl, $securityIdentity);
}
$securityHandler->addObjectClassAces($acl, $securityHandler->buildSecurityInformation($admin));
try {
$securityHandler->updateAcl($acl);
} catch (\Exception $e) {
$output->writeln(sprintf('Error saving ObjectIdentity (%s, %s) ACL : %s <info>ignoring</info>', $oid->getIdentifier(), $oid->getType(), $e->getMessage()));
}
}
return array($countAdded, $countUpdated);
}
}
}
namespace Symfony\Component\Validator
{
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Exception\InvalidOptionsException;
use Symfony\Component\Validator\Exception\MissingOptionsException;
abstract class Constraint
{
const DEFAULT_GROUP ='Default';
const CLASS_CONSTRAINT ='class';
const PROPERTY_CONSTRAINT ='property';
protected static $errorNames = array();
public $payload;
public static function getErrorName($errorCode)
{
if (!isset(static::$errorNames[$errorCode])) {
throw new InvalidArgumentException(sprintf('The error code "%s" does not exist for constraint of type "%s".',
$errorCode,
get_called_class()
));
}
return static::$errorNames[$errorCode];
}
public function __construct($options = null)
{
$invalidOptions = array();
$missingOptions = array_flip((array) $this->getRequiredOptions());
$knownOptions = get_object_vars($this);
$knownOptions['groups'] = true;
if (is_array($options) && count($options) >= 1 && isset($options['value']) && !property_exists($this,'value')) {
$options[$this->getDefaultOption()] = $options['value'];
unset($options['value']);
}
if (is_array($options) && count($options) > 0 && is_string(key($options))) {
foreach ($options as $option => $value) {
if (array_key_exists($option, $knownOptions)) {
$this->$option = $value;
unset($missingOptions[$option]);
} else {
$invalidOptions[] = $option;
}
}
} elseif (null !== $options && !(is_array($options) && count($options) === 0)) {
$option = $this->getDefaultOption();
if (null === $option) {
throw new ConstraintDefinitionException(
sprintf('No default option is configured for constraint %s', get_class($this))
);
}
if (array_key_exists($option, $knownOptions)) {
$this->$option = $options;
unset($missingOptions[$option]);
} else {
$invalidOptions[] = $option;
}
}
if (count($invalidOptions) > 0) {
throw new InvalidOptionsException(
sprintf('The options "%s" do not exist in constraint %s', implode('", "', $invalidOptions), get_class($this)),
$invalidOptions
);
}
if (count($missingOptions) > 0) {
throw new MissingOptionsException(
sprintf('The options "%s" must be set for constraint %s', implode('", "', array_keys($missingOptions)), get_class($this)),
array_keys($missingOptions)
);
}
}
public function __set($option, $value)
{
if ('groups'=== $option) {
$this->groups = (array) $value;
return;
}
throw new InvalidOptionsException(sprintf('The option "%s" does not exist in constraint %s', $option, get_class($this)), array($option));
}
public function __get($option)
{
if ('groups'=== $option) {
$this->groups = array(self::DEFAULT_GROUP);
return $this->groups;
}
throw new InvalidOptionsException(sprintf('The option "%s" does not exist in constraint %s', $option, get_class($this)), array($option));
}
public function addImplicitGroupName($group)
{
if (in_array(Constraint::DEFAULT_GROUP, $this->groups) && !in_array($group, $this->groups)) {
$this->groups[] = $group;
}
}
public function getDefaultOption()
{
}
public function getRequiredOptions()
{
return array();
}
public function validatedBy()
{
return get_class($this).'Validator';
}
public function getTargets()
{
return self::PROPERTY_CONSTRAINT;
}
public function __sleep()
{
$this->groups;
return array_keys(get_object_vars($this));
}
}
}
namespace Sonata\AdminBundle\Validator\Constraints
{
use Symfony\Component\Validator\Constraint;
class InlineConstraint extends Constraint
{
protected $service;
protected $method;
public function validatedBy()
{
return'sonata.admin.validator.inline';
}
public function isClosure()
{
return $this->method instanceof \Closure;
}
public function getClosure()
{
return $this->method;
}
public function getTargets()
{
return self::CLASS_CONSTRAINT;
}
public function getRequiredOptions()
{
return array('service','method');
}
public function getMethod()
{
return $this->method;
}
public function getService()
{
return $this->service;
}
}
}
namespace Sonata\AdminBundle\Validator
{
use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Validator\Constraint;
class ErrorElement
{
protected $context;
protected $group;
protected $constraintValidatorFactory;
protected $stack = array();
protected $propertyPaths = array();
protected $subject;
protected $current;
protected $basePropertyPath;
protected $errors = array();
public function __construct($subject, ConstraintValidatorFactoryInterface $constraintValidatorFactory, ExecutionContextInterface $context, $group)
{
$this->subject = $subject;
$this->context = $context;
$this->group = $group;
$this->constraintValidatorFactory = $constraintValidatorFactory;
$this->current ='';
$this->basePropertyPath = $this->context->getPropertyPath();
}
public function __call($name, array $arguments = array())
{
if (substr($name, 0, 6) =='assert') {
$this->validate($this->newConstraint(substr($name, 6), isset($arguments[0]) ? $arguments[0] : array()));
} else {
throw new \RunTimeException('Unable to recognize the command');
}
return $this;
}
public function addConstraint(Constraint $constraint)
{
$this->validate($constraint);
return $this;
}
public function with($name, $key = false)
{
$key = $key ? $name .'.'. $key : $name;
$this->stack[] = $key;
$this->current = implode('.', $this->stack);
if (!isset($this->propertyPaths[$this->current])) {
$this->propertyPaths[$this->current] = new PropertyPath($this->current);
}
return $this;
}
public function end()
{
array_pop($this->stack);
$this->current = implode('.', $this->stack);
return $this;
}
protected function validate(Constraint $constraint)
{
$subPath = (string) $this->getCurrentPropertyPath();
$this->context->validateValue($this->getValue(), $constraint, $subPath, $this->group);
}
public function getFullPropertyPath()
{
if ($this->getCurrentPropertyPath()) {
return sprintf('%s.%s', $this->basePropertyPath, $this->getCurrentPropertyPath());
} else {
return $this->basePropertyPath;
}
}
protected function getValue()
{
if ($this->current =='') {
return $this->subject;
}
$propertyAccessor = PropertyAccess::createPropertyAccessor();
return $propertyAccessor->getValue($this->subject, $this->getCurrentPropertyPath());
}
public function getSubject()
{
return $this->subject;
}
protected function newConstraint($name, array $options = array())
{
if (strpos($name,'\\') !== false && class_exists($name)) {
$className = (string) $name;
} else {
$className ='Symfony\\Component\\Validator\\Constraints\\'. $name;
}
return new $className($options);
}
protected function getCurrentPropertyPath()
{
if (!isset($this->propertyPaths[$this->current])) {
return null; }
return $this->propertyPaths[$this->current];
}
public function addViolation($message, $parameters = array(), $value = null)
{
if (is_array($message)) {
$value = isset($message[2]) ? $message[2] : $value;
$parameters = isset($message[1]) ? (array) $message[1] : array();
$message = isset($message[0]) ? $message[0] :'error';
}
$subPath = (string) $this->getCurrentPropertyPath();
$this->context->addViolationAt($subPath, $message, $parameters, $value);
$this->errors[] = array($message, $parameters, $value);
return $this;
}
public function getErrors()
{
return $this->errors;
}
}
}
namespace Symfony\Component\Validator
{
interface ConstraintValidatorInterface
{
public function initialize(ExecutionContextInterface $context);
public function validate($value, Constraint $constraint);
}
}
namespace Symfony\Component\Validator
{
use Symfony\Component\Validator\Context\ExecutionContextInterface as ExecutionContextInterface2Dot5;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;
use Symfony\Component\Validator\Violation\LegacyConstraintViolationBuilder;
abstract class ConstraintValidator implements ConstraintValidatorInterface
{
const PRETTY_DATE = 1;
const OBJECT_TO_STRING = 2;
protected $context;
public function initialize(ExecutionContextInterface $context)
{
$this->context = $context;
}
protected function buildViolation($message, array $parameters = array())
{
if ($this->context instanceof ExecutionContextInterface2Dot5) {
return $this->context->buildViolation($message, $parameters);
}
return new LegacyConstraintViolationBuilder($this->context, $message, $parameters);
}
protected function buildViolationInContext(ExecutionContextInterface $context, $message, array $parameters = array())
{
if ($context instanceof ExecutionContextInterface2Dot5) {
return $context->buildViolation($message, $parameters);
}
return new LegacyConstraintViolationBuilder($context, $message, $parameters);
}
protected function formatTypeOf($value)
{
return is_object($value) ? get_class($value) : gettype($value);
}
protected function formatValue($value, $format = 0)
{
$isDateTime = $value instanceof \DateTime || $value instanceof \DateTimeInterface;
if (($format & self::PRETTY_DATE) && $isDateTime) {
if (class_exists('IntlDateFormatter')) {
$locale = \Locale::getDefault();
$formatter = new \IntlDateFormatter($locale, \IntlDateFormatter::MEDIUM, \IntlDateFormatter::SHORT);
if (!$value instanceof \DateTime) {
$value = new \DateTime(
$value->format('Y-m-d H:i:s.u e'),
$value->getTimezone()
);
}
return $formatter->format($value);
}
return $value->format('Y-m-d H:i:s');
}
if (is_object($value)) {
if ($format & self::OBJECT_TO_STRING && method_exists($value,'__toString')) {
return $value->__toString();
}
return'object';
}
if (is_array($value)) {
return'array';
}
if (is_string($value)) {
return'"'.$value.'"';
}
if (is_resource($value)) {
return'resource';
}
if (null === $value) {
return'null';
}
if (false === $value) {
return'false';
}
if (true === $value) {
return'true';
}
return (string) $value;
}
protected function formatValues(array $values, $format = 0)
{
foreach ($values as $key => $value) {
$values[$key] = $this->formatValue($value, $format);
}
return implode(', ', $values);
}
}
}
namespace Sonata\AdminBundle\Validator
{
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
class InlineValidator extends ConstraintValidator
{
protected $container;
public function __construct(ContainerInterface $container, ConstraintValidatorFactoryInterface $constraintValidatorFactory)
{
$this->container = $container;
$this->constraintValidatorFactory = $constraintValidatorFactory;
}
public function validate($value, Constraint $constraint)
{
$errorElement = new ErrorElement(
$value,
$this->constraintValidatorFactory,
$this->context,
$this->context->getGroup()
);
if ($constraint->isClosure()) {
$function = $constraint->getClosure();
} else {
if (is_string($constraint->getService())) {
$service = $this->container->get($constraint->getService());
} else {
$service = $constraint->getService();
}
$function = array($service, $constraint->getMethod());
}
call_user_func($function, $errorElement, $value);
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Sonata\CoreBundle\Form\DataTransformer\BooleanTypeToBooleanTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class BooleanType extends AbstractType
{
const TYPE_YES = 1;
const TYPE_NO = 2;
public function buildForm(FormBuilderInterface $builder, array $options)
{
if ($options['transform']) {
$builder->addModelTransformer(new BooleanTypeToBooleanTransformer());
}
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('catalogue'=>'SonataCoreBundle','choices'=> array(
self::TYPE_YES =>'label_type_yes',
self::TYPE_NO =>'label_type_no'),'transform'=> false
));
}
public function getParent()
{
return'sonata_type_translatable_choice';
}
public function getName()
{
return'sonata_type_boolean';
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\CoreBundle\Form\EventListener\ResizeFormListener;
class CollectionType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$listener = new ResizeFormListener(
$options['type'],
$options['type_options'],
$options['modifiable'],
$options['pre_bind_data_callback']
);
$builder->addEventSubscriber($listener);
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('modifiable'=> false,'type'=>'text','type_options'=> array(),'pre_bind_data_callback'=> null,'btn_add'=>'link_add','btn_catalogue'=>'SonataCoreBundle'));
}
public function getName()
{
return'sonata_type_collection';
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DateRangeType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$options['field_options_start'] = array_merge(
array('label'=> $this->translator->trans('date_range_start', array(),'SonataCoreBundle')
),
$options['field_options_start']
);
$options['field_options_end'] = array_merge(
array('label'=> $this->translator->trans('date_range_end', array(),'SonataCoreBundle')
),
$options['field_options_end']
);
$builder->add('start', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_start']));
$builder->add('end', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_end']));
}
public function getName()
{
return'sonata_type_date_range';
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_options'=> array(),'field_options_start'=> array(),'field_options_end'=> array(),'field_type'=>'date'));
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DateTimeRangeType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$options['field_options_start'] = array_merge(
array('label'=> $this->translator->trans('date_range_start', array(),'SonataCoreBundle')
),
$options['field_options_start']
);
$options['field_options_end'] = array_merge(
array('label'=> $this->translator->trans('date_range_end', array(),'SonataCoreBundle')
),
$options['field_options_end']
);
$builder->add('start', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_start']));
$builder->add('end', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_end']));
}
public function getName()
{
return'sonata_type_datetime_range';
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_options'=> array(),'field_options_start'=> array(),'field_options_end'=> array(),'field_type'=>'datetime',
));
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class EqualType extends AbstractType
{
const TYPE_IS_EQUAL = 1;
const TYPE_IS_NOT_EQUAL = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('choices'=> array(
self::TYPE_IS_EQUAL => $this->translator->trans('label_type_equals', array(),'SonataCoreBundle'),
self::TYPE_IS_NOT_EQUAL => $this->translator->trans('label_type_not_equals', array(),'SonataCoreBundle'),
)
));
}
public function getParent()
{
return'choice';
}
public function getName()
{
return'sonata_type_equal';
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ImmutableArrayType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
foreach ($options['keys'] as $infos) {
if ($infos instanceof FormBuilderInterface) {
$builder->add($infos);
} else {
list($name, $type, $options) = $infos;
if (is_callable($options)) {
$extra = array_slice($infos, 3);
$options = $options($builder, $name, $type, $extra);
if ($options === null) {
$options = array();
} else if (!is_array($options)){
throw new \RuntimeException('the closure must return null or an array');
}
}
$builder->add($name, $type, $options);
}
}
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('keys'=> array(),
));
}
public function getName()
{
return'sonata_type_immutable_array';
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class TranslatableChoiceType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('catalogue'=>'messages',
));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['translation_domain'] = $options['catalogue'];
}
public function getParent()
{
return'choice';
}
public function getName()
{
return'sonata_type_translatable_choice';
}
}
}
namespace Sonata\BlockBundle\Block
{
interface BlockLoaderInterface
{
public function load($name);
public function support($name);
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Exception\BlockNotFoundException;
class BlockLoaderChain implements BlockLoaderInterface
{
protected $loaders;
public function __construct(array $loaders)
{
$this->loaders = $loaders;
}
public function load($block)
{
foreach ($this->loaders as $loader) {
if ($loader->support($block)) {
return $loader->load($block);
}
}
throw new BlockNotFoundException;
}
public function support($name)
{
return true;
}
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
interface BlockRendererInterface
{
public function render(BlockContextInterface $name, Response $response = null);
}
}
namespace Sonata\BlockBundle\Block
{
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Sonata\BlockBundle\Exception\Strategy\StrategyManagerInterface;
class BlockRenderer implements BlockRendererInterface
{
protected $blockServiceManager;
protected $exceptionStrategyManager;
protected $logger;
protected $debug;
private $lastResponse;
public function __construct(BlockServiceManagerInterface $blockServiceManager, StrategyManagerInterface $exceptionStrategyManager, LoggerInterface $logger = null, $debug = false)
{
$this->blockServiceManager = $blockServiceManager;
$this->exceptionStrategyManager = $exceptionStrategyManager;
$this->logger = $logger;
$this->debug = $debug;
}
public function render(BlockContextInterface $blockContext, Response $response = null)
{
$block = $blockContext->getBlock();
if ($this->logger) {
$this->logger->info(sprintf('[cms::renderBlock] block.id=%d, block.type=%s ', $block->getId(), $block->getType()));
}
try {
$service = $this->blockServiceManager->get($block);
$service->load($block);
$response = $service->execute($blockContext, $this->createResponse($blockContext, $response));
if (!$response instanceof Response) {
$response = null;
throw new \RuntimeException('A block service must return a Response object');
}
$response = $this->addMetaInformation($response, $blockContext, $service);
} catch (\Exception $exception) {
if ($this->logger) {
$this->logger->critical(sprintf('[cms::renderBlock] block.id=%d - error while rendering block - %s', $block->getId(), $exception->getMessage()));
}
$this->lastResponse = null;
$response = $this->exceptionStrategyManager->handleException($exception, $blockContext->getBlock(), $response);
}
return $response;
}
protected function createResponse(BlockContextInterface $blockContext, Response $response = null)
{
if (null === $response) {
$response = new Response();
}
if (($ttl = $blockContext->getBlock()->getTtl()) > 0) {
$response->setTtl($ttl);
}
return $response;
}
protected function addMetaInformation(Response $response, BlockContextInterface $blockContext, BlockServiceInterface $service)
{
if ($this->lastResponse && $this->lastResponse->isCacheable()) {
$response->setTtl($this->lastResponse->getTtl());
$response->setPublic();
} else if ($this->lastResponse) { $response->setPrivate();
$response->setTtl(0);
$response->headers->removeCacheControlDirective('s-maxage');
$response->headers->removeCacheControlDirective('maxage');
}
if (!$blockContext->getBlock()->hasParent()) {
$this->lastResponse = null;
} else { $this->lastResponse = $response;
}
return $response;
}
}}
namespace Sonata\BlockBundle\Block
{
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
interface BlockServiceManagerInterface
{
public function add($name, $service, $contexts = array());
public function get(BlockInterface $block);
public function setServices(array $blockServices);
public function getServices();
public function getServicesByContext($name, $includeContainers = true);
public function has($name);
public function getService($name);
public function getLoadedServices();
public function validate(ErrorElement $errorElement, BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class BlockServiceManager implements BlockServiceManagerInterface
{
protected $services;
protected $container;
protected $inValidate;
protected $contexts;
public function __construct(ContainerInterface $container, $debug, LoggerInterface $logger = null)
{
$this->services = array();
$this->contexts = array();
$this->container = $container;
}
private function load($type)
{
if (!$this->has($type)) {
throw new \RuntimeException(sprintf('The block service `%s` does not exist', $type));
}
if (!$this->services[$type] instanceof BlockServiceInterface) {
$this->services[$type] = $this->container->get($type);
}
if (!$this->services[$type] instanceof BlockServiceInterface) {
throw new \RuntimeException(sprintf('The service %s does not implement BlockServiceInterface', $type));
}
return $this->services[$type];
}
public function get(BlockInterface $block)
{
$this->load($block->getType());
return $this->services[$block->getType()];
}
public function getService($id)
{
return $this->load($id);
}
public function has($id)
{
return isset($this->services[$id]) ? true : false;
}
public function add($name, $service, $contexts = array())
{
$this->services[$name] = $service;
foreach ($contexts as $context) {
if (!array_key_exists($context, $this->contexts)) {
$this->contexts[$context] = array();
}
$this->contexts[$context][] = $name;
}
}
public function setServices(array $blockServices)
{
foreach($blockServices as $name => $service) {
$this->add($name, $service);
}
}
public function getServices()
{
foreach ($this->services as $name => $id) {
if (is_string($id)) {
$this->load($id);
}
}
return $this->services;
}
public function getServicesByContext($context, $includeContainers = true)
{
if (!array_key_exists($context, $this->contexts)) {
return array();
}
$services = array();
$containers = $this->container->getParameter('sonata.block.container.types');
foreach ($this->contexts[$context] as $name) {
if (!$includeContainers && in_array($name, $containers)) {
continue;
}
$services[$name] = $this->getService($name);
}
return $services;
}
public function getLoadedServices()
{
$services = array();
foreach ($this->services as $service) {
if (!$service instanceof BlockServiceInterface) {
continue;
}
$services[] = $service;
}
return $services;
}
public function validate(ErrorElement $errorElement, BlockInterface $block)
{
if (!$block->getId() && !$block->getType()) {
return;
}
if ($this->inValidate) {
return;
}
try {
$this->inValidate = true;
$this->get($block)->validateBlock($errorElement, $block);
$this->inValidate = false;
} catch (\Exception $e) {
$this->inValidate = false;
}
}
}
}
namespace Sonata\BlockBundle\Block\Loader
{
use Sonata\BlockBundle\Block\BlockLoaderInterface;
use Sonata\BlockBundle\Model\Block;
class ServiceLoader implements BlockLoaderInterface
{
protected $types;
public function __construct(array $types)
{
$this->types = $types;
}
public function load($configuration)
{
if (!in_array($configuration['type'], $this->types)) {
throw new \RuntimeException(sprintf('The block type "%s" does not exist',
$configuration['type']
));
}
$block = new Block;
$block->setId(uniqid());
$block->setType($configuration['type']);
$block->setEnabled(true);
$block->setCreatedAt(new \DateTime);
$block->setUpdatedAt(new \DateTime);
$block->setSettings(isset($configuration['settings']) ? $configuration['settings'] : array());
return $block;
}
public function support($configuration)
{
if (!is_array($configuration)) {
return false;
}
if (!isset($configuration['type'])) {
return false;
}
return true;
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
class EmptyBlockService extends BaseBlockService
{
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
throw new \RuntimeException('Not used, this block renders an empty result if no block document can be found');
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
throw new \RuntimeException('Not used, this block renders an empty result if no block document can be found');
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return new Response();
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
class RssBlockService extends BaseBlockService
{
public function getName()
{
return'Rss Reader';
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('url'=> false,'title'=>'Insert the rss title','template'=>'SonataBlockBundle:Block:block_core_rss.html.twig',
));
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('settings','sonata_type_immutable_array', array('keys'=> array(
array('url','url', array('required'=> false)),
array('title','text', array('required'=> false)),
)
));
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
$errorElement
->with('settings[url]')
->assertNotNull(array())
->assertNotBlank()
->end()
->with('settings[title]')
->assertNotNull(array())
->assertNotBlank()
->assertMaxLength(array('limit'=> 50))
->end();
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$settings = $blockContext->getSettings();
$feeds = false;
if ($settings['url']) {
$options = array('http'=> array('user_agent'=>'Sonata/RSS Reader','timeout'=> 2,
)
);
$content = @file_get_contents($settings['url'], false, stream_context_create($options));
if ($content) {
try {
$feeds = new \SimpleXMLElement($content);
$feeds = $feeds->channel->item;
} catch (\Exception $e) {
}
}
}
return $this->renderResponse($blockContext->getTemplate(), array('feeds'=> $feeds,'block'=> $blockContext->getBlock(),'settings'=> $settings
), $response);
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Knp\Menu\ItemInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class MenuBlockService extends BaseBlockService
{
protected $menuProvider;
protected $menus;
public function __construct($name, EngineInterface $templating, MenuProviderInterface $menuProvider, array $menus = array())
{
parent::__construct($name, $templating);
$this->menuProvider = $menuProvider;
$this->menus = $menus;
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$responseSettings = array('menu'=> $this->getMenu($blockContext),'menu_options'=> $this->getMenuOptions($blockContext->getSettings()),'block'=> $blockContext->getBlock(),'context'=> $blockContext
);
if ('private'=== $blockContext->getSettings('cache_policy')) {
return $this->renderPrivateResponse($blockContext->getTemplate(), $responseSettings, $response);
}
return $this->renderResponse($blockContext->getTemplate(), $responseSettings, $response);
}
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
$form->add('settings','sonata_type_immutable_array', array('keys'=> $this->getFormSettingsKeys()
));
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
if (($name = $block->getSetting('menu_name')) && $name !==""&& !$this->menuProvider->has($name)) {
$errorElement->with('menu_name')
->addViolation('sonata.block.menu.not_existing', array('name'=> $name))
->end();
}
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('title'=> $this->getName(),'cache_policy'=>'public','template'=>'SonataBlockBundle:Block:block_core_menu.html.twig','menu_name'=>"",'safe_labels'=> false,'current_class'=>'active','first_class'=> false,'last_class'=> false,'current_uri'=> null,'menu_class'=>"list-group",'children_class'=>"list-group-item",'menu_template'=> null,
));
}
public function getName()
{
return'Menu';
}
protected function getFormSettingsKeys()
{
return array(
array('title','text', array('required'=> false)),
array('cache_policy','choice', array('choices'=> array('public','private'))),
array('menu_name','choice', array('choices'=> $this->menus,'required'=> false)),
array('safe_labels','checkbox', array('required'=> false)),
array('current_class','text', array('required'=> false)),
array('first_class','text', array('required'=> false)),
array('last_class','text', array('required'=> false)),
array('menu_class','text', array('required'=> false)),
array('children_class','text', array('required'=> false)),
array('menu_template','text', array('required'=> false)),
);
}
protected function getMenu(BlockContextInterface $blockContext)
{
$settings = $blockContext->getSettings();
return $settings['menu_name'];
}
protected function getMenuOptions(array $settings)
{
$mapping = array('current_class'=>'currentClass','first_class'=>'firstClass','last_class'=>'lastClass','safe_labels'=>'allow_safe_labels','menu_template'=>'template',
);
$options = array();
foreach ($settings as $key => $value) {
if (array_key_exists($key, $mapping) && null !== $value) {
$options[$mapping[$key]] = $value;
}
}
return $options;
}
}}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class TextBlockService extends BaseBlockService
{
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return $this->renderResponse($blockContext->getTemplate(), array('block'=> $blockContext->getBlock(),'settings'=> $blockContext->getSettings()
), $response);
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('settings','sonata_type_immutable_array', array('keys'=> array(
array('content','textarea', array()),
)
));
}
public function getName()
{
return'Text (core)';
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('content'=>'Insert your custom content here','template'=>'SonataBlockBundle:Block:block_core_text.html.twig'));
}
}
}
namespace Sonata\BlockBundle\Exception
{
interface BlockExceptionInterface
{
}
}
namespace Symfony\Component\HttpKernel\Exception
{
interface HttpExceptionInterface
{
public function getStatusCode();
public function getHeaders();
}
}
namespace Symfony\Component\HttpKernel\Exception
{
class HttpException extends \RuntimeException implements HttpExceptionInterface
{
private $statusCode;
private $headers;
public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
{
$this->statusCode = $statusCode;
$this->headers = $headers;
parent::__construct($message, $code, $previous);
}
public function getStatusCode()
{
return $this->statusCode;
}
public function getHeaders()
{
return $this->headers;
}
}
}
namespace Symfony\Component\HttpKernel\Exception
{
class NotFoundHttpException extends HttpException
{
public function __construct($message = null, \Exception $previous = null, $code = 0)
{
parent::__construct(404, $message, $previous, array(), $code);
}
}
}
namespace Sonata\BlockBundle\Exception
{
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class BlockNotFoundException extends NotFoundHttpException
{
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
interface FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class DebugOnlyFilter implements FilterInterface
{
protected $debug;
public function __construct($debug)
{
$this->debug = $debug;
}
public function handle(\Exception $exception, BlockInterface $block)
{
return $this->debug ? true : false;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class IgnoreClassFilter implements FilterInterface
{
protected $class;
public function __construct($class)
{
$this->class = $class;
}
public function handle(\Exception $exception, BlockInterface $block)
{
return (!$exception instanceof $this->class);
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class KeepAllFilter implements FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block)
{
return true;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class KeepNoneFilter implements FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block)
{
return false;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Symfony\Component\HttpFoundation\Response;
use Sonata\BlockBundle\Model\BlockInterface;
interface RendererInterface
{
public function render(\Exception $exception, BlockInterface $block, Response $response = null);
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpKernel\Exception\FlattenException;
class InlineDebugRenderer implements RendererInterface
{
protected $templating;
protected $template;
protected $forceStyle;
protected $debug;
public function __construct(EngineInterface $templating, $template, $debug, $forceStyle = true)
{
$this->templating = $templating;
$this->template = $template;
$this->debug = $debug;
$this->forceStyle = $forceStyle;
}
public function render(\Exception $exception, BlockInterface $block, Response $response = null)
{
$response = $response ?: new Response();
if (!$this->debug) {
return $response;
}
$flattenException = FlattenException::create($exception);
$code = $flattenException->getStatusCode();
$parameters = array('exception'=> $flattenException,'status_code'=> $code,'status_text'=> isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] :'','logger'=> false,'currentContent'=> false,'block'=> $block,'forceStyle'=> $this->forceStyle
);
$content = $this->templating->render($this->template, $parameters);
$response->setContent($content);
return $response;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Sonata\BlockBundle\Model\BlockInterface;
class InlineRenderer implements RendererInterface
{
protected $templating;
protected $template;
public function __construct(EngineInterface $templating, $template)
{
$this->templating = $templating;
$this->template = $template;
}
public function render(\Exception $exception, BlockInterface $block, Response $response = null)
{
$parameters = array('exception'=> $exception,'block'=> $block
);
$content = $this->templating->render($this->template, $parameters);
$response = $response ?: new Response();
$response->setContent($content);
return $response;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Symfony\Component\HttpFoundation\Response;
use Sonata\BlockBundle\Model\BlockInterface;
class MonkeyThrowRenderer implements RendererInterface
{
public function render(\Exception $banana, BlockInterface $block, Response $response = null)
{
throw $banana;
}
}
}
namespace Sonata\BlockBundle\Exception\Strategy
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
interface StrategyManagerInterface
{
public function handleException(\Exception $exception, BlockInterface $block, Response $response = null);
}
}
namespace Sonata\BlockBundle\Exception\Strategy
{
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Exception\Renderer\RendererInterface;
use Sonata\BlockBundle\Exception\Filter\FilterInterface;
class StrategyManager implements StrategyManagerInterface
{
protected $container;
protected $filters;
protected $renderers;
protected $blockFilters;
protected $blockRenderers;
protected $defaultFilter;
protected $defaultRenderer;
public function __construct(ContainerInterface $container, array $filters, array $renderers, array $blockFilters, array $blockRenderers)
{
$this->container = $container;
$this->filters = $filters;
$this->renderers = $renderers;
$this->blockFilters = $blockFilters;
$this->blockRenderers = $blockRenderers;
}
public function setDefaultFilter($name)
{
if (!array_key_exists($name, $this->filters)) {
throw new \InvalidArgumentException(sprintf('Cannot set default exception filter "%s". It does not exist.', $name));
}
$this->defaultFilter = $name;
}
public function setDefaultRenderer($name)
{
if (!array_key_exists($name, $this->renderers)) {
throw new \InvalidArgumentException(sprintf('Cannot set default exception renderer "%s". It does not exist.', $name));
}
$this->defaultRenderer = $name;
}
public function handleException(\Exception $exception, BlockInterface $block, Response $response = null)
{
$response = $response ?: new Response();
$response->setPrivate();
$filter = $this->getBlockFilter($block);
if ($filter->handle($exception, $block)) {
$renderer = $this->getBlockRenderer($block);
$response = $renderer->render($exception, $block, $response);
} else {
}
return $response;
}
public function getBlockRenderer(BlockInterface $block)
{
$type = $block->getType();
$name = isset($this->blockRenderers[$type]) ? $this->blockRenderers[$type] : $this->defaultRenderer;
$service = $this->getRendererService($name);
if (!$service instanceof RendererInterface) {
throw new \RuntimeException(sprintf('The service "%s" is not an exception renderer', $name));
}
return $service;
}
public function getBlockFilter(BlockInterface $block)
{
$type = $block->getType();
$name = isset($this->blockFilters[$type]) ? $this->blockFilters[$type] : $this->defaultFilter;
$service = $this->getFilterService($name);
if (!$service instanceof FilterInterface) {
throw new \RuntimeException(sprintf('The service "%s" is not an exception filter', $name));
}
return $service;
}
protected function getFilterService($name)
{
if (!isset($this->filters[$name])) {
throw new \RuntimeException('The filter "%s" does not exist.');
}
return $this->container->get($this->filters[$name]);
}
protected function getRendererService($name)
{
if (!isset($this->renderers[$name])) {
throw new \RuntimeException('The renderer "%s" does not exist.');
}
return $this->container->get($this->renderers[$name]);
}
}
}
namespace Sonata\BlockBundle\Form\Type
{
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Block\BlockServiceManagerInterface;
class ServiceListType extends AbstractType
{
protected $manager;
public function __construct(BlockServiceManagerInterface $manager)
{
$this->manager = $manager;
}
public function getName()
{
return'sonata_block_service_choice';
}
public function getParent()
{
return'choice';
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$manager = $this->manager;
$resolver->setRequired(array('context',
));
$resolver->setDefaults(array('multiple'=> false,'expanded'=> false,'choices'=> function (Options $options, $previousValue) use ($manager) {
$types = array();
foreach ($manager->getServicesByContext($options['context'], $options['include_containers']) as $code => $service) {
$types[$code] = sprintf('%s - %s', $service->getName(), $code);
}
return $types;
},'preferred_choices'=> array(),'empty_data'=> function (Options $options) {
$multiple = isset($options['multiple']) && $options['multiple'];
$expanded = isset($options['expanded']) && $options['expanded'];
return $multiple || $expanded ? array() :'';
},'empty_value'=> function (Options $options, $previousValue) {
$multiple = isset($options['multiple']) && $options['multiple'];
$expanded = isset($options['expanded']) && $options['expanded'];
return $multiple || $expanded || !isset($previousValue) ? null :'';
},'error_bubbling'=> false,'include_containers'=> false
));
}
}
}
namespace Sonata\BlockBundle\Model
{
class Block extends BaseBlock
{
protected $id;
public function setId($id)
{
$this->id = $id;
}
public function getId()
{
return $this->id;
}
}
}
namespace Sonata\BlockBundle\Model
{
use Sonata\BlockBundle\Model\Block;
class EmptyBlock extends Block
{
}
}
namespace Sonata\BlockBundle\Twig\Extension
{
use Sonata\BlockBundle\Templating\Helper\BlockHelper;
class BlockExtension extends \Twig_Extension
{
protected $blockHelper;
public function __construct(BlockHelper $blockHelper)
{
$this->blockHelper = $blockHelper;
}
public function getFunctions()
{
return array(
new \Twig_SimpleFunction('sonata_block_render',
array($this->blockHelper,'render'),
array('is_safe'=> array('html'))
),
new \Twig_SimpleFunction('sonata_block_render_event',
array($this->blockHelper,'renderEvent'),
array('is_safe'=> array('html'))
),
new \Twig_SimpleFunction('sonata_block_include_javascripts',
array($this->blockHelper,'includeJavascripts'),
array('is_safe'=> array('html'))
),
new \Twig_SimpleFunction('sonata_block_include_stylesheets',
array($this->blockHelper,'includeStylesheets'),
array('is_safe'=> array('html'))
),
);
}
public function getName()
{
return'sonata_block';
}
}
}
namespace Sonata\BlockBundle\Twig
{
class GlobalVariables
{
protected $templates;
public function __construct(array $templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
}
}
namespace Exporter\Source
{
interface SourceIteratorInterface extends \Iterator
{
}
}
namespace Sonata\SeoBundle\Sitemap
{
use Exporter\Source\SourceIteratorInterface;
use Exporter\Source\ChainSourceIterator;
class SourceManager implements SourceIteratorInterface
{
protected $sources;
public function __construct()
{
$this->sources = new \ArrayIterator();
}
public function addSource($group, SourceIteratorInterface $source, array $types = array())
{
if (!isset($this->sources[$group])) {
$this->sources[$group] = new \stdClass();
$this->sources[$group]->sources = new ChainSourceIterator();
$this->sources[$group]->types = array();
}
$this->sources[$group]->sources->addSource($source);
if ($types) {
$this->sources[$group]->types += array_diff($types, $this->sources[$group]->types);
}
}
public function current()
{
return $this->sources->current();
}
public function next()
{
$this->sources->next();
}
public function key()
{
return $this->sources->key();
}
public function valid()
{
return $this->sources->valid();
}
public function rewind()
{
$this->sources->rewind();
}
}
}
namespace Sonata\SeoBundle\Twig\Extension
{
use Sonata\SeoBundle\Seo\SeoPageInterface;
class SeoExtension extends \Twig_Extension
{
protected $page;
protected $encoding;
public function __construct(SeoPageInterface $page, $encoding)
{
$this->page = $page;
$this->encoding = $encoding;
}
public function getFunctions()
{
return array(
new \Twig_SimpleFunction('sonata_seo_title', array($this,'getTitle'), array('is_safe'=> array('html'))),
new \Twig_SimpleFunction('sonata_seo_metadatas', array($this,'getMetadatas'), array('is_safe'=> array('html'))),
new \Twig_SimpleFunction('sonata_seo_html_attributes', array($this,'getHtmlAttributes'), array('is_safe'=> array('html'))),
new \Twig_SimpleFunction('sonata_seo_head_attributes', array($this,'getHeadAttributes'), array('is_safe'=> array('html'))),
new \Twig_SimpleFunction('sonata_seo_link_canonical', array($this,'getLinkCanonical'), array('is_safe'=> array('html'))),
new \Twig_SimpleFunction('sonata_seo_lang_alternates', array($this,'getLangAlternates'), array('is_safe'=> array('html'))),
new \Twig_SimpleFunction('sonata_seo_oembed_links', array($this,'getOembedLinks'), array('is_safe'=> array('html'))),
);
}
public function getName()
{
return'sonata_seo';
}
public function renderTitle()
{
echo $this->getTitle();
}
public function getTitle()
{
return sprintf("<title>%s</title>", strip_tags($this->page->getTitle()));
}
public function renderMetadatas()
{
echo $this->getMetadatas();
}
public function getMetadatas()
{
$html ='';
foreach ($this->page->getMetas() as $type => $metas) {
foreach ((array) $metas as $name => $meta) {
list($content, $extras) = $meta;
if (!empty($content)) {
$html .= sprintf("<meta %s=\"%s\" content=\"%s\" />\n",
$type,
$this->normalize($name),
$this->normalize($content)
);
} else {
$html .= sprintf("<meta %s=\"%s\" />\n",
$type,
$this->normalize($name)
);
}
}
}
return $html;
}
public function renderHtmlAttributes()
{
echo $this->getHtmlAttributes();
}
public function getHtmlAttributes()
{
$attributes ='';
foreach ($this->page->getHtmlAttributes() as $name => $value) {
$attributes .= sprintf('%s="%s" ', $name, $value);
}
return rtrim($attributes);
}
public function renderHeadAttributes()
{
echo $this->getHeadAttributes();
}
public function getHeadAttributes()
{
$attributes ='';
foreach ($this->page->getHeadAttributes() as $name => $value) {
$attributes .= sprintf('%s="%s" ', $name, $value);
}
return rtrim($attributes);
}
public function renderLinkCanonical()
{
echo $this->getLinkCanonical();
}
public function getLinkCanonical()
{
if ($this->page->getLinkCanonical()) {
return sprintf("<link rel=\"canonical\" href=\"%s\"/>\n", $this->page->getLinkCanonical());
}
}
public function renderLangAlternates()
{
echo $this->getLangAlternates();
}
public function getLangAlternates()
{
$html ='';
foreach ($this->page->getLangAlternates() as $href => $hrefLang) {
$html .= sprintf("<link rel=\"alternate\" href=\"%s\" hreflang=\"%s\"/>\n", $href, $hrefLang);
}
return $html;
}
public function getOembedLinks()
{
$html ='';
foreach ($this->page->getOEmbedLinks() as $title => $link) {
$html .= sprintf("<link rel=\"alternate\" type=\"application/json+oembed\" href=\"%s\" title=\"%s\" />\n", $link, $title);
}
return $html;
}
private function normalize($string)
{
return htmlentities(strip_tags($string), ENT_COMPAT, $this->encoding);
}
}
}