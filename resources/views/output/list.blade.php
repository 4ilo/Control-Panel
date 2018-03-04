@extends('master')

@section('content')
    <h3>Control the outputs</h3>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Pin</th>
            <th>Edit</th>
            <th>Remove</th>
        </tr>

        @foreach($outputs as $output)
            <tr>
                <td>{{ $output->name }}</td>
                <td>{{ $output->pin }}</td>
                <td>
                    <a href="{{ route('output.edit', $output) }}"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a style="color: red;" href="{{ route('output.destroy', $output) }}">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@stop