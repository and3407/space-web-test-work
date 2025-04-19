<?php

namespace App\Modules\SpaceWebApi;

use App\Modules\SpaceWebApi\Handlers\GetTokenHandlers;
use App\Modules\SpaceWebApi\Requests\GetTokenRequest;

class SpaceWebConnector
{
    public const string BASE_API_URL = 'https://api.sweb.ru';

    private string $token = '';

    public function authenticate(string $login, string $password): string
    {
        $request = new GetTokenRequest($login, $password);

        $result = $this->send(
            method: $request->method,
            url: $request->url,
            params: $request->params,
        );

        $this->token = GetTokenHandlers::checkResult($result);

        return $this->token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param array<mixed> $params
     */
    public function send(
        string $method,
        string $url,
        array $params = [],
    ): array {
        $requestURL = $this->getRequestUrl($url);

        $headers = [
            'Content-Type: application/json; charset=utf-8',
            'Accept: application/json',
        ];

        if ($this->token) {
            $headers[] = 'Authorization: Bearer ' . $this->token;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_URL, $requestURL);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'jsonrpc' => '2.0',
            'method' => $method,
            'params' => $params,
        ]));

        $result = json_decode(curl_exec($ch), true);

        curl_close($ch);

        SpaceWebLogger::info('Space web api request', [
            'method' => $method,
            'url' => $requestURL,
            'params' => $params,
        ]);

        $this->logResult($result);

        return $result;
    }

    /**
     * @param array<mixed> $result
     */
    private function logResult(array $result): void
    {
        if (empty($response['error'])) {
            SpaceWebLogger::info('Space web api response', $result);

            return;
        }

        SpaceWebLogger::error('Space web api error', $result);
    }

    private function getRequestUrl(string $url): string
    {
        return self::BASE_API_URL . $url;
    }
}