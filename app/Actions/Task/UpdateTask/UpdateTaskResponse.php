<?php

namespace App\Actions\Task\UpdateTask;

use App\Entities\Task;

class UpdateTaskResponse
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

    public function getId(): int
    {
        return $this->task->id;
    }

    public function getName(): string
    {
        return $this->task->name;
    }

    public function getDescription(): string
    {
        return $this->task->description;
    }

    public function getStatus(): bool
    {
        return $this->task->status;
    }
}
