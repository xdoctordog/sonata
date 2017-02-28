<?php

/* SonataPageBundle:SnapshotAdmin:create.html.twig */
class __TwigTemplate_7f46db5b90e806998a015b0c7389098b1ed29d89407c0b6aee1857534799567c extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_create_snapshot", array(), "SonataPageBundle"), "html", null, true);
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "
    ";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_create_snapshot", array(), "SonataPageBundle"), "html", null, true);
        echo "

    <form action=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "create"), "method"), "html", null, true);
        echo "\" method=\"POST\">

        ";
        // line 22
        if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "isChild", array(), "method")) {
            // line 23
            echo "            <div style=\"display:none\">";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
            echo "</div>
        ";
        } else {
            // line 25
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
            echo "
        ";
        }
        // line 27
        echo "
        <div class=\"well well-small form-actions\">
            <input class=\"btn btn-primary\" type=\"submit\" name=\"create\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("button_create_snapshot", array(), "SonataPageBundle"), "html", null, true);
        echo "\">
            ";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("or_list", array(), "SonataPageBundle"), "html", null, true);
        echo "

            <a class=\"btn\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "list"), "method"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_list", array(), "SonataAdminBundle"), "html", null, true);
        echo "</a>
        </div>
    </form>
";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:SnapshotAdmin:create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 32,  81 => 30,  77 => 29,  73 => 27,  67 => 25,  61 => 23,  59 => 22,  54 => 20,  49 => 18,  46 => 17,  43 => 16,  37 => 14,  11 => 12,);
    }
}
