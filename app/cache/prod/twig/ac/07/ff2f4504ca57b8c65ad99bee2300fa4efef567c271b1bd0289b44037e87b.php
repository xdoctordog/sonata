<?php

/* SonataPageBundle:BlockAdmin:block_core_action_edit.html.twig */
class __TwigTemplate_ac07ff2f4504ca57b8c65ad99bee2300fa4efef567c271b1bd0289b44037e87b extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataPageBundle:BlockAdmin:edit.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataPageBundle:BlockAdmin:edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        // line 15
        echo "
    <div>
        ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "settings", array()), "action", array()), 'label');
        echo " <br>
        ";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "settings", array()), "action", array()), 'widget', array("attr" => array("class" => "title")));
        echo "
        ";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "settings", array()), "action", array()), 'errors');
        echo "
    </div>

    <h2>";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_parameters", array(), "SonataPageBundle"), "html", null, true);
        echo "</h2>
    <table>
        ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "settings", array()), "parameters", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
            // line 25
            echo "
                <tr>
                    <td>";
            // line 27
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["parameter"], 'label');
            echo "</td>
                    <td>";
            // line 28
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["parameter"], 'widget', array("attr" => array("class" => "title")));
            echo " ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["parameter"], 'errors');
            echo "</td>
                </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "    </table>
";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:BlockAdmin:block_core_action_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 31,  74 => 28,  70 => 27,  66 => 25,  62 => 24,  57 => 22,  51 => 19,  47 => 18,  43 => 17,  39 => 15,  36 => 14,  11 => 12,);
    }
}
