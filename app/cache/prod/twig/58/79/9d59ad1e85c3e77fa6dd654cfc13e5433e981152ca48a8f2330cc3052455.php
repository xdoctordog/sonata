<?php

/* SonataCustomerBundle:Addresses:_address.html.twig */
class __TwigTemplate_58799d59ad1e85c3e77fa6dd654cfc13e5433e981152ca48a8f2330cc3052455 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_address_render' => array($this, 'block_sonata_address_render'),
            'sonata_address_name' => array($this, 'block_sonata_address_name'),
            'sonata_address_address' => array($this, 'block_sonata_address_address'),
            'sonata_address_edit' => array($this, 'block_sonata_address_edit'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        ob_start();
        // line 2
        $this->displayBlock('sonata_address_render', $context, $blocks);
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function block_sonata_address_render($context, array $blocks = array())
    {
        // line 3
        echo "    <div class=\"row\">
        <div class=\"col-sm-";
        // line 4
        if ((isset($context["showEdit"]) ? $context["showEdit"] : null)) {
            echo "8";
        } else {
            echo "12";
        }
        echo "\">
            <address>
                ";
        // line 6
        $this->displayBlock('sonata_address_name', $context, $blocks);
        // line 9
        echo "                ";
        $this->displayBlock('sonata_address_address', $context, $blocks);
        // line 12
        echo "            </address>
        </div>
        ";
        // line 14
        $this->displayBlock('sonata_address_edit', $context, $blocks);
        // line 21
        echo "    </div>
";
    }

    // line 6
    public function block_sonata_address_name($context, array $blocks = array())
    {
        // line 7
        echo "                    ";
        if ((isset($context["showName"]) ? $context["showName"] : null)) {
            echo "<strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["address"]) ? $context["address"] : null), "name", array()), "html", null, true);
            echo "</strong><br/>";
        }
        // line 8
        echo "                ";
    }

    // line 9
    public function block_sonata_address_address($context, array $blocks = array())
    {
        // line 10
        echo "                    ";
        echo $this->getAttribute((isset($context["address"]) ? $context["address"] : null), "address", array());
        echo "
                ";
    }

    // line 14
    public function block_sonata_address_edit($context, array $blocks = array())
    {
        // line 15
        echo "            ";
        if ((isset($context["showEdit"]) ? $context["showEdit"] : null)) {
            // line 16
            echo "                <div class=\"col-sm-3\">
                    <a class=\"btn btn-primary btn-xs pull-right\" href=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_customer_address_edit", array("id" => $this->getAttribute((isset($context["address"]) ? $context["address"] : null), "id", array()), "context" => (isset($context["context"]) ? $context["context"] : null))), "html", null, true);
            echo "\"><span class=\"glyphicon glyphicon-pencil\">&nbsp;</span>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata_customer_address_edit", array(), "SonataCustomerBundle"), "html", null, true);
            echo "</a>
                </div>
            ";
        }
        // line 20
        echo "        ";
    }

    public function getTemplateName()
    {
        return "SonataCustomerBundle:Addresses:_address.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  101 => 20,  93 => 17,  90 => 16,  87 => 15,  84 => 14,  77 => 10,  74 => 9,  70 => 8,  63 => 7,  60 => 6,  55 => 21,  53 => 14,  49 => 12,  46 => 9,  44 => 6,  35 => 4,  32 => 3,  25 => 2,  23 => 1,);
    }
}
