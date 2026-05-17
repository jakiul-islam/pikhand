  //product input section
  $(document).ready(function(){
    $("#productCreateButton").click(function(){
      const previewImage = document.querySelector("#previewImage");

      let formData = new FormData();
        formData.append('name', $('#productName').val());
        formData.append('keyword', $('#productKeyword').val());
        formData.append('metaTitle', $('#productmatatitle').val());
        formData.append('category', $('#checkboxvalue').val() );
        formData.append('brand', $('#productBrand').val());
        formData.append('image', $('#productImg')[0].files[0]);
        formData.append('price', $('#productPrice').val());
        formData.append('avolalabe', $('#productAvolalabe').val());
        formData.append('discount', $('#productDiscount').val());
        formData.append('code', $('#productCode').val());
        formData.append('sku', $('#productSku').val());
        formData.append('weight', $('#weight').val());
        formData.append('dimensions', $('#dimensions').val());
        formData.append('color', $('#color').val());
        formData.append('size', $('#size').val());
        formData.append('material', $('#material').val());
        formData.append('warranty', $('#warranty').val());
        formData.append('return-policy', $('#returnPolicy').val());
        formData.append('MetaDescription',tinymce.get('matadescription').getContent());
        formData.append('ShortDescription',tinymce.get('shortdescription').getContent());
        formData.append('LongDescription',tinymce.get('longdescription').getContent());

        sendDataAjax('/admin/product/create',formData,'post','productCreateSuccess','Nan','productCreateButton','create','createProductForm');
    });
  });
  function productCreateSuccess(){
    insertclose();
    let currentPage = 1;
    let loading = false;
    let nextPage = 1;
    $('#ProductShowTable').html('');
    indexProduct( currentPage );
  }
  //model close section
  function insertclose(){
    $('.form-control').val('');
    tinymce.get('matadescription').setContent('');
    tinymce.get('shortdescription').setContent('');
    tinymce.get('longdescription').setContent('');
  }
  // সার্চ ইনপুটের জন্য নতুন ফাংশন বানাও
  function searchProduct(){
    currentPage = 1;  // পেজ 1 এ নিয়ে যাও
    nextPage = 1;
    $('#ProductShowTable').html(''); // টেবিল ক্লিয়ার
    indexProduct(currentPage);
  }

    let golobalcategory = [];

  //lage load
  let currentPage = 1;
  let loading = false;
  let nextPage = 1;
  $('#ProductShowTable').html('');
  indexProduct( currentPage );

  function indexProduct( page ){


    golobalcategory = [];

    let search_input = document.getElementById('search_input').value;
    let select = document.getElementById('select').value;
    let time = document.getElementById('time').value;

    if (loading) return;
      loading = true;

    let formData = new FormData();
    if( page > 0 ){
      formData.append('page', page );
    }else{
      formData.append('page',  '1' );
    }


    formData.append('search_input', search_input );
    formData.append('select', select );
    formData.append('time', time );
    $.ajax({
      url : "/admin/product/index",
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {

        golobalcategory = golobalcategory.concat(response.category_product);

        if(response.productscount > 0){
          appenddata( response.products, response , page);
        }else{
          showalert( 'product nut found' , '#ffffff', 'faildalert' );
        }
        nextPage= response.nextPage;
        loading = false;
      },
      error:function(xhr,status,error){
        const response = JSON.parse(xhr.responseText);
        console.log(xhr.responseText);
      }
    });
  }

  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
      if(nextPage) {
        indexProduct( nextPage );
      }
    }
  });
  //lage load
  //append


  function appenddata( products, response ,page_number ){
    if( page_number === 'reloed' ){
      $('#ProductShowTable').html('');
    }

    products.forEach(function(product,index) {

      $('#ProductShowTable').append(`
        <tr id="tablerow_${product.id}">
          <td>${product.id}</td>
          <td id="tabletd_name_${product.id}">${product.name}</td>
          <td id="tabletd_slug_${product.id}">${product.slug}</td>
          <td id="tabletd_price_${product.id}">${product.price}</td>
          <td id="tabletd_stock_${product.id}">${product.stock}</td>
          <td id="tabletd_discount_${product.id}">${product.discount}</td>
          <td id="tabletd_img_${product.id}"><img src='/storage/${product.image}' height='100px'width='100px'></td>
          <td style='width:80px;'>
            <button class="pbuttontext" onclick="productDetails('${product.id}');"><i class='bi bi-eye'></i></button>
            <button type="button" class="pbuttontext" data-bs-toggle="modal"
            onclick="updateDataSet(${JSON.stringify(product).replace(/"/g,
            '&quot;')} ,'${response}')" data-bs-target="#updateProductForm"><i class='bi
            bi-pencil-square'></i></button>
            <button type="button" class="pbuttontext" data-bs-toggle="modal" onclick='productImgIndex(${product.id});' data-bs-target="#productAddPhoto"><i class='bi bi-camera'></i></button>
            <button type="button" onclick="deleteDataSet('${product.id}','${product.image}')" class="pbuttontext" data-bs-toggle="modal" data-bs-target="#deleteProduct"><i class='bi bi-trash'></i></button>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" onclick="statusUpdate(${product.id});" role="switch" id="status${product.id}" ${product.status == 1 ? '   checked ' : '' } >
            </div>
          </td>
        </tr>
      `);
    });
  }

  // back function
  window.back = function( pagenumber ) {
  $("#product_detels_show").html(originalContent);
    indexProduct( pagenumber );
    brandFetch();
    categoryFetch();
  };
  //action code section
  window.statusUpdate  = function( productId ){
    let status = $('#status'+productId).prop('checked') ? 1 : 0;
    let formData = new FormData();
    formData.append('id', productId);
    formData.append('status', status);
    sendDataAjax('/admin/product/status/update',formData,'post','Nan','Nan','Nan','Nan','Nan');
  }

  //delete peoduct section
  window.deleteDataSet  = function(id , img){
    $('#deleteProductImage').attr('src', "/storage/" + img);
    $('#deleteProductId').val(id);
  }
  window.deleteProduct  = function(){
    let formData = new FormData();
    formData.append('id', $('#deleteProductId').val());
    sendDataAjax('/admin/product/delete',formData,'post','deleteSuccess','Nan','deletebutton','Delete','deleteProduct');
  }
  window.deleteSuccess  = function(){
    let currentPage = 1;
    let loading = false;
    let nextPage = 1;
    $('#ProductShowTable').html('');
    indexProduct( currentPage );
  }
  //categoryFetch function
  window.categoryshow  = function(){
    let all =document.querySelector("#divDiv");
    fetchDataAjax('/admin/category/index','post','categoryData','Nan');
  }
  window.categoryData = function( response ){
    let container = document.getElementById('categoryshow');
    const selectedSet = new Set(
      document.getElementById('checkboxvalue').value
      .split(',')
      .map(id => id.trim())
    );

    if(container.style.display==='block'){
      container.style.display='none';
    }else{
      container.style.display='block'
      container.innerHTML=`
        <div class='product-form-category-container top-50'>
           <div id='productCategory'>
           </div>
           <button onclick='closeAndok();'>Ok</button>
         </div>
       `;
    }
    $('#productCategory').html('');
    $.each(response.category, function(index, Category) {
      $('#productCategory').append(`
        <div class="product-form-category" onclick=' subcategory( ${Category.id} ); '>
          <p style="margin: 0;">${Category.name}</p>
          <p style="margin: 0;"><i class="bi bi-caret-down" id='subbuttonicon_${Category.id}'></i></p>
        </div>
        <div id='subcategoryshow_${Category.id}' style='display:none;'>
        </div>
      `);
      $.each(response.subcategory, function(index, subcategory) {
        if(subcategory.category_id == Category.id){
          let subcategoryshow = document.getElementById("subcategoryshow_"+Category.id);
          const isChecked = selectedSet.has(String(subcategory.id)) ? "checked" : "";
          if(isChecked == 'checked'){
            subcategoryshow.style.display = 'block';
          }
          $("#subcategoryshow_"+Category.id).append(`
            <label style='margin-left:15px;'>
              <input type='checkbox' id='${subcategory.name}' class='cart-checkbox'value='${subcategory.id}' ${isChecked} > ${subcategory.name}
            </label><br>
          `);
        }
      });
    });
  }
 // categoryFetch();

  //brandFetch function
  window.brandFetch = function(){
    let productBrand = $(this).closest('.modal-content').find('#productBrand').val();
    $.ajax({
      url:"/admin/Fetch_brand",
      type:"GET",
      dataType:"json",
      success: function(response) {
        $('#productBrand').html('');
        $.each(response, function(index, brand) {
          $('#productBrand').append(`
            <option id="brand_option" value='${brand.id}'>${brand.name}</option>
          `);
        });
      },
    });
  }
  brandFetch();
  // product img previews myltipull
  $(document).on("change", "#myltipulImg", function (event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = "";
    previewContainer.style.display='block';
    if (files.length > 0) {
      Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.createElement('img');
          img.src = e.target.result;

          previewContainer.appendChild(img);
          img.style.height='100px';
          img.style.width='100px';
          img.style.margin='5px';
        };
        reader.readAsDataURL(file);
      });
    }
  });
  //img preview section
  document.getElementById('productImg').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const previewImage = document.getElementById('previewImage');
        previewImage.src = e.target.result;
        previewImage.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });
  //mode close img
  function imgmodelclose(productId){
    const previewImage = document.querySelector(".preview-container"+productId);
    $('.product_img_fild' + productId).val('').trigger('change');
    previewImage.style.display = 'none';
  }

  function addfilter(){
      let addfilterdiv = document.getElementById('addfilterdiv');
      if(addfilterdiv.style.display === 'block'){
        addfilterdiv.style.display = 'none';
      }else{
        addfilterdiv.style.display = 'block';
        addfilterdiv.innerHTML = `
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">select one catagoty</span>
            <select id="productCategory"  aria-describedby="addon-wrapping"  class="form-select" aria-label="Default select example">
              <option selected>select one catagoty</option>
            </select>
          </div>
          <br>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">age</span>
            <input type="Number" id="age" class="form-control" placeholder="enter age" aria-label="Username"aria-describedby="addon-wrapping">
          </div>
          <br>
          <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping">couentry</span>
            <input type="text" id="couentry" class="form-control"  placeholder="Enter country" aria-label="Username"  aria-describedby="addon-wrapping">
          </div>
        `;
      }
    }

  function closeAndok(){
    let categoryshowbutton = document.getElementById('categoryshowbutton');
    const selectedIds = $('.cart-checkbox:checked')
    .map(function () {
      return this.value;
    })
    .get();
    const count = selectedIds.length;
    categoryshowbutton.innerHTML = ` ${count} Category selected  `;
    $('#checkboxvalue').val(selectedIds.join(','));
    categoryshow();
  }
  //getchackbooksvalue
  function subcategory( Category ){
    let subcategoryshow = document.getElementById('subcategoryshow_'+Category);
    let subbuttonicon = document.getElementById('subbuttonicon_'+Category);
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
