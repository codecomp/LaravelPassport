@extends('app')

@section('contentheader_title')
    {{ $contentheader_title  }}
@endsection

@section('contentheader_description')
    {{ $contentheader_description  }}
@endsection

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                @foreach( $table_column_name as $name )
                    <th>{{ $name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach( $column_row as $row )
                <tr>
                    @foreach( $column as $col )
                        <td>{{ $col  }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection