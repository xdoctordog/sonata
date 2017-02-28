<?php

/* SonataPageBundle:SiteAdmin:create_snapshots.html.twig */
class __TwigTemplate_088f3b3b4029cc56369e7f8d4a2a559bbd58f35d26aaaf576a7310f64cf7b9de extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_create_snapshots", array(), "SonataPageBundle"), "html", null, true);
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "
    ";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_create_snapshots", array("%site%" => $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "name", array())), "SonataPageBundle"), "html", null, true);
        echo "

    <div class=\"well well-small form-actions\">
        <form action=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "snapshots", 1 => array("id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "id", array()))), "method"), "html", null, true);
        echo "\" method=\"POST\">

            <input class=\"btn btn-primary\" type=\"submit\" name=\"create\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("button_create_snapshots", array(), "SonataPageBundle"), "html", null, true);
        echo "\">

            ";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("or_list", array(), "SonataPageBundle"), "html", null, true);
        echo "

            <a class=\"btn\" href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "list"), "method"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_list", array(), "SonataAdminBundle"), "html", null, true);
        echo "</a>
        </form>
    </div>

";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:SiteAdmin:create_snapshots.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 27,  65 => 25,  60 => 23,  55 => 21,  49 => 18,  46 => 17,  43 => 16,  37 => 14,  11 => 12,);
    }
}
