<?php

namespace App\Controller;

use App\Application\GetTweetsFromAccount;
use App\Application\TweetDTO;
use App\Infrastructure\Service\Twitter\TwitterService;
use App\Model\Tweet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TwitterController extends Controller
{
    private $getTweetsFromAccount;

    /**
     * TwitterController constructor.
     * @param $twitterService
     */
    public function __construct(GetTweetsFromAccount $getTweetsFromAccount)
    {
        $this->getTweetsFromAccount = $getTweetsFromAccount;
    }


    public function index()
    {

        $response = $this->getTweetsFromAccount->execute();

        return new JsonResponse(['tweets' => $response ]);
    }

}
