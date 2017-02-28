<?php

/* SonataProductBundle:Block:_base_products_block.html.twig */
class __TwigTemplate_4366a60145c343979972946a6ca50c2619b119c332adc68df753a9a01a49ad87 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates", array()), "block_base", array()));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        // line 14
        echo "    <section>
        <div class=\"row\">
            <div class=\"col-xs-6\">
                ";
        // line 17
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "title", array())) {
            // line 18
            echo "                    <h3>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "title", array()), "html", null, true);
            echo "</h3>
                ";
        }
        // line 20
        echo "            </div>

            <div class=\"col-xs-6\" style=\"text-align: right; margin-top:17px;\">
                <a class=\"btn btn-default\" href=\"";
        // line 23
        echo $this->env->getExtension('routing')->getUrl("sonata_catalog_index");
        echo "\"><span class=\"glyphicon glyphicon-list\"></span>&nbsp;";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("view_all_products", array(), "SonataProductBundle"), "html", null, true);
        echo "</a>
            </div>
        </div>

        <div class=\"row product-grid\">
            ";
        // line 28
        if ((twig_length_filter($this->env, (isset($context["products"]) ? $context["products"] : $this->getContext($context, "products"))) > 0)) {
            // line 29
            echo "                <ul class=\"thumbnails list-inline\">
                    ";
            // line 30
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["products"]) ? $context["products"] : $this->getContext($context, "products")));
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
                // line 31
                echo "
                        ";
                // line 32
                if (($this->env->getExtension('sonata_product')->hasEnabledVariations($context["product"]) ||  !$this->env->getExtension('sonata_product')->hasVariations($context["product"]))) {
                    // line 33
                    echo "                            <li class=\"col-sm-3\" itemscope itemtype=\"http://schema.org/Product\">
                                ";
                    // line 34
                    $this->env->loadTemplate("SonataProductBundle:Catalog:_product_grid.html.twig")->display($context);
                    // line 35
                    echo "                            </li>
                        ";
                }
                // line 37
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
            // line 39
            echo "                </ul>
            ";
        } else {
            // line 41
            echo "                <p>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_product_found", array(), "SonataProductBundle"), "html", null, true);
            echo "</p>
            ";
        }
        // line 43
        echo "        </div>
    </section>
";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Block:_base_products_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 43,  113 => 41,  109 => 39,  94 => 37,  90 => 35,  88 => 34,  85 => 33,  83 => 32,  80 => 31,  63 => 30,  60 => 29,  58 => 28,  48 => 23,  43 => 20,  37 => 18,  35 => 17,  30 => 14,  27 => 13,  18 => 11,);
    }
}
