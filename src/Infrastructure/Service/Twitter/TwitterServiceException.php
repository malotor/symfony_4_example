<?php

namespace App\Infrastructure\Service\Twitter;


use Abraham\TwitterOAuth\TwitterOAuthException;

class TwitterServiceException extends \Exception
{
    static public function invalidCredentials() {
        return new TwitterOAuthException("API Twitter credentials ara invalid")
    }
}