<?php

/* SonataPageBundle:Page:redirect.html.twig */
class __TwigTemplate_43ad33ee674ba6588ad23ed2f215b86aee5404d16c2e0a756f68c4a2d4b50276 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 11
        return $this->env->resolveTemplate($this->getAttribute((isset($context["sonata_page"]) ? $context["sonata_page"] : null), "defaultTemplate", array()));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_page_redirected", array(), "SonataPageBundle"), "html", null, true);
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "    <div>
        <h2>";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_page_redirected", array(), "SonataPageBundle"), "html", null, true);
        echo "</h2>

        <p>
            ";
        // line 20
        echo $this->env->getExtension('translator')->trans("message_page_redirected", array("%url%" => $this->getAttribute($this->getAttribute((isset($context["response"]) ? $context["response"] : null), "headers", array()), "get", array(0 => "Location"), "method")), "SonataPageBundle");
        echo "
        </p>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:Page:redirect.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 20,  40 => 17,  37 => 16,  34 => 15,  28 => 13,  19 => 11,);
    }
}
