<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>insights.pics</title>
    <link rel="stylesheet" href="/css/user.css">
    <link rel="stylesheet" href="/css/Article-Clean.css">
    <link rel="stylesheet" href="/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="/css/Team-Grid.css">
</head>

<body>
<
<!--
    <div id="app">
        <div class="container">
          <h3> Basic Routing </h3>

          <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    <router-link to="/" class="list-group-item ">Home</router-link>
                    <router-link to="/login" class="list-group-item ">login</router-link>
                    <router-link to="/about" class="list-group-item ">About</router-link>
                    <router-link to="/rooms" class="list-group-item ">Rooms</router-link>
                </div>
            </div>

            <router-view class="view"></router-view>

        </div>
    </div>{{-- /container --}} -->

    <div id="app">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="fa fa-picture-o"></i>Insights.pics</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><router-link to="/">Home </router-link></li>
                            <li><router-link to="/login">Login </router-link></li>
                            <li><router-link to="/about">About </router-link></li>
                            <li><router-link to="/rooms">Rooms </router-link> </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <router-view></router-view>
    </div>{{-- /container --}}

    <script src="/js/app.js"></script>
</body>
</html>
