<?php

/* table/relation/foreign_key_row.twig */
class __TwigTemplate_5ec1cb62dec4209a936190560f5a352b1d7fb911795eb8366584ae6cb85dbdae extends Twig_Template
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
        echo "<tr>
    ";
        // line 3
        echo "    <td>
        ";
        // line 4
        $context["js_msg"] = "";
        // line 5
        echo "        ";
        $context["this_params"] = null;
        // line 6
        echo "        ";
        if ($this->getAttribute(($context["one_key"] ?? null), "constraint", array(), "array", true, true)) {
            // line 7
            echo "            ";
            $context["drop_fk_query"] = (((((("ALTER TABLE " . PhpMyAdmin\Util::backquote(($context["db"] ?? null))) . ".") . PhpMyAdmin\Util::backquote(($context["table"] ?? null))) . " DROP FOREIGN KEY ") . PhpMyAdmin\Util::backquote($this->getAttribute(            // line 9
($context["one_key"] ?? null), "constraint", array(), "array"))) . ";");
            // line 11
            echo "            ";
            $context["this_params"] = ($context["url_params"] ?? null);
            // line 12
            echo "            ";
            $context["this_params"] = array("goto" => "tbl_relation.php", "back" => "tbl_relation.php", "sql_query" =>             // line 15
($context["drop_fk_query"] ?? null), "message_to_show" => sprintf(_gettext("Foreign key constraint %s has been dropped"), $this->getAttribute(            // line 17
($context["one_key"] ?? null), "constraint", array(), "array")));
            // line 20
            echo "            ";
            $context["js_msg"] = PhpMyAdmin\Sanitize::jsFormat((((((("ALTER TABLE " .             // line 21
($context["db"] ?? null)) . ".") . ($context["table"] ?? null)) . " DROP FOREIGN KEY ") . $this->getAttribute(            // line 23
($context["one_key"] ?? null), "constraint", array(), "array")) . ";"));
            // line 25
            echo "        ";
        }
        // line 26
        echo "        ";
        if ($this->getAttribute(($context["one_key"] ?? null), "constraint", array(), "array", true, true)) {
            // line 27
            echo "            <input type=\"hidden\" class=\"drop_foreign_key_msg\" value=\"";
            // line 28
            echo twig_escape_filter($this->env, ($context["js_msg"] ?? null), "html", null, true);
            echo "\" />
            <a class=\"drop_foreign_key_anchor ajax\" href=\"sql.php";
            // line 30
            echo PhpMyAdmin\Url::getCommon(($context["this_params"] ?? null));
            echo "\">
                ";
            // line 31
            echo PhpMyAdmin\Util::getIcon("b_drop", _gettext("Drop"));
            echo "
            </a>
        ";
        }
        // line 34
        echo "    </td>
    <td>
        <span class=\"formelement clearfloat\">
            <input type=\"text\" name=\"constraint_name[";
        // line 37
        echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
        echo "]\" value=\"";
        // line 38
        echo twig_escape_filter($this->env, (($this->getAttribute(($context["one_key"] ?? null), "constraint", array(), "array", true, true)) ? ($this->getAttribute(($context["one_key"] ?? null), "constraint", array(), "array")) : ("")), "html", null, true);
        // line 39
        echo "\" placeholder=\"";
        echo _gettext("Constraint name");
        echo "\" maxlength=\"64\" />
        </span>
        <div class=\"floatleft\">
            ";
        // line 45
        echo "            ";
        $context["on_delete"] = (($this->getAttribute(($context["one_key"] ?? null), "on_delete", array(), "array", true, true)) ? ($this->getAttribute(        // line 46
($context["one_key"] ?? null), "on_delete", array(), "array")) : ("RESTRICT"));
        // line 47
        echo "            ";
        $context["on_update"] = (($this->getAttribute(($context["one_key"] ?? null), "on_update", array(), "array", true, true)) ? ($this->getAttribute(        // line 48
($context["one_key"] ?? null), "on_update", array(), "array")) : ("RESTRICT"));
        // line 49
        echo "            <span class=\"formelement\">
                ";
        // line 50
        $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 50)->display(array("dropdown_question" => "ON DELETE", "select_name" => (("on_delete[" .         // line 52
($context["i"] ?? null)) . "]"), "choices" =>         // line 53
($context["options_array"] ?? null), "selected_value" =>         // line 54
($context["on_delete"] ?? null)));
        // line 56
        echo "            </span>
            <span class=\"formelement\">
                ";
        // line 58
        $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 58)->display(array("dropdown_question" => "ON UPDATE", "select_name" => (("on_update[" .         // line 60
($context["i"] ?? null)) . "]"), "choices" =>         // line 61
($context["options_array"] ?? null), "selected_value" =>         // line 62
($context["on_update"] ?? null)));
        // line 64
        echo "            </span>
        </div>
    </td>
    <td>
        ";
        // line 68
        if ($this->getAttribute(($context["one_key"] ?? null), "index_list", array(), "array", true, true)) {
            // line 69
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["one_key"] ?? null), "index_list", array(), "array"));
            foreach ($context['_seq'] as $context["key"] => $context["column"]) {
                // line 70
                echo "                <span class=\"formelement clearfloat\">
                    ";
                // line 71
                $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 71)->display(array("dropdown_question" => "", "select_name" => (("foreign_key_fields_name[" .                 // line 73
($context["i"] ?? null)) . "][]"), "choices" =>                 // line 74
($context["column_array"] ?? null), "selected_value" =>                 // line 75
$context["column"]));
                // line 77
                echo "                </span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "        ";
        } else {
            // line 80
            echo "            <span class=\"formelement clearfloat\">
                ";
            // line 81
            $this->loadTemplate("table/relation/dropdown_generate.twig", "table/relation/foreign_key_row.twig", 81)->display(array("dropdown_question" => "", "select_name" => (("foreign_key_fields_name[" .             // line 83
($context["i"] ?? null)) . "][]"), "choices" =>             // line 84
($context["column_array"] ?? null), "selected_value" => ""));
            // line 87
            echo "            </span>
        ";
        }
        // line 89
        echo "        <a class=\"formelement clearfloat add_foreign_key_field\" data-index=\"";
        // line 90
        echo twig_escape_filter($this->env, ($context["i"] ?? null), "html", null, true);
        echo "\" href=\"\">
            ";
        // line 91
        echo _gettext("+ Add column");
        // line 92
        echo "        </a>
    </td>
    ";
        // line 94
        $context["tables"] = array();
        // line 95
        echo "    ";
        if (($context["foreign_db"] ?? null)) {
            // line 96
            echo "        ";
            $context["tables"] = call_user_func_array($this->env->getFunction('Relation_getTables')->getCallable(), array(($context["foreign_db"] ?? null), ($context["tbl_storage_engine"] ?? null)));
            // line 97
            echo "    ";
        }
        // line 98
        echo "    <td>
        <span class=\"formelement clearfloat\">
            ";
        // line 100
        $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 100)->display(array("name" => (("destination_foreign_db[" .         // line 101
($context["i"] ?? null)) . "]"), "title" => _gettext("Database"), "values" =>         // line 103
($context["databases"] ?? null), "foreign" =>         // line 104
($context["foreign_db"] ?? null)));
        // line 106
        echo "        </span>
    </td>
    <td>
        <span class=\"formelement clearfloat\">
            ";
        // line 110
        $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 110)->display(array("name" => (("destination_foreign_table[" .         // line 111
($context["i"] ?? null)) . "]"), "title" => _gettext("Table"), "values" =>         // line 113
($context["tables"] ?? null), "foreign" =>         // line 114
($context["foreign_table"] ?? null)));
        // line 116
        echo "        </span>
    </td>
    <td>
        ";
        // line 119
        if ((($context["foreign_db"] ?? null) && ($context["foreign_table"] ?? null))) {
            // line 120
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["one_key"] ?? null), "ref_index_list", array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["foreign_column"]) {
                // line 121
                echo "                <span class=\"formelement clearfloat\">
                    ";
                // line 122
                $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 122)->display(array("name" => (("destination_foreign_column[" .                 // line 123
($context["i"] ?? null)) . "][]"), "title" => _gettext("Column"), "values" =>                 // line 125
($context["unique_columns"] ?? null), "foreign" =>                 // line 126
$context["foreign_column"]));
                // line 128
                echo "                </span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['foreign_column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 130
            echo "        ";
        } else {
            // line 131
            echo "            <span class=\"formelement clearfloat\">
                ";
            // line 132
            $this->loadTemplate("table/relation/relational_dropdown.twig", "table/relation/foreign_key_row.twig", 132)->display(array("name" => (("destination_foreign_column[" .             // line 133
($context["i"] ?? null)) . "][]"), "title" => _gettext("Column"), "values" => array(), "foreign" => ""));
            // line 138
            echo "            </span>
        ";
        }
        // line 140
        echo "    </td>
