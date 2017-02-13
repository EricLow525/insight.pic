<!DOCTYPE html>
<html style="height:100%;">
<head>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' };</script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <title>insights.pics</title>
</head>
<body>
    <div class="login-background">
        <div class="login-wrap">
        	<div class="login-html">
        		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
        		<div class="login-form">
        			<div class="sign-in-htm">
        				<div class="group">
        					<label for="user" class="label">Username</label>
        					<input id="user" type="text" class="input">
        				</div>
        				<div class="group">
        					<label for="pass" class="label">Password</label>
        					<input id="pass" type="password" class="input" data-type="password">
        				</div>
        				<div class="group">
        					<input id="check" type="checkbox" class="check" checked>
        					<label for="check"><span class="icon"></span> Keep me Signed in</label>
        				</div>
        				<div class="group">
        					<input type="submit" class="button" id="signin" value="Sign In">
        				</div>
        				<div class="hr"></div>
        				<div class="foot-lnk">
        					<a href="#forgot">Forgot Password?</a>
        				</div>
        			</div>
        			<div class="sign-up-htm">
        				<div class="group">
        					<label for="user" class="label">Username</label>
        					<input id="signup_user" type="text" class="input" required="" >
        				</div>
        				<div class="group">
        					<label for="pass" class="label">Password</label>
        					<input id="signup_pass" type="password" class="input" data-type="password" required="" >
        				</div>
        				<div class="group">
        					<label for="repass" class="label">Repeat Password</label>
        					<input id="repass" type="password" class="input" data-type="password" required="" >
        				</div>
        				<div class="group">
        					<label for="email" class="label">Email Address</label>
        					<input id="email" type="text" class="input" required="">
        				</div>
                        <div class="hr"></div>
        				<div class="group">
        					<input type="submit" class="button" id="signup" value="Sign Up">
        				</div>
        			</div>
        		</div>
    	    </div>
        </div>
    </div>
</body>
<script>

$(document).ready(function(){
    $('#signin').click(function(){
        var flag=0;
        var user=$('#user').val();
        var pass=$('#pass').val();
        if(user=='' || pass==''){
            flag=1;
            alert("input the username or password");
        }else{
            $.ajax({
                type:"POST",
                url: "/api/register",
                data: {username:user,password:pass},
                success: function(result){

                }
            });
        }
    });
    $('#signup').click(function(){
        var flag=0;
        var user=$('#signup_user').val();
        var pass=$('#signup_pass').val();
        var repass=$('#repass').val();
        var email=$('#email').val();
        if(user=='' || pass=='' || repass==''||email==''){
            flag=1;
        }else{
            if(pass==repass){
                $.ajax({
                    type:"POST",
                    url: "/api/register",
                    data: {username:user,password:pass,email:email},
                    success: function(result){
                        alert(result);
                    }
                });
            }else alert("input password again");
        }
    })
})
</script>

</html>
