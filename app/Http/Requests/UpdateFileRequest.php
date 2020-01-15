<?php

namespace App\Http\Requests;

use App\File;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateFileRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
