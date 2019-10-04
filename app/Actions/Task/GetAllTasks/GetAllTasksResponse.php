<?php

namespace App\Actions\Task\GetAllTasks;

use Illuminate\Database\Eloquent\Collection;
use App\Entities\Task;

class GetAllTasksResponse
{
    private $taskCollection;

    public function __construct( $taskCollection)
    {
        $this->taskCollection = $taskCollection;
    }

    public function getCollection()
    {
        return $this->taskCollection;
    }

    public function toArray(): array
    {
        return $this->taskCollection->toArray();
    }
}
