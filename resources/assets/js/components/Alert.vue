<template>
    <div class="alert alert-success" role="alert">
        <strong id="message">Well done {{message}}!</strong>
    </div>
</template>

<script>
    export default {
        props:{
            message:String
        },
        mounted:function(){
            setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 3000);
        }
    }
</script>
<style>
    #message{
        display: table;
        margin: 0 auto;
    }
</style>
