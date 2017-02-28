<?php

/* MopaBootstrapBundle:Menu:menu.html.twig */
class __TwigTemplate_4a1606aaf5a6791cfa60466d68167335e3cad6a0af342ec9cafae8a831bc42bc extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("knp_menu.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'linkElement' => array($this, 'block_linkElement'),
            'label' => array($this, 'block_label'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "knp_menu.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_linkElement($context, array $blocks = array())
    {
        // line 4
        ob_start();
        // line 5
        $context["macros"] = $this->env->loadTemplate("knp_menu.html.twig");
        // line 6
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "uri", array()), "html", null, true);
        echo "\"";
        echo $context["macros"]->getattributes($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "linkAttributes", array()));
        echo ">
";
        // line 7
        if ((($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extras", array(), "any", false, true), "icon", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extras", array(), "any", false, true), "icon", array()), false)) : (false))) {
            // line 8
            echo "    ";
            echo $this->env->getExtension('mopa_bootstrap_icon')->renderIcon($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extras", array()), "icon", array()), (($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extras", array(), "any", false, true), "icon_white", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extras", array(), "any", false, true), "icon_white", array()), false)) : (false)));
            echo " ";
        }
        // line 10
        $this->displayBlock("label", $context, $blocks);
        // line 11
        if ((($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extras", array(), "any", false, true), "caret", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "extras", array(), "any", false, true), "caret", array()), false)) : (false))) {
            // line 12
            echo "    <b class=\"caret\"></b>
";
        }
        // line 14
        echo "</a>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 18
    public function block_label($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["item"]) ? $context["item"] : null), "label", array())), "html", null, true);
    }

    public function getTemplateName()
    {
        return "MopaBootstrapBundle:Menu:menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 18,  66 => 14,  62 => 12,  60 => 11,  58 => 10,  53 => 8,  51 => 7,  44 => 6,  42 => 5,  40 => 4,  37 => 3,  11 => 1,);
    }
}
