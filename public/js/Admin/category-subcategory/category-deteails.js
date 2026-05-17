window.originalContent = $("#mainContain").html();
function categoryDeteails(categoryId){
  let formData = new FormData();
  formData.append('id',categoryId);
  detailsDataAjax('/admin/category/deteails',formData,'post','categoryDeteailsData','Nan','Nan','Nan','Nan');
}
function categoryDeteailsData( response ){
  let mainContain = document.getElementById('mainContain');
  mainContain.innerHTML = `
    <button class='buttontext' onclick="Catagory()"><i class='bi bi-arrow-left'></i></button>
    <div><img src="/storage/${response.categories.banner}" height='200px' width='100%'></div>
    <div class='row'>
      <div class='col-md-6 col-lg-4'>
        <table>
          <tr><td>Name</td><td> : ${response.categories.name}</td></tr>
          <tr><td>Slug</td><td> : ${response.categories.slug}</td></tr>
          <tr><td>Meta title</td><td> : ${response.categories.meta_title}</td></tr>
          <tr><td>Meta keyword</td><td> : ${response.categories.meta_keywords}</td></tr>
          <tr><td>Order</td><td> : ${response.categories.order}</td></tr>
          <tr><td>Subcategory</td><td> : ${response.categories.order}</td></tr>
          <tr><td>Icon</td><td> : <img src="/storage/${response.categories.icon}" height='50' width='50'></td></tr>
          <tr><td>Image</td><td> : <img src="/storage/${response.categories.image}" height='50' width='50'></td></tr>
        </table>
      </div>
      <div class='col-md-6 col-lg-6'>
        <h6 class="text-center">Meta description</h6>
        ${response.categories.meta_description}
        <h6 class="text-center">Short description</h6>
        ${response.categories.short_description}
        <h6 class="text-center">Long description</h6>
        ${response.categories.description}
      </div>
    </div>
    <h5 class="text-center">Subcategory</h5>
    <div class="table-container">
      <table  class="table table-hover">
        <tbody class="table-group-divider" id="subcategoryShow">
        </tbody>
      <table>
    </div>
  `;
  
  $("#subcategoryShow").html('');
  if(response.categories.subcategory > 0){
    $("#subcategoryShow").append(`
      <tr>
        <th>id</th>
        <th>name</th>
        <th>slug</th>
        <th>order</th>
        <th>product</th>
        <th>click</th>
        <th>action</th>
      </tr>
    `);
    $.each(response.categories.subcategory,function( index ,subcategory){
      $("#subcategoryShow").append(`
        <tr>
          <td>${subcategory.id}</td>
          <td>${subcategory.name}</td>
          <td>${subcategory.slug}</td>
          <td>${subcategory.ordered}</td>
          <td>${subcategory.id}</td>
          <td>${subcategory.id}</td>
          <td><button type="button" class="buttontext" onclick="subcategoryDeteails(${subcategory.id})"><i class='bi bi-eye'></i></button></td>
        </tr>
      `);
    })
  }else{
    $("#subcategoryShow").append(`
      <tr>
        <th class="text-center">Subcategory not found</th>
      </tr>
    `);
  }
}
