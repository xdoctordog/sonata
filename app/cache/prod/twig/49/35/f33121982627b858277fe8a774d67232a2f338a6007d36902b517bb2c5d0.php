<?php

/* FOSCommentBundle:Thread:comments.html.twig */
class __TwigTemplate_4935f33121982627b858277fe8a774d67232a2f338a6007d36902b517bb2c5d0 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "
";
        // line 12
        $context["depth"] = ((array_key_exists("depth", $context)) ? (_twig_default_filter((isset($context["depth"]) ? $context["depth"] : null), 0)) : (0));
        // line 13
        $context["view"] = ((array_key_exists("view", $context)) ? (_twig_default_filter((isset($context["view"]) ? $context["view"] : null), "tree")) : ("tree"));
        // line 14
        echo "
";
        // line 15
        if (((isset($context["depth"]) ? $context["depth"] : null) == 0)) {
            // line 16
            echo "    ";
            if ($this->env->getExtension('fos_comment')->canCommentThread((isset($context["thread"]) ? $context["thread"] : null))) {
                // line 17
                echo "        ";
                echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('routing')->getUrl("fos_comment_new_thread_comments", array("id" => $this->getAttribute((isset($context["thread"]) ? $context["thread"] : null), "id", array()))), array());
                // line 18
                echo "    ";
            }
            // line 19
            echo "
    ";
            // line 20
            if ($this->env->getExtension('fos_comment')->canEditThread((isset($context["thread"]) ? $context["thread"] : null))) {
                // line 21
                echo "        <div class=\"fos_comment_thread_commentable\">
            <button data-url=\"";
                // line 22
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_edit_thread_commentable", array("id" => $this->getAttribute((isset($context["thread"]) ? $context["thread"] : null), "id", array()), "value" =>  !$this->getAttribute((isset($context["thread"]) ? $context["thread"] : null), "commentable", array()))), "html", null, true);
                echo "\" class=\"fos_comment_thread_commentable_action\">
                ";
                // line 23
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((($this->getAttribute((isset($context["thread"]) ? $context["thread"] : null), "commentable", array())) ? ("fos_comment_thread_close") : ("fos_comment_thread_open")), array(), "FOSCommentBundle"), "html", null, true);
                echo "
            </button>
        </div>
    ";
            }
            // line 27
            echo "
    ";
            // line 28
            $context["count"] = $this->getAttribute((isset($context["thread"]) ? $context["thread"] : null), "numComments", array());
            // line 29
            echo "    <h3 class=\"panel-title\">";
            echo $this->env->getExtension('translator')->getTranslator()->transChoice("fos_comment_thread_comment_count", (isset($context["count"]) ? $context["count"] : null), array("%count%" => (isset($context["count"]) ? $context["count"] : null)), "FOSCommentBundle");
            echo "</h3>
";
        }
        // line 31
        echo "
";
        // line 32
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["comments"]) ? $context["comments"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["commentinfo"]) {
            // line 33
            echo "    ";
            if ( !$this->getAttribute($this->getAttribute($context["commentinfo"], "comment", array()), "private", array())) {
                // line 34
                echo "        ";
                $this->env->loadTemplate("FOSCommentBundle:Thread:comment.html.twig")->display(array_merge($context, array("children" => $this->getAttribute($context["commentinfo"], "children", array()), "comment" => $this->getAttribute($context["commentinfo"], "comment", array()), "depth" => (isset($context["depth"]) ? $context["depth"] : null), "view" => (isset($context["view"]) ? $context["view"] : null))));
                // line 35
                echo "    ";
            }
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['commentinfo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "FOSCommentBundle:Thread:comments.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 35,  93 => 34,  90 => 33,  73 => 32,  70 => 31,  64 => 29,  62 => 28,  59 => 27,  52 => 23,  48 => 22,  45 => 21,  43 => 20,  40 => 19,  37 => 18,  34 => 17,  31 => 16,  29 => 15,  26 => 14,  24 => 13,  22 => 12,  19 => 11,);
    }
}
