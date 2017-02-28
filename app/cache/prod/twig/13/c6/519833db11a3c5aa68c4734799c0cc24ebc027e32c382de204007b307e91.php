<?php

/* ApplicationSonataPageBundle::demo_layout.html.twig */
class __TwigTemplate_13c6519833db11a3c5aa68c4734799c0cc24ebc027e32c382de204007b307e91 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        try {
            $this->parent = $this->env->loadTemplate("SonataPageBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(11);

            throw $e;
        }

        $this->blocks = array(
            'sonata_page_body_tag' => array($this, 'block_sonata_page_body_tag'),
            'sonata_page_javascripts' => array($this, 'block_sonata_page_javascripts'),
            'sonata_page_container' => array($this, 'block_sonata_page_container'),
            'sonata_page_breadcrumb' => array($this, 'block_sonata_page_breadcrumb'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataPageBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_sonata_page_body_tag($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        $this->displayParentBlock("sonata_page_body_tag", $context, $blocks);
        echo "

    ";
        // line 16
        $this->env->loadTemplate("SonataSeoBundle:Block:_facebook_sdk.html.twig")->display($context);
        // line 17
        echo "    ";
        $this->env->loadTemplate("SonataSeoBundle:Block:_twitter_sdk.html.twig")->display($context);
        // line 18
        echo "    ";
        $this->env->loadTemplate("SonataSeoBundle:Block:_pinterest_sdk.html.twig")->display($context);
        // line 19
        echo "
";
    }

    // line 22
    public function block_sonata_page_javascripts($context, array $blocks = array())
    {
        // line 23
        echo "    <script type=\"text/javascript\">
        var basket_update_confirmation_message = '";
        // line 24
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata_basket_update_confirmation", array(), "SonataDemoBundle"), "js"), "html", null, true);
        echo "';
    </script>

    <script src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assetic/sonata_front_js.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
";
    }

    // line 30
    public function block_sonata_page_container($context, array $blocks = array())
    {
        // line 31
        echo "    <div class=\"demonstration-bar\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sonata.demo.demonstration.message", array(), "SonataDemoBundle"), "html", null, true);
        echo "</div>

    <a href=\"https://github.com/sonata-project\"><img style=\"position: absolute; top: 0; right: 0; border: 0;\" src=\"https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png\" alt=\"Fork me on GitHub\"></a>

    ";
        // line 35
        $this->displayParentBlock("sonata_page_container", $context, $blocks);
        echo "
";
    }

    // line 38
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "ApplicationSonataPageBundle::demo_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 38,  90 => 35,  82 => 31,  79 => 30,  73 => 27,  67 => 24,  64 => 23,  61 => 22,  56 => 19,  53 => 18,  50 => 17,  48 => 16,  42 => 14,  39 => 13,  11 => 11,);
    }
}
