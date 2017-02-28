<?php

/* FOSCommentBundle:Thread:comment_new_content.html.twig */
class __TwigTemplate_2225d0a388c89b60e0b7b9755ef72dc18b17a523af8e9a49ae4292e9533e1734 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'fos_comment_comment_form_holder' => array($this, 'block_fos_comment_comment_form_holder'),
            'fos_comment_comment_new_form' => array($this, 'block_fos_comment_comment_new_form'),
            'fos_comment_form_title' => array($this, 'block_fos_comment_form_title'),
            'fos_comment_form_fields' => array($this, 'block_fos_comment_form_fields'),
            'fos_comment_form_submit' => array($this, 'block_fos_comment_form_submit'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $context["first"] = ((array_key_exists("first", $context)) ? (_twig_default_filter((isset($context["first"]) ? $context["first"] : null), false)) : (false));
        // line 13
        echo "
";
        // line 14
        $context["url_parameters"] = array("id" => (isset($context["id"]) ? $context["id"] : null));
        // line 15
        if ( !(null === (isset($context["parent"]) ? $context["parent"] : null))) {
            // line 16
            echo "    ";
            $context["url_parameters"] = twig_array_merge((isset($context["url_parameters"]) ? $context["url_parameters"] : null), array("parentId" => $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "id", array())));
        }
        // line 18
        echo "
