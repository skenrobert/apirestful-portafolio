<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonitorShiftRequest extends FormRequest
{
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
    public function rules()
    {
        switch($this->method())
    {
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
            return [
              'observation' => 'required',
              'shift_has_planning_id' => 'required',
              'shift_id' => 'required',
              'monitor_id' => 'required'
            //   'task_id' => 'required'

            ];
        }
        case 'PUT':
            {
               return [
                'observation' => 'required',
                'shift_has_planning_id' => 'required',
                'shift_id' => 'required',
                'monitor_id' => 'required',
                // 'task_id' => 'required'


                ];
            }
        case 'PATCH':
        {
            return [
                'observation' => 'required',
                'shift_has_planning_id' => 'required',
                'shift_id' => 'required',
                'monitor_id' => 'required',
                // 'task_id' => 'required'


                ];
        }
        default:break;
    }

}
public function messages()
{
    return [
        'observation.required' => 'El :attribute es obligatorio.',
        'shift_has_planning_id.required' => 'Añade una numero valido'
    ];
}

}
