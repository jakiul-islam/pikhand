  function processingOrder(){
    window.originalContent = $("#Adminpagediv").html();
    fetchDataAjax('/admin/process_order','post','processingOrderData','Nan');
  }
  function processingOrderData(response){

    let Adminpagediv = document.getElementById('Adminpagediv');
    let allchart = document.getElementById('allchart');

    allchart.style.display     = 'none';
    Adminpagediv.style.display = 'block';
        
    Adminpagediv.innerHTML=`
      <h3 class='text-center'>processing order</h3>
      <div style='overflow:auto;'>
        <table class="table table-hover">
        <thead class='table-dark '>
          <tr>
            <th scope="col">id</th>
            <th scope="col">user_name</th>
            <th scope="col">order_number</th>
            <th scope="col">subtotal</th>
            <th scope="col">discount</th>
            <th scope="col">shipping_cost</th>
            <th scope="col">total</th>
            <th scope="col">status</th>
            <th scope="col">payments_method</th>
            <th scope="col">payments_status</th>
            <th scope="col">time</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider" id="ShowOrder">
        </tbody>
      </div>
    `;
        
        
    $('#ShowOrder').html('');// পুরানো ডাটা মুছে ফেলবে
    $.each(response.order, function(index, orderRow) {
      $('#ShowOrder').append(`
        <tr>
          <td>${orderRow.id}</td>
          <td>${orderRow.user.name}</td>
          <td>${orderRow.order_number}</td>
          <td>${orderRow.subtotal}</td>
          <td>${orderRow.discount}</td>
          <td>${orderRow.shipping_cost}</td>
          <td>${orderRow.total}</td>
          <td>
            <select style='width:100px;' id="selectStatus${orderRow.id}" onchange="statusUpdate('${orderRow.id}');" class="shadow-none fillter-input" aria-label="Default select example">
              <option value="pending"${orderRow.status=='pending' ?  'selected' : '' }>pending</option>
              <option  value="processing" ${orderRow.status=='processing' ?  'selected' : '' }>processing</option>
              <option  value="shipped" ${orderRow.status=='shipped' ?  'selected' : '' }>shipped</option>
              <option  value="completed" ${orderRow.status=='completed' ?  'selected' : '' }>completed</option>
              <option  value="cancelled" ${orderRow.status=='cancelled' ?  'selected' : '' }>cancelled</option>
              <option  value="refunded" ${orderRow.status=='refunded' ?  'selected' : '' }>refunded</option>
            </select>
          </td>
          <td>${orderRow.payments?.[0]?.method || 'N/A'}</td>
          <td>${orderRow.payments?.[0]?.status || 'N/A'}</td>
          <td>${orderRow.created_at}</td>
          <td><button onclick="orderdetails('${orderRow.id}')">Show order</button></td>
        </tr>
      `);
    });
  }
  
  //order status update
  function statusUpdate( orderid ){
    let buttonvalue = document.getElementById('selectStatus'+orderid).value;

    let formData = new FormData();
      formData.append('orderId', orderid);
      formData.append('orderStatus', buttonvalue);
      sendDataAjax('/admin/order/status/update',formData,'post','Nan','Nan','Nan','Nan','Nan');
  }
  //order deteils
  function orderdetails( orderid ){
    window.originalContent1 = $("#Adminpagediv").html();
    
    let formData = new FormData();
    formData.append('orderId', orderid);
    detailsDataAjax( '/admin/order/deteils',formData, 'post' ,'orderDeteilsData' , 'Nan',  'Nan' , 'Nan' , 'Nan')
  }
  function orderDeteilsData( response ){
    
    let webLogo = document.getElementById('webLogo').value;
    let Adminpagediv = document.getElementById('Adminpagediv');
    if(response.status){
          Adminpagediv.innerHTML=`
            <button class='buttonText' onclick='back()'><i class='bi bi-arrow-left'></i></button>
            <img src='/storage/${webLogo}' style='margin:auto;
            display:flex; '>
            <div class='row'>
              <div class='col-md-6 col-lg-6' class='orderdeteilsUserInfo' style='line-height:1;'>
                <h4 class='text-center'>User info</h4>
                <table>
                  <tr>
                    <td>Name </td>
                    <td>: ${response.order.user.name}</td>
                  </tr>
                  <tr>
                    <td>Email </td>
                    <td>: ${response.order.user.email ? response.order.user.email : 'N/A'}</td>
                  </tr>
                  <tr>
                    <td>Phone </td>
                    <td>: ${response.order.user.phone_number}</td>
                  </tr>
                  <tr>
                    <td>country </td>
                    <td>: ${response.order.user.country}</td>
                  </tr>
                </table>
                
                
                <div style='margin-bottom:3px; margin-right:10px;'>
                  <p style='margin-bottom:-3px;'>delivery address:</p>
                  <div class="shipping-address">
                    <div><img style="height:50px; width:50px; margin:4px; border-radius:30px;" src="/storage/logo/location.jpeg"></div>
                    <div class="" id="address_div" style=" margin-top:12px; margin-left:4px;">
                      <h5 style="line-height:0.3;"> ${response.order.delivery_address.name}
                      <span style="color:#FFABFD;">
                      ${response.order.delivery_address.phone_number} </span></h5>
                      <p style="margin-bottom:-2px;"><span style="background-color:#FFABFD; padding:2px; border-radius:10px;">
                      ${response.order.delivery_address.home_office}
                      </span>${response.order.delivery_address.address}</p>
                    </div>
                  </div>
                    
                    
                  <p style='margin-bottom:-3px;'>order address:</p>
                  <div class="shipping-address">
                    <div><img style="height:50px; width:50px; margin:4px; border-radius:30px;" src="/storage/logo/location.jpeg"></div>
                    <div class="" id="address_div" style=" margin-top:12px; margin-left:4px;">
                      <h5 style="line-height:0.3;">${response.order.order_address.name}
                      <span style="color:#FFABFD;"> ${response.order.order_address.phone_number} </span></h5>
                      <p style="margin-bottom:-2px;"><span style="background-color:#FFABFD; padding:2px; border-radius:10px;">
                        ${response.order.order_address.home_office} </span>${response.order.order_address.address}
                      </p>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='col-md-6 col-lg-6' class='orderdeteilsUserInfo'
              style='line-height:1;'>
                <h4 class='text-center'>Order info</h4>
                
                
                <table>
                  <tr>
                    <td>Order id </td>
                    <td>: ${response.order.id}</td>
                  </tr>
                  <tr>
                    <td>Order number  </td>
                    <td>: ${response.order.order_number}</td>
                  </tr>
                  <tr>
                    <td>subtotal </td>
                    <td>: ${response.order.subtotal}</td>
                  </tr>
                  <tr>
                    <td>shipping_cost </td>
                    <td>: ${response.order.shipping_cost}</td>
                  </tr>
                  <tr>
                    <td>total </td>
                    <td>: ${response.order.total}</td>
                  </tr>
                  <tr>
                    <td>status</td>
                    <td>: ${response.order.status}</td>
                  </tr>
                  <tr>
                    <td>created_at</td>
                    <td>: ${response.order.created_at}</td>
                  </tr>
                  <tr>
                    <td>updated_at</td>
                    <td>: ${response.order.updated_at}</td>
                  </tr>
                  <tr>
                    <td>payments_method</td>
                    <td>: ${response.order.payments.length > 0 ? response.order.payments[0].method : 'No Payment' }</td>
                  </tr>
                  <tr>
                    <td>payments_status </td>
                    <td>: ${response.order.payments.length > 0 ? response.order.payments[0].status : 'No Payment' }</td>
                  </tr>
                  <tr>
                    <td>payments_currency </td>
                    <td>: ${response.order.payments.length > 0 ? response.order.payments[0].currency : 'No Payment' }</td>
                  </tr>
                  <tr>
                    <td>payments_transaction_id </td>
                    <td>: ${response.order.payments.length > 0 ? response.order.payments[0].transaction_id : 'No Payment' }</td>
                  </tr>
                  <tr>
                    <td>payments_payload </td>
                    <td>: ${response.order.payments.length > 0 ? response.order.payments[0].payload : 'No Payment' }</td>
                  </tr>
                </table>
              </div>
              
           
                
              <h3 class='text-center'>Order item</h3>
              <div style='overflow:auto;'>
                <table class="table table-hover">
                  <thead class='table-dark '>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">product name</th>
                      <th scope="col">img</th>
                      <th scope="col">unit price</th>
                      <th scope="col">discount</th>
                      <th scope="col">Quentity</th>
                      <th scope="col">total</th>
                      <th scope="col">created time</th>
                      <th scope="col">updated time</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider" id="howOrderItem">
                    
                  </tbody>
                </table>
              </div>
              
              
            </div>
            
            
            <div class='download-div'>
              <button class='btn btn-success'>
                Download <i class='bi bi-download'></i>
              </button>
            </div>
            
          `;
          $('#howOrderItem').html(''); 
          $.each(response.order_item, function(index, order_item_row) {
              
            $('#howOrderItem').append(`
              <tr>
                <td>${order_item_row.id}</td>
                <td>${order_item_row.product.name}</td>
                <td><img src='/storage/${order_item_row.product.image}' height='100' width='auto'></td>
                <td>${order_item_row.unit_price}</td>
                <td>${order_item_row.discount}</td>
                <td>${order_item_row.quantity}</td>
                <td>${order_item_row.total_price}</td>
                <td>${order_item_row.created_at}</td>
                <td>${order_item_row.updated_at}</td>
              </tr>
            `);
          });
        }
  }
  //new order 
  function NewOrder(){
    window.originalContent = $("#Adminpagediv").html();
    fetchDataAjax('/admin/NewOrder','post','NewOrderData','Nan');
  }
  
  function NewOrderData( response ){
    let Adminpagediv = document.getElementById('Adminpagediv');
    let allchart = document.getElementById('allchart');

    allchart.style.display     = 'none';
    Adminpagediv.style.display = 'block';
        
    Adminpagediv.innerHTML=`
      <h3 class='text-center'>New order</h3>
      <div style='overflow:auto;'>
        <table class="table table-hover">
        <thead class='table-dark '>
          <tr>
            <th scope="col">id</th>
            <th scope="col">user_name</th>
            <th scope="col">user_number</th>
            <th scope="col">order_number</th>
            <th scope="col">subtotal</th>
            <th scope="col">discount</th>
            <th scope="col">shipping_cost</th>
            <th scope="col">total</th>
            <th scope="col">status</th>
            <th scope="col">payments_method</th>
            <th scope="col">payments_status</th>
            <th scope="col">time</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider" id="ShowOrder">
        </tbody>
      </div>
    `;
        
        
    $('#ShowOrder').html('');// পুরানো ডাটা মুছে ফেলবে
    $.each(response.order, function(index, orderRow) {
      $('#ShowOrder').append(`
        <tr>
          <td>${orderRow.id}</td>
          <td>${orderRow.user.name}</td>
          <td>${orderRow.user.phone_number}</td>
          <td>${orderRow.order_number}</td>
          <td>${orderRow.subtotal}</td>
          <td>${orderRow.discount}</td>
          <td>${orderRow.shipping_cost}</td>
          <td>${orderRow.total}</td>
          <td>
            <select style='width:100px;' id="selectStatus${orderRow.id}" onchange="statusUpdate('${orderRow.id}');" class="shadow-none fillter-input" aria-label="Default select example">
              <option value="pending"${orderRow.status=='pending' ?  'selected' : '' }>pending</option>
              <option  value="processing" ${orderRow.status=='processing' ?  'selected' : '' }>processing</option>
              <option  value="shipped" ${orderRow.status=='shipped' ?  'selected' : '' }>shipped</option>
              <option  value="completed" ${orderRow.status=='completed' ?  'selected' : '' }>completed</option>
              <option  value="cancelled" ${orderRow.status=='cancelled' ?  'selected' : '' }>cancelled</option>
              <option  value="refunded" ${orderRow.status=='refunded' ?  'selected' : '' }>refunded</option>
            </select>
          </td>
          <td>${orderRow.payments?.[0]?.method || 'N/A'}</td>
          <td>${orderRow.payments?.[0]?.status || 'N/A'}</td>
          <td>${orderRow.created_at}</td>
          <td><button onclick="orderdetails('${orderRow.id}')">Show order</button></td>
        </tr>
      `);
    });
  }
  
   window.back = function() {
      $("#Adminpagediv").html(originalContent);
      processingOrder();
   };
