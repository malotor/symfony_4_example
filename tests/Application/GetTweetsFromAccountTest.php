<?php
namespace App\Tests\Application;

use App\Application\GetTweetsFromAccount;
use App\Infrastructure\Service\Twitter\TwitterService;
use App\Model\Tweet;
use SebastianBergmann\CodeCoverage\TestCase;

class GetTweetsFromAccountTest extends TestCase
{

    public function createTestMocks()
    {
        $service = $this->createMock(TwitterService::class);

        $service
            //->expects($this->once())
            ->method('getTweetsFromAcount')
            ->will($this->returnValue([ new Tweet("Hello World", 'Wed May 23 15:05:14 +0000 2018')]))
        ;

        return $service;
    }

    public function testRecoverTweets()
    {

        $applicationService = new GetTweetsFromAccount($this->createTestMocks(
            [
                new Tweet("Hello World", 'Wed May 23 15:05:14 +0000 2018')
            ]
        ));

        $response = $applicationService->execute("anccoun1",1);

        $this->assertCount(1, $response);


        $this->assertEquals("Hello World", $response['tweets'][0]['text']);
        $this->assertEquals("Wed May 23 15:05:14 +0000 2018", $response['tweets'][0]['date']);


    }
}
