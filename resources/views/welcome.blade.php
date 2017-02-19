<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js">
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
    <title>insights.pics</title>
</head>

<body>
    <div id="app">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="fa fa-picture-o"></i>Insights.pics</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="navbar-font" role="active"><router-link to="/">Home </router-link></li>
                            <li role="presentation"><router-link to="/about">About </router-link></li>
                            @if(isset($email))
                            <li role="presentation"><router-link to="/dashboard">Dashboard </router-link></li>
                            <li role="presentation"><a href="/logout" style="cursor: pointer;">Logout</a>
                            @else
                            <li role="presentation"><router-link to="/login">Login </router-link></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <router-view></router-view>
    </div>{{-- /container --}}

    @if(isset($email))
    <script>
        var email="{{$email}}";
        var userId={{$user_id}};
        var token="{{$token}}";
    </script>
    @endif
    <script src="/js/app.js"></script>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Insights.pics © 2017</h5></div>
                <div class="col-sm-7">
                    <h6 class="text-center">Insights Discovery and Insights Learning Systems were originated by Andi and Andy Lothian. Insights, Insights Discovery and the Insights Wheel are registered trademarks of The Insights Group Ltd.&nbsp;Insights.pics is not affliated with The Insights Group Ltd, we created this as customers and believers in the benefits of the <a href="https://www.insights.com/">Insights Discovery</a>.</h6></div>
                <div class="col-sm-2 social-icons"><a href="https://www.facebook.com/InsightsConnections/" target="_blank"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/Insights" target="_blank"><i class="fa fa-twitter"></i></a></div>
            </div>
        </div>
    </footer>
</body>
</html>
