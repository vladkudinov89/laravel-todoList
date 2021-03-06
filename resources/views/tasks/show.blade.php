@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-4 mt-4">View "{{$task->name}}" task</h2>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr class="@if($task->getStatus()) text-muted @endif" >
                    <td>{{$task->id}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->getStatus() ? 'complete' : 'not complete'}}</td>
                    <td>
                        <a class="float-left btn btn-info mr-2"
                           href="{{route('tasks.edit' , $task)}}">
                            Edit
                        </a>

                        <form action="{{ route('tasks.destroy',$task) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-danger" type="submit">
                               Delete
                            </button>
                        </form>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endsection
