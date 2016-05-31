@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <feildset class="form-group">
                            <legend>Registration</legend>
                            {!! Form::model($product, array('method' => 'PATCH', 'action' => array('ProductsController@update', $product->id)))!!}
                                @include('products.form', ['submitButton' => 'Update Product'])
                            {!! Form::close() !!}
                        </feildset>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop