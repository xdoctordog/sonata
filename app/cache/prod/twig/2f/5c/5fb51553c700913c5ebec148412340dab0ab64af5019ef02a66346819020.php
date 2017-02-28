<?php

/* ApplicationSonataProductBundle:Travel:properties.html.twig */
class __TwigTemplate_2f5c5fb51553c700913c5ebec148412340dab0ab64af5019ef02a66346819020 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
<dl class=\"dl-horizontal\" style=\"margin-bottom: 0;\">
    ";
        // line 13
        if ( !$this->getAttribute((isset($context["product"]) ? $context["product"] : null), "isMaster", array())) {
            // line 14
            echo "        <dt style=\"width: auto;\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("travel.travel_days", array(), "SonataProductBundle"), "html", null, true);
            echo "</dt>
        <dd style=\"margin-left: 110px;\">";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "travelDays", array()), "html", null, true);
            echo "</dd>
        <dt style=\"width: auto;\">";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("travel.travellers", array(), "SonataProductBundle"), "html", null, true);
            echo "</dt>
        <dd style=\"margin-left: 110px;\">";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "travellers", array()), "html", null, true);
            echo "</dd>
        <dt style=\"width: auto;\">";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("travel.travel_date", array(), "SonataProductBundle"), "html", null, true);
            echo "</dt>
        <dd style=\"margin-left: 110px;\">";
            // line 19
            echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "travelDate", array()));
            echo "</dd>
    ";
        }
        // line 21
        echo "</dl>";
    }

    public function getTemplateName()
    {
        return "ApplicationSonataProductBundle:Travel:properties.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 21,  46 => 19,  42 => 18,  38 => 17,  34 => 16,  30 => 15,  25 => 14,  23 => 13,  19 => 11,);
    }
}
