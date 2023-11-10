<?php

declare(strict_types=1);

namespace Libaro\SecureId\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class WebhookValidationRequest extends FormRequest
{
    /**
     * The validation rules which will be used during validation.
     */
    public function rules()
    {
        return [
            'phone' => 'required|string',
            'code' => 'required|string',
        ];
    }
}
