<?php

/* FOSCommentBundle:Thread:commentable.html.twig */
class __TwigTemplate_2c64c9eb1e36d2da72f43d71ffad2df165e065dc63bcfb583aabb1213620fd74 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'fos_comment_form_fields' => array($this, 'block_fos_comment_form_fields'),
            'fos_comment_form_submit' => array($this, 'block_fos_comment_form_submit'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
<div class=\"fos_comment_commentable_form_holder\">
    <form class=\"fos_comment_commentable_form\" action=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_patch_thread_commentable", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "\" data-fos-comment-thread-id=\"";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "\" method=\"POST\">

        ";
        // line 15
        $this->displayBlock('fos_comment_form_fields', $context, $blocks);
        // line 23
        echo "
        <input type=\"hidden\" name=\"_method\" value=\"patch\" />

        <div class=\"fos_comment_submit\">
            ";
        // line 27
        $this->displayBlock('fos_comment_form_submit', $context, $blocks);
        // line 30
        echo "        </div>

    </form>
</div>
";
    }

    // line 15
    public function block_fos_comment_form_fields($context, array $blocks = array())
    {
        // line 16
        echo "            ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
        echo "

            ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "isCommentable", array()), 'errors');
        echo "
            ";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "isCommentable", array()), 'widget');
        echo "

            ";
        // line 21
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
        ";
    }

    // line 27
    public function block_fos_comment_form_submit($context, array $blocks = array())
    {
        // line 28
        echo "                <input type=\"submit\" value=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((((isset($context["isCommentable"]) ? $context["isCommentable"] : null)) ? ("fos_comment_thread_open") : ("fos_comment_thread_close")), array(), "FOSCommentBundle"), "html", null, true);
        echo "\" />
            ";
    }

    public function getTemplateName()
    {
        return "FOSCommentBundle:Thread:commentable.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 28,  74 => 27,  68 => 21,  63 => 19,  59 => 18,  53 => 16,  50 => 15,  42 => 30,  40 => 27,  34 => 23,  32 => 15,  25 => 13,  21 => 11,);
    }
}
