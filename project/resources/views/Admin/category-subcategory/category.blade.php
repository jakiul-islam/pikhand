<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('public/css/Admin/common.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Category.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/Admin/subcategory.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    @include("Admin.Include.Header")
    <div class="main-contain" id="mainContain">
      <div id='showmanicatagry'>
        <div class="name-2">
          <h1>Create new category</h1>
          <h1 class="name-1"></h1>
          <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryForm">Create</button>
        </div>
        <!-- prodect show table -->
        <div class="CategoryShowTable">
          <table class="table table-hover" style="">
            <thead class="table-dark">
              <tr>
                <th scope="col">sr</th>
                <th scope="col"></th>
                <th scope="col" style="width:5px;">name</th>
                <th scope="col">slug</th>
                <th scope="col">subcategory</th>
                <th scope="col">order</th>
                <th scope="col">click</th>
                <th scope="col">img</th>
                <th scope="col" class="text-center">action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider" id="productContainer"></tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- all model site -->

    <!-- Modal -->
    <div class="modal fade" id="categoryForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create new category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
             <!--  form section flex-nowrap input-group-text input-group -->
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Category name</span><br>
              <input type="text" id="categoryName"  class="form-control" placeholder="Category name" aria-label="Username"aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Category slug</span><br>
              <input type="text" id="categorySlug" class="form-control"  placeholder="Category slug" aria-label="Username"  aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Image</span><br>
              <input type="file"  onclick="ImgPreview('imageInput','previewImage' )" id="imageInput" class="form-control" placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="previewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Icon <small>(Icon size should be 16x16 px)</small></span><br>
              <input type="file"  onclick="ImgPreview('categoryIcon','IconPreviewImage' )" id="categoryIcon" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="IconPreviewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Banner</span><br>
              <input onclick="ImgPreview('categoryBanner','BannerPreviewImage')" type="file" id="categoryBanner" class="form-control" aria-label="Username"aria-describedby="addon-wrapping">
              <img id="BannerPreviewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Meta title</span><br>
              <input type="text" id="categorymetatitle" class="form-control" placeholder="Meta title" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Meta kayword</span><br>
              <input type="text" id="categoryMetaKayword" class="form-control" placeholder="Meta kayword" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Featured</span>
              <input type="checkbox" id="categoryFeatured">
            </div>
            <br>
            <div class="col-lg-6">
              <span>Meta description </span><br>
              <textarea name="content"  id="MetaDescription" class="Description" placeholder="Please enter meta description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Short description </span>
              <textarea name="content"  id="shortDescription" class="Description" placeholder="Please enter short description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Long description </span>
              <textarea name="content"  id="longDescription" class="Description" placeholder="Please enter long description"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="insertCatagory" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>
    <!-- category edit model -->
    <div class="modal fade" id="categoryEditForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update sategory</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
             <!--  form section -->
            <div class="col-md-6 col-lg-4">
              <input type="hidden" id='EditCategoryId'>
              <input type="hidden" id='EditCategoryOldImg'>
              <input type="hidden" id='EditCategoryOldIcon'>
              <input type="hidden" id='EditCategoryOldBanner'>
              <span class="" id="addon-wrapping">Category Name</span><br>
              <input type="text" id="EditCategoryName"  class="form-control"  placeholder="Category name" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Category Slug</span><br>
              <input type="text" id="EditCategorySlug" class="form-control" placeholder="Category slug" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Image</span><br>
              <input onclick="ImgPreview('EditCategoryImg','EditPreviewImage' )" type="file"  id="EditCategoryImg" class="form-control  editCategoryImg" placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="EditPreviewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Icon <small>(Icon size should be 16x16 px)</small></span><br>
              <input onclick="ImgPreview('EditCategoryIcon','EditPreviewIcon' )" type="file"  id="EditCategoryIcon" class="form-control  editCategoryImg" placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="EditPreviewIcon" src="" alt="Image Preview" style="max-width: 200px; max-height:100px;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Banner</span><br>
              <input onclick="ImgPreview('EditCategoryBanner','EditPreviewBanner' )" type="file"  id="EditCategoryBanner" class="form-control  editCategoryImg" placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="EditPreviewBanner" src="" alt="Image Preview" style="max-width: 200px; max-height:100px;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Meta title</span><br>
              <input type="text" id="EditMetaTitle" class="form-control" placeholder="Meta title" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Mate keywords</span><br>
              <input type="text"  id="EditMetakeyword" class="form-control  editCategoryImg" placeholder="Mate keywords" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Featured</span><br>
              <input type="checkbox"  id="EditFeatured">
            </div>
            <br>
            <div class="col-lg-6">
              <span>Meta description </span>
              <textarea name="content"  id="EditMetaDescription" class="Description" placeholder="Please enter meta description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Short description </span>
              <textarea name="content"  id="EditShortDescription" class="Description" placeholder="Please enter short description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Long description </span>
              <textarea name="content"  id="EditLanghDescription" class="Description" placeholder="Please enter Long description"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="EditeSaveButton" class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
    </div>
    <!-- delete model -->
    <div class="modal fade " id="categoryDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-model">
          <div class="modal-body">
            <div class="input-group flex-nowrap">
              <img id="categoryImg" height="120" width="200">
              <input type="hidden" id='CatagoryId'>
              <p class="deleteAlert">Are you sure you want to delete this category?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="deletebutton" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
    @include("Admin.category-subcategory.subcategory")
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite([
        'resources/js/Admin/common.js',
        'resources/js/Admin/category-subcategory/category.js',
        'resources/js/Admin/category-subcategory/category-deteails.js',
        'resources/js/Admin/category-subcategory/subcategory-deteails.js',
        'resources/js/Admin/category-subcategory/subcategory.js',
    ])
</html>
