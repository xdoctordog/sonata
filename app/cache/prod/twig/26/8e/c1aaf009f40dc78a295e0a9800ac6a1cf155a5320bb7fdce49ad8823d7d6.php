<?php

/* SonataNewsBundle:Post:view.html.twig */
class __TwigTemplate_268ec1aaf009f40dc78a295e0a9800ac6a1cf155a5320bb7fdce49ad8823d7d6 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_page_breadcrumb' => array($this, 'block_sonata_page_breadcrumb'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 13
        echo "
";
        // line 14
        // token for sonata_template_box, however the box is disabled
        // line 15
        echo "
";
        // line 16
        $this->displayBlock('sonata_page_breadcrumb', $context, $blocks);
        // line 21
        echo "
<article class=\"sonata-blog-post-container\">
    <header>
        <div class=\"sonata-blog-post-date-container\">
            <h5>
                <i class=\"icon-calendar\"></i>
                ";
        // line 27
        echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "publicationDateStart", array()));
        echo "
            </h5>
        </div>

        <h1 class=\"sonata-blog-post-title\">
            <a href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_view", array("permalink" => $this->env->getExtension('sonata_news')->generatePermalink((isset($context["post"]) ? $context["post"] : null)))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "title", array()), "html", null, true);
        echo "</a>
            <span class=\"sonata-blog-post-author\">";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("archive_author", array("%author%" => $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "author", array())), "SonataNewsBundle"), "html", null, true);
        echo "</span>
        </h1>

        <div class=\"sonata-blog-post-information\">
            <div class=\"sonata-blog-post-tag-container\">
                <div class=\"sonata-blog-post-tag-title\">
                    ";
        // line 39
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "tags", array())) > 1)) {
            // line 40
            echo "                        <i class=\"icon-tags\"></i>
                    ";
        } else {
            // line 42
            echo "                        <i class=\"icon-tag\"></i>
                    ";
        }
        // line 44
        echo "                    ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->transchoice("published_under", twig_length_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "tags", array())), array(), "SonataNewsBundle"), "html", null, true);
        echo "
                </div>
                <div class=\"sonata-blog-post-tag-list\">
                    ";
        // line 47
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "tags", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 48
            echo "                        <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_tag", array("tag" => $this->getAttribute($context["tag"], "slug", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "name", array()), "html", null, true);
            echo "</a>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "                </div>
            </div>
        </div>
    </header>

    <div class=\"sonata-blog-post-content\">
        ";
        // line 56
        echo $this->env->getExtension('sonata_media')->media($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "image", array()), "wide", array());
        // line 57
        echo "        ";
        echo $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "content", array());
        echo "
    </div>

    ";
        // line 60
        echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('sonata_page')->controller("SonataNewsBundle:Post:comments", array("postId" => $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "id", array()))), array());
        // line 61
        echo "
    ";
        // line 62
        if ($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "iscommentable", array())) {
            // line 63
            echo "        ";
            echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('sonata_page')->controller("SonataNewsBundle:Post:addCommentForm", array("postId" => $this->getAttribute(            // line 64
(isset($context["post"]) ? $context["post"] : null), "id", array()), "form" =>             // line 65
(isset($context["form"]) ? $context["form"] : null))), array());
            // line 67
            echo "    ";
        } else {
            // line 68
            echo "        <div>
            ";
            // line 69
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_comments_are_closed", array(), "SonataNewsBundle"), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 72
        echo "</article>
";
    }

    // line 16
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
        // line 17
        echo "    <div class=\"row-fluid clearfix\">
        ";
        // line 18
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => "news_post", "post" => (isset($context["post"]) ? $context["post"] : null), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "requestUri", array()))));
        echo "
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataNewsBundle:Post:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 18,  142 => 17,  139 => 16,  134 => 72,  128 => 69,  125 => 68,  122 => 67,  120 => 65,  119 => 64,  117 => 63,  115 => 62,  112 => 61,  110 => 60,  103 => 57,  101 => 56,  93 => 50,  82 => 48,  78 => 47,  71 => 44,  67 => 42,  63 => 40,  61 => 39,  52 => 33,  46 => 32,  38 => 27,  30 => 21,  28 => 16,  25 => 15,  23 => 14,  20 => 13,);
    }
}
