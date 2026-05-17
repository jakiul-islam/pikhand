    <!--  product add photo -->
    <div class="modal fade product-upload" id="productAddPhoto" tabindex="-1" aria-labelledby="productAddPhotoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5"  id="productAddPhotoLabel">product add photo model</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h1>Add img</h1>
            <h1></h1>
            <div class="product-upload">
              <input type='hidden' id='photoProductId'>
              <input type="file" id="myltipulImg" class='product_img_file' accept="image/*" multiple>
            </div>
            <div class="preview-container" id="previewContainer">
            </div>
            <hr>
            <div id='preview_img'>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" onclick='' class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id='addphotobutton' class="btn btn-primary" >add photo</button>
          </div>
        </div>
      </div>
    </div>

    