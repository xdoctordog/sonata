<?php

/* SonataBasketBundle:Basket:add_product_form_button.html.twig */
class __TwigTemplate_ffabb366d2c69ba2e365bd5a7775bb95d4d002468f860e46c76e96e0eb422993 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 14
        try {
            $this->parent = $this->env->loadTemplate("SonataBasketBundle:Basket:add_product_form.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(14);

            throw $e;
        }

        $this->blocks = array(
            'add_product_form_content' => array($this, 'block_add_product_form_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataBasketBundle:Basket:add_product_form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 12
        $context["provider"] = $this->env->getExtension('sonata_product')->getProductProvider((isset($context["product"]) ? $context["product"] : null));
        // line 14
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 16
    public function block_add_product_form_content($context, array $blocks = array())
    {
        // line 17
        echo "    ";
        if ($this->env->getExtension('sonata_product')->hasVariations((isset($context["product"]) ? $context["product"] : null))) {
            // line 18
            echo "        <a class=\"btn btn-primary btn-sm pull-right\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_product_view", array("productId" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "id", array()), "slug" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "slug", array()))), "html", null, true);
            echo "\">
            <i class=\"glyphicon glyphicon-search icon-white\"></i> ";
            // line 19
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.product.btn_see", array(), "SonataProductBundle");
            // line 20
            echo "        </a>
    ";
        } else {
            // line 22
            echo "        ";
            if (($this->env->getExtension('sonata_product')->getProductStock((isset($context["product"]) ? $context["product"] : null)) == 0)) {
                // line 23
                echo "            <a class=\"btn btn-primary btn-sm pull-right\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_product_view", array("productId" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "id", array()), "slug" => $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "slug", array()))), "html", null, true);
                echo "\">
                <i class=\"glyphicon glyphicon-search icon-white\"></i> ";
                // line 24
                echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.product.btn_see", array(), "SonataProductBundle");
                // line 25
                echo "            </a>
        ";
            } else {
                // line 27
                echo "            ";
                $context["form"] = $this->env->getExtension('sonata_product')->getFormAddBasket((isset($context["product"]) ? $context["product"] : null));
                // line 28
                echo "
            <form id=\"form_add_basket\" class=\"form-horizontal\" action=\"";
                // line 29
                echo $this->env->getExtension('routing')->getUrl("sonata_basket_add_product");
                echo "\" method=\"POST\"";
                if ($this->getAttribute((isset($context["provider"]) ? $context["provider"] : null), "getOption", array(0 => "product_add_modal"), "method")) {
                    echo " data-target=\"#add_basket_modal_";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["product"]) ? $context["product"] : null), "id", array()), "html", null, true);
                    echo "\"";
                }
                echo ">
                <button type=\"submit\" class=\"btn btn-primary btn-sm pull-right\" id=\"sonata_add_basket_submit\"";
                // line 30
                if (($this->env->getExtension('sonata_product')->getProductStock((isset($context["product"]) ? $context["product"] : null)) == 0)) {
                    echo " disabled";
                }
                echo ">
                    <i class=\"glyphicon glyphicon-shopping-cart icon-white\"></i> ";
                // line 31
                echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.product.btn_add", array(), "SonataProductBundle");
                // line 32
                echo "                </button>

                ";
                // line 34
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
                echo "
            </form>
        ";
            }
            // line 37
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:add_product_form_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 37,  98 => 34,  94 => 32,  92 => 31,  86 => 30,  76 => 29,  73 => 28,  70 => 27,  66 => 25,  64 => 24,  59 => 23,  56 => 22,  52 => 20,  50 => 19,  45 => 18,  42 => 17,  39 => 16,  35 => 14,  33 => 12,  11 => 14,);
    }
}
