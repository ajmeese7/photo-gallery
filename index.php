<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Photo Gallery</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="masonry.min.js"></script>
    <link rel="stylesheet" href="style.css"/>
  </head>
  <body>
    <h1>Welcome to my gallery!</h1>
    <div class="grid" data-masonry='{ "itemSelector": ".grid-item" }'></div>
    <script>
      // NOTE: Does NOT work if you use subdomain in front of address (i.e. gallery.mysite.com)
      var subdomain = "/photos"; // Write your subdomain here. Leave blank for local

      var images = <?php
        $images = array();
        $folder = new DirectoryIterator("content"); // name of media file
        foreach ($folder as $fileinfo) {
          if (!$fileinfo->isDot()) {
              $images[] = $fileinfo->getFilename();
          }
        }
        echo json_encode($images);
      ?>;

      for (var i = 0; i < images.length; i++) {
        if (images[i].includes(".png") || images[i].includes(".jpeg") || images[i].includes(".gif") || images[i].includes(".jpg")
            || images[i].includes(".webp")) {
          var content = "<img class='grid-item' id='" + i + "' src='" + subdomain + "/content/" + images[i] +"'></div>";
          document.getElementsByClassName("grid")[0].innerHTML += content;

          var img = document.getElementById(i);
          var width = img.naturalWidth;
          var height = img.naturalHeight;
          if (width < height) { // portrait
            img.classList.add('portrait');
          } else if (width == height) { // square
            img.classList.add('square');
          }
        } else if (images[i].includes(".mp4")) { // IDEA: Make video sizing prettier?
          var video = "<video class='grid-item' controls>" +
          "<source src='" + subdomain + "/content/" + images[i] + "' type='video/mp4'>" +
          "Your browser does not support the video tag.</video>";

          document.getElementsByClassName("grid")[0].innerHTML += video;
        } else if (images[i].includes(".webm")) {
          var video = "<video class='grid-item' controls>" +
          "<source src='" + subdomain + "/content/" + images[i] + "' type='video/webm'>" +
          "Your browser does not support the video tag.</video>";

          document.getElementsByClassName("grid")[0].innerHTML += video;
        } else if (images[i].includes(".ogg")) {
          var video = "<video class='grid-item' controls>" +
          "<source src='" + subdomain + "/content/" + images[i] + "' type='video/ogg'>" +
          "Your browser does not support the video tag.</video>";

          document.getElementsByClassName("grid")[0].innerHTML += video;
        }
      }
    </script>
  </body>
</html>
