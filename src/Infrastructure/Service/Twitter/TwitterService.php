<?php

namespace App\Infrastructure\Service\Twitter;


use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;
use App\Model\Tweet;
use App\Model\TweetRepository;

class TwitterService implements TweetRepository
{

    private $consumer_key;
    private $consumer_secret;
    private $access_token;
    private $access_token_secret;

    /**
     * TwitterService constructor.
     * @param $consumer_key
     * @param $consumer_secret
     * @param $access_token
     * @param $access_token_secret
     */
    public function __construct($consumer_key, $consumer_secret, $access_token, $access_token_secret)
    {
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->access_token = $access_token;
        $this->access_token_secret = $access_token_secret;
    }


    public function getTweetsFromAcount($account, $n)
    {


        $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);
        $content = $connection->get("account/verify_credentials");

        if ($connection->getLastHttpCode() != 200)
           throw TwitterServiceException::invalidCredentials();

        $statuses = $connection->get("statuses/user_timeline", ["user_id" => $account, "count" => $n]);
        $result = [];
        foreach ($statuses as $s)
        {
            $result[] = new Tweet($s->text,$s->created_at);
        }
        return $result;
    }

}