<?php

set_time_limit(0);

require __DIR__.'/../vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

define(CONSUMER_KEY, "IcugvlStOYTxEPICITXyBoOz3");
define(CONSUMER_SECRET, "SbDtTvSuqxsHwXqz9Oxxen9EfyB5l9akVhh3DuyL0RdUnbSk52");

$access_token = '490402045-1QDYNdHVlsu8fLE9UwY94XC1JJF29zkiG2p2RgaA';
$access_token_secret = 'HVow4BT6QCQDs5N1KRgpFAj7cE58e2kG4JZ19gM1pr41N';


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
$content = $connection->get("account/verify_credentials");

#$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);


$statuses = $connection->get("statuses/user_timeline", ["user_id" => "mloptor", "count" => 10]);

foreach ($statuses as $s)
{

    echo json_encode([
        'created_at' => $s->created_at,
        'text' => $s->text
    ]);
}