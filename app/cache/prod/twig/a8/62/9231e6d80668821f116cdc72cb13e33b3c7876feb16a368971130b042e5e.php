<?php

/* SonataProductBundle:Catalog:layout.html.twig */
class __TwigTemplate_a8629231e6d80668821f116cdc72cb13e33b3c7876feb16a368971130b042e5e extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_page_breadcrumb' => array($this, 'block_sonata_page_breadcrumb'),
            'product_category' => array($this, 'block_product_category'),
            'no_products' => array($this, 'block_no_products'),
            'products' => array($this, 'block_products'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        // token for sonata_template_box, however the box is disabled
        // line 13
        echo "
";
        // line 14
        $this->displayBlock('sonata_page_breadcrumb', $context, $blocks);
        // line 19
        echo "
<div class=\"row\">

    <div class=\"col-sm-3\">

        ";
        // line 24
        $this->displayBlock('product_category', $context, $blocks);
        // line 34
        echo "
        ";
        // line 36
        echo "            ";
        // line 37
        echo "                ";
        // line 38
        echo "                    ";
        // line 39
        echo "                ";
        // line 40
        echo "            ";
        // line 41
        echo "        ";
        // line 42
        echo "
    </div>

    <div class=\"col-sm-9\">

        ";
        // line 47
        if (($this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "count", array()) == 0)) {
            // line 48
            echo "
            ";
            // line 49
            $this->displayBlock('no_products', $context, $blocks);
            // line 54
            echo "
        ";
        } else {
            // line 56
            echo "
            <div class=\"panel panel-default sonata-product-navigation-bar\">
                <div class=\"panel-heading\">
                    <div class=\"row\">
                        <div class=\"col-sm-3\">
                            <h4 class=\"panel-title\">
                                ";
            // line 62
            if ((isset($context["category"]) ? $context["category"] : null)) {
                // line 63
                echo "                                    ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["category"]) ? $context["category"] : null), "name", array()), "html", null, true);
                echo "
                                ";
            } else {
                // line 65
                echo "                                    ";
                echo $this->env->getExtension('translator')->getTranslator()->trans("catalog_root_title", array(), "SonataProductBundle");
                // line 66
                echo "                                ";
            }
            // line 67
            echo "                            </h4>
                        </div>
                        <div class=\"col-sm-9\">
                            ";
            // line 70
            $this->env->loadTemplate("SonataProductBundle:Catalog:_pager.html.twig")->display($context);
            // line 71
            echo "                        </div>
                    </div>
                </div>

                ";
            // line 75
            $this->displayBlock('products', $context, $blocks);
            // line 76
            echo "
                ";
            // line 77
            if (($this->getAttribute($this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "paginationData", array()), "pageCount", array()) > 1)) {
                // line 78
                echo "                    <div class=\"panel-footer\">
                        <div class=\"row\">
                            <div class=\"col-sm-12\">
                                ";
                // line 81
                $this->env->loadTemplate("SonataProductBundle:Catalog:_pager.html.twig")->display($context);
                // line 82
                echo "                            </div>
                        </div>
                    </div>
                ";
            }
            // line 86
            echo "            </div>
        ";
        }
        // line 88
        echo "
    </div>

</div>
";
    }

    // line 14
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
        // line 15
        echo "    <div class=\"row-fluid clearfix\">
        ";
        // line 16
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => "catalog", "category" => (isset($context["category"]) ? $context["category"] : null), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "requestUri", array()))));
        echo "
    </div>
";
    }

    // line 24
    public function block_product_category($context, array $blocks = array())
    {
        // line 25
        echo "            ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => "sonata.product.block.categories_menu", "settings" => array("current_uri" => $this->getAttribute($this->getAttribute(        // line 26
(isset($context["app"]) ? $context["app"] : null), "request", array()), "requestUri", array()), "extra_cache_keys" => array("block_id" => "sonata.product.block.categories_menu", "updated_at" => "now"), "ttl" => 60))));
        // line 32
        echo "
        ";
    }

    // line 49
    public function block_no_products($context, array $blocks = array())
    {
        // line 50
        echo "                <div class=\"no-products-available\">
                    ";
        // line 51
        echo $this->env->getExtension('translator')->getTranslator()->trans("no_products_available", array(), "SonataProductBundle");
        // line 52
        echo "                </div>
            ";
    }

    // line 75
    public function block_products($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Catalog:layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 75,  175 => 52,  173 => 51,  170 => 50,  167 => 49,  162 => 32,  160 => 26,  158 => 25,  155 => 24,  148 => 16,  145 => 15,  142 => 14,  134 => 88,  130 => 86,  124 => 82,  122 => 81,  117 => 78,  115 => 77,  112 => 76,  110 => 75,  104 => 71,  102 => 70,  97 => 67,  94 => 66,  91 => 65,  85 => 63,  83 => 62,  75 => 56,  71 => 54,  69 => 49,  66 => 48,  64 => 47,  57 => 42,  55 => 41,  53 => 40,  51 => 39,  49 => 38,  47 => 37,  45 => 36,  42 => 34,  40 => 24,  33 => 19,  31 => 14,  28 => 13,  26 => 12,  23 => 11,);
    }
}
