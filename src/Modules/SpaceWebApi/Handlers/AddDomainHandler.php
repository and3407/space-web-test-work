<?php

namespace App\Modules\SpaceWebApi\Handlers;

class AddDomainHandler
{
    /**
     * @param array<mixed> $answer
     */
    public static function checkResult(array $answer): bool
    {
        if (empty($answer['result'])) {
            return false;
        }

        return true;
    }
}