<?php

/* SonataPageBundle:PageAdmin:select_site.html.twig */
class __TwigTemplate_2c42aaaa5802be4c182c24715a904c52f96e19c492f481e11f8864dc436655f7 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
            'actions' => array($this, 'block_actions'),
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
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_select_site", array(), "SonataPageBundle"), "html", null, true);
    }

    // line 16
    public function block_actions($context, array $blocks = array())
    {
        // line 17
        echo "
";
    }

    // line 20
    public function block_content($context, array $blocks = array())
    {
        // line 21
        echo "
    <h2>";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_message_create_page", array(), "SonataPageBundle"), "html", null, true);
        echo "</h2>

    <p>
    ";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_create_page", array(), "SonataPageBundle"), "html", null, true);
        echo "
    </p>

    <ul>
        ";
        // line 29
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sites"]) ? $context["sites"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["site"]) {
            // line 30
            echo "            <li>
                ";
            // line 31
            if (((isset($context["current"]) ? $context["current"] : null) && ($this->getAttribute($context["site"], "id", array()) == $this->getAttribute((isset($context["current"]) ? $context["current"] : null), "id", array())))) {
                // line 32
                echo "                    <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/famfamfam/accept.png"), "html", null, true);
                echo "\">
                ";
            }
            // line 34
            echo "
                <a href=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "create", 1 => array("siteId" => $this->getAttribute($context["site"], "id", array()), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uniqid", array()))), "method"), "html", null, true);
            echo "\">

                ";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($context["site"], "name", array()), "html", null, true);
            echo "
                </a>
                - ";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute($context["site"], "url", array()), "html", null, true);
            echo "
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['site'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:PageAdmin:select_site.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 42,  99 => 39,  94 => 37,  89 => 35,  86 => 34,  80 => 32,  78 => 31,  75 => 30,  71 => 29,  64 => 25,  58 => 22,  55 => 21,  52 => 20,  47 => 17,  44 => 16,  38 => 14,  11 => 12,);
    }
}
