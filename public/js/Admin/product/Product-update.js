//update deta set for input 
   let subcategoryId = [];
  let productId = [];
  function updateDataSet( product , response){
    
    subcategoryId = [];
    
    let editCategoryshowbutton = document.getElementById('editCategoryshowbutton');
    editCategoryshowbutton.innerHTML = `Select`;
    $('#editCheckboxvalue').val('');
    
    productId = [];
    productId = productId.concat(product.id);
    
    let categoryContainer = document.getElementById('editcategoryshow');
    categoryContainer.style.display='none';
    categoryContainer.classList.add('categoryContainer'+product.id);
    
    $('#editProductId').val(product.id);
    $('#editProductName').val(product.name);
    $('#editProductKeyword').val(product.slug);
    $('#editProductmetatitle').val(product.mata_title);
    
    $.each(golobalcategory, function(index, subcategory) {
      if(product.id == subcategory.product_id){
        subcategoryId = subcategoryId.concat(subcategory.subcategory_id);
      }
    });
    
    console.log(subcategoryId);
    //$('#editCheckboxvalue').val(subcategoryId);
    
    //$('#editProductBrand').val();
    //$('#productImg')[0].files[0];
    $('#editPreviewImage').attr('src', `/storage/${product.image}`);
    $('#editProductPrice').val(product.price);
    $('#editProductAvolalabe').val(product.stock);
    $('#editProductDiscount').val(product.discount);
    $('#editProductCode').val(product.product_code);
    $('#editProductSku').val(product.sku);
    $('#editWeight').val(product.weight);
    $('#editDimensions').val(product.dimensions);
    $('#editColor').val(product.color);
    $('#editSize').val(product.size);
    $('#editMaterial').val(product.material);
    $('#editWarranty').val(product.warranty);
    $('#editReturnPolicy').val(product.return_policy);
    tinymce.get('editMetadescription').setContent(product.mata_description);
    tinymce.get('editShortdescription').setContent(product.short_description);
    tinymce.get('editLongdescription').setContent(product.long_description);
    
  }
  
  
  //edit product section
  function updateProduct(){
   
    /*const selectedIds = [...new Set(
      $('.eeditCheckboxvalue:checked')
        .map(function () { return this.value; })
        .get()
    )];*/
    
    let editProductImg  = document.getElementById('editProductImg');
    
    
    
    let formData = new FormData();
             
    if ( editProductImg.files.length > 0 ) {
      formData.append('editProductImg',editProductImg.files[0]);
    }
    formData.append('editProductId', $('#editProductId').val());
    formData.append('editProductName', $('#editProductName').val());
    formData.append('editProductKeyword', $('#editProductKeyword').val());
    formData.append('editProductmetatitle', $('#editProductmetatitle').val());
    formData.append('editProductPrice', $('#editProductPrice').val());
    formData.append('editProductAvolalabe', $('#editProductAvolalabe').val());
    formData.append('editProductDiscount', $('#editProductDiscount').val());
    formData.append('editProductCode', $('#editProductCode').val());
    formData.append('editProductSku', $('#editProductSku').val());
    formData.append('editWeight', $('#editWeight').val());
    formData.append('editDimensions', $('#editDimensions').val());
    formData.append('editColor', $('#editColor').val());
    formData.append('editSize', $('#editSize').val());
    formData.append('editMaterial', $('#editMaterial').val());
    formData.append('editWarranty', $('#editWarranty').val());
    formData.append('editReturnPolicy', $('#editReturnPolicy').val());
    formData.append('editMetadescription', tinymce.get('editMetadescription').getContent());
    formData.append('editShortdescription', tinymce.get('editShortdescription').getContent());
    formData.append('editLongdescription', tinymce.get('editLongdescription').getContent());
   
    formData.append('editSubcategory',$('#editCheckboxvalue').val());
    
    sendDataAjax('/admin/product/update',formData,'post','productCreateSuccess','Nan','productUpdateButton','Update','updateProductForm');

  }
  
  function editcategoryshow(){
    fetchDataAjax('/admin/category/index','post','editcategoryData','Nan');
  }
  
  function editcategoryData( response ){
    let container = document.querySelector('.categoryContainer'+productId);
    const editselectedSet = new Set(
      document.getElementById('editCheckboxvalue').value
      .split(',')                              
      .map(id => id.trim())
    );
    
    if(container.style.display==='block'){
      container.style.display='none';
    }else{
      container.style.display='block';
      container.innerHTML=`
        <div class='product-form-category-container top-50'>
           <div id='editproductCategory'>
           </div>
           <button onclick='editcloseAndok();'>Ok</button>
         </div>
       `;
    }
    $('#editproductCategory').html('');
    $.each(response.category, function(index, Category) {
      $('#editproductCategory').append(`
        <div class="product-form-category" onclick='editsubcategory(${Category.id}); '>
          <p style="margin: 0;">${Category.name}</p>
          <p style="margin: 0;"><i class="bi bi-caret-down"  id='editsubbuttonicon_${Category.id}'></i></p>
        </div>
        <div id='editsubcategoryshow_${Category.id}' style='display:none;'>
        </div> 
      `);
      $.each(response.subcategory, function(index, subcategory) {
        if(subcategory.category_id == Category.id){
          let subcategoryshow = document.getElementById("editsubcategoryshow_"+Category.id);
          
        /*  const editisChecked = editselectedSet.has(String(subcategory.id)) ? "checked" : "";
          if(editisChecked == 'checked'){
            subcategoryshow.style.display = 'block';
          }
        
        */
          let isChecked = '';
          $.each(subcategoryId, function(index, subcategoryid) {
            
            if(subcategoryid == subcategory.id){
               isChecked = "checked";
            }
          });
          
          if(isChecked == 'checked'){
            subcategoryshow.style.display = 'block';
          }
          
          $("#editsubcategoryshow_"+Category.id).append(`
            <label style='margin-left:15px;'>
              <input type='checkbox' id='${subcategory.name}' class='edit-category-checkbox' value='${subcategory.id}' ${isChecked}> ${subcategory.name}
            </label><br>
          `);
          
        }
      });
    });
  }
  
  function editsubcategory( Category ){
    let subcategoryshow = document.getElementById('editsubcategoryshow_'+Category);
    let subbuttonicon = document.getElementById('editsubbuttonicon_'+Category);
    if (subbuttonicon.classList.contains('bi-caret-down')) {
      subbuttonicon.classList.remove('bi-caret-down');
      subbuttonicon.classList.add('bi-caret-up');
      subcategoryshow.style.display='block';
    } else {
      subbuttonicon.classList.remove('bi-caret-up');
      subbuttonicon.classList.add('bi-caret-down');
      subcategoryshow.style.display='none';
    }
  }
  
  function editcloseAndok(){
    let editCategoryshowbutton = document.getElementById('editCategoryshowbutton');
    const selectedIds = $('.edit-category-checkbox:checked')
    .map(function () {
      return this.value;
    })
    .get();
    const count = selectedIds.length;
    editCategoryshowbutton.innerHTML = ` ${count} Category selected  `;
    $('#editCheckboxvalue').val(selectedIds.join(','));
    editcategoryshow();
  }