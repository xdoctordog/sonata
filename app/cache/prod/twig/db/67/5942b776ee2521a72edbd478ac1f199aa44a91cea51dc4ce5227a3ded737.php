<?php

/* SonataCustomerBundle:Addresses:new.html.twig */
class __TwigTemplate_db675942b776ee2521a72edbd478ac1f199aa44a91cea51dc4ce5227a3ded737 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        try {
            $this->parent = $this->env->loadTemplate("SonataUserBundle:Profile:action.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(11);

            throw $e;
        }

        $this->blocks = array(
            'sonata_profile_title' => array($this, 'block_sonata_profile_title'),
            'sonata_profile_content' => array($this, 'block_sonata_profile_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataUserBundle:Profile:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_sonata_profile_title($context, array $blocks = array())
    {
        echo $this->env->getExtension('translator')->getTranslator()->trans("address_new", array(), "SonataCustomerBundle");
    }

    // line 15
    public function block_sonata_profile_content($context, array $blocks = array())
    {
        // line 16
        echo "
";
        // line 17
        // token for sonata_template_box, however the box is disabled
        // line 18
        echo "
";
        // line 19
        $this->env->getExtension('form')->renderer->setTheme((isset($context["form"]) ? $context["form"] : null), array(0 => "SonataCustomerBundle:Form:label.html.twig"));
        // line 20
        echo "
";
        // line 21
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form_start', array("attr" => array("class" => "form-horizontal")));
        echo "
    ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
        echo "
    ";
        // line 23
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'rest');
        echo "
    <div class=\"form-actions\">
        <button type=\"submit\" class=\"btn btn-success pull-right\">";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.customer.address.save", array(), "SonataCustomerBundle"), "html", null, true);
        echo "</button>
    </div>
";
        // line 27
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : null), 'form_end');
        echo "

";
    }

    public function getTemplateName()
    {
        return "SonataCustomerBundle:Addresses:new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 27,  72 => 25,  67 => 23,  63 => 22,  59 => 21,  56 => 20,  54 => 19,  51 => 18,  49 => 17,  46 => 16,  43 => 15,  37 => 13,  11 => 11,);
    }
}
