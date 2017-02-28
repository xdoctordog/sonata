<?php

/* SonataDatagridBundle:Search:pager.html.twig */
class __TwigTemplate_ba59bbe62d9ba6bd2c4948b3bccb5bc266c07a27380936232e4ad5517b8509d4 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'pager_links' => array($this, 'block_pager_links'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $this->displayBlock('pager_links', $context, $blocks);
    }

    public function block_pager_links($context, array $blocks = array())
    {
        // line 13
        echo "    <ul class=\"pagination";
        if (array_key_exists("pager_class", $context)) {
            echo " ";
            echo twig_escape_filter($this->env, (isset($context["pager_class"]) ? $context["pager_class"] : null), "html", null, true);
        }
        echo "\">
        ";
        // line 14
        if (($this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "page", array()) > 2)) {
            // line 15
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "all", array()), array("page" => 1))), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_first_pager", array(), "SonataDatagridBundle"), "html", null, true);
            echo "\">&laquo;</a></li>
        ";
        }
        // line 17
        echo "
        ";
        // line 18
        if (($this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "page", array()) != $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "previouspage", array()))) {
            // line 19
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "all", array()), array("page" => $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "previouspage", array())))), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_previous_pager", array(), "SonataDatagridBundle"), "html", null, true);
            echo "\">&lsaquo;</a></li>
        ";
        }
        // line 21
        echo "
        ";
        // line 23
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "getLinks", array(0 => 5), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 24
            echo "            ";
            if (($context["page"] == $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "page", array()))) {
                // line 25
                echo "                <li class=\"active\"><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "all", array()), array("page" => $context["page"]))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                echo "</a></li>
            ";
            } else {
                // line 27
                echo "                <li><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "all", array()), array("page" => $context["page"]))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                echo "</a></li>
            ";
            }
            // line 29
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "
        ";
        // line 31
        if (($this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "page", array()) != $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "nextpage", array()))) {
            // line 32
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "all", array()), array("page" => $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "nextpage", array())))), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_next_pager", array(), "SonataDatagridBundle"), "html", null, true);
            echo "\">&rsaquo;</a></li>
        ";
        }
        // line 34
        echo "
        ";
        // line 35
        if ((($this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "page", array()) != $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "lastpage", array())) && ($this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "lastpage", array()) != $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "nextpage", array())))) {
            // line 36
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"), twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "all", array()), array("page" => $this->getAttribute($this->getAttribute((isset($context["datagrid"]) ? $context["datagrid"] : null), "pager", array()), "lastpage", array())))), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_last_pager", array(), "SonataDatagridBundle"), "html", null, true);
            echo "\">&raquo;</a></li>
        ";
        }
        // line 38
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "SonataDatagridBundle:Search:pager.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  119 => 38,  111 => 36,  109 => 35,  106 => 34,  98 => 32,  96 => 31,  93 => 30,  87 => 29,  79 => 27,  71 => 25,  68 => 24,  63 => 23,  60 => 21,  52 => 19,  50 => 18,  47 => 17,  39 => 15,  37 => 14,  29 => 13,  23 => 12,  20 => 11,);
    }
}
