<?php

namespace App\Modules\SpaceWebApi;

use App\Modules\SpaceWebApi\Enums\ProlongType;
use App\Modules\SpaceWebApi\Handlers\AddDomainHandler;
use App\Modules\SpaceWebApi\Requests\AddDomainRequest;

class SpaceWebClient
{
    public function __construct(
        private readonly SpaceWebConnector $httpConnector,
    ) { }

    public function getToken(): string
    {
        return $this->httpConnector->getToken();
    }

    public function addDomain(string $domain, ProlongType $prolongType): bool
    {
        $request = new AddDomainRequest($domain, $prolongType);

        $result = $this->httpConnector->send(
            method: $request->method,
            url: $request->url,
            params: $request->params,
        );

        return AddDomainHandler::checkResult($result);
    }
}
