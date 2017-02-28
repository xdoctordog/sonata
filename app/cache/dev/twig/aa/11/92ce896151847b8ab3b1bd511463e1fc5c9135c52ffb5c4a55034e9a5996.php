<?php

/* MopaBootstrapBundle:Form:fields.html.twig */
class __TwigTemplate_aa1192ce896151847b8ab3b1bd511463e1fc5c9135c52ffb5c4a55034e9a5996 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("form_div_layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'button_attributes' => array($this, 'block_button_attributes'),
            'button_widget' => array($this, 'block_button_widget'),
            'choice_widget_collapsed' => array($this, 'block_choice_widget_collapsed'),
            'textarea_widget' => array($this, 'block_textarea_widget'),
            'form_widget_simple' => array($this, 'block_form_widget_simple'),
            'form_widget_compound' => array($this, 'block_form_widget_compound'),
            'form_tabs' => array($this, 'block_form_tabs'),
            'tabs_widget' => array($this, 'block_tabs_widget'),
            'form_tab' => array($this, 'block_form_tab'),
            'collection_widget' => array($this, 'block_collection_widget'),
            'choice_widget_expanded' => array($this, 'block_choice_widget_expanded'),
            'checkbox_widget' => array($this, 'block_checkbox_widget'),
            'date_widget' => array($this, 'block_date_widget'),
            'time_widget' => array($this, 'block_time_widget'),
            'datetime_widget' => array($this, 'block_datetime_widget'),
            'percent_widget' => array($this, 'block_percent_widget'),
            'money_widget' => array($this, 'block_money_widget'),
            'file_widget' => array($this, 'block_file_widget'),
            'form_legend' => array($this, 'block_form_legend'),
            'form_label' => array($this, 'block_form_label'),
            'help_label' => array($this, 'block_help_label'),
            'help_label_tooltip' => array($this, 'block_help_label_tooltip'),
            'help_label_popover' => array($this, 'block_help_label_popover'),
            'form_rows_visible' => array($this, 'block_form_rows_visible'),
            'form_row' => array($this, 'block_form_row'),
            'form_message' => array($this, 'block_form_message'),
            'form_help' => array($this, 'block_form_help'),
            'form_widget_add_btn' => array($this, 'block_form_widget_add_btn'),
            'form_widget_remove_btn' => array($this, 'block_form_widget_remove_btn'),
            'collection_button' => array($this, 'block_collection_button'),
            'label_asterisk' => array($this, 'block_label_asterisk'),
            'widget_addon' => array($this, 'block_widget_addon'),
            'form_errors' => array($this, 'block_form_errors'),
            'error_type' => array($this, 'block_error_type'),
            'widget_form_group_start' => array($this, 'block_widget_form_group_start'),
            'help_widget_popover' => array($this, 'block_help_widget_popover'),
            'widget_form_group_end' => array($this, 'block_widget_form_group_end'),
            'form_widget' => array($this, 'block_form_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "form_div_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_button_attributes($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ("btn " . (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")))));
        // line 6
        echo "    ";
        $this->displayParentBlock("button_attributes", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_button_widget($context, array $blocks = array())
    {
        // line 10
        ob_start();
        // line 11
        echo "    ";
        if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
            // line 12
            echo "        ";
            $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
            // line 13
            echo "    ";
        }
        // line 14
        echo "    <button type=\"";
        echo twig_escape_filter($this->env, ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "button")) : ("button")), "html", null, true);
        echo "\" ";
        $this->displayBlock("button_attributes", $context, $blocks);
        echo ">
    ";
        // line 15
        if ( !twig_test_empty((isset($context["icon"]) ? $context["icon"] : $this->getContext($context, "icon")))) {
            echo " <span class=\"glyphicon glyphicon-";
            echo twig_escape_filter($this->env, (isset($context["icon"]) ? $context["icon"] : $this->getContext($context, "icon")), "html", null, true);
            echo "\"";
            if ( !twig_test_empty((isset($context["icon_color"]) ? $context["icon_color"] : $this->getContext($context, "icon_color")))) {
                echo " style=\"color: ";
                echo twig_escape_filter($this->env, (isset($context["icon_color"]) ? $context["icon_color"] : $this->getContext($context, "icon_color")), "html", null, true);
                echo ";\" ";
            }
            echo " ></span> ";
        }
        echo " ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
        echo "</button>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 21
    public function block_choice_widget_collapsed($context, array $blocks = array())
    {
        // line 22
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control")));
        // line 23
        echo "    ";
        if (( !(isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")) && (isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal")))) {
            // line 24
            echo "        ";
            if ( !(isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render"))) {
                // line 25
                echo "        ";
                $context["horizontal_input_wrapper_class"] = (((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")) . " ") . (isset($context["horizontal_label_offset_class"]) ? $context["horizontal_label_offset_class"] : $this->getContext($context, "horizontal_label_offset_class")));
                // line 26
                echo "        ";
            }
            // line 27
            echo "        <div class=\"";
            echo twig_escape_filter($this->env, (isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "html", null, true);
            echo "\">
    ";
        }
        // line 29
        echo "    ";
        $this->displayParentBlock("choice_widget_collapsed", $context, $blocks);
        echo "
    ";
        // line 30
        if (( !(isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")) && (isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal")))) {
            // line 31
            echo "            ";
            $this->displayBlock("form_message", $context, $blocks);
            echo "
        </div>
    ";
        }
    }

    // line 36
    public function block_textarea_widget($context, array $blocks = array())
    {
        // line 37
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control")));
        // line 38
        echo "    ";
        if (( !(isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")) && (isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal")))) {
            // line 39
            echo "    ";
            if ( !(isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render"))) {
                // line 40
                echo "    ";
                $context["horizontal_input_wrapper_class"] = (((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")) . " ") . (isset($context["horizontal_label_offset_class"]) ? $context["horizontal_label_offset_class"] : $this->getContext($context, "horizontal_label_offset_class")));
                // line 41
                echo "    ";
            }
            // line 42
            echo "    <div class=\"";
            echo twig_escape_filter($this->env, (isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "html", null, true);
            echo "\">
    ";
        }
        // line 44
        echo "    ";
        $this->displayParentBlock("textarea_widget", $context, $blocks);
        echo "
    ";
        // line 45
        if (( !(isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")) && (isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal")))) {
            // line 46
            echo "            ";
            $this->displayBlock("form_message", $context, $blocks);
            echo "
    </div>
    ";
        }
    }

    // line 51
    public function block_form_widget_simple($context, array $blocks = array())
    {
        // line 52
        ob_start();
        // line 53
        echo "    ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "text")) : ("text"));
        // line 54
        echo "    ";
        if (((((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) != "hidden") &&  !(isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline"))) && (isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal")))) {
            // line 55
            echo "    <div class=\"";
            echo twig_escape_filter($this->env, (isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "html", null, true);
            echo "\">
    ";
        }
        // line 57
        echo "    ";
        if ((((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) != "hidden") && ( !(null === ((array_key_exists("widget_addon_prepend", $context)) ? (_twig_default_filter((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")), null)) : (null))) ||  !(null === ((array_key_exists("widget_addon_append", $context)) ? (_twig_default_filter((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append")), null)) : (null)))))) {
            // line 58
            echo "    <div class=\"input-group\">
        ";
            // line 59
            if ( !(null === ((array_key_exists("widget_addon_prepend", $context)) ? (_twig_default_filter((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")), null)) : (null)))) {
                // line 60
                echo "            ";
                $context["widget_addon"] = (isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend"));
                // line 61
                echo "            ";
                $this->displayBlock("widget_addon", $context, $blocks);
                echo "
        ";
            }
            // line 63
            echo "    ";
        }
        // line 64
        echo "    ";
        if ( !((array_key_exists("widget_remove_btn", $context)) ? (_twig_default_filter((isset($context["widget_remove_btn"]) ? $context["widget_remove_btn"] : $this->getContext($context, "widget_remove_btn")), null)) : (null))) {
            // line 65
            echo "        ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " not-removable")));
            // line 66
            echo "    ";
        }
        // line 67
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control")));
        // line 68
        echo "    ";
        $this->displayParentBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        // line 69
        if ((((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) != "hidden") && ( !(null === ((array_key_exists("widget_addon_prepend", $context)) ? (_twig_default_filter((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")), null)) : (null))) ||  !(null === ((array_key_exists("widget_addon_append", $context)) ? (_twig_default_filter((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append")), null)) : (null)))))) {
            // line 70
            echo "        ";
            if ( !(null === ((array_key_exists("widget_addon_append", $context)) ? (_twig_default_filter((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append")), null)) : (null)))) {
                // line 71
                echo "        ";
                $context["widget_addon"] = (isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append"));
                // line 72
                echo "        ";
                $this->displayBlock("widget_addon", $context, $blocks);
                echo "
        ";
            }
            // line 74
            echo "    </div>
    ";
        }
        // line 76
        echo "    ";
        if (((((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) != "hidden") &&  !(isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline"))) && (isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal")))) {
            // line 77
            echo "        ";
            $this->displayBlock("form_message", $context, $blocks);
            echo "
    </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 83
    public function block_form_widget_compound($context, array $blocks = array())
    {
        // line 84
        ob_start();
        // line 85
        echo "    ";
        if (($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) == null)) {
            // line 86
            echo "        ";
            if ((isset($context["render_fieldset"]) ? $context["render_fieldset"] : $this->getContext($context, "render_fieldset"))) {
                echo "<fieldset>";
            }
            // line 87
            echo "        ";
            if ((isset($context["show_legend"]) ? $context["show_legend"] : $this->getContext($context, "show_legend"))) {
                $this->displayBlock("form_legend", $context, $blocks);
            }
            // line 88
            echo "    ";
        }
        // line 89
        echo "
    ";
        // line 90
        if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "tabbed", array())) {
            // line 91
            echo "        ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'tabs');
            echo "
        <div class=\"tab-content\">
    ";
        }
        // line 94
        echo "
    ";
        // line 95
        $this->displayBlock("form_rows_visible", $context, $blocks);
        echo "

    ";
        // line 97
        if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "tabbed", array())) {
            // line 98
            echo "        </div>
    ";
        }
        // line 100
        echo "
    ";
        // line 101
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "

    ";
        // line 103
        if (($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) == null)) {
            // line 104
            echo "        ";
            if ((isset($context["render_fieldset"]) ? $context["render_fieldset"] : $this->getContext($context, "render_fieldset"))) {
                echo "</fieldset>";
            }
            // line 105
            echo "    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 109
    public function block_form_tabs($context, array $blocks = array())
    {
        // line 110
        if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "tabsView", array(), "any", true, true)) {
            // line 111
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "tabsView", array()), 'widget');
            echo "
";
        }
    }

    // line 115
    public function block_tabs_widget($context, array $blocks = array())
    {
        // line 116
        ob_start();
        // line 117
        echo "<ul class=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "attr", array()), "class", array()), "html", null, true);
        echo "\">
    ";
        // line 118
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "tabs", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
            // line 119
            echo "        <li";
            if ($this->getAttribute($context["tab"], "active", array())) {
                echo " class=\"active\"";
            }
            echo ">
            <a data-toggle=\"tab\" href=\"#";
            // line 120
            echo twig_escape_filter($this->env, $this->getAttribute($context["tab"], "id", array()), "html", null, true);
            echo "\">
                ";
            // line 121
            if ($this->getAttribute($context["tab"], "icon", array())) {
                echo "<span class=\"glyphicon glyphicon-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["tab"], "icon", array()), "html", null, true);
                echo "\"></span>";
            }
            // line 122
            echo "                ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["tab"], "label", array()), "html", null, true);
            echo "
            </a>
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 126
        echo "</ul>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 130
    public function block_form_tab($context, array $blocks = array())
    {
        // line 131
        echo "<div class=\"tab-pane";
        echo (($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "tab_active", array())) ? (" active") : (""));
        echo "\" id=\"";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\">
    ";
        // line 132
        $this->displayBlock("form_widget", $context, $blocks);
        echo "
</div>
";
    }

    // line 136
    public function block_collection_widget($context, array $blocks = array())
    {
        // line 137
        ob_start();
        // line 138
        echo "    <div class=\"collection-items col-lg-9\">
    ";
        // line 139
        $this->displayBlock("form_widget", $context, $blocks);
        echo "
    </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 144
    public function block_choice_widget_expanded($context, array $blocks = array())
    {
        // line 145
        ob_start();
        // line 146
        echo "    ";
        $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => (($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : (""))));
        // line 147
        echo "    ";
        $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => (($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), "class", array()) . " ") . ((((isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")) != "")) ? ((((((isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))) ? ("checkbox") : ("radio")) . "-") . (isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")))) : ("")))));
        // line 148
        echo "    ";
        if ((isset($context["expanded"]) ? $context["expanded"] : $this->getContext($context, "expanded"))) {
            // line 149
            echo "        ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), (isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")))) : ((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class"))))));
            // line 150
            echo "        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
    ";
        }
        // line 152
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 153
            echo "        ";
            if (((isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")) != "inline")) {
                // line 154
                echo "        <div class=\"";
                echo (((isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))) ? ("checkbox") : ("radio"));
                echo "\">
        ";
            }
            // line 156
            echo "            <label";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">
                ";
            // line 157
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'widget', array("horizontal_label_class" => (isset($context["horizontal_label_class"]) ? $context["horizontal_label_class"] : $this->getContext($context, "horizontal_label_class")), "horizontal_input_wrapper_class" => (isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "attr" => array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array()), "")) : ("")))));
            echo "
                ";
            // line 158
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["child"], "vars", array()), "label", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "
            </label>
        ";
            // line 160
            if (((isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")) != "inline")) {
                // line 161
                echo "        </div>
        ";
            }
            // line 163
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 164
        echo "    ";
        $this->displayBlock("form_message", $context, $blocks);
        echo "
    ";
        // line 165
        if ((isset($context["expanded"]) ? $context["expanded"] : $this->getContext($context, "expanded"))) {
            // line 166
            echo "        </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 171
    public function block_checkbox_widget($context, array $blocks = array())
    {
        // line 172
        ob_start();
        // line 173
        if (( !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false) && twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label"))))) {
            // line 174
            echo "    ";
            $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
        }
        // line 176
        if ((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array())))) {
            // line 177
            echo "<div class=\"";
            echo twig_escape_filter($this->env, (isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "html", null, true);
            echo "\">
    <div class=\"checkbox\">
";
        }
        // line 180
        echo "
";
        // line 181
        if (((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array()))) && (isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render")))) {
            // line 182
            echo "    <label class=\"";
            if ((array_key_exists("inline", $context) && (isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")))) {
                echo "checkbox-inline";
            }
            echo "\">
";
        }
        // line 184
        echo "        <input type=\"checkbox\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        if (array_key_exists("value", $context)) {
            echo " value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "\"";
        }
        if ((isset($context["checked"]) ? $context["checked"] : $this->getContext($context, "checked"))) {
            echo " checked=\"checked\"";
        }
        echo "/>
";
        // line 185
        if ((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array())))) {
            // line 186
            echo "    ";
            if (((isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render")) && twig_in_filter((isset($context["widget_checkbox_label"]) ? $context["widget_checkbox_label"] : $this->getContext($context, "widget_checkbox_label")), array(0 => "both", 1 => "widget")))) {
                // line 187
                echo "        ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                echo "
    </label>
    ";
            }
        }
        // line 191
        if ((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array())))) {
            // line 192
            echo "    </div>
    ";
            // line 193
            $this->displayBlock("form_message", $context, $blocks);
            echo "
</div>
";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 199
    public function block_date_widget($context, array $blocks = array())
    {
        // line 200
        ob_start();
        // line 201
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 202
            echo "    ";
            if (array_key_exists("datepicker", $context)) {
                // line 203
                echo "        <div class=\"input-group date col-lg-9\">
            ";
                // line 204
                if ( !(null === ((array_key_exists("widget_addon_prepend", $context)) ? (_twig_default_filter((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")), null)) : (null)))) {
                    // line 205
                    echo "                ";
                    $context["widget_addon"] = (isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend"));
                    // line 206
                    echo "                ";
                    $this->displayBlock("widget_addon", $context, $blocks);
                    echo "
            ";
                }
                // line 208
                echo "            ";
                $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " not-removable grd-white form-control")));
                // line 209
                echo "            <input type=\"text\" ";
                $this->displayBlock("widget_attributes", $context, $blocks);
                echo " value=\"";
                echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
                echo "\"  data-form=\"datepicker\" data-date-format=\"";
                echo twig_escape_filter($this->env, twig_lower_filter($this->env, (isset($context["format"]) ? $context["format"] : $this->getContext($context, "format"))), "html", null, true);
                echo "\"/>
            ";
                // line 210
                if ( !(null === ((array_key_exists("widget_addon_append", $context)) ? (_twig_default_filter((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append")), null)) : (null)))) {
                    // line 211
                    echo "                ";
                    $context["widget_addon"] = (isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append"));
                    // line 212
                    echo "                ";
                    $this->displayBlock("widget_addon", $context, $blocks);
                    echo "
            ";
                }
                // line 214
                echo "\t    <script type=\"text/javascript\">
\t\t\$(document).ready(function () {
\t\t    \$(";
                // line 216
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                echo ").datepicker();
                    \$(";
                // line 217
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                echo ").keydown(function(e) {
                        if(e.which == 27) {
                            \$(";
                // line 219
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                echo ").datepicker('hide');
                                return false;
                            }
                        });
                });
            </script>
        </div>
    ";
            } else {
                // line 227
                echo "        ";
                $this->displayBlock("form_widget_simple", $context, $blocks);
                echo "
    ";
            }
            // line 229
            echo "    ";
            $this->displayBlock("form_message", $context, $blocks);
            echo "
";
        } else {
            // line 231
            echo "    ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "inline")) : ("inline"))));
            // line 232
            echo "        ";
            echo strtr((isset($context["date_pattern"]) ? $context["date_pattern"] : $this->getContext($context, "date_pattern")), array("{{ year }}" =>             // line 233
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "year", array()), 'widget', array("attr" => array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array()), "")) : ("")) . "")), "horizontal_input_wrapper_class" => ((array_key_exists("horizontal_input_wrapper_class", $context)) ? (_twig_default_filter((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "col-lg-3")) : ("col-lg-3")))), "{{ month }}" =>             // line 234
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "month", array()), 'widget', array("attr" => array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array()), "")) : ("")) . "")), "horizontal_input_wrapper_class" => ((array_key_exists("horizontal_input_wrapper_class", $context)) ? (_twig_default_filter((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "col-lg-3")) : ("col-lg-3")))), "{{ day }}" =>             // line 235
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "day", array()), 'widget', array("attr" => array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array()), "")) : ("")) . "")), "horizontal_input_wrapper_class" => ((array_key_exists("horizontal_input_wrapper_class", $context)) ? (_twig_default_filter((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "col-lg-3")) : ("col-lg-3"))))));
            // line 236
            echo "
    ";
            // line 237
            $this->displayBlock("form_message", $context, $blocks);
            echo "
