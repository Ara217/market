@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/market.css')}}">
    <script src="{{asset('/assets/js/main.js')}}"></script>

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
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Created_at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach($productsAll as $product)
                                <tr id="main_div_{{$product["id"]}}">
                                    <td>
                                        {{$product["id"]}}
                                    </td>
                                    <td>
                                        <a href="market/{{$product["id"]}}">
                                            {{ $product["title"] }}
                                        </a>
                                    </td>
                                    <td>
                                        {{$product["price"]}}
                                    </td>
                                    <td>
                                        {{$product["created_at"]}}
                                    </td>
                                    <td>
                                        <a href="/market/{{$product["id"]}}/edit" class="edit">
                                            <button class="btn btn-info">Edit</button>
                                        </a>
                                    </td>
                                    <td>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                        <button class="btn btn-danger delete-product" data-id="{{$product["id"]}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
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