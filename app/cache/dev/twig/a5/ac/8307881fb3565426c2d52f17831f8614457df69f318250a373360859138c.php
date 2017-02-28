<?php

/* SonataPageBundle::base_layout.html.twig */
class __TwigTemplate_a5ac8307881fb3565426c2d52f17831f8614457df69f318250a373360859138c extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_page_html_tag' => array($this, 'block_sonata_page_html_tag'),
            'sonata_page_head' => array($this, 'block_sonata_page_head'),
            'sonata_page_stylesheets' => array($this, 'block_sonata_page_stylesheets'),
            'page_stylesheets' => array($this, 'block_page_stylesheets'),
            'sonata_page_javascripts' => array($this, 'block_sonata_page_javascripts'),
            'page_javascripts' => array($this, 'block_page_javascripts'),
            'sonata_page_body_tag' => array($this, 'block_sonata_page_body_tag'),
            'sonata_page_top_bar' => array($this, 'block_sonata_page_top_bar'),
            'page_top_bar' => array($this, 'block_page_top_bar'),
            'sonata_page_container' => array($this, 'block_sonata_page_container'),
            'page_container' => array($this, 'block_page_container'),
            'sonata_page_asset_footer' => array($this, 'block_sonata_page_asset_footer'),
            'page_asset_footer' => array($this, 'block_page_asset_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        $this->displayBlock('sonata_page_html_tag', $context, $blocks);
        // line 15
        echo "    ";
        $this->displayBlock('sonata_page_head', $context, $blocks);
        // line 45
        echo "
    ";
        // line 46
        $this->displayBlock('sonata_page_body_tag', $context, $blocks);
        // line 49
        echo "
        ";
        // line 50
        $this->displayBlock('sonata_page_top_bar', $context, $blocks);
        // line 141
        echo "
        ";
        // line 142
        $this->displayBlock('sonata_page_container', $context, $blocks);
        // line 145
        echo "
        ";
        // line 146
        $this->displayBlock('sonata_page_asset_footer', $context, $blocks);
        // line 168
        echo "
        <!-- monitoring:3e9fda56df2cdd3b039f189693ab7844fbb2d4f6 -->
    </body>
</html>
";
    }

    // line 11
    public function block_sonata_page_html_tag($context, array $blocks = array())
    {
        // line 12
        echo "<!DOCTYPE html>
<html ";
        // line 13
        echo $this->env->getExtension('sonata_seo')->getHtmlAttributes();
        echo ">
";
    }

    // line 15
    public function block_sonata_page_head($context, array $blocks = array())
    {
        // line 16
        echo "        <head ";
        echo $this->env->getExtension('sonata_seo')->getHeadAttributes();
        echo ">

            <!--[if IE]><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><![endif]-->
            ";
        // line 19
        echo $this->env->getExtension('sonata_seo')->getTitle();
        echo "
            ";
        // line 20
        echo $this->env->getExtension('sonata_seo')->getMetadatas();
        echo "

            ";
        // line 22
        $this->displayBlock('sonata_page_stylesheets', $context, $blocks);
        // line 29
        echo "
            ";
        // line 30
        $this->displayBlock('sonata_page_javascripts', $context, $blocks);
        // line 43
        echo "        </head>
    ";
    }

    // line 22
    public function block_sonata_page_stylesheets($context, array $blocks = array())
    {
        // line 23
        echo "                ";
        $this->displayBlock('page_stylesheets', $context, $blocks);
        // line 28
        echo "            ";
    }

    // line 23
    public function block_page_stylesheets($context, array $blocks = array())
    {
        echo " ";
        // line 24
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "assets", array()), "stylesheets", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["stylesheet"]) {
            // line 25
            echo "                        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($context["stylesheet"]), "html", null, true);
            echo "\" media=\"all\">
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stylesheet'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "                ";
    }

    // line 30
    public function block_sonata_page_javascripts($context, array $blocks = array())
    {
        // line 31
        echo "                ";
        $this->displayBlock('page_javascripts', $context, $blocks);
        // line 41
        echo "
            ";
    }

    // line 31
    public function block_page_javascripts($context, array $blocks = array())
    {
        echo " ";
        // line 32
        echo "                    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
                    <!--[if lt IE 9]>
                        <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
                    <![endif]-->

                    ";
        // line 37
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "assets", array()), "javascripts", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["js"]) {
            // line 38
            echo "                        <script src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($context["js"]), "html", null, true);
            echo "\"></script>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "                ";
    }

    // line 46
    public function block_sonata_page_body_tag($context, array $blocks = array())
    {
        // line 47
        echo "        <body class=\"sonata-bc\">
    ";
    }

    // line 50
    public function block_sonata_page_top_bar($context, array $blocks = array())
    {
        // line 51
        echo "            ";
        $this->displayBlock('page_top_bar', $context, $blocks);
        // line 140
        echo "        ";
    }

    // line 51
    public function block_page_top_bar($context, array $blocks = array())
    {
        echo " ";
        // line 52
        echo "                ";
        if (($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isEditor", array()) || (($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "security", array()) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "security", array()), "token", array())) && $this->env->getExtension('security')->isGranted("ROLE_PREVIOUS_ADMIN")))) {
            // line 53
            echo "
                    ";
            // line 54
            if (($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isEditor", array()) && $this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isInlineEditionOn", array()))) {
                // line 55
                echo "                        <!-- CMS specific variables -->
                        <script>
                            jQuery(document).ready(function() {
                                Sonata.Page.init({
                                    url: {
                                        block_save_position: '";
                // line 60
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_sonata_page_block_savePosition", array("id" => $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "id", array()))), "html", null, true);
                echo "',
                                        block_edit:          '";
                // line 61
                echo $this->env->getExtension('routing')->getPath("admin_sonata_page_block_edit", array("id" => "BLOCK_ID"));
                echo "'
                                    }
                                });
                            });
                        </script>
                    ";
            }
            // line 67
            echo "
                    <header class=\"sonata-bc sonata-page-top-bar navbar navbar-inverse navbar-fixed-top\" role=\"banner\">
                        <div class=\"container\">
                            <ul class=\"nav navbar-nav\">
                                ";
            // line 71
            if ((($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "security", array()) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "security", array()), "token", array())) && $this->env->getExtension('security')->isGranted("ROLE_SONATA_ADMIN"))) {
                // line 72
                echo "                                    <li><a href=\"";
                echo $this->env->getExtension('routing')->getPath("sonata_admin_dashboard");
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.sonata_admin_dashboard", array(), "SonataPageBundle"), "html", null, true);
                echo "</a></li>
                                ";
            }
            // line 74
            echo "
                                ";
            // line 75
            if ($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isEditor", array())) {
                // line 76
                echo "                                    ";
                $context["sites"] = $this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "siteavailables", array());
                // line 77
                echo "
                                    ";
                // line 78
                if (((twig_length_filter($this->env, (isset($context["sites"]) ? $context["sites"] : $this->getContext($context, "sites"))) > 1) && array_key_exists("site", $context))) {
                    // line 79
                    echo "                                        <li class=\"dropdown\">
                                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
                    // line 80
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["site"]) ? $context["site"] : $this->getContext($context, "site")), "name", array()), "html", null, true);
                    echo " <span class=\"caret\"></span></a>
                                            <ul class=\"dropdown-menu\">
                                                ";
                    // line 82
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["sites"]) ? $context["sites"] : $this->getContext($context, "sites")));
                    foreach ($context['_seq'] as $context["_key"] => $context["site"]) {
                        // line 83
                        echo "                                                    <li><a href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["site"], "url", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["site"], "name", array()), "html", null, true);
                        echo "</a></li>
                                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['site'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 85
                    echo "                                            </ul>
                                        </li>
                                    ";
                }
                // line 88
                echo "
                                    <li class=\"dropdown\">
                                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Page <span class=\"caret\"></span></a>
                                        <ul class=\"dropdown-menu\">
                                            ";
                // line 92
                if (array_key_exists("page", $context)) {
                    // line 93
                    echo "                                                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_sonata_page_page_edit", array("id" => $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "id", array()))), "html", null, true);
                    echo "\" target=\"_new\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.edit_page", array(), "SonataPageBundle"), "html", null, true);
                    echo "</a></li>
                                                <li><a href=\"";
                    // line 94
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_sonata_page_page_snapshot_create", array("id" => $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "id", array()))), "html", null, true);
                    echo "\" target=\"_new\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.create_snapshot", array(), "SonataPageBundle"), "html", null, true);
                    echo "</a></li>
                                                <li class=\"divider\"></li>
                                            ";
                }
                // line 97
                echo "
                                            <li><a href=\"";
                // line 98
                echo $this->env->getExtension('routing')->getPath("admin_sonata_page_page_list");
                echo "\" target=\"_new\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.view_all_pages", array(), "SonataPageBundle"), "html", null, true);
                echo "</a></li>

                                            ";
                // line 100
                if ((array_key_exists("error_codes", $context) && twig_length_filter($this->env, (isset($context["error_codes"]) ? $context["error_codes"] : $this->getContext($context, "error_codes"))))) {
                    // line 101
                    echo "                                                <li class=\"divider\"></li>
                                                <li><a href=\"";
                    // line 102
                    echo $this->env->getExtension('routing')->getPath("sonata_page_exceptions_list");
                    echo "\" target=\"_new\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.view_all_exceptions", array(), "SonataPageBundle"), "html", null, true);
                    echo "</a></li>
                                            ";
                }
                // line 104
                echo "                                        </ul>
                                    </li>

                                    ";
                // line 107
                if (array_key_exists("page", $context)) {
                    // line 108
                    echo "                                        <li>
                                            <a href=\"";
                    // line 109
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_sonata_page_page_compose", array("id" => $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "id", array()))), "html", null, true);
                    echo "\">
                                                <i class=\"fa fa-magic\"></i>
                                                ";
                    // line 111
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.compose_page", array(), "SonataPageBundle"), "html", null, true);
                    echo "
                                            </a>
                                        </li>
                                    ";
                }
                // line 115
                echo "
                                    ";
                // line 116
                if ((array_key_exists("page", $context) &&  !$this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "enabled", array()))) {
                    // line 117
                    echo "                                        <li><span style=\"padding-left: 20px; background: red;\"><strong><em>";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.page_is_disabled", array(), "SonataPageBundle"), "html", null, true);
                    echo "</em></strong></span></li>
                                    ";
                }
                // line 119
                echo "
                                    ";
                // line 120
                if (($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : $this->getContext($context, "sonata_page")), "isInlineEditionOn", array()) && array_key_exists("page", $context))) {
                    // line 121
                    echo "                                        <li>
                                            <form class=\"form-inline\" style=\"margin: 0px\">
                                                <label class=\"checkbox inline\" for=\"page-action-enabled-edit\"><input type=\"checkbox\" id=\"page-action-enabled-edit\">";
                    // line 123
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.show_zone", array(), "SonataPageBundle"), "html", null, true);
                    echo "</label>
                                                <input type=\"submit\" class=\"btn\" value=\"";
                    // line 124
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_save_position", array(), "SonataPageBundle"), "html", null, true);
                    echo "\" id=\"page-action-save-position\">
                                            </form>
                                        </li>
                                    ";
                }
                // line 128
                echo "                                ";
            }
            // line 129
            echo "
                                ";
            // line 130
            if ((($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "security", array()) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "security", array()), "token", array())) && $this->env->getExtension('security')->isGranted("ROLE_PREVIOUS_ADMIN"))) {
                // line 131
                echo "                                    <li><a href=\"";
                echo $this->env->getExtension('routing')->getUrl("homepage", array("_switch_user" => "_exit"));
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("header.switch_user_exit", array(), "SonataPageBundle"), "html", null, true);
                echo "</a></li>
                                ";
            }
            // line 133
            echo "
                            </ul>
                        </div>
                    </header>

                ";
        }
        // line 139
        echo "            ";
    }

    // line 142
    public function block_sonata_page_container($context, array $blocks = array())
    {
        // line 143
        echo "            ";
        $this->displayBlock('page_container', $context, $blocks);
        echo " ";
        // line 144
        echo "        ";
    }

    // line 143
    public function block_page_container($context, array $blocks = array())
    {
    }

    // line 146
    public function block_sonata_page_asset_footer($context, array $blocks = array())
    {
        // line 147
        echo "            ";
        $this->displayBlock('page_asset_footer', $context, $blocks);
        // line 167
        echo "        ";
    }

    // line 147
    public function block_page_asset_footer($context, array $blocks = array())
    {
        echo " ";
        // line 148
        echo "                ";
        if (array_key_exists("page", $context)) {
            // line 149
            echo "                    ";
            if ( !twig_test_empty($this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "javascript", array()))) {
                // line 150
                echo "                        <script>
                            ";
                // line 151
                echo $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "javascript", array());
                echo "
                        </script>
                    ";
            }
            // line 154
            echo "                    ";
            if ( !twig_test_empty($this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "stylesheet", array()))) {
                // line 155
                echo "                        <style>
                            ";
                // line 156
                echo $this->getAttribute((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "stylesheet", array());
                echo "
                        </style>
                    ";
            }
            // line 159
            echo "                ";
        }
        // line 160
        echo "                ";
        // line 164
        echo "                ";
        echo call_user_func_array($this->env->getFunction('sonata_block_include_stylesheets')->getCallable(), array("screen", $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "basePath", array())));
        echo "
                ";
        // line 165
        echo call_user_func_array($this->env->getFunction('sonata_block_include_javascripts')->getCallable(), array("screen", $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "basePath", array())));
        echo "
            ";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle::base_layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  479 => 165,  474 => 164,  472 => 160,  469 => 159,  463 => 156,  460 => 155,  457 => 154,  451 => 151,  448 => 150,  445 => 149,  442 => 148,  438 => 147,  434 => 167,  431 => 147,  428 => 146,  423 => 143,  419 => 144,  415 => 143,  412 => 142,  408 => 139,  400 => 133,  392 => 131,  390 => 130,  387 => 129,  384 => 128,  377 => 124,  373 => 123,  369 => 121,  367 => 120,  364 => 119,  358 => 117,  356 => 116,  353 => 115,  346 => 111,  341 => 109,  338 => 108,  336 => 107,  331 => 104,  324 => 102,  321 => 101,  319 => 100,  312 => 98,  309 => 97,  301 => 94,  294 => 93,  292 => 92,  286 => 88,  281 => 85,  270 => 83,  266 => 82,  261 => 80,  258 => 79,  256 => 78,  253 => 77,  250 => 76,  248 => 75,  245 => 74,  237 => 72,  235 => 71,  229 => 67,  220 => 61,  216 => 60,  209 => 55,  207 => 54,  204 => 53,  201 => 52,  197 => 51,  193 => 140,  190 => 51,  187 => 50,  182 => 47,  179 => 46,  175 => 40,  166 => 38,  162 => 37,  155 => 32,  151 => 31,  146 => 41,  143 => 31,  140 => 30,  136 => 27,  127 => 25,  122 => 24,  118 => 23,  114 => 28,  111 => 23,  108 => 22,  103 => 43,  101 => 30,  98 => 29,  96 => 22,  91 => 20,  87 => 19,  80 => 16,  77 => 15,  71 => 13,  68 => 12,  65 => 11,  57 => 168,  55 => 146,  52 => 145,  50 => 142,  47 => 141,  45 => 50,  42 => 49,  40 => 46,  37 => 45,  34 => 15,  32 => 11,);
    }
}