";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 242
    public function block_time_widget($context, array $blocks = array())
    {
        // line 243
        ob_start();
        // line 244
        echo "    ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 245
            echo "        ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
    ";
        } else {
            // line 247
            echo "        ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : (""))));
            // line 248
            echo "        ";
            ob_start();
            // line 249
            echo "        ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "hour", array()), 'widget', array("attr" => array("size" => "1"), "horizontal_input_wrapper_class" => ((array_key_exists("horizontal_input_wrapper_class", $context)) ? (_twig_default_filter((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "col-lg-2")) : ("col-lg-2"))));
            echo "
        ";
            // line 250
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "minute", array()), 'widget', array("attr" => array("size" => "1"), "horizontal_input_wrapper_class" => ((array_key_exists("horizontal_input_wrapper_class", $context)) ? (_twig_default_filter((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "col-lg-2")) : ("col-lg-2"))));
            echo "
        ";
            // line 251
            if ((isset($context["with_seconds"]) ? $context["with_seconds"] : $this->getContext($context, "with_seconds"))) {
                // line 252
                echo "            :";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second", array()), 'widget', array("attr" => array("size" => "1")));
                echo "
        ";
            }
            // line 254
            echo "        ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 255
            echo "        ";
            $this->displayBlock("form_message", $context, $blocks);
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 260
    public function block_datetime_widget($context, array $blocks = array())
    {
        // line 261
        ob_start();
        // line 262
        echo "    ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 263
            echo "        ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
    ";
        } else {
            // line 265
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : (""))));
            // line 266
            echo "            <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
                ";
            // line 267
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date", array()), 'errors');
            echo "
                ";
            // line 268
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "time", array()), 'errors');
            echo "
                ";
            // line 269
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date", array()), 'widget', array("attr" => array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array()), "")) : (""))), "horizontal_input_wrapper_class" => ((array_key_exists("horizontal_input_wrapper_class", $context)) ? (_twig_default_filter((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "col-lg-3")) : ("col-lg-3"))));
            echo "
                ";
            // line 270
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "time", array()), 'widget', array("attr" => array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array()), "")) : (""))), "horizontal_input_wrapper_class" => ((array_key_exists("horizontal_input_wrapper_class", $context)) ? (_twig_default_filter((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "col-lg-2")) : ("col-lg-2"))));
            echo "
                ";
            // line 271
            $this->displayBlock("form_message", $context, $blocks);
            echo "
            </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 277
    public function block_percent_widget($context, array $blocks = array())
    {
        // line 278
        ob_start();
        // line 279
        echo "    ";
        $context["widget_addon_append"] = twig_array_merge((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append")), array("text" => (($this->getAttribute((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : null), "text", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : null), "text", array()), "%")) : ("%"))));
        // line 280
        echo "    ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 284
    public function block_money_widget($context, array $blocks = array())
    {
        // line 285
        ob_start();
        // line 286
        echo "    ";
        $context["widget_addon_prepend"] = ((((((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")) != false) || ((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")) == null)) && ((isset($context["money_pattern"]) ? $context["money_pattern"] : $this->getContext($context, "money_pattern")) != "{{ widget }}"))) ? (array("text" => strtr((isset($context["money_pattern"]) ? $context["money_pattern"] : $this->getContext($context, "money_pattern")), array("{{ widget }}" => "")))) : (((array_key_exists("widget_addon_prepend", $context)) ? (_twig_default_filter((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")), null)) : (null))));
        // line 287
        echo "    ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 291
    public function block_file_widget($context, array $blocks = array())
    {
        // line 292
        ob_start();
        // line 293
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "file")) : ("file"));
        // line 294
        echo "<div class=\"";
        echo twig_escape_filter($this->env, (isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")), "html", null, true);
        echo "\">
    ";
        // line 295
        if ( !(null === ((array_key_exists("widget_addon_prepend", $context)) ? (_twig_default_filter((isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend")), null)) : (null)))) {
            // line 296
            echo "        ";
            $context["widget_addon"] = (isset($context["widget_addon_prepend"]) ? $context["widget_addon_prepend"] : $this->getContext($context, "widget_addon_prepend"));
            // line 297
            echo "        ";
            $this->displayBlock("widget_addon", $context, $blocks);
            echo "
    ";
        }
        // line 299
        echo "<input type=\"";
        echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "html", null, true);
        echo "\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo "/>
";
        // line 300
        if ((((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) != "hidden") &&  !(null === (($this->getAttribute((isset($context["widget_addon"]) ? $context["widget_addon"] : null), "type", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["widget_addon"]) ? $context["widget_addon"] : null), "type", array()), null)) : (null))))) {
            // line 301
            echo "    ";
            if ( !(null === ((array_key_exists("widget_addon_append", $context)) ? (_twig_default_filter((isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append")), null)) : (null)))) {
                // line 302
                echo "        ";
                $context["widget_addon"] = (isset($context["widget_addon_append"]) ? $context["widget_addon_append"] : $this->getContext($context, "widget_addon_append"));
                // line 303
                echo "        ";
                $this->displayBlock("widget_addon", $context, $blocks);
                echo "
    ";
            }
        }
        // line 306
        echo "</div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 312
    public function block_form_legend($context, array $blocks = array())
    {
        // line 313
        ob_start();
        // line 314
        echo "    ";
        if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
            // line 315
            echo "        ";
            $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
            // line 316
            echo "    ";
        }
        // line 317
        echo "    <legend>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
        echo "</legend>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 321
    public function block_form_label($context, array $blocks = array())
    {
        // line 322
        if ((!twig_in_filter("checkbox", (isset($context["block_prefixes"]) ? $context["block_prefixes"] : $this->getContext($context, "block_prefixes"))) || twig_in_filter((isset($context["widget_checkbox_label"]) ? $context["widget_checkbox_label"] : $this->getContext($context, "widget_checkbox_label")), array(0 => "label", 1 => "both")))) {
            // line 323
            ob_start();
            // line 324
            echo "    ";
            if ( !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false)) {
                // line 325
                echo "        ";
                if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
                    // line 326
                    echo "            ";
                    $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
                    // line 327
                    echo "        ";
                }
                // line 328
                echo "        ";
                if ( !(isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound"))) {
                    // line 329
                    echo "            ";
                    $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("for" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
                    // line 330
                    echo "        ";
                }
                // line 331
                echo "        ";
                $context["label_attr_class"] = " control-label ";
                // line 332
                echo "        ";
                if ((isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal"))) {
                    // line 333
                    echo "            ";
                    $context["label_attr_class"] = ((isset($context["label_attr_class"]) ? $context["label_attr_class"] : $this->getContext($context, "label_attr_class")) . (isset($context["horizontal_label_class"]) ? $context["horizontal_label_class"] : $this->getContext($context, "horizontal_label_class")));
                    // line 334
                    echo "        ";
                }
                // line 335
                echo "        ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => (((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . (isset($context["label_attr_class"]) ? $context["label_attr_class"] : $this->getContext($context, "label_attr_class"))) . (((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) ? (" required") : (" optional")))));
                // line 336
                echo "        <label";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
                foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                    echo " ";
                    echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                    echo "=\"";
                    echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                    echo "\"";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo ">
        ";
                // line 337
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                // line 338
                $this->displayBlock("label_asterisk", $context, $blocks);
                echo "
        ";
                // line 339
                if ((twig_in_filter("collection", $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "block_prefixes", array())) && ((array_key_exists("widget_add_btn", $context)) ? (_twig_default_filter((isset($context["widget_add_btn"]) ? $context["widget_add_btn"] : $this->getContext($context, "widget_add_btn")), null)) : (null)))) {
                    // line 340
                    echo "            ";
                    $this->displayBlock("form_widget_add_btn", $context, $blocks);
                    echo "
        ";
                }
                // line 342
                echo "        ";
                if ((isset($context["help_label"]) ? $context["help_label"] : $this->getContext($context, "help_label"))) {
                    // line 343
                    echo "            ";
                    $this->displayBlock("help_label", $context, $blocks);
                    echo "
        ";
                }
                // line 345
                echo "        ";
                if ($this->getAttribute((isset($context["help_label_tooltip"]) ? $context["help_label_tooltip"] : $this->getContext($context, "help_label_tooltip")), "title", array())) {
                    // line 346
                    echo "            ";
                    $this->displayBlock("help_label_tooltip", $context, $blocks);
                    echo "
        ";
                }
                // line 348
                echo "        ";
                if ($this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "title", array())) {
                    // line 349
                    echo "            ";
                    $this->displayBlock("help_label_popover", $context, $blocks);
                    echo "
        ";
                }
                // line 351
                echo "        </label>
    ";
            }
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        }
    }

    // line 357
    public function block_help_label($context, array $blocks = array())
    {
        // line 358
        echo "    <span class=\"help-block\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["help_label"]) ? $context["help_label"] : $this->getContext($context, "help_label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
        echo "</span>
";
    }

    // line 361
    public function block_help_label_tooltip($context, array $blocks = array())
    {
        // line 362
        echo "    <span class=\"help-block\">
        <a href=\"#\" data-toggle=\"tooltip\" data-placement=\"";
        // line 363
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help_label_tooltip"]) ? $context["help_label_tooltip"] : $this->getContext($context, "help_label_tooltip")), "placement", array()), "html", null, true);
        echo "\" data-title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["help_label_tooltip"]) ? $context["help_label_tooltip"] : $this->getContext($context, "help_label_tooltip")), "title", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
        echo "\">
            ";
        // line 364
        if ( !($this->getAttribute((isset($context["help_label_tooltip"]) ? $context["help_label_tooltip"] : $this->getContext($context, "help_label_tooltip")), "icon", array()) === false)) {
            // line 365
            echo "            <span class=\"glyphicon glyphicon-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help_label_tooltip"]) ? $context["help_label_tooltip"] : $this->getContext($context, "help_label_tooltip")), "icon", array()), "html", null, true);
            echo "\"></span>
            ";
        }
        // line 367
        echo "            ";
        if ( !($this->getAttribute((isset($context["help_label_tooltip"]) ? $context["help_label_tooltip"] : $this->getContext($context, "help_label_tooltip")), "text", array()) === null)) {
            // line 368
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help_label_tooltip"]) ? $context["help_label_tooltip"] : $this->getContext($context, "help_label_tooltip")), "text", array()), "html", null, true);
            echo "
            ";
        }
        // line 370
        echo "        </a>
    </span>
";
    }

    // line 374
    public function block_help_label_popover($context, array $blocks = array())
    {
        // line 375
        echo "    <span class=\"help-block\">
        <a href=\"#\" data-toggle=\"popover\" data-trigger=\"hover\" data-placement=\"";
        // line 376
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "placement", array()), "html", null, true);
        echo "\" data-title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "title", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
        echo "\" data-content=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "content", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
        echo "\" >
            ";
        // line 377
        if ( !($this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "icon", array()) === false)) {
            // line 378
            echo "            <span class=\"glyphicon glyphicon-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "icon", array()), "html", null, true);
            echo "\"></span>
            ";
        }
        // line 380
        echo "            ";
        if ( !($this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "text", array()) === null)) {
            // line 381
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["help_label_popover"]) ? $context["help_label_popover"] : $this->getContext($context, "help_label_popover")), "text", array()), "html", null, true);
            echo "
            ";
        }
        // line 383
        echo "        </a>
    </span>
";
    }

    // line 391
    public function block_form_rows_visible($context, array $blocks = array())
    {
        // line 392
        ob_start();
        // line 393
        echo "    ";
        if ($this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors')) {
            // line 394
            echo "        <div class=\"symfony-form-errors\">
            ";
            // line 395
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
        </div>
    ";
        }
        // line 398
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 399
            echo "        ";
            if (!twig_in_filter("hidden", $this->getAttribute($this->getAttribute($context["child"], "vars", array()), "block_prefixes", array()))) {
                echo " ";
                // line 400
                echo "            ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'row');
                echo "
        ";
            }
            // line 402
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 406
    public function block_form_row($context, array $blocks = array())
    {
        // line 407
        ob_start();
        // line 408
        echo "    ";
        if (twig_in_filter("tab", $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "block_prefixes", array()))) {
            // line 409
            echo "        ";
            $this->displayBlock("form_tab", $context, $blocks);
            echo "
    ";
        } else {
            // line 411
            echo "        ";
            $this->displayBlock("widget_form_group_start", $context, $blocks);
            echo "
        ";
            // line 412
            echo $this->env->getExtension('translator')->trans((isset($context["widget_prefix"]) ? $context["widget_prefix"] : $this->getContext($context, "widget_prefix")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain")));
            echo " ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget', $context);
            echo " ";
            echo $this->env->getExtension('translator')->trans((isset($context["widget_suffix"]) ? $context["widget_suffix"] : $this->getContext($context, "widget_suffix")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain")));
            echo "
        ";
            // line 413
            if ((twig_in_filter("collection", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array())) && ((array_key_exists("widget_remove_btn", $context)) ? (_twig_default_filter((isset($context["widget_remove_btn"]) ? $context["widget_remove_btn"] : $this->getContext($context, "widget_remove_btn")), null)) : (null)))) {
                // line 414
                echo "            ";
                $this->displayBlock("form_widget_remove_btn", $context, $blocks);
                echo "
        ";
            }
            // line 416
            $this->displayBlock("widget_form_group_end", $context, $blocks);
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 423
    public function block_form_message($context, array $blocks = array())
    {
        // line 424
        ob_start();
        // line 425
        echo "    ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
    ";
        // line 426
        $this->displayBlock("form_help", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 432
    public function block_form_help($context, array $blocks = array())
    {
        // line 433
        ob_start();
        // line 434
        if ((isset($context["help_block"]) ? $context["help_block"] : $this->getContext($context, "help_block"))) {
            echo "<p class=\"help-block\">";
            echo $this->env->getExtension('translator')->trans((isset($context["help_block"]) ? $context["help_block"] : $this->getContext($context, "help_block")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain")));
            echo "</p>";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 438
    public function block_form_widget_add_btn($context, array $blocks = array())
    {
        // line 439
        ob_start();
        // line 440
        echo "    ";
        if (((array_key_exists("widget_add_btn", $context)) ? (_twig_default_filter((isset($context["widget_add_btn"]) ? $context["widget_add_btn"] : $this->getContext($context, "widget_add_btn")), null)) : (null))) {
            // line 441
            echo "        ";
            $context["button_type"] = "add";
            // line 442
            echo "        ";
            $context["button_values"] = (isset($context["widget_add_btn"]) ? $context["widget_add_btn"] : $this->getContext($context, "widget_add_btn"));
            // line 443
            echo "        ";
            $this->displayBlock("collection_button", $context, $blocks);
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 448
    public function block_form_widget_remove_btn($context, array $blocks = array())
    {
        // line 449
        ob_start();
        // line 450
        echo "    ";
        if (((array_key_exists("widget_remove_btn", $context)) ? (_twig_default_filter((isset($context["widget_remove_btn"]) ? $context["widget_remove_btn"] : $this->getContext($context, "widget_remove_btn")), null)) : (null))) {
            // line 451
            echo "    ";
            $context["button_type"] = "remove";
            // line 452
            echo "    ";
            $context["button_values"] = (isset($context["widget_remove_btn"]) ? $context["widget_remove_btn"] : $this->getContext($context, "widget_remove_btn"));
            // line 453
            echo "    ";
            $this->displayBlock("collection_button", $context, $blocks);
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 458
    public function block_collection_button($context, array $blocks = array())
    {
        // line 459
        echo "<a ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["button_values"]) ? $context["button_values"] : $this->getContext($context, "button_values")), "attr", array()));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            echo " ";
            echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
            echo "\"";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " data-collection-";
        echo twig_escape_filter($this->env, (isset($context["button_type"]) ? $context["button_type"] : $this->getContext($context, "button_type")), "html", null, true);
        echo "-btn=\".";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "id", array(), "array"), "html", null, true);
        echo "_form_group\">
";
        // line 460
        if (($this->getAttribute((isset($context["button_values"]) ? $context["button_values"] : $this->getContext($context, "button_values")), "icon", array()) != "")) {
            // line 461
            echo "<span class=\"glyphicon glyphicon-";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["button_values"]) ? $context["button_values"] : $this->getContext($context, "button_values")), "icon", array()), "html", null, true);
            echo " ";
            if ( !(null === $this->getAttribute((isset($context["button_values"]) ? $context["button_values"] : $this->getContext($context, "button_values")), "icon_color", array()))) {
                echo "icon-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["button_values"]) ? $context["button_values"] : $this->getContext($context, "button_values")), "icon_color", array()), "html", null, true);
            }
            echo "\"></span>
";
        }
        // line 463
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["button_values"]) ? $context["button_values"] : $this->getContext($context, "button_values")), "label", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
        echo "
</a>

";
    }

    // line 468
    public function block_label_asterisk($context, array $blocks = array())
    {
        // line 469
        if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
            // line 470
            if ((isset($context["render_required_asterisk"]) ? $context["render_required_asterisk"] : $this->getContext($context, "render_required_asterisk"))) {
                echo " <span class=\"asterisk\">*</span>";
            }
        } else {
            // line 472
            if ((isset($context["render_optional_text"]) ? $context["render_optional_text"] : $this->getContext($context, "render_optional_text"))) {
                echo " <span>";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("(optional)", array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                echo "</span>";
            }
        }
    }

    // line 476
    public function block_widget_addon($context, array $blocks = array())
    {
        // line 477
        ob_start();
        // line 478
        $context["widget_addon_icon"] = (($this->getAttribute((isset($context["widget_addon"]) ? $context["widget_addon"] : null), "icon", array(), "any", true, true)) ? ($this->getAttribute((isset($context["widget_addon"]) ? $context["widget_addon"] : $this->getContext($context, "widget_addon")), "icon", array())) : (null));
        // line 479
        echo "    <span class=\"input-group-addon\">";
        echo (((($this->getAttribute((isset($context["widget_addon"]) ? $context["widget_addon"] : null), "text", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["widget_addon"]) ? $context["widget_addon"] : null), "text", array()), false)) : (false))) ? ($this->env->getExtension('translator')->trans($this->getAttribute((isset($context["widget_addon"]) ? $context["widget_addon"] : $this->getContext($context, "widget_addon")), "text", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain")))) : ($this->env->getExtension('mopa_bootstrap_icon')->renderIcon((isset($context["widget_addon_icon"]) ? $context["widget_addon_icon"] : $this->getContext($context, "widget_addon_icon")))));
        echo "</span>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 485
    public function block_form_errors($context, array $blocks = array())
    {
        // line 486
        ob_start();
        // line 487
        if ((isset($context["error_delay"]) ? $context["error_delay"] : $this->getContext($context, "error_delay"))) {
            // line 488
            echo "    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
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
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 489
                echo "        ";
                if (($this->getAttribute($context["loop"], "index", array()) == 1)) {
                    // line 490
                    echo "            ";
                    if ($this->getAttribute($context["child"], "set", array(0 => "errors", 1 => (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))), "method")) {
                    }
                    // line 491
                    echo "        ";
                }
                // line 492
                echo "    ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 494
            echo "    ";
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                // line 495
                echo "        ";
                if (($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) == null)) {
                    // line 496
                    echo "            ";
                    $context["__internal_448b7b27f4837804eea4ae49bb81c0bca8a40c8df931fb8bdd58c1ef8a3dbdfd"] = $this->env->loadTemplate("MopaBootstrapBundle::flash.html.twig");
                    // line 497
                    echo "            ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors")));
                    foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                        // line 498
                        echo "                ";
                        echo $context["__internal_448b7b27f4837804eea4ae49bb81c0bca8a40c8df931fb8bdd58c1ef8a3dbdfd"]->getflash("danger", (((null === $this->getAttribute(                        // line 499
$context["error"], "messagePluralization", array()))) ? ($this->env->getExtension('translator')->trans($this->getAttribute(                        // line 500
$context["error"], "messageTemplate", array()), $this->getAttribute($context["error"], "messageParameters", array()), "validators")) : ($this->env->getExtension('translator')->transchoice($this->getAttribute(                        // line 501
$context["error"], "messageTemplate", array()), $this->getAttribute($context["error"], "messagePluralization", array()), $this->getAttribute($context["error"], "messageParameters", array()), "validators"))));
                        // line 503
                        echo "
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 505
                    echo "        ";
                } else {
                    // line 506
                    echo "            <span class=\"help-";
                    $this->displayBlock("error_type", $context, $blocks);
                    echo "\">
            ";
                    // line 507
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors")));
                    foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                        // line 508
                        echo "                ";
                        echo twig_escape_filter($this->env, (((null === $this->getAttribute(                        // line 509
$context["error"], "messagePluralization", array()))) ? ($this->env->getExtension('translator')->trans($this->getAttribute(                        // line 510
$context["error"], "messageTemplate", array()), $this->getAttribute($context["error"], "messageParameters", array()), "validators")) : ($this->env->getExtension('translator')->transchoice($this->getAttribute(                        // line 511
$context["error"], "messageTemplate", array()), $this->getAttribute($context["error"], "messagePluralization", array()), $this->getAttribute($context["error"], "messageParameters", array()), "validators"))), "html", null, true);
                        // line 512
                        echo " <br>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 514
                    echo "            </span>
        ";
                }
                // line 516
                echo "    ";
            }
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 523
    public function block_error_type($context, array $blocks = array())
    {
        // line 524
        ob_start();
        // line 525
        if ((isset($context["error_type"]) ? $context["error_type"] : $this->getContext($context, "error_type"))) {
            // line 526
            echo "    ";
            echo twig_escape_filter($this->env, (isset($context["error_type"]) ? $context["error_type"] : $this->getContext($context, "error_type")), "html", null, true);
            echo "
";
        } elseif (($this->getAttribute(        // line 527
(isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) == null)) {
            // line 528
            echo "    ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "error_type", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "error_type", array()), "inline")) : ("inline")), "html", null, true);
            echo "
";
        } else {
            // line 530
            echo "    block
";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 537
    public function block_widget_form_group_start($context, array $blocks = array())
    {
        // line 538
        if ((((array_key_exists("widget_form_group", $context)) ? (_twig_default_filter((isset($context["widget_form_group"]) ? $context["widget_form_group"] : $this->getContext($context, "widget_form_group")), false)) : (false)) || ($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) == null))) {
            // line 539
            echo "    ";
            if (twig_in_filter("collection", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array()))) {
                echo " ";
                // line 540
                echo "        ";
                if ( !(isset($context["omit_collection_item"]) ? $context["omit_collection_item"] : $this->getContext($context, "omit_collection_item"))) {
                    // line 541
                    echo "        ";
                    $context["widget_form_group_attr"] = twig_array_merge((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")), array("class" => ($this->getAttribute((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")), "class", array()) . " collection-item")));
                    // line 542
                    echo "        ";
                }
                // line 543
                echo "    ";
            }
            // line 544
            echo "    ";
            if (array_key_exists("prototype", $context)) {
                // line 545
                echo "        ";
                $context["data_prototype_name"] = (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "form", array(), "any", false, true), "vars", array(), "any", false, true), "prototype", array(), "any", false, true), "vars", array(), "any", false, true), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array(), "any", false, true), "form", array(), "any", false, true), "vars", array(), "any", false, true), "prototype", array(), "any", false, true), "vars", array(), "any", false, true), "name", array()), "__name__")) : ("__name__"));
                // line 546
                echo "        ";
                $context["widget_form_group_attr"] = twig_array_merge(twig_array_merge((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")), array("data-prototype" => $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["prototype"]) ? $context["prototype"] : $this->getContext($context, "prototype")), 'row'), "data-prototype-name" => (isset($context["data_prototype_name"]) ? $context["data_prototype_name"] : $this->getContext($context, "data_prototype_name")))), (isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
                // line 547
                echo "    ";
            }
            // line 548
            echo "    ";
            // line 549
            echo "    ";
            $context["widget_form_group_attr"] = twig_array_merge((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")), array("class" => ((($this->getAttribute((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")), "class", array()) . " ") . (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))) . "_form_group")));
            // line 550
            echo "    ";
            if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
                // line 551
                echo "        ";
                $context["widget_form_group_attr"] = twig_array_merge((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")), array("class" => ((($this->getAttribute((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : null), "class", array()), "")) : ("")) . " has-error")));
                // line 552
                echo "    ";
            }
            // line 553
            echo "\t";
            if ((twig_in_filter("collection", $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "block_prefixes", array())) && $this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true))) {
                // line 554
                echo "\t\t";
                $context["widget_form_group_attr"] = twig_array_merge((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")), array("class" => (((($this->getAttribute((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : null), "class", array()), "row")) : ("row")) . " ") . $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "class", array()))));
                // line 555
                echo "\t";
            }
            // line 556
            echo "    <div";
            if ( !($this->getAttribute((isset($context["help_widget_popover"]) ? $context["help_widget_popover"] : $this->getContext($context, "help_widget_popover")), "title", array()) === null)) {
                $this->displayBlock("help_widget_popover", $context, $blocks);
            }
            echo " ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["widget_form_group_attr"]) ? $context["widget_form_group_attr"] : $this->getContext($context, "widget_form_group_attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">
    ";
            // line 558
            echo "    ";
            if ((((twig_length_filter($this->env, (isset($context["form"]) ? $context["form"] : $this->getContext($context, "form"))) > 0) && ($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null)) && !twig_in_filter("field", $this->getAttribute($this->getAttribute(            // line 559
(isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "block_prefixes", array())))) {
                // line 560
                echo "        ";
                if ((isset($context["show_child_legend"]) ? $context["show_child_legend"] : $this->getContext($context, "show_child_legend"))) {
                    // line 561
                    echo "            ";
                    $this->displayBlock("form_legend", $context, $blocks);
                    echo "
        ";
                } elseif (                // line 562
(isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render"))) {
                    // line 563
                    echo "            ";
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
                    echo "
        ";
                }
                // line 565
                echo "    ";
            } else {
                // line 566
                echo "        ";
                if ((isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render"))) {
                    // line 567
                    echo "            ";
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
                    echo "
        ";
                }
                // line 569
                echo "    ";
            }
        } else {
            // line 571
            echo "    ";
            if ((isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render"))) {
                // line 572
                echo "        ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label', (twig_test_empty($_label_ = ((array_key_exists("label", $context)) ? (_twig_default_filter((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), null)) : (null))) ? array() : array("label" => $_label_)));
                echo "
    ";
            }
        }
    }

    // line 577
    public function block_help_widget_popover($context, array $blocks = array())
    {
        // line 578
        echo " ";
        ob_start();
        // line 579
        echo " ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["help_widget_popover"]) ? $context["help_widget_popover"] : $this->getContext($context, "help_widget_popover")));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            // line 580
            echo " data-";
            echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
            echo "\"
 ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 582
        echo " ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 585
    public function block_widget_form_group_end($context, array $blocks = array())
    {
        // line 586
        ob_start();
        // line 587
        if ((((array_key_exists("widget_form_group", $context)) ? (_twig_default_filter((isset($context["widget_form_group"]) ? $context["widget_form_group"] : $this->getContext($context, "widget_form_group")), false)) : (false)) || ($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) == null))) {
            // line 588
            echo "    </div>
";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 593
    public function block_form_widget($context, array $blocks = array())
    {
        // line 594
        if (((isset($context["horizontal"]) ? $context["horizontal"] : $this->getContext($context, "horizontal")) &&  !(isset($context["label_render"]) ? $context["label_render"] : $this->getContext($context, "label_render")))) {
            // line 595
            echo "    ";
            $context["horizontal_input_wrapper_class"] = (((isset($context["horizontal_input_wrapper_class"]) ? $context["horizontal_input_wrapper_class"] : $this->getContext($context, "horizontal_input_wrapper_class")) . " ") . (isset($context["horizontal_label_offset_class"]) ? $context["horizontal_label_offset_class"] : $this->getContext($context, "horizontal_label_offset_class")));
        }
        // line 597
        $this->displayParentBlock("form_widget", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "MopaBootstrapBundle:Form:fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1659 => 597,  1655 => 595,  1653 => 594,  1650 => 593,  1643 => 588,  1641 => 587,  1639 => 586,  1636 => 585,  1631 => 582,  1620 => 580,  1615 => 579,  1612 => 578,  1609 => 577,  1600 => 572,  1597 => 571,  1593 => 569,  1587 => 567,  1584 => 566,  1581 => 565,  1575 => 563,  1573 => 562,  1568 => 561,  1565 => 560,  1563 => 559,  1561 => 558,  1541 => 556,  1538 => 555,  1535 => 554,  1532 => 553,  1529 => 552,  1526 => 551,  1523 => 550,  1520 => 549,  1518 => 548,  1515 => 547,  1512 => 546,  1509 => 545,  1506 => 544,  1503 => 543,  1500 => 542,  1497 => 541,  1494 => 540,  1490 => 539,  1488 => 538,  1485 => 537,  1478 => 530,  1472 => 528,  1470 => 527,  1465 => 526,  1463 => 525,  1461 => 524,  1458 => 523,  1451 => 516,  1447 => 514,  1440 => 512,  1438 => 511,  1437 => 510,  1436 => 509,  1434 => 508,  1430 => 507,  1425 => 506,  1422 => 505,  1415 => 503,  1413 => 501,  1412 => 500,  1411 => 499,  1409 => 498,  1404 => 497,  1401 => 496,  1398 => 495,  1395 => 494,  1380 => 492,  1377 => 491,  1373 => 490,  1370 => 489,  1352 => 488,  1350 => 487,  1348 => 486,  1345 => 485,  1337 => 479,  1335 => 478,  1333 => 477,  1330 => 476,  1321 => 472,  1316 => 470,  1314 => 469,  1311 => 468,  1303 => 463,  1292 => 461,  1290 => 460,  1270 => 459,  1267 => 458,  1258 => 453,  1255 => 452,  1252 => 451,  1249 => 450,  1247 => 449,  1244 => 448,  1235 => 443,  1232 => 442,  1229 => 441,  1226 => 440,  1224 => 439,  1221 => 438,  1212 => 434,  1210 => 433,  1207 => 432,  1200 => 426,  1195 => 425,  1193 => 424,  1190 => 423,  1182 => 416,  1176 => 414,  1174 => 413,  1166 => 412,  1161 => 411,  1155 => 409,  1152 => 408,  1150 => 407,  1147 => 406,  1138 => 402,  1132 => 400,  1128 => 399,  1123 => 398,  1117 => 395,  1114 => 394,  1111 => 393,  1109 => 392,  1106 => 391,  1100 => 383,  1094 => 381,  1091 => 380,  1085 => 378,  1083 => 377,  1075 => 376,  1072 => 375,  1069 => 374,  1063 => 370,  1057 => 368,  1054 => 367,  1048 => 365,  1046 => 364,  1040 => 363,  1037 => 362,  1034 => 361,  1027 => 358,  1024 => 357,  1016 => 351,  1010 => 349,  1007 => 348,  1001 => 346,  998 => 345,  992 => 343,  989 => 342,  983 => 340,  981 => 339,  977 => 338,  975 => 337,  959 => 336,  956 => 335,  953 => 334,  950 => 333,  947 => 332,  944 => 331,  941 => 330,  938 => 329,  935 => 328,  932 => 327,  929 => 326,  926 => 325,  923 => 324,  921 => 323,  919 => 322,  916 => 321,  908 => 317,  905 => 316,  902 => 315,  899 => 314,  897 => 313,  894 => 312,  888 => 306,  881 => 303,  878 => 302,  875 => 301,  873 => 300,  866 => 299,  860 => 297,  857 => 296,  855 => 295,  850 => 294,  848 => 293,  846 => 292,  843 => 291,  835 => 287,  832 => 286,  830 => 285,  827 => 284,  819 => 280,  816 => 279,  814 => 278,  811 => 277,  802 => 271,  798 => 270,  794 => 269,  790 => 268,  786 => 267,  781 => 266,  778 => 265,  772 => 263,  769 => 262,  767 => 261,  764 => 260,  755 => 255,  752 => 254,  746 => 252,  744 => 251,  740 => 250,  735 => 249,  732 => 248,  729 => 247,  723 => 245,  720 => 244,  718 => 243,  715 => 242,  707 => 237,  704 => 236,  702 => 235,  701 => 234,  700 => 233,  698 => 232,  695 => 231,  689 => 229,  683 => 227,  672 => 219,  667 => 217,  663 => 216,  659 => 214,  653 => 212,  650 => 211,  648 => 210,  639 => 209,  636 => 208,  630 => 206,  627 => 205,  625 => 204,  622 => 203,  619 => 202,  617 => 201,  615 => 200,  612 => 199,  603 => 193,  600 => 192,  598 => 191,  590 => 187,  587 => 186,  585 => 185,  572 => 184,  564 => 182,  562 => 181,  559 => 180,  552 => 177,  550 => 176,  546 => 174,  544 => 173,  542 => 172,  539 => 171,  532 => 166,  530 => 165,  525 => 164,  519 => 163,  515 => 161,  513 => 160,  508 => 158,  504 => 157,  488 => 156,  482 => 154,  479 => 153,  474 => 152,  468 => 150,  465 => 149,  462 => 148,  459 => 147,  456 => 146,  454 => 145,  451 => 144,  443 => 139,  440 => 138,  438 => 137,  435 => 136,  428 => 132,  421 => 131,  418 => 130,  412 => 126,  401 => 122,  395 => 121,  391 => 120,  384 => 119,  380 => 118,  375 => 117,  373 => 116,  370 => 115,  363 => 111,  361 => 110,  358 => 109,  352 => 105,  347 => 104,  345 => 103,  340 => 101,  337 => 100,  333 => 98,  331 => 97,  326 => 95,  323 => 94,  316 => 91,  314 => 90,  311 => 89,  308 => 88,  303 => 87,  298 => 86,  295 => 85,  293 => 84,  290 => 83,  280 => 77,  277 => 76,  273 => 74,  267 => 72,  264 => 71,  261 => 70,  259 => 69,  254 => 68,  251 => 67,  248 => 66,  245 => 65,  242 => 64,  239 => 63,  233 => 61,  230 => 60,  228 => 59,  225 => 58,  222 => 57,  216 => 55,  213 => 54,  210 => 53,  208 => 52,  205 => 51,  196 => 46,  194 => 45,  189 => 44,  183 => 42,  180 => 41,  177 => 40,  174 => 39,  171 => 38,  169 => 37,  166 => 36,  157 => 31,  155 => 30,  150 => 29,  144 => 27,  141 => 26,  138 => 25,  135 => 24,  132 => 23,  129 => 22,  126 => 21,  107 => 15,  100 => 14,  97 => 13,  94 => 12,  91 => 11,  89 => 10,  86 => 9,  79 => 6,  76 => 5,  73 => 4,  11 => 1,);
    }
}
