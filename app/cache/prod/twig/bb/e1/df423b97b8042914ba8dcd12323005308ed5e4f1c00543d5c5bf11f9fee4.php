<?php

/* SonataProductBundle:Category:side_menu_category.html.twig */
class __TwigTemplate_bbe1df423b97b8042914ba8dcd12323005308ed5e4f1c00543d5c5bf11f9fee4 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 11
        echo "
<ul>
    ";
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["root_category"]) ? $context["root_category"] : null), "getChildren", array(), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 14
            echo "        <li>
            <a href=\"";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_catalog_index", array("category_slug" => $this->getAttribute($context["category"], "slug", array()), "category_id" => $this->getAttribute($context["category"], "id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "name", array()), "html", null, true);
            echo "</a>

            ";
            // line 17
            if (($this->getAttribute($context["category"], "hasChildren", array()) && ((isset($context["deep"]) ? $context["deep"] : null) < (isset($context["depth"]) ? $context["depth"] : null)))) {
                // line 18
                echo "
                ";
                // line 19
                echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('sonata_page')->controller("SonataProductBundle:Category:listSideMenuCategories", array("category" =>                 // line 20
$context["category"], "deep" =>                 // line 21
(isset($context["deep"]) ? $context["deep"] : null), "depth" =>                 // line 22
(isset($context["depth"]) ? $context["depth"] : null))), array());
                // line 24
                echo "
            ";
            }
            // line 26
            echo "
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "</ul>
";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Category:side_menu_category.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 29,  51 => 26,  47 => 24,  45 => 22,  44 => 21,  43 => 20,  42 => 19,  39 => 18,  37 => 17,  30 => 15,  27 => 14,  23 => 13,  19 => 11,);
    }
}
