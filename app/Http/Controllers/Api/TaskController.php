<?php

namespace App\Http\Controllers\Api;

use App\Actions\Task\DeleteTask\DeleteTaskAction;
use App\Actions\Task\DeleteTask\DeleteTaskRequest;
use App\Actions\Task\GetAllTasks\GetAllTasksAction;
use App\Actions\Task\SaveTask\SaveTaskAction;
use App\Actions\Task\SaveTask\SaveTaskPresenter;
use App\Actions\Task\SaveTask\SaveTaskRequest;
use App\Actions\Task\UpdateTask\UpdateTaskAction;
use App\Actions\Task\UpdateTask\UpdateTaskPresenter;
use App\Actions\Task\UpdateTask\UpdateTaskRequest;
use App\Entities\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateSaveTaskRequest;
use App\Http\Requests\ValidateUpdateTaskRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    private $getAllTasksAction;
    private $saveTaskAction;
    private $deleteTaskAction;
    private $updateTaskAction;

    public function __construct(
        GetAllTasksAction $getAllTasksAction,
        SaveTaskAction $saveTaskAction,
        UpdateTaskAction $updateTaskAction,
        DeleteTaskAction $deleteTaskAction
    )
    {
        $this->getAllTasksAction = $getAllTasksAction;
        $this->saveTaskAction = $saveTaskAction;
        $this->deleteTaskAction = $deleteTaskAction;
        $this->updateTaskAction = $updateTaskAction;
    }

    public function index()
    {
        return $this->getAllTasksAction->execute()->getCollection();
    }

    public function store(ValidateSaveTaskRequest $request): JsonResponse
    {
        try {
            $taskResponse = $this->saveTaskAction->execute(new SaveTaskRequest(
                $request->name,
                $request->description,
                $request->status
            ));
        } catch (\Exception $e) {
            return $this->$e->getCode();
        }

        return $this->successResponse(SaveTaskPresenter::present($taskResponse), 201);
    }

    public function destroy(int $id)
    {
        $this->deleteTaskAction->execute(new DeleteTaskRequest($id));

        return $this->emptyResponse( 200);
    }

    public function update(ValidateUpdateTaskRequest $request, Task $task)
    {
        $updateResponse = $this->updateTaskAction->execute(new UpdateTaskRequest(
            $request->id,
            $request->name,
            $request->description,
            $request->status
        ));

        return $this->successResponse(UpdateTaskPresenter::present($updateResponse), 201);
    }

    protected function successResponse(array $data, int $statusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        return JsonResponse::create(['data' => $data], $statusCode);
    }

    protected function emptyResponse(int $statusCode = 200): JsonResponse
    {
        return JsonResponse::create(null, $statusCode);
    }
}
