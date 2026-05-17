    function cartIndex(page = 1){
      let search_input    = document.getElementById('search_input').value;
      let time            = document.getElementById('time').value;
    
      
      let formData = new FormData();
      formData.append('page', page);
      formData.append('search_input', search_input);
      formData.append('time', time);
      
      detailsDataAjax('/admin/cart/index',formData,'post','cartIndexData','Nan','Nan','Nan','Nan');
  
    }
    cartIndex();
    
    
    function cartIndexData(response){
      
      $('#showUser').html('');
      $.each(response.carts.data, function(index, cartsRow) {
        let showUser = true;
        
        if(showUser){
          $('#showUser').append(`
            <tr>
              <td>${cartsRow.id}</td>
              <td>${cartsRow.user.name}</td>
              <td>${cartsRow.user.phone_number}</td>
              <td>${cartsRow.product.name}</td>
              <td><img src='/storage/${cartsRow.product.image}'
              height='100'></td>
              <td>${cartsRow.product.price}</td>
              <td>${cartsRow.quantity}</td>
              <td>${cartsRow.status}</td>
              <td>${cartsRow.created_at}</td>
              <td>
                <button onclick="cartDetails('${cartsRow.id}')"> <i class='bi bi-eye'></i></button>
              </td>
            </tr>
          `);
        }
      });
      
      renderPagination(response.carts);
    }
    
    
    function renderPagination(carts){
      $('#paginationLinks').html('');
    
      for(let i = 1; i <= carts.last_page; i++){
        $('#paginationLinks').append(`
          <button onclick="cartIndex(${i})" 
            class="${carts.current_page == i ? 'active' : ''}">
            ${i}
          </button>
        `);
      }
    }
    
    function cartDetails( cartid ){
      
      let formData = new FormData();
        formData.append('cartid', cartid);
      detailsDataAjax('/admin/cart/details',formData,'post','cartDetailsData','Nan','Nan','Nan','Nan');
    }
    
    function  cartDetailsData(response) {
      window.originalContent1 = $("#maindiv").html();
      let maindiv = document.getElementById('maindiv');
      let webLogo = document.getElementById('webLogo').value;
      
      if(response.ststus){
        maindiv.innerHTML=`
          <button class='buttonText' onclick='ordertable()'><i class='bi bi-arrow-left'></i></button>
          <img src='/storage/${webLogo}' style='margin:auto;
          display:flex; '>
          <div class='row'>
            <div class='col-md-6 col-lg-6' class='orderdeteilsUserInfo' style='line-height:1;'>
              <h4 class='text-center'>User info</h4>
              <table>
                <tr>
                  <td>Name </td>
                  <td>: ${response.carts.user.name}</td>
                </tr>
                <tr>
                  <td>Email </td>
                  <td>: ${response.carts.user.email ? response.carts.user.email : 'N/A'}</td>
                </tr>
                <tr>
                  <td>Phone </td>
                  <td>: ${response.carts.user.phone_number}</td>
                </tr>
                <tr>
                  <td>country </td>
                  <td>: ${response.carts.user.country}</td>
                </tr>
              </table>
              
                  

            <div class='col-md-6 col-lg-6' class='orderdeteilsUserInfo' style='line-height:1;'>
              <h4 class='text-center'>cart info</h4>
              <table>
                <tr>
                  <td>product id </td>
                  <td>: ${response.carts.product.id}</td>
                </tr>
                <tr>
                  <td>product name</td>
                  <td>: ${response.carts.product.name}</td>
                </tr>
                <tr>
                  <td>product img</td>
                  <td>: <img src='/storage/${response.carts.product.image}'  height='100'></td>
                </tr>
                <tr>
                  <td>product price</td>
                  <td>: ${response.carts.product.price}</td>
                </tr>
                <tr>
                  <td>quantity </td>
                  <td>: ${response.carts.quantity}</td>
                </tr>
                <tr>
                  <td>status </td>
                  <td>: ${response.carts.status}</td>
                </tr>
                 <tr>
                  <td>created_at</td>
                  <td>: ${response.carts.created_at}</td>
                </tr>
                 <tr>
                  <td>updated_at </td>
                  <td>: ${response.carts.updated_at}</td>
                </tr>
              </table>
            </div>
        `;
      }
    }
    
    
    
    
  window.ordertable = function() {
    $("#maindiv").html(originalContent1);
  };