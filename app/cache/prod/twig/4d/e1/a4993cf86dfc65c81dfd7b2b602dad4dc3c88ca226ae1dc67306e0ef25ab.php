<?php

/* ::empty.html.twig */
class __TwigTemplate_4de1a4993cf86dfc65c81dfd7b2b602dad4dc3c88ca226ae1dc67306e0ef25ab extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('body', $context, $blocks);
        // line 2
        $this->displayBlock('content', $context, $blocks);
    }

    // line 1
    public function block_body($context, array $blocks = array())
    {
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::empty.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  32 => 2,  27 => 1,  23 => 2,  21 => 1,);
    }
}
