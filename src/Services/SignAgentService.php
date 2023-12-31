<?php

namespace Libaro\SecureId\Services;

use Exception;
use \Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;

class SignAgentService
{
    /** @var Agent */
    private $agent;

    /**
     *
     */
    public function __construct()
    {
        $this->agent = new Agent();
    }


    /**
     * @param string $callbackUrl
     * @return string[]
     * @throws Exception
     */
    public function getSign(string $callbackUrl = 'default'): array
    {
        $message = $this->getMessage();
        $sign = $this->getSignFromMessage($message);

        return $sign;
    }


    /**
     * @param string $template
     * @param string $customCode
     * @param string $callbackUrl
     * @return string[]
     * @throws Exception
     */
    private function getMessage(string $template = '', string $customCode = '', string $callbackUrl = 'default'): array
    {
        $apiKey = config('secure-id.api_key');
        if (! $apiKey) {
            throw new Exception('No apikey defined for secureid');
        }

        /** @var string $apiUrl */
        $apiUrl = config('secure-id.api_url');

        $response = Http::post(strval($apiUrl), [
            'api_key' => $apiKey,
            'type' => $this->getMethod(),
            'template' => $template,
            'customCode' => $customCode,
            'callback_url' => $callbackUrl,
        ]);

        /** @var array<string, string> $result */
        $result = $response->json();

        return $result;
    }

    /**
     * @return string
     */
    private function getMethod(): string
    {
        if ($this->agent->isDesktop()) {
            return 'qr';
        } else {
            return 'sms';
        }
    }


    /**
     * @param array<string, string> $data
     * @return array<string, string>
     */
    private function getSignFromMessage(array $data): array
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
