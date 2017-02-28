<?php

/* MopaBootstrapBundle:Navbar:subnavbar.html.twig */
class __TwigTemplate_3e4751fb5b893e8d183d458457e8427554e106d3ea4b7d881148133acdbbcedd extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"subnav ";
        echo ((((array_key_exists("fixedTop", $context)) ? (_twig_default_filter((isset($context["fixedTop"]) ? $context["fixedTop"] : null), false)) : (false))) ? ("subnavbar-fixed-top") : (""));
        echo "\">
    ";
        // line 2
        $this->displayBlock('menu', $context, $blocks);
        // line 3
        echo "</div>
";
    }

    // line 2
    public function block_menu($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "MopaBootstrapBundle:Navbar:subnavbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 2,  27 => 3,  25 => 2,  20 => 1,);
    }
}
