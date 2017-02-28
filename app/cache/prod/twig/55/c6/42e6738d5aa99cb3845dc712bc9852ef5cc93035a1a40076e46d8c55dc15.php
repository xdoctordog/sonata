<?php

/* SonataPageBundle:BlockAdmin:block_core_text_edit.html.twig */
class __TwigTemplate_55c642e6738d5aa99cb3845dc712bc9852ef5cc93035a1a40076e46d8c55dc15 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataPageBundle:BlockAdmin:edit.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataPageBundle:BlockAdmin:edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        // line 15
        echo "    <p>
        ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "settings", array()), "content", array()), 'label');
        echo " <br>
        ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "settings", array()), "content", array()), 'widget', array("attr" => array("class" => "title")));
        echo "
        ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "settings", array()), "content", array()), 'errors');
        echo "
    </p>
";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:BlockAdmin:block_core_text_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 18,  46 => 17,  42 => 16,  39 => 15,  36 => 14,  11 => 12,);
    }
}
