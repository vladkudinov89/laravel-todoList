<?php

namespace App\Console\Commands\Search;

use App\Entities\Task;
use App\Repositories\Task\TaskRepository;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InitCommand extends Command
{
    protected $signature = 'search:init';

    private $client;

    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    public function handle(): bool
    {
        $this->initTasks();

        return true;
    }

    private function initTasks()
    {
        try {
            $this->client->indices()->delete([
                'index' => 'app'
            ]);
            $this->output->writeln('');
            $this->info('Delete!');
        } catch (Missing404Exception $e) {
        }

        $this->client->indices()->create([
           'index' => 'app',
            'body' => [
                'mappings' =>[
                    'tasks' => [
                        'properties' => [
                            'id' => [
                                'type' => 'integer'
                            ],
                            'name' => [
                                'type' => 'text'
                            ],
                            'description' => [
                                'type' => 'text'
                            ],
                            'status' => [
                                'type' => 'integer'
                            ],
                        ]
                    ]
                ],

                'settings' => [
                    'analysis' => [
                        'char_filter' => [
                            'replace' => [
                                'type' => 'mapping',
                                'mappings' => [
                                    '&=> and '
                                ],
                            ],
                        ],
                        'filter' => [
                            'word_delimiter' => [
                                'type' => 'word_delimiter',
                                'split_on_numerics' => false,
                                'split_on_case_change' => true,
                                'generate_word_parts' => true,
                                'generate_number_parts' => true,
                                'catenate_all' => true,
                                'preserve_original' => true,
                                'catenate_numbers' => true,
                            ],
                            'trigrams' => [
                                'type' => 'ngram',
                                'min_gram' => 1,
                                'max_gram' => 20,
                            ],
                        ],
                        'analyzer' => [
                            'default' => [
                                'type' => 'custom',
                                'char_filter' => [
                                    'html_strip',
                                    'replace',
                                ],
                                'tokenizer' => 'whitespace',
                                'filter' => [
                                    'lowercase',
                                    'word_delimiter',
                                    'trigrams',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ]);

        foreach (DB::table('task_lists')
                     ->orderBy('id')->cursor() as $task) {
            $this->client->index([
                'index' => 'app',
               'type' => 'tasks',
               'id' => $task->id,
                'body' => [
                    'id' => $task->id,
                    'name' => $task->name,
                    'description' => $task->description,
                    'status' => $task->status,
                ]
            ]);
        }

        $this->output->writeln('');
        $this->info('Reindex Success!');

    }
}
