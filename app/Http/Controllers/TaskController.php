<?php

namespace App\Http\Controllers;

use App\Actions\Task\GetAllTasks\GetAllTasksAction;
use App\Actions\Task\GetTaskById\GetTaskByIdAction;
use App\Actions\Task\UpdateTask\UpdateTaskAction;
use App\Actions\Task\UpdateTask\UpdateTaskRequest;
use App\Entities\Task;
use App\Http\Requests\ValidateUpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $getAllTasksAction;
    private $getTaskByIdAction;
    private $updateTaskAction;

    public function __construct(
        GetAllTasksAction $getAllTasksAction,
        GetTaskByIdAction $getTaskByIdAction,
        UpdateTaskAction $updateTaskAction
    )
    {
        $this->getAllTasksAction = $getAllTasksAction;
        $this->getTaskByIdAction = $getTaskByIdAction;
        $this->updateTaskAction = $updateTaskAction;
    }

    public function index()
    {
        return view('tasks.index', [
            'tasks' => $this->getAllTasksAction->execute()->getCollection()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create', [
            'task' => [],
            'buttonAction' => 'add task'
        ]);
    }

    public function store(Request $request)
    {
        $task = new Task([
            'name' => $request->name,
            'description' => $request->description,
            'is_complete' => (bool) $request->status
        ]);

        $task->save();

        return redirect()->route('tasks.index')->with('status', 'Success Add task');
    }

    public function show(int $id)
    {
        return view('tasks.show', [
            'task' => $this->getTaskByIdAction->execute($id)->getModel()
        ]);
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
            'buttonAction' => 'update'
        ]);
    }

    public function update(ValidateUpdateTaskRequest $request, Task $task)
    {
        $this->updateTaskAction->execute(new UpdateTaskRequest(
            $task->id,
            $request->name,
            $request->description,
            (bool) $request->status
        ))->toArray();

        return redirect()->route('tasks.show', $task->id)
            ->with('status', 'Success Update task');
    }

    public function destroy(Task $task)
    {

    }
}
