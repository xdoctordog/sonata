<?php

/* SonataProductBundle:Product:carousel.html.twig */
class __TwigTemplate_eb0d3635ad0c32012a74a5e9abf2404f7715ed6f662251b767f485a3e0740b73 extends Sonata\CacheBundle\Twig\TwigTemplate14
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
        // line 11
        echo "
";
        // line 15
        echo "
<script type=\"text/javascript\">
    jQuery(document).ready(function() {
        \$('#productCarousel').carousel({
            interval: false // Don't auto-switch images
        });

        // handles the carousel thumbnails
        \$('a[id^=carousel-selector-]').click( function(){
            var id_selector = \$(this).attr(\"id\");
            var id = id_selector.replace('carousel-selector-', '');
            id = parseInt(id);
            \$('#productCarousel').carousel(id);
            \$('a[id^=carousel-selector-]').css('border', '1px solid #dddddd');
            \$(this).css('border', '1px solid #000000');
        });

        // when the carousel slides, auto update
        \$('#productCarousel').on('slid', function (e) {
            var id = \$('.item.active').data('slide-number');
            id = parseInt(id);
            \$('a[id^=carousel-selector-]').css('border', '1px solid #dddddd');
            \$('#carousel-selector-'+id).css('border', '1px solid #000000');
        });
    });
</script>

<!-- main slider carousel -->
<div class=\"row\">
    <div class=\"col-md-12\" id=\"slider\">

        <div id=\"carousel-bounding-box\">
            <div id=\"productCarousel\" class=\"carousel slide\">
                <!-- main slider carousel items -->
                <div class=\"carousel-inner\">
                    <div class=\"active item\" data-slide-number=\"0\">
                        ";
        // line 51
        echo $this->env->getExtension('sonata_media')->media($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "image", array()), "large", array("class" => "img-responsive"));
        // line 52
        echo "                    </div>

                    ";
        // line 54
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "gallery", array()), "galleryHasMedias", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["galMedia"]) {
            // line 55
            echo "                        <div class=\"item\" data-slide-number=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
                            ";
            // line 56
            echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($context["galMedia"], "media", array()), "large", array("class" => "img-responsive"));
            // line 57
            echo "                        </div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['galMedia'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "                </div>

                <!-- main slider carousel nav controls -->
                <a class=\"carousel-control left\" href=\"#productCarousel\" data-slide=\"prev\">
                    <span class=\"glyphicon glyphicon-chevron-left\"></span>
                </a>
                <a class=\"carousel-control right\" href=\"#productCarousel\" data-slide=\"next\">
                    <span class=\"glyphicon glyphicon-chevron-right\"></span>
                </a>
            </div>
        </div>

    </div>
</div>
<!--/main slider carousel-->

<div class=\"row\">&nbsp;</div>

<!-- thumb navigation carousel -->
<div class=\"hidden-sm hidden-xs\" id=\"slider-thumbs\">
    <!-- thumb navigation carousel items -->
    <ul class=\"list-inline\">
        <li>
            <a id=\"carousel-selector-0\" class=\"img-thumbnail\">
                ";
        // line 83
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "image", array()), "preview", array());
        // line 84
        echo "            </a>
        </li>
        ";
        // line 86
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["product"]) ? $context["product"] : null), "gallery", array()), "galleryHasMedias", array()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["galMedia"]) {
            // line 87
            echo "            <li>
                <a id=\"carousel-selector-";
            // line 88
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"img-thumbnail\">
                    ";
            // line 89
            echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($context["galMedia"], "media", array()), "preview", array());
            // line 90
            echo "                </a>
            </li>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['galMedia'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        echo "    </ul>
</div>
<!-- /thumb navigation carousel -->


";
    }

    public function getTemplateName()
    {
        return "SonataProductBundle:Product:carousel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 93,  163 => 90,  161 => 89,  157 => 88,  154 => 87,  137 => 86,  133 => 84,  131 => 83,  105 => 59,  90 => 57,  88 => 56,  83 => 55,  66 => 54,  62 => 52,  60 => 51,  22 => 15,  19 => 11,);
    }
}
