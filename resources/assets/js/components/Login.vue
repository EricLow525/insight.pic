<template>
    <div class="login-clean">
        <form method="post" v-on:submit.prevent="Login">
            <h2 class="sr-only">Login Form</h2>
            <alert v-if="flag==1" v-bind:message="msg"></alert>
            <div class="illustration"><i class="fa fa-envelope-o"></i></div>
            <div class="form-group">
                <p class="text-center">Login with email, enter your email address and we'll send you a link to login.</p>
                <input class="form-control" type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="discover" v-bind:true-value="1" v-bind:false-value="0">I have been through Insights Discovery
                </label>
            </div>
            <div class="form-group"></div>
            <div class="form-group">
                <button class="btn btn-success btn-block">Request Login Link</button>
            </div>
        </form>
    </div>
</template>
<script>
import Alert from './Alert.vue'
    export default{
        mounted() {

        },

        data : function() {
            return {
                msg : '',
                discovery:0,
                flag:0
            }
        },
        components: {
            'alert': Alert,
        },
        methods : {
            Login : function(e){
                var self=this;
                e.preventDefault();
                var isChecked = $("#discover").prop("checked");
                if(isChecked==true){
                    this.discovery=1;
                }else this.discovery=0;
                $.ajax({
                    type:"POST",
                    url: "/api/login",
                    data: {email:$("#email").val(),checkVal:this.discovery},
                    success: function(result){
                        self.msg=result;
                        self.flag=1;
                    }
                });
            }
        }
    }
</script>
