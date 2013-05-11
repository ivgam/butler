<?php

abstract class Fw_View {

    public static function display($layout, $html) {
        require_once LAYOUTS_PATH . DS . $layout . '.php';
    }

    public static function displayEditInputs($oResult, $oParams) {
        $html = '';
        foreach ($oParams as $label => $attr) {
            $comment = (isset($attr['comment'])) ? '<span class="small-label">' . $attr['comment'] . '</span>' : '';
            $html .= '<div class="control-group">';
            $html .= '<label class="control-label" for="' . $attr['name'] . '">' . $label . $comment . '</label>';
            $html .= '<div class="controls">';
            $attr['join'] = (!isset($attr['join'])) ? null : $attr['join'];
            $attr['where'] = (!isset($attr['where'])) ? null : $attr['where'];
            switch ($attr['type']) {
                case 'text':
                    $html .= '<input  type="text" class="input-block-level"';
                    $html .= ' name="' . $attr['name'] . '"';
                    $html .= ' value="' . ((isset($oResult[$attr['name']]) && $attr['populate']) ? $oResult[$attr['name']] : '') . '"';
                    $html .= ' />';
                    break;

                case 'password':
                    $html .= '<input  type="password" class="input-block-level"';
                    $html .= ' name="' . $attr['name'] . '"';
                    $html .= ' value="' . ((isset($oResult[$attr['name']]) && $attr['populate']) ? $oResult[$attr['name']] : '') . '"';
                    $html .= ' />';
                    break;

                case 'select':
                    $html .= '<select name="' . $attr['name'] . '" class="input-block-level">';
                    $data = Fw_Model::getDataForSelect($attr['table'], $attr['field'], $attr['join'], $attr['where']);
                    $html .= '<option value="0">None</option>';
                    foreach ($data as $row) {
                        $html .= '<option value="' . $row['id'] . '" ';
                        $html .= (($row['id'] == $oResult[$attr['name']]) ? ' selected="selected" ' : '') . '>';
                        $html .= $row[$attr['field']];
                        $html .= '</option>';
                    }
                    $html .= '</select>';
                    break;
                case 'multi-select':
                    $html .= '<select multiple="multiple" name="' . $attr['name'] . '[]" class="input-block-level">';
                    $data = Fw_Model::getDataForSelect($attr['table'], $attr['field'], $attr['join'], $attr['where']);
                    foreach ($data as $row) {
                        $html .= '<option value="' . $row['id'] . '" ';
                        $html .= ((!empty($row['match_v'])) ? ' selected="selected" ' : '') . '>';
                        $html .= $row[$attr['field']];
                        $html .= '</option>';
                    }
                    $html .= '</select>';
                    break;
                case 'radio':
                    $data = Fw_Model::getDataForSelect($attr['table'], $attr['field'], $attr['join'], $attr['where']);
                    foreach ($data as $row) {
                        $html .= '<input type="radio"';
                        $html .= ' name="' . $attr['name'] . '"';
                        $html .= (($row['id'] == $oResult[$attr['name']]) ? ' checked="checked" ' : '');
                        $html .= ' /> ';
                        $html .= $row[$attr['field']];
                    }
                    break;
                case 'textarea':
                    $html .= '<textarea cols="80" rows="10" name="' . $attr['name'] . '" class="input-block-level">';
                    $html .= (isset($oResult[$attr['name']]) && $attr['populate']) ? $oResult[$attr['name']] : '';
                    $html .= '</textarea>';
                    break;
                case 'checkbox':
                    $html .= '<input type="checkbox"';
                    $html .= ' name="' . $attr['name'] . '"';
                    $html .= ($oResult[$attr['name']]) ? ' checked="checked" ' : '';
                    $html .= ' /> ';
                    $html .= $label;
                    break;
            }
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }

}

?>