<?php

/* SonataNewsBundle:Post:comment_form.html.twig */
class __TwigTemplate_72827bb4922ac7459f929209d6f3db6e63ef2aefbf961a9e17f17646a9817695 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 13
        echo "
<div class=\"panel panel-default\">
    <div class=\"panel-heading\">
        <h3>";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_leave_comment", array(), "SonataNewsBundle"), "html", null, true);
        echo "</h3>
    </div>
    <div class=\"panel-body\">
        <form action=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_add_comment", array("id" => (isset($context["post_id"]) ? $context["post_id"] : null))), "html", null, true);
        echo "\" method=\"POST\" class=\"form-horizontal\" role=\"form\">
            ";
        // line 20
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
        echo "
            <div class=\"form-actions\">
                <button type=\"submit\" class=\"btn btn-primary\"><i class=\"glyphicon glyphicon-pencil\"></i>&nbsp;";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_add_comment", array(), "SonataNewsBundle"), "html", null, true);
        echo "</button>
            </div>
        </form>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "SonataNewsBundle:Post:comment_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 22,  34 => 20,  30 => 19,  24 => 16,  19 => 13,);
    }
}
