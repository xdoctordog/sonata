<?php

/* SonataCustomerBundle:Addresses:list.html.twig */
class __TwigTemplate_7f826fd0bda643ec782374f19ec904a0781ad81c61fe7c049d683c0d0fa914a8 extends Sonata\CacheBundle\Twig\TwigTemplate14
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("SonataUserBundle:Profile:action.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'sonata_profile_title' => array($this, 'block_sonata_profile_title'),
            'sonata_profile_content' => array($this, 'block_sonata_profile_content'),
            'sonata_flash_messages' => array($this, 'block_sonata_flash_messages'),
            'sonata_profile_address_actions' => array($this, 'block_sonata_profile_address_actions'),
            'sonata_profile_address_list' => array($this, 'block_sonata_profile_address_list'),
            'sonata_profile_address_typelist' => array($this, 'block_sonata_profile_address_typelist'),
            'sonata_profile_address_table_headers' => array($this, 'block_sonata_profile_address_table_headers'),
            'sonata_profile_address_row' => array($this, 'block_sonata_profile_address_row'),
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

    // line 4
    public function block_sonata_profile_title($context, array $blocks = array())
    {
        echo $this->env->getExtension('translator')->getTranslator()->trans("address_list", array(), "SonataCustomerBundle");
    }

    // line 6
    public function block_sonata_profile_content($context, array $blocks = array())
    {
        // line 7
        echo "
    ";
        // line 8
        // token for sonata_template_box, however the box is disabled
        // line 9
        echo "
    ";
        // line 10
        $this->displayBlock('sonata_flash_messages', $context, $blocks);
        // line 13
        echo "
    ";
        // line 14
        $this->displayBlock('sonata_profile_address_actions', $context, $blocks);
        // line 21
        echo "
    ";
        // line 22
        $this->displayBlock('sonata_profile_address_list', $context, $blocks);
        // line 76
        echo "
";
    }

    // line 10
    public function block_sonata_flash_messages($context, array $blocks = array())
    {
        // line 11
        echo "        ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display(array_merge($context, array("domain" => "SonataCustomerBundle")));
        // line 12
        echo "    ";
    }

    // line 14
    public function block_sonata_profile_address_actions($context, array $blocks = array())
    {
        // line 15
        echo "        <div class=\"panel\" style=\"height: 35px;\">
            <div class=\"pull-right btn-group\">
                <a class=\"btn btn-success\" href=\"";
        // line 17
        echo $this->env->getExtension('routing')->getUrl("sonata_customer_address_add");
        echo "\"><i class=\"glyphicon glyphicon-plus-sign icon-white\"></i>&nbsp;";
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.address.list.add", array(), "SonataCustomerBundle");
        echo "</a>
            </div>
        </div>
    ";
    }

    // line 22
    public function block_sonata_profile_address_list($context, array $blocks = array())
    {
        // line 23
        echo "
        ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["addresses"]) ? $context["addresses"] : null));
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
        foreach ($context['_seq'] as $context["type"] => $context["addressesByType"]) {
            // line 25
            echo "
            ";
            // line 26
            $this->displayBlock('sonata_profile_address_typelist', $context, $blocks);
            // line 73
            echo "        ";
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
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['addressesByType'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "
    ";
    }

    // line 26
    public function block_sonata_profile_address_typelist($context, array $blocks = array())
    {
        // line 27
        echo "                <div class=\"panel panel-default\">
                    <div class=\"panel-heading\"><h3 class=\"panel-title\">";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["type"]) ? $context["type"] : null), array(), "SonataCustomerBundle"), "html", null, true);
        echo "</h3></div>

                    ";
        // line 30
        if ((twig_length_filter($this->env, (isset($context["addressesByType"]) ? $context["addressesByType"] : null)) > 0)) {
            // line 31
            echo "                        <table class=\"table\">
                            ";
            // line 32
            $this->displayBlock('sonata_profile_address_table_headers', $context, $blocks);
            // line 38
            echo "
                            ";
            // line 39
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["addressesByType"]) ? $context["addressesByType"] : null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["address"]) {
                // line 40
                echo "                                ";
                $this->displayBlock('sonata_profile_address_row', $context, $blocks);
                // line 63
                echo "                            ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['address'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 64
            echo "                        </table>
                    ";
        } else {
            // line 66
            echo "                        <div class=\"panel-body\">
                            ";
            // line 67
            echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.address.list.no_addresses", array(), "SonataCustomerBundle");
            // line 68
            echo "                        </div>
                    ";
        }
        // line 70
        echo "
                </div>
            ";
    }

    // line 32
    public function block_sonata_profile_address_table_headers($context, array $blocks = array())
    {
        // line 33
        echo "                                <tr>
                                    <th>";
        // line 34
        echo $this->env->getExtension('translator')->getTranslator()->trans("address_full_label", array(), "SonataCustomerBundle");
        echo "</th>
                                    <th>";
        // line 35
        echo $this->env->getExtension('translator')->getTranslator()->trans("address_actions_label", array(), "SonataCustomerBundle");
        echo "</th>
                                </tr>
                            ";
    }

    // line 40
    public function block_sonata_profile_address_row($context, array $blocks = array())
    {
        // line 41
        echo "                                <tr>
                                    <td><a href=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_customer_address_edit", array("id" => $this->getAttribute((isset($context["address"]) ? $context["address"] : null), "id", array()))), "html", null, true);
        echo "\">";
        echo $this->env->getExtension('sonata_address')->renderAddress($this->env, (isset($context["address"]) ? $context["address"] : null), true, false);
        echo "</a></td>
                                    <td style=\"width: 30%;\">
                                        <div>
                                            <form action=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_customer_address_delete", array("id" => $this->getAttribute((isset($context["address"]) ? $context["address"] : null), "id", array()))), "html", null, true);
        echo "\" method=\"post\" onsubmit=\"return confirm('";
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.address.list.delete_confirm", array(), "SonataCustomerBundle");
        echo "');\" style=\"display:inline;\">
                                                <button type=\"submit\" class=\"btn btn-danger\">
                                                    <i class=\"glyphicon glyphicon-trash icon-white\"></i>&nbsp;";
        // line 47
        echo $this->env->getExtension('translator')->getTranslator()->trans("sonata.address.list.delete", array(), "SonataCustomerBundle");
        // line 48
        echo "                                                </button>
                                            </form>
                                            ";
        // line 50
        if ((twig_length_filter($this->env, (isset($context["addressesByType"]) ? $context["addressesByType"] : null)) > 1)) {
            // line 51
            echo "                                                ";
            if ($this->getAttribute((isset($context["address"]) ? $context["address"] : null), "current", array())) {
                // line 52
                echo "                                                    <a style=\"display:inline;\" class=\"btn btn-default disabled\" href=\"#\"><i class=\"glyphicon glyphicon-ok icon-white\"></i>&nbsp;";
                echo $this->env->getExtension('translator')->getTranslator()->trans("address_list_default", array(), "SonataCustomerBundle");
                echo "</a>
                                                ";
            } else {
                // line 54
                echo "                                                    <form action=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_customer_address_setcurrent", array("id" => $this->getAttribute((isset($context["address"]) ? $context["address"] : null), "id", array()))), "html", null, true);
                echo "\" method=\"post\" style=\"display:inline;\">
                                                        <input class=\"btn btn-primary\" type=\"submit\" value=\"";
                // line 55
                echo $this->env->getExtension('translator')->getTranslator()->trans("address_list_set_current", array(), "SonataCustomerBundle");
                echo "\" />
                                                    </form>
                                                ";
            }
            // line 58
            echo "                                            ";
        }
        // line 59
        echo "                                        </div>
                                    </td>
                                </tr>
                                ";
    }

    public function getTemplateName()
    {
        return "SonataCustomerBundle:Addresses:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  294 => 59,  291 => 58,  285 => 55,  280 => 54,  274 => 52,  271 => 51,  269 => 50,  265 => 48,  263 => 47,  256 => 45,  248 => 42,  245 => 41,  242 => 40,  235 => 35,  231 => 34,  228 => 33,  225 => 32,  219 => 70,  215 => 68,  213 => 67,  210 => 66,  206 => 64,  192 => 63,  189 => 40,  172 => 39,  169 => 38,  167 => 32,  164 => 31,  162 => 30,  157 => 28,  154 => 27,  151 => 26,  146 => 74,  132 => 73,  130 => 26,  127 => 25,  110 => 24,  107 => 23,  104 => 22,  94 => 17,  90 => 15,  87 => 14,  83 => 12,  80 => 11,  77 => 10,  72 => 76,  70 => 22,  67 => 21,  65 => 14,  62 => 13,  60 => 10,  57 => 9,  55 => 8,  52 => 7,  49 => 6,  43 => 4,  11 => 1,);
    }
}
