<?php

/* SonataMediaBundle:MediaAdmin:edit.html.twig */
class __TwigTemplate_4a2aee483936ac531910734b266bd0abab3aca28ef479a93044bae35d6ae8e0b extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_edit.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
            'sonata_media_show_reference' => array($this, 'block_sonata_media_show_reference'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style>
        button.btn.btn-sm.btn-default.pixlr-link {
            margin-bottom: 0;
        }
    </style>
";
    }

    // line 23
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 24
        echo "
    <div class=\"row\">
        ";
        // line 26
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "id", array())) {
            // line 27
            echo "            <div class=\"col-md-6\">
                ";
            // line 28
            $this->displayBlock('sonata_media_show_reference', $context, $blocks);
            // line 103
            echo "            </div>
        ";
        }
        // line 105
        echo "
        <div class=\"col-md-6\">
            ";
        // line 108
        echo "            ";
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
        </div>
    </div>

    ";
        // line 112
        if (($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : null), "pixlr", array()) && $this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : null), "pixlr", array()), "isEditable", array(0 => (isset($context["object"]) ? $context["object"] : null)), "method"))) {
            // line 113
            echo "        <div class=\"modal fade\" id=\"pixlr-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.edit_with_pixlr", array(), "SonataMediaBundle"), "html", null, true);
            echo "\" aria-hidden=\"true\">
            <div class=\"modal-dialog modal-lg\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                        <h4 class=\"modal-title\" id=\"myModalLabel\">";
            // line 118
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.edit_with_pixlr", array(), "SonataMediaBundle"), "html", null, true);
            echo "</h4>
                    </div>
                    <div class=\"modal-body\" id=\"pixlr-modal-body\">
                    </div>
                </div>
            </div>
        </div>

        <script type=\"text/javascript\">
            window.closeModal = function() {
                jQuery('#pixlr-modal').modal('hide');
            }

            jQuery('button.pixlr-link').on('click', function(e) {
                e.preventDefault();
                var url = jQuery(this).attr('data-href');
                jQuery(\"#pixlr-modal-body\").html('<iframe width=\"100%\" height=\"100%\" frameborder=\"0\" scrolling=\"no\" allowtransparency=\"true\" src=\"'+url+'\"></iframe>');
            });

            Admin.setup_list_modal(jQuery('#pixlr-modal'));
        </script>
    ";
        }
        // line 140
        echo "

