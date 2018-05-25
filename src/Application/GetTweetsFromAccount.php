<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 25/5/18
 * Time: 18:50
 */

namespace App\Application;


use App\Infrastructure\Service\Twitter\TwitterService;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetTweetsFromAccount
{

    private $twitterService;

    /**
     * TwitterController constructor.
     * @param $twitterService
     */
    public function __construct(TwitterService $twitterService)
    {
        $this->twitterService = $twitterService;
    }

    public function execute()
    {

        $response = $this->twitterService->getTweetsFromAcount("fake",1);

        array_walk($response, function(&$e) {
            $e = (new TweetDTO($e))->get();
        });

        return $response;

    }
}