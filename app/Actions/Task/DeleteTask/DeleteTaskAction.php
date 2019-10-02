<?php

namespace App\Actions\Task\DeleteTask;

use App\Exceptions\Task\TaskDoesNotExistException;
use App\Repositories\Task\TaskRepositoryInterface;

class DeleteTaskAction
{
    private $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(DeleteTaskRequest $request): void
    {
        $task = $this->repository->getById($request->getId());

        if (!$task) {
            throw new TaskDoesNotExistException();
        }

        $this->repository->deleteById($task->id);
    }
}
