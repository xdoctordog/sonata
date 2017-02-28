<?php

/* SonataPaymentBundle:Payment:ogone.html.twig */
class __TwigTemplate_595468337647bad38987e7e820120c3f27bdab11b5586c3de2274e12dcc4d77d extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
        <link rel=\"shortcut icon\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        <div>
            <form method=\"post\" action=\"";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["form_url"]) ? $context["form_url"] : null), "html", null, true);
        echo "\" id=\"form1\" name=\"form1\">

            ";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["fields"]) ? $context["fields"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["param"]) {
            // line 13
            echo "                <input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, $context["param"], "html", null, true);
            echo "\">
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['param'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "
                <input type=\"hidden\" name=\"SHASign\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["shasign"]) ? $context["shasign"] : null), "html", null, true);
        echo "\">
            </form>
        </div>


        <script type=\"text/javascript\">
            var form = document.getElementById('form1');

            form.submit();
        </script>

    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "SonataPaymentBundle:Payment:ogone.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 5,  60 => 16,  57 => 15,  46 => 13,  42 => 12,  37 => 10,  30 => 6,  26 => 5,  20 => 1,);
    }
}
