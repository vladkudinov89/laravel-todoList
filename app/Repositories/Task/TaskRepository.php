<?php

namespace App\Repositories\Task;

use App\Entities\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function findAll(): Collection
    {
        return Task::all();
    }

    public function getById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function save(Task $task): Task
    {
        $task->save();

        return $task;
    }

    public function deleteById(int $id): void
    {
        Task::destroy($id);
    }

}
