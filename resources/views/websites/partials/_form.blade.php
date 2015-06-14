<!-- Website Details -->
<div class="form-group">
    {!! Form::label('url', 'Website Address', ['class' => 'control-label']) !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ip', 'Website IP Address', ['class' => 'control-label']) !!}
    {!! Form::text('ip', null, ['class' => 'form-control']) !!}
</div>

<!-- FTP Details -->
<div class="form-group">
    {!! Form::label('ftp_host', 'FTP Host', ['class' => 'control-label']) !!}
    {!! Form::text('ftp_host', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('ftp_username', 'FTP Username', ['class' => 'control-label']) !!}
    {!! Form::text('ftp_username', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('ftp_password', (isset($password_ftp) ? $password_ftp : 'FTP Password'), ['class' => 'control-label']) !!}
    {!! Form::password('ftp_password', ['class' => 'form-control']) !!}
</div>

<!-- SSH Details -->
<div class="form-group">
    {!! Form::label('ssh_host', 'SSH Host', ['class' => 'control-label']) !!}
    {!! Form::text('ssh_host', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('ssh_username', 'SSH Username', ['class' => 'control-label']) !!}
    {!! Form::text('ssh_username', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('ssh_password', (isset($password_ssh) ? $password_ssh : 'SSH Password'), ['class' => 'control-label']) !!}
    {!! Form::password('ssh_password', ['class' => 'form-control']) !!}
</div>

<!-- Save form -->
<div class="form-group">
    {!! Form::submit(isset($buttonText) ? $buttonText : 'Add Website', ['class' => 'btn btn-primary']) !!}
</div>