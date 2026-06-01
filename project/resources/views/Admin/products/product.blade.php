<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admin product managements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/Admin/product.css') }}">

      
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('public/tinymce/tinymce.min.js') }}"></script>
    <script>
      tinymce.init({
        selector: '.description',
        license_key: 'gpl',
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
    @include("Admin.Include.header")
    <div class="main-contain" id="product_detels_show">
      <div class="name-2">
        <h1>Create new product</h1>
        <h3 class="alartdiv name-1" style="position: fixed; bottom: 40px; margin-left:30%;" id='successalert'>successfull</h3>
        <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductForm">
          Create
        </button>
      </div>
      <!-- product filter -->
      <div class="search-fillter">
        <div class="div-search">
          <input required class="form-control search shadow-none" id="search_input"oninput="searchProduct();"  type="text" placeholder="Iam looking for..." aria-label="default input example">
          <button class="submit-search"  type="submit"> <i class="bi bi-search"></i></button>
        </div>
        <div class="row">
          <div class="col-md-6  fillter-input-div">
            <select id="select" onchange="searchProduct();" class="shadow-none fillter-input" aria-label="Default select example">
              <option  value="All">All product</option>
              <option  value="1">active</option>
              <option  value="0">unactive</option>
            </select>
          </div>

          <div class="col-md-6  fillter-input-div">
            <input  type="datetime-local" id="time" oninput="searchProduct();" class=" shadow-none fillter-input">
          </div>
        </div>
      </div>

      <!-- product show table -->
      <!--</thead>-->
      <div  style='width:100%; overflow:auto;'>
        <table class="table table-hover">
          <thead class="tableheader table-dark ">
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">keyword</th>
              <th scope="col">price</th>
              <th scope="col">avolalbe</th>
              <th scope="col">discount</th>
              <th scope="col">Images</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody style='height:100px; overflow: auto;' id="ProductShowTable" class="table-group-divider">
          </tbody>
        </table>
      </div>
    </div>
    <!-- all model site -->
    <!-- Create new product form model -->
    <div class="modal fade" id="createProductForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create new product</h1>
            <button type="button" id="insertclose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="name-label" class="d-block mb-1">Product Name</span>
              <input type="text" id="productName" class="form-control" placeholder="Type product name here" aria-label="Type product name here" aria-describedby="name-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="keyword-label" class="d-block mb-1">Product keywords</span>
              <input type="text" id="productKeyword" class="form-control" placeholder="Type relevant kaywords" aria-label="Type relevant kaywords" aria-describedby="keyword-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="subcategory-label" class="d-block mb-1">Choose subcategory</span>
              <div class="product-form-main-category " id='categoryshow'>
              </div>
              <input type="hidden" id='checkboxvalue'>
              <button type="button" class="form-control" id='categoryshowbutton' onclick="categoryshow()" >select</button>
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="image-label" class="d-block mb-1">Add image</span>
              <input type="file" id="productImg" class="form-control" placeholder="" aria-label="Add product image" aria-describedby="image-label">
              <img id="previewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="meta-title-label" class="d-block mb-1">Meta title</span>
              <input type="text" id="productmatatitle" class="form-control"
              placeholder="Enter a catchy meta title" aria-label="Enter a catchy
              meta title"aria-describedby="meta-title-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="product-code-label" class="d-block mb-1">Product code</span>
              <input type="text" id="productCode" class="form-control"
              placeholder="Enter product code" aria-label="Enter product code"
              aria-describedby="product-code-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="product-sku-label" class="d-block mb-1">Sku</span>
              <input type="text" id="productSku" class="form-control"
              placeholder="Enter a producy sku" aria-label="Enter product sku"
              aria-describedby="product-sku-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="product-weight-label" class="d-block mb-1">Product weight</span>
              <input type="number" id="weight" class="form-control" placeholder="Enter product weight" aria-label="Enter product weight" aria-describedby="product-weight-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="dimensions-label" class="d-block mb-1">Dimensions (L x W x H)</span>
              <input type="text" id="dimensions" class="form-control" placeholder="e.g. 20 x 15 x 5 cm" aria-label="Enter dimensions" aria-describedby="dimensions-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="color-label" class="d-block mb-1">Color</span>
              <input type="text" id="color" class="form-control" placeholder="Enter color" aria-label="Enter color" aria-describedby="color-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="size-label" class="d-block mb-1">Size</span>
              <input type="text" id="size" class="form-control" placeholder="Enter size" aria-label="Enter size" aria-describedby="size-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="material-label" class="d-block mb-1">Material</span>
              <input type="text" id="material" class="form-control" placeholder="Enter material" aria-label="Enter material" aria-describedby="material-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="warranty-label" class="d-block mb-1">Warranty</span>
              <input type="text" id="warranty" class="form-control" placeholder="Enter warranty details" aria-label="Enter warranty" aria-describedby="warranty-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="return-policy-label" class="d-block mb-1">Return Policy</span>
              <textarea id="returnPolicy" class="form-control" placeholder="Enter return policy details" aria-label="Enter return policy" aria-describedby="return-policy-label"></textarea>
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span  id="addon-wrapping" class="d-block mb-1" >Product price</span>
              <input type="number" id="productPrice" class="form-control"  placeholder="Add product price" aria-label="Username" aria-describedby="addon-wrapping">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span  id="addon-wrapping" class="d-block mb-1">Avolalbe stock</span>
              <input type="number" id="productAvolalabe" class="form-control" placeholder="Enter available stock" aria-label="Username" aria-describedby="addon-wrapping">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="addon-wrapping" class="d-block mb-1">discount</span>
              <input type="number" id="productDiscount" class="form-control" placeholder="Discount in (%) " aria-label="Username" aria-describedby="addon-wrapping">
            </div>

            <div class="col-md-6 col-lg-6 mb-1">
              <label class="d-block mb-1">Meta description</label>
              <textarea id="matadescription" class='description' placeholder="Write a brief description for SEO"></textarea><br>
            </div>
            <div class="col-md-6 col-lg-6 mb-1">
              <label class="d-block mb-1">Short description</label>
              <textarea id="shortdescription" class='description' placeholder="Describe your product briefly"></textarea>
            </div>
            <div class="col-md-12 col-lg-12">
              <label class="d-block mb-1">Long description</label>
              <textarea id="longdescription" class='description'placeholder="Provide a detailed description of the product or content"></textarea>
            </div>
          </div>
          <div id='addfilterdiv'>
          </div>
          <div class="modal-footer">
            <button type="button" id="insertclose" onclick="insertclose()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="productCreateButton" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>
    <!-- update product form model -->
    <div class="modal fade" id="updateProductForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit product</h1>
            <button type="button" id="insertclose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <div class="col-6 col-md-4 col-lg-3 mb-1">
               <input type="hidden" id='editProductId'>
              <span id="edit-name-label" class="d-block mb-1">Product Name</span>
              <input type="text" id="editProductName" class="form-control" placeholder="Type product name here" aria-label="Type product name here" aria-describedby="edit-name-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-keyword-label" class="d-block mb-1">Product keywords</span>
              <input type="text" id="editProductKeyword" class="form-control"
              placeholder="Type relevant kaywords" aria-label="Type relevant
              kaywords" aria-describedby="edit-keyword-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-subcategory-label" class="d-block mb-1">Choose subcategory</span>
              <div class="product-form-main-category" id='editcategoryshow'></div>
              <input type="hidden" id='editCheckboxvalue'>
              <button type="button" class="form-control" id='editCategoryshowbutton' onclick="editcategoryshow()" >select</button>
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-image-label" class="d-block mb-1">Add image</span>
              <input type="file" id="editProductImg" class="form-control" placeholder="" aria-label="Add product image" aria-describedby="edit-image-label">
              <img id="editPreviewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px;">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-meta-title-label" class="d-block mb-1">Meta title</span>
              <input type="text" id="editProductmetatitle" class="form-control"
              placeholder="Enter a catchy meta title" aria-label="Enter a catchy
              meta title"aria-describedby="edit-meta-title-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-product-code-label" class="d-block mb-1">Product code</span>
              <input type="text" id="editProductCode" class="form-control"
              placeholder="Enter product code" aria-label="Enter product code"
              aria-describedby="edit-product-code-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-product-sku-label" class="d-block mb-1">Sku</span>
              <input type="text" id="editProductSku" class="form-control"
              placeholder="Enter a producy sku" aria-label="Enter product sku"
              aria-describedby="edit-product-sku-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-product-weight-label" class="d-block mb-1">Product weight</span>
              <input type="number" id="editWeight" class="form-control" placeholder="Enter product weight" aria-label="Enter product weight" aria-describedby="edit-product-weight-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-dimensions-label" class="d-block mb-1">Dimensions (L x W x H)</span>
              <input type="text" id="editDimensions" class="form-control" placeholder="e.g. 20 x 15 x 5 cm" aria-label="Enter dimensions" aria-describedby="edit-dimensions-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-color-label" class="d-block mb-1">Color</span>
              <input type="text" id="editColor" class="form-control" placeholder="Enter color" aria-label="Enter color" aria-describedby="edit-color-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-size-label" class="d-block mb-1">Size</span>
              <input type="text" id="editSize" class="form-control" placeholder="Enter size" aria-label="Enter size" aria-describedby="edit-size-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-material-label" class="d-block mb-1">Material</span>
              <input type="text" id="editMaterial" class="form-control" placeholder="Enter material" aria-label="Enter material" aria-describedby="edit-material-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-warranty-label" class="d-block mb-1">Warranty</span>
              <input type="text" id="editWarranty" class="form-control" placeholder="Enter warranty details" aria-label="Enter warranty" aria-describedby="edit-warranty-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-return-policy-label" class="d-block mb-1">Return Policy</span>
              <textarea id="editReturnPolicy" class="form-control" placeholder="Enter return policy details" aria-label="Enter return policy" aria-describedby="edit-return-policy-label"></textarea>
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span  id="edit-price-label" class="d-block mb-1" >Product price</span>
              <input type="number" id="editProductPrice" class="form-control"  placeholder="Add product price" aria-label="Add product price" aria-describedby="edit-edit-price-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span  id="edit-stock-label" class="d-block mb-1">Avolalbe stock</span>
              <input type="number" id="editProductAvolalabe" class="form-control" placeholder="Enter available stock" aria-label="Enter available stock" aria-describedby="edit-stock-label">
            </div>

            <div class="col-6 col-md-4 col-lg-3 mb-1">
              <span id="edit-discount-label" class="d-block mb-1">discount</span>
              <input type="number" id="editProductDiscount" class="form-control" placeholder="Discount in (%) " aria-label="Discount in (%) " aria-describedby="edit-discount-label">
            </div>

            <div class="col-md-6 col-lg-6 mb-1">
              <label class="d-block mb-1">Meta description</label>
              <textarea id="editMetadescription" class='description' placeholder="Write a brief description for SEO"></textarea><br>
            </div>
            <div class="col-md-6 col-lg-6 mb-1">
              <label class="d-block mb-1">Short description</label>
              <textarea id="editShortdescription" class='description' placeholder="Describe your product briefly"></textarea>
            </div>
            <div class="col-md-12 col-lg-12">
              <label class="d-block mb-1">Long description</label>
              <textarea id="editLongdescription" class='description'placeholder="Provide a detailed description of the product or content"></textarea>
            </div>
          </div>
          <div id='addfilterdiv'>
          </div>
          <div class="modal-footer">
            <button type="button" id="insertclose" onclick="insertclose()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" onclick="updateProduct()" id="productUpdateButton" class="btn
            btn-primary">Update</button>
          </div>
        </div>
      </div>
    </div>
    <!-- product delete model -->
    <div class="modal fade " id="deleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-model">
          <div class="modal-body">
            <div class="input-group flex-nowrap">
              <img id="deleteProductImage" height="120" width="200">
              <input type="hidden" id='deleteProductId'>
              <p class="deleteAlert">Are you sure you want to delete this category?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="deletebutton" onclick="deleteProduct()" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div id='faildalert'></div>
    @include("Admin.products.product_img_add")

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite([
        'resources/js/Admin/common.js',
        'resources/js/Admin/product/product.js',
        'resources/js/Admin/product/product-details.js',
        'resources/js/Admin/product/product-img.js',
        'resources/js/Admin/product/product-update.js'
    ])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
