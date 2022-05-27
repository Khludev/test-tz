<?php

namespace App\Http\Requests;

use App\Models\Application;
use Illuminate\Foundation\Http\FormRequest;

class ClientAppRequest extends FormRequest
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
            'title' => 'required|max:255',
            'message' => 'required',
            'attached_file' => 'nullable|max:512|mimes:jpg,bmp,png,pdf,docx,doc,ms-doc,msword',
            'create_app_access' => ['required',
                function ($attribute, $value, $fail) {
                    if (Application::todayEntry()->first()) {
                        $fail('Entry creation is limited to one per day.');
                    }
                },]
        ];
    }
}
