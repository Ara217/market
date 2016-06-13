{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
{!! $errors->first('title','<div class="alert alert-danger" role="alert">:message</div>') !!}

{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
{!! $errors->first('description','<div class="alert alert-danger" role="alert">:message</div>') !!}

{!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
{!! $errors->first('price','<div class="alert alert-danger" role="alert">:message</div>') !!}

{!! Form::number('count', null, ['class' => 'form-control', 'placeholder' => 'Count']) !!}
{!! $errors->first('count','<div class="alert alert-danger" role="alert">:message</div>') !!}

<label class="btn btn-primary btn-file">
    {{$imageButton}}
{!! Form::file('image', null) !!}
</label><br>
{!! $errors->first('count','<div class="alert alert-danger" role="alert">:message</div>') !!}


{!! Form::submit($submitButton, ['class' => 'btn btn-default']) !!}