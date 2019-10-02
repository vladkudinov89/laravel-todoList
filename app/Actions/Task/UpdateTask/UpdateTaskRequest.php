<?php

namespace App\Actions\Task\UpdateTask;

class UpdateTaskRequest
{
    private $id;
    private $name;
    private $description;
    private $status;

    public function __construct(int $id , string $name , string $description , bool $status)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
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
