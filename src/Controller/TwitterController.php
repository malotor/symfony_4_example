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

    public function __construct(GetTweetsFromAccount $getTweetsFromAccount)
    {
        $this->getTweetsFromAccount = $getTweetsFromAccount;
    }


    public function index($account,$n)
    {
        try {
            $response = $this->getTweetsFromAccount->execute($account,$n);
            return new JsonResponse(['tweets' => $response ]);

        } catch (\Exception $e) {
            return new JsonResponse(['code' => 500, 'message' => $e->getMessage() ], 500);
        }
    }


}
