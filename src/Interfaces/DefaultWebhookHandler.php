<?php

namespace Libaro\SecureId\Interfaces;

use Illuminate\Support\Facades\Log;

class DefaultWebhookHandler implements WebhookHandlerInterface
{
    public function handleWebhook(string $phone, string $code): void
    {
        Log::info("received webhook from {$phone} with code {$code}");
    }
}
