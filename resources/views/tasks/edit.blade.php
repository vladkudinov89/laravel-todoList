@extends('layouts.app')

@section('content')
   <div class="container">
       <form class="form-horizontal" action="{{route('tasks.update' , $task->id)}}" method="post">
           <input type="hidden" name="_method" value="put">
           {{csrf_field()}}

           {{--Form include--}}
           @include('tasks.partials.form')


       </form>
   </div>
@endsection
