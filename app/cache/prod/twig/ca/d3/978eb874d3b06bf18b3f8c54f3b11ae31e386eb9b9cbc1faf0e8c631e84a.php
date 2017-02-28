<?php

/* SonataInvoiceBundle:Invoice:view.html.twig */
class __TwigTemplate_cad3978eb874d3b06bf18b3f8c54f3b11ae31e386eb9b9cbc1faf0e8c631e84a extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataUserBundle:Profile:action.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'sonata_profile_title' => array($this, 'block_sonata_profile_title'),
            'sonata_profile_content' => array($this, 'block_sonata_profile_content'),
            'content' => array($this, 'block_content'),
            'sonata_invoice_top_left' => array($this, 'block_sonata_invoice_top_left'),
            'sonata_invoice_top_right' => array($this, 'block_sonata_invoice_top_right'),
            'sonata_invoice_elements' => array($this, 'block_sonata_invoice_elements'),
            'sonata_invoice_elements_header' => array($this, 'block_sonata_invoice_elements_header'),
            'sonata_invoice_element_row' => array($this, 'block_sonata_invoice_element_row'),
            'sonata_invoice_elements_sumup' => array($this, 'block_sonata_invoice_elements_sumup'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataUserBundle:Profile:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 15
    public function block_sonata_profile_title($context, array $blocks = array())
    {
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.title_invoice", array(), "SonataInvoiceBundle");
        echo " - ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "reference", array()), "html", null, true);
    }

    // line 17
    public function block_sonata_profile_content($context, array $blocks = array())
    {
        // line 18
        echo "    ";
        // token for sonata_template_box, however the box is disabled
        // line 19
        echo "
    ";
        // line 20
        $this->displayBlock('content', $context, $blocks);
        // line 147
        echo "
    ";
        // line 148
        $this->displayBlock('footer', $context, $blocks);
        // line 153
        echo "
";
    }

    // line 20
    public function block_content($context, array $blocks = array())
    {
        // line 21
        echo "
        <!-- Invoice -->
        <div class=\"row\">
            ";
        // line 24
        $this->displayBlock('sonata_invoice_top_left', $context, $blocks);
        // line 39
        echo "
            <!-- References -->
            ";
        // line 41
        $this->displayBlock('sonata_invoice_top_right', $context, $blocks);
        // line 72
        echo "
        </div>

        ";
        // line 75
        $this->displayBlock('sonata_invoice_elements', $context, $blocks);
        // line 145
        echo "
    ";
    }

    // line 24
    public function block_sonata_invoice_top_left($context, array $blocks = array())
    {
        // line 25
        echo "                <!-- Billing address -->
                <div class=\"col-sm-6\">
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4 class=\"panel-title\">";
        // line 30
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.subtitle_billing", array(), "SonataInvoiceBundle");
        echo "</h4>
                            </div>
                        </div>
                        <div class=\"panel-body\">
                            ";
        // line 34
        echo $this->env->getExtension('sonata_address')->renderAddress($this->env, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "billingAsArray", array()));
        echo "
                        </div>
                    </div>
                </div>
            ";
    }

    // line 41
    public function block_sonata_invoice_top_right($context, array $blocks = array())
    {
        // line 42
        echo "                ";
        $context["date_time_size"] = twig_constant("IntlDateFormatter::SHORT");
        // line 43
        echo "
                <div class=\"col-sm-6\">
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4 class=\"panel-title\">";
        // line 48
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.subtitle_references", array(), "SonataInvoiceBundle");
        echo "</h4>
                            </div>
                        </div>
                        <table class=\"table\">
                            <tr>
                                <th>";
        // line 53
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.references.date", array(), "SonataInvoiceBundle");
        echo "</th>
                                <td>";
        // line 54
        echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "createdAt", array()), null, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "locale", array()), (isset($context["date_time_size"]) ? $context["date_time_size"] : null), (isset($context["date_time_size"]) ? $context["date_time_size"] : null));
        echo "</td>
                            </tr>
                            <tr>
                                <th>";
        // line 57
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.payment_status", array(), "SonataOrderBundle");
        echo "</th>
                                <td><span class=\"label";
        // line 58
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "paymentStatusName", array()), array(), "SonataPaymentBundle"), "html", null, true);
        echo "</span></td>
                            </tr>
                            <tr>
                                <th>";
        // line 61
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.delivery_status", array(), "SonataOrderBundle");
        echo "</th>
                                <td><span class=\"label";
        // line 62
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryStatusName", array()), array(), "SonataDeliveryBundle"), "html", null, true);
        echo "</span></td>
                            </tr>
                            <tr>
                                <th>";
        // line 65
        echo $this->env->getExtension('translator')->getTranslator()->trans("method", array(), "SonataPaymentBundle");
        echo "</th>
                                <td>";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "paymentMethod", array()), "html", null, true);
        echo "</td>
                            </tr>
                        </table>
                    </div>
                </div>
            ";
    }

    // line 75
    public function block_sonata_invoice_elements($context, array $blocks = array())
    {
        // line 76
        echo "            <!-- Invoice elements -->
            <div class=\"row\">
                <div class=\"col-sm-12\">
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4 class=\"panel-title\">";
        // line 82
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.elements.list.title", array(), "SonataInvoiceBundle");
        echo "</h4>
                            </div>
                        </div>

                        <table class=\"table\">

                            ";
        // line 88
        $this->displayBlock('sonata_invoice_elements_header', $context, $blocks);
        // line 98
        echo "
                            <tbody>
                                ";
        // line 100
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "invoiceElements", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
            // line 101
            echo "                                    ";
            $this->displayBlock('sonata_invoice_element_row', $context, $blocks);
            // line 109
            echo "                                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "                            </tbody>

                            ";
        // line 112
        $this->displayBlock('sonata_invoice_elements_sumup', $context, $blocks);
        // line 138
        echo "
                        </table>

                    </div>
                </div>
            </div>
        ";
    }

    // line 88
    public function block_sonata_invoice_elements_header($context, array $blocks = array())
    {
        // line 89
        echo "                                <thead>
                                    <tr>
                                        <th>";
        // line 91
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.elements.label", array(), "SonataInvoiceBundle");
        echo "</th>
                                        <th>";
        // line 92
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.elements.unit_price", array(), "SonataInvoiceBundle");
        echo "</th>
                                        <th>";
        // line 93
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.elements.quantity", array(), "SonataInvoiceBundle");
        echo "</th>
                                        <th>";
        // line 94
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.elements.total_inc_vat", array(), "SonataInvoiceBundle");
        echo "</th>
                                    </tr>
                                </thead>
                            ";
    }

    // line 101
    public function block_sonata_invoice_element_row($context, array $blocks = array())
    {
        // line 102
        echo "                                        <tr>
                                            <td>";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "designation", array()), "html", null, true);
        echo "</td>
                                            <td class=\"number\">";
        // line 104
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "unitPrice", array(0 => true), "method"), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "currency", array()), array(), array(), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "locale", array()));
        echo "</td>
                                            <td class=\"number\">";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "quantity", array()), "html", null, true);
        echo "</td>
                                            <td class=\"number\">";
        // line 106
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "total", array(0 => true), "method"), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "currency", array()), array(), array(), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "locale", array()));
        echo "</td>
                                        </tr>
                                    ";
    }

    // line 112
    public function block_sonata_invoice_elements_sumup($context, array $blocks = array())
    {
        // line 113
        echo "                                <tfoot>
                                    <tr>
                                        <td colspan=\"2\" rowspan=\"";
        // line 115
        echo twig_escape_filter($this->env, (3 + twig_length_filter($this->env, $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "getVatAmounts", array()))), "html", null, true);
        echo "\">&nbsp;</td>
                                        <th style=\"text-align: right\">";
        // line 116
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.total_exc_vat", array(), "SonataInvoiceBundle");
        echo "</th>
                                        <td class=\"number\"><b>";
        // line 117
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "totalExcl", array()), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "currency", array()), array(), array(), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "locale", array()));
        echo "</b></td>
                                    </tr>

                                    ";
        // line 120
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "getVatAmounts", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 121
            echo "                                        <tr>
                                            <th style=\"text-align: right\">";
            // line 122
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata_invoice_view_vat", array(), "SonataInvoiceBundle");
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["item"], "rate", array()), 2), "html", null, true);
            echo "%</th>
                                            <td class=\"number\"><b>";
            // line 123
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute($context["item"], "amount", array()), $this->getAttribute($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "locale", array()));
            echo "</b></td>
                                        </tr>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "
                                    <tr>
                                        <th style=\"text-align: right\">";
        // line 128
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.vat", array(), "SonataInvoiceBundle");
        echo "</th>
                                        <td class=\"number\"><b>";
        // line 129
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency(($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "totalInc", array()) - $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "totalExcl", array())), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "currency", array()), array(), array(), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "locale", array()));
        echo "</b></td>
                                    </tr>

                                    <tr>
                                        <th style=\"text-align: right\">";
        // line 133
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.invoice.total_inc_vat", array(), "SonataInvoiceBundle");
        echo "</th>
                                        <td class=\"number\"><b>";
        // line 134
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "totalInc", array()), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "currency", array()), array(), array(), $this->getAttribute((isset($context["invoice"]) ? $context["invoice"] : null), "locale", array()));
        echo "</b></td>
                                    </tr>
                                </tfoot>
                            ";
    }

    // line 148
    public function block_footer($context, array $blocks = array())
    {
        // line 149
        echo "
        ";
        // line 150
        echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('sonata_page')->controller("SonataPaymentBundle:Payment:terms"), array());
        // line 151
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "SonataInvoiceBundle:Invoice:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  403 => 151,  401 => 150,  398 => 149,  395 => 148,  387 => 134,  383 => 133,  376 => 129,  372 => 128,  368 => 126,  359 => 123,  353 => 122,  350 => 121,  346 => 120,  340 => 117,  336 => 116,  332 => 115,  328 => 113,  325 => 112,  318 => 106,  314 => 105,  310 => 104,  306 => 103,  303 => 102,  300 => 101,  292 => 94,  288 => 93,  284 => 92,  280 => 91,  276 => 89,  273 => 88,  263 => 138,  261 => 112,  257 => 110,  243 => 109,  240 => 101,  223 => 100,  219 => 98,  217 => 88,  208 => 82,  200 => 76,  197 => 75,  187 => 66,  183 => 65,  175 => 62,  171 => 61,  163 => 58,  159 => 57,  153 => 54,  149 => 53,  141 => 48,  134 => 43,  131 => 42,  128 => 41,  119 => 34,  112 => 30,  105 => 25,  102 => 24,  97 => 145,  95 => 75,  90 => 72,  88 => 41,  84 => 39,  82 => 24,  77 => 21,  74 => 20,  69 => 153,  67 => 148,  64 => 147,  62 => 20,  59 => 19,  56 => 18,  53 => 17,  45 => 15,  11 => 12,);
    }
}
