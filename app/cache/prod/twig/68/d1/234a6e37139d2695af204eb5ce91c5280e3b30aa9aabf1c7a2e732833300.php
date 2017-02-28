<?php

/* SonataProductBundle:Product:view.html.twig */
class __TwigTemplate_68d1234a6e37139d2695af204eb5ce91c5280e3b30aa9aabf1c7a2e732833300 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'product_javascript_init' => array($this, 'block_product_javascript_init'),
            'breadcrumb' => array($this, 'block_breadcrumb'),
            'product' => array($this, 'block_product'),
            'product_left' => array($this, 'block_product_left'),
            'product_carousel' => array($this, 'block_product_carousel'),
            'product_right' => array($this, 'block_product_right'),
            'product_title' => array($this, 'block_product_title'),
            'product_properties' => array($this, 'block_product_properties'),
            'product_generic_properties' => array($this, 'block_product_generic_properties'),
            'product_unit_price' => array($this, 'block_product_unit_price'),
            'product_reference' => array($this, 'block_product_reference'),
            'product_description_short' => array($this, 'block_product_description_short'),
            'product_errors' => array($this, 'block_product_errors'),
            'product_variations_form_block' => array($this, 'block_product_variations_form_block'),
            'product_delivery' => array($this, 'block_product_delivery'),
            'product_basket' => array($this, 'block_product_basket'),
            'product_cross' => array($this, 'block_product_cross'),
            'product_cross_selling' => array($this, 'block_product_cross_selling'),
            'product_full_description' => array($this, 'block_product_full_description'),
            'product_comments' => array($this, 'block_product_comments'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $context["variations_properties"] = ((array_key_exists("variations_properties", $context)) ? (_twig_default_filter((isset($context["variations_properties"]) ? $context["variations_properties"] : null), array())) : (array()));
        // line 13
        echo "
";
        // line 14
        $this->displayBlock('product_javascript_init', $context, $blocks);
        // line 31
        echo "
";
        // line 32
        $this->displayBlock('breadcrumb', $context, $blocks);
        // line 37
        echo "
";
        // line 38
        $this->displayBlock('product', $context, $blocks);
        // line 136
        echo "
";
        // line 137
        $this->displayBlock('product_cross', $context, $blocks);
        // line 146
        echo "
";
        // line 147
        $this->displayBlock('product_full_description', $context, $blocks);
        // line 157
        $this->displayBlock('product_comments', $context, $blocks);
    }

    // line 14
    public function block_product_javascript_init($context, array $blocks = array())
    {
        // line 15
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function() {
            Sonata.Product.init({
                url: {
                    infoStockPrice: '";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_product_price_stock", array("productId" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "id", array()))), "html", null, true);
        echo "'
                },
                targets: {
                    inputAddBasket:  \$('#add_basket_quantity'),
                    productPrice:    \$('#sonata_product_price'),
                    submitBasketBtn: \$('#sonata_add_basket_submit'),
                    addBasketError:  \$('#sonata_add_basket_error')
                }
            });
        });
    </script>
";
    }

    // line 32
    public function block_breadcrumb($context, array $blocks = array())
    {
        // line 33
        echo "    <div class=\"clearfix\">
        ";
        // line 34
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => "catalog", "product" => (isset($context["product"]) ? $context["product"] : null), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "requestUri", array()))));
        echo "
    </div>