";
    }

    // line 28
    public function block_sonata_media_show_reference($context, array $blocks = array())
    {
        // line 29
        echo "                    <div class=\"box box-primary\">
                        <div class=\"box-header\">
                            <h3 class=\"box-title\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title.media_preview", array(), "SonataMediaBundle"), "html", null, true);
        echo "</h3>
                            ";
        // line 32
        if (($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : null), "pixlr", array()) && $this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : null), "pixlr", array()), "isEditable", array(0 => (isset($context["object"]) ? $context["object"] : null)), "method"))) {
            // line 33
            echo "                                <div class=\"box-tools pull-right\">
                                    <button class=\"btn btn-sm btn-default pixlr-link\"
                                            data-href=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_pixlr_open_editor", array("id" => $this->env->getExtension('sonata_core_template')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "html", null, true);
            echo "\"
                                            data-toggle=\"modal\"
                                            data-target=\"#pixlr-modal\"
                                            >
                                        <i class=\"fa fa-pencil-square-o\"></i> ";
            // line 39
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.edit_with_pixlr", array(), "SonataMediaBundle"), "html", null, true);
            echo "
                                    </button>
                                </div>
                            ";
        }
        // line 43
        echo "
                        </div>
                        <div class=\"box-body table-responsive\">

                            <center> <!-- yeah, center is still awesome ;) -->
                                ";
        // line 48
        echo $this->env->getExtension('sonata_media')->media((isset($context["object"]) ? $context["object"] : null), "reference", array("width" => null, "height" => null, "class" => "img-responsive img-rounded"));
        // line 49
        echo "                            </center>

                            <table class=\"table\">
                                <tr>
                                    <th>";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.size", array(), "SonataMediaBundle"), "html", null, true);
        echo "</th>
                                    <td>";
        // line 54
        echo $this->env->getExtension('sonata_intl_number')->formatDecimal($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "width", array()));
        echo "px x ";
        echo $this->env->getExtension('sonata_intl_number')->formatDecimal($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "height", array()));
        echo "px
                                        ";
        // line 55
        if (($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "size", array()) > 0)) {
            echo "(";
            echo $this->env->getExtension('sonata_intl_number')->formatDecimal($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "size", array()));
            echo "o)";
        }
        echo "</td>
                                <tr>
                                <tr>
                                    <th>";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.content_type", array(), "SonataMediaBundle"), "html", null, true);
        echo "</th>
                                    <td>";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "contenttype", array()), "html", null, true);
        echo "</td>
                                <tr>
                                <tr>
                                    <th>";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.cdn", array(), "SonataMediaBundle"), "html", null, true);
        echo "</th>
                                    <td>
                                        ";
        // line 64
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "cdnisflushable", array())) {
            // line 65
            echo "                                            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.to_be_flushed", array(), "SonataMediaBundle"), "html", null, true);
            echo "
                                        ";
        } else {
            // line 67
            echo "                                            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.flushed_at", array(), "SonataMediaBundle"), "html", null, true);
            echo "
                                            ";
            // line 68
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "cdnflushat", array())), "html", null, true);
            echo "
                                        ";
        }
        // line 70
        echo "                                    </td>
                                <tr>
                                <tr>
                                    <th><a href=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->env->getExtension('sonata_core_template')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.protected_download_url", array(), "SonataMediaBundle"), "html", null, true);
        echo "</a></th>
                                    <td>
                                        <input type=\"text\" class=\"form-control\" onClick=\"this.select();\" readonly=\"readonly\" value=\"";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->env->getExtension('sonata_core_template')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "html", null, true);
        echo "\" />
                                        <span class=\"label label-warning\">";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.protected_download_url_notice", array(), "SonataMediaBundle"), "html", null, true);
        echo "</span> ";
        echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : null), "pool", array()), "downloadSecurity", array(0 => (isset($context["object"]) ? $context["object"] : null)), "method"), "description", array());
        echo "
                                    </td>
                                <tr>
                                <tr>
                                    <th>
                                        <a href=\"";
        // line 81
        echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : null), "reference");
        echo "\" target=\"_blank\">reference</a>
                                    </th>
                                    <td>
                                        <input type=\"text\" class=\"form-control\" onClick=\"this.select();\" readonly=\"readonly\" value=\"";
        // line 84
        echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : null), "reference");
        echo "\" />
                                    </td>
                                </tr>

                                ";
        // line 88
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : null), "pool", array()), "formatNamesByContext", array(0 => $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "context", array())), "method"));
        foreach ($context['_seq'] as $context["name"] => $context["format"]) {
            // line 89
            echo "                                    <tr>
                                        <th>
                                            <a href=\"";
            // line 91
            echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : null), $context["name"]);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
            echo "</a>
                                        </th>
                                        <td>
                                            <input type=\"text\" class=\"form-control\" onClick=\"this.select();\" readonly=\"readonly\" value=\"";
            // line 94
            echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : null), $context["name"]);
            echo "\" />
                                        </td>
                                    </tr>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['format'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "                            </table>
                        </div>

                    </div>
                ";
    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  289 => 98,  279 => 94,  271 => 91,  267 => 89,  263 => 88,  256 => 84,  250 => 81,  240 => 76,  236 => 75,  229 => 73,  224 => 70,  219 => 68,  214 => 67,  208 => 65,  206 => 64,  201 => 62,  195 => 59,  191 => 58,  181 => 55,  175 => 54,  171 => 53,  165 => 49,  163 => 48,  156 => 43,  149 => 39,  142 => 35,  138 => 33,  136 => 32,  132 => 31,  128 => 29,  125 => 28,  119 => 140,  94 => 118,  85 => 113,  83 => 112,  75 => 108,  71 => 105,  67 => 103,  65 => 28,  62 => 27,  60 => 26,  56 => 24,  53 => 23,  41 => 15,  38 => 14,  11 => 12,);
    }
}
