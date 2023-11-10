<?php

use Illuminate\Support\Facades\Route;
use Libaro\SecureId\Http\Controllers\Api\WebhookController;

//phpstan-ignore-next-line      // because phpstan gives wrong warning about using strval on mixed
Route::name('api.secure-id.')
    ->prefix(strval(config('secure-id.api_url_prefix')))
    ->group(function () {
        Route::name('sign')
            ->post('sign/webhook', [WebhookController::class, 'handle']);
    });
