<!DOCTYPE html>
<html lang="en">
<head>
    <title>Control panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style type="text/css">
        .marginTop {
            margin-top: 50px;
        }
    </style>

    @yield('header')

</head>
<body>

<div class="container">
    <div class="row marginTop">
        <div class="col-sm-2">
            <ul class="list-group">
                <li class="list-group-item"><h4>Outputs</h4></li>
                <li class="list-group-item"><a href="{{ route('output.index') }}">List</a></li>
                <li class="list-group-item"><a href="{{ route('output.create') }}">Add new</a></li>
            </ul>
        </div>
        <div class="col-sm-6">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>