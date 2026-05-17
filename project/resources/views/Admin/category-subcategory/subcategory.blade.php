<div class="showsubmodel">
</div>
  <body>
    <!-- Insert subcategory form models -->
    <div class="modal fade editor-modal modal-remove" id="createSubcategoryForm" tabindex="-1" aria-labelledby="createSubsubcategoryFormLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="subvewIdLabel">Create new subcategory</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <div class="col-md-6 col-lg-4">
              <input type="hidden" id="subcategoryCategoryId">
              <span class="" id="addon-wrapping">Subcategory name</span><br>
              <input type="text" id="subcategoryName"  class="form-control"
              placeholder="Subcategory name" aria-label="Username"
              aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Subcategory Slug</span><br>
              <input type="text" id="subcategorySlug" class="form-control" placeholder="Subcategory slug" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Image</span><br>
              <input type="file"
              onclick="ImgPreview('subcategoryImg','subcatagoryPreviewImage' )"
              id="subcategoryImg" class="form-control" placeholder="prodect-name"
              aria-label="Username" aria-describedby="addon-wrapping">
              <img id="subcatagoryPreviewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Icon <small>(Icon size should be 16x16 px)</small></span><br>
              <input type="file"  onclick="ImgPreview('subcategoryIcon','subcatagoryIconPreview' )" id="subcategoryIcon" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="subcatagoryIconPreview" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Banner</span><br>
              <input onclick="ImgPreview('subcategoryBanner','subcategoryBannerPreview')" type="file" id="subcategoryBanner" class="form-control" aria-label="Username"aria-describedby="addon-wrapping">
              <img id="subcategoryBannerPreview" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Meta title</span><br>
              <input type="text" id="subcategoryMetaTitle" class="form-control"
              placeholder="Meta title" aria-label="Username"
              aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Meta kayword</span><br>
              <input type="text" id="subcategoryMetaKayword"
              class="form-control" placeholder="Meta kayword"
              aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Featured</span>
              <input type="checkbox" id="subcategoryFeatured">
            </div>
            <br>
            <div class="col-lg-6">
              <span>Meta description </span><br>
              <textarea name="content"  id="subcategoryMetaDescription" class="Description" placeholder="Please enter meta description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Short description </span>
              <textarea name="content"  id="subcategoryShortDescription" class="Description" placeholder="Please enter short description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Long description </span>
              <textarea name="content"  id="subcategoryLongDescription" class="Description" placeholder="Please enter long description"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="subinsert()" id="subcategoryInsertButton" class="btn btn-secondary">Create subcategory</button>
          </div>
        </div>
      </div>
    </div>
    <!-- update  subcategory form models -->
    <div class="modal fade editor-modal modal-remove" id="updateSubcategoryForm" tabindex="-1" aria-labelledby="createSubsubcategoryFormLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="subvewIdLabel">Update subsubcategory</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <div class="col-md-6 col-lg-4">
              <input type="hidden" id="editSubcategoryId">
              <input type="hidden" id="editSubcategoryCategoryId">
              <span class="" id="addon-wrapping">Subcategory Name</span><br>
              <input type="text" id="editSubcategoryName"  class="form-control" placeholder="Subcategory name" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Subcategory Slug</span><br>
              <input type="text" id="editSubcategorySlug" class="form-control"  placeholder="Subcategory slug" aria-label="Username"  aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Image</span><br>
              <input type="file"  onclick="ImgPreview('editSubcategoryImg','editSubcatagoryPreviewImage' )" id="editSubcategoryImg" class="form-control" placeholder="prodect-name"aria-label="Username" aria-describedby="addon-wrapping">
              <img id="editSubcatagoryPreviewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; ">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Icon <small>(Icon size should be 16x16 px)</small></span><br>
              <input type="file"  onclick="ImgPreview('editSubcategoryIcon','editSubcatagoryIconPreview' )" id="editSubcategoryIcon" class="form-control" aria-label="Username" aria-describedby="addon-wrapping">
              <img id="editSubcatagoryIconPreview" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; ">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Banner</span><br>
              <input onclick="ImgPreview('editSubcategoryBanner','editSubcategoryBannerPreview')" type="file" id="editSubcategoryBanner" class="form-control" aria-label="Username"aria-describedby="addon-wrapping">
              <img id="editSubcategoryBannerPreview" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; ">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Meta title</span><br>
              <input type="text" id="editSubcategoryMetaTitle" class="form-control" placeholder="Meta title" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Meta kayword</span><br>
              <input type="text" id="editSubcategoryMetaKayword" class="form-control" placeholder="Meta keyword" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <br>
            <div class="col-md-6 col-lg-4">
              <span class="" id="addon-wrapping">Featured</span>
              <input type="checkbox" id="editSubcategoryFeatured">
            </div>
            <br>
            <div class="col-lg-6">
              <span>Meta description </span><br>
              <textarea name="content"  id="editSubcategoryMetaDescription"  class="Description" placeholder="Please enter meta description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Short description </span>
              <textarea name="content"  id="editSubcategoryShortDescription" class="Description" placeholder="Please enter short description"></textarea>
            </div>
            <br>
            <div class="col-lg-6">
              <span>Long description </span>
              <textarea name="content"  id="editSubcategoryLongDescription" class="Description" placeholder="Please enter long description"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="update()" id="subcategoryUpateButton" class="btn btn-secondary">Update</button>
          </div>
        </div>
      </div>
    </div>
    <!-- subcategory delete  -->
    <div class="modal fade " id="subcategoryDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-model">
          <div class="modal-body">
            <div class="input-group flex-nowrap">
              <img id="subcategoryDeleteImg" height="120" width="200">
              <input type="hidden" id='subcatagoryDeleteId'>
              <p class="deleteAlert">Are you sure you want to delete this category?</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="subcategoryDeleteButton" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>

 </body>
 
 
 