<?php

namespace Tests\Feature;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Connections\Connection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ElasticTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function search()
    {
        $params = [
            'hosts' => [
                getenv('ELASTICSEARCH_HOSTS')
            ],
            'retries' => 1,
            'handler' => ClientBuilder::multiHandler()
        ];
        $client = ClientBuilder::fromConfig($params);
        $this->assertInstanceOf(Client::class, $client);

        $this->deleteIfPresent($client);

        $response = $client->index([
            'index' => 'testing',
            'type' => 'test',
            'id' => 1,
            'body' => ['testfield' => 'testvalue'],
        ]);

        $this->assertTrue($response['result'] == 'created');
        $this->assertEquals(1, $response['_id']);
    }

    private function deleteIfPresent($connection) {
        try {
            $response = $connection->delete([
                'index' => 'testing',
                'type' => 'test',
                'id' => 1
            ]);
            return $response;
        } catch (\Exception $e) {

        }
    }


}
