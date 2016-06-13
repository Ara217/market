@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/market.css')}}">
    <script src="{{asset('/assets/js/main.js')}}"></script>

@stop

@section('content')
    <div class="shadow">
        <div class="popup_container">
            <p class="text-center">Are you sure you want to delete this product?</p>
            <div class="col-md-10 col-md-offset-1">
                <button class="btn btn-danger confirm-delete-product">Yes</button>
                <button class="btn btn-info confirm-delete-product-no">No</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="list-inline">
                            <li>
                                <a href="market/create">
                                    <button class="btn btn-info popup">
                                        Add product
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-heading">
                        <p class="lead">Products list</p>
                        <table class="table table-striped">
                            @foreach($productsAll as $product)
                                <tr id="main_div_{{$product["id"]}}">
                                    <td class="">
                                        {{$product["id"]}}
                                    </td>
                                    <td>
                                        <div class="imageDiv">
                                            <img src="/" alt="">
                                        </div>
                                        <div class="infoDiv">
                                            <a href="market/{{$product["id"]}}">
                                                {{ $product["title"] }}
                                            </a>
                                            <p>
                                                Description: {{ $product["description"] }}
                                            </p>
                                            <p>
                                                Price: {{$product["price"] . "$"}}
                                            </p>
                                            <a href="/market/{{$product["id"]}}/edit" class="edit">
                                                <button class="btn btn-info">Edit</button>
                                            </a>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                            <button class="btn btn-danger delete-product" data-id="{{$product["id"]}}">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection