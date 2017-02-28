<?php

/* SonataProductBundle:Block:variations_choice.html.twig */
class __TwigTemplate_eb72474fc170d6baa6123cc5d82f9e11b8c472194beea6ca7aa1dbc633d96fa4 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'product_variation_javascript_init' => array($this, 'block_product_variation_javascript_init'),
            'product_variation_form' => array($this, 'block_product_variation_form'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $this->displayBlock('product_variation_javascript_init', $context, $blocks);
        // line 32
        echo "

";
        // line 34
        $this->displayBlock('product_variation_form', $context, $blocks);
    }

    // line 12
    public function block_product_variation_javascript_init($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        if ( !((isset($context["form"]) ? $context["form"] : null) === null)) {
            // line 14
            echo "        ";
            $context["variationIds"] = array();
            // line 15
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["formItem"]) {
                // line 16
                echo "            ";
                $context["variationIds"] = twig_array_merge((isset($context["variationIds"]) ? $context["variationIds"] : null), array(0 => (("\$('#" . $this->getAttribute($this->getAttribute($context["formItem"], "vars", array()), "id", array())) . "')")));
                // line 17
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['formItem'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "
        <script type=\"text/javascript\">
            jQuery(document).ready(function() {
                Sonata.Product.setOptions({
                    variations: {
                        fields: [";
            // line 23
            echo twig_join_filter((isset($context["variationIds"]) ? $context["variationIds"] : null), ", ");
            echo "],
                        form: \$('#sonata_variation_form'),
                        unavailableError: \$('#sonata_variation_error')
                    }});
                Sonata.Product.initVariation();
            });
        </script>
    ";
        }
    }

    // line 34
    public function block_product_variation_form($context, array $blocks = array())
    {
        // line 35
        echo "    <div class=\"alert alert-danger\" id=\"sonata_variation_error\"";
        if ( !($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "product", array()) === null)) {
            echo " style=\"display:none;\"";
        }
        echo ">";
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "product", array()) === null)) {
            echo $this->env->getExtension('translator')->getTranslator()->trans("no_product_found", array(), "SonataProductBundle");
        }
        echo "</div>

    ";
        // line 37
        if ( !($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "product", array()) === null)) {
            // line 38
            echo "        <form action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "form_route", array()), $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "form_route_parameters", array())), "html", null, true);
            echo "\" id=\"sonata_variation_form\" class=\"form-horizontal\" role=\"form\">
            ";
            // line 39
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
            echo "
        </form>
    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Block:variations_choice.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  99 => 39,  94 => 38,  92 => 37,  80 => 35,  77 => 34,  64 => 23,  57 => 18,  51 => 17,  48 => 16,  43 => 15,  40 => 14,  37 => 13,  34 => 12,  30 => 34,  26 => 32,  24 => 12,  21 => 11,);
    }
}
