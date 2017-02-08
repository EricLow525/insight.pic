<template>
<div>
    <div class="container">
        <div class="row">
            <h1>Insights.pics Creator</h1>
            <p>The first step is to select your Insights colors. Choose your primary color and one or two secondary colors.</p>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-md-4">
                <h3>Select the design </h3>
                <div class="row design">
                    <ul>
                        <li v-for="design in designList">
                            <img @click="onSelectDesign(design)" :src="design.url">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container">
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
                        <div class="col-md-6">
                            <div v-if="!image.length">
                                <div class="dropzone-area" drag-over="handleDragOver">
                                    <div class="dropzone-text">
                                        <span class="dropzone-title">Drop image here or click to select</span>
                                    </div>
                                    <input type="file" @change="onFileChange">
                                </div>
                            </div>
                            <div class="dropzone-preview" v-else>
                                <button @click="removeImage">Remove image</button>
                                <div v-bind:style="imageContainer">
                                    <img :src="image" />
                                    <effect
                                        v-bind:primaryColor="userProfile.priColor.style.backgroundColor"
                                        v-bind:secondaryColor="userProfile.secColor.style.backgroundColor"
                                        v-bind:info="userProfile.design.info"
                                        v-bind:imgWidth="imageWidth"
                                        v-bind:imgHeight="imageHeight"
                                        v-bind:primaryText="userProfile.priText"
                                        v-bind:secondaryText="userProfile.secText"
                                    >
                                    </effect>
            <!--                        <div v-bind:style="div1Container">
                                        {{priText}}
                                    </div>
                                    <div v-bind:style="div2Container">
                                        {{secText}}
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>(The picture area is a dropzone to browse or drag and drop. The right side lets the pick from designs and applies to the image they uploaded.)</p>
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
            imageHeight: 0,
//            divWidth: 0,
//            divHeight: 0,
//            divTop:0,
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
        //"position:absolute; left:0px; top:80%; width:divWidth; height:divHeight; background-color:red;">
/*        div1Container:function(){
            return {
                width: this.divWidth + 'px',
                height: this.divHeight + 'px',
                position:'absolute',
                left: 0,
                top: this.imageHeight-this.divHeight+'px',
                backgroundColor:this.effect.priColor
            }
        },
        div2Container:function(){
            return {
                width: this.divWidth + 'px',
                height: this.divHeight + 'px',
                position:'absolute',
                left: 0,
                top: this.imageHeight*0.6+'px',
                backgroundColor:this.effect.secColor
            }
        }*/
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
                    console.log(vm.imageWidth, vm.imageHeight)
                    // this.userProfile.imageWidth=vm.imageWidth;
                    // this.userProfile.imageHeight=vm.imageHeight;
                    // console.log(vm.userProfile.imageWidth, vm.userProfile.imageHeight);
//                    vm.divWidth=vm.imageWidth;
//                    vm.divHeight=(vm.imageHeight*0.2);
//                    console.log(vm.divWidth,vm.divHeight);
                }, 10);
            };
            reader.readAsDataURL(file);
        },
        removeImage: function(e) {
            this.image = '';
            this.imageWidth = 0;
            this.imageHeight = 0;
//            this.divWidth=0;
//            this.divHeight=0;
        },
        onPriColorChange: function(color) {
            this.userProfile.priColor = color;
        },
        onSecColorChange: function(color) {
            this.userProfile.secColor = color;
            console.log(this.userProfile.secColor.style);
        },
        onSelectDesign: function(design) {
            this.userProfile.design = design;
        },
        onPrimaryText() {
            this.userProfile.priText = this.priText;
        },
        onSecondaryText() {
            this.userProfile.secText = this.secText;
        }
    }
}
</script>
