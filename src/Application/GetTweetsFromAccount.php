<?php
namespace App\Application;

use App\Infrastructure\Service\Twitter\TwitterService;
use App\Model\TweetRepository;

class GetTweetsFromAccount
{

    private $twitterService;


    public function __construct(TweetRepository $twitterService)
    {
        $this->twitterService = $twitterService;
    }

    public function execute($account,$n)
    {

        $response = $this->twitterService->getTweetsFromAcount($account,$n);

        array_walk($response, function(&$e) {
            $e = (new TweetDTO($e))->get();
        });

        return $response;

    }
}