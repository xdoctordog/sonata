<?php

/* SonataBasketBundle:Basket:delivery_step.html.twig */
class __TwigTemplate_cfa2727264263516739261a2545bf268f096207741842cd32c46b88455bab223 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_flash_messages' => array($this, 'block_sonata_flash_messages'),
            'delivery_step' => array($this, 'block_delivery_step'),
            'selected_delivery_address' => array($this, 'block_selected_delivery_address'),
            'delivery_method_choice' => array($this, 'block_delivery_method_choice'),
            'delivery_submit' => array($this, 'block_delivery_submit'),
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
        $this->env->loadTemplate("SonataBasketBundle:Basket:stepper.html.twig")->display(array_merge($context, array("step" => "delivery")));
        // line 19
        echo "
";
        // line 20
        $this->displayBlock('delivery_step', $context, $blocks);
    }

    // line 14
    public function block_sonata_flash_messages($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    // line 20
    public function block_delivery_step($context, array $blocks = array())
    {
        // line 21
        echo "    <form action=\"";
        echo $this->env->getExtension('routing')->getUrl("sonata_basket_delivery");
        echo "\" method=\"POST\" >
        <div class=\"row\">
            ";
        // line 23
        $this->displayBlock('selected_delivery_address', $context, $blocks);
        // line 37
        echo "
            ";
        // line 38
        $this->displayBlock('delivery_method_choice', $context, $blocks);
        // line 54
        echo "        </div>

        ";
        // line 56
        $this->displayBlock('delivery_submit', $context, $blocks);
        // line 63
        echo "    </form>
";
    }

    // line 23
    public function block_selected_delivery_address($context, array $blocks = array())
    {
        // line 24
        echo "                <div class=\"col-sm-6\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4>";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_address_delivery_step_basket", array(), "SonataBasketBundle"), "html", null, true);
        echo "</h4>
                            </div>
                        </div>
                        <div class=\"panel-body\">
                            ";
        // line 32
        echo $this->env->getExtension('sonata_address')->renderAddress($this->env, $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "deliveryaddress", array()));
        echo "
                        </div>
                    </div>
                </div>
            ";
    }

    // line 38
    public function block_delivery_method_choice($context, array $blocks = array())
    {
        // line 39
        echo "                <div class=\"col-sm-6\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                <h4>";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.title_delivery_methods", array(), "SonataBasketBundle"), "html", null, true);
        echo "</h4>
                            </div>
                        </div>
                        <div class=\"panel-body\">
                            ";
        // line 47
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "deliveryMethod", array()), 'errors');
        echo "
                            ";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "deliveryMethod", array()), 'widget');
        echo "
                            ";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
                        </div>
                    </div>
                </div>
            ";
    }

    // line 56
    public function block_delivery_submit($context, array $blocks = array())
    {
        // line 57
        echo "            <div class=\"well\">
                    <a href=\"";
        // line 58
        echo $this->env->getExtension('routing')->getUrl("sonata_basket_delivery_address");
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-arrow-left\"></i>&nbsp;";
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.basket.link_previous_step", array(), "SonataBasketBundle");
        echo "</a>

                    <button type=\"submit\" class=\"btn btn-primary pull-right\">";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.btn_update_delivery_step", array(), "SonataBasketBundle"), "html", null, true);
        echo "&nbsp;<i class=\"glyphicon glyphicon-arrow-right icon-white\"></i></button>
            </div>
        ";
    }

    public function getTemplateName()
    {
        return "SonataBasketBundle:Basket:delivery_step.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 60,  145 => 58,  142 => 57,  139 => 56,  130 => 49,  126 => 48,  122 => 47,  115 => 43,  109 => 39,  106 => 38,  97 => 32,  90 => 28,  84 => 24,  81 => 23,  76 => 63,  74 => 56,  70 => 54,  68 => 38,  65 => 37,  63 => 23,  57 => 21,  54 => 20,  49 => 15,  46 => 14,  42 => 20,  39 => 19,  37 => 18,  34 => 17,  32 => 14,  29 => 13,  27 => 12,  24 => 11,);
    }
}
