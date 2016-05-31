@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="col-md-12">
                    <h2>Create new product</h2>
                </div>
                <div class="col-md-12">
                    {!! Form::open(['action' => 'ProductsController@store'])!!}
                        @include('products.form', ['submitButton' => 'Add Product'])
                    {!! Form::close() !!}
                </div>
        </div>
    </div>
@stop