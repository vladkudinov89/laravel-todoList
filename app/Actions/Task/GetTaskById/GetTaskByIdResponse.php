<?php


namespace App\Actions\Task\GetTaskById;


use App\Entities\Task;

class GetTaskByIdResponse
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getModel(): Task
    {
        return $this->task;
    }

    public function toArray(): array
    {
        return $this->task->toArray();
    }
}
