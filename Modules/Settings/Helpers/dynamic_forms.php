<?php
if (!function_exists('formControl')) {
    function formControl($field, $row=null,$selectList=[]) {

        $default_value = !is_null($row) ? $row->{$field->field_name} : $field->default_value;
        $string = '<div class="form-group">';
        $string .= '<label for="">' . $field->label_name . '</label>';
        $string .= '<span class="req-star text-danger">' . ($field->is_required ? '*' : '') . '</span>';
        switch ($field->control_type) {
            case 'text':
                $string .= '<input type="text" name="' . $field->field_name . '" id="' . $field->field_name . '"';
                $string .= ' class="form-control"' . ($field->is_required ? 'required' : '');
                $string .= ' maxlength="' . $field->field_length . '" value="' . $default_value . '" />';
                break;
            case 'numeric':
                $string .= '<input type="numeric" name="' . $field->field_name . '" id="' . $field->field_name . '"';
                $string .= ' class="form-control"' . ($field->is_required ? 'required' : '');
                $string .= ' maxlength="' . $field->field_length . '" value="' . $default_value . '" />';
                break;
            case 'date':
            case 'datetime':
                $string .= '<input type="date" name="' . $field->field_name . '" id="' . $field->field_name . '"';
                $string .= ' class="form-control datepicker"' . ($field->is_required ? 'required' : '');
                $string .= ' maxlength="' . $field->field_length . '" value="' . date('Y-m-d', strtotime($default_value)) . '" />';
                break;
            case 'textarea':
                $string .= '<textarea name="' . $field->field_name . '" id="' . $field->field_name . '"';
                $string .= ' class="form-control" cols=25 rows=2 ' . ($field->is_required ? 'required' : '');
                $string .= ' maxlength="' . $field->field_length . '" >' . $default_value . '</textarea>';
                break;
            case 'select':
                $string .= '<select name="' . $field->field_name . '" id="' . $field->field_name . '"';
                $string .= ' class="form-control" ' . ($field->is_required ? 'required' : '');
                $string .= ' >' . selectOptionsWithObject($selectList,$default_value) . '</select>';
                break;
            case 'radio':
                $checklist = explode(',',$field->checklist);
                foreach ($checklist as $index => $list) {
                    $checked = ($index+1 == $default_value) ? 'checked' : '';
                    $string .= '<label class="label text-capitalize" for="'.$field->field_name.'_'.$list.'">';
                    $string .= '<input type="radio" name="'.$field->field_name . '" id="'.$field->field_name.'_'.$list.'"';
                    $string .= ' class="radio"' . ($field->is_required ? 'required' : ''). ' ' . $checked;
                    $string .= ' value="' . ($index+1) . '" /> '.$list.'</label> ';
                }
                break;
            case 'checkbox':
                $string .= '<br/>';
                $checklist = explode(',',$field->checklist);
                $default_value = explode(',',$default_value);
                foreach ($checklist as $index => $list) {
                    $checked = in_array($index+1, $default_value) ? 'checked' : '';
                    $string .= '<label class="label text-capitalize" for="'.$field->field_name.'_'.$list.'">';
                    $string .= '<input type="checkbox" name="'.$field->field_name . '[]" id="'.$field->field_name.'_'.$list.'"';
                    $string .= ' class="checkbox"' . ($field->is_required ? 'required' : '') . ' ' . $checked;
                    $string .= ' value="' . ($index+1) . '" /> '.$list.'</label> ';
                }
                break;
            default:
                $string .= '';
                break;
        }

        $string .= '<p id="' . $field->field_name . '_message" class="text-danger"></p>';
        $string .= '</div>';

        return $string;
    }
}
