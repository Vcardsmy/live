<?php

namespace App\Http\Requests;

use App\Models\Vcard;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVcardRequest extends FormRequest
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
        $rules = Vcard::$rules;
        $rules['url_alias'] = $rules['url_alias'].','.$this->route('vcard')->id;
        $rules['password'] = 'nullable|min:6';

        return $rules;
    }

    public function messages()
    {
        return [
            'url_alias.string'   => 'The URL Alias field is required.',
            'name.string'        => 'The name field is required.',
            'url_alias.min'      => 'The URL Alias must be at least 6 characters.',
            'url_alias.max'      => 'The URL Alias not be grater then 16 characters.',
            'url_alias.unique'   => 'The URL Alias must unique.',
            'occupation.string'  => 'The occupation field is required.',
            'description.string' => ' The description field is required.',
            'first_name.string'  => 'The first name field is required.',
            'last_name.string'   => 'The last name field is required.',
        ];
    }
}
