<?php


namespace App\Services;


use App\Entities\Task;
use App\Repositories\Task\TaskRepository;
use Elasticsearch\Client;

class SearchService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
}
