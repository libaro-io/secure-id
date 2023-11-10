<?php

namespace Libaro\SecureId\Interfaces;

interface WebhookHandlerInterface
{
    public function handleWebhook(string $phone, string $code): void;
}
