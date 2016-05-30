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

                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                    {{ $errors->first('title') }}

                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    {{ $errors->first('description') }}

                    {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
                    {{ $errors->first('price') }}

                    {!! Form::submit('addProduct', ['class' => 'btn btn-default', 'Value' => 'Add Product']) !!}

                    {!! Form::close() !!}
                </div>
        </div>
    </div>
@stop