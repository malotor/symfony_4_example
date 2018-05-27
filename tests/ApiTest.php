<?php
namespace App\Tests;

use App\Infrastructure\Service\Twitter\TwitterService;
use App\Infrastructure\Service\Twitter\TwitterServiceMock;
use App\Model\Tweet;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
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

        self::bootKernel();

        //static::$kernel->getContainer()->set('service.twitter', new TwitterServiceMock());

        //service = static::$kernel->getContainer()->get('service.twitter');
        //var_dump(get_class($service));

        //$client = static::createClient();

        $client = static::createClient([
            'services' => [
                'service.twitter' => new TwitterServiceMock()
            ]
        ]);

        $service = static::$kernel->getContainer()->get('service.twitter');
        var_dump(get_class($service));

        $client->request('GET', '/tweets/mloptor/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );





        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertCount(1, $response);


        $this->assertEquals("Hello World", $response['tweets'][0]['text']);
        $this->assertEquals("Wed May 23 15:05:14 +0000 2018", $response['tweets'][0]['date']);


    }
}
