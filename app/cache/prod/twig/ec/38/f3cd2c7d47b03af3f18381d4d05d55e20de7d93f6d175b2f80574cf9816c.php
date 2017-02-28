<?php

/* SonataPaymentBundle:Payment:confirmation.html.twig */
class __TwigTemplate_ec38f3cd2c7d47b03af3f18381d4d05d55e20de7d93f6d175b2f80574cf9816c extends Sonata\CacheBundle\Twig\TwigTemplate14
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
<div class=\"sonata-payment-confirmation\">
    ";
        // line 15
        if ($this->getAttribute((isset($context["order"]) ? $context["order"] : null), "isvalidated", array())) {
            // line 16
            echo "        <h1>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_validation_confirmation_payment", array(), "SonataPaymentBundle"), "html", null, true);
            echo "</h1>
        <p>
            ";
            // line 19
            echo "                ";
            echo $this->env->getExtension('translator')->trans("message_validation_payment", array(), "SonataPaymentBundle");
            echo "
            ";
            // line 21
            echo "        </p>

    ";
        } elseif ($this->getAttribute(        // line 23
(isset($context["order"]) ? $context["order"] : null), "ispending", array())) {
            // line 24
            echo "        <h1>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_pending_confirmation_payment", array(), "SonataPaymentBundle"), "html", null, true);
            echo "</h1>

        <p>
            ";
            // line 27
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_pending_payment", array(), "SonataPaymentBundle"), "html", null, true);
            echo "
        </p>
    ";
        } else {
            // line 30
            echo "
        <h1>";
            // line 31
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_not_validated_confirmation_payment", array(), "SonataPaymentBundle"), "html", null, true);
            echo "</h1>

        <p>
            ";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_not_validated_payment", array(), "SonataPaymentBundle"), "html", null, true);
            echo "
        </p>

    ";
        }
        // line 38
        echo "

    <div class=\"well\">
        <a class=\"btn btn-default\" href=\"";
        // line 41
        echo $this->env->getExtension('routing')->getUrl("sonata_user_profile_show");
        echo "\"><i class=\"glyphicon glyphicon-home\"></i>&nbsp;";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_view_user_profile", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</a>

        <a class=\"btn btn-primary pull-right\" href=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_order_view", array("reference" => $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()))), "html", null, true);
        echo "\"><i class=\"glyphicon glyphicon-file icon-white\"></i>&nbsp;";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_view_order_payment", array(), "SonataPaymentBundle"), "html", null, true);
        echo "</a>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "SonataPaymentBundle:Payment:confirmation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 43,  81 => 41,  76 => 38,  69 => 34,  63 => 31,  60 => 30,  54 => 27,  47 => 24,  45 => 23,  41 => 21,  36 => 19,  30 => 16,  28 => 15,  24 => 13,  22 => 12,  19 => 11,);
    }
}
