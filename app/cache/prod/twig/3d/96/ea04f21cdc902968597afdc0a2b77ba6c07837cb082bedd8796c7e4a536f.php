<?php

/* SonataBasketBundle:Basket:index.html.twig */
class __TwigTemplate_3d96ea04f21cdc902968597afdc0a2b77ba6c07837cb082bedd8796c7e4a536f extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_flash_messages' => array($this, 'block_sonata_flash_messages'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $this->displayBlock('sonata_flash_messages', $context, $blocks);
        // line 15
        echo "
";
        // line 16
        // token for sonata_template_box, however the box is disabled
        // line 17
        echo "
";
        // line 18
        $this->env->loadTemplate("SonataBasketBundle:Basket:stepper.html.twig")->display(array_merge($context, array("step" => "basket")));
        // line 19
        echo "
";
        // line 20
        if ($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "hasBasketElements", array())) {
            // line 21
            echo "
    ";
            // line 22
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
            echo "

    <form action=\"";
            // line 24
            echo $this->env->getExtension('routing')->getUrl("sonata_basket_update");
            echo "\" method=\"POST\" novalidate=\"novalidate\">

        <table class=\"table basket\">

            <thead>
                <tr>
                    <th class=\"col-sm-6\">";
            // line 30
            echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_information", array(), "SonataBasketBundle");
            echo "</th>
                    <th>";
            // line 31
            echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_unit_price", array(), "SonataBasketBundle");
            echo "</th>
                    <th class=\"col-sm-1\">";
            // line 32
            echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_quantity", array(), "SonataBasketBundle");
            echo "</th>
                    <th>";
            // line 33
            echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_total_inc", array(), "SonataBasketBundle");
            echo "</th>
                    <th>";
            // line 34
            echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_delete", array(), "SonataBasketBundle");
            echo "</th>
                </tr>
            </thead>

            <tbody>
                ";
            // line 40
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getBasketElements", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["basketElement"]) {
                // line 41
                echo "                    ";
                echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('sonata_page')->controller("SonataProductBundle:Product:renderFormBasketElement", array("formView" => $this->getAttribute($this->getAttribute($this->getAttribute(                // line 42
(isset($context["form"]) ? $context["form"] : null), "basketElements", array()), "children", array()), $this->getAttribute($context["basketElement"], "position", array()), array(), "array"), "basketElement" =>                 // line 43
$context["basketElement"], "basket" =>                 // line 44
(isset($context["basket"]) ? $context["basket"] : null))), array());
                // line 46
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basketElement'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "
                ";
            // line 49
            echo "                ";
            $context["dummy"] = $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "basketElements", array()), "setrendered", array());
            // line 50
            echo "            </tbody>

            <tfoot>
                <tr>
                    <td colspan=\"3\" rowspan=\"";
            // line 54
            echo twig_escape_filter($this->env, (3 + twig_length_filter($this->env, $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getVatAmounts", array()))), "html", null, true);
            echo "\"></td>
                    <th style=\"text-align: right\">";
            // line 55
            echo $this->env->getExtension('translator')->getTranslator()->trans("footer_basket_total_excl", array(), "SonataBasketBundle");
            echo "</th>
                    <td colspan=\"2\" class=\"number\"><b>";
            // line 56
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getTotal", array(0 => false), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
            echo "</b></td>
                </tr>

                ";
            // line 59
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getVatAmounts", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 60
                echo "                    <tr>
                        <th style=\"text-align: right\">";
                // line 61
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("footer_basket_vat", array(), "SonataBasketBundle"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "rate", array()), "html", null, true);
                echo "%</th>
                        <td colspan=\"2\" class=\"number\"><b>";
                // line 62
                echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute($context["item"], "amount", array()), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
                echo "</b></td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 65
            echo "
                <tr>
                    <th style=\"text-align: right\">";
            // line 67
            echo $this->env->getExtension('translator')->getTranslator()->trans("footer_basket_total_vat", array(), "SonataBasketBundle");
            echo "</th>
                    <td colspan=\"2\" class=\"number\"><b>";
            // line 68
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getVatAmount", array(), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
            echo "</b></td>
                </tr>

                <tr>
                    <th style=\"text-align: right\">";
            // line 72
            echo $this->env->getExtension('translator')->getTranslator()->trans("footer_basket_total_inc", array(), "SonataBasketBundle");
            echo "</th>
                    <td colspan=\"2\" class=\"number\"><b>";
            // line 73
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getTotal", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
            echo "</b></td>
                </tr>
            </tfoot>

        </table>

        <div class=\"well\">
            <button type=\"submit\" class=\"btn btn-success\"><i class=\"glyphicon glyphicon-refresh icon-white\"></i>&nbsp;";
            // line 80
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.basket.btn_update_basket", array(), "SonataBasketBundle");
            echo "</button>

            <a href=\"";
            // line 82
            echo $this->env->getExtension('routing')->getUrl("sonata_basket_delivery_address");
            echo "\" class=\"btn btn-primary pull-right sonata-basket-nextstep\"";
            if ( !twig_test_empty($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "errors", array()))) {
                echo " disabled";
            }
            echo ">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.basket.link_next_step", array(), "SonataBasketBundle");
            echo "&nbsp;<i class=\"glyphicon glyphicon-arrow-right icon-white\"></i></a>
        </div>

        ";
            // line 85
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
            echo "
    </form>

    ";
            // line 88
            $context["single_basket_element"] = twig_last($this->env, $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "basketElements", array()));
            // line 89
            echo "    ";
            echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => "sonata.product.block.similar_products", "settings" => array("number" => 4, "base_product_id" => $this->getAttribute((isset($context["single_basket_element"]) ? $context["single_basket_element"] : null), "productId", array())))));
            echo "

";
        } else {
            // line 92
            echo "
    <div class=\"well\" style=\"text-align: center; padding: 40px; margin: 20px;\">
        <p>
            ";
            // line 95
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.basket.message_basket_is_empty", array(), "SonataBasketBundle");
            echo ".
            <br />
            <a href=\"";
            // line 97
            echo $this->env->getExtension('routing')->getPath("sonata_catalog_index");
            echo "\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.basket.message_basket_go_back_shopping", array(), "SonataBasketBundle");
            echo "</a>.
        </p>
    </div>

    ";
            // line 101
            echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => "sonata.product.block.recent_products", "settings" => array("number" => 4))));
            echo "

";
        }
    }

    // line 12
    public function block_sonata_flash_messages($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  237 => 13,  234 => 12,  226 => 101,  217 => 97,  212 => 95,  207 => 92,  200 => 89,  198 => 88,  192 => 85,  180 => 82,  175 => 80,  165 => 73,  161 => 72,  154 => 68,  150 => 67,  146 => 65,  137 => 62,  131 => 61,  128 => 60,  124 => 59,  118 => 56,  114 => 55,  110 => 54,  104 => 50,  101 => 49,  98 => 47,  92 => 46,  90 => 44,  89 => 43,  88 => 42,  86 => 41,  81 => 40,  73 => 34,  69 => 33,  65 => 32,  61 => 31,  57 => 30,  48 => 24,  43 => 22,  40 => 21,  38 => 20,  35 => 19,  33 => 18,  30 => 17,  28 => 16,  25 => 15,  23 => 12,  20 => 11,);
    }
}
