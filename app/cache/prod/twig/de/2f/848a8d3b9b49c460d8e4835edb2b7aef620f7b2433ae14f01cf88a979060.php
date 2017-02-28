<?php

/* SonataNewsBundle:Post:archive.html.twig */
class __TwigTemplate_de2f848a8d3b9b49c460d8e4835edb2b7aef620f7b2433ae14f01cf88a979060 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
<h1>";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_archive", array(), "SonataNewsBundle"), "html", null, true);
        echo "</h1>

<div class=\"sonata-blog-post-list\">
    ";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "getResults", array(), "method"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 26
            echo "        <div class=\"sonata-blog-post-container\">
            <header>
                <h2 class=\"sonata-blog-post-title\">
                    <a href=\"";
            // line 29
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_view", array("permalink" => $this->env->getExtension('sonata_news')->generatePermalink($context["post"]))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
            echo "</a>
                </h2>

                <div class=\"sonata-blog-post-information\">
                    <span class=\"sonata-blog-post-author\">";
            // line 33
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("archive_author", array("%author%" => $this->getAttribute($context["post"], "author", array())), "SonataNewsBundle"), "html", null, true);
            echo "</span> |

                    <i class=\"icon-calendar\"></i>
                    ";
            // line 36
            echo $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute($context["post"], "publicationDateStart", array()));
            echo " |

                    <i class=\"icon-comment\"></i>
                    <span class=\"sonata-blog-post-comments-count\">";
            // line 39
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("comments_count", array("%comments_count%" => $this->getAttribute($context["post"], "commentsCount", array())), "SonataNewsBundle"), "html", null, true);
            echo "</span>

                    <div class=\"sonata-blog-post-tags\">
                        ";
            // line 42
            if ((twig_length_filter($this->env, $this->getAttribute($context["post"], "tags", array())) > 1)) {
                // line 43
                echo "                            <i class=\"icon-tags\"></i>
                        ";
            } else {
                // line 45
                echo "                            <i class=\"icon-tag\"></i>
                        ";
            }
            // line 47
            echo "                        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->transchoice("published_under", twig_length_filter($this->env, $this->getAttribute($context["post"], "tags", array())), array(), "SonataNewsBundle"), "html", null, true);
            echo "

                        ";
            // line 49
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["post"], "tags", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 50
                echo "                            <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_news_tag", array("tag" => $this->getAttribute($context["tag"], "slug", array()))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "name", array()), "html", null, true);
                echo "</a>";
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ",";
                }
                // line 51
                echo "                        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "                    </div>
                </div>
            </header>

            <div class=\"sonata-blog-post-abtract\">
                ";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "abstract", array()), "html", null, true);
            echo "
            </div>
        </div>

        <hr />
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 63
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_post_found", array(), "SonataNewsBundle"), "html", null, true);
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "
    <ul class=\"pager\">
        <li";
        // line 67
        if (($this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "page", array()) == $this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "lastPage", array()))) {
            echo " class=\"disabled\"";
        }
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl((isset($context["route"]) ? $context["route"] : null), twig_array_merge((isset($context["route_parameters"]) ? $context["route_parameters"] : null), array("page" => $this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "nextpage", array())))), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_previous_page", array(), "SonataNewsBundle"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_previous_page", array(), "SonataNewsBundle"), "html", null, true);
        echo "</a>
        <li";
        // line 68
        if (($this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "page", array()) == $this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "firstPage", array()))) {
            echo " class=\"disabled\"";
        }
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl((isset($context["route"]) ? $context["route"] : null), twig_array_merge((isset($context["route_parameters"]) ? $context["route_parameters"] : null), array("page" => $this->getAttribute((isset($context["pager"]) ? $context["pager"] : null), "previouspage", array())))), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_next_page", array(), "SonataNewsBundle"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_next_page", array(), "SonataNewsBundle"), "html", null, true);
        echo "</a></li>
    </ul>
</div>
";
    }

    // line 16
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
        // line 17
        echo "    <div class=\"row-fluid clearfix\">
        ";
        // line 18
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => "news_archive", "collection" => (isset($context["collection"]) ? $context["collection"] : null), "tag" => (isset($context["tag"]) ? $context["tag"] : null), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "requestUri", array()))));
        echo "
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataNewsBundle:Post:archive.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 18,  194 => 17,  191 => 16,  175 => 68,  163 => 67,  159 => 65,  150 => 63,  139 => 57,  132 => 52,  118 => 51,  109 => 50,  92 => 49,  86 => 47,  82 => 45,  78 => 43,  76 => 42,  70 => 39,  64 => 36,  58 => 33,  49 => 29,  44 => 26,  39 => 25,  33 => 22,  30 => 21,  28 => 16,  25 => 15,  23 => 14,  20 => 13,);
    }
}
