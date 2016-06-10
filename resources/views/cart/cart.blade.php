@extends('layouts.app')

@section('head')
    <script src="{{asset('/assets/js/cart.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/assets/css/cart.css')}}">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="lead pull-left">Products in your cart</p>
                        {!! Form::open(['url' => '/market/cart/delete'])!!}
                        {!! Form::submit('Delete Cart', ['class' => "btn btn-info pull-right"]) !!}
                        {!! Form::close() !!}
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Count</th>
                                <th>Delete</th>
                                <th>Select</th>
                            </tr>
                            @foreach($cart as $item)
                                <tr id="main-div-{{$item["rowid"]}}">
                                    <td>
                                        {{ $item["name"] }}
                                    </td>
                                    <td>
                                        {{$item["price"] . "$"}}
                                    </td>
                                    <td>
                                        {{ $item["qty"] }}
                                    </td>
                                    <td>
                                        <button delete-id="{{$item["rowid"]}}" name="delete" class="btn btn-danger deleteFromCart">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </td>
                                    {!! Form::open(['url' => '/market/checkout']) !!}
                                    <td>
                                        <input name="checkbox_{{ $item["rowid"] }}" type="checkbox" value="{{$item["rowid"]}}" id="buy">
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <hr>
                        {!! Form::submit('ORDER', ['id' => 'buyButton', 'class' => 'btn btn-info']) !!}
                        {!! Form::close() !!}
                        <div>
                            <p class="total lead">Total price: {{ $total }}$</p>
                            <p class="count lead">Products in cart: {{ $count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection