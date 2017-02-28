<?php
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
class appDevProjectContainer extends Container
{
    private $parameters;
    private $targetDirs = array();
    public function __construct()
    {
        $dir = __DIR__;
        for ($i = 1; $i <= 4; ++$i) {
            $this->targetDirs[$i] = $dir = dirname($dir);
        }
        $this->parameters = $this->getDefaultParameters();
        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();
        $this->set('service_container', $this);
        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
        $this->methodMap = array(
            'annotation_reader' => 'getAnnotationReaderService',
            'application.sonata.delivery.take_away' => 'getApplication_Sonata_Delivery_TakeAwayService',
            'assetic.asset_factory' => 'getAssetic_AssetFactoryService',
            'assetic.asset_manager' => 'getAssetic_AssetManagerService',
            'assetic.filter.cssrewrite' => 'getAssetic_Filter_CssrewriteService',
            'assetic.filter.yui_css' => 'getAssetic_Filter_YuiCssService',
            'assetic.filter.yui_js' => 'getAssetic_Filter_YuiJsService',
            'assetic.filter_manager' => 'getAssetic_FilterManagerService',
            'cache_clearer' => 'getCacheClearerService',
            'cache_warmer' => 'getCacheWarmerService',
            'cmf_routing.route_type_form_type' => 'getCmfRouting_RouteTypeFormTypeService',
            'cmf_routing.router' => 'getCmfRouting_RouterService',
            'controller_name_converter' => 'getControllerNameConverterService',
            'data_collector.form' => 'getDataCollector_FormService',
            'data_collector.form.extractor' => 'getDataCollector_Form_ExtractorService',
            'data_collector.request' => 'getDataCollector_RequestService',
            'data_collector.router' => 'getDataCollector_RouterService',
            'debug.debug_handlers_listener' => 'getDebug_DebugHandlersListenerService',
            'debug.stopwatch' => 'getDebug_StopwatchService',
            'doctrine' => 'getDoctrineService',
            'doctrine.dbal.connection_factory' => 'getDoctrine_Dbal_ConnectionFactoryService',
            'doctrine.dbal.default_connection' => 'getDoctrine_Dbal_DefaultConnectionService',
            'doctrine.orm.default_entity_listener_resolver' => 'getDoctrine_Orm_DefaultEntityListenerResolverService',
            'doctrine.orm.default_entity_manager' => 'getDoctrine_Orm_DefaultEntityManagerService',
            'doctrine.orm.default_manager_configurator' => 'getDoctrine_Orm_DefaultManagerConfiguratorService',
            'doctrine.orm.validator.unique' => 'getDoctrine_Orm_Validator_UniqueService',
            'doctrine.orm.validator_initializer' => 'getDoctrine_Orm_ValidatorInitializerService',
            'doctrine_cache.providers.doctrine.orm.default_metadata_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultMetadataCacheService',
            'doctrine_cache.providers.doctrine.orm.default_query_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultQueryCacheService',
            'doctrine_cache.providers.doctrine.orm.default_result_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultResultCacheService',
            'event_dispatcher' => 'getEventDispatcherService',
            'faker.formatter_factory' => 'getFaker_FormatterFactoryService',
            'faker.generator' => 'getFaker_GeneratorService',
            'faker.populator' => 'getFaker_PopulatorService',
            'file_locator' => 'getFileLocatorService',
            'filesystem' => 'getFilesystemService',
            'form.csrf_provider' => 'getForm_CsrfProviderService',
            'form.factory' => 'getForm_FactoryService',
            'form.registry' => 'getForm_RegistryService',
            'form.resolved_type_factory' => 'getForm_ResolvedTypeFactoryService',
            'form.type.birthday' => 'getForm_Type_BirthdayService',
            'form.type.button' => 'getForm_Type_ButtonService',
            'form.type.checkbox' => 'getForm_Type_CheckboxService',
            'form.type.choice' => 'getForm_Type_ChoiceService',
            'form.type.collection' => 'getForm_Type_CollectionService',
            'form.type.country' => 'getForm_Type_CountryService',
            'form.type.currency' => 'getForm_Type_CurrencyService',
            'form.type.date' => 'getForm_Type_DateService',
            'form.type.datetime' => 'getForm_Type_DatetimeService',
            'form.type.email' => 'getForm_Type_EmailService',
            'form.type.entity' => 'getForm_Type_EntityService',
            'form.type.file' => 'getForm_Type_FileService',
            'form.type.form' => 'getForm_Type_FormService',
            'form.type.hidden' => 'getForm_Type_HiddenService',
            'form.type.integer' => 'getForm_Type_IntegerService',
            'form.type.language' => 'getForm_Type_LanguageService',
            'form.type.locale' => 'getForm_Type_LocaleService',
            'form.type.money' => 'getForm_Type_MoneyService',
            'form.type.number' => 'getForm_Type_NumberService',
            'form.type.password' => 'getForm_Type_PasswordService',
            'form.type.percent' => 'getForm_Type_PercentService',
            'form.type.radio' => 'getForm_Type_RadioService',
            'form.type.repeated' => 'getForm_Type_RepeatedService',
            'form.type.reset' => 'getForm_Type_ResetService',
            'form.type.search' => 'getForm_Type_SearchService',
            'form.type.submit' => 'getForm_Type_SubmitService',
            'form.type.text' => 'getForm_Type_TextService',
            'form.type.textarea' => 'getForm_Type_TextareaService',
            'form.type.time' => 'getForm_Type_TimeService',
            'form.type.timezone' => 'getForm_Type_TimezoneService',
            'form.type.url' => 'getForm_Type_UrlService',
            'form.type_extension.csrf' => 'getForm_TypeExtension_CsrfService',
            'form.type_extension.form.data_collector' => 'getForm_TypeExtension_Form_DataCollectorService',
            'form.type_extension.form.http_foundation' => 'getForm_TypeExtension_Form_HttpFoundationService',
            'form.type_extension.form.validator' => 'getForm_TypeExtension_Form_ValidatorService',
            'form.type_extension.repeated.validator' => 'getForm_TypeExtension_Repeated_ValidatorService',
            'form.type_extension.submit.validator' => 'getForm_TypeExtension_Submit_ValidatorService',
            'form.type_guesser.doctrine' => 'getForm_TypeGuesser_DoctrineService',
            'form.type_guesser.validator' => 'getForm_TypeGuesser_ValidatorService',
            'fos_comment.entity_manager' => 'getFosComment_EntityManagerService',
            'fos_comment.form_factory.comment' => 'getFosComment_FormFactory_CommentService',
            'fos_comment.form_factory.commentable_thread' => 'getFosComment_FormFactory_CommentableThreadService',
            'fos_comment.form_factory.delete_comment' => 'getFosComment_FormFactory_DeleteCommentService',
            'fos_comment.form_factory.thread' => 'getFosComment_FormFactory_ThreadService',
            'fos_comment.form_factory.vote' => 'getFosComment_FormFactory_VoteService',
            'fos_comment.form_type.comment.default' => 'getFosComment_FormType_Comment_DefaultService',
            'fos_comment.form_type.commentable_thread.default' => 'getFosComment_FormType_CommentableThread_DefaultService',
            'fos_comment.form_type.delete_comment.default' => 'getFosComment_FormType_DeleteComment_DefaultService',
            'fos_comment.form_type.thread.default' => 'getFosComment_FormType_Thread_DefaultService',
            'fos_comment.form_type.vote.default' => 'getFosComment_FormType_Vote_DefaultService',
            'fos_comment.listener.closed_threads' => 'getFosComment_Listener_ClosedThreadsService',
            'fos_comment.listener.comment_blamer' => 'getFosComment_Listener_CommentBlamerService',
            'fos_comment.listener.comment_vote_score' => 'getFosComment_Listener_CommentVoteScoreService',
            'fos_comment.listener.thread_counters' => 'getFosComment_Listener_ThreadCountersService',
            'fos_comment.listener.thread_permalink' => 'getFosComment_Listener_ThreadPermalinkService',
            'fos_comment.listener.vote_blamer' => 'getFosComment_Listener_VoteBlamerService',
            'fos_comment.manager.comment.default' => 'getFosComment_Manager_Comment_DefaultService',
            'fos_comment.manager.thread.default' => 'getFosComment_Manager_Thread_DefaultService',
            'fos_comment.manager.vote.default' => 'getFosComment_Manager_Vote_DefaultService',
            'fos_comment.sorting_factory' => 'getFosComment_SortingFactoryService',
            'fos_rest.body_listener' => 'getFosRest_BodyListenerService',
            'fos_rest.controller.exception' => 'getFosRest_Controller_ExceptionService',
            'fos_rest.decoder.json' => 'getFosRest_Decoder_JsonService',
            'fos_rest.decoder.jsontoform' => 'getFosRest_Decoder_JsontoformService',
            'fos_rest.decoder.xml' => 'getFosRest_Decoder_XmlService',
            'fos_rest.decoder_provider' => 'getFosRest_DecoderProviderService',
            'fos_rest.exception_format_negotiator' => 'getFosRest_ExceptionFormatNegotiatorService',
            'fos_rest.exception_listener' => 'getFosRest_ExceptionListenerService',
            'fos_rest.format_negotiator' => 'getFosRest_FormatNegotiatorService',
            'fos_rest.inflector.doctrine' => 'getFosRest_Inflector_DoctrineService',
            'fos_rest.normalizer.camel_keys' => 'getFosRest_Normalizer_CamelKeysService',
            'fos_rest.param_fetcher_listener' => 'getFosRest_ParamFetcherListenerService',
            'fos_rest.request.param_fetcher' => 'getFosRest_Request_ParamFetcherService',
            'fos_rest.request.param_fetcher.reader' => 'getFosRest_Request_ParamFetcher_ReaderService',
            'fos_rest.routing.loader.controller' => 'getFosRest_Routing_Loader_ControllerService',
            'fos_rest.routing.loader.processor' => 'getFosRest_Routing_Loader_ProcessorService',
            'fos_rest.routing.loader.reader.action' => 'getFosRest_Routing_Loader_Reader_ActionService',
            'fos_rest.routing.loader.reader.controller' => 'getFosRest_Routing_Loader_Reader_ControllerService',
            'fos_rest.routing.loader.xml_collection' => 'getFosRest_Routing_Loader_XmlCollectionService',
            'fos_rest.routing.loader.yaml_collection' => 'getFosRest_Routing_Loader_YamlCollectionService',
            'fos_rest.serializer.exception_wrapper_serialize_handler' => 'getFosRest_Serializer_ExceptionWrapperSerializeHandlerService',
            'fos_rest.view.exception_wrapper_handler' => 'getFosRest_View_ExceptionWrapperHandlerService',
            'fos_rest.view_handler' => 'getFosRest_ViewHandlerService',
            'fos_rest.view_response_listener' => 'getFosRest_ViewResponseListenerService',
            'fos_rest.violation_formatter' => 'getFosRest_ViolationFormatterService',
            'fos_user.change_password.form' => 'getFosUser_ChangePassword_FormService',
            'fos_user.change_password.form.handler.default' => 'getFosUser_ChangePassword_Form_Handler_DefaultService',
            'fos_user.change_password.form.type' => 'getFosUser_ChangePassword_Form_TypeService',
            'fos_user.entity_manager' => 'getFosUser_EntityManagerService',
            'fos_user.group.form' => 'getFosUser_Group_FormService',
            'fos_user.group.form.handler' => 'getFosUser_Group_Form_HandlerService',
            'fos_user.group.form.type' => 'getFosUser_Group_Form_TypeService',
            'fos_user.group_manager' => 'getFosUser_GroupManagerService',
            'fos_user.mailer' => 'getFosUser_MailerService',
            'fos_user.profile.form' => 'getFosUser_Profile_FormService',
            'fos_user.profile.form.handler' => 'getFosUser_Profile_Form_HandlerService',
            'fos_user.profile.form.type' => 'getFosUser_Profile_Form_TypeService',
            'fos_user.registration.form' => 'getFosUser_Registration_FormService',
            'fos_user.registration.form.handler' => 'getFosUser_Registration_Form_HandlerService',
            'fos_user.registration.form.type' => 'getFosUser_Registration_Form_TypeService',
            'fos_user.resetting.form' => 'getFosUser_Resetting_FormService',
            'fos_user.resetting.form.handler' => 'getFosUser_Resetting_Form_HandlerService',
            'fos_user.resetting.form.type' => 'getFosUser_Resetting_Form_TypeService',
            'fos_user.security.interactive_login_listener' => 'getFosUser_Security_InteractiveLoginListenerService',
            'fos_user.security.login_manager' => 'getFosUser_Security_LoginManagerService',
            'fos_user.user_manager' => 'getFosUser_UserManagerService',
            'fos_user.username_form_type' => 'getFosUser_UsernameFormTypeService',
            'fos_user.util.email_canonicalizer' => 'getFosUser_Util_EmailCanonicalizerService',
            'fos_user.util.token_generator' => 'getFosUser_Util_TokenGeneratorService',
            'fos_user.util.user_manipulator' => 'getFosUser_Util_UserManipulatorService',
            'fragment.handler' => 'getFragment_HandlerService',
            'fragment.listener' => 'getFragment_ListenerService',
            'fragment.renderer.esi' => 'getFragment_Renderer_EsiService',
            'fragment.renderer.hinclude' => 'getFragment_Renderer_HincludeService',
            'fragment.renderer.inline' => 'getFragment_Renderer_InlineService',
            'fragment.renderer.ssi' => 'getFragment_Renderer_SsiService',
            'http_kernel' => 'getHttpKernelService',
            'ivory_ck_editor.config_manager' => 'getIvoryCkEditor_ConfigManagerService',
            'ivory_ck_editor.form.type' => 'getIvoryCkEditor_Form_TypeService',
            'ivory_ck_editor.plugin_manager' => 'getIvoryCkEditor_PluginManagerService',
            'ivory_ck_editor.styles_set_manager' => 'getIvoryCkEditor_StylesSetManagerService',
            'ivory_ck_editor.template_manager' => 'getIvoryCkEditor_TemplateManagerService',
            'ivory_ck_editor.templating.helper' => 'getIvoryCkEditor_Templating_HelperService',
            'ivory_ck_editor.twig_extension' => 'getIvoryCkEditor_TwigExtensionService',
            'jms_aop.interceptor_loader' => 'getJmsAop_InterceptorLoaderService',
            'jms_aop.pointcut_container' => 'getJmsAop_PointcutContainerService',
            'jms_serializer' => 'getJmsSerializerService',
            'jms_serializer.array_collection_handler' => 'getJmsSerializer_ArrayCollectionHandlerService',
            'jms_serializer.constraint_violation_handler' => 'getJmsSerializer_ConstraintViolationHandlerService',
            'jms_serializer.datetime_handler' => 'getJmsSerializer_DatetimeHandlerService',
            'jms_serializer.doctrine_proxy_subscriber' => 'getJmsSerializer_DoctrineProxySubscriberService',
            'jms_serializer.form_error_handler' => 'getJmsSerializer_FormErrorHandlerService',
            'jms_serializer.handler_registry' => 'getJmsSerializer_HandlerRegistryService',
            'jms_serializer.json_deserialization_visitor' => 'getJmsSerializer_JsonDeserializationVisitorService',
            'jms_serializer.json_serialization_visitor' => 'getJmsSerializer_JsonSerializationVisitorService',
            'jms_serializer.metadata_driver' => 'getJmsSerializer_MetadataDriverService',
            'jms_serializer.metadata_factory' => 'getJmsSerializer_MetadataFactoryService',
            'jms_serializer.naming_strategy' => 'getJmsSerializer_NamingStrategyService',
            'jms_serializer.object_constructor' => 'getJmsSerializer_ObjectConstructorService',
            'jms_serializer.php_collection_handler' => 'getJmsSerializer_PhpCollectionHandlerService',
            'jms_serializer.templating.helper.serializer' => 'getJmsSerializer_Templating_Helper_SerializerService',
            'jms_serializer.unserialize_object_constructor' => 'getJmsSerializer_UnserializeObjectConstructorService',
            'jms_serializer.xml_deserialization_visitor' => 'getJmsSerializer_XmlDeserializationVisitorService',
            'jms_serializer.xml_serialization_visitor' => 'getJmsSerializer_XmlSerializationVisitorService',
            'jms_serializer.yaml_serialization_visitor' => 'getJmsSerializer_YamlSerializationVisitorService',
            'kernel' => 'getKernelService',
            'knp_menu.factory' => 'getKnpMenu_FactoryService',
            'knp_menu.listener.voters' => 'getKnpMenu_Listener_VotersService',
            'knp_menu.matcher' => 'getKnpMenu_MatcherService',
            'knp_menu.menu_provider' => 'getKnpMenu_MenuProviderService',
            'knp_menu.renderer.list' => 'getKnpMenu_Renderer_ListService',
            'knp_menu.renderer.twig' => 'getKnpMenu_Renderer_TwigService',
            'knp_menu.renderer_provider' => 'getKnpMenu_RendererProviderService',
            'knp_menu.voter.router' => 'getKnpMenu_Voter_RouterService',
            'knp_paginator' => 'getKnpPaginatorService',
            'knp_paginator.helper.processor' => 'getKnpPaginator_Helper_ProcessorService',
            'knp_paginator.subscriber.filtration' => 'getKnpPaginator_Subscriber_FiltrationService',
            'knp_paginator.subscriber.paginate' => 'getKnpPaginator_Subscriber_PaginateService',
            'knp_paginator.subscriber.sliding_pagination' => 'getKnpPaginator_Subscriber_SlidingPaginationService',
            'knp_paginator.subscriber.sortable' => 'getKnpPaginator_Subscriber_SortableService',
            'knp_paginator.templating.helper.pagination' => 'getKnpPaginator_Templating_Helper_PaginationService',
            'knp_paginator.twig.extension.pagination' => 'getKnpPaginator_Twig_Extension_PaginationService',
            'locale_listener' => 'getLocaleListenerService',
            'logger' => 'getLoggerService',
            'markdown.parser' => 'getMarkdown_ParserService',
            'monolog.handler.main' => 'getMonolog_Handler_MainService',
            'monolog.logger.assetic' => 'getMonolog_Logger_AsseticService',
            'monolog.logger.doctrine' => 'getMonolog_Logger_DoctrineService',
            'monolog.logger.php' => 'getMonolog_Logger_PhpService',
            'monolog.logger.profiler' => 'getMonolog_Logger_ProfilerService',
            'monolog.logger.request' => 'getMonolog_Logger_RequestService',
            'monolog.logger.router' => 'getMonolog_Logger_RouterService',
            'monolog.logger.security' => 'getMonolog_Logger_SecurityService',
            'monolog.logger.translation' => 'getMonolog_Logger_TranslationService',
            'mopa_bootstrap.form.type.tab' => 'getMopaBootstrap_Form_Type_TabService',
            'mopa_bootstrap.form.type_extension.button' => 'getMopaBootstrap_Form_TypeExtension_ButtonService',
            'mopa_bootstrap.form.type_extension.date' => 'getMopaBootstrap_Form_TypeExtension_DateService',
            'mopa_bootstrap.form.type_extension.error' => 'getMopaBootstrap_Form_TypeExtension_ErrorService',
            'mopa_bootstrap.form.type_extension.help' => 'getMopaBootstrap_Form_TypeExtension_HelpService',
            'mopa_bootstrap.form.type_extension.horizontal' => 'getMopaBootstrap_Form_TypeExtension_HorizontalService',
            'mopa_bootstrap.form.type_extension.legend' => 'getMopaBootstrap_Form_TypeExtension_LegendService',
            'mopa_bootstrap.form.type_extension.tabbed' => 'getMopaBootstrap_Form_TypeExtension_TabbedService',
            'mopa_bootstrap.form.type_extension.widget' => 'getMopaBootstrap_Form_TypeExtension_WidgetService',
            'mopa_bootstrap.form.type_extension.widget_collection' => 'getMopaBootstrap_Form_TypeExtension_WidgetCollectionService',
            'mopa_bootstrap.twig.extension.bootstrap_form' => 'getMopaBootstrap_Twig_Extension_BootstrapFormService',
            'mopa_bootstrap.twig.extension.bootstrap_icon' => 'getMopaBootstrap_Twig_Extension_BootstrapIconService',
            'nelmio_api_doc.doc_comment_extractor' => 'getNelmioApiDoc_DocCommentExtractorService',
            'nelmio_api_doc.event_listener.request' => 'getNelmioApiDoc_EventListener_RequestService',
            'nelmio_api_doc.extractor.api_doc_extractor' => 'getNelmioApiDoc_Extractor_ApiDocExtractorService',
            'nelmio_api_doc.form.extension.description_form_type_extension' => 'getNelmioApiDoc_Form_Extension_DescriptionFormTypeExtensionService',
            'nelmio_api_doc.formatter.html_formatter' => 'getNelmioApiDoc_Formatter_HtmlFormatterService',
            'nelmio_api_doc.formatter.markdown_formatter' => 'getNelmioApiDoc_Formatter_MarkdownFormatterService',
            'nelmio_api_doc.formatter.simple_formatter' => 'getNelmioApiDoc_Formatter_SimpleFormatterService',
            'nelmio_api_doc.formatter.swagger_formatter' => 'getNelmioApiDoc_Formatter_SwaggerFormatterService',
            'nelmio_api_doc.parser.collection_parser' => 'getNelmioApiDoc_Parser_CollectionParserService',
            'nelmio_api_doc.parser.form_errors_parser' => 'getNelmioApiDoc_Parser_FormErrorsParserService',
            'nelmio_api_doc.parser.form_type_parser' => 'getNelmioApiDoc_Parser_FormTypeParserService',
            'nelmio_api_doc.parser.jms_metadata_parser' => 'getNelmioApiDoc_Parser_JmsMetadataParserService',
            'nelmio_api_doc.parser.validation_parser' => 'getNelmioApiDoc_Parser_ValidationParserService',
            'nelmio_api_doc.twig.extension.extra_markdown' => 'getNelmioApiDoc_Twig_Extension_ExtraMarkdownService',
            'profiler' => 'getProfilerService',
            'profiler_listener' => 'getProfilerListenerService',
            'property_accessor' => 'getPropertyAccessorService',
            'request' => 'getRequestService',
            'request_stack' => 'getRequestStackService',
            'response_listener' => 'getResponseListenerService',
            'router.default' => 'getRouter_DefaultService',
            'router.request_context' => 'getRouter_RequestContextService',
            'router_listener' => 'getRouterListenerService',
            'routing.loader' => 'getRouting_LoaderService',
            'security.access.decision_manager' => 'getSecurity_Access_DecisionManagerService',
            'security.access.method_interceptor' => 'getSecurity_Access_MethodInterceptorService',
            'security.access.pointcut' => 'getSecurity_Access_PointcutService',
            'security.access_listener' => 'getSecurity_AccessListenerService',
            'security.access_map' => 'getSecurity_AccessMapService',
            'security.acl.dbal.schema' => 'getSecurity_Acl_Dbal_SchemaService',
            'security.acl.dbal.schema_listener' => 'getSecurity_Acl_Dbal_SchemaListenerService',
            'security.acl.object_identity_retrieval_strategy' => 'getSecurity_Acl_ObjectIdentityRetrievalStrategyService',
            'security.acl.permission.map' => 'getSecurity_Acl_Permission_MapService',
            'security.acl.provider' => 'getSecurity_Acl_ProviderService',
            'security.acl.security_identity_retrieval_strategy' => 'getSecurity_Acl_SecurityIdentityRetrievalStrategyService',
            'security.authentication.manager' => 'getSecurity_Authentication_ManagerService',
            'security.authentication.session_strategy' => 'getSecurity_Authentication_SessionStrategyService',
            'security.authentication.trust_resolver' => 'getSecurity_Authentication_TrustResolverService',
            'security.authentication_utils' => 'getSecurity_AuthenticationUtilsService',
            'security.authorization_checker' => 'getSecurity_AuthorizationCheckerService',
            'security.channel_listener' => 'getSecurity_ChannelListenerService',
            'security.context' => 'getSecurity_ContextService',
            'security.context_listener.0' => 'getSecurity_ContextListener_0Service',
            'security.csrf.token_manager' => 'getSecurity_Csrf_TokenManagerService',
            'security.encoder_factory' => 'getSecurity_EncoderFactoryService',
            'security.extra.metadata_driver' => 'getSecurity_Extra_MetadataDriverService',
            'security.extra.metadata_factory' => 'getSecurity_Extra_MetadataFactoryService',
            'security.firewall' => 'getSecurity_FirewallService',
            'security.firewall.map.context.admin' => 'getSecurity_Firewall_Map_Context_AdminService',
            'security.firewall.map.context.api' => 'getSecurity_Firewall_Map_Context_ApiService',
            'security.firewall.map.context.dev' => 'getSecurity_Firewall_Map_Context_DevService',
            'security.firewall.map.context.main' => 'getSecurity_Firewall_Map_Context_MainService',
            'security.http_utils' => 'getSecurity_HttpUtilsService',
            'security.password_encoder' => 'getSecurity_PasswordEncoderService',
            'security.rememberme.response_listener' => 'getSecurity_Rememberme_ResponseListenerService',
            'security.role_hierarchy' => 'getSecurity_RoleHierarchyService',
            'security.secure_random' => 'getSecurity_SecureRandomService',
            'security.token_storage' => 'getSecurity_TokenStorageService',
            'security.user.provider.concrete.in_memory' => 'getSecurity_User_Provider_Concrete_InMemoryService',
            'security.user_checker' => 'getSecurity_UserCheckerService',
            'security.validator.user_password' => 'getSecurity_Validator_UserPasswordService',
            'sensio_framework_extra.cache.listener' => 'getSensioFrameworkExtra_Cache_ListenerService',
            'sensio_framework_extra.controller.listener' => 'getSensioFrameworkExtra_Controller_ListenerService',
            'sensio_framework_extra.converter.datetime' => 'getSensioFrameworkExtra_Converter_DatetimeService',
            'sensio_framework_extra.converter.doctrine.orm' => 'getSensioFrameworkExtra_Converter_Doctrine_OrmService',
            'sensio_framework_extra.converter.listener' => 'getSensioFrameworkExtra_Converter_ListenerService',
            'sensio_framework_extra.converter.manager' => 'getSensioFrameworkExtra_Converter_ManagerService',
            'sensio_framework_extra.view.guesser' => 'getSensioFrameworkExtra_View_GuesserService',
            'service_container' => 'getServiceContainerService',
            'session' => 'getSessionService',
            'session.handler' => 'getSession_HandlerService',
            'session.save_listener' => 'getSession_SaveListenerService',
            'session.storage.filesystem' => 'getSession_Storage_FilesystemService',
            'session.storage.metadata_bag' => 'getSession_Storage_MetadataBagService',
            'session.storage.native' => 'getSession_Storage_NativeService',
            'session.storage.php_bridge' => 'getSession_Storage_PhpBridgeService',
            'session_listener' => 'getSessionListenerService',
            'simplethings_entityaudit.config' => 'getSimplethingsEntityaudit_ConfigService',
            'simplethings_entityaudit.create_schema_listener' => 'getSimplethingsEntityaudit_CreateSchemaListenerService',
            'simplethings_entityaudit.log_revisions_listener' => 'getSimplethingsEntityaudit_LogRevisionsListenerService',
            'simplethings_entityaudit.manager' => 'getSimplethingsEntityaudit_ManagerService',
            'simplethings_entityaudit.reader' => 'getSimplethingsEntityaudit_ReaderService',
            'simplethings_entityaudit.request.current_user_listener' => 'getSimplethingsEntityaudit_Request_CurrentUserListenerService',
            'sonata.address.manager' => 'getSonata_Address_ManagerService',
            'sonata.admin.audit.manager' => 'getSonata_Admin_Audit_ManagerService',
            'sonata.admin.audit.orm.reader' => 'getSonata_Admin_Audit_Orm_ReaderService',
            'sonata.admin.block.admin_list' => 'getSonata_Admin_Block_AdminListService',
            'sonata.admin.block.search_result' => 'getSonata_Admin_Block_SearchResultService',
            'sonata.admin.builder.filter.factory' => 'getSonata_Admin_Builder_Filter_FactoryService',
            'sonata.admin.builder.orm_datagrid' => 'getSonata_Admin_Builder_OrmDatagridService',
            'sonata.admin.builder.orm_form' => 'getSonata_Admin_Builder_OrmFormService',
            'sonata.admin.builder.orm_list' => 'getSonata_Admin_Builder_OrmListService',
            'sonata.admin.builder.orm_show' => 'getSonata_Admin_Builder_OrmShowService',
            'sonata.admin.controller.admin' => 'getSonata_Admin_Controller_AdminService',
            'sonata.admin.event.extension' => 'getSonata_Admin_Event_ExtensionService',
            'sonata.admin.exporter' => 'getSonata_Admin_ExporterService',
            'sonata.admin.form.extension.field' => 'getSonata_Admin_Form_Extension_FieldService',
            'sonata.admin.form.filter.type.choice' => 'getSonata_Admin_Form_Filter_Type_ChoiceService',
            'sonata.admin.form.filter.type.date' => 'getSonata_Admin_Form_Filter_Type_DateService',
            'sonata.admin.form.filter.type.daterange' => 'getSonata_Admin_Form_Filter_Type_DaterangeService',
            'sonata.admin.form.filter.type.datetime' => 'getSonata_Admin_Form_Filter_Type_DatetimeService',
            'sonata.admin.form.filter.type.datetime_range' => 'getSonata_Admin_Form_Filter_Type_DatetimeRangeService',
            'sonata.admin.form.filter.type.default' => 'getSonata_Admin_Form_Filter_Type_DefaultService',
            'sonata.admin.form.filter.type.number' => 'getSonata_Admin_Form_Filter_Type_NumberService',
            'sonata.admin.form.type.admin' => 'getSonata_Admin_Form_Type_AdminService',
            'sonata.admin.form.type.collection' => 'getSonata_Admin_Form_Type_CollectionService',
            'sonata.admin.form.type.model_autocomplete' => 'getSonata_Admin_Form_Type_ModelAutocompleteService',
            'sonata.admin.form.type.model_choice' => 'getSonata_Admin_Form_Type_ModelChoiceService',
            'sonata.admin.form.type.model_hidden' => 'getSonata_Admin_Form_Type_ModelHiddenService',
            'sonata.admin.form.type.model_list' => 'getSonata_Admin_Form_Type_ModelListService',
            'sonata.admin.form.type.model_reference' => 'getSonata_Admin_Form_Type_ModelReferenceService',
            'sonata.admin.guesser.orm_datagrid' => 'getSonata_Admin_Guesser_OrmDatagridService',
            'sonata.admin.guesser.orm_datagrid_chain' => 'getSonata_Admin_Guesser_OrmDatagridChainService',
            'sonata.admin.guesser.orm_list' => 'getSonata_Admin_Guesser_OrmListService',
            'sonata.admin.guesser.orm_list_chain' => 'getSonata_Admin_Guesser_OrmListChainService',
            'sonata.admin.guesser.orm_show' => 'getSonata_Admin_Guesser_OrmShowService',
            'sonata.admin.guesser.orm_show_chain' => 'getSonata_Admin_Guesser_OrmShowChainService',
            'sonata.admin.helper' => 'getSonata_Admin_HelperService',
            'sonata.admin.label.strategy.bc' => 'getSonata_Admin_Label_Strategy_BcService',
            'sonata.admin.label.strategy.form_component' => 'getSonata_Admin_Label_Strategy_FormComponentService',
            'sonata.admin.label.strategy.native' => 'getSonata_Admin_Label_Strategy_NativeService',
            'sonata.admin.label.strategy.noop' => 'getSonata_Admin_Label_Strategy_NoopService',
            'sonata.admin.label.strategy.underscore' => 'getSonata_Admin_Label_Strategy_UnderscoreService',
            'sonata.admin.manager.orm' => 'getSonata_Admin_Manager_OrmService',
            'sonata.admin.manipulator.acl.admin' => 'getSonata_Admin_Manipulator_Acl_AdminService',
            'sonata.admin.manipulator.acl.object.orm' => 'getSonata_Admin_Manipulator_Acl_Object_OrmService',
            'sonata.admin.object.manipulator.acl.admin' => 'getSonata_Admin_Object_Manipulator_Acl_AdminService',
            'sonata.admin.orm.filter.type.boolean' => 'getSonata_Admin_Orm_Filter_Type_BooleanService',
            'sonata.admin.orm.filter.type.callback' => 'getSonata_Admin_Orm_Filter_Type_CallbackService',
            'sonata.admin.orm.filter.type.choice' => 'getSonata_Admin_Orm_Filter_Type_ChoiceService',
            'sonata.admin.orm.filter.type.class' => 'getSonata_Admin_Orm_Filter_Type_ClassService',
            'sonata.admin.orm.filter.type.date' => 'getSonata_Admin_Orm_Filter_Type_DateService',
            'sonata.admin.orm.filter.type.date_range' => 'getSonata_Admin_Orm_Filter_Type_DateRangeService',
            'sonata.admin.orm.filter.type.datetime' => 'getSonata_Admin_Orm_Filter_Type_DatetimeService',
            'sonata.admin.orm.filter.type.datetime_range' => 'getSonata_Admin_Orm_Filter_Type_DatetimeRangeService',
            'sonata.admin.orm.filter.type.model' => 'getSonata_Admin_Orm_Filter_Type_ModelService',
            'sonata.admin.orm.filter.type.number' => 'getSonata_Admin_Orm_Filter_Type_NumberService',
            'sonata.admin.orm.filter.type.string' => 'getSonata_Admin_Orm_Filter_Type_StringService',
            'sonata.admin.orm.filter.type.time' => 'getSonata_Admin_Orm_Filter_Type_TimeService',
            'sonata.admin.pool' => 'getSonata_Admin_PoolService',
            'sonata.admin.route.cache' => 'getSonata_Admin_Route_CacheService',
            'sonata.admin.route.cache_warmup' => 'getSonata_Admin_Route_CacheWarmupService',
            'sonata.admin.route.default_generator' => 'getSonata_Admin_Route_DefaultGeneratorService',
            'sonata.admin.route.path_info' => 'getSonata_Admin_Route_PathInfoService',
            'sonata.admin.route.query_string' => 'getSonata_Admin_Route_QueryStringService',
            'sonata.admin.route_loader' => 'getSonata_Admin_RouteLoaderService',
            'sonata.admin.search.handler' => 'getSonata_Admin_Search_HandlerService',
            'sonata.admin.security.handler' => 'getSonata_Admin_Security_HandlerService',
            'sonata.admin.twig.extension' => 'getSonata_Admin_Twig_ExtensionService',
            'sonata.admin.validator.inline' => 'getSonata_Admin_Validator_InlineService',
            'sonata.admin_doctrine_orm.block.audit' => 'getSonata_AdminDoctrineOrm_Block_AuditService',
            'sonata.basket' => 'getSonata_BasketService',
            'sonata.basket.api.form.type.basket' => 'getSonata_Basket_Api_Form_Type_BasketService',
            'sonata.basket.api.form.type.basket.element.parent' => 'getSonata_Basket_Api_Form_Type_Basket_Element_ParentService',
            'sonata.basket.api.form.type.basket.parent' => 'getSonata_Basket_Api_Form_Type_Basket_ParentService',
            'sonata.basket.api.form.type.basket_element' => 'getSonata_Basket_Api_Form_Type_BasketElementService',
            'sonata.basket.block.nb_items' => 'getSonata_Basket_Block_NbItemsService',
            'sonata.basket.builder.standard' => 'getSonata_Basket_Builder_StandardService',
            'sonata.basket.controller.api.basket' => 'getSonata_Basket_Controller_Api_BasketService',
            'sonata.basket.entity.factory' => 'getSonata_Basket_Entity_FactoryService',
            'sonata.basket.form.type.address' => 'getSonata_Basket_Form_Type_AddressService',
            'sonata.basket.form.type.basket' => 'getSonata_Basket_Form_Type_BasketService',
            'sonata.basket.form.type.payment' => 'getSonata_Basket_Form_Type_PaymentService',
            'sonata.basket.form.type.shipping' => 'getSonata_Basket_Form_Type_ShippingService',
            'sonata.basket.loader.standard' => 'getSonata_Basket_Loader_StandardService',
            'sonata.basket.manager' => 'getSonata_Basket_ManagerService',
            'sonata.basket.session.factory' => 'getSonata_Basket_Session_FactoryService',
            'sonata.basket.twig.global' => 'getSonata_Basket_Twig_GlobalService',
            'sonata.basket.validator.basket' => 'getSonata_Basket_Validator_BasketService',
            'sonata.basket_element.manager' => 'getSonata_BasketElement_ManagerService',
            'sonata.block.cache.handler.default' => 'getSonata_Block_Cache_Handler_DefaultService',
            'sonata.block.cache.handler.noop' => 'getSonata_Block_Cache_Handler_NoopService',
            'sonata.block.context_manager.default' => 'getSonata_Block_ContextManager_DefaultService',
            'sonata.block.exception.filter.debug_only' => 'getSonata_Block_Exception_Filter_DebugOnlyService',
            'sonata.block.exception.filter.ignore_block_exception' => 'getSonata_Block_Exception_Filter_IgnoreBlockExceptionService',
            'sonata.block.exception.filter.keep_all' => 'getSonata_Block_Exception_Filter_KeepAllService',
            'sonata.block.exception.filter.keep_none' => 'getSonata_Block_Exception_Filter_KeepNoneService',
            'sonata.block.exception.renderer.inline' => 'getSonata_Block_Exception_Renderer_InlineService',
            'sonata.block.exception.renderer.inline_debug' => 'getSonata_Block_Exception_Renderer_InlineDebugService',
            'sonata.block.exception.renderer.throw' => 'getSonata_Block_Exception_Renderer_ThrowService',
            'sonata.block.exception.strategy.manager' => 'getSonata_Block_Exception_Strategy_ManagerService',
            'sonata.block.form.type.block' => 'getSonata_Block_Form_Type_BlockService',
            'sonata.block.form.type.container_template' => 'getSonata_Block_Form_Type_ContainerTemplateService',
            'sonata.block.loader.chain' => 'getSonata_Block_Loader_ChainService',
            'sonata.block.loader.service' => 'getSonata_Block_Loader_ServiceService',
            'sonata.block.manager' => 'getSonata_Block_ManagerService',
            'sonata.block.renderer.default' => 'getSonata_Block_Renderer_DefaultService',
            'sonata.block.service.container' => 'getSonata_Block_Service_ContainerService',
            'sonata.block.service.empty' => 'getSonata_Block_Service_EmptyService',
            'sonata.block.service.menu' => 'getSonata_Block_Service_MenuService',
            'sonata.block.service.rss' => 'getSonata_Block_Service_RssService',
            'sonata.block.service.template' => 'getSonata_Block_Service_TemplateService',
            'sonata.block.service.text' => 'getSonata_Block_Service_TextService',
            'sonata.block.templating.helper' => 'getSonata_Block_Templating_HelperService',
            'sonata.block.twig.global' => 'getSonata_Block_Twig_GlobalService',
            'sonata.cache.invalidation.simple' => 'getSonata_Cache_Invalidation_SimpleService',
            'sonata.cache.manager' => 'getSonata_Cache_ManagerService',
            'sonata.cache.model_identifier' => 'getSonata_Cache_ModelIdentifierService',
            'sonata.cache.noop' => 'getSonata_Cache_NoopService',
            'sonata.cache.orm.event_subscriber' => 'getSonata_Cache_Orm_EventSubscriberService',
            'sonata.cache.orm.event_subscriber.default' => 'getSonata_Cache_Orm_EventSubscriber_DefaultService',
            'sonata.cache.recorder' => 'getSonata_Cache_RecorderService',
            'sonata.classification.admin.category' => 'getSonata_Classification_Admin_CategoryService',
            'sonata.classification.admin.collection' => 'getSonata_Classification_Admin_CollectionService',
            'sonata.classification.admin.tag' => 'getSonata_Classification_Admin_TagService',
            'sonata.classification.api.form.type.category' => 'getSonata_Classification_Api_Form_Type_CategoryService',
            'sonata.classification.api.form.type.collection' => 'getSonata_Classification_Api_Form_Type_CollectionService',
            'sonata.classification.api.form.type.tag' => 'getSonata_Classification_Api_Form_Type_TagService',
            'sonata.classification.controller.api.category' => 'getSonata_Classification_Controller_Api_CategoryService',
            'sonata.classification.controller.api.collection' => 'getSonata_Classification_Controller_Api_CollectionService',
            'sonata.classification.controller.api.tag' => 'getSonata_Classification_Controller_Api_TagService',
            'sonata.classification.form.type.category_selector' => 'getSonata_Classification_Form_Type_CategorySelectorService',
            'sonata.classification.manager.category' => 'getSonata_Classification_Manager_CategoryService',
            'sonata.classification.manager.collection' => 'getSonata_Classification_Manager_CollectionService',
            'sonata.classification.manager.tag' => 'getSonata_Classification_Manager_TagService',
            'sonata.classification.serializer.handler.category' => 'getSonata_Classification_Serializer_Handler_CategoryService',
            'sonata.classification.serializer.handler.collection' => 'getSonata_Classification_Serializer_Handler_CollectionService',
            'sonata.classification.serializer.handler.tag' => 'getSonata_Classification_Serializer_Handler_TagService',
            'sonata.comment.admin.comment' => 'getSonata_Comment_Admin_CommentService',
            'sonata.comment.admin.thread' => 'getSonata_Comment_Admin_ThreadService',
            'sonata.comment.block.thread.async' => 'getSonata_Comment_Block_Thread_AsyncService',
            'sonata.comment.event.sonata.comment' => 'getSonata_Comment_Event_Sonata_CommentService',
            'sonata.comment.form.comment_status_type' => 'getSonata_Comment_Form_CommentStatusTypeService',
            'sonata.comment.form.comment_type' => 'getSonata_Comment_Form_CommentTypeService',
            'sonata.comment.manager.comment' => 'getSonata_Comment_Manager_CommentService',
            'sonata.comment.manager.thread' => 'getSonata_Comment_Manager_ThreadService',
            'sonata.comment.note.provider' => 'getSonata_Comment_Note_ProviderService',
            'sonata.comment.status.comment_renderer' => 'getSonata_Comment_Status_CommentRendererService',
            'sonata.core.date.moment_format_converter' => 'getSonata_Core_Date_MomentFormatConverterService',
            'sonata.core.flashmessage.manager' => 'getSonata_Core_Flashmessage_ManagerService',
            'sonata.core.flashmessage.twig.extension' => 'getSonata_Core_Flashmessage_Twig_ExtensionService',
            'sonata.core.form.type.array' => 'getSonata_Core_Form_Type_ArrayService',
            'sonata.core.form.type.boolean' => 'getSonata_Core_Form_Type_BooleanService',
            'sonata.core.form.type.collection' => 'getSonata_Core_Form_Type_CollectionService',
            'sonata.core.form.type.date_picker' => 'getSonata_Core_Form_Type_DatePickerService',
            'sonata.core.form.type.date_range' => 'getSonata_Core_Form_Type_DateRangeService',
            'sonata.core.form.type.datetime_picker' => 'getSonata_Core_Form_Type_DatetimePickerService',
            'sonata.core.form.type.datetime_range' => 'getSonata_Core_Form_Type_DatetimeRangeService',
            'sonata.core.form.type.equal' => 'getSonata_Core_Form_Type_EqualService',
            'sonata.core.form.type.translatable_choice' => 'getSonata_Core_Form_Type_TranslatableChoiceService',
            'sonata.core.model.adapter.chain' => 'getSonata_Core_Model_Adapter_ChainService',
            'sonata.core.slugify.cocur' => 'getSonata_Core_Slugify_CocurService',
            'sonata.core.slugify.native' => 'getSonata_Core_Slugify_NativeService',
            'sonata.core.twig.extension.text' => 'getSonata_Core_Twig_Extension_TextService',
            'sonata.core.twig.extension.wrapping' => 'getSonata_Core_Twig_Extension_WrappingService',
            'sonata.core.twig.status_extension' => 'getSonata_Core_Twig_StatusExtensionService',
            'sonata.core.twig.template_extension' => 'getSonata_Core_Twig_TemplateExtensionService',
            'sonata.core.validator.inline' => 'getSonata_Core_Validator_InlineService',
            'sonata.customer.admin.address' => 'getSonata_Customer_Admin_AddressService',
            'sonata.customer.admin.customer' => 'getSonata_Customer_Admin_CustomerService',
            'sonata.customer.api.form.type.address' => 'getSonata_Customer_Api_Form_Type_AddressService',
            'sonata.customer.api.form.type.customer' => 'getSonata_Customer_Api_Form_Type_CustomerService',
            'sonata.customer.block.breadcrumb_address' => 'getSonata_Customer_Block_BreadcrumbAddressService',
            'sonata.customer.block.recent_customers' => 'getSonata_Customer_Block_RecentCustomersService',
            'sonata.customer.controller.api.address' => 'getSonata_Customer_Controller_Api_AddressService',
            'sonata.customer.controller.api.customer' => 'getSonata_Customer_Controller_Api_CustomerService',
            'sonata.customer.form.address_type' => 'getSonata_Customer_Form_AddressTypeService',
            'sonata.customer.form.address_types_type' => 'getSonata_Customer_Form_AddressTypesTypeService',
            'sonata.customer.manager' => 'getSonata_Customer_ManagerService',
            'sonata.customer.selector' => 'getSonata_Customer_SelectorService',
            'sonata.customer.serializer.handler.customer' => 'getSonata_Customer_Serializer_Handler_CustomerService',
            'sonata.delivery.form.delivery_choice_type' => 'getSonata_Delivery_Form_DeliveryChoiceTypeService',
            'sonata.delivery.manager' => 'getSonata_Delivery_ManagerService',
            'sonata.delivery.method.free_address_required' => 'getSonata_Delivery_Method_FreeAddressRequiredService',
            'sonata.delivery.pool' => 'getSonata_Delivery_PoolService',
            'sonata.delivery.selector.default' => 'getSonata_Delivery_Selector_DefaultService',
            'sonata.demo.admin.car' => 'getSonata_Demo_Admin_CarService',
            'sonata.demo.admin.color' => 'getSonata_Demo_Admin_ColorService',
            'sonata.demo.admin.engine' => 'getSonata_Demo_Admin_EngineService',
            'sonata.demo.admin.inspection' => 'getSonata_Demo_Admin_InspectionService',
            'sonata.demo.admin.material' => 'getSonata_Demo_Admin_MaterialService',
            'sonata.demo.block.newsletter' => 'getSonata_Demo_Block_NewsletterService',
            'sonata.demo.form.type.advanced_rescue_engine' => 'getSonata_Demo_Form_Type_AdvancedRescueEngineService',
            'sonata.demo.form.type.car' => 'getSonata_Demo_Form_Type_CarService',
            'sonata.demo.form.type.engine' => 'getSonata_Demo_Form_Type_EngineService',
            'sonata.demo.form.type.newsletter' => 'getSonata_Demo_Form_Type_NewsletterService',
            'sonata.easy_extends.doctrine.mapper' => 'getSonata_EasyExtends_Doctrine_MapperService',
            'sonata.easy_extends.generator.bundle' => 'getSonata_EasyExtends_Generator_BundleService',
            'sonata.easy_extends.generator.odm' => 'getSonata_EasyExtends_Generator_OdmService',
            'sonata.easy_extends.generator.orm' => 'getSonata_EasyExtends_Generator_OrmService',
            'sonata.easy_extends.generator.phpcr' => 'getSonata_EasyExtends_Generator_PhpcrService',
            'sonata.easy_extends.generator.serializer' => 'getSonata_EasyExtends_Generator_SerializerService',
            'sonata.ecommerce_demo.product.goodie.manager' => 'getSonata_EcommerceDemo_Product_Goodie_ManagerService',
            'sonata.ecommerce_demo.product.goodie.type' => 'getSonata_EcommerceDemo_Product_Goodie_TypeService',
            'sonata.ecommerce_demo.product.travel.manager' => 'getSonata_EcommerceDemo_Product_Travel_ManagerService',
            'sonata.ecommerce_demo.product.travel.type' => 'getSonata_EcommerceDemo_Product_Travel_TypeService',
            'sonata.formatter.block.formatter' => 'getSonata_Formatter_Block_FormatterService',
            'sonata.formatter.ckeditor.extension' => 'getSonata_Formatter_Ckeditor_ExtensionService',
            'sonata.formatter.form.type.selector' => 'getSonata_Formatter_Form_Type_SelectorService',
            'sonata.formatter.pool' => 'getSonata_Formatter_PoolService',
            'sonata.formatter.text.markdown' => 'getSonata_Formatter_Text_MarkdownService',
            'sonata.formatter.text.raw' => 'getSonata_Formatter_Text_RawService',
            'sonata.formatter.text.text' => 'getSonata_Formatter_Text_TextService',
            'sonata.formatter.text.twigengine' => 'getSonata_Formatter_Text_TwigengineService',
            'sonata.formatter.twig.control_flow' => 'getSonata_Formatter_Twig_ControlFlowService',
            'sonata.formatter.twig.env.markdown' => 'getSonata_Formatter_Twig_Env_MarkdownService',
            'sonata.formatter.twig.env.rawhtml' => 'getSonata_Formatter_Twig_Env_RawhtmlService',
            'sonata.formatter.twig.env.richhtml' => 'getSonata_Formatter_Twig_Env_RichhtmlService',
            'sonata.formatter.twig.env.text' => 'getSonata_Formatter_Twig_Env_TextService',
            'sonata.formatter.twig.gist' => 'getSonata_Formatter_Twig_GistService',
            'sonata.formatter.validator.formatter' => 'getSonata_Formatter_Validator_FormatterService',
            'sonata.intl.locale_detector.request' => 'getSonata_Intl_LocaleDetector_RequestService',
            'sonata.intl.templating.helper.datetime' => 'getSonata_Intl_Templating_Helper_DatetimeService',
            'sonata.intl.templating.helper.locale' => 'getSonata_Intl_Templating_Helper_LocaleService',
            'sonata.intl.templating.helper.number' => 'getSonata_Intl_Templating_Helper_NumberService',
            'sonata.intl.timezone_detector.chain' => 'getSonata_Intl_TimezoneDetector_ChainService',
            'sonata.intl.timezone_detector.locale' => 'getSonata_Intl_TimezoneDetector_LocaleService',
            'sonata.intl.timezone_detector.user' => 'getSonata_Intl_TimezoneDetector_UserService',
            'sonata.invoice.admin.invoice' => 'getSonata_Invoice_Admin_InvoiceService',
            'sonata.invoice.controller.api.invoice' => 'getSonata_Invoice_Controller_Api_InvoiceService',
            'sonata.invoice.form.status_type' => 'getSonata_Invoice_Form_StatusTypeService',
            'sonata.invoice.manager' => 'getSonata_Invoice_ManagerService',
            'sonata.invoice.serializer.handler' => 'getSonata_Invoice_Serializer_HandlerService',
            'sonata.invoice.status.renderer' => 'getSonata_Invoice_Status_RendererService',
            'sonata.invoice_element.manager' => 'getSonata_InvoiceElement_ManagerService',
            'sonata.media.adapter.filesystem.local' => 'getSonata_Media_Adapter_Filesystem_LocalService',
            'sonata.media.adapter.image.gd' => 'getSonata_Media_Adapter_Image_GdService',
            'sonata.media.adapter.image.gmagick' => 'getSonata_Media_Adapter_Image_GmagickService',
            'sonata.media.adapter.image.imagick' => 'getSonata_Media_Adapter_Image_ImagickService',
            'sonata.media.adapter.service.s3' => 'getSonata_Media_Adapter_Service_S3Service',
            'sonata.media.admin.gallery' => 'getSonata_Media_Admin_GalleryService',
            'sonata.media.admin.gallery_has_media' => 'getSonata_Media_Admin_GalleryHasMediaService',
            'sonata.media.admin.media' => 'getSonata_Media_Admin_MediaService',
            'sonata.media.admin.media.manager' => 'getSonata_Media_Admin_Media_ManagerService',
            'sonata.media.api.form.type.doctrine.media' => 'getSonata_Media_Api_Form_Type_Doctrine_MediaService',
            'sonata.media.api.form.type.gallery' => 'getSonata_Media_Api_Form_Type_GalleryService',
            'sonata.media.api.form.type.gallery_has_media' => 'getSonata_Media_Api_Form_Type_GalleryHasMediaService',
            'sonata.media.api.form.type.media' => 'getSonata_Media_Api_Form_Type_MediaService',
            'sonata.media.block.breadcrumb_index' => 'getSonata_Media_Block_BreadcrumbIndexService',
            'sonata.media.block.breadcrumb_view' => 'getSonata_Media_Block_BreadcrumbViewService',
            'sonata.media.block.breadcrumb_view_media' => 'getSonata_Media_Block_BreadcrumbViewMediaService',
            'sonata.media.block.feature_media' => 'getSonata_Media_Block_FeatureMediaService',
            'sonata.media.block.gallery' => 'getSonata_Media_Block_GalleryService',
            'sonata.media.block.media' => 'getSonata_Media_Block_MediaService',
            'sonata.media.buzz.browser' => 'getSonata_Media_Buzz_BrowserService',
            'sonata.media.buzz.connector.curl' => 'getSonata_Media_Buzz_Connector_CurlService',
            'sonata.media.buzz.connector.file_get_contents' => 'getSonata_Media_Buzz_Connector_FileGetContentsService',
            'sonata.media.cdn.server' => 'getSonata_Media_Cdn_ServerService',
            'sonata.media.controller.api.gallery' => 'getSonata_Media_Controller_Api_GalleryService',
            'sonata.media.controller.api.media' => 'getSonata_Media_Controller_Api_MediaService',
            'sonata.media.doctrine.event_subscriber' => 'getSonata_Media_Doctrine_EventSubscriberService',
            'sonata.media.extra.pixlr' => 'getSonata_Media_Extra_PixlrService',
            'sonata.media.filesystem.local' => 'getSonata_Media_Filesystem_LocalService',
            'sonata.media.form.type.media' => 'getSonata_Media_Form_Type_MediaService',
            'sonata.media.formatter.twig' => 'getSonata_Media_Formatter_TwigService',
            'sonata.media.generator.default' => 'getSonata_Media_Generator_DefaultService',
            'sonata.media.manager.gallery' => 'getSonata_Media_Manager_GalleryService',
            'sonata.media.manager.media' => 'getSonata_Media_Manager_MediaService',
            'sonata.media.metadata.amazon' => 'getSonata_Media_Metadata_AmazonService',
            'sonata.media.metadata.noop' => 'getSonata_Media_Metadata_NoopService',
            'sonata.media.metadata.proxy' => 'getSonata_Media_Metadata_ProxyService',
            'sonata.media.notification.create_thumbnail' => 'getSonata_Media_Notification_CreateThumbnailService',
            'sonata.media.pool' => 'getSonata_Media_PoolService',
            'sonata.media.provider.dailymotion' => 'getSonata_Media_Provider_DailymotionService',
            'sonata.media.provider.file' => 'getSonata_Media_Provider_FileService',
            'sonata.media.provider.image' => 'getSonata_Media_Provider_ImageService',
            'sonata.media.provider.vimeo' => 'getSonata_Media_Provider_VimeoService',
            'sonata.media.provider.youtube' => 'getSonata_Media_Provider_YoutubeService',
            'sonata.media.resizer.simple' => 'getSonata_Media_Resizer_SimpleService',
            'sonata.media.resizer.square' => 'getSonata_Media_Resizer_SquareService',
            'sonata.media.security.connected_strategy' => 'getSonata_Media_Security_ConnectedStrategyService',
            'sonata.media.security.forbidden_strategy' => 'getSonata_Media_Security_ForbiddenStrategyService',
            'sonata.media.security.public_strategy' => 'getSonata_Media_Security_PublicStrategyService',
            'sonata.media.security.superadmin_strategy' => 'getSonata_Media_Security_SuperadminStrategyService',
            'sonata.media.serializer.handler.gallery' => 'getSonata_Media_Serializer_Handler_GalleryService',
            'sonata.media.serializer.handler.media' => 'getSonata_Media_Serializer_Handler_MediaService',
            'sonata.media.thumbnail.consumer.format' => 'getSonata_Media_Thumbnail_Consumer_FormatService',
            'sonata.media.thumbnail.format' => 'getSonata_Media_Thumbnail_FormatService',
            'sonata.media.twig.extension' => 'getSonata_Media_Twig_ExtensionService',
            'sonata.media.twig.global' => 'getSonata_Media_Twig_GlobalService',
            'sonata.media.validator.format' => 'getSonata_Media_Validator_FormatService',
            'sonata.news.admin.comment' => 'getSonata_News_Admin_CommentService',
            'sonata.news.admin.post' => 'getSonata_News_Admin_PostService',
            'sonata.news.api.form.type.comment' => 'getSonata_News_Api_Form_Type_CommentService',
            'sonata.news.api.form.type.post' => 'getSonata_News_Api_Form_Type_PostService',
            'sonata.news.block.breadcrumb_archive' => 'getSonata_News_Block_BreadcrumbArchiveService',
            'sonata.news.block.breadcrumb_post' => 'getSonata_News_Block_BreadcrumbPostService',
            'sonata.news.block.recent_comments' => 'getSonata_News_Block_RecentCommentsService',
            'sonata.news.block.recent_posts' => 'getSonata_News_Block_RecentPostsService',
            'sonata.news.blog' => 'getSonata_News_BlogService',
            'sonata.news.controller.api.comment' => 'getSonata_News_Controller_Api_CommentService',
            'sonata.news.controller.api.post' => 'getSonata_News_Controller_Api_PostService',
            'sonata.news.form.comment.status_type' => 'getSonata_News_Form_Comment_StatusTypeService',
            'sonata.news.form.type.comment' => 'getSonata_News_Form_Type_CommentService',
            'sonata.news.hash.generator' => 'getSonata_News_Hash_GeneratorService',
            'sonata.news.mailer' => 'getSonata_News_MailerService',
            'sonata.news.manager.comment' => 'getSonata_News_Manager_CommentService',
            'sonata.news.manager.post' => 'getSonata_News_Manager_PostService',
            'sonata.news.permalink.collection' => 'getSonata_News_Permalink_CollectionService',
            'sonata.news.permalink.date' => 'getSonata_News_Permalink_DateService',
            'sonata.news.serializer.handler.post' => 'getSonata_News_Serializer_Handler_PostService',
            'sonata.news.status.comment' => 'getSonata_News_Status_CommentService',
            'sonata.notification.admin.message' => 'getSonata_Notification_Admin_MessageService',
            'sonata.notification.backend.doctrine' => 'getSonata_Notification_Backend_DoctrineService',
            'sonata.notification.backend.postpone' => 'getSonata_Notification_Backend_PostponeService',
            'sonata.notification.backend.runtime' => 'getSonata_Notification_Backend_RuntimeService',
            'sonata.notification.consumer.logger' => 'getSonata_Notification_Consumer_LoggerService',
            'sonata.notification.consumer.metadata' => 'getSonata_Notification_Consumer_MetadataService',
            'sonata.notification.consumer.swift_mailer' => 'getSonata_Notification_Consumer_SwiftMailerService',
            'sonata.notification.controller.api.message' => 'getSonata_Notification_Controller_Api_MessageService',
            'sonata.notification.dispatcher' => 'getSonata_Notification_DispatcherService',
            'sonata.notification.erroneous_messages_selector' => 'getSonata_Notification_ErroneousMessagesSelectorService',
            'sonata.notification.event.doctrine_backend_optimize' => 'getSonata_Notification_Event_DoctrineBackendOptimizeService',
            'sonata.notification.event.doctrine_optimize' => 'getSonata_Notification_Event_DoctrineOptimizeService',
            'sonata.notification.manager.message.default' => 'getSonata_Notification_Manager_Message_DefaultService',
            'sonata.order.admin.order' => 'getSonata_Order_Admin_OrderService',
            'sonata.order.admin.order_element' => 'getSonata_Order_Admin_OrderElementService',
            'sonata.order.block.breadcrumb_order' => 'getSonata_Order_Block_BreadcrumbOrderService',
            'sonata.order.block.recent_orders' => 'getSonata_Order_Block_RecentOrdersService',
            'sonata.order.controller.api.order' => 'getSonata_Order_Controller_Api_OrderService',
            'sonata.order.form.status_type' => 'getSonata_Order_Form_StatusTypeService',
            'sonata.order.manager' => 'getSonata_Order_ManagerService',
            'sonata.order.order_element.manager' => 'getSonata_Order_OrderElement_ManagerService',
            'sonata.order.serializer.handler.order' => 'getSonata_Order_Serializer_Handler_OrderService',
            'sonata.order.serializer.handler.order_element' => 'getSonata_Order_Serializer_Handler_OrderElementService',
            'sonata.order.status.renderer' => 'getSonata_Order_Status_RendererService',
            'sonata.package.manager' => 'getSonata_Package_ManagerService',
            'sonata.page.admin.block' => 'getSonata_Page_Admin_BlockService',
            'sonata.page.admin.page' => 'getSonata_Page_Admin_PageService',
            'sonata.page.admin.shared_block' => 'getSonata_Page_Admin_SharedBlockService',
            'sonata.page.admin.site' => 'getSonata_Page_Admin_SiteService',
            'sonata.page.admin.snapshot' => 'getSonata_Page_Admin_SnapshotService',
            'sonata.page.api.form.type.block' => 'getSonata_Page_Api_Form_Type_BlockService',
            'sonata.page.api.form.type.page' => 'getSonata_Page_Api_Form_Type_PageService',
            'sonata.page.api.form.type.site' => 'getSonata_Page_Api_Form_Type_SiteService',
            'sonata.page.block.ajax' => 'getSonata_Page_Block_AjaxService',
            'sonata.page.block.breadcrumb' => 'getSonata_Page_Block_BreadcrumbService',
            'sonata.page.block.children_pages' => 'getSonata_Page_Block_ChildrenPagesService',
            'sonata.page.block.container' => 'getSonata_Page_Block_ContainerService',
            'sonata.page.block.context_manager' => 'getSonata_Page_Block_ContextManagerService',
            'sonata.page.block.shared_block' => 'getSonata_Page_Block_SharedBlockService',
            'sonata.page.block_interactor' => 'getSonata_Page_BlockInteractorService',
            'sonata.page.cache.esi' => 'getSonata_Page_Cache_EsiService',
            'sonata.page.cache.js_async' => 'getSonata_Page_Cache_JsAsyncService',
            'sonata.page.cache.js_sync' => 'getSonata_Page_Cache_JsSyncService',
            'sonata.page.cache.ssi' => 'getSonata_Page_Cache_SsiService',
            'sonata.page.cms.page' => 'getSonata_Page_Cms_PageService',
            'sonata.page.cms.snapshot' => 'getSonata_Page_Cms_SnapshotService',
            'sonata.page.cms_manager_selector' => 'getSonata_Page_CmsManagerSelectorService',
            'sonata.page.controller.api.block' => 'getSonata_Page_Controller_Api_BlockService',
            'sonata.page.controller.api.page' => 'getSonata_Page_Controller_Api_PageService',
            'sonata.page.controller.api.site' => 'getSonata_Page_Controller_Api_SiteService',
            'sonata.page.controller.api.snapshot' => 'getSonata_Page_Controller_Api_SnapshotService',
            'sonata.page.decorator_strategy' => 'getSonata_Page_DecoratorStrategyService',
            'sonata.page.form.create_snapshot' => 'getSonata_Page_Form_CreateSnapshotService',
            'sonata.page.form.page_type_choice' => 'getSonata_Page_Form_PageTypeChoiceService',
            'sonata.page.form.template_choice' => 'getSonata_Page_Form_TemplateChoiceService',
            'sonata.page.form.type.page_selector' => 'getSonata_Page_Form_Type_PageSelectorService',
            'sonata.page.kernel.exception_listener' => 'getSonata_Page_Kernel_ExceptionListenerService',
            'sonata.page.manager.block' => 'getSonata_Page_Manager_BlockService',
            'sonata.page.manager.page' => 'getSonata_Page_Manager_PageService',
            'sonata.page.manager.site' => 'getSonata_Page_Manager_SiteService',
            'sonata.page.manager.snapshot' => 'getSonata_Page_Manager_SnapshotService',
            'sonata.page.notification.cleanup_snapshot' => 'getSonata_Page_Notification_CleanupSnapshotService',
            'sonata.page.notification.cleanup_snapshots' => 'getSonata_Page_Notification_CleanupSnapshotsService',
            'sonata.page.notification.create_snapshot' => 'getSonata_Page_Notification_CreateSnapshotService',
            'sonata.page.notification.create_snapshots' => 'getSonata_Page_Notification_CreateSnapshotsService',
            'sonata.page.page_service_manager' => 'getSonata_Page_PageServiceManagerService',
            'sonata.page.request_listener' => 'getSonata_Page_RequestListenerService',
            'sonata.page.response_listener' => 'getSonata_Page_ResponseListenerService',
            'sonata.page.route.page.generator' => 'getSonata_Page_Route_Page_GeneratorService',
            'sonata.page.router' => 'getSonata_Page_RouterService',
            'sonata.page.serializer.handler.block' => 'getSonata_Page_Serializer_Handler_BlockService',
            'sonata.page.serializer.handler.page' => 'getSonata_Page_Serializer_Handler_PageService',
            'sonata.page.serializer.handler.site' => 'getSonata_Page_Serializer_Handler_SiteService',
            'sonata.page.serializer.handler.snapshot' => 'getSonata_Page_Serializer_Handler_SnapshotService',
            'sonata.page.service.default' => 'getSonata_Page_Service_DefaultService',
            'sonata.page.site.selector.host_with_path' => 'getSonata_Page_Site_Selector_HostWithPathService',
            'sonata.page.template_manager' => 'getSonata_Page_TemplateManagerService',
            'sonata.page.transformer' => 'getSonata_Page_TransformerService',
            'sonata.page.twig.global' => 'getSonata_Page_Twig_GlobalService',
            'sonata.page.validator.unique_url' => 'getSonata_Page_Validator_UniqueUrlService',
            'sonata.payment.browser.curl' => 'getSonata_Payment_Browser_CurlService',
            'sonata.payment.consumer.order_element_process' => 'getSonata_Payment_Consumer_OrderElementProcessService',
            'sonata.payment.consumer.order_process' => 'getSonata_Payment_Consumer_OrderProcessService',
            'sonata.payment.form.transaction_status' => 'getSonata_Payment_Form_TransactionStatusService',
            'sonata.payment.generator.mysql' => 'getSonata_Payment_Generator_MysqlService',
            'sonata.payment.handler' => 'getSonata_Payment_HandlerService',
            'sonata.payment.method.debug' => 'getSonata_Payment_Method_DebugService',
            'sonata.payment.method.pass' => 'getSonata_Payment_Method_PassService',
            'sonata.payment.pool' => 'getSonata_Payment_PoolService',
            'sonata.payment.provider.scellius.none_generator' => 'getSonata_Payment_Provider_Scellius_NoneGeneratorService',
            'sonata.payment.provider.scellius.order_generator' => 'getSonata_Payment_Provider_Scellius_OrderGeneratorService',
            'sonata.payment.selector.simple' => 'getSonata_Payment_Selector_SimpleService',
            'sonata.payment.transformer.basket' => 'getSonata_Payment_Transformer_BasketService',
            'sonata.payment.transformer.invoice' => 'getSonata_Payment_Transformer_InvoiceService',
            'sonata.payment.transformer.order' => 'getSonata_Payment_Transformer_OrderService',
            'sonata.payment.transformer.pool' => 'getSonata_Payment_Transformer_PoolService',
            'sonata.price.currency.calculator' => 'getSonata_Price_Currency_CalculatorService',
            'sonata.price.currency.data_transformer' => 'getSonata_Price_Currency_DataTransformerService',
            'sonata.price.currency.detector' => 'getSonata_Price_Currency_DetectorService',
            'sonata.price.currency.form_type' => 'getSonata_Price_Currency_FormTypeService',
            'sonata.price.currency.manager' => 'getSonata_Price_Currency_ManagerService',
            'sonata.product.admin.delivery' => 'getSonata_Product_Admin_DeliveryService',
            'sonata.product.admin.product' => 'getSonata_Product_Admin_ProductService',
            'sonata.product.admin.product.category' => 'getSonata_Product_Admin_Product_CategoryService',
            'sonata.product.admin.product.collection' => 'getSonata_Product_Admin_Product_CollectionService',
            'sonata.product.admin.product.manager' => 'getSonata_Product_Admin_Product_ManagerService',
            'sonata.product.admin.product.variation' => 'getSonata_Product_Admin_Product_VariationService',
            'sonata.product.api.form.type.product' => 'getSonata_Product_Api_Form_Type_ProductService',
            'sonata.product.api.form.type.product.parent' => 'getSonata_Product_Api_Form_Type_Product_ParentService',
            'sonata.product.block.breadcrumb' => 'getSonata_Product_Block_BreadcrumbService',
            'sonata.product.block.categories_menu' => 'getSonata_Product_Block_CategoriesMenuService',
            'sonata.product.block.filters_menu' => 'getSonata_Product_Block_FiltersMenuService',
            'sonata.product.block.recent_products' => 'getSonata_Product_Block_RecentProductsService',
            'sonata.product.block.similar_products' => 'getSonata_Product_Block_SimilarProductsService',
            'sonata.product.block.variations_form' => 'getSonata_Product_Block_VariationsFormService',
            'sonata.product.controller.api.product' => 'getSonata_Product_Controller_Api_ProductService',
            'sonata.product.finder' => 'getSonata_Product_FinderService',
            'sonata.product.form.delivery_type' => 'getSonata_Product_Form_DeliveryTypeService',
            'sonata.product.form.variation_choices_type' => 'getSonata_Product_Form_VariationChoicesTypeService',
            'sonata.product.menu.product_menu_builder' => 'getSonata_Product_Menu_ProductMenuBuilderService',
            'sonata.product.pool' => 'getSonata_Product_PoolService',
            'sonata.product.seo.facebook' => 'getSonata_Product_Seo_FacebookService',
            'sonata.product.seo.twitter' => 'getSonata_Product_Seo_TwitterService',
            'sonata.product.seo_iterator' => 'getSonata_Product_SeoIteratorService',
            'sonata.product.serializer.handler.product' => 'getSonata_Product_Serializer_Handler_ProductService',
            'sonata.product.set.manager' => 'getSonata_Product_Set_ManagerService',
            'sonata.product.subscriber.orm' => 'getSonata_Product_Subscriber_OrmService',
            'sonata.product_category.product' => 'getSonata_ProductCategory_ProductService',
            'sonata.product_collection.product' => 'getSonata_ProductCollection_ProductService',
            'sonata.seo.block.breadcrumb.homepage' => 'getSonata_Seo_Block_Breadcrumb_HomepageService',
            'sonata.seo.block.email.share_button' => 'getSonata_Seo_Block_Email_ShareButtonService',
            'sonata.seo.block.facebook.like_box' => 'getSonata_Seo_Block_Facebook_LikeBoxService',
            'sonata.seo.block.facebook.like_button' => 'getSonata_Seo_Block_Facebook_LikeButtonService',
            'sonata.seo.block.facebook.send_button' => 'getSonata_Seo_Block_Facebook_SendButtonService',
            'sonata.seo.block.facebook.share_button' => 'getSonata_Seo_Block_Facebook_ShareButtonService',
            'sonata.seo.block.pinterest.pin_button' => 'getSonata_Seo_Block_Pinterest_PinButtonService',
            'sonata.seo.block.twitter.embed' => 'getSonata_Seo_Block_Twitter_EmbedService',
            'sonata.seo.block.twitter.follow_button' => 'getSonata_Seo_Block_Twitter_FollowButtonService',
            'sonata.seo.block.twitter.hashtag_button' => 'getSonata_Seo_Block_Twitter_HashtagButtonService',
            'sonata.seo.block.twitter.mention_button' => 'getSonata_Seo_Block_Twitter_MentionButtonService',
            'sonata.seo.block.twitter.share_button' => 'getSonata_Seo_Block_Twitter_ShareButtonService',
            'sonata.seo.event.breadcrumb' => 'getSonata_Seo_Event_BreadcrumbService',
            'sonata.seo.page.default' => 'getSonata_Seo_Page_DefaultService',
            'sonata.seo.sitemap.manager' => 'getSonata_Seo_Sitemap_ManagerService',
            'sonata.seo.source.doctrine_sitemap_iterator_0' => 'getSonata_Seo_Source_DoctrineSitemapIterator0Service',
            'sonata.seo.source.doctrine_sitemap_iterator_1' => 'getSonata_Seo_Source_DoctrineSitemapIterator1Service',
            'sonata.seo.source.doctrine_sitemap_iterator_2' => 'getSonata_Seo_Source_DoctrineSitemapIterator2Service',
            'sonata.seo.source.doctrine_sitemap_iterator_3' => 'getSonata_Seo_Source_DoctrineSitemapIterator3Service',
            'sonata.seo.source.doctrine_sitemap_iterator_4' => 'getSonata_Seo_Source_DoctrineSitemapIterator4Service',
            'sonata.timeline.admin.extension' => 'getSonata_Timeline_Admin_ExtensionService',
            'sonata.timeline.block.timeline' => 'getSonata_Timeline_Block_TimelineService',
            'sonata.timeline.spread.admin' => 'getSonata_Timeline_Spread_AdminService',
            'sonata.timeline.twig.extension' => 'getSonata_Timeline_Twig_ExtensionService',
            'sonata.transaction.manager' => 'getSonata_Transaction_ManagerService',
            'sonata.user.admin.group' => 'getSonata_User_Admin_GroupService',
            'sonata.user.admin.user' => 'getSonata_User_Admin_UserService',
            'sonata.user.block.account' => 'getSonata_User_Block_AccountService',
            'sonata.user.block.breadcrumb_index' => 'getSonata_User_Block_BreadcrumbIndexService',
            'sonata.user.block.breadcrumb_profile' => 'getSonata_User_Block_BreadcrumbProfileService',
            'sonata.user.block.menu' => 'getSonata_User_Block_MenuService',
            'sonata.user.controller.api.group' => 'getSonata_User_Controller_Api_GroupService',
            'sonata.user.controller.api.user' => 'getSonata_User_Controller_Api_UserService',
            'sonata.user.editable_role_builder' => 'getSonata_User_EditableRoleBuilderService',
            'sonata.user.form.gender_list' => 'getSonata_User_Form_GenderListService',
            'sonata.user.form.type.security_roles' => 'getSonata_User_Form_Type_SecurityRolesService',
            'sonata.user.google.authenticator' => 'getSonata_User_Google_AuthenticatorService',
            'sonata.user.google.authenticator.interactive_login_listener' => 'getSonata_User_Google_Authenticator_InteractiveLoginListenerService',
            'sonata.user.google.authenticator.provider' => 'getSonata_User_Google_Authenticator_ProviderService',
            'sonata.user.google.authenticator.request_listener' => 'getSonata_User_Google_Authenticator_RequestListenerService',
            'sonata.user.profile.form' => 'getSonata_User_Profile_FormService',
            'sonata.user.profile.form.handler' => 'getSonata_User_Profile_Form_HandlerService',
            'sonata.user.profile.form.type' => 'getSonata_User_Profile_Form_TypeService',
            'sonata.user.profile.menu_builder' => 'getSonata_User_Profile_MenuBuilderService',
            'sonata.user.twig.global' => 'getSonata_User_Twig_GlobalService',
            'spy_timeline.action_manager.orm' => 'getSpyTimeline_ActionManager_OrmService',
            'spy_timeline.filter.data_hydrator' => 'getSpyTimeline_Filter_DataHydratorService',
            'spy_timeline.filter.data_hydrator.locator.doctrine_odm' => 'getSpyTimeline_Filter_DataHydrator_Locator_DoctrineOdmService',
            'spy_timeline.filter.data_hydrator.locator.doctrine_orm' => 'getSpyTimeline_Filter_DataHydrator_Locator_DoctrineOrmService',
            'spy_timeline.filter.duplicate_key' => 'getSpyTimeline_Filter_DuplicateKeyService',
            'spy_timeline.filter.manager' => 'getSpyTimeline_Filter_ManagerService',
            'spy_timeline.paginator.knp' => 'getSpyTimeline_Paginator_KnpService',
            'spy_timeline.query_builder.factory' => 'getSpyTimeline_QueryBuilder_FactoryService',
            'spy_timeline.query_builder.orm' => 'getSpyTimeline_QueryBuilder_OrmService',
            'spy_timeline.resolve_component.basic' => 'getSpyTimeline_ResolveComponent_BasicService',
            'spy_timeline.resolve_component.doctrine' => 'getSpyTimeline_ResolveComponent_DoctrineService',
            'spy_timeline.result_builder' => 'getSpyTimeline_ResultBuilderService',
            'spy_timeline.spread.deployer.default' => 'getSpyTimeline_Spread_Deployer_DefaultService',
            'spy_timeline.spread.entry_collection' => 'getSpyTimeline_Spread_EntryCollectionService',
            'spy_timeline.timeline_manager.orm' => 'getSpyTimeline_TimelineManager_OrmService',
            'spy_timeline.twig.extension.timeline' => 'getSpyTimeline_Twig_Extension_TimelineService',
            'spy_timeline.unread_notifications' => 'getSpyTimeline_UnreadNotificationsService',
            'streamed_response_listener' => 'getStreamedResponseListenerService',
            'swiftmailer.email_sender.listener' => 'getSwiftmailer_EmailSender_ListenerService',
            'swiftmailer.mailer.default' => 'getSwiftmailer_Mailer_DefaultService',
            'swiftmailer.mailer.default.transport' => 'getSwiftmailer_Mailer_Default_TransportService',
            'templating' => 'getTemplatingService',
            'templating.asset.package_factory' => 'getTemplating_Asset_PackageFactoryService',
            'templating.engine.php' => 'getTemplating_Engine_PhpService',
            'templating.filename_parser' => 'getTemplating_FilenameParserService',
            'templating.globals' => 'getTemplating_GlobalsService',
            'templating.helper.actions' => 'getTemplating_Helper_ActionsService',
            'templating.helper.assets' => 'getTemplating_Helper_AssetsService',
            'templating.helper.code' => 'getTemplating_Helper_CodeService',
            'templating.helper.form' => 'getTemplating_Helper_FormService',
            'templating.helper.logout_url' => 'getTemplating_Helper_LogoutUrlService',
            'templating.helper.request' => 'getTemplating_Helper_RequestService',
            'templating.helper.router' => 'getTemplating_Helper_RouterService',
            'templating.helper.security' => 'getTemplating_Helper_SecurityService',
            'templating.helper.session' => 'getTemplating_Helper_SessionService',
            'templating.helper.slots' => 'getTemplating_Helper_SlotsService',
            'templating.helper.stopwatch' => 'getTemplating_Helper_StopwatchService',
            'templating.helper.translator' => 'getTemplating_Helper_TranslatorService',
            'templating.loader' => 'getTemplating_LoaderService',
            'templating.locator' => 'getTemplating_LocatorService',
            'templating.name_parser' => 'getTemplating_NameParserService',
            'translation.dumper.csv' => 'getTranslation_Dumper_CsvService',
            'translation.dumper.ini' => 'getTranslation_Dumper_IniService',
            'translation.dumper.json' => 'getTranslation_Dumper_JsonService',
            'translation.dumper.mo' => 'getTranslation_Dumper_MoService',
            'translation.dumper.php' => 'getTranslation_Dumper_PhpService',
            'translation.dumper.po' => 'getTranslation_Dumper_PoService',
            'translation.dumper.qt' => 'getTranslation_Dumper_QtService',
            'translation.dumper.res' => 'getTranslation_Dumper_ResService',
            'translation.dumper.xliff' => 'getTranslation_Dumper_XliffService',
            'translation.dumper.yml' => 'getTranslation_Dumper_YmlService',
            'translation.extractor' => 'getTranslation_ExtractorService',
            'translation.extractor.php' => 'getTranslation_Extractor_PhpService',
            'translation.loader' => 'getTranslation_LoaderService',
            'translation.loader.csv' => 'getTranslation_Loader_CsvService',
            'translation.loader.dat' => 'getTranslation_Loader_DatService',
            'translation.loader.ini' => 'getTranslation_Loader_IniService',
            'translation.loader.json' => 'getTranslation_Loader_JsonService',
            'translation.loader.mo' => 'getTranslation_Loader_MoService',
            'translation.loader.php' => 'getTranslation_Loader_PhpService',
            'translation.loader.po' => 'getTranslation_Loader_PoService',
            'translation.loader.qt' => 'getTranslation_Loader_QtService',
            'translation.loader.res' => 'getTranslation_Loader_ResService',
            'translation.loader.xliff' => 'getTranslation_Loader_XliffService',
            'translation.loader.yml' => 'getTranslation_Loader_YmlService',
            'translation.writer' => 'getTranslation_WriterService',
            'translator.default' => 'getTranslator_DefaultService',
            'translator_listener' => 'getTranslatorListenerService',
            'twig' => 'getTwigService',
            'twig.controller.exception' => 'getTwig_Controller_ExceptionService',
            'twig.controller.preview_error' => 'getTwig_Controller_PreviewErrorService',
            'twig.loader' => 'getTwig_LoaderService',
            'twig.translation.extractor' => 'getTwig_Translation_ExtractorService',
            'uri_signer' => 'getUriSignerService',
            'validator' => 'getValidatorService',
            'validator.builder' => 'getValidator_BuilderService',
            'validator.email' => 'getValidator_EmailService',
            'validator.expression' => 'getValidator_ExpressionService',
            'validator.validator_factory' => 'getValidator_ValidatorFactoryService',
            'web_profiler.controller.exception' => 'getWebProfiler_Controller_ExceptionService',
            'web_profiler.controller.profiler' => 'getWebProfiler_Controller_ProfilerService',
            'web_profiler.controller.router' => 'getWebProfiler_Controller_RouterService',
            'web_profiler.debug_toolbar' => 'getWebProfiler_DebugToolbarService',
        );
        $this->aliases = array(
            'database_connection' => 'doctrine.dbal.default_connection',
            'doctrine.orm.default_metadata_cache' => 'doctrine_cache.providers.doctrine.orm.default_metadata_cache',
            'doctrine.orm.default_query_cache' => 'doctrine_cache.providers.doctrine.orm.default_query_cache',
            'doctrine.orm.default_result_cache' => 'doctrine_cache.providers.doctrine.orm.default_result_cache',
            'doctrine.orm.entity_manager' => 'doctrine.orm.default_entity_manager',
            'fos_comment.manager.comment' => 'fos_comment.manager.comment.default',
            'fos_comment.manager.thread' => 'fos_comment.manager.thread.default',
            'fos_comment.manager.vote' => 'fos_comment.manager.vote.default',
            'fos_rest.exception_handler' => 'fos_rest.view.exception_wrapper_handler',
            'fos_rest.inflector' => 'fos_rest.inflector.doctrine',
            'fos_rest.router' => 'cmf_routing.router',
            'fos_rest.serializer' => 'jms_serializer',
            'fos_rest.templating' => 'templating',
            'fos_rest.validator' => 'validator',
            'fos_user.change_password.form.handler' => 'fos_user.change_password.form.handler.default',
            'fos_user.util.username_canonicalizer' => 'fos_user.util.email_canonicalizer',
            'mailer' => 'swiftmailer.mailer.default',
            'router' => 'cmf_routing.router',
            'security.acl.dbal.connection' => 'doctrine.dbal.default_connection',
            'serializer' => 'jms_serializer',
            'session.storage' => 'session.storage.native',
            'sonata.basket.builder' => 'sonata.basket.builder.standard',
            'sonata.basket.factory' => 'sonata.basket.entity.factory',
            'sonata.basket.loader' => 'sonata.basket.loader.standard',
            'sonata.block.cache.handler' => 'sonata.block.cache.handler.default',
            'sonata.block.context_manager' => 'sonata.page.block.context_manager',
            'sonata.block.renderer' => 'sonata.block.renderer.default',
            'sonata.delivery.selector' => 'sonata.delivery.selector.default',
            'sonata.generator' => 'sonata.payment.generator.mysql',
            'sonata.intl.locale_detector' => 'sonata.intl.locale_detector.request',
            'sonata.intl.timezone_detector' => 'sonata.intl.timezone_detector.chain',
            'sonata.news.permalink.generator' => 'sonata.news.permalink.date',
            'sonata.notification.backend' => 'sonata.notification.backend.postpone',
            'sonata.notification.manager.message' => 'sonata.notification.manager.message.default',
            'sonata.page.site.selector' => 'sonata.page.site.selector.host_with_path',
            'sonata.payment.selector' => 'sonata.payment.selector.simple',
            'sonata.seo.page' => 'sonata.seo.page.default',
            'sonata.user.authentication.form' => 'fos_user.profile.form',
            'sonata.user.authentication.form_handler' => 'fos_user.profile.form.handler',
            'spy_timeline.action_manager' => 'spy_timeline.action_manager.orm',
            'spy_timeline.driver.object_manager' => 'doctrine.orm.default_entity_manager',
            'spy_timeline.query_builder' => 'spy_timeline.query_builder.orm',
            'spy_timeline.resolve_component.resolver' => 'spy_timeline.resolve_component.doctrine',
            'spy_timeline.spread.deployer' => 'spy_timeline.spread.deployer.default',
            'spy_timeline.timeline_manager' => 'spy_timeline.timeline_manager.orm',
            'swiftmailer.mailer' => 'swiftmailer.mailer.default',
            'swiftmailer.transport' => 'swiftmailer.mailer.default.transport',
            'translator' => 'translator.default',
        );
    }
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), (__DIR__.'/annotations'), false);
    }
    protected function getApplication_Sonata_Delivery_TakeAwayService()
    {
        return $this->services['application.sonata.delivery.take_away'] = new \Application\Sonata\DeliveryBundle\Model\TakeAwayDelivery();
    }
    protected function getAssetic_AssetManagerService()
    {
        $this->services['assetic.asset_manager'] = $instance = new \Assetic\Factory\LazyAssetManager($this->get('assetic.asset_factory'), array('config' => new \Symfony\Bundle\AsseticBundle\Factory\Loader\ConfigurationLoader(), 'twig' => new \Assetic\Factory\Loader\CachedFormulaLoader(new \Assetic\Extension\Twig\TwigFormulaLoader($this->get('twig'), $this->get('monolog.logger.assetic', ContainerInterface::NULL_ON_INVALID_REFERENCE)), new \Assetic\Cache\ConfigCache((__DIR__.'/assetic/config')), false)));
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\ConfigurationResource(array('sonata_jqueryui_js' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.core.js'), 1 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.widget.js'), 2 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.mouse.js'), 3 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.draggable.js'), 4 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.droppable.js'), 5 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.resizable.js'), 6 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.selectable.js'), 7 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.sortable.js'), 8 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.effect.js'), 9 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.position.js'), 10 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/ui/jquery.ui.tooltip.js')), 1 => array(0 => 'yui_js'), 2 => array()), 'sonata_jqueryui_css' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/themes/base/jquery-ui.css')), 1 => array(0 => 'cssrewrite', 1 => 'yui_css'), 2 => array()), 'sonata_formatter_js' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/vendor/markitup-markitup/markitup/jquery.markitup.js'), 1 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/markitup/sets/markdown/set.js'), 2 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/markitup/sets/html/set.js'), 3 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/markitup/sets/textile/set.js')), 1 => array(0 => 'yui_js'), 2 => array()), 'sonata_formatter_css' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/markitup/skins/sonata/style.css'), 1 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/markitup/sets/markdown/style.css'), 2 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/markitup/sets/html/style.css'), 3 => ($this->targetDirs[2].'/../web/bundles/sonataformatter/markitup/sets/textile/style.css')), 1 => array(0 => 'cssrewrite', 1 => 'yui_css'), 2 => array()), 'sonata_admin_js' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jquery/dist/jquery.js'), 1 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jquery.scrollTo/jquery.scrollTo.js'), 2 => ($this->targetDirs[2].'/../web/bundles/sonatacore/vendor/moment/min/moment.min.js'), 3 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/bootstrap/dist/js/bootstrap.js'), 4 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js'), 5 => ($this->targetDirs[2].'/../web/bundles/sonatacore/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'), 6 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/select2/select2.js'), 7 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/jquery/jquery.form.js'), 8 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/jquery/jquery.confirmExit.js'), 9 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/App.js'), 10 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/Admin.js'), 11 => ($this->targetDirs[2].'/../web/bundles/sonatapage/sonata-page.back.js')), 1 => array(0 => 'yui_js'), 2 => array()), 'sonata_admin_css' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/bootstrap/dist/css/bootstrap.min.css'), 1 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/AdminLTE/css/font-awesome.min.css'), 2 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/AdminLTE/css/ionicons.min.css'), 3 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/AdminLTE/css/AdminLTE.css'), 4 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jqueryui/themes/flick/jquery-ui.min.css'), 5 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/select2/select2.css'), 6 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/select2/select2-bootstrap.css'), 7 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css'), 8 => ($this->targetDirs[2].'/../web/bundles/sonatacore/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'), 9 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/css/styles.css'), 10 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/css/layout.css'), 11 => ($this->targetDirs[2].'/../web/bundles/sonatapage/sonata-page.back.min.css')), 1 => array(0 => 'cssrewrite', 1 => 'yui_css'), 2 => array()), 'sonata_front_js' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/jquery/dist/jquery.js'), 1 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/bootstrap/dist/js/bootstrap.js'), 2 => ($this->targetDirs[2].'/../web/bundles/sonataproduct/js/product.js'), 3 => ($this->targetDirs[2].'/../web/bundles/sonatacore/js/base.js'), 4 => ($this->targetDirs[2].'/../web/bundles/sonatacore/vendor/select2/select2.min.js'), 5 => ($this->targetDirs[2].'/../web/bundles/sonatademo/js/demo.js')), 1 => array(0 => 'yui_js'), 2 => array()), 'sonata_front_css' => array(0 => array(0 => ($this->targetDirs[2].'/../web/bundles/sonataadmin/vendor/bootstrap/dist/css/bootstrap.min.css'), 1 => ($this->targetDirs[2].'/../web/bundles/sonatacore/vendor/select2/select2.css'), 2 => ($this->targetDirs[2].'/../web/bundles/mopabootstrap/css/datepicker.css'), 3 => ($this->targetDirs[2].'/../web/bundles/sonatademo/css/demo.css')), 1 => array(0 => 'cssrewrite', 1 => 'yui_css'), 2 => array()))), 'config');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($this->get('templating.loader'), '', ($this->targetDirs[2].'/Resources/views'), '/\\.[^.]+\\.twig$/'), 'twig');
        return $instance;
    }
    protected function getAssetic_Filter_CssrewriteService()
    {
        return $this->services['assetic.filter.cssrewrite'] = new \Assetic\Filter\CssRewriteFilter();
    }
    protected function getAssetic_Filter_YuiCssService()
    {
        $this->services['assetic.filter.yui_css'] = $instance = new \Assetic\Filter\Yui\CssCompressorFilter(($this->targetDirs[2].'/../bin/yuicompressor.jar'), '/usr/bin/java');
        $instance->setCharset('UTF-8');
        $instance->setTimeout(NULL);
        $instance->setStackSize(NULL);
        $instance->setLineBreak(NULL);
        return $instance;
    }
    protected function getAssetic_Filter_YuiJsService()
    {
        $this->services['assetic.filter.yui_js'] = $instance = new \Assetic\Filter\Yui\JsCompressorFilter(($this->targetDirs[2].'/../bin/yuicompressor.jar'), '/usr/bin/java');
        $instance->setCharset('UTF-8');
        $instance->setTimeout(NULL);
        $instance->setStackSize(NULL);
        $instance->setNomunge(NULL);
        $instance->setPreserveSemi(NULL);
        $instance->setDisableOptimizations(NULL);
        $instance->setLineBreak(NULL);
        return $instance;
    }
    protected function getAssetic_FilterManagerService()
    {
        return $this->services['assetic.filter_manager'] = new \Symfony\Bundle\AsseticBundle\FilterManager($this, array('cssrewrite' => 'assetic.filter.cssrewrite', 'yui_js' => 'assetic.filter.yui_js', 'yui_css' => 'assetic.filter.yui_css'));
    }
    protected function getCacheClearerService()
    {
        return $this->services['cache_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer(array());
    }
    protected function getCacheWarmerService()
    {
        $a = $this->get('kernel');
        $b = $this->get('templating.filename_parser');
        $c = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplateFinder($a, $b, ($this->targetDirs[2].'/Resources'));
        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplatePathsCacheWarmer($c, $this->get('templating.locator')), 1 => new \Symfony\Bundle\AsseticBundle\CacheWarmer\AssetManagerCacheWarmer($this), 2 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('cmf_routing.router')), 3 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheCacheWarmer($this, $c), 4 => new \Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer($this->get('doctrine')), 5 => $this->get('sonata.admin.route.cache_warmup')));
    }
    protected function getCmfRouting_RouteTypeFormTypeService()
    {
        return $this->services['cmf_routing.route_type_form_type'] = new \Symfony\Cmf\Bundle\RoutingBundle\Form\Type\RouteTypeType();
    }
    protected function getCmfRouting_RouterService()
    {
        $this->services['cmf_routing.router'] = $instance = new \Symfony\Cmf\Component\Routing\ChainRouter($this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
        $instance->setContext($this->get('router.request_context'));
        $instance->add($this->get('sonata.page.router'), '150');
        $instance->add($this->get('router.default'), '100');
        return $instance;
    }
    protected function getDataCollector_FormService()
    {
        return $this->services['data_collector.form'] = new \Symfony\Component\Form\Extension\DataCollector\FormDataCollector($this->get('data_collector.form.extractor'));
    }
    protected function getDataCollector_Form_ExtractorService()
    {
        return $this->services['data_collector.form.extractor'] = new \Symfony\Component\Form\Extension\DataCollector\FormDataExtractor();
    }
    protected function getDataCollector_RequestService()
    {
        return $this->services['data_collector.request'] = new \Symfony\Component\HttpKernel\DataCollector\RequestDataCollector();
    }
    protected function getDataCollector_RouterService()
    {
        return $this->services['data_collector.router'] = new \Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector();
    }
    protected function getDebug_DebugHandlersListenerService()
    {
        return $this->services['debug.debug_handlers_listener'] = new \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener('', $this->get('monolog.logger.php', ContainerInterface::NULL_ON_INVALID_REFERENCE), 85, NULL, true, NULL);
    }
    protected function getDebug_StopwatchService()
    {
        return $this->services['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch();
    }
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Doctrine\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default');
    }
    protected function getDoctrine_Dbal_ConnectionFactoryService()
    {
        return $this->services['doctrine.dbal.connection_factory'] = new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory(array('json' => array('class' => 'Sonata\\Doctrine\\Types\\JsonType', 'commented' => true), 'currency' => array('class' => 'Sonata\\Component\\Currency\\CurrencyDoctrineType', 'commented' => true)));
    }
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($this);
        $a->addEventSubscriber($this->get('sonata.easy_extends.doctrine.mapper'));
        $a->addEventSubscriber($this->get('sonata.cache.orm.event_subscriber'));
        $a->addEventSubscriber($this->get('sonata.product.subscriber.orm'));
        $a->addEventSubscriber($this->get('simplethings_entityaudit.create_schema_listener'));
        $a->addEventSubscriber($this->get('simplethings_entityaudit.log_revisions_listener'));
        $a->addEventSubscriber($this->get('sonata.media.doctrine.event_subscriber'));
        $a->addEventSubscriber(new \FOS\UserBundle\Entity\UserListener($this));
        $a->addEventListener(array(0 => 'postGenerateSchema'), 'security.acl.dbal.schema_listener');
        return $this->services['doctrine.dbal.default_connection'] = $this->get('doctrine.dbal.connection_factory')->createConnection(array('driver' => 'pdo_mysql', 'dbname' => 'sonata3', 'user' => 'root', 'host' => '127.0.0.1', 'password' => 'panda2014', 'charset' => 'UTF8', 'port' => NULL, 'driverOptions' => array()), new \Doctrine\DBAL\Configuration(), $a, array());
    }
    protected function getDoctrine_Orm_DefaultEntityListenerResolverService()
    {
        return $this->services['doctrine.orm.default_entity_listener_resolver'] = new \Doctrine\ORM\Mapping\DefaultEntityListenerResolver();
    }
    protected function getDoctrine_Orm_DefaultEntityManagerService()
    {
        $a = $this->get('annotation_reader');
        $b = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver(array(($this->targetDirs[3].'/src/Application/Sonata/PageBundle/Resources/config/doctrine') => 'Application\\Sonata\\PageBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/config/doctrine') => 'Sonata\\PageBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/MediaBundle/Resources/config/doctrine') => 'Application\\Sonata\\MediaBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/config/doctrine') => 'Sonata\\MediaBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/NewsBundle/Resources/config/doctrine') => 'Application\\Sonata\\NewsBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/config/doctrine') => 'Sonata\\NewsBundle\\Entity', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/doctrine') => 'FOS\\UserBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/UserBundle/Resources/config/doctrine') => 'Application\\Sonata\\UserBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/config/doctrine') => 'Sonata\\UserBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/config/doctrine') => 'Sonata\\NotificationBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/NotificationBundle/Resources/config/doctrine') => 'Application\\Sonata\\NotificationBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/OrderBundle/Resources/config/doctrine') => 'Application\\Sonata\\OrderBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/OrderBundle/Resources/config/doctrine') => 'Sonata\\OrderBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/PaymentBundle/Resources/config/doctrine') => 'Application\\Sonata\\PaymentBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/PaymentBundle/Resources/config/doctrine') => 'Sonata\\PaymentBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/ProductBundle/Resources/config/doctrine') => 'Application\\Sonata\\ProductBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/config/doctrine') => 'Sonata\\ProductBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/InvoiceBundle/Resources/config/doctrine') => 'Application\\Sonata\\InvoiceBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/InvoiceBundle/Resources/config/doctrine') => 'Sonata\\InvoiceBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/CustomerBundle/Resources/config/doctrine') => 'Application\\Sonata\\CustomerBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/CustomerBundle/Resources/config/doctrine') => 'Sonata\\CustomerBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/BasketBundle/Resources/config/doctrine') => 'Application\\Sonata\\BasketBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/config/doctrine') => 'Sonata\\BasketBundle\\Entity', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/config/doctrine') => 'FOS\\CommentBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/comment-bundle/Resources/config/doctrine') => 'Sonata\\CommentBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/CommentBundle/Resources/config/doctrine') => 'Application\\Sonata\\CommentBundle\\Entity', ($this->targetDirs[3].'/vendor/sonata-project/classification-bundle/Resources/config/doctrine') => 'Sonata\\ClassificationBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/ClassificationBundle/Resources/config/doctrine') => 'Application\\Sonata\\ClassificationBundle\\Entity', ($this->targetDirs[3].'/vendor/stephpy/timeline-bundle/Resources/config/doctrine') => 'Spy\\TimelineBundle\\Entity', ($this->targetDirs[3].'/src/Application/Sonata/TimelineBundle/Resources/config/doctrine') => 'Application\\Sonata\\TimelineBundle\\Entity'));
        $b->setGlobalBasename('mapping');
        $c = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($a, array(0 => ($this->targetDirs[3].'/src/Sonata/Bundle/DemoBundle/Entity'), 1 => ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Entity')));
        $d = new \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain();
        $d->addDriver($b, 'Application\\Sonata\\PageBundle\\Entity');
        $d->addDriver($b, 'Sonata\\PageBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\MediaBundle\\Entity');
        $d->addDriver($b, 'Sonata\\MediaBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\NewsBundle\\Entity');
        $d->addDriver($b, 'Sonata\\NewsBundle\\Entity');
        $d->addDriver($b, 'FOS\\UserBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\UserBundle\\Entity');
        $d->addDriver($b, 'Sonata\\UserBundle\\Entity');
        $d->addDriver($b, 'Sonata\\NotificationBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\NotificationBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\OrderBundle\\Entity');
        $d->addDriver($b, 'Sonata\\OrderBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\PaymentBundle\\Entity');
        $d->addDriver($b, 'Sonata\\PaymentBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\ProductBundle\\Entity');
        $d->addDriver($b, 'Sonata\\ProductBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\InvoiceBundle\\Entity');
        $d->addDriver($b, 'Sonata\\InvoiceBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\CustomerBundle\\Entity');
        $d->addDriver($b, 'Sonata\\CustomerBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\BasketBundle\\Entity');
        $d->addDriver($b, 'Sonata\\BasketBundle\\Entity');
        $d->addDriver($b, 'FOS\\CommentBundle\\Entity');
        $d->addDriver($b, 'Sonata\\CommentBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\CommentBundle\\Entity');
        $d->addDriver($b, 'Sonata\\ClassificationBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\ClassificationBundle\\Entity');
        $d->addDriver($b, 'Spy\\TimelineBundle\\Entity');
        $d->addDriver($b, 'Application\\Sonata\\TimelineBundle\\Entity');
        $d->addDriver($c, 'Sonata\\Bundle\\DemoBundle\\Entity');
        $d->addDriver($c, 'Sonata\\TimelineBundle\\Entity');
        $e = new \Doctrine\ORM\Configuration();
        $e->setEntityNamespaces(array('ApplicationSonataPageBundle' => 'Application\\Sonata\\PageBundle\\Entity', 'SonataPageBundle' => 'Sonata\\PageBundle\\Entity', 'ApplicationSonataMediaBundle' => 'Application\\Sonata\\MediaBundle\\Entity', 'SonataMediaBundle' => 'Sonata\\MediaBundle\\Entity', 'ApplicationSonataNewsBundle' => 'Application\\Sonata\\NewsBundle\\Entity', 'SonataNewsBundle' => 'Sonata\\NewsBundle\\Entity', 'FOSUserBundle' => 'FOS\\UserBundle\\Entity', 'ApplicationSonataUserBundle' => 'Application\\Sonata\\UserBundle\\Entity', 'SonataUserBundle' => 'Sonata\\UserBundle\\Entity', 'SonataNotificationBundle' => 'Sonata\\NotificationBundle\\Entity', 'ApplicationSonataNotificationBundle' => 'Application\\Sonata\\NotificationBundle\\Entity', 'ApplicationSonataOrderBundle' => 'Application\\Sonata\\OrderBundle\\Entity', 'SonataOrderBundle' => 'Sonata\\OrderBundle\\Entity', 'ApplicationSonataPaymentBundle' => 'Application\\Sonata\\PaymentBundle\\Entity', 'SonataPaymentBundle' => 'Sonata\\PaymentBundle\\Entity', 'ApplicationSonataProductBundle' => 'Application\\Sonata\\ProductBundle\\Entity', 'SonataProductBundle' => 'Sonata\\ProductBundle\\Entity', 'ApplicationSonataInvoiceBundle' => 'Application\\Sonata\\InvoiceBundle\\Entity', 'SonataInvoiceBundle' => 'Sonata\\InvoiceBundle\\Entity', 'ApplicationSonataCustomerBundle' => 'Application\\Sonata\\CustomerBundle\\Entity', 'SonataCustomerBundle' => 'Sonata\\CustomerBundle\\Entity', 'ApplicationSonataBasketBundle' => 'Application\\Sonata\\BasketBundle\\Entity', 'SonataBasketBundle' => 'Sonata\\BasketBundle\\Entity', 'FOSCommentBundle' => 'FOS\\CommentBundle\\Entity', 'SonataCommentBundle' => 'Sonata\\CommentBundle\\Entity', 'ApplicationSonataCommentBundle' => 'Application\\Sonata\\CommentBundle\\Entity', 'SonataClassificationBundle' => 'Sonata\\ClassificationBundle\\Entity', 'ApplicationSonataClassificationBundle' => 'Application\\Sonata\\ClassificationBundle\\Entity', 'SonataDemoBundle' => 'Sonata\\Bundle\\DemoBundle\\Entity', 'SpyTimelineBundle' => 'Spy\\TimelineBundle\\Entity', 'SonataTimelineBundle' => 'Sonata\\TimelineBundle\\Entity', 'ApplicationSonataTimelineBundle' => 'Application\\Sonata\\TimelineBundle\\Entity'));
        $e->setMetadataCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_metadata_cache'));
        $e->setQueryCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_query_cache'));
        $e->setResultCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_result_cache'));
        $e->setMetadataDriverImpl($d);
        $e->setProxyDir((__DIR__.'/doctrine/orm/Proxies'));
        $e->setProxyNamespace('Proxies');
        $e->setAutoGenerateProxyClasses(false);
        $e->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        $e->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
        $e->setNamingStrategy(new \Doctrine\ORM\Mapping\DefaultNamingStrategy());
        $e->setEntityListenerResolver($this->get('doctrine.orm.default_entity_listener_resolver'));
        $this->services['doctrine.orm.default_entity_manager'] = $instance = \Doctrine\ORM\EntityManager::create($this->get('doctrine.dbal.default_connection'), $e);
        $this->get('doctrine.orm.default_manager_configurator')->configure($instance);
        return $instance;
    }
    protected function getDoctrine_Orm_DefaultManagerConfiguratorService()
    {
        return $this->services['doctrine.orm.default_manager_configurator'] = new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator(array(), array());
    }
    protected function getDoctrine_Orm_Validator_UniqueService()
    {
        return $this->services['doctrine.orm.validator.unique'] = new \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator($this->get('doctrine'));
    }
    protected function getDoctrine_Orm_ValidatorInitializerService()
    {
        return $this->services['doctrine.orm.validator_initializer'] = new \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer($this->get('doctrine'));
    }
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultMetadataCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_metadata_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();
        $instance->setNamespace('sf2orm_default_a1d9e2e194c47ebc3617c2e6bf9cb631f25548ec9ecf46ffe040d2de579d3325');
        return $instance;
    }
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultQueryCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_query_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();
        $instance->setNamespace('sf2orm_default_a1d9e2e194c47ebc3617c2e6bf9cb631f25548ec9ecf46ffe040d2de579d3325');
        return $instance;
    }
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultResultCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_result_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();
        $instance->setNamespace('sf2orm_default_a1d9e2e194c47ebc3617c2e6bf9cb631f25548ec9ecf46ffe040d2de579d3325');
        return $instance;
    }
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this);
        $instance->addListenerService('kernel.controller', array(0 => 'data_collector.router', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'knp_menu.listener.voters', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('security.interactive_login', array(0 => 'fos_user.security.interactive_login_listener', 1 => 'onSecurityInteractiveLogin'), 0);
        $instance->addListenerService('security.interactive_login', array(0 => 'sonata.user.google.authenticator.interactive_login_listener', 1 => 'onSecurityInteractiveLogin'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'sonata.user.google.authenticator.request_listener', 1 => 'onCoreRequest'), -1);
        $instance->addListenerService('kernel.request', array(0 => 'sonata.page.site.selector.host_with_path', 1 => 'onKernelRequest'), 47);
        $instance->addListenerService('kernel.request', array(0 => 'sonata.page.site.selector.host_with_path', 1 => 'onKernelRequestRedirect'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'sonata.page.response_listener', 1 => 'onCoreResponse'), -1);
        $instance->addListenerService('kernel.request', array(0 => 'sonata.page.request_listener', 1 => 'onCoreRequest'), 30);
        $instance->addListenerService('security.interactive_login', array(0 => 'sonata.page.cms_manager_selector', 1 => 'onSecurityInteractiveLogin'), 0);
        $instance->addListenerService('kernel.exception', array(0 => 'sonata.page.kernel.exception_listener', 1 => 'onKernelException'), -127);
        $instance->addListenerService('kernel.request', array(0 => 'simplethings_entityaudit.request.current_user_listener', 1 => 'handle'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelController'), -10);
        $instance->addListenerService('kernel.view', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelView'), 100);
        $instance->addListenerService('kernel.request', array(0 => 'fos_rest.body_listener', 1 => 'onKernelRequest'), 10);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.param_fetcher_listener', 1 => 'onKernelController'), 5);
        $instance->addListenerService('kernel.request', array(0 => 'nelmio_api_doc.event_listener.request', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('sonata.block.event.sonata.comment', array(0 => 'sonata.comment.event.sonata.comment', 1 => 'onBlock'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'sonata.block.cache.handler.default', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('sonata.block.event.breadcrumb', array(0 => 'sonata.seo.event.breadcrumb', 1 => 'onBlock'), 0);
        $instance->addListenerService('kernel.terminate', array(0 => 'sonata.notification.backend.postpone', 1 => 'onEvent'), 0);
        $instance->addListenerService('sonata.notification.event.message_iterate_event', array(0 => 'sonata.notification.event.doctrine_optimize', 1 => 'iterate'), 0);
        $instance->addSubscriberService('response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener');
        $instance->addSubscriberService('streamed_response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener');
        $instance->addSubscriberService('locale_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener');
        $instance->addSubscriberService('translator_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\TranslatorListener');
        $instance->addSubscriberService('session_listener', 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener');
        $instance->addSubscriberService('session.save_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\SaveSessionListener');
        $instance->addSubscriberService('fragment.listener', 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener');
        $instance->addSubscriberService('profiler_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ProfilerListener');
        $instance->addSubscriberService('data_collector.request', 'Symfony\\Component\\HttpKernel\\DataCollector\\RequestDataCollector');
        $instance->addSubscriberService('router_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener');
        $instance->addSubscriberService('debug.debug_handlers_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener');
        $instance->addSubscriberService('security.firewall', 'Symfony\\Component\\Security\\Http\\Firewall');
        $instance->addSubscriberService('security.rememberme.response_listener', 'Symfony\\Component\\Security\\Http\\RememberMe\\ResponseListener');
        $instance->addSubscriberService('swiftmailer.email_sender.listener', 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener');
        $instance->addSubscriberService('sensio_framework_extra.controller.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener');
        $instance->addSubscriberService('sensio_framework_extra.converter.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener');
        $instance->addSubscriberService('sensio_framework_extra.cache.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\CacheListener');
        $instance->addSubscriberService('fos_rest.exception_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener');
        $instance->addSubscriberService('fos_comment.listener.comment_vote_score', 'FOS\\CommentBundle\\EventListener\\CommentVoteScoreListener');
        $instance->addSubscriberService('fos_comment.listener.thread_counters', 'FOS\\CommentBundle\\EventListener\\ThreadCountersListener');
        $instance->addSubscriberService('fos_comment.listener.thread_permalink', 'FOS\\CommentBundle\\EventListener\\ThreadPermalinkListener');
        $instance->addSubscriberService('fos_comment.listener.comment_blamer', 'FOS\\CommentBundle\\EventListener\\CommentBlamerListener');
        $instance->addSubscriberService('fos_comment.listener.vote_blamer', 'FOS\\CommentBundle\\EventListener\\VoteBlamerListener');
        $instance->addSubscriberService('fos_comment.listener.closed_threads', 'FOS\\CommentBundle\\EventListener\\ClosedThreadListener');
        $instance->addSubscriberService('web_profiler.debug_toolbar', 'Symfony\\Bundle\\WebProfilerBundle\\EventListener\\WebDebugToolbarListener');
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'before'), 0);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'pagination'), 0);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.sortable', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.filtration', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'pagination'), 1);
        return $instance;
    }
    protected function getFaker_FormatterFactoryService()
    {
        return $this->services['faker.formatter_factory'] = new \Bazinga\Bundle\FakerBundle\Factory\FormatterFactory();
    }
    protected function getFaker_GeneratorService()
    {
        $this->services['faker.generator'] = $instance = \Faker\Factory::create('en_US');
        $instance->seed(2024574236);
        return $instance;
    }
    protected function getFaker_PopulatorService()
    {
        return $this->services['faker.populator'] = new \Faker\ORM\Propel\Populator($this->get('faker.generator'), '');
    }
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), ($this->targetDirs[2].'/Resources'));
    }
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }
    protected function getForm_CsrfProviderService()
    {
        return $this->services['form.csrf_provider'] = new \Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter($this->get('security.csrf.token_manager'));
    }
    protected function getForm_FactoryService()
    {
        return $this->services['form.factory'] = new \Symfony\Component\Form\FormFactory($this->get('form.registry'), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_RegistryService()
    {
        return $this->services['form.registry'] = new \Symfony\Component\Form\FormRegistry(array(0 => new \Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension($this, array('form' => 'form.type.form', 'birthday' => 'form.type.birthday', 'checkbox' => 'form.type.checkbox', 'choice' => 'form.type.choice', 'collection' => 'form.type.collection', 'country' => 'form.type.country', 'date' => 'form.type.date', 'datetime' => 'form.type.datetime', 'email' => 'form.type.email', 'file' => 'form.type.file', 'hidden' => 'form.type.hidden', 'integer' => 'form.type.integer', 'language' => 'form.type.language', 'locale' => 'form.type.locale', 'money' => 'form.type.money', 'number' => 'form.type.number', 'password' => 'form.type.password', 'percent' => 'form.type.percent', 'radio' => 'form.type.radio', 'repeated' => 'form.type.repeated', 'search' => 'form.type.search', 'textarea' => 'form.type.textarea', 'text' => 'form.type.text', 'time' => 'form.type.time', 'timezone' => 'form.type.timezone', 'url' => 'form.type.url', 'button' => 'form.type.button', 'submit' => 'form.type.submit', 'reset' => 'form.type.reset', 'currency' => 'form.type.currency', 'entity' => 'form.type.entity', 'fos_user_username' => 'fos_user.username_form_type', 'fos_user_profile' => 'fos_user.profile.form.type', 'fos_user_registration' => 'fos_user.registration.form.type', 'fos_user_change_password' => 'fos_user.change_password.form.type', 'fos_user_resetting' => 'fos_user.resetting.form.type', 'fos_user_group' => 'fos_user.group.form.type', 'sonata_security_roles' => 'sonata.user.form.type.security_roles', 'sonata_user_profile' => 'sonata.user.profile.form.type', 'sonata_user_gender' => 'sonata.user.form.gender_list', 'sonata_page_api_form_site' => 'sonata.page.api.form.type.site', 'sonata_page_api_form_page' => 'sonata.page.api.form.type.page', 'sonata_page_api_form_block' => 'sonata.page.api.form.type.block', 'sonata_page_selector' => 'sonata.page.form.type.page_selector', 'sonata_page_create_snapshot' => 'sonata.page.form.create_snapshot', 'sonata_page_template' => 'sonata.page.form.template_choice', 'sonata_page_type_choice' => 'sonata.page.form.page_type_choice', 'sonata_post_comment' => 'sonata.news.form.type.comment', 'sonata_news_comment_status' => 'sonata.news.form.comment.status_type', 'sonata_news_api_form_comment' => 'sonata.news.api.form.type.comment', 'sonata_news_api_form_post' => 'sonata.news.api.form.type.post', 'sonata_media_type' => 'sonata.media.form.type.media', 'sonata_media_api_form_doctrine_media' => 'sonata.media.api.form.type.doctrine.media', 'sonata_media_api_form_media' => 'sonata.media.api.form.type.media', 'sonata_media_api_form_gallery' => 'sonata.media.api.form.type.gallery', 'sonata_media_api_form_gallery_has_media' => 'sonata.media.api.form.type.gallery_has_media', 'ckeditor' => 'ivory_ck_editor.form.type', 'sonata_type_admin' => 'sonata.admin.form.type.admin', 'sonata_type_model' => 'sonata.admin.form.type.model_choice', 'sonata_type_model_list' => 'sonata.admin.form.type.model_list', 'sonata_type_model_reference' => 'sonata.admin.form.type.model_reference', 'sonata_type_model_hidden' => 'sonata.admin.form.type.model_hidden', 'sonata_type_model_autocomplete' => 'sonata.admin.form.type.model_autocomplete', 'sonata_type_native_collection' => 'sonata.admin.form.type.collection', 'sonata_type_filter_number' => 'sonata.admin.form.filter.type.number', 'sonata_type_filter_choice' => 'sonata.admin.form.filter.type.choice', 'sonata_type_filter_default' => 'sonata.admin.form.filter.type.default', 'sonata_type_filter_date' => 'sonata.admin.form.filter.type.date', 'sonata_type_filter_date_range' => 'sonata.admin.form.filter.type.daterange', 'sonata_type_filter_datetime' => 'sonata.admin.form.filter.type.datetime', 'sonata_type_filter_datetime_range' => 'sonata.admin.form.filter.type.datetime_range', 'sonata_basket_basket' => 'sonata.basket.form.type.basket', 'sonata_basket_address' => 'sonata.basket.form.type.address', 'sonata_basket_shipping' => 'sonata.basket.form.type.shipping', 'sonata_basket_payment' => 'sonata.basket.form.type.payment', 'sonata_basket_api_form_basket_parent' => 'sonata.basket.api.form.type.basket.parent', 'sonata_basket_api_form_basket' => 'sonata.basket.api.form.type.basket', 'sonata_basket_api_form_basket_element_parent' => 'sonata.basket.api.form.type.basket.element.parent', 'sonata_basket_api_form_basket_element' => 'sonata.basket.api.form.type.basket_element', 'sonata_customer_address' => 'sonata.customer.form.address_type', 'sonata_customer_address_types' => 'sonata.customer.form.address_types_type', 'sonata_customer_api_form_customer' => 'sonata.customer.api.form.type.customer', 'sonata_customer_api_form_address' => 'sonata.customer.api.form.type.address', 'sonata_delivery_choice' => 'sonata.delivery.form.delivery_choice_type', 'sonata_invoice_status' => 'sonata.invoice.form.status_type', 'sonata_order_status' => 'sonata.order.form.status_type', 'sonata_payment_transaction_status' => 'sonata.payment.form.transaction_status', 'sonata_product_delivery_status' => 'sonata.product.form.delivery_type', 'sonata_product_variation_choices' => 'sonata.product.form.variation_choices_type', 'sonata_product_api_form_product_parent' => 'sonata.product.api.form.type.product.parent', 'sonata_product_api_form_product' => 'sonata.product.api.form.type.product', 'sonata_currency' => 'sonata.price.currency.form_type', 'fos_comment_comment' => 'fos_comment.form_type.comment.default', 'fos_comment_commentable_thread' => 'fos_comment.form_type.commentable_thread.default', 'fos_comment_delete_comment' => 'fos_comment.form_type.delete_comment.default', 'fos_comment_thread' => 'fos_comment.form_type.thread.default', 'fos_comment_vote' => 'fos_comment.form_type.vote.default', 'sonata_comment_comment' => 'sonata.comment.form.comment_type', 'sonata_comment_status' => 'sonata.comment.form.comment_status_type', 'sonata_type_immutable_array' => 'sonata.core.form.type.array', 'sonata_type_boolean' => 'sonata.core.form.type.boolean', 'sonata_type_collection' => 'sonata.core.form.type.collection', 'sonata_type_translatable_choice' => 'sonata.core.form.type.translatable_choice', 'sonata_type_date_range' => 'sonata.core.form.type.date_range', 'sonata_type_datetime_range' => 'sonata.core.form.type.datetime_range', 'sonata_type_date_picker' => 'sonata.core.form.type.date_picker', 'sonata_type_datetime_picker' => 'sonata.core.form.type.datetime_picker', 'sonata_type_equal' => 'sonata.core.form.type.equal', 'sonata_formatter_type' => 'sonata.formatter.form.type.selector', 'sonata_block_service_choice' => 'sonata.block.form.type.block', 'sonata_type_container_template_choice' => 'sonata.block.form.type.container_template', 'sonata_category_selector' => 'sonata.classification.form.type.category_selector', 'sonata_classification_api_form_category' => 'sonata.classification.api.form.type.category', 'sonata_classification_api_form_collection' => 'sonata.classification.api.form.type.collection', 'sonata_classification_api_form_tag' => 'sonata.classification.api.form.type.tag', 'cmf_routing_route_type' => 'cmf_routing.route_type_form_type', 'sonata_demo_form_type_car' => 'sonata.demo.form.type.car', 'sonata_demo_form_type_engine' => 'sonata.demo.form.type.engine', 'sonata_demo_form_type_newsletter' => 'sonata.demo.form.type.newsletter', 'tab' => 'mopa_bootstrap.form.type.tab'), array('form' => array(0 => 'form.type_extension.form.http_foundation', 1 => 'form.type_extension.form.validator', 2 => 'form.type_extension.csrf', 3 => 'form.type_extension.form.data_collector', 4 => 'sonata.admin.form.extension.field', 5 => 'nelmio_api_doc.form.extension.description_form_type_extension', 6 => 'mopa_bootstrap.form.type_extension.help', 7 => 'mopa_bootstrap.form.type_extension.legend', 8 => 'mopa_bootstrap.form.type_extension.error', 9 => 'mopa_bootstrap.form.type_extension.widget', 10 => 'mopa_bootstrap.form.type_extension.horizontal', 11 => 'mopa_bootstrap.form.type_extension.widget_collection', 12 => 'mopa_bootstrap.form.type_extension.tabbed'), 'repeated' => array(0 => 'form.type_extension.repeated.validator'), 'submit' => array(0 => 'form.type_extension.submit.validator'), 'sonata_demo_car' => array(0 => 'sonata.demo.form.type.advanced_rescue_engine'), 'button' => array(0 => 'mopa_bootstrap.form.type_extension.button'), 'date' => array(0 => 'mopa_bootstrap.form.type_extension.date')), array(0 => 'form.type_guesser.validator', 1 => 'form.type_guesser.doctrine'))), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_ResolvedTypeFactoryService()
    {
        return $this->services['form.resolved_type_factory'] = new \Symfony\Component\Form\Extension\DataCollector\Proxy\ResolvedTypeFactoryDataCollectorProxy(new \Symfony\Component\Form\ResolvedFormTypeFactory(), $this->get('data_collector.form'));
    }
    protected function getForm_Type_BirthdayService()
    {
        return $this->services['form.type.birthday'] = new \Symfony\Component\Form\Extension\Core\Type\BirthdayType();
    }
    protected function getForm_Type_ButtonService()
    {
        return $this->services['form.type.button'] = new \Symfony\Component\Form\Extension\Core\Type\ButtonType();
    }
    protected function getForm_Type_CheckboxService()
    {
        return $this->services['form.type.checkbox'] = new \Symfony\Component\Form\Extension\Core\Type\CheckboxType();
    }
    protected function getForm_Type_ChoiceService()
    {
        return $this->services['form.type.choice'] = new \Symfony\Component\Form\Extension\Core\Type\ChoiceType();
    }
    protected function getForm_Type_CollectionService()
    {
        return $this->services['form.type.collection'] = new \Symfony\Component\Form\Extension\Core\Type\CollectionType();
    }
    protected function getForm_Type_CountryService()
    {
        return $this->services['form.type.country'] = new \Symfony\Component\Form\Extension\Core\Type\CountryType();
    }
    protected function getForm_Type_CurrencyService()
    {
        return $this->services['form.type.currency'] = new \Symfony\Component\Form\Extension\Core\Type\CurrencyType();
    }
    protected function getForm_Type_DateService()
    {
        return $this->services['form.type.date'] = new \Symfony\Component\Form\Extension\Core\Type\DateType();
    }
    protected function getForm_Type_DatetimeService()
    {
        return $this->services['form.type.datetime'] = new \Symfony\Component\Form\Extension\Core\Type\DateTimeType();
    }
    protected function getForm_Type_EmailService()
    {
        return $this->services['form.type.email'] = new \Symfony\Component\Form\Extension\Core\Type\EmailType();
    }
    protected function getForm_Type_EntityService()
    {
        return $this->services['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType($this->get('doctrine'));
    }
    protected function getForm_Type_FileService()
    {
        return $this->services['form.type.file'] = new \Symfony\Component\Form\Extension\Core\Type\FileType();
    }
    protected function getForm_Type_FormService()
    {
        return $this->services['form.type.form'] = new \Symfony\Component\Form\Extension\Core\Type\FormType($this->get('property_accessor'));
    }
    protected function getForm_Type_HiddenService()
    {
        return $this->services['form.type.hidden'] = new \Symfony\Component\Form\Extension\Core\Type\HiddenType();
    }
    protected function getForm_Type_IntegerService()
    {
        return $this->services['form.type.integer'] = new \Symfony\Component\Form\Extension\Core\Type\IntegerType();
    }
    protected function getForm_Type_LanguageService()
    {
        return $this->services['form.type.language'] = new \Symfony\Component\Form\Extension\Core\Type\LanguageType();
    }
    protected function getForm_Type_LocaleService()
    {
        return $this->services['form.type.locale'] = new \Symfony\Component\Form\Extension\Core\Type\LocaleType();
    }
    protected function getForm_Type_MoneyService()
    {
        return $this->services['form.type.money'] = new \Symfony\Component\Form\Extension\Core\Type\MoneyType();
    }
    protected function getForm_Type_NumberService()
    {
        return $this->services['form.type.number'] = new \Symfony\Component\Form\Extension\Core\Type\NumberType();
    }
    protected function getForm_Type_PasswordService()
    {
        return $this->services['form.type.password'] = new \Symfony\Component\Form\Extension\Core\Type\PasswordType();
    }
    protected function getForm_Type_PercentService()
    {
        return $this->services['form.type.percent'] = new \Symfony\Component\Form\Extension\Core\Type\PercentType();
    }
    protected function getForm_Type_RadioService()
    {
        return $this->services['form.type.radio'] = new \Symfony\Component\Form\Extension\Core\Type\RadioType();
    }
    protected function getForm_Type_RepeatedService()
    {
        return $this->services['form.type.repeated'] = new \Symfony\Component\Form\Extension\Core\Type\RepeatedType();
    }
    protected function getForm_Type_ResetService()
    {
        return $this->services['form.type.reset'] = new \Symfony\Component\Form\Extension\Core\Type\ResetType();
    }
    protected function getForm_Type_SearchService()
    {
        return $this->services['form.type.search'] = new \Symfony\Component\Form\Extension\Core\Type\SearchType();
    }
    protected function getForm_Type_SubmitService()
    {
        return $this->services['form.type.submit'] = new \Symfony\Component\Form\Extension\Core\Type\SubmitType();
    }
    protected function getForm_Type_TextService()
    {
        return $this->services['form.type.text'] = new \Symfony\Component\Form\Extension\Core\Type\TextType();
    }
    protected function getForm_Type_TextareaService()
    {
        return $this->services['form.type.textarea'] = new \Symfony\Component\Form\Extension\Core\Type\TextareaType();
    }
    protected function getForm_Type_TimeService()
    {
        return $this->services['form.type.time'] = new \Symfony\Component\Form\Extension\Core\Type\TimeType();
    }
    protected function getForm_Type_TimezoneService()
    {
        return $this->services['form.type.timezone'] = new \Symfony\Component\Form\Extension\Core\Type\TimezoneType();
    }
    protected function getForm_Type_UrlService()
    {
        return $this->services['form.type.url'] = new \Symfony\Component\Form\Extension\Core\Type\UrlType();
    }
    protected function getForm_TypeExtension_CsrfService()
    {
        return $this->services['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension($this->get('form.csrf_provider'), true, '_token', $this->get('translator.default'), 'validators');
    }
    protected function getForm_TypeExtension_Form_DataCollectorService()
    {
        return $this->services['form.type_extension.form.data_collector'] = new \Symfony\Component\Form\Extension\DataCollector\Type\DataCollectorTypeExtension($this->get('data_collector.form'));
    }
    protected function getForm_TypeExtension_Form_HttpFoundationService()
    {
        return $this->services['form.type_extension.form.http_foundation'] = new \Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension(new \Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler());
    }
    protected function getForm_TypeExtension_Form_ValidatorService()
    {
        return $this->services['form.type_extension.form.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension($this->get('validator'));
    }
    protected function getForm_TypeExtension_Repeated_ValidatorService()
    {
        return $this->services['form.type_extension.repeated.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\RepeatedTypeValidatorExtension();
    }
    protected function getForm_TypeExtension_Submit_ValidatorService()
    {
        return $this->services['form.type_extension.submit.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\SubmitTypeValidatorExtension();
    }
    protected function getForm_TypeGuesser_DoctrineService()
    {
        return $this->services['form.type_guesser.doctrine'] = new \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser($this->get('doctrine'));
    }
    protected function getForm_TypeGuesser_ValidatorService()
    {
        return $this->services['form.type_guesser.validator'] = new \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser($this->get('validator'));
    }
    protected function getFosComment_FormFactory_CommentService()
    {
        return $this->services['fos_comment.form_factory.comment'] = new \FOS\CommentBundle\FormFactory\CommentFormFactory($this->get('form.factory'), 'sonata_comment_comment', 'fos_comment_comment');
    }
    protected function getFosComment_FormFactory_CommentableThreadService()
    {
        return $this->services['fos_comment.form_factory.commentable_thread'] = new \FOS\CommentBundle\FormFactory\CommentableThreadFormFactory($this->get('form.factory'), 'fos_comment_commentable_thread', 'fos_comment_commentable_thread');
    }
    protected function getFosComment_FormFactory_DeleteCommentService()
    {
        return $this->services['fos_comment.form_factory.delete_comment'] = new \FOS\CommentBundle\FormFactory\DeleteCommentFormFactory($this->get('form.factory'), 'fos_comment_delete_comment', 'fos_comment_delete_comment');
    }
    protected function getFosComment_FormFactory_ThreadService()
    {
        return $this->services['fos_comment.form_factory.thread'] = new \FOS\CommentBundle\FormFactory\ThreadFormFactory($this->get('form.factory'), 'fos_comment_thread', 'fos_comment_thread');
    }
    protected function getFosComment_FormFactory_VoteService()
    {
        return $this->services['fos_comment.form_factory.vote'] = new \FOS\CommentBundle\FormFactory\VoteFormFactory($this->get('form.factory'), 'fos_comment_vote', 'fos_comment_vote');
    }
    protected function getFosComment_FormType_Comment_DefaultService()
    {
        return $this->services['fos_comment.form_type.comment.default'] = new \FOS\CommentBundle\Form\CommentType('Application\\Sonata\\CommentBundle\\Entity\\Comment');
    }
    protected function getFosComment_FormType_CommentableThread_DefaultService()
    {
        return $this->services['fos_comment.form_type.commentable_thread.default'] = new \FOS\CommentBundle\Form\CommentableThreadType('Application\\Sonata\\CommentBundle\\Entity\\Thread');
    }
    protected function getFosComment_FormType_DeleteComment_DefaultService()
    {
        return $this->services['fos_comment.form_type.delete_comment.default'] = new \FOS\CommentBundle\Form\DeleteCommentType('Application\\Sonata\\CommentBundle\\Entity\\Comment');
    }
    protected function getFosComment_FormType_Thread_DefaultService()
    {
        return $this->services['fos_comment.form_type.thread.default'] = new \FOS\CommentBundle\Form\ThreadType('Application\\Sonata\\CommentBundle\\Entity\\Thread');
    }
    protected function getFosComment_FormType_Vote_DefaultService()
    {
        return $this->services['fos_comment.form_type.vote.default'] = new \FOS\CommentBundle\Form\VoteType('FOS\\CommentBundle\\Entity\\Vote');
    }
    protected function getFosComment_Listener_ClosedThreadsService()
    {
        return $this->services['fos_comment.listener.closed_threads'] = new \FOS\CommentBundle\EventListener\ClosedThreadListener();
    }
    protected function getFosComment_Listener_CommentBlamerService()
    {
        return $this->services['fos_comment.listener.comment_blamer'] = new \FOS\CommentBundle\EventListener\CommentBlamerListener($this->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getFosComment_Listener_CommentVoteScoreService()
    {
        return $this->services['fos_comment.listener.comment_vote_score'] = new \FOS\CommentBundle\EventListener\CommentVoteScoreListener();
    }
    protected function getFosComment_Listener_ThreadCountersService()
    {
        return $this->services['fos_comment.listener.thread_counters'] = new \FOS\CommentBundle\EventListener\ThreadCountersListener($this->get('fos_comment.manager.comment.default'));
    }
    protected function getFosComment_Listener_ThreadPermalinkService()
    {
        return $this->services['fos_comment.listener.thread_permalink'] = new \FOS\CommentBundle\EventListener\ThreadPermalinkListener($this);
    }
    protected function getFosComment_Listener_VoteBlamerService()
    {
        return $this->services['fos_comment.listener.vote_blamer'] = new \FOS\CommentBundle\EventListener\VoteBlamerListener($this->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getFosComment_Manager_Comment_DefaultService()
    {
        return $this->services['fos_comment.manager.comment.default'] = new \FOS\CommentBundle\Entity\CommentManager($this->get('event_dispatcher'), $this->get('fos_comment.sorting_factory'), $this->get('fos_comment.entity_manager'), 'Application\\Sonata\\CommentBundle\\Entity\\Comment');
    }
    protected function getFosComment_Manager_Thread_DefaultService()
    {
        return $this->services['fos_comment.manager.thread.default'] = new \FOS\CommentBundle\Entity\ThreadManager($this->get('event_dispatcher'), $this->get('fos_comment.entity_manager'), 'Application\\Sonata\\CommentBundle\\Entity\\Thread');
    }
    protected function getFosComment_Manager_Vote_DefaultService()
    {
        return $this->services['fos_comment.manager.vote.default'] = new \FOS\CommentBundle\Entity\VoteManager($this->get('event_dispatcher'), $this->get('fos_comment.entity_manager'), 'FOS\\CommentBundle\\Entity\\Vote');
    }
    protected function getFosComment_SortingFactoryService()
    {
        return $this->services['fos_comment.sorting_factory'] = new \FOS\CommentBundle\Sorting\SortingFactory(array('date_asc' => new \FOS\CommentBundle\Sorting\DateSorting('ASC'), 'date_desc' => new \FOS\CommentBundle\Sorting\DateSorting('DESC')), 'date_desc');
    }
    protected function getFosRest_BodyListenerService()
    {
        $this->services['fos_rest.body_listener'] = $instance = new \FOS\RestBundle\EventListener\BodyListener($this->get('fos_rest.decoder_provider'), false);
        $instance->setDefaultFormat(NULL);
        return $instance;
    }
    protected function getFosRest_Controller_ExceptionService()
    {
        $this->services['fos_rest.controller.exception'] = $instance = new \FOS\RestBundle\Controller\ExceptionController();
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFosRest_Decoder_JsonService()
    {
        return $this->services['fos_rest.decoder.json'] = new \FOS\RestBundle\Decoder\JsonDecoder();
    }
    protected function getFosRest_Decoder_JsontoformService()
    {
        return $this->services['fos_rest.decoder.jsontoform'] = new \FOS\RestBundle\Decoder\JsonToFormDecoder();
    }
    protected function getFosRest_Decoder_XmlService()
    {
        return $this->services['fos_rest.decoder.xml'] = new \FOS\RestBundle\Decoder\XmlDecoder();
    }
    protected function getFosRest_DecoderProviderService()
    {
        $this->services['fos_rest.decoder_provider'] = $instance = new \FOS\RestBundle\Decoder\ContainerDecoderProvider(array('json' => 'fos_rest.decoder.json', 'xml' => 'fos_rest.decoder.xml'));
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFosRest_ExceptionFormatNegotiatorService()
    {
        return $this->services['fos_rest.exception_format_negotiator'] = new \FOS\RestBundle\Util\FormatNegotiator();
    }
    protected function getFosRest_ExceptionListenerService()
    {
        return $this->services['fos_rest.exception_listener'] = new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('fos_rest.controller.exception:showAction', $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getFosRest_FormatNegotiatorService()
    {
        return $this->services['fos_rest.format_negotiator'] = new \FOS\RestBundle\Util\FormatNegotiator();
    }
    protected function getFosRest_Inflector_DoctrineService()
    {
        return $this->services['fos_rest.inflector.doctrine'] = new \FOS\RestBundle\Util\Inflector\DoctrineInflector();
    }
    protected function getFosRest_Normalizer_CamelKeysService()
    {
        return $this->services['fos_rest.normalizer.camel_keys'] = new \FOS\RestBundle\Normalizer\CamelKeysNormalizer();
    }
    protected function getFosRest_ParamFetcherListenerService()
    {
        return $this->services['fos_rest.param_fetcher_listener'] = new \FOS\RestBundle\EventListener\ParamFetcherListener($this, false);
    }
    protected function getFosRest_Request_ParamFetcherService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_rest.request.param_fetcher', 'request');
        }
        return $this->services['fos_rest.request.param_fetcher'] = $this->scopedServices['request']['fos_rest.request.param_fetcher'] = new \FOS\RestBundle\Request\ParamFetcher($this->get('fos_rest.request.param_fetcher.reader'), $this->get('request'), $this->get('fos_rest.violation_formatter'), $this->get('validator', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getFosRest_Request_ParamFetcher_ReaderService()
    {
        return $this->services['fos_rest.request.param_fetcher.reader'] = new \FOS\RestBundle\Request\ParamReader($this->get('annotation_reader'));
    }
    protected function getFosRest_Routing_Loader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.controller'] = new \FOS\RestBundle\Routing\Loader\RestRouteLoader($this, $this->get('file_locator'), $this->get('controller_name_converter'), $this->get('fos_rest.routing.loader.reader.controller'), NULL);
    }
    protected function getFosRest_Routing_Loader_ProcessorService()
    {
        return $this->services['fos_rest.routing.loader.processor'] = new \FOS\RestBundle\Routing\Loader\RestRouteProcessor();
    }
    protected function getFosRest_Routing_Loader_Reader_ActionService()
    {
        return $this->services['fos_rest.routing.loader.reader.action'] = new \FOS\RestBundle\Routing\Loader\Reader\RestActionReader($this->get('annotation_reader'), $this->get('fos_rest.request.param_fetcher.reader'), $this->get('fos_rest.inflector.doctrine'), true, array('json' => false, 'xml' => false, 'html' => true));
    }
    protected function getFosRest_Routing_Loader_Reader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.reader.controller'] = new \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader($this->get('fos_rest.routing.loader.reader.action'), $this->get('annotation_reader'));
    }
    protected function getFosRest_Routing_Loader_XmlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.xml_collection'] = new \FOS\RestBundle\Routing\Loader\RestXmlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'), true, array('json' => false, 'xml' => false, 'html' => true), NULL);
    }
    protected function getFosRest_Routing_Loader_YamlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.yaml_collection'] = new \FOS\RestBundle\Routing\Loader\RestYamlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'), true, array('json' => false, 'xml' => false, 'html' => true), NULL);
    }
    protected function getFosRest_Serializer_ExceptionWrapperSerializeHandlerService()
    {
        return $this->services['fos_rest.serializer.exception_wrapper_serialize_handler'] = new \FOS\RestBundle\Serializer\ExceptionWrapperSerializeHandler();
    }
    protected function getFosRest_View_ExceptionWrapperHandlerService()
    {
        return $this->services['fos_rest.view.exception_wrapper_handler'] = new \FOS\RestBundle\View\ExceptionWrapperHandler();
    }
    protected function getFosRest_ViewHandlerService()
    {
        $this->services['fos_rest.view_handler'] = $instance = new \FOS\RestBundle\View\ViewHandler(array('json' => false, 'xml' => false, 'html' => true), 400, 204, false, array('html' => 302), 'twig');
        $instance->setExclusionStrategyGroups('');
        $instance->setExclusionStrategyVersion('');
        $instance->setSerializeNullStrategy(false);
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFosRest_ViewResponseListenerService()
    {
        return $this->services['fos_rest.view_response_listener'] = new \FOS\RestBundle\EventListener\ViewResponseListener($this);
    }
    protected function getFosRest_ViolationFormatterService()
    {
        return $this->services['fos_rest.violation_formatter'] = new \FOS\RestBundle\Util\ViolationFormatter();
    }
    protected function getFosUser_ChangePassword_FormService()
    {
        return $this->services['fos_user.change_password.form'] = $this->get('form.factory')->createNamed('fos_user_change_password_form', 'fos_user_change_password', NULL, array('validation_groups' => array(0 => 'ChangePassword', 1 => 'Default')));
    }
    protected function getFosUser_ChangePassword_Form_Handler_DefaultService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.change_password.form.handler.default', 'request');
        }
        return $this->services['fos_user.change_password.form.handler.default'] = $this->scopedServices['request']['fos_user.change_password.form.handler.default'] = new \FOS\UserBundle\Form\Handler\ChangePasswordFormHandler($this->get('fos_user.change_password.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }
    protected function getFosUser_ChangePassword_Form_TypeService()
    {
        return $this->services['fos_user.change_password.form.type'] = new \FOS\UserBundle\Form\Type\ChangePasswordFormType();
    }
    protected function getFosUser_Group_FormService()
    {
        return $this->services['fos_user.group.form'] = $this->get('form.factory')->createNamed('fos_user_group_form', 'fos_user_group', NULL, array('validation_groups' => array(0 => 'Registration', 1 => 'Default')));
    }
    protected function getFosUser_Group_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.group.form.handler', 'request');
        }
        return $this->services['fos_user.group.form.handler'] = $this->scopedServices['request']['fos_user.group.form.handler'] = new \FOS\UserBundle\Form\Handler\GroupFormHandler($this->get('fos_user.group.form'), $this->get('request'), $this->get('fos_user.group_manager'));
    }
    protected function getFosUser_Group_Form_TypeService()
    {
        return $this->services['fos_user.group.form.type'] = new \FOS\UserBundle\Form\Type\GroupFormType('Application\\Sonata\\UserBundle\\Entity\\Group');
    }
    protected function getFosUser_GroupManagerService()
    {
        return $this->services['fos_user.group_manager'] = new \Sonata\UserBundle\Entity\GroupManager($this->get('fos_user.entity_manager'), 'Application\\Sonata\\UserBundle\\Entity\\Group');
    }
    protected function getFosUser_MailerService()
    {
        return $this->services['fos_user.mailer'] = new \FOS\UserBundle\Mailer\Mailer($this->get('swiftmailer.mailer.default'), $this->get('cmf_routing.router'), $this->get('templating'), array('confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig', 'resetting.template' => 'FOSUserBundle:Resetting:email.txt.twig', 'from_email' => array('confirmation' => array('webmaster@example.com' => 'webmaster'), 'resetting' => array('webmaster@example.com' => 'webmaster'))));
    }
    protected function getFosUser_Profile_FormService()
    {
        return $this->services['fos_user.profile.form'] = $this->get('form.factory')->createNamed('fos_user_profile_form', 'fos_user_profile', NULL, array('validation_groups' => array(0 => 'Profile', 1 => 'Default')));
    }
    protected function getFosUser_Profile_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.profile.form.handler', 'request');
        }
        return $this->services['fos_user.profile.form.handler'] = $this->scopedServices['request']['fos_user.profile.form.handler'] = new \FOS\UserBundle\Form\Handler\ProfileFormHandler($this->get('fos_user.profile.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Profile_Form_TypeService()
    {
        return $this->services['fos_user.profile.form.type'] = new \FOS\UserBundle\Form\Type\ProfileFormType('Application\\Sonata\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Registration_FormService()
    {
        return $this->services['fos_user.registration.form'] = $this->get('form.factory')->createNamed('fos_user_registration_form', 'fos_user_registration', NULL, array('validation_groups' => array(0 => 'Registration', 1 => 'Default')));
    }
    protected function getFosUser_Registration_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.registration.form.handler', 'request');
        }
        return $this->services['fos_user.registration.form.handler'] = $this->scopedServices['request']['fos_user.registration.form.handler'] = new \FOS\UserBundle\Form\Handler\RegistrationFormHandler($this->get('fos_user.registration.form'), $this->get('request'), $this->get('fos_user.user_manager'), $this->get('fos_user.mailer'), $this->get('fos_user.util.token_generator'));
    }
    protected function getFosUser_Registration_Form_TypeService()
    {
        return $this->services['fos_user.registration.form.type'] = new \FOS\UserBundle\Form\Type\RegistrationFormType('Application\\Sonata\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Resetting_FormService()
    {
        return $this->services['fos_user.resetting.form'] = $this->get('form.factory')->createNamed('fos_user_resetting_form', 'fos_user_resetting', NULL, array('validation_groups' => array(0 => 'ResetPassword', 1 => 'Default')));
    }
    protected function getFosUser_Resetting_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.resetting.form.handler', 'request');
        }
        return $this->services['fos_user.resetting.form.handler'] = $this->scopedServices['request']['fos_user.resetting.form.handler'] = new \FOS\UserBundle\Form\Handler\ResettingFormHandler($this->get('fos_user.resetting.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Resetting_Form_TypeService()
    {
        return $this->services['fos_user.resetting.form.type'] = new \FOS\UserBundle\Form\Type\ResettingFormType();
    }
    protected function getFosUser_Security_InteractiveLoginListenerService()
    {
        return $this->services['fos_user.security.interactive_login_listener'] = new \FOS\UserBundle\Security\InteractiveLoginListener($this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Security_LoginManagerService()
    {
        return $this->services['fos_user.security.login_manager'] = new \FOS\UserBundle\Security\LoginManager($this->get('security.context'), $this->get('security.user_checker'), $this->get('security.authentication.session_strategy'), $this);
    }
    protected function getFosUser_UserManagerService()
    {
        $a = $this->get('fos_user.util.email_canonicalizer');
        return $this->services['fos_user.user_manager'] = new \Sonata\UserBundle\Entity\UserManager($this->get('security.encoder_factory'), $a, $a, $this->get('fos_user.entity_manager'), 'Application\\Sonata\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_UsernameFormTypeService()
    {
        return $this->services['fos_user.username_form_type'] = new \FOS\UserBundle\Form\Type\UsernameFormType(new \FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer($this->get('fos_user.user_manager')));
    }
    protected function getFosUser_Util_EmailCanonicalizerService()
    {
        return $this->services['fos_user.util.email_canonicalizer'] = new \FOS\UserBundle\Util\Canonicalizer();
    }
    protected function getFosUser_Util_TokenGeneratorService()
    {
        return $this->services['fos_user.util.token_generator'] = new \FOS\UserBundle\Util\TokenGenerator($this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getFosUser_Util_UserManipulatorService()
    {
        return $this->services['fos_user.util.user_manipulator'] = new \FOS\UserBundle\Util\UserManipulator($this->get('fos_user.user_manager'));
    }
    protected function getFragment_HandlerService()
    {
        $this->services['fragment.handler'] = $instance = new \Symfony\Component\HttpKernel\Fragment\FragmentHandler(array(), false, $this->get('request_stack'));
        $instance->addRenderer($this->get('fragment.renderer.inline'));
        $instance->addRenderer($this->get('fragment.renderer.hinclude'));
        $instance->addRenderer($this->get('fragment.renderer.esi'));
        $instance->addRenderer($this->get('fragment.renderer.ssi'));
        return $instance;
    }
    protected function getFragment_ListenerService()
    {
        return $this->services['fragment.listener'] = new \Symfony\Component\HttpKernel\EventListener\FragmentListener($this->get('uri_signer'), '/_fragment');
    }
    protected function getFragment_Renderer_EsiService()
    {
        $this->services['fragment.renderer.esi'] = $instance = new \Symfony\Component\HttpKernel\Fragment\EsiFragmentRenderer(NULL, $this->get('fragment.renderer.inline'), $this->get('uri_signer'));
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getFragment_Renderer_HincludeService()
    {
        $this->services['fragment.renderer.hinclude'] = $instance = new \Symfony\Bundle\FrameworkBundle\Fragment\ContainerAwareHIncludeFragmentRenderer($this, $this->get('uri_signer'), NULL);
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getFragment_Renderer_InlineService()
    {
        $this->services['fragment.renderer.inline'] = $instance = new \Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer($this->get('http_kernel'), $this->get('event_dispatcher'));
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getFragment_Renderer_SsiService()
    {
        $this->services['fragment.renderer.ssi'] = $instance = new \Symfony\Component\HttpKernel\Fragment\SsiFragmentRenderer(NULL, $this->get('fragment.renderer.inline'), $this->get('uri_signer'));
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel($this->get('event_dispatcher'), $this, new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, $this->get('controller_name_converter'), $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE)), $this->get('request_stack'));
    }
    protected function getIvoryCkEditor_ConfigManagerService()
    {
        $this->services['ivory_ck_editor.config_manager'] = $instance = new \Ivory\CKEditorBundle\Model\ConfigManager();
        $instance->setConfig('default', array('filebrowserBrowseRoute' => 'admin_sonata_media_media_ckeditor_browser', 'filebrowserImageBrowseRoute' => 'admin_sonata_media_media_ckeditor_browser', 'filebrowserImageBrowseRouteParameters' => array('provider' => 'sonata.media.provider.image'), 'filebrowserUploadRoute' => 'admin_sonata_media_media_ckeditor_upload', 'filebrowserUploadRouteParameters' => array('provider' => 'sonata.media.provider.file'), 'filebrowserImageUploadRoute' => 'admin_sonata_media_media_ckeditor_upload', 'filebrowserImageUploadRouteParameters' => array('provider' => 'sonata.media.provider.image', 'context' => 'default')));
        $instance->setConfig('news', array('filebrowserBrowseRoute' => 'admin_sonata_media_media_ckeditor_browser', 'filebrowserImageBrowseRoute' => 'admin_sonata_media_media_ckeditor_browser', 'filebrowserImageBrowseRouteParameters' => array('provider' => 'sonata.media.provider.image'), 'filebrowserUploadRoute' => 'admin_sonata_media_media_ckeditor_upload', 'filebrowserUploadRouteParameters' => array('provider' => 'sonata.media.provider.file'), 'filebrowserImageUploadRoute' => 'admin_sonata_media_media_ckeditor_upload', 'filebrowserImageUploadRouteParameters' => array('provider' => 'sonata.media.provider.image', 'context' => 'news')));
        $instance->setDefaultConfig('default');
        return $instance;
    }
    protected function getIvoryCkEditor_Form_TypeService()
    {
        return $this->services['ivory_ck_editor.form.type'] = new \Ivory\CKEditorBundle\Form\Type\CKEditorType(true, true, 'bundles/ivoryckeditor/', 'bundles/ivoryckeditor/ckeditor.js', $this->get('ivory_ck_editor.config_manager'), $this->get('ivory_ck_editor.plugin_manager'), $this->get('ivory_ck_editor.styles_set_manager'), $this->get('ivory_ck_editor.template_manager'));
    }
    protected function getIvoryCkEditor_PluginManagerService()
    {
        return $this->services['ivory_ck_editor.plugin_manager'] = new \Ivory\CKEditorBundle\Model\PluginManager();
    }
    protected function getIvoryCkEditor_StylesSetManagerService()
    {
        return $this->services['ivory_ck_editor.styles_set_manager'] = new \Ivory\CKEditorBundle\Model\StylesSetManager();
    }
    protected function getIvoryCkEditor_TemplateManagerService()
    {
        return $this->services['ivory_ck_editor.template_manager'] = new \Ivory\CKEditorBundle\Model\TemplateManager();
    }
    protected function getIvoryCkEditor_Templating_HelperService()
    {
        return $this->services['ivory_ck_editor.templating.helper'] = new \Ivory\CKEditorBundle\Templating\CKEditorHelper($this);
    }
    protected function getIvoryCkEditor_TwigExtensionService()
    {
        return $this->services['ivory_ck_editor.twig_extension'] = new \Ivory\CKEditorBundle\Twig\CKEditorExtension($this->get('ivory_ck_editor.templating.helper'));
    }
    protected function getJmsAop_InterceptorLoaderService()
    {
        return $this->services['jms_aop.interceptor_loader'] = new \JMS\AopBundle\Aop\InterceptorLoader($this, array());
    }
    protected function getJmsAop_PointcutContainerService()
    {
        return $this->services['jms_aop.pointcut_container'] = new \JMS\AopBundle\Aop\PointcutContainer(array('security.access.method_interceptor' => $this->get('security.access.pointcut')));
    }
    protected function getJmsSerializerService()
    {
        $a = new \JMS\Serializer\EventDispatcher\LazyEventDispatcher($this);
        $a->setListeners(array('serializer.pre_serialize' => array(0 => array(0 => array(0 => 'jms_serializer.doctrine_proxy_subscriber', 1 => 'onPreSerialize'), 1 => NULL, 2 => NULL))));
        return $this->services['jms_serializer'] = new \JMS\Serializer\Serializer($this->get('jms_serializer.metadata_factory'), $this->get('jms_serializer.handler_registry'), $this->get('jms_serializer.unserialize_object_constructor'), new \JMS\DiExtraBundle\DependencyInjection\Collection\LazyServiceMap($this, array('json' => 'jms_serializer.json_serialization_visitor', 'xml' => 'jms_serializer.xml_serialization_visitor', 'yml' => 'jms_serializer.yaml_serialization_visitor')), new \JMS\DiExtraBundle\DependencyInjection\Collection\LazyServiceMap($this, array('json' => 'jms_serializer.json_deserialization_visitor', 'xml' => 'jms_serializer.xml_deserialization_visitor')), $a);
    }
    protected function getJmsSerializer_ArrayCollectionHandlerService()
    {
        return $this->services['jms_serializer.array_collection_handler'] = new \JMS\Serializer\Handler\ArrayCollectionHandler();
    }
    protected function getJmsSerializer_ConstraintViolationHandlerService()
    {
        return $this->services['jms_serializer.constraint_violation_handler'] = new \JMS\Serializer\Handler\ConstraintViolationHandler();
    }
    protected function getJmsSerializer_DatetimeHandlerService()
    {
        return $this->services['jms_serializer.datetime_handler'] = new \JMS\Serializer\Handler\DateHandler('Y-m-d\\TH:i:sO', 'Europe/Moscow', true);
    }
    protected function getJmsSerializer_DoctrineProxySubscriberService()
    {
        return $this->services['jms_serializer.doctrine_proxy_subscriber'] = new \JMS\Serializer\EventDispatcher\Subscriber\DoctrineProxySubscriber();
    }
    protected function getJmsSerializer_FormErrorHandlerService()
    {
        return $this->services['jms_serializer.form_error_handler'] = new \JMS\Serializer\Handler\FormErrorHandler($this->get('translator.default'));
    }
    protected function getJmsSerializer_HandlerRegistryService()
    {
        return $this->services['jms_serializer.handler_registry'] = new \JMS\Serializer\Handler\LazyHandlerRegistry($this, array(1 => array('sonata_page_page_id' => array('json' => array(0 => 'sonata.page.serializer.handler.page', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.page.serializer.handler.page', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.page.serializer.handler.page', 1 => 'serializeObjectToId')), 'sonata_page_block_id' => array('json' => array(0 => 'sonata.page.serializer.handler.block', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.page.serializer.handler.block', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.page.serializer.handler.block', 1 => 'serializeObjectToId')), 'sonata_page_site_id' => array('json' => array(0 => 'sonata.page.serializer.handler.site', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.page.serializer.handler.site', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.page.serializer.handler.site', 1 => 'serializeObjectToId')), 'sonata_page_snapshot_id' => array('json' => array(0 => 'sonata.page.serializer.handler.snapshot', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.page.serializer.handler.snapshot', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.page.serializer.handler.snapshot', 1 => 'serializeObjectToId')), 'sonata_news_post_id' => array('json' => array(0 => 'sonata.news.serializer.handler.post', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.news.serializer.handler.post', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.news.serializer.handler.post', 1 => 'serializeObjectToId')), 'sonata_media_media_id' => array('json' => array(0 => 'sonata.media.serializer.handler.media', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.media.serializer.handler.media', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.media.serializer.handler.media', 1 => 'serializeObjectToId')), 'sonata_media_gallery_id' => array('json' => array(0 => 'sonata.media.serializer.handler.gallery', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.media.serializer.handler.gallery', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.media.serializer.handler.gallery', 1 => 'serializeObjectToId')), 'FOS\\RestBundle\\Util\\ExceptionWrapper' => array('json' => array(0 => 'fos_rest.serializer.exception_wrapper_serialize_handler', 1 => 'serializeToJson'), 'xml' => array(0 => 'fos_rest.serializer.exception_wrapper_serialize_handler', 1 => 'serializeToXml')), 'sonata_customer_customer_id' => array('json' => array(0 => 'sonata.customer.serializer.handler.customer', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.customer.serializer.handler.customer', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.customer.serializer.handler.customer', 1 => 'serializeObjectToId')), 'sonata_invoice_invoice_id' => array('json' => array(0 => 'sonata.invoice.serializer.handler', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.invoice.serializer.handler', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.invoice.serializer.handler', 1 => 'serializeObjectToId')), 'sonata_order_order_id' => array('json' => array(0 => 'sonata.order.serializer.handler.order', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.order.serializer.handler.order', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.order.serializer.handler.order', 1 => 'serializeObjectToId')), 'sonata_order_orderelement_id' => array('json' => array(0 => 'sonata.order.serializer.handler.order_element', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.order.serializer.handler.order_element', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.order.serializer.handler.order_element', 1 => 'serializeObjectToId')), 'sonata_product_product_id' => array('json' => array(0 => 'sonata.product.serializer.handler.product', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.product.serializer.handler.product', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.product.serializer.handler.product', 1 => 'serializeObjectToId')), 'DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime')), 'DateInterval' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ODM\\PHPCR\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap')), 'Symfony\\Component\\Form\\Form' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormTojson'), 'yml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormToyml')), 'Symfony\\Component\\Form\\FormError' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorTojson'), 'yml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorToyml')), 'Symfony\\Component\\Validator\\ConstraintViolationList' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToyml')), 'Symfony\\Component\\Validator\\ConstraintViolation' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToyml')), 'sonata_classification_category_id' => array('json' => array(0 => 'sonata.classification.serializer.handler.category', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.classification.serializer.handler.category', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.classification.serializer.handler.category', 1 => 'serializeObjectToId')), 'sonata_classification_collection_id' => array('json' => array(0 => 'sonata.classification.serializer.handler.collection', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.classification.serializer.handler.collection', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.classification.serializer.handler.collection', 1 => 'serializeObjectToId')), 'sonata_classification_tag_id' => array('json' => array(0 => 'sonata.classification.serializer.handler.tag', 1 => 'serializeObjectToId'), 'xml' => array(0 => 'sonata.classification.serializer.handler.tag', 1 => 'serializeObjectToId'), 'yml' => array(0 => 'sonata.classification.serializer.handler.tag', 1 => 'serializeObjectToId'))), 2 => array('sonata_page_page_id' => array('json' => array(0 => 'sonata.page.serializer.handler.page', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.page.serializer.handler.page', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.page.serializer.handler.page', 1 => 'deserializeObjectFromId')), 'sonata_page_block_id' => array('json' => array(0 => 'sonata.page.serializer.handler.block', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.page.serializer.handler.block', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.page.serializer.handler.block', 1 => 'deserializeObjectFromId')), 'sonata_page_site_id' => array('json' => array(0 => 'sonata.page.serializer.handler.site', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.page.serializer.handler.site', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.page.serializer.handler.site', 1 => 'deserializeObjectFromId')), 'sonata_page_snapshot_id' => array('json' => array(0 => 'sonata.page.serializer.handler.snapshot', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.page.serializer.handler.snapshot', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.page.serializer.handler.snapshot', 1 => 'deserializeObjectFromId')), 'sonata_news_post_id' => array('json' => array(0 => 'sonata.news.serializer.handler.post', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.news.serializer.handler.post', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.news.serializer.handler.post', 1 => 'deserializeObjectFromId')), 'sonata_media_media_id' => array('json' => array(0 => 'sonata.media.serializer.handler.media', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.media.serializer.handler.media', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.media.serializer.handler.media', 1 => 'deserializeObjectFromId')), 'sonata_media_gallery_id' => array('json' => array(0 => 'sonata.media.serializer.handler.gallery', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.media.serializer.handler.gallery', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.media.serializer.handler.gallery', 1 => 'deserializeObjectFromId')), 'sonata_customer_customer_id' => array('json' => array(0 => 'sonata.customer.serializer.handler.customer', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.customer.serializer.handler.customer', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.customer.serializer.handler.customer', 1 => 'deserializeObjectFromId')), 'sonata_invoice_invoice_id' => array('json' => array(0 => 'sonata.invoice.serializer.handler', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.invoice.serializer.handler', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.invoice.serializer.handler', 1 => 'deserializeObjectFromId')), 'sonata_order_order_id' => array('json' => array(0 => 'sonata.order.serializer.handler.order', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.order.serializer.handler.order', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.order.serializer.handler.order', 1 => 'deserializeObjectFromId')), 'sonata_order_orderelement_id' => array('json' => array(0 => 'sonata.order.serializer.handler.order_element', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.order.serializer.handler.order_element', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.order.serializer.handler.order_element', 1 => 'deserializeObjectFromId')), 'sonata_product_product_id' => array('json' => array(0 => 'sonata.product.serializer.handler.product', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.product.serializer.handler.product', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.product.serializer.handler.product', 1 => 'deserializeObjectFromId')), 'DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromjson'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromxml'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromyml')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ODM\\PHPCR\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap')), 'sonata_classification_category_id' => array('json' => array(0 => 'sonata.classification.serializer.handler.category', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.classification.serializer.handler.category', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.classification.serializer.handler.category', 1 => 'deserializeObjectFromId')), 'sonata_classification_collection_id' => array('json' => array(0 => 'sonata.classification.serializer.handler.collection', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.classification.serializer.handler.collection', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.classification.serializer.handler.collection', 1 => 'deserializeObjectFromId')), 'sonata_classification_tag_id' => array('json' => array(0 => 'sonata.classification.serializer.handler.tag', 1 => 'deserializeObjectFromId'), 'xml' => array(0 => 'sonata.classification.serializer.handler.tag', 1 => 'deserializeObjectFromId'), 'yml' => array(0 => 'sonata.classification.serializer.handler.tag', 1 => 'deserializeObjectFromId')))));
    }
    protected function getJmsSerializer_JsonDeserializationVisitorService()
    {
        return $this->services['jms_serializer.json_deserialization_visitor'] = new \JMS\Serializer\JsonDeserializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.unserialize_object_constructor'));
    }
    protected function getJmsSerializer_JsonSerializationVisitorService()
    {
        $this->services['jms_serializer.json_serialization_visitor'] = $instance = new \JMS\Serializer\JsonSerializationVisitor($this->get('jms_serializer.naming_strategy'));
        $instance->setOptions(0);
        return $instance;
    }
    protected function getJmsSerializer_MetadataDriverService()
    {
        $a = new \Metadata\Driver\FileLocator(array('Symfony\\Bundle\\FrameworkBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/config/serializer'), 'Symfony\\Bundle\\SecurityBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/SecurityBundle/Resources/config/serializer'), 'Symfony\\Bundle\\TwigBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/config/serializer'), 'Symfony\\Bundle\\MonologBundle' => ($this->targetDirs[3].'/vendor/symfony/monolog-bundle/Resources/config/serializer'), 'Symfony\\Bundle\\SwiftmailerBundle' => ($this->targetDirs[3].'/vendor/symfony/swiftmailer-bundle/Resources/config/serializer'), 'Sensio\\Bundle\\FrameworkExtraBundle' => ($this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Sensio/Bundle/FrameworkExtraBundle/Resources/config/serializer'), 'JMS\\AopBundle' => ($this->targetDirs[3].'/vendor/jms/aop-bundle/JMS/AopBundle/Resources/config/serializer'), 'JMS\\SecurityExtraBundle' => ($this->targetDirs[3].'/vendor/jms/security-extra-bundle/JMS/SecurityExtraBundle/Resources/config/serializer'), 'Symfony\\Bundle\\AsseticBundle' => ($this->targetDirs[3].'/vendor/symfony/assetic-bundle/Resources/config/serializer'), 'Doctrine\\Bundle\\DoctrineBundle' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Resources/config/serializer'), 'Doctrine\\Bundle\\MigrationsBundle' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-migrations-bundle/Doctrine/Bundle/MigrationsBundle/Resources/config/serializer'), 'Knp\\Bundle\\MenuBundle' => ($this->targetDirs[3].'/vendor/knplabs/knp-menu-bundle/Knp/Bundle/MenuBundle/Resources/config/serializer'), 'Knp\\Bundle\\MarkdownBundle' => ($this->targetDirs[3].'/vendor/knplabs/knp-markdown-bundle/Knp/Bundle/MarkdownBundle/Resources/config/serializer'), 'Knp\\Bundle\\PaginatorBundle' => ($this->targetDirs[3].'/vendor/knplabs/knp-paginator-bundle/Knp/Bundle/PaginatorBundle/Resources/config/serializer'), 'FOS\\UserBundle' => ($this->targetDirs[2].'/../vendor/sonata-project/user-bundle/Resources/config/serializer/FOSUserBundle'), 'Sonata\\UserBundle' => ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/config/serializer'), 'Application\\Sonata\\UserBundle' => ($this->targetDirs[3].'/src/Application/Sonata/UserBundle/Resources/config/serializer'), 'Sonata\\PageBundle' => ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/config/serializer'), 'Application\\Sonata\\PageBundle' => ($this->targetDirs[3].'/src/Application/Sonata/PageBundle/Resources/config/serializer'), 'Sonata\\NewsBundle' => ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/config/serializer'), 'Application\\Sonata\\NewsBundle' => ($this->targetDirs[3].'/src/Application/Sonata/NewsBundle/Resources/config/serializer'), 'Sonata\\MediaBundle' => ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/config/serializer'), 'Application\\Sonata\\MediaBundle' => ($this->targetDirs[3].'/src/Application/Sonata/MediaBundle/Resources/config/serializer'), 'Ivory\\CKEditorBundle' => ($this->targetDirs[3].'/vendor/egeloen/ckeditor-bundle/Resources/config/serializer'), 'Sonata\\AdminBundle' => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/config/serializer'), 'Sonata\\DoctrineORMAdminBundle' => ($this->targetDirs[3].'/vendor/sonata-project/doctrine-orm-admin-bundle/Resources/config/serializer'), 'SimpleThings\\EntityAudit' => ($this->targetDirs[3].'/vendor/simplethings/entity-audit-bundle/src/SimpleThings/EntityAudit/Resources/config/serializer'), 'FOS\\RestBundle' => ($this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/FOS/RestBundle/Resources/config/serializer'), 'Nelmio\\ApiDocBundle' => ($this->targetDirs[3].'/vendor/nelmio/api-doc-bundle/Nelmio/ApiDocBundle/Resources/config/serializer'), 'Sonata\\BasketBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/config/serializer'), 'Application\\Sonata\\BasketBundle' => ($this->targetDirs[3].'/src/Application/Sonata/BasketBundle/Resources/config/serializer'), 'Sonata\\CustomerBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/CustomerBundle/Resources/config/serializer'), 'Application\\Sonata\\CustomerBundle' => ($this->targetDirs[3].'/src/Application/Sonata/CustomerBundle/Resources/config/serializer'), 'Sonata\\DeliveryBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/DeliveryBundle/Resources/config/serializer'), 'Application\\Sonata\\DeliveryBundle' => ($this->targetDirs[3].'/src/Application/Sonata/DeliveryBundle/Resources/config/serializer'), 'Sonata\\InvoiceBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/InvoiceBundle/Resources/config/serializer'), 'Application\\Sonata\\InvoiceBundle' => ($this->targetDirs[3].'/src/Application/Sonata/InvoiceBundle/Resources/config/serializer'), 'Sonata\\OrderBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/OrderBundle/Resources/config/serializer'), 'Application\\Sonata\\OrderBundle' => ($this->targetDirs[3].'/src/Application/Sonata/OrderBundle/Resources/config/serializer'), 'Sonata\\PaymentBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/PaymentBundle/Resources/config/serializer'), 'Application\\Sonata\\PaymentBundle' => ($this->targetDirs[3].'/src/Application/Sonata/PaymentBundle/Resources/config/serializer'), 'Sonata\\ProductBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/config/serializer'), 'Application\\Sonata\\ProductBundle' => ($this->targetDirs[3].'/src/Application/Sonata/ProductBundle/Resources/config/serializer'), 'Sonata\\PriceBundle' => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/PriceBundle/Resources/config/serializer'), 'JMS\\SerializerBundle' => ($this->targetDirs[3].'/vendor/jms/serializer-bundle/JMS/SerializerBundle/Resources/config/serializer'), 'FOS\\CommentBundle' => ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/config/serializer'), 'Sonata\\CommentBundle' => ($this->targetDirs[3].'/vendor/sonata-project/comment-bundle/Resources/config/serializer'), 'Application\\Sonata\\CommentBundle' => ($this->targetDirs[3].'/src/Application/Sonata/CommentBundle/Resources/config/serializer'), 'Sonata\\EasyExtendsBundle' => ($this->targetDirs[3].'/vendor/sonata-project/easy-extends-bundle/Resources/config/serializer'), 'Sonata\\CoreBundle' => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/config/serializer'), 'Sonata\\IntlBundle' => ($this->targetDirs[3].'/vendor/sonata-project/intl-bundle/Resources/config/serializer'), 'Sonata\\FormatterBundle' => ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/config/serializer'), 'Sonata\\CacheBundle' => ($this->targetDirs[3].'/vendor/sonata-project/cache-bundle/Resources/config/serializer'), 'Sonata\\BlockBundle' => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/Resources/config/serializer'), 'Sonata\\SeoBundle' => ($this->targetDirs[3].'/vendor/sonata-project/seo-bundle/Resources/config/serializer'), 'Sonata\\ClassificationBundle' => ($this->targetDirs[3].'/vendor/sonata-project/classification-bundle/Resources/config/serializer'), 'Application\\Sonata\\ClassificationBundle' => ($this->targetDirs[3].'/src/Application/Sonata/ClassificationBundle/Resources/config/serializer'), 'Sonata\\NotificationBundle' => ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/config/serializer'), 'Application\\Sonata\\NotificationBundle' => ($this->targetDirs[3].'/src/Application/Sonata/NotificationBundle/Resources/config/serializer'), 'Application\\Sonata\\SeoBundle' => ($this->targetDirs[3].'/src/Application/Sonata/SeoBundle/Resources/config/serializer'), 'Sonata\\DatagridBundle' => ($this->targetDirs[2].'/../vendor/sonata-project/datagrid-bundle/Resources/config/serializer'), 'Symfony\\Cmf\\Bundle\\RoutingBundle' => ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/config/serializer'), 'Sonata\\Bundle\\DemoBundle' => ($this->targetDirs[3].'/src/Sonata/Bundle/DemoBundle/Resources/config/serializer'), 'Sonata\\Bundle\\QABundle' => ($this->targetDirs[3].'/src/Sonata/Bundle/QABundle/Resources/config/serializer'), 'Spy\\TimelineBundle' => ($this->targetDirs[3].'/vendor/stephpy/timeline-bundle/Resources/config/serializer'), 'Sonata\\TimelineBundle' => ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/config/serializer'), 'Application\\Sonata\\TimelineBundle' => ($this->targetDirs[3].'/src/Application/Sonata/TimelineBundle/Resources/config/serializer'), 'Mopa\\Bundle\\BootstrapBundle' => ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/config/serializer'), 'Symfony\\Bundle\\WebProfilerBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/config/serializer'), 'Sensio\\Bundle\\GeneratorBundle' => ($this->targetDirs[3].'/vendor/sensio/generator-bundle/Sensio/Bundle/GeneratorBundle/Resources/config/serializer'), 'Bazinga\\Bundle\\FakerBundle' => ($this->targetDirs[3].'/vendor/willdurand/faker-bundle/Bazinga/Bundle/FakerBundle/Resources/config/serializer'), 'Doctrine\\Bundle\\FixturesBundle' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-fixtures-bundle/Doctrine/Bundle/FixturesBundle/Resources/config/serializer'), 'Sonata\\Component\\Basket' => ($this->targetDirs[2].'/../vendor/sonata-project/ecommerce/src/BasketBundle/Resources/config/serializer/Component')));
        return $this->services['jms_serializer.metadata_driver'] = new \JMS\Serializer\Metadata\Driver\DoctrineTypeDriver(new \Metadata\Driver\DriverChain(array(0 => new \JMS\Serializer\Metadata\Driver\YamlDriver($a), 1 => new \JMS\Serializer\Metadata\Driver\XmlDriver($a), 2 => new \JMS\Serializer\Metadata\Driver\PhpDriver($a), 3 => new \JMS\Serializer\Metadata\Driver\AnnotationDriver($this->get('annotation_reader')))), $this->get('doctrine'));
    }
    protected function getJmsSerializer_NamingStrategyService()
    {
        return $this->services['jms_serializer.naming_strategy'] = new \JMS\Serializer\Naming\CacheNamingStrategy(new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(new \JMS\Serializer\Naming\CamelCaseNamingStrategy('_', true)));
    }
    protected function getJmsSerializer_ObjectConstructorService()
    {
        return $this->services['jms_serializer.object_constructor'] = new \JMS\Serializer\Construction\DoctrineObjectConstructor($this->get('doctrine'), $this->get('jms_serializer.unserialize_object_constructor'));
    }
    protected function getJmsSerializer_PhpCollectionHandlerService()
    {
        return $this->services['jms_serializer.php_collection_handler'] = new \JMS\Serializer\Handler\PhpCollectionHandler();
    }
    protected function getJmsSerializer_Templating_Helper_SerializerService()
    {
        return $this->services['jms_serializer.templating.helper.serializer'] = new \JMS\SerializerBundle\Templating\SerializerHelper($this->get('jms_serializer'));
    }
    protected function getJmsSerializer_XmlDeserializationVisitorService()
    {
        $this->services['jms_serializer.xml_deserialization_visitor'] = $instance = new \JMS\Serializer\XmlDeserializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.unserialize_object_constructor'));
        $instance->setDoctypeWhitelist(array());
        return $instance;
    }
    protected function getJmsSerializer_XmlSerializationVisitorService()
    {
        return $this->services['jms_serializer.xml_serialization_visitor'] = new \JMS\Serializer\XmlSerializationVisitor($this->get('jms_serializer.naming_strategy'));
    }
    protected function getJmsSerializer_YamlSerializationVisitorService()
    {
        return $this->services['jms_serializer.yaml_serialization_visitor'] = new \JMS\Serializer\YamlSerializationVisitor($this->get('jms_serializer.naming_strategy'));
    }
    protected function getKernelService()
    {
        throw new RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }
    protected function getKnpMenu_FactoryService()
    {
        $this->services['knp_menu.factory'] = $instance = new \Knp\Menu\MenuFactory();
        $instance->addExtension(new \Knp\Menu\Integration\Symfony\RoutingExtension($this->get('cmf_routing.router')), 0);
        return $instance;
    }
    protected function getKnpMenu_Listener_VotersService()
    {
        $this->services['knp_menu.listener.voters'] = $instance = new \Knp\Bundle\MenuBundle\EventListener\VoterInitializerListener();
        $instance->addVoter($this->get('knp_menu.voter.router'));
        return $instance;
    }
    protected function getKnpMenu_MatcherService()
    {
        $this->services['knp_menu.matcher'] = $instance = new \Knp\Menu\Matcher\Matcher();
        $instance->addVoter($this->get('knp_menu.voter.router'));
        return $instance;
    }
    protected function getKnpMenu_MenuProviderService()
    {
        return $this->services['knp_menu.menu_provider'] = new \Knp\Menu\Provider\ChainProvider(array(0 => new \Knp\Bundle\MenuBundle\Provider\ContainerAwareProvider($this, array()), 1 => new \Knp\Bundle\MenuBundle\Provider\BuilderAliasProvider($this->get('kernel'), $this, $this->get('knp_menu.factory'))));
    }
    protected function getKnpMenu_Renderer_ListService()
    {
        return $this->services['knp_menu.renderer.list'] = new \Knp\Menu\Renderer\ListRenderer($this->get('knp_menu.matcher'), array(), 'UTF-8');
    }
    protected function getKnpMenu_Renderer_TwigService()
    {
        return $this->services['knp_menu.renderer.twig'] = new \Knp\Menu\Renderer\TwigRenderer($this->get('twig'), 'knp_menu.html.twig', $this->get('knp_menu.matcher'), array());
    }
    protected function getKnpMenu_RendererProviderService()
    {
        return $this->services['knp_menu.renderer_provider'] = new \Knp\Bundle\MenuBundle\Renderer\ContainerAwareProvider($this, 'twig', array('list' => 'knp_menu.renderer.list', 'twig' => 'knp_menu.renderer.twig'));
    }
    protected function getKnpMenu_Voter_RouterService()
    {
        return $this->services['knp_menu.voter.router'] = new \Knp\Menu\Matcher\Voter\RouteVoter();
    }
    protected function getKnpPaginatorService()
    {
        $this->services['knp_paginator'] = $instance = new \Knp\Component\Pager\Paginator($this->get('event_dispatcher'));
        $instance->setDefaultPaginatorOptions(array('pageParameterName' => 'page', 'sortFieldParameterName' => 'sort', 'sortDirectionParameterName' => 'direction', 'filterFieldParameterName' => 'filterField', 'filterValueParameterName' => 'filterValue', 'distinct' => true));
        return $instance;
    }
    protected function getKnpPaginator_Helper_ProcessorService()
    {
        return $this->services['knp_paginator.helper.processor'] = new \Knp\Bundle\PaginatorBundle\Helper\Processor($this->get('templating.helper.router'), $this->get('translator.default'));
    }
    protected function getKnpPaginator_Subscriber_FiltrationService()
    {
        return $this->services['knp_paginator.subscriber.filtration'] = new \Knp\Component\Pager\Event\Subscriber\Filtration\FiltrationSubscriber();
    }
    protected function getKnpPaginator_Subscriber_PaginateService()
    {
        return $this->services['knp_paginator.subscriber.paginate'] = new \Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber();
    }
    protected function getKnpPaginator_Subscriber_SlidingPaginationService()
    {
        return $this->services['knp_paginator.subscriber.sliding_pagination'] = new \Knp\Bundle\PaginatorBundle\Subscriber\SlidingPaginationSubscriber(array('defaultPaginationTemplate' => 'MopaBootstrapBundle:Pagination:sliding.html.twig', 'defaultSortableTemplate' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig', 'defaultFiltrationTemplate' => 'KnpPaginatorBundle:Pagination:filtration.html.twig', 'defaultPageRange' => 5));
    }
    protected function getKnpPaginator_Subscriber_SortableService()
    {
        return $this->services['knp_paginator.subscriber.sortable'] = new \Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber();
    }
    protected function getKnpPaginator_Templating_Helper_PaginationService()
    {
        return $this->services['knp_paginator.templating.helper.pagination'] = new \Knp\Bundle\PaginatorBundle\Templating\PaginationHelper($this->get('knp_paginator.helper.processor'), $this->get('templating.engine.php'));
    }
    protected function getKnpPaginator_Twig_Extension_PaginationService()
    {
        return $this->services['knp_paginator.twig.extension.pagination'] = new \Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension($this->get('knp_paginator.helper.processor'));
    }
    protected function getLocaleListenerService()
    {
        return $this->services['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener('en', $this->get('cmf_routing.router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('request_stack'));
    }
    protected function getLoggerService()
    {
        $this->services['logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMarkdown_ParserService()
    {
        return $this->services['markdown.parser'] = new \Knp\Bundle\MarkdownBundle\Parser\Preset\Max();
    }
    protected function getMonolog_Handler_MainService()
    {
        return $this->services['monolog.handler.main'] = new \Monolog\Handler\StreamHandler(($this->targetDirs[2].'/logs/app_dev.log'), 100, true, NULL);
    }
    protected function getMonolog_Logger_AsseticService()
    {
        $this->services['monolog.logger.assetic'] = $instance = new \Symfony\Bridge\Monolog\Logger('assetic');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_DoctrineService()
    {
        $this->services['monolog.logger.doctrine'] = $instance = new \Symfony\Bridge\Monolog\Logger('doctrine');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_PhpService()
    {
        $this->services['monolog.logger.php'] = $instance = new \Symfony\Bridge\Monolog\Logger('php');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_ProfilerService()
    {
        $this->services['monolog.logger.profiler'] = $instance = new \Symfony\Bridge\Monolog\Logger('profiler');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_RequestService()
    {
        $this->services['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_RouterService()
    {
        $this->services['monolog.logger.router'] = $instance = new \Symfony\Bridge\Monolog\Logger('router');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_SecurityService()
    {
        $this->services['monolog.logger.security'] = $instance = new \Symfony\Bridge\Monolog\Logger('security');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_TranslationService()
    {
        $this->services['monolog.logger.translation'] = $instance = new \Symfony\Bridge\Monolog\Logger('translation');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMopaBootstrap_Form_Type_TabService()
    {
        return $this->services['mopa_bootstrap.form.type.tab'] = new \Mopa\Bundle\BootstrapBundle\Form\Type\TabType();
    }
    protected function getMopaBootstrap_Form_TypeExtension_ButtonService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.button'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\IconButtonExtension();
    }
    protected function getMopaBootstrap_Form_TypeExtension_DateService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.date'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\DateTypeExtension();
    }
    protected function getMopaBootstrap_Form_TypeExtension_ErrorService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.error'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\ErrorTypeFormTypeExtension(array('error_type' => NULL));
    }
    protected function getMopaBootstrap_Form_TypeExtension_HelpService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.help'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\HelpFormTypeExtension(array('help_label_tooltip' => array('title' => NULL, 'text' => NULL, 'icon' => 'info-sign', 'placement' => 'top'), 'help_label_popover' => array('title' => NULL, 'content' => NULL, 'text' => NULL, 'icon' => 'info-sign', 'placement' => 'top'), 'help_widget_popover' => array('title' => NULL, 'content' => NULL, 'trigger' => 'hover', 'toggle' => 'popover', 'placement' => 'right')));
    }
    protected function getMopaBootstrap_Form_TypeExtension_HorizontalService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.horizontal'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\HorizontalFormTypeExtension(array('horizontal_label_class' => 'col-lg-3 control-label', 'horizontal_label_offset_class' => 'col-lg-offset-3', 'horizontal_input_wrapper_class' => 'col-lg-9'));
    }
    protected function getMopaBootstrap_Form_TypeExtension_LegendService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.legend'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\LegendFormTypeExtension(array('render_fieldset' => true, 'show_legend' => false, 'show_child_legend' => false, 'render_required_asterisk' => true, 'render_optional_text' => false));
    }
    protected function getMopaBootstrap_Form_TypeExtension_TabbedService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.tabbed'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\TabbedFormTypeExtension($this->get('form.factory'), array('class' => 'nav nav-tabs'));
    }
    protected function getMopaBootstrap_Form_TypeExtension_WidgetService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.widget'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\WidgetFormTypeExtension(array('checkbox_label' => 'both'));
    }
    protected function getMopaBootstrap_Form_TypeExtension_WidgetCollectionService()
    {
        return $this->services['mopa_bootstrap.form.type_extension.widget_collection'] = new \Mopa\Bundle\BootstrapBundle\Form\Extension\WidgetCollectionFormTypeExtension(array('render_collection_item' => true, 'widget_add_btn' => array('attr' => array('class' => 'btn btn-default'), 'label' => 'add_item', 'icon' => NULL, 'icon_color' => NULL), 'widget_remove_btn' => array('attr' => array('class' => 'btn btn-default'), 'label' => 'remove_item', 'icon' => NULL, 'icon_color' => NULL)));
    }
    protected function getMopaBootstrap_Twig_Extension_BootstrapFormService()
    {
        return $this->services['mopa_bootstrap.twig.extension.bootstrap_form'] = new \Mopa\Bundle\BootstrapBundle\Twig\FormExtension();
    }
    protected function getMopaBootstrap_Twig_Extension_BootstrapIconService()
    {
        return $this->services['mopa_bootstrap.twig.extension.bootstrap_icon'] = new \Mopa\Bundle\BootstrapBundle\Twig\IconExtension('glyphicons', 'icon');
    }
    protected function getNelmioApiDoc_DocCommentExtractorService()
    {
        return $this->services['nelmio_api_doc.doc_comment_extractor'] = new \Nelmio\ApiDocBundle\Util\DocCommentExtractor();
    }
    protected function getNelmioApiDoc_EventListener_RequestService()
    {
        return $this->services['nelmio_api_doc.event_listener.request'] = new \Nelmio\ApiDocBundle\EventListener\RequestListener($this->get('nelmio_api_doc.extractor.api_doc_extractor'), $this->get('nelmio_api_doc.formatter.html_formatter'), '_doc');
    }
    protected function getNelmioApiDoc_Extractor_ApiDocExtractorService()
    {
        $a = $this->get('nelmio_api_doc.doc_comment_extractor');
        $this->services['nelmio_api_doc.extractor.api_doc_extractor'] = $instance = new \Nelmio\ApiDocBundle\Extractor\ApiDocExtractor($this, $this->get('cmf_routing.router'), $this->get('annotation_reader'), $a, array(0 => new \Nelmio\ApiDocBundle\Extractor\Handler\FosRestHandler(), 1 => new \Nelmio\ApiDocBundle\Extractor\Handler\JmsSecurityExtraHandler(), 2 => new \Nelmio\ApiDocBundle\Extractor\Handler\SensioFrameworkExtraHandler(), 3 => new \Nelmio\ApiDocBundle\Extractor\Handler\PhpDocHandler($a)));
        $instance->addParser($this->get('nelmio_api_doc.parser.collection_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.form_errors_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.form_type_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.validation_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.jms_metadata_parser'));
        return $instance;
    }
    protected function getNelmioApiDoc_Form_Extension_DescriptionFormTypeExtensionService()
    {
        return $this->services['nelmio_api_doc.form.extension.description_form_type_extension'] = new \Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension();
    }
    protected function getNelmioApiDoc_Formatter_HtmlFormatterService()
    {
        $this->services['nelmio_api_doc.formatter.html_formatter'] = $instance = new \Nelmio\ApiDocBundle\Formatter\HtmlFormatter();
        $instance->setTemplatingEngine($this->get('templating'));
        $instance->setMotdTemplate('NelmioApiDocBundle::Components/motd.html.twig');
        $instance->setApiName('API documentation');
        $instance->setEnableSandbox(true);
        $instance->setEndpoint(NULL);
        $instance->setRequestFormatMethod('format_param');
        $instance->setRequestFormats(array('json' => 'application/json', 'xml' => 'application/xml'));
        $instance->setDefaultRequestFormat('json');
        $instance->setAcceptType(NULL);
        $instance->setBodyFormats(array(0 => 'form', 1 => 'json'));
        $instance->setDefaultBodyFormat('form');
        $instance->setAuthentication(NULL);
        $instance->setDefaultSectionsOpened(true);
        return $instance;
    }
    protected function getNelmioApiDoc_Formatter_MarkdownFormatterService()
    {
        return $this->services['nelmio_api_doc.formatter.markdown_formatter'] = new \Nelmio\ApiDocBundle\Formatter\MarkdownFormatter();
    }
    protected function getNelmioApiDoc_Formatter_SimpleFormatterService()
    {
        return $this->services['nelmio_api_doc.formatter.simple_formatter'] = new \Nelmio\ApiDocBundle\Formatter\SimpleFormatter();
    }
    protected function getNelmioApiDoc_Formatter_SwaggerFormatterService()
    {
        $this->services['nelmio_api_doc.formatter.swagger_formatter'] = $instance = new \Nelmio\ApiDocBundle\Formatter\SwaggerFormatter('dot_notation');
        $instance->setBasePath('/api');
        $instance->setApiVersion('0.1');
        $instance->setSwaggerVersion('1.2');
        $instance->setInfo(array('title' => 'Symfony2', 'description' => 'My awesome Symfony2 app!', 'TermsOfServiceUrl' => NULL, 'contact' => NULL, 'license' => NULL, 'licenseUrl' => NULL));
        return $instance;
    }
    protected function getNelmioApiDoc_Parser_CollectionParserService()
    {
        return $this->services['nelmio_api_doc.parser.collection_parser'] = new \Nelmio\ApiDocBundle\Parser\CollectionParser();
    }
    protected function getNelmioApiDoc_Parser_FormErrorsParserService()
    {
        return $this->services['nelmio_api_doc.parser.form_errors_parser'] = new \Nelmio\ApiDocBundle\Parser\FormErrorsParser();
    }
    protected function getNelmioApiDoc_Parser_FormTypeParserService()
    {
        return $this->services['nelmio_api_doc.parser.form_type_parser'] = new \Nelmio\ApiDocBundle\Parser\FormTypeParser($this->get('form.factory'));
    }
    protected function getNelmioApiDoc_Parser_JmsMetadataParserService()
    {
        return $this->services['nelmio_api_doc.parser.jms_metadata_parser'] = new \Nelmio\ApiDocBundle\Parser\JmsMetadataParser($this->get('jms_serializer.metadata_factory'), $this->get('jms_serializer.naming_strategy'), $this->get('nelmio_api_doc.doc_comment_extractor'));
    }
    protected function getNelmioApiDoc_Parser_ValidationParserService()
    {
        return $this->services['nelmio_api_doc.parser.validation_parser'] = new \Nelmio\ApiDocBundle\Parser\ValidationParser($this->get('validator'));
    }
    protected function getNelmioApiDoc_Twig_Extension_ExtraMarkdownService()
    {
        return $this->services['nelmio_api_doc.twig.extension.extra_markdown'] = new \Nelmio\ApiDocBundle\Twig\Extension\MarkdownExtension();
    }
    protected function getProfilerService()
    {
        $a = $this->get('monolog.logger.profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $b = $this->get('kernel', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $c = new \Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector();
        if ($this->has('kernel')) {
            $c->setKernel($b);
        }
        $this->services['profiler'] = $instance = new \Symfony\Component\HttpKernel\Profiler\Profiler(new \Symfony\Component\HttpKernel\Profiler\FileProfilerStorage(('file:'.__DIR__.'/profiler'), '', '', 86400), $a);
        $instance->add($c);
        $instance->add($this->get('data_collector.request'));
        $instance->add(new \Symfony\Bundle\FrameworkBundle\DataCollector\AjaxDataCollector());
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\ExceptionDataCollector());
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\EventDataCollector($this->get('event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector($a));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\TimeDataCollector($b, $this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\MemoryDataCollector());
        $instance->add($this->get('data_collector.router'));
        $instance->add($this->get('data_collector.form'));
        $instance->add(new \Symfony\Bundle\SecurityBundle\DataCollector\SecurityDataCollector($this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->add(new \Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector($this));
        $instance->add(new \Doctrine\Bundle\DoctrineBundle\DataCollector\DoctrineDataCollector($this->get('doctrine')));
        $instance->add(new \Sonata\BlockBundle\Profiler\DataCollector\BlockDataCollector($this->get('sonata.block.templating.helper'), array(0 => 'sonata.block.service.container', 1 => 'sonata.page.block.container', 2 => 'cmf.block.container', 3 => 'cmf.block.slideshow')));
        return $instance;
    }
    protected function getProfilerListenerService()
    {
        return $this->services['profiler_listener'] = new \Symfony\Component\HttpKernel\EventListener\ProfilerListener($this->get('profiler'), NULL, false, false, $this->get('request_stack'));
    }
    protected function getPropertyAccessorService()
    {
        return $this->services['property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false);
    }
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }
        throw new RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }
    protected function getRequestStackService()
    {
        return $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack();
    }
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }
    protected function getRouter_RequestContextService()
    {
        return $this->services['router.request_context'] = $this->get('sonata.page.site.selector.host_with_path')->getRequestContext();
    }
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($this->get('cmf_routing.router'), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('request_stack'));
    }
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');
        $b = $this->get('annotation_reader');
        $c = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);
        $d = new \Symfony\Component\Config\Loader\LoaderResolver();
        $d->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $c));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $c));
        $d->addLoader($c);
        $d->addLoader($this->get('sonata.admin.route_loader'));
        $d->addLoader($this->get('fos_rest.routing.loader.controller'));
        $d->addLoader($this->get('fos_rest.routing.loader.yaml_collection'));
        $d->addLoader($this->get('fos_rest.routing.loader.xml_collection'));
        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), $this->get('monolog.logger.router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $d);
    }
    protected function getSecurity_Access_DecisionManagerService()
    {
        $a = $this->get('security.role_hierarchy');
        $b = $this->get('security.authentication.trust_resolver');
        return $this->services['security.access.decision_manager'] = new \JMS\SecurityExtraBundle\Security\Authorization\RememberingAccessDecisionManager(new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(array(0 => new \Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter($a), 1 => new \Symfony\Component\Security\Core\Authorization\Voter\ExpressionVoter(new \Symfony\Component\Security\Core\Authorization\ExpressionLanguage(), $b, $a), 2 => new \Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter($b), 3 => new \JMS\SecurityExtraBundle\Security\Acl\Voter\AclVoter($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map'), $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE), true)), 'affirmative', false, true));
    }
    protected function getSecurity_Access_MethodInterceptorService()
    {
        return $this->services['security.access.method_interceptor'] = new \JMS\SecurityExtraBundle\Security\Authorization\Interception\MethodSecurityInterceptor($this->get('security.context'), $this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AfterInvocationManager(array(0 => new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AclAfterInvocationProvider($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map')))), new \JMS\SecurityExtraBundle\Security\Authorization\RunAsManager('RunAsToken', 'ROLE_'), $this->get('security.extra.metadata_factory'), $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_Access_PointcutService()
    {
        $this->services['security.access.pointcut'] = $instance = new \JMS\SecurityExtraBundle\Security\Authorization\Interception\SecurityPointcut($this->get('security.extra.metadata_factory'), false, array());
        $instance->setSecuredClasses(array());
        return $instance;
    }
    protected function getSecurity_Acl_Dbal_SchemaService()
    {
        return $this->services['security.acl.dbal.schema'] = new \Symfony\Component\Security\Acl\Dbal\Schema(array('class_table_name' => 'acl_classes', 'entry_table_name' => 'acl_entries', 'oid_table_name' => 'acl_object_identities', 'oid_ancestors_table_name' => 'acl_object_identity_ancestors', 'sid_table_name' => 'acl_security_identities'), $this->get('doctrine.dbal.default_connection'));
    }
    protected function getSecurity_Acl_Dbal_SchemaListenerService()
    {
        return $this->services['security.acl.dbal.schema_listener'] = new \Symfony\Bundle\SecurityBundle\EventListener\AclSchemaListener($this->get('security.acl.dbal.schema'));
    }
    protected function getSecurity_Acl_ProviderService()
    {
        return $this->services['security.acl.provider'] = new \Symfony\Component\Security\Acl\Dbal\MutableAclProvider($this->get('doctrine.dbal.default_connection'), new \Symfony\Component\Security\Acl\Domain\PermissionGrantingStrategy(), array('class_table_name' => 'acl_classes', 'entry_table_name' => 'acl_entries', 'oid_table_name' => 'acl_object_identities', 'oid_ancestors_table_name' => 'acl_object_identity_ancestors', 'sid_table_name' => 'acl_security_identities'), NULL);
    }
    protected function getSecurity_AuthenticationUtilsService()
    {
        return $this->services['security.authentication_utils'] = new \Symfony\Component\Security\Http\Authentication\AuthenticationUtils($this->get('request_stack'));
    }
    protected function getSecurity_AuthorizationCheckerService()
    {
        return $this->services['security.authorization_checker'] = new \Symfony\Component\Security\Core\Authorization\AuthorizationChecker($this->get('security.token_storage'), $this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), false);
    }
    protected function getSecurity_ContextService()
    {
        return $this->services['security.context'] = new \Symfony\Component\Security\Core\SecurityContext($this->get('security.token_storage'), $this->get('security.authorization_checker'));
    }
    protected function getSecurity_Csrf_TokenManagerService()
    {
        return $this->services['security.csrf.token_manager'] = new \Symfony\Component\Security\Csrf\CsrfTokenManager(new \Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator($this->get('security.secure_random')), new \Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage($this->get('session')));
    }
    protected function getSecurity_EncoderFactoryService()
    {
        return $this->services['security.encoder_factory'] = new \Symfony\Component\Security\Core\Encoder\EncoderFactory(array('Application\\Sonata\\UserBundle\\Entity\\User' => array('class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder', 'arguments' => array(0 => 'sha512', 1 => false, 2 => 1)), 'Symfony\\Component\\Security\\Core\\User\\User' => array('class' => 'Symfony\\Component\\Security\\Core\\Encoder\\PlaintextPasswordEncoder', 'arguments' => array(0 => false))));
    }
    protected function getSecurity_Extra_MetadataDriverService()
    {
        return $this->services['security.extra.metadata_driver'] = new \Metadata\Driver\DriverChain(array(0 => new \JMS\SecurityExtraBundle\Metadata\Driver\AnnotationDriver($this->get('annotation_reader'))));
    }
    protected function getSecurity_FirewallService()
    {
        return $this->services['security.firewall'] = new \Symfony\Component\Security\Http\Firewall(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap($this, array('security.firewall.map.context.dev' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/(_(profiler|wdt)|css|images|js|admin/_(wdt|profiler)|api/_(wdt|profiler))/'), 'security.firewall.map.context.admin' => new \Symfony\Component\HttpFoundation\RequestMatcher('/admin(.*)'), 'security.firewall.map.context.api' => new \Symfony\Component\HttpFoundation\RequestMatcher('/api/(.*)'), 'security.firewall.map.context.main' => new \Symfony\Component\HttpFoundation\RequestMatcher('.*'))), $this->get('event_dispatcher'));
    }
    protected function getSecurity_Firewall_Map_Context_AdminService()
    {
        $a = $this->get('security.http_utils');
        $b = $this->get('security.context');
        $c = $this->get('http_kernel');
        $d = $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $e = $this->get('security.authentication.manager');
        $f = new \Symfony\Component\Security\Http\Firewall\LogoutListener($b, $a, new \Symfony\Component\Security\Http\Logout\DefaultLogoutSuccessHandler($a, '/'), array('csrf_parameter' => '_csrf_token', 'intention' => 'logout', 'logout_path' => '/admin/logout'));
        $f->addHandler(new \Symfony\Component\Security\Http\Logout\SessionLogoutHandler());
        $g = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler($a, array());
        $g->setOptions(array('login_path' => '/admin/login', 'always_use_default_target_path' => false, 'default_target_path' => '/', 'target_path_parameter' => '_target_path', 'use_referer' => false));
        $g->setProviderKey('admin');
        $h = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler($c, $a, array(), $d);
        $h->setOptions(array('login_path' => '/admin/login', 'failure_path' => NULL, 'failure_forward' => false, 'failure_path_parameter' => '_failure_path'));
        return $this->services['security.firewall.map.context.admin'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => $this->get('security.context_listener.0'), 2 => $f, 3 => new \Symfony\Component\Security\Http\Firewall\UsernamePasswordFormAuthenticationListener($b, $e, $this->get('security.authentication.session_strategy'), $a, 'admin', $g, $h, array('use_forward' => false, 'check_path' => '/admin/login_check', 'require_previous_session' => true, 'username_parameter' => '_username', 'password_parameter' => '_password', 'csrf_parameter' => '_csrf_token', 'intention' => 'authenticate', 'post_only' => true), $d, $this->get('event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE), NULL), 4 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($b, '58b3fe9ce3baa', $d, $e), 5 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($b, $this->get('security.authentication.trust_resolver'), $a, 'admin', new \Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint($c, $a, '/admin/login', false), NULL, NULL, $d));
    }
    protected function getSecurity_Firewall_Map_Context_ApiService()
    {
        $a = $this->get('security.context');
        $b = $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $c = new \Symfony\Component\Security\Http\EntryPoint\BasicAuthenticationEntryPoint('Secured Demo Area');
        return $this->services['security.firewall.map.context.api'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => new \Symfony\Component\Security\Http\Firewall\BasicAuthenticationListener($a, $this->get('security.authentication.manager'), 'api', $c, $b), 2 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $this->get('security.http_utils'), 'api', $c, NULL, NULL, $b));
    }
    protected function getSecurity_Firewall_Map_Context_DevService()
    {
        return $this->services['security.firewall.map.context.dev'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL);
    }
    protected function getSecurity_Firewall_Map_Context_MainService()
    {
        $a = $this->get('security.http_utils');
        $b = $this->get('security.context');
        $c = $this->get('http_kernel');
        $d = $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $e = $this->get('security.authentication.manager');
        $f = new \Symfony\Component\Security\Http\Firewall\LogoutListener($b, $a, new \Symfony\Component\Security\Http\Logout\DefaultLogoutSuccessHandler($a, '/'), array('csrf_parameter' => '_csrf_token', 'intention' => 'logout', 'logout_path' => '/logout'));
        $f->addHandler($this->get('sonata.page.cms_manager_selector'));
        $f->addHandler($this->get('sonata.basket.entity.factory'));
        $g = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler($a, array());
        $g->setOptions(array('login_path' => '/login', 'always_use_default_target_path' => false, 'default_target_path' => '/', 'target_path_parameter' => '_target_path', 'use_referer' => false));
        $g->setProviderKey('main');
        $h = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler($c, $a, array(), $d);
        $h->setOptions(array('login_path' => '/login', 'failure_path' => NULL, 'failure_forward' => false, 'failure_path_parameter' => '_failure_path'));
        return $this->services['security.firewall.map.context.main'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => $this->get('security.context_listener.0'), 2 => $f, 3 => new \Symfony\Component\Security\Http\Firewall\UsernamePasswordFormAuthenticationListener($b, $e, $this->get('security.authentication.session_strategy'), $a, 'main', $g, $h, array('use_forward' => false, 'check_path' => '/login_check', 'require_previous_session' => true, 'username_parameter' => '_username', 'password_parameter' => '_password', 'csrf_parameter' => '_csrf_token', 'intention' => 'authenticate', 'post_only' => true), $d, $this->get('event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE), NULL), 4 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($b, '58b3fe9ce3baa', $d, $e), 5 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($b, $this->get('security.authentication.trust_resolver'), $a, 'main', new \Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint($c, $a, '/login', false), NULL, NULL, $d));
    }
    protected function getSecurity_PasswordEncoderService()
    {
        return $this->services['security.password_encoder'] = new \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder($this->get('security.encoder_factory'));
    }
    protected function getSecurity_Rememberme_ResponseListenerService()
    {
        return $this->services['security.rememberme.response_listener'] = new \Symfony\Component\Security\Http\RememberMe\ResponseListener();
    }
    protected function getSecurity_RoleHierarchyService()
    {
        return $this->services['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy(array('ROLE_ADMIN' => array(0 => 'ROLE_USER'), 'ROLE_SUPER_ADMIN' => array(0 => 'ROLE_USER', 1 => 'ROLE_SONATA_ADMIN', 2 => 'ROLE_ADMIN', 3 => 'ROLE_ALLOWED_TO_SWITCH', 4 => 'ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT', 5 => 'ROLE_SONATA_PAGE_ADMIN_BLOCK_EDIT'), 'SONATA' => array()));
    }
    protected function getSecurity_SecureRandomService()
    {
        return $this->services['security.secure_random'] = new \Symfony\Component\Security\Core\Util\SecureRandom((__DIR__.'/secure_random.seed'), $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_TokenStorageService()
    {
        return $this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage();
    }
    protected function getSecurity_Validator_UserPasswordService()
    {
        return $this->services['security.validator.user_password'] = new \Symfony\Component\Security\Core\Validator\Constraints\UserPasswordValidator($this->get('security.context'), $this->get('security.encoder_factory'));
    }
    protected function getSensioFrameworkExtra_Cache_ListenerService()
    {
        return $this->services['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\CacheListener();
    }
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->services['sensio_framework_extra.controller.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener($this->get('annotation_reader'));
    }
    protected function getSensioFrameworkExtra_Converter_DatetimeService()
    {
        return $this->services['sensio_framework_extra.converter.datetime'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter();
    }
    protected function getSensioFrameworkExtra_Converter_Doctrine_OrmService()
    {
        return $this->services['sensio_framework_extra.converter.doctrine.orm'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        return $this->services['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($this->get('sensio_framework_extra.converter.manager'));
    }
    protected function getSensioFrameworkExtra_Converter_ManagerService()
    {
        $this->services['sensio_framework_extra.converter.manager'] = $instance = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();
        $instance->add($this->get('sensio_framework_extra.converter.doctrine.orm'), 0, 'doctrine.orm');
        $instance->add($this->get('sensio_framework_extra.converter.datetime'), 0, 'datetime');
        return $instance;
    }
    protected function getSensioFrameworkExtra_View_GuesserService()
    {
        return $this->services['sensio_framework_extra.view.guesser'] = new \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser($this->get('kernel'));
    }
    protected function getServiceContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }
    protected function getSessionService()
    {
        return $this->services['session'] = new \Symfony\Component\HttpFoundation\Session\Session($this->get('session.storage.native'), new \Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag(), new \Symfony\Component\HttpFoundation\Session\Flash\FlashBag());
    }
    protected function getSession_HandlerService()
    {
        return $this->services['session.handler'] = new \Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler(($this->targetDirs[1].'/sessions'));
    }
    protected function getSession_SaveListenerService()
    {
        return $this->services['session.save_listener'] = new \Symfony\Component\HttpKernel\EventListener\SaveSessionListener();
    }
    protected function getSession_Storage_FilesystemService()
    {
        return $this->services['session.storage.filesystem'] = new \Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage((__DIR__.'/sessions'), 'MOCKSESSID', $this->get('session.storage.metadata_bag'));
    }
    protected function getSession_Storage_NativeService()
    {
        return $this->services['session.storage.native'] = new \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array('gc_probability' => 1), $this->get('session.handler'), $this->get('session.storage.metadata_bag'));
    }
    protected function getSession_Storage_PhpBridgeService()
    {
        return $this->services['session.storage.php_bridge'] = new \Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage($this->get('session.handler'), $this->get('session.storage.metadata_bag'));
    }
    protected function getSessionListenerService()
    {
        return $this->services['session_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener($this);
    }
    protected function getSimplethingsEntityaudit_ConfigService()
    {
        $this->services['simplethings_entityaudit.config'] = $instance = new \SimpleThings\EntityAudit\AuditConfiguration();
        $instance->setAuditedEntityClasses(array(0 => 'Application\\Sonata\\UserBundle\\Entity\\User', 1 => 'Application\\Sonata\\UserBundle\\Entity\\Group', 2 => 'Application\\Sonata\\PageBundle\\Entity\\Page', 3 => 'Application\\Sonata\\PageBundle\\Entity\\Block', 5 => 'Application\\Sonata\\PageBundle\\Entity\\Snapshot', 6 => 'Application\\Sonata\\PageBundle\\Entity\\Site', 7 => 'Application\\Sonata\\NewsBundle\\Entity\\Post', 8 => 'Application\\Sonata\\NewsBundle\\Entity\\Comment', 9 => 'Application\\Sonata\\MediaBundle\\Entity\\Media', 10 => 'Application\\Sonata\\MediaBundle\\Entity\\Gallery', 11 => 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia', 12 => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 13 => 'Application\\Sonata\\CustomerBundle\\Entity\\Address', 14 => 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', 15 => 'Application\\Sonata\\OrderBundle\\Entity\\Order', 16 => 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 17 => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 19 => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory', 20 => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection', 21 => 'Application\\Sonata\\ProductBundle\\Entity\\Delivery', 22 => 'Application\\Sonata\\CommentBundle\\Entity\\Comment', 23 => 'Application\\Sonata\\CommentBundle\\Entity\\Thread', 24 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 25 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag', 26 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection', 27 => 'Application\\Sonata\\NotificationBundle\\Entity\\Message', 28 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Car', 29 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Engine', 30 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Inspection', 31 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Color', 32 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Material'));
        $instance->setGlobalIgnoreColumns(array());
        $instance->setTablePrefix('');
        $instance->setTableSuffix('_audit');
        $instance->setRevisionFieldName('rev');
        $instance->setRevisionTypeFieldName('revtype');
        $instance->setRevisionTableName('revisions');
        $instance->setRevisionIdFieldType('integer');
        return $instance;
    }
    protected function getSimplethingsEntityaudit_CreateSchemaListenerService()
    {
        return $this->services['simplethings_entityaudit.create_schema_listener'] = new \SimpleThings\EntityAudit\EventListener\CreateSchemaListener($this->get('simplethings_entityaudit.manager'));
    }
    protected function getSimplethingsEntityaudit_LogRevisionsListenerService()
    {
        return $this->services['simplethings_entityaudit.log_revisions_listener'] = new \SimpleThings\EntityAudit\EventListener\LogRevisionsListener($this->get('simplethings_entityaudit.manager'));
    }
    protected function getSimplethingsEntityaudit_ManagerService()
    {
        return $this->services['simplethings_entityaudit.manager'] = new \SimpleThings\EntityAudit\AuditManager($this->get('simplethings_entityaudit.config'));
    }
    protected function getSimplethingsEntityaudit_ReaderService()
    {
        return $this->services['simplethings_entityaudit.reader'] = $this->get('simplethings_entityaudit.manager')->createAuditReader($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getSimplethingsEntityaudit_Request_CurrentUserListenerService()
    {
        return $this->services['simplethings_entityaudit.request.current_user_listener'] = new \SimpleThings\EntityAudit\Request\CurrentUserListener($this->get('simplethings_entityaudit.config'), $this->get('security.context'));
    }
    protected function getSonata_Address_ManagerService()
    {
        return $this->services['sonata.address.manager'] = new \Sonata\CustomerBundle\Entity\AddressManager('Application\\Sonata\\CustomerBundle\\Entity\\Address', $this->get('doctrine'));
    }
    protected function getSonata_Admin_Audit_ManagerService()
    {
        $this->services['sonata.admin.audit.manager'] = $instance = new \Sonata\AdminBundle\Model\AuditManager($this);
        $instance->setReader('sonata.admin.audit.orm.reader', array(0 => 'Application\\Sonata\\UserBundle\\Entity\\User', 1 => 'Application\\Sonata\\UserBundle\\Entity\\Group', 2 => 'Application\\Sonata\\PageBundle\\Entity\\Page', 3 => 'Application\\Sonata\\PageBundle\\Entity\\Block', 5 => 'Application\\Sonata\\PageBundle\\Entity\\Snapshot', 6 => 'Application\\Sonata\\PageBundle\\Entity\\Site', 7 => 'Application\\Sonata\\NewsBundle\\Entity\\Post', 8 => 'Application\\Sonata\\NewsBundle\\Entity\\Comment', 9 => 'Application\\Sonata\\MediaBundle\\Entity\\Media', 10 => 'Application\\Sonata\\MediaBundle\\Entity\\Gallery', 11 => 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia', 12 => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 13 => 'Application\\Sonata\\CustomerBundle\\Entity\\Address', 14 => 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', 15 => 'Application\\Sonata\\OrderBundle\\Entity\\Order', 16 => 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 17 => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 19 => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory', 20 => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection', 21 => 'Application\\Sonata\\ProductBundle\\Entity\\Delivery', 22 => 'Application\\Sonata\\CommentBundle\\Entity\\Comment', 23 => 'Application\\Sonata\\CommentBundle\\Entity\\Thread', 24 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 25 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag', 26 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection', 27 => 'Application\\Sonata\\NotificationBundle\\Entity\\Message', 28 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Car', 29 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Engine', 30 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Inspection', 31 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Color', 32 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Material'));
        return $instance;
    }
    protected function getSonata_Admin_Audit_Orm_ReaderService()
    {
        return $this->services['sonata.admin.audit.orm.reader'] = new \Sonata\DoctrineORMAdminBundle\Model\AuditReader($this->get('simplethings_entityaudit.reader', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSonata_Admin_Block_AdminListService()
    {
        return $this->services['sonata.admin.block.admin_list'] = new \Sonata\AdminBundle\Block\AdminListBlockService('sonata.admin.block.admin_list', $this->get('templating'), $this->get('sonata.admin.pool'));
    }
    protected function getSonata_Admin_Block_SearchResultService()
    {
        return $this->services['sonata.admin.block.search_result'] = new \Sonata\AdminBundle\Block\AdminSearchBlockService('sonata.admin.block.search_result', $this->get('templating'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.search.handler'));
    }
    protected function getSonata_Admin_Builder_Filter_FactoryService()
    {
        return $this->services['sonata.admin.builder.filter.factory'] = new \Sonata\AdminBundle\Filter\FilterFactory($this, array('doctrine_orm_boolean' => 'sonata.admin.orm.filter.type.boolean', 'doctrine_orm_callback' => 'sonata.admin.orm.filter.type.callback', 'doctrine_orm_choice' => 'sonata.admin.orm.filter.type.choice', 'doctrine_orm_model' => 'sonata.admin.orm.filter.type.model', 'doctrine_orm_string' => 'sonata.admin.orm.filter.type.string', 'doctrine_orm_number' => 'sonata.admin.orm.filter.type.number', 'doctrine_orm_date' => 'sonata.admin.orm.filter.type.date', 'doctrine_orm_date_range' => 'sonata.admin.orm.filter.type.date_range', 'doctrine_orm_datetime' => 'sonata.admin.orm.filter.type.datetime', 'doctrine_orm_time' => 'sonata.admin.orm.filter.type.time', 'doctrine_orm_datetime_range' => 'sonata.admin.orm.filter.type.datetime_range', 'doctrine_orm_class' => 'sonata.admin.orm.filter.type.class'));
    }
    protected function getSonata_Admin_Builder_OrmDatagridService()
    {
        return $this->services['sonata.admin.builder.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder($this->get('form.factory'), $this->get('sonata.admin.builder.filter.factory'), $this->get('sonata.admin.guesser.orm_datagrid_chain'), true);
    }
    protected function getSonata_Admin_Builder_OrmFormService()
    {
        return $this->services['sonata.admin.builder.orm_form'] = new \Sonata\DoctrineORMAdminBundle\Builder\FormContractor($this->get('form.factory'));
    }
    protected function getSonata_Admin_Builder_OrmListService()
    {
        return $this->services['sonata.admin.builder.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Builder\ListBuilder($this->get('sonata.admin.guesser.orm_list_chain'), array('array' => 'SonataAdminBundle:CRUD:list_array.html.twig', 'boolean' => 'SonataAdminBundle:CRUD:list_boolean.html.twig', 'date' => 'SonataIntlBundle:CRUD:list_date.html.twig', 'time' => 'SonataAdminBundle:CRUD:list_time.html.twig', 'datetime' => 'SonataIntlBundle:CRUD:list_datetime.html.twig', 'text' => 'SonataAdminBundle:CRUD:list_string.html.twig', 'textarea' => 'SonataAdminBundle:CRUD:list_string.html.twig', 'email' => 'SonataAdminBundle:CRUD:list_string.html.twig', 'trans' => 'SonataAdminBundle:CRUD:list_trans.html.twig', 'string' => 'SonataAdminBundle:CRUD:list_string.html.twig', 'smallint' => 'SonataIntlBundle:CRUD:list_decimal.html.twig', 'bigint' => 'SonataIntlBundle:CRUD:list_decimal.html.twig', 'integer' => 'SonataIntlBundle:CRUD:list_decimal.html.twig', 'decimal' => 'SonataIntlBundle:CRUD:list_decimal.html.twig', 'identifier' => 'SonataAdminBundle:CRUD:list_string.html.twig', 'currency' => 'SonataIntlBundle:CRUD:list_currency.html.twig', 'percent' => 'SonataIntlBundle:CRUD:list_percent.html.twig', 'choice' => 'SonataAdminBundle:CRUD:list_choice.html.twig', 'url' => 'SonataAdminBundle:CRUD:list_url.html.twig', 'html' => 'SonataAdminBundle:CRUD:list_html.html.twig'));
    }
    protected function getSonata_Admin_Builder_OrmShowService()
    {
        return $this->services['sonata.admin.builder.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Builder\ShowBuilder($this->get('sonata.admin.guesser.orm_show_chain'), array('array' => 'SonataAdminBundle:CRUD:show_array.html.twig', 'boolean' => 'SonataAdminBundle:CRUD:show_boolean.html.twig', 'date' => 'SonataIntlBundle:CRUD:show_date.html.twig', 'time' => 'SonataAdminBundle:CRUD:show_time.html.twig', 'datetime' => 'SonataIntlBundle:CRUD:show_datetime.html.twig', 'text' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'trans' => 'SonataAdminBundle:CRUD:show_trans.html.twig', 'string' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'smallint' => 'SonataIntlBundle:CRUD:show_decimal.html.twig', 'bigint' => 'SonataIntlBundle:CRUD:show_decimal.html.twig', 'integer' => 'SonataIntlBundle:CRUD:show_decimal.html.twig', 'decimal' => 'SonataIntlBundle:CRUD:show_decimal.html.twig', 'currency' => 'SonataIntlBundle:CRUD:show_currency.html.twig', 'percent' => 'SonataIntlBundle:CRUD:show_percent.html.twig', 'choice' => 'SonataAdminBundle:CRUD:show_choice.html.twig', 'url' => 'SonataAdminBundle:CRUD:show_url.html.twig', 'html' => 'SonataAdminBundle:CRUD:show_html.html.twig'));
    }
    protected function getSonata_Admin_Controller_AdminService()
    {
        return $this->services['sonata.admin.controller.admin'] = new \Sonata\AdminBundle\Controller\HelperController($this->get('twig'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.helper'), $this->get('validator'));
    }
    protected function getSonata_Admin_Event_ExtensionService()
    {
        return $this->services['sonata.admin.event.extension'] = new \Sonata\AdminBundle\Event\AdminEventExtension($this->get('event_dispatcher'));
    }
    protected function getSonata_Admin_ExporterService()
    {
        return $this->services['sonata.admin.exporter'] = new \Sonata\AdminBundle\Export\Exporter();
    }
    protected function getSonata_Admin_Form_Extension_FieldService()
    {
        return $this->services['sonata.admin.form.extension.field'] = new \Sonata\AdminBundle\Form\Extension\Field\Type\FormTypeFieldExtension(array('email' => '', 'textarea' => '', 'text' => '', 'choice' => '', 'integer' => '', 'datetime' => 'sonata-medium-date', 'date' => 'sonata-medium-date'));
    }
    protected function getSonata_Admin_Form_Filter_Type_ChoiceService()
    {
        return $this->services['sonata.admin.form.filter.type.choice'] = new \Sonata\AdminBundle\Form\Type\Filter\ChoiceType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DateService()
    {
        return $this->services['sonata.admin.form.filter.type.date'] = new \Sonata\AdminBundle\Form\Type\Filter\DateType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DaterangeService()
    {
        return $this->services['sonata.admin.form.filter.type.daterange'] = new \Sonata\AdminBundle\Form\Type\Filter\DateRangeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DatetimeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DatetimeRangeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime_range'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DefaultService()
    {
        return $this->services['sonata.admin.form.filter.type.default'] = new \Sonata\AdminBundle\Form\Type\Filter\DefaultType();
    }
    protected function getSonata_Admin_Form_Filter_Type_NumberService()
    {
        return $this->services['sonata.admin.form.filter.type.number'] = new \Sonata\AdminBundle\Form\Type\Filter\NumberType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Type_AdminService()
    {
        return $this->services['sonata.admin.form.type.admin'] = new \Sonata\AdminBundle\Form\Type\AdminType();
    }
    protected function getSonata_Admin_Form_Type_CollectionService()
    {
        return $this->services['sonata.admin.form.type.collection'] = new \Sonata\AdminBundle\Form\Type\CollectionType();
    }
    protected function getSonata_Admin_Form_Type_ModelAutocompleteService()
    {
        return $this->services['sonata.admin.form.type.model_autocomplete'] = new \Sonata\AdminBundle\Form\Type\ModelAutocompleteType();
    }
    protected function getSonata_Admin_Form_Type_ModelChoiceService()
    {
        return $this->services['sonata.admin.form.type.model_choice'] = new \Sonata\AdminBundle\Form\Type\ModelType();
    }
    protected function getSonata_Admin_Form_Type_ModelHiddenService()
    {
        return $this->services['sonata.admin.form.type.model_hidden'] = new \Sonata\AdminBundle\Form\Type\ModelHiddenType();
    }
    protected function getSonata_Admin_Form_Type_ModelListService()
    {
        return $this->services['sonata.admin.form.type.model_list'] = new \Sonata\AdminBundle\Form\Type\ModelTypeList();
    }
    protected function getSonata_Admin_Form_Type_ModelReferenceService()
    {
        return $this->services['sonata.admin.form.type.model_reference'] = new \Sonata\AdminBundle\Form\Type\ModelReferenceType();
    }
    protected function getSonata_Admin_Guesser_OrmDatagridService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Guesser\FilterTypeGuesser();
    }
    protected function getSonata_Admin_Guesser_OrmDatagridChainService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_datagrid')));
    }
    protected function getSonata_Admin_Guesser_OrmListService()
    {
        return $this->services['sonata.admin.guesser.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser();
    }
    protected function getSonata_Admin_Guesser_OrmListChainService()
    {
        return $this->services['sonata.admin.guesser.orm_list_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_list')));
    }
    protected function getSonata_Admin_Guesser_OrmShowService()
    {
        return $this->services['sonata.admin.guesser.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser();
    }
    protected function getSonata_Admin_Guesser_OrmShowChainService()
    {
        return $this->services['sonata.admin.guesser.orm_show_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_show')));
    }
    protected function getSonata_Admin_HelperService()
    {
        return $this->services['sonata.admin.helper'] = new \Sonata\AdminBundle\Admin\AdminHelper($this->get('sonata.admin.pool'));
    }
    protected function getSonata_Admin_Label_Strategy_BcService()
    {
        return $this->services['sonata.admin.label.strategy.bc'] = new \Sonata\AdminBundle\Translator\BCLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_FormComponentService()
    {
        return $this->services['sonata.admin.label.strategy.form_component'] = new \Sonata\AdminBundle\Translator\FormLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_NativeService()
    {
        return $this->services['sonata.admin.label.strategy.native'] = new \Sonata\AdminBundle\Translator\NativeLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_NoopService()
    {
        return $this->services['sonata.admin.label.strategy.noop'] = new \Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_UnderscoreService()
    {
        return $this->services['sonata.admin.label.strategy.underscore'] = new \Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Manager_OrmService()
    {
        return $this->services['sonata.admin.manager.orm'] = new \Sonata\DoctrineORMAdminBundle\Model\ModelManager($this->get('doctrine'));
    }
    protected function getSonata_Admin_Manipulator_Acl_AdminService()
    {
        return $this->services['sonata.admin.manipulator.acl.admin'] = new \Sonata\AdminBundle\Util\AdminAclManipulator('Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder');
    }
    protected function getSonata_Admin_Manipulator_Acl_Object_OrmService()
    {
        return $this->services['sonata.admin.manipulator.acl.object.orm'] = new \Sonata\DoctrineORMAdminBundle\Util\ObjectAclManipulator();
    }
    protected function getSonata_Admin_Object_Manipulator_Acl_AdminService()
    {
        return $this->services['sonata.admin.object.manipulator.acl.admin'] = new \Sonata\AdminBundle\Util\AdminObjectAclManipulator($this->get('form.factory'), 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder');
    }
    protected function getSonata_Admin_Orm_Filter_Type_BooleanService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_CallbackService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_ChoiceService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_ClassService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ClassFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_DateService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_DateRangeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_DatetimeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateTimeFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_DatetimeRangeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateTimeRangeFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_ModelService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ModelFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_NumberService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\NumberFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_StringService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\StringFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_TimeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\TimeFilter();
    }
    protected function getSonata_Admin_PoolService()
    {
        $this->services['sonata.admin.pool'] = $instance = new \Sonata\AdminBundle\Admin\Pool($this, 'Sonata Project', '/bundles/sonataadmin/logo_title.png', array('html5_validate' => false, 'pager_links' => 5, 'confirm_exit' => true, 'use_select2' => true, 'use_icheck' => true, 'form_type' => 'standard', 'dropdown_number_groups_per_colums' => 2, 'title_mode' => 'both', 'javascripts' => array(0 => 'assetic/sonata_admin_js.js', 1 => 'assetic/sonata_jqueryui_js.js', 2 => 'assetic/sonata_formatter_js.js', 3 => 'bundles/sonataformatter/vendor/ckeditor/ckeditor.js'), 'stylesheets' => array(0 => 'assetic/sonata_admin_css.css', 1 => 'assetic/sonata_formatter_css.css', 2 => 'assetic/sonata_jqueryui_css.css', 3 => 'bundles/sonatademo/css/demo.css')), array());
        $instance->setTemplates(array('history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig'));
        $instance->setAdminServiceIds(array(0 => 'sonata.user.admin.user', 1 => 'sonata.user.admin.group', 2 => 'sonata.page.admin.page', 3 => 'sonata.page.admin.block', 4 => 'sonata.page.admin.shared_block', 5 => 'sonata.page.admin.snapshot', 6 => 'sonata.page.admin.site', 7 => 'sonata.news.admin.post', 8 => 'sonata.news.admin.comment', 9 => 'sonata.media.admin.media', 10 => 'sonata.media.admin.gallery', 11 => 'sonata.media.admin.gallery_has_media', 12 => 'sonata.customer.admin.customer', 13 => 'sonata.customer.admin.address', 14 => 'sonata.invoice.admin.invoice', 15 => 'sonata.order.admin.order', 16 => 'sonata.order.admin.order_element', 17 => 'sonata.product.admin.product', 18 => 'sonata.product.admin.product.variation', 19 => 'sonata.product.admin.product.category', 20 => 'sonata.product.admin.product.collection', 21 => 'sonata.product.admin.delivery', 22 => 'sonata.comment.admin.comment', 23 => 'sonata.comment.admin.thread', 24 => 'sonata.classification.admin.category', 25 => 'sonata.classification.admin.tag', 26 => 'sonata.classification.admin.collection', 27 => 'sonata.notification.admin.message', 28 => 'sonata.demo.admin.car', 29 => 'sonata.demo.admin.engine', 30 => 'sonata.demo.admin.inspection', 31 => 'sonata.demo.admin.color', 32 => 'sonata.demo.admin.material'));
        $instance->setAdminGroups(array('sonata.admin.group.content' => array('label' => 'sonata_content', 'label_catalogue' => 'SonataDemoBundle', 'icon' => '<i class="fa fa-th"></i>', 'items' => array(0 => 'sonata.news.admin.comment', 1 => 'sonata.news.admin.post', 2 => 'sonata.media.admin.media', 3 => 'sonata.media.admin.gallery', 4 => 'sonata.comment.admin.thread'), 'item_adds' => array(), 'roles' => array()), 'sonata.admin.group.ecommerce' => array('label' => 'sonata_ecommerce', 'label_catalogue' => 'SonataAdminBundle', 'icon' => '<i class="fa fa-dollar"></i>', 'items' => array(0 => 'sonata.customer.admin.customer', 1 => 'sonata.invoice.admin.invoice', 2 => 'sonata.order.admin.order', 3 => 'sonata.product.admin.product'), 'item_adds' => array(), 'roles' => array()), 'sonata.admin.group.classification' => array('label' => 'sonata_classification', 'label_catalogue' => 'SonataClassificationBundle', 'icon' => '<i class="fa fa-sitemap"></i>', 'items' => array(0 => 'sonata.classification.admin.category', 1 => 'sonata.classification.admin.tag', 2 => 'sonata.classification.admin.collection'), 'item_adds' => array(), 'roles' => array()), 'sonata.admin.group.site_builder' => array('label' => 'Site Builder', 'label_catalogue' => 'SonataDemoBundle', 'icon' => '<i class="fa fa-puzzle-piece"></i>', 'items' => array(0 => 'sonata.page.admin.page', 1 => 'sonata.page.admin.site'), 'item_adds' => array(), 'roles' => array()), 'sonata.admin.group.administration' => array('label' => 'sonata_administration', 'label_catalogue' => 'SonataAdminBundle', 'icon' => '<i class="fa fa-cogs"></i>', 'items' => array(0 => 'sonata.user.admin.user', 1 => 'sonata.user.admin.group', 2 => 'sonata.page.admin.site', 3 => 'sonata.notification.admin.message'), 'item_adds' => array(), 'roles' => array()), 'sonata.admin.group.demo' => array('label' => 'Demo', 'icon' => '<i class="fa fa-play-circle"></i>', 'items' => array(0 => 'sonata.demo.admin.car', 1 => 'sonata.demo.admin.engine', 2 => 'sonata.demo.admin.color', 3 => 'sonata.demo.admin.material'), 'item_adds' => array(), 'roles' => array(), 'label_catalogue' => 'SonataAdminBundle')));
        $instance->setAdminClasses(array('Application\\Sonata\\UserBundle\\Entity\\User' => array(0 => 'sonata.user.admin.user'), 'Application\\Sonata\\UserBundle\\Entity\\Group' => array(0 => 'sonata.user.admin.group'), 'Application\\Sonata\\PageBundle\\Entity\\Page' => array(0 => 'sonata.page.admin.page'), 'Application\\Sonata\\PageBundle\\Entity\\Block' => array(0 => 'sonata.page.admin.block', 1 => 'sonata.page.admin.shared_block'), 'Application\\Sonata\\PageBundle\\Entity\\Snapshot' => array(0 => 'sonata.page.admin.snapshot'), 'Application\\Sonata\\PageBundle\\Entity\\Site' => array(0 => 'sonata.page.admin.site'), 'Application\\Sonata\\NewsBundle\\Entity\\Post' => array(0 => 'sonata.news.admin.post'), 'Application\\Sonata\\NewsBundle\\Entity\\Comment' => array(0 => 'sonata.news.admin.comment'), 'Application\\Sonata\\MediaBundle\\Entity\\Media' => array(0 => 'sonata.media.admin.media'), 'Application\\Sonata\\MediaBundle\\Entity\\Gallery' => array(0 => 'sonata.media.admin.gallery'), 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia' => array(0 => 'sonata.media.admin.gallery_has_media'), 'Application\\Sonata\\CustomerBundle\\Entity\\Customer' => array(0 => 'sonata.customer.admin.customer'), 'Application\\Sonata\\CustomerBundle\\Entity\\Address' => array(0 => 'sonata.customer.admin.address'), 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice' => array(0 => 'sonata.invoice.admin.invoice'), 'Application\\Sonata\\OrderBundle\\Entity\\Order' => array(0 => 'sonata.order.admin.order'), 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement' => array(0 => 'sonata.order.admin.order_element'), 'Application\\Sonata\\ProductBundle\\Entity\\Product' => array(0 => 'sonata.product.admin.product', 1 => 'sonata.product.admin.product.variation'), 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory' => array(0 => 'sonata.product.admin.product.category'), 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection' => array(0 => 'sonata.product.admin.product.collection'), 'Application\\Sonata\\ProductBundle\\Entity\\Delivery' => array(0 => 'sonata.product.admin.delivery'), 'Application\\Sonata\\CommentBundle\\Entity\\Comment' => array(0 => 'sonata.comment.admin.comment'), 'Application\\Sonata\\CommentBundle\\Entity\\Thread' => array(0 => 'sonata.comment.admin.thread'), 'Application\\Sonata\\ClassificationBundle\\Entity\\Category' => array(0 => 'sonata.classification.admin.category'), 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag' => array(0 => 'sonata.classification.admin.tag'), 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection' => array(0 => 'sonata.classification.admin.collection'), 'Application\\Sonata\\NotificationBundle\\Entity\\Message' => array(0 => 'sonata.notification.admin.message'), 'Sonata\\Bundle\\DemoBundle\\Entity\\Car' => array(0 => 'sonata.demo.admin.car'), 'Sonata\\Bundle\\DemoBundle\\Entity\\Engine' => array(0 => 'sonata.demo.admin.engine'), 'Sonata\\Bundle\\DemoBundle\\Entity\\Inspection' => array(0 => 'sonata.demo.admin.inspection'), 'Sonata\\Bundle\\DemoBundle\\Entity\\Color' => array(0 => 'sonata.demo.admin.color'), 'Sonata\\Bundle\\DemoBundle\\Entity\\Material' => array(0 => 'sonata.demo.admin.material')));
        return $instance;
    }
    protected function getSonata_Admin_Route_CacheService()
    {
        return $this->services['sonata.admin.route.cache'] = new \Sonata\AdminBundle\Route\RoutesCache((__DIR__.'/sonata/admin'), false);
    }
    protected function getSonata_Admin_Route_CacheWarmupService()
    {
        return $this->services['sonata.admin.route.cache_warmup'] = new \Sonata\AdminBundle\Route\RoutesCacheWarmUp($this->get('sonata.admin.route.cache'), $this->get('sonata.admin.pool'));
    }
    protected function getSonata_Admin_Route_DefaultGeneratorService()
    {
        return $this->services['sonata.admin.route.default_generator'] = new \Sonata\AdminBundle\Route\DefaultRouteGenerator($this->get('cmf_routing.router'), $this->get('sonata.admin.route.cache'));
    }
    protected function getSonata_Admin_Route_PathInfoService()
    {
        return $this->services['sonata.admin.route.path_info'] = new \Sonata\AdminBundle\Route\PathInfoBuilder($this->get('sonata.admin.audit.manager'));
    }
    protected function getSonata_Admin_Route_QueryStringService()
    {
        return $this->services['sonata.admin.route.query_string'] = new \Sonata\AdminBundle\Route\QueryStringBuilder($this->get('sonata.admin.audit.manager'));
    }
    protected function getSonata_Admin_RouteLoaderService()
    {
        return $this->services['sonata.admin.route_loader'] = new \Sonata\AdminBundle\Route\AdminPoolLoader($this->get('sonata.admin.pool'), array(0 => 'sonata.user.admin.user', 1 => 'sonata.user.admin.group', 2 => 'sonata.page.admin.page', 3 => 'sonata.page.admin.block', 4 => 'sonata.page.admin.shared_block', 5 => 'sonata.page.admin.snapshot', 6 => 'sonata.page.admin.site', 7 => 'sonata.news.admin.post', 8 => 'sonata.news.admin.comment', 9 => 'sonata.media.admin.media', 10 => 'sonata.media.admin.gallery', 11 => 'sonata.media.admin.gallery_has_media', 12 => 'sonata.customer.admin.customer', 13 => 'sonata.customer.admin.address', 14 => 'sonata.invoice.admin.invoice', 15 => 'sonata.order.admin.order', 16 => 'sonata.order.admin.order_element', 17 => 'sonata.product.admin.product', 18 => 'sonata.product.admin.product.variation', 19 => 'sonata.product.admin.product.category', 20 => 'sonata.product.admin.product.collection', 21 => 'sonata.product.admin.delivery', 22 => 'sonata.comment.admin.comment', 23 => 'sonata.comment.admin.thread', 24 => 'sonata.classification.admin.category', 25 => 'sonata.classification.admin.tag', 26 => 'sonata.classification.admin.collection', 27 => 'sonata.notification.admin.message', 28 => 'sonata.demo.admin.car', 29 => 'sonata.demo.admin.engine', 30 => 'sonata.demo.admin.inspection', 31 => 'sonata.demo.admin.color', 32 => 'sonata.demo.admin.material'), $this);
    }
    protected function getSonata_Admin_Search_HandlerService()
    {
        return $this->services['sonata.admin.search.handler'] = new \Sonata\AdminBundle\Search\SearchHandler($this->get('sonata.admin.pool'));
    }
    protected function getSonata_Admin_Security_HandlerService()
    {
        $this->services['sonata.admin.security.handler'] = $instance = new \Sonata\AdminBundle\Security\Handler\AclSecurityHandler($this->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.acl.provider', ContainerInterface::NULL_ON_INVALID_REFERENCE), 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder', array(0 => 'ROLE_SUPER_ADMIN'));
        $instance->setAdminPermissions(array(0 => 'CREATE', 1 => 'LIST', 2 => 'DELETE', 3 => 'UNDELETE', 4 => 'EXPORT', 5 => 'OPERATOR', 6 => 'MASTER'));
        $instance->setObjectPermissions(array(0 => 'VIEW', 1 => 'EDIT', 2 => 'DELETE', 3 => 'UNDELETE', 4 => 'OPERATOR', 5 => 'MASTER', 6 => 'OWNER'));
        return $instance;
    }
    protected function getSonata_Admin_Twig_ExtensionService()
    {
        return $this->services['sonata.admin.twig.extension'] = new \Sonata\AdminBundle\Twig\Extension\SonataAdminExtension($this->get('sonata.admin.pool'), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSonata_Admin_Validator_InlineService()
    {
        return $this->services['sonata.admin.validator.inline'] = new \Sonata\AdminBundle\Validator\InlineValidator($this, $this->get('validator.validator_factory'));
    }
    protected function getSonata_AdminDoctrineOrm_Block_AuditService()
    {
        return $this->services['sonata.admin_doctrine_orm.block.audit'] = new \Sonata\DoctrineORMAdminBundle\Block\AuditBlockService('sonata.admin_doctrine_orm.block.audit', $this->get('templating'), $this->get('simplethings_entityaudit.reader', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSonata_BasketService()
    {
        return $this->services['sonata.basket'] = $this->get('sonata.basket.loader.standard')->getBasket();
    }
    protected function getSonata_Basket_Api_Form_Type_BasketService()
    {
        return $this->services['sonata.basket.api.form.type.basket'] = new \Sonata\BasketBundle\Form\ApiBasketType('Application\\Sonata\\BasketBundle\\Entity\\Basket', $this->get('sonata.price.currency.form_type'));
    }
    protected function getSonata_Basket_Api_Form_Type_Basket_Element_ParentService()
    {
        return $this->services['sonata.basket.api.form.type.basket.element.parent'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_basket_api_form_basket_element_parent', 'Application\\Sonata\\BasketBundle\\Entity\\BasketElement', 'sonata_api_write');
    }
    protected function getSonata_Basket_Api_Form_Type_Basket_ParentService()
    {
        return $this->services['sonata.basket.api.form.type.basket.parent'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_basket_api_form_basket_parent', 'Application\\Sonata\\BasketBundle\\Entity\\Basket', 'sonata_api_write');
    }
    protected function getSonata_Basket_Api_Form_Type_BasketElementService()
    {
        return $this->services['sonata.basket.api.form.type.basket_element'] = new \Sonata\BasketBundle\Form\ApiBasketElementType('Application\\Sonata\\BasketBundle\\Entity\\BasketElement');
    }
    protected function getSonata_Basket_Block_NbItemsService()
    {
        return $this->services['sonata.basket.block.nb_items'] = new \Sonata\BasketBundle\Block\BasketBlockService('sonata.basket.block.nb_items', $this->get('templating'));
    }
    protected function getSonata_Basket_Builder_StandardService()
    {
        return $this->services['sonata.basket.builder.standard'] = new \Sonata\Component\Basket\BasketBuilder($this->get('sonata.product.pool'), $this->get('sonata.address.manager'), $this->get('sonata.delivery.pool'), $this->get('sonata.payment.pool'));
    }
    protected function getSonata_Basket_Controller_Api_BasketService()
    {
        return $this->services['sonata.basket.controller.api.basket'] = new \Sonata\BasketBundle\Controller\Api\BasketController($this->get('sonata.basket.manager'), $this->get('sonata.basket_element.manager'), $this->get('sonata.product.set.manager'), $this->get('sonata.basket.builder.standard'), $this->get('form.factory'));
    }
    protected function getSonata_Basket_Entity_FactoryService()
    {
        return $this->services['sonata.basket.entity.factory'] = new \Sonata\Component\Basket\BasketEntityFactory($this->get('sonata.basket.manager'), $this->get('sonata.basket.builder.standard'), $this->get('sonata.price.currency.detector'), $this->get('session'));
    }
    protected function getSonata_Basket_Form_Type_AddressService()
    {
        return $this->services['sonata.basket.form.type.address'] = new \Sonata\BasketBundle\Form\AddressType('Application\\Sonata\\CustomerBundle\\Entity\\Address', $this->get('sonata.basket'));
    }
    protected function getSonata_Basket_Form_Type_BasketService()
    {
        return $this->services['sonata.basket.form.type.basket'] = new \Sonata\BasketBundle\Form\BasketType();
    }
    protected function getSonata_Basket_Form_Type_PaymentService()
    {
        return $this->services['sonata.basket.form.type.payment'] = new \Sonata\BasketBundle\Form\PaymentType($this->get('sonata.address.manager'), $this->get('sonata.payment.pool'), $this->get('sonata.payment.selector.simple'));
    }
    protected function getSonata_Basket_Form_Type_ShippingService()
    {
        return $this->services['sonata.basket.form.type.shipping'] = new \Sonata\BasketBundle\Form\ShippingType($this->get('sonata.delivery.pool'), $this->get('sonata.delivery.selector.default'));
    }
    protected function getSonata_Basket_Loader_StandardService()
    {
        return $this->services['sonata.basket.loader.standard'] = new \Sonata\Component\Basket\Loader($this->get('sonata.basket.entity.factory'), $this->get('sonata.customer.selector'));
    }
    protected function getSonata_Basket_ManagerService()
    {
        return $this->services['sonata.basket.manager'] = new \Sonata\Component\Basket\BasketManager('Application\\Sonata\\BasketBundle\\Entity\\Basket', $this->get('doctrine'));
    }
    protected function getSonata_Basket_Session_FactoryService()
    {
        return $this->services['sonata.basket.session.factory'] = new \Sonata\Component\Basket\BasketSessionFactory($this->get('sonata.basket.manager'), $this->get('sonata.basket.builder.standard'), $this->get('sonata.price.currency.detector'), $this->get('session'));
    }
    protected function getSonata_Basket_Twig_GlobalService()
    {
        return $this->services['sonata.basket.twig.global'] = new \Sonata\BasketBundle\Twig\GlobalVariables($this);
    }
    protected function getSonata_Basket_Validator_BasketService()
    {
        return $this->services['sonata.basket.validator.basket'] = new \Sonata\Component\Form\BasketValidator($this->get('sonata.product.pool'), $this->get('validator.validator_factory'));
    }
    protected function getSonata_BasketElement_ManagerService()
    {
        return $this->services['sonata.basket_element.manager'] = new \Sonata\Component\Basket\BasketElementManager('Application\\Sonata\\BasketBundle\\Entity\\BasketElement', $this->get('doctrine'));
    }
    protected function getSonata_Block_Cache_Handler_DefaultService()
    {
        return $this->services['sonata.block.cache.handler.default'] = new \Sonata\BlockBundle\Cache\HttpCacheHandler();
    }
    protected function getSonata_Block_Cache_Handler_NoopService()
    {
        return $this->services['sonata.block.cache.handler.noop'] = new \Sonata\BlockBundle\Cache\NoopHttpCacheHandler();
    }
    protected function getSonata_Block_ContextManager_DefaultService()
    {
        return $this->services['sonata.block.context_manager.default'] = new \Sonata\BlockBundle\Block\BlockContextManager($this->get('sonata.block.loader.chain'), $this->get('sonata.block.manager'), array('by_type' => array('sonata.admin.block.admin_list' => 'sonata.cache.noop', 'sonata.admin.block.search_result' => 'sonata.cache.noop', 'sonata.block.service.text' => 'sonata.cache.noop', 'sonata.block.service.container' => 'sonata.cache.noop', 'sonata.block.service.rss' => 'sonata.cache.noop', 'sonata.block.service.menu' => 'sonata.cache.noop', 'sonata.block.service.template' => 'sonata.cache.noop', 'sonata.page.block.container' => 'sonata.cache.noop', 'sonata.page.block.children_pages' => 'sonata.cache.noop', 'sonata.page.block.breadcrumb' => 'sonata.cache.noop', 'sonata.media.block.media' => 'sonata.cache.noop', 'sonata.media.block.gallery' => 'sonata.cache.noop', 'sonata.media.block.feature_media' => 'sonata.cache.noop', 'sonata.news.block.recent_comments' => 'sonata.cache.noop', 'sonata.news.block.recent_posts' => 'sonata.cache.noop', 'sonata.order.block.recent_orders' => 'sonata.cache.noop', 'sonata.product.block.recent_products' => 'sonata.cache.noop', 'sonata.product.block.similar_products' => 'sonata.cache.noop', 'sonata.product.block.categories_menu' => 'sonata.cache.noop', 'sonata.product.block.filters_menu' => 'sonata.cache.noop', 'sonata.product.block.variations_form' => 'sonata.cache.noop', 'sonata.customer.block.recent_customers' => 'sonata.cache.noop', 'sonata.basket.block.nb_items' => 'sonata.page.cache.js_async', 'sonata.timeline.block.timeline' => 'sonata.cache.noop', 'sonata.user.block.account' => 'sonata.page.cache.js_async', 'sonata.user.block.menu' => 'sonata.cache.noop', 'sonata.seo.block.email.share_button' => 'sonata.cache.noop', 'sonata.seo.block.facebook.like_box' => 'sonata.cache.noop', 'sonata.seo.block.facebook.like_button' => 'sonata.cache.noop', 'sonata.seo.block.facebook.send_button' => 'sonata.cache.noop', 'sonata.seo.block.facebook.share_button' => 'sonata.cache.noop', 'sonata.seo.block.pinterest.pin_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.share_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.follow_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.hashtag_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.mention_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.embed' => 'sonata.cache.noop', 'sonata.demo.block.newsletter' => 'sonata.cache.noop', 'sonata.formatter.block.formatter' => 'sonata.cache.noop', 'sonata.seo.block.breadcrumb.homepage' => 'sonata.cache.noop')), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSonata_Block_Exception_Filter_DebugOnlyService()
    {
        return $this->services['sonata.block.exception.filter.debug_only'] = new \Sonata\BlockBundle\Exception\Filter\DebugOnlyFilter(false);
    }
    protected function getSonata_Block_Exception_Filter_IgnoreBlockExceptionService()
    {
        return $this->services['sonata.block.exception.filter.ignore_block_exception'] = new \Sonata\BlockBundle\Exception\Filter\IgnoreClassFilter('Sonata\\BlockBundle\\Exception\\BlockExceptionInterface');
    }
    protected function getSonata_Block_Exception_Filter_KeepAllService()
    {
        return $this->services['sonata.block.exception.filter.keep_all'] = new \Sonata\BlockBundle\Exception\Filter\KeepAllFilter();
    }
    protected function getSonata_Block_Exception_Filter_KeepNoneService()
    {
        return $this->services['sonata.block.exception.filter.keep_none'] = new \Sonata\BlockBundle\Exception\Filter\KeepNoneFilter();
    }
    protected function getSonata_Block_Exception_Renderer_InlineService()
    {
        return $this->services['sonata.block.exception.renderer.inline'] = new \Sonata\BlockBundle\Exception\Renderer\InlineRenderer($this->get('templating'), 'SonataBlockBundle:Block:block_exception.html.twig');
    }
    protected function getSonata_Block_Exception_Renderer_InlineDebugService()
    {
        return $this->services['sonata.block.exception.renderer.inline_debug'] = new \Sonata\BlockBundle\Exception\Renderer\InlineDebugRenderer($this->get('templating'), 'SonataBlockBundle:Block:block_exception_debug.html.twig', false, true);
    }
    protected function getSonata_Block_Exception_Renderer_ThrowService()
    {
        return $this->services['sonata.block.exception.renderer.throw'] = new \Sonata\BlockBundle\Exception\Renderer\MonkeyThrowRenderer();
    }
    protected function getSonata_Block_Exception_Strategy_ManagerService()
    {
        $this->services['sonata.block.exception.strategy.manager'] = $instance = new \Sonata\BlockBundle\Exception\Strategy\StrategyManager($this, array('debug_only' => 'sonata.block.exception.filter.debug_only', 'ignore_block_exception' => 'sonata.block.exception.filter.ignore_block_exception', 'keep_all' => 'sonata.block.exception.filter.keep_all', 'keep_none' => 'sonata.block.exception.filter.keep_none'), array('inline' => 'sonata.block.exception.renderer.inline', 'inline_debug' => 'sonata.block.exception.renderer.inline_debug', 'throw' => 'sonata.block.exception.renderer.throw'), array(), array());
        $instance->setDefaultFilter('debug_only');
        $instance->setDefaultRenderer('throw');
        return $instance;
    }
    protected function getSonata_Block_Form_Type_BlockService()
    {
        return $this->services['sonata.block.form.type.block'] = new \Sonata\BlockBundle\Form\Type\ServiceListType($this->get('sonata.block.manager'));
    }
    protected function getSonata_Block_Form_Type_ContainerTemplateService()
    {
        return $this->services['sonata.block.form.type.container_template'] = new \Sonata\BlockBundle\Form\Type\ContainerTemplateType(array('SonataPageBundle:Block:block_container.html.twig' => 'SonataPageBundle default template', 'SonataSeoBundle:Block:block_social_container.html.twig' => 'SonataSeoBundle (to contain social buttons)'));
    }
    protected function getSonata_Block_Loader_ChainService()
    {
        return $this->services['sonata.block.loader.chain'] = new \Sonata\BlockBundle\Block\BlockLoaderChain(array(0 => $this->get('sonata.block.loader.service')));
    }
    protected function getSonata_Block_Loader_ServiceService()
    {
        return $this->services['sonata.block.loader.service'] = new \Sonata\BlockBundle\Block\Loader\ServiceLoader(array(0 => 'sonata.admin.block.admin_list', 1 => 'sonata.admin.block.search_result', 2 => 'sonata.block.service.text', 3 => 'sonata.block.service.container', 4 => 'sonata.block.service.rss', 5 => 'sonata.block.service.menu', 6 => 'sonata.block.service.template', 7 => 'sonata.page.block.container', 8 => 'sonata.page.block.children_pages', 9 => 'sonata.page.block.breadcrumb', 10 => 'sonata.media.block.media', 11 => 'sonata.media.block.gallery', 12 => 'sonata.media.block.feature_media', 13 => 'sonata.news.block.recent_comments', 14 => 'sonata.news.block.recent_posts', 15 => 'sonata.order.block.recent_orders', 16 => 'sonata.product.block.recent_products', 17 => 'sonata.product.block.similar_products', 18 => 'sonata.product.block.categories_menu', 19 => 'sonata.product.block.filters_menu', 20 => 'sonata.product.block.variations_form', 21 => 'sonata.customer.block.recent_customers', 22 => 'sonata.basket.block.nb_items', 23 => 'sonata.timeline.block.timeline', 24 => 'sonata.user.block.account', 25 => 'sonata.user.block.menu', 26 => 'sonata.seo.block.email.share_button', 27 => 'sonata.seo.block.facebook.like_box', 28 => 'sonata.seo.block.facebook.like_button', 29 => 'sonata.seo.block.facebook.send_button', 30 => 'sonata.seo.block.facebook.share_button', 31 => 'sonata.seo.block.pinterest.pin_button', 32 => 'sonata.seo.block.twitter.share_button', 33 => 'sonata.seo.block.twitter.follow_button', 34 => 'sonata.seo.block.twitter.hashtag_button', 35 => 'sonata.seo.block.twitter.mention_button', 36 => 'sonata.seo.block.twitter.embed', 37 => 'sonata.demo.block.newsletter', 38 => 'sonata.formatter.block.formatter', 39 => 'sonata.seo.block.breadcrumb.homepage'));
    }
    protected function getSonata_Block_Renderer_DefaultService()
    {
        return $this->services['sonata.block.renderer.default'] = new \Sonata\BlockBundle\Block\BlockRenderer($this->get('sonata.block.manager'), $this->get('sonata.block.exception.strategy.manager'), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE), false);
    }
    protected function getSonata_Block_Service_ContainerService()
    {
        return $this->services['sonata.block.service.container'] = new \Sonata\BlockBundle\Block\Service\ContainerBlockService('sonata.block.container', $this->get('templating'));
    }
    protected function getSonata_Block_Service_EmptyService()
    {
        return $this->services['sonata.block.service.empty'] = new \Sonata\BlockBundle\Block\Service\EmptyBlockService('sonata.block.empty', $this->get('templating'));
    }
    protected function getSonata_Block_Service_MenuService()
    {
        return $this->services['sonata.block.service.menu'] = new \Sonata\BlockBundle\Block\Service\MenuBlockService('sonata.block.menu', $this->get('templating'), $this->get('knp_menu.menu_provider'), array('SonataDemoBundle:Builder:mainMenu' => 'Main Menu'));
    }
    protected function getSonata_Block_Service_RssService()
    {
        return $this->services['sonata.block.service.rss'] = new \Sonata\BlockBundle\Block\Service\RssBlockService('sonata.block.rss', $this->get('templating'));
    }
    protected function getSonata_Block_Service_TemplateService()
    {
        return $this->services['sonata.block.service.template'] = new \Sonata\BlockBundle\Block\Service\TemplateBlockService('sonata.block.template', $this->get('templating'));
    }
    protected function getSonata_Block_Service_TextService()
    {
        return $this->services['sonata.block.service.text'] = new \Sonata\BlockBundle\Block\Service\TextBlockService('sonata.block.text', $this->get('templating'));
    }
    protected function getSonata_Block_Templating_HelperService()
    {
        return $this->services['sonata.block.templating.helper'] = new \Sonata\BlockBundle\Templating\Helper\BlockHelper($this->get('sonata.block.manager'), array('by_type' => array('sonata.admin.block.admin_list' => 'sonata.cache.noop', 'sonata.admin.block.search_result' => 'sonata.cache.noop', 'sonata.block.service.text' => 'sonata.cache.noop', 'sonata.block.service.container' => 'sonata.cache.noop', 'sonata.block.service.rss' => 'sonata.cache.noop', 'sonata.block.service.menu' => 'sonata.cache.noop', 'sonata.block.service.template' => 'sonata.cache.noop', 'sonata.page.block.container' => 'sonata.cache.noop', 'sonata.page.block.children_pages' => 'sonata.cache.noop', 'sonata.page.block.breadcrumb' => 'sonata.cache.noop', 'sonata.media.block.media' => 'sonata.cache.noop', 'sonata.media.block.gallery' => 'sonata.cache.noop', 'sonata.media.block.feature_media' => 'sonata.cache.noop', 'sonata.news.block.recent_comments' => 'sonata.cache.noop', 'sonata.news.block.recent_posts' => 'sonata.cache.noop', 'sonata.order.block.recent_orders' => 'sonata.cache.noop', 'sonata.product.block.recent_products' => 'sonata.cache.noop', 'sonata.product.block.similar_products' => 'sonata.cache.noop', 'sonata.product.block.categories_menu' => 'sonata.cache.noop', 'sonata.product.block.filters_menu' => 'sonata.cache.noop', 'sonata.product.block.variations_form' => 'sonata.cache.noop', 'sonata.customer.block.recent_customers' => 'sonata.cache.noop', 'sonata.basket.block.nb_items' => 'sonata.page.cache.js_async', 'sonata.timeline.block.timeline' => 'sonata.cache.noop', 'sonata.user.block.account' => 'sonata.page.cache.js_async', 'sonata.user.block.menu' => 'sonata.cache.noop', 'sonata.seo.block.email.share_button' => 'sonata.cache.noop', 'sonata.seo.block.facebook.like_box' => 'sonata.cache.noop', 'sonata.seo.block.facebook.like_button' => 'sonata.cache.noop', 'sonata.seo.block.facebook.send_button' => 'sonata.cache.noop', 'sonata.seo.block.facebook.share_button' => 'sonata.cache.noop', 'sonata.seo.block.pinterest.pin_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.share_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.follow_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.hashtag_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.mention_button' => 'sonata.cache.noop', 'sonata.seo.block.twitter.embed' => 'sonata.cache.noop', 'sonata.demo.block.newsletter' => 'sonata.cache.noop', 'sonata.formatter.block.formatter' => 'sonata.cache.noop', 'sonata.seo.block.breadcrumb.homepage' => 'sonata.cache.noop')), $this->get('sonata.block.renderer.default'), $this->get('sonata.page.block.context_manager'), $this->get('event_dispatcher'), $this->get('sonata.cache.manager', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('sonata.block.cache.handler.default', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSonata_Block_Twig_GlobalService()
    {
        return $this->services['sonata.block.twig.global'] = new \Sonata\BlockBundle\Twig\GlobalVariables(array('block_base' => 'SonataPageBundle:Block:block_base.html.twig', 'block_container' => 'SonataPageBundle:Block:block_container.html.twig'));
    }
    protected function getSonata_Cache_Invalidation_SimpleService()
    {
        return $this->services['sonata.cache.invalidation.simple'] = new \Sonata\CacheBundle\Invalidation\SimpleCacheInvalidation($this->get('logger'));
    }
    protected function getSonata_Cache_ManagerService()
    {
        $this->services['sonata.cache.manager'] = $instance = new \Sonata\Cache\CacheManager($this->get('sonata.cache.invalidation.simple'), array('sonata.page.cache.esi' => $this->get('sonata.page.cache.esi'), 'sonata.page.cache.ssi' => $this->get('sonata.page.cache.ssi'), 'sonata.page.cache.js_sync' => $this->get('sonata.page.cache.js_sync'), 'sonata.page.cache.js_async' => $this->get('sonata.page.cache.js_async'), 'sonata.cache.noop' => $this->get('sonata.cache.noop')));
        $instance->setRecorder($this->get('sonata.cache.recorder'));
        return $instance;
    }
    protected function getSonata_Cache_ModelIdentifierService()
    {
        return $this->services['sonata.cache.model_identifier'] = new \Sonata\Cache\Invalidation\ModelCollectionIdentifiers(array());
    }
    protected function getSonata_Cache_NoopService()
    {
        return $this->services['sonata.cache.noop'] = new \Sonata\Cache\Adapter\Cache\NoopCache();
    }
    protected function getSonata_Cache_Orm_EventSubscriberService()
    {
        return $this->services['sonata.cache.orm.event_subscriber'] = new \Sonata\CacheBundle\Invalidation\DoctrineORMListenerContainerAware($this, 'sonata.cache.orm.event_subscriber.default');
    }
    protected function getSonata_Cache_Orm_EventSubscriber_DefaultService()
    {
        return $this->services['sonata.cache.orm.event_subscriber.default'] = new \Sonata\CacheBundle\Invalidation\DoctrineORMListener($this->get('sonata.cache.model_identifier'), array('sonata.page.cache.esi' => $this->get('sonata.page.cache.esi'), 'sonata.page.cache.ssi' => $this->get('sonata.page.cache.ssi'), 'sonata.page.cache.js_sync' => $this->get('sonata.page.cache.js_sync'), 'sonata.page.cache.js_async' => $this->get('sonata.page.cache.js_async'), 'sonata.cache.noop' => $this->get('sonata.cache.noop')));
    }
    protected function getSonata_Cache_RecorderService()
    {
        return $this->services['sonata.cache.recorder'] = new \Sonata\Cache\Invalidation\Recorder($this->get('sonata.cache.model_identifier'));
    }
    protected function getSonata_Classification_Admin_CategoryService()
    {
        $instance = new \Sonata\ClassificationBundle\Admin\CategoryAdmin('sonata.classification.admin.category', 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'SonataAdminBundle:CRUD');
        $instance->setTranslationDomain('SonataClassificationBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('label_categories');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Classification_Admin_CollectionService()
    {
        $instance = new \Sonata\ClassificationBundle\Admin\CollectionAdmin('sonata.classification.admin.collection', 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection', 'SonataAdminBundle:CRUD');
        $instance->setTranslationDomain('SonataClassificationBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('label_collections');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Classification_Admin_TagService()
    {
        $instance = new \Sonata\ClassificationBundle\Admin\TagAdmin('sonata.classification.admin.tag', 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag', 'SonataAdminBundle:CRUD');
        $instance->setTranslationDomain('SonataClassificationBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('label_tags');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Classification_Api_Form_Type_CategoryService()
    {
        return $this->services['sonata.classification.api.form.type.category'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_classification_api_form_category', 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'sonata_api_write');
    }
    protected function getSonata_Classification_Api_Form_Type_CollectionService()
    {
        return $this->services['sonata.classification.api.form.type.collection'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_classification_api_form_collection', 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection', 'sonata_api_write');
    }
    protected function getSonata_Classification_Api_Form_Type_TagService()
    {
        return $this->services['sonata.classification.api.form.type.tag'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_classification_api_form_tag', 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag', 'sonata_api_write');
    }
    protected function getSonata_Classification_Controller_Api_CategoryService()
    {
        return $this->services['sonata.classification.controller.api.category'] = new \Sonata\ClassificationBundle\Controller\Api\CategoryController($this->get('sonata.classification.manager.category'), $this->get('form.factory'));
    }
    protected function getSonata_Classification_Controller_Api_CollectionService()
    {
        return $this->services['sonata.classification.controller.api.collection'] = new \Sonata\ClassificationBundle\Controller\Api\CollectionController($this->get('sonata.classification.manager.collection'), $this->get('form.factory'));
    }
    protected function getSonata_Classification_Controller_Api_TagService()
    {
        return $this->services['sonata.classification.controller.api.tag'] = new \Sonata\ClassificationBundle\Controller\Api\TagController($this->get('sonata.classification.manager.tag'), $this->get('form.factory'));
    }
    protected function getSonata_Classification_Form_Type_CategorySelectorService()
    {
        return $this->services['sonata.classification.form.type.category_selector'] = new \Sonata\ClassificationBundle\Form\Type\CategorySelectorType($this->get('sonata.classification.manager.category'));
    }
    protected function getSonata_Classification_Manager_CategoryService()
    {
        return $this->services['sonata.classification.manager.category'] = new \Sonata\ClassificationBundle\Entity\CategoryManager('Application\\Sonata\\ClassificationBundle\\Entity\\Category', $this->get('doctrine'));
    }
    protected function getSonata_Classification_Manager_CollectionService()
    {
        return $this->services['sonata.classification.manager.collection'] = new \Sonata\ClassificationBundle\Entity\CollectionManager('Application\\Sonata\\ClassificationBundle\\Entity\\Collection', $this->get('doctrine'));
    }
    protected function getSonata_Classification_Manager_TagService()
    {
        return $this->services['sonata.classification.manager.tag'] = new \Sonata\ClassificationBundle\Entity\TagManager('Application\\Sonata\\ClassificationBundle\\Entity\\Tag', $this->get('doctrine'));
    }
    protected function getSonata_Classification_Serializer_Handler_CategoryService()
    {
        return $this->services['sonata.classification.serializer.handler.category'] = new \Sonata\ClassificationBundle\Serializer\CategorySerializerHandler($this->get('sonata.classification.manager.category'));
    }
    protected function getSonata_Classification_Serializer_Handler_CollectionService()
    {
        return $this->services['sonata.classification.serializer.handler.collection'] = new \Sonata\ClassificationBundle\Serializer\CollectionSerializerHandler($this->get('sonata.classification.manager.collection'));
    }
    protected function getSonata_Classification_Serializer_Handler_TagService()
    {
        return $this->services['sonata.classification.serializer.handler.tag'] = new \Sonata\ClassificationBundle\Serializer\TagSerializerHandler($this->get('sonata.classification.manager.tag'));
    }
    protected function getSonata_Comment_Admin_CommentService()
    {
        $instance = new \Sonata\CommentBundle\Admin\Entity\CommentAdmin('sonata.comment.admin.comment', 'Application\\Sonata\\CommentBundle\\Entity\\Comment', 'SonataAdminBundle:CRUD');
        $instance->setTranslationDomain('SonataCommentBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('-');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Comment_Admin_ThreadService()
    {
        $a = $this->get('sonata.admin.label.strategy.underscore');
        $b = $this->get('sonata.admin.manager.orm');
        $c = $this->get('sonata.admin.builder.orm_form');
        $d = $this->get('sonata.admin.builder.orm_show');
        $e = $this->get('sonata.admin.builder.orm_list');
        $f = $this->get('sonata.admin.builder.orm_datagrid');
        $g = $this->get('translator.default');
        $h = $this->get('sonata.admin.pool');
        $i = $this->get('sonata.admin.route.default_generator');
        $j = $this->get('validator');
        $k = $this->get('sonata.admin.security.handler');
        $l = $this->get('knp_menu.factory');
        $m = $this->get('sonata.admin.route.path_info');
        $n = $this->get('sonata.admin.event.extension');
        $o = $this->get('sonata.timeline.admin.extension');
        $p = new \Sonata\CommentBundle\Admin\Entity\CommentAdmin('sonata.comment.admin.comment', 'Application\\Sonata\\CommentBundle\\Entity\\Comment', 'SonataAdminBundle:CRUD');
        $p->setTranslationDomain('SonataCommentBundle');
        $p->setLabelTranslatorStrategy($a);
        $p->setManagerType('orm');
        $p->setModelManager($b);
        $p->setFormContractor($c);
        $p->setShowBuilder($d);
        $p->setListBuilder($e);
        $p->setDatagridBuilder($f);
        $p->setTranslator($g);
        $p->setConfigurationPool($h);
        $p->setRouteGenerator($i);
        $p->setValidator($j);
        $p->setSecurityHandler($k);
        $p->setMenuFactory($l);
        $p->setRouteBuilder($m);
        $p->setLabel('-');
        $p->setPersistFilters(false);
        $p->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $p->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $p->initialize();
        $p->addExtension($n);
        $p->addExtension($o);
        $p->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $p->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $instance = new \Sonata\CommentBundle\Admin\Entity\ThreadAdmin('sonata.comment.admin.thread', 'Application\\Sonata\\CommentBundle\\Entity\\Thread', 'SonataAdminBundle:CRUD');
        $instance->setTranslationDomain('SonataCommentBundle');
        $instance->addChild($p);
        $instance->setLabelTranslatorStrategy($a);
        $instance->setManagerType('orm');
        $instance->setModelManager($b);
        $instance->setFormContractor($c);
        $instance->setShowBuilder($d);
        $instance->setListBuilder($e);
        $instance->setDatagridBuilder($f);
        $instance->setTranslator($g);
        $instance->setConfigurationPool($h);
        $instance->setRouteGenerator($i);
        $instance->setValidator($j);
        $instance->setSecurityHandler($k);
        $instance->setMenuFactory($l);
        $instance->setRouteBuilder($m);
        $instance->setLabel('conversation');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($n);
        $instance->addExtension($o);
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Comment_Block_Thread_AsyncService()
    {
        return $this->services['sonata.comment.block.thread.async'] = new \Sonata\CommentBundle\Block\CommentThreadAsyncBlockService('sonata.comment.block.thread.async', $this->get('templating'));
    }
    protected function getSonata_Comment_Event_Sonata_CommentService()
    {
        $this->services['sonata.comment.event.sonata.comment'] = $instance = new \Sonata\CommentBundle\Event\CommentThreadAsyncListener();
        $instance->setBlockService($this->get('sonata.comment.block.thread.async'));
        return $instance;
    }
    protected function getSonata_Comment_Form_CommentStatusTypeService()
    {
        return $this->services['sonata.comment.form.comment_status_type'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\CommentBundle\\Entity\\Comment', 'getStateList', 'sonata_comment_status');
    }
    protected function getSonata_Comment_Form_CommentTypeService()
    {
        $this->services['sonata.comment.form.comment_type'] = $instance = new \Sonata\CommentBundle\Form\CommentType($this->get('sonata.comment.note.provider'));
        $instance->setIsSignedInterface(false);
        return $instance;
    }
    protected function getSonata_Comment_Manager_CommentService()
    {
        return $this->services['sonata.comment.manager.comment'] = new \Sonata\CommentBundle\Manager\CommentManager($this->get('event_dispatcher'), $this->get('fos_comment.sorting_factory'), $this->get('fos_comment.entity_manager'), 'Application\\Sonata\\CommentBundle\\Entity\\Comment');
    }
    protected function getSonata_Comment_Manager_ThreadService()
    {
        return $this->services['sonata.comment.manager.thread'] = new \Sonata\CommentBundle\Manager\ThreadManager($this->get('sonata.comment.manager.comment'), $this->get('event_dispatcher'), $this->get('fos_comment.entity_manager'), 'Application\\Sonata\\CommentBundle\\Entity\\Thread');
    }
    protected function getSonata_Comment_Note_ProviderService()
    {
        return $this->services['sonata.comment.note.provider'] = new \Sonata\CommentBundle\Note\NoteProvider($this->get('sonata.comment.manager.comment'), array(0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5));
    }
    protected function getSonata_Comment_Status_CommentRendererService()
    {
        return $this->services['sonata.comment.status.comment_renderer'] = new \Sonata\CommentBundle\Renderer\CommentStatusRenderer();
    }
    protected function getSonata_Core_Date_MomentFormatConverterService()
    {
        return $this->services['sonata.core.date.moment_format_converter'] = new \Sonata\CoreBundle\Date\MomentFormatConverter();
    }
    protected function getSonata_Core_Flashmessage_ManagerService()
    {
        return $this->services['sonata.core.flashmessage.manager'] = new \Sonata\CoreBundle\FlashMessage\FlashManager($this->get('session'), $this->get('translator.default'), array('error' => array('sonata_product_error' => array('domain' => 'SonataProductBundle')), 'success' => array('sonata_customer_success' => array('domain' => 'SonataCustomerBundle'), 'success' => array('domain' => 'SonataCoreBundle'), 'sonata_flash_success' => array('domain' => 'SonataAdminBundle'), 'sonata_user_success' => array('domain' => 'SonataUserBundle'), 'fos_user_success' => array('domain' => 'FOSUserBundle')), 'warning' => array('warning' => array('domain' => 'SonataCoreBundle'), 'sonata_flash_info' => array('domain' => 'SonataAdminBundle')), 'danger' => array('error' => array('domain' => 'SonataCoreBundle'), 'sonata_flash_error' => array('domain' => 'SonataAdminBundle'), 'sonata_user_error' => array('domain' => 'SonataUserBundle'))), array('error' => 'danger', 'success' => 'success', 'warning' => 'warning', 'danger' => 'danger'));
    }
    protected function getSonata_Core_Flashmessage_Twig_ExtensionService()
    {
        return $this->services['sonata.core.flashmessage.twig.extension'] = new \Sonata\CoreBundle\Twig\Extension\FlashMessageExtension($this->get('sonata.core.flashmessage.manager'));
    }
    protected function getSonata_Core_Form_Type_ArrayService()
    {
        return $this->services['sonata.core.form.type.array'] = new \Sonata\CoreBundle\Form\Type\ImmutableArrayType();
    }
    protected function getSonata_Core_Form_Type_BooleanService()
    {
        return $this->services['sonata.core.form.type.boolean'] = new \Sonata\CoreBundle\Form\Type\BooleanType();
    }
    protected function getSonata_Core_Form_Type_CollectionService()
    {
        return $this->services['sonata.core.form.type.collection'] = new \Sonata\CoreBundle\Form\Type\CollectionType();
    }
    protected function getSonata_Core_Form_Type_DatePickerService()
    {
        return $this->services['sonata.core.form.type.date_picker'] = new \Sonata\CoreBundle\Form\Type\DatePickerType($this->get('sonata.core.date.moment_format_converter'));
    }
    protected function getSonata_Core_Form_Type_DateRangeService()
    {
        return $this->services['sonata.core.form.type.date_range'] = new \Sonata\CoreBundle\Form\Type\DateRangeType($this->get('translator.default'));
    }
    protected function getSonata_Core_Form_Type_DatetimePickerService()
    {
        return $this->services['sonata.core.form.type.datetime_picker'] = new \Sonata\CoreBundle\Form\Type\DateTimePickerType($this->get('sonata.core.date.moment_format_converter'));
    }
    protected function getSonata_Core_Form_Type_DatetimeRangeService()
    {
        return $this->services['sonata.core.form.type.datetime_range'] = new \Sonata\CoreBundle\Form\Type\DateTimeRangeType($this->get('translator.default'));
    }
    protected function getSonata_Core_Form_Type_EqualService()
    {
        return $this->services['sonata.core.form.type.equal'] = new \Sonata\CoreBundle\Form\Type\EqualType($this->get('translator.default'));
    }
    protected function getSonata_Core_Form_Type_TranslatableChoiceService()
    {
        return $this->services['sonata.core.form.type.translatable_choice'] = new \Sonata\CoreBundle\Form\Type\TranslatableChoiceType($this->get('translator.default'));
    }
    protected function getSonata_Core_Model_Adapter_ChainService()
    {
        $this->services['sonata.core.model.adapter.chain'] = $instance = new \Sonata\CoreBundle\Model\Adapter\AdapterChain();
        $instance->addAdapter(new \Sonata\CoreBundle\Model\Adapter\DoctrineORMAdapter($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        return $instance;
    }
    protected function getSonata_Core_Slugify_CocurService()
    {
        return $this->services['sonata.core.slugify.cocur'] = new \Cocur\Slugify\Slugify();
    }
    protected function getSonata_Core_Slugify_NativeService()
    {
        return $this->services['sonata.core.slugify.native'] = new \Sonata\CoreBundle\Component\NativeSlugify();
    }
    protected function getSonata_Core_Twig_Extension_TextService()
    {
        return $this->services['sonata.core.twig.extension.text'] = new \Twig_Extensions_Extension_Text();
    }
    protected function getSonata_Core_Twig_Extension_WrappingService()
    {
        return $this->services['sonata.core.twig.extension.wrapping'] = new \Sonata\CoreBundle\Twig\Extension\FormTypeExtension('standard');
    }
    protected function getSonata_Core_Twig_StatusExtensionService()
    {
        $this->services['sonata.core.twig.status_extension'] = $instance = new \Sonata\CoreBundle\Twig\Extension\StatusExtension();
        $instance->addStatusService($this->get('sonata.news.status.comment'));
        $instance->addStatusService($this->get('sonata.invoice.status.renderer'));
        $instance->addStatusService($this->get('sonata.order.status.renderer'));
        $instance->addStatusService($this->get('sonata.comment.status.comment_renderer'));
        $instance->addStatusService($this->get('sonata.core.flashmessage.manager'));
        return $instance;
    }
    protected function getSonata_Core_Twig_TemplateExtensionService()
    {
        return $this->services['sonata.core.twig.template_extension'] = new \Sonata\CoreBundle\Twig\Extension\TemplateExtension(false, $this->get('translator.default'), $this->get('sonata.core.model.adapter.chain'));
    }
    protected function getSonata_Core_Validator_InlineService()
    {
        return $this->services['sonata.core.validator.inline'] = new \Sonata\CoreBundle\Validator\InlineValidator($this, $this->get('validator.validator_factory'));
    }
    protected function getSonata_Customer_Admin_AddressService()
    {
        $instance = new \Sonata\CustomerBundle\Admin\AddressAdmin('sonata.customer.admin.address', 'Application\\Sonata\\CustomerBundle\\Entity\\Address', 'SonataAdminBundle:CRUD');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('address');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Customer_Admin_CustomerService()
    {
        $a = $this->get('sonata.admin.label.strategy.underscore');
        $b = $this->get('sonata.admin.manager.orm');
        $c = $this->get('sonata.admin.builder.orm_form');
        $d = $this->get('sonata.admin.builder.orm_show');
        $e = $this->get('sonata.admin.builder.orm_list');
        $f = $this->get('sonata.admin.builder.orm_datagrid');
        $g = $this->get('translator.default');
        $h = $this->get('sonata.admin.pool');
        $i = $this->get('sonata.admin.route.default_generator');
        $j = $this->get('validator');
        $k = $this->get('sonata.admin.security.handler');
        $l = $this->get('knp_menu.factory');
        $m = $this->get('sonata.admin.route.path_info');
        $n = $this->get('sonata.admin.event.extension');
        $o = $this->get('sonata.timeline.admin.extension');
        $p = $this->get('sonata.price.currency.detector');
        $q = new \Sonata\CustomerBundle\Admin\AddressAdmin('sonata.customer.admin.address', 'Application\\Sonata\\CustomerBundle\\Entity\\Address', 'SonataAdminBundle:CRUD');
        $q->setLabelTranslatorStrategy($a);
        $q->setManagerType('orm');
        $q->setModelManager($b);
        $q->setFormContractor($c);
        $q->setShowBuilder($d);
        $q->setListBuilder($e);
        $q->setDatagridBuilder($f);
        $q->setTranslator($g);
        $q->setConfigurationPool($h);
        $q->setRouteGenerator($i);
        $q->setValidator($j);
        $q->setSecurityHandler($k);
        $q->setMenuFactory($l);
        $q->setRouteBuilder($m);
        $q->setLabel('address');
        $q->setPersistFilters(false);
        $q->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $q->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $q->initialize();
        $q->addExtension($n);
        $q->addExtension($o);
        $q->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $q->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $r = new \Sonata\OrderBundle\Admin\OrderElementAdmin('sonata.order.admin.order_element', 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'SonataAdminBundle:CRUD');
        $r->setCurrencyDetector($p);
        $r->setProductPool($this->get('sonata.product.pool'));
        $r->setLabelTranslatorStrategy($a);
        $r->setManagerType('orm');
        $r->setModelManager($b);
        $r->setFormContractor($c);
        $r->setShowBuilder($d);
        $r->setListBuilder($e);
        $r->setDatagridBuilder($f);
        $r->setTranslator($g);
        $r->setConfigurationPool($h);
        $r->setRouteGenerator($i);
        $r->setValidator($j);
        $r->setSecurityHandler($k);
        $r->setMenuFactory($l);
        $r->setRouteBuilder($m);
        $r->setLabel('orderElement');
        $r->setPersistFilters(false);
        $r->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $r->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $r->initialize();
        $r->addExtension($n);
        $r->addExtension($o);
        $r->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $r->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $s = new \Sonata\OrderBundle\Admin\OrderAdmin('sonata.order.admin.order', 'Application\\Sonata\\OrderBundle\\Entity\\Order', 'SonataOrderBundle:OrderCRUD');
        $s->addChild($r);
        $s->setCurrencyDetector($p);
        $s->setInvoiceManager($this->get('sonata.invoice.manager'));
        $s->setOrderManager($this->get('sonata.order.manager'));
        $s->setLabelTranslatorStrategy($a);
        $s->setManagerType('orm');
        $s->setModelManager($b);
        $s->setFormContractor($c);
        $s->setShowBuilder($d);
        $s->setListBuilder($e);
        $s->setDatagridBuilder($f);
        $s->setTranslator($g);
        $s->setConfigurationPool($h);
        $s->setRouteGenerator($i);
        $s->setValidator($j);
        $s->setSecurityHandler($k);
        $s->setMenuFactory($l);
        $s->setRouteBuilder($m);
        $s->setLabel('order');
        $s->setPersistFilters(false);
        $s->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $s->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $s->initialize();
        $s->addExtension($n);
        $s->addExtension($o);
        $s->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $s->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $instance = new \Sonata\CustomerBundle\Admin\CustomerAdmin('sonata.customer.admin.customer', 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'SonataAdminBundle:CRUD');
        $instance->addChild($q);
        $instance->addChild($s);
        $instance->setLabelTranslatorStrategy($a);
        $instance->setManagerType('orm');
        $instance->setModelManager($b);
        $instance->setFormContractor($c);
        $instance->setShowBuilder($d);
        $instance->setListBuilder($e);
        $instance->setDatagridBuilder($f);
        $instance->setTranslator($g);
        $instance->setConfigurationPool($h);
        $instance->setRouteGenerator($i);
        $instance->setValidator($j);
        $instance->setSecurityHandler($k);
        $instance->setMenuFactory($l);
        $instance->setRouteBuilder($m);
        $instance->setLabel('customer');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($n);
        $instance->addExtension($o);
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Customer_Api_Form_Type_AddressService()
    {
        return $this->services['sonata.customer.api.form.type.address'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_customer_api_form_address', 'Application\\Sonata\\CustomerBundle\\Entity\\Address', 'sonata_api_write');
    }
    protected function getSonata_Customer_Api_Form_Type_CustomerService()
    {
        return $this->services['sonata.customer.api.form.type.customer'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_customer_api_form_customer', 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'sonata_api_write');
    }
    protected function getSonata_Customer_Block_BreadcrumbAddressService()
    {
        return $this->services['sonata.customer.block.breadcrumb_address'] = new \Sonata\CustomerBundle\Block\Breadcrumb\CustomerAddressBreadcrumbBlockService('customer_address', 'sonata.customer.block.breadcrumb_address', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_Customer_Block_RecentCustomersService()
    {
        return $this->services['sonata.customer.block.recent_customers'] = new \Sonata\CustomerBundle\Block\RecentCustomersBlockService('sonata.customer.block.recent_customers', $this->get('templating'), $this->get('sonata.customer.manager'));
    }
    protected function getSonata_Customer_Controller_Api_AddressService()
    {
        return $this->services['sonata.customer.controller.api.address'] = new \Sonata\CustomerBundle\Controller\Api\AddressController($this->get('sonata.address.manager'), $this->get('form.factory'));
    }
    protected function getSonata_Customer_Controller_Api_CustomerService()
    {
        return $this->services['sonata.customer.controller.api.customer'] = new \Sonata\CustomerBundle\Controller\Api\CustomerController($this->get('sonata.customer.manager'), $this->get('sonata.order.manager'), $this->get('sonata.address.manager'), $this->get('form.factory'));
    }
    protected function getSonata_Customer_Form_AddressTypeService()
    {
        return $this->services['sonata.customer.form.address_type'] = new \Sonata\CustomerBundle\Form\AddressType('Application\\Sonata\\CustomerBundle\\Entity\\Address', 'getTypesList', 'sonata_customer_address', $this->get('sonata.basket'));
    }
    protected function getSonata_Customer_Form_AddressTypesTypeService()
    {
        return $this->services['sonata.customer.form.address_types_type'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\CustomerBundle\\Entity\\Address', 'getTypesList', 'sonata_customer_address_types');
    }
    protected function getSonata_Customer_ManagerService()
    {
        return $this->services['sonata.customer.manager'] = new \Sonata\CustomerBundle\Entity\CustomerManager('Application\\Sonata\\CustomerBundle\\Entity\\Customer', $this->get('doctrine'));
    }
    protected function getSonata_Customer_SelectorService()
    {
        return $this->services['sonata.customer.selector'] = new \Sonata\Component\Customer\CustomerSelector($this->get('sonata.customer.manager'), $this->get('session'), $this->get('security.context'), $this->get('sonata.intl.locale_detector.request'));
    }
    protected function getSonata_Customer_Serializer_Handler_CustomerService()
    {
        return $this->services['sonata.customer.serializer.handler.customer'] = new \Sonata\CustomerBundle\Serializer\CustomerSerializerHandler($this->get('sonata.customer.manager'));
    }
    protected function getSonata_Delivery_Form_DeliveryChoiceTypeService()
    {
        return $this->services['sonata.delivery.form.delivery_choice_type'] = new \Sonata\Component\Form\Type\DeliveryChoiceType($this->get('sonata.delivery.pool'));
    }
    protected function getSonata_Delivery_ManagerService()
    {
        return $this->services['sonata.delivery.manager'] = new \Sonata\ProductBundle\Entity\DeliveryManager('Application\\Sonata\\ProductBundle\\Entity\\Delivery', $this->get('doctrine'));
    }
    protected function getSonata_Delivery_Method_FreeAddressRequiredService()
    {
        $this->services['sonata.delivery.method.free_address_required'] = $instance = new \Sonata\Component\Delivery\FreeDelivery(true);
        $instance->setName('Free');
        $instance->setCode('free');
        $instance->setPriority(1);
        $instance->setEnabled(true);
        return $instance;
    }
    protected function getSonata_Delivery_PoolService()
    {
        $this->services['sonata.delivery.pool'] = $instance = new \Sonata\Component\Delivery\Pool();
        $instance->addMethod($this->get('sonata.delivery.method.free_address_required'));
        $instance->addMethod($this->get('application.sonata.delivery.take_away'));
        return $instance;
    }
    protected function getSonata_Delivery_Selector_DefaultService()
    {
        $this->services['sonata.delivery.selector.default'] = $instance = new \Sonata\Component\Delivery\Selector($this->get('sonata.delivery.pool'), $this->get('sonata.product.pool'));
        $instance->setLogger($this->get('logger'));
        return $instance;
    }
    protected function getSonata_Demo_Admin_CarService()
    {
        $instance = new \Sonata\Bundle\DemoBundle\Admin\CarAdmin('sonata.demo.admin.car', 'Sonata\\Bundle\\DemoBundle\\Entity\\Car', 'SonataAdminBundle:CRUD');
        $instance->setSubClasses(array('renault' => 'Sonata\\Bundle\\DemoBundle\\Entity\\Renault', 'citroen' => 'Sonata\\Bundle\\DemoBundle\\Entity\\Citroen', 'peugeot' => 'Sonata\\Bundle\\DemoBundle\\Entity\\Peugeot'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('Car');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Demo_Admin_ColorService()
    {
        $instance = new \Sonata\Bundle\DemoBundle\Admin\ColorAdmin('sonata.demo.admin.color', 'Sonata\\Bundle\\DemoBundle\\Entity\\Color', 'SonataAdminBundle:CRUD');
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('Color');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Demo_Admin_EngineService()
    {
        $instance = new \Sonata\Bundle\DemoBundle\Admin\EngineAdmin('sonata.demo.admin.engine', 'Sonata\\Bundle\\DemoBundle\\Entity\\Engine', 'SonataAdminBundle:CRUD');
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('Engine');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Demo_Admin_InspectionService()
    {
        $instance = new \Sonata\Bundle\DemoBundle\Admin\InspectionAdmin('sonata.demo.admin.inspection', 'Sonata\\Bundle\\DemoBundle\\Entity\\Inspection', 'SonataAdminBundle:CRUD');
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('Inspection');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Demo_Admin_MaterialService()
    {
        $instance = new \Sonata\Bundle\DemoBundle\Admin\MaterialAdmin('sonata.demo.admin.material', 'Sonata\\Bundle\\DemoBundle\\Entity\\Material', 'SonataAdminBundle:CRUD');
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('Material');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Demo_Block_NewsletterService()
    {
        return $this->services['sonata.demo.block.newsletter'] = new \Sonata\Bundle\DemoBundle\Block\NewsletterBlockService('sonata.demo.block.newsletter', $this->get('templating'), $this->get('form.factory'), 'sonata_demo_form_type_newsletter');
    }
    protected function getSonata_Demo_Form_Type_AdvancedRescueEngineService()
    {
        return $this->services['sonata.demo.form.type.advanced_rescue_engine'] = new \Sonata\Bundle\DemoBundle\Form\Extension\RescueEngineTypeExtension();
    }
    protected function getSonata_Demo_Form_Type_CarService()
    {
        return $this->services['sonata.demo.form.type.car'] = new \Sonata\Bundle\DemoBundle\Form\Type\CarType();
    }
    protected function getSonata_Demo_Form_Type_EngineService()
    {
        return $this->services['sonata.demo.form.type.engine'] = new \Sonata\Bundle\DemoBundle\Form\Type\EngineType();
    }
    protected function getSonata_Demo_Form_Type_NewsletterService()
    {
        return $this->services['sonata.demo.form.type.newsletter'] = new \Sonata\Bundle\DemoBundle\Form\Type\NewsletterType();
    }
    protected function getSonata_EasyExtends_Doctrine_MapperService()
    {
        $this->services['sonata.easy_extends.doctrine.mapper'] = $instance = new \Sonata\EasyExtendsBundle\Mapper\DoctrineORMMapper($this->get('doctrine'), array());
        $instance->addAssociation('Application\\Sonata\\UserBundle\\Entity\\User', 'mapManyToMany', array(0 => array('fieldName' => 'groups', 'targetEntity' => 'Application\\Sonata\\UserBundle\\Entity\\Group', 'cascade' => array(), 'joinTable' => array('name' => 'fos_user_user_group', 'joinColumns' => array(0 => array('name' => 'user_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'inverseJoinColumns' => array(0 => array('name' => 'group_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE'))))));
        $instance->addAssociation('Application\\Sonata\\PageBundle\\Entity\\Page', 'mapOneToMany', array(0 => array('fieldName' => 'children', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Page', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'parent', 'orphanRemoval' => false, 'orderBy' => array('position' => 'ASC')), 1 => array('fieldName' => 'blocks', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Block', 'cascade' => array(0 => 'remove', 1 => 'persist', 2 => 'refresh', 3 => 'merge', 4 => 'detach'), 'mappedBy' => 'page', 'orphanRemoval' => false, 'orderBy' => array('position' => 'ASC')), 2 => array('fieldName' => 'sources', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Page', 'cascade' => array(), 'mappedBy' => 'target', 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\PageBundle\\Entity\\Page', 'mapManyToOne', array(0 => array('fieldName' => 'site', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Site', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'site_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'parent', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Page', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'children', 'joinColumns' => array(0 => array('name' => 'parent_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false), 2 => array('fieldName' => 'target', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Page', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'sources', 'joinColumns' => array(0 => array('name' => 'target_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\PageBundle\\Entity\\Block', 'mapOneToMany', array(0 => array('fieldName' => 'children', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Block', 'cascade' => array(0 => 'remove', 1 => 'persist'), 'mappedBy' => 'parent', 'orphanRemoval' => true, 'orderBy' => array('position' => 'ASC'))));
        $instance->addAssociation('Application\\Sonata\\PageBundle\\Entity\\Block', 'mapManyToOne', array(0 => array('fieldName' => 'parent', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Block', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => 'children', 'joinColumns' => array(0 => array('name' => 'parent_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'page', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Page', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'blocks', 'joinColumns' => array(0 => array('name' => 'page_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\PageBundle\\Entity\\Snapshot', 'mapManyToOne', array(0 => array('fieldName' => 'site', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Site', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'site_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'page', 'targetEntity' => 'Application\\Sonata\\PageBundle\\Entity\\Page', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'page_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\NewsBundle\\Entity\\Post', 'mapOneToMany', array(0 => array('fieldName' => 'comments', 'targetEntity' => 'Application\\Sonata\\NewsBundle\\Entity\\Comment', 'cascade' => array(0 => 'remove', 1 => 'persist'), 'mappedBy' => 'post', 'orphanRemoval' => true, 'orderBy' => array('createdAt' => 'DESC'))));
        $instance->addAssociation('Application\\Sonata\\NewsBundle\\Entity\\Post', 'mapManyToOne', array(0 => array('fieldName' => 'image', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\Media', 'cascade' => array(0 => 'remove', 1 => 'persist', 2 => 'refresh', 3 => 'merge', 4 => 'detach'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'image_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false), 1 => array('fieldName' => 'author', 'targetEntity' => 'Application\\Sonata\\UserBundle\\Entity\\User', 'cascade' => array(1 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'author_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false), 2 => array('fieldName' => 'collection', 'targetEntity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection', 'cascade' => array(1 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'collection_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\NewsBundle\\Entity\\Post', 'mapManyToMany', array(0 => array('fieldName' => 'tags', 'targetEntity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag', 'cascade' => array(1 => 'persist'), 'joinTable' => array('name' => 'news__post_tag', 'joinColumns' => array(0 => array('name' => 'post_id', 'referencedColumnName' => 'id')), 'inverseJoinColumns' => array(0 => array('name' => 'tag_id', 'referencedColumnName' => 'id'))))));
        $instance->addAssociation('Application\\Sonata\\NewsBundle\\Entity\\Comment', 'mapManyToOne', array(0 => array('fieldName' => 'post', 'targetEntity' => 'Application\\Sonata\\NewsBundle\\Entity\\Post', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => 'comments', 'joinColumns' => array(0 => array('name' => 'post_id', 'referencedColumnName' => 'id', 'nullable' => false)), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\MediaBundle\\Entity\\Media', 'mapOneToMany', array(0 => array('fieldName' => 'galleryHasMedias', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'media', 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia', 'mapManyToOne', array(0 => array('fieldName' => 'gallery', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\Gallery', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'galleryHasMedias', 'joinColumns' => array(0 => array('name' => 'gallery_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false), 1 => array('fieldName' => 'media', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\Media', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'galleryHasMedias', 'joinColumns' => array(0 => array('name' => 'media_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\MediaBundle\\Entity\\Gallery', 'mapOneToMany', array(0 => array('fieldName' => 'galleryHasMedias', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'gallery', 'orphanRemoval' => true, 'orderBy' => array('position' => 'ASC'))));
        $instance->addAssociation('Application\\Sonata\\BasketBundle\\Entity\\Basket', 'mapManyToOne', array(0 => array('fieldName' => 'customer', 'targetEntity' => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'customer_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE', 'unique' => true)), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\BasketBundle\\Entity\\Basket', 'mapOneToMany', array(0 => array('fieldName' => 'basketElements', 'targetEntity' => 'Application\\Sonata\\BasketBundle\\Entity\\BasketElement', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'basket', 'orphanRemoval' => true)));
        $instance->addAssociation('Application\\Sonata\\BasketBundle\\Entity\\BasketElement', 'mapManyToOne', array(0 => array('fieldName' => 'basket', 'targetEntity' => 'Application\\Sonata\\BasketBundle\\Entity\\Basket', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => 'basketElements', 'joinColumns' => array(0 => array('name' => 'basket_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'mapOneToMany', array(0 => array('fieldName' => 'addresses', 'targetEntity' => 'Application\\Sonata\\CustomerBundle\\Entity\\Address', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'customer', 'orphanRemoval' => false), 1 => array('fieldName' => 'orders', 'targetEntity' => 'Application\\Sonata\\OrderBundle\\Entity\\Order', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'customer', 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'mapManyToOne', array(0 => array('fieldName' => 'user', 'targetEntity' => 'Application\\Sonata\\UserBundle\\Entity\\User', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'customers', 'joinColumns' => array(0 => array('name' => 'user_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\CustomerBundle\\Entity\\Address', 'mapManyToOne', array(0 => array('fieldName' => 'customer', 'targetEntity' => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'addresses', 'joinColumns' => array(0 => array('name' => 'customer_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', 'mapManyToOne', array(0 => array('fieldName' => 'customer', 'targetEntity' => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'cascade' => array(0 => 'persist', 1 => 'refresh', 2 => 'merge', 3 => 'detach'), 'mappedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'customer_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', 'mapOneToMany', array(0 => array('fieldName' => 'invoiceElements', 'targetEntity' => 'Application\\Sonata\\InvoiceBundle\\Entity\\InvoiceElement', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'invoice', 'orphanRemoval' => true)));
        $instance->addAssociation('Application\\Sonata\\InvoiceBundle\\Entity\\InvoiceElement', 'mapManyToOne', array(0 => array('fieldName' => 'invoice', 'targetEntity' => 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', 'cascade' => array(0 => 'persist', 1 => 'refresh', 2 => 'merge', 3 => 'detach'), 'mappedBy' => NULL, 'inversedBy' => 'invoiceElements', 'joinColumns' => array(0 => array('name' => 'invoice_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'orderElement', 'targetEntity' => 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'cascade' => array(), 'joinColumns' => array(0 => array('name' => 'order_element_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')))));
        $instance->addAssociation('Application\\Sonata\\OrderBundle\\Entity\\Order', 'mapOneToMany', array(0 => array('fieldName' => 'orderElements', 'targetEntity' => 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'order', 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\OrderBundle\\Entity\\Order', 'mapManyToOne', array(0 => array('fieldName' => 'customer', 'targetEntity' => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => 'orders', 'joinColumns' => array(0 => array('name' => 'customer_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'mapManyToOne', array(0 => array('fieldName' => 'order', 'targetEntity' => 'Application\\Sonata\\OrderBundle\\Entity\\Order', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'order_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\PaymentBundle\\Entity\\Transaction', 'mapManyToOne', array(0 => array('fieldName' => 'order', 'targetEntity' => 'Application\\Sonata\\OrderBundle\\Entity\\Order', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'order_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ProductBundle\\Entity\\Delivery', 'mapManyToOne', array(0 => array('fieldName' => 'product', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'deliveries', 'joinColumns' => array(0 => array('name' => 'product_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ProductBundle\\Entity\\Package', 'mapManyToOne', array(0 => array('fieldName' => 'product', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'packages', 'joinColumns' => array(0 => array('name' => 'product_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ProductBundle\\Entity\\ProductCategory', 'mapManyToOne', array(0 => array('fieldName' => 'product', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'productCategories', 'joinColumns' => array(0 => array('name' => 'product_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE', 'onUpdate' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'category', 'targetEntity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'category_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE', 'onUpdate' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ProductBundle\\Entity\\ProductCollection', 'mapManyToOne', array(0 => array('fieldName' => 'product', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'productCollections', 'joinColumns' => array(0 => array('name' => 'product_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE', 'onUpdate' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'collection', 'targetEntity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'productCollection', 'joinColumns' => array(0 => array('name' => 'collection_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE', 'onUpdate' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ProductBundle\\Entity\\Product', 'mapOneToMany', array(0 => array('fieldName' => 'packages', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Package', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'product', 'orphanRemoval' => false), 1 => array('fieldName' => 'deliveries', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Delivery', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'product', 'orphanRemoval' => false), 2 => array('fieldName' => 'productCategories', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'product', 'orphanRemoval' => false), 3 => array('fieldName' => 'productCollections', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'product', 'orphanRemoval' => false), 4 => array('fieldName' => 'variations', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'parent', 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ProductBundle\\Entity\\Product', 'mapManyToOne', array(0 => array('fieldName' => 'image', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\Media', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'image_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false), 1 => array('fieldName' => 'gallery', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\Gallery', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'gallery_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false), 2 => array('fieldName' => 'parent', 'targetEntity' => 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'variations', 'joinColumns' => array(0 => array('name' => 'parent_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\CommentBundle\\Entity\\Comment', 'mapManyToOne', array(0 => array('fieldName' => 'thread', 'targetEntity' => 'Application\\Sonata\\CommentBundle\\Entity\\Thread', 'cascade' => array())));
        $instance->addAssociation('Application\\Sonata\\CommentBundle\\Entity\\Thread', 'mapManyToOne', array(0 => array('fieldName' => 'category', 'targetEntity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'category_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE', 'onUpdate' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'mapOneToMany', array(0 => array('fieldName' => 'children', 'targetEntity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'cascade' => array(0 => 'remove', 1 => 'persist'), 'mappedBy' => 'parent', 'orphanRemoval' => true, 'orderBy' => array('position' => 'ASC'))));
        $instance->addAssociation('Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'mapManyToOne', array(0 => array('fieldName' => 'parent', 'targetEntity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category', 'cascade' => array(0 => 'remove', 1 => 'persist', 2 => 'refresh', 3 => 'merge', 4 => 'detach'), 'mappedBy' => NULL, 'inversedBy' => 'children', 'joinColumns' => array(0 => array('name' => 'parent_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'media', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\Media', 'cascade' => array(0 => 'remove', 1 => 'persist', 2 => 'refresh', 3 => 'merge', 4 => 'detach'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'media_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\ClassificationBundle\\Entity\\Collection', 'mapManyToOne', array(0 => array('fieldName' => 'media', 'targetEntity' => 'Application\\Sonata\\MediaBundle\\Entity\\Media', 'cascade' => array(0 => 'remove', 1 => 'persist', 2 => 'refresh', 3 => 'merge', 4 => 'detach'), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'media_id', 'referencedColumnName' => 'id', 'onDelete' => 'SET NULL')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\TimelineBundle\\Entity\\Timeline', 'mapManyToOne', array(0 => array('fieldName' => 'action', 'targetEntity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Action', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => 'timelines', 'joinColumns' => array(0 => array('name' => 'action_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false), 1 => array('fieldName' => 'subject', 'targetEntity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Component', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'subject_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addAssociation('Application\\Sonata\\TimelineBundle\\Entity\\Action', 'mapOneToMany', array(0 => array('fieldName' => 'actionComponents', 'targetEntity' => 'Application\\Sonata\\TimelineBundle\\Entity\\ActionComponent', 'cascade' => array(1 => 'persist'), 'mappedBy' => 'action'), 1 => array('fieldName' => 'timelines', 'targetEntity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Timeline', 'cascade' => array(), 'mappedBy' => 'action')));
        $instance->addAssociation('Application\\Sonata\\TimelineBundle\\Entity\\ActionComponent', 'mapManyToOne', array(0 => array('fieldName' => 'action', 'targetEntity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Action', 'cascade' => array(), 'mappedBy' => NULL, 'inversedBy' => 'actionComponents', 'joinColumns' => array(0 => array('name' => 'action_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false), 1 => array('fieldName' => 'component', 'targetEntity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Component', 'cascade' => array(), 'mappedBy' => NULL, 'joinColumns' => array(0 => array('name' => 'component_id', 'referencedColumnName' => 'id', 'onDelete' => 'CASCADE')), 'orphanRemoval' => false)));
        $instance->addIndex('Application\\Sonata\\PageBundle\\Entity\\Snapshot', 'idx_snapshot_dates_enabled', array(0 => 'publication_date_start', 1 => 'publication_date_end', 2 => 'enabled'));
        $instance->addIndex('Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'product_type', array(0 => 'product_type'));
        $instance->addIndex('Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'order_element_status', array(0 => 'status'));
        $instance->addIndex('Application\\Sonata\\OrderBundle\\Entity\\Order', 'order_status', array(0 => 'status'));
        $instance->addIndex('Application\\Sonata\\OrderBundle\\Entity\\Order', 'payment_status', array(0 => 'payment_status'));
        $instance->addIndex('Application\\Sonata\\PaymentBundle\\Entity\\Transaction', 'status_code', array(0 => 'status_code'));
        $instance->addIndex('Application\\Sonata\\PaymentBundle\\Entity\\Transaction', 'state', array(0 => 'state'));
        $instance->addIndex('Application\\Sonata\\ProductBundle\\Entity\\Product', 'enabled', array(0 => 'enabled'));
        $instance->addIndex('Application\\Sonata\\NotificationBundle\\Entity\\Message', 'idx_state', array(0 => 'state'));
        $instance->addIndex('Application\\Sonata\\NotificationBundle\\Entity\\Message', 'idx_created_at', array(0 => 'created_at'));
        return $instance;
    }
    protected function getSonata_EasyExtends_Generator_BundleService()
    {
        return $this->services['sonata.easy_extends.generator.bundle'] = new \Sonata\EasyExtendsBundle\Generator\BundleGenerator();
    }
    protected function getSonata_EasyExtends_Generator_OdmService()
    {
        return $this->services['sonata.easy_extends.generator.odm'] = new \Sonata\EasyExtendsBundle\Generator\OdmGenerator();
    }
    protected function getSonata_EasyExtends_Generator_OrmService()
    {
        return $this->services['sonata.easy_extends.generator.orm'] = new \Sonata\EasyExtendsBundle\Generator\OrmGenerator();
    }
    protected function getSonata_EasyExtends_Generator_PhpcrService()
    {
        return $this->services['sonata.easy_extends.generator.phpcr'] = new \Sonata\EasyExtendsBundle\Generator\PHPCRGenerator();
    }
    protected function getSonata_EasyExtends_Generator_SerializerService()
    {
        return $this->services['sonata.easy_extends.generator.serializer'] = new \Sonata\EasyExtendsBundle\Generator\SerializerGenerator();
    }
    protected function getSonata_EcommerceDemo_Product_Goodie_ManagerService()
    {
        return $this->services['sonata.ecommerce_demo.product.goodie.manager'] = new \Sonata\ProductBundle\Entity\ProductManager('Application\\Sonata\\ProductBundle\\Entity\\Goodie', $this->get('doctrine'));
    }
    protected function getSonata_EcommerceDemo_Product_Goodie_TypeService()
    {
        $this->services['sonata.ecommerce_demo.product.goodie.type'] = $instance = new \Application\Sonata\ProductBundle\Provider\GoodieProductProvider($this->get('jms_serializer'));
        $instance->setCode('sonata.ecommerce_demo.product.goodie');
        $instance->setBasketElementManager($this->get('sonata.basket_element.manager'));
        $instance->setCurrencyPriceCalculator($this->get('sonata.price.currency.calculator'));
        $instance->setProductCategoryManager($this->get('sonata.product_category.product'));
        $instance->setProductCollectionManager($this->get('sonata.product_collection.product'));
        $instance->setOrderElementClassName('Application\\Sonata\\OrderBundle\\Entity\\OrderElement');
        $instance->setEventDispatcher($this->get('event_dispatcher'));
        return $instance;
    }
    protected function getSonata_EcommerceDemo_Product_Travel_ManagerService()
    {
        return $this->services['sonata.ecommerce_demo.product.travel.manager'] = new \Sonata\ProductBundle\Entity\ProductManager('Application\\Sonata\\ProductBundle\\Entity\\Travel', $this->get('doctrine'));
    }
    protected function getSonata_EcommerceDemo_Product_Travel_TypeService()
    {
        $this->services['sonata.ecommerce_demo.product.travel.type'] = $instance = new \Application\Sonata\ProductBundle\Provider\TravelProductProvider($this->get('jms_serializer'));
        $instance->setCode('sonata.ecommerce_demo.product.travel');
        $instance->setBasketElementManager($this->get('sonata.basket_element.manager'));
        $instance->setCurrencyPriceCalculator($this->get('sonata.price.currency.calculator'));
        $instance->setProductCategoryManager($this->get('sonata.product_category.product'));
        $instance->setProductCollectionManager($this->get('sonata.product_collection.product'));
        $instance->setOrderElementClassName('Application\\Sonata\\OrderBundle\\Entity\\OrderElement');
        $instance->setEventDispatcher($this->get('event_dispatcher'));
        $instance->setVariationFields(array(0 => 'travellers', 1 => 'travelDays', 2 => 'sku', 3 => 'slug', 4 => 'name', 5 => 'price', 6 => 'stock', 7 => 'vatRate', 8 => 'priceIncludingVat', 9 => 'enabled'));
        return $instance;
    }
    protected function getSonata_Formatter_Block_FormatterService()
    {
        return $this->services['sonata.formatter.block.formatter'] = new \Sonata\FormatterBundle\Block\FormatterBlockService('sonata.block.empty', $this->get('templating'));
    }
    protected function getSonata_Formatter_Ckeditor_ExtensionService()
    {
        return $this->services['sonata.formatter.ckeditor.extension'] = new \Sonata\FormatterBundle\Admin\CkeditorAdminExtension();
    }
    protected function getSonata_Formatter_Form_Type_SelectorService()
    {
        return $this->services['sonata.formatter.form.type.selector'] = new \Sonata\FormatterBundle\Form\Type\FormatterType($this->get('sonata.formatter.pool'), $this->get('translator.default'), $this->get('ivory_ck_editor.config_manager'));
    }
    protected function getSonata_Formatter_PoolService()
    {
        $a = $this->get('sonata.formatter.text.raw');
        $this->services['sonata.formatter.pool'] = $instance = new \Sonata\FormatterBundle\Formatter\Pool($this->get('logger'));
        $instance->add('markdown', $this->get('sonata.formatter.text.markdown'), $this->get('sonata.formatter.twig.env.markdown'));
        $instance->add('text', $this->get('sonata.formatter.text.text'), $this->get('sonata.formatter.twig.env.text'));
        $instance->add('rawhtml', $a, $this->get('sonata.formatter.twig.env.rawhtml'));
        $instance->add('richhtml', $a, $this->get('sonata.formatter.twig.env.richhtml'));
        return $instance;
    }
    protected function getSonata_Formatter_Text_MarkdownService()
    {
        return $this->services['sonata.formatter.text.markdown'] = new \Sonata\FormatterBundle\Formatter\MarkdownFormatter($this->get('markdown.parser'));
    }
    protected function getSonata_Formatter_Text_RawService()
    {
        return $this->services['sonata.formatter.text.raw'] = new \Sonata\FormatterBundle\Formatter\RawFormatter();
    }
    protected function getSonata_Formatter_Text_TextService()
    {
        return $this->services['sonata.formatter.text.text'] = new \Sonata\FormatterBundle\Formatter\TextFormatter();
    }
    protected function getSonata_Formatter_Text_TwigengineService()
    {
        return $this->services['sonata.formatter.text.twigengine'] = new \Sonata\FormatterBundle\Formatter\TwigFormatter($this->get('twig'));
    }
    protected function getSonata_Formatter_Twig_ControlFlowService()
    {
        return $this->services['sonata.formatter.twig.control_flow'] = new \Sonata\FormatterBundle\Extension\ControlFlowExtension();
    }
    protected function getSonata_Formatter_Twig_GistService()
    {
        return $this->services['sonata.formatter.twig.gist'] = new \Sonata\FormatterBundle\Extension\GistExtension();
    }
    protected function getSonata_Formatter_Validator_FormatterService()
    {
        return $this->services['sonata.formatter.validator.formatter'] = new \Sonata\FormatterBundle\Validator\Constraints\FormatterValidator($this->get('sonata.formatter.pool'));
    }
    protected function getSonata_Intl_LocaleDetector_RequestService()
    {
        return $this->services['sonata.intl.locale_detector.request'] = new \Sonata\IntlBundle\Locale\RequestDetector($this, 'en');
    }
    protected function getSonata_Intl_Templating_Helper_DatetimeService()
    {
        return $this->services['sonata.intl.templating.helper.datetime'] = new \Sonata\IntlBundle\Templating\Helper\DateTimeHelper($this->get('sonata.intl.timezone_detector.chain'), 'UTF-8', $this->get('sonata.intl.locale_detector.request'));
    }
    protected function getSonata_Intl_Templating_Helper_LocaleService()
    {
        return $this->services['sonata.intl.templating.helper.locale'] = new \Sonata\IntlBundle\Templating\Helper\LocaleHelper('UTF-8', $this->get('sonata.intl.locale_detector.request'));
    }
    protected function getSonata_Intl_Templating_Helper_NumberService()
    {
        return $this->services['sonata.intl.templating.helper.number'] = new \Sonata\IntlBundle\Templating\Helper\NumberHelper('UTF-8', $this->get('sonata.intl.locale_detector.request'));
    }
    protected function getSonata_Intl_TimezoneDetector_ChainService()
    {
        $this->services['sonata.intl.timezone_detector.chain'] = $instance = new \Sonata\IntlBundle\Timezone\ChainTimezoneDetector('Europe/Moscow');
        $instance->addDetector($this->get('sonata.intl.timezone_detector.user'));
        $instance->addDetector($this->get('sonata.intl.timezone_detector.locale'));
        return $instance;
    }
    protected function getSonata_Intl_TimezoneDetector_LocaleService()
    {
        return $this->services['sonata.intl.timezone_detector.locale'] = new \Sonata\IntlBundle\Timezone\LocaleBasedTimezoneDetector($this->get('sonata.intl.locale_detector.request'), array());
    }
    protected function getSonata_Intl_TimezoneDetector_UserService()
    {
        return $this->services['sonata.intl.timezone_detector.user'] = new \Sonata\IntlBundle\Timezone\UserBasedTimezoneDetector($this->get('security.context'), '');
    }
    protected function getSonata_Invoice_Admin_InvoiceService()
    {
        $instance = new \Sonata\InvoiceBundle\Admin\InvoiceAdmin('sonata.invoice.admin.invoice', 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', 'SonataAdminBundle:CRUD');
        $instance->setCurrencyDetector($this->get('sonata.price.currency.detector'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('invoice');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Invoice_Controller_Api_InvoiceService()
    {
        return $this->services['sonata.invoice.controller.api.invoice'] = new \Sonata\InvoiceBundle\Controller\Api\InvoiceController($this->get('sonata.invoice.manager'));
    }
    protected function getSonata_Invoice_Form_StatusTypeService()
    {
        return $this->services['sonata.invoice.form.status_type'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', 'getStatusList', 'sonata_invoice_status');
    }
    protected function getSonata_Invoice_ManagerService()
    {
        return $this->services['sonata.invoice.manager'] = new \Sonata\InvoiceBundle\Entity\InvoiceManager('Application\\Sonata\\InvoiceBundle\\Entity\\Invoice', $this->get('doctrine'));
    }
    protected function getSonata_Invoice_Serializer_HandlerService()
    {
        return $this->services['sonata.invoice.serializer.handler'] = new \Sonata\InvoiceBundle\Serializer\InvoiceSerializerHandler($this->get('sonata.invoice.manager'));
    }
    protected function getSonata_Invoice_Status_RendererService()
    {
        return $this->services['sonata.invoice.status.renderer'] = new \Sonata\Component\Invoice\InvoiceStatusRenderer();
    }
    protected function getSonata_InvoiceElement_ManagerService()
    {
        return $this->services['sonata.invoice_element.manager'] = new \Sonata\InvoiceBundle\Entity\InvoiceElementManager('Application\\Sonata\\InvoiceBundle\\Entity\\InvoiceElement', $this->get('doctrine'));
    }
    protected function getSonata_Media_Adapter_Filesystem_LocalService()
    {
        return $this->services['sonata.media.adapter.filesystem.local'] = new \Sonata\MediaBundle\Filesystem\Local(($this->targetDirs[2].'/../web/uploads/media'), true);
    }
    protected function getSonata_Media_Adapter_Image_GdService()
    {
        return $this->services['sonata.media.adapter.image.gd'] = new \Imagine\Gd\Imagine();
    }
    protected function getSonata_Media_Adapter_Image_GmagickService()
    {
        return $this->services['sonata.media.adapter.image.gmagick'] = new \Imagine\Gmagick\Imagine();
    }
    protected function getSonata_Media_Adapter_Image_ImagickService()
    {
        return $this->services['sonata.media.adapter.image.imagick'] = new \Imagine\Imagick\Imagine();
    }
    protected function getSonata_Media_Adapter_Service_S3Service()
    {
        return $this->services['sonata.media.adapter.service.s3'] = new \AmazonS3(array());
    }
    protected function getSonata_Media_Admin_GalleryService()
    {
        $instance = new \Sonata\MediaBundle\Admin\GalleryAdmin('sonata.media.admin.gallery', 'Application\\Sonata\\MediaBundle\\Entity\\Gallery', 'SonataMediaBundle:GalleryAdmin', $this->get('sonata.media.pool'));
        $instance->setTranslationDomain('SonataMediaBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('gallery');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataMediaBundle:GalleryAdmin:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Media_Admin_GalleryHasMediaService()
    {
        $instance = new \Sonata\MediaBundle\Admin\GalleryHasMediaAdmin('sonata.media.admin.gallery_has_media', 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia', 'SonataAdminBundle:CRUD');
        $instance->setTranslationDomain('SonataMediaBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('gallery_has_media');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Media_Admin_MediaService()
    {
        $instance = new \Sonata\MediaBundle\Admin\ORM\MediaAdmin('sonata.media.admin.media', 'Application\\Sonata\\MediaBundle\\Entity\\Media', 'SonataMediaBundle:MediaAdmin', $this->get('sonata.media.pool'));
        $instance->setModelManager($this->get('sonata.media.admin.media.manager'));
        $instance->setTranslationDomain('SonataMediaBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('media');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataMediaBundle:MediaAdmin:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataMediaBundle:MediaAdmin:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataMediaBundle:MediaAdmin:inner_row_media.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_flat_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.formatter.ckeditor.extension'));
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Media_Admin_Media_ManagerService()
    {
        return $this->services['sonata.media.admin.media.manager'] = new \Sonata\MediaBundle\Admin\Manager\DoctrineORMManager($this->get('doctrine'), $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Api_Form_Type_Doctrine_MediaService()
    {
        return $this->services['sonata.media.api.form.type.doctrine.media'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_media_api_form_doctrine_media', 'Application\\Sonata\\MediaBundle\\Entity\\Media', 'sonata_api_write');
    }
    protected function getSonata_Media_Api_Form_Type_GalleryService()
    {
        return $this->services['sonata.media.api.form.type.gallery'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_media_api_form_gallery', 'Application\\Sonata\\MediaBundle\\Entity\\Gallery', 'sonata_api_write');
    }
    protected function getSonata_Media_Api_Form_Type_GalleryHasMediaService()
    {
        return $this->services['sonata.media.api.form.type.gallery_has_media'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_media_api_form_gallery_has_media', 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia', 'sonata_api_write');
    }
    protected function getSonata_Media_Api_Form_Type_MediaService()
    {
        return $this->services['sonata.media.api.form.type.media'] = new \Sonata\MediaBundle\Form\Type\ApiMediaType($this->get('sonata.media.pool'), 'Application\\Sonata\\MediaBundle\\Entity\\Media');
    }
    protected function getSonata_Media_Block_BreadcrumbIndexService()
    {
        return $this->services['sonata.media.block.breadcrumb_index'] = new \Sonata\MediaBundle\Block\Breadcrumb\GalleryIndexBreadcrumbBlockService('gallery_index', 'sonata.media.block.breadcrumb_view', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_Media_Block_BreadcrumbViewService()
    {
        return $this->services['sonata.media.block.breadcrumb_view'] = new \Sonata\MediaBundle\Block\Breadcrumb\GalleryViewBreadcrumbBlockService('gallery_view', 'sonata.media.block.breadcrumb_view', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_Media_Block_BreadcrumbViewMediaService()
    {
        return $this->services['sonata.media.block.breadcrumb_view_media'] = new \Sonata\MediaBundle\Block\Breadcrumb\MediaViewBreadcrumbBlockService('media_view', 'sonata.media.block.breadcrumb_view_media', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_Media_Block_FeatureMediaService()
    {
        return $this->services['sonata.media.block.feature_media'] = new \Sonata\MediaBundle\Block\FeatureMediaBlockService('sonata.media.block.feature_media', $this->get('templating'), $this, $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Block_GalleryService()
    {
        return $this->services['sonata.media.block.gallery'] = new \Sonata\MediaBundle\Block\GalleryBlockService('sonata.media.block.gallery', $this->get('templating'), $this, $this->get('sonata.media.manager.gallery'));
    }
    protected function getSonata_Media_Block_MediaService()
    {
        return $this->services['sonata.media.block.media'] = new \Sonata\MediaBundle\Block\MediaBlockService('sonata.media.block.media', $this->get('templating'), $this, $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Buzz_BrowserService()
    {
        return $this->services['sonata.media.buzz.browser'] = new \Buzz\Browser($this->get('sonata.media.buzz.connector.file_get_contents'));
    }
    protected function getSonata_Media_Buzz_Connector_CurlService()
    {
        $this->services['sonata.media.buzz.connector.curl'] = $instance = new \Buzz\Client\Curl();
        $instance->setIgnoreErrors(true);
        $instance->setMaxRedirects(5);
        $instance->setTimeout(5);
        $instance->setVerifyPeer(true);
        $instance->setProxy(NULL);
        return $instance;
    }
    protected function getSonata_Media_Buzz_Connector_FileGetContentsService()
    {
        $this->services['sonata.media.buzz.connector.file_get_contents'] = $instance = new \Buzz\Client\FileGetContents();
        $instance->setIgnoreErrors(true);
        $instance->setMaxRedirects(5);
        $instance->setTimeout(5);
        $instance->setVerifyPeer(true);
        $instance->setProxy(NULL);
        return $instance;
    }
    protected function getSonata_Media_Cdn_ServerService()
    {
        return $this->services['sonata.media.cdn.server'] = new \Sonata\MediaBundle\CDN\Server('/uploads/media');
    }
    protected function getSonata_Media_Controller_Api_GalleryService()
    {
        return $this->services['sonata.media.controller.api.gallery'] = new \Sonata\MediaBundle\Controller\Api\GalleryController($this->get('sonata.media.manager.gallery'), $this->get('sonata.media.manager.media'), $this->get('form.factory'), 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia');
    }
    protected function getSonata_Media_Controller_Api_MediaService()
    {
        return $this->services['sonata.media.controller.api.media'] = new \Sonata\MediaBundle\Controller\Api\MediaController($this->get('sonata.media.manager.media'), $this->get('sonata.media.pool'), $this->get('form.factory'));
    }
    protected function getSonata_Media_Doctrine_EventSubscriberService()
    {
        return $this->services['sonata.media.doctrine.event_subscriber'] = new \Sonata\MediaBundle\Listener\ORM\MediaEventSubscriber($this);
    }
    protected function getSonata_Media_Extra_PixlrService()
    {
        return $this->services['sonata.media.extra.pixlr'] = new \Sonata\MediaBundle\Extra\Pixlr('Demo - Sonata Project', '7baa9dbd9a67be1d6aa2846e81f0b031f5412551', $this->get('sonata.media.pool'), $this->get('sonata.media.manager.media'), $this->get('cmf_routing.router'), $this->get('templating'), $this);
    }
    protected function getSonata_Media_Filesystem_LocalService()
    {
        return $this->services['sonata.media.filesystem.local'] = new \Gaufrette\Filesystem($this->get('sonata.media.adapter.filesystem.local'));
    }
    protected function getSonata_Media_Form_Type_MediaService()
    {
        return $this->services['sonata.media.form.type.media'] = new \Sonata\MediaBundle\Form\Type\MediaType($this->get('sonata.media.pool'), 'Application\\Sonata\\MediaBundle\\Entity\\Media');
    }
    protected function getSonata_Media_Formatter_TwigService()
    {
        return $this->services['sonata.media.formatter.twig'] = new \Sonata\MediaBundle\Twig\Extension\FormatterMediaExtension($this->get('sonata.media.twig.extension'));
    }
    protected function getSonata_Media_Generator_DefaultService()
    {
        return $this->services['sonata.media.generator.default'] = new \Sonata\MediaBundle\Generator\DefaultGenerator();
    }
    protected function getSonata_Media_Manager_GalleryService()
    {
        return $this->services['sonata.media.manager.gallery'] = new \Sonata\MediaBundle\Entity\GalleryManager('Application\\Sonata\\MediaBundle\\Entity\\Gallery', $this->get('doctrine'));
    }
    protected function getSonata_Media_Manager_MediaService()
    {
        return $this->services['sonata.media.manager.media'] = new \Sonata\MediaBundle\Entity\MediaManager('Application\\Sonata\\MediaBundle\\Entity\\Media', $this->get('doctrine'));
    }
    protected function getSonata_Media_Metadata_AmazonService()
    {
        return $this->services['sonata.media.metadata.amazon'] = new \Sonata\MediaBundle\Metadata\AmazonMetadataBuilder();
    }
    protected function getSonata_Media_Metadata_NoopService()
    {
        return $this->services['sonata.media.metadata.noop'] = new \Sonata\MediaBundle\Metadata\NoopMetadataBuilder();
    }
    protected function getSonata_Media_Metadata_ProxyService()
    {
        return $this->services['sonata.media.metadata.proxy'] = new \Sonata\MediaBundle\Metadata\ProxyMetadataBuilder($this, array());
    }
    protected function getSonata_Media_Notification_CreateThumbnailService()
    {
        return $this->services['sonata.media.notification.create_thumbnail'] = new \Sonata\MediaBundle\Consumer\CreateThumbnailConsumer($this->get('sonata.media.manager.media'), $this->get('sonata.media.pool'), $this);
    }
    protected function getSonata_Media_PoolService()
    {
        $this->services['sonata.media.pool'] = $instance = new \Sonata\MediaBundle\Provider\Pool('default');
        $instance->addContext('default', array(0 => 'sonata.media.provider.dailymotion', 1 => 'sonata.media.provider.youtube', 2 => 'sonata.media.provider.image', 3 => 'sonata.media.provider.file', 4 => 'sonata.media.provider.vimeo'), array('default_small' => array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true), 'default_big' => array('width' => 970, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true)), array('mode' => 'http', 'strategy' => 'sonata.media.security.superadmin_strategy'));
        $instance->addContext('news', array(0 => 'sonata.media.provider.image'), array('news_abstract' => array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true), 'news_wide' => array('width' => 820, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true)), array('strategy' => 'sonata.media.security.superadmin_strategy', 'mode' => 'http'));
        $instance->addContext('sonata_collection', array(0 => 'sonata.media.provider.image'), array('sonata_collection_preview' => array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true), 'sonata_collection_wide' => array('width' => 820, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true)), array('strategy' => 'sonata.media.security.superadmin_strategy', 'mode' => 'http'));
        $instance->addContext('sonata_category', array(0 => 'sonata.media.provider.image'), array('sonata_category_preview' => array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true), 'sonata_category_wide' => array('width' => 820, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true)), array('strategy' => 'sonata.media.security.superadmin_strategy', 'mode' => 'http'));
        $instance->addContext('sonata_product', array(0 => 'sonata.media.provider.image'), array('sonata_product_preview' => array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true), 'sonata_product_small' => array('width' => 300, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true), 'sonata_product_large' => array('width' => 750, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true)), array('strategy' => 'sonata.media.security.superadmin_strategy', 'mode' => 'http'));
        $instance->addDownloadSecurity('sonata.media.security.superadmin_strategy', $this->get('sonata.media.security.superadmin_strategy'));
        $instance->addProvider('sonata.media.provider.image', $this->get('sonata.media.provider.image'));
        $instance->addProvider('sonata.media.provider.file', $this->get('sonata.media.provider.file'));
        $instance->addProvider('sonata.media.provider.youtube', $this->get('sonata.media.provider.youtube'));
        $instance->addProvider('sonata.media.provider.dailymotion', $this->get('sonata.media.provider.dailymotion'));
        $instance->addProvider('sonata.media.provider.vimeo', $this->get('sonata.media.provider.vimeo'));
        return $instance;
    }
    protected function getSonata_Media_Provider_DailymotionService()
    {
        $this->services['sonata.media.provider.dailymotion'] = $instance = new \Sonata\MediaBundle\Provider\DailyMotionProvider('sonata.media.provider.dailymotion', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), $this->get('sonata.media.buzz.browser'), $this->get('sonata.media.metadata.proxy'));
        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_dailymotion.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 970, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));
        return $instance;
    }
    protected function getSonata_Media_Provider_FileService()
    {
        $this->services['sonata.media.provider.file'] = $instance = new \Sonata\MediaBundle\Provider\FileProvider('sonata.media.provider.file', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), array(0 => 'pdf', 1 => 'txt', 2 => 'rtf', 3 => 'doc', 4 => 'docx', 5 => 'xls', 6 => 'xlsx', 7 => 'ppt', 8 => 'pptx', 9 => 'odt', 10 => 'odg', 11 => 'odp', 12 => 'ods', 13 => 'odc', 14 => 'odf', 15 => 'odb', 16 => 'csv', 17 => 'xml'), array(0 => 'application/pdf', 1 => 'application/x-pdf', 2 => 'application/rtf', 3 => 'text/html', 4 => 'text/rtf', 5 => 'text/plain', 6 => 'application/excel', 7 => 'application/msword', 8 => 'application/vnd.ms-excel', 9 => 'application/vnd.ms-powerpoint', 10 => 'application/vnd.ms-powerpoint', 11 => 'application/vnd.oasis.opendocument.text', 12 => 'application/vnd.oasis.opendocument.graphics', 13 => 'application/vnd.oasis.opendocument.presentation', 14 => 'application/vnd.oasis.opendocument.spreadsheet', 15 => 'application/vnd.oasis.opendocument.chart', 16 => 'application/vnd.oasis.opendocument.formula', 17 => 'application/vnd.oasis.opendocument.database', 18 => 'application/vnd.oasis.opendocument.image', 19 => 'text/comma-separated-values', 20 => 'text/xml', 21 => 'application/xml', 22 => 'application/zip'), $this->get('sonata.media.metadata.proxy'));
        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_file.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 970, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));
        return $instance;
    }
    protected function getSonata_Media_Provider_ImageService()
    {
        $this->services['sonata.media.provider.image'] = $instance = new \Sonata\MediaBundle\Provider\ImageProvider('sonata.media.provider.image', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), array(0 => 'jpg', 1 => 'png', 2 => 'jpeg'), array(0 => 'image/pjpeg', 1 => 'image/jpeg', 2 => 'image/png', 3 => 'image/x-png'), $this->get('sonata.media.adapter.image.gd'), $this->get('sonata.media.metadata.proxy'));
        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_image.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 970, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('news_abstract', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('news_wide', array('width' => 820, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('sonata_collection_preview', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('sonata_collection_wide', array('width' => 820, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('sonata_category_preview', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('sonata_category_wide', array('width' => 820, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('sonata_product_preview', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('sonata_product_small', array('width' => 300, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('sonata_product_large', array('width' => 750, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));
        return $instance;
    }
    protected function getSonata_Media_Provider_VimeoService()
    {
        $this->services['sonata.media.provider.vimeo'] = $instance = new \Sonata\MediaBundle\Provider\VimeoProvider('sonata.media.provider.vimeo', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), $this->get('sonata.media.buzz.browser'), $this->get('sonata.media.metadata.proxy'));
        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_vimeo.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 970, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));
        return $instance;
    }
    protected function getSonata_Media_Provider_YoutubeService()
    {
        $this->services['sonata.media.provider.youtube'] = $instance = new \Sonata\MediaBundle\Provider\YouTubeProvider('sonata.media.provider.youtube', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), $this->get('sonata.media.buzz.browser'), $this->get('sonata.media.metadata.proxy'), false);
        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_youtube.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 970, 'quality' => 100, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));
        return $instance;
    }
    protected function getSonata_Media_Resizer_SimpleService()
    {
        return $this->services['sonata.media.resizer.simple'] = new \Sonata\MediaBundle\Resizer\SimpleResizer($this->get('sonata.media.adapter.image.gd'), 'inset', $this->get('sonata.media.metadata.proxy'));
    }
    protected function getSonata_Media_Resizer_SquareService()
    {
        return $this->services['sonata.media.resizer.square'] = new \Sonata\MediaBundle\Resizer\SquareResizer($this->get('sonata.media.adapter.image.gd'), 'inset', $this->get('sonata.media.metadata.proxy'));
    }
    protected function getSonata_Media_Security_ConnectedStrategyService()
    {
        return $this->services['sonata.media.security.connected_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'IS_AUTHENTICATED_FULLY', 1 => 'IS_AUTHENTICATED_REMEMBERED'));
    }
    protected function getSonata_Media_Security_ForbiddenStrategyService()
    {
        return $this->services['sonata.media.security.forbidden_strategy'] = new \Sonata\MediaBundle\Security\ForbiddenDownloadStrategy($this->get('translator.default'));
    }
    protected function getSonata_Media_Security_PublicStrategyService()
    {
        return $this->services['sonata.media.security.public_strategy'] = new \Sonata\MediaBundle\Security\PublicDownloadStrategy($this->get('translator.default'));
    }
    protected function getSonata_Media_Security_SuperadminStrategyService()
    {
        return $this->services['sonata.media.security.superadmin_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'ROLE_SUPER_ADMIN', 1 => 'ROLE_ADMIN'));
    }
    protected function getSonata_Media_Serializer_Handler_GalleryService()
    {
        return $this->services['sonata.media.serializer.handler.gallery'] = new \Sonata\MediaBundle\Serializer\GallerySerializerHandler($this->get('sonata.media.manager.gallery'));
    }
    protected function getSonata_Media_Serializer_Handler_MediaService()
    {
        return $this->services['sonata.media.serializer.handler.media'] = new \Sonata\MediaBundle\Serializer\MediaSerializerHandler($this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Thumbnail_Consumer_FormatService()
    {
        return $this->services['sonata.media.thumbnail.consumer.format'] = new \Sonata\MediaBundle\Thumbnail\ConsumerThumbnail('sonata.media.thumbnail.format', $this->get('sonata.media.thumbnail.format'), $this->get('sonata.notification.backend.postpone'));
    }
    protected function getSonata_Media_Thumbnail_FormatService()
    {
        return $this->services['sonata.media.thumbnail.format'] = new \Sonata\MediaBundle\Thumbnail\FormatThumbnail('jpg');
    }
    protected function getSonata_Media_Twig_ExtensionService()
    {
        return $this->services['sonata.media.twig.extension'] = new \Sonata\MediaBundle\Twig\Extension\MediaExtension($this->get('sonata.media.pool'), $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Twig_GlobalService()
    {
        return $this->services['sonata.media.twig.global'] = new \Sonata\MediaBundle\Twig\GlobalVariables($this);
    }
    protected function getSonata_Media_Validator_FormatService()
    {
        return $this->services['sonata.media.validator.format'] = new \Sonata\MediaBundle\Validator\FormatValidator($this->get('sonata.media.pool'));
    }
    protected function getSonata_News_Admin_CommentService()
    {
        $instance = new \Sonata\NewsBundle\Admin\CommentAdmin('sonata.news.admin.comment', 'Application\\Sonata\\NewsBundle\\Entity\\Comment', 'SonataNewsBundle:CommentAdmin');
        $instance->setTranslationDomain('SonataNewsBundle');
        $instance->setCommentManager($this->get('sonata.news.manager.comment'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('comments');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataNewsBundle:Admin:inner_row_comment.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_flat_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_News_Admin_PostService()
    {
        $a = $this->get('sonata.admin.label.strategy.underscore');
        $b = $this->get('sonata.admin.manager.orm');
        $c = $this->get('sonata.admin.builder.orm_form');
        $d = $this->get('sonata.admin.builder.orm_show');
        $e = $this->get('sonata.admin.builder.orm_list');
        $f = $this->get('sonata.admin.builder.orm_datagrid');
        $g = $this->get('translator.default');
        $h = $this->get('sonata.admin.pool');
        $i = $this->get('sonata.admin.route.default_generator');
        $j = $this->get('validator');
        $k = $this->get('sonata.admin.security.handler');
        $l = $this->get('knp_menu.factory');
        $m = $this->get('sonata.admin.route.path_info');
        $n = $this->get('sonata.admin.event.extension');
        $o = $this->get('sonata.timeline.admin.extension');
        $p = new \Sonata\NewsBundle\Admin\CommentAdmin('sonata.news.admin.comment', 'Application\\Sonata\\NewsBundle\\Entity\\Comment', 'SonataNewsBundle:CommentAdmin');
        $p->setTranslationDomain('SonataNewsBundle');
        $p->setCommentManager($this->get('sonata.news.manager.comment'));
        $p->setLabelTranslatorStrategy($a);
        $p->setManagerType('orm');
        $p->setModelManager($b);
        $p->setFormContractor($c);
        $p->setShowBuilder($d);
        $p->setListBuilder($e);
        $p->setDatagridBuilder($f);
        $p->setTranslator($g);
        $p->setConfigurationPool($h);
        $p->setRouteGenerator($i);
        $p->setValidator($j);
        $p->setSecurityHandler($k);
        $p->setMenuFactory($l);
        $p->setRouteBuilder($m);
        $p->setLabel('comments');
        $p->setPersistFilters(false);
        $p->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataNewsBundle:Admin:inner_row_comment.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_flat_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $p->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $p->initialize();
        $p->addExtension($n);
        $p->addExtension($o);
        $p->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $p->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $instance = new \Sonata\NewsBundle\Admin\PostAdmin('sonata.news.admin.post', 'Application\\Sonata\\NewsBundle\\Entity\\Post', 'SonataAdminBundle:CRUD');
        $instance->setUserManager($this->get('fos_user.user_manager'));
        $instance->setPoolFormatter($this->get('sonata.formatter.pool'));
        $instance->addChild($p);
        $instance->setTranslationDomain('SonataNewsBundle');
        $instance->setPermalinkGenerator($this->get('sonata.news.permalink.date'));
        $instance->setLabelTranslatorStrategy($a);
        $instance->setManagerType('orm');
        $instance->setModelManager($b);
        $instance->setFormContractor($c);
        $instance->setShowBuilder($d);
        $instance->setListBuilder($e);
        $instance->setDatagridBuilder($f);
        $instance->setTranslator($g);
        $instance->setConfigurationPool($h);
        $instance->setRouteGenerator($i);
        $instance->setValidator($j);
        $instance->setSecurityHandler($k);
        $instance->setMenuFactory($l);
        $instance->setRouteBuilder($m);
        $instance->setLabel('posts');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($n);
        $instance->addExtension($o);
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_News_Api_Form_Type_CommentService()
    {
        return $this->services['sonata.news.api.form.type.comment'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_news_api_form_comment', 'Application\\Sonata\\NewsBundle\\Entity\\Comment', 'sonata_api_write');
    }
    protected function getSonata_News_Api_Form_Type_PostService()
    {
        return $this->services['sonata.news.api.form.type.post'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_news_api_form_post', 'Application\\Sonata\\NewsBundle\\Entity\\Post', 'sonata_api_write');
    }
    protected function getSonata_News_Block_BreadcrumbArchiveService()
    {
        return $this->services['sonata.news.block.breadcrumb_archive'] = new \Sonata\NewsBundle\Block\Breadcrumb\NewsArchiveBreadcrumbBlockService('news_archive', 'sonata.news.block.breadcrumb_archive', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_News_Block_BreadcrumbPostService()
    {
        return $this->services['sonata.news.block.breadcrumb_post'] = new \Sonata\NewsBundle\Block\Breadcrumb\NewsPostBreadcrumbBlockService('news_post', 'sonata.news.block.breadcrumb_post', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'), $this->get('sonata.news.blog'));
    }
    protected function getSonata_News_Block_RecentCommentsService()
    {
        return $this->services['sonata.news.block.recent_comments'] = new \Sonata\NewsBundle\Block\RecentCommentsBlockService('sonata.news.block.recent_comments', $this->get('templating'), $this->get('sonata.news.manager.comment'));
    }
    protected function getSonata_News_Block_RecentPostsService()
    {
        return $this->services['sonata.news.block.recent_posts'] = new \Sonata\NewsBundle\Block\RecentPostsBlockService('sonata.news.block.recent_posts', $this->get('templating'), $this->get('sonata.news.manager.post'));
    }
    protected function getSonata_News_BlogService()
    {
        return $this->services['sonata.news.blog'] = new \Sonata\NewsBundle\Model\Blog('My Awesome Blog', 'http://awesome-blog.ltd', 'My Awesome blog description', $this->get('sonata.news.permalink.date'));
    }
    protected function getSonata_News_Controller_Api_CommentService()
    {
        return $this->services['sonata.news.controller.api.comment'] = new \Sonata\NewsBundle\Controller\Api\CommentController($this->get('sonata.news.manager.comment'));
    }
    protected function getSonata_News_Controller_Api_PostService()
    {
        return $this->services['sonata.news.controller.api.post'] = new \Sonata\NewsBundle\Controller\Api\PostController($this->get('sonata.news.manager.post'), $this->get('sonata.news.manager.comment'), $this->get('sonata.news.mailer'), $this->get('form.factory'), $this->get('sonata.formatter.pool'));
    }
    protected function getSonata_News_Form_Comment_StatusTypeService()
    {
        return $this->services['sonata.news.form.comment.status_type'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\NewsBundle\\Entity\\Comment', 'getStatusList', 'sonata_news_comment_status');
    }
    protected function getSonata_News_Form_Type_CommentService()
    {
        return $this->services['sonata.news.form.type.comment'] = new \Sonata\NewsBundle\Form\Type\CommentType();
    }
    protected function getSonata_News_Hash_GeneratorService()
    {
        return $this->services['sonata.news.hash.generator'] = new \Sonata\NewsBundle\Util\HashGenerator('ThisTokenIsNotSoSecretChangeIt');
    }
    protected function getSonata_News_MailerService()
    {
        return $this->services['sonata.news.mailer'] = new \Sonata\NewsBundle\Mailer\Mailer($this->get('swiftmailer.mailer.default'), $this->get('sonata.news.blog'), $this->get('sonata.news.hash.generator'), $this->get('cmf_routing.router'), $this->get('templating'), array('notification' => array('emails' => array(0 => 'mail@example.org'), 'from' => 'no-reply@example.org', 'template' => 'SonataNewsBundle:Mail:comment_notification.txt.twig')));
    }
    protected function getSonata_News_Manager_CommentService()
    {
        return $this->services['sonata.news.manager.comment'] = new \Sonata\NewsBundle\Entity\CommentManager('Application\\Sonata\\NewsBundle\\Entity\\Comment', $this->get('doctrine'), $this->get('sonata.news.manager.post'));
    }
    protected function getSonata_News_Manager_PostService()
    {
        return $this->services['sonata.news.manager.post'] = new \Sonata\NewsBundle\Entity\PostManager('Application\\Sonata\\NewsBundle\\Entity\\Post', $this->get('doctrine'));
    }
    protected function getSonata_News_Permalink_CollectionService()
    {
        return $this->services['sonata.news.permalink.collection'] = new \Sonata\NewsBundle\Permalink\CollectionPermalink();
    }
    protected function getSonata_News_Permalink_DateService()
    {
        return $this->services['sonata.news.permalink.date'] = new \Sonata\NewsBundle\Permalink\DatePermalink('%1$04d/%2$d/%3$d/%4$s');
    }
    protected function getSonata_News_Serializer_Handler_PostService()
    {
        return $this->services['sonata.news.serializer.handler.post'] = new \Sonata\NewsBundle\Serializer\PostSerializerHandler($this->get('sonata.news.manager.post'));
    }
    protected function getSonata_News_Status_CommentService()
    {
        return $this->services['sonata.news.status.comment'] = new \Sonata\NewsBundle\Status\CommentStatusRenderer();
    }
    protected function getSonata_Notification_Admin_MessageService()
    {
        $instance = new \Sonata\NotificationBundle\Admin\MessageAdmin('sonata.notification.admin.message', 'Application\\Sonata\\NotificationBundle\\Entity\\Message', 'SonataNotificationBundle:MessageAdmin');
        $instance->setTranslationDomain('SonataNotificationBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('notifications');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Notification_Backend_DoctrineService()
    {
        return $this->services['sonata.notification.backend.doctrine'] = new \Sonata\NotificationBundle\Backend\MessageManagerBackendDispatcher($this->get('sonata.notification.manager.message.default'), '', '', '');
    }
    protected function getSonata_Notification_Backend_PostponeService()
    {
        return $this->services['sonata.notification.backend.postpone'] = new \Sonata\NotificationBundle\Backend\PostponeRuntimeBackend($this->get('sonata.notification.dispatcher'));
    }
    protected function getSonata_Notification_Backend_RuntimeService()
    {
        return $this->services['sonata.notification.backend.runtime'] = new \Sonata\NotificationBundle\Backend\RuntimeBackend($this->get('sonata.notification.dispatcher'));
    }
    protected function getSonata_Notification_Consumer_LoggerService()
    {
        return $this->services['sonata.notification.consumer.logger'] = new \Sonata\NotificationBundle\Consumer\LoggerConsumer($this->get('logger'));
    }
    protected function getSonata_Notification_Consumer_MetadataService()
    {
        return $this->services['sonata.notification.consumer.metadata'] = new \Sonata\NotificationBundle\Consumer\Metadata(array('sonata.page.create_snapshots' => array(0 => 'sonata.page.notification.create_snapshots'), 'sonata.page.create_snapshot' => array(0 => 'sonata.page.notification.create_snapshot'), 'sonata.page.cleanup_snapshots' => array(0 => 'sonata.page.notification.cleanup_snapshots'), 'sonata.page.cleanup_snapshot' => array(0 => 'sonata.page.notification.cleanup_snapshot'), 'sonata.media.create_thumbnail' => array(0 => 'sonata.media.notification.create_thumbnail'), 'sonata_payment_order_process' => array(0 => 'sonata.payment.consumer.order_process'), 'sonata_payment_order_element_process' => array(0 => 'sonata.payment.consumer.order_element_process'), 'mailer' => array(0 => 'sonata.notification.consumer.swift_mailer'), 'logger' => array(0 => 'sonata.notification.consumer.logger')));
    }
    protected function getSonata_Notification_Consumer_SwiftMailerService()
    {
        return $this->services['sonata.notification.consumer.swift_mailer'] = new \Sonata\NotificationBundle\Consumer\SwiftMailerConsumer($this->get('swiftmailer.mailer.default'));
    }
    protected function getSonata_Notification_Controller_Api_MessageService()
    {
        return $this->services['sonata.notification.controller.api.message'] = new \Sonata\NotificationBundle\Controller\Api\MessageController($this->get('sonata.notification.manager.message.default'));
    }
    protected function getSonata_Notification_DispatcherService()
    {
        $this->services['sonata.notification.dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this);
        $instance->addListenerService('sonata.page.create_snapshots', array(0 => 'sonata.page.notification.create_snapshots', 1 => 'process'), 0);
        $instance->addListenerService('sonata.page.create_snapshot', array(0 => 'sonata.page.notification.create_snapshot', 1 => 'process'), 0);
        $instance->addListenerService('sonata.page.cleanup_snapshots', array(0 => 'sonata.page.notification.cleanup_snapshots', 1 => 'process'), 0);
        $instance->addListenerService('sonata.page.cleanup_snapshot', array(0 => 'sonata.page.notification.cleanup_snapshot', 1 => 'process'), 0);
        $instance->addListenerService('sonata.media.create_thumbnail', array(0 => 'sonata.media.notification.create_thumbnail', 1 => 'process'), 0);
        $instance->addListenerService('sonata_payment_order_process', array(0 => 'sonata.payment.consumer.order_process', 1 => 'process'), 0);
        $instance->addListenerService('sonata_payment_order_element_process', array(0 => 'sonata.payment.consumer.order_element_process', 1 => 'process'), 0);
        $instance->addListenerService('mailer', array(0 => 'sonata.notification.consumer.swift_mailer', 1 => 'process'), 0);
        $instance->addListenerService('logger', array(0 => 'sonata.notification.consumer.logger', 1 => 'process'), 0);
        return $instance;
    }
    protected function getSonata_Notification_ErroneousMessagesSelectorService()
    {
        return $this->services['sonata.notification.erroneous_messages_selector'] = new \Sonata\NotificationBundle\Selector\ErroneousMessagesSelector($this->get('doctrine'), 'Application\\Sonata\\NotificationBundle\\Entity\\Message');
    }
    protected function getSonata_Notification_Event_DoctrineBackendOptimizeService()
    {
        return $this->services['sonata.notification.event.doctrine_backend_optimize'] = new \Sonata\NotificationBundle\Event\DoctrineBackendOptimizeListener($this->get('doctrine'));
    }
    protected function getSonata_Notification_Event_DoctrineOptimizeService()
    {
        return $this->services['sonata.notification.event.doctrine_optimize'] = new \Sonata\NotificationBundle\Event\DoctrineOptimizeListener($this->get('doctrine'));
    }
    protected function getSonata_Notification_Manager_Message_DefaultService()
    {
        return $this->services['sonata.notification.manager.message.default'] = new \Sonata\NotificationBundle\Entity\MessageManager('Application\\Sonata\\NotificationBundle\\Entity\\Message', $this->get('doctrine'));
    }
    protected function getSonata_Order_Admin_OrderService()
    {
        $a = $this->get('sonata.price.currency.detector');
        $b = $this->get('sonata.admin.label.strategy.underscore');
        $c = $this->get('sonata.admin.manager.orm');
        $d = $this->get('sonata.admin.builder.orm_form');
        $e = $this->get('sonata.admin.builder.orm_show');
        $f = $this->get('sonata.admin.builder.orm_list');
        $g = $this->get('sonata.admin.builder.orm_datagrid');
        $h = $this->get('translator.default');
        $i = $this->get('sonata.admin.pool');
        $j = $this->get('sonata.admin.route.default_generator');
        $k = $this->get('validator');
        $l = $this->get('sonata.admin.security.handler');
        $m = $this->get('knp_menu.factory');
        $n = $this->get('sonata.admin.route.path_info');
        $o = $this->get('sonata.admin.event.extension');
        $p = $this->get('sonata.timeline.admin.extension');
        $q = new \Sonata\OrderBundle\Admin\OrderElementAdmin('sonata.order.admin.order_element', 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'SonataAdminBundle:CRUD');
        $q->setCurrencyDetector($a);
        $q->setProductPool($this->get('sonata.product.pool'));
        $q->setLabelTranslatorStrategy($b);
        $q->setManagerType('orm');
        $q->setModelManager($c);
        $q->setFormContractor($d);
        $q->setShowBuilder($e);
        $q->setListBuilder($f);
        $q->setDatagridBuilder($g);
        $q->setTranslator($h);
        $q->setConfigurationPool($i);
        $q->setRouteGenerator($j);
        $q->setValidator($k);
        $q->setSecurityHandler($l);
        $q->setMenuFactory($m);
        $q->setRouteBuilder($n);
        $q->setLabel('orderElement');
        $q->setPersistFilters(false);
        $q->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $q->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $q->initialize();
        $q->addExtension($o);
        $q->addExtension($p);
        $q->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $q->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $instance = new \Sonata\OrderBundle\Admin\OrderAdmin('sonata.order.admin.order', 'Application\\Sonata\\OrderBundle\\Entity\\Order', 'SonataOrderBundle:OrderCRUD');
        $instance->addChild($q);
        $instance->setCurrencyDetector($a);
        $instance->setInvoiceManager($this->get('sonata.invoice.manager'));
        $instance->setOrderManager($this->get('sonata.order.manager'));
        $instance->setLabelTranslatorStrategy($b);
        $instance->setManagerType('orm');
        $instance->setModelManager($c);
        $instance->setFormContractor($d);
        $instance->setShowBuilder($e);
        $instance->setListBuilder($f);
        $instance->setDatagridBuilder($g);
        $instance->setTranslator($h);
        $instance->setConfigurationPool($i);
        $instance->setRouteGenerator($j);
        $instance->setValidator($k);
        $instance->setSecurityHandler($l);
        $instance->setMenuFactory($m);
        $instance->setRouteBuilder($n);
        $instance->setLabel('order');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($o);
        $instance->addExtension($p);
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Order_Admin_OrderElementService()
    {
        $instance = new \Sonata\OrderBundle\Admin\OrderElementAdmin('sonata.order.admin.order_element', 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement', 'SonataAdminBundle:CRUD');
        $instance->setCurrencyDetector($this->get('sonata.price.currency.detector'));
        $instance->setProductPool($this->get('sonata.product.pool'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('orderElement');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Order_Block_BreadcrumbOrderService()
    {
        return $this->services['sonata.order.block.breadcrumb_order'] = new \Sonata\OrderBundle\Block\Breadcrumb\UserOrderBreadcrumbBlockService('user_order', 'sonata.order.block.breadcrumb_order', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_Order_Block_RecentOrdersService()
    {
        return $this->services['sonata.order.block.recent_orders'] = new \Sonata\OrderBundle\Block\RecentOrdersBlockService('sonata.order.block.recent_orders', $this->get('templating'), $this->get('sonata.order.manager'), $this->get('sonata.customer.manager'), $this->get('security.context'));
    }
    protected function getSonata_Order_Controller_Api_OrderService()
    {
        return $this->services['sonata.order.controller.api.order'] = new \Sonata\OrderBundle\Controller\Api\OrderController($this->get('sonata.order.manager'));
    }
    protected function getSonata_Order_Form_StatusTypeService()
    {
        return $this->services['sonata.order.form.status_type'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\OrderBundle\\Entity\\Order', 'getStatusList', 'sonata_order_status');
    }
    protected function getSonata_Order_ManagerService()
    {
        return $this->services['sonata.order.manager'] = new \Sonata\OrderBundle\Entity\OrderManager('Application\\Sonata\\OrderBundle\\Entity\\Order', $this->get('doctrine'));
    }
    protected function getSonata_Order_OrderElement_ManagerService()
    {
        return $this->services['sonata.order.order_element.manager'] = new \Sonata\OrderBundle\Entity\OrderElementManager('Application\\Sonata\\OrderBundle\\Entity\\OrderElement', $this->get('doctrine'));
    }
    protected function getSonata_Order_Serializer_Handler_OrderService()
    {
        return $this->services['sonata.order.serializer.handler.order'] = new \Sonata\OrderBundle\Serializer\OrderSerializerHandler($this->get('sonata.order.manager'));
    }
    protected function getSonata_Order_Serializer_Handler_OrderElementService()
    {
        return $this->services['sonata.order.serializer.handler.order_element'] = new \Sonata\OrderBundle\Serializer\OrderElementSerializerHandler($this->get('sonata.order.order_element.manager'));
    }
    protected function getSonata_Order_Status_RendererService()
    {
        return $this->services['sonata.order.status.renderer'] = new \Sonata\Component\Order\OrderStatusRenderer();
    }
    protected function getSonata_Package_ManagerService()
    {
        return $this->services['sonata.package.manager'] = new \Sonata\ProductBundle\Entity\PackageManager('Application\\Sonata\\ProductBundle\\Entity\\Package', $this->get('doctrine'));
    }
    protected function getSonata_Page_Admin_BlockService()
    {
        $instance = new \Sonata\PageBundle\Admin\BlockAdmin('sonata.page.admin.block', 'Application\\Sonata\\PageBundle\\Entity\\Block', 'SonataPageBundle:BlockAdmin');
        $instance->setCacheManager($this->get('sonata.cache.manager'));
        $instance->setBlockManager($this->get('sonata.block.manager'));
        $instance->setTranslationDomain('SonataPageBundle');
        $instance->setContainerBlockTypes(array(0 => 'sonata.block.service.container', 1 => 'sonata.page.block.container', 2 => 'cmf.block.container', 3 => 'cmf.block.slideshow'));
        $instance->setFormTheme(array(0 => 'SonataPageBundle:Form:form_admin_fields.html.twig', 1 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('block');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Page_Admin_PageService()
    {
        $a = $this->get('sonata.cache.manager');
        $b = $this->get('sonata.admin.label.strategy.underscore');
        $c = $this->get('sonata.admin.manager.orm');
        $d = $this->get('sonata.admin.builder.orm_form');
        $e = $this->get('sonata.admin.builder.orm_show');
        $f = $this->get('sonata.admin.builder.orm_list');
        $g = $this->get('sonata.admin.builder.orm_datagrid');
        $h = $this->get('translator.default');
        $i = $this->get('sonata.admin.pool');
        $j = $this->get('sonata.admin.route.default_generator');
        $k = $this->get('validator');
        $l = $this->get('sonata.admin.security.handler');
        $m = $this->get('knp_menu.factory');
        $n = $this->get('sonata.admin.route.path_info');
        $o = $this->get('sonata.admin.event.extension');
        $p = $this->get('sonata.timeline.admin.extension');
        $q = new \Sonata\PageBundle\Admin\BlockAdmin('sonata.page.admin.block', 'Application\\Sonata\\PageBundle\\Entity\\Block', 'SonataPageBundle:BlockAdmin');
        $q->setCacheManager($a);
        $q->setBlockManager($this->get('sonata.block.manager'));
        $q->setTranslationDomain('SonataPageBundle');
        $q->setContainerBlockTypes(array(0 => 'sonata.block.service.container', 1 => 'sonata.page.block.container', 2 => 'cmf.block.container', 3 => 'cmf.block.slideshow'));
        $q->setFormTheme(array(0 => 'SonataPageBundle:Form:form_admin_fields.html.twig', 1 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $q->setLabelTranslatorStrategy($b);
        $q->setManagerType('orm');
        $q->setModelManager($c);
        $q->setFormContractor($d);
        $q->setShowBuilder($e);
        $q->setListBuilder($f);
        $q->setDatagridBuilder($g);
        $q->setTranslator($h);
        $q->setConfigurationPool($i);
        $q->setRouteGenerator($j);
        $q->setValidator($k);
        $q->setSecurityHandler($l);
        $q->setMenuFactory($m);
        $q->setRouteBuilder($n);
        $q->setLabel('block');
        $q->setPersistFilters(false);
        $q->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $q->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $q->initialize();
        $q->addExtension($o);
        $q->addExtension($p);
        $q->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $r = new \Sonata\PageBundle\Admin\SnapshotAdmin('sonata.page.admin.snapshot', 'Application\\Sonata\\PageBundle\\Entity\\Snapshot', 'SonataPageBundle:SnapshotAdmin');
        $r->setCacheManager($a);
        $r->setTranslationDomain('SonataPageBundle');
        $r->setLabelTranslatorStrategy($b);
        $r->setManagerType('orm');
        $r->setModelManager($c);
        $r->setFormContractor($d);
        $r->setShowBuilder($e);
        $r->setListBuilder($f);
        $r->setDatagridBuilder($g);
        $r->setTranslator($h);
        $r->setConfigurationPool($i);
        $r->setRouteGenerator($j);
        $r->setValidator($k);
        $r->setSecurityHandler($l);
        $r->setMenuFactory($m);
        $r->setRouteBuilder($n);
        $r->setLabel('snapshot');
        $r->setPersistFilters(false);
        $r->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $r->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $r->initialize();
        $r->addExtension($o);
        $r->addExtension($p);
        $r->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $r->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $instance = new \Sonata\PageBundle\Admin\PageAdmin('sonata.page.admin.page', 'Application\\Sonata\\PageBundle\\Entity\\Page', 'SonataPageBundle:PageAdmin');
        $instance->addChild($q);
        $instance->addChild($r);
        $instance->setPageManager($this->get('sonata.page.manager.page'));
        $instance->setCacheManager($a);
        $instance->setSiteManager($this->get('sonata.page.manager.site'));
        $instance->setTranslationDomain('SonataPageBundle');
        $instance->setLabelTranslatorStrategy($b);
        $instance->setManagerType('orm');
        $instance->setModelManager($c);
        $instance->setFormContractor($d);
        $instance->setShowBuilder($e);
        $instance->setListBuilder($f);
        $instance->setDatagridBuilder($g);
        $instance->setTranslator($h);
        $instance->setConfigurationPool($i);
        $instance->setRouteGenerator($j);
        $instance->setValidator($k);
        $instance->setSecurityHandler($l);
        $instance->setMenuFactory($m);
        $instance->setRouteBuilder($n);
        $instance->setLabel('page');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataPageBundle:PageAdmin:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($o);
        $instance->addExtension($p);
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Page_Admin_SharedBlockService()
    {
        $instance = new \Sonata\PageBundle\Admin\SharedBlockAdmin('sonata.page.admin.shared_block', 'Application\\Sonata\\PageBundle\\Entity\\Block', 'SonataPageBundle:BlockAdmin');
        $instance->setCacheManager($this->get('sonata.cache.manager'));
        $instance->setBlockManager($this->get('sonata.block.manager'));
        $instance->setTranslationDomain('SonataPageBundle');
        $instance->setContainerBlockTypes(array(0 => 'sonata.block.service.container', 1 => 'sonata.page.block.container', 2 => 'cmf.block.container', 3 => 'cmf.block.slideshow'));
        $instance->setFormTheme(array(0 => 'SonataPageBundle:Form:form_admin_fields.html.twig', 1 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('shared_block');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Page_Admin_SiteService()
    {
        $instance = new \Sonata\PageBundle\Admin\SiteAdmin('sonata.page.admin.site', 'Application\\Sonata\\PageBundle\\Entity\\Site', 'SonataPageBundle:SiteAdmin', $this->get('sonata.page.route.page.generator'));
        $instance->setTranslationDomain('SonataPageBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('site');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Page_Admin_SnapshotService()
    {
        $instance = new \Sonata\PageBundle\Admin\SnapshotAdmin('sonata.page.admin.snapshot', 'Application\\Sonata\\PageBundle\\Entity\\Snapshot', 'SonataPageBundle:SnapshotAdmin');
        $instance->setCacheManager($this->get('sonata.cache.manager'));
        $instance->setTranslationDomain('SonataPageBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('snapshot');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Page_Api_Form_Type_BlockService()
    {
        return $this->services['sonata.page.api.form.type.block'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_page_api_form_block', 'Application\\Sonata\\PageBundle\\Entity\\Block', 'sonata_api_write');
    }
    protected function getSonata_Page_Api_Form_Type_PageService()
    {
        return $this->services['sonata.page.api.form.type.page'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_page_api_form_page', 'Application\\Sonata\\PageBundle\\Entity\\Page', 'sonata_api_write');
    }
    protected function getSonata_Page_Api_Form_Type_SiteService()
    {
        return $this->services['sonata.page.api.form.type.site'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_page_api_form_site', 'Application\\Sonata\\PageBundle\\Entity\\Site', 'sonata_api_write');
    }
    protected function getSonata_Page_Block_AjaxService()
    {
        return $this->services['sonata.page.block.ajax'] = new \Sonata\PageBundle\Controller\AjaxController($this->get('sonata.page.cms_manager_selector'), $this->get('sonata.block.renderer.default'), $this->get('sonata.page.block.context_manager'));
    }
    protected function getSonata_Page_Block_BreadcrumbService()
    {
        return $this->services['sonata.page.block.breadcrumb'] = new \Sonata\PageBundle\Block\BreadcrumbBlockService('page', 'sonata.page.block.breadcrumb', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'), $this->get('sonata.page.cms_manager_selector'));
    }
    protected function getSonata_Page_Block_ChildrenPagesService()
    {
        return $this->services['sonata.page.block.children_pages'] = new \Sonata\PageBundle\Block\ChildrenPagesBlockService('sonata.page.block.children_pages', $this->get('templating'), $this->get('sonata.page.site.selector.host_with_path'), $this->get('sonata.page.cms_manager_selector'));
    }
    protected function getSonata_Page_Block_ContainerService()
    {
        return $this->services['sonata.page.block.container'] = new \Sonata\PageBundle\Block\ContainerBlockService('sonata.page.block.container', $this->get('templating'));
    }
    protected function getSonata_Page_Block_ContextManagerService()
    {
        return $this->services['sonata.page.block.context_manager'] = new \Sonata\PageBundle\Block\BlockContextManager($this->get('sonata.block.loader.service'), $this->get('sonata.block.manager'));
    }
    protected function getSonata_Page_Block_SharedBlockService()
    {
        return $this->services['sonata.page.block.shared_block'] = new \Sonata\PageBundle\Block\SharedBlockBlockService('sonata.page.block.shared_block', $this->get('templating'), $this, $this->get('sonata.page.manager.block'));
    }
    protected function getSonata_Page_BlockInteractorService()
    {
        return $this->services['sonata.page.block_interactor'] = new \Sonata\PageBundle\Entity\BlockInteractor($this->get('doctrine'), $this->get('sonata.page.manager.block'));
    }
    protected function getSonata_Page_Cache_EsiService()
    {
        return $this->services['sonata.page.cache.esi'] = new \Sonata\PageBundle\Cache\BlockEsiCache('add an unique token here', array(0 => 'if [ ! -r "/etc/varnish/secret" ]; then echo "VALID ERROR :/"; else varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 {{ COMMAND }} "{{ EXPRESSION }}"; fi;'), $this->get('cmf_routing.router'), 'ban', $this->get('sonata.block.renderer.default'), $this->get('sonata.page.block.context_manager'), array('page' => $this->get('sonata.page.cms.page'), 'snapshot' => $this->get('sonata.page.cms.snapshot')), $this->get('sonata.cache.recorder'));
    }
    protected function getSonata_Page_Cache_JsAsyncService()
    {
        return $this->services['sonata.page.cache.js_async'] = new \Sonata\PageBundle\Cache\BlockJsCache($this->get('cmf_routing.router'), $this->get('sonata.page.cms_manager_selector'), $this->get('sonata.block.renderer.default'), $this->get('sonata.page.block.context_manager'), false);
    }
    protected function getSonata_Page_Cache_JsSyncService()
    {
        return $this->services['sonata.page.cache.js_sync'] = new \Sonata\PageBundle\Cache\BlockJsCache($this->get('cmf_routing.router'), $this->get('sonata.page.cms_manager_selector'), $this->get('sonata.block.renderer.default'), $this->get('sonata.page.block.context_manager'), true);
    }
    protected function getSonata_Page_Cache_SsiService()
    {
        return $this->services['sonata.page.cache.ssi'] = new \Sonata\PageBundle\Cache\BlockSsiCache('add an unique token here', $this->get('cmf_routing.router'), $this->get('sonata.block.renderer.default'), $this->get('sonata.page.block.context_manager'), array('page' => $this->get('sonata.page.cms.page'), 'snapshot' => $this->get('sonata.page.cms.snapshot')));
    }
    protected function getSonata_Page_Cms_PageService()
    {
        return $this->services['sonata.page.cms.page'] = new \Sonata\PageBundle\CmsManager\CmsPageManager($this->get('sonata.page.manager.page'), $this->get('sonata.page.block_interactor'));
    }
    protected function getSonata_Page_Cms_SnapshotService()
    {
        return $this->services['sonata.page.cms.snapshot'] = new \Sonata\PageBundle\CmsManager\CmsSnapshotManager($this->get('sonata.page.manager.snapshot'), $this->get('sonata.page.transformer'));
    }
    protected function getSonata_Page_CmsManagerSelectorService()
    {
        return $this->services['sonata.page.cms_manager_selector'] = new \Sonata\PageBundle\CmsManager\CmsManagerSelector($this);
    }
    protected function getSonata_Page_Controller_Api_BlockService()
    {
        return $this->services['sonata.page.controller.api.block'] = new \Sonata\PageBundle\Controller\Api\BlockController($this->get('sonata.page.manager.block'), $this->get('form.factory'));
    }
    protected function getSonata_Page_Controller_Api_PageService()
    {
        return $this->services['sonata.page.controller.api.page'] = new \Sonata\PageBundle\Controller\Api\PageController($this->get('sonata.page.manager.site'), $this->get('sonata.page.manager.page'), $this->get('sonata.page.manager.block'), $this->get('form.factory'), $this->get('sonata.notification.backend.postpone'));
    }
    protected function getSonata_Page_Controller_Api_SiteService()
    {
        return $this->services['sonata.page.controller.api.site'] = new \Sonata\PageBundle\Controller\Api\SiteController($this->get('sonata.page.manager.site'), $this->get('form.factory'));
    }
    protected function getSonata_Page_Controller_Api_SnapshotService()
    {
        return $this->services['sonata.page.controller.api.snapshot'] = new \Sonata\PageBundle\Controller\Api\SnapshotController($this->get('sonata.page.manager.snapshot'));
    }
    protected function getSonata_Page_DecoratorStrategyService()
    {
        return $this->services['sonata.page.decorator_strategy'] = new \Sonata\PageBundle\CmsManager\DecoratorStrategy(array(0 => 'sonata_page_cache_esi', 1 => 'sonata_page_cache_ssi', 2 => 'sonata_page_js_sync_cache', 3 => 'sonata_page_js_async_cache', 4 => 'sonata_cache_esi', 5 => 'sonata_cache_ssi', 6 => 'sonata_cache_js_async', 7 => 'sonata_cache_js_sync', 8 => 'sonata_cache_apc'), array(0 => '(.*)admin(.*)', 1 => '^_(.*)'), array(0 => '^/admin(.*)', 1 => '^/api/(.*)'));
    }
    protected function getSonata_Page_Form_CreateSnapshotService()
    {
        return $this->services['sonata.page.form.create_snapshot'] = new \Sonata\PageBundle\Form\Type\CreateSnapshotType();
    }
    protected function getSonata_Page_Form_PageTypeChoiceService()
    {
        return $this->services['sonata.page.form.page_type_choice'] = new \Sonata\PageBundle\Form\Type\PageTypeChoiceType($this->get('sonata.page.page_service_manager'));
    }
    protected function getSonata_Page_Form_TemplateChoiceService()
    {
        return $this->services['sonata.page.form.template_choice'] = new \Sonata\PageBundle\Form\Type\TemplateChoiceType($this->get('sonata.page.template_manager'));
    }
    protected function getSonata_Page_Form_Type_PageSelectorService()
    {
        return $this->services['sonata.page.form.type.page_selector'] = new \Sonata\PageBundle\Form\Type\PageSelectorType($this->get('sonata.page.manager.page'));
    }
    protected function getSonata_Page_Kernel_ExceptionListenerService()
    {
        return $this->services['sonata.page.kernel.exception_listener'] = new \Sonata\PageBundle\Listener\ExceptionListener($this->get('sonata.page.site.selector.host_with_path'), $this->get('sonata.page.cms_manager_selector'), false, $this->get('templating'), $this->get('sonata.page.page_service_manager'), $this->get('sonata.page.decorator_strategy'), array(404 => '_page_internal_error_not_found', 500 => '_page_internal_error_fatal'), $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSonata_Page_Manager_BlockService()
    {
        return $this->services['sonata.page.manager.block'] = new \Sonata\PageBundle\Entity\BlockManager('Application\\Sonata\\PageBundle\\Entity\\Block', $this->get('doctrine'));
    }
    protected function getSonata_Page_Manager_PageService()
    {
        return $this->services['sonata.page.manager.page'] = new \Sonata\PageBundle\Entity\PageManager('Application\\Sonata\\PageBundle\\Entity\\Page', $this->get('doctrine'), array('templateCode' => 'default', 'enabled' => true, 'routeName' => NULL, 'name' => NULL, 'slug' => NULL, 'url' => NULL, 'requestMethod' => NULL, 'decorate' => true), array('homepage' => array('templateCode' => 'default', 'enabled' => true, 'routeName' => NULL, 'name' => NULL, 'slug' => NULL, 'url' => NULL, 'requestMethod' => NULL, 'decorate' => false)));
    }
    protected function getSonata_Page_Manager_SiteService()
    {
        return $this->services['sonata.page.manager.site'] = new \Sonata\PageBundle\Entity\SiteManager('Application\\Sonata\\PageBundle\\Entity\\Site', $this->get('doctrine'));
    }
    protected function getSonata_Page_Manager_SnapshotService()
    {
        return $this->services['sonata.page.manager.snapshot'] = new \Sonata\PageBundle\Entity\SnapshotManager('Application\\Sonata\\PageBundle\\Entity\\Snapshot', $this->get('doctrine'));
    }
    protected function getSonata_Page_Notification_CleanupSnapshotService()
    {
        return $this->services['sonata.page.notification.cleanup_snapshot'] = new \Sonata\PageBundle\Consumer\CleanupSnapshotConsumer($this->get('sonata.page.manager.snapshot'), $this->get('sonata.page.manager.page'));
    }
    protected function getSonata_Page_Notification_CleanupSnapshotsService()
    {
        return $this->services['sonata.page.notification.cleanup_snapshots'] = new \Sonata\PageBundle\Consumer\CleanupSnapshotsConsumer($this->get('sonata.notification.backend.postpone'), $this->get('sonata.notification.backend.runtime'), $this->get('sonata.page.manager.page'));
    }
    protected function getSonata_Page_Notification_CreateSnapshotService()
    {
        return $this->services['sonata.page.notification.create_snapshot'] = new \Sonata\PageBundle\Consumer\CreateSnapshotConsumer($this->get('sonata.page.manager.snapshot'), $this->get('sonata.page.manager.page'), $this->get('sonata.page.transformer'));
    }
    protected function getSonata_Page_Notification_CreateSnapshotsService()
    {
        return $this->services['sonata.page.notification.create_snapshots'] = new \Sonata\PageBundle\Consumer\CreateSnapshotsConsumer($this->get('sonata.notification.backend.postpone'), $this->get('sonata.notification.backend.runtime'), $this->get('sonata.page.manager.page'));
    }
    protected function getSonata_Page_PageServiceManagerService()
    {
        $a = $this->get('sonata.page.service.default');
        $this->services['sonata.page.page_service_manager'] = $instance = new \Sonata\PageBundle\Page\PageServiceManager($this->get('cmf_routing.router'));
        $instance->setDefault($a);
        $instance->add('sonata.page.service.default', $a);
        return $instance;
    }
    protected function getSonata_Page_RequestListenerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('sonata.page.request_listener', 'request');
        }
        return $this->services['sonata.page.request_listener'] = $this->scopedServices['request']['sonata.page.request_listener'] = new \Sonata\PageBundle\Listener\RequestListener($this->get('sonata.page.cms_manager_selector'), $this->get('sonata.page.site.selector.host_with_path'), $this->get('sonata.page.decorator_strategy'));
    }
    protected function getSonata_Page_ResponseListenerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('sonata.page.response_listener', 'request');
        }
        return $this->services['sonata.page.response_listener'] = $this->scopedServices['request']['sonata.page.response_listener'] = new \Sonata\PageBundle\Listener\ResponseListener($this->get('sonata.page.cms_manager_selector'), $this->get('sonata.page.page_service_manager'), $this->get('sonata.page.decorator_strategy'), $this->get('templating'));
    }
    protected function getSonata_Page_Route_Page_GeneratorService()
    {
        return $this->services['sonata.page.route.page.generator'] = new \Sonata\PageBundle\Route\RoutePageGenerator($this->get('router.default'), $this->get('sonata.page.manager.page'), $this->get('sonata.page.decorator_strategy'), $this->get('sonata.page.kernel.exception_listener'));
    }
    protected function getSonata_Page_RouterService()
    {
        return $this->services['sonata.page.router'] = new \Sonata\PageBundle\Route\CmsPageRouter($this->get('sonata.page.cms_manager_selector'), $this->get('sonata.page.site.selector.host_with_path'), $this->get('router.default'));
    }
    protected function getSonata_Page_Serializer_Handler_BlockService()
    {
        return $this->services['sonata.page.serializer.handler.block'] = new \Sonata\PageBundle\Serializer\BlockSerializerHandler($this->get('sonata.page.manager.block'));
    }
    protected function getSonata_Page_Serializer_Handler_PageService()
    {
        return $this->services['sonata.page.serializer.handler.page'] = new \Sonata\PageBundle\Serializer\PageSerializerHandler($this->get('sonata.page.manager.page'));
    }
    protected function getSonata_Page_Serializer_Handler_SiteService()
    {
        return $this->services['sonata.page.serializer.handler.site'] = new \Sonata\PageBundle\Serializer\SiteSerializerHandler($this->get('sonata.page.manager.site'));
    }
    protected function getSonata_Page_Serializer_Handler_SnapshotService()
    {
        return $this->services['sonata.page.serializer.handler.snapshot'] = new \Sonata\PageBundle\Serializer\SnapshotSerializerHandler($this->get('sonata.page.manager.snapshot'));
    }
    protected function getSonata_Page_Service_DefaultService()
    {
        return $this->services['sonata.page.service.default'] = new \Sonata\PageBundle\Page\Service\DefaultPageService('Default', $this->get('sonata.page.template_manager'), $this->get('sonata.seo.page.default'));
    }
    protected function getSonata_Page_Site_Selector_HostWithPathService()
    {
        return $this->services['sonata.page.site.selector.host_with_path'] = new \Sonata\PageBundle\Site\HostPathSiteSelector($this->get('sonata.page.manager.site'), $this->get('sonata.page.decorator_strategy'), $this->get('sonata.seo.page.default'));
    }
    protected function getSonata_Page_TemplateManagerService()
    {
        $this->services['sonata.page.template_manager'] = $instance = new \Sonata\PageBundle\Page\TemplateManager($this->get('templating'), array('error_codes' => array(404 => '_page_internal_error_not_found', 500 => '_page_internal_error_fatal')));
        $instance->setAll(array('default' => new \Sonata\PageBundle\Model\Template('default', 'ApplicationSonataPageBundle::demo_layout.html.twig', array('header' => array('name' => 'Header', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 80.0)), 'content_top' => array('name' => 'Top content', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 20.0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 60.0)), 'content' => array('name' => 'Main content', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 40.0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 40.0)), 'content_bottom' => array('name' => 'Bottom content', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 60.0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 20.0)), 'footer' => array('name' => 'Footer', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 80.0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 0.0)))), '2columns' => new \Sonata\PageBundle\Model\Template('2 columns layout', 'ApplicationSonataPageBundle::demo_2columns_layout.html.twig', array('header' => array('name' => 'Header', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 80.0)), 'content_top' => array('name' => 'Top content', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 20.0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 60.0)), 'left_col' => array('name' => 'Left content', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 40.0, 'width' => 50.0, 'height' => 20.0, 'right' => 50.0, 'bottom' => 40.0)), 'right_col' => array('name' => 'Right content', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 50.0, 'y' => 40.0, 'width' => 50.0, 'height' => 20.0, 'right' => 0.0, 'bottom' => 40.0)), 'content_bottom' => array('name' => 'Bottom content', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 60.0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 20.0)), 'footer' => array('name' => 'Footer', 'shared' => false, 'type' => 1, 'blocks' => array(), 'placement' => array('x' => 0, 'y' => 80.0, 'width' => 100, 'height' => 20.0, 'right' => 0, 'bottom' => 0.0))))));
        $instance->setDefaultTemplateCode('default');
        return $instance;
    }
    protected function getSonata_Page_TransformerService()
    {
        return $this->services['sonata.page.transformer'] = new \Sonata\PageBundle\Entity\Transformer($this->get('sonata.page.manager.snapshot'), $this->get('sonata.page.manager.page'), $this->get('sonata.page.manager.block'), $this->get('doctrine'));
    }
    protected function getSonata_Page_Twig_GlobalService()
    {
        return $this->services['sonata.page.twig.global'] = new \Sonata\PageBundle\Twig\GlobalVariables($this);
    }
    protected function getSonata_Page_Validator_UniqueUrlService()
    {
        return $this->services['sonata.page.validator.unique_url'] = new \Sonata\PageBundle\Validator\UniqueUrlValidator($this->get('sonata.page.manager.page'));
    }
    protected function getSonata_Payment_Consumer_OrderElementProcessService()
    {
        return $this->services['sonata.payment.consumer.order_element_process'] = new \Sonata\PaymentBundle\Consumer\PaymentProcessOrderElementConsumer($this->get('sonata.order.order_element.manager'), $this->get('sonata.product.pool'));
    }
    protected function getSonata_Payment_Consumer_OrderProcessService()
    {
        return $this->services['sonata.payment.consumer.order_process'] = new \Sonata\PaymentBundle\Consumer\PaymentProcessOrderConsumer($this->get('sonata.order.manager'), $this->get('sonata.transaction.manager'), $this->get('sonata.notification.backend.postpone'));
    }
    protected function getSonata_Payment_Form_TransactionStatusService()
    {
        return $this->services['sonata.payment.form.transaction_status'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\PaymentBundle\\Entity\\Transaction', 'getStatusList', 'sonata_payment_transaction_status');
    }
    protected function getSonata_Payment_Generator_MysqlService()
    {
        return $this->services['sonata.payment.generator.mysql'] = new \Sonata\Component\Generator\MysqlReference($this->get('doctrine'));
    }
    protected function getSonata_Payment_HandlerService()
    {
        return $this->services['sonata.payment.handler'] = new \Sonata\Component\Payment\PaymentHandler($this->get('sonata.order.manager'), $this->get('sonata.payment.selector.simple'), $this->get('sonata.payment.generator.mysql'), $this->get('sonata.transaction.manager'), $this->get('sonata.notification.backend.postpone'), $this->get('event_dispatcher'));
    }
    protected function getSonata_Payment_Method_DebugService()
    {
        $this->services['sonata.payment.method.debug'] = $instance = new \Sonata\Component\Payment\Debug\DebugPayment($this->get('cmf_routing.router'), $this->get('sonata.payment.browser.curl'));
        $instance->setName('Debug Payment');
        $instance->setOptions(array('url_callback' => 'sonata_payment_callback', 'url_return_ko' => 'sonata_payment_error', 'url_return_ok' => 'sonata_payment_confirmation'));
        $instance->setCode('debug');
        $instance->addTransformer('basket', $this->get('sonata.payment.transformer.basket'));
        $instance->addTransformer('order', $this->get('sonata.payment.transformer.order'));
        $instance->setEnabled(true);
        return $instance;
    }
    protected function getSonata_Payment_Method_PassService()
    {
        $this->services['sonata.payment.method.pass'] = $instance = new \Sonata\Component\Payment\PassPayment($this->get('cmf_routing.router'), $this->get('sonata.payment.browser.curl'));
        $instance->setName('Pass');
        $instance->setOptions(array('shop_secret_key' => 'assdsds', 'url_callback' => 'sonata_payment_callback', 'url_return_ko' => 'sonata_payment_error', 'url_return_ok' => 'sonata_payment_confirmation'));
        $instance->setCode('pass');
        $instance->addTransformer('basket', $this->get('sonata.payment.transformer.basket'));
        $instance->addTransformer('order', $this->get('sonata.payment.transformer.order'));
        $instance->setEnabled(true);
        return $instance;
    }
    protected function getSonata_Payment_PoolService()
    {
        $this->services['sonata.payment.pool'] = $instance = new \Sonata\Component\Payment\Pool();
        $instance->addMethod($this->get('sonata.payment.method.pass'));
        $instance->addMethod($this->get('sonata.payment.method.debug'));
        return $instance;
    }
    protected function getSonata_Payment_Provider_Scellius_NoneGeneratorService()
    {
        return $this->services['sonata.payment.provider.scellius.none_generator'] = new \Sonata\Component\Payment\Scellius\NodeScelliusTransactionGenerator();
    }
    protected function getSonata_Payment_Provider_Scellius_OrderGeneratorService()
    {
        return $this->services['sonata.payment.provider.scellius.order_generator'] = new \Sonata\Component\Payment\Scellius\OrderScelliusTransactionGenerator();
    }
    protected function getSonata_Payment_Selector_SimpleService()
    {
        return $this->services['sonata.payment.selector.simple'] = new \Sonata\Component\Payment\Selector($this->get('sonata.payment.pool'), $this->get('sonata.product.pool'), $this->get('logger'));
    }
    protected function getSonata_Payment_Transformer_BasketService()
    {
        return $this->services['sonata.payment.transformer.basket'] = new \Sonata\Component\Transformer\BasketTransformer($this->get('sonata.order.manager'), $this->get('sonata.product.pool'), $this->get('event_dispatcher'), $this->get('logger'));
    }
    protected function getSonata_Payment_Transformer_InvoiceService()
    {
        return $this->services['sonata.payment.transformer.invoice'] = new \Sonata\Component\Transformer\InvoiceTransformer($this->get('sonata.invoice_element.manager'), $this->get('sonata.delivery.pool'), $this->get('event_dispatcher'));
    }
    protected function getSonata_Payment_Transformer_OrderService()
    {
        return $this->services['sonata.payment.transformer.order'] = new \Sonata\Component\Transformer\OrderTransformer($this->get('sonata.product.pool'), $this->get('event_dispatcher'));
    }
    protected function getSonata_Payment_Transformer_PoolService()
    {
        $this->services['sonata.payment.transformer.pool'] = $instance = new \Sonata\Component\Transformer\Pool();
        $instance->addTransformer('order', $this->get('sonata.payment.transformer.order'));
        $instance->addTransformer('basket', $this->get('sonata.payment.transformer.basket'));
        return $instance;
    }
    protected function getSonata_Price_Currency_CalculatorService()
    {
        return $this->services['sonata.price.currency.calculator'] = new \Sonata\Component\Currency\CurrencyPriceCalculator();
    }
    protected function getSonata_Price_Currency_DataTransformerService()
    {
        return $this->services['sonata.price.currency.data_transformer'] = new \Sonata\Component\Currency\CurrencyDataTransformer($this->get('sonata.price.currency.manager'));
    }
    protected function getSonata_Price_Currency_DetectorService()
    {
        return $this->services['sonata.price.currency.detector'] = new \Sonata\Component\Currency\CurrencyDetector('EUR', $this->get('sonata.price.currency.manager'));
    }
    protected function getSonata_Price_Currency_FormTypeService()
    {
        return $this->services['sonata.price.currency.form_type'] = new \Sonata\Component\Currency\CurrencyFormType($this->get('sonata.price.currency.data_transformer'));
    }
    protected function getSonata_Price_Currency_ManagerService()
    {
        return $this->services['sonata.price.currency.manager'] = new \Sonata\Component\Currency\CurrencyManager('Sonata\\Component\\Currency\\CurrencyManager', $this->get('doctrine'));
    }
    protected function getSonata_Product_Admin_DeliveryService()
    {
        $instance = new \Sonata\ProductBundle\Admin\DeliveryAdmin('sonata.product.admin.delivery', 'Application\\Sonata\\ProductBundle\\Entity\\Delivery', 'SonataAdminBundle:CRUD');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('delivery');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Product_Admin_ProductService()
    {
        $a = $this->get('sonata.product.pool');
        $b = $this->get('sonata.price.currency.detector');
        $c = $this->get('sonata.admin.label.strategy.underscore');
        $d = $this->get('sonata.admin.manager.orm');
        $e = $this->get('sonata.admin.builder.orm_form');
        $f = $this->get('sonata.admin.builder.orm_show');
        $g = $this->get('sonata.admin.builder.orm_list');
        $h = $this->get('sonata.admin.builder.orm_datagrid');
        $i = $this->get('translator.default');
        $j = $this->get('sonata.admin.pool');
        $k = $this->get('sonata.admin.route.default_generator');
        $l = $this->get('validator');
        $m = $this->get('sonata.admin.security.handler');
        $n = $this->get('knp_menu.factory');
        $o = $this->get('sonata.admin.route.path_info');
        $p = $this->get('sonata.admin.event.extension');
        $q = $this->get('sonata.timeline.admin.extension');
        $r = new \Sonata\ProductBundle\Admin\ProductCategoryAdmin('sonata.product.admin.product.category', 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory', 'SonataAdminBundle:CRUD');
        $r->setLabelTranslatorStrategy($c);
        $r->setManagerType('orm');
        $r->setModelManager($d);
        $r->setFormContractor($e);
        $r->setShowBuilder($f);
        $r->setListBuilder($g);
        $r->setDatagridBuilder($h);
        $r->setTranslator($i);
        $r->setConfigurationPool($j);
        $r->setRouteGenerator($k);
        $r->setValidator($l);
        $r->setSecurityHandler($m);
        $r->setMenuFactory($n);
        $r->setRouteBuilder($o);
        $r->setLabel('product_category');
        $r->setPersistFilters(false);
        $r->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $r->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $r->initialize();
        $r->addExtension($p);
        $r->addExtension($q);
        $r->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $r->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $s = new \Sonata\ProductBundle\Admin\ProductCollectionAdmin('sonata.product.admin.product.collection', 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection', 'SonataAdminBundle:CRUD');
        $s->setLabelTranslatorStrategy($c);
        $s->setManagerType('orm');
        $s->setModelManager($d);
        $s->setFormContractor($e);
        $s->setShowBuilder($f);
        $s->setListBuilder($g);
        $s->setDatagridBuilder($h);
        $s->setTranslator($i);
        $s->setConfigurationPool($j);
        $s->setRouteGenerator($k);
        $s->setValidator($l);
        $s->setSecurityHandler($m);
        $s->setMenuFactory($n);
        $s->setRouteBuilder($o);
        $s->setLabel('product_collection');
        $s->setPersistFilters(false);
        $s->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $s->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $s->initialize();
        $s->addExtension($p);
        $s->addExtension($q);
        $s->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $s->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $t = new \Sonata\ProductBundle\Admin\DeliveryAdmin('sonata.product.admin.delivery', 'Application\\Sonata\\ProductBundle\\Entity\\Delivery', 'SonataAdminBundle:CRUD');
        $t->setLabelTranslatorStrategy($c);
        $t->setManagerType('orm');
        $t->setModelManager($d);
        $t->setFormContractor($e);
        $t->setShowBuilder($f);
        $t->setListBuilder($g);
        $t->setDatagridBuilder($h);
        $t->setTranslator($i);
        $t->setConfigurationPool($j);
        $t->setRouteGenerator($k);
        $t->setValidator($l);
        $t->setSecurityHandler($m);
        $t->setMenuFactory($n);
        $t->setRouteBuilder($o);
        $t->setLabel('delivery');
        $t->setPersistFilters(false);
        $t->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $t->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $t->initialize();
        $t->addExtension($p);
        $t->addExtension($q);
        $t->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $t->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $u = new \Sonata\ProductBundle\Admin\ProductVariationAdmin('sonata.product.admin.product.variation', 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'SonataProductBundle:ProductVariationAdmin');
        $u->setProductPool($a);
        $u->setCurrencyDetector($b);
        $u->setLabelTranslatorStrategy($c);
        $u->setManagerType('orm');
        $u->setModelManager($d);
        $u->setFormContractor($e);
        $u->setShowBuilder($f);
        $u->setListBuilder($g);
        $u->setDatagridBuilder($h);
        $u->setTranslator($i);
        $u->setConfigurationPool($j);
        $u->setRouteGenerator($k);
        $u->setValidator($l);
        $u->setSecurityHandler($m);
        $u->setMenuFactory($n);
        $u->setRouteBuilder($o);
        $u->setLabel('product_variation');
        $u->setPersistFilters(false);
        $u->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $u->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $u->initialize();
        $u->addExtension($p);
        $u->addExtension($q);
        $u->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $u->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        $instance = new \Sonata\ProductBundle\Admin\ProductAdmin('sonata.product.admin.product', 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'SonataProductBundle:ProductAdmin');
        $instance->addChild($r);
        $instance->addChild($s);
        $instance->addChild($t);
        $instance->addChild($u);
        $instance->setProductPool($a);
        $instance->setCurrencyDetector($b);
        $instance->setLabelTranslatorStrategy($c);
        $instance->setManagerType('orm');
        $instance->setModelManager($d);
        $instance->setFormContractor($e);
        $instance->setShowBuilder($f);
        $instance->setListBuilder($g);
        $instance->setDatagridBuilder($h);
        $instance->setTranslator($i);
        $instance->setConfigurationPool($j);
        $instance->setRouteGenerator($k);
        $instance->setValidator($l);
        $instance->setSecurityHandler($m);
        $instance->setMenuFactory($n);
        $instance->setRouteBuilder($o);
        $instance->setLabel('product');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($p);
        $instance->addExtension($q);
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Product_Admin_Product_CategoryService()
    {
        $instance = new \Sonata\ProductBundle\Admin\ProductCategoryAdmin('sonata.product.admin.product.category', 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory', 'SonataAdminBundle:CRUD');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('product_category');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Product_Admin_Product_CollectionService()
    {
        $instance = new \Sonata\ProductBundle\Admin\ProductCollectionAdmin('sonata.product.admin.product.collection', 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection', 'SonataAdminBundle:CRUD');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('product_collection');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Product_Admin_Product_ManagerService()
    {
        return $this->services['sonata.product.admin.product.manager'] = new \Sonata\ProductBundle\Model\DoctrineModelManager($this->get('doctrine'), $this->get('sonata.product.pool'));
    }
    protected function getSonata_Product_Admin_Product_VariationService()
    {
        $instance = new \Sonata\ProductBundle\Admin\ProductVariationAdmin('sonata.product.admin.product.variation', 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'SonataProductBundle:ProductVariationAdmin');
        $instance->setProductPool($this->get('sonata.product.pool'));
        $instance->setCurrencyDetector($this->get('sonata.price.currency.detector'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('product_variation');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_Product_Api_Form_Type_ProductService()
    {
        return $this->services['sonata.product.api.form.type.product'] = new \Sonata\ProductBundle\Form\Type\ApiProductType($this->get('sonata.product.pool'));
    }
    protected function getSonata_Product_Api_Form_Type_Product_ParentService()
    {
        return $this->services['sonata.product.api.form.type.product.parent'] = new \Sonata\CoreBundle\Form\Type\DoctrineORMSerializationType($this->get('jms_serializer.metadata_factory'), $this->get('doctrine'), 'sonata_product_api_form_product_parent', 'Application\\Sonata\\ProductBundle\\Entity\\Product', 'sonata_api_write');
    }
    protected function getSonata_Product_Block_BreadcrumbService()
    {
        return $this->services['sonata.product.block.breadcrumb'] = new \Sonata\ProductBundle\Block\CatalogBreadcrumbBlockService('catalog', 'sonata.product.block.breadcrumb', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_Product_Block_CategoriesMenuService()
    {
        return $this->services['sonata.product.block.categories_menu'] = new \Sonata\ProductBundle\Block\CategoriesMenuBlockService('sonata.product.block.categories_menu', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('sonata.product.menu.product_menu_builder'));
    }
    protected function getSonata_Product_Block_FiltersMenuService()
    {
        return $this->services['sonata.product.block.filters_menu'] = new \Sonata\ProductBundle\Block\FiltersMenuBlockService('sonata.product.block.product_menu', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('sonata.product.menu.product_menu_builder'));
    }
    protected function getSonata_Product_Block_RecentProductsService()
    {
        return $this->services['sonata.product.block.recent_products'] = new \Sonata\ProductBundle\Block\RecentProductsBlockService('sonata.product.block.recent_products', $this->get('templating'), $this->get('doctrine'), $this->get('sonata.price.currency.detector'));
    }
    protected function getSonata_Product_Block_SimilarProductsService()
    {
        return $this->services['sonata.product.block.similar_products'] = new \Sonata\ProductBundle\Block\SimilarProductsBlockService('sonata.product.block.similar_products', $this->get('templating'), $this->get('doctrine'), $this->get('sonata.price.currency.detector'), $this->get('sonata.product.finder'));
    }
    protected function getSonata_Product_Block_VariationsFormService()
    {
        return $this->services['sonata.product.block.variations_form'] = new \Sonata\ProductBundle\Block\VariationsFormBlockService('sonata.product.block.variations_form', $this->get('templating'), $this->get('sonata.product.pool'), $this->get('form.factory'));
    }
    protected function getSonata_Product_Controller_Api_ProductService()
    {
        return $this->services['sonata.product.controller.api.product'] = new \Sonata\ProductBundle\Controller\Api\ProductController($this->get('sonata.product.set.manager'), $this->get('sonata.product.pool'), $this->get('form.factory'), $this->get('sonata.formatter.pool'));
    }
    protected function getSonata_Product_FinderService()
    {
        return $this->services['sonata.product.finder'] = new \Sonata\Component\Product\ProductFinder($this->get('sonata.product.set.manager'));
    }
    protected function getSonata_Product_Form_DeliveryTypeService()
    {
        return $this->services['sonata.product.form.delivery_type'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\ProductBundle\\Entity\\Delivery', 'getStatusList', 'sonata_product_delivery_status');
    }
    protected function getSonata_Product_Form_VariationChoicesTypeService()
    {
        return $this->services['sonata.product.form.variation_choices_type'] = new \Sonata\Component\Form\Type\VariationChoiceType($this->get('sonata.product.pool'));
    }
    protected function getSonata_Product_Menu_ProductMenuBuilderService()
    {
        return $this->services['sonata.product.menu.product_menu_builder'] = new \Sonata\ProductBundle\Menu\ProductMenuBuilder($this->get('knp_menu.factory'), $this->get('sonata.product_category.product'), $this->get('cmf_routing.router'));
    }
    protected function getSonata_Product_PoolService()
    {
        $this->services['sonata.product.pool'] = $instance = new \Sonata\Component\Product\Pool();
        $instance->addProduct('sonata.ecommerce_demo.product.goodie', new \Sonata\Component\Product\ProductDefinition($this->get('sonata.ecommerce_demo.product.goodie.type'), $this->get('sonata.ecommerce_demo.product.goodie.manager')));
        $instance->addProduct('sonata.ecommerce_demo.product.travel', new \Sonata\Component\Product\ProductDefinition($this->get('sonata.ecommerce_demo.product.travel.type'), $this->get('sonata.ecommerce_demo.product.travel.manager')));
        return $instance;
    }
    protected function getSonata_Product_Seo_FacebookService()
    {
        return $this->services['sonata.product.seo.facebook'] = new \Sonata\ProductBundle\Seo\Services\Facebook($this->get('cmf_routing.router'), $this->get('sonata.media.pool'), $this->get('sonata.intl.templating.helper.number'), $this->get('sonata.price.currency.detector'), 'http://demo.sonata-project.org', 'reference');
    }
    protected function getSonata_Product_Seo_TwitterService()
    {
        return $this->services['sonata.product.seo.twitter'] = new \Sonata\ProductBundle\Seo\Services\Twitter($this->get('sonata.media.pool'), $this->get('sonata.intl.templating.helper.number'), $this->get('sonata.price.currency.detector'), '@sonataproject', '@th0masr', 'http://demo.sonata-project.org', 'reference');
    }
    protected function getSonata_Product_SeoIteratorService()
    {
        return $this->services['sonata.product.seo_iterator'] = new \Sonata\Component\Product\SeoProductIterator($this->get('doctrine'), 'Application\\Sonata\\ProductBundle\\Entity\\Product', $this->get('cmf_routing.router'), 'sonata_product_view');
    }
    protected function getSonata_Product_Serializer_Handler_ProductService()
    {
        return $this->services['sonata.product.serializer.handler.product'] = new \Sonata\ProductBundle\Serializer\ProductSerializerHandler($this->get('sonata.product.set.manager'));
    }
    protected function getSonata_Product_Set_ManagerService()
    {
        return $this->services['sonata.product.set.manager'] = new \Sonata\ProductBundle\Entity\ProductSetManager('Application\\Sonata\\ProductBundle\\Entity\\Product', $this->get('doctrine'));
    }
    protected function getSonata_Product_Subscriber_OrmService()
    {
        return $this->services['sonata.product.subscriber.orm'] = new \Sonata\Component\Subscriber\ORMInheritanceSubscriber(array('sonata.ecommerce_demo.product.goodie' => 'Application\\Sonata\\ProductBundle\\Entity\\Goodie', 'sonata.ecommerce_demo.product.travel' => 'Application\\Sonata\\ProductBundle\\Entity\\Travel'));
    }
    protected function getSonata_ProductCategory_ProductService()
    {
        return $this->services['sonata.product_category.product'] = new \Sonata\ProductBundle\Entity\ProductCategoryManager('Application\\Sonata\\ProductBundle\\Entity\\ProductCategory', $this->get('doctrine'));
    }
    protected function getSonata_ProductCollection_ProductService()
    {
        return $this->services['sonata.product_collection.product'] = new \Sonata\ProductBundle\Entity\ProductCollectionManager('Application\\Sonata\\ProductBundle\\Entity\\ProductCollection', $this->get('doctrine'));
    }
    protected function getSonata_Seo_Block_Breadcrumb_HomepageService()
    {
        return $this->services['sonata.seo.block.breadcrumb.homepage'] = new \Sonata\SeoBundle\Block\Breadcrumb\HomepageBreadcrumbBlockService('homepage', 'sonata.seo.block.breadcrumb.homepage', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_Seo_Block_Email_ShareButtonService()
    {
        return $this->services['sonata.seo.block.email.share_button'] = new \Sonata\SeoBundle\Block\Social\EmailShareButtonBlockService('sonata.seo.block.email.share_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Facebook_LikeBoxService()
    {
        return $this->services['sonata.seo.block.facebook.like_box'] = new \Sonata\SeoBundle\Block\Social\FacebookLikeBoxBlockService('sonata.seo.block.facebook.like_box', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Facebook_LikeButtonService()
    {
        return $this->services['sonata.seo.block.facebook.like_button'] = new \Sonata\SeoBundle\Block\Social\FacebookLikeButtonBlockService('sonata.seo.block.facebook.like_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Facebook_SendButtonService()
    {
        return $this->services['sonata.seo.block.facebook.send_button'] = new \Sonata\SeoBundle\Block\Social\FacebookSendButtonBlockService('sonata.seo.block.facebook.send_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Facebook_ShareButtonService()
    {
        return $this->services['sonata.seo.block.facebook.share_button'] = new \Sonata\SeoBundle\Block\Social\FacebookShareButtonBlockService('sonata.seo.block.facebook.share_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Pinterest_PinButtonService()
    {
        return $this->services['sonata.seo.block.pinterest.pin_button'] = new \Sonata\SeoBundle\Block\Social\PinterestPinButtonBlockService('sonata.seo.block.pinterest.pin_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Twitter_EmbedService()
    {
        return $this->services['sonata.seo.block.twitter.embed'] = new \Sonata\SeoBundle\Block\Social\TwitterEmbedTweetBlockService('sonata.seo.block.twitter.embed', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Twitter_FollowButtonService()
    {
        return $this->services['sonata.seo.block.twitter.follow_button'] = new \Sonata\SeoBundle\Block\Social\TwitterFollowButtonBlockService('sonata.seo.block.twitter.follow_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Twitter_HashtagButtonService()
    {
        return $this->services['sonata.seo.block.twitter.hashtag_button'] = new \Sonata\SeoBundle\Block\Social\TwitterHashtagButtonBlockService('sonata.seo.block.twitter.hashtag_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Twitter_MentionButtonService()
    {
        return $this->services['sonata.seo.block.twitter.mention_button'] = new \Sonata\SeoBundle\Block\Social\TwitterMentionButtonBlockService('sonata.seo.block.twitter.mention_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Block_Twitter_ShareButtonService()
    {
        return $this->services['sonata.seo.block.twitter.share_button'] = new \Sonata\SeoBundle\Block\Social\TwitterShareButtonBlockService('sonata.seo.block.twitter.share_button', $this->get('templating'));
    }
    protected function getSonata_Seo_Event_BreadcrumbService()
    {
        $this->services['sonata.seo.event.breadcrumb'] = $instance = new \Sonata\SeoBundle\Event\BreadcrumbListener();
        $instance->addBlockService('sonata.user.block.breadcrumb_index', $this->get('sonata.user.block.breadcrumb_index'));
        $instance->addBlockService('sonata.user.block.breadcrumb_profile', $this->get('sonata.user.block.breadcrumb_profile'));
        $instance->addBlockService('sonata.page.block.breadcrumb', $this->get('sonata.page.block.breadcrumb'));
        $instance->addBlockService('sonata.news.block.breadcrumb_archive', $this->get('sonata.news.block.breadcrumb_archive'));
        $instance->addBlockService('sonata.news.block.breadcrumb_post', $this->get('sonata.news.block.breadcrumb_post'));
        $instance->addBlockService('sonata.media.block.breadcrumb_view', $this->get('sonata.media.block.breadcrumb_view'));
        $instance->addBlockService('sonata.media.block.breadcrumb_index', $this->get('sonata.media.block.breadcrumb_index'));
        $instance->addBlockService('sonata.media.block.breadcrumb_view_media', $this->get('sonata.media.block.breadcrumb_view_media'));
        $instance->addBlockService('sonata.customer.block.breadcrumb_address', $this->get('sonata.customer.block.breadcrumb_address'));
        $instance->addBlockService('sonata.order.block.breadcrumb_order', $this->get('sonata.order.block.breadcrumb_order'));
        $instance->addBlockService('sonata.product.block.breadcrumb', $this->get('sonata.product.block.breadcrumb'));
        $instance->addBlockService('sonata.seo.block.breadcrumb.homepage', $this->get('sonata.seo.block.breadcrumb.homepage'));
        return $instance;
    }
    protected function getSonata_Seo_Page_DefaultService()
    {
        $this->services['sonata.seo.page.default'] = $instance = new \Sonata\SeoBundle\Seo\SeoPage();
        $instance->setTitle('Sonata Project');
        $instance->setMetas(array('name' => array('keywords' => 'foo bar', 'description' => 'The description', 'robots' => 'index, follow'), 'property' => array('og:site_name' => 'Sonata Project Sandbox', 'og:description' => 'A demo of the some rich bundles for your Symfony2 projects'), 'http-equiv' => array('Content-Type' => 'text/html; charset=utf-8')));
        $instance->setHtmlAttributes(array('xmlns' => 'http://www.w3.org/1999/xhtml'));
        $instance->setSeparator(' - ');
        return $instance;
    }
    protected function getSonata_Seo_Sitemap_ManagerService()
    {
        $instance = new \Sonata\SeoBundle\Sitemap\SourceManager();
        $instance->addSource(false, $this->get('sonata.seo.source.doctrine_sitemap_iterator_0'), array());
        $instance->addSource(false, $this->get('sonata.seo.source.doctrine_sitemap_iterator_1'), array());
        $instance->addSource(false, $this->get('sonata.seo.source.doctrine_sitemap_iterator_2'), array());
        $instance->addSource(false, $this->get('sonata.seo.source.doctrine_sitemap_iterator_3'), array());
        $instance->addSource(false, $this->get('sonata.seo.source.doctrine_sitemap_iterator_4'), array());
        $instance->addSource(false, $this->get('sonata.product.seo_iterator'), array());
        return $instance;
    }
    protected function getSonata_Timeline_Admin_ExtensionService()
    {
        return $this->services['sonata.timeline.admin.extension'] = new \Sonata\TimelineBundle\Admin\AdminExtension($this->get('spy_timeline.action_manager.orm'), $this->get('security.context'));
    }
    protected function getSonata_Timeline_Block_TimelineService()
    {
        return $this->services['sonata.timeline.block.timeline'] = new \Sonata\TimelineBundle\Block\TimelineBlock('sonata.timeline.block.timeline', $this->get('templating'), $this->get('spy_timeline.action_manager.orm'), $this->get('spy_timeline.timeline_manager.orm'), $this->get('security.context'));
    }
    protected function getSonata_Timeline_Spread_AdminService()
    {
        return $this->services['sonata.timeline.spread.admin'] = new \Sonata\TimelineBundle\Spread\AdminSpread($this->get('doctrine'), 'Application\\Sonata\\UserBundle\\Entity\\User');
    }
    protected function getSonata_Timeline_Twig_ExtensionService()
    {
        return $this->services['sonata.timeline.twig.extension'] = new \Sonata\TimelineBundle\Twig\Extension\SonataTimelineExtension($this->get('sonata.admin.pool', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSonata_Transaction_ManagerService()
    {
        return $this->services['sonata.transaction.manager'] = new \Sonata\PaymentBundle\Entity\TransactionManager('Application\\Sonata\\PaymentBundle\\Entity\\Transaction', $this->get('doctrine'));
    }
    protected function getSonata_User_Admin_GroupService()
    {
        $instance = new \Sonata\UserBundle\Admin\Entity\GroupAdmin('sonata.user.admin.group', 'Application\\Sonata\\UserBundle\\Entity\\Group', 'SonataAdminBundle:CRUD');
        $instance->setTranslationDomain('SonataUserBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('groups');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_User_Admin_UserService()
    {
        $instance = new \Sonata\UserBundle\Admin\Entity\UserAdmin('sonata.user.admin.user', 'Application\\Sonata\\UserBundle\\Entity\\User', 'SonataAdminBundle:CRUD');
        $instance->setUserManager($this->get('fos_user.user_manager'));
        $instance->setTranslationDomain('SonataUserBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('users');
        $instance->setPersistFilters(false);
        $instance->setTemplates(array('user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig', 'add_block' => 'SonataAdminBundle:Core:add_block.html.twig', 'layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig', 'acl' => 'SonataAdminBundle:CRUD:acl.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig', 'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig', 'preview' => 'SonataAdminBundle:CRUD:preview.html.twig', 'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig', 'delete' => 'SonataAdminBundle:CRUD:delete.html.twig', 'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig', 'select' => 'SonataAdminBundle:CRUD:list__select.html.twig', 'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig', 'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig', 'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'pager_links' => 'SonataAdminBundle:Pager:links.html.twig', 'pager_results' => 'SonataAdminBundle:Pager:results.html.twig', 'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig', 'search' => 'SonataAdminBundle:Core:search.html.twig', 'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig'));
        $instance->setSecurityInformation(array('GUEST' => array(0 => 'VIEW', 1 => 'LIST'), 'STAFF' => array(0 => 'EDIT', 1 => 'LIST', 2 => 'CREATE'), 'EDITOR' => array(0 => 'OPERATOR', 1 => 'EXPORT'), 'ADMIN' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));
        $instance->addExtension($this->get('sonata.timeline.admin.extension'));
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));
        return $instance;
    }
    protected function getSonata_User_Block_AccountService()
    {
        return $this->services['sonata.user.block.account'] = new \Sonata\UserBundle\Block\AccountBlockService('sonata.user.block.account', $this->get('templating'), $this->get('security.context'));
    }
    protected function getSonata_User_Block_BreadcrumbIndexService()
    {
        return $this->services['sonata.user.block.breadcrumb_index'] = new \Sonata\UserBundle\Block\Breadcrumb\UserIndexBreadcrumbBlockService('user_index', 'sonata.user.block.breadcrumb_index', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_User_Block_BreadcrumbProfileService()
    {
        return $this->services['sonata.user.block.breadcrumb_profile'] = new \Sonata\UserBundle\Block\Breadcrumb\UserProfileBreadcrumbBlockService('user_profile', 'sonata.user.block.breadcrumb_profile', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('knp_menu.factory'));
    }
    protected function getSonata_User_Block_MenuService()
    {
        return $this->services['sonata.user.block.menu'] = new \Sonata\UserBundle\Block\ProfileMenuBlockService('sonata.user.block.menu', $this->get('templating'), $this->get('knp_menu.menu_provider'), $this->get('sonata.user.profile.menu_builder'));
    }
    protected function getSonata_User_Controller_Api_GroupService()
    {
        return $this->services['sonata.user.controller.api.group'] = new \Sonata\UserBundle\Controller\Api\GroupController($this->get('fos_user.group_manager'));
    }
    protected function getSonata_User_Controller_Api_UserService()
    {
        return $this->services['sonata.user.controller.api.user'] = new \Sonata\UserBundle\Controller\Api\UserController($this->get('fos_user.user_manager'));
    }
    protected function getSonata_User_EditableRoleBuilderService()
    {
        return $this->services['sonata.user.editable_role_builder'] = new \Sonata\UserBundle\Security\EditableRolesBuilder($this->get('security.context'), $this->get('sonata.admin.pool'), array('ROLE_ADMIN' => array(0 => 'ROLE_USER'), 'ROLE_SUPER_ADMIN' => array(0 => 'ROLE_USER', 1 => 'ROLE_SONATA_ADMIN', 2 => 'ROLE_ADMIN', 3 => 'ROLE_ALLOWED_TO_SWITCH', 4 => 'ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT', 5 => 'ROLE_SONATA_PAGE_ADMIN_BLOCK_EDIT'), 'SONATA' => array()));
    }
    protected function getSonata_User_Form_GenderListService()
    {
        return $this->services['sonata.user.form.gender_list'] = new \Sonata\CoreBundle\Form\Type\StatusType('Application\\Sonata\\UserBundle\\Entity\\User', 'getGenderList', 'sonata_user_gender');
    }
    protected function getSonata_User_Form_Type_SecurityRolesService()
    {
        return $this->services['sonata.user.form.type.security_roles'] = new \Sonata\UserBundle\Form\Type\SecurityRolesType($this->get('sonata.user.editable_role_builder'));
    }
    protected function getSonata_User_Google_AuthenticatorService()
    {
        return $this->services['sonata.user.google.authenticator'] = new \Google\Authenticator\GoogleAuthenticator();
    }
    protected function getSonata_User_Google_Authenticator_InteractiveLoginListenerService()
    {
        return $this->services['sonata.user.google.authenticator.interactive_login_listener'] = new \Sonata\UserBundle\GoogleAuthenticator\InteractiveLoginListener($this->get('sonata.user.google.authenticator.provider'));
    }
    protected function getSonata_User_Google_Authenticator_ProviderService()
    {
        return $this->services['sonata.user.google.authenticator.provider'] = new \Sonata\UserBundle\GoogleAuthenticator\Helper('demo.sonata-project.org', $this->get('sonata.user.google.authenticator'));
    }
    protected function getSonata_User_Google_Authenticator_RequestListenerService()
    {
        return $this->services['sonata.user.google.authenticator.request_listener'] = new \Sonata\UserBundle\GoogleAuthenticator\RequestListener($this->get('sonata.user.google.authenticator.provider'), $this->get('security.context'), $this->get('templating'));
    }
    protected function getSonata_User_Profile_FormService()
    {
        return $this->services['sonata.user.profile.form'] = $this->get('form.factory')->createNamed('sonata_user_profile_form', 'sonata_user_profile', NULL, array('validation_groups' => array(0 => 'Profile', 1 => 'Default'), 'translation_domain' => 'SonataUserBundle'));
    }
    protected function getSonata_User_Profile_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('sonata.user.profile.form.handler', 'request');
        }
        return $this->services['sonata.user.profile.form.handler'] = $this->scopedServices['request']['sonata.user.profile.form.handler'] = new \Sonata\UserBundle\Form\Handler\ProfileFormHandler($this->get('sonata.user.profile.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }
    protected function getSonata_User_Profile_Form_TypeService()
    {
        return $this->services['sonata.user.profile.form.type'] = new \Sonata\UserBundle\Form\Type\ProfileType('Application\\Sonata\\UserBundle\\Entity\\User');
    }
    protected function getSonata_User_Profile_MenuBuilderService()
    {
        return $this->services['sonata.user.profile.menu_builder'] = new \Sonata\UserBundle\Menu\ProfileMenuBuilder($this->get('knp_menu.factory'), $this->get('translator.default'), array(0 => array('route' => 'sonata_user_profile_show', 'label' => 'sonata_profile_title', 'domain' => 'SonataUserBundle', 'route_parameters' => array()), 1 => array('route' => 'sonata_user_profile_edit', 'label' => 'link_edit_profile', 'domain' => 'SonataUserBundle', 'route_parameters' => array()), 2 => array('route' => 'sonata_customer_addresses', 'label' => 'link_list_addresses', 'domain' => 'SonataCustomerBundle', 'route_parameters' => array()), 3 => array('route' => 'sonata_order_index', 'label' => 'order_list', 'domain' => 'SonataOrderBundle', 'route_parameters' => array())), $this->get('event_dispatcher'));
    }
    protected function getSonata_User_Twig_GlobalService()
    {
        return $this->services['sonata.user.twig.global'] = new \Sonata\UserBundle\Twig\GlobalVariables($this);
    }
    protected function getSpyTimeline_ActionManager_OrmService()
    {
        $a = new \Spy\Timeline\Spread\Deployer($this->get('spy_timeline.timeline_manager.orm'), $this->get('spy_timeline.spread.entry_collection'), true, '50');
        $a->setDelivery('immediate');
        $a->addSpread(new \Sonata\TimelineBundle\Spread\AdminSpread($this->get('doctrine'), 'Application\\Sonata\\UserBundle\\Entity\\User'));
        $b = new \Spy\TimelineBundle\ResolveComponent\DoctrineComponentDataResolver();
        $b->addRegistry(new \Doctrine\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default'));
        $this->services['spy_timeline.action_manager.orm'] = $instance = new \Spy\TimelineBundle\Driver\ORM\ActionManager($this->get('doctrine.orm.default_entity_manager'), $this->get('spy_timeline.result_builder'), 'Application\\Sonata\\TimelineBundle\\Entity\\Action', 'Application\\Sonata\\TimelineBundle\\Entity\\Component', 'Application\\Sonata\\TimelineBundle\\Entity\\ActionComponent');
        $instance->setDeployer($a);
        $instance->setComponentDataResolver($b);
        return $instance;
    }
    protected function getSpyTimeline_Filter_DataHydratorService()
    {
        $this->services['spy_timeline.filter.data_hydrator'] = $instance = new \Spy\Timeline\Filter\DataHydrator(false);
        $instance->setPriority(20);
        $instance->addLocator(new \Spy\TimelineBundle\Filter\DataHydrator\Locator\DoctrineORM($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        return $instance;
    }
    protected function getSpyTimeline_Filter_DataHydrator_Locator_DoctrineOdmService()
    {
        return $this->services['spy_timeline.filter.data_hydrator.locator.doctrine_odm'] = new \Spy\TimelineBundle\Filter\DataHydrator\Locator\DoctrineODM(NULL);
    }
    protected function getSpyTimeline_Filter_DataHydrator_Locator_DoctrineOrmService()
    {
        return $this->services['spy_timeline.filter.data_hydrator.locator.doctrine_orm'] = new \Spy\TimelineBundle\Filter\DataHydrator\Locator\DoctrineORM($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSpyTimeline_Filter_DuplicateKeyService()
    {
        return $this->services['spy_timeline.filter.duplicate_key'] = new \Spy\Timeline\Filter\DuplicateKey();
    }
    protected function getSpyTimeline_Filter_ManagerService()
    {
        $a = new \Spy\Timeline\Filter\DataHydrator(false);
        $a->setPriority(20);
        $a->addLocator(new \Spy\TimelineBundle\Filter\DataHydrator\Locator\DoctrineORM($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $this->services['spy_timeline.filter.manager'] = $instance = new \Spy\Timeline\Filter\FilterManager();
        $instance->add($a);
        return $instance;
    }
    protected function getSpyTimeline_Paginator_KnpService()
    {
        return $this->services['spy_timeline.paginator.knp'] = new \Spy\Timeline\ResultBuilder\Pager\KnpPager($this->get('knp_paginator', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSpyTimeline_QueryBuilder_FactoryService()
    {
        return $this->services['spy_timeline.query_builder.factory'] = new \Spy\Timeline\Driver\QueryBuilder\QueryBuilderFactory(array('query_builder' => 'Spy\\TimelineBundle\\Driver\\ORM\\QueryBuilder\\QueryBuilder', 'asserter' => 'Spy\\Timeline\\Driver\\QueryBuilder\\Criteria\\Asserter', 'operator' => 'Spy\\Timeline\\Driver\\QueryBuilder\\Criteria\\Operator'));
    }
    protected function getSpyTimeline_QueryBuilder_OrmService()
    {
        return $this->services['spy_timeline.query_builder.orm'] = new \Spy\TimelineBundle\Driver\ORM\QueryBuilder\QueryBuilder($this->get('spy_timeline.query_builder.factory'), $this->get('doctrine.orm.default_entity_manager'), $this->get('spy_timeline.result_builder'), 'Application\\Sonata\\TimelineBundle\\Entity\\Action');
    }
    protected function getSpyTimeline_ResolveComponent_BasicService()
    {
        return $this->services['spy_timeline.resolve_component.basic'] = new \Spy\Timeline\ResolveComponent\BasicComponentDataResolver();
    }
    protected function getSpyTimeline_ResolveComponent_DoctrineService()
    {
        $this->services['spy_timeline.resolve_component.doctrine'] = $instance = new \Spy\TimelineBundle\ResolveComponent\DoctrineComponentDataResolver();
        $instance->addRegistry(new \Doctrine\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default'));
        return $instance;
    }
    protected function getSpyTimeline_ResultBuilderService()
    {
        $a = new \Spy\Timeline\Filter\DataHydrator(false);
        $a->setPriority(20);
        $a->addLocator(new \Spy\TimelineBundle\Filter\DataHydrator\Locator\DoctrineORM($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $b = new \Spy\Timeline\Filter\FilterManager();
        $b->add($a);
        $this->services['spy_timeline.result_builder'] = $instance = new \Spy\Timeline\ResultBuilder\ResultBuilder(new \Spy\TimelineBundle\Driver\ORM\QueryExecutor(), $b);
        $instance->setPager(new \Spy\TimelineBundle\Driver\ORM\Pager());
        return $instance;
    }
    protected function getSpyTimeline_Spread_Deployer_DefaultService()
    {
        $this->services['spy_timeline.spread.deployer.default'] = $instance = new \Spy\Timeline\Spread\Deployer($this->get('spy_timeline.timeline_manager.orm'), $this->get('spy_timeline.spread.entry_collection'), true, '50');
        $instance->setDelivery('immediate');
        $instance->addSpread(new \Sonata\TimelineBundle\Spread\AdminSpread($this->get('doctrine'), 'Application\\Sonata\\UserBundle\\Entity\\User'));
        return $instance;
    }
    protected function getSpyTimeline_Spread_EntryCollectionService()
    {
        return $this->services['spy_timeline.spread.entry_collection'] = new \Spy\Timeline\Spread\Entry\EntryCollection(true, '50');
    }
    protected function getSpyTimeline_TimelineManager_OrmService()
    {
        return $this->services['spy_timeline.timeline_manager.orm'] = new \Spy\TimelineBundle\Driver\ORM\TimelineManager($this->get('doctrine.orm.default_entity_manager'), $this->get('spy_timeline.result_builder'), 'Application\\Sonata\\TimelineBundle\\Entity\\Timeline');
    }
    protected function getSpyTimeline_Twig_Extension_TimelineService()
    {
        return $this->services['spy_timeline.twig.extension.timeline'] = new \Spy\TimelineBundle\Twig\Extension\TimelineExtension($this->get('twig'), array('path' => 'SpyTimelineBundle:Timeline', 'fallback' => 'SpyTimelineBundle:Timeline:default.html.twig', 'i18n_fallback' => NULL), array(0 => 'SpyTimelineBundle:Action:components.html.twig'));
    }
    protected function getSpyTimeline_UnreadNotificationsService()
    {
        return $this->services['spy_timeline.unread_notifications'] = new \Spy\Timeline\Notification\Unread\UnreadNotificationManager($this->get('spy_timeline.timeline_manager.orm'));
    }
    protected function getStreamedResponseListenerService()
    {
        return $this->services['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener();
    }
    protected function getSwiftmailer_EmailSender_ListenerService()
    {
        return $this->services['swiftmailer.email_sender.listener'] = new \Symfony\Bundle\SwiftmailerBundle\EventListener\EmailSenderListener($this, $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSwiftmailer_Mailer_DefaultService()
    {
        return $this->services['swiftmailer.mailer.default'] = new \Swift_Mailer($this->get('swiftmailer.mailer.default.transport'));
    }
    protected function getSwiftmailer_Mailer_Default_TransportService()
    {
        $a = new \Swift_Transport_Esmtp_AuthHandler(array(0 => new \Swift_Transport_Esmtp_Auth_CramMd5Authenticator(), 1 => new \Swift_Transport_Esmtp_Auth_LoginAuthenticator(), 2 => new \Swift_Transport_Esmtp_Auth_PlainAuthenticator()));
        $a->setUsername(NULL);
        $a->setPassword(NULL);
        $a->setAuthMode(NULL);
        $this->services['swiftmailer.mailer.default.transport'] = $instance = new \Swift_Transport_EsmtpTransport(new \Swift_Transport_StreamBuffer(new \Swift_StreamFilters_StringReplacementFilterFactory()), array(0 => $a), new \Swift_Events_SimpleEventDispatcher());
        $instance->setHost('localhost');
        $instance->setPort(25);
        $instance->setEncryption(NULL);
        $instance->setTimeout(30);
        $instance->setSourceIp(NULL);
        return $instance;
    }
    protected function getTemplatingService()
    {
        return $this->services['templating'] = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('twig'), $this->get('templating.name_parser'), $this->get('templating.locator'));
    }
    protected function getTemplating_Asset_PackageFactoryService()
    {
        return $this->services['templating.asset.package_factory'] = new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PackageFactory($this);
    }
    protected function getTemplating_FilenameParserService()
    {
        return $this->services['templating.filename_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateFilenameParser();
    }
    protected function getTemplating_GlobalsService()
    {
        return $this->services['templating.globals'] = new \Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables($this);
    }
    protected function getTemplating_Helper_ActionsService()
    {
        return $this->services['templating.helper.actions'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper($this->get('fragment.handler'));
    }
    protected function getTemplating_Helper_AssetsService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('templating.helper.assets', 'request');
        }
        return $this->services['templating.helper.assets'] = $this->scopedServices['request']['templating.helper.assets'] = new \Symfony\Component\Templating\Helper\CoreAssetsHelper(new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PathPackage($this->get('request'), NULL, '%s?%s'), array());
    }
    protected function getTemplating_Helper_CodeService()
    {
        return $this->services['templating.helper.code'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\CodeHelper(NULL, $this->targetDirs[2], 'UTF-8');
    }
    protected function getTemplating_Helper_FormService()
    {
        return $this->services['templating.helper.form'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper(new \Symfony\Component\Form\FormRenderer(new \Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine($this->get('templating.engine.php'), array(0 => 'FrameworkBundle:Form')), $this->get('form.csrf_provider', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
    }
    protected function getTemplating_Helper_LogoutUrlService()
    {
        $this->services['templating.helper.logout_url'] = $instance = new \Symfony\Bundle\SecurityBundle\Templating\Helper\LogoutUrlHelper($this, $this->get('cmf_routing.router'));
        $instance->registerListener('admin', '/admin/logout', 'logout', '_csrf_token', NULL);
        $instance->registerListener('main', '/logout', 'logout', '_csrf_token', NULL);
        return $instance;
    }
    protected function getTemplating_Helper_RequestService()
    {
        return $this->services['templating.helper.request'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper($this->get('request_stack'));
    }
    protected function getTemplating_Helper_RouterService()
    {
        return $this->services['templating.helper.router'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper($this->get('cmf_routing.router'));
    }
    protected function getTemplating_Helper_SecurityService()
    {
        return $this->services['templating.helper.security'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper($this->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getTemplating_Helper_SessionService()
    {
        return $this->services['templating.helper.session'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\SessionHelper($this->get('request_stack'));
    }
    protected function getTemplating_Helper_SlotsService()
    {
        return $this->services['templating.helper.slots'] = new \Symfony\Component\Templating\Helper\SlotsHelper();
    }
    protected function getTemplating_Helper_StopwatchService()
    {
        return $this->services['templating.helper.stopwatch'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\StopwatchHelper($this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getTemplating_Helper_TranslatorService()
    {
        return $this->services['templating.helper.translator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper($this->get('translator.default'));
    }
    protected function getTemplating_LoaderService()
    {
        return $this->services['templating.loader'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader($this->get('templating.locator'));
    }
    protected function getTemplating_NameParserService()
    {
        return $this->services['templating.name_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser($this->get('kernel'));
    }
    protected function getTranslation_Dumper_CsvService()
    {
        return $this->services['translation.dumper.csv'] = new \Symfony\Component\Translation\Dumper\CsvFileDumper();
    }
    protected function getTranslation_Dumper_IniService()
    {
        return $this->services['translation.dumper.ini'] = new \Symfony\Component\Translation\Dumper\IniFileDumper();
    }
    protected function getTranslation_Dumper_JsonService()
    {
        return $this->services['translation.dumper.json'] = new \Symfony\Component\Translation\Dumper\JsonFileDumper();
    }
    protected function getTranslation_Dumper_MoService()
    {
        return $this->services['translation.dumper.mo'] = new \Symfony\Component\Translation\Dumper\MoFileDumper();
    }
    protected function getTranslation_Dumper_PhpService()
    {
        return $this->services['translation.dumper.php'] = new \Symfony\Component\Translation\Dumper\PhpFileDumper();
    }
    protected function getTranslation_Dumper_PoService()
    {
        return $this->services['translation.dumper.po'] = new \Symfony\Component\Translation\Dumper\PoFileDumper();
    }
    protected function getTranslation_Dumper_QtService()
    {
        return $this->services['translation.dumper.qt'] = new \Symfony\Component\Translation\Dumper\QtFileDumper();
    }
    protected function getTranslation_Dumper_ResService()
    {
        return $this->services['translation.dumper.res'] = new \Symfony\Component\Translation\Dumper\IcuResFileDumper();
    }
    protected function getTranslation_Dumper_XliffService()
    {
        return $this->services['translation.dumper.xliff'] = new \Symfony\Component\Translation\Dumper\XliffFileDumper();
    }
    protected function getTranslation_Dumper_YmlService()
    {
        return $this->services['translation.dumper.yml'] = new \Symfony\Component\Translation\Dumper\YamlFileDumper();
    }
    protected function getTranslation_ExtractorService()
    {
        $this->services['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();
        $instance->addExtractor('php', $this->get('translation.extractor.php'));
        $instance->addExtractor('twig', $this->get('twig.translation.extractor'));
        return $instance;
    }
    protected function getTranslation_Extractor_PhpService()
    {
        return $this->services['translation.extractor.php'] = new \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor();
    }
    protected function getTranslation_LoaderService()
    {
        $a = $this->get('translation.loader.xliff');
        $this->services['translation.loader'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader();
        $instance->addLoader('php', $this->get('translation.loader.php'));
        $instance->addLoader('yml', $this->get('translation.loader.yml'));
        $instance->addLoader('xlf', $a);
        $instance->addLoader('xliff', $a);
        $instance->addLoader('po', $this->get('translation.loader.po'));
        $instance->addLoader('mo', $this->get('translation.loader.mo'));
        $instance->addLoader('ts', $this->get('translation.loader.qt'));
        $instance->addLoader('csv', $this->get('translation.loader.csv'));
        $instance->addLoader('res', $this->get('translation.loader.res'));
        $instance->addLoader('dat', $this->get('translation.loader.dat'));
        $instance->addLoader('ini', $this->get('translation.loader.ini'));
        $instance->addLoader('json', $this->get('translation.loader.json'));
        return $instance;
    }
    protected function getTranslation_Loader_CsvService()
    {
        return $this->services['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader();
    }
    protected function getTranslation_Loader_DatService()
    {
        return $this->services['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuDatFileLoader();
    }
    protected function getTranslation_Loader_IniService()
    {
        return $this->services['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader();
    }
    protected function getTranslation_Loader_JsonService()
    {
        return $this->services['translation.loader.json'] = new \Symfony\Component\Translation\Loader\JsonFileLoader();
    }
    protected function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }
    protected function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }
    protected function getTranslation_Loader_QtService()
    {
        return $this->services['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtFileLoader();
    }
    protected function getTranslation_Loader_ResService()
    {
        return $this->services['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }
    protected function getTranslation_WriterService()
    {
        $this->services['translation.writer'] = $instance = new \Symfony\Component\Translation\Writer\TranslationWriter();
        $instance->addDumper('php', $this->get('translation.dumper.php'));
        $instance->addDumper('xlf', $this->get('translation.dumper.xliff'));
        $instance->addDumper('po', $this->get('translation.dumper.po'));
        $instance->addDumper('mo', $this->get('translation.dumper.mo'));
        $instance->addDumper('yml', $this->get('translation.dumper.yml'));
        $instance->addDumper('ts', $this->get('translation.dumper.qt'));
        $instance->addDumper('csv', $this->get('translation.dumper.csv'));
        $instance->addDumper('ini', $this->get('translation.dumper.ini'));
        $instance->addDumper('json', $this->get('translation.dumper.json'));
        $instance->addDumper('res', $this->get('translation.dumper.res'));
        return $instance;
    }
    protected function getTranslator_DefaultService()
    {
        $this->services['translator.default'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, new \Symfony\Component\Translation\MessageSelector(), array('translation.loader.php' => array(0 => 'php'), 'translation.loader.yml' => array(0 => 'yml'), 'translation.loader.xliff' => array(0 => 'xlf', 1 => 'xliff'), 'translation.loader.po' => array(0 => 'po'), 'translation.loader.mo' => array(0 => 'mo'), 'translation.loader.qt' => array(0 => 'ts'), 'translation.loader.csv' => array(0 => 'csv'), 'translation.loader.res' => array(0 => 'res'), 'translation.loader.dat' => array(0 => 'dat'), 'translation.loader.ini' => array(0 => 'ini'), 'translation.loader.json' => array(0 => 'json')), array('cache_dir' => (__DIR__.'/translations'), 'debug' => false));
        $instance->setFallbackLocales(array(0 => 'en'));
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.id.xlf'), 'id', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.cs.xlf'), 'cs', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.cy.xlf'), 'cy', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.mn.xlf'), 'mn', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.th.xlf'), 'th', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sv.xlf'), 'sv', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Cyrl.xlf'), 'sr_Cyrl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.vi.xlf'), 'vi', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.zh_TW.xlf'), 'zh_TW', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sk.xlf'), 'sk', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt_BR.xlf'), 'pt_BR', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.de.xlf'), 'de', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nl.xlf'), 'nl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.he.xlf'), 'he', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hu.xlf'), 'hu', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fa.xlf'), 'fa', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.en.xlf'), 'en', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ar.xlf'), 'ar', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nb.xlf'), 'nb', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.uk.xlf'), 'uk', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Latn.xlf'), 'sr_Latn', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hr.xlf'), 'hr', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt.xlf'), 'pt', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.gl.xlf'), 'gl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lb.xlf'), 'lb', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ru.xlf'), 'ru', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pl.xlf'), 'pl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.tr.xlf'), 'tr', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.no.xlf'), 'no', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ro.xlf'), 'ro', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lt.xlf'), 'lt', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hy.xlf'), 'hy', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.zh_CN.xlf'), 'zh_CN', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.da.xlf'), 'da', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sl.xlf'), 'sl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.el.xlf'), 'el', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sq.xlf'), 'sq', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ja.xlf'), 'ja', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.et.xlf'), 'et', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.bg.xlf'), 'bg', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ca.xlf'), 'ca', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fi.xlf'), 'fi', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.it.xlf'), 'it', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.es.xlf'), 'es', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fr.xlf'), 'fr', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.af.xlf'), 'af', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.eu.xlf'), 'eu', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.az.xlf'), 'az', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.id.xlf'), 'id', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.cs.xlf'), 'cs', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.mn.xlf'), 'mn', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sv.xlf'), 'sv', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Cyrl.xlf'), 'sr_Cyrl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sk.xlf'), 'sk', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt_BR.xlf'), 'pt_BR', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.de.xlf'), 'de', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nl.xlf'), 'nl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.he.xlf'), 'he', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hu.xlf'), 'hu', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fa.xlf'), 'fa', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.en.xlf'), 'en', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ar.xlf'), 'ar', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nb.xlf'), 'nb', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.uk.xlf'), 'uk', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Latn.xlf'), 'sr_Latn', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hr.xlf'), 'hr', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt.xlf'), 'pt', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.gl.xlf'), 'gl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lb.xlf'), 'lb', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ru.xlf'), 'ru', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pl.xlf'), 'pl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ro.xlf'), 'ro', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lt.xlf'), 'lt', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hy.xlf'), 'hy', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.zh_CN.xlf'), 'zh_CN', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.da.xlf'), 'da', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sl.xlf'), 'sl', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.el.xlf'), 'el', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ja.xlf'), 'ja', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.et.xlf'), 'et', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.bg.xlf'), 'bg', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ca.xlf'), 'ca', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fi.xlf'), 'fi', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.it.xlf'), 'it', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.es.xlf'), 'es', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lv.xlf'), 'lv', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fr.xlf'), 'fr', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.eu.xlf'), 'eu', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.az.xlf'), 'az', 'validators');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.pt_BR.xlf'), 'pt_BR', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.pl.xlf'), 'pl', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.it.xlf'), 'it', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ro.xlf'), 'ro', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.de.xlf'), 'de', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sr_Cyrl.xlf'), 'sr_Cyrl', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.en.xlf'), 'en', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.fa.xlf'), 'fa', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ru.xlf'), 'ru', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.pt_PT.xlf'), 'pt_PT', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.gl.xlf'), 'gl', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sk.xlf'), 'sk', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.hu.xlf'), 'hu', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ua.xlf'), 'ua', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.da.xlf'), 'da', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.cs.xlf'), 'cs', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ar.xlf'), 'ar', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.az.xlf'), 'az', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.es.xlf'), 'es', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.tr.xlf'), 'tr', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sl.xlf'), 'sl', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.ca.xlf'), 'ca', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.nl.xlf'), 'nl', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.no.xlf'), 'no', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.el.xlf'), 'el', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.lb.xlf'), 'lb', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sr_Latn.xlf'), 'sr_Latn', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.he.xlf'), 'he', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.sv.xlf'), 'sv', 'security');
        $instance->addResource('xlf', ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Exception/../Resources/translations/security.fr.xlf'), 'fr', 'security');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.lv.yml'), 'lv', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.lt.yml'), 'lt', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sv.yml'), 'sv', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.cs.yml'), 'cs', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.es.yml'), 'es', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.de.yml'), 'de', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ja.yml'), 'ja', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.da.yml'), 'da', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.en.yml'), 'en', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.ja.yml'), 'ja', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.hu.yml'), 'hu', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.lv.yml'), 'lv', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sk.yml'), 'sk', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.it.yml'), 'it', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.hr.yml'), 'hr', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.lt.yml'), 'lt', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.nl.yml'), 'nl', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sl.yml'), 'sl', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.pl.yml'), 'pl', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.zh_CN.yml'), 'zh_CN', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.pt_BR.yml'), 'pt_BR', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.en.yml'), 'en', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.fi.yml'), 'fi', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.uk.yml'), 'uk', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.pt.yml'), 'pt', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.zh_CN.yml'), 'zh_CN', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.tr.yml'), 'tr', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.lb.yml'), 'lb', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.nl.yml'), 'nl', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.sr_Latn.yml'), 'sr_Latn', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.bg.yml'), 'bg', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.ru.yml'), 'ru', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.fr.yml'), 'fr', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.fa.yml'), 'fa', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ro.yml'), 'ro', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.es.yml'), 'es', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.et.yml'), 'et', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.bg.yml'), 'bg', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.da.yml'), 'da', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sl.yml'), 'sl', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ca.yml'), 'ca', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.pl.yml'), 'pl', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.de.yml'), 'de', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.cs.yml'), 'cs', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.tr.yml'), 'tr', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.uk.yml'), 'uk', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.pt_PT.yml'), 'pt_PT', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.pt_BR.yml'), 'pt_BR', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sv.yml'), 'sv', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.fi.yml'), 'fi', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.fr.yml'), 'fr', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.ru.yml'), 'ru', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.hu.yml'), 'hu', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sr_Latn.yml'), 'sr_Latn', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.hr.yml'), 'hr', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.fa.yml'), 'fa', 'validators');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/FOSUserBundle.it.yml'), 'it', 'FOSUserBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/translations/validators.sk.yml'), 'sk', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.lt.xliff'), 'lt', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.ca.xliff'), 'ca', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.en.xliff'), 'en', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.pt.xliff'), 'pt', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.pl.xliff'), 'pl', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.bg.xliff'), 'bg', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.it.xliff'), 'it', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.zh_TW.xliff'), 'zh_TW', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.cs.xliff'), 'cs', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.fr.xliff'), 'fr', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.ru.xliff'), 'ru', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.nl.xliff'), 'nl', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.sl.xliff'), 'sl', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.es.xliff'), 'es', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.fa.xliff'), 'fa', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.de.xliff'), 'de', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.pt_BR.xliff'), 'pt_BR', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/translations/SonataUserBundle.sk.xliff'), 'sk', 'SonataUserBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.pt_BR.xliff'), 'pt_BR', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.sk.xliff'), 'sk', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.sk.xliff'), 'sk', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.sl.xliff'), 'sl', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.nl.xliff'), 'nl', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.es.xliff'), 'es', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.en.xliff'), 'en', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.de.xliff'), 'de', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.en.xliff'), 'en', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.ja.xliff'), 'ja', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.fr.xliff'), 'fr', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.sl.xliff'), 'sl', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.de.xliff'), 'de', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.fr.xliff'), 'fr', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.bg.xliff'), 'bg', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.ja.xliff'), 'ja', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.es.xliff'), 'es', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/validators.pt_BR.xliff'), 'pt_BR', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/translations/SonataPageBundle.nl.xliff'), 'nl', 'SonataPageBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.en.xliff'), 'en', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.fr.xliff'), 'fr', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.de.xliff'), 'de', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.ru.xliff'), 'ru', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.sl.xliff'), 'sl', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.sk.xliff'), 'sk', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.nl.xliff'), 'nl', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.es.xliff'), 'es', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/translations/SonataNewsBundle.cs.xliff'), 'cs', 'SonataNewsBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.ru.xliff'), 'ru', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.sl.xliff'), 'sl', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.nl.xliff'), 'nl', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.es.xliff'), 'es', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.bg.xliff'), 'bg', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.pt_BR.xliff'), 'pt_BR', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.hu.xliff'), 'hu', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.en.xliff'), 'en', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.lt.xliff'), 'lt', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.pl.xliff'), 'pl', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.fr.xliff'), 'fr', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/translations/SonataMediaBundle.de.xliff'), 'de', 'SonataMediaBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.fa.xliff'), 'fa', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.ar.xliff'), 'ar', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.ru.xliff'), 'ru', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.de.xliff'), 'de', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.nl.xliff'), 'nl', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.en.xliff'), 'en', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.cs.xliff'), 'cs', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.sk.xliff'), 'sk', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.ro.xliff'), 'ro', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.ja.xliff'), 'ja', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.lt.xliff'), 'lt', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.fr.xliff'), 'fr', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.pt.xliff'), 'pt', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.pt_BR.xliff'), 'pt_BR', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.zh_CN.xliff'), 'zh_CN', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.eu.xliff'), 'eu', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.it.xliff'), 'it', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.hu.xliff'), 'hu', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.ca.xliff'), 'ca', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.es.xliff'), 'es', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.uk.xliff'), 'uk', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.sl.xliff'), 'sl', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.hr.xliff'), 'hr', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.lb.xliff'), 'lb', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.bg.xliff'), 'bg', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/translations/SonataAdminBundle.pl.xliff'), 'pl', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[2].'/Resources/SonataAdminBundle/translations/SonataAdminBundle.en.xliff'), 'en', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[2].'/Resources/SonataAdminBundle/translations/SonataAdminBundle.fr.xliff'), 'fr', 'SonataAdminBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/translations/SonataBasketBundle.fr.xliff'), 'fr', 'SonataBasketBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/translations/validators.en.xliff'), 'en', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/translations/validators.fr.xliff'), 'fr', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/translations/SonataBasketBundle.en.xliff'), 'en', 'SonataBasketBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/CustomerBundle/Resources/translations/SonataCustomerBundle.en.xliff'), 'en', 'SonataCustomerBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/CustomerBundle/Resources/translations/SonataCustomerBundle.fr.xliff'), 'fr', 'SonataCustomerBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/DeliveryBundle/Resources/translations/SonataDeliveryBundle.en.xliff'), 'en', 'SonataDeliveryBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/DeliveryBundle/Resources/translations/SonataDeliveryBundle.fr.xliff'), 'fr', 'SonataDeliveryBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/InvoiceBundle/Resources/translations/SonataInvoiceBundle.en.xliff'), 'en', 'SonataInvoiceBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/InvoiceBundle/Resources/translations/SonataInvoiceBundle.fr.xliff'), 'fr', 'SonataInvoiceBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/OrderBundle/Resources/translations/SonataOrderBundle.fr.xliff'), 'fr', 'SonataOrderBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/OrderBundle/Resources/translations/SonataOrderBundle.en.xliff'), 'en', 'SonataOrderBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/PaymentBundle/Resources/translations/SonataPaymentBundle.en.xliff'), 'en', 'SonataPaymentBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/PaymentBundle/Resources/translations/SonataPaymentBundle.fr.xliff'), 'fr', 'SonataPaymentBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/translations/SonataProductBundle.en.xliff'), 'en', 'SonataProductBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/translations/validators.en.xliff'), 'en', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/translations/validators.fr.xliff'), 'fr', 'validators');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/translations/SonataProductBundle.fr.xliff'), 'fr', 'SonataProductBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/src/Application/Sonata/ProductBundle/Resources/translations/SonataProductBundle.en.xliff'), 'en', 'SonataProductBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/src/Application/Sonata/ProductBundle/Resources/translations/SonataProductBundle.fr.xliff'), 'fr', 'SonataProductBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.es.yml'), 'es', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.et.yml'), 'et', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.pl.yml'), 'pl', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.fa_IR.yml'), 'fa_IR', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.mn.yml'), 'mn', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.sl.yml'), 'sl', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.en.yml'), 'en', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.da.yml'), 'da', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.de.yml'), 'de', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.fr.yml'), 'fr', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.bg.yml'), 'bg', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.ru.yml'), 'ru', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.nl.yml'), 'nl', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.zh_CN.yml'), 'zh_CN', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.sr_Latn.yml'), 'sr_Latn', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.pt.yml'), 'pt', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.fi.yml'), 'fi', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.it.yml'), 'it', 'FOSCommentBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/translations/FOSCommentBundle.sr_Cyrl.yml'), 'sr_Cyrl', 'FOSCommentBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/comment-bundle/Resources/translations/SonataCommentBundle.en.xliff'), 'en', 'SonataCommentBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/comment-bundle/Resources/translations/SonataCommentBundle.fr.xliff'), 'fr', 'SonataCommentBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.cs.xliff'), 'cs', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.es.xliff'), 'es', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.lb.xliff'), 'lb', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.nl.xliff'), 'nl', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.zh_CN.xliff'), 'zh_CN', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.lt.xliff'), 'lt', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.ja.xliff'), 'ja', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.ro.xliff'), 'ro', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.pt_BR.xliff'), 'pt_BR', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.ar.xliff'), 'ar', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.ca.xliff'), 'ca', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.eu.xliff'), 'eu', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.hu.xliff'), 'hu', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.uk.xliff'), 'uk', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.sk.xliff'), 'sk', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.de.xliff'), 'de', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.bg.xliff'), 'bg', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.ru.xliff'), 'ru', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.fa.xliff'), 'fa', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.pt.xliff'), 'pt', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.it.xliff'), 'it', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.en.xliff'), 'en', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.pl.xliff'), 'pl', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.hr.xliff'), 'hr', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.fr.xliff'), 'fr', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/translations/SonataCoreBundle.sl.xliff'), 'sl', 'SonataCoreBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.sk.xliff'), 'sk', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.pl.xliff'), 'pl', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.fr.xliff'), 'fr', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.sl.xliff'), 'sl', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.cs.xliff'), 'cs', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.de.xliff'), 'de', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.ru.xliff'), 'ru', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/translations/SonataFormatterBundle.en.xliff'), 'en', 'SonataFormatterBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/seo-bundle/Resources/translations/SonataSeoBundle.nl.xliff'), 'nl', 'SonataSeoBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/seo-bundle/Resources/translations/SonataSeoBundle.en.xliff'), 'en', 'SonataSeoBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/seo-bundle/Resources/translations/SonataSeoBundle.fr.xliff'), 'fr', 'SonataSeoBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/classification-bundle/Resources/translations/SonataClassificationBundle.nl.xliff'), 'nl', 'SonataClassificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/classification-bundle/Resources/translations/SonataClassificationBundle.en.xliff'), 'en', 'SonataClassificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/classification-bundle/Resources/translations/SonataClassificationBundle.fr.xliff'), 'fr', 'SonataClassificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.cs.xliff'), 'cs', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.nl.xliff'), 'nl', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.en.xliff'), 'en', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.es.xliff'), 'es', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.sl.xliff'), 'sl', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.sk.xliff'), 'sk', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.de.xliff'), 'de', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/notification-bundle/Resources/translations/SonataNotificationBundle.fr.xliff'), 'fr', 'SonataNotificationBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.cs.xliff'), 'cs', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.es.xliff'), 'es', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.hu.xliff'), 'hu', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.sl.xliff'), 'sl', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.ru.xliff'), 'ru', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.pt_BR.xliff'), 'pt_BR', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.sk.xliff'), 'sk', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.it.xliff'), 'it', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.fa.xliff'), 'fa', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.de.xliff'), 'de', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.hr.xliff'), 'hr', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.lb.xliff'), 'lb', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.bg.xliff'), 'bg', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.eu.xliff'), 'eu', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.pt.xliff'), 'pt', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.ro.xliff'), 'ro', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.fr.xliff'), 'fr', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.uk.xliff'), 'uk', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.lt.xliff'), 'lt', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.en.xliff'), 'en', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.nl.xliff'), 'nl', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.ja.xliff'), 'ja', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.pl.xliff'), 'pl', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.zh_CN.xliff'), 'zh_CN', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/translations/SonataDatagridBundle.ca.xliff'), 'ca', 'SonataDatagridBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/translations/CmfRoutingBundle.pl.xliff'), 'pl', 'CmfRoutingBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/translations/CmfRoutingBundle.nl.xliff'), 'nl', 'CmfRoutingBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/translations/CmfRoutingBundle.fr.xliff'), 'fr', 'CmfRoutingBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/translations/CmfRoutingBundle.it.xliff'), 'it', 'CmfRoutingBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/translations/CmfRoutingBundle.de.xliff'), 'de', 'CmfRoutingBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/translations/CmfRoutingBundle.en.xliff'), 'en', 'CmfRoutingBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/src/Sonata/Bundle/DemoBundle/Resources/translations/SonataDemoBundle.fr.xliff'), 'fr', 'SonataDemoBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/src/Sonata/Bundle/DemoBundle/Resources/translations/SonataDemoBundle.en.xliff'), 'en', 'SonataDemoBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.de.xliff'), 'de', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.sk.xliff'), 'sk', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.es.xliff'), 'es', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.fr.xliff'), 'fr', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.pt_BR.xliff'), 'pt_BR', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.cs.xliff'), 'cs', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.nl.xliff'), 'nl', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.sl.xliff'), 'sl', 'SonataTimelineBundle');
        $instance->addResource('xliff', ($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/translations/SonataTimelineBundle.en.xliff'), 'en', 'SonataTimelineBundle');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.es.yml'), 'es', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.sk.yml'), 'sk', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.sl.yml'), 'sl', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.pl.yml'), 'pl', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.en.yml'), 'en', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.uk.yml'), 'uk', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.ru.yml'), 'ru', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.nl.yml'), 'nl', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.fr.yml'), 'fr', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.de.yml'), 'de', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.it.yml'), 'it', 'pagination');
        $instance->addResource('yml', ($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/translations/pagination.pt.yml'), 'pt', 'pagination');
        return $instance;
    }
    protected function getTranslatorListenerService()
    {
        return $this->services['translator_listener'] = new \Symfony\Component\HttpKernel\EventListener\TranslatorListener($this->get('translator.default'), $this->get('request_stack'));
    }
    protected function getTwigService()
    {
        $a = $this->get('cmf_routing.router');
        $b = $this->get('fragment.handler');
        $c = $this->get('markdown.parser');
        $d = $this->get('sonata.block.templating.helper');
        $e = new \Symfony\Bridge\Twig\Extension\HttpKernelExtension($b);
        $f = new \Knp\Bundle\MarkdownBundle\Helper\MarkdownHelper($c);
        $f->addParser(new \Knp\Bundle\MarkdownBundle\Parser\Preset\Min(), 'min');
        $f->addParser(new \Knp\Bundle\MarkdownBundle\Parser\Preset\Light(), 'light');
        $f->addParser(new \Knp\Bundle\MarkdownBundle\Parser\Preset\Medium(), 'medium');
        $f->addParser($c, 'default');
        $f->addParser(new \Knp\Bundle\MarkdownBundle\Parser\Preset\Flavored(), 'flavored');
        $this->services['twig'] = $instance = new \Twig_Environment($this->get('twig.loader'), array('debug' => false, 'strict_variables' => false, 'base_template_class' => 'Sonata\\CacheBundle\\Twig\\TwigTemplate14', 'exception_controller' => 'FOS\\RestBundle\\Controller\\ExceptionController::showAction', 'form_themes' => array(0 => 'form_div_layout.html.twig', 1 => 'SonataFormatterBundle:Form:formatter.html.twig', 2 => 'SonataMediaBundle:Form:media_widgets.html.twig', 3 => 'SonataCoreBundle:Form:datepicker.html.twig'), 'autoescape' => array(0 => 'Symfony\\Bundle\\TwigBundle\\TwigDefaultEscapingStrategy', 1 => 'guess'), 'cache' => (__DIR__.'/twig'), 'charset' => 'UTF-8', 'paths' => array()));
        $instance->addExtension(new \Symfony\Bundle\SecurityBundle\Twig\Extension\LogoutUrlExtension($this->get('templating.helper.logout_url')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\SecurityExtension($this->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($this->get('translator.default')));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\AssetsExtension($this, $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\ActionsExtension($this));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CodeExtension(NULL, $this->targetDirs[2], 'UTF-8'));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\RoutingExtension($a));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\YamlExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\StopwatchExtension($this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE), false));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\ExpressionExtension());
        $instance->addExtension($e);
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\FormExtension(new \Symfony\Bridge\Twig\Form\TwigRenderer(new \Symfony\Bridge\Twig\Form\TwigRendererEngine(array(0 => 'IvoryCKEditorBundle:Form:ckeditor_widget.html.twig', 1 => 'form_div_layout.html.twig', 2 => 'MopaBootstrapBundle:Form:fields.html.twig', 3 => 'SonataFormatterBundle:Form:formatter.html.twig', 4 => 'SonataMediaBundle:Form:media_widgets.html.twig', 5 => 'SonataCoreBundle:Form:datepicker.html.twig', 6 => 'SonataUserBundle:Form:form_admin_fields.html.twig')), $this->get('form.csrf_provider', ContainerInterface::NULL_ON_INVALID_REFERENCE))));
        $instance->addExtension(new \Symfony\Bundle\AsseticBundle\Twig\AsseticExtension($this->get('assetic.asset_factory'), $this->get('templating.name_parser'), false, array(), array(), new \Symfony\Bundle\AsseticBundle\DefaultValueSupplier($this)));
        $instance->addExtension(new \Doctrine\Bundle\DoctrineBundle\Twig\DoctrineExtension());
        $instance->addExtension(new \Knp\Menu\Twig\MenuExtension(new \Knp\Menu\Twig\Helper($this->get('knp_menu.renderer_provider'), $this->get('knp_menu.menu_provider'))));
        $instance->addExtension(new \Knp\Bundle\MarkdownBundle\Twig\Extension\MarkdownTwigExtension($f));
        $instance->addExtension($this->get('knp_paginator.twig.extension.pagination'));
        $instance->addExtension(new \Sonata\PageBundle\Twig\Extension\PageExtension($this->get('sonata.page.cms_manager_selector'), $this->get('sonata.page.site.selector.host_with_path'), $a, $d, $e));
        $instance->addExtension(new \Sonata\NewsBundle\Twig\Extension\NewsExtension($a, $this->get('sonata.classification.manager.tag'), $this->get('sonata.news.blog')));
        $instance->addExtension($this->get('sonata.media.twig.extension'));
        $instance->addExtension($this->get('ivory_ck_editor.twig_extension'));
        $instance->addExtension($this->get('sonata.admin.twig.extension'));
        $instance->addExtension($this->get('nelmio_api_doc.twig.extension.extra_markdown'));
        $instance->addExtension(new \Sonata\CustomerBundle\Twig\Extension\AddressExtension($this->get('sonata.delivery.selector.default')));
        $instance->addExtension(new \Sonata\ProductBundle\Twig\Extension\ProductExtension($this->get('sonata.product.pool'), $this->get('form.factory'), 'Application\\Sonata\\BasketBundle\\Entity\\BasketElement'));
        $instance->addExtension(new \JMS\Serializer\Twig\SerializerExtension($this->get('jms_serializer')));
        $instance->addExtension(new \FOS\CommentBundle\Twig\CommentExtension(NULL, NULL, NULL));
        $instance->addExtension($this->get('sonata.core.flashmessage.twig.extension'));
        $instance->addExtension($this->get('sonata.core.twig.extension.wrapping'));
        $instance->addExtension($this->get('sonata.core.twig.extension.text'));
        $instance->addExtension($this->get('sonata.core.twig.status_extension'));
        $instance->addExtension($this->get('sonata.core.twig.template_extension'));
        $instance->addExtension(new \Sonata\IntlBundle\Twig\Extension\LocaleExtension($this->get('sonata.intl.templating.helper.locale')));
        $instance->addExtension(new \Sonata\IntlBundle\Twig\Extension\NumberExtension($this->get('sonata.intl.templating.helper.number')));
        $instance->addExtension(new \Sonata\IntlBundle\Twig\Extension\DateTimeExtension($this->get('sonata.intl.templating.helper.datetime')));
        $instance->addExtension(new \Sonata\FormatterBundle\Twig\Extension\TextFormatterExtension($this->get('sonata.formatter.pool')));
        $instance->addExtension(new \Sonata\BlockBundle\Twig\Extension\BlockExtension($d));
        $instance->addExtension(new \Sonata\SeoBundle\Twig\Extension\SeoExtension($this->get('sonata.seo.page.default'), 'UTF-8'));
        $instance->addExtension($this->get('spy_timeline.twig.extension.timeline'));
        $instance->addExtension($this->get('sonata.timeline.twig.extension'));
        $instance->addExtension($this->get('mopa_bootstrap.twig.extension.bootstrap_form'));
        $instance->addExtension($this->get('mopa_bootstrap.twig.extension.bootstrap_icon'));
        $instance->addExtension(new \Symfony\Bundle\WebProfilerBundle\Twig\WebProfilerExtension());
        $instance->addGlobal('app', $this->get('templating.globals'));
        $instance->addGlobal('sonata_user', $this->get('sonata.user.twig.global'));
        $instance->addGlobal('sonata_page', $this->get('sonata.page.twig.global'));
        $instance->addGlobal('sonata_media', $this->get('sonata.media.twig.global'));
        $instance->addGlobal('sonata_basket', $this->get('sonata.basket.twig.global'));
        $instance->addGlobal('sonata_block', $this->get('sonata.block.twig.global'));
        return $instance;
    }
    protected function getTwig_Controller_ExceptionService()
    {
        return $this->services['twig.controller.exception'] = new \Symfony\Bundle\TwigBundle\Controller\ExceptionController($this->get('twig'), false);
    }
    protected function getTwig_Controller_PreviewErrorService()
    {
        return $this->services['twig.controller.preview_error'] = new \Symfony\Bundle\TwigBundle\Controller\PreviewErrorController($this->get('http_kernel'), 'FOS\\RestBundle\\Controller\\ExceptionController::showAction');
    }
    protected function getTwig_LoaderService()
    {
        $this->services['twig.loader'] = $instance = new \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader($this->get('templating.locator'), $this->get('templating.name_parser'));
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/views'), 'Framework');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/SecurityBundle/Resources/views'), 'Security');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views'), 'Twig');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/swiftmailer-bundle/Resources/views'), 'Swiftmailer');
        $instance->addPath(($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Resources/views'), 'Doctrine');
        $instance->addPath(($this->targetDirs[3].'/vendor/knplabs/knp-paginator-bundle/Knp/Bundle/PaginatorBundle/Resources/views'), 'KnpPaginator');
        $instance->addPath(($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/views'), 'FOSUser');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/user-bundle/Resources/views'), 'SonataUser');
        $instance->addPath(($this->targetDirs[3].'/src/Application/Sonata/UserBundle/Resources/views'), 'ApplicationSonataUser');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/views'), 'SonataPage');
        $instance->addPath(($this->targetDirs[3].'/src/Application/Sonata/PageBundle/Resources/views'), 'ApplicationSonataPage');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/views'), 'SonataNews');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/views'), 'SonataMedia');
        $instance->addPath(($this->targetDirs[3].'/vendor/egeloen/ckeditor-bundle/Resources/views'), 'IvoryCKEditor');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/Resources/views'), 'SonataAdmin');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/doctrine-orm-admin-bundle/Resources/views'), 'SonataDoctrineORMAdmin');
        $instance->addPath(($this->targetDirs[3].'/vendor/simplethings/entity-audit-bundle/src/SimpleThings/EntityAudit/Resources/views'), 'SimpleThingsEntityAudit');
        $instance->addPath(($this->targetDirs[3].'/vendor/nelmio/api-doc-bundle/Nelmio/ApiDocBundle/Resources/views'), 'NelmioApiDoc');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/views'), 'SonataBasket');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/CustomerBundle/Resources/views'), 'SonataCustomer');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/InvoiceBundle/Resources/views'), 'SonataInvoice');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/OrderBundle/Resources/views'), 'SonataOrder');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/PaymentBundle/Resources/views'), 'SonataPayment');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/views'), 'SonataProduct');
        $instance->addPath(($this->targetDirs[3].'/src/Application/Sonata/ProductBundle/Resources/views'), 'ApplicationSonataProduct');
        $instance->addPath(($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/views'), 'FOSComment');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/comment-bundle/Resources/views'), 'SonataComment');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/core-bundle/Resources/views'), 'SonataCore');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/intl-bundle/Resources/views'), 'SonataIntl');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/formatter-bundle/Resources/views'), 'SonataFormatter');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/block-bundle/Resources/views'), 'SonataBlock');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/seo-bundle/Resources/views'), 'SonataSeo');
        $instance->addPath(($this->targetDirs[3].'/src/Application/Sonata/SeoBundle/Resources/views'), 'ApplicationSonataSeo');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/datagrid-bundle/Resources/views'), 'SonataDatagrid');
        $instance->addPath(($this->targetDirs[3].'/src/Sonata/Bundle/DemoBundle/Resources/views'), 'SonataDemo');
        $instance->addPath(($this->targetDirs[3].'/src/Sonata/Bundle/QABundle/Resources/views'), 'SonataQA');
        $instance->addPath(($this->targetDirs[3].'/vendor/stephpy/timeline-bundle/Resources/views'), 'SpyTimeline');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/timeline-bundle/Resources/views'), 'SonataTimeline');
        $instance->addPath(($this->targetDirs[3].'/vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/views'), 'MopaBootstrap');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views'), 'WebProfiler');
        $instance->addPath(($this->targetDirs[2].'/Resources/views'));
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/views/Form'));
        $instance->addPath(($this->targetDirs[3].'/vendor/knplabs/knp-menu/src/Knp/Menu/Resources/views'));
        return $instance;
    }
    protected function getTwig_Translation_ExtractorService()
    {
        return $this->services['twig.translation.extractor'] = new \Symfony\Bridge\Twig\Translation\TwigExtractor($this->get('twig'));
    }
    protected function getUriSignerService()
    {
        return $this->services['uri_signer'] = new \Symfony\Component\HttpKernel\UriSigner('ThisTokenIsNotSoSecretChangeIt');
    }
    protected function getValidatorService()
    {
        return $this->services['validator'] = $this->get('validator.builder')->getValidator();
    }
    protected function getValidator_BuilderService()
    {
        $this->services['validator.builder'] = $instance = \Symfony\Component\Validator\Validation::createValidatorBuilder();
        $instance->setConstraintValidatorFactory($this->get('validator.validator_factory'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setTranslationDomain('validators');
        $instance->addXmlMappings(array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml'), 1 => ($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/Resources/config/validation.xml'), 2 => ($this->targetDirs[3].'/vendor/sonata-project/page-bundle/Resources/config/validation.xml'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/news-bundle/Resources/config/validation.xml'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/media-bundle/Resources/config/validation.xml'), 5 => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/BasketBundle/Resources/config/validation.xml'), 6 => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/CustomerBundle/Resources/config/validation.xml'), 7 => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/InvoiceBundle/Resources/config/validation.xml'), 8 => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/OrderBundle/Resources/config/validation.xml'), 9 => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/PaymentBundle/Resources/config/validation.xml'), 10 => ($this->targetDirs[3].'/vendor/sonata-project/ecommerce/src/ProductBundle/Resources/config/validation.xml'), 11 => ($this->targetDirs[3].'/vendor/friendsofsymfony/comment-bundle/FOS/CommentBundle/Resources/config/validation.xml'), 12 => ($this->targetDirs[3].'/vendor/sonata-project/classification-bundle/Resources/config/validation.xml'), 13 => ($this->targetDirs[3].'/vendor/symfony-cmf/routing-bundle/Resources/config/validation.xml'), 14 => ($this->targetDirs[3].'/src/Sonata/Bundle/DemoBundle/Resources/config/validation.xml')));
        $instance->enableAnnotationMapping($this->get('annotation_reader'));
        $instance->addMethodMapping('loadValidatorMetadata');
        $instance->setApiVersion(3);
        $instance->addObjectInitializers(array(0 => $this->get('doctrine.orm.validator_initializer'), 1 => new \FOS\UserBundle\Validator\Initializer($this->get('fos_user.user_manager'))));
        $instance->addXmlMapping(($this->targetDirs[3].'/vendor/friendsofsymfony/user-bundle/FOS/UserBundle/DependencyInjection/Compiler/../../Resources/config/validation/orm.xml'));
        return $instance;
    }
    protected function getValidator_EmailService()
    {
        return $this->services['validator.email'] = new \Symfony\Component\Validator\Constraints\EmailValidator(false);
    }
    protected function getValidator_ExpressionService()
    {
        return $this->services['validator.expression'] = new \Symfony\Component\Validator\Constraints\ExpressionValidator($this->get('property_accessor'));
    }
    protected function getWebProfiler_Controller_ExceptionService()
    {
        return $this->services['web_profiler.controller.exception'] = new \Symfony\Bundle\WebProfilerBundle\Controller\ExceptionController($this->get('profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('twig'), false);
    }
    protected function getWebProfiler_Controller_ProfilerService()
    {
        return $this->services['web_profiler.controller.profiler'] = new \Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController($this->get('cmf_routing.router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('twig'), array('data_collector.config' => array(0 => 'config', 1 => '@WebProfiler/Collector/config.html.twig'), 'data_collector.request' => array(0 => 'request', 1 => '@WebProfiler/Collector/request.html.twig'), 'data_collector.ajax' => array(0 => 'ajax', 1 => '@WebProfiler/Collector/ajax.html.twig'), 'data_collector.exception' => array(0 => 'exception', 1 => '@WebProfiler/Collector/exception.html.twig'), 'data_collector.events' => array(0 => 'events', 1 => '@WebProfiler/Collector/events.html.twig'), 'data_collector.logger' => array(0 => 'logger', 1 => '@WebProfiler/Collector/logger.html.twig'), 'data_collector.time' => array(0 => 'time', 1 => '@WebProfiler/Collector/time.html.twig'), 'data_collector.memory' => array(0 => 'memory', 1 => '@WebProfiler/Collector/memory.html.twig'), 'data_collector.router' => array(0 => 'router', 1 => '@WebProfiler/Collector/router.html.twig'), 'data_collector.form' => array(0 => 'form', 1 => '@WebProfiler/Collector/form.html.twig'), 'data_collector.security' => array(0 => 'security', 1 => '@Security/Collector/security.html.twig'), 'swiftmailer.data_collector' => array(0 => 'swiftmailer', 1 => '@Swiftmailer/Collector/swiftmailer.html.twig'), 'data_collector.doctrine' => array(0 => 'db', 1 => '@Doctrine/Collector/db.html.twig'), 'sonata.block.data_collector' => array(0 => 'block', 1 => 'SonataBlockBundle:Profiler:block.html.twig')), 'bottom');
    }
    protected function getWebProfiler_Controller_RouterService()
    {
        return $this->services['web_profiler.controller.router'] = new \Symfony\Bundle\WebProfilerBundle\Controller\RouterController($this->get('profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('twig'), $this->get('cmf_routing.router', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getWebProfiler_DebugToolbarService()
    {
        return $this->services['web_profiler.debug_toolbar'] = new \Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener($this->get('twig'), false, 2, 'bottom', $this->get('cmf_routing.router', ContainerInterface::NULL_ON_INVALID_REFERENCE), '^/bundles|^/_wdt');
    }
    protected function getAssetic_AssetFactoryService()
    {
        return $this->services['assetic.asset_factory'] = new \Symfony\Bundle\AsseticBundle\Factory\AssetFactory($this->get('kernel'), $this, $this->getParameterBag(), ($this->targetDirs[2].'/../web'), false);
    }
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }
    protected function getFosComment_EntityManagerService()
    {
        return $this->services['fos_comment.entity_manager'] = $this->get('doctrine')->getManager(NULL);
    }
    protected function getFosUser_EntityManagerService()
    {
        return $this->services['fos_user.entity_manager'] = $this->get('doctrine')->getManager(NULL);
    }
    protected function getJmsSerializer_MetadataFactoryService()
    {
        $this->services['jms_serializer.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \Metadata\Driver\LazyLoadingDriver($this, 'jms_serializer.metadata_driver'), 'Metadata\\ClassHierarchyMetadata', false);
        $instance->setCache(new \Metadata\Cache\FileCache((__DIR__.'/jms_serializer')));
        return $instance;
    }
    protected function getJmsSerializer_UnserializeObjectConstructorService()
    {
        return $this->services['jms_serializer.unserialize_object_constructor'] = new \JMS\Serializer\Construction\UnserializeObjectConstructor();
    }
    protected function getRouter_DefaultService()
    {
        return $this->services['router.default'] = new \Symfony\Bundle\FrameworkBundle\Routing\Router($this, ($this->targetDirs[2].'/config/routing_dev.yml'), array('cache_dir' => __DIR__, 'debug' => false, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'appDevUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'appDevUrlMatcher', 'strict_requirements' => NULL), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('monolog.logger.router', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_AccessListenerService()
    {
        return $this->services['security.access_listener'] = new \Symfony\Component\Security\Http\Firewall\AccessListener($this->get('security.context'), $this->get('security.access.decision_manager'), $this->get('security.access_map'), $this->get('security.authentication.manager'));
    }
    protected function getSecurity_AccessMapService()
    {
        $this->services['security.access_map'] = $instance = new \Symfony\Component\Security\Http\AccessMap();
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/login$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/register'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/resetting'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/login$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/logout$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/login-check$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/'), array(0 => 'ROLE_ADMIN', 1 => 'ROLE_SONATA_ADMIN'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/profile/'), array(0 => 'IS_AUTHENTICATED_FULLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/shop/basket/step/'), array(0 => 'IS_AUTHENTICATED_FULLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/shop/user/'), array(0 => 'IS_AUTHENTICATED_FULLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/.*'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        return $instance;
    }
    protected function getSecurity_Acl_ObjectIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.object_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy();
    }
    protected function getSecurity_Acl_Permission_MapService()
    {
        return $this->services['security.acl.permission.map'] = new \Sonata\AdminBundle\Security\Acl\Permission\AdminPermissionMap();
    }
    protected function getSecurity_Acl_SecurityIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.security_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\SecurityIdentityRetrievalStrategy($this->get('security.role_hierarchy'), $this->get('security.authentication.trust_resolver'));
    }
    protected function getSecurity_Authentication_ManagerService()
    {
        $a = $this->get('fos_user.user_manager');
        $b = $this->get('security.user_checker');
        $c = $this->get('security.encoder_factory');
        $this->services['security.authentication.manager'] = $instance = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(array(0 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($a, $b, 'admin', $c, true), 1 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('58b3fe9ce3baa'), 2 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($this->get('security.user.provider.concrete.in_memory'), $b, 'api', $c, true), 3 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($a, $b, 'main', $c, true), 4 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('58b3fe9ce3baa')), true);
        $instance->setEventDispatcher($this->get('event_dispatcher'));
        return $instance;
    }
    protected function getSecurity_Authentication_SessionStrategyService()
    {
        return $this->services['security.authentication.session_strategy'] = new \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy('migrate');
    }
    protected function getSecurity_Authentication_TrustResolverService()
    {
        return $this->services['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken');
    }
    protected function getSecurity_ChannelListenerService()
    {
        return $this->services['security.channel_listener'] = new \Symfony\Component\Security\Http\Firewall\ChannelListener($this->get('security.access_map'), new \Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint(80, 443), $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_ContextListener_0Service()
    {
        return $this->services['security.context_listener.0'] = new \Symfony\Component\Security\Http\Firewall\ContextListener($this->get('security.context'), array(0 => $this->get('fos_user.user_manager'), 1 => $this->get('security.user.provider.concrete.in_memory')), 'user', $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
    protected function getSecurity_Extra_MetadataFactoryService()
    {
        $this->services['security.extra.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \Metadata\Driver\LazyLoadingDriver($this, 'security.extra.metadata_driver'), new \Metadata\Cache\FileCache((__DIR__.'/jms_security'), false));
        $instance->setIncludeInterfaces(true);
        return $instance;
    }
    protected function getSecurity_HttpUtilsService()
    {
        $a = $this->get('cmf_routing.router', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        return $this->services['security.http_utils'] = new \Symfony\Component\Security\Http\HttpUtils($a, $a);
    }
    protected function getSecurity_User_Provider_Concrete_InMemoryService()
    {
        $this->services['security.user.provider.concrete.in_memory'] = $instance = new \Symfony\Component\Security\Core\User\InMemoryUserProvider();
        $instance->createUser(new \Symfony\Component\Security\Core\User\User('admin', 'admin', array(0 => 'ROLE_ADMIN')));
        return $instance;
    }
    protected function getSecurity_UserCheckerService()
    {
        return $this->services['security.user_checker'] = new \Symfony\Component\Security\Core\User\UserChecker();
    }
    protected function getSession_Storage_MetadataBagService()
    {
        return $this->services['session.storage.metadata_bag'] = new \Symfony\Component\HttpFoundation\Session\Storage\MetadataBag('_sf2_meta', '0');
    }
    protected function getSonata_Block_ManagerService()
    {
        $this->services['sonata.block.manager'] = $instance = new \Sonata\BlockBundle\Block\BlockServiceManager($this, false, $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
        $instance->add('sonata.user.block.menu', 'sonata.user.block.menu', array(0 => 'user'));
        $instance->add('sonata.user.block.account', 'sonata.user.block.account', array(0 => 'user'));
        $instance->add('sonata.user.block.breadcrumb_index', 'sonata.user.block.breadcrumb_index', array());
        $instance->add('sonata.user.block.breadcrumb_profile', 'sonata.user.block.breadcrumb_profile', array());
        $instance->add('sonata.page.block.container', 'sonata.page.block.container', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.page.block.children_pages', 'sonata.page.block.children_pages', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.page.block.breadcrumb', 'sonata.page.block.breadcrumb', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.page.block.shared_block', 'sonata.page.block.shared_block', array());
        $instance->add('sonata.news.block.recent_posts', 'sonata.news.block.recent_posts', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.news.block.recent_comments', 'sonata.news.block.recent_comments', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.news.block.breadcrumb_archive', 'sonata.news.block.breadcrumb_archive', array());
        $instance->add('sonata.news.block.breadcrumb_post', 'sonata.news.block.breadcrumb_post', array());
        $instance->add('sonata.media.block.media', 'sonata.media.block.media', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.media.block.feature_media', 'sonata.media.block.feature_media', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.media.block.gallery', 'sonata.media.block.gallery', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.media.block.breadcrumb_view', 'sonata.media.block.breadcrumb_view', array());
        $instance->add('sonata.media.block.breadcrumb_index', 'sonata.media.block.breadcrumb_index', array());
        $instance->add('sonata.media.block.breadcrumb_view_media', 'sonata.media.block.breadcrumb_view_media', array());
        $instance->add('sonata.admin.block.admin_list', 'sonata.admin.block.admin_list', array(0 => 'admin'));
        $instance->add('sonata.admin.block.search_result', 'sonata.admin.block.search_result', array(0 => 'admin'));
        $instance->add('sonata.admin_doctrine_orm.block.audit', 'sonata.admin_doctrine_orm.block.audit', array());
        $instance->add('sonata.basket.block.nb_items', 'sonata.basket.block.nb_items', array(0 => 'user'));
        $instance->add('sonata.customer.block.recent_customers', 'sonata.customer.block.recent_customers', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.customer.block.breadcrumb_address', 'sonata.customer.block.breadcrumb_address', array());
        $instance->add('sonata.order.block.recent_orders', 'sonata.order.block.recent_orders', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.order.block.breadcrumb_order', 'sonata.order.block.breadcrumb_order', array());
        $instance->add('sonata.product.block.breadcrumb', 'sonata.product.block.breadcrumb', array());
        $instance->add('sonata.product.block.recent_products', 'sonata.product.block.recent_products', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.product.block.similar_products', 'sonata.product.block.similar_products', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.product.block.categories_menu', 'sonata.product.block.categories_menu', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.product.block.filters_menu', 'sonata.product.block.filters_menu', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.product.block.variations_form', 'sonata.product.block.variations_form', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.comment.block.thread.async', 'sonata.comment.block.thread.async', array());
        $instance->add('sonata.formatter.block.formatter', 'sonata.formatter.block.formatter', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.block.service.container', 'sonata.block.service.container', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.block.service.empty', 'sonata.block.service.empty', array());
        $instance->add('sonata.block.service.text', 'sonata.block.service.text', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.block.service.rss', 'sonata.block.service.rss', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.block.service.menu', 'sonata.block.service.menu', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.block.service.template', 'sonata.block.service.template', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.email.share_button', 'sonata.seo.block.email.share_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.facebook.like_box', 'sonata.seo.block.facebook.like_box', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.facebook.like_button', 'sonata.seo.block.facebook.like_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.facebook.send_button', 'sonata.seo.block.facebook.send_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.facebook.share_button', 'sonata.seo.block.facebook.share_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.twitter.share_button', 'sonata.seo.block.twitter.share_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.twitter.follow_button', 'sonata.seo.block.twitter.follow_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.twitter.hashtag_button', 'sonata.seo.block.twitter.hashtag_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.twitter.mention_button', 'sonata.seo.block.twitter.mention_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.twitter.embed', 'sonata.seo.block.twitter.embed', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.pinterest.pin_button', 'sonata.seo.block.pinterest.pin_button', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.seo.block.breadcrumb.homepage', 'sonata.seo.block.breadcrumb.homepage', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.demo.block.newsletter', 'sonata.demo.block.newsletter', array(0 => 'sonata_page_bundle'));
        $instance->add('sonata.timeline.block.timeline', 'sonata.timeline.block.timeline', array(0 => 'admin'));
        return $instance;
    }
    protected function getSonata_Formatter_Twig_Env_MarkdownService()
    {
        $this->services['sonata.formatter.twig.env.markdown'] = $instance = new \Twig_Environment(new \Sonata\FormatterBundle\Twig\Loader\LoaderSelector(new \Twig_Loader_String(), $this->get('twig.loader')), array('debug' => false, 'strict_variables' => false, 'charset' => 'UTF-8'));
        $instance->addExtension(new \Twig_Extension_Sandbox(new \Sonata\FormatterBundle\Twig\SecurityPolicyContainerAware($this, array(0 => 'sonata.formatter.twig.control_flow', 1 => 'sonata.formatter.twig.gist', 2 => 'sonata.media.formatter.twig')), true));
        $instance->addExtension($this->get('sonata.formatter.twig.control_flow'));
        $instance->addExtension($this->get('sonata.formatter.twig.gist'));
        $instance->addExtension($this->get('sonata.media.formatter.twig'));
        $instance->setLexer(new \Twig_Lexer($instance, array('tag_comment' => array(0 => '<#', 1 => '#>'), 'tag_block' => array(0 => '<%', 1 => '%>'), 'tag_variable' => array(0 => '<%=', 1 => '%>'))));
        return $instance;
    }
    protected function getSonata_Formatter_Twig_Env_RawhtmlService()
    {
        $this->services['sonata.formatter.twig.env.rawhtml'] = $instance = new \Twig_Environment(new \Sonata\FormatterBundle\Twig\Loader\LoaderSelector(new \Twig_Loader_String(), $this->get('twig.loader')), array('debug' => false, 'strict_variables' => false, 'charset' => 'UTF-8'));
        $instance->addExtension(new \Twig_Extension_Sandbox(new \Sonata\FormatterBundle\Twig\SecurityPolicyContainerAware($this, array(0 => 'sonata.formatter.twig.control_flow', 1 => 'sonata.formatter.twig.gist', 2 => 'sonata.media.formatter.twig')), true));
        $instance->addExtension($this->get('sonata.formatter.twig.control_flow'));
        $instance->addExtension($this->get('sonata.formatter.twig.gist'));
        $instance->addExtension($this->get('sonata.media.formatter.twig'));
        $instance->setLexer(new \Twig_Lexer($instance, array('tag_comment' => array(0 => '<#', 1 => '#>'), 'tag_block' => array(0 => '<%', 1 => '%>'), 'tag_variable' => array(0 => '<%=', 1 => '%>'))));
        return $instance;
    }
    protected function getSonata_Formatter_Twig_Env_RichhtmlService()
    {
        $this->services['sonata.formatter.twig.env.richhtml'] = $instance = new \Twig_Environment(new \Sonata\FormatterBundle\Twig\Loader\LoaderSelector(new \Twig_Loader_String(), $this->get('twig.loader')), array('debug' => false, 'strict_variables' => false, 'charset' => 'UTF-8'));
        $instance->addExtension(new \Twig_Extension_Sandbox(new \Sonata\FormatterBundle\Twig\SecurityPolicyContainerAware($this, array(0 => 'sonata.formatter.twig.control_flow', 1 => 'sonata.formatter.twig.gist', 2 => 'sonata.media.formatter.twig')), true));
        $instance->addExtension($this->get('sonata.formatter.twig.control_flow'));
        $instance->addExtension($this->get('sonata.formatter.twig.gist'));
        $instance->addExtension($this->get('sonata.media.formatter.twig'));
        $instance->setLexer(new \Twig_Lexer($instance, array('tag_comment' => array(0 => '<#', 1 => '#>'), 'tag_block' => array(0 => '<%', 1 => '%>'), 'tag_variable' => array(0 => '<%=', 1 => '%>'))));
        return $instance;
    }
    protected function getSonata_Formatter_Twig_Env_TextService()
    {
        $this->services['sonata.formatter.twig.env.text'] = $instance = new \Twig_Environment(new \Sonata\FormatterBundle\Twig\Loader\LoaderSelector(new \Twig_Loader_String(), $this->get('twig.loader')), array('debug' => false, 'strict_variables' => false, 'charset' => 'UTF-8'));
        $instance->addExtension(new \Twig_Extension_Sandbox(new \Sonata\FormatterBundle\Twig\SecurityPolicyContainerAware($this, array(0 => 'sonata.formatter.twig.control_flow', 1 => 'sonata.formatter.twig.gist', 2 => 'sonata.media.formatter.twig')), true));
        $instance->addExtension($this->get('sonata.formatter.twig.control_flow'));
        $instance->addExtension($this->get('sonata.formatter.twig.gist'));
        $instance->addExtension($this->get('sonata.media.formatter.twig'));
        $instance->setLexer(new \Twig_Lexer($instance, array('tag_comment' => array(0 => '<#', 1 => '#>'), 'tag_block' => array(0 => '<%', 1 => '%>'), 'tag_variable' => array(0 => '<%=', 1 => '%>'))));
        return $instance;
    }
    protected function getSonata_Payment_Browser_CurlService()
    {
        return $this->services['sonata.payment.browser.curl'] = new \Buzz\Browser(new \Buzz\Client\Curl());
    }
    protected function getSonata_Seo_Source_DoctrineSitemapIterator0Service()
    {
        return $this->services['sonata.seo.source.doctrine_sitemap_iterator_0'] = new \Exporter\Source\SymfonySitemapSourceIterator(new \Exporter\Source\DoctrineDBALConnectionSourceIterator($this->get('doctrine.dbal.default_connection'), 'SELECT id, updated_at as lastmod, \'weekly\' as changefreq, \'0.5\' as prioriy FROM media__media WHERE enabled = true'), $this->get('cmf_routing.router'), 'sonata_media_view', array('id' => NULL));
    }
    protected function getSonata_Seo_Source_DoctrineSitemapIterator1Service()
    {
        return $this->services['sonata.seo.source.doctrine_sitemap_iterator_1'] = new \Exporter\Source\SymfonySitemapSourceIterator(new \Exporter\Source\DoctrineDBALConnectionSourceIterator($this->get('doctrine.dbal.default_connection'), 'SELECT CONCAT_WS(\'/\', YEAR(created_at), MONTH(created_at), DAY(created_at), slug) as permalink , updated_at as lastmod, \'weekly\' as changefreq, \'0.5\' as prioriy FROM news__post WHERE enabled = 1 AND (publication_date_start IS NULL OR publication_date_start <= NOW())'), $this->get('cmf_routing.router'), 'sonata_news_view', array('permalink' => NULL));
    }
    protected function getSonata_Seo_Source_DoctrineSitemapIterator2Service()
    {
        return $this->services['sonata.seo.source.doctrine_sitemap_iterator_2'] = new \Exporter\Source\SymfonySitemapSourceIterator(new \Exporter\Source\DoctrineDBALConnectionSourceIterator($this->get('doctrine.dbal.default_connection'), 'SELECT url as path, updated_at as lastmod, \'weekly\' as changefreq, \'0.5\' as prioriy FROM page__snapshot WHERE route_name = \'page_slug\' AND enabled = 1 AND (publication_date_start IS NULL OR publication_date_start <= NOW())'), $this->get('cmf_routing.router'), 'page_slug', array('path' => NULL));
    }
    protected function getSonata_Seo_Source_DoctrineSitemapIterator3Service()
    {
        return $this->services['sonata.seo.source.doctrine_sitemap_iterator_3'] = new \Exporter\Source\SymfonySitemapSourceIterator(new \Exporter\Source\DoctrineDBALConnectionSourceIterator($this->get('doctrine.dbal.default_connection'), 'SELECT id as category_id, slug as category_slug, updated_at as lastmod, \'weekly\' as changefreq, \'0.5\' as prioriy FROM classification__category WHERE enabled = true'), $this->get('cmf_routing.router'), 'sonata_catalog_category', array('category_id' => NULL, 'category_slug' => NULL));
    }
    protected function getSonata_Seo_Source_DoctrineSitemapIterator4Service()
    {
        return $this->services['sonata.seo.source.doctrine_sitemap_iterator_4'] = new \Exporter\Source\SymfonySitemapSourceIterator(new \Exporter\Source\DoctrineDBALConnectionSourceIterator($this->get('doctrine.dbal.default_connection'), 'SELECT id as productId, slug, updated_at as lastmod, \'weekly\' as changefreq, \'0.5\' as prioriy FROM product__product WHERE enabled = true'), $this->get('cmf_routing.router'), 'sonata_product_view', array('productId' => NULL, 'slug' => NULL));
    }
    protected function getTemplating_Engine_PhpService()
    {
        $this->services['templating.engine.php'] = $instance = new \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine($this->get('templating.name_parser'), $this, $this->get('templating.loader'), $this->get('templating.globals'));
        $instance->setCharset('UTF-8');
        $instance->setHelpers(array('slots' => 'templating.helper.slots', 'assets' => 'templating.helper.assets', 'request' => 'templating.helper.request', 'session' => 'templating.helper.session', 'router' => 'templating.helper.router', 'actions' => 'templating.helper.actions', 'code' => 'templating.helper.code', 'translator' => 'templating.helper.translator', 'form' => 'templating.helper.form', 'stopwatch' => 'templating.helper.stopwatch', 'logout_url' => 'templating.helper.logout_url', 'security' => 'templating.helper.security', 'assetic' => 'assetic.helper.static', 'markdown' => 'templating.helper.markdown', 'knp_pagination' => 'knp_paginator.templating.helper.pagination', 'ivory_ckeditor' => 'ivory_ck_editor.templating.helper', 'jms_serializer' => 'jms_serializer.templating.helper.serializer', 'locale' => 'sonata.intl.templating.helper.locale', 'number' => 'sonata.intl.templating.helper.number', 'datetime' => 'sonata.intl.templating.helper.datetime', 'sonata_block' => 'sonata.block.templating.helper'));
        return $instance;
    }
    protected function getTemplating_LocatorService()
    {
        return $this->services['templating.locator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator($this->get('file_locator'), __DIR__);
    }
    protected function getValidator_ValidatorFactoryService()
    {
        return $this->services['validator.validator_factory'] = new \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory($this, array('validator.expression' => 'validator.expression', 'Symfony\\Component\\Validator\\Constraints\\EmailValidator' => 'validator.email', 'security.validator.user_password' => 'security.validator.user_password', 'doctrine.orm.validator.unique' => 'doctrine.orm.validator.unique', 'sonata.page.validator.unique_url' => 'sonata.page.validator.unique_url', 'sonata.media.validator.format' => 'sonata.media.validator.format', 'sonata.admin.validator.inline' => 'sonata.admin.validator.inline', 'sonata_basket_validator' => 'sonata.basket.validator.basket', 'sonata.core.validator.inline' => 'sonata.core.validator.inline', 'sonata.formatter.validator.formatter' => 'sonata.formatter.validator.formatter'));
    }
    public function getParameter($name)
    {
        $name = strtolower($name);
        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        return $this->parameters[$name];
    }
    public function hasParameter($name)
    {
        $name = strtolower($name);
        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }
        return $this->parameterBag;
    }
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => $this->targetDirs[2],
            'kernel.environment' => 'dev',
            'kernel.debug' => false,
            'kernel.name' => 'app',
            'kernel.cache_dir' => __DIR__,
            'kernel.logs_dir' => ($this->targetDirs[2].'/logs'),
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'SecurityBundle' => 'Symfony\\Bundle\\SecurityBundle\\SecurityBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'SwiftmailerBundle' => 'Symfony\\Bundle\\SwiftmailerBundle\\SwiftmailerBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'JMSAopBundle' => 'JMS\\AopBundle\\JMSAopBundle',
                'JMSSecurityExtraBundle' => 'JMS\\SecurityExtraBundle\\JMSSecurityExtraBundle',
                'AsseticBundle' => 'Symfony\\Bundle\\AsseticBundle\\AsseticBundle',
                'DoctrineBundle' => 'Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'DoctrineMigrationsBundle' => 'Doctrine\\Bundle\\MigrationsBundle\\DoctrineMigrationsBundle',
                'KnpMenuBundle' => 'Knp\\Bundle\\MenuBundle\\KnpMenuBundle',
                'KnpMarkdownBundle' => 'Knp\\Bundle\\MarkdownBundle\\KnpMarkdownBundle',
                'KnpPaginatorBundle' => 'Knp\\Bundle\\PaginatorBundle\\KnpPaginatorBundle',
                'FOSUserBundle' => 'FOS\\UserBundle\\FOSUserBundle',
                'SonataUserBundle' => 'Sonata\\UserBundle\\SonataUserBundle',
                'ApplicationSonataUserBundle' => 'Application\\Sonata\\UserBundle\\ApplicationSonataUserBundle',
                'SonataPageBundle' => 'Sonata\\PageBundle\\SonataPageBundle',
                'ApplicationSonataPageBundle' => 'Application\\Sonata\\PageBundle\\ApplicationSonataPageBundle',
                'SonataNewsBundle' => 'Sonata\\NewsBundle\\SonataNewsBundle',
                'ApplicationSonataNewsBundle' => 'Application\\Sonata\\NewsBundle\\ApplicationSonataNewsBundle',
                'SonataMediaBundle' => 'Sonata\\MediaBundle\\SonataMediaBundle',
                'ApplicationSonataMediaBundle' => 'Application\\Sonata\\MediaBundle\\ApplicationSonataMediaBundle',
                'IvoryCKEditorBundle' => 'Ivory\\CKEditorBundle\\IvoryCKEditorBundle',
                'SonataAdminBundle' => 'Sonata\\AdminBundle\\SonataAdminBundle',
                'SonataDoctrineORMAdminBundle' => 'Sonata\\DoctrineORMAdminBundle\\SonataDoctrineORMAdminBundle',
                'SimpleThingsEntityAuditBundle' => 'SimpleThings\\EntityAudit\\SimpleThingsEntityAuditBundle',
                'FOSRestBundle' => 'FOS\\RestBundle\\FOSRestBundle',
                'NelmioApiDocBundle' => 'Nelmio\\ApiDocBundle\\NelmioApiDocBundle',
                'SonataBasketBundle' => 'Sonata\\BasketBundle\\SonataBasketBundle',
                'ApplicationSonataBasketBundle' => 'Application\\Sonata\\BasketBundle\\ApplicationSonataBasketBundle',
                'SonataCustomerBundle' => 'Sonata\\CustomerBundle\\SonataCustomerBundle',
                'ApplicationSonataCustomerBundle' => 'Application\\Sonata\\CustomerBundle\\ApplicationSonataCustomerBundle',
                'SonataDeliveryBundle' => 'Sonata\\DeliveryBundle\\SonataDeliveryBundle',
                'ApplicationSonataDeliveryBundle' => 'Application\\Sonata\\DeliveryBundle\\ApplicationSonataDeliveryBundle',
                'SonataInvoiceBundle' => 'Sonata\\InvoiceBundle\\SonataInvoiceBundle',
                'ApplicationSonataInvoiceBundle' => 'Application\\Sonata\\InvoiceBundle\\ApplicationSonataInvoiceBundle',
                'SonataOrderBundle' => 'Sonata\\OrderBundle\\SonataOrderBundle',
                'ApplicationSonataOrderBundle' => 'Application\\Sonata\\OrderBundle\\ApplicationSonataOrderBundle',
                'SonataPaymentBundle' => 'Sonata\\PaymentBundle\\SonataPaymentBundle',
                'ApplicationSonataPaymentBundle' => 'Application\\Sonata\\PaymentBundle\\ApplicationSonataPaymentBundle',
                'SonataProductBundle' => 'Sonata\\ProductBundle\\SonataProductBundle',
                'ApplicationSonataProductBundle' => 'Application\\Sonata\\ProductBundle\\ApplicationSonataProductBundle',
                'SonataPriceBundle' => 'Sonata\\PriceBundle\\SonataPriceBundle',
                'JMSSerializerBundle' => 'JMS\\SerializerBundle\\JMSSerializerBundle',
                'FOSCommentBundle' => 'FOS\\CommentBundle\\FOSCommentBundle',
                'SonataCommentBundle' => 'Sonata\\CommentBundle\\SonataCommentBundle',
                'ApplicationSonataCommentBundle' => 'Application\\Sonata\\CommentBundle\\ApplicationSonataCommentBundle',
                'SonataEasyExtendsBundle' => 'Sonata\\EasyExtendsBundle\\SonataEasyExtendsBundle',
                'SonataCoreBundle' => 'Sonata\\CoreBundle\\SonataCoreBundle',
                'SonataIntlBundle' => 'Sonata\\IntlBundle\\SonataIntlBundle',
                'SonataFormatterBundle' => 'Sonata\\FormatterBundle\\SonataFormatterBundle',
                'SonataCacheBundle' => 'Sonata\\CacheBundle\\SonataCacheBundle',
                'SonataBlockBundle' => 'Sonata\\BlockBundle\\SonataBlockBundle',
                'SonataSeoBundle' => 'Sonata\\SeoBundle\\SonataSeoBundle',
                'SonataClassificationBundle' => 'Sonata\\ClassificationBundle\\SonataClassificationBundle',
                'ApplicationSonataClassificationBundle' => 'Application\\Sonata\\ClassificationBundle\\ApplicationSonataClassificationBundle',
                'SonataNotificationBundle' => 'Sonata\\NotificationBundle\\SonataNotificationBundle',
                'ApplicationSonataNotificationBundle' => 'Application\\Sonata\\NotificationBundle\\ApplicationSonataNotificationBundle',
                'ApplicationSonataSeoBundle' => 'Application\\Sonata\\SeoBundle\\ApplicationSonataSeoBundle',
                'SonataDatagridBundle' => 'Sonata\\DatagridBundle\\SonataDatagridBundle',
                'CmfRoutingBundle' => 'Symfony\\Cmf\\Bundle\\RoutingBundle\\CmfRoutingBundle',
                'SonataDemoBundle' => 'Sonata\\Bundle\\DemoBundle\\SonataDemoBundle',
                'SonataQABundle' => 'Sonata\\Bundle\\QABundle\\SonataQABundle',
                'SpyTimelineBundle' => 'Spy\\TimelineBundle\\SpyTimelineBundle',
                'SonataTimelineBundle' => 'Sonata\\TimelineBundle\\SonataTimelineBundle',
                'ApplicationSonataTimelineBundle' => 'Application\\Sonata\\TimelineBundle\\ApplicationSonataTimelineBundle',
                'MopaBootstrapBundle' => 'Mopa\\Bundle\\BootstrapBundle\\MopaBootstrapBundle',
                'WebProfilerBundle' => 'Symfony\\Bundle\\WebProfilerBundle\\WebProfilerBundle',
                'SensioGeneratorBundle' => 'Sensio\\Bundle\\GeneratorBundle\\SensioGeneratorBundle',
                'BazingaFakerBundle' => 'Bazinga\\Bundle\\FakerBundle\\BazingaFakerBundle',
                'DoctrineFixturesBundle' => 'Doctrine\\Bundle\\FixturesBundle\\DoctrineFixturesBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'appDevProjectContainer',
            'database_driver' => 'pdo_mysql',
            'database_host' => '127.0.0.1',
            'database_name' => 'sonata3',
            'database_user' => 'root',
            'database_password' => 'panda2014',
            'mailer_transport' => 'smtp',
            'mailer_host' => 'localhost',
            'mailer_user' => NULL,
            'mailer_password' => NULL,
            'locale' => 'en',
            'secret' => 'ThisTokenIsNotSoSecretChangeIt',
            'sonata_admin.title' => 'Sonata Project',
            'sonata_admin.logo_title' => '/bundles/sonataadmin/logo_title.png',
            'sonata_news.blog_title' => 'My Awesome Blog',
            'sonata_news.blog_link' => 'http://awesome-blog.ltd',
            'sonata_news.blog_description' => 'My Awesome blog description',
            'sonata_news.salt' => 'ThisTokenIsNotSoSecretChangeIt',
            'sonata_news.comment.emails' => array(
                0 => 'mail@example.org',
            ),
            'sonata_news.comment.email_from' => 'no-reply@example.org',
            'sonata_media.cdn.host' => '/uploads/media',
            'sonata_user.google_authenticator.server' => 'demo.sonata-project.org',
            'sonata_page.varnish.command' => 'if [ ! -r "/etc/varnish/secret" ]; then echo "VALID ERROR :/"; else varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 {{ COMMAND }} "{{ EXPRESSION }}"; fi;',
            'security.acl.permission.map.class' => 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\AdminPermissionMap',
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'streamed_response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener',
            'locale_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener',
            'event_dispatcher.class' => 'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Component\\HttpKernel\\DependencyInjection\\ContainerAwareHttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'cache_clearer.class' => 'Symfony\\Component\\HttpKernel\\CacheClearer\\ChainCacheClearer',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'uri_signer.class' => 'Symfony\\Component\\HttpKernel\\UriSigner',
            'request_stack.class' => 'Symfony\\Component\\HttpFoundation\\RequestStack',
            'fragment.handler.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\FragmentHandler',
            'fragment.renderer.inline.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\InlineFragmentRenderer',
            'fragment.renderer.hinclude.class' => 'Symfony\\Bundle\\FrameworkBundle\\Fragment\\ContainerAwareHIncludeFragmentRenderer',
            'fragment.renderer.hinclude.global_template' => NULL,
            'fragment.renderer.esi.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\EsiFragmentRenderer',
            'fragment.path' => '/_fragment',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'translation.loader.po.class' => 'Symfony\\Component\\Translation\\Loader\\PoFileLoader',
            'translation.loader.mo.class' => 'Symfony\\Component\\Translation\\Loader\\MoFileLoader',
            'translation.loader.qt.class' => 'Symfony\\Component\\Translation\\Loader\\QtFileLoader',
            'translation.loader.csv.class' => 'Symfony\\Component\\Translation\\Loader\\CsvFileLoader',
            'translation.loader.res.class' => 'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader',
            'translation.loader.dat.class' => 'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader',
            'translation.loader.ini.class' => 'Symfony\\Component\\Translation\\Loader\\IniFileLoader',
            'translation.loader.json.class' => 'Symfony\\Component\\Translation\\Loader\\JsonFileLoader',
            'translation.dumper.php.class' => 'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper',
            'translation.dumper.xliff.class' => 'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper',
            'translation.dumper.po.class' => 'Symfony\\Component\\Translation\\Dumper\\PoFileDumper',
            'translation.dumper.mo.class' => 'Symfony\\Component\\Translation\\Dumper\\MoFileDumper',
            'translation.dumper.yml.class' => 'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper',
            'translation.dumper.qt.class' => 'Symfony\\Component\\Translation\\Dumper\\QtFileDumper',
            'translation.dumper.csv.class' => 'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper',
            'translation.dumper.ini.class' => 'Symfony\\Component\\Translation\\Dumper\\IniFileDumper',
            'translation.dumper.json.class' => 'Symfony\\Component\\Translation\\Dumper\\JsonFileDumper',
            'translation.dumper.res.class' => 'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper',
            'translation.extractor.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\PhpExtractor',
            'translation.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\TranslationLoader',
            'translation.extractor.class' => 'Symfony\\Component\\Translation\\Extractor\\ChainExtractor',
            'translation.writer.class' => 'Symfony\\Component\\Translation\\Writer\\TranslationWriter',
            'property_accessor.class' => 'Symfony\\Component\\PropertyAccess\\PropertyAccessor',
            'kernel.secret' => 'ThisTokenIsNotSoSecretChangeIt',
            'kernel.http_method_override' => true,
            'kernel.trusted_hosts' => array(
            ),
            'kernel.trusted_proxies' => array(
            ),
            'kernel.default_locale' => 'en',
            'session.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Session',
            'session.flashbag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Flash\\FlashBag',
            'session.attribute_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Attribute\\AttributeBag',
            'session.storage.metadata_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MetadataBag',
            'session.metadata.storage_key' => '_sf2_meta',
            'session.storage.native.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\NativeSessionStorage',
            'session.storage.php_bridge.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\PhpBridgeSessionStorage',
            'session.storage.mock_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MockFileSessionStorage',
            'session.handler.native_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\NativeFileSessionHandler',
            'session.handler.write_check.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\WriteCheckSessionHandler',
            'session_listener.class' => 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener',
            'session.storage.options' => array(
                'gc_probability' => 1,
            ),
            'session.save_path' => ($this->targetDirs[1].'/sessions'),
            'session.metadata.update_threshold' => '0',
            'security.secure_random.class' => 'Symfony\\Component\\Security\\Core\\Util\\SecureRandom',
            'form.resolved_type_factory.class' => 'Symfony\\Component\\Form\\ResolvedFormTypeFactory',
            'form.registry.class' => 'Symfony\\Component\\Form\\FormRegistry',
            'form.factory.class' => 'Symfony\\Component\\Form\\FormFactory',
            'form.extension.class' => 'Symfony\\Component\\Form\\Extension\\DependencyInjection\\DependencyInjectionExtension',
            'form.type_guesser.validator.class' => 'Symfony\\Component\\Form\\Extension\\Validator\\ValidatorTypeGuesser',
            'form.type_extension.form.request_handler.class' => 'Symfony\\Component\\Form\\Extension\\HttpFoundation\\HttpFoundationRequestHandler',
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'security.csrf.token_generator.class' => 'Symfony\\Component\\Security\\Csrf\\TokenGenerator\\UriSafeTokenGenerator',
            'security.csrf.token_storage.class' => 'Symfony\\Component\\Security\\Csrf\\TokenStorage\\SessionTokenStorage',
            'security.csrf.token_manager.class' => 'Symfony\\Component\\Security\\Csrf\\CsrfTokenManager',
            'templating.engine.delegating.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\DelegatingEngine',
            'templating.name_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateNameParser',
            'templating.filename_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateFilenameParser',
            'templating.cache_warmer.template_paths.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplatePathsCacheWarmer',
            'templating.locator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\TemplateLocator',
            'templating.loader.filesystem.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\FilesystemLoader',
            'templating.loader.cache.class' => 'Symfony\\Component\\Templating\\Loader\\CacheLoader',
            'templating.loader.chain.class' => 'Symfony\\Component\\Templating\\Loader\\ChainLoader',
            'templating.finder.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplateFinder',
            'templating.engine.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\PhpEngine',
            'templating.helper.slots.class' => 'Symfony\\Component\\Templating\\Helper\\SlotsHelper',
            'templating.helper.assets.class' => 'Symfony\\Component\\Templating\\Helper\\CoreAssetsHelper',
            'templating.helper.actions.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\ActionsHelper',
            'templating.helper.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RouterHelper',
            'templating.helper.request.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RequestHelper',
            'templating.helper.session.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\SessionHelper',
            'templating.helper.code.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\CodeHelper',
            'templating.helper.translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\TranslatorHelper',
            'templating.helper.form.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\FormHelper',
            'templating.helper.stopwatch.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\StopwatchHelper',
            'templating.form.engine.class' => 'Symfony\\Component\\Form\\Extension\\Templating\\TemplatingRendererEngine',
            'templating.form.renderer.class' => 'Symfony\\Component\\Form\\FormRenderer',
            'templating.globals.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\GlobalVariables',
            'templating.asset.path_package.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PathPackage',
            'templating.asset.url_package.class' => 'Symfony\\Component\\Templating\\Asset\\UrlPackage',
            'templating.asset.package_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PackageFactory',
            'templating.helper.code.file_link_format' => NULL,
            'templating.helper.form.resources' => array(
                0 => 'FrameworkBundle:Form',
            ),
            'templating.loader.cache.path' => NULL,
            'templating.engines' => array(
                0 => 'twig',
            ),
            'validator.class' => 'Symfony\\Component\\Validator\\ValidatorInterface',
            'validator.builder.class' => 'Symfony\\Component\\Validator\\ValidatorBuilderInterface',
            'validator.builder.factory.class' => 'Symfony\\Component\\Validator\\Validation',
            'validator.mapping.cache.apc.class' => 'Symfony\\Component\\Validator\\Mapping\\Cache\\ApcCache',
            'validator.mapping.cache.prefix' => '',
            'validator.validator_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Validator\\ConstraintValidatorFactory',
            'validator.expression.class' => 'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator',
            'validator.email.class' => 'Symfony\\Component\\Validator\\Constraints\\EmailValidator',
            'validator.translation_domain' => 'validators',
            'validator.api' => 3,
            'fragment.listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener',
            'profiler.class' => 'Symfony\\Component\\HttpKernel\\Profiler\\Profiler',
            'profiler_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ProfilerListener',
            'data_collector.config.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ConfigDataCollector',
            'data_collector.request.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\RequestDataCollector',
            'data_collector.exception.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ExceptionDataCollector',
            'data_collector.events.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\EventDataCollector',
            'data_collector.logger.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\LoggerDataCollector',
            'data_collector.time.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\TimeDataCollector',
            'data_collector.memory.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\MemoryDataCollector',
            'data_collector.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\DataCollector\\RouterDataCollector',
            'form.resolved_type_factory.data_collector_proxy.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\Proxy\\ResolvedTypeFactoryDataCollectorProxy',
            'form.type_extension.form.data_collector.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\Type\\DataCollectorTypeExtension',
            'data_collector.form.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\FormDataCollector',
            'data_collector.form.extractor.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\FormDataExtractor',
            'profiler_listener.only_exceptions' => false,
            'profiler_listener.only_master_requests' => false,
            'profiler.storage.dsn' => ('file:'.__DIR__.'/profiler'),
            'profiler.storage.username' => '',
            'profiler.storage.password' => '',
            'profiler.storage.lifetime' => 86400,
            'translator.logging' => false,
            'router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\Router',
            'router.request_context.class' => 'Symfony\\Component\\Routing\\RequestContext',
            'routing.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\DelegatingLoader',
            'routing.resolver.class' => 'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'routing.loader.xml.class' => 'Symfony\\Component\\Routing\\Loader\\XmlFileLoader',
            'routing.loader.yml.class' => 'Symfony\\Component\\Routing\\Loader\\YamlFileLoader',
            'routing.loader.php.class' => 'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'router.options.generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'router.options.matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'router.cache_warmer.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\RouterCacheWarmer',
            'router.options.matcher.cache_class' => 'appDevUrlMatcher',
            'router.options.generator.cache_class' => 'appDevUrlGenerator',
            'router_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener',
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => ($this->targetDirs[2].'/config/routing_dev.yml'),
            'router.cache_class_prefix' => 'appDev',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
            'debug.debug_handlers_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener',
            'debug.stopwatch.class' => 'Symfony\\Component\\Stopwatch\\Stopwatch',
            'debug.error_handler.throw_at' => 0,
            'security.context.class' => 'Symfony\\Component\\Security\\Core\\SecurityContext',
            'security.user_checker.class' => 'Symfony\\Component\\Security\\Core\\User\\UserChecker',
            'security.encoder_factory.generic.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\EncoderFactory',
            'security.encoder.digest.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder',
            'security.encoder.plain.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\PlaintextPasswordEncoder',
            'security.encoder.pbkdf2.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\Pbkdf2PasswordEncoder',
            'security.encoder.bcrypt.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\BCryptPasswordEncoder',
            'security.user.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\User\\InMemoryUserProvider',
            'security.user.provider.in_memory.user.class' => 'Symfony\\Component\\Security\\Core\\User\\User',
            'security.user.provider.chain.class' => 'Symfony\\Component\\Security\\Core\\User\\ChainUserProvider',
            'security.authentication.trust_resolver.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationTrustResolver',
            'security.authentication.trust_resolver.anonymous_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken',
            'security.authentication.trust_resolver.rememberme_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken',
            'security.authentication.manager.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationProviderManager',
            'security.authentication.session_strategy.class' => 'Symfony\\Component\\Security\\Http\\Session\\SessionAuthenticationStrategy',
            'security.access.decision_manager.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\AccessDecisionManager',
            'security.access.simple_role_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleVoter',
            'security.access.authenticated_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\AuthenticatedVoter',
            'security.access.role_hierarchy_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleHierarchyVoter',
            'security.access.expression_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\ExpressionVoter',
            'security.firewall.class' => 'Symfony\\Component\\Security\\Http\\Firewall',
            'security.firewall.map.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallMap',
            'security.firewall.context.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallContext',
            'security.matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'security.expression_matcher.class' => 'Symfony\\Component\\HttpFoundation\\ExpressionRequestMatcher',
            'security.role_hierarchy.class' => 'Symfony\\Component\\Security\\Core\\Role\\RoleHierarchy',
            'security.http_utils.class' => 'Symfony\\Component\\Security\\Http\\HttpUtils',
            'security.validator.user_password.class' => 'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator',
            'security.expression_language.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\ExpressionLanguage',
            'security.authentication.retry_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\RetryAuthenticationEntryPoint',
            'security.channel_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ChannelListener',
            'security.authentication.form_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\FormAuthenticationEntryPoint',
            'security.authentication.listener.form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\UsernamePasswordFormAuthenticationListener',
            'security.authentication.listener.simple_form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SimpleFormAuthenticationListener',
            'security.authentication.listener.simple_preauth.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SimplePreAuthenticationListener',
            'security.authentication.listener.basic.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\BasicAuthenticationListener',
            'security.authentication.basic_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\BasicAuthenticationEntryPoint',
            'security.authentication.listener.digest.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\DigestAuthenticationListener',
            'security.authentication.digest_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\DigestAuthenticationEntryPoint',
            'security.authentication.listener.x509.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\X509AuthenticationListener',
            'security.authentication.listener.anonymous.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AnonymousAuthenticationListener',
            'security.authentication.switchuser_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SwitchUserListener',
            'security.logout_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\LogoutListener',
            'security.logout.handler.session.class' => 'Symfony\\Component\\Security\\Http\\Logout\\SessionLogoutHandler',
            'security.logout.handler.cookie_clearing.class' => 'Symfony\\Component\\Security\\Http\\Logout\\CookieClearingLogoutHandler',
            'security.logout.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Logout\\DefaultLogoutSuccessHandler',
            'security.access_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AccessListener',
            'security.access_map.class' => 'Symfony\\Component\\Security\\Http\\AccessMap',
            'security.exception_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ExceptionListener',
            'security.context_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ContextListener',
            'security.authentication.provider.dao.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\DaoAuthenticationProvider',
            'security.authentication.provider.simple.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\SimpleAuthenticationProvider',
            'security.authentication.provider.pre_authenticated.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\PreAuthenticatedAuthenticationProvider',
            'security.authentication.provider.anonymous.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\AnonymousAuthenticationProvider',
            'security.authentication.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationSuccessHandler',
            'security.authentication.failure_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationFailureHandler',
            'security.authentication.simple_success_failure_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\SimpleAuthenticationHandler',
            'security.authentication.provider.rememberme.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\RememberMeAuthenticationProvider',
            'security.authentication.listener.rememberme.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\RememberMeListener',
            'security.rememberme.token.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\RememberMe\\InMemoryTokenProvider',
            'security.authentication.rememberme.services.persistent.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\PersistentTokenBasedRememberMeServices',
            'security.authentication.rememberme.services.simplehash.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\TokenBasedRememberMeServices',
            'security.rememberme.response_listener.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\ResponseListener',
            'templating.helper.logout_url.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\LogoutUrlHelper',
            'templating.helper.security.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\SecurityHelper',
            'twig.extension.logout_url.class' => 'Symfony\\Bundle\\SecurityBundle\\Twig\\Extension\\LogoutUrlExtension',
            'twig.extension.security.class' => 'Symfony\\Bridge\\Twig\\Extension\\SecurityExtension',
            'data_collector.security.class' => 'Symfony\\Bundle\\SecurityBundle\\DataCollector\\SecurityDataCollector',
            'security.access.denied_url' => NULL,
            'security.authentication.manager.erase_credentials' => true,
            'security.authentication.session_strategy.strategy' => 'migrate',
            'security.access.always_authenticate_before_granting' => false,
            'security.authentication.hide_user_not_found' => true,
            'security.role_hierarchy.roles' => array(
                'ROLE_ADMIN' => array(
                    0 => 'ROLE_USER',
                ),
                'ROLE_SUPER_ADMIN' => array(
                    0 => 'ROLE_USER',
                    1 => 'ROLE_SONATA_ADMIN',
                    2 => 'ROLE_ADMIN',
                    3 => 'ROLE_ALLOWED_TO_SWITCH',
                    4 => 'ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT',
                    5 => 'ROLE_SONATA_PAGE_ADMIN_BLOCK_EDIT',
                ),
                'SONATA' => array(
                ),
            ),
            'security.acl.permission_granting_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\PermissionGrantingStrategy',
            'security.acl.voter.class' => 'Symfony\\Component\\Security\\Acl\\Voter\\AclVoter',
            'security.acl.object_identity_retrieval_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\ObjectIdentityRetrievalStrategy',
            'security.acl.security_identity_retrieval_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\SecurityIdentityRetrievalStrategy',
            'security.acl.cache.doctrine.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\DoctrineAclCache',
            'security.acl.collection_cache.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\AclCollectionCache',
            'security.acl.dbal.provider.class' => 'Symfony\\Component\\Security\\Acl\\Dbal\\MutableAclProvider',
            'security.acl.dbal.schema.class' => 'Symfony\\Component\\Security\\Acl\\Dbal\\Schema',
            'security.acl.dbal.schema_listener.class' => 'Symfony\\Bundle\\SecurityBundle\\EventListener\\AclSchemaListener',
            'security.acl.dbal.class_table_name' => 'acl_classes',
            'security.acl.dbal.entry_table_name' => 'acl_entries',
            'security.acl.dbal.oid_table_name' => 'acl_object_identities',
            'security.acl.dbal.oid_ancestors_table_name' => 'acl_object_identity_ancestors',
            'security.acl.dbal.sid_table_name' => 'acl_security_identities',
            'twig.class' => 'Twig_Environment',
            'twig.loader.filesystem.class' => 'Symfony\\Bundle\\TwigBundle\\Loader\\FilesystemLoader',
            'twig.loader.chain.class' => 'Twig_Loader_Chain',
            'templating.engine.twig.class' => 'Symfony\\Bundle\\TwigBundle\\TwigEngine',
            'twig.cache_warmer.class' => 'Symfony\\Bundle\\TwigBundle\\CacheWarmer\\TemplateCacheCacheWarmer',
            'twig.extension.trans.class' => 'Symfony\\Bridge\\Twig\\Extension\\TranslationExtension',
            'twig.extension.assets.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\AssetsExtension',
            'twig.extension.actions.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\ActionsExtension',
            'twig.extension.code.class' => 'Symfony\\Bridge\\Twig\\Extension\\CodeExtension',
            'twig.extension.routing.class' => 'Symfony\\Bridge\\Twig\\Extension\\RoutingExtension',
            'twig.extension.yaml.class' => 'Symfony\\Bridge\\Twig\\Extension\\YamlExtension',
            'twig.extension.form.class' => 'Symfony\\Bridge\\Twig\\Extension\\FormExtension',
            'twig.extension.httpkernel.class' => 'Symfony\\Bridge\\Twig\\Extension\\HttpKernelExtension',
            'twig.extension.debug.stopwatch.class' => 'Symfony\\Bridge\\Twig\\Extension\\StopwatchExtension',
            'twig.extension.expression.class' => 'Symfony\\Bridge\\Twig\\Extension\\ExpressionExtension',
            'twig.form.engine.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRendererEngine',
            'twig.form.renderer.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRenderer',
            'twig.translation.extractor.class' => 'Symfony\\Bridge\\Twig\\Translation\\TwigExtractor',
            'twig.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'twig.controller.exception.class' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController',
            'twig.controller.preview_error.class' => 'Symfony\\Bundle\\TwigBundle\\Controller\\PreviewErrorController',
            'twig.exception_listener.controller' => 'FOS\\RestBundle\\Controller\\ExceptionController::showAction',
            'twig.form.resources' => array(
                0 => 'IvoryCKEditorBundle:Form:ckeditor_widget.html.twig',
                1 => 'form_div_layout.html.twig',
                2 => 'MopaBootstrapBundle:Form:fields.html.twig',
                3 => 'SonataFormatterBundle:Form:formatter.html.twig',
                4 => 'SonataMediaBundle:Form:media_widgets.html.twig',
                5 => 'SonataCoreBundle:Form:datepicker.html.twig',
                6 => 'SonataUserBundle:Form:form_admin_fields.html.twig',
            ),
            'twig.options' => array(
                'debug' => false,
                'strict_variables' => false,
                'base_template_class' => 'Sonata\\CacheBundle\\Twig\\TwigTemplate14',
                'exception_controller' => 'FOS\\RestBundle\\Controller\\ExceptionController::showAction',
                'form_themes' => array(
                    0 => 'form_div_layout.html.twig',
                    1 => 'SonataFormatterBundle:Form:formatter.html.twig',
                    2 => 'SonataMediaBundle:Form:media_widgets.html.twig',
                    3 => 'SonataCoreBundle:Form:datepicker.html.twig',
                ),
                'autoescape' => array(
                    0 => 'Symfony\\Bundle\\TwigBundle\\TwigDefaultEscapingStrategy',
                    1 => 'guess',
                ),
                'cache' => (__DIR__.'/twig'),
                'charset' => 'UTF-8',
                'paths' => array(
                ),
            ),
            'monolog.logger.class' => 'Symfony\\Bridge\\Monolog\\Logger',
            'monolog.gelf.publisher.class' => 'Gelf\\MessagePublisher',
            'monolog.gelfphp.publisher.class' => 'Gelf\\Publisher',
            'monolog.handler.stream.class' => 'Monolog\\Handler\\StreamHandler',
            'monolog.handler.console.class' => 'Symfony\\Bridge\\Monolog\\Handler\\ConsoleHandler',
            'monolog.handler.group.class' => 'Monolog\\Handler\\GroupHandler',
            'monolog.handler.buffer.class' => 'Monolog\\Handler\\BufferHandler',
            'monolog.handler.rotating_file.class' => 'Monolog\\Handler\\RotatingFileHandler',
            'monolog.handler.syslog.class' => 'Monolog\\Handler\\SyslogHandler',
            'monolog.handler.syslogudp.class' => 'Monolog\\Handler\\SyslogUdpHandler',
            'monolog.handler.null.class' => 'Monolog\\Handler\\NullHandler',
            'monolog.handler.test.class' => 'Monolog\\Handler\\TestHandler',
            'monolog.handler.gelf.class' => 'Monolog\\Handler\\GelfHandler',
            'monolog.handler.rollbar.class' => 'Monolog\\Handler\\RollbarHandler',
            'monolog.handler.flowdock.class' => 'Monolog\\Handler\\FlowdockHandler',
            'monolog.handler.browser_console.class' => 'Monolog\\Handler\\BrowserConsoleHandler',
            'monolog.handler.firephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\FirePHPHandler',
            'monolog.handler.chromephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\ChromePhpHandler',
            'monolog.handler.debug.class' => 'Symfony\\Bridge\\Monolog\\Handler\\DebugHandler',
            'monolog.handler.swift_mailer.class' => 'Symfony\\Bridge\\Monolog\\Handler\\SwiftMailerHandler',
            'monolog.handler.native_mailer.class' => 'Monolog\\Handler\\NativeMailerHandler',
            'monolog.handler.socket.class' => 'Monolog\\Handler\\SocketHandler',
            'monolog.handler.pushover.class' => 'Monolog\\Handler\\PushoverHandler',
            'monolog.handler.raven.class' => 'Monolog\\Handler\\RavenHandler',
            'monolog.handler.newrelic.class' => 'Monolog\\Handler\\NewRelicHandler',
            'monolog.handler.hipchat.class' => 'Monolog\\Handler\\HipChatHandler',
            'monolog.handler.slack.class' => 'Monolog\\Handler\\SlackHandler',
            'monolog.handler.cube.class' => 'Monolog\\Handler\\CubeHandler',
            'monolog.handler.amqp.class' => 'Monolog\\Handler\\AmqpHandler',
            'monolog.handler.error_log.class' => 'Monolog\\Handler\\ErrorLogHandler',
            'monolog.handler.loggly.class' => 'Monolog\\Handler\\LogglyHandler',
            'monolog.handler.logentries.class' => 'Monolog\\Handler\\LogEntriesHandler',
            'monolog.handler.whatfailuregroup.class' => 'Monolog\\Handler\\WhatFailureGroupHandler',
            'monolog.activation_strategy.not_found.class' => 'Symfony\\Bundle\\MonologBundle\\NotFoundActivationStrategy',
            'monolog.handler.fingers_crossed.class' => 'Monolog\\Handler\\FingersCrossedHandler',
            'monolog.handler.fingers_crossed.error_level_activation_strategy.class' => 'Monolog\\Handler\\FingersCrossed\\ErrorLevelActivationStrategy',
            'monolog.handler.filter.class' => 'Monolog\\Handler\\FilterHandler',
            'monolog.handler.mongo.class' => 'Monolog\\Handler\\MongoDBHandler',
            'monolog.mongo.client.class' => 'MongoClient',
            'monolog.handler.elasticsearch.class' => 'Monolog\\Handler\\ElasticSearchHandler',
            'monolog.elastica.client.class' => 'Elastica\\Client',
            'monolog.swift_mailer.handlers' => array(
            ),
            'monolog.handlers_to_channels' => array(
                'monolog.handler.main' => NULL,
            ),
            'swiftmailer.class' => 'Swift_Mailer',
            'swiftmailer.transport.sendmail.class' => 'Swift_Transport_SendmailTransport',
            'swiftmailer.transport.mail.class' => 'Swift_Transport_MailTransport',
            'swiftmailer.transport.failover.class' => 'Swift_Transport_FailoverTransport',
            'swiftmailer.plugin.redirecting.class' => 'Swift_Plugins_RedirectingPlugin',
            'swiftmailer.plugin.impersonate.class' => 'Swift_Plugins_ImpersonatePlugin',
            'swiftmailer.plugin.messagelogger.class' => 'Swift_Plugins_MessageLogger',
            'swiftmailer.plugin.antiflood.class' => 'Swift_Plugins_AntiFloodPlugin',
            'swiftmailer.transport.smtp.class' => 'Swift_Transport_EsmtpTransport',
            'swiftmailer.plugin.blackhole.class' => 'Swift_Plugins_BlackholePlugin',
            'swiftmailer.spool.file.class' => 'Swift_FileSpool',
            'swiftmailer.spool.memory.class' => 'Swift_MemorySpool',
            'swiftmailer.email_sender.listener.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener',
            'swiftmailer.data_collector.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\DataCollector\\MessageDataCollector',
            'swiftmailer.mailer.default.transport.name' => 'smtp',
            'swiftmailer.mailer.default.delivery.enabled' => true,
            'swiftmailer.mailer.default.transport.smtp.encryption' => NULL,
            'swiftmailer.mailer.default.transport.smtp.port' => 25,
            'swiftmailer.mailer.default.transport.smtp.host' => 'localhost',
            'swiftmailer.mailer.default.transport.smtp.username' => NULL,
            'swiftmailer.mailer.default.transport.smtp.password' => NULL,
            'swiftmailer.mailer.default.transport.smtp.auth_mode' => NULL,
            'swiftmailer.mailer.default.transport.smtp.timeout' => 30,
            'swiftmailer.mailer.default.transport.smtp.source_ip' => NULL,
            'swiftmailer.mailer.default.spool.enabled' => false,
            'swiftmailer.mailer.default.plugin.impersonate' => NULL,
            'swiftmailer.mailer.default.single_address' => NULL,
            'swiftmailer.spool.enabled' => false,
            'swiftmailer.delivery.enabled' => true,
            'swiftmailer.single_address' => NULL,
            'swiftmailer.mailers' => array(
                'default' => 'swiftmailer.mailer.default',
            ),
            'swiftmailer.default_mailer' => 'default',
            'sensio_framework_extra.view.guesser.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Templating\\TemplateGuesser',
            'sensio_framework_extra.controller.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener',
            'sensio_framework_extra.routing.loader.annot_dir.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationDirectoryLoader',
            'sensio_framework_extra.routing.loader.annot_file.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationFileLoader',
            'sensio_framework_extra.routing.loader.annot_class.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Routing\\AnnotatedRouteControllerLoader',
            'sensio_framework_extra.converter.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener',
            'sensio_framework_extra.converter.manager.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\ParamConverterManager',
            'sensio_framework_extra.converter.doctrine.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DoctrineParamConverter',
            'sensio_framework_extra.converter.datetime.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DateTimeParamConverter',
            'jms_aop.cache_dir' => (__DIR__.'/jms_aop'),
            'jms_aop.interceptor_loader.class' => 'JMS\\AopBundle\\Aop\\InterceptorLoader',
            'security.secured_services' => array(
            ),
            'security.access.method_interceptor.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Interception\\MethodSecurityInterceptor',
            'security.access.method_access_control' => array(
            ),
            'security.access.remembering_access_decision_manager.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\RememberingAccessDecisionManager',
            'security.access.run_as_manager.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\RunAsManager',
            'security.authentication.provider.run_as.class' => 'JMS\\SecurityExtraBundle\\Security\\Authentication\\Provider\\RunAsAuthenticationProvider',
            'security.run_as.key' => 'RunAsToken',
            'security.run_as.role_prefix' => 'ROLE_',
            'security.access.after_invocation_manager.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\AfterInvocation\\AfterInvocationManager',
            'security.access.after_invocation.acl_provider.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\AfterInvocation\\AclAfterInvocationProvider',
            'security.access.iddqd_voter.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Voter\\IddqdVoter',
            'security.extra.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'security.extra.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'security.extra.driver_chain.class' => 'Metadata\\Driver\\DriverChain',
            'security.extra.annotation_driver.class' => 'JMS\\SecurityExtraBundle\\Metadata\\Driver\\AnnotationDriver',
            'security.extra.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'security.access.secure_all_services' => false,
            'security.extra.cache_dir' => (__DIR__.'/jms_security'),
            'security.authenticated_voter.disabled' => false,
            'security.role_voter.disabled' => false,
            'security.acl_voter.disabled' => false,
            'security.extra.iddqd_ignore_roles' => array(
                0 => 'ROLE_PREVIOUS_ADMIN',
            ),
            'security.iddqd_aliases' => array(
            ),
            'assetic.asset_factory.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\AssetFactory',
            'assetic.asset_manager.class' => 'Assetic\\Factory\\LazyAssetManager',
            'assetic.asset_manager_cache_warmer.class' => 'Symfony\\Bundle\\AsseticBundle\\CacheWarmer\\AssetManagerCacheWarmer',
            'assetic.cached_formula_loader.class' => 'Assetic\\Factory\\Loader\\CachedFormulaLoader',
            'assetic.config_cache.class' => 'Assetic\\Cache\\ConfigCache',
            'assetic.config_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\ConfigurationLoader',
            'assetic.config_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\ConfigurationResource',
            'assetic.coalescing_directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\CoalescingDirectoryResource',
            'assetic.directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\DirectoryResource',
            'assetic.filter_manager.class' => 'Symfony\\Bundle\\AsseticBundle\\FilterManager',
            'assetic.worker.ensure_filter.class' => 'Assetic\\Factory\\Worker\\EnsureFilterWorker',
            'assetic.worker.cache_busting.class' => 'Assetic\\Factory\\Worker\\CacheBustingWorker',
            'assetic.value_supplier.class' => 'Symfony\\Bundle\\AsseticBundle\\DefaultValueSupplier',
            'assetic.node.paths' => array(
            ),
            'assetic.cache_dir' => (__DIR__.'/assetic'),
            'assetic.bundles' => array(
            ),
            'assetic.twig_extension.class' => 'Symfony\\Bundle\\AsseticBundle\\Twig\\AsseticExtension',
            'assetic.twig_formula_loader.class' => 'Assetic\\Extension\\Twig\\TwigFormulaLoader',
            'assetic.helper.dynamic.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\DynamicAsseticHelper',
            'assetic.helper.static.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\StaticAsseticHelper',
            'assetic.php_formula_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\AsseticHelperFormulaLoader',
            'assetic.debug' => false,
            'assetic.use_controller' => false,
            'assetic.enable_profiler' => false,
            'assetic.read_from' => ($this->targetDirs[2].'/../web'),
            'assetic.write_to' => ($this->targetDirs[2].'/../web'),
            'assetic.variables' => array(
            ),
            'assetic.java.bin' => '/usr/bin/java',
            'assetic.node.bin' => '/usr/bin/node',
            'assetic.ruby.bin' => '/usr/bin/ruby',
            'assetic.sass.bin' => '/usr/bin/sass',
            'assetic.filter.cssrewrite.class' => 'Assetic\\Filter\\CssRewriteFilter',
            'assetic.filter.yui_js.class' => 'Assetic\\Filter\\Yui\\JsCompressorFilter',
            'assetic.filter.yui_js.java' => '/usr/bin/java',
            'assetic.filter.yui_js.jar' => ($this->targetDirs[2].'/../bin/yuicompressor.jar'),
            'assetic.filter.yui_js.charset' => 'UTF-8',
            'assetic.filter.yui_js.stacksize' => NULL,
            'assetic.filter.yui_js.timeout' => NULL,
            'assetic.filter.yui_js.nomunge' => NULL,
            'assetic.filter.yui_js.preserve_semi' => NULL,
            'assetic.filter.yui_js.disable_optimizations' => NULL,
            'assetic.filter.yui_js.linebreak' => NULL,
            'assetic.filter.yui_css.class' => 'Assetic\\Filter\\Yui\\CssCompressorFilter',
            'assetic.filter.yui_css.java' => '/usr/bin/java',
            'assetic.filter.yui_css.jar' => ($this->targetDirs[2].'/../bin/yuicompressor.jar'),
            'assetic.filter.yui_css.charset' => 'UTF-8',
            'assetic.filter.yui_css.stacksize' => NULL,
            'assetic.filter.yui_css.timeout' => NULL,
            'assetic.filter.yui_css.linebreak' => NULL,
            'assetic.twig_extension.functions' => array(
            ),
            'doctrine_cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine_cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine_cache.file_system.class' => 'Doctrine\\Common\\Cache\\FilesystemCache',
            'doctrine_cache.php_file.class' => 'Doctrine\\Common\\Cache\\PhpFileCache',
            'doctrine_cache.mongodb.class' => 'Doctrine\\Common\\Cache\\MongoDBCache',
            'doctrine_cache.mongodb.collection.class' => 'MongoCollection',
            'doctrine_cache.mongodb.connection.class' => 'MongoClient',
            'doctrine_cache.mongodb.server' => 'localhost:27017',
            'doctrine_cache.riak.class' => 'Doctrine\\Common\\Cache\\RiakCache',
            'doctrine_cache.riak.bucket.class' => 'Riak\\Bucket',
            'doctrine_cache.riak.connection.class' => 'Riak\\Connection',
            'doctrine_cache.riak.bucket_property_list.class' => 'Riak\\BucketPropertyList',
            'doctrine_cache.riak.host' => 'localhost',
            'doctrine_cache.riak.port' => 8087,
            'doctrine_cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine_cache.memcache.connection.class' => 'Memcache',
            'doctrine_cache.memcache.host' => 'localhost',
            'doctrine_cache.memcache.port' => 11211,
            'doctrine_cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine_cache.memcached.connection.class' => 'Memcached',
            'doctrine_cache.memcached.host' => 'localhost',
            'doctrine_cache.memcached.port' => 11211,
            'doctrine_cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine_cache.redis.connection.class' => 'Redis',
            'doctrine_cache.redis.host' => 'localhost',
            'doctrine_cache.redis.port' => 6379,
            'doctrine_cache.couchbase.class' => 'Doctrine\\Common\\Cache\\CouchbaseCache',
            'doctrine_cache.couchbase.connection.class' => 'Couchbase',
            'doctrine_cache.couchbase.hostnames' => 'localhost:8091',
            'doctrine_cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine_cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine_cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine_cache.security.acl.cache.class' => 'Doctrine\\Bundle\\DoctrineCacheBundle\\Acl\\Model\\AclCache',
            'doctrine.dbal.logger.chain.class' => 'Doctrine\\DBAL\\Logging\\LoggerChain',
            'doctrine.dbal.logger.profiling.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Doctrine\\Bundle\\DoctrineBundle\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Symfony\\Bridge\\Doctrine\\ContainerAwareEventManager',
            'doctrine.dbal.connection_factory.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => array(
                'default' => 'doctrine.orm.default_entity_manager',
            ),
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => array(
                'json' => array(
                    'class' => 'Sonata\\Doctrine\\Types\\JsonType',
                    'commented' => true,
                ),
                'currency' => array(
                    'class' => 'Sonata\\Component\\Currency\\CurrencyDoctrineType',
                    'commented' => true,
                ),
            ),
            'doctrine.connections' => array(
                'default' => 'doctrine.dbal.default_connection',
            ),
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.manager_configurator.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ManagerConfigurator',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine.orm.cache.memcached_host' => 'localhost',
            'doctrine.orm.cache.memcached_port' => 11211,
            'doctrine.orm.cache.memcached_instance.class' => 'Memcached',
            'doctrine.orm.cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine.orm.cache.redis_host' => 'localhost',
            'doctrine.orm.cache.redis_port' => 6379,
            'doctrine.orm.cache.redis_instance.class' => 'Redis',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine.orm.cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\Common\\Persistence\\Mapping\\Driver\\MappingDriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.xml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedXmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedYamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\DoctrineInitializer',
            'doctrine.orm.security.user.provider.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'doctrine.orm.listeners.resolve_target_entity.class' => 'Doctrine\\ORM\\Tools\\ResolveTargetEntityListener',
            'doctrine.orm.listeners.attach_entity_listeners.class' => 'Doctrine\\ORM\\Tools\\AttachEntityListenersListener',
            'doctrine.orm.naming_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultNamingStrategy',
            'doctrine.orm.naming_strategy.underscore.class' => 'Doctrine\\ORM\\Mapping\\UnderscoreNamingStrategy',
            'doctrine.orm.entity_listener_resolver.class' => 'Doctrine\\ORM\\Mapping\\DefaultEntityListenerResolver',
            'doctrine.orm.second_level_cache.default_cache_factory.class' => 'Doctrine\\ORM\\Cache\\DefaultCacheFactory',
            'doctrine.orm.second_level_cache.default_region.class' => 'Doctrine\\ORM\\Cache\\Region\\DefaultRegion',
            'doctrine.orm.second_level_cache.filelock_region.class' => 'Doctrine\\ORM\\Cache\\Region\\FileLockRegion',
            'doctrine.orm.second_level_cache.logger_chain.class' => 'Doctrine\\ORM\\Cache\\Logging\\CacheLoggerChain',
            'doctrine.orm.second_level_cache.logger_statistics.class' => 'Doctrine\\ORM\\Cache\\Logging\\StatisticsCacheLogger',
            'doctrine.orm.second_level_cache.cache_configuration.class' => 'Doctrine\\ORM\\Cache\\CacheConfiguration',
            'doctrine.orm.second_level_cache.regions_configuration.class' => 'Doctrine\\ORM\\Cache\\RegionsConfiguration',
            'doctrine.orm.auto_generate_proxy_classes' => false,
            'doctrine.orm.proxy_dir' => (__DIR__.'/doctrine/orm/Proxies'),
            'doctrine.orm.proxy_namespace' => 'Proxies',
            'doctrine_migrations.dir_name' => ($this->targetDirs[2].'/DoctrineMigrations'),
            'doctrine_migrations.namespace' => 'Application\\Migrations',
            'doctrine_migrations.table_name' => 'migration_versions',
            'doctrine_migrations.name' => 'Application Migrations',
            'knp_menu.factory.class' => 'Knp\\Menu\\MenuFactory',
            'knp_menu.factory_extension.routing.class' => 'Knp\\Menu\\Integration\\Symfony\\RoutingExtension',
            'knp_menu.helper.class' => 'Knp\\Menu\\Twig\\Helper',
            'knp_menu.matcher.class' => 'Knp\\Menu\\Matcher\\Matcher',
            'knp_menu.menu_provider.chain.class' => 'Knp\\Menu\\Provider\\ChainProvider',
            'knp_menu.menu_provider.container_aware.class' => 'Knp\\Bundle\\MenuBundle\\Provider\\ContainerAwareProvider',
            'knp_menu.menu_provider.builder_alias.class' => 'Knp\\Bundle\\MenuBundle\\Provider\\BuilderAliasProvider',
            'knp_menu.renderer_provider.class' => 'Knp\\Bundle\\MenuBundle\\Renderer\\ContainerAwareProvider',
            'knp_menu.renderer.list.class' => 'Knp\\Menu\\Renderer\\ListRenderer',
            'knp_menu.renderer.list.options' => array(
            ),
            'knp_menu.listener.voters.class' => 'Knp\\Bundle\\MenuBundle\\EventListener\\VoterInitializerListener',
            'knp_menu.voter.router.class' => 'Knp\\Menu\\Matcher\\Voter\\RouteVoter',
            'knp_menu.twig.extension.class' => 'Knp\\Menu\\Twig\\MenuExtension',
            'knp_menu.renderer.twig.class' => 'Knp\\Menu\\Renderer\\TwigRenderer',
            'knp_menu.renderer.twig.options' => array(
            ),
            'knp_menu.renderer.twig.template' => 'knp_menu.html.twig',
            'knp_menu.default_renderer' => 'twig',
            'templating.helper.markdown.class' => 'Knp\\Bundle\\MarkdownBundle\\Helper\\MarkdownHelper',
            'knp_paginator.class' => 'Knp\\Component\\Pager\\Paginator',
            'knp_paginator.templating.helper.pagination.class' => 'Knp\\Bundle\\PaginatorBundle\\Templating\\PaginationHelper',
            'knp_paginator.helper.processor.class' => 'Knp\\Bundle\\PaginatorBundle\\Helper\\Processor',
            'knp_paginator.template.pagination' => 'MopaBootstrapBundle:Pagination:sliding.html.twig',
            'knp_paginator.template.filtration' => 'KnpPaginatorBundle:Pagination:filtration.html.twig',
            'knp_paginator.template.sortable' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig',
            'knp_paginator.page_range' => 5,
            'fos_user.validator.password.class' => 'FOS\\UserBundle\\Validator\\PasswordValidator',
            'fos_user.validator.unique.class' => 'FOS\\UserBundle\\Validator\\UniqueValidator',
            'fos_user.security.interactive_login_listener.class' => 'FOS\\UserBundle\\Security\\InteractiveLoginListener',
            'fos_user.security.login_manager.class' => 'FOS\\UserBundle\\Security\\LoginManager',
            'fos_user.resetting.email.template' => 'FOSUserBundle:Resetting:email.txt.twig',
            'fos_user.registration.confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig',
            'fos_user.storage' => 'orm',
            'fos_user.firewall_name' => 'main',
            'fos_user.model_manager_name' => NULL,
            'fos_user.model.user.class' => 'Application\\Sonata\\UserBundle\\Entity\\User',
            'fos_user.template.engine' => 'twig',
            'fos_user.profile.form.type' => 'fos_user_profile',
            'fos_user.profile.form.name' => 'fos_user_profile_form',
            'fos_user.profile.form.validation_groups' => array(
                0 => 'Profile',
                1 => 'Default',
            ),
            'fos_user.registration.confirmation.from_email' => array(
                'webmaster@example.com' => 'webmaster',
            ),
            'fos_user.registration.confirmation.enabled' => false,
            'fos_user.registration.form.type' => 'fos_user_registration',
            'fos_user.registration.form.name' => 'fos_user_registration_form',
            'fos_user.registration.form.validation_groups' => array(
                0 => 'Registration',
                1 => 'Default',
            ),
            'fos_user.change_password.form.type' => 'fos_user_change_password',
            'fos_user.change_password.form.name' => 'fos_user_change_password_form',
            'fos_user.change_password.form.validation_groups' => array(
                0 => 'ChangePassword',
                1 => 'Default',
            ),
            'fos_user.resetting.email.from_email' => array(
                'webmaster@example.com' => 'webmaster',
            ),
            'fos_user.resetting.token_ttl' => 86400,
            'fos_user.resetting.form.type' => 'fos_user_resetting',
            'fos_user.resetting.form.name' => 'fos_user_resetting_form',
            'fos_user.resetting.form.validation_groups' => array(
                0 => 'ResetPassword',
                1 => 'Default',
            ),
            'fos_user.group_manager.class' => 'FOS\\UserBundle\\Doctrine\\GroupManager',
            'fos_user.model.group.class' => 'Application\\Sonata\\UserBundle\\Entity\\Group',
            'fos_user.group.form.type' => 'fos_user_group',
            'fos_user.group.form.name' => 'fos_user_group_form',
            'fos_user.group.form.validation_groups' => array(
                0 => 'Registration',
                1 => 'Default',
            ),
            'sonata.user.admin.groupname' => 'sonata_user',
            'sonata.user.block.breadcrumb_index.class' => 'Sonata\\UserBundle\\Block\\Breadcrumb\\UserIndexBreadcrumbBlockService',
            'sonata.user.block.breadcrumb_profile.class' => 'Sonata\\UserBundle\\Block\\Breadcrumb\\UserProfileBreadcrumbBlockService',
            'sonata.user.admin.user.class' => 'Sonata\\UserBundle\\Admin\\Entity\\UserAdmin',
            'sonata.user.admin.group.class' => 'Sonata\\UserBundle\\Admin\\Entity\\GroupAdmin',
            'sonata.user.admin.user.entity' => 'Application\\Sonata\\UserBundle\\Entity\\User',
            'sonata.user.admin.group.entity' => 'Application\\Sonata\\UserBundle\\Entity\\Group',
            'sonata.user.admin.user.translation_domain' => 'SonataUserBundle',
            'sonata.user.admin.group.translation_domain' => 'SonataUserBundle',
            'sonata.user.admin.user.controller' => 'SonataAdminBundle:CRUD',
            'sonata.user.admin.group.controller' => 'SonataAdminBundle:CRUD',
            'sonata.user.impersonating' => array(
                'route' => 'page_slug',
                'parameters' => array(
                    'path' => '/',
                ),
            ),
            'sonata.user.google.authenticator.enabled' => true,
            'sonata.user.profile.form.type' => 'sonata_user_profile',
            'sonata.user.profile.form.name' => 'sonata_user_profile_form',
            'sonata.user.profile.form.validation_groups' => array(
                0 => 'Profile',
                1 => 'Default',
            ),
            'sonata.user.register.confirm.redirect_route' => 'sonata_user_profile_show',
            'sonata.user.register.confirm.redirect_route_params' => array(
            ),
            'sonata.user.configuration.profile_blocks' => array(
                0 => array(
                    'position' => 'left',
                    'type' => 'sonata.block.service.text',
                    'settings' => array(
                        'content' => '<h2>Welcome!</h2> <p>This is a sample user profile dashboard, feel free to override it in the configuration! Want to make this text dynamic? For instance display the user\'s name? Create a dedicated block and edit the configuration!</p>',
                    ),
                ),
                1 => array(
                    'position' => 'left',
                    'type' => 'sonata.order.block.recent_orders',
                    'settings' => array(
                        'title' => 'Recent Orders',
                        'number' => 5,
                        'mode' => 'public',
                    ),
                ),
                2 => array(
                    'position' => 'right',
                    'type' => 'sonata.timeline.block.timeline',
                    'settings' => array(
                        'max_per_page' => 15,
                    ),
                ),
                3 => array(
                    'position' => 'right',
                    'type' => 'sonata.news.block.recent_posts',
                    'settings' => array(
                        'title' => 'Recent Posts',
                        'number' => 5,
                        'mode' => 'public',
                    ),
                ),
                4 => array(
                    'position' => 'right',
                    'type' => 'sonata.news.block.recent_comments',
                    'settings' => array(
                        'title' => 'Recent Comments',
                        'number' => 5,
                        'mode' => 'public',
                    ),
                ),
            ),
            'sonata.page.cms_manager.page.class' => 'Sonata\\PageBundle\\CmsManager\\CmsPageManager',
            'sonata.page.cms_manager.snapshot.class' => 'Sonata\\PageBundle\\CmsManager\\CmsSnapshotManager',
            'sonata.page.cms_manager_selector.class' => 'Sonata\\PageBundle\\CmsManager\\CmsManagerSelector',
            'sonata.page.decorator_strategy.class' => 'Sonata\\PageBundle\\CmsManager\\DecoratorStrategy',
            'sonata.page.response_listener.class' => 'Sonata\\PageBundle\\Listener\\ResponseListener',
            'sonata.page.request_listener.class' => 'Sonata\\PageBundle\\Listener\\RequestListener',
            'sonata.page.site.selector.host.class' => 'Sonata\\PageBundle\\Site\\HostSiteSelector',
            'sonata.page.site.selector.host_by_locale.class' => 'Sonata\\PageBundle\\Site\\HostByLocaleSiteSelector',
            'sonata.page.site.selector.host_with_path.class' => 'Sonata\\PageBundle\\Site\\HostPathSiteSelector',
            'sonata.page.site.selector.host_with_path_by_locale.class' => 'Sonata\\PageBundle\\Site\\HostPathByLocaleSiteSelector',
            'sonata.page.router.class' => 'Sonata\\PageBundle\\Route\\CmsPageRouter',
            'sonata.page.route.page.generator.class' => 'Sonata\\PageBundle\\Route\\RoutePageGenerator',
            'sonata.page.service.manager.class' => 'Sonata\\PageBundle\\Page\\PageServiceManager',
            'sonata.page.template.manager.class' => 'Sonata\\PageBundle\\Page\\TemplateManager',
            'sonata.page.service.default.class' => 'Sonata\\PageBundle\\Page\\Service\\DefaultPageService',
            'sonata.page.admin.page.class' => 'Sonata\\PageBundle\\Admin\\PageAdmin',
            'sonata.page.admin.page.controller' => 'SonataPageBundle:PageAdmin',
            'sonata.page.admin.page.translation_domain' => 'SonataPageBundle',
            'sonata.page.admin.site.class' => 'Sonata\\PageBundle\\Admin\\SiteAdmin',
            'sonata.page.admin.site.controller' => 'SonataPageBundle:SiteAdmin',
            'sonata.page.admin.site.translation_domain' => 'SonataPageBundle',
            'sonata.page.admin.block.class' => 'Sonata\\PageBundle\\Admin\\BlockAdmin',
            'sonata.page.admin.block.controller' => 'SonataPageBundle:BlockAdmin',
            'sonata.page.admin.block.translation_domain' => 'SonataPageBundle',
            'sonata.page.admin.shared_block.class' => 'Sonata\\PageBundle\\Admin\\SharedBlockAdmin',
            'sonata.page.admin.shared_block.controller' => 'SonataPageBundle:BlockAdmin',
            'sonata.page.admin.shared_block.translation_domain' => 'SonataPageBundle',
            'sonata.page.admin.snapshot.class' => 'Sonata\\PageBundle\\Admin\\SnapshotAdmin',
            'sonata.page.admin.snapshot.controller' => 'SonataPageBundle:SnapshotAdmin',
            'sonata.page.admin.snapshot.translation_domain' => 'SonataPageBundle',
            'sonata.page.block.container.class' => 'Sonata\\PageBundle\\Block\\ContainerBlockService',
            'sonata.page.block.children_pages.class' => 'Sonata\\PageBundle\\Block\\ChildrenPagesBlockService',
            'sonata.page.block.ajax.class' => 'Sonata\\PageBundle\\Controller\\AjaxController',
            'sonata.page.block.breadcrumb.class' => 'Sonata\\PageBundle\\Block\\BreadcrumbBlockService',
            'sonata.page.block.shared_block.class' => 'Sonata\\PageBundle\\Block\\SharedBlockBlockService',
            'sonata.page.manager.page.class' => 'Sonata\\PageBundle\\Entity\\PageManager',
            'sonata.page.manager.block.class' => 'Sonata\\PageBundle\\Entity\\BlockManager',
            'sonata.page.manager.snapshot.class' => 'Sonata\\PageBundle\\Entity\\SnapshotManager',
            'sonata.page.manager.site.class' => 'Sonata\\PageBundle\\Entity\\SiteManager',
            'sonata.page.block_interactor.class' => 'Sonata\\PageBundle\\Entity\\BlockInteractor',
            'sonata.page.transformer.class' => 'Sonata\\PageBundle\\Entity\\Transformer',
            'sonata.page.assets' => array(
                'stylesheets' => array(
                    0 => 'assetic/sonata_front_css.css',
                ),
                'javascripts' => array(
                    0 => 'assetic/sonata_front_js.js',
                ),
            ),
            'sonata.page.slugify_service' => 'sonata.core.slugify.native',
            'sonata.page.is_inline_edition_on' => false,
            'sonata.page.site.class' => 'Application\\Sonata\\PageBundle\\Entity\\Site',
            'sonata.page.block.class' => 'Application\\Sonata\\PageBundle\\Entity\\Block',
            'sonata.page.snapshot.class' => 'Application\\Sonata\\PageBundle\\Entity\\Snapshot',
            'sonata.page.page.class' => 'Application\\Sonata\\PageBundle\\Entity\\Page',
            'sonata.page.admin.site.entity' => 'Application\\Sonata\\PageBundle\\Entity\\Site',
            'sonata.page.admin.block.entity' => 'Application\\Sonata\\PageBundle\\Entity\\Block',
            'sonata.page.admin.snapshot.entity' => 'Application\\Sonata\\PageBundle\\Entity\\Snapshot',
            'sonata.page.admin.page.entity' => 'Application\\Sonata\\PageBundle\\Entity\\Page',
            'sonata.news.manager.comment.class' => 'Sonata\\NewsBundle\\Entity\\CommentManager',
            'sonata.news.manager.post.class' => 'Sonata\\NewsBundle\\Entity\\PostManager',
            'sonata.news.admin.post.entity' => 'Application\\Sonata\\NewsBundle\\Entity\\Post',
            'sonata.news.admin.comment.entity' => 'Application\\Sonata\\NewsBundle\\Entity\\Comment',
            'sonata.news.manager.post.entity' => 'Application\\Sonata\\NewsBundle\\Entity\\Post',
            'sonata.news.manager.comment.entity' => 'Application\\Sonata\\NewsBundle\\Entity\\Comment',
            'sonata.news.admin.post.class' => 'Sonata\\NewsBundle\\Admin\\PostAdmin',
            'sonata.news.admin.post.controller' => 'SonataAdminBundle:CRUD',
            'sonata.news.admin.post.translation_domain' => 'SonataNewsBundle',
            'sonata.news.admin.comment.class' => 'Sonata\\NewsBundle\\Admin\\CommentAdmin',
            'sonata.news.admin.comment.controller' => 'SonataNewsBundle:CommentAdmin',
            'sonata.news.admin.comment.translation_domain' => 'SonataNewsBundle',
            'sonata.media.provider.image.class' => 'Sonata\\MediaBundle\\Provider\\ImageProvider',
            'sonata.media.provider.file.class' => 'Sonata\\MediaBundle\\Provider\\FileProvider',
            'sonata.media.provider.youtube.class' => 'Sonata\\MediaBundle\\Provider\\YouTubeProvider',
            'sonata.media.provider.dailymotion.class' => 'Sonata\\MediaBundle\\Provider\\DailyMotionProvider',
            'sonata.media.provider.vimeo.class' => 'Sonata\\MediaBundle\\Provider\\VimeoProvider',
            'sonata.media.thumbnail.format' => 'Sonata\\MediaBundle\\Thumbnail\\FormatThumbnail',
            'sonata.media.thumbnail.format.default' => 'jpg',
            'sonata.media.thumbnail.liip_imagine' => 'Sonata\\MediaBundle\\Thumbnail\\LiipImagineThumbnail',
            'sonata.media.pool.class' => 'Sonata\\MediaBundle\\Provider\\Pool',
            'sonata.media.resizer.simple.class' => 'Sonata\\MediaBundle\\Resizer\\SimpleResizer',
            'sonata.media.resizer.square.class' => 'Sonata\\MediaBundle\\Resizer\\SquareResizer',
            'sonata.media.block.media.class' => 'Sonata\\MediaBundle\\Block\\MediaBlockService',
            'sonata.media.block.feature_media.class' => 'Sonata\\MediaBundle\\Block\\FeatureMediaBlockService',
            'sonata.media.block.gallery.class' => 'Sonata\\MediaBundle\\Block\\GalleryBlockService',
            'sonata.media.metadata.proxy.class' => 'Sonata\\MediaBundle\\Metadata\\ProxyMetadataBuilder',
            'sonata.media.metadata.amazon.class' => 'Sonata\\MediaBundle\\Metadata\\AmazonMetadataBuilder',
            'sonata.media.metadata.noop.class' => 'Sonata\\MediaBundle\\Metadata\\NoopMetadataBuilder',
            'sonata.media.adapater.filesystem.opencloud.class' => '',
            'sonata.media.block.breadcrumb_view.class' => 'Sonata\\MediaBundle\\Block\\Breadcrumb\\GalleryViewBreadcrumbBlockService',
            'sonata.media.block.breadcrumb_index.class' => 'Sonata\\MediaBundle\\Block\\Breadcrumb\\GalleryIndexBreadcrumbBlockService',
            'sonata.media.block.breadcrumb_media.class' => 'Sonata\\MediaBundle\\Block\\Breadcrumb\\MediaViewBreadcrumbBlockService',
            'sonata.media.manager.media.class' => 'Sonata\\MediaBundle\\Entity\\MediaManager',
            'sonata.media.manager.gallery.class' => 'Sonata\\MediaBundle\\Entity\\GalleryManager',
            'sonata.media.admin.media.class' => 'Sonata\\MediaBundle\\Admin\\ORM\\MediaAdmin',
            'sonata.media.admin.media.controller' => 'SonataMediaBundle:MediaAdmin',
            'sonata.media.admin.media.translation_domain' => 'SonataMediaBundle',
            'sonata.media.admin.gallery.class' => 'Sonata\\MediaBundle\\Admin\\GalleryAdmin',
            'sonata.media.admin.gallery.controller' => 'SonataMediaBundle:GalleryAdmin',
            'sonata.media.admin.gallery.translation_domain' => 'SonataMediaBundle',
            'sonata.media.admin.gallery_has_media.class' => 'Sonata\\MediaBundle\\Admin\\GalleryHasMediaAdmin',
            'sonata.media.admin.gallery_has_media.controller' => 'SonataAdminBundle:CRUD',
            'sonata.media.admin.gallery_has_media.translation_domain' => 'SonataMediaBundle',
            'sonata.media.resizer.simple.adapter.mode' => 'inset',
            'sonata.media.resizer.square.adapter.mode' => 'inset',
            'sonata.media.admin.media.entity' => 'Application\\Sonata\\MediaBundle\\Entity\\Media',
            'sonata.media.admin.gallery.entity' => 'Application\\Sonata\\MediaBundle\\Entity\\Gallery',
            'sonata.media.admin.gallery_has_media.entity' => 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia',
            'sonata.media.media.class' => 'Application\\Sonata\\MediaBundle\\Entity\\Media',
            'sonata.media.gallery.class' => 'Application\\Sonata\\MediaBundle\\Entity\\Gallery',
            'ivory_ck_editor.form.type.class' => 'Ivory\\CKEditorBundle\\Form\\Type\\CKEditorType',
            'ivory_ck_editor.config_manager.class' => 'Ivory\\CKEditorBundle\\Model\\ConfigManager',
            'ivory_ck_editor.plugin_manager.class' => 'Ivory\\CKEditorBundle\\Model\\PluginManager',
            'ivory_ck_editor.styles_set_manager.class' => 'Ivory\\CKEditorBundle\\Model\\StylesSetManager',
            'ivory_ck_editor.template_manager.class' => 'Ivory\\CKEditorBundle\\Model\\TemplateManager',
            'ivory_ck_editor.templating.helper.class' => 'Ivory\\CKEditorBundle\\Templating\\CKEditorHelper',
            'ivory_ck_editor.twig_extension.class' => 'Ivory\\CKEditorBundle\\Twig\\CKEditorExtension',
            'ivory_ck_editor.form.type.enable' => true,
            'ivory_ck_editor.form.type.autoload' => true,
            'ivory_ck_editor.form.type.base_path' => 'bundles/ivoryckeditor/',
            'ivory_ck_editor.form.type.js_path' => 'bundles/ivoryckeditor/ckeditor.js',
            'sonata.admin.configuration.templates' => array(
                'history_revision_timestamp' => 'SonataIntlBundle:CRUD:history_revision_timestamp.html.twig',
                'user_block' => 'SonataUserBundle:Admin/Core:user_block.html.twig',
                'layout' => 'SonataAdminBundle::standard_layout.html.twig',
                'ajax' => 'SonataAdminBundle::ajax_layout.html.twig',
                'list' => 'SonataAdminBundle:CRUD:list.html.twig',
                'show' => 'SonataAdminBundle:CRUD:show.html.twig',
                'edit' => 'SonataAdminBundle:CRUD:edit.html.twig',
                'add_block' => 'SonataAdminBundle:Core:add_block.html.twig',
                'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig',
                'search' => 'SonataAdminBundle:Core:search.html.twig',
                'filter' => 'SonataAdminBundle:Form:filter_admin_fields.html.twig',
                'show_compare' => 'SonataAdminBundle:CRUD:show_compare.html.twig',
                'preview' => 'SonataAdminBundle:CRUD:preview.html.twig',
                'history' => 'SonataAdminBundle:CRUD:history.html.twig',
                'acl' => 'SonataAdminBundle:CRUD:acl.html.twig',
                'action' => 'SonataAdminBundle:CRUD:action.html.twig',
                'select' => 'SonataAdminBundle:CRUD:list__select.html.twig',
                'list_block' => 'SonataAdminBundle:Block:block_admin_list.html.twig',
                'search_result_block' => 'SonataAdminBundle:Block:block_search_result.html.twig',
                'short_object_description' => 'SonataAdminBundle:Helper:short-object-description.html.twig',
                'delete' => 'SonataAdminBundle:CRUD:delete.html.twig',
                'batch' => 'SonataAdminBundle:CRUD:list__batch.html.twig',
                'batch_confirmation' => 'SonataAdminBundle:CRUD:batch_confirmation.html.twig',
                'inner_list_row' => 'SonataAdminBundle:CRUD:list_inner_row.html.twig',
                'base_list_field' => 'SonataAdminBundle:CRUD:base_list_field.html.twig',
                'pager_links' => 'SonataAdminBundle:Pager:links.html.twig',
                'pager_results' => 'SonataAdminBundle:Pager:results.html.twig',
                'tab_menu_template' => 'SonataAdminBundle:Core:tab_menu_template.html.twig',
            ),
            'sonata.admin.configuration.admin_services' => array(
            ),
            'sonata.admin.configuration.dashboard_groups' => array(
                'sonata.admin.group.content' => array(
                    'label' => 'sonata_content',
                    'label_catalogue' => 'SonataDemoBundle',
                    'icon' => '<i class="fa fa-th"></i>',
                    'items' => array(
                        0 => 'sonata.news.admin.comment',
                        1 => 'sonata.news.admin.post',
                        2 => 'sonata.media.admin.media',
                        3 => 'sonata.media.admin.gallery',
                        4 => 'sonata.comment.admin.thread',
                    ),
                    'item_adds' => array(
                    ),
                    'roles' => array(
                    ),
                ),
                'sonata.admin.group.ecommerce' => array(
                    'label' => 'sonata_ecommerce',
                    'label_catalogue' => 'SonataAdminBundle',
                    'icon' => '<i class="fa fa-dollar"></i>',
                    'items' => array(
                        0 => 'sonata.customer.admin.customer',
                        1 => 'sonata.invoice.admin.invoice',
                        2 => 'sonata.order.admin.order',
                        3 => 'sonata.product.admin.product',
                    ),
                    'item_adds' => array(
                    ),
                    'roles' => array(
                    ),
                ),
                'sonata.admin.group.classification' => array(
                    'label' => 'sonata_classification',
                    'label_catalogue' => 'SonataClassificationBundle',
                    'icon' => '<i class="fa fa-sitemap"></i>',
                    'items' => array(
                        0 => 'sonata.classification.admin.category',
                        1 => 'sonata.classification.admin.tag',
                        2 => 'sonata.classification.admin.collection',
                    ),
                    'item_adds' => array(
                    ),
                    'roles' => array(
                    ),
                ),
                'sonata.admin.group.site_builder' => array(
                    'label' => 'Site Builder',
                    'label_catalogue' => 'SonataDemoBundle',
                    'icon' => '<i class="fa fa-puzzle-piece"></i>',
                    'items' => array(
                        0 => 'sonata.page.admin.page',
                        1 => 'sonata.page.admin.site',
                    ),
                    'item_adds' => array(
                    ),
                    'roles' => array(
                    ),
                ),
                'sonata.admin.group.administration' => array(
                    'label' => 'sonata_administration',
                    'label_catalogue' => 'SonataAdminBundle',
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'items' => array(
                        0 => 'sonata.user.admin.user',
                        1 => 'sonata.user.admin.group',
                        2 => 'sonata.page.admin.site',
                        3 => 'sonata.notification.admin.message',
                    ),
                    'item_adds' => array(
                    ),
                    'roles' => array(
                    ),
                ),
                'sonata.admin.group.demo' => array(
                    'label' => 'Demo',
                    'icon' => '<i class="fa fa-play-circle"></i>',
                    'items' => array(
                        0 => 'sonata.demo.admin.car',
                        1 => 'sonata.demo.admin.engine',
                        2 => 'sonata.demo.admin.color',
                        3 => 'sonata.demo.admin.material',
                    ),
                    'item_adds' => array(
                    ),
                    'roles' => array(
                    ),
                ),
            ),
            'sonata.admin.configuration.dashboard_blocks' => array(
                0 => array(
                    'position' => 'left',
                    'type' => 'sonata.block.service.text',
                    'settings' => array(
                        'content' => '<div class=\'panel panel-default\'><div class=\'panel-heading\'><h3 class=\'panel-title\'>Welcome!</h3></div><div class=\'panel-body\'>You can customize this dashboard by editing the <code>sonata_admin.yml</code> file. The current dashboard presents the recent items from the NewsBundle and a non-statistical e-commerce information.</div></div>',
                    ),
                    'class' => 'col-md-4',
                ),
                1 => array(
                    'position' => 'left',
                    'type' => 'sonata.news.block.recent_posts',
                    'settings' => array(
                        'title' => 'Recent Posts',
                        'number' => 7,
                        'mode' => 'admin',
                    ),
                    'class' => 'col-md-4',
                ),
                2 => array(
                    'position' => 'left',
                    'type' => 'sonata.news.block.recent_comments',
                    'settings' => array(
                        'title' => 'Recent Comments',
                        'number' => 7,
                        'mode' => 'admin',
                    ),
                    'class' => 'col-md-4',
                ),
                3 => array(
                    'position' => 'right',
                    'type' => 'sonata.order.block.recent_orders',
                    'settings' => array(
                        'title' => 'Recent Orders',
                        'number' => 5,
                        'mode' => 'admin',
                    ),
                    'class' => 'col-md-4',
                ),
                4 => array(
                    'position' => 'right',
                    'type' => 'sonata.customer.block.recent_customers',
                    'settings' => array(
                        'title' => 'Recent Customers',
                        'number' => 5,
                        'mode' => 'admin',
                    ),
                    'class' => 'col-md-4',
                ),
                5 => array(
                    'position' => 'right',
                    'type' => 'sonata.block.service.rss',
                    'settings' => array(
                        'title' => 'Sonata Project\'s Feeds',
                        'url' => 'http://sonata-project.org/blog/archive.rss',
                        'template' => 'SonataAdminBundle:Block:block_rss_dashboard.html.twig',
                    ),
                    'class' => 'col-md-4',
                ),
            ),
            'sonata.admin.security.acl_user_manager' => 'fos_user.user_manager',
            'sonata.admin.configuration.security.information' => array(
                'GUEST' => array(
                    0 => 'VIEW',
                    1 => 'LIST',
                ),
                'STAFF' => array(
                    0 => 'EDIT',
                    1 => 'LIST',
                    2 => 'CREATE',
                ),
                'EDITOR' => array(
                    0 => 'OPERATOR',
                    1 => 'EXPORT',
                ),
                'ADMIN' => array(
                    0 => 'MASTER',
                ),
            ),
            'sonata.admin.configuration.security.admin_permissions' => array(
                0 => 'CREATE',
                1 => 'LIST',
                2 => 'DELETE',
                3 => 'UNDELETE',
                4 => 'EXPORT',
                5 => 'OPERATOR',
                6 => 'MASTER',
            ),
            'sonata.admin.configuration.security.object_permissions' => array(
                0 => 'VIEW',
                1 => 'EDIT',
                2 => 'DELETE',
                3 => 'UNDELETE',
                4 => 'OPERATOR',
                5 => 'MASTER',
                6 => 'OWNER',
            ),
            'sonata.admin.security.handler.noop.class' => 'Sonata\\AdminBundle\\Security\\Handler\\NoopSecurityHandler',
            'sonata.admin.security.handler.role.class' => 'Sonata\\AdminBundle\\Security\\Handler\\RoleSecurityHandler',
            'sonata.admin.security.handler.acl.class' => 'Sonata\\AdminBundle\\Security\\Handler\\AclSecurityHandler',
            'sonata.admin.security.mask.builder.class' => 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder',
            'sonata.admin.manipulator.acl.admin.class' => 'Sonata\\AdminBundle\\Util\\AdminAclManipulator',
            'sonata.admin.object.manipulator.acl.admin.class' => 'Sonata\\AdminBundle\\Util\\AdminObjectAclManipulator',
            'sonata.admin.extension.map' => array(
                'admins' => array(
                ),
                'excludes' => array(
                ),
                'implements' => array(
                ),
                'extends' => array(
                ),
                'instanceof' => array(
                ),
            ),
            'sonata.admin.configuration.filters.persist' => false,
            'sonata_doctrine_orm_admin.audit.force' => true,
            'sonata.admin.manipulator.acl.object.orm.class' => 'Sonata\\DoctrineORMAdminBundle\\Util\\ObjectAclManipulator',
            'sonata_doctrine_orm_admin.entity_manager' => NULL,
            'sonata_doctrine_orm_admin.templates' => array(
                'types' => array(
                    'list' => array(
                        'array' => 'SonataAdminBundle:CRUD:list_array.html.twig',
                        'boolean' => 'SonataAdminBundle:CRUD:list_boolean.html.twig',
                        'date' => 'SonataIntlBundle:CRUD:list_date.html.twig',
                        'time' => 'SonataAdminBundle:CRUD:list_time.html.twig',
                        'datetime' => 'SonataIntlBundle:CRUD:list_datetime.html.twig',
                        'text' => 'SonataAdminBundle:CRUD:list_string.html.twig',
                        'textarea' => 'SonataAdminBundle:CRUD:list_string.html.twig',
                        'email' => 'SonataAdminBundle:CRUD:list_string.html.twig',
                        'trans' => 'SonataAdminBundle:CRUD:list_trans.html.twig',
                        'string' => 'SonataAdminBundle:CRUD:list_string.html.twig',
                        'smallint' => 'SonataIntlBundle:CRUD:list_decimal.html.twig',
                        'bigint' => 'SonataIntlBundle:CRUD:list_decimal.html.twig',
                        'integer' => 'SonataIntlBundle:CRUD:list_decimal.html.twig',
                        'decimal' => 'SonataIntlBundle:CRUD:list_decimal.html.twig',
                        'identifier' => 'SonataAdminBundle:CRUD:list_string.html.twig',
                        'currency' => 'SonataIntlBundle:CRUD:list_currency.html.twig',
                        'percent' => 'SonataIntlBundle:CRUD:list_percent.html.twig',
                        'choice' => 'SonataAdminBundle:CRUD:list_choice.html.twig',
                        'url' => 'SonataAdminBundle:CRUD:list_url.html.twig',
                        'html' => 'SonataAdminBundle:CRUD:list_html.html.twig',
                    ),
                    'show' => array(
                        'array' => 'SonataAdminBundle:CRUD:show_array.html.twig',
                        'boolean' => 'SonataAdminBundle:CRUD:show_boolean.html.twig',
                        'date' => 'SonataIntlBundle:CRUD:show_date.html.twig',
                        'time' => 'SonataAdminBundle:CRUD:show_time.html.twig',
                        'datetime' => 'SonataIntlBundle:CRUD:show_datetime.html.twig',
                        'text' => 'SonataAdminBundle:CRUD:base_show_field.html.twig',
                        'trans' => 'SonataAdminBundle:CRUD:show_trans.html.twig',
                        'string' => 'SonataAdminBundle:CRUD:base_show_field.html.twig',
                        'smallint' => 'SonataIntlBundle:CRUD:show_decimal.html.twig',
                        'bigint' => 'SonataIntlBundle:CRUD:show_decimal.html.twig',
                        'integer' => 'SonataIntlBundle:CRUD:show_decimal.html.twig',
                        'decimal' => 'SonataIntlBundle:CRUD:show_decimal.html.twig',
                        'currency' => 'SonataIntlBundle:CRUD:show_currency.html.twig',
                        'percent' => 'SonataIntlBundle:CRUD:show_percent.html.twig',
                        'choice' => 'SonataAdminBundle:CRUD:show_choice.html.twig',
                        'url' => 'SonataAdminBundle:CRUD:show_url.html.twig',
                        'html' => 'SonataAdminBundle:CRUD:show_html.html.twig',
                    ),
                ),
                'form' => array(
                    0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig',
                ),
                'filter' => array(
                    0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig',
                ),
            ),
            'simplethings.entityaudit.audited_entities' => array(
                0 => 'Application\\Sonata\\UserBundle\\Entity\\User',
                1 => 'Application\\Sonata\\UserBundle\\Entity\\Group',
                2 => 'Application\\Sonata\\PageBundle\\Entity\\Page',
                3 => 'Application\\Sonata\\PageBundle\\Entity\\Block',
                5 => 'Application\\Sonata\\PageBundle\\Entity\\Snapshot',
                6 => 'Application\\Sonata\\PageBundle\\Entity\\Site',
                7 => 'Application\\Sonata\\NewsBundle\\Entity\\Post',
                8 => 'Application\\Sonata\\NewsBundle\\Entity\\Comment',
                9 => 'Application\\Sonata\\MediaBundle\\Entity\\Media',
                10 => 'Application\\Sonata\\MediaBundle\\Entity\\Gallery',
                11 => 'Application\\Sonata\\MediaBundle\\Entity\\GalleryHasMedia',
                12 => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer',
                13 => 'Application\\Sonata\\CustomerBundle\\Entity\\Address',
                14 => 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice',
                15 => 'Application\\Sonata\\OrderBundle\\Entity\\Order',
                16 => 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement',
                17 => 'Application\\Sonata\\ProductBundle\\Entity\\Product',
                19 => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory',
                20 => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection',
                21 => 'Application\\Sonata\\ProductBundle\\Entity\\Delivery',
                22 => 'Application\\Sonata\\CommentBundle\\Entity\\Comment',
                23 => 'Application\\Sonata\\CommentBundle\\Entity\\Thread',
                24 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category',
                25 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag',
                26 => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection',
                27 => 'Application\\Sonata\\NotificationBundle\\Entity\\Message',
                28 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Car',
                29 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Engine',
                30 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Inspection',
                31 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Color',
                32 => 'Sonata\\Bundle\\DemoBundle\\Entity\\Material',
            ),
            'simplethings.entityaudit.global_ignore_columns' => array(
            ),
            'simplethings.entityaudit.table_prefix' => '',
            'simplethings.entityaudit.table_suffix' => '_audit',
            'simplethings.entityaudit.revision_field_name' => 'rev',
            'simplethings.entityaudit.revision_type_field_name' => 'revtype',
            'simplethings.entityaudit.revision_table_name' => 'revisions',
            'simplethings.entityaudit.revision_id_field_type' => 'integer',
            'simplethings_entityaudit.request.current_user_listener.class' => 'SimpleThings\\EntityAudit\\Request\\CurrentUserListener',
            'fos_rest.serializer.exclusion_strategy.version' => '',
            'fos_rest.serializer.exclusion_strategy.groups' => '',
            'fos_rest.view_handler.jsonp.callback_param' => '',
            'fos_rest.view.exception_wrapper_handler' => 'FOS\\RestBundle\\View\\ExceptionWrapperHandler',
            'fos_rest.view_handler.default.class' => 'FOS\\RestBundle\\View\\ViewHandler',
            'fos_rest.view_handler.jsonp.class' => 'FOS\\RestBundle\\View\\JsonpHandler',
            'fos_rest.serializer.exception_wrapper_serialize_handler.class' => 'FOS\\RestBundle\\Serializer\\ExceptionWrapperSerializeHandler',
            'fos_rest.routing.loader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteLoader',
            'fos_rest.routing.loader.yaml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestYamlCollectionLoader',
            'fos_rest.routing.loader.xml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestXmlCollectionLoader',
            'fos_rest.routing.loader.processor.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteProcessor',
            'fos_rest.routing.loader.reader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestControllerReader',
            'fos_rest.routing.loader.reader.action.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestActionReader',
            'fos_rest.format_negotiator.class' => 'FOS\\RestBundle\\Util\\FormatNegotiator',
            'fos_rest.inflector.class' => 'FOS\\RestBundle\\Util\\Inflector\\DoctrineInflector',
            'fos_rest.request_matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'fos_rest.violation_formatter.class' => 'FOS\\RestBundle\\Util\\ViolationFormatter',
            'fos_rest.request.param_fetcher.class' => 'FOS\\RestBundle\\Request\\ParamFetcher',
            'fos_rest.request.param_fetcher.reader.class' => 'FOS\\RestBundle\\Request\\ParamReader',
            'fos_rest.cache_dir' => (__DIR__.'/fos_rest'),
            'fos_rest.serializer.serialize_null' => false,
            'fos_rest.formats' => array(
                'json' => false,
                'xml' => false,
                'html' => true,
            ),
            'fos_rest.default_engine' => 'twig',
            'fos_rest.force_redirects' => array(
                'html' => 302,
            ),
            'fos_rest.failed_validation' => 400,
            'fos_rest.empty_content' => 204,
            'fos_rest.serialize_null' => false,
            'fos_rest.view_response_listener.class' => 'FOS\\RestBundle\\EventListener\\ViewResponseListener',
            'fos_rest.view_response_listener.force_view' => true,
            'fos_rest.routing.loader.default_format' => NULL,
            'fos_rest.routing.loader.include_format' => true,
            'fos_rest.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'fos_rest.controller.exception.class' => 'FOS\\RestBundle\\Controller\\ExceptionController',
            'fos_rest.exception_listener.controller' => 'fos_rest.controller.exception:showAction',
            'fos_rest.exception.codes' => array(
            ),
            'fos_rest.exception.messages' => array(
                'Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException' => true,
            ),
            'fos_rest.normalizer.camel_keys.class' => 'FOS\\RestBundle\\Normalizer\\CamelKeysNormalizer',
            'fos_rest.decoder.json.class' => 'FOS\\RestBundle\\Decoder\\JsonDecoder',
            'fos_rest.decoder.jsontoform.class' => 'FOS\\RestBundle\\Decoder\\JsonToFormDecoder',
            'fos_rest.decoder.xml.class' => 'FOS\\RestBundle\\Decoder\\XmlDecoder',
            'fos_rest.decoder_provider.class' => 'FOS\\RestBundle\\Decoder\\ContainerDecoderProvider',
            'fos_rest.body_listener.class' => 'FOS\\RestBundle\\EventListener\\BodyListener',
            'fos_rest.throw_exception_on_unsupported_content_type' => false,
            'fos_rest.body_default_format' => NULL,
            'fos_rest.decoders' => array(
                'json' => 'fos_rest.decoder.json',
                'xml' => 'fos_rest.decoder.xml',
            ),
            'fos_rest.mime_types' => array(
            ),
            'fos_rest.param_fetcher_listener.class' => 'FOS\\RestBundle\\EventListener\\ParamFetcherListener',
            'fos_rest.param_fetcher_listener.set_params_as_attributes' => false,
            'fos_rest.converter.request_body.validation_errors_argument' => 'validationErrors',
            'nelmio_api_doc.motd.template' => 'NelmioApiDocBundle::Components/motd.html.twig',
            'nelmio_api_doc.exclude_sections' => array(
            ),
            'nelmio_api_doc.default_sections_opened' => true,
            'nelmio_api_doc.api_name' => 'API documentation',
            'nelmio_api_doc.sandbox.enabled' => true,
            'nelmio_api_doc.sandbox.endpoint' => NULL,
            'nelmio_api_doc.sandbox.accept_type' => NULL,
            'nelmio_api_doc.sandbox.body_format.formats' => array(
                0 => 'form',
                1 => 'json',
            ),
            'nelmio_api_doc.sandbox.body_format.default_format' => 'form',
            'nelmio_api_doc.sandbox.request_format.method' => 'format_param',
            'nelmio_api_doc.sandbox.request_format.default_format' => 'json',
            'nelmio_api_doc.sandbox.request_format.formats' => array(
                'json' => 'application/json',
                'xml' => 'application/xml',
            ),
            'nelmio_api_doc.formatter.abstract_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\AbstractFormatter',
            'nelmio_api_doc.formatter.markdown_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\MarkdownFormatter',
            'nelmio_api_doc.formatter.simple_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\SimpleFormatter',
            'nelmio_api_doc.formatter.html_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\HtmlFormatter',
            'nelmio_api_doc.formatter.swagger_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\SwaggerFormatter',
            'nelmio_api_doc.sandbox.authentication' => NULL,
            'nelmio_api_doc.extractor.api_doc_extractor.class' => 'Nelmio\\ApiDocBundle\\Extractor\\ApiDocExtractor',
            'nelmio_api_doc.form.extension.description_form_type_extension.class' => 'Nelmio\\ApiDocBundle\\Form\\Extension\\DescriptionFormTypeExtension',
            'nelmio_api_doc.twig.extension.extra_markdown.class' => 'Nelmio\\ApiDocBundle\\Twig\\Extension\\MarkdownExtension',
            'nelmio_api_doc.doc_comment_extractor.class' => 'Nelmio\\ApiDocBundle\\Util\\DocCommentExtractor',
            'nelmio_api_doc.extractor.handler.fos_rest.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\FosRestHandler',
            'nelmio_api_doc.extractor.handler.jms_security.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\JmsSecurityExtraHandler',
            'nelmio_api_doc.extractor.handler.sensio_framework_extra.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\SensioFrameworkExtraHandler',
            'nelmio_api_doc.extractor.handler.phpdoc.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\PhpDocHandler',
            'nelmio_api_doc.parser.collection_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\CollectionParser',
            'nelmio_api_doc.parser.form_errors_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\FormErrorsParser',
            'nelmio_api_doc.request_listener.parameter' => '_doc',
            'nelmio_api_doc.event_listener.request.class' => 'Nelmio\\ApiDocBundle\\EventListener\\RequestListener',
            'nelmio_api_doc.swagger.base_path' => '/api',
            'nelmio_api_doc.swagger.swagger_version' => '1.2',
            'nelmio_api_doc.swagger.api_version' => '0.1',
            'nelmio_api_doc.swagger.info' => array(
                'title' => 'Symfony2',
                'description' => 'My awesome Symfony2 app!',
                'TermsOfServiceUrl' => NULL,
                'contact' => NULL,
                'license' => NULL,
                'licenseUrl' => NULL,
            ),
            'nelmio_api_doc.swagger.model_naming_strategy' => 'dot_notation',
            'sonata.customer.selector.class' => 'Sonata\\Component\\Customer\\CustomerSelector',
            'sonata.basket.basket.class' => 'Application\\Sonata\\BasketBundle\\Entity\\Basket',
            'sonata.basket.basket_element.class' => 'Application\\Sonata\\BasketBundle\\Entity\\BasketElement',
            'sonata.address.manager.class' => 'Sonata\\CustomerBundle\\Entity\\AddressManager',
            'sonata.customer.manager.class' => 'Sonata\\CustomerBundle\\Entity\\CustomerManager',
            'sonata.customer.admin.customer.class' => 'Sonata\\CustomerBundle\\Admin\\CustomerAdmin',
            'sonata.customer.admin.customer.controller' => 'SonataAdminBundle:CRUD',
            'sonata.customer.admin.address.class' => 'Sonata\\CustomerBundle\\Admin\\AddressAdmin',
            'sonata.customer.admin.address.controller' => 'SonataAdminBundle:CRUD',
            'sonata.customer.block.breadcrumb_address.class' => 'Sonata\\CustomerBundle\\Block\\Breadcrumb\\CustomerAddressBreadcrumbBlockService',
            'sonata.customer.customer.class' => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer',
            'sonata.customer.address.class' => 'Application\\Sonata\\CustomerBundle\\Entity\\Address',
            'sonata.customer.admin.customer.entity' => 'Application\\Sonata\\CustomerBundle\\Entity\\Customer',
            'sonata.customer.admin.address.entity' => 'Application\\Sonata\\CustomerBundle\\Entity\\Address',
            'sonata.delivery.selector.class' => 'Sonata\\Component\\Delivery\\Selector',
            'sonata.delivery.pool.class' => 'Sonata\\Component\\Delivery\\Pool',
            'sonata.invoice.manager.class' => 'Sonata\\InvoiceBundle\\Entity\\InvoiceManager',
            'sonata.invoice_element.manager.class' => 'Sonata\\InvoiceBundle\\Entity\\InvoiceElementManager',
            'sonata.invoice.admin.invoice.class' => 'Sonata\\InvoiceBundle\\Admin\\InvoiceAdmin',
            'sonata.invoice.invoice.class' => 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice',
            'sonata.invoice.invoice_element.class' => 'Application\\Sonata\\InvoiceBundle\\Entity\\InvoiceElement',
            'sonata.invoice.admin.invoice.entity' => 'Application\\Sonata\\InvoiceBundle\\Entity\\Invoice',
            'sonata.invoice.admin.invoice_element.entity' => 'Application\\Sonata\\InvoiceBundle\\Entity\\InvoiceElement',
            'sonata.order.order.manager.class' => 'Sonata\\OrderBundle\\Entity\\OrderManager',
            'sonata.order.order_element.manager.class' => 'Sonata\\OrderBundle\\Entity\\OrderElementManager',
            'sonata.order.admin.order.class' => 'Sonata\\OrderBundle\\Admin\\OrderAdmin',
            'sonata.order.admin.order.controller' => 'SonataOrderBundle:OrderCRUD',
            'sonata.order.admin.order_element.class' => 'Sonata\\OrderBundle\\Admin\\OrderElementAdmin',
            'sonata.order.admin.order_element.controller' => 'SonataAdminBundle:CRUD',
            'sonata.order.block.breadcrumb_order.class' => 'Sonata\\OrderBundle\\Block\\Breadcrumb\\UserOrderBreadcrumbBlockService',
            'sonata.order.order.class' => 'Application\\Sonata\\OrderBundle\\Entity\\Order',
            'sonata.order.order_element.class' => 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement',
            'sonata.order.admin.order.entity' => 'Application\\Sonata\\OrderBundle\\Entity\\Order',
            'sonata.order.admin.order_element.entity' => 'Application\\Sonata\\OrderBundle\\Entity\\OrderElement',
            'sonata.payment.consumer.order_process.class' => 'Sonata\\PaymentBundle\\Consumer\\PaymentProcessOrderConsumer',
            'sonata.payment.consumer.order_element_process.class' => 'Sonata\\PaymentBundle\\Consumer\\PaymentProcessOrderElementConsumer',
            'sonata.transaction.manager.class' => 'Sonata\\PaymentBundle\\Entity\\TransactionManager',
            'sonata.payment.pool.class' => 'Sonata\\Component\\Payment\\Pool',
            'sonata.payment.handler.class' => 'Sonata\\Component\\Payment\\PaymentHandler',
            'sonata.payment.method.paypal.class' => 'Sonata\\Component\\Payment\\Paypal',
            'sonata.payment.method.check.class' => 'Sonata\\Component\\Payment\\CheckPayment',
            'sonata.payment.method.pass.class' => 'Sonata\\Component\\Payment\\PassPayment',
            'sonata.payment.method.scellius.class' => 'Sonata\\Component\\Payment\\Scellius\\ScelliusPayment',
            'sonata.payment.provider.scellius.none_generator.class' => 'Sonata\\Component\\Payment\\Scellius\\NodeScelliusTransactionGenerator',
            'sonata.payment.provider.scellius.order_generator.class' => 'Sonata\\Component\\Payment\\Scellius\\OrderScelliusTransactionGenerator',
            'sonata.payment.method.debug.class' => 'Sonata\\Component\\Payment\\Debug\\DebugPayment',
            'sonata.payment.method.ogone.class' => 'Sonata\\Component\\Payment\\Ogone\\OgonePayment',
            'sonata.payment.generator.mysql.class' => 'Sonata\\Component\\Generator\\MysqlReference',
            'sonata.basket_transformer.class' => 'Sonata\\Component\\Transformer\\BasketTransformer',
            'sonata.invoice_transformer.class' => 'Sonata\\Component\\Transformer\\InvoiceTransformer',
            'sonata.payment.transaction.class' => 'Application\\Sonata\\PaymentBundle\\Entity\\Transaction',
            'sonata.product.pool.class' => 'Sonata\\Component\\Product\\Pool',
            'sonata.product.subscriber.orm.class' => 'Sonata\\Component\\Subscriber\\ORMInheritanceSubscriber',
            'sonata.product.seo_iterator.class' => 'Sonata\\Component\\Product\\SeoProductIterator',
            'sonata.product.finder.class' => 'Sonata\\Component\\Product\\ProductFinder',
            'sonata.product.seo.twitter.class' => 'Sonata\\ProductBundle\\Seo\\Services\\Twitter',
            'sonata.product.seo.product.site' => '@sonataproject',
            'sonata.product.seo.product.creator' => '@th0masr',
            'sonata.product.seo.product.domain' => 'http://demo.sonata-project.org',
            'sonata.product.seo.product.media_prefix' => 'http://demo.sonata-project.org',
            'sonata.product.seo.product.media_format' => 'reference',
            'sonata.product.seo.facebook.class' => 'Sonata\\ProductBundle\\Seo\\Services\\Facebook',
            'sonata.delivery.manager.class' => 'Sonata\\ProductBundle\\Entity\\DeliveryManager',
            'sonata.package.manager.class' => 'Sonata\\ProductBundle\\Entity\\PackageManager',
            'sonata.product.set.manager.class' => 'Sonata\\ProductBundle\\Entity\\ProductSetManager',
            'sonata.product_category.manager.class' => 'Sonata\\ProductBundle\\Entity\\ProductCategoryManager',
            'sonata.product_collection.manager.class' => 'Sonata\\ProductBundle\\Entity\\ProductCollectionManager',
            'sonata.product.admin.product.class' => 'Sonata\\ProductBundle\\Admin\\ProductAdmin',
            'sonata.product.admin.product.controller' => 'SonataProductBundle:ProductAdmin',
            'sonata.product.admin.product.variation.class' => 'Sonata\\ProductBundle\\Admin\\ProductVariationAdmin',
            'sonata.product.admin.product.variation.controller' => 'SonataProductBundle:ProductVariationAdmin',
            'sonata.product.admin.product_category.class' => 'Sonata\\ProductBundle\\Admin\\ProductCategoryAdmin',
            'sonata.product.admin.product_category.controller' => 'SonataAdminBundle:CRUD',
            'sonata.product.admin.product_collection.class' => 'Sonata\\ProductBundle\\Admin\\ProductCollectionAdmin',
            'sonata.product.admin.product_collection.controller' => 'SonataAdminBundle:CRUD',
            'sonata.product.admin.delivery.class' => 'Sonata\\ProductBundle\\Admin\\DeliveryAdmin',
            'sonata.product.admin.delivery.controller' => 'SonataAdminBundle:CRUD',
            'sonata.product.admin.product.manager' => 'Sonata\\ProductBundle\\Model\\DoctrineModelManager',
            'sonata.product.product.class' => 'Application\\Sonata\\ProductBundle\\Entity\\Product',
            'sonata.product.package.class' => 'Application\\Sonata\\ProductBundle\\Entity\\Package',
            'sonata.product.product_category.class' => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory',
            'sonata.product.product_collection.class' => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection',
            'sonata.product.category.class' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category',
            'sonata.product.collection.class' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection',
            'sonata.product.delivery.class' => 'Application\\Sonata\\ProductBundle\\Entity\\Delivery',
            'sonata.product.admin.product.entity' => 'Application\\Sonata\\ProductBundle\\Entity\\Product',
            'sonata.product.admin.package.entity' => 'Application\\Sonata\\ProductBundle\\Entity\\Package',
            'sonata.product.admin.product_category.entity' => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCategory',
            'sonata.product.admin.product_collection.entity' => 'Application\\Sonata\\ProductBundle\\Entity\\ProductCollection',
            'sonata.product.admin.category.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category',
            'sonata.product.admin.collection.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection',
            'sonata.product.admin.delivery.entity' => 'Application\\Sonata\\ProductBundle\\Entity\\Delivery',
            'sonata.price.currency.detector.class' => 'Sonata\\Component\\Currency\\CurrencyDetector',
            'sonata.price.currency.manager.class' => 'Sonata\\Component\\Currency\\CurrencyManager',
            'sonata.price.currency.calculator.class' => 'Sonata\\Component\\Currency\\CurrencyPriceCalculator',
            'sonata.price.currency.data_transformer.class' => 'Sonata\\Component\\Currency\\CurrencyDataTransformer',
            'sonata.price.currency.form_type.class' => 'Sonata\\Component\\Currency\\CurrencyFormType',
            'sonata.price.currency' => 'EUR',
            'sonata.price.precision' => 3,
            'jms_serializer.metadata.file_locator.class' => 'Metadata\\Driver\\FileLocator',
            'jms_serializer.metadata.annotation_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\AnnotationDriver',
            'jms_serializer.metadata.chain_driver.class' => 'Metadata\\Driver\\DriverChain',
            'jms_serializer.metadata.yaml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\YamlDriver',
            'jms_serializer.metadata.xml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\XmlDriver',
            'jms_serializer.metadata.php_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\PhpDriver',
            'jms_serializer.metadata.doctrine_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrineTypeDriver',
            'jms_serializer.metadata.doctrine_phpcr_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrinePHPCRTypeDriver',
            'jms_serializer.metadata.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'jms_serializer.metadata.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'jms_serializer.metadata.cache.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'jms_serializer.event_dispatcher.class' => 'JMS\\Serializer\\EventDispatcher\\LazyEventDispatcher',
            'jms_serializer.camel_case_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CamelCaseNamingStrategy',
            'jms_serializer.serialized_name_annotation_strategy.class' => 'JMS\\Serializer\\Naming\\SerializedNameAnnotationStrategy',
            'jms_serializer.cache_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CacheNamingStrategy',
            'jms_serializer.doctrine_object_constructor.class' => 'JMS\\Serializer\\Construction\\DoctrineObjectConstructor',
            'jms_serializer.unserialize_object_constructor.class' => 'JMS\\Serializer\\Construction\\UnserializeObjectConstructor',
            'jms_serializer.version_exclusion_strategy.class' => 'JMS\\Serializer\\Exclusion\\VersionExclusionStrategy',
            'jms_serializer.serializer.class' => 'JMS\\Serializer\\Serializer',
            'jms_serializer.twig_extension.class' => 'JMS\\Serializer\\Twig\\SerializerExtension',
            'jms_serializer.templating.helper.class' => 'JMS\\SerializerBundle\\Templating\\SerializerHelper',
            'jms_serializer.json_serialization_visitor.class' => 'JMS\\Serializer\\JsonSerializationVisitor',
            'jms_serializer.json_serialization_visitor.options' => 0,
            'jms_serializer.json_deserialization_visitor.class' => 'JMS\\Serializer\\JsonDeserializationVisitor',
            'jms_serializer.xml_serialization_visitor.class' => 'JMS\\Serializer\\XmlSerializationVisitor',
            'jms_serializer.xml_deserialization_visitor.class' => 'JMS\\Serializer\\XmlDeserializationVisitor',
            'jms_serializer.xml_deserialization_visitor.doctype_whitelist' => array(
            ),
            'jms_serializer.yaml_serialization_visitor.class' => 'JMS\\Serializer\\YamlSerializationVisitor',
            'jms_serializer.handler_registry.class' => 'JMS\\Serializer\\Handler\\LazyHandlerRegistry',
            'jms_serializer.datetime_handler.class' => 'JMS\\Serializer\\Handler\\DateHandler',
            'jms_serializer.array_collection_handler.class' => 'JMS\\Serializer\\Handler\\ArrayCollectionHandler',
            'jms_serializer.php_collection_handler.class' => 'JMS\\Serializer\\Handler\\PhpCollectionHandler',
            'jms_serializer.form_error_handler.class' => 'JMS\\Serializer\\Handler\\FormErrorHandler',
            'jms_serializer.constraint_violation_handler.class' => 'JMS\\Serializer\\Handler\\ConstraintViolationHandler',
            'jms_serializer.doctrine_proxy_subscriber.class' => 'JMS\\Serializer\\EventDispatcher\\Subscriber\\DoctrineProxySubscriber',
            'jms_serializer.stopwatch_subscriber.class' => 'JMS\\SerializerBundle\\Serializer\\StopwatchEventSubscriber',
            'jms_serializer.infer_types_from_doctrine_metadata' => true,
            'fos_comment.model.thread.class' => 'Application\\Sonata\\CommentBundle\\Entity\\Thread',
            'fos_comment.model.comment.class' => 'Application\\Sonata\\CommentBundle\\Entity\\Comment',
            'fos_comment.model.vote.class' => 'FOS\\CommentBundle\\Entity\\Vote',
            'fos_comment.manager.thread.default.class' => 'FOS\\CommentBundle\\Entity\\ThreadManager',
            'fos_comment.manager.comment.default.class' => 'FOS\\CommentBundle\\Entity\\CommentManager',
            'fos_comment.manager.vote.default.class' => 'FOS\\CommentBundle\\Entity\\VoteManager',
            'fos_comment.listener.comment_vote_score.class' => 'FOS\\CommentBundle\\EventListener\\CommentVoteScoreListener',
            'fos_comment.listener.thread_counters.class' => 'FOS\\CommentBundle\\EventListener\\ThreadCountersListener',
            'fos_comment.listener.thread_permalink.class' => 'FOS\\CommentBundle\\EventListener\\ThreadPermalinkListener',
            'fos_comment.listener.comment_blamer.class' => 'FOS\\CommentBundle\\EventListener\\CommentBlamerListener',
            'fos_comment.listener.vote_blamer.class' => 'FOS\\CommentBundle\\EventListener\\VoteBlamerListener',
            'fos_comment.listener.closed_threads.class' => 'FOS\\CommentBundle\\EventListener\\ClosedThreadListener',
            'fos_comment.sorting_factory.class' => 'FOS\\CommentBundle\\Sorting\\SortingFactory',
            'fos_comment.sorter.date.class' => 'FOS\\CommentBundle\\Sorting\\DateSorting',
            'fos_comment.template.engine' => 'twig',
            'fos_comment.model_manager_name' => NULL,
            'fos_comment.form.comment.type' => 'sonata_comment_comment',
            'fos_comment.form.comment.name' => 'fos_comment_comment',
            'fos_comment.form.thread.type' => 'fos_comment_thread',
            'fos_comment.form.thread.name' => 'fos_comment_thread',
            'fos_comment.form.commentable_thread.type' => 'fos_comment_commentable_thread',
            'fos_comment.form.commentable_thread.name' => 'fos_comment_commentable_thread',
            'fos_comment.form.delete_comment.type' => 'fos_comment_delete_comment',
            'fos_comment.form.delete_comment.name' => 'fos_comment_delete_comment',
            'fos_comment.form.vote.type' => 'fos_comment_vote',
            'fos_comment.form.vote.name' => 'fos_comment_vote',
            'fos_comment.sorting_factory.default_sorter' => 'date_desc',
            'sonata.comment.admin.groupname' => 'sonata_comment',
            'sonata.comment.manager.comment.class' => 'Sonata\\CommentBundle\\Manager\\CommentManager',
            'sonata.comment.manager.thread.class' => 'Sonata\\CommentBundle\\Manager\\ThreadManager',
            'sonata.comment.block.thread.async.class' => 'Sonata\\CommentBundle\\Block\\CommentThreadAsyncBlockService',
            'sonata.comment.admin.comment.class' => 'Sonata\\CommentBundle\\Admin\\Entity\\CommentAdmin',
            'sonata.comment.admin.thread.class' => 'Sonata\\CommentBundle\\Admin\\Entity\\ThreadAdmin',
            'sonata.comment.class.comment.entity' => 'Application\\Sonata\\CommentBundle\\Entity\\Comment',
            'sonata.comment.class.thread.entity' => 'Application\\Sonata\\CommentBundle\\Entity\\Thread',
            'sonata.comment.admin.comment.controller' => 'SonataAdminBundle:CRUD',
            'sonata.comment.admin.thread.controller' => 'SonataAdminBundle:CRUD',
            'sonata.comment.admin.comment.translation_domain' => 'SonataCommentBundle',
            'sonata.comment.admin.thread.translation_domain' => 'SonataCommentBundle',
            'sonata.comment.class.comment.signed' => false,
            'sonata.core.flashmessage.manager.class' => 'Sonata\\CoreBundle\\FlashMessage\\FlashManager',
            'sonata.core.twig.extension.flashmessage.class' => 'Sonata\\CoreBundle\\Twig\\Extension\\FlashMessageExtension',
            'sonata.core.form_type' => 'standard',
            'sonata.intl.locale_detector.request.class' => 'Sonata\\IntlBundle\\Locale\\RequestDetector',
            'sonata.intl.locale_detector.session.class' => 'Sonata\\IntlBundle\\Locale\\SessionDetector',
            'sonata.intl.templating.helper.locale.class' => 'Sonata\\IntlBundle\\Templating\\Helper\\LocaleHelper',
            'sonata.intl.templating.helper.number.class' => 'Sonata\\IntlBundle\\Templating\\Helper\\NumberHelper',
            'sonata.intl.templating.helper.datetime.class' => 'Sonata\\IntlBundle\\Templating\\Helper\\DateTimeHelper',
            'sonata.intl.timezone_detector.chain.class' => 'Sonata\\IntlBundle\\Timezone\\ChainTimezoneDetector',
            'sonata.intl.timezone_detector.user.class' => 'Sonata\\IntlBundle\\Timezone\\UserBasedTimezoneDetector',
            'sonata.intl.timezone_detector.locale.class' => 'Sonata\\IntlBundle\\Timezone\\LocaleBasedTimezoneDetector',
            'sonata.intl.twig.helper.locale.class' => 'Sonata\\IntlBundle\\Twig\\Extension\\LocaleExtension',
            'sonata.intl.twig.helper.number.class' => 'Sonata\\IntlBundle\\Twig\\Extension\\NumberExtension',
            'sonata.intl.twig.helper.datetime.class' => 'Sonata\\IntlBundle\\Twig\\Extension\\DateTimeExtension',
            'sonata_intl.timezone.detectors' => array(
                0 => 'sonata.intl.timezone_detector.user',
                1 => 'sonata.intl.timezone_detector.locale',
            ),
            'sonata.formatter.text.markdown.class' => 'Sonata\\FormatterBundle\\Formatter\\MarkdownFormatter',
            'sonata.formatter.text.text.class' => 'Sonata\\FormatterBundle\\Formatter\\TextFormatter',
            'sonata.formatter.text.raw.class' => 'Sonata\\FormatterBundle\\Formatter\\RawFormatter',
            'sonata.formatter.text.twigengine.class' => 'Sonata\\FormatterBundle\\Formatter\\TwigFormatter',
            'sonata.formatter.block.formatter.class' => 'Sonata\\FormatterBundle\\Block\\FormatterBlockService',
            'sonata.formatter.ckeditor.extension.class' => 'Sonata\\FormatterBundle\\Admin\\CkeditorAdminExtension',
            'sonata.formatter.ckeditor.configuration.templates' => array(
                'browser' => 'SonataFormatterBundle:Ckeditor:browser.html.twig',
                'upload' => 'SonataFormatterBundle:Ckeditor:upload.html.twig',
            ),
            'sonata.block.service.container.class' => 'Sonata\\BlockBundle\\Block\\Service\\ContainerBlockService',
            'sonata.block.service.empty.class' => 'Sonata\\BlockBundle\\Block\\Service\\EmptyBlockService',
            'sonata.block.service.text.class' => 'Sonata\\BlockBundle\\Block\\Service\\TextBlockService',
            'sonata.block.service.rss.class' => 'Sonata\\BlockBundle\\Block\\Service\\RssBlockService',
            'sonata.block.service.menu.class' => 'Sonata\\BlockBundle\\Block\\Service\\MenuBlockService',
            'sonata.block.service.template.class' => 'Sonata\\BlockBundle\\Block\\Service\\TemplateBlockService',
            'sonata.block.exception.strategy.manager.class' => 'Sonata\\BlockBundle\\Exception\\Strategy\\StrategyManager',
            'sonata.block.container.types' => array(
                0 => 'sonata.block.service.container',
                1 => 'sonata.page.block.container',
                2 => 'cmf.block.container',
                3 => 'cmf.block.slideshow',
            ),
            'sonata_block.blocks' => array(
                'sonata.admin.block.admin_list' => array(
                    'contexts' => array(
                        0 => 'admin',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.admin.block.search_result' => array(
                    'contexts' => array(
                        0 => 'admin',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.block.service.text' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.block.service.container' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.block.service.rss' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.block.service.menu' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.block.service.template' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.page.block.container' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.page.block.children_pages' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.page.block.breadcrumb' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.media.block.media' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.media.block.gallery' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.media.block.feature_media' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.news.block.recent_comments' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.news.block.recent_posts' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.order.block.recent_orders' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.product.block.recent_products' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.product.block.similar_products' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.product.block.categories_menu' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.product.block.filters_menu' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.product.block.variations_form' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.customer.block.recent_customers' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.basket.block.nb_items' => array(
                    'cache' => 'sonata.page.cache.js_async',
                    'contexts' => array(
                        0 => 'user',
                    ),
                    'settings' => array(
                    ),
                ),
                'sonata.timeline.block.timeline' => array(
                    'contexts' => array(
                        0 => 'admin',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.user.block.account' => array(
                    'cache' => 'sonata.page.cache.js_async',
                    'contexts' => array(
                        0 => 'user',
                    ),
                    'settings' => array(
                    ),
                ),
                'sonata.user.block.menu' => array(
                    'contexts' => array(
                        0 => 'user',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.email.share_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.facebook.like_box' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.facebook.like_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.facebook.send_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.facebook.share_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.pinterest.pin_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.twitter.share_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.twitter.follow_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.twitter.hashtag_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.twitter.mention_button' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.twitter.embed' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.demo.block.newsletter' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.formatter.block.formatter' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
                'sonata.seo.block.breadcrumb.homepage' => array(
                    'contexts' => array(
                        0 => 'sonata_page_bundle',
                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(
                    ),
                ),
            ),
            'sonata_block.blocks_by_class' => array(
            ),
            'sonata_block.cache_blocks' => array(
                'by_type' => array(
                    'sonata.admin.block.admin_list' => 'sonata.cache.noop',
                    'sonata.admin.block.search_result' => 'sonata.cache.noop',
                    'sonata.block.service.text' => 'sonata.cache.noop',
                    'sonata.block.service.container' => 'sonata.cache.noop',
                    'sonata.block.service.rss' => 'sonata.cache.noop',
                    'sonata.block.service.menu' => 'sonata.cache.noop',
                    'sonata.block.service.template' => 'sonata.cache.noop',
                    'sonata.page.block.container' => 'sonata.cache.noop',
                    'sonata.page.block.children_pages' => 'sonata.cache.noop',
                    'sonata.page.block.breadcrumb' => 'sonata.cache.noop',
                    'sonata.media.block.media' => 'sonata.cache.noop',
                    'sonata.media.block.gallery' => 'sonata.cache.noop',
                    'sonata.media.block.feature_media' => 'sonata.cache.noop',
                    'sonata.news.block.recent_comments' => 'sonata.cache.noop',
                    'sonata.news.block.recent_posts' => 'sonata.cache.noop',
                    'sonata.order.block.recent_orders' => 'sonata.cache.noop',
                    'sonata.product.block.recent_products' => 'sonata.cache.noop',
                    'sonata.product.block.similar_products' => 'sonata.cache.noop',
                    'sonata.product.block.categories_menu' => 'sonata.cache.noop',
                    'sonata.product.block.filters_menu' => 'sonata.cache.noop',
                    'sonata.product.block.variations_form' => 'sonata.cache.noop',
                    'sonata.customer.block.recent_customers' => 'sonata.cache.noop',
                    'sonata.basket.block.nb_items' => 'sonata.page.cache.js_async',
                    'sonata.timeline.block.timeline' => 'sonata.cache.noop',
                    'sonata.user.block.account' => 'sonata.page.cache.js_async',
                    'sonata.user.block.menu' => 'sonata.cache.noop',
                    'sonata.seo.block.email.share_button' => 'sonata.cache.noop',
                    'sonata.seo.block.facebook.like_box' => 'sonata.cache.noop',
                    'sonata.seo.block.facebook.like_button' => 'sonata.cache.noop',
                    'sonata.seo.block.facebook.send_button' => 'sonata.cache.noop',
                    'sonata.seo.block.facebook.share_button' => 'sonata.cache.noop',
                    'sonata.seo.block.pinterest.pin_button' => 'sonata.cache.noop',
                    'sonata.seo.block.twitter.share_button' => 'sonata.cache.noop',
                    'sonata.seo.block.twitter.follow_button' => 'sonata.cache.noop',
                    'sonata.seo.block.twitter.hashtag_button' => 'sonata.cache.noop',
                    'sonata.seo.block.twitter.mention_button' => 'sonata.cache.noop',
                    'sonata.seo.block.twitter.embed' => 'sonata.cache.noop',
                    'sonata.demo.block.newsletter' => 'sonata.cache.noop',
                    'sonata.formatter.block.formatter' => 'sonata.cache.noop',
                    'sonata.seo.block.breadcrumb.homepage' => 'sonata.cache.noop',
                ),
            ),
            'sonata.seo.block.social.container.class' => 'Sonata\\SeoBundle\\Block\\Social\\SocialBlockContainer',
            'sonata.seo.block.email.share_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\EmailShareButtonBlockService',
            'sonata.seo.block.facebook.like_box.class' => 'Sonata\\SeoBundle\\Block\\Social\\FacebookLikeBoxBlockService',
            'sonata.seo.block.facebook.like_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\FacebookLikeButtonBlockService',
            'sonata.seo.block.facebook.send_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\FacebookSendButtonBlockService',
            'sonata.seo.block.facebook.share_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\FacebookShareButtonBlockService',
            'sonata.seo.block.twitter.share_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\TwitterShareButtonBlockService',
            'sonata.seo.block.twitter.follow_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\TwitterFollowButtonBlockService',
            'sonata.seo.block.twitter.hashtag_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\TwitterHashtagButtonBlockService',
            'sonata.seo.block.twitter.mention_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\TwitterMentionButtonBlockService',
            'sonata.seo.block.twitter.embed.class' => 'Sonata\\SeoBundle\\Block\\Social\\TwitterEmbedTweetBlockService',
            'sonata.seo.block.pinterest.pin_button.class' => 'Sonata\\SeoBundle\\Block\\Social\\PinterestPinButtonBlockService',
            'sonata.seo.block.breadcrumb.homepage.class' => 'Sonata\\SeoBundle\\Block\\Breadcrumb\\HomepageBreadcrumbBlockService',
            'sonata.seo.exporter.database_source_iterator.class' => 'Exporter\\Source\\DoctrineDBALConnectionSourceIterator',
            'sonata.seo.exporter.sitemap_source_iterator.class' => 'Exporter\\Source\\SymfonySitemapSourceIterator',
            'sonata.seo.page.default.class' => 'Sonata\\SeoBundle\\Seo\\SeoPage',
            'sonata.seo.twig.extension.class' => 'Sonata\\SeoBundle\\Twig\\Extension\\SeoExtension',
            'sonata.seo.sitemap.manager.class' => 'Sonata\\SeoBundle\\Sitemap\\SourceManager',
            'sonata.classification.manager.category.class' => 'Sonata\\ClassificationBundle\\Entity\\CategoryManager',
            'sonata.classification.manager.tag.class' => 'Sonata\\ClassificationBundle\\Entity\\TagManager',
            'sonata.classification.manager.collection.class' => 'Sonata\\ClassificationBundle\\Entity\\CollectionManager',
            'sonata.classification.admin.tag.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag',
            'sonata.classification.admin.category.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category',
            'sonata.classification.admin.collection.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection',
            'sonata.classification.manager.tag.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Tag',
            'sonata.classification.manager.category.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Category',
            'sonata.classification.manager.collection.entity' => 'Application\\Sonata\\ClassificationBundle\\Entity\\Collection',
            'sonata.classification.admin.category.class' => 'Sonata\\ClassificationBundle\\Admin\\CategoryAdmin',
            'sonata.classification.admin.category.controller' => 'SonataAdminBundle:CRUD',
            'sonata.classification.admin.category.translation_domain' => 'SonataClassificationBundle',
            'sonata.classification.admin.tag.class' => 'Sonata\\ClassificationBundle\\Admin\\TagAdmin',
            'sonata.classification.admin.tag.controller' => 'SonataAdminBundle:CRUD',
            'sonata.classification.admin.tag.translation_domain' => 'SonataClassificationBundle',
            'sonata.classification.admin.collection.class' => 'Sonata\\ClassificationBundle\\Admin\\CollectionAdmin',
            'sonata.classification.admin.collection.controller' => 'SonataAdminBundle:CRUD',
            'sonata.classification.admin.collection.translation_domain' => 'SonataClassificationBundle',
            'sonata.notification.backend' => 'sonata.notification.backend.postpone',
            'sonata.notification.message.class' => 'Application\\Sonata\\NotificationBundle\\Entity\\Message',
            'sonata.notification.admin.message.entity' => 'Application\\Sonata\\NotificationBundle\\Entity\\Message',
            'sonata.notification.manager.message.entity' => 'Application\\Sonata\\NotificationBundle\\Entity\\Message',
            'sonata.notification.event.iteration_listeners' => array(
                0 => 'sonata.notification.event.doctrine_optimize',
            ),
            'sonata.notification.admin.message.class' => 'Sonata\\NotificationBundle\\Admin\\MessageAdmin',
            'sonata.notification.admin.message.controller' => 'SonataNotificationBundle:MessageAdmin',
            'sonata.notification.admin.message.translation_domain' => 'SonataNotificationBundle',
            'cmf_routing.chain_router.class' => 'Symfony\\Cmf\\Component\\Routing\\ChainRouter',
            'cmf_routing.replace_symfony_router' => true,
            'cmf_routing.route_type_type.class' => 'Symfony\\Cmf\\Bundle\\RoutingBundle\\Form\\Type\\RouteTypeType',
            'spy_timeline.filter.manager.class' => 'Spy\\Timeline\\Filter\\FilterManager',
            'spy_timeline.filter.duplicate_key.class' => 'Spy\\Timeline\\Filter\\DuplicateKey',
            'spy_timeline.filter.data_hydrator.class' => 'Spy\\Timeline\\Filter\\DataHydrator',
            'spy_timeline.filter.data_hydrator.locator.doctrine_orm.class' => 'Spy\\TimelineBundle\\Filter\\DataHydrator\\Locator\\DoctrineORM',
            'spy_timeline.filter.data_hydrator.locator.doctrine_odm.class' => 'Spy\\TimelineBundle\\Filter\\DataHydrator\\Locator\\DoctrineODM',
            'spy_timeline.unread_notifications.class' => 'Spy\\Timeline\\Notification\\Unread\\UnreadNotificationManager',
            'spy_timeline.paginator.knp.class' => 'Spy\\Timeline\\ResultBuilder\\Pager\\KnpPager',
            'spy_timeline.resolve_component.doctrine.class' => 'Spy\\TimelineBundle\\ResolveComponent\\DoctrineComponentDataResolver',
            'spy_timeline.resolve_component.basic.class' => 'Spy\\Timeline\\ResolveComponent\\BasicComponentDataResolver',
            'spy_timeline.result_builder.class' => 'Spy\\Timeline\\ResultBuilder\\ResultBuilder',
            'spy_timeline.spread.deployer.class' => 'Spy\\Timeline\\Spread\\Deployer',
            'spy_timeline.spread.entry_collection.class' => 'Spy\\Timeline\\Spread\\Entry\\EntryCollection',
            'spy_timeline.class.timeline' => 'Application\\Sonata\\TimelineBundle\\Entity\\Timeline',
            'spy_timeline.class.action' => 'Application\\Sonata\\TimelineBundle\\Entity\\Action',
            'spy_timeline.class.component' => 'Application\\Sonata\\TimelineBundle\\Entity\\Component',
            'spy_timeline.class.action_component' => 'Application\\Sonata\\TimelineBundle\\Entity\\ActionComponent',
            'spy_timeline.timeline_manager.orm.class' => 'Spy\\TimelineBundle\\Driver\\ORM\\TimelineManager',
            'spy_timeline.action_manager.orm.class' => 'Spy\\TimelineBundle\\Driver\\ORM\\ActionManager',
            'spy_timeline.pager.orm.class' => 'Spy\\TimelineBundle\\Driver\\ORM\\Pager',
            'spy_timeline.query_executor.orm.class' => 'Spy\\TimelineBundle\\Driver\\ORM\\QueryExecutor',
            'spy_timeline.query_builder.class' => 'Spy\\TimelineBundle\\Driver\\ORM\\QueryBuilder\\QueryBuilder',
            'spy_timeline.filter.data_hydrator.locators_config' => array(
                0 => 'spy_timeline.filter.data_hydrator.locator.doctrine_orm',
            ),
            'spy_timeline.spread.deployer.delivery' => 'immediate',
            'spy_timeline.spread.on_subject' => true,
            'spy_timeline.spread.on_global_context' => true,
            'spy_timeline.spread.deployer.batch_size' => '50',
            'spy_timeline.render.path' => 'SpyTimelineBundle:Timeline',
            'spy_timeline.render.fallback' => 'SpyTimelineBundle:Timeline:default.html.twig',
            'spy_timeline.render.i18n.fallback' => NULL,
            'spy_timeline.twig.resources' => array(
                0 => 'SpyTimelineBundle:Action:components.html.twig',
            ),
            'spy_timeline.query_builder.factory.class' => 'Spy\\Timeline\\Driver\\QueryBuilder\\QueryBuilderFactory',
            'spy_timeline.query_builder.asserter.class' => 'Spy\\Timeline\\Driver\\QueryBuilder\\Criteria\\Asserter',
            'spy_timeline.query_builder.operator.class' => 'Spy\\Timeline\\Driver\\QueryBuilder\\Criteria\\Operator',
            'spy_timeline.resolve_component.doctrine_registries' => true,
            'sonata.timeline.admin.timeline.entity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Timeline',
            'sonata.timeline.admin.action.entity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Action',
            'sonata.timeline.admin.actioncomponent.entity' => 'Application\\Sonata\\TimelineBundle\\Entity\\ActionComponent',
            'sonata.timeline.admin.component.entity' => 'Application\\Sonata\\TimelineBundle\\Entity\\Component',
            'mopa_bootstrap.twig.extension.form.class' => 'Mopa\\Bundle\\BootstrapBundle\\Twig\\FormExtension',
            'mopa_bootstrap.twig.extension.icon.class' => 'Mopa\\Bundle\\BootstrapBundle\\Twig\\IconExtension',
            'mopa_bootstrap.bootstrap.install_path' => 'Resources/public/bootstrap',
            'mopa_bootstrap.form.type_extension.button.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\IconButtonExtension',
            'mopa_bootstrap.form.type_extension.help.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\HelpFormTypeExtension',
            'mopa_bootstrap.form.type_extension.legend.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\LegendFormTypeExtension',
            'mopa_bootstrap.form.type_extension.error.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\ErrorTypeFormTypeExtension',
            'mopa_bootstrap.form.type_extension.widget.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\WidgetFormTypeExtension',
            'mopa_bootstrap.form.type_extension.horizontal.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\HorizontalFormTypeExtension',
            'mopa_bootstrap.form.type_extension.widget_collection.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\WidgetCollectionFormTypeExtension',
            'mopa_bootstrap.form.type_extension.date.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\DateTypeExtension',
            'mopa_bootstrap.form.type_extension.tabbed.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Extension\\TabbedFormTypeExtension',
            'mopa_bootstrap.form.type.tab.class' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Type\\TabType',
            'mopa_bootstrap.form.show_legend' => false,
            'mopa_bootstrap.form.render_optional_text' => false,
            'mopa_bootstrap.form.render_required_asterisk' => true,
            'mopa_bootstrap.form.templating' => 'MopaBootstrapBundle:Form:fields.html.twig',
            'mopa_bootstrap.form.horizontal_label_class' => 'col-lg-3 control-label',
            'mopa_bootstrap.form.horizontal_label_offset_class' => 'col-lg-offset-3',
            'mopa_bootstrap.form.horizontal_input_wrapper_class' => 'col-lg-9',
            'mopa_bootstrap.form.render_fieldset' => true,
            'mopa_bootstrap.form.render_collection_item' => true,
            'mopa_bootstrap.form.show_child_legend' => false,
            'mopa_bootstrap.form.checkbox_label' => 'both',
            'mopa_bootstrap.form.error_type' => NULL,
            'mopa_bootstrap.form.tabs.class' => 'nav nav-tabs',
            'mopa_bootstrap.form.help_widget.popover' => array(
                'title' => NULL,
                'content' => NULL,
                'trigger' => 'hover',
                'toggle' => 'popover',
                'placement' => 'right',
            ),
            'mopa_bootstrap.form.help_label.tooltip' => array(
                'title' => NULL,
                'text' => NULL,
                'icon' => 'info-sign',
                'placement' => 'top',
            ),
            'mopa_bootstrap.form.help_label.popover' => array(
                'title' => NULL,
                'content' => NULL,
                'text' => NULL,
                'icon' => 'info-sign',
                'placement' => 'top',
            ),
            'mopa_bootstrap.form.collection.widget_remove_btn' => array(
                'attr' => array(
                    'class' => 'btn btn-default',
                ),
                'label' => 'remove_item',
                'icon' => NULL,
                'icon_color' => NULL,
            ),
            'mopa_bootstrap.form.collection.widget_add_btn' => array(
                'attr' => array(
                    'class' => 'btn btn-default',
                ),
                'label' => 'add_item',
                'icon' => NULL,
                'icon_color' => NULL,
            ),
            'mopa_bootstrap.icons.icon_set' => 'glyphicons',
            'mopa_bootstrap.icons.shortcut' => 'icon',
            'web_profiler.controller.profiler.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController',
            'web_profiler.controller.router.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\RouterController',
            'web_profiler.controller.exception.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ExceptionController',
            'twig.extension.webprofiler.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension',
            'web_profiler.debug_toolbar.position' => 'bottom',
            'web_profiler.debug_toolbar.class' => 'Symfony\\Bundle\\WebProfilerBundle\\EventListener\\WebDebugToolbarListener',
            'web_profiler.debug_toolbar.intercept_redirects' => false,
            'web_profiler.debug_toolbar.mode' => 2,
            'faker.generator.class' => 'Faker\\Factory',
            'faker.populator.class' => 'Faker\\ORM\\Propel\\Populator',
            'faker.entity.class' => 'Faker\\ORM\\Propel\\EntityPopulator',
            'data_collector.templates' => array(
                'data_collector.config' => array(
                    0 => 'config',
                    1 => '@WebProfiler/Collector/config.html.twig',
                ),
                'data_collector.request' => array(
                    0 => 'request',
                    1 => '@WebProfiler/Collector/request.html.twig',
                ),
                'data_collector.ajax' => array(
                    0 => 'ajax',
                    1 => '@WebProfiler/Collector/ajax.html.twig',
                ),
                'data_collector.exception' => array(
                    0 => 'exception',
                    1 => '@WebProfiler/Collector/exception.html.twig',
                ),
                'data_collector.events' => array(
                    0 => 'events',
                    1 => '@WebProfiler/Collector/events.html.twig',
                ),
                'data_collector.logger' => array(
                    0 => 'logger',
                    1 => '@WebProfiler/Collector/logger.html.twig',
                ),
                'data_collector.time' => array(
                    0 => 'time',
                    1 => '@WebProfiler/Collector/time.html.twig',
                ),
                'data_collector.memory' => array(
                    0 => 'memory',
                    1 => '@WebProfiler/Collector/memory.html.twig',
                ),
                'data_collector.router' => array(
                    0 => 'router',
                    1 => '@WebProfiler/Collector/router.html.twig',
                ),
                'data_collector.form' => array(
                    0 => 'form',
                    1 => '@WebProfiler/Collector/form.html.twig',
                ),
                'data_collector.security' => array(
                    0 => 'security',
                    1 => '@Security/Collector/security.html.twig',
                ),
                'swiftmailer.data_collector' => array(
                    0 => 'swiftmailer',
                    1 => '@Swiftmailer/Collector/swiftmailer.html.twig',
                ),
                'data_collector.doctrine' => array(
                    0 => 'db',
                    1 => '@Doctrine/Collector/db.html.twig',
                ),
                'sonata.block.data_collector' => array(
                    0 => 'block',
                    1 => 'SonataBlockBundle:Profiler:block.html.twig',
                ),
            ),
            'console.command.ids' => array(
            ),
            'nelmio_api_doc.parser.form_type_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\FormTypeParser',
            'nelmio_api_doc.parser.validation_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\ValidationParser',
            'nelmio_api_doc.parser.jms_metadata_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\JmsMetadataParser',
        );
    }
}
