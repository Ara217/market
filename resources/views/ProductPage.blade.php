@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
               {{-- @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('update') }}
                    </div>
                @endif--}}
                @if(isset($chosenProduct))
                        <h2>{{ $chosenProduct["title"] }}</h2>
                        <p>{{"Description: " . $chosenProduct["description"] }}</p>
                        <p>{{"Price: " . $chosenProduct["price"] . "$" }}</p>
                    <a href="{{$chosenProduct["id"]}}/edit">Edit</a><br>
                    <button class="btn btn-danger">Delete</button>
                @endif
            </div>
        </div>
    </div>
@stop