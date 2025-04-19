<?php

namespace App\Modules\SpaceWebApi\Requests;

class GetTokenRequest
{
    public string $url = '/notAuthorized';

    public string $method = 'getToken';

    /**
     * @var array{
     *     login: string,
     *     password: string,
     * }
     */
    public array $params = [
        'login' => '',
        'password' => '',
    ];

    public function __construct(string $login, string $password)
    {
        $this->params['login'] = $login;
        $this->params['password'] = $password;
    }
}
