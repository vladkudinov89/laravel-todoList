<?php

namespace App\Actions\Task\SaveTask;

use App\Entities\Task;
use App\Repositories\Task\TaskRepositoryInterface;

class SaveTaskAction
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(SaveTaskRequest $saveTaskRequest): SaveTaskResponse
    {
        $taskSave = new Task([
            'name' => $saveTaskRequest->getName(),
            'description' => $saveTaskRequest->getDescription(),
            'status' => $saveTaskRequest->getStatus()
        ]);

        $task = $this->taskRepository->save($taskSave);

        return new SaveTaskResponse($task);
    }
}
