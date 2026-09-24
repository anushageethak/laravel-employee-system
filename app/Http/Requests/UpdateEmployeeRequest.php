<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employee = $this->route('employee');

        return [
            
            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')
                    ->ignore($employee),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'designation' => [
                'required',
                'string',
                'max:255',
            ],

            'salary' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
