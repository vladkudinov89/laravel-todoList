<?php

namespace Tests\Feature;

use App\Entities\Task;
use App\Exceptions\Task\TaskDoesNotExistException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_all_tasks_index()
    {
        $tasks = factory(Task::class, 3)->create();

        $response = $this->get('/tasks')
            ->assertStatus(200)
            ->getOriginalContent();

        self::assertEquals($tasks[0]->name , $response['tasks'][0]->name);
        self::assertEquals($tasks[0]->description , $response['tasks'][0]->description);
        self::assertEquals($tasks[0]->status , $response['tasks'][0]->status);
    }

    /** @test */
    public function get_task_by_id()
    {
        $task = factory(Task::class)->create();

        $response = $this->get($task->path())
            ->assertStatus(200)
            ->getOriginalContent();

        self::assertEquals($task->name , $response['task']->name);
        self::assertEquals($task->description , $response['task']->description);
        self::assertEquals($task->status , $response['task']->status);
    }

    /** @test
     *
     * @expectedException \App\Exceptions\Task\TaskDoesNotExistException
     */
    public function get_fake_task_by_id()
    {
        $this->withoutExceptionHandling();

        $this->get('/tasks/' . 9999)
            ->assertStatus(404);
    }


    /** @test */
    public function save_task()
    {
       $this->post('tasks' , [
            'name' => 'new name',
            'description' => 'new description',
            'status' => 1
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

        $this->patch($task->path() , [
            'name' => 'name changed',
            'description' => 'description changed',
            'status' => 1
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

        $this->delete($task->path());

        $this->assertDatabaseMissing('task_lists' , $task->toArray());
    }

    /** @test */
    public function not_found_task_to_delete()
    {
        $this->delete('tasks/' . 9999)
            ->assertStatus(404);
    }

    /** @test */
    public function search_tasks_by_name()
    {
        $tasks = factory(Task::class , 3)->create();

        $response = $this->post('/tasks/search' , [
                'search' => $tasks[0]->name
        ])->getOriginalContent();

        $this->assertDatabaseHas('task_lists' , [
            'name' => $tasks[0]->name
        ]);

        $this->assertEquals($tasks[0]->name , $response['tasks'][0]->name);
    }

    /** @test */
    public function search_tasks_by_description()
    {
        $tasks = factory(Task::class , 3)->create();

        $response = $this->post('/tasks/search' , [
                'search' => $tasks[0]->description
        ])->getOriginalContent();

        $this->assertDatabaseHas('task_lists' , [
            'description' => $tasks[0]->description
        ]);

        $this->assertEquals($tasks[0]->description , $response['tasks'][0]->description);
    }


}
