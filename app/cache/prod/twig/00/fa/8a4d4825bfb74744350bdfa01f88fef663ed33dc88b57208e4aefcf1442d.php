<?php

/* SonataBasketBundle:Basket:final_review_step.html.twig */
class __TwigTemplate_00fa8a4d4825bfb74744350bdfa01f88fef663ed33dc88b57208e4aefcf1442d extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // token for sonata_template_box, however the box is disabled
        // line 13
        echo "
";
        // line 14
        $this->env->loadTemplate("SonataBasketBundle:Basket:stepper.html.twig")->display(array_merge($context, array("step" => "checkout")));
        // line 15
        echo "
<table class=\"table basket\">

    <thead>
        <tr>
            <th class=\"col-sm-2\">&nbsp;</th>
            <th class=\"col-sm-4\">";
        // line 21
        echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_information", array(), "SonataBasketBundle");
        echo "</th>
            <th class=\"col-sm-2\">";
        // line 22
        echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_unit_price", array(), "SonataBasketBundle");
        echo "</th>
            <th class=\"col-sm-2\">";
        // line 23
        echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_quantity", array(), "SonataBasketBundle");
        echo "</th>
            <th>";
        // line 24
        echo $this->env->getExtension('translator')->getTranslator()->trans("header_basket_total_inc", array(), "SonataBasketBundle");
        echo "</th>
        </tr>
    </thead>

    <tbody>
        ";
        // line 30
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "BasketElements", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["basketElement"]) {
            // line 31
            echo "            ";
            echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('sonata_page')->controller("SonataProductBundle:Product:renderFinalReviewBasketElement", array("basketElement" =>             // line 32
$context["basketElement"], "basket" =>             // line 33
(isset($context["basket"]) ? $context["basket"] : null))), array());
            // line 35
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basketElement'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "
        <tr>
            <td><span class=\"glyphicon glyphicon-plane\" style=\"font-size:50px;\">&nbsp;</span></td>
            <td>
                <b>";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.label_delivery_charge", array(), "SonataBasketBundle"), "html", null, true);
        echo "</b>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class=\"number\">";
        // line 44
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getDeliveryPrice", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "</td>
        </tr>
    </tbody>

    <tfoot>
        <tr>
            <td colspan=\"3\" rowspan=\"";
        // line 50
        echo twig_escape_filter($this->env, (3 + twig_length_filter($this->env, $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getVatAmounts", array()))), "html", null, true);
        echo "\"></td>
            <th style=\"text-align: right\">";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.total_wo_vat", array(), "SonataBasketBundle"), "html", null, true);
        echo "</th>
            <td class=\"number\"><b>";
        // line 52
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getTotal", array(0 => false), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "</b></td>
        </tr>

        ";
        // line 55
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getVatAmounts", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 56
            echo "            <tr>
                <th style=\"text-align: right\">";
            // line 57
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("footer_basket_vat", array(), "SonataBasketBundle"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "rate", array()), "html", null, true);
            echo "%</th>
                <td class=\"number\"><b>";
            // line 58
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute($context["item"], "amount", array()), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
            echo "</b></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "
        <tr>
            <th style=\"text-align: right\">";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.total_vat", array(), "SonataBasketBundle"), "html", null, true);
        echo "</th>
            <td class=\"number\"><b>";
        // line 64
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getVatAmount", array(), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "</b></td>
        </tr>

        <tr>
            <th style=\"text-align: right\">";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.total_w_vat", array(), "SonataBasketBundle"), "html", null, true);
        echo "</th>
            <td class=\"number\"><b>";
        // line 69
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "getTotal", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "</b></td>
        </tr>
    </tfoot>

</table>

<div class=\"row\">
    <!-- Delivery address -->
    <div class=\"col-sm-6\">
        <div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
                <div class=\"panel-title\">
                    ";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_address_delivery_step_basket", array(), "SonataBasketBundle"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"panel-body\">
                ";
        // line 85
        if ($this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "deliverymethod", array()), "isAddressRequired", array(), "method")) {
            // line 86
            echo "                    <address>
                        <strong>";
            // line 87
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "deliveryaddress", array()), "name", array()), "html", null, true);
            echo "</strong><br/>
                        ";
            // line 88
            echo $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "deliveryaddress", array()), "getFullAddress", array(0 => "<br />"), "method");
            echo "
                    </address>
                ";
        } else {
            // line 91
            echo "                    <i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_delivery_address_not_required", array(), "SonataBasketBundle"), "html", null, true);
            echo "</i>
                ";
        }
        // line 93
        echo "            </div>
        </div>
    </div>

    <!-- Payment address -->
    <div class=\"col-sm-6\">
        <div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
                <div class=\"panel-title\">
                    ";
        // line 102
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_address_billing_step_basket", array(), "SonataBasketBundle"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"panel-body\">
                <address>
                    <strong>";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "billingaddress", array()), "name", array()), "html", null, true);
        echo "</strong><br/>
                    ";
        // line 108
        echo $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "billingaddress", array()), "getFullAddress", array(0 => "<br />"), "method");
        echo "
                </address>
            </div>
        </div>
    </div>
