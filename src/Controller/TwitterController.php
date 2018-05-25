<?php

namespace App\Controller;

use App\Application\TweetDTO;
use App\Infrastructure\Service\Twitter\TwitterService;
use App\Model\Tweet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TwitterController extends Controller
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


    public function index()
    {

        $response = $this->twitterService->getTweetsFromAcount("fake",1);

        array_walk($response, function(&$e) {
            $e = (new TweetDTO($e))->get();
        });

        return new JsonResponse(['tweets' => $response ]);
    }
    
}
