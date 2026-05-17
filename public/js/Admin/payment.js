  function index(page = 1){

    let search_input    = document.getElementById('search_input').value;
    let select          = document.getElementById('select').value;
    let time            = document.getElementById('time').value;
    let selectMethod   = document.getElementById('selectMethod').value;


      let formData = new FormData();
      formData.append('page', page);
      formData.append('search_input', search_input);
      formData.append('select', select);
      formData.append('selectMethod', selectMethod);
      formData.append('time', time);

        detailsDataAjax('/admin/payment/index',formData,'post','paymentIndexData','Nan','Nan','Nan','Nan');



  }
  function paymentIndexData(response){

    $('#showUser').html(''); // পুরানো ডাটা মুছে ফেলবে
    $.each(response.payments.data, function(index, payment) {

      let showUser = true;
      if(showUser){
        $('#showUser').append(`
          <tr>
            <td>${payment.id}</td>
            <td>${payment.user.name}</td>
            <td>${payment.user.phone_number}</td>
            <td>${payment.order.order_number}</td>
            <td>${payment.amount}</td>
            <td>${payment.currency}</td>
            <td>${payment.method}</td>
            <td>${payment.status}</td>
            <td>${payment.created_at}</td>
            <td>${payment.updated_at}</td>
            <td><button onclick="details( '${payment.id}' )"><i class='bi bi-eye'></i></button></td>
          </tr>
        `);
      }
    });


    renderPagination(response.payments);

  }
  index();

  function renderPagination(response){
      $('#paginationLinks').html('');

      for(let i = 1; i <= response.last_page; i++){
        $('#paginationLinks').append(`
          <button onclick="index(${i})"
            class="${response.current_page == i ? 'active' : ''}">
            ${i}
          </button>
        `);
      }
    }

  function details(Paymentid){
    let formData = new FormData();
      formData.append('Paymentid', Paymentid);
      detailsDataAjax('/admin/Payment/details',formData,'post','paymentDeteilsData','Nan','Nan','Nan','Nan');

  }


  function paymentDeteilsData( response ){
    window.originalContent1 = $("#maindiv").html();

    let maindiv = document.getElementById('maindiv');
    let webLogo = document.getElementById('webLogo').value;

    if(response.status){
      maindiv.innerHTML=`
        <button class='buttonText' onclick='ordertable()'><i class='bi bi-arrow-left'></i></button>
        <img src='/storage/${webLogo}' style='margin:auto;
        display:flex; '>
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
                <td>: ${response.user.phone_number ? response.user.phone_number : 'N/A'}</td>
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


        document.getElementById('pdfdownloadButton').innerHTML=`<button class='btn btn-primary button' onclick="downloadPDF('maindiv','${response.Payment.id}','${response.order.user.email}','payment')">Download PDF</button>`;




      $('#showOrderItem').html('');
      $.each(response.orderItem, function(index, orderItemRow) {
        $('#showOrderItem').append(`
          <tr>
            <td>${orderItemRow.id}</td>
            <td>${orderItemRow.product.name}</td>
            <td><img src='/storage/${orderItemRow.product.image}/' height='100'></td>
            <td>${orderItemRow.quantity}</td>
            <td>${orderItemRow.unit_price}</td>
            <td>${orderItemRow.total_price}</td>
            <td>${orderItemRow.discount}</td>
            <td>${orderItemRow.created_at}</td>
          </tr>
        `);
      });




    }
  }
  //show order item
  function showorderitem( order_id){

    let orderItamShow = document.getElementById('orderItamShow'+order_id);
    if(orderItamShow.style.display=='none'){
      orderItamShow.style.display='table-row';
    }else{
      orderItamShow.style.display='none';
    }

      let formData = new FormData();
      formData.append('order_id', order_id);

      $.ajax({
        url: "/admin/PaymentOrderItem",
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function(response) {
          $('#orderItamTable'+order_id).html('');
          $.each( response.order_item, function(index, orderItem){
            $('#orderItamTable'+orderItem.order_id ).append(`
              <tr>
                <td>${orderItem.order_item_id}</td>
                <td>${orderItem.products_name}</td>
                <td>${orderItem.unit_price}</td>
                <td>${orderItem.discount}</td>
                <td>${orderItem.quantity}</td>
                <td>${orderItem.total_price}</td>
                <td>${orderItem.method}</td>
                <td>${orderItem.created_at}</td>
                <td>${orderItem.updated_at}</td>
              </tr>
            `);
          });
        },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }

  window.ordertable = function() {
    $("#maindiv").html(originalContent1);
  };
