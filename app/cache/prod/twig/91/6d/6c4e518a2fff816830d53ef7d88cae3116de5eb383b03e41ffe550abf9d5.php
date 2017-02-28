<?php

/* SonataBasketBundle:Basket:add_product_popin.html.twig */
class __TwigTemplate_916d6c4e518a2fff816830d53ef7d88cae3116de5eb383b03e41ffe550abf9d5 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'product_details' => array($this, 'block_product_details'),
            'product_image' => array($this, 'block_product_image'),
            'product_title' => array($this, 'block_product_title'),
            'product_sku' => array($this, 'block_product_sku'),
            'product_properties' => array($this, 'block_product_properties'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"modal-dialog\">
    <div class=\"modal-content\">
        <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
            <div class=\"row\">
                <div class=\"col-md-7 col-md-offset-3\">
                    <h4 class=\"modal-title\">";
        // line 7
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.basket.product.added", array(), "SonataBasketBundle");
        echo "</h4>
                </div>
            </div>
        </div>
        <div class=\"modal-body\">
            ";
        // line 12
        $this->displayBlock('product_details', $context, $blocks);
        // line 49
        echo "        </div>
        <div class=\"modal-footer\">
            <div class=\"row-fluid\">
                <div class=\"col-md-4 col-md-offset-1\">
                    <a href=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_product_view", array("productId" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "id", array()), "slug" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "slug", array()))), "html", null, true);
        echo "\" class=\"btn\">&larr; Continue shopping</a>
                </div>
                <div class=\"col-md-4 col-md-offset-1\">
                    <a href=\"";
        // line 56
        echo $this->env->getExtension('routing')->getUrl("sonata_basket_index");
        echo "\" class=\"btn btn-primary btn-large\">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    // line 12
    public function block_product_details($context, array $blocks = array())
    {
        // line 13
        echo "                <div class=\"row\" itemtype=\"http://schema.org/Product\">
                    <div class=\"col-sm-6\">
                        ";
        // line 15
        $this->displayBlock('product_image', $context, $blocks);
        // line 16
        echo "                    </div>

                    <div class=\"col-sm-6\">
                        <h4 itemprop=\"name\" style=\"margin-top: 0px;\">";
        // line 19
        $this->displayBlock('product_title', $context, $blocks);
        echo "</h4>

                        ";
        // line 21
        $this->displayBlock('product_sku', $context, $blocks);
        // line 27
        echo "
                        ";
        // line 28
        $this->displayBlock('product_properties', $context, $blocks);
        // line 31
        echo "
                        <dl class=\"dl-horizontal\" style=\"margin-bottom: 0;\">
                            <dt style=\"width: auto;\">";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header_basket_unit_price", array(), "SonataBasketBundle"), "html", null, true);
        echo "</dt>
                            <dd style=\"margin-left: 110px;\">";
        // line 34
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "getUnitPrice", array(0 => true), "method"), $this->getAttribute((isset($context["currency"]) ? $context["currency"] : null), "label", array()), array(), array(), (isset($context["locale"]) ? $context["locale"] : null));
        echo "</dd>

                            <dt style=\"width: auto;\">";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header_basket_quantity", array(), "SonataBasketBundle"), "html", null, true);
        echo "</dt>
                            <dd style=\"margin-left: 110px;\">";
        // line 37
        echo twig_escape_filter($this->env, (isset($context["quantity"]) ? $context["quantity"] : null), "html", null, true);
        echo "</dd>

                            <dt style=\"width: auto;\">";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata_basket_total_price", array(), "SonataBasketBundle"), "html", null, true);
        echo "</dt>
                            <dd style=\"margin-left: 110px;\">";
        // line 40
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency((isset($context["price"]) ? $context["price"] : null), $this->getAttribute((isset($context["currency"]) ? $context["currency"] : null), "label", array()), array(), array(), (isset($context["locale"]) ? $context["locale"] : null));
        echo "</dd>
                        </dl>
                    </div>
                </div>

                <div class=\"col-md-12\">
                    <p>";
        // line 46
        echo $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "rawShortDescription", array());
        echo "</p>
                </div>
            ";
    }

    // line 15
    public function block_product_image($context, array $blocks = array())
    {
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "image", array()), "small", array("itemprop" => "image", "class" => "img-rounded img-responsive"));
    }

    // line 19
    public function block_product_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "name", array()), "html", null, true);
    }

    // line 21
    public function block_product_sku($context, array $blocks = array())
    {
        // line 22
        echo "                            <dl class=\"dl-horizontal\" style=\"margin-bottom: 0;\">
                                <dt style=\"width: auto;\">";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.product.sku", array(), "SonataProductBundle"), "html", null, true);
        echo "</dt>
                                <dd style=\"margin-left: 110px; word-wrap: break-word;\">";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "sku", array()), "html", null, true);
        echo "</dd>
                            </dl>
                        ";
    }

    // line 28
    public function block_product_properties($context, array $blocks = array())
    {
        // line 29
        echo "                            ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('sonata_page')->controller(($this->getAttribute((isset($context["provider"]) ? $context["provider"] : null), "baseControllerName", array()) . ":renderProperties"), array("product" => (isset($context["product"]) ? $context["product"] : null))));
        echo "
                        ";
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:add_product_popin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 29,  161 => 28,  154 => 24,  150 => 23,  147 => 22,  144 => 21,  138 => 19,  132 => 15,  125 => 46,  116 => 40,  112 => 39,  107 => 37,  103 => 36,  98 => 34,  94 => 33,  90 => 31,  88 => 28,  85 => 27,  83 => 21,  78 => 19,  73 => 16,  71 => 15,  67 => 13,  64 => 12,  54 => 56,  48 => 53,  42 => 49,  40 => 12,  32 => 7,  24 => 1,);
    }
}
