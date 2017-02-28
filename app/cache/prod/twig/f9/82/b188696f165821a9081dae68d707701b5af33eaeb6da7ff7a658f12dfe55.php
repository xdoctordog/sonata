<?php

/* SonataDemoBundle:Demo:car.html.twig */
class __TwigTemplate_f982b188696f165821a9081dae68d707701b5af33eaeb6da7ff7a658f12dfe55 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("::empty.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            '_sonata_demo_form_type_car_rescueEngine_label' => array($this, 'block__sonata_demo_form_type_car_rescueEngine_label'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::empty.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : null), array(0 => $this));
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "    <h2>Car Type</h2>
    <h3>Object</h3>
    <div>
        ";
        // line 10
        echo (isset($context["dump"]) ? $context["dump"] : null);
        echo "
    </div>

    <h3>Form Version</h3>

    <div>
        <form method=\"POST\">
            ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
            <input type=\"submit\" />
        </form>
    </div>
";
    }

    // line 24
    public function block__sonata_demo_form_type_car_rescueEngine_label($context, array $blocks = array())
    {
        // line 25
        echo "    ";
        $this->displayBlock("form_label", $context, $blocks);
        echo "
    sfsdfsd
";
    }

    public function getTemplateName()
    {
        return "SonataDemoBundle:Demo:car.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 25,  67 => 24,  58 => 17,  48 => 10,  43 => 7,  40 => 6,  36 => 1,  34 => 3,  11 => 1,);
    }
}