";
    }

    // line 38
    public function block_product($context, array $blocks = array())
    {
        // line 39
        echo "    ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
        // line 40
        echo "    <!-- Begin product display -->
    <div class=\"row\">
        <div class=\"col-lg-12\">
            ";
        // line 43
        // token for sonata_template_box, however the box is disabled
        // line 44
        echo "        </div>
    </div>
    <div class=\"row\" itemscope itemtype=\"http://schema.org/Product\">
        ";
        // line 47
        $this->displayBlock('product_left', $context, $blocks);
        // line 60
        echo "        ";
        $this->displayBlock('product_right', $context, $blocks);
        // line 134
        echo "    </div>
";
    }

    // line 47
    public function block_product_left($context, array $blocks = array())
    {
        // line 48
        echo "            <div class=\"col-md-8\">
                ";
        // line 49
        $this->displayBlock('product_carousel', $context, $blocks);
        // line 58
        echo "            </div>
        ";
    }

    // line 49
    public function block_product_carousel($context, array $blocks = array())
    {
        // line 50
        echo "                    <div>
                        ";
        // line 51
        if (($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "gallery", array()) && (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "gallery", array()), "galleryHasMedias", array())) > 0))) {
            // line 52
            echo "                            ";
            $this->env->loadTemplate("SonataProductBundle:Product:carousel.html.twig")->display($context);
            // line 53
            echo "                        ";
        } else {
            // line 54
            echo "                            ";
            echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "image", array()), "large", array("itemprop" => "image", "class" => "img-rounded img-responsive", "style" => "margin: 0 10px 10px 0;"));
            // line 55
            echo "                        ";
        }
        // line 56
        echo "                    </div>
                ";
    }

    // line 60
    public function block_product_right($context, array $blocks = array())
    {
        // line 61
        echo "            <div class=\"col-md-4\">
                <div class=\"panel panel-primary\">
                    <div class=\"panel-heading\">
                        <h3 itemprop=\"name\" class=\"panel-title\">";
        // line 64
        $this->displayBlock('product_title', $context, $blocks);
        echo "</h3>
                    </div>

                    ";
        // line 67
        $this->displayBlock('product_properties', $context, $blocks);
        // line 105
        echo "
                    <div class=\"panel-footer\">
                        ";
        // line 107
        $this->displayBlock('product_variations_form_block', $context, $blocks);
        // line 114
        echo "
                        ";
        // line 115
        $this->displayBlock('product_delivery', $context, $blocks);
        // line 120
        echo "
                        ";
        // line 121
        if ($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "isSalable", array())) {
            // line 122
            echo "                            <div itemprop=\"offers\" class=\"row\" itemscope itemtype=\"http://schema.org/Offer\">
                                <div class=\"col-lg-12\">
                                    ";
            // line 124
            $this->displayBlock('product_basket', $context, $blocks);
            // line 127
            echo "                                </div>
                            </div>
                        ";
        }
        // line 130
        echo "                    </div>
                </div>
            </div>
        ";
    }

    // line 64
    public function block_product_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "name", array()), "html", null, true);
    }

    // line 67
    public function block_product_properties($context, array $blocks = array())
    {
        // line 68
        echo "                        <ul class=\"list-group\">
                            ";
        // line 69
        $this->displayBlock('product_generic_properties', $context, $blocks);
        // line 85
        echo "                            <li class=\"list-group-item\">
                                <span itemprop=\"description\">
                                    ";
        // line 87
        $this->displayBlock('product_description_short', $context, $blocks);
        // line 91
        echo "                                </span>
                            </li>
                            ";
        // line 93
        $this->displayBlock('product_errors', $context, $blocks);
        // line 103
        echo "                        </ul>
                    ";
    }

    // line 69
    public function block_product_generic_properties($context, array $blocks = array())
    {
        // line 70
        echo "                                <li class=\"list-group-item\">
                                    ";
        // line 71
        $this->displayBlock('product_unit_price', $context, $blocks);
        // line 77
        echo "                                    ";
        $this->displayBlock('product_reference', $context, $blocks);
        // line 83
        echo "                                </li>
                            ";
    }

    // line 71
    public function block_product_unit_price($context, array $blocks = array())
    {
        // line 72
        echo "                                        <small class=\"list-group-item-text\">
                                            ";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("product_price", array(), "SonataProductBundle"), "html", null, true);
        echo ":&nbsp;
                                            <span itemprop=\"price\">";
        // line 74
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->env->getExtension('sonata_product')->getProductPrice((isset($context["product"]) ? $context["product"] : null), (isset($context["currency"]) ? $context["currency"] : null), true), (isset($context["currency"]) ? $context["currency"] : null));
        echo "</span>
                                        </small><br/>
                                    ";
    }

    // line 77
    public function block_product_reference($context, array $blocks = array())
    {
        // line 78
        echo "                                        <small class=\"list-group-item-text\">
                                            ";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("product_reference", array(), "SonataProductBundle"), "html", null, true);
        echo ":&nbsp;
                                            <span itemprop=\"sku\">";
        // line 80
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "sku", array()), "html", null, true);
        echo "</span>
                                        </small>
                                    ";
    }

    // line 87
    public function block_product_description_short($context, array $blocks = array())
    {
        // line 88
        echo "                                        ";
        echo $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "shortDescription", array());
        echo "<br/>
                                        <a href=\"#fullDescription\">";
        // line 89
        echo $this->env->getExtension('translator')->getTranslator()->trans("product_full_description_link", array(), "SonataProductBundle");
        echo "</a>
                                    ";
    }

    // line 93
    public function block_product_errors($context, array $blocks = array())
    {
        // line 94
        echo "                                ";
        if (( !$this->getAttribute((isset($context["provider"]) ? $context["provider"] : null), "hasVariations", array(0 => (isset($context["product"]) ? $context["product"] : null)), "method") && ($this->env->getExtension('sonata_product')->getProductStock((isset($context["product"]) ? $context["product"] : null)) == 0))) {
            // line 95
            echo "                                    <li class=\"list-group-item\">
                                        <span class=\"text-danger\">
                                            ";
            // line 97
            echo $this->env->getExtension('translator')->getTranslator()->trans("product_out_of_stock", array(), "SonataProductBundle");
            // line 98
            echo "                                        </span>
                                    </li>
                                ";
        }
        // line 101
        echo "                                <li class=\"list-group-item text-danger\" id=\"sonata_add_basket_error\" style=\"display:none;\"></li>
                            ";
    }

    // line 107
    public function block_product_variations_form_block($context, array $blocks = array())
    {
        // line 108
        echo "                            <div class=\"row\">
                                <div class=\"col-lg-12\">
                                    ";
        // line 110
        echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => "sonata.product.block.variations_form"), array("product" => (isset($context["product"]) ? $context["product"] : null), "variations_properties" => (isset($context["variations_properties"]) ? $context["variations_properties"] : null), "form_field_options" => array("horizontal_input_wrapper_class" => "col-lg-4", "horizontal_label_class" => "control-label col-lg-8", "render_required_asterisk" => false))));
        echo "
                                </div>
                            </div>
                        ";
    }

    // line 115
    public function block_product_delivery($context, array $blocks = array())
    {
        // line 116
        echo "                            <div class=\"row\">
                                Block 'product_delivery' to override
                            </div>
                        ";
    }

    // line 124
    public function block_product_basket($context, array $blocks = array())
    {
        // line 125
        echo "                                        ";
        $this->env->loadTemplate("SonataBasketBundle:Basket:add_product_form.html.twig")->display($context);
        // line 126
        echo "                                    ";
    }

    // line 137
    public function block_product_cross($context, array $blocks = array())
    {
        // line 138
        echo "    <!-- Cross selling -->
    <div>
        ";
        // line 140
        $this->displayBlock('product_cross_selling', $context, $blocks);
        // line 143
        echo "    </div>
    <!-- End Cross selling -->
";
    }

    // line 140
    public function block_product_cross_selling($context, array $blocks = array())
    {
        // line 141
        echo "            ";
        $this->env->loadTemplate("SonataProductBundle:Product:view_similar.html.twig")->display($context);
        // line 142
        echo "        ";
    }

    // line 147
    public function block_product_full_description($context, array $blocks = array())
    {
        // line 148
        echo "    <div class=\"panel panel-primary\">
        <div class=\"panel-heading\">
            <h3 class=\"panel-title\"><a id=\"fullDescription\"></a>";
        // line 150
        echo $this->env->getExtension('translator')->getTranslator()->trans("product_full_description", array(), "SonataProductBundle");
        echo "</h3>
        </div>
        <div class=\"panel-body\">
            ";
        // line 153
        echo $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "description", array());
        echo "
        </div>
    </div>
