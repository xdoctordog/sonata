<?php

/* ApplicationSonataProductBundle:Travel:view.html.twig */
class __TwigTemplate_9580006648f603283137643121b2b9f6dd7f6282db49227be1c7490371f00f0f extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 19
        try {
            $this->parent = $this->env->loadTemplate("SonataProductBundle:Product:view.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(19);

            throw $e;
        }

        $this->blocks = array(
            'product_title' => array($this, 'block_product_title'),
            'product_description' => array($this, 'block_product_description'),
            'product_gallery' => array($this, 'block_product_gallery'),
            'product_delivery' => array($this, 'block_product_delivery'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataProductBundle:Product:view.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 21
        $context["variations_properties"] = array(0 => "travellers", 1 => "travelDays");
        // line 19
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 23
    public function block_product_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "name", array()), "html", null, true);
    }

    // line 25
    public function block_product_description($context, array $blocks = array())
    {
        // line 26
        echo "    ";
        echo $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "description", array());
        echo "
";
    }

    // line 29
    public function block_product_gallery($context, array $blocks = array())
    {
        echo "Product gallery";
    }

    // line 31
    public function block_product_delivery($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "ApplicationSonataProductBundle:Travel:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 31,  58 => 29,  51 => 26,  48 => 25,  42 => 23,  38 => 19,  36 => 21,  11 => 19,);
    }
}
