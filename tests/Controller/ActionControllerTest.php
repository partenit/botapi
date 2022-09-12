<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActionControllerTest extends WebTestCase
{
    public function testActions()
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/actions', [
            'token' => $this->getToken(),
        ]);

        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }

    public function testActionToLog()
    {
        $client = static::createClient();
        $client->request('POST', '/api/v1/action_to_log', [
            'id' => 10,
            'chat' => 5,
            'token' => $this->getToken(),
        ]);
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }

    public function getToken() {
        return getenv('API_TEST_TOKEN');
    }

}
