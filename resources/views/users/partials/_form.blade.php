<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email address', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', isset($password) ? $password : 'Password', ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password2', 'Repeat Password', ['class' => 'control-label']) !!}
    {!! Form::password('password2', ['class' => 'form-control']) !!}
</div>

@if( Auth::user()->can('assign_clients') )
<div class="form-group">
    {!! Form::label('client_id', 'Client', ['class' => 'control-label']) !!}
    {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
</div>
@endif

@if( Auth::user()->can('assign_roles') && ( !isset($user) || $user->id != Auth::user()->getId() ) )
<div class="form-group">
    {!! Form::label('role', 'Role', ['class' => 'control-label']) !!}
    {!! Form::select('role', $roles, (isset($role_id) ? $role_id : null), ['class' => 'form-control']) !!}
</div>
@endif

<div class="form-group">
    {!! Form::submit(isset($buttonText) ? $buttonText : 'Add user', ['class' => 'btn btn-primary']) !!}
</div>