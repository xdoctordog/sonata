<?php

/* SonataPaymentBundle:Payment:debug.html.twig */
class __TwigTemplate_7e3ffbceba182318037aa6e814f081207beec80eee68d01a92e9374d643434b3 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 1
        echo "<h1>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_title", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</h1>

<div class=\"alert alert-danger\">
    <strong>";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_alert_title", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</strong>
    ";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_alert_text", array(), "SonataPaymentBundle"), "html", null, true);
        echo "
</div>

<p>";
        // line 8
        echo $this->env->getExtension('translator')->trans("debug_payment_help", array(), "SonataPaymentBundle");
        echo "</p>

<div class=\"form-actions\" align=\"center\">
    <a href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_payment_debug_process", array("check" => (isset($context["check"]) ? $context["check"] : null), "reference" => $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()), "action" => "accept")), "html", null, true);
        echo "\" class=\"btn btn-success\"><i class=\"icon-ok-circle icon-white\"></i> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_ok_action", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</a>
    <a href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_payment_debug_process", array("check" => (isset($context["check"]) ? $context["check"] : null), "reference" => $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()), "action" => "refuse")), "html", null, true);
        echo "\" class=\"btn btn-danger\"><i class=\"icon-remove-circle icon-white\"></i> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_ko_action", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</a>
    <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_payment_debug_process", array("check" => (isset($context["check"]) ? $context["check"] : null), "reference" => $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()), "action" => "cancel")), "html", null, true);
        echo "\" class=\"btn btn-default\"><i class=\"icon-ban-circle icon-white\"></i> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_cancel_action", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</a>
</div>

<h2>";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_data_title", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</h2>

<p>";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_data_header", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</p>

<table class=\"table table-bordered table-striped\">
    <tr>
        <th>";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_id", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</th>
        <td>";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "id", array()), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <th>";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_reference", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</th>
        <td>";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <th>";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_status", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</th>
        <td><span class=\"label";
        // line 31
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), null, "important")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), null, "important"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "statusName", array()), array(), "SonataOrderBundle"), "html", null, true);
        echo "</span></td>
    </tr>
    <tr>
        <th>";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_payment_status", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</th>
        <td><span class=\"label";
        // line 35
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "important")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "payment", "important"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "paymentStatusName", array()), array(), "SonataPaymentBundle"), "html", null, true);
        echo "</span></td>
    </tr>
    <tr>
        <th>";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_delivery_status", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</th>
        <td><span class=\"label";
        // line 39
        echo twig_escape_filter($this->env, (($this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "important")) ? ((" label-" . $this->env->getExtension('sonata_core_status')->statusClass((isset($context["order"]) ? $context["order"] : null), "delivery", "important"))) : ("")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryStatusName", array()), array(), "SonataDeliveryBundle"), "html", null, true);
        echo "</span></td>
    </tr>
    <tr>
        <th>";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_payment_method", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</th>
        <td>";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "paymentMethod", array()), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <th>";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("debug_payment_delivery_method", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</th>
        <td>";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "deliveryMethod", array()), "html", null, true);
        echo "</td>
    </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "SonataPaymentBundle:Payment:debug.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 47,  140 => 46,  134 => 43,  130 => 42,  122 => 39,  118 => 38,  110 => 35,  106 => 34,  98 => 31,  94 => 30,  88 => 27,  84 => 26,  78 => 23,  74 => 22,  67 => 18,  62 => 16,  54 => 13,  48 => 12,  42 => 11,  36 => 8,  30 => 5,  26 => 4,  19 => 1,);
    }
}
