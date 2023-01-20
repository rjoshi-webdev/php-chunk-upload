<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>php-chunk-upload</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<!-- (A) UPLOAD BUTTON & FILE LIST -->
  <div class="px-4 py-5 my-5 text-center">
      <img class="d-block mx-auto mb-4" src="http://scriptdice.com/wp-content/uploads/2022/06/scriptdice.png" alt="" height="57">
      <h1 class="display-5 fw-bold">Chunk upload - PHP-jQuery</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">This is the demo script to show how chunk upload work with php & jQuery. Click on file upload button and upload your file to see chunk upload magic.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <input type="button" id="pick" class="btn btn-primary btn-lg px-4 gap-3" value="Upload">
        </div>
        <div class="card mt-2" id="list"></div>
      </div>
    </div>

 
<!-- (B) LOAD PLUPLOAD FROM CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.5/plupload.full.min.js"></script>
<script>
// (C) INITIALIZE UPLOADER
window.onload = () => {
  // (C1) GET HTML FILE LIST
  var list = document.getElementById("list");
 
  // (C2) INIT PLUPLOAD
  var uploader = new plupload.Uploader({
    runtimes: "html5",
    browse_button: "pick",
    url: "upload.php",
    chunk_size: "10mb",
    init: {
      PostInit: () => list.innerHTML = "<div></div>",
      FilesAdded: (up, files) => {
        plupload.each(files, file => {
          let row = document.createElement("div");
          row.id = file.id;
          row.innerHTML = `${file.name} (${plupload.formatSize(file.size)}) <strong></strong>`;
          list.appendChild(row);
        });
        uploader.start();
      },
      UploadProgress: (up, file) => {
        document.querySelector(`#${file.id} strong`).innerHTML = `${file.percent}%`;
      },
      FileUploaded: function(up, file, info) {
          // Called when file has finished uploading
          list.innerHTML = "<div>File uploaded successfully!</div>";
      },
      Error: (up, err) => console.error(err),
      
    }
  });
  uploader.init();
};
</script>

</body>
</html>