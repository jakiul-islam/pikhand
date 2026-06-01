<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>jis food admin panale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('public/tinymce/tinymce.min.js') }}"></script>

    <script>
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
    </script>
  </head>

  <body>
   @include("Admin.include.header")
    <div class="main-contain">
      <div class="name-2">
        <h1>create help page</h1>
        <h3 class="name-1">
        </h3>
        <button class="edit-button" type="button" class="btn  btn-primary"data-bs-toggle="modal" data-bs-target="#HelpPageModel">
           Create
        </button>
      </div>
      <!-- prodect show table -->
      <div id="showHelpPage"></div>
    </div>
  <!-- all model site -->
  <!-- Modal -->
  <div class="modal fade" id="HelpPageModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <span class="input-group-text" id="help-page">Create help page</span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <textarea id="helpPage" class="form-control description" placeholder="Create help page" aria-label="help-page"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="InsertHelpButton" class="btn btn-primary">Help</button>
        </div>
      </div>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @vite([
        'resources/js/Admin/common.js',
        'resources/js/Admin/Help.js'
    ])
  </body>
</html>
