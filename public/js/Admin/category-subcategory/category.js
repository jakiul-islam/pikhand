
  $(document).ready(function() {
    $("#insertclose").click(function() {
      const previewImage = document.querySelector("#previewImage");
        // Clear form fields and hide preview image
      $('#catagoryName').val('');
      $('#catagorySlug').val('');
      $('#imageInput').val('');
      $('#description').val(''); // Don't forget this if you want to clear it too
      previewImage.style.display = 'none';
    });
  });

  // category insert
  $(document).ready(function(){
    $("#insertCatagory").click(function(){
      // e.preventDefault();
      let featuredValue = $('#categoryFeatured').prop('checked') ? 1 : 0;
      const previewImage = document.querySelector("#previewImage");
      const IconPreviewImage = document.querySelector("#IconPreviewImage");
      const BannerPreviewImage = document.querySelector("#BannerPreviewImage");

      let formData = new FormData();
      formData.append('categoryName', $('#categoryName').val());
      formData.append('categorySlug', $('#categorySlug').val());
      formData.append('imageInput', $('#imageInput')[0].files[0]);
      formData.append('categoryIcon', $('#categoryIcon')[0].files[0]);
      formData.append('categoryBanner', $('#categoryBanner')[0].files[0]);
      formData.append('categorymetatitle', $('#categorymetatitle').val());
      formData.append('categoryMetaKayword', $('#categoryMetaKayword').val());
      formData.append('featured', featuredValue);
      formData.append('MetaDescription', $('MetaDescription').val() );
      formData.append('shortDescription', $('shortDescription').val() );
      formData.append('langhDescription', $('longDescription').val() );

      sendDataAjax('/admin/category/create',formData,'post','categoryFetch','Nan','insertCatagory','Create','categoryForm');
      $('#categoryName').val('');
      $('#categorySlug').val('');
      $('#categoryIcon').val('');
      $('#categoryBanner').val('');
      $('#categorymetatitle').val('');
      $('#categoryMetaKayword').val('');
      $('#imageInput').val('');
      previewImage.style.display       ='none';
      IconPreviewImage.style.display   ='none';
      BannerPreviewImage.style.display ='none';
      $('#categoryFeatured').prop('checked',false);
      $('longDescription').val('');
      $('shortDescription').val('');
      $('MetaDescription').val('');

    });
  });

  //categoryFetch
  window.categoryFetch = function(){
    fetchDataAjax('/admin/category/index','post','categoryGetData','Nan');
  }
  categoryFetch();

  window.categoryGetData  = function(response){

    $('#productContainer').html(''); // পুরানো ডাটা মুছে ফেলবে
    $.each(response.category, function(index, category) {

      let subcategoryCount = 0 ;
      $.each(response.subcategory, function(index, subcategoryRow) {
        if(subcategoryRow.category_id == category.id ){
          subcategoryCount++;
        }
      })

      $('#productContainer').append(`
        <tr>
          <td onclick='subcatagoryIndex( ${category.id} );'>${category.id}</td>
          <td onclick='subcatagoryIndex( ${category.id} );'></td>
          <td style="width:5px;" onclick='subcatagoryIndex( ${category.id} );'>${category.name}</td>
          <td onclick='subcatagoryIndex( ${category.id} );'>${category.slug}</td>
          <td onclick='subcatagoryIndex( ${category.id} );'>${subcategoryCount}</td>
          <td onclick='subcatagoryIndex( ${category.id} );'>${category.order}</td>
          <td onclick='subcatagoryIndex( ${category.id} );'>0</td>
          <td onclick='subcatagoryIndex( ${category.id} );'><img src="/storage/${category.image}" width="50" height='50' alt="${category.name}"></td>
          <td class='category-action' style='text-align:right; width:100px;'>
            <i onclick='ActionPoopUpShow(${category.id})' class='bi bi-three-dots-vertical'></i>
            <div id='ActionPoopUp${category.id}' class='Action-poopUp'>
              <button type="button" class="buttontext" onclick="categoryDeteails('${category.id}')"><i class='bi bi-eye'></i></button>
              <button onclick="subcategoryShowForm('${category.id}')"  type="button" class="buttontext" data-bs-toggle="modal" data-bs-target="#createSubcategoryForm"><i class='bi bi-file-plus'></i></button>
              <button type="button" onclick="CategoryOldData(
                '${category.id}','${category.name}','${category.slug}','${category.image}','${category.meta_title}','${category.meta_description}',
                '${category.short_description}','${category.description}','${category.meta_keywords}','${category.icon}','${category.banner}','${category.featured}'
              );"class="buttontext" data-bs-toggle="modal" data-bs-target="#categoryEditForm"><i class='bi bi-pencil-square'></i></button>
              <button onclick="categoryDelete('${category.id}' , '${category.image}')" type="button" class="buttontext" data-bs-toggle="modal" data-bs-target="#categoryDelete"><i class="bi bi-trash"></i></button>
              <input onclick="featuredUpdate('${category.id}')"  type="checkbox"
              ${ category.featured == 1 ? 'checked' :''    }
              class='input-chackbox' id="featured${category.id}" value='${category.id}'>
              <div class="form-check form-switch">
                <input id='statusSwitch${category.id}' ${ category.status == 1 ?'checked' :''    } class="form-check-input" type="checkbox"  onclick="statusUpdate(${category.id} , ${subcategoryCount});" role="switch" >
              </div>
              <input  type="hidden" id="Fcatagoryid${index}" value='${category.id}'>
            <div>
          </td>
        </tr>
        <tr id='Subcatagorytr_${category.id}' style='display:none;' class='subcategoryShow'>
          <td colspan='10'>
            <table id='Subcatagorytable_${category.id}' style='width:100%;'  class=' table-light'>
            </table>
          </td>
        </tr>
      `);
    });
  }


  //set edit old dete
  window.subcategoryShowForm = function(id){
    $("#subcategoryCategoryId").val(id);
  }
  window.CategoryOldData = function(id , name , slug ,image,
  meta_title,meta_description,short_description,description,meta_keywords,icon,banner,featured){

    $('#EditPreviewImage').attr('src', "/storage/" + image);
    $('#EditPreviewIcon').attr('src', "/storage/" + icon);
    $('#EditPreviewBanner').attr('src', "/storage/" + banner);

    $('#EditCategoryId').val(id);
    $('#EditCategoryName').val(name);
    $('#EditCategorySlug').val(slug);
    $('#EditMetaTitle').val(meta_title);
    $('#EditMetakeyword').val(meta_keywords);


    tinymce.get('EditMetaDescription').setContent(meta_description);
    tinymce.get('EditShortDescription').setContent(short_description);
    tinymce.get('EditLanghDescription').setContent(description);

    $('#EditCategoryOldImg').val(image);
    $('#EditCategoryOldIcone').val(icon);
    $('#EditCategoryOldBanner').val(banner);

    if(featured > 0 ){
      $('#EditFeatured').prop('checked',true);
    }else{
      $('#EditFeatured').prop('checked',false);
    }
  }

  //category change function
  $(document).ready(function(){
    $(document).on("click", "#EditeSaveButton", function(){
      let EditCategoryImg = document.getElementById('EditCategoryImg');
      let EditCategoryIcon = document.getElementById('EditCategoryIcon');
      let EditCategoryBanner = document.getElementById('EditCategoryBanner');


      let formData = new FormData();
      if (EditCategoryImg.files.length > 0) {
        formData.append('EditCategoryImg', EditCategoryImg.files[0]);
      }else{
        formData.append('EditCategoryImg', '');
      }


      if (EditCategoryIcon.files.length > 0) {
        formData.append('EditCategoryIcon', EditCategoryIcon.files[0]);
      }else{
        formData.append('EditCategoryIcon', '');
      }

      if (EditCategoryBanner.files.length > 0) {
        formData.append('EditCategoryBanner', EditCategoryBanner.files[0]);
      }else{
        formData.append('EditCategoryBanner', '');
      }


      formData.append('EditCategoryId', $('#EditCategoryId').val());
      formData.append('EditCategoryName', $('#EditCategoryName').val());
      formData.append('EditCategorySlug', $('#EditCategorySlug').val());
      formData.append('EditMetaTitle', $('#EditMetaTitle').val());
      formData.append('EditMetakeyword', $('#EditMetakeyword').val());

      formData.append('EditMetaDescription', tinymce.get('EditMetaDescription').getContent());
      formData.append('EditShortDescription', tinymce.get('EditShortDescription').getContent());
      formData.append('EditLanghDescription', tinymce.get('EditLanghDescription').getContent());



      sendDataAjax('/admin/category/update',formData,'post','categoryFetch','Nan','EditeSaveButton','Update','categoryEditForm');
    });
  });

  //delete catagory
  window.categoryDelete = function( CatagoryId , categoryImg){
    $('#CatagoryId').val(CatagoryId);
    $('#categoryImg').attr('src', "/storage/" + categoryImg);
  }

  $(document).ready(function(){
    $(document).on("click", "#deletebutton", function(){
      let formData = new FormData();
      formData.append('deleteId',$('#CatagoryId').val());
      sendDataAjax('/admin/category/delete',formData,'post','categoryFetch','Nan','deletebutton','Delete','categoryDelete');
    });
  });

  window.ImgPreview = function(inputId , previewId){
    document.getElementById(inputId).addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const previewImage = document.getElementById(previewId);
          previewImage.src = e.target.result;
          previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
  }
  window.Catagory = function() {
    categoryFetch();
    $("#mainContain").html(originalContent);
  };
  //action poopup
  window.ActionPoopUpShow = function( id ){

    let ActionPoopUp = document.getElementById('ActionPoopUp'+id);
    if(ActionPoopUp.style.display == 'block'){
      ActionPoopUp.style.display = 'none';
    }else{
      ActionPoopUp.style.display = 'block';
    }
  }
  //featured update
  window.featuredUpdate = function( categoryId){
    let featured = $("#featured"+categoryId).prop('checked')? 1 : 0 ;
    let formData = new FormData();
      formData.append('categoryId',categoryId);
      formData.append('featured',featured);
      sendDataAjax('/admin/category/featured/update',formData,'post','Nan','Nan','Nan','Nan','Nan');

  }
  //status update
  window.statusUpdate = function( categoryId , subcategoryCount){
    let statusSwitch = $("#statusSwitch"+categoryId).prop('checked')? 1 : 0 ;
    if(subcategoryCount > 0){
      if(statusSwitch == 1 ){
        let formData = new FormData();
          formData.append('categoryId',categoryId);
          formData.append('statusSwitch',statusSwitch);
          sendDataAjax('/admin/category/status/update',formData,'post','Nan','Nan','Nan','Nan','Nan');
      }else{
        if(statusSwitch == 0){
          $("#statusSwitch"+categoryId).prop('checked',true);
        }
      }
    }else{
      let formData = new FormData();
        formData.append('categoryId',categoryId);
        formData.append('statusSwitch',statusSwitch);
        sendDataAjax('/admin/category/status/update',formData,'post','Nan','Nan','Nan','Nan','Nan');

    }

  }
