<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js">
    <title>insights.pics</title>
    <link rel="stylesheet" href="/css/user.css">
    <link rel="stylesheet" href="/css/Article-Clean.css">
    <link rel="stylesheet" href="/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="/css/Team-Grid.css">
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
                            <li role="active"><router-link to="/">Home </router-link></li>
                            @if(isset($email)>0)
                            <li role="presentation"><router-link to="/dashboard">Dashboard </router-link></li>
                            <li role="presentation"><router-link to="/logout">Logout </router-link></li>
                            @else
                            <li role="presentation"><router-link to="/login">Login </router-link></li>
                            @endif
                            <li role="presentation"><router-link to="/abouts">About </router-link></li>
                            <li role="presentation"><router-link to="/rooms">Rooms </router-link> </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <router-view></router-view>
    </div>{{-- /container --}}
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
