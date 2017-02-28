<?php

/* SonataPageBundle::layout.html.twig */
class __TwigTemplate_d702cd14b5d9f45ad4b2e5ab5ae25cdc4c4a0c57ae064391ef61d3cb6411faf5 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        try {
            $this->parent = $this->env->loadTemplate("SonataPageBundle::base_layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(11);

            throw $e;
        }

        $this->blocks = array(
            'sonata_page_container' => array($this, 'block_sonata_page_container'),
            'sonata_page_breadcrumb' => array($this, 'block_sonata_page_breadcrumb'),
            'page_content' => array($this, 'block_page_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataPageBundle::base_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_sonata_page_container($context, array $blocks = array())
    {
        // line 14
        echo "    <div class=\"container\">
        <div class=\"content\">
            <div class=\"row page-header\">
                ";
        // line 17
        echo $this->env->getExtension('sonata_page')->renderContainer("header", "global");
        echo "
            </div>

            ";
        // line 20
        $this->displayBlock('sonata_page_breadcrumb', $context, $blocks);
        // line 28
        echo "
            ";
        // line 29
        if (array_key_exists("page", $context)) {
            // line 30
            echo "                <div class=\"row\">
                    ";
            // line 31
            if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "name", array()) != "global")) {
                // line 32
                echo "                        ";
                echo $this->env->getExtension('sonata_page')->renderContainer("content_top", "global");
                echo "
                    ";
            }
            // line 34
            echo "                    ";
            echo $this->env->getExtension('sonata_page')->renderContainer("content_top", (isset($context["page"]) ? $context["page"] : null));
            echo "
                </div>
            ";
        }
        // line 37
        echo "
            <div class=\"row\">
                ";
        // line 39
        $this->displayBlock('page_content', $context, $blocks);
        // line 51
        echo "            </div>

            ";
        // line 53
        if (array_key_exists("page", $context)) {
            // line 54
            echo "                <div class=\"row\">
                    ";
            // line 55
            echo $this->env->getExtension('sonata_page')->renderContainer("content_bottom", (isset($context["page"]) ? $context["page"] : null));
            echo "

                    ";
            // line 57
            if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "name", array()) != "global")) {
                // line 58
                echo "                        ";
                echo $this->env->getExtension('sonata_page')->renderContainer("content_bottom", "global");
                echo "
                    ";
            }
            // line 60
            echo "                </div>
            ";
        }
        // line 62
        echo "        </div>

        <footer class=\"row\">
            ";
        // line 65
        echo $this->env->getExtension('sonata_page')->renderContainer("footer", "global");
        echo "
        </footer>
    </div>
";
    }

    // line 20
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
        // line 21
        echo "                <div class=\"row\">
                    ";
        // line 22
        if ( !array_key_exists("sonata_seo_context", $context)) {
            // line 23
            echo "                        ";
            $context["sonata_seo_context"] = "homepage";
            // line 24
            echo "                    ";
        }
        // line 25
        echo "                    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => (isset($context["sonata_seo_context"]) ? $context["sonata_seo_context"] : null), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "requestUri", array()))));
        echo "
                </div>
            ";
    }

    // line 39
    public function block_page_content($context, array $blocks = array())
    {
        // line 40
        echo "                    ";
        if (array_key_exists("content", $context)) {
            // line 41
            echo "                        ";
            echo (isset($context["content"]) ? $context["content"] : null);
            echo "
                    ";
        } else {
            // line 43
            echo "                        ";
            $context["content"] = $this->renderBlock("content", $context, $blocks);
            // line 44
            echo "                        ";
            if ((twig_length_filter($this->env, (isset($context["content"]) ? $context["content"] : null)) > 0)) {
                // line 45
                echo "                            ";
                echo (isset($context["content"]) ? $context["content"] : null);
                echo "
                        ";
            } elseif (            // line 46
array_key_exists("page", $context)) {
                // line 47
                echo "                            ";
                echo $this->env->getExtension('sonata_page')->renderContainer("content", (isset($context["page"]) ? $context["page"] : null));
                echo "
                        ";
            }
            // line 49
            echo "                    ";
        }
        // line 50
        echo "                ";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 50,  175 => 49,  169 => 47,  167 => 46,  162 => 45,  159 => 44,  156 => 43,  150 => 41,  147 => 40,  144 => 39,  136 => 25,  133 => 24,  130 => 23,  128 => 22,  125 => 21,  122 => 20,  114 => 65,  109 => 62,  105 => 60,  99 => 58,  97 => 57,  92 => 55,  89 => 54,  87 => 53,  83 => 51,  81 => 39,  77 => 37,  70 => 34,  64 => 32,  62 => 31,  59 => 30,  57 => 29,  54 => 28,  52 => 20,  46 => 17,  41 => 14,  38 => 13,  11 => 11,);
    }
}
