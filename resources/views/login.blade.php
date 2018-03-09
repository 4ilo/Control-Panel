<!DOCTYPE html>
<html lang="en">
<head>
    <title>Control panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body>

<div class="container">
    <div class="row marginTop">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <h1 class="text-center">Control Panel Login</h1>
            @include('error')

            <form action="{{ route('authenticate') }}" method="post">
            {{ csrf_field() }}

            <!-- Username form input -->
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" required value="{{ old("username") }}" class="form-control"
                           name="username"/>
                </div>

                <!-- Password form input -->
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" required class="form-control" name="password"/>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>