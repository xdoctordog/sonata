<?php

/* SonataSeoBundle:Block:block_social_container.html.twig */
class __TwigTemplate_8a3f52347799411b16ba5f492530a0b102833ab9bd74f3d78f1268b064022b0e extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
            'block_child_render' => array($this, 'block_block_child_render'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : null), "templates", array()), "block_container", array(), "array"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 15
    public function block_block($context, array $blocks = array())
    {
        // line 16
        echo "    <div class=\"col-sm-12\">
        <div class=\"row\">
            ";
        // line 18
        $this->displayParentBlock("block", $context, $blocks);
        echo "
        </div>
        <div class=\"clearfix\"></div>
    </div>
";
    }

    // line 23
    public function block_block_child_render($context, array $blocks = array())
    {
        // line 24
        echo "    <div class=\"sonata_seo_social pull-left\">
        ";
        // line 25
        $this->displayParentBlock("block_child_render", $context, $blocks);
        echo "
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataSeoBundle:Block:block_social_container.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 25,  47 => 24,  44 => 23,  35 => 18,  31 => 16,  28 => 15,  19 => 12,);
    }
}
