<?php

/* SonataMediaBundle:MediaAdmin:list_image.html.twig */
class __TwigTemplate_c4404070dd4259b844f884f8d46a66175acedb974d25a673ac1213ce8b812646 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "    <a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_core_template')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "method"), "html", null, true);
        echo "\">";
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute((isset($context["object"]) ? $context["object"] : null), $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "name", array())), "admin", array("width" => 75, "height" => 60));
        echo "</a>
";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:list_image.html.twig";
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
