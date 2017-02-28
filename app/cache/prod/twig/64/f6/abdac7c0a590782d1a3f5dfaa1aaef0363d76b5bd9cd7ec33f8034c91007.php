<?php

/* SonataProductBundle:Product:final_review_basket_element.html.twig */
class __TwigTemplate_64f6abdac7c0a590782d1a3f5dfaa1aaef0363d76b5bd9cd7ec33f8034c91007 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'product_thumbnail' => array($this, 'block_product_thumbnail'),
            'product_name' => array($this, 'block_product_name'),
            'product_sku' => array($this, 'block_product_sku'),
            'product_description' => array($this, 'block_product_description'),
            'product_variations' => array($this, 'block_product_variations'),
            'product_unit_price' => array($this, 'block_product_unit_price'),
            'product_quantity' => array($this, 'block_product_quantity'),
            'product_total' => array($this, 'block_product_total'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
<tr>
    <td>
        ";
        // line 14
        $this->displayBlock('product_thumbnail', $context, $blocks);
        // line 17
        echo "    </td>
    <td>
        ";
        // line 19
        $this->displayBlock('product_name', $context, $blocks);
        // line 22
        echo "        ";
        $this->displayBlock('product_sku', $context, $blocks);
        // line 25
        echo "        ";
        $this->displayBlock('product_description', $context, $blocks);
        // line 26
        echo "        ";
        $this->displayBlock('product_variations', $context, $blocks);
        // line 27
        echo "    </td>
    <td class=\"number\">
        ";
        // line 29
        $this->displayBlock('product_unit_price', $context, $blocks);
        // line 32
        echo "    </td>
    <td class=\"number\">
        ";
        // line 34
        $this->displayBlock('product_quantity', $context, $blocks);
        // line 37
        echo "    </td>
    <td class=\"number\">
        ";
        // line 39
        $this->displayBlock('product_total', $context, $blocks);
        // line 42
        echo "    </td>
</tr>
";
    }

    // line 14
    public function block_product_thumbnail($context, array $blocks = array())
    {
        // line 15
        echo "            ";
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "product", array()), "image", array()), "preview", array("itemprop" => "image", "class" => "img-rounded img-responsive"));
        // line 16
        echo "        ";
    }

    // line 19
    public function block_product_name($context, array $blocks = array())
    {
        // line 20
        echo "            <strong>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "name", array()), "html", null, true);
        echo "</strong>
        ";
    }

    // line 22
    public function block_product_sku($context, array $blocks = array())
    {
        // line 23
        echo "            <p>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.product.sku", array(), "SonataProductBundle"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "product", array()), "sku", array()), "html", null, true);
        echo "</p>
        ";
    }

    // line 25
    public function block_product_description($context, array $blocks = array())
    {
    }

    // line 26
    public function block_product_variations($context, array $blocks = array())
    {
    }

    // line 29
    public function block_product_unit_price($context, array $blocks = array())
    {
        // line 30
        echo "            ";
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "getUnitPrice", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "
        ";
    }

    // line 34
    public function block_product_quantity($context, array $blocks = array())
    {
        // line 35
        echo "            ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "quantity", array()), "html", null, true);
        echo "
        ";
    }

    // line 39
    public function block_product_total($context, array $blocks = array())
    {
        // line 40
        echo "            ";
        echo $this->env->getExtension('sonata_intl_number')->formatCurrency($this->getAttribute((isset($context["basketElement"]) ? $context["basketElement"] : null), "getTotal", array(0 => true), "method"), $this->getAttribute($this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "currency", array()), "label", array()), array(), array(), $this->getAttribute((isset($context["basket"]) ? $context["basket"] : null), "locale", array()));
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Product:final_review_basket_element.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  138 => 40,  135 => 39,  128 => 35,  125 => 34,  118 => 30,  115 => 29,  110 => 26,  105 => 25,  96 => 23,  93 => 22,  86 => 20,  83 => 19,  79 => 16,  76 => 15,  73 => 14,  67 => 42,  65 => 39,  61 => 37,  59 => 34,  55 => 32,  53 => 29,  49 => 27,  46 => 26,  43 => 25,  40 => 22,  38 => 19,  34 => 17,  32 => 14,  27 => 11,);
    }
}
