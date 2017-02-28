<?php

/* SonataPageBundle::2columns_layout.html.twig */
class __TwigTemplate_eff3b1f4b3a800a2884573e5ccffd8fe928a9b41c372fd26adc171f3294c9bda extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        try {
            $this->parent = $this->env->loadTemplate("SonataPageBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(11);

            throw $e;
        }

        $this->blocks = array(
            'page_content' => array($this, 'block_page_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataPageBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_page_content($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        if (array_key_exists("page", $context)) {
            // line 15
            echo "        <div class=\"span6\">
            ";
            // line 16
            if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "name", array()) != "global")) {
                // line 17
                echo "                ";
                echo $this->env->getExtension('sonata_page')->renderContainer("left_col", "global");
                echo "
            ";
            }
            // line 19
            echo "            ";
            echo $this->env->getExtension('sonata_page')->renderContainer("left_col", (isset($context["page"]) ? $context["page"] : null));
            echo "
        </div>
        <div class=\"span6\">
            ";
            // line 22
            if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "name", array()) != "global")) {
                // line 23
                echo "                ";
                echo $this->env->getExtension('sonata_page')->renderContainer("right_col", "global");
                echo "
            ";
            }
            // line 25
            echo "            ";
            echo $this->env->getExtension('sonata_page')->renderContainer("right_col", (isset($context["page"]) ? $context["page"] : null));
            echo "
        </div>
        <div style=\"clear: both\"></div>
    ";
        }
        // line 29
        echo "
    ";
        // line 30
        $this->displayParentBlock("page_content", $context, $blocks);
        echo "

";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle::2columns_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 30,  76 => 29,  68 => 25,  62 => 23,  60 => 22,  53 => 19,  47 => 17,  45 => 16,  42 => 15,  39 => 14,  36 => 13,  11 => 11,);
    }
}
