<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Photo Gallery</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="jquery.min.js"></script>
    <style>
      img {
        margin: 15px;
      }

      .square {
        width: 15%;
      }

      .portrait {
        width: 12.5%;
      }

      .landscape {
        width: 20%;
      }
    </style>
  </head>
  <body>
    <h1>Welcome to my gallery!</h1>
    <script>
      var subdomain = "/photos"; // Write your subdomain here. Leave blank for local

      var images = <?php
        $images = array();
        $folder = new DirectoryIterator("content");
        foreach ($folder as $fileinfo) {
          if (!$fileinfo->isDot()) {
              $images[] = $fileinfo->getFilename();
          }
        }
        echo json_encode($images);
      ?>;

      for (var i = 0; i < images.length; i++) {
        // TODO: Add support for other image types
        if (images[i].includes(".png") || images[i].includes(".jpeg") || images[i].includes(".gif") || images[i].includes(".jpg")) {
          $("body").append( "<img id='" + i + "' src='" + subdomain + "/content/" + images[i] +"'>" );

          var img = document.getElementById(i);
          var width = $("img").width(); //naturalWidth
          var height = $("img").height(); //naturalHeight
          console.log("Image #" + i + ": [width: " + width + ", height: " + height + "]");
          if (width > height) {
            img.classList.add('landscape');
          } else if (width == height) { // Square photo
            img.classList.add('square');
          } else {
            img.classList.add('portrait');
          }
        } else { // Assumes the media is a video
          $("body").append("<video width='320' height='240' controls>" +
          "<source src='/content/" + images[i] + "' type='video/mp4'>" +
          "Your browser does not support the video tag.</video>");
        }
      }
    </script>
  </body>
</html>
