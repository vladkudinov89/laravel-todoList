<?php

namespace App\Actions\Task\DeleteTask;

class DeleteTaskRequest
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
