<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_56cae3e2587dcd5f642b29dee118dd16b5182a73d5259f1484a29c2e8340da62 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataUserBundle:Security:base_login.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataUserBundle:Security:base_login.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_fos_user_content($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "session", array()), "get", array(0 => "sonata_basket_delivery_redirect"), "method")) {
            // line 16
            echo "        ";
            $this->env->loadTemplate("SonataBasketBundle:Basket:stepper.html.twig")->display(array_merge($context, array("step" => "identification")));
            // line 17
            echo "    ";
        }
        // line 18
        echo "
    ";
        // line 19
        $this->displayParentBlock("fos_user_content", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 19,  48 => 18,  45 => 17,  42 => 16,  39 => 15,  36 => 14,  11 => 12,);
    }
}
