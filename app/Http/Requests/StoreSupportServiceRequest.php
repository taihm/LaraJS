<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-23 01:00:48
 * File: SupportService.php
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupportServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'description' => 'nullable|string|max:191',
            'fee' => 'nullable|numeric',
            //{{REQUEST_RULES_NOT_DELETE_THIS_LINE}}
        ];
    }
}
