<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>jis food admin panale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     @vite('resources/css/Admin/common.css')
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('public/tinymce/tinymce.min.js') }}"></script>
    <script>
      function tinymceditor(){
        tinymce.init({
          selector: '.description',
          plugins: 'autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
          toolbar: 'undo redo | bold italic underline strikethrough | link image media table | alignleft aligncenter alignright alignjustify | numlist bullist | removeformat',
          setup: function (editor) {
            editor.on('change', function () {
              tinymce.triggerSave(); // Ensures textarea updates with editor content
            });
          }
        });
      }
      tinymceditor();
    </script>
  </head>

  <body>
   @include("Admin.Include.Header")
    <div class="main-contain">
      <div class="name-2">
        <h1>Insert banner</h1>
        <h3 class="name-1">
        </h3>
        <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#banner">
           banner
        </button>
      </div>
       <!-- prodect show table -->
    <div style="width:100%; overflow: auto;">
      <table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col"> name</th>
            <th scope="col"> slug</th>
            <th scope="col">description</th>
            <th scope="col">img</th>
            <th scope="col">edit</th>
            <th scope="col">view</th>
            <th scope="col">delete</th>
          </tr>
        </thead>
        <tbody class="table-group-divider" id="allbanners">
        </table>
        </tbody>
      </table>
    </div>
  </div>
   <!-- all model site -->
   <!-- Modal -->
        <div class="modal fade" id="banner" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert banner</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping">name</span>
                  <input type="text" required id="bannerName"class="form-control" placeholder="banner name" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <br>
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping">slog</span>
                  <input type="text"  required id="bannerSlog" class="form-control " placeholder="banner slog" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <br>
                <div class="input-group flex-nowrap">
                  <input type="file" id="imageInput" required  class="form-control " placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
                  <img id="previewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
                </div>
                <br>
                  <span id="addon-wrapping">banner Description</span>
                <div class="input-group flex-nowrap">
                  <textarea id="bannerDescription" required class="description" placeholder="description" aria-label="Username" aria-describedby="addon-wrapping"></textarea>
                </div>
                <br>
              </div>
              <div class="modal-footer">
                <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="insertBannerButton" name="insert_brand" class="btn btn-primary">Insert</button>
              </div>
            </div>
          </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="{{ asset('public/js/Admin/common.js') }} " ></script>
    <script src="{{ asset('public/js/Admin/banner-managements.js') }}"></script>
  </body>
</html>
