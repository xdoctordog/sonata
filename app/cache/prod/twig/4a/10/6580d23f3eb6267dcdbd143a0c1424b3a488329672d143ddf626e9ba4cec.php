<?php

/* SonataSeoBundle:Block:block_facebook_like_box.html.twig */
class __TwigTemplate_4a106580d23f3eb6267dcdbd143a0c1424b3a488329672d143ddf626e9ba4cec extends Sonata\CacheBundle\Twig\TwigTemplate14
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
    <div class=\"fb-like-box\"
        ";
        // line 17
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "url", array())) {
            echo "data-href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "url", array()), "html", null, true);
            echo "\"";
        }
        // line 18
        echo "        data-show-faces=\"";
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "show_faces", array())) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"
        data-header=\"";
        // line 19
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "show_header", array())) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"
        data-stream=\"";
        // line 20
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "show_posts", array())) {
            echo "true";
        } else {
            echo "false";
        }
        echo "\"
        data-show-border=\"";
        // line 21
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "show_border", array())) {
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
        echo "        ";
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "height", array())) {
            echo "data-height=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "height", array()), "html", null, true);
            echo "\"";
        }
        // line 24
        echo "        data-colorscheme=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "colorscheme", array()), "html", null, true);
        echo "\">
    </div>

";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "SonataSeoBundle:Block:block_facebook_like_box.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 24,  81 => 23,  75 => 22,  67 => 21,  59 => 20,  51 => 19,  42 => 18,  36 => 17,  32 => 15,  30 => 14,  27 => 13,  18 => 11,);
    }
}
