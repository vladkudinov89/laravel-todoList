<?php

namespace App\Http\Controllers;

use App\Actions\Task\DeleteTask\DeleteTaskAction;
use App\Actions\Task\DeleteTask\DeleteTaskRequest;
use App\Actions\Task\GetAllTasks\GetAllTasksAction;
use App\Actions\Task\GetTaskById\GetTaskByIdAction;
use App\Actions\Task\SaveTask\SaveTaskAction;
use App\Actions\Task\SaveTask\SaveTaskRequest;
use App\Actions\Task\UpdateTask\UpdateTaskAction;
use App\Actions\Task\UpdateTask\UpdateTaskRequest;
use App\Entities\Task;
use App\Http\Requests\ValidateSaveTaskRequest;
use App\Http\Requests\ValidateUpdateTaskRequest;

class TaskController extends Controller
{
    private $getAllTasksAction;
    private $getTaskByIdAction;
    private $updateTaskAction;
    private $saveTaskAction;
    /**
     * @var DeleteTaskAction
     */
    private $deleteTaskAction;

    public function __construct(
        GetAllTasksAction $getAllTasksAction,
        GetTaskByIdAction $getTaskByIdAction,
        UpdateTaskAction $updateTaskAction,
        SaveTaskAction $saveTaskAction,
        DeleteTaskAction $deleteTaskAction
    )
    {
        $this->getAllTasksAction = $getAllTasksAction;
        $this->getTaskByIdAction = $getTaskByIdAction;
        $this->updateTaskAction = $updateTaskAction;
        $this->saveTaskAction = $saveTaskAction;
        $this->deleteTaskAction = $deleteTaskAction;
    }

    public function index()
    {
        return view('tasks.index', [
            'tasks' => $this->getAllTasksAction->execute()->getCollection()
        ]);
    }

    public function create()
    {
        return view('tasks.create', [
            'task' => [],
            'buttonAction' => 'add task'
        ]);
    }

    public function store(ValidateSaveTaskRequest $request)
    {
        $this->saveTaskAction->execute(new SaveTaskRequest(
            $request->name,
            $request->description,
            $request->status
        ))->toArray();

        return redirect()->route('tasks.index')
            ->with('status', 'Success Add task');
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
            $request->status
        ))->toArray();

        return redirect()->route('tasks.show', $task->id)
            ->with('status', 'Success Update task');
    }

    public function destroy(Task $task)
    {
        $this->deleteTaskAction->execute(new DeleteTaskRequest($task->id));

        return redirect()->route('tasks.index')
            ->with('status' , 'Task Success Deleted!');
    }
}
