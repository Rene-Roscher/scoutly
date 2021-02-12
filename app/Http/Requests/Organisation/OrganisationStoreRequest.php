<?php

namespace App\Http\Requests\Organisation;

use Illuminate\Foundation\Http\FormRequest;

class OrganisationStoreRequest extends FormRequest
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
        return [
            'name' => 'required|string',
//            'logo' => 'required|file|mimetypes:svg,png,jpeg,jpg',
            'logo' => 'required|string|starts_with:data:image/',
            'type' => 'required|in:B2B,B2C',
            'solution' => 'required|string',
            'legal' => 'required|string',
            'datacenter' => 'required|string',
            'homepage' => 'required|url|active_url',
        ];
    }
}
