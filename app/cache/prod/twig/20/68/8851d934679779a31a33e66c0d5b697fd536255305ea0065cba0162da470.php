<?php

/* MopaBootstrapBundle:Navbar:navbar.html.twig */
class __TwigTemplate_20688851d934679779a31a33e66c0d5b697fd536255305ea0065cba0162da470 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'header' => array($this, 'block_header'),
            'toggle' => array($this, 'block_toggle'),
            'brand' => array($this, 'block_brand'),
            'menu_container' => array($this, 'block_menu_container'),
            'menu' => array($this, 'block_menu'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div role=\"navigation\" class=\"navbar";
        echo ((((array_key_exists("inverse", $context)) ? (_twig_default_filter((isset($context["inverse"]) ? $context["inverse"] : null), false)) : (false))) ? (" navbar-inverse") : (" navbar-default"));
        echo ((((array_key_exists("fixedTop", $context)) ? (_twig_default_filter((isset($context["fixedTop"]) ? $context["fixedTop"] : null), false)) : (false))) ? (" navbar-fixed-top") : (""));
        echo ((((array_key_exists("staticTop", $context)) ? (_twig_default_filter((isset($context["staticTop"]) ? $context["staticTop"] : null), false)) : (false))) ? (" navbar-static-top") : (""));
        echo "\">
    <div class=\"container\">
        ";
        // line 3
        $this->displayBlock('header', $context, $blocks);
        // line 16
        echo "        ";
        $this->displayBlock('menu_container', $context, $blocks);
        // line 21
        echo "    </div>
</div>
";
    }

    // line 3
    public function block_header($context, array $blocks = array())
    {
        // line 4
        echo "        <div class=\"navbar-header\">
            ";
        // line 5
        $this->displayBlock('toggle', $context, $blocks);
        // line 13
        echo "            ";
        $this->displayBlock('brand', $context, $blocks);
        // line 14
        echo "        </div>
        ";
    }

    // line 5
    public function block_toggle($context, array $blocks = array())
    {
        // line 6
        echo "            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-responsive-collapse\" >
            <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            ";
    }

    // line 13
    public function block_brand($context, array $blocks = array())
    {
    }

    // line 16
    public function block_menu_container($context, array $blocks = array())
    {
        // line 17
        echo "        <div class=\"collapse navbar-collapse navbar-responsive-collapse\">
            ";
        // line 18
        $this->displayBlock('menu', $context, $blocks);
        // line 19
        echo "        </div>
        ";
    }

    // line 18
    public function block_menu($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "MopaBootstrapBundle:Navbar:navbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 18,  85 => 19,  83 => 18,  80 => 17,  77 => 16,  72 => 13,  62 => 6,  59 => 5,  54 => 14,  51 => 13,  49 => 5,  46 => 4,  43 => 3,  37 => 21,  34 => 16,  32 => 3,  24 => 1,);
    }
}
