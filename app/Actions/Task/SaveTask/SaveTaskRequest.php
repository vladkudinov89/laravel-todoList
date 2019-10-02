<?php

namespace App\Actions\Task\SaveTask;

class SaveTaskRequest
{
    private $name;
    private $description;
    private $status;

    public function __construct(string $name , string $description , bool $status)
    {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
