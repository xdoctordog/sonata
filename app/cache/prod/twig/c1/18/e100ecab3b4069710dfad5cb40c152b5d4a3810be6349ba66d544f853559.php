<?php

/* SonataCommentBundle:Block:thread_async.html.twig */
class __TwigTemplate_c118e100ecab3b4069710dfad5cb40c152b5d4a3810be6349ba66d544f853559 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        $this->env->loadTemplate("SonataCommentBundle:Thread:async.html.twig")->display(array_merge($context, array("id" => $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "id", array()))));
    }

    public function getTemplateName()
    {
        return "SonataCommentBundle:Block:thread_async.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
