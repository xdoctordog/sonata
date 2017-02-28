<?php

/* SonataNewsBundle:Post:archive.rss.twig */
class __TwigTemplate_1f1e39333d5106ad6e10828117bae15be926e96c13cf3988cf45e059351f8420 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 11
        echo "<?xml version=\"1.0\" ?>
<rss version=\"2.0\">
    <channel>
        <title>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["blog"]) ? $context["blog"] : null), "title", array()), "html", null, true);
        if ((isset($context["tag"]) ? $context["tag"] : null)) {
            echo " : ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tag"]) ? $context["tag"] : null), "name", array()), "html", null, true);
        }
        echo "</title>
        <link>";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["blog"]) ? $context["blog"] : null), "link", array()), "html", null, true);
        echo "</link>
        <description>";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["blog"]) ? $context["blog"] : null), "description", array()), "html", null, true);
        echo "</description>
        ";
        // line 17
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "getResults", array(), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 18
            echo "             <item>
                  <title>";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
            echo "</title>
                  <link>";
            // line 20
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_view", array("permalink" => $this->env->getExtension('sonata_news')->generatePermalink($context["post"])), true), "html", null, true);
            echo "</link>
                  <description><![CDATA[ ";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "abstract", array()), "html", null, true);
            echo " ]]></description>
                  <pubDate>";
            // line 22
            echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute($context["post"], "publicationDateStart", array()), "eee, MM LLL yyyy HH:mm:ss ZZZ", "en");
            echo "</pubDate>
                  <guid>";
            // line 23
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_view", array("permalink" => $this->env->getExtension('sonata_news')->generatePermalink($context["post"])), true), "html", null, true);
            echo "</guid>
             </item>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "    </channel>
</rss>
";
    }

    public function getTemplateName()
    {
        return "SonataNewsBundle:Post:archive.rss.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 26,  63 => 23,  59 => 22,  55 => 21,  51 => 20,  47 => 19,  44 => 18,  40 => 17,  36 => 16,  32 => 15,  24 => 14,  19 => 11,);
    }
}
