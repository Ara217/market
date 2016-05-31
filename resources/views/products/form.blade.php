{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
{!! $errors->first('title','<div class="alert alert-danger" role="alert">:message</div>') !!}

{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
{!! $errors->first('description','<div class="alert alert-danger" role="alert">:message</div>') !!}

{!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'price']) !!}
{!! $errors->first('price','<div class="alert alert-danger" role="alert">:message</div>') !!}

{!! Form::submit($submitButton, ['class' => 'btn btn-default']) !!}