<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>jis food admin panale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/Admin/Common.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script>
      tinymce.init({
        selector: '.Description',
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
        <h1>Create new brand</h1>
        <h3 class="name-1">
        </h3>
        <button type="button" class="edit-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#brandCreateForm">
          <i class="bi bi-plus"></i>Create
        </button>
      </div>
       <!-- prodect show table -->
      <div style='overflow:auto;'>
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Mame</th>
              <th scope="col">Slug</th>
              <th scope="col">Description</th>
              <th scope="col">Img</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="allBrand">
          </tbody>
        </table>
      </div>
    </div>
   <!-- all model site -->
    <!-- Modal -->
    <div class="modal fade" id="brandCreateForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create new brand </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Name</span>
              <input type="text" required id="brandName"class="form-control" placeholder="Brand name" aria-label="Username"aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Slog</span>
              <input type="text"  required id="brandSlog" name="brand_slog" class="form-control " placeholder="Brand slog" aria-label="Username"  aria-describedby="addon-wrapping">
            </div>
            <br>
             <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Meta title </span>
              <input type="text" id="metaTitle"  class="form-control "  placeholder="Meta title" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
             <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Meta keywords</span>
              <input type="text" id="meteKeyword"  class="form-control " placeholder="Meta keywords" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="">
              <span class="" id="addon-wrapping">Meta description</span><br>
              <textarea type="text" id="metaDescription" rows="3" placeholder="Meta Description" style="width:100%;"  class="form-control " aria-label="Username" aria-describedby="addon-wrapping"></textarea>
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <input type="file" onclick="imgPreview('imageInput','previewImage')" id="imageInput" required  class="form-control " placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="previewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>
            <br>
            <textarea  id="branddescription" class="Description" placeholder="please inter catagory ditels"></textarea>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="insertBrand" name="insert_brand" class="btn btn-primary">Add new</button>
          </div>
        </div>
      </div>
    </div>
    <!-- update brand -->
    <div class="modal fade" id="brandUpdateForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update brand </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Name</span>
              <input type="hidden" id="editBrandId" >
              <input type="text" required id="editBrandName"class="form-control" placeholder="Brand name" aria-label="Username"aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Slog</span>
              <input type="text"  required id="editBrandSlog" name="brand_slog" class="form-control " placeholder="Brand slog" aria-label="Username"  aria-describedby="addon-wrapping">
            </div>
            <br>
             <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Meta title </span>
              <input type="text" id="editMetaTitle"  class="form-control "  placeholder="Meta title" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
             <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Meta keywords</span>
              <input type="text" id="editMetaKeyword"  class="form-control " placeholder="Meta keywords" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="">
              <span class="" id="addon-wrapping">Meta description</span><br>
              <textarea type="text" id="editMetaDescription" rows="3" placeholder="Meta Description" style="width:100%;"  class="form-control " aria-label="Username" aria-describedby="addon-wrapping"></textarea>
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <input type="file" onclick="imgPreview('editBrandImg','editPreviewImage')" id="editBrandImg" required  class="form-control " placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="editPreviewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px;">
            </div>
            <br>
            <textarea  id="editBrandDescription" class="Description"  placeholder="please inter catagory ditels"></textarea>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="updateBrand"  class="btn btn-primary"><i class="bi bi-save"></i>Update</button>
          </div>
        </div>
      </div>
    </div>
    <!-- brand delete  -->
    <div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-model">
          <div class="modal-body">
            <div class="input-group flex-nowrap">
              <img id="deleteBramdImage" height="120" width="200">
              <input type="hidden" id='deleteBrandId'>
              <p class="deleteAlert">Are you sure you want to delete this category?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="brandDeleteButton" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @vite([
        'resources/js/Admin/common.js',
        'resources/js/Admin/brand.js'
    ])
  </body>
</html>
