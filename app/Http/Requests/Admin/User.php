<?php

namespace ImobiRodi\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class User extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:191',
            'genre' => 'in:male,female,other',
            'document' => 'required|min:11|max:14|unique:users',
            'document_secondary' => 'required|min:8|max:12',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'civil_status' => 'required|in:married,separated,single,divorced,widower',

            //renda
            'occupation' => 'required',
            'income' => 'required',
            'company_work' => 'required',

            //endereco
            'zipcode' => 'required|min:3|max:9',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',

            //contato
            'cell' => 'required',

            //access
            'email' => 'required|email|unique:users',

            //conjuge
            'type_of_communion' => 'required_if:civil_status,married,separated|in:Comunhão Universal de Bens,Comunhão Parcial de Bens,Comunhão Parcial de Bens,Participação Final de Aquestos',
            'spouse_name' => 'required_if:civil_status,married,separated|min:3|max:191',
            'spouse_genre' => 'required_if:civil_status,married,separated|in:male,female,other',
            'spouse_document' => 'required_if:civil_status,married,separated|min:11|max:14|unique:users',
            'spouse_document_secondary' => 'required_if:civil_status,married,separated|min:8|max:12',
            'spouse_date_of_birth' => 'required_if:civil_status,married,separated|date_format:d/m/Y',
            'spouse_occupation' => 'required_if:civil_status,married,separated',
            'spouse_income' => 'required_if:civil_status,married,separated',
            'spouse_company_work' => 'required_if:civil_status,married,separated',

        ];
    }
}
