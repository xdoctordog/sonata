<?php

/* MopaBootstrapBundle:Form:formflow_buttons.html.twig */
class __TwigTemplate_28390cb06da3b8c58d74712d35f9c71b022717df1897ce8f2f0c1188afb4504d extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 1
        $context["renderBackButton"] = twig_in_filter($this->getAttribute((isset($context["flow"]) ? $context["flow"] : null), "getCurrentStep", array(), "method"), range(($this->getAttribute((isset($context["flow"]) ? $context["flow"] : null), "getFirstStep", array(), "method") + 1), $this->getAttribute((isset($context["flow"]) ? $context["flow"] : null), "getLastStep", array(), "method")));
        // line 2
        echo "<div class=\"form-actions form-flow-actions\">
    ";
        // line 8
        echo "    <button type=\"submit\" class=\"btn btn-primary\">";
        // line 9
        if (($this->getAttribute((isset($context["flow"]) ? $context["flow"] : null), "getCurrentStep", array(), "method") < $this->getAttribute((isset($context["flow"]) ? $context["flow"] : null), "getMaxSteps", array(), "method"))) {
            // line 10
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("button.next", array(), "CraueFormFlowBundle"), "html", null, true);
        } else {
            // line 12
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("button.finish", array(), "CraueFormFlowBundle"), "html", null, true);
        }
        // line 14
        echo "</button>

    <button type=\"submit\" name=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["flow"]) ? $context["flow"] : null), "getFormTransitionKey", array(), "method"), "html", null, true);
        echo "\" value=\"back\" class=\"btn btn-primary";
        if ( !(isset($context["renderBackButton"]) ? $context["renderBackButton"] : null)) {
            echo " disabled";
        }
        echo "\" formnovalidate=\"formnovalidate\"";
        if ( !(isset($context["renderBackButton"]) ? $context["renderBackButton"] : null)) {
            echo " disabled=\"disabled\"";
        }
        echo ">";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("button.back", array(), "CraueFormFlowBundle"), "html", null, true);
        // line 18
        echo "</button>

    <button type=\"submit\" name=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["flow"]) ? $context["flow"] : null), "getFormTransitionKey", array(), "method"), "html", null, true);
        echo "\" value=\"reset\" class=\"btn btn-primary\" formnovalidate=\"formnovalidate\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("button.reset", array(), "CraueFormFlowBundle"), "html", null, true);
        // line 22
        echo "</button>
</div>
";
    }

    public function getTemplateName()
    {
        return "MopaBootstrapBundle:Form:formflow_buttons.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 22,  58 => 21,  55 => 20,  51 => 18,  49 => 17,  38 => 16,  34 => 14,  31 => 12,  28 => 10,  26 => 9,  24 => 8,  21 => 2,  19 => 1,);
    }
}
