<?php

use App\Modules\SpaceWebApi\Handlers\AddDomainHandler;
use PHPUnit\Framework\TestCase;

class AddDomainHandlerTest extends TestCase
{
    public function testCheckResultReturnsTrue(): void
    {
        $answer = ['result' => '1'];

        $this->assertTrue(AddDomainHandler::checkResult($answer));
    }

    public function testCheckResultReturnsFalse(): void
    {
        $this->assertFalse(AddDomainHandler::checkResult(['result' => '']));
        $this->assertFalse(AddDomainHandler::checkResult([]));
    }
}