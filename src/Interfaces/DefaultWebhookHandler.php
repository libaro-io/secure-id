<?php

namespace Libaro\SecureId\Interfaces;

use Illuminate\Support\Facades\Log;

class DefaultWebhookHandler implements WebhookHandlerInterface
{
    /**
     * @param string $phone
     * @param string $code
     * @return void
     */
    public function handleWebhook(string $phone, string $code): void
    {
        Log::info("received webhook from {$phone} with code {$code}");
    }
}
