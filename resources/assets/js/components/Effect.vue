<template>
    <div>
        <div v-bind:style="primaryContainer">
            <span v-bind:style="textContainer">{{primaryText}}</span>
        </div>
        <div v-bind:style="secondaryContainer">
            <span v-bind:style="textContainer">{{secondaryText}}</span>
        </div>
    </div>
</template>

<script>
export default {
    created(){
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
        secondaryFontSize:Number,
        primaryTextWidth:Number,
        secondaryTextWidth:Number
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
                left:(this.imgWidth*this.info[0].left)/100+'px',
                top:(this.imgHeight*this.info[0].top)/100+'px',
                backgroundColor: this.hexToRgbA(this.primaryColor,this.primaryColorAlpha),
                'text-align':this.info[0].textalign,
                color:'white',
                'fontFamily':this.primaryFont,
                'fontSize':this.primaryFontSize+'px',
                'display': 'table-cell',
                'vertical-align': 'middle',
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            }
        },
        secondaryContainer:function(){
            return{
                width:(this.imgWidth*this.info[1].width)/100+'px',
                height:(this.imgHeight*this.info[1].height)/100+'px',
                position:this.info[1].position,
                left:(this.imgWidth*this.info[0].left)/100+'px',
                top: (this.imgHeight*this.info[1].top)/100+'px',
                backgroundColor: this.hexToRgbA(this.secondaryColor,this.secondaryColorAlpha),
                'text-align':this.info[1].textalign,
                color:'white',
                'fontFamily':this.secondaryFont,
                'fontSize':this.secondaryFontSize+'px',
                'display': 'table-cell',
                'vertical-align': 'middle',
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            }
        },
        textContainer:function(){
            return {
                'position': 'relative',
                'margin':'auto'
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
        },

    }
}
</script>
