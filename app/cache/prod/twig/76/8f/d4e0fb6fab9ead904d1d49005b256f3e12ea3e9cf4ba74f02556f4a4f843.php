<?php

/* MopaBootstrapBundle:Pagination:sliding_item.html.twig */
class __TwigTemplate_768fd4e0fb6fab9ead904d1d49005b256f3e12ea3e9cf4ba74f02556f4a4f843 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "<li class=\"";
        echo twig_escape_filter($this->env, ((array_key_exists("name", $context)) ? ((isset($context["name"]) ? $context["name"] : null)) : ("")), "html", null, true);
        echo " ";
        echo ((((isset($context["page"]) ? $context["page"] : null) == (isset($context["current"]) ? $context["current"] : null))) ? ("active") : (""));
        echo " ";
        echo (((array_key_exists("clickable", $context) &&  !(isset($context["clickable"]) ? $context["clickable"] : null))) ? ("disabled") : (""));
        echo "\">
    ";
        // line 2
        if ((((isset($context["page"]) ? $context["page"] : null) != (isset($context["current"]) ? $context["current"] : null)) && ( !array_key_exists("clickable", $context) || (isset($context["clickable"]) ? $context["clickable"] : null)))) {
            // line 3
            echo "        <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : null), twig_array_merge((isset($context["query"]) ? $context["query"] : null), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : null) => (isset($context["page"]) ? $context["page"] : null)))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((array_key_exists("text", $context)) ? ((isset($context["text"]) ? $context["text"] : null)) : ((isset($context["page"]) ? $context["page"] : null))), "html", null, true);
            echo "</a>
    ";
        } else {
            // line 5
            echo "        <span>";
            echo twig_escape_filter($this->env, ((array_key_exists("text", $context)) ? ((isset($context["text"]) ? $context["text"] : null)) : ((isset($context["page"]) ? $context["page"] : null))), "html", null, true);
            echo "</span>
    ";
        }
        // line 7
        echo "</li>
";
    }

    public function getTemplateName()
    {
        return "MopaBootstrapBundle:Pagination:sliding_item.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 7,  38 => 5,  30 => 3,  28 => 2,  19 => 1,);
    }
}
