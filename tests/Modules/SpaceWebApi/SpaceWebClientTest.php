<?php

use App\Modules\SpaceWebApi\Enums\ProlongType;
use App\Modules\SpaceWebApi\Requests\AddDomainRequest;
use App\Modules\SpaceWebApi\SpaceWebClient;
use App\Modules\SpaceWebApi\SpaceWebConnector;
use PHPUnit\Framework\TestCase;

class SpaceWebClientTest extends TestCase
{
    private const string DOMAIN = 'test.ru';
    private const string TOKEN = 'token';

    private SpaceWebConnector $spaceWebConnector;
    private SpaceWebClient $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->spaceWebConnector = $this->createMock(SpaceWebConnector::class);

        $this->client = new SpaceWebClient($this->spaceWebConnector);
    }

    public function testSuccessfulDomainAddition(): void
    {
        $request = new AddDomainRequest(self::DOMAIN, ProlongType::NO);

        $this->spaceWebConnector
            ->expects($this->once())
            ->method('send')
            ->with(
                $request->method,
                $request->url,
                $request->params,
            )->willReturn([
                'result' => 1,
            ]);

        $result = $this->client->addDomain(self::DOMAIN, ProlongType::NO);

        $this->assertTrue($result);
    }

    public function testFailedDomainAddition(): void
    {
        $request = new AddDomainRequest(self::DOMAIN, ProlongType::NO);

        $this->spaceWebConnector
            ->expects($this->once())
            ->method('send')
            ->with(
                $request->method,
                $request->url,
                $request->params,
            )->willReturn([
                'result' => 0,
            ]);

        $result = $this->client->addDomain(self::DOMAIN, ProlongType::NO);

        $this->assertFalse($result);
    }

    public function testTokenExists(): void
    {
        $this->spaceWebConnector
            ->expects($this->once())
            ->method('getToken')
            ->willReturn(self::TOKEN);

        $result = $this->client->getToken();

        $this->assertEquals(self::TOKEN, $result);
    }

    public function testTokenIsEmpty(): void
    {
        $this->spaceWebConnector
            ->expects($this->once())
            ->method('getToken')
            ->willReturn('');

        $result = $this->client->getToken();

        $this->assertEquals('', $result);
    }
}