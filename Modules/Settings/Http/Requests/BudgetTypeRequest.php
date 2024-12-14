<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetTypeRequest extends FormRequest
{
    protected $table = 'budget_types';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => ['required'],
                    'department_idfk' => ['required'],
//                    'title' => ['required'], //, $this->unique($this->table, 'title')],
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => ['required'],
                    'department_idfk' => ['required'],
//                    'title' => ['required', $this->unique($this->table, 'title', $this->id)],
                ];
            }
            default:
                break;
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required' => 'The name field is required.',
            'department_idfk.required' => 'The department field is required.',
            'title.required' => 'The title field is required.',
        ];
    }
}
