<?php

/* SonataPageBundle:BlockAdmin:compose_preview.html.twig */
class __TwigTemplate_8a1a70b9b59b438106c5daea0de0b520e17d90c4e28f1ec11ebd9c89a1dafe1c extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        echo "<li class=\"page-composer__container__child\"
    data-block-id=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "id", array()), "html", null, true);
        echo "\"
    data-parent-block-id=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["container"]) ? $context["container"] : null), "id", array()), "html", null, true);
        echo "\"
    data-block-enabled=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "enabled", array()), "html", null, true);
        echo "\"
>
    <a class=\"page-composer__container__child__edit\"
       href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getAdminByAdminCode", array(0 => "sonata.page.admin.block"), "method"), "generateUrl", array(0 => "edit", 1 => array("id" => $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "id", array()), "composer" => true)), "method"), "html", null, true);
        echo "\"
    >
        <h4 class=\"page-composer__container__child__name\">";
        // line 9
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "name", array()), $this->getAttribute($this->getAttribute((isset($context["blockServices"]) ? $context["blockServices"] : null), $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "type", array())), "name", array()))) : ($this->getAttribute($this->getAttribute((isset($context["blockServices"]) ? $context["blockServices"] : null), $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "type", array())), "name", array()))), "html", null, true);
        echo "</h4>
        <small>";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["blockServices"]) ? $context["blockServices"] : null), $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "type", array())), "name", array()), "html", null, true);
        echo "</small>
        <span class=\"page-composer__container__child__toggle\">
            <i class=\"fa fa-chevron-down\"></i>
            <i class=\"fa fa-chevron-up\"></i>
        </span>
    </a>

    <div class=\"page-composer__container__child__right\">
        <div class=\"page-composer__container__child__remove\">
            <a class=\"badge\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getAdminByAdminCode", array(0 => "sonata.page.admin.block"), "method"), "generateUrl", array(0 => "delete", 1 => array("id" => $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "id", array()))), "method"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("composer.remove", array(), "SonataPageBundle"), "html", null, true);
        echo " <i class=\"fa fa-times\"></i> </a>
            <span class=\"page-composer__container__child__remove__confirm\">
                ";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("composer.remove.confirm", array(), "SonataPageBundle"), "html", null, true);
        echo "
                <span class=\"yes\">";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("yes", array(), "SonataPageBundle"), "html", null, true);
        echo "</span>
                <span class=\"cancel\">";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("cancel", array(), "SonataPageBundle"), "html", null, true);
        echo "</span>
            </span>
        </div>

        <div class=\"page-composer__container__child__switch-enabled\"
             data-label-enable=\"";
        // line 28
        echo twig_escape_filter($this->env, ($this->env->getExtension('translator')->trans("composer.enable", array(), "SonataPageBundle") . " <i class=\"fa fa-toggle-on\"></i>"));
        echo "\"
             data-label-disable=\"";
        // line 29
        echo twig_escape_filter($this->env, ($this->env->getExtension('translator')->trans("composer.disable", array(), "SonataPageBundle") . " <i class=\"fa fa-toggle-off\"></i>"));
        echo "\">
            <a class=\"badge bg-";
        // line 30
        echo (($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "enabled", array())) ? ("yellow") : ("green"));
        echo "\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_admin_set_object_field_value", array("objectId" => $this->getAttribute((isset($context["child"]) ? $context["child"] : null), "id", array()), "context" => "list", "field" => "enabled", "code" => "sonata.page.admin.block")), "html", null, true);
        echo "\">";
        if ($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "enabled", array())) {
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("composer.disable", array(), "SonataPageBundle"), "html", null, true);
            echo " <i class=\"fa fa-toggle-off\"></i>";
        } else {
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("composer.enable", array(), "SonataPageBundle"), "html", null, true);
            echo " <i class=\"fa fa-toggle-on\"></i>";
        }
        echo "</a>
        </div>

        <div class=\"page-composer__container__child__enabled\">
            <small class=\"badge bg-";
        // line 34
        echo (($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "enabled", array())) ? ("green") : ("yellow"));
        echo "\"><i class=\"fa fa-";
        echo (($this->getAttribute((isset($context["child"]) ? $context["child"] : null), "enabled", array())) ? ("check") : ("times"));
        echo "\"></i></small>
        </div>
    </div>

    <div class=\"page-composer__container__child__content\">
    </div>

    <div class=\"page-composer__container__child__loader\">
        <span>";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("loading", array(), "SonataPageBundle"), "html", null, true);
        echo "</span>
    </div>
</li>";
    }

    public function getTemplateName()
    {
        return "SonataPageBundle:BlockAdmin:compose_preview.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 42,  105 => 34,  88 => 30,  84 => 29,  80 => 28,  72 => 23,  68 => 22,  64 => 21,  57 => 19,  45 => 10,  41 => 9,  36 => 7,  30 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }
}
