<?php

namespace App\Infrastructure\Service\Twitter;


use App\Model\Tweet;
use App\Model\TweetRepository;

class TwitterService implements TweetRepository
{
    public function getTweetsFromAcount($account, $n)
    {
        return [ new Tweet("Hello World")];

    }

}