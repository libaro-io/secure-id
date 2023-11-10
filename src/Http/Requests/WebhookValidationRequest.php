<?php

declare(strict_types=1);

namespace Libaro\SecureId\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class WebhookValidationRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|string',
            'code' => 'required|string',
        ];
    }
}
