<?php
namespace App\Tests;

use App\Infrastructure\Service\Twitter\TwitterService;
use App\Infrastructure\Service\Twitter\TwitterServiceException;
use App\Model\Tweet;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    private $container;
    private $client;

    public function setUp()
    {
        self::bootKernel();

        $this->client = static::createClient(array(
            'environment' => 'test',
            'debug'       => false,
        ));

        $this->container = $this->client->getContainer();

    }


    public function testRecoverOneTweetsFromTwitter()
    {


        $this->container->set('service.twitter',$this->createTestMocks('mloptor', 1,
            [ new Tweet("Hello World", 'Wed May 23 15:05:14 +0000 2018')]
        ));


        $this->client->request('GET', '/tweets/mloptor/1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );


        $response = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertCount(1, $response['tweets']);


        $this->assertEquals("Hello World", $response['tweets'][0]['text']);
        $this->assertEquals("Wed May 23 15:05:14 +0000 2018", $response['tweets'][0]['date']);


    }


    public function testRecoverTwoTweetsFromTwitter()
    {

        $this->container->set('service.twitter',$this->createTestMocks('mloptor', 2,
            [
                new Tweet("Hello World", 'Wed May 23 15:05:14 +0000 2018'),
                new Tweet("Bye bye World", 'Wed May 24 15:05:14 +0000 2018')
            ]
        ));


        $this->client->request('GET', '/tweets/mloptor/2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );


        $response = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertCount(2, $response['tweets']);


        $this->assertEquals("Hello World", $response['tweets'][0]['text']);
        $this->assertEquals("Wed May 23 15:05:14 +0000 2018", $response['tweets'][0]['date']);

        $this->assertEquals("Bye bye World", $response['tweets'][1]['text']);
        $this->assertEquals("Wed May 24 15:05:14 +0000 2018", $response['tweets'][1]['date']);

    }

    public function testShowErrors()
    {

        $this->container->set('service.twitter',$this->createTestMocksThrowException());


        $this->client->request('GET', '/tweets/mloptor/2');

        $this->assertEquals(500, $this->client->getResponse()->getStatusCode());

        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $response = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertEquals("API Twitter credentials ara invalid", $response['message']);
        $this->assertEquals(500, $response['code']);

    }


    private function createTestMocks($account, $n,$response)
    {
        $service = $this->createMock(TwitterService::class);

        $service
            ->expects($this->once())
            ->method('getTweetsFromAcount')
            ->with($account, $n)
            ->will($this->returnValue($response));

        return $service;
    }

    private function createTestMocksThrowException()
    {
        $service = $this->createMock(TwitterService::class);

        $service
            ->method('getTweetsFromAcount')
            ->will($this->throwException(TwitterServiceException::invalidCredentials()));

        return $service;
    }


}
