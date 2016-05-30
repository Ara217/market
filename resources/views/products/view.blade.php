@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/view.css')}}">

@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                @if(isset($chosenProduct))
                        <h2>{{ $chosenProduct["title"] }}</h2>
                        <p>{{"Description: " . $chosenProduct["description"] }}</p>
                        <p>{{"Price: " . $chosenProduct["price"] . "$" }}</p>
                    <a href="{{$chosenProduct["id"]}}/edit">
                        <button class="btn btn-info">
                            Edit
                        </button>
                    </a><br>
                @endif
            </div>
        </div>
    </div>
@stop
