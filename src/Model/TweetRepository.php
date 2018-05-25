<?php
namespace App\Model;

interface TweetRepository
{
    public function getTweetsFromAcount($account, $n);
}