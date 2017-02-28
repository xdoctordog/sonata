<?php

/* SonataFormatterBundle:Ckeditor:upload.html.twig */
class __TwigTemplate_95a3ba7277b256dcd2810e8c49dc446f76d7dc7f6ae9a2a3adc23020fa5a8878 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "<script>window.parent.CKEDITOR.tools.callFunction(";
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "CKEditorFuncNum"), "method"), "js"), "html", null, true);
        echo ", \"";
        echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : null), twig_escape_filter($this->env, "reference", "js"));
        echo "\");</script>
";
    }

    public function getTemplateName()
    {
        return "SonataFormatterBundle:Ckeditor:upload.html.twig";
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
