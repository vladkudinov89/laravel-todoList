<?php

namespace App\Actions\Task\UpdateTask;

use App\Repositories\Task\TaskRepositoryInterface;
use App\Services\SearchService;

class UpdateTaskAction
{
    private $taskRepository;
    private $searchService;

    public function __construct(TaskRepositoryInterface $taskRepository , SearchService $searchService)
    {
        $this->taskRepository = $taskRepository;
        $this->searchService = $searchService;
    }

    public function execute(UpdateTaskRequest $updateTaskRequest): UpdateTaskResponse
    {
        $taskUpdate = $this->taskRepository->getById($updateTaskRequest->getId());

        $taskUpdate->name = $updateTaskRequest->getName();
        $taskUpdate->description = $updateTaskRequest->getDescription();
        $taskUpdate->status = $updateTaskRequest->getStatus();

        $task = $this->taskRepository->save($taskUpdate);

        $this->searchService->reindex();

        return new UpdateTaskResponse($task);
    }
}
