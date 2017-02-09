<template>
<div>
    <div class="container">
        <div class="row">
            <h1>Insights.pics Creator</h1>
            <p>The first step is to select your Insights colors. Choose your primary color and one or two secondary colors.</p>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Select the design </h3>
                    <div class="row design">
                        <ul style="list-style: none;">
                            <li style="padding-bottom:3px;" v-for="design in designList">
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
                                <button class="btn" v-bind:style="[color.style]" @click="onPriColorChange(color)"> {{color.colorName}} </button>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Secondary Color(s)</h3>
                                    </div>
                                    <div v-for="color in colors" class="col-md-2">
                                        <button class="btn" v-bind:style="[color.style]" @click="onSecColorChange(color)"> {{color.colorName}} </button>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Picture(s) Upload</h4>
                                <p>The second step is to upload pictures and apply some Insights.pics designs. Then just download and share.</p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <section></section>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="inputValue">
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
                                <p>(The picture area is a dropzone to browse or drag and drop. The right side lets the pick from designs and applies to the image they uploaded.)</p>
                                <div class="dropzone-area" drag-over="handleDragOver">
                                    <div class="dropzone-text">
                                        <span class="dropzone-title">Drop image here or click to select</span>
                                    </div>
                                    <input type="file" @change="onFileChange">
                                </div>
                            </div>
                            <div class="dropzone-preview" v-else>
                                <button style="margin-top:8px;" class="button" @click="removeImage"> <i class="glyphicon glyphicon-remove-sign"></i>Remove image</button>
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
    created() {
        var self = this;
        $.ajax({
            type: "POST",
            url: "/api/design",
            success: function(result) {
                for (var i in result) {
                    self.designList.push({
                        urlId: result[i].id,
                        url: result[i].url,
                        info: result[i].info
                    })
                }
                if(!self.userProfile.design){
                    self.userProfile.design=result[1];
                }
            }
        });
        $.ajax({
            type: "POST",
            url: "/api/color",
            success: function(res) {
                for (var j in res) {
                    self.colors.push({
                        colorId: res[j].id,
                        colorName: res[j].color_name,
                        style: {
                            backgroundColor: res[j].color,
                            color: 'white'
                        }
                    });
                }
                if(!self.userProfile.priColor){
                    self.userProfile.priColor=self.colors[0];
                }
                if(!self.userProfile.secColor){
                    self.userProfile.secColor=self.colors[1];
                }
            }
        });
    },

    data: function() {
        return {
            image: [],
            designList: [],
            colors: [],
            userProfile: {},
            effect: {},
            priText: '',
            secText: '',
            imageWidth: 0,
            imageHeight: 0
        }
    },
    watch:{
        userProfile:function(val){
            console.log(val);
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
        'effect': Effect
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
            this.userProfile=Object.assign({},this.userProfile,{priColor:color});
        },
        onSecColorChange: function(color) {
            this.userProfile=Object.assign({},this.userProfile,{secColor:color});
        },
        onSelectDesign: function(design) {
            this.userProfile=Object.assign({},this.userProfile,{design:design});
        },
        onPrimaryText() {
            this.userProfile=Object.assign({},this.userProfile,{priText:this.priText});

        },
        onSecondaryText() {
            this.userProfile=Object.assign({},this.userProfile,{secText:this.secText});
        },
        downloadImage() {

        }
    }
}
</script>
