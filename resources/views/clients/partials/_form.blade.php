<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit(isset($buttonText) ? $buttonText : 'Add Client', ['class' => 'btn btn-primary']) !!}
</div>