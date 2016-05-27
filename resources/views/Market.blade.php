@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/market.css')}}">

@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="list-inline">
                            <li>
                                <a href="market/create">
                                    Add product
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-heading">
                        <p class="lead">Products list</p>

                        @foreach($ProductList as $product)
                            <div class="productBlock">
                                <a href="market/{{$product["id"]}}">
                                    {{ $product["title"] }}
                                </a>
                            </div>
                            @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection