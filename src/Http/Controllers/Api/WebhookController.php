<?php

namespace Libaro\SecureId\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Libaro\SecureId\Http\Controllers\Controller;
use Libaro\SecureId\Http\Requests\WebhookValidationRequest;
use Libaro\SecureId\Interfaces\WebhookHandlerInterface;

class WebhookController extends Controller
{
    /**
     * @param WebhookValidationRequest $request
     */
    public function handle(WebhookValidationRequest $request): JsonResponse
    {
        $webhookHandlers = collect(config('secure-id.webhook_handlers'));

        $data = $request->validated();
        $phone = $data['phone'];
        $code = $data['code'];

        // Loop through each webhook handler and call the handleWebhook method
        /** @var string $handlerClass */
        foreach ($webhookHandlers as $handlerClass) {
            /** @var WebhookHandlerInterface $handler */
            $handler = app($handlerClass);

            // Call the handleWebhook method
            $handler->handleWebhook($phone, $code);
        }

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Webhook handled successfully'], JsonResponse::HTTP_OK);
    }
}
