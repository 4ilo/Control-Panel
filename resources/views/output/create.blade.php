@extends('master')

@section('content')
    <h3>Create new output</h3>
    <form action="{{ route('output.store') }}" method="POST">
        {{ csrf_field() }}

        <!-- Name form input -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" class="form-control" name="name"/>
        </div>

        <!-- Pin form input -->
        <div class="form-group">
            <label for="pin">Pin (BCM_GPIO nr):</label>
            <input type="text" id="pin" class="form-control" name="pin"/>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@stop