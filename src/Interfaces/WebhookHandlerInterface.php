<?php

namespace Libaro\SecureId\Interfaces;

interface WebhookHandlerInterface
{
    /**
     * @param string $phone
     * @param string $code
     * @return void
     */
    public function handleWebhook(string $phone, string $code): void;
}
