<template>
<div>
    <div class="container">
        <div class="row">
            <h1>Insights.pics Creator</h1>
            <p>The first step is to select your Insights colors. Choose your primary color and one or two secondary colors.</p>
        </div>
    </div>
    <div>
        <div class="container" v-if="loaded">
            <div class="row">
                <div class="col-md-4">
                    <h3>Select the design </h3>
                    <div class="row design">
                        <ul style="list-style: none;">
                            <li style="padding-bottom:3px;" v-for="design in designList">
                                <i v-if="design.urlId==userProfile.design.urlId" class="glyphicon glyphicon-check"> </i>
                                <img @click="onSelectDesign(design)" :src="design.url">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div>
                        <div class="row">
                            <div class="col-md-4">
                                <h3>Primary Color</h3>
                            </div>
                            <div v-for="color in colors" class="col-md-2">
                                <button class="btn" v-bind:style="[color.style]" @click="onPriColorChange(color)">
                                         <i v-if="color.colorId==userProfile.priColor.colorId" class="glyphicon glyphicon-ok"> </i>{{color.colorName}}
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Secondary Color(s)</h3>
                                    </div>
                                    <div v-for="color in colors" class="col-md-2">
                                        <button class="btn" v-bind:style="[color.style]" @click="onSecColorChange(color)">
                                            <i v-if="color.colorId==userProfile.secColor.colorId" class="glyphicon glyphicon-ok"></i> {{color.colorName}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="team-grid">
                        <div class="container">
                            <div class="intro"></div>
                        </div>
                    </div>
                    <div class="container">
                        <section></section>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="inputValue">
                                <p>(The picture area is a dropzone to browse or drag and drop. The left side lets the pick from designs and applies to the image they uploaded.)</p>
                                <h4>Insights.pics Text:</h4>
                                <div class="input-group">
                                    <div class="input-group-addon"><span>Text </span></div>
                                    <input class="form-control" v-model="priText" type="text" id="priTextInput">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" @click="onPrimaryText">Update </button>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon"><span>Text </span></div>
                                    <input class="form-control" v-model="secText" type="text" id="secTextInput">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" @click="onSecondaryText">Update </button>
                                    </div>
                                </div>
                                <div v-bind:style="{fontSize:userProfile.primaryFontSize+'px',fontFamily:userProfile.primaryFont}">{{userProfile.priText}}</div>
                                <div id="pridiv" v-bind:style="{fontSize:userProfile.primaryFontSize+'px',fontFamily:userProfile.primaryFont}" hidden>{{userProfile.priText}}</div>
                                <div id="secdiv" v-bind:style="{fontSize:userProfile.secondaryFontSize+'px',fontFamily:userProfile.secondaryFont}" hidden>{{userProfile.secText}}</div>
                            </div>
                            <div>
                                <h4>Insights.pics Fonts & Font Sizes:</h4>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <p>Primary fonts & font sizes </p>
                                    </div>
                                    <div class="col-md-6" style="margin-left:7px">
                                        <form id="primary_font_style">
                                            <select id="primaryfont" v-model="userProfile.primaryFont" @change="onChangePriFont">
                                                <option value="0"></option>
                                                <option v-for="font in fontArray" :value="font.value">{{font.fontname}}</option>
                                            </select>
                                            <select id="primary_fontsize" v-model="userProfile.primaryFontSize" @change="onChangePriFontSize">
                                                <option value="0"></option>
                                                <option v-for="size in fontsizeArray" :value="size.value">{{size.Size}}</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3" style="margin-left:14px">
                                        <p>Secondary fonts & font sizes </p>
                                    </div>
                                    <div class="col-md-6">
                                        <form id="secondary_font_style">
                                            <select id="secondaryfont" v-model="userProfile.secondaryFont" @change="onChangeSecFont">
                                                <option value=""></option>
                                                <option v-for="font in fontArray" :value="font.value">{{font.fontname}}</option>
                                            </select>
                                            <select id="secondary_fontsize" v-model="userProfile.secondaryFontSize" @change="onChangeSecFontSize">
                                                <option value=""></option>
                                                <option v-for="size in fontsizeArray" :value="size.value">{{size.Size}}</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom:8px;" class="inputValue" v-if="!image.length">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Picture(s) Upload</h4>
                                            <p>The second step is to upload pictures and apply some Insights.pics designs. Then just download and share.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropzone-area" drag-over="handleDragOver">
                                    <div class="dropzone-text">
                                        <span class="dropzone-title">Drop image here or click to select</span>
                                    </div>
                                    <input type="file" @change="onFileChange">
                                </div>
                            </div>
                            <div class="dropzone-preview" v-else>
                                <button style="margin-top:8px;" class="button" @click="removeImage"> <i class="glyphicon glyphicon-remove-sign"></i>Remove</button>
                                <div style="margin-top:8px;" v-bind:style="imageContainer" id="image-merge">
                                    <img :src="image" />
                                    <effect v-if="imageWidth!=0 "
                                        v-bind:info="userProfile.design.info"
                                        v-bind:imgWidth="imageWidth"
                                        v-bind:imgHeight="imageHeight"
                                        v-bind:primaryText="userProfile.priText"
                                        v-bind:secondaryText="userProfile.secText"
                                        v-bind:primaryColor="userProfile.priColor.style.backgroundColor"
                                        v-bind:secondaryColor="userProfile.secColor.style.backgroundColor"
                                        v-bind:primaryColorAlpha="userProfile.priColor.alpha"
                                        v-bind:secondaryColorAlpha="userProfile.secColor.alpha"
                                        v-bind:primaryFont="userProfile.primaryFont"
                                        v-bind:primaryFontSize="userProfile.primaryFontSize"
                                        v-bind:secondaryFont="userProfile.secondaryFont"
                                        v-bind:secondaryFontSize="userProfile.secondaryFontSize"
                                        v-bind:primaryTextWidth="userProfile.priTextWidth"
                                        v-bind:secondaryTextWidth="userProfile.secTextWidth"
                                    >
                                    </effect>
                                </div>
                                <div id="result">
                                </div>
                                <button class="button" @click="downloadCanvas"> <i class="glyphicon glyphicon-download-alt"></i> Download Insights.pic</button>
                                <a id="downloadable" style="display:none;" download="profile"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import html2canvas  from 'html2canvas'
import Effect from './Effect.vue'
export default {
    created:function() {
        var self = this;
        $.ajax({
            type: "GET",
            url: "/api/profile",
            headers:{"insight-auth-token":token},
            success:function(result){
                if(!self.userProfile.design){
                    self.userProfile.design=result['design_url'];
                }

                self.primaryColorInfo.push({
                    colorId: result['pricolor'].id,
                    colorName: result['pricolor'].color_name,
                    alpha:result['pricolor'].alpha,
                    style: {
                        backgroundColor:result['pricolor'].color,
                        color: 'white'
                    }
                });
                self.secondaryColorInfo.push({
                    colorId: result['seccolor'].id,
                    colorName: result['seccolor'].color_name,
                    alpha:result['seccolor'].alpha,
                    style: {
                        backgroundColor:result['seccolor'].color,
                        color: 'white'
                    }
                });
                if(!self.userProfile.priColor){
                    self.userProfile.priColor=self.primaryColorInfo[0];
                }
                if(!self.userProfile.secColor){
                    self.userProfile.secColor=self.secondaryColorInfo[0];
                }
                self.priText=result['primary_text'];
                self.secText=result['secondary_text'];
                self.userProfile.priText=result['primary_text'];
                self.userProfile.secText=result['secondary_text'];
                self.userProfile.primaryFont=result['primary_font'];
                self.userProfile.primaryFontSize=result['primary_fontsize'];
                self.userProfile.secondaryFont=result['secondary_font'];
                self.userProfile.secondaryFontSize=result['secondary_fontsize'];
                self.userProfile.priTextWidth=result['primary_txtWidth'];
                self.userProfile.secTextWidth=result['secondary_txtWidth'];
                self.loaded=true;
            }
        });
        $.ajax({
            type: "GET",
            url: "/api/design",
            success: function(result) {
                for (var i in result) {
                    self.designList.push({
                        urlId: result[i].id,
                        url: result[i].url,
                        info: result[i].info
                    })
                }
            }
        });
        $.ajax({
            type: "GET",
            url: "/api/color",
            success: function(res) {
                for (var j in res) {
                    self.colors.push({
                        colorId: res[j].id,
                        colorName: res[j].color_name,
                        alpha:res[j].alpha,
                        style: {
                            backgroundColor:res[j].color,
                            color: 'white'
                        }
                    });
                }
            }
        });
        self.fontArray=[{"value":"Roboto","fontname":"Roboto"},
                        {"value":"Oswald","fontname":"Oswald"},
                        {"value":"Lobster","fontname":"Lobster"},
                        {"value":"Anton","fontname":"Anton"},
                        {"value":"Pacifico","fontname":"Pacifico"},
                        {"value":"Rokkitt","fontname":"Rokkitt"},
                        {"value":"Lato","fontname":"Lato"}];
        self.fontsizeArray=[
                        {"value":6,"Size":6},
                        {"value":8,"Size":8},
                        {"value":10,"Size":10},
                        {"value":12,"Size":12},
                        {"value":14,"Size":14},
                        {"value":16,"Size":16},
                        {"value":18,"Size":18},
                        {"value":20,"Size":20},
                        {"value":22,"Size":22},
                        {"value":24,"Size":24},
                        {"value":26,"Size":26},
                        {"value":28,"Size":28},
                        {"value":30,"Size":30},
                        ];
    },

    data: function() {
        return {
            fontArray:[],
            fontsizeArray:[],
            loaded:false,
            primaryColorInfo:[],
            secondaryColorInfo:[],
            image: [],
            design_id:0,
            designList: [],
            colors: [],
            userProfile: {},
            effect: {},
            priText: '',
            secText: '',
            imageWidth: 0,
            imageHeight: 0,
            flag:0,
            priFont:'',
            priFontSize:0,
            secFont:'',
            secFontSize:0,
            priTextWidth:0,
            secTextWidth:0,
        }
    },
    watch:{
        userProfile:function(val){
        }
    },
    computed: {
        imageContainer: function() {
            if (this.imageWidth) {
                return {
                    width: this.imageWidth + 'px',
                    height: this.imageHeight + 'px',
                    position:'relative'
                }
            } else {
                return {}
            }
        },

    },
    components: {
        'effect': Effect,
    },
    methods: {
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var reader = new FileReader();
            var vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
                setTimeout(function() {
                    vm.imageWidth = $(".dropzone-preview img").width();
                    vm.imageHeight = $(".dropzone-preview img").height();
                }, 10);
            };
            reader.readAsDataURL(file);

        },
        removeImage: function(e) {
            this.image = '';
            this.imageWidth = 0;
            this.imageHeight = 0;
        },
        onPriColorChange: function(color) {
            this.flag=4;
            this.userProfile=Object.assign({},this.userProfile,{priColor:color});
            $.ajax({
                type:"PUT",
                url: "/api/profile",
                headers:{'insight-auth-token':token},
                data: {primary_color_id:this.userProfile.priColor.colorId,flag:this.flag},
                success: function(result){
                    if(result=='ok'){
                        console.log('saved');
                    }else{
                        console.log("Don't save");
                    }
                }
            });
        },
        onSecColorChange: function(color) {
            this.flag=5;
            this.userProfile=Object.assign({},this.userProfile,{secColor:color});
            $.ajax({
                type:"PUT",
                url: "/api/profile",
                headers:{'insight-auth-token':token},
                data: {secondary_color_id:this.userProfile.secColor.colorId,flag:this.flag},
                success: function(result){
                    if(result=='ok'){
                        console.log('saved');
                    }else{
                        console.log("Don't save");
                    }
                }
            });
        },
        onSelectDesign: function(design) {
            this.flag=3;
            this.userProfile=Object.assign({},this.userProfile,{design:design});
            $.ajax({
                type:"PUT",
                url: "/api/profile",
                headers:{'insight-auth-token':token},
                data: {design_id:this.userProfile.design.urlId,flag:this.flag},
                success: function(result){
                    if(result=='ok'){
                        console.log('saved');
                    }else{
                        console.log("Don't save");
                    }
                }
            });
        },
        priFontReSize(){
            this.userProfile.priTextWidth=$("#pridiv").width();
            if(this.userProfile.priTextWidth>this.imageWidth){
                var self=this;
                setTimeout(function(){
                    self.userProfile.primaryFontSize-=2;
                    self.userProfile.priTextWidth=$("#pridiv").width();
                },10);
            }else{
                this.userProfile.priTextWidth=this.userProfile.priTextWidth;
                this.userProfile.primaryFontSize=this.userProfile.primaryFontSize;
            }
            setTimeout(this.priFontReSize,20);
        },
        onPrimaryText: function() {
            if(this.imageWidth){
                var self=this;
                setTimeout(function() {
                    self.priTextWidth=$("#pridiv").width();
                    self.userProfile=Object.assign({},self.userProfile,{priTextWidth:self.priTextWidth});
                    self.priFontReSize();
                    self.flag=1;
                    self.userProfile=Object.assign({},self.userProfile,{priText:self.priText});
                    $.ajax({
                        type:"PUT",
                        url: "/api/profile",
                        headers:{'insight-auth-token':token},
                        data: {primaryText:self.userProfile.priText, flag:self.flag, primaryTextWidth:self.userProfile.priTextWidth,primaryfontsize:self.userProfile.primaryFontSize},
                        success: function(result){
                            if(result=='ok'){
                                console.log('saved');
                            }else{
                                console.log("Don't save");
                            }
                        }
                    });
                }, 30);
            }
        },
        secFontReSize(){
            this.userProfile.secTextWidth=$("#secdiv").width();
            if(this.userProfile.secTextWidth>this.imageWidth){
                var self=this;
                setTimeout(function(){
                    self.userProfile.secondaryFontSize-=2;
                    self.userProfile.secTextWidth=$("#secdiv").width();
                },10);
            }else{
                this.userProfile.secondaryFontSize=this.userProfile.secondaryFontSize;
            }
            setTimeout(this.secFontReSize,20);
        },
        onSecondaryText: function() {
            if(this.imageWidth){
                var self=this;
                setTimeout(function() {
                    self.flag=2;
                    self.userProfile=Object.assign({},self.userProfile,{secText:self.secText});
                    self.secTextWidth=$("#secdiv").width();
                    self.userProfile=Object.assign({},self.userProfile,{secTextWidth:self.secTextWidth});
                    self.secFontReSize();
                    $.ajax({
                        type:"PUT",
                        url: "/api/profile",
                        headers:{'insight-auth-token':token},
                        data: {secondaryText:self.userProfile.secText, flag:self.flag,secondaryTextWidth:self.userProfile.secTextWidth,secondaryfontsize:self.userProfile.secondaryFontSize},
                        success: function(result){
                            if(result=='ok'){
                                console.log('saved');
                            }else{
                                console.log("Don't save");
                            }
                        }
                    });
                }, 30);
            }
        },
        onChangePriFont:function(){
            if(this.imageWidth){
                this.priFont=$('#primaryfont').val();
                this.userProfile=Object.assign({},this.userProfile,{primaryFont:this.priFont});
                this.priTextWidth=$("#pridiv").width();
                this.userProfile=Object.assign({},this.userProfile,{priTextWidth:this.priTextWidth});
                this.priFontReSize();
                this.flag=6;
                $.ajax({
                    type:"PUT",
                    url: "/api/profile",
                    headers:{'insight-auth-token':token},
                    data: {primaryfont:this.userProfile.primaryFont, flag:this.flag},
                    success: function(result){
                        if(result=='ok'){
                            console.log('saved');
                        }else{
                            console.log("Don't save");
                        }
                    }
                });
            }
        },
        onChangePriFontSize:function(){
            if(this.imageWidth){
                this.priFontSize=$('#primary_fontsize').val();
                this.userProfile=Object.assign({},this.userProfile,{primaryFontSize:parseInt($('#primary_fontsize').val())});
                this.priTextWidth=$("#pridiv").width();
                this.userProfile=Object.assign({},this.userProfile,{priTextWidth:this.priTextWidth});
                this.flag=7;
                this.priFontReSize();
                $.ajax({
                    type:"PUT",
                    url: "/api/profile",
                    headers:{'insight-auth-token':token},
                    data: {primaryfontsize:this.userProfile.primaryFontSize, flag:this.flag},
                    success: function(result){
                        if(result=='ok'){
                            console.log('saved');
                        }else{
                            console.log("Don't save");
                        }
                    }
                });
            }
        },
        onChangeSecFont:function(){
            if(this.imageWidth){
                this.secFont=$('#secondaryfont').val();
                this.userProfile=Object.assign({},this.userProfile,{secondaryFont:this.secFont});
                this.secTextWidth=$("#secdiv").width();
                this.userProfile=Object.assign({},this.userProfile,{secTextWidth:this.secTextWidth});
                this.flag=8;
                this.secFontReSize();
                $.ajax({
                    type:"PUT",
                    url: "/api/profile",
                    headers:{'insight-auth-token':token},
                    data: {secondaryfont:this.userProfile.secondaryFont, flag:this.flag},
                    success: function(result){
                        if(result=='ok'){
                            console.log('saved');
                        }else{
                            console.log("Don't save");
                        }
                    }
                });
            }
        },
        onChangeSecFontSize:function(){
            if(this.imageWidth){
                this.secFontSize=$('#secondary_fontsize').val();
                this.userProfile=Object.assign({},this.userProfile,{secondaryFontSize:parseInt($('#secondary_fontsize').val())});
                this.secTextWidth=$("#secdiv").width();
                this.userProfile=Object.assign({},this.userProfile,{secTextWidth:this.secTextWidth});
                this.secFontReSize();
                this.flag=9;
                $.ajax({
                    type:"PUT",
                    url: "/api/profile",
                    headers:{'insight-auth-token':token},
                    data: {secondaryfontsize:this.userProfile.secondaryFontSize, flag:this.flag},
                    success: function(result){
                        if(result=='ok'){
                            console.log('saved');
                        }else{
                            console.log("Don't save");
                        }
                    }
                });
            }
        },
        downloadCanvas(e){
            html2canvas($('#image-merge'), {
                onrendered: function (canvas) {
                    var canvasImg = canvas.toDataURL("image/jpg");
                    canvasImg = canvasImg.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition%3A%20attachment');
                    document.getElementById("downloadable").href = canvasImg;
                    document.getElementById("downloadable").click();
                }
            });
        }
    }
}
</script>
