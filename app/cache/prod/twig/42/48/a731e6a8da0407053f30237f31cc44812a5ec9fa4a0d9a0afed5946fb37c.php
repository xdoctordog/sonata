<?php

/* SonataOrderBundle:OrderAdmin:list_status.html.twig */
class __TwigTemplate_4248a731e6a8da0407053f30237f31cc44812a5ec9fa4a0d9a0afed5946fb37c extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        // line 15
        echo "    <span class=\"label";
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["object"]) ? $context["object"] : null), null, "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["object"]) ? $context["object"] : null), null, "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "statusName", array()), array(), "SonataOrderBundle"), "html", null, true);
        echo "</span>
";
    }

    public function getTemplateName()
    {
        return "SonataOrderBundle:OrderAdmin:list_status.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 15,  36 => 14,  11 => 12,);
    }
}
