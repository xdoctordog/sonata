<?php

/* SonataQABundle:Page:controllerHelper.html.twig */
class __TwigTemplate_652715511a35a18699fd6bba939e33c51c54d0c3062729bb9af533062625b7b7 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1>Page Bundle</h1>

<h2>Solving</h2>
<ul>
    <li><a href=\"https://github.com/sonata-project/SonataPageBundle/pull/211\">Make HostSiteSelector working again</a></li>
</ul>

<h2>Rendering</h2>
<h3>render_hinclude</h3>
<pre>
    ";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('http_kernel')->renderFragmentStrategy("hinclude", $this->env->getExtension('sonata_page')->controller("SonataQABundle:Page:internalController")));
        echo "
</pre>

<h3>render</h3>
";
        // line 15
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('sonata_page')->controller("SonataQABundle:Page:internalController"));
    }

    public function getTemplateName()
    {
        return "SonataQABundle:Page:controllerHelper.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 15,  31 => 11,  19 => 1,);
    }
}
