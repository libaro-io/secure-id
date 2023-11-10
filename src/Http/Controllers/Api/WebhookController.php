<?php

namespace Libaro\SecureId\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Libaro\SecureId\Http\Controllers\Controller;
use Libaro\SecureId\Http\Requests\WebhookValidationRequest;

class WebhookController extends Controller
{
    /**
     * @param  Request  $request
     */
    public function handle(WebhookValidationRequest $request): JsonResponse
    {
        $webhookHandlers = config('secure-id.webhook_handlers');

        $data = $request->validated();
        $phone = $data['phone'];
        $code = $data['code'];

        // Loop through each webhook handler and call the handleWebhook method
        foreach ($webhookHandlers as $handlerClass) {
            // Instantiate the handler
            $handler = app($handlerClass);

            // Call the handleWebhook method
            $handler->handleWebhook($phone, $code);
        }

        // Return a JSON response indicating success
        return response()->json(['message' => 'Webhook handled successfully']);

    }
}
