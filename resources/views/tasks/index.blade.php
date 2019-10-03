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
            @forelse($tasks as $task)
                <tr class="@if($task->getStatus()) text-muted @endif" >
                    <td>{{$task->id}}</td>
                    <td>
                        <a href="{{route('tasks.show' , $task->id)}}">{{$task->name}}</a>
                    </td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->getStatus() ? 'complete' : 'not complete'}}</td>
                    <td>
                        <a class="float-left btn btn-info mr-2"
                           href="{{route('tasks.edit' , $task->id)}}">
                            Edit
                        </a>

                        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <p>No Tasks!</p>
            @endforelse

            </tbody>
        </table>
    </div>
    @endsection
