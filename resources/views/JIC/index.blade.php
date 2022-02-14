<!DOCTYPE html>
<html lang="en">
<head>
<meta charset='utf-8'>
<meta name="viewport" content="width=800">
<title>J I C - a Javascript Image Compressor</title>
<!-- JQUERY UI DEPENDENCIES FOR SLIDER -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" media="all"/>
<link rel="stylesheet" href="https://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all"/>
<!-- BOOTSTRAP CSS STYLES FOR GOOD LOOKING -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
<!-- DEMO CUSTOM STYLES -->
<link rel="stylesheet" href="css/demo.css">
<!-- HERE IS THE MAGIC ... -->
<script src="js/JIC.min.js" type="text/javascript"></script>
<script src="js/demo.js" type="text/javascript"></script>

</head>
<body>

  <section id="wrapper">
    <input type="file" name="something" id="FileInput" style="display:none">
    <article id='article'>
      <div class='holder' id="holder">
        <div id='holder_helper'>
          <h2 id="holder_helper_title">Drag & Drop your Image here!</h2>
        </div>
        <img id="source_image" class='img_container' />
      </div>
      <div class='holder' id='holder_result'>
        <img id="result_image" class='img_container' src=""/>
      </div>
      <div class='clear'></div>
      <div class='col' id='left-col'>
        <fieldset>
          <legend>Compressor settings</legend>
          <div id="slider-range-min"></div>
          <div id='controls-wrapper'>
             Compression ratio : <input id="jpeg_encode_quality" size='3' readonly='true' type="text" value="30"/> %
            <div id='buttons-wrapper'>
              <a class='btn btn-large btn-primary' id="jpeg_encode_button">Compress</a>&nbsp;
              <a class='btn btn-large btn-success' id="jpeg_upload_button">Upload</a>
            </div>
          </div>
        </fieldset>
      </div>
      <div class='col' id='right-col'>
        <fieldset>
          <legend>Console output</legend>
          <div id='console_out'></div>
        </fieldset>
      </div>
      <div class='clear'></div>
    </article>

  </section>
</body>
<script>
  $("#holder_helper").click(myFunction);

  function myFunction() { 
    $('#FileInput').trigger("click") ; 
  } 

  $(function(){
    $('input:file').change(  function(e) {
      var input = this ; 
      this.className = '';
      e.preventDefault();
      
      document.getElementById("holder_helper").removeChild(document.getElementById("holder_helper_title"));
      
      var file = input.files[0] , 
      reader = new FileReader();
      reader.onload = function(event) {
          var i = document.getElementById("source_image");
              i.src = event.target.result;
              i.onload = function(){
                image_width=$(i).width(),
                image_height=$(i).height();

                if(image_width > image_height){
                  i.style.width="320px";
                }else{
                  i.style.height="300px";
                }
                i.style.display = "block";
                console.log("Image loaded");

              }
              
      };
      
      if(file.type=="image/png"){
          output_format = "png";
      }

      console.log("Filename:" + file.name);
      console.log("Filesize:" + (parseInt(file.size) / 1024) + " Kb");
      console.log("Type:" + file.type);
      

      reader.readAsDataURL(file);
      
      return false;
  });

  });
 




</script>

</html>