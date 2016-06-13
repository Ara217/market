@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/edit.css')}}">
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <feildset class="form-group">
                            <legend>Registration</legend>
                            {!! Form::model($product, array('method' => 'PATCH', 'action' => array('ProductsController@update', $product->id),'files' => 'true'))!!}
                                @include('products._form', ['submitButton' => 'Update Product', 'imageButton' => 'Change image'])
                            {!! Form::close() !!}
                        </feildset>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop