<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreLetterOutRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('letter_out_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
            'receiver' => [
                'string',
                'required',
            ],
            'regarding' => [
                'string',
                'required',
            ],
            'sended_at' => [
                'date_format:' . config('panel.date_format'),
                'required',
            ],
            'servicer_id' => [
                'required',
                'integer',
                'exists:servicers,id'
            ],
        ];
    }
}