</div>

<div class=\"row\">
    <!-- Delivery information -->
    <div class=\"col-sm-6\">
        <div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
                <div class=\"panel-title\">
                    ";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_delivery_method", array(), "SonataBasketBundle"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"panel-body\">
                ";
        // line 125
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "deliverymethod", array()), "name", array()), "html", null, true);
        echo "
            </div>
        </div>
    </div>

    <!-- Payment information -->
    <div class=\"col-sm-6\">
        <div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
                <div class=\"panel-title\">
                    ";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_payment_method", array(), "SonataBasketBundle"), "html", null, true);
        echo "
                </div>
            </div>
            <div class=\"panel-body\">
                ";
        // line 139
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "paymentmethod", array()), "name", array()), "html", null, true);
        echo "
            </div>
        </div>
    </div>
</div>

<form action=\"";
        // line 145
        echo $this->env->getExtension('routing')->getUrl("sonata_basket_final");
        echo "\" method=\"POST\" onsubmit=\"ctrlForm(this)\">
    <div class=\"alert alert-info text-center\">
        <h4>
            <a href=\"";
        // line 148
        echo $this->env->getExtension('routing')->getPath("sonata_payment_terms");
        echo "\" target=\"_blank\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.link_terms_and_condition", array(), "SonataBasketBundle"), "html", null, true);
        echo "</a>
        </h4>
        <label for=\"basket_tac\">
            <input type=\"checkbox\" name=\"tac\" id=\"basket_tac\"/>
            ";
        // line 152
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.label_terms_and_condition", array(), "SonataBasketBundle"), "html", null, true);
        echo "
        </label>

        <div>
            <input type=\"submit\" value=\"";
        // line 156
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.label_process_to_payment", array(), "SonataBasketBundle"), "html", null, true);
        echo "\" class=\"btn btn-primary\" />
        </div>
    </div>
</form>

<script>
    function ctrlForm(form) {
        if (!form.tac.checked) {
            alert(\"";
        // line 164
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.label_confirm_tac", array(), "SonataBasketBundle"), "html", null, true);
        echo "\");

            return false;
        }

        return true;
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:final_review_step.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  301 => 164,  290 => 156,  283 => 152,  274 => 148,  268 => 145,  259 => 139,  252 => 135,  239 => 125,  232 => 121,  216 => 108,  212 => 107,  204 => 102,  193 => 93,  187 => 91,  181 => 88,  177 => 87,  174 => 86,  172 => 85,  165 => 81,  150 => 69,  146 => 68,  139 => 64,  135 => 63,  131 => 61,  122 => 58,  116 => 57,  113 => 56,  109 => 55,  103 => 52,  99 => 51,  95 => 50,  86 => 44,  79 => 40,  73 => 36,  67 => 35,  65 => 33,  64 => 32,  62 => 31,  57 => 30,  49 => 24,  45 => 23,  41 => 22,  37 => 21,  29 => 15,  27 => 14,  24 => 13,  22 => 12,  19 => 11,);
    }
}
