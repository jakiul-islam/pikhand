  $(document).ready(function(){
    $(document).on("click", "#addphotobutton", function(){

      let myltipulImg = document.getElementById('myltipulImg');

      let formData = new FormData();
      formData.append('imgAddId',$('#photoProductId').val());
      for (let i = 0; i < myltipulImg.files.length; i++) {
        formData.append('myltipulImg[]', myltipulImg.files[i]);
      }
      sendDataAjax('/admin/product/add/img',formData,'post','productImgIndex','Nan','addphotobutton','Add photo','productAddPhoto');
      previewContainer.style.display="none";
    });
  });
  //index product img 
  function productImgIndex(productid){
    
    $('#photoProductId').val(productid);
    
    let formData = new FormData();
    formData.append('productId',productid);
    detailsDataAjax('/admin/product/images/index',formData,'post','productImgIndexData','Nan','Nan','Nan','Nan');
  }
  function productImgIndexData( response ){
    let preview_img = document.getElementById('preview_img');
    preview_img.innerHTML = "";
    response.products_img.forEach(function(img) {
      preview_img.innerHTML +=`
        <div style='position:relative; display:inline-block;'>
          <img src='/storage/${img.images}' style="margin:3px;" height='100'
          width='100'>
          <button onclick='productImgDelete(${img.id},${img.product_id});' style="position:absolute; top:10%; right:10%; background:none; border:none;"><i class="bi bi-trash-fill text-danger" style='font-size:1.5rem;'></i> </button>
        </div>`;
    });
  }
  //product img delete
  function productImgDelete(imgid,productId){
    let formData = new FormData();
    formData.append('imgId',imgid);
    sendDataAjax('/admin/product/images/delete',formData,'post','Nan','Nan','Nan','Nan','Nan');
    productImgIndex(productId);
  }
