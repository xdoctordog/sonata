<?php

/* SonataDemoBundle:Demo:media.html.twig */
class __TwigTemplate_8fe524034009672d65c43c758a444384d47e384914d04fb15cd45c5008df1669 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "<h2>Form Media Type & SEO</h2>

<div>

    <p>
        The <code>form_media_type</code> allows to add a Media to an entity. The Media information will be stored in a dedicated media table. <br />

        <br />
        <strong>Example</strong> :
        Please enter a youtube url and press the \"Preview Video\" button. <br />

    </p>
    <form method=\"POST\">
        ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "media", array()), "binaryContent", array()), 'widget', array("attr" => array("class" => "span8")));
        echo "

        ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "

        <input type=\"submit\" class=\"btn\" value=\"Preview Video\"/>
    </form>
</div>

";
        // line 22
        if (((isset($context["media"]) ? $context["media"] : null) && $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "providerReference", array()))) {
            // line 23
            echo "    <h2>Preview : ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : null), "name", array()), "html", null, true);
            echo "</h2>

    ";
            // line 25
            echo $this->env->getExtension('sonata_media')->media((isset($context["media"]) ? $context["media"] : null), "reference", array());
            // line 26
            echo "
    <p>
        The <code>media</code> helper is used to render the video.
    </p>
";
        }
        // line 31
        echo "
<h2>One more thing</h2>
<p>
    This page also uses the <code>SonataSeoBundle</code> to inject specific headers information. This is done by reading
    the Media information

    <script src=\"https://gist.github.com/1900366.js?file=gistfile1.aw\"></script>
</p>

<h2>Usage</h2>

<h3>Controller</h3>

<script src=\"https://gist.github.com/1896425.js?file=gistfile1.aw\"></script>

<h3>Template</h3>

<script src=\"https://gist.github.com/1896431.js?file=gistfile1.twig\"></script>";
    }

    public function getTemplateName()
    {
        return "SonataDemoBundle:Demo:media.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 31,  58 => 26,  56 => 25,  50 => 23,  48 => 22,  39 => 16,  34 => 14,  19 => 1,);
    }
}
