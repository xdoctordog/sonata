<?php

/* SonataProductBundle:ProductAdmin:create_variation.html.twig */
class __TwigTemplate_f9929319a6a0f5c21768fe82aaacf620c43ec92f73e1166e90d69e13963689a0 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_edit.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'form' => array($this, 'block_form'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_form($context, array $blocks = array())
    {
        // line 15
        echo "
    <h5>";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("product.title.create_variations", array(), "SonataProductBundle"), "html", null, true);
        echo "</h5>

    <form class=\"form-horizontal\" action=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "create"), "method"), "html", null, true);
        echo "\" method=\"post\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'enctype');
        echo ">

        ";
        // line 20
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "errors", array())) > 0)) {
            // line 21
            echo "            <div class=\"sonata-ba-form-error\">
                ";
            // line 22
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
            echo "
            </div>
        ";
        }
        // line 25
        echo "
        <fieldset>
            ";
        // line 27
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
        </fieldset>

        <div class=\"well well-small form-actions\">
            <input type=\"submit\" class=\"btn btn-primary\" value=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("product.submit.create_variations", array(), "SonataProductBundle"), "html", null, true);
        echo "\"/>
        </div>

    </form>

";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:ProductAdmin:create_variation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 31,  69 => 27,  65 => 25,  59 => 22,  56 => 21,  54 => 20,  47 => 18,  42 => 16,  39 => 15,  36 => 14,  11 => 12,);
    }
}
