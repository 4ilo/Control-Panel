@extends('master')

@section('content')
    <h3>Update {{ $output->name }}</h3>
    <form action="{{ route('output.update', $output) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH')  }}

        <!-- Name form input -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" value="{{ $output->name }}" class="form-control" name="name"/>
        </div>

        <!-- Pin form input -->
        <div class="form-group">
            <label for="pin">Pin (BCM_GPIO nr):</label>
            <input type="text" id="pin" value="{{ $output->pin }}" class="form-control" name="pin"/>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@stop