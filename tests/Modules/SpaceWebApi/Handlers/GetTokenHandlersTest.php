<?php

use App\Modules\SpaceWebApi\Handlers\GetTokenHandlers;
use PHPUnit\Framework\TestCase;

class GetTokenHandlersTest extends TestCase
{
    public function testCheckResultReturnsTrue(): void
    {
        $answer = ['result' => 'token'];

        $this->assertEquals($answer['result'], GetTokenHandlers::checkResult($answer));
    }

    public function testCheckResultReturnsFalse(): void
    {
        $this->assertEquals('', GetTokenHandlers::checkResult(['result' => '']));
        $this->assertEquals('', GetTokenHandlers::checkResult([]));
    }
}