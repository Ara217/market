@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/add.css')}}">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="col-md-12">
                    <h2>Create new product</h2>
                </div>
                <div class="col-md-12">
                    {!! Form::open(['action' => 'ProductsController@store', 'files' => 'true'])!!}
                        @include('products._form', ['submitButton' => 'Add Product', 'imageButton' => 'Add image'])
                    {!! Form::close() !!}
                </div>
        </div>
    </div>
@stop