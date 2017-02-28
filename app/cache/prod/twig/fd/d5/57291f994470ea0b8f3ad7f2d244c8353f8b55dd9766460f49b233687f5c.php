<?php

/* FOSCommentBundle:Thread:comment_content.html.twig */
class __TwigTemplate_fdd557291f994470ea0b8f3ad7f2d244c8353f8b55dd9766460f49b233687f5c extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'fos_comment_comment' => array($this, 'block_fos_comment_comment'),
            'fos_comment_comment_metas' => array($this, 'block_fos_comment_comment_metas'),
            'fos_comment_comment_metas_authorline' => array($this, 'block_fos_comment_comment_metas_authorline'),
            'fos_comment_comment_metas_edit' => array($this, 'block_fos_comment_comment_metas_edit'),
            'fos_comment_comment_metas_delete' => array($this, 'block_fos_comment_comment_metas_delete'),
            'fos_comment_comment_metas_voting' => array($this, 'block_fos_comment_comment_metas_voting'),
            'fos_comment_comment_body' => array($this, 'block_fos_comment_comment_body'),
            'fos_comment_comment_children' => array($this, 'block_fos_comment_comment_children'),
            'fos_comment_comment_reply' => array($this, 'block_fos_comment_comment_reply'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $this->displayBlock('fos_comment_comment', $context, $blocks);
    }

    public function block_fos_comment_comment($context, array $blocks = array())
    {
        // line 13
        echo "    <div id=\"fos_comment_";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "html", null, true);
        echo "\" class=\"panel-body fos_comment_comment_show fos_comment_comment_depth_";
        echo twig_escape_filter($this->env, (isset($context["depth"]) ? $context["depth"] : null), "html", null, true);
        echo "\" ";
        if ((array_key_exists("parent", $context) &&  !(null === (isset($context["parent"]) ? $context["parent"] : null)))) {
            echo "data-parent=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "id", array()), "html", null, true);
            echo "\"";
        }
        echo ">

        <div class=\"fos_comment_comment_metas\">
            ";
        // line 16
        $this->displayBlock('fos_comment_comment_metas', $context, $blocks);
        // line 56
        echo "        </div>

        <div id=\"fos_comment_comment_body_";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "html", null, true);
        echo "\" class=\"fos_comment_comment_body\">
            ";
        // line 59
        $this->displayBlock('fos_comment_comment_body', $context, $blocks);
        // line 74
        echo "        </div>

        ";
        // line 76
        $this->displayBlock('fos_comment_comment_children', $context, $blocks);
        // line 97
        echo "
    </div>
