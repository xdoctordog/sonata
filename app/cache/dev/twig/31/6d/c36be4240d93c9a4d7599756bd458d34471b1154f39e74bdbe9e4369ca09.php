<?php

/* SonataBasketBundle:Basket:add_product_form.html.twig */
class __TwigTemplate_316dc36be4240d93c9a4d7599756bd458d34471b1154f39e74bdbe9e4369ca09 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'product_javascript_init' => array($this, 'block_product_javascript_init'),
            'product_add_basket_modal' => array($this, 'block_product_add_basket_modal'),
            'add_product_form_content' => array($this, 'block_add_product_form_content'),
            'product_price_price' => array($this, 'block_product_price_price'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        if ($this->getAttribute((isset($context["provider"]) ? $context["provider"] : $this->getContext($context, "provider")), "getOption", array(0 => "product_add_modal"), "method")) {
            // line 13
            echo "    ";
            $this->displayBlock('product_javascript_init', $context, $blocks);
            // line 16
            echo "
    ";
            // line 17
            $this->displayBlock('product_add_basket_modal', $context, $blocks);
        }
        // line 25
        echo "

";
        // line 27
        $this->displayBlock('add_product_form_content', $context, $blocks);
    }

    // line 13
    public function block_product_javascript_init($context, array $blocks = array())
    {
        // line 14
        echo "        <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatabasket/modal.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    ";
    }

    // line 17
    public function block_product_add_basket_modal($context, array $blocks = array())
    {
        // line 18
        echo "    <div class=\"row\">
        <div class=\"col-lg-12\">
            <div id=\"add_basket_modal_";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : $this->getContext($context, "product")), "id", array()), "html", null, true);
        echo "\" class=\"modal fade\"></div>
        </div>
    </div>
    ";
    }

    // line 27
    public function block_add_product_form_content($context, array $blocks = array())
    {
        // line 28
        echo "    <div class=\"row\">
        <div class=\"col-lg-12\">
            <form id=\"form_add_basket\" class=\"form-horizontal\" action=\"";
        // line 30
        echo $this->env->getExtension('routing')->getUrl("sonata_basket_add_product");
        echo "\" method=\"POST\"";
        if ($this->getAttribute((isset($context["provider"]) ? $context["provider"] : $this->getContext($context, "provider")), "getOption", array(0 => "product_add_modal"), "method")) {
            echo " data-target=\"#add_basket_modal_";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : $this->getContext($context, "product")), "id", array()), "html", null, true);
            echo "\"";
        }
        echo ">

                ";
        // line 32
        if (($this->env->getExtension('sonata_product')->getProductStock((isset($context["product"]) ? $context["product"] : $this->getContext($context, "product"))) == 0)) {
            // line 33
            echo "                    ";
            $context["quantityAttrs"] = array("min" => 1, "disabled" => true);
            // line 34
            echo "                ";
        } else {
            // line 35
            echo "                    ";
            $context["quantityAttrs"] = array("min" => 1);
            // line 36
            echo "                ";
        }
        // line 37
        echo "
                ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "quantity", array()), 'row', array("label" => $this->env->getExtension('translator')->trans("form_label_quantity", array(), "SonataBasketBundle"), "attr" => (isset($context["quantityAttrs"]) ? $context["quantityAttrs"] : $this->getContext($context, "quantityAttrs")), "horizontal_input_wrapper_class" => "col-lg-4", "horizontal_label_class" => "control-label col-lg-8", "render_required_asterisk" => false));
        echo "

                <div class=\"form-group\">
                    <div class=\"col-lg-6 col-xs-6\">
                        <span id=\"sonata_product_price\" class=\"lead\">
                            ";
        // line 43
        $this->displayBlock('product_price_price', $context, $blocks);
        // line 50
        echo "                        </span>
                    </div>
                    <div class=\"col-lg-6 col-xs-6\">
                        <button type=\"submit\" class=\"btn btn-primary btn-sm pull-right\" id=\"sonata_add_basket_submit\"";
        // line 53
        if (($this->env->getExtension('sonata_product')->getProductStock((isset($context["product"]) ? $context["product"] : $this->getContext($context, "product"))) == 0)) {
            echo " disabled";
        }
        echo ">
                            <i class=\"glyphicon glyphicon-shopping-cart icon-white\"></i> ";
        // line 54
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.product.btn_add_to_basket", array(), "SonataProductBundle");
        // line 55
        echo "                        </button>
                    </div>
                </div>

                ";
        // line 59
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
            </form>
        </div>
    </div>
";
    }

    // line 43
    public function block_product_price_price($context, array $blocks = array())
    {
        // line 44
        echo "                                ";
        if ($this->getAttribute((isset($context["provider"]) ? $context["provider"] : $this->getContext($context, "provider")), "hasEnabledVariations", array(0 => (isset($context["product"]) ? $context["product"] : $this->getContext($context, "product"))), "method")) {
            // line 45
            echo "                                    ";
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["cheapest_variation"]) ? $context["cheapest_variation"] : $this->getContext($context, "cheapest_variation")), "price", array()), (isset($context["currency"]) ? $context["currency"] : $this->getContext($context, "currency")));
            echo "
                                ";
        } else {
            // line 47
            echo "                                    ";
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->env->getExtension('sonata_product')->getProductPrice((isset($context["product"]) ? $context["product"] : $this->getContext($context, "product")), (isset($context["currency"]) ? $context["currency"] : $this->getContext($context, "currency")), true), (isset($context["currency"]) ? $context["currency"] : $this->getContext($context, "currency")));
            echo "
                                ";
        }
        // line 49
        echo "                            ";
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:add_product_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 49,  155 => 47,  149 => 45,  146 => 44,  143 => 43,  134 => 59,  128 => 55,  126 => 54,  120 => 53,  115 => 50,  113 => 43,  105 => 38,  102 => 37,  99 => 36,  96 => 35,  93 => 34,  90 => 33,  88 => 32,  77 => 30,  73 => 28,  70 => 27,  62 => 20,  58 => 18,  55 => 17,  48 => 14,  45 => 13,  41 => 27,  37 => 25,  34 => 17,  31 => 16,  28 => 13,  26 => 12,  23 => 11,);
    }
}
