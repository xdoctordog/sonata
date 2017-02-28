<?php

/* SonataPageBundle:BlockAdmin:edit.html.twig */
class __TwigTemplate_13058e33f69f9123ec89a9224075e3b0ce523103a952318fe10e633b0aa7cb54 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'form' => array($this, 'block_form'),
            'information' => array($this, 'block_information'),
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : null));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_form($context, array $blocks = array())
    {
        // line 15
        echo "    <form action=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "update", 1 => array("id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "id", array()))), "method"), "html", null, true);
        echo "\" method=\"POST\">
        <p>
             ";
        // line 17
        $this->displayBlock('information', $context, $blocks);
        // line 20
        echo "        </p>

        <p>
            ";
        // line 23
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "enabled", array()), 'label');
        echo "
            ";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "enabled", array()), 'widget');
        echo "
            ";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "enabled", array()), 'errors');
        echo "
        </p>

        <div>
            ";
        // line 29
        $this->displayBlock('block', $context, $blocks);
        // line 32
        echo "        </div>

        <input type=\"submit\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("button_save", array(), "SonataPageBundle"), "html", null, true);
        echo "\">

        ";
        // line 36
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
    </form>
";
    }

    // line 17
    public function block_information($context, array $blocks = array())
    {
        // line 18
        echo "                ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "type", array()), "html", null, true);
        echo "
             ";
    }

    // line 29
    public function block_block($context, array $blocks = array())
    {
        // line 30
        echo "                Custom block settings ...
            ";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:BlockAdmin:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 30,  88 => 29,  81 => 18,  78 => 17,  71 => 36,  66 => 34,  62 => 32,  60 => 29,  53 => 25,  49 => 24,  45 => 23,  40 => 20,  38 => 17,  32 => 15,  29 => 14,  20 => 12,);
    }
}
