@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-4 mt-4">Add task</h2>

        <form class="form-horizontal" action="{{route('tasks.store')}}" method="post">

            {{csrf_field()}}

            {{--Form include--}}
            @include('tasks.partials.form')


        </form>
    </div>
@endsection
