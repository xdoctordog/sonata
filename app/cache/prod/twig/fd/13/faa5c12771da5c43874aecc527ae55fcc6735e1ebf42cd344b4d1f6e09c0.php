<?php

/* SonataNewsBundle:Admin:list_post_custom.html.twig */
class __TwigTemplate_fd13faa5c12771da5c43874aecc527ae55fcc6735e1ebf42cd344b4d1f6e09c0 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        // line 15
        echo "    <div class=\"col-sm-2 centered\">
        <center>
            ";
        // line 17
        if ((($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "image", array()) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : null)), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "hasRoute", array(0 => "edit"), "method"))) {
            // line 18
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_core_template')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "method"), "html", null, true);
            echo "\" style=\"float: left; margin-right: 6px;\">";
            echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "image", array()), "admin", array("width" => 90));
            echo "</a>
            ";
        } else {
            // line 20
            echo "                <i class=\"fa fa-chain-broken fa-3x\"></i>
            ";
        }
        // line 22
        echo "        </center>
    </div>
    <div class=\"col-sm-10\">
        <span class=\"badge pull-right\">";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "commentsCount", array()), "html", null, true);
        echo "</span>
        ";
        // line 26
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : null)), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "hasRoute", array(0 => "edit"), "method"))) {
            // line 27
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_core_template')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : null)))), "method"), "html", null, true);
            echo "\"><strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "title", array()), "html", null, true);
            echo "</strong></a>
        ";
        } else {
            // line 29
            echo "            <strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "title", array()), "html", null, true);
            echo "</strong>
        ";
        }
        // line 31
        echo "
        ";
        // line 32
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "author", array())) {
            // line 33
            echo "            ~ ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "author", array()), "username", array()), "html", null, true);
            echo "
        ";
        }
        // line 35
        echo "        <br />

        ";
        // line 37
        echo twig_escape_filter($this->env, twig_truncate_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "abstract", array()), 150), "html", null, true);
        echo "

        <br />
        ";
        // line 40
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "collection", array())) {
            // line 41
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "collection", array()), "name", array()), "html", null, true);
            echo "
        ";
        }
        // line 43
        echo "
        ";
        // line 44
        if (($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "collection", array()) && (twig_length_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : null), "tags", array())) > 0))) {
            // line 45
            echo "            ~
        ";
        }
        // line 47
        echo "
        ";
        // line 48
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : null), "tags", array()));
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
            // line 49
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "name", array()), "html", null, true);
            if ( !$this->getAttribute($context["loop"], "last", array())) {
                echo ", ";
            }
            // line 50
            echo "        ";
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
        // line 51
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataNewsBundle:Admin:list_post_custom.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 51,  146 => 50,  140 => 49,  123 => 48,  120 => 47,  116 => 45,  114 => 44,  111 => 43,  105 => 41,  103 => 40,  97 => 37,  93 => 35,  87 => 33,  85 => 32,  82 => 31,  76 => 29,  68 => 27,  66 => 26,  62 => 25,  57 => 22,  53 => 20,  45 => 18,  43 => 17,  39 => 15,  36 => 14,  11 => 12,);
    }
}
