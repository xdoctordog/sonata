<?php

/* SonataNewsBundle:Block:recent_posts.html.twig */
class __TwigTemplate_27132b3df6a4174956e3ebc3f767bf178304d61d2493a04aacbd989d20863862 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 11
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : null), "templates", array()), "block_base", array()));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        // line 14
        echo "    <div class=\"sonata-news-block-recent-post panel panel-default\">
        ";
        // line 15
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array())) {
            // line 16
            echo "            <div class=\"panel-heading\">
                <h3 class=\"sonata-news-block-recent-post panel-title\"><i class=\"fa fa-pencil\"></i> ";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array()), "html", null, true);
            echo "</h3>
            </div>
        ";
        }
        // line 20
        echo "
        <div class=\"panel-body\">
            ";
        // line 22
        // token for sonata_template_box, however the box is disabled
        // line 23
        echo "
            <div class=\"sonata-blog-post-container list-group\">
                ";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "getResults", array(), "method"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 26
            echo "                    ";
            if (($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "getSetting", array(0 => "mode"), "method") == "admin")) {
                // line 27
                echo "                        <a class=\"list-group-item\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_sonata_news_post_edit", array("id" => $this->getAttribute($context["post"], "id", array()))), "html", null, true);
                echo "\">
                            ";
                // line 28
                if ($this->getAttribute($context["post"], "ispublic", array())) {
                    // line 29
                    echo "                                <span class=\"label label-success\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("post_is_public", array(), "SonataNewsBundle"), "html", null, true);
                    echo "</span>
                            ";
                } else {
                    // line 31
                    echo "                                <span class=\"label\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("post_is_not_public", array(), "SonataNewsBundle"), "html", null, true);
                    echo "</span>
                            ";
                }
                // line 32
                echo "&nbsp;

                            ";
                // line 34
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("archive_author", array("%author%" => $this->getAttribute($context["post"], "author", array())), "SonataNewsBundle"), "html", null, true);
                echo " - ";
                echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute($context["post"], "publicationDateStart", array()));
                echo "</a>
                    ";
            } else {
                // line 36
                echo "                        <a class=\"list-group-item\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_view", array("permalink" => $this->env->getExtension('sonata_news')->generatePermalink($context["post"]))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
                echo "</a> - ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("archive_author", array("%author%" => $this->getAttribute($context["post"], "author", array())), "SonataNewsBundle"), "html", null, true);
                echo " - ";
                echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute($context["post"], "publicationDateStart", array()));
                echo "
                    ";
            }
            // line 38
            echo "                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 39
            echo "                    <a class=\"list-group-item\" href=\"#\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_post_found", array(), "SonataNewsBundle"), "html", null, true);
            echo "</a>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "            </div>

            ";
        // line 43
        if (($this->getAttribute((isset($context["context"]) ? $context["context"] : null), "getSetting", array(0 => "mode"), "method") == "admin")) {
            // line 44
            echo "                <a href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_sonata_news_post_list");
            echo "\" class=\"btn btn-primary btn-block\"><i class=\"fa fa-list\"></i> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("view_all_posts", array(), "SonataNewsBundle"), "html", null, true);
            echo "</a>
            ";
        } else {
            // line 46
            echo "                <a href=\"";
            echo $this->env->getExtension('routing')->getUrl("sonata_news_archive");
            echo "\" class=\"btn btn-primary btn-block\"><i class=\"fa fa-list\"></i> ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("view_all_posts", array(), "SonataNewsBundle"), "html", null, true);
            echo "</a>
            ";
        }
        // line 48
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataNewsBundle:Block:recent_posts.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 48,  134 => 46,  126 => 44,  124 => 43,  120 => 41,  111 => 39,  106 => 38,  94 => 36,  85 => 34,  81 => 32,  75 => 31,  69 => 29,  67 => 28,  62 => 27,  59 => 26,  54 => 25,  50 => 23,  48 => 22,  44 => 20,  38 => 17,  35 => 16,  33 => 15,  30 => 14,  27 => 13,  18 => 11,);
    }
}
