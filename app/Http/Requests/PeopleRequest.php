<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
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

    public function rules()
{
  //$user = User::find($this->users);

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
                'name' => 'min:3|max:50|required',
                'last_name' => 'min:3|max:50|required',
                'mobile_phone' => 'bail|nullable|min:7|max:15|required_without:phone',
                'phone' => 'bail|nullable|min:7|max:15|required_without:mobile_phone',
                'birthdate' => 'date|required',
                'address' => 'required',
                'document_type' => 'required',
                'document_number' => 'bail|min:8|max:12|unique:people,document_number,'.$this->segment(2),
                'sigin' => 'required',
                'rut' => 'required',
                'gender' => 'required',
                'nationality' => 'required',
                'bank_account' => 'bail|nullable|min:8|max:20|unique:people,bank_account,'.$this->segment(2),
                'company_id' => 'required',
                'role_id' => 'required',
                // 'epss_id' => 'required',
                // 'banks_id' => 'required',
                'email' => 'bail|min:6|max:60|unique:users,email,'.$this->segment(2),
                'password'=> 'required',
                'jobtype_id'=> 'required',
                'init'=> 'required'
            ];
        }
        case 'PUT':
            {
               return [
                'name' => 'min:3|max:50|required',
                'last_name' => 'min:3|max:50|required',
                'mobile_phone' => 'bail|nullable|min:7|max:15|required_without:phone',
                'phone' => 'bail|nullable|min:7|max:15|required_without:mobile_phone',
                'birthdate' => 'date|required',
                'address' => 'required',
                'document_type' => 'required',
                'document_number' => 'bail|min:8|max:12|unique:people,document_number,'.$this->segment(2),
                'sigin' => 'required',
                'rut' => 'required',
                'gender' => 'required',
                'nationality' => 'required',
                'bank_account' => 'bail|nullable|min:8|max:20|unique:people,bank_account,'.$this->segment(2),
                'company_id' => 'required',
                'role_id' => 'required',
                // 'epss_id' => 'required',
                // 'banks_id' => 'required',
                'email' => 'bail|min:6|max:60|unique:users,email,'.$this->segment(2),
                'password'=> 'required',
                'jobtype_id'=> 'required',
                'init'=> 'required'

                ];
            }
        case 'PATCH':
        {
            return [
                'name' => 'min:3|max:50|required',
                'last_name' => 'min:3|max:50|required',
                'mobile_phone' => 'bail|nullable|min:7|max:15|required_without:phone',
                'phone' => 'bail|nullable|min:7|max:15|required_without:mobile_phone',
                'birthdate' => 'date',
                'address' => 'required',
                'document_type' => 'required',
                'document_number' => 'bail|min:8|max:12|unique:people,document_number,'.$this->segment(2),
                'sigin' => 'required',
                'rut' => 'required',
                'gender' => 'required',
                'nationality' => 'required',
                'bank_account' => 'bail|nullable|min:8|max:20|unique:people,bank_account,'.$this->segment(2),
                'company_id' => 'required',
                'role_id' => 'required',
                'email' => 'bail|min:6|max:60|unique:users,email,'.$this->segment(2),
                'password'=> 'required',
                'jobtype_id'=> 'required',
                'init'=> 'required'

                ];
        }
        default:break;
    }

}
public function messages()
{
    return [
        'name.required' => 'El :attribute es obligatorio.',
        'document_number.required' => 'Añade una numero valido'
    ];
}

}
