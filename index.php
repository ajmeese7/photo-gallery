<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Photo Gallery</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="jquery.min.js"></script>
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
        // TODO: Add support for other image types
        if (images[i].includes(".png") || images[i].includes(".jpeg") || images[i].includes(".gif") || images[i].includes(".jpg")) {
          // TODO: Remove jQuery? Is this the only reason I had it here?
          var content = "<img class='grid-item' id='" + i + "' src='" + subdomain + "/content/" + images[i] +"'></div>";
          $(".grid").append(content);

          var img = document.getElementById(i);
          var width = img.naturalWidth;
          var height = img.naturalHeight;
          if (width < height) { // portrait
            img.classList.add('portrait');
          } else if (width == height) { // square
            img.classList.add('square');
          }
        } else { // Assumes the media is a video
          // IDEA: Add special video class support?
          $("body").append("<video class='grid-item' width='320' height='240' controls>" +
          "<source src='/content/" + images[i] + "' type='video/mp4'>" +
          "Your browser does not support the video tag.</video>");
        }
      }
    </script>
  </body>
</html>
