  //create subsubcategory
  window.subinsert = function(){
    let featuredValue = $('#subcategoryFeatured').prop('checked') ? 1 : 0;
      const previewImage = document.querySelector("#subcategoryPreviewImage");
      const IconPreviewImage = document.querySelector("#subcategoryIconPreviewImage");
      const BannerPreviewImage = document.querySelector("#subcategoryBannerPreviewImage");

    let formData = new FormData();
      formData.append('categoryId', $('#subcategoryCategoryId').val());
      formData.append('subcategoryName', $('#subcategoryName').val());
      formData.append('subcategorySlug', $('#subcategorySlug').val());
      formData.append('subcategoryImg', $('#subcategoryImg')[0].files[0]);
      formData.append('subcategoryIcon', $('#subcategoryIcon')[0].files[0]);
      formData.append('subcategoryBanner', $('#subcategoryBanner')[0].files[0]);
      formData.append('subcategoryMetaTitle', $('#subcategoryMetaTitle').val());
      formData.append('subcategoryMetaKayword', $('#subcategoryMetaKayword').val());
      formData.append('featured', featuredValue);
      formData.append('subcategoryMetaDescription', $('#subcategoryMetaDescription').val());
      formData.append('subcategoryShortDescription', $('#subcategoryShortDescription').val());
      formData.append('subcategoryLongDescription', $('#subcategoryLongDescription').val());


      sendDataAjax('/admin/subcategory/create',formData,'post','Nan','Nan','subcategoryInsertButton','Create subcategory','createSubcategoryForm');

      // ইনপুট ফিল্ড রিসেট
      const inputsToReset = ['#subcategoryName', '#subcategorySlug','subcategoryImg', '#subcategoryIcon', '#subcategoryBanner', '#subcategoryMetaTitle', '#subcategoryMetaKayword'];
      inputsToReset.forEach(input => $(input).val(''));

      previewImage.style.display       ='none';
      IconPreviewImage.style.display   ='none';
      BannerPreviewImage.style.display ='none';
      subcatagoryIndex($('#subcategoryCategoryId').val());
      categoryFetch();
      $('#subcategoryFeatured').prop('checked',false);
      tinymce.get('subcategoryLonghDescription').setContent('');
      tinymce.get('subcategoryShortDescription').setContent('');
      tinymce.get('subcategoryMetaDescription').setContent('');
  }
  //index subsubcategory
  window.subcatagoryIndex = function( categoryId ){
    let Subcatagorytr = document.getElementById("Subcatagorytr_"+categoryId);
    if( Subcatagorytr.style.display === 'table-row'){
      Subcatagorytr.style.display = 'none';
    }else{
      Subcatagorytr.style.display = 'table-row';
      $('.subview-modal_'+categoryId).remove();
      $('.subeditor-modal_'+categoryId).remove();
      $("#Subcatagorytable_" + categoryId).empty();
      $(".showsubmodel").empty();

      let formData = new FormData();
        formData.append('categoryId',categoryId);
        detailsDataAjax('/admin/subcategory/index',formData,'post','getSubsubcategoryData','Nan','Nan','Nan','Nan');
    }
  }
  window.getSubsubcategoryData = function(response){
    $("#Subcatagorytable_"+response.categoryId).html('');
    if(response.subcategory_count > 0){
      $("#Subcatagorytable_"+response.categoryId).append(`
        <tr>
          <th></th>
          <th>id</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Product</th>
          <th>Order</th>
          <th>Click</th>
          <th>img</th>
          <th>action</th>
        </tr>
      `);
      $.each(response.subcategory, function(index, subcategoryRow) {
        $("#Subcatagorytable_"+response.categoryId).append(
          `<tr>
            <td style='width:30px;'></td>
            <td>${subcategoryRow.id}</td>
            <td>${subcategoryRow.name}</td>
            <td>${subcategoryRow.slug}</td>
            <td>${subcategoryRow.id}</td>
            <td>${subcategoryRow.ordered}</td>
            <td>${subcategoryRow.ordered}</td>
            <td><img src='/storage/${subcategoryRow.image}' width="50" height='50'></td>
            <td class='category-action' style='text-align:right; width:100px;'>
              <i onclick="ActionPoopUpShow( '${subcategoryRow.name+index}' )" class='bi bi-three-dots-vertical'></i>
              <div id='ActionPoopUp${subcategoryRow.name+index}' class='Action-poopUp'>
                <button type="button" class="buttontext" onclick="subcategoryDeteails('${subcategoryRow.id}')"><i class='bi bi-eye'></i></button>
                <button type="button" onclick="subcategoryOldData('${subcategoryRow.id}');"class="buttontext"  data-bs-toggle="modal" data-bs-target="#updateSubcategoryForm"><i class='bi bi-pencil-square'></i></button>
                <button class='subcategory-delete buttontext' onclick="subcategoryDelete('${subcategoryRow.id}' , '${subcategoryRow.image}')" type="button" data-bs-toggle="modal" data-bs-target="#subcategoryDelete"><i class="bi bi-trash"></i></button>
                <input id="subcategoryFeatured${subcategoryRow.id}" onclick="subcategoryFeaturedUpdate('${subcategoryRow.id}')"  type="checkbox" ${ subcategoryRow.featured == 1 ? 'checked' :''    } class='input-chackbox subcategory-checkbox'>
                <div class="form-check form-switch subcategory-switch">
                  <input id='subcategoryStatus${subcategoryRow.id}' ${ subcategoryRow.status == 1 ?  'checked' :''    } class="form-check-input" type="checkbox"  onclick="subcategoryStatusUpdate(${subcategoryRow.id});" role="switch" >
                </div>
                <input  type="hidden" id="Fcatagoryid${index}" value='${subcategoryRow.id}'>
              <div>
            </td>
          </tr>`
        );
      });
    }
  }
  //delete subcategory
  window.subcategoryDelete = function( subcatagoryId , subcategoryImg){
    $('#subcatagoryDeleteId').val(subcatagoryId);
    $('#subcategoryDeleteImg').attr('src', "/storage/" + subcategoryImg);
  }

  $(document).ready(function(){
    $(document).on("click", "#subcategoryDeleteButton", function(){
      let formData = new FormData();
      formData.append('Id',$('#subcatagoryDeleteId').val());
      sendDataAjax('/admin/subcategory/delete',formData,'post','categoryFetch','Nan','subcategoryDeleteButton','delete','subcategoryDelete');
    });
  });
  //update old date
  window.subcategoryOldData = function( subcategoryId ){
    let formData = new FormData();
    formData.append('subcategoryId',subcategoryId);
    detailsDataAjax('/admin/subcategory/index/oldData',formData,'post','setEditInputValue','Nan','Nan','Nan','Nan');
  }
  //set input value editS
  window.setEditInputValue = function( response ){
    $('#editSubcategoryId').val(response.subcategory.id);
    $('#editSubcategoryCategoryId').val(response.subcategory.category_id);
    $('#editSubcategoryName').val(response.subcategory.name);
    $('#editSubcategorySlug').val(response.subcategory.slug);
    $('#editSubcategoryMetaTitle').val(response.subcategory.meta_title);
    $('#editSubcategoryMetaKayword').val(response.subcategory.meta_keyword);

    $('#editSubcatagoryPreviewImage').attr('src', "/storage/" + response.subcategory.image);
    $('#editSubcatagoryIconPreview').attr('src', "/storage/" + response.subcategory.icon);
    $('#editSubcategoryBannerPreview').attr('src', "/storage/" + response.subcategory.banner);


    tinymce.get('editSubcategoryMetaDescription').setContent(response.subcategory.meta_description);
    tinymce.get('editSubcategoryShortDescription').setContent(response.subcategory.short_description);
    tinymce.get('editSubcategoryLongDescription').setContent(response.subcategory.long_description);

    if(response.subcategory.featured > 0 ){
      $('#editSubcategoryFeatured').prop('checked',true);
    }else{
      $('#editSubcategoryFeatured').prop('checked',false);
    }
  }
  //update subsubcategory
  window.update = function(){

      let EditSubcategoryImg = document.getElementById('editSubcategoryImg');
      let EditSubcategoryIcon = document.getElementById('editSubcategoryIcon');
      let EditSubcategoryBanner = document.getElementById('editSubcategoryBanner');
      let featuredValue = $('#editSubcategoryFeatured').prop('checked') ? 1 : 0;

      let formData = new FormData();

      if (EditSubcategoryImg.files.length > 0) {
        formData.append('Img', EditSubcategoryImg.files[0]);
      }else{
        formData.append('Img', '');
      }

      if (EditSubcategoryIcon.files.length > 0) {
        formData.append('Icon', EditSubcategoryIcon.files[0]);
      }else{
        formData.append('Icon', '');
      }

      if (EditSubcategoryBanner.files.length > 0) {
        formData.append('Banner', EditSubcategoryBanner.files[0]);
      }else{
        formData.append('Banner', '');
      }

    formData.append('id', $('#editSubcategoryId').val());
    formData.append('name', $('#editSubcategoryName').val());
    formData.append('slug', $('#editSubcategorySlug').val());
    formData.append('metaTitle', $('#editSubcategoryMetaTitle').val());
    formData.append('featured', featuredValue );
    formData.append('metaKeyword', $('#editSubcategoryMetaKayword').val());
    formData.append('metaDescription', tinymce.get('editSubcategoryMetaDescription').getContent());
    formData.append('shortDescription', tinymce.get('editSubcategoryShortDescription').getContent());
    formData.append('longDescription', tinymce.get('editSubcategoryLongDescription').getContent());


    ///admin/editesubsubcategory
    sendDataAjax('/admin/subcategory/update',formData,'post','Nan','Nan','subcategoryUpateButton','Update','updateSubcategoryForm');

   subcatagoryIndex( $('#editSubcategoryCategoryId').val() );

  }
  //delete subsubcategory
  window.subdelete = function( subsubcategoryId ){

    let formData = new FormData();
    formData.append('deleteSubsubcategoryId', subsubcategoryId);
    ///admin/deletesubsubcategory
    sendDataAjax('/admin/subsubcategory/delete',formData,'post','subcatagoryIndex','subsubcategoryDeleteButton','Delete','subsubcategoryDeleteModels');
}
  //featured update
  window.subcategoryFeaturedUpdate = function(subcategoryId){
    let subcategoryFeatured = $('#subcategoryFeatured'+subcategoryId).prop('checked') ? 1 : 0;

    let formData = new FormData();
      formData.append('subcategoryId', subcategoryId );
      formData.append('featured', subcategoryFeatured );

      sendDataAjax('/admin/subcategory/featured/update',formData,'post','Nan','Nan','Nan','Nan','Nan');
  }
  //status update
  window.subcategoryStatusUpdate = function(subcategoryId){
    let subcategoryStatus = $('#subcategoryStatus'+subcategoryId).prop('checked') ? 1 : 0;

    let formData = new FormData();
      formData.append('subcategoryId', subcategoryId );
      formData.append('status', subcategoryStatus );

      sendDataAjax('/admin/subcategory/status/update',formData,'post','Nan','Nan','Nan','Nan','Nan');
  }

