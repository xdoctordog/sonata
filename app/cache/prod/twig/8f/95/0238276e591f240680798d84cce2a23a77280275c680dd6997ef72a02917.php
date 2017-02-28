<?php

/* SimpleThingsEntityAuditBundle:Audit:view_detail.html.twig */
class __TwigTemplate_8f950238276e591f240680798d84cce2a23a77280275c680dd6997ef72a02917 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("SimpleThingsEntityAuditBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'simplethings_entityaudit_content' => array($this, 'block_simplethings_entityaudit_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SimpleThingsEntityAuditBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_simplethings_entityaudit_content($context, array $blocks = array())
    {
        // line 4
        echo "<h1>Detail of ";
        echo twig_escape_filter($this->env, (isset($context["className"]) ? $context["className"] : null), "html", null, true);
        echo " with identifiers of ";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo " at revisions ";
        echo twig_escape_filter($this->env, (isset($context["rev"]) ? $context["rev"] : null), "html", null, true);
        echo "</h1>

<p><a href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("simple_things_entity_audit_viewentity", array("className" => (isset($context["className"]) ? $context["className"] : null), "id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "\">Compare revisions</a></p>
<table>
    <thead><tr>
        <th>Field</th>
        <th>Value</th>
    </tr></thead>
    <tbody>
    ";
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["data"]) ? $context["data"] : null));
        foreach ($context['_seq'] as $context["field"] => $context["value"]) {
            // line 14
            echo "    <tr>
        <td>";
            // line 15
            echo twig_escape_filter($this->env, $context["field"], "html", null, true);
            echo "</td>
        ";
            // line 16
            if ($this->getAttribute($context["value"], "timestamp", array(), "any", true, true)) {
                // line 17
                echo "        <td>";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $context["value"], "m/d/Y"), "html", null, true);
                echo "</td>
        ";
            } elseif (twig_test_iterable(            // line 18
$context["value"])) {
                // line 19
                echo "        <td>
            <ul>
                ";
                // line 21
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($context["value"]);
                foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                    // line 22
                    echo "                    <li>";
                    echo twig_escape_filter($this->env, $context["element"], "html", null, true);
                    echo "</li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 24
                echo "            </ul>
        </td>
        ";
            } else {
                // line 27
                echo "        <td>";
                echo twig_escape_filter($this->env, $context["value"], "html", null, true);
                echo "</td>
        ";
            }
            // line 29
            echo "    </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['field'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "    </tbody>
</table>

";
    }

    public function getTemplateName()
    {
        return "SimpleThingsEntityAuditBundle:Audit:view_detail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 31,  107 => 29,  101 => 27,  96 => 24,  87 => 22,  83 => 21,  79 => 19,  77 => 18,  72 => 17,  70 => 16,  66 => 15,  63 => 14,  59 => 13,  49 => 6,  39 => 4,  36 => 3,  11 => 1,);
    }
}
