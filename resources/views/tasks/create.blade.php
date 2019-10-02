@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" action="{{route('tasks.store')}}" method="post">

            {{csrf_field()}}

            {{--Form include--}}
            @include('tasks.partials.form')


        </form>
    </div>
@endsection
