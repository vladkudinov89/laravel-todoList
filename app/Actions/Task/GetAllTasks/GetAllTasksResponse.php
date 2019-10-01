<?php

namespace App\Actions\Task\GetAllTasks;

use Illuminate\Database\Eloquent\Collection;
use App\Entities\Task;

class GetAllTasksResponse
{
    private $taskCollection;

    public function __construct(Collection $taskCollection)
    {
        $this->taskCollection = $taskCollection;
    }

    public function getCollection(): Collection
    {
        return $this->taskCollection;
    }

    public function toArray(): array
    {
        return $this->taskCollection->toArray();
    }
}
