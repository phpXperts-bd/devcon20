<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required|unique:sessions,slug,' . $id,
            'recording_url' => 'required|url',
            'description' => 'required',
            'speakers' => 'required|array',
            'start_time' => 'required|date:Y-m-d\TH:i:sO',
            'end_time' => 'required|date:Y-m-d\TH:i:sO',
            'active' => 'required',
            'slide_url' => 'nullable|url',
            'codebase_url' => 'nullable|url',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string'
        ];

        return  $rules;
    }

}
