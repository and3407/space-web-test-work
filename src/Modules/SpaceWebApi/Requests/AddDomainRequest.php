<?php

namespace App\Modules\SpaceWebApi\Requests;

use App\Modules\SpaceWebApi\Enums\ProlongType;

class AddDomainRequest
{
    public string $url = '/domains';

    public string $method = 'move';

    public array $params = [
        'domain' => '',
        'prolongType' => '',
    ];

    public function __construct(string $domain, ProlongType $prolongType)
    {
        $this->params['domain'] = $domain;
        $this->params['prolongType'] = $prolongType;
    }
}