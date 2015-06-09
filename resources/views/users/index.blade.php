@extends('app')

@section('contentheader_title')
    Users
@endsection

@section('content')

    {!! link_to_route('users.create', 'New User', null, ['class' => 'btn btn-primary']) !!}

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name  }}</td>
                <td><!-- TODO add roles --></td>
                <td>{{ $user->created_at  }}</td>
                <td>{{ $user->updated_at  }}</td>
                <td><!-- TODO Add actions --></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection