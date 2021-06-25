<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTable extends FormRequest
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
        $tableId = $this->segment(3);

        return [
            "identify" => ["required", "min:3", "max:255", "unique:tables,identify,{$tableId},id"],
            "description" => ["min:3", "max:10000"]
        ];
    }
}
