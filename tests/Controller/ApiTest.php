<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    public function testRecoverTweets()
    {
        $client = static::createClient();

        $client->request('GET', '/tweets/mloptor/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals("Hello World", $response['message']);
    }
}
