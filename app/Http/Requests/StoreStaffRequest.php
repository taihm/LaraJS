<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 * File: Staff.php
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'building_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'staff_position_id' => 'required|numeric',
            'status' => 'required|numeric',
            //{{REQUEST_RULES_NOT_DELETE_THIS_LINE}}
        ];
    }
}
