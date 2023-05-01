<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        //$user = User::find($this->users);

        // 'id', 'name', 'email', 'password', 'status', 'type','notification_preference'
      
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
                    // 'name' => 'min:4|max:120|required',
                    'email' => 'bail|min:4|max:120|required|email|unique:users',
                    'password' => 'min:4|max:120|required',
                    'role_id' => 'required',
                    'person_id' => 'required'

                  ];
              }
              case 'PUT':
                  {
                      return [
                        // 'name' => 'min:4|max:120|required',
                        // 'email' => 'bail|min:4|max:120|required|email|unique:people,email,'.$this->segment(2),
                        'email' => 'bail|min:4|max:120|email|unique:users,email,'.$this->segment(2),
                        'password' => 'bail|min:6|max:20,password,'.$this->segment(2),
                        'role_id' => 'required'

                      ];
                  }
              case 'PATCH':
              {
              }
              default:break;
          }

      }

      
      public function messages()
      {
          return [
              'name.required' => 'El :attribute es obligatorio.',
              'email.required' => 'Añade un email correctos.'
          ];
      }

}
