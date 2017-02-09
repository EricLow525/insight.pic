<template>
    <div>
        <div v-bind:style="primaryContainer">
            {{primaryText}}
        </div>
        <div v-bind:style="secondaryContainer">
            {{secondaryText}}
        </div>
    </div>
</template>

<script>
export default {
    created(){
        console.log(this.primaryColor);
        console.log(this.secondaryColor);
        console.log(this.info[0].top);
        console.log(this.info[1].top);
        console.log(this.imgWidth);
        console.log(this.imgHeight);
        console.log("primaryText:"+this.primaryText);
        console.log("secondaryText:"+this.secondaryText);
    },
    props:{
        info: Array,
        imgWidth: Number,
        imgHeight: Number,
        primaryText:String,
        secondaryText:String,
        primaryColor:String,
        secondaryColor:String
    },
    data(){
        return{

        }
    },
    computed:{
        primaryContainer:function(){
            return{
                width:(this.imgWidth*this.info[0].width)/100+'px',
                height:(this.imgHeight*this.info[0].height)/100+'px',
                position:this.info[0].position,
                left:this.info[0].left,
                top:(this.imgHeight*this.info[0].top)/100+'px',
                backgroundColor: this.primaryColor,
                'text-align':this.info[0].textalign,
                color:"white",
                'font-size':"30px"
            }
        },
        secondaryContainer:function(){
            return{
                width:(this.imgWidth*this.info[1].width)/100+'px',
                height:(this.imgHeight*this.info[1].height)/100+'px',
                position:this.info[1].position,
                left:this.info[1].left,
                top: (this.imgHeight*this.info[1].top)/100+'px',
                backgroundColor: this.secondaryColor,
                'text-align':this.info[1].textalign,
                color:"white",
                'font-size':"30px"
            }
        }
    }

}
</script>
