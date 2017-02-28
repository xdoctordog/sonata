<?php

/* SonataBasketBundle:Basket:stepper.html.twig */
class __TwigTemplate_30f008ae460f71adbfb44fd5f758d2cec9864d7ac73bb4276e5293de93bafb01 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stepper_stylesheet' => array($this, 'block_stepper_stylesheet'),
            'stepper_content' => array($this, 'block_stepper_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('stepper_stylesheet', $context, $blocks);
        // line 4
        echo "
";
        // line 5
        $this->displayBlock('stepper_content', $context, $blocks);
    }

    // line 1
    public function block_stepper_stylesheet($context, array $blocks = array())
    {
        // line 2
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatabasket/css/stepper.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 5
    public function block_stepper_content($context, array $blocks = array())
    {
        // line 6
        echo "    <ul class=\"stepper hidden-xs\">
        <li";
        // line 7
        if (("basket" == (isset($context["step"]) ? $context["step"] : null))) {
            echo " class=\"active\"";
        }
        echo ">
            <div class=\"img-circle\">1</div>
            <p>";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("basket_stepper_basket_title", array(), "SonataBasketBundle"), "html", null, true);
        echo "</p>
            <hr />
        </li>

        <li";
        // line 13
        if (("identification" == (isset($context["step"]) ? $context["step"] : null))) {
            echo " class=\"active\"";
        }
        echo ">
            <div class=\"img-circle\">2</div>
            <p>";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("basket_stepper_identification_title", array(), "SonataBasketBundle"), "html", null, true);
        echo "</p>
            <hr />
        </li>

        <li";
        // line 19
        if (("delivery" == (isset($context["step"]) ? $context["step"] : null))) {
            echo " class=\"active\"";
        }
        echo ">
            <div class=\"img-circle\">3</div>
            <p>";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("basket_stepper_delivery_title", array(), "SonataBasketBundle"), "html", null, true);
        echo "</p>
            <hr />
        </li>

        <li";
        // line 25
        if (("billing" == (isset($context["step"]) ? $context["step"] : null))) {
            echo " class=\"active\"";
        }
        echo ">
            <div class=\"img-circle\">4</div>
            <p>";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("basket_stepper_billing_title", array(), "SonataBasketBundle"), "html", null, true);
        echo "</p>
            <hr />
        </li>

        <li";
        // line 31
        if (("checkout" == (isset($context["step"]) ? $context["step"] : null))) {
            echo " class=\"active\"";
        }
        echo ">
            <div class=\"img-circle\">5</div>
            <p>";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("basket_stepper_checkout_title", array(), "SonataBasketBundle"), "html", null, true);
        echo "</p>
            <hr />
        </li>
    </ul>
";
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:stepper.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  109 => 33,  102 => 31,  95 => 27,  88 => 25,  81 => 21,  74 => 19,  67 => 15,  60 => 13,  53 => 9,  46 => 7,  43 => 6,  40 => 5,  33 => 2,  30 => 1,  26 => 5,  23 => 4,  21 => 1,);
    }
}
