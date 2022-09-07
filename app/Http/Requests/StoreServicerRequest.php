<?php

namespace App\Http\Requests;

use App\Models\Servicer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreServicerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('servicer_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
