<?php

/* SonataQABundle:Serializer:serialize.html.twig */
class __TwigTemplate_a019ec1bc076083fc4ab575d304f98e1c123233931296ebfa0f6ee8ddeb1918d extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "<h1>Serialize test page</h1>

<form action=\"";
        // line 3
        echo $this->env->getExtension('routing')->getUrl("sonata_qa_serialize");
        echo "\" method=\"post\">
    <p class=\"well\">
        <label for=\"class\">Class:</label>
        <select name=\"class\">
            ";
        // line 7
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["classes"]) ? $context["classes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
            // line 8
            echo "                <option value=\"";
            echo twig_escape_filter($this->env, $context["class"], "html", null, true);
            echo "\" ";
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "class"), "method") == $context["class"])) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["class"], "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "        </select>

        <label for=\"id\">Id.:</label>
        <input type=\"text\" name=\"id\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "id"), "method"), "html", null, true);
        echo "\" placeholder=\"optional\" size=\"3\">

        <label for=\"group\">Group:</label>
        <input type=\"text\" name=\"group\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "group"), "method"), "html", null, true);
        echo "\" placeholder=\"optional\" size=\"5\">

        <label for=\"version\">Version:</label>
        <input type=\"text\" name=\"version\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "version"), "method"), "html", null, true);
        echo "\" placeholder=\"optional\" size=\"5\">

        <input type=\"submit\" value=\"Serialize\" class=\"btn btn-primary pull-right\">
    </p>
</form>

<ul class=\"nav nav-pills\" style=\"margin-bottom: 15px;\">
    <li class=\"active\"><a href=\"#xml\">XML</a></li>
    <li><a href=\"#json\">Json</a></li>
</ul>

<div class=\"tab-content\">
    <div class=\"tab-pane active\" id=\"xml\">
        <pre>";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["raw"]) ? $context["raw"] : null), "xml", array(), "array"), "html", null, true);
        echo "</pre>
    </div>
    <div class=\"tab-pane\" id=\"json\">
        <pre>";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["raw"]) ? $context["raw"] : null), "json", array(), "array"), "html", null, true);
        echo "</pre>
    </div>
</div>

<script type=\"text/javascript\">
    \$('.nav-pills a').click(function (e) {
        e.preventDefault()
        \$(this).tab('show')
    })
</script>
";
    }

    public function getTemplateName()
    {
        return "SonataQABundle:Serializer:serialize.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 35,  82 => 32,  66 => 19,  60 => 16,  54 => 13,  49 => 10,  34 => 8,  30 => 7,  23 => 3,  19 => 1,);
    }
}
