<?php

namespace Tests\Unit;

use App\Entities\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function task_model()
    {
        $taskName = 'name';
        $taskDescription = 'description';

        $task = factory(Task::class , 1)->create([
            'name' => $taskName,
            'description' => $taskDescription,
        ]);

        self::assertEquals($taskName , $task[0]->name);
        self::assertEquals($taskDescription , $task[0]->description);
    }

}
