<?php

/* SonataSeoBundle:Block:block_pinterest_pin_button.html.twig */
class __TwigTemplate_1d5a7ca114b07253a030b44a391765577f61e72cc8e9cb00fd8743bfe9850f35 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "    ";
        ob_start();
        // line 15
        echo "
        <a href=\"//www.pinterest.com/pin/create/button/?url=";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "url", array()), "html", null, true);
        echo "&media=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "image", array()), "html", null, true);
        echo "&description=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "description", array()), "html", null, true);
        echo "\"
           data-pin-do=\"buttonPin\"
           ";
        // line 18
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "size", array())) {
            echo "data-pin-height=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "size", array()), "html", null, true);
            echo "\"";
        }
        // line 19
        echo "           ";
        if (("round" == $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "shape", array()))) {
            echo "data-pin-shape=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "shape", array()), "html", null, true);
            echo "\"";
        }
        echo ">
            <img src=\"//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png\" />
        </a>

    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "SonataSeoBundle:Block:block_pinterest_pin_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 19,  45 => 18,  36 => 16,  33 => 15,  30 => 14,  27 => 13,  18 => 11,);
    }
}
