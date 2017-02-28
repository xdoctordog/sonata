<?php

/* SonataOrderBundle:Order:view.html.twig */
class __TwigTemplate_a8a746898ce0a08ea197e26a63ba5cccd461875e086700f9601e04e9b01c79c0 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
            'sonata_order_title' => array($this, 'block_sonata_order_title'),
            'sonata_order_top' => array($this, 'block_sonata_order_top'),
            'sonata_order_dates_statuses' => array($this, 'block_sonata_order_dates_statuses'),
            'sonata_order_dates' => array($this, 'block_sonata_order_dates'),
            'sonata_order_statuses' => array($this, 'block_sonata_order_statuses'),
            'sonata_order_top_right' => array($this, 'block_sonata_order_top_right'),
            'sonata_order_delivery' => array($this, 'block_sonata_order_delivery'),
            'sonata_order_billing' => array($this, 'block_sonata_order_billing'),
            'sonata_order_elements' => array($this, 'block_sonata_order_elements'),
            'sonata_order_elements_header' => array($this, 'block_sonata_order_elements_header'),
            'sonata_order_element' => array($this, 'block_sonata_order_element'),
            'product_thumbnail' => array($this, 'block_product_thumbnail'),
            'sonata_order_elements_sumup' => array($this, 'block_sonata_order_elements_sumup'),
            'sonata_order_footer' => array($this, 'block_sonata_order_footer'),
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
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.title_order", array(), "SonataOrderBundle");
        echo " - ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()), "html", null, true);
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
        $this->displayBlock('sonata_order_title', $context, $blocks);
        // line 29
        echo "
    ";
        // line 30
        $this->displayBlock('sonata_order_top', $context, $blocks);
        // line 127
        echo "
    ";
        // line 128
        $this->displayBlock('sonata_order_elements', $context, $blocks);
        // line 210
        echo "
    ";
        // line 211
        $this->displayBlock('sonata_order_footer', $context, $blocks);
        // line 213
        echo "
