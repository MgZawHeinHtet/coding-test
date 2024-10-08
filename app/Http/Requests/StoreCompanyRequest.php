<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
Use Illuminate\Support\Str;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    private $isUpdate;
    public function __construct()
    {
        $this->isUpdate = Str::contains(url()->previous(),'edit');
    }
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email'=>['required','email'],
            'logo' => [$this->isUpdate?'':'required','image'],
            'website' => ['required'],
            
        ];
    }
}
