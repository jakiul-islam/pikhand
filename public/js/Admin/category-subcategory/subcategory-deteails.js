window.originalContent = $("#mainContain").html();
function subcategoryDeteails(subcategoryId){
  let formData = new FormData();
  formData.append('id',subcategoryId);
  detailsDataAjax('/admin/subcategory/deteails',formData,'post','subcategoryDeteailsData','Nan','Nan','Nan','Nan');
}
function subcategoryDeteailsData( response ){
  let mainContain = document.getElementById('mainContain');
  mainContain.innerHTML = `
    <button class='buttontext' onclick="Catagory()"><i class='bi bi-arrow-left'></i></button>
    <div><img src="/storage/${response.product_subcategories.banner}" height='200px' width='100%'></div>
    <div class='row'>
      <div class='col-md-6 col-lg-4'>
        <table>
          <tr><td>Name</td><td> : ${response.product_subcategories.name}</td></tr>
          <tr><td>Slug</td><td> : ${response.product_subcategories.slug}</td></tr>
          <tr><td>Meta title</td><td> : ${response.product_subcategories.meta_title}</td></tr>
          <tr><td>Meta keyword</td><td> : ${response.product_subcategories.meta_keywords}</td></tr>
          <tr><td>Order</td><td> : ${response.product_subcategories.ordered}</td></tr>
          <tr><td>Subcategory</td><td> : ${response.product_subcategories.ordered}</td></tr>
          <tr><td>Icon</td><td> : <img src="/storage/${response.product_subcategories.icon}" height='50' width='50'></td></tr>
          <tr><td>Image</td><td> : <img src="/storage/${response.product_subcategories.image}" height='50' width='50'></td></tr>
        </table>
      </div>
      <div class='col-md-6 col-lg-6'>
        <h6 class="text-center">Meta description</h6>
        ${response.product_subcategories.meta_description}
        <h6 class="text-center">Short description</h6>
        ${response.product_subcategories.short_description}
        <h6 class="text-center">Long description</h6>
        ${response.product_subcategories.long_description}
      </div>
    </div>
  `;
}
