<?php

/* SpyTimelineBundle:Action:components.html.twig */
class __TwigTemplate_343ba1cd8d0f25c54e6c83a7a0edd7f427bda73bb8522079a885490f08faf3dd extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'subject_component' => array($this, 'block_subject_component'),
            'verb_component' => array($this, 'block_verb_component'),
            'action_component' => array($this, 'block_action_component'),
            'component_attributes' => array($this, 'block_component_attributes'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $this->displayBlock('subject_component', $context, $blocks);
        // line 8
        echo "
";
        // line 9
        $this->displayBlock('verb_component', $context, $blocks);
        // line 15
        echo "
";
        // line 16
        $this->displayBlock('action_component', $context, $blocks);
        // line 24
        echo "
";
        // line 26
        $this->displayBlock('component_attributes', $context, $blocks);
    }

    // line 2
    public function block_subject_component($context, array $blocks = array())
    {
        // line 3
        ob_start();
        // line 4
        echo "    ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : null), "subject")) : ("subject"));
        // line 5
        echo "    ";
        $this->displayBlock("action_component", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 9
    public function block_verb_component($context, array $blocks = array())
    {
        // line 10
        ob_start();
        // line 11
        echo "    ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : null), "verb")) : ("verb"));
        // line 12
        echo "    ";
        $this->displayBlock("action_component", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 16
    public function block_action_component($context, array $blocks = array())
    {
        // line 17
        ob_start();
        // line 18
        echo "    ";
        if (((array_key_exists("text", $context)) ? (_twig_default_filter((isset($context["text"]) ? $context["text"] : null), false)) : (false))) {
            // line 19
            echo "        ";
            $context["value"] = ((array_key_exists("value", $context)) ? (_twig_default_filter((isset($context["value"]) ? $context["value"] : null), (isset($context["text"]) ? $context["text"] : null))) : ((isset($context["text"]) ? $context["text"] : null)));
            // line 20
            echo "    ";
        }
        // line 21
        echo "    <span ";
        $this->displayBlock("component_attributes", $context, $blocks);
        echo ">";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        echo "</span>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 26
    public function block_component_attributes($context, array $blocks = array())
    {
        // line 27
        ob_start();
        // line 28
        echo "    ";
        if (((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : null), false)) : (false))) {
            // line 29
            echo "        ";
            $context["attrClass"] = (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : (""));
            // line 30
            echo "        ";
            $context["attr"] = twig_array_merge(((array_key_exists("attr", $context)) ? (_twig_default_filter((isset($context["attr"]) ? $context["attr"] : null), array())) : (array())), array("class" => trim((((isset($context["attrClass"]) ? $context["attrClass"] : null) . " ") . (isset($context["type"]) ? $context["type"] : null)))));
            // line 31
            echo "    ";
        }
        // line 32
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : null));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
            echo "\" ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "SpyTimelineBundle:Action:components.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  115 => 32,  112 => 31,  109 => 30,  106 => 29,  103 => 28,  101 => 27,  98 => 26,  88 => 21,  85 => 20,  82 => 19,  79 => 18,  77 => 17,  74 => 16,  66 => 12,  63 => 11,  61 => 10,  58 => 9,  50 => 5,  47 => 4,  45 => 3,  42 => 2,  38 => 26,  35 => 24,  33 => 16,  30 => 15,  28 => 9,  25 => 8,  23 => 2,);
    }
}
