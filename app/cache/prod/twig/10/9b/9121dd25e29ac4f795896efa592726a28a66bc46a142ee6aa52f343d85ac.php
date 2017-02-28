<?php

/* SonataOrderBundle:OrderAdmin:invoice_generate_confirm.html.twig */
class __TwigTemplate_109b9121dd25e29ac4f795896efa592726a28a66bc46a142ee6aa52f343d85ac extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        try {
            $this->parent = $this->env->loadTemplate("SonataAdminBundle::standard_layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(12);

            throw $e;
        }

        $this->blocks = array(
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::standard_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 15
        echo "    <div class=\"alert alert-info col-sm-6\">
        <h4>";
        // line 16
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.invoice_generate_confirm_title", array(), "SonataOrderBundle");
        echo "</h4>
        <p>";
        // line 17
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.invoice_generate_confirm_message", array(), "SonataOrderBundle");
        echo "</p>
        <p>
            <a href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_sonata_order_order_edit", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-arrow-left\"></i>&nbsp;";
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.invoice_generate_confirm_cancel", array(), "SonataOrderBundle");
        echo "</a>
            <a href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_sonata_order_order_generateInvoice", array("id" => (isset($context["id"]) ? $context["id"] : null), "confirm" => "yes")), "html", null, true);
        echo "\" class=\"btn btn-success pull-right\">";
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.order.invoice_generate_confirm_confirm", array(), "SonataOrderBundle");
        echo "</a>
        </p>
    </div>
";
    }

    public function getTemplateName()
    {
        return "SonataOrderBundle:OrderAdmin:invoice_generate_confirm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 20,  51 => 19,  46 => 17,  42 => 16,  39 => 15,  36 => 14,  11 => 12,);
    }
}
