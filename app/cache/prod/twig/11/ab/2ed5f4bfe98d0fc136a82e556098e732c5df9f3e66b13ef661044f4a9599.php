<?php

/* SonataDatagridBundle:Search:results.html.twig */
class __TwigTemplate_11ab2ed5f4bfe98d0fc136a82e556098e732c5df9f3e66b13ef661044f4a9599 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "<div class=\"row\">
    <form name=\"search\" method=\"get\" action=\"";
        // line 2
        echo $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : null));
        echo "\">
        <div class=\"row\">
            ";
        // line 4
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "search", array()), 'widget');
        echo "
        </div>

        <div class=\"row\">
            ";
        // line 8
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "priceStart", array()), 'widget', array("horizontal_input_wrapper_class" => "col-sm-3", "attr" => array("min" => 1, "class" => "form-control", "placeholder" => "Start from")));
        // line 12
        echo "

            ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "priceEnd", array()), 'widget', array("horizontal_input_wrapper_class" => "col-sm-3", "attr" => array("min" => 1, "class" => "form-control", "placeholder" => "End to")));
        // line 18
        echo "
        </div>

        <div class=\"row\">
            ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "sort", array()), 'widget', array("horizontal_input_wrapper_class" => "col-sm-3"));
        echo "
        </div>

        <div class=\"row col-sm-3\">
            <input class=\"btn btn-primary\" type=\"submit\" value=\"Search\" />
        </div>
    </form>
</div>

<div class=\"row text-center\">
    ";
        // line 32
        $this->env->loadTemplate("SonataDatagridBundle:Search:pager.html.twig")->display($context);
        // line 33
        echo "</div>

<div class=\"row\">
    ";
        // line 36
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["results"]) ? $context["results"] : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 37
            echo "        <div class=\"col-sm-4\" itemscope itemtype=\"http://schema.org/Product\">
            ";
            // line 38
            $this->env->loadTemplate("SonataProductBundle:Catalog:_product_grid.html.twig")->display($context);
            // line 39
            echo "        </div>
    ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "SonataDatagridBundle:Search:results.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 41,  90 => 39,  88 => 38,  85 => 37,  68 => 36,  63 => 33,  61 => 32,  48 => 22,  42 => 18,  40 => 14,  36 => 12,  34 => 8,  27 => 4,  22 => 2,  19 => 1,);
    }
}
