<?php

/* SonataPageBundle:PageAdmin:compose_container_show.html.twig */
class __TwigTemplate_013fdfc3fc043ffeff9f8ba60b556b7ca13cedca8e421bc7f3d158ff61f07bc9 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 1
        echo "<div class=\"page-composer__container__view block-view-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["container"]) ? $context["container"] : null), "id", array()), "html", null, true);
        echo "\"
     data-block-id=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["container"]) ? $context["container"] : null), "id", array()), "html", null, true);
        echo "\"
>
    <h2 class=\"page-composer__container__view__header\">";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["container"]) ? $context["container"] : null), "name", array()), "html", null, true);
        echo "</h2>

    <span class=\"page-composer__container__view__notice\">";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("notice", array(), "SonataPageBundle"), "html", null, true);
        echo "</span>

    <div class=\"page-composer__block-type-selector\">
        <label>";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("composer.block.add.type", array(), "SonataPageBundle"), "html", null, true);
        echo "</label>
        <select class=\"page-composer__block-type-selector__select\" style=\"width: auto\">
            ";
        // line 11
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blockServices"]) ? $context["blockServices"] : null));
        foreach ($context['_seq'] as $context["blockServiceId"] => $context["blockService"]) {
            // line 12
            echo "                <option value=\"";
            echo twig_escape_filter($this->env, $context["blockServiceId"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["blockService"], "name", array()), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['blockServiceId'], $context['blockService'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "        </select>
        <a class=\"btn btn-action btn-small page-composer__block-type-selector__confirm\"
           href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateObjectUrl", array(0 => "sonata.page.admin.block.create", 1 => (isset($context["page"]) ? $context["page"] : null), 2 => array("composer" => true)), "method"), "html", null, true);
        echo "\"
        ><i class=\"fa fa-plus\"></i></a>
        <span class=\"page-composer__block-type-selector__loader\">";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("loading", array(), "SonataPageBundle"), "html", null, true);
        echo "</span>

        <small class=\"page-composer__container__child-count pull-right\">
            ";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("blocks", array(), "SonataPageBundle"), "html", null, true);
        echo " <span class=\"badge\">";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["container"]) ? $context["container"] : null), "children", array())), "html", null, true);
        echo "</span>
        </small>
    </div>

    <ul class=\"page-composer__container__children\">
        ";
        // line 26
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["container"]) ? $context["container"] : null), "children", array()));
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
            // line 27
            echo "            ";
            $this->env->loadTemplate("SonataPageBundle:BlockAdmin:compose_preview.html.twig")->display($context);
            // line 28
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "    </ul>
</div>";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:PageAdmin:compose_container_show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 29,  105 => 28,  102 => 27,  85 => 26,  75 => 21,  69 => 18,  64 => 16,  60 => 14,  49 => 12,  45 => 11,  40 => 9,  34 => 6,  29 => 4,  24 => 2,  19 => 1,);
    }
}
