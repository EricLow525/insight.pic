<template id="dropzone">
    <div v-if="!image.length">
        <div class="dropzone-area" drag-over="handleDragOver">
            <div class="dropzone-text">
                <span class="dropzone-title">Drop image here or click to select</span>
                <span class="dropzone-info" v-if="help">{{ help }}</span>
            </div>
            <input type="file" @change="onFileChange">
        </div>
    </div>
    <div class="dropzone-preview">
        <img :src="image" />
        <button @click="removeImage" v-if="image">Remove</button>
    </div>
</template>
<script>
    export default{
      mounted() {
          console.log('dashboard')
      },

      data : function() {
          return {
              image : []
          }
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
                  console.log(e.target.result);
                  vm.image = e.target.result;
              };
              reader.readAsDataURL(file);
          },
          removeImage: function (e) {
              this.image = '';
          }
      }
    }
</script>
