<?php

namespace App\Actions\Task\GetTaskById;

use App\Repositories\Task\TaskRepositoryInterface;

class GetTaskByIdAction
{
    private $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): GetTaskByIdResponse
    {
        $task = $this->repository->getById($id);

        return new GetTaskByIdResponse($task);
    }
}
