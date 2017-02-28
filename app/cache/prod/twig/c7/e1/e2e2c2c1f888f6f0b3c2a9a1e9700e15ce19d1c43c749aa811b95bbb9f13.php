<?php

/* SonataPageBundle:PageAdmin:tree.html.twig */
class __TwigTemplate_c7e1e2e2c2c1f888f6f0b3c2a9a1e9700e15ce19d1c43c749aa811b95bbb9f13 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'tab_menu' => array($this, 'block_tab_menu'),
            'list_table' => array($this, 'block_list_table'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 14
        $context["tree"] = $this;
        // line 12
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 35
    public function block_tab_menu($context, array $blocks = array())
    {
        // line 36
        echo "    ";
        $this->env->loadTemplate("SonataPageBundle:PageAdmin:list_tab_menu.html.twig")->display(array("mode" => "tree", "action" =>         // line 38
(isset($context["action"]) ? $context["action"] : null), "admin" =>         // line 39
(isset($context["admin"]) ? $context["admin"] : null), "currentSite" =>         // line 40
(isset($context["currentSite"]) ? $context["currentSite"] : null)));
    }

    // line 44
    public function block_list_table($context, array $blocks = array())
    {
        // line 45
        echo "    <div class=\"box box-primary\">
        <div class=\"box-header\">
            <h1 class=\"box-title\">
                ";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pages.tree_site_label", array(), "SonataPageBundle"), "html", null, true);
        echo "
                <div class=\"btn-group\">
                    <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                        <strong class=\"text-info\">";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["currentSite"]) ? $context["currentSite"] : null), "name", array()), "html", null, true);
        echo "</strong> <span class=\"caret\"></span>
                    </button>
                    <ul class=\"dropdown-menu\" role=\"menu\">
                        ";
        // line 54
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sites"]) ? $context["sites"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["site"]) {
            // line 55
            echo "                            <li>
                                <a href=\"";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "tree", 1 => array("site" => $this->getAttribute($context["site"], "id", array()))), "method"), "html", null, true);
            echo "\">
                                    ";
            // line 57
            if (((isset($context["currentSite"]) ? $context["currentSite"] : null) && ($this->getAttribute($context["site"], "id", array()) == $this->getAttribute((isset($context["currentSite"]) ? $context["currentSite"] : null), "id", array())))) {
                // line 58
                echo "                                        <span class=\"pull-right\">
                                            <i class=\"fa fa-check\"></i>
                                        </span>
                                    ";
            }
            // line 62
            echo "                                    ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["site"], "name", array()), "html", null, true);
            echo "
                                </a>
                            </li>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['site'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "                    </ul>
                </div>
            </h1>
        </div>
        <div class=\"box-content\">
            ";
        // line 71
        echo $context["tree"]->getpages((isset($context["pages"]) ? $context["pages"] : null), (isset($context["admin"]) ? $context["admin"] : null), true);
        echo "
        </div>
    </div>
";
    }

    // line 15
    public function getpages($__pages__ = null, $__admin__ = null, $__rootPages__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "pages" => $__pages__,
            "admin" => $__admin__,
            "rootPages" => $__rootPages__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "    <ul";
            if ((isset($context["rootPages"]) ? $context["rootPages"] : null)) {
                echo " class=\"page-tree\"";
            }
            echo ">
        ";
            // line 17
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["pages"]) ? $context["pages"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                if (( !$this->getAttribute($context["page"], "internal", array()) && ( !$this->getAttribute($context["page"], "parent", array()) ||  !(isset($context["rootPages"]) ? $context["rootPages"] : null)))) {
                    // line 18
                    echo "            <li>
                <div class=\"page-tree__item\">
                    ";
                    // line 20
                    if ($this->getAttribute($context["page"], "parent", array())) {
                        echo "<i class=\"fa fa-caret-right\"></i>";
                    }
                    // line 21
                    echo "                    <i class=\"fa page-tree__item__is-hybrid fa-";
                    if ($this->getAttribute($context["page"], "isHybrid", array())) {
                        echo "gears";
                    } else {
                        echo "code";
                    }
                    echo "\"></i>
                    <a class=\"page-tree__item__edit\" href=\"";
                    // line 22
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "edit", 1 => $context["page"]), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["page"], "name", array()), "html", null, true);
                    echo "</a>
                    <i class=\"text-muted\">";
                    // line 23
                    echo twig_escape_filter($this->env, $this->getAttribute($context["page"], "url", array()), "html", null, true);
                    echo "</i>
                    <a class=\"label label-default pull-right\" href=\"";
                    // line 24
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "compose", 1 => $context["page"]), "method"), "html", null, true);
                    echo "\">compose <i class=\"fa fa-magic\"></i></a>
                    ";
                    // line 25
                    if ($this->getAttribute($context["page"], "edited", array())) {
                        echo "<span class=\"label label-warning pull-right\">edited</span>";
                    }
                    // line 26
                    echo "                </div>
                ";
                    // line 27
                    if (twig_length_filter($this->env, $this->getAttribute($context["page"], "children", array()))) {
                        // line 28
                        echo "                    ";
                        echo $this->getAttribute($this, "pages", array(0 => $this->getAttribute($context["page"], "children", array()), 1 => (isset($context["admin"]) ? $context["admin"] : null), 2 => false), "method");
                        echo "
                ";
                    }
                    // line 30
                    echo "            </li>
        ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "    </ul>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:PageAdmin:tree.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 32,  187 => 30,  181 => 28,  179 => 27,  176 => 26,  172 => 25,  168 => 24,  164 => 23,  158 => 22,  149 => 21,  145 => 20,  141 => 18,  136 => 17,  129 => 16,  116 => 15,  108 => 71,  101 => 66,  90 => 62,  84 => 58,  82 => 57,  78 => 56,  75 => 55,  71 => 54,  65 => 51,  59 => 48,  54 => 45,  51 => 44,  47 => 40,  46 => 39,  45 => 38,  43 => 36,  40 => 35,  36 => 12,  34 => 14,  11 => 12,);
    }
}
