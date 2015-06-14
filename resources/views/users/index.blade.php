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
            @if( Auth::user()->can('delete_users') )
               <th>Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{!! link_to_route('users.edit', $user->name, $user->id) !!}</td>
                <td>
                    @foreach( $user->roles() as $role )
                        {{ $role->name }}
                    @endforeach
                </td>
                <td>{{ $user->created_at->diffForHumans()  }}</td>
                <td>{{ $user->updated_at->diffForHumans()  }}</td>
                @if( Auth::user()->can('delete_users') )
                    <td>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm-delete']) !!}
                        {!! Form::close() !!}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection