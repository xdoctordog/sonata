<?php

/* FOSCommentBundle:Thread:comment.html.twig */
class __TwigTemplate_39e758f0c88ef53851000bdc99b8f8a9a45ca3efa11594afebf729fb7790d1cd extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 11
        echo "
";
        // line 12
        $context["view"] = ((array_key_exists("view", $context)) ? (_twig_default_filter((isset($context["view"]) ? $context["view"] : null), "tree")) : ("tree"));
        // line 13
        $context["depth"] = ((array_key_exists("depth", $context)) ? (_twig_default_filter((isset($context["depth"]) ? $context["depth"] : null), 0)) : (0));
        // line 14
        echo "
";
        // line 15
        $this->env->loadTemplate("FOSCommentBundle:Thread:comment_content.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "FOSCommentBundle:Thread:comment.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 15,  26 => 14,  24 => 13,  22 => 12,  19 => 11,);
    }
}
