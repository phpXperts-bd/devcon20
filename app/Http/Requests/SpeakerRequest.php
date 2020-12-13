<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeakerRequest extends FormRequest
{
    /**
     * @var int
     */
    protected $id;

    public function __construct()
    {
        if (!empty(\Route::current()->parameters['id'])) {
            $this->id = intval(\Route::current()->parameters['id']);
        }
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
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:speakers,slug,' . $id,
            'photo_url' => 'required|url',
            'designation' => 'required',
            'company' => 'required',
            'about' => 'required',
            'active' => 'required',
            'email' => 'nullable|unique:speakers,email,' . $id,
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:speakers,phone',
            'twitter' => 'nullable|url',
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string'
        ];

        return  $rules;
    }

}
