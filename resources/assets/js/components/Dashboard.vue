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
                        <li v-for="url in url_lists">
                            <img :id="url.url_id" @click="select_design" :src="url.url">
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
                            <div v-for="color in colors"  class="col-md-2">
                                <button class="btn" v-bind:style="[color.style]" @click="pri_color"> {{color.color_name}} </button>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Secondary Color(s)</h3>
                                    </div>
                                    <div v-for="color in colors"  class="col-md-2">
                                        <button class="btn" v-bind:style="[color.style]" @click="sec_color"> {{color.color_name}} </button>
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
                                        <div>
                                            <img :src="image" />
                                            <effect></effect>
                                        </div>
                                        <button @click="removeImage">Remove image</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>(The picture area is a dropzone to browse or drag and drop. The right side lets the pick from designs and applies to the image they uploaded.)</p>
                                    <h4>Insights.pics Text:</h4>
                                  <div class="input-group">
                                      <div class="input-group-addon"><span>Text </span></div>
                                      <input class="form-control" type="text">
                                      <div class="input-group-btn">
                                          <button class="btn btn-default" type="button">Update </button>
                                      </div>
                                  </div>
                                  <div class="input-group">
                                      <div class="input-group-addon"><span>Text </span></div>
                                      <input class="form-control" type="text">
                                      <div class="input-group-btn">
                                          <button class="btn btn-default" type="button">Update </button>
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
var colors=[];
var arr_url=[];
export default{
    mounted() {
        console.log(colors.length);
        $.ajax({
            type:"POST",
            url: "/api/design",
            success: function(result){
                if(arr_url.length==0){
                    for(var i in result){
                        arr_url.push({
                            url_id: result[i].id,
                            url: result[i].url,
                            info: result[i].info
                        })
                    }
                }else {
                    arr_url=[];
                    for(var i in result){
                        arr_url.push({
                            url_id: result[i].id,
                            url: result[i].url,
                            info: result[i].info
                        })
                    }
                }
            }
        });
        $.ajax({
            type:"POST",
            url:"/api/color",
            success:function(res){
                if(colors.length==0){
                    for(var j in res){
                        colors.push({
                            color_name: res[j].color_name,
                            style: {
                                'background-color': res[j].color,
                                color : 'white'
                            }
                        });
                    }
                }else{
                    colors=[];
                    for(var j in res){
                        colors.push({
                            color_name: res[j].color_name,
                            style: {
                                'background-color': res[j].color,
                                color : 'white'
                            }
                        });
                    }
                }
            }
        });
    },

    data : function() {
        return {
            image : [],
            url_lists : arr_url,
            colors: colors
        }
    },
    components:{
        'effect':Effect
    },
    methods : {
        onFileChange(e){
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
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            this.image = '';
        },
        pri_color: function(e){
            console.log(1);
        },
        sec_color: function(e){
            console.log(2);
        },
        select_design:function(e){
            var count=0;
            for(var i in this.url_lists){
                if(e.target.id==this.url_lists[i].url_id){
                    console.log(this.url_lists[i].info);
                }
            }
        }
    }
}
</script>
