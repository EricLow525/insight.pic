<template>
    <div>
        <div class="container">
            <div class="row">
                <div>
                    <h1>Insights.pics Creator</h1>
                    <p>The first step is to select your Insights colors. Choose your primary color and one or two secondary colors.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h3>Primary Color</h3>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger active" type="button"><i class="glyphicon glyphicon-ok"></i> Red </button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-warning" type="button">Yellow </button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" type="button">Green </button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-info" type="button">Blue </button>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Secondary Color(s)</h3></div>
                        <div class="col-md-2">
                            <button class="btn btn-danger active" type="button">Red </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-warning" type="button">Yellow </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success active" type="button"><i class="glyphicon glyphicon-ok"></i> Green </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info active" type="button"><i class="glyphicon glyphicon-ok"></i>Blue </button>
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
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Picture(s) Upload</h4>
                        <p>The second step is to upload pictures and apply some Insights.pics designs. Then just download and share.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container">
                <section></section>
            </div>
        </div>
        <div class="container">
              <div class="row">

                <div class="col-md-6">
                    <h2>Select an image</h2>
                    <input type="file" @change="onFileChange">
                </div>
  <!--                <div class="col-md-6" id="image_app">
                      <input type="file" @change="onFileChange">
                  </div>    -->
                  <div class="col-md-6">
                      <p>(The picture area is a dropzone to browse or drag and drop. The right side lets the pick from designs and applies to the image they uploaded.)</p>
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
              console.log(file);
              var image = new Image();
              var reader = new FileReader();
              var vm = this;
              console.log(vm);

              reader.onload = (e) => {
                  vm.image = e.target.result;
              };
              reader.readAsDataURL(file);
          }
      }
    }
</script>
