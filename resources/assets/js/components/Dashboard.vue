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
                                    <input class="form-control" v-model="priText" type="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" @click="onPrimaryText">Update </button>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon"><span>Text </span></div>
                                    <input class="form-control" v-model="secText" type="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" @click="onSecondaryText">Update </button>
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
                                <div style="margin-top:8px;" v-bind:style="imageContainer">
                                    <div>
                                        <img :src="image" />
                                    </div>
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
                                    >
                                    </effect>
                                </div>
                                <button class="button" @click="downloadImage"> <i class="glyphicon glyphicon-download-alt"></i> Download Insights.pic</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Effect from './Effect.vue'
export default {
    created:function() {
        var self = this;
        $.ajax({
            type: "GET",
            url: "/api/profile",
            headers:{"insight-auth-token":token},
            success:function(result){
                console.log(result);
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
    },

    data: function() {
        return {
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
                        alert("Don't save")
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
                        alert("Don't save")
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
                        alert("Don't save")
                    }
                }
            });
        },
        onPrimaryText: function() {
            this.flag=1;
            this.userProfile=Object.assign({},this.userProfile,{priText:this.priText});
            $.ajax({
                type:"PUT",
                url: "/api/profile",
                headers:{'insight-auth-token':token},
                data: {primaryText:this.userProfile.priText,flag:this.flag},
                success: function(result){
                    if(result=='ok'){
                        console.log('saved');
                    }else{
                        alert("Don't save")
                    }
                }
            });

        },
        onSecondaryText: function() {
            this.flag=2;
            this.userProfile=Object.assign({},this.userProfile,{secText:this.secText});
            console.log(token);
            $.ajax({
                type:"PUT",
                url: "/api/profile",
                headers:{'insight-auth-token':token},
                data: {secondaryText:this.userProfile.secText, flag:this.flag},
                success: function(result){
                    if(result=='ok'){
                        console.log('saved');
                    }else{
                        alert("Don't save")
                    }
                }
            });
        },
        downloadImage() {

        }
    }
}
</script>