";
    }

    // line 16
    public function block_fos_comment_comment_metas($context, array $blocks = array())
    {
        // line 17
        echo "                ";
        $this->displayBlock('fos_comment_comment_metas_authorline', $context, $blocks);
        // line 27
        echo "
                ";
        // line 28
        $this->displayBlock('fos_comment_comment_metas_edit', $context, $blocks);
        // line 33
        echo "
                ";
        // line 34
        $this->displayBlock('fos_comment_comment_metas_delete', $context, $blocks);
        // line 45
        echo "
                ";
        // line 46
        $this->displayBlock('fos_comment_comment_metas_voting', $context, $blocks);
        // line 55
        echo "            ";
    }

    // line 17
    public function block_fos_comment_comment_metas_authorline($context, array $blocks = array())
    {
        // line 18
        echo "                    ";
        echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_show_by", array(), "FOSCommentBundle");
        // line 19
        echo "                    <span class=\"fos_comment_comment_authorname\">
                    ";
        // line 20
        if ($this->env->getExtension('fos_comment')->isCommentInState((isset($context["comment"]) ? $context["comment"] : null), twig_constant("FOS\\CommentBundle\\Model\\CommentInterface::STATE_DELETED"))) {
            // line 21
            echo "                        ";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_deleted", array(), "FOSCommentBundle");
            // line 22
            echo "                    ";
        } else {
            // line 23
            echo "                        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "authorName", array()), "html", null, true);
            echo "
                    ";
        }
        // line 25
        echo "                </span> - ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "createdAt", array())), "html", null, true);
        echo "
                ";
    }

    // line 28
    public function block_fos_comment_comment_metas_edit($context, array $blocks = array())
    {
        // line 29
        echo "                    ";
        if ($this->env->getExtension('fos_comment')->canEditComment((isset($context["comment"]) ? $context["comment"] : null))) {
            // line 30
            echo "                        <button data-container=\"#fos_comment_comment_body_";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "html", null, true);
            echo "\" data-url=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_edit_thread_comment", array("id" => $this->getAttribute($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "thread", array()), "id", array()), "commentId" => $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()))), "html", null, true);
            echo "\" class=\"fos_comment_comment_edit_show_form\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_edit", array(), "FOSCommentBundle");
            echo "</button>
                    ";
        }
        // line 32
        echo "                ";
    }

    // line 34
    public function block_fos_comment_comment_metas_delete($context, array $blocks = array())
    {
        // line 35
        echo "                    ";
        if ($this->env->getExtension('fos_comment')->canDeleteComment((isset($context["comment"]) ? $context["comment"] : null))) {
            // line 36
            echo "                        ";
            if ($this->env->getExtension('fos_comment')->isCommentInState((isset($context["comment"]) ? $context["comment"] : null), twig_constant("FOS\\CommentBundle\\Model\\CommentInterface::STATE_DELETED"))) {
                // line 37
                echo "                            ";
                // line 38
                echo "                            <button data-url=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_remove_thread_comment", array("id" => $this->getAttribute($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "thread", array()), "id", array()), "commentId" => $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "value" => twig_constant("FOS\\CommentBundle\\Model\\CommentInterface::STATE_VISIBLE"))), "html", null, true);
                echo "\" class=\"btn btn-default fos_comment_comment_remove\">";
                echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_undelete", array(), "FOSCommentBundle");
                echo "</button>
                        ";
            } else {
                // line 40
                echo "                            ";
                // line 41
                echo "                            <button data-url=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_remove_thread_comment", array("id" => $this->getAttribute($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "thread", array()), "id", array()), "commentId" => $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "value" => twig_constant("FOS\\CommentBundle\\Model\\CommentInterface::STATE_DELETED"))), "html", null, true);
                echo "\" class=\"btn btn-default fos_comment_comment_remove\">";
                echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_delete", array(), "FOSCommentBundle");
                echo "</button>
                        ";
            }
            // line 43
            echo "                    ";
        }
        // line 44
        echo "                ";
    }

    // line 46
    public function block_fos_comment_comment_metas_voting($context, array $blocks = array())
    {
        // line 47
        echo "                    ";
        if ($this->env->getExtension('fos_comment')->canVote((isset($context["comment"]) ? $context["comment"] : null))) {
            // line 48
            echo "                        <div class=\"fos_comment_comment_voting\">
                            <button data-url=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_new_thread_comment_votes", array("id" => $this->getAttribute($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "thread", array()), "id", array()), "commentId" => $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "value" => 1)), "html", null, true);
            echo "\" class=\"btn btn-default fos_comment_comment_vote\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_show_voteup", array(), "FOSCommentBundle");
            echo "</button>
                            <button data-url=\"";
            // line 50
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_new_thread_comment_votes", array("id" => $this->getAttribute($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "thread", array()), "id", array()), "commentId" => $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "value" =>  -1)), "html", null, true);
            echo "\" class=\"btn btn-default fos_comment_comment_vote\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_show_votedown", array(), "FOSCommentBundle");
            echo "</button>
                            <div class=\"fos_comment_comment_score\" id=\"fos_comment_score_";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "html", null, true);
            echo "\">";
            $this->env->loadTemplate("FOSCommentBundle:Thread:comment_votes.html.twig")->display(array_merge($context, array("commentScore" => $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "score", array()))));
            echo "</div>
                        </div>
                    ";
        }
        // line 54
        echo "                ";
    }

    // line 59
    public function block_fos_comment_comment_body($context, array $blocks = array())
    {
        // line 60
        echo "                ";
        if ($this->env->getExtension('fos_comment')->isCommentInState((isset($context["comment"]) ? $context["comment"] : null), twig_constant("FOS\\CommentBundle\\Model\\CommentInterface::STATE_DELETED"))) {
            // line 61
            echo "                    ";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_deleted", array(), "FOSCommentBundle");
            // line 62
            echo "                ";
        } else {
            // line 63
            echo "                    ";
            if ($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "note", array())) {
                // line 64
                echo "                        <p>";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata_comment_note_given", array(), "SonataCommentBundle"), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "note", array()), "html", null, true);
                echo "</p>
                    ";
            }
            // line 66
            echo "
                    ";
            // line 67
            if ($this->env->getExtension('fos_comment')->isRawComment((isset($context["comment"]) ? $context["comment"] : null))) {
                // line 68
                echo "                        ";
                echo $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "rawBody", array());
                echo "
                    ";
            } else {
                // line 70
                echo "                        ";
                echo nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "body", array()), "html", null, true));
                echo "
                    ";
            }
            // line 72
            echo "                ";
        }
        // line 73
        echo "            ";
    }

    // line 76
    public function block_fos_comment_comment_children($context, array $blocks = array())
    {
        // line 77
        echo "            ";
        if ( !((isset($context["view"]) ? $context["view"] : null) === "flat")) {
            // line 78
            echo "                ";
            if ($this->env->getExtension('fos_comment')->canComment((isset($context["comment"]) ? $context["comment"] : null))) {
                // line 79
                echo "                    <div class=\"fos_comment_comment_reply\">
                        ";
                // line 80
                $this->displayBlock('fos_comment_comment_reply', $context, $blocks);
                // line 83
                echo "                    </div>
                ";
            }
            // line 85
            echo "
                <div class=\"col-sm-offset-1 fos_comment_comment_replies\">

                    ";
            // line 88
            if (array_key_exists("children", $context)) {
                // line 89
                echo "                        ";
                $this->env->loadTemplate("FOSCommentBundle:Thread:comments.html.twig")->display(array_merge($context, array("comments" => (isset($context["children"]) ? $context["children"] : null), "depth" => ((isset($context["depth"]) ? $context["depth"] : null) + 1), "parent" => (isset($context["comment"]) ? $context["comment"] : null), "view" => (isset($context["view"]) ? $context["view"] : null))));
                // line 90
                echo "                    ";
            }
            // line 91
            echo "
                </div>
            ";
        } elseif (((        // line 93
(isset($context["view"]) ? $context["view"] : null) === "flat") && array_key_exists("children", $context))) {
            // line 94
            echo "                ";
            $this->env->loadTemplate("FOSCommentBundle:Thread:comments.html.twig")->display(array_merge($context, array("comments" => (isset($context["children"]) ? $context["children"] : null), "depth" => ((isset($context["depth"]) ? $context["depth"] : null) + 1), "parent" => (isset($context["comment"]) ? $context["comment"] : null), "view" => (isset($context["view"]) ? $context["view"] : null))));
            // line 95
            echo "            ";
        }
        // line 96
        echo "        ";
    }

    // line 80
    public function block_fos_comment_comment_reply($context, array $blocks = array())
    {
        // line 81
        echo "                            <button data-url=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_new_thread_comments", array("id" => $this->getAttribute($this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "thread", array()), "id", array()))), "html", null, true);
        echo "\" data-name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "authorName", array()), "html", null, true);
        echo "\" data-parent-id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["comment"]) ? $context["comment"] : null), "id", array()), "html", null, true);
        echo "\" class=\"btn btn-primary fos_comment_comment_reply_show_form\">";
        echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_show_reply", array(), "FOSCommentBundle");
        echo "</button>
                        ";
    }

    public function getTemplateName()
    {
        return "FOSCommentBundle:Thread:comment_content.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  316 => 81,  313 => 80,  309 => 96,  306 => 95,  303 => 94,  301 => 93,  297 => 91,  294 => 90,  291 => 89,  289 => 88,  284 => 85,  280 => 83,  278 => 80,  275 => 79,  272 => 78,  269 => 77,  266 => 76,  262 => 73,  259 => 72,  253 => 70,  247 => 68,  245 => 67,  242 => 66,  235 => 64,  232 => 63,  229 => 62,  226 => 61,  223 => 60,  220 => 59,  216 => 54,  208 => 51,  202 => 50,  196 => 49,  193 => 48,  190 => 47,  187 => 46,  183 => 44,  180 => 43,  172 => 41,  170 => 40,  162 => 38,  160 => 37,  157 => 36,  154 => 35,  151 => 34,  147 => 32,  137 => 30,  134 => 29,  131 => 28,  124 => 25,  118 => 23,  115 => 22,  112 => 21,  110 => 20,  107 => 19,  104 => 18,  101 => 17,  97 => 55,  95 => 46,  92 => 45,  90 => 34,  87 => 33,  85 => 28,  82 => 27,  79 => 17,  76 => 16,  70 => 97,  68 => 76,  64 => 74,  62 => 59,  58 => 58,  54 => 56,  52 => 16,  37 => 13,  31 => 12,  28 => 11,);
    }
}
