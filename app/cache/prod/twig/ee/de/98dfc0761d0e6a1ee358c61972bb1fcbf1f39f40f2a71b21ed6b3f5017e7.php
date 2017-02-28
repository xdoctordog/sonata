<?php

/* MopaBootstrapBundle:Pagination:sortable_link.html.twig */
class __TwigTemplate_eede98dfc0761d0e6a1ee358c61972bb1fcbf1f39f40f2a71b21ed6b3f5017e7 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["link"] = "";
        // line 2
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["options"]) ? $context["options"] : null));
        foreach ($context['_seq'] as $context["attr"] => $context["value"]) {
            // line 3
            echo "    ";
            $context["link"] = ((((((isset($context["link"]) ? $context["link"] : null) . " ") . $context["attr"]) . "=\"") . $context["value"]) . "\"");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 5
        echo "
<a ";
        // line 6
        echo (isset($context["link"]) ? $context["link"] : null);
        echo ">";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</a>
";
    }

    public function getTemplateName()
    {
        return "MopaBootstrapBundle:Pagination:sortable_link.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 6,  32 => 5,  25 => 3,  21 => 2,  19 => 1,);
    }
}
