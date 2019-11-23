<?php

namespace App\Actions\Task\DeleteTask;

use App\Exceptions\Task\TaskDoesNotExistException;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Services\SearchService;

class DeleteTaskAction
{
    private $repository;
    private $searchService;

    public function __construct(TaskRepositoryInterface $repository, SearchService $searchService)
    {
        $this->repository = $repository;
        $this->searchService = $searchService;
    }

    public function execute(DeleteTaskRequest $request): void
    {
        $task = $this->repository->getById($request->getId());

        if (!$task) {
            throw new TaskDoesNotExistException();
        }

        $this->repository->deleteById($task->id);

        $this->searchService->reindex();
    }
}
