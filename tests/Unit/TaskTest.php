<?php

namespace Tests\Unit;

use App\Entities\Task;
use App\Repositories\Task\TaskRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $taskRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskRepository = app(TaskRepository::class);
    }

    /** @test */
    public function task_model()
    {
        $taskName = 'name';
        $taskDescription = 'description';

        $task = factory(Task::class)->create([
            'name' => $taskName,
            'description' => $taskDescription,
        ]);

        self::assertDatabaseHas('task_lists', [
            'name' => $task->name,
            'description' => $task->description,
        ]);

        self::assertEquals($taskName, $task->name);
        self::assertEquals($taskDescription, $task->description);
    }

    /** @test */
    public function task_get_all()
    {
        $tasks = factory(Task::class, 3)->create();

        $repoTasks = $this->taskRepository->findAll();

        self::assertEquals($tasks[0]->name, $repoTasks[0]->name);
    }

    /** @test */
    public function task_get_by_id()
    {
        $task = factory(Task::class)->create();

        $repoID = $this->taskRepository->getById($task->id);

        self::assertEquals($task->id, $repoID->id);
        self::assertEquals($task->name, $repoID->name);
        self::assertEquals($task->description, $repoID->description);
    }

    /** @test */
    public function task_save()
    {
        $newTask = new Task([
            'name' => 'name',
            'description' => 'description',
        ]);

        $repoSave = $this->taskRepository->save($newTask);

        $getRepoSave = $this->taskRepository->getById($repoSave->id);

        self::assertDatabaseHas('task_lists', [
            'name' => $repoSave->name,
            'description' => $repoSave->description,
        ]);

        self::assertEquals($repoSave->id , $getRepoSave->id);
        self::assertEquals($repoSave->name , $getRepoSave->name);
        self::assertEquals($repoSave->description , $getRepoSave->description);
    }

    /** @test */
    public function task_delete()
    {
        $task = factory(Task::class)->create();

        $this->taskRepository->deleteById($task->id);

        $this->assertDatabaseMissing('task_lists' , $task->toArray());
    }


}
