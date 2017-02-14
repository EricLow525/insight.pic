<template>
    <div class="alert alert-success" role="alert">
        <strong>Well done!</strong> {{message}}.
    </div>
</template>

<script>
    export default {
        props:{
            message:String
        }
    }
</script>
