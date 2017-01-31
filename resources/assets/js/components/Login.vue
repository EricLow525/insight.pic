<template>
    <div class="login-clean">
        <form method="post" v-on:submit.prevent="Login">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="fa fa-envelope-o"></i></div>
            <div class="form-group">
                <p class="text-center">Login with email, enter your email address and we'll send you a link to login.</p>
                <input class="form-control" type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox">I have been through Insights Discovery
                </label>
            <div class="form-group"></div>
            <div class="form-group">
                <button class="btn btn-success btn-block">Request Login Link</button>
            </div>
        </form>
    </div>
</template>
<script>
    export default{
      mounted() {
          console.log('login')
      },

      data : function() {
          return {
              msg : []
          }
      },

      methods : {
          Login : function(e){
              console.log(e);
              alert($("#email").val());
              e.preventDefault();
              $.ajax({
                  type:"POST",
                  url: "/api/login",
                  data: {email:$("#email").val()},
                  success: function(result){
                      alert(result);
                  }
              });
          }
      }
    }
</script>
