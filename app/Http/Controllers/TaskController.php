<?php

namespace App\Http\Controllers;

use App\Actions\Task\GetAllTasks\GetAllTasksAction;
use App\Actions\Task\GetTaskById\GetTaskByIdAction;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $getAllTasksAction;
    private $getTaskByIdAction;

    public function __construct(
        GetAllTasksAction $getAllTasksAction,
        GetTaskByIdAction $getTaskByIdAction
    )
    {
        $this->getAllTasksAction = $getAllTasksAction;
        $this->getTaskByIdAction = $getTaskByIdAction;
    }

    public function index()
    {
        return $this->getAllTasksAction->execute()->getCollection();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
       return $this->getTaskByIdAction->execute($id)->getModel();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
