<?php

namespace Modules\Schools\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'student_name' => ['required'],
                    'father_name' => ['required'],
                    'cell_phone_father' => ['required'],
                    'course_id' => ['required'],
                    'section' => ['required'],
//                    'title' => ['required'], //, $this->unique($this->table, 'title')],
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'student_name' => ['required'],
                    'father_name' => ['required'],
                    'cell_phone_father' => ['required'],
//                    'title' => ['required', $this->unique($this->table, 'title', $this->id)],
                ];
            }
            default:
                break;
        }
    }

    public function messages() {
        return [
            'name.required' => 'The name field is required.',
            'cell_phone_father.required' => 'The contact # field is required.',
            'title.required' => 'The title field is required.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
