<template>
    <div>
        haha
    </div>
</template>

<script>
export default {
    created(){
        console.log(this.primaryColor);
        console.log(this.secondaryColor);
        console.log(this.info);
        console.log(this.imgWidth);
        console.log(this.imgHeight);
        console.log(this.primaryText);
        console.log(this.secondaryText);
    },
    props:{
        primaryColor:String,
        secondaryColor:String,
        info: String,
        imgWidth: Number,
        imgHeight: Number,
        primaryText:String,
        secondaryText:String
    },
    data(){
        return{

        }
    }
}
</script>
