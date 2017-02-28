<?php

/* SonataSeoBundle:Block:block_facebook_like_button.html.twig */
class __TwigTemplate_b353d73148c6d0fa17c6c401c29aaf79fec3e1e49eb4ab8d5eabc43482011006 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 11
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : null), "templates", array()), "block_base", array()));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        // line 14
        ob_start();
        // line 15
        echo "
    <div class=\"fb-like\"
        ";
        // line 17
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "url", array())) {
            echo "data-href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "url", array()), "html", null, true);
            echo "\"";
        }
        // line 18
        echo "        data-layout=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "layout", array()), "html", null, true);
        echo "\"
        data-action=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "action", array()), "html", null, true);
        echo "\"
        data-show-faces=\"";
        // line 20
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "show_faces", array())) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"
        data-share=\"";
        // line 21
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "share", array())) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"
        ";
        // line 22
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "width", array())) {
            echo "data-width=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "width", array()), "html", null, true);
            echo "\"";
        }
        // line 23
        echo "        data-colorscheme=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "colorscheme", array()), "html", null, true);
        echo "\">
    </div>

";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "SonataSeoBundle:Block:block_facebook_like_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 23,  67 => 22,  59 => 21,  51 => 20,  47 => 19,  42 => 18,  36 => 17,  32 => 15,  30 => 14,  27 => 13,  18 => 11,);
    }
}
