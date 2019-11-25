<?php

namespace App\Services;

use App\Console\Commands\Search\InitCommand;
use App\Entities\Task;
use Elasticsearch\Client;

class SearchService
{
    private $client;
    private $command;

    public function __construct(Client $client , InitCommand $command)
    {
        $this->client = $client;
        $this->command = $command;
    }

    public function search($request)
    {
        $response = $this->client->search([
            'index' => 'app',
            'type' => 'tasks',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            ['term' => ['name' => $request->q]],
                            ['term' => ['description' => $request->q]],
                        ]
                    ]
                ],
            ]
        ]);

        $ids = array_column($response['hits']['hits'], '_id');

        return Task::whereIn('id', $ids)
            ->get();
    }

    public function reindex()
    {
        $this->command->handle();
    }
}
