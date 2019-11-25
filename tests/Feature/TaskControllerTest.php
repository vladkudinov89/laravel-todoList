<?php

namespace Tests\Feature;

use App\Entities\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_all_tasks_index()
    {
        $tasks = factory(Task::class, 3)->create();

        $response = $this->get('/api/v1/tasks')
            ->assertStatus(200)
            ->getOriginalContent();

        for ($i = 0;$i > count($tasks);$i++){
            self::assertEquals($tasks[$i]->name , $response[$i]->name);
            self::assertEquals($tasks[$i]->description , $response[$i]->description);
            self::assertEquals($tasks[$i]->status , $response[$i]->status);
        }
    }

    /** @test */
    public function save_task()
    {
       $this->post('api/v1/tasks' , [
            'name' => 'new name',
            'description' => 'new description',
            'status' => 'true'
        ]);

        $this->assertDatabaseHas('task_lists' , [
            'name' => 'new name',
            'description' => 'new description',
            'status' => 1
        ]);
    }


    /** @test */
    public function update_task()
    {
        $task = factory(Task::class)->create();

        $this->put('api/v1/tasks/' . $task->id , [
            'name' => 'name changed',
            'description' => 'description changed',
            'status' => 'true'
        ]);

        $this->assertDatabaseHas('task_lists' , [
            'name' => 'name changed',
            'description' => 'description changed',
            'status' => 1
        ]);
    }

    /** @test */
    public function delete_task()
    {
        $task = factory(Task::class)->create();

        $this->delete('api/v1/tasks/'. $task->id);

        $this->assertDatabaseMissing('task_lists' , $task->toArray());
    }

    /** @test */
    public function not_found_task_to_delete()
    {
        $this->delete('api/v1/tasks' . 9999)
            ->assertStatus(404);
    }
}
