<?php

/* SonataOrderBundle:Order:index.html.twig */
class __TwigTemplate_31c5030184d0e9890b8d1daae0500775e6bf00a05e649b5315926faf1a5c0cc2 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
            'order_list_heading' => array($this, 'block_order_list_heading'),
            'order_list_row' => array($this, 'block_order_list_row'),
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
        echo $this->env->getExtension('translator')->getTranslator()->trans("order_list", array(), "SonataOrderBundle");
    }

    // line 17
    public function block_sonata_profile_content($context, array $blocks = array())
    {
        // line 18
        echo "
    ";
        // line 19
        // token for sonata_template_box, however the box is disabled
        // line 20
        echo "
    ";
        // line 21
        if ((twig_length_filter($this->env, (isset($context["orders"]) ? $context["orders"] : null)) > 0)) {
            // line 22
            echo "
        ";
            // line 23
            $context["looped"] = false;
            // line 24
            echo "
        ";
            // line 25
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["orders"]) ? $context["orders"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                if ((($this->getAttribute(                // line 26
$context["order"], "status", array()) === constant(get_class($context["order"])."::"."STATUS_PENDING")) || ($this->getAttribute($context["order"], "status", array()) === constant(get_class($context["order"])."::"."STATUS_OPEN")))) {
                    // line 27
                    echo "
            ";
                    // line 28
                    $context["looped"] = true;
                    // line 29
                    echo "
            ";
                    // line 30
                    if ($this->getAttribute($context["loop"], "first", array())) {
                        // line 31
                        echo "                <h3>";
                        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.in_progress_title", array(), "SonataOrderBundle");
                        echo "</h3>
                <table class=\"table table-bordered\" id=\"sonata-ecommerce-current-orders\">
                    ";
                        // line 33
                        $this->displayBlock("order_list_heading", $context, $blocks);
                        echo "
            ";
                    }
                    // line 35
                    echo "
            ";
                    // line 36
                    $this->displayBlock("order_list_row", $context, $blocks);
                    echo "
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "
        ";
            // line 39
            if ((isset($context["looped"]) ? $context["looped"] : null)) {
                // line 40
                echo "            ";
                $context["looped"] = false;
                // line 41
                echo "            </table>
        ";
            }
            // line 43
            echo "
        ";
            // line 44
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["orders"]) ? $context["orders"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                if (( !($this->getAttribute(                // line 45
$context["order"], "status", array()) === constant(get_class($context["order"])."::"."STATUS_PENDING")) &&  !($this->getAttribute($context["order"], "status", array()) === constant(get_class($context["order"])."::"."STATUS_OPEN")))) {
                    // line 46
                    echo "
            ";
                    // line 47
                    $context["looped"] = true;
                    // line 48
                    echo "
            ";
                    // line 49
                    if ($this->getAttribute($context["loop"], "first", array())) {
                        // line 50
                        echo "                <h3>";
                        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.done_title", array(), "SonataOrderBundle");
                        echo "</h3>
                <table class=\"table table-bordered\" id=\"sonata-ecommerce-past-orders\">
                    ";
                        // line 52
                        $this->displayBlock("order_list_heading", $context, $blocks);
                        echo "
            ";
                    }
                    // line 54
                    echo "
            ";
                    // line 55
                    $this->displayBlock("order_list_row", $context, $blocks);
                    echo "
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "
        ";
            // line 58
            if ((isset($context["looped"]) ? $context["looped"] : null)) {
                // line 59
                echo "            </table>
        ";
            }
            // line 61
            echo "
    ";
        } else {
            // line 63
            echo "        <p>";
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.list.no_orders", array(), "SonataOrderBundle");
            echo "</p>
    ";
        }
    }

    // line 68
    public function block_order_list_heading($context, array $blocks = array())
    {
        // line 69
        echo "    <tr>
        <th>";
        // line 70
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.reference", array(), "SonataOrderBundle");
        echo "</th>
        <th>";
        // line 71
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.created_at", array(), "SonataOrderBundle");
        echo "</th>
        <th>";
        // line 72
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.order_status", array(), "SonataOrderBundle");
        echo "</th>
        <th>";
        // line 73
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.payment_status", array(), "SonataOrderBundle");
        echo "</th>
        <th>";
        // line 74
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.delivery_status", array(), "SonataOrderBundle");
        echo "</th>
        <th>";
        // line 75
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.view.total_inc", array(), "SonataOrderBundle");
        echo "</th>
    </tr>
";
    }

    // line 79
    public function block_order_list_row($context, array $blocks = array())
    {
        // line 80
        echo "    <tr>
        <td><a href=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_order_view", array("reference" => $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()), "html", null, true);
        echo "</a></td>
        <td>";
        // line 82
        echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "createdAt", array()), null, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</td>
        <td><span class=\"label";
        // line 83
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), null, "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), null, "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "statusName", array()), array(), "SonataOrderBundle"), "html", null, true);
        echo "</span></td>
        <td><span class=\"label";
        // line 84
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "paymentStatusName", array()), array(), "SonataPaymentBundle"), "html", null, true);
        echo "</span></td>
        <td><span class=\"label";
        // line 85
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "danger"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryStatusName", array()), array(), "SonataDeliveryBundle"), "html", null, true);
        echo "</span></td>
        <td class=\"number\">";
        // line 86
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "totalInc", array()), $this->getAttribute($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "locale", array()));
        echo "</td>
    </tr>
";
    }

    public function getTemplateName()
    {
        return "SonataOrderBundle:Order:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  265 => 86,  259 => 85,  253 => 84,  247 => 83,  243 => 82,  237 => 81,  234 => 80,  231 => 79,  224 => 75,  220 => 74,  216 => 73,  212 => 72,  208 => 71,  204 => 70,  201 => 69,  198 => 68,  190 => 63,  186 => 61,  182 => 59,  180 => 58,  177 => 57,  165 => 55,  162 => 54,  157 => 52,  151 => 50,  149 => 49,  146 => 48,  144 => 47,  141 => 46,  139 => 45,  129 => 44,  126 => 43,  122 => 41,  119 => 40,  117 => 39,  114 => 38,  102 => 36,  99 => 35,  94 => 33,  88 => 31,  86 => 30,  83 => 29,  81 => 28,  78 => 27,  76 => 26,  66 => 25,  63 => 24,  61 => 23,  58 => 22,  56 => 21,  53 => 20,  51 => 19,  48 => 18,  45 => 17,  39 => 15,  11 => 12,);
    }
}
