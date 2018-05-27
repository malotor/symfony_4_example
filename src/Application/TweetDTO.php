<?php

namespace App\Application;


use App\Model\Tweet;

class TweetDTO {

    private $tweet;

    /**
     * TweetDTO constructor.
     * @param $tweet
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    public function get()
    {
        return [
            'date' => $this->tweet->getDate(),
            'text' => $this->tweet->getText()
        ];
    }

}