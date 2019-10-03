@extends('layouts.app')

@section('content')
   <div class="container">

       <h2 class="mb-4 mt-4">Edit task</h2>

       <form class="form-horizontal" action="{{route('tasks.update' , $task->id)}}" method="post">
           <input type="hidden" name="_method" value="put">
           {{csrf_field()}}

           {{--Form include--}}
           @include('tasks.partials.form')


       </form>
   </div>
@endsection
