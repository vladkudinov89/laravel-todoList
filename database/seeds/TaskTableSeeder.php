<?php

use App\Entities\Task;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    public function run()
    {
         factory(Task::class , 15)->create();
    }
}
