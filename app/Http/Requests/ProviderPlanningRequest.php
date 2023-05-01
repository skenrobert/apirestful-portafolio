<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderPlanningRequest extends FormRequest
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
            //     // 'image' =>  'required|file_exists'
              'observation' => 'required',
              'goal_dollar' => 'required',
              'monitor_shift_id' => 'required',
              'model_id' => 'required',
              'room_id' => 'required'
            ];
        }
        case 'PUT':
            {
               return [
                'observation' => 'required',
                // 'shift_has_planning_id' => 'required',
                'monitor_shift_id' => 'required',
                'model_id' => 'required',
                'room_id' => 'required'
                ];
            }
        case 'PATCH':
        {
            return [
                'observation' => 'required',
                // 'shift_has_planning_id' => 'required',
                'monitor_shift_id' => 'required',
                'model_id' => 'required',
                'room_id' => 'required'
                ];
        }
        default:break;
    }

}
public function messages()
{
    return [
        'observation.required' => 'El :attribute es obligatorio.',
        'monitor_shift_id.required' => 'Añade una numero valido'
        // 'image.file_exists' =>  'That file no longer exists or is invalid'
    ];
}

}
