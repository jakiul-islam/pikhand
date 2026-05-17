 <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      *{
        box-sizing: border-box;
      }
      .main-contain{
        padding: 10px;
        box-sizing: border-box;
      }
      @media (min-width:992px){
        .main-contain{
          margin-left: 400px;
        }
      }
      .edit-button{
        position:absolute;
        right: 20px;
      }
      .name-1{
        display: inline-block;
      }
      .name-2{
        padding: 10px;
        border:1px solid black;
        margin: 10px;
      }
      .img{
        cursor: pointer;
      }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body>
   @include("Admin.Include.header")
  <div class="main-contain">
    <div id='filter_div' class="row">
      <div class="col-6 col-sm-4 col-md-4 col-lg-4 ">
        <div class="input-group flex-nowrap" style='border:solid black 1px ; border-radius:40px;'>
          <input type='search' required oninput="neworder();" id="searchinput" style='background:none; border:none;'
                  class="form-control shadow-none"  placeholder="prodect-name"
                  aria-label="Username"  aria-describedby="addon-wrapping">
          <span class="input-group-text" style='background:none;border:none;' id="addon-wrapping">
            <i class="bi bi-search"></i>
          </span>
        </div>
      </div>
      <div class=" col-6 col-sm-4 col-md-4 col-lg-4">
        <div class="input-group flex-nowrap" style='border:solid black 1px ; border-radius:40px;'>
         
          <input type="text" required id=""  style="background:none; border:none;"
       class="form-control shadow-none" 
       placeholder="DD.MM.YYYY" 
       onfocus="(this.type='date')" 
       onblur="if(this.value==''){this.type='text'}" />
          
        </div>
      </div>
    </div>
    <br>
    <div id='showAlltable' style='overflow: auto; width:100%;'>
      <table class="table table-dark table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">user id</th>
            <th scope="col">order number</th>
            <th scope="col">subtotal</th>
            <th scope="col">shipping_cost</th>
            <th scope="col">total_price</th>
            <th scope="col">address</th>
            <th scope="col">status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="ProductShowTable" class="table-group-divider">
        </tbody>
      </table>
    </div>
  </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      
  <script>
    $(document).ready(function() {
      let pathParts = window.location.pathname.split('/').filter(Boolean);
      if (pathParts.length === 3 && pathParts[0] === 'admin') {
        let subcategoryid = decodeURIComponent(pathParts[2]);
        window[subcategoryid]();
      }
    }); 
  </script>
    <script>
      function neworder(){
        
       let filter_div = document.getElementById('filter_div');
     
       
        window.history.pushState({}, '', `/admin/order/neworder`);
        
        const searchinput = document.getElementById('searchinput').value;
        
        
        
        let formData = new FormData();
        formData.append('searchinput',$('#searchinput').val() );
  
        $.ajax({
          url : '/admin/adminFetchorder',
          type :'POST',
          processData: false,
          contentType: false,
          data: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          success:function(response){
            response.fetch_order_table.forEach(function(product,index) {
              $('#ProductShowTable').append(`
                <tr>
                  <td>${product.id}</td>
                  <td>${product.user_id}</td>
                  <td>${product.order_number}</td>
                  <td>${product.subtotal}</td>
                  <td>${product.shipping_cost}</td>
                  <td>${product.total}</td>
                  <td>${product.shipping_address}</td>
                  <td> ${product.status}</td>
                  <td>7</td>
                </tr>
              `);
              
              response.product.forEach(function(products,index){
                document.querySelectorAll(`img[data-product-id="product_img${products.id}"]`).forEach(function(img) {
                  img.src = `/storage/${products.image}`;
                });
                
                document.querySelectorAll(`.product-name[data-product-id="${products.id}"]`).forEach(function(nameElement) {
                  nameElement.innerHTML = `${products.name}`;
                });
              }); 
              
              
            });
          },
          error:function(xhr,status,error){
            let response = JSON.parse(xhr.responseText);
            alert(xhr.responseText);
            console.log(xhr.responseText);
          },
        });
      }
      
      
    function ordermenu( id ){
    let ids = document.getElementById('showOrdermenu_'+id );
    
   
    if( ids.style.display === 'none' ){
      ids.style.display = 'block';
    }else{
      ids.style.display = 'none';
    }
    
  }
    </script>
  </body>
</html>