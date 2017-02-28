<?php

/* SonataOrderBundle:Block:recent_orders.html.twig */
class __TwigTemplate_4aaec8b7bec4f440b618241450b848a594536a50b96d45fdd8eaca3caf9ddde4 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 11
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : null), "templates", array()), "block_base", array()));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        // line 14
        echo "
    <div class=\"sonata-order-block-recent-order panel panel-default\">
        ";
        // line 16
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array())) {
            // line 17
            echo "            <div class=\"panel-heading\">
                <h3 class=\"panel-title sonata-order-block-recent-order\"><i class=\"fa fa-barcode\"></i> ";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array()), "html", null, true);
            echo "</h3>
            </div>
        ";
        }
        // line 21
        echo "

        <div class=\"panel-body\">

            ";
        // line 25
        // token for sonata_template_box, however the box is disabled
        // line 26
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["orders"]) ? $context["orders"] : null)) > 0)) {
            // line 27
            echo "                <table class=\"sonata-order-block-order-container table table-condensed\">
                    ";
            // line 28
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["orders"]) ? $context["orders"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 29
                echo "                        <tr>
                            ";
                // line 30
                if (($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "getSetting", array(0 => "mode"), "method") == "admin")) {
                    // line 31
                    echo "                                <td><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_sonata_order_order_edit", array("id" => $this->getAttribute($context["order"], "id", array()))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "reference", array()), "html", null, true);
                    echo "</a></td>
                            ";
                } else {
                    // line 33
                    echo "                                <td><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_order_view", array("reference" => $this->getAttribute($context["order"], "reference", array()))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["order"], "reference", array()), "html", null, true);
                    echo "</a></td>
                            ";
                }
                // line 35
                echo "                            <td class=\"number\">";
                echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute($context["order"], "totalInc", array()), $this->getAttribute($this->getAttribute($context["order"], "currency", array()), "label", array()));
                echo "</td>
                            <td><span class=\"label";
                // line 36
                echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass($context["order"], null, "danger")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass($context["order"], null, "danger"))) : ("")), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($context["order"], "statusName", array()), array(), "SonataOrderBundle"), "html", null, true);
                echo "</span></td>
                            <td>";
                // line 37
                echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute($context["order"], "createdAt", array()), null, $this->getAttribute($context["order"], "locale", array()));
                echo "</td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "                </table>

                ";
            // line 42
            if (($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "getSetting", array(0 => "mode"), "method") == "admin")) {
                // line 43
                echo "                    <a href=\"";
                echo $this->env->getExtension('routing')->getUrl("admin_sonata_order_order_list");
                echo "\" class=\"btn btn-primary btn-block\"><i class=\"fa fa-list\"></i>&nbsp;";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("view_all_orders", array(), "SonataOrderBundle"), "html", null, true);
                echo "</a>
                ";
            } else {
                // line 45
                echo "                    <a href=\"";
                echo $this->env->getExtension('routing')->getUrl("sonata_order_index");
                echo "\" class=\"btn btn-primary btn-block\"><i class=\"fa fa-list\"></i>&nbsp;";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("view_all_orders", array(), "SonataOrderBundle"), "html", null, true);
                echo "</a>
                ";
            }
            // line 47
            echo "            ";
        } else {
            // line 48
            echo "                ";
            if (($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "getSetting", array(0 => "mode"), "method") == "admin")) {
                // line 49
                echo "                    <p>";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_order_found", array(), "SonataOrderBundle"), "html", null, true);
                echo "</p>
                ";
            } else {
                // line 51
                echo "                    <p>";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.order.list.no_orders", array(), "SonataOrderBundle"), "html", null, true);
                echo "</p>
                ";
            }
            // line 53
            echo "            ";
        }
        // line 54
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataOrderBundle:Block:recent_orders.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 54,  144 => 53,  138 => 51,  132 => 49,  129 => 48,  126 => 47,  118 => 45,  110 => 43,  108 => 42,  104 => 40,  95 => 37,  89 => 36,  84 => 35,  76 => 33,  68 => 31,  66 => 30,  63 => 29,  59 => 28,  56 => 27,  53 => 26,  51 => 25,  45 => 21,  39 => 18,  36 => 17,  34 => 16,  30 => 14,  27 => 13,  18 => 11,);
    }
}
