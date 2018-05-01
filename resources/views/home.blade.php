<!DOCTYPE html>
<html lang="en">
<head>
    <title>Control panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

<div class="container" id="app">
    <div class="row marginTop">
        <div class="col-sm-2">
            <div class="text-center mb-2">
                <button type="button" @click="toggleMenu" class="btn btn-secondary d-sm-none">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <ul class="list-group" :class="{'d-none d-sm-block': showMenu}">
                <li class="list-group-item"><h4>Dashboard</h4></li>

                <router-link to="/" tag="li" class="list-group-item" exact>
                    <a>Home</a>
                </router-link>

                <li class="list-group-item"><h4>Outputs</h4></li>

                <router-link to="/output" tag="li" class="list-group-item" exact>
                    <a>List</a>
                </router-link>

                <router-link to="/output/create" tag="li" class="list-group-item" exact>
                    <a>Add new</a>
                </router-link>

                <li class="list-group-item"><h4>Logout</h4></li>
                <li class="list-group-item">
                    <a href="/logout">Logout</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-10">
            <router-view></router-view>
            <flash></flash>
        </div>
    </div>


</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>