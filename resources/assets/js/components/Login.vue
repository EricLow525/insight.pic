<template>
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="fa fa-envelope-o"></i></div>
            <div class="form-group">
                <p class="text-center">Login with email, enter your email address and we'll send you a link to login.</p>
                <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox">I have been through Insights Discovery</label>
            </div>
            <div class="form-group"></div>
            <div class="form-group">
                <button class="btn btn-success btn-block" type="submit">Request Login Link</button>
            </div>
        </form>
    </div>
</template>
