<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
Use Illuminate\Support\Str;

class StoreEmployeeRequest extends FormRequest
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
            'phone' => ['required', 'string', 'regex:/^(\+?[0-9]{1,3})?[0-9]{7,14}$/'],
            'profile' => [$this->isUpdate?'':'required','image'],
            'company_id' => ['required','integer'],
        ];
    }
}
