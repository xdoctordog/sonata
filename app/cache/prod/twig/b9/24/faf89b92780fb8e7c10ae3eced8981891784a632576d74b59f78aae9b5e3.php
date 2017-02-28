<?php

/* SonataProductBundle:Product:form_basket_element.html.twig */
class __TwigTemplate_b924faf89b92780fb8e7c10ae3eced8981891784a632576d74b59f78aae9b5e3 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'product_error' => array($this, 'block_product_error'),
            'product_thumbnail' => array($this, 'block_product_thumbnail'),
            'product_name' => array($this, 'block_product_name'),
            'product_sku' => array($this, 'block_product_sku'),
            'product_variations' => array($this, 'block_product_variations'),
            'product_description' => array($this, 'block_product_description'),
            'product_unit_price' => array($this, 'block_product_unit_price'),
            'product_quantity' => array($this, 'block_product_quantity'),
            'product_total_inc' => array($this, 'block_product_total_inc'),
            'product_delete' => array($this, 'block_product_delete'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
<tr";
        // line 12
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "quantity", array()), "vars", array()), "errors", array())) > 0)) {
            echo " class=\"danger unavailable\"";
        }
        echo ">
    ";
        // line 13
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "vars", array()), "errors", array())) > 0)) {
            echo " ";
            // line 14
            echo "        <td colspan=\"4\">";
            $this->displayBlock('product_error', $context, $blocks);
            echo "</td>
    ";
        } else {
            // line 16
            echo "        <td>
            ";
            // line 17
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "productId", array()), 'widget');
            echo "
            <div class=\"col-sm-4 hidden-xs\">
                ";
            // line 19
            $this->displayBlock('product_thumbnail', $context, $blocks);
            // line 22
            echo "            </div>
            <div class=\"col-sm-8\">
                ";
            // line 24
            $this->displayBlock('product_name', $context, $blocks);
            // line 27
            echo "                ";
            $this->displayBlock('product_sku', $context, $blocks);
            // line 30
            echo "                ";
            $this->displayBlock('product_variations', $context, $blocks);
            // line 31
            echo "            </div>
            ";
            // line 32
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "quantity", array()), "vars", array()), "errors", array())) > 0)) {
                // line 33
                echo "                <span class=\"has-error\">";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "quantity", array()), 'errors');
                echo "</span>
            ";
            }
            // line 35
            echo "            ";
            $this->displayBlock('product_description', $context, $blocks);
            // line 36
            echo "        </td>
        <td class=\"number\">
            ";
            // line 38
            $this->displayBlock('product_unit_price', $context, $blocks);
            // line 41
            echo "        </td>
        <td>
            ";
            // line 43
            $this->displayBlock('product_quantity', $context, $blocks);
            // line 48
            echo "        </td>
        <td class=\"number\">
            ";
            // line 50
            $this->displayBlock('product_total_inc', $context, $blocks);
            // line 53
            echo "        </td>
    ";
        }
        // line 55
        echo "    <td>
        ";
        // line 56
        $this->displayBlock('product_delete', $context, $blocks);
        // line 59
        echo "    </td>
</tr>
";
    }

    // line 14
    public function block_product_error($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.basket.message_product_not_available", array(), "SonataProductBundle"), "html", null, true);
    }

    // line 19
    public function block_product_thumbnail($context, array $blocks = array())
    {
        // line 20
        echo "                    ";
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "product", array()), "image", array()), "preview", array("itemprop" => "image", "class" => "img-rounded img-responsive"));
        // line 21
        echo "                ";
    }

    // line 24
    public function block_product_name($context, array $blocks = array())
    {
        // line 25
        echo "                    <strong><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_product_view", array("productId" => $this->getAttribute($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "product", array()), "id", array()), "slug" => $this->getAttribute($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "product", array()), "slug", array()))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "name", array()), "html", null, true);
        echo "</a></strong>
                ";
    }

    // line 27
    public function block_product_sku($context, array $blocks = array())
    {
        // line 28
        echo "                    <p>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.product.sku", array(), "SonataProductBundle"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "product", array()), "sku", array()), "html", null, true);
        echo "</p>
                ";
    }

    // line 30
    public function block_product_variations($context, array $blocks = array())
    {
    }

    // line 35
    public function block_product_description($context, array $blocks = array())
    {
    }

    // line 38
    public function block_product_unit_price($context, array $blocks = array())
    {
        // line 39
        echo "                ";
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "getUnitPrice", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "
            ";
    }

    // line 43
    public function block_product_quantity($context, array $blocks = array())
    {
        // line 44
        echo "                <div";
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "quantity", array()), "vars", array()), "errors", array())) > 0)) {
            echo " class=\"has-error\"";
        }
        echo ">
                    ";
        // line 45
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "quantity", array()), 'widget', array("attr" => array("class" => "input-mini", "min" => 1), "horizontal_input_wrapper_class" => ""));
        echo "
                </div>
            ";
    }

    // line 50
    public function block_product_total_inc($context, array $blocks = array())
    {
        // line 51
        echo "                ";
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "getTotal", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "
            ";
    }

    // line 56
    public function block_product_delete($context, array $blocks = array())
    {
        // line 57
        echo "            ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["formView"]) ? $context["formView"] : null), "delete", array()), 'widget', array("label_render" => false, "horizontal_input_wrapper_class" => "text-center"));
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Product:form_basket_element.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 57,  203 => 56,  196 => 51,  193 => 50,  186 => 45,  179 => 44,  176 => 43,  169 => 39,  166 => 38,  161 => 35,  156 => 30,  147 => 28,  144 => 27,  135 => 25,  132 => 24,  128 => 21,  125 => 20,  122 => 19,  116 => 14,  110 => 59,  108 => 56,  105 => 55,  101 => 53,  99 => 50,  95 => 48,  93 => 43,  89 => 41,  87 => 38,  83 => 36,  80 => 35,  74 => 33,  72 => 32,  69 => 31,  66 => 30,  63 => 27,  61 => 24,  57 => 22,  55 => 19,  50 => 17,  47 => 16,  41 => 14,  38 => 13,  32 => 12,  29 => 11,);
    }
}
