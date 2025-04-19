<?php

namespace App\Modules\SpaceWebApi\Handlers;


class GetTokenHandlers
{
    /**
     * @param array<mixed> $answer
     */
    public static function checkResult(array $answer): string
    {
        if (empty($answer['result'])) {
            return '';
        }

        return $answer['result'];
    }
}
