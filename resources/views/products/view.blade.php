@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/view.css')}}">
    <script src="{{asset('/assets/js/validationCustom.js')}}"></script>
    <script src="{{asset('/assets/js/view.js')}}"></script>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(isset($chosenProduct))
                    <h2>{{ $chosenProduct["title"] }}</h2>
                    <p>{{"Description: " . $chosenProduct["description"] }}</p>
                    <p>{{"Price: " . $chosenProduct["price"] . "$" }}</p>
                    <a href="{{$chosenProduct["id"]}}/edit">
                        <button class="btn btn-info">
                            Edit
                        </button>
                    </a>
                    {!! Form::hidden('id', $chosenProduct["id"], ['class' => 'form-control']) !!}
                    {!! Form::hidden('title', $chosenProduct["title"], ['class' => 'form-control']) !!}
                    {!! Form::hidden('price', $chosenProduct["price"], ['class' => 'form-control']) !!}
                    {!! Form::hidden('_token', 'token', ['id' => 'token', 'data-value-buy' => csrf_token()]) !!}
                    <button id='buyButton' class='btn btn-info btn-buy' title="Add to cart">
                        Buy
                    </button>
                @endif
            </div>
            <div class="col-md-10 col-md-offset-1" id="form_block">
                <hr>
                <input type="hidden" data-value="{{$chosenProduct["id"]}}" id="hidden" name="product_id">
                @include('products._comment')
                <input id="token" type="hidden" name="_token" data-value-token="{{ csrf_token() }}">
                <button id="comment_send" class="btn btn-info">Comment</button>
            </div>
            <hr>
            <div class="col-md-10 col-md-offset-1">
                <hr>
                <table class="table table-striped test" id="commnet_table">
                    <caption>Comments</caption>
                    @foreach($comments as $comment)
                        <tr>
                            <td>
                                {{"By: " . $comment["name"]}}<br>
                                {{"Email: " . $comment["email"]}}<br>
                                {{"Commnet: " . $comment["comment"]}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop
