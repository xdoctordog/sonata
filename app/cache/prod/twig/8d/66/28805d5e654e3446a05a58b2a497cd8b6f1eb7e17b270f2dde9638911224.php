<?php

/* SonataSeoBundle:Block:block_twitter_follow_button.html.twig */
class __TwigTemplate_8d6628805d5e654e3446a05a58b2a497cd8b6f1eb7e17b270f2dde9638911224 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
    ";
        // line 16
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "user", array())) {
            // line 17
            echo "
        <a href=\"https://twitter.com/";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "user", array()), "html", null, true);
            echo "\" class=\"twitter-follow-button\"
            ";
            // line 19
            if ( !$this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "show_username", array())) {
                echo "data-show-screen-name=\"false\"";
            }
            // line 20
            echo "            ";
            if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "large_button", array())) {
                echo "data-size=\"large\"";
            }
            // line 21
            echo "            data-lang=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "language", array()), "html", null, true);
            echo "\"
            ";
            // line 22
            if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "opt_out", array())) {
                echo "data-dnt=\"true\"";
            }
            echo ">
            Follow @";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "user", array()), "html", null, true);
            echo "
        </a>

    ";
        }
        // line 27
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "SonataSeoBundle:Block:block_twitter_follow_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 27,  64 => 23,  58 => 22,  53 => 21,  48 => 20,  44 => 19,  40 => 18,  37 => 17,  35 => 16,  32 => 15,  30 => 14,  27 => 13,  18 => 11,);
    }
}
