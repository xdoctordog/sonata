<?php

/* SonataFormatterBundle:Ckeditor:browser.html.twig */
class __TwigTemplate_148047f7a652fe9c1014db3f0af6d4000f971c98ec82263257cf766dd0ee590e extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle::empty_layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'preview' => array($this, 'block_preview'),
            'list_table' => array($this, 'block_list_table'),
            'table_header' => array($this, 'block_table_header'),
            'table_body' => array($this, 'block_table_body'),
            'table_footer' => array($this, 'block_table_footer'),
            'pager_results' => array($this, 'block_pager_results'),
            'num_pages' => array($this, 'block_num_pages'),
            'num_results' => array($this, 'block_num_results'),
            'max_per_page' => array($this, 'block_max_per_page'),
            'pager_links' => array($this, 'block_pager_links'),
            'list_filters' => array($this, 'block_list_filters'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::empty_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 14
        $context["ckParameters"] = array("CKEditor" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "CKEditor"), "method"), "CKEditorFuncNum" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "CKEditorFuncNum"), "method"));
        // line 12
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 16
    public function block_javascripts($context, array $blocks = array())
    {
        // line 17
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        \$(function () {
            \$(\".select\").click(function (e) {
                e.preventDefault();
                window.opener.CKEDITOR.tools.callFunction(";
        // line 23
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "CKEditorFuncNum"), "method"), "js"), "html", null, true);
        echo ", \$(this).attr(\"href\"));
                window.close();
            });
        });
    </script>
";
    }

    // line 31
    public function block_preview($context, array $blocks = array())
    {
        // line 32
        echo "
    <ul class=\"nav nav-pills\">
        <li><a><strong>";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.select_context", array(), "SonataMediaBundle"), "html", null, true);
        echo "</strong></a></li>
        ";
        // line 35
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["media_pool"]) ? $context["media_pool"] : null), "contexts", array()));
        foreach ($context['_seq'] as $context["name"] => $context["context"]) {
            // line 36
            echo "            ";
            if ((twig_length_filter($this->env, $this->getAttribute($context["context"], "providers", array())) == 0)) {
                // line 37
                echo "                ";
                $context["urlParams"] = twig_array_merge(array("context" => $context["name"]), (isset($context["ckParameters"]) ? $context["ckParameters"] : null));
                // line 38
                echo "            ";
            } else {
                // line 39
                echo "                ";
                $context["urlParams"] = twig_array_merge(array("context" => $context["name"], "provider" => $this->getAttribute($this->getAttribute($context["context"], "providers", array()), 0, array(), "array")), (isset($context["ckParameters"]) ? $context["ckParameters"] : null));
                // line 40
                echo "            ";
            }
            // line 41
            echo "
            ";
            // line 42
            if (($context["name"] == $this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "context", array()))) {
                // line 43
                echo "                <li class=\"active\"><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => (isset($context["urlParams"]) ? $context["urlParams"] : null)), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["name"], array(), "SonataMediaBundle"), "html", null, true);
                echo "</a></li>
            ";
            } else {
                // line 45
                echo "                <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => (isset($context["urlParams"]) ? $context["urlParams"] : null)), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["name"], array(), "SonataMediaBundle"), "html", null, true);
                echo "</a></li>
            ";
            }
            // line 47
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['context'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "
        ";
        // line 49
        $context["providers"] = $this->getAttribute((isset($context["media_pool"]) ? $context["media_pool"] : null), "getProviderNamesByContext", array(0 => $this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "context", array())), "method");
        // line 50
        echo "
        ";
        // line 51
        if ((twig_length_filter($this->env, (isset($context["providers"]) ? $context["providers"] : null)) > 1)) {
            // line 52
            echo "            <li><a><strong>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.select_provider", array(), "SonataMediaBundle"), "html", null, true);
            echo "</strong></a></li>

            ";
            // line 54
            if ( !$this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "provider", array())) {
                // line 55
                echo "                <li class=\"active\"><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge(array("context" => $this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "context", array()), "provider" => null), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link.all_providers", array(), "SonataMediaBundle"), "html", null, true);
                echo "</a></li>
            ";
            } else {
                // line 57
                echo "                <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge(array("context" => $this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "context", array()), "provider" => null), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link.all_providers", array(), "SonataMediaBundle"), "html", null, true);
                echo "</a></li>
            ";
            }
            // line 59
            echo "
            ";
            // line 60
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["providers"]) ? $context["providers"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["provider_name"]) {
                // line 61
                echo "                ";
                if (($this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "provider", array()) == $context["provider_name"])) {
                    // line 62
                    echo "                    <li class=\"active\"><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge(array("context" => $this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "context", array()), "provider" => $context["provider_name"]), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["provider_name"], array(), "SonataMediaBundle"), "html", null, true);
                    echo "</a></li>
                ";
                } else {
                    // line 64
                    echo "                    <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge(array("context" => $this->getAttribute((isset($context["persistent_parameters"]) ? $context["persistent_parameters"] : null), "context", array()), "provider" => $context["provider_name"]), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["provider_name"], array(), "SonataMediaBundle"), "html", null, true);
                    echo "</a></li>
                ";
                }
                // line 66
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['provider_name'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo "        ";
        }
        // line 68
        echo "    </ul>