";
        // line 19
        $this->displayBlock('fos_comment_comment_form_holder', $context, $blocks);
    }

    public function block_fos_comment_comment_form_holder($context, array $blocks = array())
    {
        // line 20
        echo "    <div class=\"fos_comment_comment_form_holder\">
        ";
        // line 21
        $this->displayBlock('fos_comment_comment_new_form', $context, $blocks);
        // line 83
        echo "    </div>
";
    }

    // line 21
    public function block_fos_comment_comment_new_form($context, array $blocks = array())
    {
        // line 22
        echo "            <form class=\"fos_comment_comment_new_form\" action=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("fos_comment_post_thread_comments", (isset($context["url_parameters"]) ? $context["url_parameters"] : null)), "html", null, true);
        echo "\" data-parent=\"";
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "id", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "id", array()))) : ("")), "html", null, true);
        echo "\" method=\"POST\">
                <div class=\"panel panel-primary\">
                    <div class=\"panel-heading\">
                        ";
        // line 25
        $this->displayBlock('fos_comment_form_title', $context, $blocks);
        // line 34
        echo "                    </div>

                    <div class=\"panel-body\">
                        ";
        // line 37
        $this->displayBlock('fos_comment_form_fields', $context, $blocks);
        // line 70
        echo "
                        <div class=\"fos_comment_submit\">
                            ";
        // line 72
        $this->displayBlock('fos_comment_form_submit', $context, $blocks);
        // line 78
        echo "                        </div>
                    </div>
                </div>
            </form>
        ";
    }

    // line 25
    public function block_fos_comment_form_title($context, array $blocks = array())
    {
        // line 26
        echo "                            ";
        if ((isset($context["first"]) ? $context["first"] : null)) {
            // line 27
            echo "                                <h3 class=\"panel-title\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_new_headline_first", array(), "FOSCommentBundle");
            echo "</h3>
                            ";
        } elseif ( !(null ===         // line 28
(isset($context["parent"]) ? $context["parent"] : null))) {
            // line 29
            echo "                                <h3 class=\"panel-title\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_reply_reply_to", array("%name%" => $this->getAttribute((isset($context["parent"]) ? $context["parent"] : null), "authorName", array())), "FOSCommentBundle");
            echo "</h3>
                            ";
        } else {
            // line 31
            echo "                                <h3 class=\"panel-title\">";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_new_headline", array(), "FOSCommentBundle");
            echo "</h3>
                            ";
        }
        // line 33
        echo "                        ";
    }

    // line 37
    public function block_fos_comment_form_fields($context, array $blocks = array())
    {
        // line 38
        echo "                            <div class=\"row\">
                                ";
        // line 39
        if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "authorName", array(), "any", true, true)) {
            // line 40
            echo "                                    <div class=\"col-sm-3\">
                                        ";
            // line 41
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "authorName", array()), 'label', array("horizontal_label_class" => "") + (twig_test_empty($_label_ = $this->env->getExtension('translator')->trans("form_label_author_name", array(), "SonataCommentBundle")) ? array() : array("label" => $_label_)));
            echo "
                                        ";
            // line 42
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "authorName", array()), 'widget', array("horizontal_input_wrapper_class" => ""));
            echo "
                                    </div>
                                ";
        }
        // line 45
        echo "
                                <div class=\"col-sm-3\">
                                    ";
        // line 47
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "website", array()), 'label', array("horizontal_label_class" => "") + (twig_test_empty($_label_ = $this->env->getExtension('translator')->trans("form_label_website", array(), "SonataCommentBundle")) ? array() : array("label" => $_label_)));
        echo "
                                    ";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "website", array()), 'widget', array("horizontal_input_wrapper_class" => ""));
        echo "
                                </div>

                                <div class=\"col-sm-3\">
                                    ";
        // line 52
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "email", array()), 'label', array("horizontal_label_class" => "") + (twig_test_empty($_label_ = $this->env->getExtension('translator')->trans("form_label_email", array(), "SonataCommentBundle")) ? array() : array("label" => $_label_)));
        echo "
                                    ";
        // line 53
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "email", array()), 'widget', array("horizontal_input_wrapper_class" => ""));
        echo "
                                </div>

                                <div class=\"col-sm-3\">
                                    ";
        // line 57
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "note", array()), 'label', array("horizontal_label_class" => "") + (twig_test_empty($_label_ = $this->env->getExtension('translator')->trans("form_label_note", array(), "SonataCommentBundle")) ? array() : array("label" => $_label_)));
        echo "
                                    ";
        // line 58
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "note", array()), 'widget', array("horizontal_input_wrapper_class" => ""));
        echo "
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-sm-12\">
                                    ";
        // line 63
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "body", array()), 'label', array("horizontal_label_class" => "") + (twig_test_empty($_label_ = $this->env->getExtension('translator')->trans("form_label_body", array(), "SonataCommentBundle")) ? array() : array("label" => $_label_)));
        echo "
                                    ";
        // line 64
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "body", array()), 'widget', array("horizontal_input_wrapper_class" => ""));
        echo "
                                </div>
                            </div>

                            ";
        // line 68
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
                        ";
    }

    // line 72
    public function block_fos_comment_form_submit($context, array $blocks = array())
    {
        // line 73
        echo "                                ";
        if ( !(null === (isset($context["parent"]) ? $context["parent"] : null))) {
            // line 74
            echo "                                    <input class=\"btn\" type=\"button\" value=\"";
            echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_reply_cancel", array(), "FOSCommentBundle");
            echo "\" class=\"fos_comment_comment_reply_cancel\" />
                                ";
        }
        // line 76
        echo "                                <input class=\"btn btn-primary\" type=\"submit\" value=\"";
        echo $this->env->getExtension('translator')->getTranslator()->trans("fos_comment_comment_new_submit", array(), "FOSCommentBundle");
        echo "\" />
                            ";
    }

    public function getTemplateName()
    {
        return "FOSCommentBundle:Thread:comment_new_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  211 => 76,  205 => 74,  202 => 73,  199 => 72,  193 => 68,  186 => 64,  182 => 63,  174 => 58,  170 => 57,  163 => 53,  159 => 52,  152 => 48,  148 => 47,  144 => 45,  138 => 42,  134 => 41,  131 => 40,  129 => 39,  126 => 38,  123 => 37,  119 => 33,  113 => 31,  107 => 29,  105 => 28,  100 => 27,  97 => 26,  94 => 25,  86 => 78,  84 => 72,  80 => 70,  78 => 37,  73 => 34,  71 => 25,  62 => 22,  59 => 21,  54 => 83,  52 => 21,  49 => 20,  43 => 19,  40 => 18,  36 => 16,  34 => 15,  32 => 14,  29 => 13,  27 => 12,  24 => 11,);
    }
}
