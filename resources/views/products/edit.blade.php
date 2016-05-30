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

                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
                            {!! $errors->first('title','<div class="alert alert-danger" role="alert">:message</div>') !!}

                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
                            {!! $errors->first('description','<div class="alert alert-danger" role="alert">:message</div>') !!}

                            {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'price']) !!}
                            {!! $errors->first('price','<div class="alert alert-danger" role="alert">:message</div>') !!}

                            {!! Form::submit('updateProduct', ['class' => 'btn btn-default', 'Value' => 'Update Product']) !!}

                            {!! Form::close() !!}
                        </feildset>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop