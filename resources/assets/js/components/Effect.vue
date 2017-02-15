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
    },
    props:{
        info: Array,
        imgWidth: Number,
        imgHeight: Number,
        primaryText:String,
        secondaryText:String,
        primaryColor:String,
        secondaryColor:String,
        primaryColorAlpha:Number,
        secondaryColorAlpha:Number,
        primaryFont:String,
        primaryFontSize:Number,
        secondaryFont:String,
        secondaryFontSize:Number
    },
    data(){
        return{

        }
    },
    computed:{
        primaryContainer:function(){
            console.log(this.primaryFontSize);
            console.log(this.primaryFont);
            return{
                width:(this.imgWidth*this.info[0].width)/100+'px',
                height:(this.imgHeight*this.info[0].height)/100+'px',
                position:this.info[0].position,
                left:(this.imgWidth*this.info[0].left)/100+'px',
                top:(this.imgHeight*this.info[0].top)/100+'px',
                backgroundColor: this.hexToRgbA(this.primaryColor,this.primaryColorAlpha),
                'text-align':this.info[0].textalign,
                color:"white",
                'font-size':this.primaryFontSize+'px',
                'font-family':this.primaryFont,
            }
        },
        secondaryContainer:function(){
            console.log(this.secondaryFontSize);
            console.log(this.secondaryFont);
            return{
                width:(this.imgWidth*this.info[1].width)/100+'px',
                height:(this.imgHeight*this.info[1].height)/100+'px',
                position:this.info[1].position,
                left:(this.imgWidth*this.info[0].left)/100+'px',
                top: (this.imgHeight*this.info[1].top)/100+'px',
                backgroundColor: this.hexToRgbA(this.secondaryColor,this.secondaryColorAlpha),
                'text-align':this.info[1].textalign,
                color:"white",
                'font-size':this.secondaryFontSize+'px',
                'font-family':this.secondaryFont,
            }
        }
    },
    methods:{
        hexToRgbA: function(hex,alpha){
            var c;
            if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
                c= hex.substring(1).split('');
                if(c.length== 3){
                    c= [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c= '0x'+c.join('');
                return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+','+alpha+')';
            }
            throw new Error('Bad Hex');
        }
    }

}
</script>
