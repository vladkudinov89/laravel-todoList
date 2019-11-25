<?php

namespace App\Actions\Task\SaveTask;

use App\Entities\Task;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Services\SearchService;

class SaveTaskAction
{
    private $taskRepository;
    private $searchService;

    public function __construct(TaskRepositoryInterface $taskRepository , SearchService $searchService)
    {
        $this->taskRepository = $taskRepository;
        $this->searchService = $searchService;
    }

    public function execute(SaveTaskRequest $saveTaskRequest): SaveTaskResponse
    {
        $taskSave = new Task([
            'name' => $saveTaskRequest->getName(),
            'description' => $saveTaskRequest->getDescription(),
            'status' => $saveTaskRequest->getStatus() == 'true' ? true : false
        ]);

        $task = $this->taskRepository->save($taskSave);

        $this->searchService->reindex();

        return new SaveTaskResponse($task);
    }
}
