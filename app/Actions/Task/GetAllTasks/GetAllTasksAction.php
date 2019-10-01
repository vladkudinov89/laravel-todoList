<?php

namespace App\Actions\Task\GetAllTasks;

use App\Repositories\Task\TaskRepositoryInterface;

class GetAllTasksAction
{
    private $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): GetAllTasksResponse
    {
        $tasks = $this->repository->findAll();

        return new GetAllTasksResponse($tasks);
    }
}
