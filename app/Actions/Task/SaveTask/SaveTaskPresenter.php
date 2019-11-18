<?php

namespace App\Actions\Task\SaveTask;

class SaveTaskPresenter
{
    public static function present(SaveTaskResponse $taskResponse): array
    {
        return [
            'id' => $taskResponse->getId(),
            'name' => $taskResponse->getName(),
            'description' => $taskResponse->getDescription(),
            'status' => $taskResponse->getStatus()
        ];
    }
}
