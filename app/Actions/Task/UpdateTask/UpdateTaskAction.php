<?php


namespace App\Actions\Task\UpdateTask;


use App\Repositories\Task\TaskRepositoryInterface;

class UpdateTaskAction
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(UpdateTaskRequest $updateTaskRequest): UpdateTaskResponse
    {
        $taskUpdate = $this->taskRepository->getById($updateTaskRequest->getId());

        $taskUpdate->name = $updateTaskRequest->getName();
        $taskUpdate->description = $updateTaskRequest->getDescription();
        $taskUpdate->is_complete = $updateTaskRequest->getStatus();

        return new UpdateTaskResponse($this->taskRepository->save($taskUpdate));
    }
}