";
    }

    // line 157
    public function block_product_comments($context, array $blocks = array())
    {
        // line 158
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.comment", array("id" => ("front-product-" . $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "id", array())))));
        echo "
";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Product:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  428 => 158,  425 => 157,  417 => 153,  411 => 150,  407 => 148,  404 => 147,  400 => 142,  397 => 141,  394 => 140,  388 => 143,  386 => 140,  382 => 138,  379 => 137,  375 => 126,  372 => 125,  369 => 124,  362 => 116,  359 => 115,  351 => 110,  347 => 108,  344 => 107,  339 => 101,  334 => 98,  332 => 97,  328 => 95,  325 => 94,  322 => 93,  316 => 89,  311 => 88,  308 => 87,  301 => 80,  297 => 79,  294 => 78,  291 => 77,  284 => 74,  280 => 73,  277 => 72,  274 => 71,  269 => 83,  266 => 77,  264 => 71,  261 => 70,  258 => 69,  253 => 103,  251 => 93,  247 => 91,  245 => 87,  241 => 85,  239 => 69,  236 => 68,  233 => 67,  227 => 64,  220 => 130,  215 => 127,  213 => 124,  209 => 122,  207 => 121,  204 => 120,  202 => 115,  199 => 114,  197 => 107,  193 => 105,  191 => 67,  185 => 64,  180 => 61,  177 => 60,  172 => 56,  169 => 55,  166 => 54,  163 => 53,  160 => 52,  158 => 51,  155 => 50,  152 => 49,  147 => 58,  145 => 49,  142 => 48,  139 => 47,  134 => 134,  131 => 60,  129 => 47,  124 => 44,  122 => 43,  117 => 40,  114 => 39,  111 => 38,  104 => 34,  101 => 33,  98 => 32,  82 => 19,  76 => 15,  73 => 14,  69 => 157,  67 => 147,  64 => 146,  62 => 137,  59 => 136,  57 => 38,  54 => 37,  52 => 32,  49 => 31,  47 => 14,  44 => 13,  42 => 12,  39 => 11,);
    }
}
