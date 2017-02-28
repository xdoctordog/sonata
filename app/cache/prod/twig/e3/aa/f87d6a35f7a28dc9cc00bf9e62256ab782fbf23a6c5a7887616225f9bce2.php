<?php

/* SonataPageBundle:BlockAdmin:select_type.html.twig */
class __TwigTemplate_e3aaf87d6a35f7a28dc9cc00bf9e62256ab782fbf23a6c5a7887616225f9bce2 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_select_block_type", array(), "SonataPageBundle"), "html", null, true);
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "    <div class=\"box box-success\">
        <div class=\"box-header\">
            <h3 class=\"box-title\">
                ";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_select_block_type", array(), "SonataPageBundle"), "html", null, true);
        echo "
            </h3>
        </div>
        <div class=\"box-body\">
            ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["services"]) ? $context["services"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["code"] => $context["service"]) {
            // line 25
            echo "                <div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6\">
                    <a  href=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "create", 1 => array("type" => $context["code"])), "method"), "html", null, true);
            echo "\"
                        class=\"btn btn-app btn-block\"
                        data-toggle=\"tooltip\"
                        data-placement=\"top\"
                        title=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array()), "description", array()), array(), (($this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array(), "any", false, true), "domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array(), "any", false, true), "domain", array()), "SonataPageBundle")) : ("SonataPageBundle"))), "html", null, true);
            echo "\"
                            >
                        ";
            // line 32
            if ( !$this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array()), "image", array())) {
                // line 33
                echo "                            <i class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array()), "option", array(0 => "class"), "method"), "html", null, true);
                echo "\" ></i>
                        ";
            } else {
                // line 35
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array()), "image", array())), "html", null, true);
                echo "\" style=\"max-height: 20px; max-width: 100px;\"/>
                            <br />
                        ";
            }
            // line 38
            echo "                        <span>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array()), "title", array()), array(), (($this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array(), "any", false, true), "domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["service"], "blockMetadata", array(), "any", false, true), "domain", array()), "SonataPageBundle")) : ("SonataPageBundle"))), "html", null, true);
            echo "</span>
                    </a>
                </div>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 42
            echo "                <span class=\"alert alert-info\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_type_available", array(), "SonataPageBundle"), "html", null, true);
            echo "</span>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['code'], $context['service'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "
            <div class=\"clearfix\"></div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:BlockAdmin:select_type.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 44,  103 => 42,  93 => 38,  86 => 35,  80 => 33,  78 => 32,  73 => 30,  66 => 26,  63 => 25,  58 => 24,  51 => 20,  46 => 17,  43 => 16,  37 => 14,  11 => 12,);
    }
}
