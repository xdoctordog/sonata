<?php

/* SonataTimelineBundle:Block:timeline.html.twig */
class __TwigTemplate_6bd65bb5e14ab24583b766b51b61cd9b0b5e9be35a0f9f6613323b5b1f99ea84 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "    <div class=\"box box-primary\">
        ";
        // line 15
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array())) {
            // line 16
            echo "            <div class=\"box-heading\">
                <h4 class=\"box-title\"><i class=\"fa fa-clock-o fa-fw\"></i> ";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "title", array()), "html", null, true);
            echo "</h4>
            </div>
        ";
        }
        // line 20
        echo "
        <div class=\"box-body\">

            ";
        // line 23
        // token for sonata_template_box, however the box is disabled
        // line 24
        echo "
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <ul class=\"timeline\">
                        ";
        // line 28
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["entries"]) ? $context["entries"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
            // line 29
            echo "
                            ";
            // line 30
            if (( !array_key_exists("currentDay", $context) || ((isset($context["currentDay"]) ? $context["currentDay"] : null) != $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute($context["entry"], "createdAt", array()))))) {
                // line 31
                echo "                                ";
                $context["currentDay"] = $this->env->getExtension('sonata_intl_datetime')->formatDate($this->getAttribute($context["entry"], "createdAt", array()));
                // line 32
                echo "                                <li class=\"time-label\">
                                    <span class=\"bg-red\">";
                // line 33
                echo twig_escape_filter($this->env, (isset($context["currentDay"]) ? $context["currentDay"] : null), "html", null, true);
                echo "</span>
                                </li>
                            ";
            }
            // line 36
            echo "
                            ";
            // line 37
            $context["subject"] = $this->getAttribute($context["entry"], "getComponent", array(0 => "subject"), "method");
            // line 38
            echo "                            ";
            $context["target"] = $this->getAttribute($context["entry"], "getComponent", array(0 => "target"), "method");
            // line 39
            echo "                            ";
            $context["target_text_component"] = $this->getAttribute($context["entry"], "getComponent", array(0 => "target_text"), "method");
            // line 40
            echo "
                            ";
            // line 41
            if ($this->getAttribute((isset($context["subject"]) ? $context["subject"] : null), "data", array())) {
                // line 42
                echo "                                ";
                $context["subject_text"] = $this->env->getExtension('sonata_timeline')->generateLink((isset($context["subject"]) ? $context["subject"] : null), $context["entry"]);
                // line 43
                echo "                            ";
            } else {
                // line 44
                echo "                                ";
                $context["subject_text"] = (("<abbr title=\"reference: " . $this->getAttribute((isset($context["subject"]) ? $context["subject"] : null), "hash", array())) . "\">element deleted</abbr>");
                // line 45
                echo "                            ";
            }
            // line 46
            echo "
                            ";
            // line 47
            if (($this->getAttribute((isset($context["target"]) ? $context["target"] : null), "data", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["target"]) ? $context["target"] : null), "data", array())))) {
                // line 48
                echo "                                ";
                $context["target_text"] = $this->env->getExtension('sonata_timeline')->generateLink((isset($context["target"]) ? $context["target"] : null), $context["entry"]);
                // line 49
                echo "                            ";
            } elseif ((isset($context["target_text_component"]) ? $context["target_text_component"] : null)) {
                // line 50
                echo "                                ";
                $context["target_text"] = (("<abbr title=\"Element Deleted\">" . (isset($context["target_text_component"]) ? $context["target_text_component"] : null)) . "</abbr>");
                // line 51
                echo "                            ";
            } else {
                // line 52
                echo "                                ";
                $context["target_text"] = (("<abbr title=\"reference: " . $this->getAttribute((isset($context["target"]) ? $context["target"] : null), "hash", array())) . "\">element deleted</abbr>");
                // line 53
                echo "                            ";
            }
            // line 54
            echo "
                            ";
            // line 55
            $context["verb"] = ("actions." . $this->getAttribute($context["entry"], "verb", array()));
            // line 56
            echo "                            ";
            $context["icon"] = ("actions.icon." . $this->getAttribute($context["entry"], "verb", array()));
            // line 57
            echo "
                            <li>
                                <i class=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["icon"]) ? $context["icon"] : null), array(), "SonataTimelineBundle"), "html", null, true);
            echo "\"></i>
                                <div class=\"timeline-item\" style=\"background: #f3f4f5;\">
                                    <span class=\"time\"><i class=\"fa fa-clock-o\"></i> ";
            // line 61
            echo $this->env->getExtension('sonata_intl_datetime')->formatTime($this->getAttribute($context["entry"], "createdAt", array()));
            echo "</span>
                                    <h3 class=\"timeline-header\" style=\"border-bottom: none;\">";
            // line 62
            echo $this->env->getExtension('translator')->trans((isset($context["verb"]) ? $context["verb"] : null), array("%subject%" => (isset($context["subject_text"]) ? $context["subject_text"] : null), "%target%" => (isset($context["target_text"]) ? $context["target_text"] : null)), "SonataTimelineBundle");
            echo "</h3>
                                </div>
                            </li>
                        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 66
            echo "                            No action for now ...
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entry'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        echo "                    </ul>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataTimelineBundle:Block:timeline.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  167 => 68,  160 => 66,  151 => 62,  147 => 61,  142 => 59,  138 => 57,  135 => 56,  133 => 55,  130 => 54,  127 => 53,  124 => 52,  121 => 51,  118 => 50,  115 => 49,  112 => 48,  110 => 47,  107 => 46,  104 => 45,  101 => 44,  98 => 43,  95 => 42,  93 => 41,  90 => 40,  87 => 39,  84 => 38,  82 => 37,  79 => 36,  73 => 33,  70 => 32,  67 => 31,  65 => 30,  62 => 29,  57 => 28,  51 => 24,  49 => 23,  44 => 20,  38 => 17,  35 => 16,  33 => 15,  30 => 14,  27 => 13,  18 => 11,);
    }
}
