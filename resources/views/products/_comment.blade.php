
{!! Form::text('name', null, ['class' => 'form-control clean', 'placeholder' => 'Name', 'id' => 'name']) !!}
{!! $errors->first('name','<div class="alert alert-danger" role="alert">:message</div>') !!}
<div class="alert alert-danger none" role="alert" data-id="name">

</div>

{!! Form::email('email', null, ['class' => 'form-control clean', 'placeholder' => 'Email', 'id' => 'email']) !!}
{!! $errors->first('email','<div class="alert alert-danger" role="alert">:message</div>') !!}
<div class="alert alert-danger none" role="alert" data-id="email">

</div>

{!! Form::textarea('comment', null, ['class' => 'form-control clean', 'placeholder' => 'Comment', 'id' => 'comment']) !!}
{!! $errors->first('comment','<div class="alert alert-danger" role="alert">:message</div>') !!}
<div class="alert alert-danger none" role="alert" data-id="comment">

</div>
