<?php

use App\Modules\SpaceWebApi\Enums\ProlongType;
use App\Modules\SpaceWebApi\SpaceWebClient;
use App\Modules\SpaceWebApi\SpaceWebConnector;

require __DIR__ . '/vendor/autoload.php';

$login = 'and3407yan';
$password = 'PN99BpC2seM*mjZQ';
$domain = 'cwwxzrfiiq2.ru';

$httpConnector = new SpaceWebConnector();
$httpConnector->authenticate($login, $password);

$spaceWebClient = new SpaceWebClient($httpConnector);
var_dump($spaceWebClient->getToken());
var_dump($spaceWebClient->addDomain($domain, ProlongType::NO));
