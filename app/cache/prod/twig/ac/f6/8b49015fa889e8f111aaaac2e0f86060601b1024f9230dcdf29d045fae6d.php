<?php

/* SonataProductBundle:Product:view_similar.html.twig */
class __TwigTemplate_acf68b49015fa889e8f111aaaac2e0f86060601b1024f9230dcdf29d045fae6d extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        ob_start();
        // line 13
        echo "
    <div class=\"panel panel-primary\">

        <div class=\"panel-heading\">
            <h3 class=\"panel-title\">";
        // line 17
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.product.cross_selling.title", array(), "SonataProductBundle");
        echo "</h3>
        </div>

        <div class=\"panel-body product-grid\">
            <div class=\"col-lg-12\">
                ";
        // line 22
        // token for sonata_template_box, however the box is disabled
        // line 23
        echo "            </div>

            <div class=\"col-lg-12\">
                ";
        // line 26
        echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => "sonata.product.block.similar_products", "settings" => array("title" => "", "number" => 4, "base_product_id" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "id", array())))));
        echo "
            </div>
        </div>

    </div>

";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Product:view_similar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 26,  40 => 23,  38 => 22,  30 => 17,  24 => 13,  22 => 12,  19 => 11,);
    }
}
