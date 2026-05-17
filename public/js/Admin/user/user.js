    let currentStep = 'userList';
    
    function index(page = 1){
      let search_input    = document.getElementById('search_input').value;
      let select          = document.getElementById('select').value;
      let time            = document.getElementById('time').value;
      let selectcountry   = document.getElementById('selectcountry').value;
    
      let formData = new FormData();
      formData.append('page', page);
      formData.append('search_input', search_input);
      formData.append('select', select);
      formData.append('time', time);
      formData.append('selectcountry', selectcountry);
      

      detailsDataAjax('/admin/user/index',formData,'post','userIndexData','Nan','Nan','Nan','Nan');
      
    }
    index();
    
    function userIndexData(response) {
      $('#showUser').html(''); // পুরানো ডাটা মুছে ফেলবে

      $.each(response.users.data, function(index, users) {
        let showUser = true;
               
        if(showUser){
          $('#showUser').append(`
            <tr>
              <td>${users.id}</td>
              <td>${users.phone_number}</td>
              <td>${users.name}</td>
              <td>${users.country}</td>
              <td>${ users.email ? users.email : 'N/A' }</td>
              <td>${users.Login_time ? users.Login_time : 'N/A'}</td>
              <td>${users.Logout_time ? users.Logout_time : 'N/A'}</td>
              <td>
                <div class="form-check form-switch">
                  <input id='switchbutton${users.id}' class="form-check-input" type="checkbox" onclick="actionButton(${users.id},${users.status == 1 ?  0  : 1 });" role="switch" id="switchCheckChecked${users.id}" ${users.status == 1 ? '   checked ' : '' } >
                  <button class='buttonText' onclick="mainnavber( '${users.id}' )"><i class='bi bi-eye'></i></button>
                </div>
              </td>
            </tr>
          `);
        }
      });
      
      
      
      $('#selectcountry').html(''); 
      $('#selectcountry').append(`
        <option  value="All">All country</option>
      `);
          
      const addedCountries = new Set();
      $.each(response.users.data, function(index, users) {
        const country = users.country;
        if (!addedCountries.has(country)) {
          addedCountries.add(country);
          $('#selectcountry').append(`
            <option  value="${users.country}">${users.country}</option>
          `);
        }
      });
      renderPagination(response.users);
      
    }
    
    function renderPagination(orders){
      $('#paginationLinks').html('');
    
      for(let i = 1; i <= orders.last_page; i++){
        $('#paginationLinks').append(`
          <button onclick="index(${i})" 
            class="${orders.current_page == i ? 'active' : ''}">
            ${i}
          </button>
        `);
      }
    }
    
  
    function actionButton(userid , buttonvalue){
      let formData = new FormData();
        formData.append('userid', userid);
        formData.append('buttonvalue', buttonvalue);
      sendDataAjax('/admin/useractiveUnactiv',formData,'post','index','Nan','Nan','Nan','Nan');
    }
    
    function mainnavber( userid ){
      currentStep = 'paymentList'; 
      window.backUserTableid = $("#maindiv").html();

      let maindiv = document.getElementById('maindiv');
      let webLogo = document.getElementById('webLogo').value;
      maindiv.innerHTML=`
        <div class='userNev' id='userNev'>
          <button onclick="userdeteils( '${userid}' )" id="userDetailsButton" class='btn btn-outline-success DetailsButton'>User info</button>
          <button onclick="orderInfo( '${userid}' )"  id="orderDetailsButton" class='btn btn-outline-success DetailsButton'>Order info</button>
          <button onclick="reviewInfo( '${userid}' )" id="reviewDetailsButton" class='btn btn-outline-success DetailsButton'>Review info</button>
          <button onclick="feedbackInfo( '${userid}' )" id="feedbackDetailsButton" class='btn btn-outline-success DetailsButton'>feedback info</button>
          <button onclick="paymentInfo( '${userid}' )" id="paymentDetailsButton" class='btn btn-outline-success DetailsButton'>Payment info</button>
          <button onclick="cartInfo( '${userid}' )" id="cartDetailsButton" class='btn btn-outline-success DetailsButton'>cart info</button>
        </div>
        <input type='hidden' id='webLogo' value='${webLogo}'>
        <button class='buttonText' onclick='backUserTable()'><i class='bi bi-arrow-left'></i></button>
        <img src='/storage/${webLogo}' style='margin:auto; display:flex; '>
        <div id='showAllcontain'>
        </div>
      `;
      userdeteils( userid );
    }

    function userdeteils( userid ){
      currentStep = 'List';

      nevberForColor();

      let userDetailsButton = document.getElementById("userDetailsButton");
      userDetailsButton.style.color='black';
      
      let formData = new FormData();
      formData.append('userid', userid);
      
      $.ajax({
        url: "/admin/userdeteils",  
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function(response) {
          if(response.status){
              let showAllcontain =document.getElementById('showAllcontain');
              
              showAllcontain.innerHTML=`
              <div class='row'>
                <div class='col-md-6' class='orderdeteilsUserInfo'
                style='line-height:1;'>
                  <h4 class='text-center'>User info</h4>
                  <table>
                    <tr><td> Name </td><td> : ${response.user.name}</td> </tr>
                    <tr><td> Phone </td><td> : ${response.user.phone_number}</td></tr>
                    <tr><td> Country </td><td> : ${response.user.country}</td></tr>
                    <tr><td> Email </td><td> : ${response.user.email ? response.user.email : 'N/A'}</td></tr>
                  </table>
                    <div  id='userAddress'>
                      <!--  -->
                    </div>
                  
                  
                </div>
                <div class='col-md-6' id='orderdeteilsUserInfo' class='orderdeteilsUserInfo' style='line-height:1;'>
                  <h4 class='text-center'>Order info</h4>
                  <table>
                    <tr id='totalOrder'> </tr>
                    <tr id='pandingOrder'></tr>
                    <tr id='processingOrder'> </tr>
                    <tr id='shippedOrder'></tr>
                    <tr id='completeOrder'> </tr>
                    <tr id='RefoundOrder'></tr>
                    <tr id='cancelledOrder'></tr>
                    <tr id='shipping_costOrder'></tr>
                    <tr id='totalOrderItem'></tr>
                  </table>
                </div>
              `;
            
           
           
           
             $('#userAddress').html('');
            $.each(response.user_address, function(index, userAddressRow) {
              $('#userAddress').append(`
                <div class="shipping-address">
                  <div ><img style="height:50px; width:50px; margin:4px; border-radius:30px;" src="/storage/logo/location.jpeg"></div>
                  <div class="" id="address_div" style=" margin-top:12px; margin-left:4px;">
                    <h5 style="line-height:0.3;">${userAddressRow.name} <span style="color:#FFABFD;"> ${userAddressRow.phone_number} </span></h5>
                    <p style="margin-bottom:-2px;"><span style="background-color:#FFABFD; padding:2px;
                    border-radius:10px;"> ${userAddressRow.home_office} </span>
                    ${userAddressRow.address}</p>
                  </div>
                </div>
              `);
            });
            
           
           
            let totalOrder          = document.getElementById('totalOrder');
            let pandingOrder        = document.getElementById('pandingOrder');
            let processingOrder     = document.getElementById('processingOrder');
            let shippedOrder        = document.getElementById('shippedOrder');
            let completeOrder       = document.getElementById('completeOrder');
            let RefoundOrder        = document.getElementById('RefoundOrder');
            let cancelledOrder      = document.getElementById('cancelledOrder');
            let shipping_costOrder  = document.getElementById('shipping_costOrder');
            let totalOrderItem      = document.getElementById('totalOrderItem');
            
            let totalOrdercount        = response.order_item.reduce((sum, product) => sum + (parseFloat(product.total_price ) || 0), 0).toFixed(1);
            pandingOrder.innerHTML     = '<td>Panding order    </td><td> : $' +response.pandingOrder.reduce((sum, product) => sum + (parseFloat(product.total_price ) || 0), 0).toFixed(1) +'</td>';
            processingOrder.innerHTML  = '<td>Processing order </td><td> : $' +response.processingOrder.reduce((sum, product) => sum + (parseFloat(product.total_price ) || 0), 0).toFixed(1) +'</td>';
            shippedOrder.innerHTML     = '<td>Shipped order </td><td> : $' +response.shippedOrder.reduce((sum, product) => sum + (parseFloat(product.total_price ) || 0), 0).toFixed(1) +'</td>';
            completeOrder.innerHTML    = '<td>Complete order </td><td> : $' +response.completeOrder.reduce((sum, product) => sum + (parseFloat(product.total_price ) || 0), 0).toFixed(1) +'</td>';
            RefoundOrder.innerHTML     = '<td>Refound order </td><td> : $' +response.RefoundOrder.reduce((sum, product) => sum + (parseFloat(product.total_price ) || 0), 0).toFixed(1) +'</td>';
            cancelledOrder.innerHTML   = '<td>cancelled order </td><td> : $' +response.cancelledOrder.reduce((sum, product) => sum + (parseFloat(product.total_price ) || 0), 0).toFixed(1) +'</td>';
            shipping_costOrder.innerHTML= '<td>shipping cost    </td><td> : $ ' +response.total_shipping.reduce((sum, product) => sum + (parseFloat(product.shipping_cost ) || 0), 0).toFixed(1) +'</td>';
            totalOrderItem.innerHTML   = `<td>total order item </td><td> : ${response.totalOrderItem}</td>`;
            

            totalOrder.innerHTML = `<td>total order </td><td>: $${totalOrdercount}</td>`;
            

          }
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
      
  //show order info 
  function orderInfo( userid ){
    currentStep = 'List';

    nevberForColor();

    let orderDetailsButton = document.getElementById("orderDetailsButton");
    orderDetailsButton.style.color='black';
    
    let formData = new FormData();
    formData.append('userid', userid);
    
    $.ajax({
      url: "/admin/userdeteils",  
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.status){
          let showAllcontain = document.getElementById('showAllcontain');
          showAllcontain.innerHTML=`
            <div style='overflow:auto;' id='tableDiv'>
              <table class="table table-hover">
                <thead class='table-dark'>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">order number</th>
                    <th scope="col">subtotal</th>
                    <th scope="col">shipping cost</th>
                    <th scope="col">total</th>
                    <th scope="col">status</th>
                    <th scope="col">created time</th>
                    <th scope="col">updated time</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider" id="showOrderItem">
                </tbody>
              </table>
            </div>
          `;
          
          
          
          $('#showOrderItem').html('');
          if(response.user_order_count > 0){
            let tableDiv = document.getElementById('tableDiv');
            tableDiv.style.dislpay = 'block';
            $.each(response.user_order, function(index, user_order_row) {
              $('#showOrderItem').append(`
                <tr>
                  <td>${user_order_row.id}</td>
                  <td>${user_order_row.order_number}</td>
                  <td>${user_order_row.subtotal}</td>
                  <td>${user_order_row.shipping_cost}</td>
                  <td>${user_order_row.total}</td>
                  <td>${user_order_row.status}</td>
                  <td>${user_order_row.created_at}</td>
                  <td>${user_order_row.updated_at}</td>
                  <td>
                    <button onclick="orderdeteils('${user_order_row.id}')">order
                    details</button>
                  </td>
                </tr>
              `);
              
            });
          }else{
            let orderdeteilsUserInfo = document.getElementById('orderdeteilsUserInfo');
            let tableDiv = document.getElementById('tableDiv');
            tableDiv.style.display = 'none';
            orderdeteilsUserInfo.innerHTML = `
            <h4 style='margin:auto; display:flex;' >No order found</h4>`;
          }
          
          
        }
        
        
        
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  
  //show order info 
  function reviewInfo( userid ){
    currentStep = 'List';

    nevberForColor();

    let reviewDetailsButton = document.getElementById("reviewDetailsButton");
    reviewDetailsButton.style.color='black';
    
    let formData = new FormData();
    formData.append('userid', userid);
    
    $.ajax({
      url: "/admin/userdeteils",  
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.status){
          
          let showAllcontain = document.getElementById('showAllcontain');
           $('#showAllcontain').html('');
            if(response.total_review_count > 0){
              let showAllcontain = document.getElementById('showAllcontain');
                  showAllcontain.style.display='block';
              $.each(response.total_review, function(index, total_review_row) {
                  
                  let starrat = '';
                  for (let j = 1; j <= total_review_row.rating; j++) {
                    starrat += "<i style='color:#e8f411ff;' class='bi bi-star-fill'></i>";
                  }
                  
                  
                  
                  $('#showAllcontain').append(`
                    <style>
                      .buttontext{
                        background:none;
                        border:none;
                        color:#ffffff;
                        text-decoration:none;
                      }
                    </style>
                    <div class="card mb-3" style='width:95%; margin:auto;'>
                      <div class="row g-0  margin-bottom:-10px;">
                        <div class="col-2">
                            <img src='/storage/${total_review_row.product.image}'
                                 style='height:100px; width:auto; margin-top:10px;'
                                 class='img-fluid rounded-start' 
                                 alt='...'>
                        </div>
                        <div class="col-10">
                          <div class="card-body" style='position:relative;'>
                            <p class="card-text product-name" style='margin-top:-14px;' data-product-id="">
                            ${total_review_row.product.name}</p>
                            <p style='line-height:0;
                            margin-top:-8px;'><span>${starrat}</span>${total_review_row.created_at
                            ? total_review_row.created_at : 'N/A'}</p>
                            <p style=' margin-top:-10px;
                            margin-bottom:-10px;'>
                              ${total_review_row.review.substring(0,70)}...
                              <button class='buttonText see-more-btn' 
                                data-full="${total_review_row.review}" 
                                data-short="${total_review_row.review.substring(0,70)}"
                              >see more</button>
                            </p>
                            <div id='img_review_${total_review_row.id}'
                            class='mt-3'></div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  `);
                  
                $('#img_review_'+total_review_row.id).html('');
                $.each(response.product_review_img, function(index,product_review_img_row) {
                  if(total_review_row.id == product_review_img_row.reviews_id){
                    $('#img_review_'+total_review_row.id).append(`
                      <img src='/storage/${product_review_img_row.img}' height='100'>
                    `);
                  }
                });
                  
                  
                  
              });
              
              
              

              
                $(document).on('click', '.see-more-btn', function() {
                  const fullMsg = $(this).data('full');
                  const shortMsg = $(this).data('short');
                  const parentP = $(this).parent();
                  if ($(this).text() === 'see more') {
                    parentP.html(`${fullMsg} <button class='buttonText see-more-btn' data-full="${fullMsg}" data-short="${shortMsg}">see less</button>`);
                  } else {
                    parentP.html(`${shortMsg} <button class='buttonText see-more-btn' data-full="${fullMsg}" data-short="${shortMsg}">see more</button>`);
                  }
                });
            }else{
              let showAllcontain = document.getElementById('showAllcontain');
              showAllcontain.style.display='none';
            }
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  
  //show order info 
  function feedbackInfo( userid ){
        currentStep = 'List';

          nevberForColor();

    let feedbackDetailsButton = document.getElementById("feedbackDetailsButton");
    feedbackDetailsButton.style.color='black';
    
    let formData = new FormData();
    formData.append('userid', userid);
    
    $.ajax({
      url: "/admin/userdeteils",  
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.status){
          if(response.user_feedback){
            let showAllcontain = document.getElementById('showAllcontain');
            $('#showAllcontain').html('');
              showAllcontain.style.display='block';
              $.each(response.user_feedback, function(index, user_feedback_row) {
                 
                 let starrat = '';
                  for (let j = 1; j <= user_feedback_row.ratingNumber; j++) {
                    starrat += "<i style='color:#e8f411ff;' class='bi bi-star-fill'></i>";
                  }
                 
                 
                  $('#showAllcontain').append(`
                    <style>
                      .buttontext{
                        background:none;
                        border:none;
                        color:#ffffff;
                        text-decoration:none;
                      }
                    </style>
                    <div class="card mb-3" style='width:95%; margin:auto;'>
                      <div class="row g-0  margin-bottom:-10px;">
                        <div class="col-2">
                            <img 
                               src='/storage/'
                                 style='height:auto; width:auto; margin-top:10px;'
                                 class='img-fluid rounded-start' 
                                 alt='...'>
                        </div>
                        <div class="col-10">
                          <div class="card-body" style='position:relative;'>
                            <p class="card-text product-name"
                            style='margin-top:-14px;'
                            data-product-id="">${user_feedback_row.name}</p>
                            <p
                            style='line-height:0;'>${user_feedback_row.email}</p>
                            <p
                            style='line-height:1;'>${starrat}</p>
                            <p style='line-height:1; margin-top:-5px;'>
                              
                            </p>
                            <p style=' margin-top:-10px; margin-bottom:-10px;'>
                              ${user_feedback_row.massage}
                              <button class='buttonText see-more-btn' 
                                data-full="feedback.massage" 
                                data-short="feedback.massage.substring0, 70..."
                              >see more</button>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  `);
              });
          }else{
            $('#showAllcontain').html('');
            $('#showAllcontain').append(`
              feedback not found 
            
            `);
          }
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  
  //show order info 
  function paymentInfo( userid ){
      nevberForColor();
      currentStep = 'List';
    let paymentDetailsButton = document.getElementById("paymentDetailsButton");
    paymentDetailsButton.style.color='black';
    
    let formData = new FormData();
    formData.append('userid', userid);
    
    $.ajax({
      url: "/admin/userdeteils",  
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.status){
          let showAllcontain = document.getElementById('showAllcontain');
          showAllcontain.innerHTML=`
            <div style='overflow:auto;' id='tableDiv'>
              <table class="table  table-hover">
                <thead class='table-dark'>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">amount</th>
                    <th scope="col">method</th>
                    <th scope="col">currency</th>
                    <th scope="col">order status</th>
                    <th scope="col">status</th>
                    <th scope="col">created time</th>
                    <th scope="col">updated time</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider" id="showOrderItem">
                </tbody>
              </table>
            </div>
          `;
          
          
          
          $('#user_feedback').html('');
         
            let tableDiv = document.getElementById('tableDiv');
            tableDiv.style.dislpay = 'block';
            $.each(response.user_payments, function(index, user_payments_row) {
              $('#showOrderItem').append(`
                <tr>
                  <td>${user_payments_row.id}</td>
                  <td>${user_payments_row.amount}</td>
                  <td>${user_payments_row.method}</td>
                  <td>${user_payments_row.currency}</td>
                  <td>${user_payments_row.order.status}</td>
                  <td>${user_payments_row.status}</td>
                  <td>${user_payments_row.created_at}</td>
                  <td>${user_payments_row.updated_at}</td>
                  <td><button
                  onclick="Paymentdeteils('${user_payments_row.id}')">deteils</button></td>
                </tr>
              `);
            });
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  
  function Paymentdeteils( Paymentid ){
    
    currentStep = 'Details'; 
    window.paymentListHTML = $("#showAllcontain").html();
    
    
      //window.originalContent1 = $("#showAllcontain").html();
     // window.originalContent2 = $("#maindiv").html();
      
      let maindiv = document.getElementById('showAllcontain');
      let webLogo = document.getElementById('webLogo').value;
      
      
      let formData = new FormData();
        formData.append('Paymentid', Paymentid);

      
      $.ajax({
        url: "/admin/Payment/details",  
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function(response) {
          if(response.status){
            maindiv.innerHTML=`

              <div class='row'>
                <div class='col-md-6 col-lg-6' class='orderdeteilsUserInfo'
                style='line-height:1;'>
                  <h4 class='text-center'>User info</h4>
                  
                  <table>
                    <tr>
                      <td>Name</td>
                      <td>: ${response.user.name}</td>
                    </tr>
                    <tr>
                      <td>Email </td>
                      <td>: ${response.user.email ? response.user.email : 'N/A'}</td>
                    </tr>
                    <tr>
                      <td>Phone</td>
                      <td>: ${response.user.Phonenumber ? response.user.Phonenumber : 'N/A'}</td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td>: ${response.user.country}</td>
                    </tr>
                  </table>
                
                    <div style='margin-bottom:3px; margin-right:10px;'>
                      <p style='margin-bottom:-3px;'>delivery address:</p>
                      <div class="shipping-address">
                        <div><img style="height:50px; width:50px; margin:4px; border-radius:30px;" src="/storage/logo/location.jpeg"></div>
                        <div class="" id="address_div" style=" margin-top:12px; margin-left:4px;">
                          <h5 style="line-height:0.3;"> ${response.useraddress.name}
                          <span style="color:#FFABFD;"> ${response.useraddress.phone_number} </span></h5>
                          <p style="margin-bottom:-2px;"><span style="background-color:#FFABFD; padding:2px; border-radius:10px;">
                          ${response.useraddress.home_office}
                          </span>${response.useraddress.address} </p>
                        </div>
                      </div>
                        
                        
                      <p style='margin-bottom:-3px;'>order address:</p>
                      <div class="shipping-address">
                        <div><img style="height:50px; width:50px; margin:4px; border-radius:30px;" src="/storage/logo/location.jpeg"></div>
                        <div class="" id="address_div" style=" margin-top:12px; margin-left:4px;">
                          <h5 style="line-height:0.3;"> ${response.useraddress.name}
                            <span style="color:#FFABFD;"> ${response.useraddress.phone_number} </span></h5>
                          <p style="margin-bottom:-2px;"><span style="background-color:#FFABFD; padding:2px; border-radius:10px;">
                          ${response.useraddress.home_office}
                          </span>${response.useraddress.address} </p>
                        </div>
                      </div>
                    </div>
                  
                  
                </div>
                <div class='col-md-6 col-md-6' class='orderdeteilsUserInfo' style='line-height:1;'>
                  <h4 class='text-center'>Payment info</h4>
                  
                  <table>
                    <tr>
                      <td>order number</td>
                      <td>: ${response.order.order_number}</td>
                    </tr>
                    <tr>
                      <td>subtotal </td>
                      <td>: $${response.order.subtotal}</td>
                    </tr>
                    <tr>
                      <td>shipping_cost</td>
                      <td>: $${response.order.shipping_cost}</td>
                    </tr>
                    <tr>
                      <td>total</td>
                      <td>: $${response.order.total}</td>
                    </tr>
                    <tr>
                      <td>status</td>
                      <td>: ${response.order.status}</td>
                    </tr>
                    <tr>
                      <td>Payment method </td>
                      <td>: ${response.Payment.method}</td>
                    </tr>
                    <tr>
                      <td>currency</td>
                      <td>: ${response.Payment.currency}</td>
                    </tr>
                    <tr>
                      <td>transaction_id</td>
                      <td>: ${response.Payment.transaction_id ? response.Payment.transaction_id : 'N/A'}</td>
                    </tr>
                    <tr>
                      <td>Payment payload</td>
                      <td>: ${response.Payment.payload ? response.Payment.payload : 'N/A'}</td>
                    </tr>
                    <tr>
                      <td>Payment status</td>
                      <td>: ${response.Payment.status}</td>
                    </tr>
                    
                  </table>
                  
                  
             </div>
                <h4 class='Text-center'>order item</h4>
                <div style='overflow:auto;' id='tableDiv'>
                  <table class="table table-hover">
                    <thead class='table-dark'>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">img</th>
                        <th scope="col">quantity</th>
                        <th scope="col">unit_price</th>
                        <th scope="col">total_price</th>
                        <th scope="col">discount</th>
                        <th scope="col">created</th>
                      </tr>
                    </thead>
                    <tbody class="table-group-divider" id="showOrderItem">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            `;
           
           
           
            $('#showOrderItem').html('');
            $.each(response.orderItem, function(index, orderItemRow) {
              $('#showOrderItem').append(`
                <tr>
                  <td>${orderItemRow.id}</td>
                  <td>${orderItemRow.name}</td>
                  <td><img src='/storage/${orderItemRow.image}/' height='100'></td>
                  <td>${orderItemRow.quantity}</td>
                  <td>${orderItemRow.unit_price}</td>
                  <td>${orderItemRow.total_price}</td>
                  <td>${orderItemRow.discount}</td>
                  <td>${orderItemRow.created_at}</td>
                </tr>
              `);
            });
            
           
           
            
          }
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
  //show order info 
  function cartInfo( userid ){
        currentStep = 'List';

    nevberForColor();
    let cartDetailsButton = document.getElementById("cartDetailsButton");
    cartDetailsButton.style.color='black';
    
    let formData = new FormData();
    formData.append('userid', userid);
    
    $.ajax({
      url: "/admin/userdeteils",  
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.status){
          
          
          let showAllcontain = document.getElementById('showAllcontain');
          showAllcontain.innerHTML=`
            <div style='overflow:auto;' id='UserCarttableDiv'>
              <p class='text-center' >user carts </p>
              <table class="table  table-hover">
                <thead class='table-dark'>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">status</th>
                    <th scope="col">created time</th>
                    <th scope="col">updated time</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider" id="userCarts">
                </tbody>
              </table>
            </div>
          `;
          
            $('#userCarts').html('');
            if(response.total_carts_count > 0){
              let UserCarttableDiv = document.getElementById('UserCarttableDiv');
              $.each(response.total_carts, function(index, total_carts_row) {
                
               /// alert(total_carts_row.product.name);
                
                if(total_carts_row.status == 'Active' ||  total_carts_row.status == 'Ordered'){
                  UserCarttableDiv.style.display='block';
                  $('#userCarts').append(`
                    <tr>
                      <td>${total_carts_row.id}</td>
                      <td>${total_carts_row.product.name}</td>
                      <td>${total_carts_row.product.price}</td>
                      <td>${total_carts_row.quantity}</td>
                      <td>${total_carts_row.status}</td>
                      <td>${total_carts_row.updated_at}</td>
                      <td>${total_carts_row.created_at}</td>
                    </tr>
                  `);
                }
              });
            }else{
              let UserCarttableDiv = document.getElementById('UserCarttableDiv');
              UserCarttableDiv.style.display='none';
            }
          
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  
  function orderdeteils( orderid ){
      
    currentStep = 'Details'; 
    window.paymentListHTML = $("#showAllcontain").html();
      
      let webLogo = document.getElementById('webLogo').value;
      

      let formData = new FormData();
        formData.append('orderId', orderid);

      
      $.ajax({
        url: "/admin/order/deteils",  
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function(response) {
          if(response.status){
            let showAllcontain = document.getElementById('showAllcontain');
            showAllcontain.innerHTML=`

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
                        <span style="color:#FFABFD;"> ${response.order.delivery_address.phone_number}
                        </span></h5>
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
                      <td>status </td>
                      <td>: ${response.order.status}</td>
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
                </div>
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
              `);
            });
          }else{
            alert('server error ')
          }
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
    
  function nevberForColor(){
    let userDetailsButton = document.getElementById("userDetailsButton");
    let orderDetailsButton = document.getElementById("orderDetailsButton");
    let reviewDetailsButton = document.getElementById("reviewDetailsButton");
    let feedbackDetailsButton = document.getElementById("feedbackDetailsButton");
    let paymentDetailsButton = document.getElementById("paymentDetailsButton");
    let cartDetailsButton = document.getElementById("cartDetailsButton");
    
    userDetailsButton.style.color='green';
    orderDetailsButton.style.color='green';
    reviewDetailsButton.style.color='green';
    feedbackDetailsButton.style.color='green';
    paymentDetailsButton.style.color='green';
    cartDetailsButton.style.color='green';
  }
    

  window.backUserTable = function() {
    if (currentStep === 'Details') {
      $("#showAllcontain").html(window.paymentListHTML);
      currentStep = 'List';
    }

  else if (currentStep === 'List') {
    $("#maindiv").html(window.backUserTableid);
    currentStep = 'userList';
  }
  };
  