";
    }

    // line 20
    public function block_sonata_order_title($context, array $blocks = array())
    {
        // line 21
        echo "    <div class=\"row\">
        <div class=\"col-sm-3 col-sm-offset-9\" style=\"margin-bottom:15px;\">
            <p>
                <a href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_invoice_view", array("reference" => $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()))), "html", null, true);
        echo "\" class=\"btn btn-primary pull-right\"><i class=\"glyphicon glyphicon-file icon-white\"></i>&nbsp;";
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view_invoice", array(), "SonataOrderBundle");
        echo "</a>
            </p>
        </div>
    </div>
    ";
    }

    // line 30
    public function block_sonata_order_top($context, array $blocks = array())
    {
        // line 31
        echo "    <div class=\"row\">
        ";
        // line 32
        $this->displayBlock('sonata_order_dates_statuses', $context, $blocks);
        // line 93
        echo "    </div>
    <div class=\"row\">
        ";
        // line 95
        $this->displayBlock('sonata_order_top_right', $context, $blocks);
        // line 125
        echo "    </div>
    ";
    }

    // line 32
    public function block_sonata_order_dates_statuses($context, array $blocks = array())
    {
        // line 33
        echo "            <div class=\"col-sm-6\">
                ";
        // line 34
        $this->displayBlock('sonata_order_dates', $context, $blocks);
        // line 65
        echo "            </div>
            <div class=\"col-sm-6\">
                ";
        // line 67
        $this->displayBlock('sonata_order_statuses', $context, $blocks);
        // line 91
        echo "            </div>
        ";
    }

    // line 34
    public function block_sonata_order_dates($context, array $blocks = array())
    {
        // line 35
        echo "                    ";
        $context["date_time_size"] = twig_constant("IntlDateFormatter::SHORT");
        // line 36
        echo "                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4 class=\"panel-title\">";
        // line 39
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.subtitle_dates", array(), "SonataOrderBundle");
        echo "</h4>
                            </div>
                        </div>

                        <table class=\"table\">
                            <tr>
                                <th>";
        // line 45
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.created_at", array(), "SonataOrderBundle");
        echo "</th>
                                <td>";
        // line 46
        echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "createdAt", array()), null, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()), null, (isset($context["date_time_size"]) ? $context["date_time_size"] : null), (isset($context["date_time_size"]) ? $context["date_time_size"] : null));
        echo "</td>
                            </tr>
                            <tr>
                                <th>";
        // line 49
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.validated_at", array(), "SonataOrderBundle");
        echo "</th>
                                <td>
                                    ";
        // line 51
        if ($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "validatedAt", array())) {
            // line 52
            echo "                                        ";
            echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "validatedAt", array()), null, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()), null, (isset($context["date_time_size"]) ? $context["date_time_size"] : null), (isset($context["date_time_size"]) ? $context["date_time_size"] : null));
            echo "
                                    ";
        } else {
            // line 54
            echo "                                        /
                                    ";
        }
        // line 56
        echo "                                </td>
                            </tr>
                            <tr>
                                <th>";
        // line 59
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.updated_at", array(), "SonataOrderBundle");
        echo "</th>
                                <td>";
        // line 60
        echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "updatedAt", array()), null, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()), null, (isset($context["date_time_size"]) ? $context["date_time_size"] : null), (isset($context["date_time_size"]) ? $context["date_time_size"] : null));
        echo "</td>
                            </tr>
                        </table>
                    </div>
                ";
    }

    // line 67
    public function block_sonata_order_statuses($context, array $blocks = array())
    {
        // line 68
        echo "                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4 class=\"panel-title\">";
        // line 71
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.subtitle_statuses", array(), "SonataOrderBundle");
        echo "</h4>
                            </div>
                        </div>

                        <table class=\"table\">
                            <tr>
                                <th>";
        // line 77
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.order_status", array(), "SonataOrderBundle");
        echo "</th>
                                <td><span class=\"label";
        // line 78
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), null, "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), null, "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "statusName", array()), array(), "SonataOrderBundle"), "html", null, true);
        echo "</span></td>
                            </tr>
                            <tr>
                                <th>";
        // line 81
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.payment_status", array(), "SonataOrderBundle");
        echo "</th>
                                <td><span class=\"label";
        // line 82
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "paymentStatusName", array()), array(), "SonataPaymentBundle"), "html", null, true);
        echo "</span></td>
                            </tr>
                            <tr>
                                <th>";
        // line 85
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.delivery_status", array(), "SonataOrderBundle");
        echo "</th>
                                <td><span class=\"label";
        // line 86
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryStatusName", array()), array(), "SonataDeliveryBundle"), "html", null, true);
        echo "</span></td>
                            </tr>
                        </table>
                    </div>
                ";
    }

    // line 95
    public function block_sonata_order_top_right($context, array $blocks = array())
    {
        // line 96
        echo "            <div class=\"col-sm-6\">
                ";
        // line 97
        $this->displayBlock('sonata_order_delivery', $context, $blocks);
        // line 109
        echo "            </div>
            <div class=\"col-sm-6\">
                ";
        // line 111
        $this->displayBlock('sonata_order_billing', $context, $blocks);
        // line 123
        echo "            </div>
        ";
    }

    // line 97
    public function block_sonata_order_delivery($context, array $blocks = array())
    {
        // line 98
        echo "                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4 class=\"panel-title\">";
        // line 101
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.delivery_title", array(), "SonataOrderBundle");
        echo "</h4>
                            </div>
                        </div>
                        <div class=\"panel-body\">
                            ";
        // line 105
        echo $this->env->getExtension('sonata_address')->renderAddress($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryAsArray", array()));
        echo "
                        </div>
                    </div>
                ";
    }

    // line 111
    public function block_sonata_order_billing($context, array $blocks = array())
    {
        // line 112
        echo "                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4 class=\"panel-title\">";
        // line 115
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.billing_title", array(), "SonataOrderBundle");
        echo "</h4>
                            </div>
                        </div>
                        <div class=\"panel-body\">
                            ";
        // line 119
        echo $this->env->getExtension('sonata_address')->renderAddress($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "billingAsArray", array()));
        echo "
                        </div>
                    </div>
                ";
    }

    // line 128
    public function block_sonata_order_elements($context, array $blocks = array())
    {
        // line 129
        echo "    <!-- Elements -->
    <div class=\"clearfix\">&nbsp;</div>
    <div class=\"row\">
        <div class=\"col-sm-12\">
            <div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                    <h4 class=\"panel-title\">";
        // line 135
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.elements", array(), "SonataOrderBundle");
        echo "</h4>
                </div>

                <table class=\"table\">

                    ";
        // line 140
        $this->displayBlock('sonata_order_elements_header', $context, $blocks);
        // line 151
        echo "
                    <tbody>
                        ";
        // line 153
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "orderElements", array()));
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
            // line 154
            echo "                            <tr>
                                ";
            // line 155
            $this->displayBlock('sonata_order_element', $context, $blocks);
            // line 166
            echo "                            </tr>
                        ";
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
        // line 168
        echo "                        <tr>
                            <td><span class=\"glyphicon glyphicon-plane\" style=\"font-size:50px;\">&nbsp;</span></td>
                            <td>";
        // line 170
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.delivery", array(), "SonataOrderBundle");
        echo "</td>
                            <td class=\"number\">";
        // line 171
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryCost", array()), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</td>
                            <td class=\"number\">1</td>
                            <td class=\"number\">";
        // line 173
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryCost", array()), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</td>
                        </tr>
                    </tbody>

                    ";
        // line 177
        $this->displayBlock('sonata_order_elements_sumup', $context, $blocks);
        // line 203
        echo "
                </table>

            </div>
        </div>
    </div>
    ";
    }

    // line 140
    public function block_sonata_order_elements_header($context, array $blocks = array())
    {
        // line 141
        echo "                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>";
        // line 144
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.element.label", array(), "SonataOrderBundle");
        echo "</th>
                                <th>";
        // line 145
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.element.unit_price", array(), "SonataOrderBundle");
        echo "</th>
                                <th>";
        // line 146
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.element.quantity", array(), "SonataOrderBundle");
        echo "</th>
                                <th>";
        // line 147
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.total_inc", array(), "SonataOrderBundle");
        echo "</th>
                            </tr>
                        </thead>
                    ";
    }

    // line 155
    public function block_sonata_order_element($context, array $blocks = array())
    {
        // line 156
        echo "                                    <td>
                                        ";
        // line 157
        $this->displayBlock('product_thumbnail', $context, $blocks);
        // line 160
        echo "                                    </td>
                                    <td><a href=\"";
        // line 161
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_product_view", array("productId" => $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "productId", array()), "slug" => $this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "product", array()), "slug", array()))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "designation", array()), "html", null, true);
        echo "</a></td>
                                    <td class=\"number\">";
        // line 162
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "unitPrice", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</td>
                                    <td class=\"number\">";
        // line 163
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : null), "quantity", array()), "html", null, true);
        echo "</td>
                                    <td class=\"number\">";
        // line 164
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "total", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</td>
                                ";
    }

    // line 157
    public function block_product_thumbnail($context, array $blocks = array())
    {
        // line 158
        echo "                                            ";
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($this->getAttribute((isset($context["element"]) ? $context["element"] : null), "product", array()), "image", array()), "preview", array("itemprop" => "image", "class" => "img-rounded img-responsive"));
        // line 159
        echo "                                        ";
    }

    // line 177
    public function block_sonata_order_elements_sumup($context, array $blocks = array())
    {
        // line 178
        echo "                        <tfoot>
                            <tr>
                                <td colspan=\"3\" rowspan=\"";
        // line 180
        echo twig_escape_filter($this->env, (3 + twig_length_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "getVatAmounts", array()))), "html", null, true);
        echo "\">&nbsp;</td>
                                <th style=\"text-align: right\">";
        // line 181
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.total_excl", array(), "SonataOrderBundle");
        echo "</th>
                                <td class=\"number\"><b>";
        // line 182
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "totalExcl", array()), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</b></td>
                            </tr>

                            ";
        // line 185
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "getVatAmounts", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 186
            echo "                                <tr>
                                    <th style=\"text-align: right\">";
            // line 187
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata_order_view_vat", array(), "SonataOrderBundle");
            echo " ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["item"], "rate", array()), 2), "html", null, true);
            echo "%</th>
                                    <td class=\"number\"><b>";
            // line 188
            echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute($context["item"], "amount", array()), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
            echo "</b></td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 191
        echo "
                            <tr>
                                <th style=\"text-align: right\">";
        // line 193
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.total_vat", array(), "SonataOrderBundle");
        echo "</th>
                                <td class=\"number\"><b>";
        // line 194
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "vat", array()), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</b></td>
                            </tr>

                            <tr>
                                <th style=\"text-align: right\">";
        // line 198
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.total_inc", array(), "SonataOrderBundle");
        echo "</th>
                                <td class=\"number\"><b>";
        // line 199
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "totalInc", array()), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</b></td>
                            </tr>
                        </tfoot>
                    ";
    }

    // line 211
    public function block_sonata_order_footer($context, array $blocks = array())
    {
        // line 212
        echo "    ";
    }

    public function getTemplateName()
    {
        return "SonataOrderBundle:Order:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  569 => 212,  566 => 211,  558 => 199,  554 => 198,  547 => 194,  543 => 193,  539 => 191,  530 => 188,  524 => 187,  521 => 186,  517 => 185,  511 => 182,  507 => 181,  503 => 180,  499 => 178,  496 => 177,  492 => 159,  489 => 158,  486 => 157,  480 => 164,  476 => 163,  472 => 162,  466 => 161,  463 => 160,  461 => 157,  458 => 156,  455 => 155,  447 => 147,  443 => 146,  439 => 145,  435 => 144,  430 => 141,  427 => 140,  417 => 203,  415 => 177,  408 => 173,  403 => 171,  399 => 170,  395 => 168,  380 => 166,  378 => 155,  375 => 154,  358 => 153,  354 => 151,  352 => 140,  344 => 135,  336 => 129,  333 => 128,  325 => 119,  318 => 115,  313 => 112,  310 => 111,  302 => 105,  295 => 101,  290 => 98,  287 => 97,  282 => 123,  280 => 111,  276 => 109,  274 => 97,  271 => 96,  268 => 95,  257 => 86,  253 => 85,  245 => 82,  241 => 81,  233 => 78,  229 => 77,  220 => 71,  215 => 68,  212 => 67,  203 => 60,  199 => 59,  194 => 56,  190 => 54,  184 => 52,  182 => 51,  177 => 49,  171 => 46,  167 => 45,  158 => 39,  153 => 36,  150 => 35,  147 => 34,  142 => 91,  140 => 67,  136 => 65,  134 => 34,  131 => 33,  128 => 32,  123 => 125,  121 => 95,  117 => 93,  115 => 32,  112 => 31,  109 => 30,  98 => 24,  93 => 21,  90 => 20,  85 => 213,  83 => 211,  80 => 210,  78 => 128,  75 => 127,  73 => 30,  70 => 29,  68 => 20,  65 => 19,  62 => 18,  59 => 17,  51 => 15,  11 => 12,);
    }
}
