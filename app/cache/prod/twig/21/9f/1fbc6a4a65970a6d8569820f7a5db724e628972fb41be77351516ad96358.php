<?php

/* SonataProductBundle:Catalog:grid.html.twig */
class __TwigTemplate_219f1fbc6a4a65970a6d8569820f7a5db724e628972fb41be77351516ad96358 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
<div class=\"panel-body product-grid\">

    ";
        // line 14
        // token for sonata_template_box, however the box is disabled
        // line 15
        echo "
    ";
        // line 16
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pager"]) ? $context["pager"] : null));
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
            // line 17
            echo "
        ";
            // line 18
            if (( !$this->env->getExtension('sonata_product')->hasVariations($context["product"]) || ($this->env->getExtension('sonata_product')->hasVariations($context["product"]) && $this->env->getExtension('sonata_product')->hasEnabledVariations($context["product"])))) {
                // line 19
                echo "
            <div class=\"col-sm-4\" itemscope itemtype=\"http://schema.org/Product\">
                ";
                // line 21
                $this->env->loadTemplate("SonataProductBundle:Catalog:_product_grid.html.twig")->display($context);
                // line 22
                echo "            </div>

        ";
            }
            // line 25
            echo "
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
        // line 27
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Catalog:grid.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 27,  62 => 25,  57 => 22,  55 => 21,  51 => 19,  49 => 18,  46 => 17,  29 => 16,  26 => 15,  24 => 14,  19 => 11,);
    }
}
