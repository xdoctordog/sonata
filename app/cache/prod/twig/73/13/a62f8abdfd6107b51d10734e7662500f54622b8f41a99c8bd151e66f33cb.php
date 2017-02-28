<?php

/* SonataPageBundle:PageAdmin:compose.html.twig */
class __TwigTemplate_7313a62f8abdfd6107b51d10734e7662500f54622b8f41a99c8bd151e66f33cb extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'tab_menu' => array($this, 'block_tab_menu'),
            'body_attributes' => array($this, 'block_body_attributes'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_tab_menu($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : null)), "method"), array("currentClass" => "active"), "list");
        echo "
";
    }

    // line 18
    public function block_body_attributes($context, array $blocks = array())
    {
        echo "class=\"sonata-bc skin-black fixed page-composer-page sonata-ba-no-side-menu\"";
    }

    // line 20
    public function block_content($context, array $blocks = array())
    {
        // line 21
        echo "    <div class=\"page-composer\">
        <h2>";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("page.compose_page", array(), "SonataPageBundle"), "html", null, true);
        echo " \"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "name", array()), "html", null, true);
        echo "\" <small>[template: <b>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["template"]) ? $context["template"] : null), "name", array()), "html", null, true);
        echo "</b>]</small></h2>

        ";
        // line 24
        if ((twig_length_filter($this->env, (isset($context["containers"]) ? $context["containers"] : null)) == 0)) {
            // line 25
            echo "            ";
            $this->env->loadTemplate("SonataPageBundle:PageAdmin:compose_hint.html.twig")->display($context);
            // line 26
            echo "        ";
        } else {
            // line 27
            echo "            <div class=\"row row-fluid\">
                <div class=\"col-md-4 span4\">
                    <div class=\"page-composer__page-preview\">
                        <div class=\"page-composer__page-preview__containers\">
                            ";
            // line 31
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["containers"]) ? $context["containers"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["container"]) {
                // line 32
                echo "                                ";
                if (($this->getAttribute($context["container"], "block", array(), "any", true, true) && $this->getAttribute($context["container"], "block", array()))) {
                    // line 33
                    echo "                                    <a class=\"page-composer__page-preview__container block-preview-";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["container"], "block", array()), "id", array()), "html", null, true);
                    echo "\"
                                       data-block-id=\"";
                    // line 34
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["container"], "block", array()), "id", array()), "html", null, true);
                    echo "\"
                                       style=\"top:";
                    // line 35
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "y", array()), "html", null, true);
                    echo "%;right:";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "right", array()), "html", null, true);
                    echo "%;bottom:";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "bottom", array()), "html", null, true);
                    echo "%;left:";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "x", array()), "html", null, true);
                    echo "%\"
                                       href=\"";
                    // line 36
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "compose_container_show", 1 => array("id" => $this->getAttribute($this->getAttribute($context["container"], "block", array()), "id", array()))), "method"), "html", null, true);
                    echo "\"
                                    >
                                        <div class=\"page-composer__page-preview__container__content\">
                                            <strong>";
                    // line 39
                    echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($context["container"], "block", array(), "any", false, true), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["container"], "block", array(), "any", false, true), "name", array()), $this->getAttribute($this->getAttribute($context["container"], "area", array()), "name", array()))) : ($this->getAttribute($this->getAttribute($context["container"], "area", array()), "name", array()))), "html", null, true);
                    echo "</strong><br>
                                            <small><span class=\"child-count\">";
                    // line 40
                    echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["container"], "block", array()), "children", array())), "html", null, true);
                    echo "</span> blocks</small>
                                            <span class=\"page-composer__page-preview__add-block\">
                                                <i class=\"fa fa-circle-o\"></i>
                                                <i class=\"fa fa-dot-circle-o\"></i>
                                            </span>
                                            <span class=\"drop-indicator\">
                                                <span class=\"fa fa-download\"></span>
                                            </span>
                                        </div>
                                    </a>
                                ";
                } else {
                    // line 51
                    echo "                                    <div class=\"page-composer__page-preview__container--no-block\"
                                         style=\"top:";
                    // line 52
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "y", array()), "html", null, true);
                    echo "%;right:";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "right", array()), "html", null, true);
                    echo "%;bottom:";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "bottom", array()), "html", null, true);
                    echo "%;left:";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["container"], "area", array()), "placement", array()), "x", array()), "html", null, true);
                    echo "%\"
                                    >
                                        <div class=\"page-composer__page-preview__container__content\">
                                            <strong>";
                    // line 55
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["container"], "area", array()), "name", array()), "html", null, true);
                    echo "</strong>
                                        </div>
                                    </div>
                                ";
                }
                // line 59
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['container'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "                        </div>
                    </div>

                    ";
            // line 63
            if ((twig_length_filter($this->env, (isset($context["orphanContainers"]) ? $context["orphanContainers"] : null)) > 0)) {
                // line 64
                echo "                        <div class=\"page-composer__orphan-containers\">
                            <h3 class=\"page-composer__orphan-containers__header\">";
                // line 65
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("page.orphan_containers", array(), "SonataPageBundle"), "html", null, true);
                echo "</h3>
                            <ul>
                                ";
                // line 67
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["orphanContainers"]) ? $context["orphanContainers"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["orphanContainer"]) {
                    // line 68
                    echo "                                    <li class=\"page-composer__orphan-container block-preview-";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["orphanContainer"], "id", array()), "html", null, true);
                    echo "\"
                                        data-block-id=\"";
                    // line 69
                    echo twig_escape_filter($this->env, $this->getAttribute($context["orphanContainer"], "id", array()), "html", null, true);
                    echo "\"
                                        href=\"";
                    // line 70
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "compose_container_show", 1 => array("id" => $this->getAttribute($context["orphanContainer"], "id", array()))), "method"), "html", null, true);
                    echo "\"
                                    >
                                        <strong>";
                    // line 72
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["orphanContainer"], "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["orphanContainer"], "name", array()), $this->getAttribute($context["orphanContainer"], "type", array()))) : ($this->getAttribute($context["orphanContainer"], "type", array()))), "html", null, true);
                    echo "</strong><br>
                                        <small><span class=\"child-count\">";
                    // line 73
                    echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($context["orphanContainer"], "children", array())), "html", null, true);
                    echo "</span> blocks</small>
                                    </li>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['orphanContainer'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 76
                echo "                            </ul>
                        </div>
                    ";
            }
            // line 79
            echo "                </div>
                <div class=\"col-md-8 span8\">
                    <div class=\"page-composer__dyn-content\">
                    </div>
                </div>
            </div>
            <script>
                \$(document).ready(function () {
                    var composer = new PageComposer(";
            // line 87
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "id", array()), "html", null, true);
            echo ", {
                        translations: {
                            cancel: \"";
            // line 89
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("cancel", array(), "SonataPageBundle"), "html", null, true);
            echo "\"
                        },
                        routes: {
                            save_blocks_positions: \"";
            // line 92
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getAdminByAdminCode", array(0 => "sonata.page.admin.block"), "method"), "generateUrl", array(0 => "savePosition", 1 => array("id" => $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "id", array()))), "method"), "html", null, true);
            echo "\",
                            block_switch_parent:   \"";
            // line 93
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getAdminByAdminCode", array(0 => "sonata.page.admin.block"), "method"), "generateUrl", array(0 => "switchParent"), "method"), "html", null, true);
            echo "\",
                            block_preview:         \"";
            // line 94
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getAdminByAdminCode", array(0 => "sonata.page.admin.block"), "method"), "generateUrl", array(0 => "composePreview", 1 => array("block_id" => "BLOCK_ID")), "method"), "html", null, true);
            echo "\"
                        }
                    });
                    composer.csrfTokens = ";
            // line 97
            echo twig_jsonencode_filter((isset($context["csrfTokens"]) ? $context["csrfTokens"] : null));
            echo ";

                    window.SonataPageComposer = composer;
                });
            </script>
        ";
        }
        // line 103
        echo "    </div>


";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:PageAdmin:compose.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  256 => 103,  247 => 97,  241 => 94,  237 => 93,  233 => 92,  227 => 89,  222 => 87,  212 => 79,  207 => 76,  198 => 73,  194 => 72,  189 => 70,  185 => 69,  180 => 68,  176 => 67,  171 => 65,  168 => 64,  166 => 63,  161 => 60,  155 => 59,  148 => 55,  136 => 52,  133 => 51,  119 => 40,  115 => 39,  109 => 36,  99 => 35,  95 => 34,  90 => 33,  87 => 32,  83 => 31,  77 => 27,  74 => 26,  71 => 25,  69 => 24,  60 => 22,  57 => 21,  54 => 20,  48 => 18,  41 => 15,  38 => 14,  11 => 12,);
    }
}