";
    }

    // line 72
    public function block_list_table($context, array $blocks = array())
    {
        // line 73
        echo "    ";
        $context["batchactions"] = $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "batchactions", array());
        // line 74
        echo "    ";
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "results", array())) > 0)) {
            // line 75
            echo "        <table class=\"table table-bordered table-striped\">
            ";
            // line 76
            $this->displayBlock('table_header', $context, $blocks);
            // line 104
            echo "
            ";
            // line 105
            $this->displayBlock('table_body', $context, $blocks);
            // line 129
            echo "
            ";
            // line 130
            $this->displayBlock('table_footer', $context, $blocks);
            // line 201
            echo "        </table>
    ";
        } else {
            // line 203
            echo "        <p class=\"notice\">
            ";
            // line 204
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_result", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </p>
    ";
        }
    }

    // line 76
    public function block_table_header($context, array $blocks = array())
    {
        // line 77
        echo "                <thead>
                <tr class=\"sonata-ba-list-field-header\">
                    ";
        // line 79
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "list", array()), "elements", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["field_description"]) {
            // line 80
            echo "                        ";
            if ((($this->getAttribute($context["field_description"], "getOption", array(0 => "code"), "method") == "_batch") || ($this->getAttribute($context["field_description"], "name", array()) == "_action"))) {
                // line 81
                echo "                            ";
                // line 82
                echo "                        ";
            } else {
                // line 83
                echo "                            ";
                $context["sortable"] = false;
                // line 84
                echo "                            ";
                if (($this->getAttribute($this->getAttribute($context["field_description"], "options", array(), "any", false, true), "sortable", array(), "any", true, true) && $this->getAttribute($this->getAttribute($context["field_description"], "options", array()), "sortable", array()))) {
                    // line 85
                    echo "                                ";
                    $context["sortable"] = true;
                    // line 86
                    echo "                                ";
                    $context["current"] = ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "values", array()), "_sort_by", array()) == $context["field_description"]);
                    // line 87
                    echo "                                ";
                    $context["sort_parameters"] = twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "modelmanager", array()), "sortparameters", array(0 => $context["field_description"], 1 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array())), "method"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null));
                    // line 88
                    echo "                                ";
                    $context["sort_active_class"] = (((isset($context["current"]) ? $context["current"] : null)) ? ("sonata-ba-list-field-order-active") : (""));
                    // line 89
                    echo "                                ";
                    $context["sort_by"] = (((isset($context["current"]) ? $context["current"] : null)) ? ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "values", array()), "_sort_order", array())) : ($this->getAttribute($this->getAttribute($context["field_description"], "options", array()), "_sort_order", array())));
                    // line 90
                    echo "                            ";
                }
                // line 91
                echo "
                            ";
                // line 92
                ob_start();
                // line 93
                echo "                                <th class=\"sonata-ba-list-field-header-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["field_description"], "type", array()), "html", null, true);
                echo " ";
                if ((isset($context["sortable"]) ? $context["sortable"] : null)) {
                    echo " sonata-ba-list-field-header-order-";
                    echo twig_escape_filter($this->env, twig_lower_filter($this->env, (isset($context["sort_by"]) ? $context["sort_by"] : null)), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, (isset($context["sort_active_class"]) ? $context["sort_active_class"] : null), "html", null, true);
                }
                echo "\">
                                    ";
                // line 94
                if ((isset($context["sortable"]) ? $context["sortable"] : null)) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => (isset($context["sort_parameters"]) ? $context["sort_parameters"] : null)), "method"), "html", null, true);
                    echo "\">";
                }
                // line 95
                echo "                                        ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "trans", array(0 => $this->getAttribute($context["field_description"], "label", array())), "method"), "html", null, true);
                echo "
                                        ";
                // line 96
                if ((isset($context["sortable"]) ? $context["sortable"] : null)) {
                    echo "</a>";
                }
                // line 97
                echo "                                </th>
                            ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 99
                echo "                        ";
            }
            // line 100
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_description'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        echo "                </tr>
                </thead>
            ";
    }

    // line 105
    public function block_table_body($context, array $blocks = array())
    {
        // line 106
        echo "                <tbody>
                    ";
        // line 107
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "results", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["object"]) {
            // line 108
            echo "                        <tr>
                            <td colspan=\"";
            // line 109
            echo twig_escape_filter($this->env, (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "list", array()), "elements", array())) - 1), "html", null, true);
            echo "\">
                                <div>
                                    <a href=\"";
            // line 111
            echo $this->env->getExtension('sonata_media')->path($context["object"], "reference");
            echo "\" class=\"select\" style=\"float: left; margin-right: 6px;\">";
            echo $this->env->getExtension('sonata_media')->thumbnail($context["object"], "admin", array("width" => 75, "height" => 60));
            echo "</a>

                                    <strong><a href=\"";
            // line 113
            echo $this->env->getExtension('sonata_media')->path($context["object"], "reference");
            echo "\" class=\"select\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["object"], "name", array()), "html", null, true);
            echo "</a></strong> <br />
                                    ";
            // line 114
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($context["object"], "providerName", array()), array(), "SonataMediaBundle"), "html", null, true);
            if ($this->getAttribute($context["object"], "width", array())) {
                echo ": ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["object"], "width", array()), "html", null, true);
                if ($this->getAttribute($context["object"], "height", array())) {
                    echo "x";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["object"], "height", array()), "html", null, true);
                }
                echo "px";
            }
            // line 115
            echo "
                                    ";
            // line 116
            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["formats"]) ? $context["formats"] : null), $this->getAttribute($context["object"], "id", array()), array(), "array")) > 0)) {
                // line 117
                echo "                                        - ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title.formats", array(), "SonataMediaBundle"), "html", null, true);
                echo ":
                                        ";
                // line 118
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["formats"]) ? $context["formats"] : null), $this->getAttribute($context["object"], "id", array()), array(), "array"));
                foreach ($context['_seq'] as $context["name"] => $context["format"]) {
                    // line 119
                    echo "                                            <a href=\"";
                    echo $this->env->getExtension('sonata_media')->path($context["object"], $context["name"]);
                    echo "\" class=\"select\">";
                    echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                    echo "</a> ";
                    if ($this->getAttribute($context["format"], "width", array())) {
                        echo "(";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["format"], "width", array()), "html", null, true);
                        if ($this->getAttribute($context["format"], "height", array())) {
                            echo "x";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["format"], "height", array()), "html", null, true);
                        }
                        echo "px)";
                    }
                    // line 120
                    echo "                                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['name'], $context['format'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 121
                echo "                                    ";
            }
            // line 122
            echo "                                    <br />
                                </div>
                            </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['object'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 127
        echo "                </tbody>
            ";
    }

    // line 130
    public function block_table_footer($context, array $blocks = array())
    {
        // line 131
        echo "                <tr>
                    <th colspan=\"";
        // line 132
        echo twig_escape_filter($this->env, (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "list", array()), "elements", array())) - 2), "html", null, true);
        echo "\">
                        <div class=\"form-inline\">
                            <div class=\"pull-right\">
                                ";
        // line 135
        $this->displayBlock('pager_results', $context, $blocks);
        // line 157
        echo "                            </div>
                        </div>
                    </th>
                </tr>

                ";
        // line 162
        $this->displayBlock('pager_links', $context, $blocks);
        // line 199
        echo "
            ";
    }

    // line 135
    public function block_pager_results($context, array $blocks = array())
    {
        // line 136
        echo "                                    ";
        $this->displayBlock('num_pages', $context, $blocks);
        // line 140
        echo "
                                    ";
        // line 141
        $this->displayBlock('num_results', $context, $blocks);
        // line 145
        echo "
                                    ";
        // line 146
        $this->displayBlock('max_per_page', $context, $blocks);
        // line 156
        echo "                                ";
    }

    // line 136
    public function block_num_pages($context, array $blocks = array())
    {
        // line 137
        echo "                                        ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "page", array()), "html", null, true);
        echo " / ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "lastpage", array()), "html", null, true);
        echo "
                                        &nbsp;-&nbsp;
                                    ";
    }

    // line 141
    public function block_num_results($context, array $blocks = array())
    {
        // line 142
        echo "                                        ";
        echo $this->env->getExtension('translator')->getTranslator()->transChoice("list_results_count", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "nbresults", array()), array("%count%" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "nbresults", array())), "SonataAdminBundle");
        // line 143
        echo "                                        &nbsp;-&nbsp;
                                    ";
    }

    // line 146
    public function block_max_per_page($context, array $blocks = array())
    {
        // line 147
        echo "                                        <label class=\"control-label\" for=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uniqid", array()), "html", null, true);
        echo "_per_page\">";
        echo $this->env->getExtension('translator')->getTranslator()->trans("label_per_page", array(), "SonataAdminBundle");
        echo "</label>
                                        <select class=\"per-page small\" id=\"";
        // line 148
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uniqid", array()), "html", null, true);
        echo "_per_page\" style=\"width: auto; height: auto\">
                                            ";
        // line 149
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "getperpageoptions", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["per_page"]) {
            // line 150
            echo "                                                <option ";
            if (($context["per_page"] == $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "maxperpage", array()))) {
                echo "selected=\"selected\"";
            }
            echo " value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge(array("filter" => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "values", array()), array("_per_page" => $context["per_page"]))), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
            echo "\">
                                                    ";
            // line 151
            echo twig_escape_filter($this->env, $context["per_page"], "html", null, true);
            echo "
                                                </option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['per_page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 154
        echo "                                        </select>
                                    ";
    }

    // line 162
    public function block_pager_links($context, array $blocks = array())
    {
        // line 163
        echo "                    ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "haveToPaginate", array(), "method")) {
            // line 164
            echo "                        <tr>
                            <td colspan=\"";
            // line 165
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "list", array()), "elements", array())), "html", null, true);
            echo "\">
                                <div class=\"pagination pagination-centered\">
                                    <ul>
                                        ";
            // line 168
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "page", array()) > 2)) {
                // line 169
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "modelmanager", array()), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), 1 => 1), "method"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_first_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&laquo;</a></li>
                                        ";
            }
            // line 171
            echo "
                                        ";
            // line 172
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "page", array()) != $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "previouspage", array()))) {
                // line 173
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "modelmanager", array()), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), 1 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "previouspage", array())), "method"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_previous_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&lsaquo;</a></li>
                                        ";
            }
            // line 175
            echo "
                                        ";
            // line 177
            echo "                                        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "getLinks", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                // line 178
                echo "                                            ";
                if (($context["page"] == $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "page", array()))) {
                    // line 179
                    echo "                                                <li class=\"active\"><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "modelmanager", array()), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), 1 => $context["page"]), "method"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "</a></li>
                                            ";
                } else {
                    // line 181
                    echo "                                                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "modelmanager", array()), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), 1 => $context["page"]), "method"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "</a></li>
                                            ";
                }
                // line 183
                echo "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 184
            echo "
                                        ";
            // line 185
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "page", array()) != $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "nextpage", array()))) {
                // line 186
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "modelmanager", array()), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), 1 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "nextpage", array())), "method"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_next_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&rsaquo;</a></li>
                                        ";
            }
            // line 188
            echo "
                                        ";
            // line 189
            if ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "page", array()) != $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "lastpage", array())) && ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "lastpage", array()) != $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "nextpage", array())))) {
                // line 190
                echo "                                            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "modelmanager", array()), "paginationparameters", array(0 => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), 1 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "pager", array()), "lastpage", array())), "method"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_last_pager", array(), "SonataAdminBundle"), "html", null, true);
                echo "\">&raquo;</a></li>
                                        ";
            }
            // line 192
            echo "                                    </ul>
                                </div>
                            </td>
                        </tr>

                    ";
        }
        // line 198
        echo "                ";
    }

    // line 209
    public function block_list_filters($context, array $blocks = array())
    {
        // line 210
        echo "    ";
        if ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "filters", array())) {
            // line 211
            echo "        <form class=\"sonata-filter-form ";
            echo ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "isChild", array()) && (1 == twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "filters", array()))))) ? ("hide") : (""));
            echo "\" action=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser"), "method"), "html", null, true);
            echo "\" method=\"GET\">
            <fieldset class=\"filter_legend\">
                <legend class=\"filter_legend ";
            // line 213
            echo (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "hasActiveFilters", array())) ? ("active") : ("inactive"));
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_filters", array(), "SonataAdminBundle"), "html", null, true);
            echo "</legend>

                <div class=\"filter_container ";
            // line 215
            echo (($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "hasActiveFilters", array())) ? ("active") : ("inactive"));
            echo "\">
                    <div>
                        ";
            // line 217
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "datagrid", array()), "filters", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["filter"]) {
                // line 218
                echo "                            <div class=\"clearfix\">
                                <label for=\"";
                // line 219
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()), $this->getAttribute($context["filter"], "formName", array()), array(), "array"), "children", array()), "value", array(), "array"), "vars", array()), "id", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "trans", array(0 => $this->getAttribute($context["filter"], "label", array())), "method"), "html", null, true);
                echo "</label>
                                ";
                // line 220
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()), $this->getAttribute($context["filter"], "formName", array()), array(), "array"), "children", array()), "type", array(), "array"), 'widget', array("attr" => array("class" => "span8 sonata-filter-option")));
                echo "
                                ";
                // line 221
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()), $this->getAttribute($context["filter"], "formName", array()), array(), "array"), "children", array()), "value", array(), "array"), 'widget', array("attr" => array("class" => "span8")));
                echo "
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 224
            echo "                    </div>

                    <input type=\"hidden\" name=\"filter[_page]\" id=\"filter__page\" value=\"1\" />

                    ";
            // line 228
            $context["foo"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()), "_page", array(), "array"), "setRendered", array(), "method");
            // line 229
            echo "                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
            echo "

                    <input type=\"submit\" class=\"btn btn-primary\" value=\"";
            // line 231
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_filter", array(), "SonataAdminBundle"), "html", null, true);
            echo "\" />

                    <a class=\"btn\" href=\"";
            // line 233
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "ckeditor_browser", 1 => twig_array_merge(array("filters" => "reset"), (isset($context["ckParameters"]) ? $context["ckParameters"] : null))), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_reset_filter", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a>
                </div>

                ";
            // line 236
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_array_merge($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "persistentParameters", array()), (isset($context["ckParameters"]) ? $context["ckParameters"] : null)));
            foreach ($context['_seq'] as $context["paramKey"] => $context["paramValue"]) {
                // line 237
                echo "                    <input type=\"hidden\" name=\"";
                echo twig_escape_filter($this->env, $context["paramKey"], "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $context["paramValue"], "html", null, true);
                echo "\" />
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['paramKey'], $context['paramValue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 239
            echo "            </fieldset>
        </form>
    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataFormatterBundle:Ckeditor:browser.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  749 => 239,  738 => 237,  734 => 236,  726 => 233,  721 => 231,  715 => 229,  713 => 228,  707 => 224,  698 => 221,  694 => 220,  688 => 219,  685 => 218,  681 => 217,  676 => 215,  669 => 213,  661 => 211,  658 => 210,  655 => 209,  651 => 198,  643 => 192,  635 => 190,  633 => 189,  630 => 188,  622 => 186,  620 => 185,  617 => 184,  611 => 183,  603 => 181,  595 => 179,  592 => 178,  587 => 177,  584 => 175,  576 => 173,  574 => 172,  571 => 171,  563 => 169,  561 => 168,  555 => 165,  552 => 164,  549 => 163,  546 => 162,  541 => 154,  532 => 151,  523 => 150,  519 => 149,  515 => 148,  508 => 147,  505 => 146,  500 => 143,  497 => 142,  494 => 141,  484 => 137,  481 => 136,  477 => 156,  475 => 146,  472 => 145,  470 => 141,  467 => 140,  464 => 136,  461 => 135,  456 => 199,  454 => 162,  447 => 157,  445 => 135,  439 => 132,  436 => 131,  433 => 130,  428 => 127,  418 => 122,  415 => 121,  409 => 120,  394 => 119,  390 => 118,  385 => 117,  383 => 116,  380 => 115,  369 => 114,  363 => 113,  356 => 111,  351 => 109,  348 => 108,  344 => 107,  341 => 106,  338 => 105,  332 => 101,  326 => 100,  323 => 99,  319 => 97,  315 => 96,  310 => 95,  304 => 94,  292 => 93,  290 => 92,  287 => 91,  284 => 90,  281 => 89,  278 => 88,  275 => 87,  272 => 86,  269 => 85,  266 => 84,  263 => 83,  260 => 82,  258 => 81,  255 => 80,  251 => 79,  247 => 77,  244 => 76,  236 => 204,  233 => 203,  229 => 201,  227 => 130,  224 => 129,  222 => 105,  219 => 104,  217 => 76,  214 => 75,  211 => 74,  208 => 73,  205 => 72,  199 => 68,  196 => 67,  190 => 66,  182 => 64,  174 => 62,  171 => 61,  167 => 60,  164 => 59,  156 => 57,  148 => 55,  146 => 54,  140 => 52,  138 => 51,  135 => 50,  133 => 49,  130 => 48,  124 => 47,  116 => 45,  108 => 43,  106 => 42,  103 => 41,  100 => 40,  97 => 39,  94 => 38,  91 => 37,  88 => 36,  84 => 35,  80 => 34,  76 => 32,  73 => 31,  63 => 23,  53 => 17,  50 => 16,  46 => 12,  44 => 14,  11 => 12,);
    }
}