</tr>
";
    }

    public function getTemplateName()
    {
        return "table/relation/foreign_key_row.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  239 => 140,  235 => 138,  233 => 133,  232 => 132,  229 => 131,  226 => 130,  219 => 128,  217 => 126,  216 => 125,  215 => 123,  214 => 122,  211 => 121,  206 => 120,  204 => 119,  199 => 116,  197 => 114,  196 => 113,  195 => 111,  194 => 110,  188 => 106,  186 => 104,  185 => 103,  184 => 101,  183 => 100,  179 => 98,  176 => 97,  173 => 96,  170 => 95,  168 => 94,  164 => 92,  162 => 91,  158 => 90,  156 => 89,  152 => 87,  150 => 84,  149 => 83,  148 => 81,  145 => 80,  142 => 79,  135 => 77,  133 => 75,  132 => 74,  131 => 73,  130 => 71,  127 => 70,  122 => 69,  120 => 68,  114 => 64,  112 => 62,  111 => 61,  110 => 60,  109 => 58,  105 => 56,  103 => 54,  102 => 53,  101 => 52,  100 => 50,  97 => 49,  95 => 48,  93 => 47,  91 => 46,  89 => 45,  82 => 39,  80 => 38,  77 => 37,  72 => 34,  66 => 31,  62 => 30,  58 => 28,  56 => 27,  53 => 26,  50 => 25,  48 => 23,  47 => 21,  45 => 20,  43 => 17,  42 => 15,  40 => 12,  37 => 11,  35 => 9,  33 => 7,  30 => 6,  27 => 5,  25 => 4,  22 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "table/relation/foreign_key_row.twig", "/Users/boo/Sites/phpmyadmin/templates/table/relation/foreign_key_row.twig");
    }
}
