<?php

/* SonataPaymentBundle:Payment:scellius.html.twig */
class __TwigTemplate_2c49a7c7419fcd6fe1512d35f43d479adc58de3ad0029866bfe4233e16c9369b extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        <h1>";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["order"]) ? $context["order"] : null), "reference", array()), "html", null, true);
        echo "</h1>

        <div>
            ";
        // line 13
        if ($this->getAttribute((isset($context["scellius"]) ? $context["scellius"] : null), "valid", array())) {
            // line 14
            echo "                ";
            echo $this->getAttribute((isset($context["scellius"]) ? $context["scellius"] : null), "content", array());
            echo "
            ";
        }
        // line 16
        echo "        </div>

        ";
        // line 18
        if ((isset($context["debug"]) ? $context["debug"] : null)) {
            // line 19
            echo "            <h2>Only visible on debug</h2>
            <h3>Command line parameters</h3>
            <table>
                ";
            // line 22
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["parameters"]) ? $context["parameters"] : null));
            foreach ($context['_seq'] as $context["name"] => $context["value"]) {
                // line 23
                echo "                    <tr>
                        <td>";
                // line 24
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "</td><td> ";
                echo twig_escape_filter($this->env, $context["value"], "html", null, true);
                echo "</td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "            </table>
            ";
            // line 28
            if ( !$this->getAttribute((isset($context["scellius"]) ? $context["scellius"] : null), "valid", array())) {
                // line 29
                echo "                <h3>Error Message</h3>
                <div>
                    ";
                // line 31
                echo $this->getAttribute((isset($context["scellius"]) ? $context["scellius"] : null), "content", array());
                echo "
                </div>
            ";
            }
            // line 34
            echo "        ";
        }
        // line 35
        echo "
    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "SonataPaymentBundle:Payment:scellius.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 6,  108 => 5,  101 => 35,  98 => 34,  92 => 31,  88 => 29,  86 => 28,  83 => 27,  72 => 24,  69 => 23,  65 => 22,  60 => 19,  58 => 18,  54 => 16,  48 => 14,  46 => 13,  40 => 10,  33 => 7,  31 => 6,  27 => 5,  21 => 1,);
    }
}
