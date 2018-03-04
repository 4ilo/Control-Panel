@extends('master')

@section('content')
    <h1>Dashboard</h1>

    @foreach($outputs as $set)
        <div class="row mt-5">
            @foreach($set as $output)
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header text-center">{{ $output->name }}</div>
                        <div style="font-size: 40px;" class="text-center">
                            @if($output->state())
                                <i class="fa fa-bolt" style="color: green"></i>
                            @else
                                <i class="fa fa-bolt" style="color: red"></i>
                            @endif

                        </div>

                        <div class="card-body">
                            <a href="{{ route('output.activate', $output) }}" class="btn btn-success float-left">
                                Activate
                            </a>
                            <a href="{{ route('output.disable', $output) }}" class="btn btn-danger float-right">
                                Disable
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endforeach
@stop