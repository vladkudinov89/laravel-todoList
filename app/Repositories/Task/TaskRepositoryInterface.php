<?php

namespace App\Repositories\Task;

use App\Entities\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function findAll(): Collection;

    public function getById(int $id): ?Task;

    public function save(Task $task): Task;

    public function deleteById(int $id): void;
}
