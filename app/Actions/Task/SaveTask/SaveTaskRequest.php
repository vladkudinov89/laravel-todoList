<?php

namespace App\Actions\Task\SaveTask;

class SaveTaskRequest
{
    protected $name;
    protected $description;
    protected $status;

    public function __construct(string $name , string $description , $status)
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

    public function getStatus(): string
    {
         return  $this->status;
    }
}
