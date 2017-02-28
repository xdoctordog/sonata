<?php

/* SonataProductBundle:ProductAdmin:select_provider.html.twig */
class __TwigTemplate_58c7fa76abd3044ae4a90b0bbe01cc5fbc655ac7ec7cc5eaa9544ad36df3e0b7 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo $this->env->getExtension('translator')->getTranslator()->trans("title_select_provider", array(), "SonataPageBundle");
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "    <ul>
        ";
        // line 18
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["providers"]) ? $context["providers"] : null));
        foreach ($context['_seq'] as $context["code"] => $context["provider"]) {
            // line 19
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "create", 1 => array("provider" => $context["code"])), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["code"], "html", null, true);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['code'], $context['provider'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:ProductAdmin:select_provider.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 21,  53 => 19,  49 => 18,  46 => 17,  43 => 16,  37 => 14,  11 => 12,);
    }
}
