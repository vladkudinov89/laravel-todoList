@extends('layouts.app')

@section('content')
    <div class="container">
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
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->isComplete() ? 'complete' : 'not complete'}}</td>
                    <td>
                        <a class="float-left edit-button"
                           href="{{route('tasks.edit' , $task->id)}}">
                            Edit
                        </a>

                        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="delete-button button-delete" type="submit">
                               Delete
                            </button>
                        </form>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endsection
