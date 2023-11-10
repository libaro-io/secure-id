<?php

namespace Libaro\SecureId\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;

class SignAgentService
{
    /** @var Agent */
    private $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function getSign(): array
    {
        $message = $this->getMessage();
        $sign = $this->getSignFromMessage($message);

        return $sign;
    }

    /**
     * @return mixed
     */
    private function getMessage(string $template = '', string $customCode = ''): array
    {
        $apiKey = config('secure-id.api_key');
        if (! $apiKey) {
            throw new Exception('No apikey defined for secureid');
        }

        $response = Http::post('https://secureid.digitalhq.com/api/generate', [
            'api_key' => $apiKey,
            'type' => $this->getMethod(),
            'template' => $template,
            'customCode' => $customCode,
        ]);

        $result = (array) json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    private function getMethod(): string
    {
        if ($this->agent->isDesktop()) {
            return 'qr';
        } else {
            return 'sms';
        }
    }

    private function getSignFromMessage($data): array
    {
        $method = $this->getMethod();
        $sign = [];

        $sign['type'] = $this->getMethod();
        $sign['code'] = $data['code'];

        if ($this->agent->isDesktop()) {
            $sign['data'] = $data[$method];
        } else {
            if ($this->agent->isAndroidOS()) {
                $sign['data'] = $data['android'];
            } else {
                $sign['data'] = $data['ios'];
            }
        }

        return $sign;
    }
}
