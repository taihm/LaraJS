<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-08-02 23:43:11
 * File: DataExcel.php
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataExcelRequest extends FormRequest
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
//            'name' => 'nullable|string|max:191',
//            'content' => 'nullable|string|max:191',
            //{{REQUEST_RULES_NOT_DELETE_THIS_LINE}}
        ];
    }
}
