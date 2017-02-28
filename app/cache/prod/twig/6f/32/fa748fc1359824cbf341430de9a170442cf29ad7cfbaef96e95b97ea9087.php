<?php

/* SonataBasketBundle:Basket:payment_step.html.twig */
class __TwigTemplate_6f32fa748fc1359824cbf341430de9a170442cf29ad7cfbaef96e95b97ea9087 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // token for sonata_template_box, however the box is disabled
        // line 13
        echo "
";
        // line 14
        $this->displayBlock('sonata_flash_messages', $context, $blocks);
        // line 17
        echo "
";
        // line 18
        $this->env->loadTemplate("SonataBasketBundle:Basket:stepper.html.twig")->display(array_merge($context, array("step" => "billing")));
        // line 19
        echo "
<form action=\"";
        // line 20
        echo $this->env->getExtension('routing')->getUrl("sonata_basket_payment");
        echo "\" method=\"POST\" >
    <div class=\"row\">
        <div class=\"col-sm-6\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    <div class=\"panel-title\">
                        <h4>";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_address_billing_step_basket", array(), "SonataBasketBundle"), "html", null, true);
        echo "</h4>
                    </div>
                </div>
                <div class=\"panel-body\">
                    ";
        // line 30
        echo $this->env->getExtension('sonata_address')->renderAddress($this->env, $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "billingAddress", array()));
        echo "
                </div>
            </div>
        </div>
        <div class=\"col-sm-6\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    <div class=\"panel-title\">
                        <h4>";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_payment_method", array(), "SonataBasketBundle"), "html", null, true);
        echo "</h4>
                    </div>
                </div>
                <div class=\"panel-body\">
                    ";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "paymentMethod", array()), 'errors');
        echo "
                    ";
        // line 43
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "paymentMethod", array()), 'widget');
        echo "
                    ";
        // line 44
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
                </div>
            </div>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-lg-12\">
            <div class=\"well\">
                <a href=\"";
        // line 53
        echo $this->env->getExtension('routing')->getUrl("sonata_basket_payment_address");
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-arrow-left\"></i>&nbsp;";
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.basket.link_previous_step", array(), "SonataBasketBundle");
        echo "</a>

                <button type=\"submit\" class=\"btn btn-primary pull-right\">";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.btn_update_payment_step", array(), "SonataBasketBundle"), "html", null, true);
        echo "&nbsp;<i class=\"glyphicon glyphicon-arrow-right icon-white\"></i></button>
            </div>
        </div>
    </div>
</form>
";
    }

    // line 14
    public function block_sonata_flash_messages($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:payment_step.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 15,  109 => 14,  99 => 55,  92 => 53,  80 => 44,  76 => 43,  72 => 42,  65 => 38,  54 => 30,  47 => 26,  38 => 20,  35 => 19,  33 => 18,  30 => 17,  28 => 14,  25 => 13,  23 => 12,  20 => 11,);
    }
}
