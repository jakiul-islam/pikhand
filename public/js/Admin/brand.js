  $(document).ready(function() {
    $("#insertclose").click(function() {
      const previewImage = document.querySelector("#previewImage");
        // Clear form fields and hide preview image
      $('#brandName').val('');
      $('#brandSlog').val('');
      $('#imageInput').val('');
      $('#branddescription').val(''); // Don't forget this if you want to clear it too
      previewImage.style.display = 'none';
    });
  });
  //Create brand
  $(document).ready(function(){
    $("#insertBrand").click(function(){
      const previewImage = document.querySelector("#previewImage");
      let formData = new FormData();
        formData.append('brandName', $('#brandName').val());
        formData.append('brandSlog', $('#brandSlog').val());
        formData.append('metaTitle', $('#metaTitle').val());
        formData.append('metaKeyword', $('#metaKeyword').val());
        formData.append('metaDescription', $('#metaDescription').val());
        formData.append('imageInput', $('#imageInput')[0].files[0]);
        formData.append('brand_describtion',tinymce.get('branddescription').getContent());
        
        sendDataAjax('/admin/brand/create',formData,'post','brandFetch','Nan','insertBrand','Add new','brandCreateForm');
        
        previewImage.style.display= 'none';
        
        $('#brandName').val('');
        $('#brandSlog').val('');
        $('#imageInput').val('');
        $('#metaTitle').val('');
        $('#metaKeyword').val('');
        $('#metaDescription').val('');
        tinymce.get('branddescription').setContent('');
    });
  });
  //fetch brand
  function brandFetch(){
    $('.editor-modal').remove(); 
    fetchDataAjax('/admin/brand/index','post','brandData','Nan');
  }
  brandFetch();
  function brandData(response){
    $('#allBrand').html(''); // পুরানো ডাটা মুছে ফেলবে
    $.each(response.brand, function(index, brand) {
      let productCount = 0;
      $.each(response.product, function(index, productRow) {
        if(productRow.brand_id == brand.id){
          productCount++;
        }
      });
      
      
      $('#allBrand').append(`
        <tr>
          <td>${brand.id}</td>
          <td style="width:5px;">${brand.name}</td>
          <td>${brand.slug}</td>
          <td>${brand.description}</td>
          <td><img src="/storage/${brand.logo}" width="100" alt="${brand.name}"></td>
          <td>
            <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#"><i class='bi bi-eye'></i></button>
            <button onclick="setOldData(${JSON.stringify(brand).replace(/"/g, '&quot;')})" type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#brandUpdateForm"><i class='bi bi-pencil-square'></i></button>
            <button onclick="deleteDataSet( '${brand.id}','${brand.logo}')" type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#deleteModel"><i class="bi bi-trash"></i></button>
            <div class="form-check form-switch">
              <input id='statusSwitch${brand.id}' ${ brand.status == 1 ?'checked' :''    } class="form-check-input" type="checkbox" onclick="statusUpdate(${brand.id} , ${productCount});" role="switch" >
            </div>
          </td>
        </tr>
      `);
    });
  }
  function setOldData( brand ){
    $('#editBrandId').val(brand.id);
    $('#editBrandName').val(brand.name);
    $('#editBrandSlog').val(brand.slug);
    $('#editMetaTitle').val(brand.meta_title);
    $('#editMetaKeyword').val(brand.meta_keyword);
    $('#editMetaDescription').val(brand.meta_description);
    tinymce.get('editBrandDescription').setContent(brand.description);
    
    $('#editPreviewImage').attr('src', "/storage/" + brand.logo);
  }
  //brand update
  $(document).ready(function(){
    $(document).on("click", "#updateBrand", function(){
      
    let formData = new FormData();
      let editBrandImg = document.getElementById('editBrandImg');
      if (editBrandImg.files.length > 0) {
        formData.append('img', editBrandImg.files[0]);
      }else{
        formData.append('img', '');
      }
      formData.append('id', $('#editBrandId').val());
      formData.append('name', $('#editBrandName').val());
      formData.append('slug', $('#editBrandSlog').val());
      formData.append('meta_title', $('#editMetaTitle').val());
      formData.append('meta_keyword', $('#editMetaKeyword').val());
      formData.append('meta_description', $('#editMetaDescription').val());
      formData.append('description', tinymce.get('editBrandDescription').getContent());
      
      sendDataAjax('/admin/brand/update',formData,'post','brandFetch','Nan','updateBrand','<i class="bi bi-save"></i>Update','brandUpdateForm');
    });
  });
  //end brand change function
  //delete brand
  function deleteDataSet( id , logo ){
    $('#deleteBramdImage').attr('src', "/storage/" + logo);
    $('#deleteBrandId').val(id);
  }
  $(document).ready(function(){
    $(document).on("click", "#brandDeleteButton", function(){
      
      let formData = new FormData();
      formData.append('id', $('#deleteBrandId').val() );
      
      sendDataAjax('/admin/brand/delete',formData,'post','brandFetch','Nan','brandDeleteButton','Delete','deleteModel');

    });
  });
  //status update 
  function statusUpdate( id , productCount){
    let statusSwitch = $("#statusSwitch"+id).prop('checked')? 1 : 0 ;
    if(productCount > 0){
      if(statusSwitch == 1 ){
        let formData = new FormData();
          formData.append('id',id);
          formData.append('statusSwitch',statusSwitch);
          sendDataAjax('/admin/brand/status/update',formData,'post','Nan','Nan','Nan','Nan','Nan');
      }else{
        if(statusSwitch == 0){
          $("#statusSwitch"+categoryId).prop('checked',true);
        }
      }
    }else{
      let formData = new FormData();
        formData.append('id',id);
        formData.append('statusSwitch',statusSwitch);
        sendDataAjax('/admin/brand/status/update',formData,'post','Nan','Nan','Nan','Nan','Nan');
    }
  }
  //img preview 
  function imgPreview(inputId,imgTagId){
    document.getElementById(inputId).addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const previewImage = document.getElementById(imgTagId);
          previewImage.src = e.target.result;
          previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
  }
