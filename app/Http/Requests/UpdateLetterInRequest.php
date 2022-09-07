<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateLetterInRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('letter_in_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
            'sender' => [
                'string',
                'required',
            ],
            'regarding' => [
                'string',
                'required',
            ],
            'received_at' => [
                'date_format:' . config('panel.date_format'),
                'required',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'required',
            ],
            'disposition' => [
                'string',
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
