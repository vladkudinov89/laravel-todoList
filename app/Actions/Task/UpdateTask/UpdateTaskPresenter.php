<?php

namespace App\Actions\Task\UpdateTask;

class UpdateTaskPresenter
{
    public static function present(UpdateTaskResponse $taskResponse): array
    {
        return [
            'id' => $taskResponse->getId(),
            'name' => $taskResponse->getName(),
            'description' => $taskResponse->getDescription(),
            'status' => $taskResponse->getStatus()
        ];
    }
}
