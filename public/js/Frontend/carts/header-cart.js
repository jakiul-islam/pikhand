  window.subcategory = function( Category , Categoryslug ){
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
  // Fetct to carts section
  window.FetchCarts = function(){
    const countcarts =document.getElementById('countcarts');
    $.ajax({
      url : '/cart/index',
      type :'POST',
      processData: false,
      contentType: false,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){

        if(response.countProduct){
          countcarts.innerText= response.sessioncountProduct + + + response.countProduct;
        }

        $('#cartsProdectshow').html('');
        if(response.countProduct > 0){
          response.all_carts.forEach(function(carts) {

            let cartPrice  =`${carts.product_price }`;
            let cartid     =`${carts.id}`;
            let quantity   =`${carts.quantity}`;
             //কষকদকদ



            //cart product show
            let formData = new FormData();
            formData.append('productId',carts.product_id);
            $.ajax({
              url : '/carts/product/index',
              type :'POST',
              processData: false,
              contentType: false,
              data: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              success:function(response){
                response.show_cart_product.forEach(function(cartsproducts) {
                  $('#cartsProdectshow').append(`
                    <li class="nav-item">
                      <div class="card mb-3" style='width:100%;'>
                        <div class="row g-0">
                          <div class="col-4">
                            <img src="/storage/${cartsproducts.image}"
                            style='height:80px; width:100px; margin:5px;' class="img-fluid rounded-start"
                            alt="...">
                          </div>
                          <div class="col-8">
                            <div class="card-body">
                              <p class="card-text" style="margin-bottom:-0px;
                              margin-top:-10px;
                              line-height:1;">${cartsproducts.name}</p>
                              <input type='checkbox' onclick='chackout(${cartid});' class='cart-checkbox'
                              ${ carts.status == 'Ordered' ? 'checked' :'' }
                              id='product-${cartid}' value='${cartid}' style='position:absolute; top:5px; right:5px;' >
                           <table border='1px solid black' style='position:absolute; right:6px;
                             bottom:8px; border-radius: 20px;'>
                               <tr>
                                 <th style='font-size:12px; width:17px;
                                 cursor: pointer;'><button
                                 onclick='addquantity(${cartid}, 1111111
                                 ,${cartsproducts.stock} );'><i
                                 class="bi
                                 bi-plus-lg"></i></button></th>
                                 <input type='hidden' id='inputQuantity${cartid}' value='${quantity}'>
                                 <th style='font-size:15px; width:17px; '
                                 id='quantity-${cartid}'>${quantity}</th>
                                 <th style='font-size:12px; width:20px;
                                 cursor: pointer;'><button
                                 id="misnesquantity${cartid}"
                                 onclick='addquantity(${cartid},${Number(quantity)-1});'><i
                                 class="bi
                                 bi-dash-lg"></i></button></th>
                               </tr>
                             </table>
                              <p class="card-text" style='display:inline; '>$${cartPrice}
                                <small class="text-body-secondary"
                                id="rating_show${cartsproducts.id}">
                                </small>
                              </p>
                              <p style='margin-bottom:-10px;'>
                                <del>$${cartsproducts.price}</del>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  `);


                let rating_show =
                document.getElementById('rating_show'+cartsproducts.id);

                  let rating_count = 0;

                  response.product_ratting.forEach(function(product_ratting_row){
                    if(product_ratting_row.product_id === cartsproducts.id){
                      rating_count += product_ratting_row.rating;

                      let sum = rating_count / response.product_ratting_count;

                      rating_show.innerHTML = `<i class="bi bi-star-fill"
                      style="color:#FFDA25;"></i>${sum}(${response.product_ratting_count})`;
                    }
                  });




                //  $('#rating_show').append(`
                 //   <i class="bi bi-star-fill" style="color:#FFDA25;"></i>${rating_count}(${response.product_ratting_count})
                //  `);



                  if ( carts.status === 'Ordered' ) { chackout( cartid ); }


                });
              }
            });
            //end peoduct fetch
          });

        }else if(response.sessioncountProduct){
          response.sessioncarts.forEach(function(carts) {
            let cartPrice  =`${carts.product_price }`;
          //  let cartid     =`${carts.id}`;
            let quantity   =`${carts.quantity}`;
             //কষকদকদ

            //cart product show
            let formData = new FormData();
            formData.append('productId',carts.product_id);
            $.ajax({
              url : '/cartsProductFetch',
              type :'POST',
              processData: false,
              contentType: false,
              data: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              success:function(response){
                response.show_cart_product.forEach(function(cartsproducts) {
                  $('#cartsProdectshow').append(`
                    <li class="nav-item">
                      <div class="card mb-3" style='width:100%;'>
                        <div class="row g-0">
                          <div class="col-4">
                            <img src="/storage/${cartsproducts.image}"
                            style='height:100px; width:100px;' class="img-fluid rounded-start"
                            alt="...">
                          </div>
                          <div class="col-8">
                            <div class="card-body">
                              <p class="card-text">${cartsproducts.name}</p>
                              <input type='checkbox' onclick='chackout(  );' class='cart-checkbox' id='product-' value='' style='position:absolute; top:5px; right:5px;' >
                           <table border='1px solid black' style='position:absolute; right:6px;
                             bottom:8px; border-radius: 20px;'>
                               <tr>
                                 <th style='font-size:16px; width:20px;
                                 cursor: pointer;'><button
                                 onclick='addquantity( 1111111
                                 ,${cartsproducts.stock} );'><i
                                 class="bi
                                 bi-plus-lg"></i></button></th>
                                 <input type='hidden' id='inputQuantity' value='${quantity}'>
                                 <th style='font-size:20px; width:20px; '
                                 id='quantity-'>${quantity}</th>
                                 <th style='font-size:16px; width:20px;
                                 cursor: pointer;'><button
                                 id="misnesquantity"
                                 onclick='addquantity(,${Number(quantity)-1});'><i
                                 class="bi
                                 bi-dash-lg"></i></button></th>
                               </tr>
                             </table>
                              <p class="card-text"
                              style='display:inline;'>${cartPrice}<small
                             class="text-body-secondary" style=""> <i class="bi bi-star-fill"
                             style="color:#FFDA25;"></i>4.5(777)
                                 </small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  `);
                });
              },
              error:function(xhr,status,error){
                //alert ('Error:'+ xhr.responseText);
                //console.log(xhr.responseText);
              }

            });
            //end peoduct fetch
          });

        }else{
          $('#cartsProdectshow').append(`cart is not found`);
        }
      },
      error:function(xhr,status,error){
        //alert ('Error:'+ xhr.responseText);
        //console.log(xhr.responseText);
      }
    });
  }
  FetchCarts();

  window.addquantity = function(cartid,addquantitynum,stock){

    let input = $('#inputQuantity' + cartid);
    let count = parseInt(input.val()) || 0;

    if( addquantitynum == 1111111 ){
      if(count < stock){
        count ++;
        input.val(count);
        $('#quantity-'+cartid).text(count);
      }
    }else{
      if(count > 1){
        count --;
        input.val(count);
        $('#quantity-'+cartid).text(count);
      }
    }

    let formData = new FormData();
    formData.append('cartid',cartid);
    formData.append('addquantitynum',count);

    $.ajax({
      url : '/cart/quantity',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        response.user.forEach(function(quantityNum) {
          let quantity   =`${quantityNum.quantity}`;
          chackout();
        });
      }
    });
  }
  //chackout section
  window.chackout = function(){
    let show = document.getElementById("showPrice");
    const cartdeletebutton = document.getElementById('cartdeletebutton');
    const chackoutbutton   = document.getElementById('chackoutbutton');
    let selectedIds = [];
    $('.cart-checkbox:checked').each(function() {
      selectedIds.push($(this).val());
    });

    if(selectedIds.length === 0 ){
      show.innerText = `0`;
      cartdeletebutton.style.display='none';
      chackoutbutton.style.display='none'
    }else{
      cartdeletebutton.style.display='block';
      chackoutbutton.style.display='block'
      let formData = new FormData();
      formData.append('ids',selectedIds);

      $.ajax({
        url: '/chackout/index', // change to your actual route
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function(response) {
          let total_price = response.products.reduce((sum, product) => sum +
          (parseFloat(product.product_price * product.quantity ) || 0),
          0).toFixed(1);

          show.innerText  ='price: $'+ total_price;
          $('#showPriceForVoucher').val(total_price);
        },
        error: function(xhr) {
          console.error("Error fetching product data:", xhr);
          showalert('Try agian later' , '#ffffff' ,'showallalert');
        }
      });
    }
  }
  //end chackout section
  window.cartsdelete = function(){
    const cartdeletebutton = document.getElementById('cartdeletebutton');
    let selectedIds = [];
    $('.cart-checkbox:checked').each(function() {
      selectedIds.push($(this).val());
    });
    let formData = new FormData();
    formData.append('ids',selectedIds);
    $.ajax({
      url: '/cart/delete', // change to your actual route
      type: 'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
       FetchCarts();
       chackout();
       cartdeletebutton.style.display='none';
       chackoutbutton.style.display='none';

        showalert('Cart delete' , '#ffffff' ,'showallalert');
      },
      error: function(xhr) {
          console.error("Error fetching product data:", xhr);
          showalert('Try agian later' , '#ffffff' ,'showallalert');
      }
    });
  }

  window.orderinsert = function(){
    let selectedIds = [];
    $('.cart-checkbox:checked').each(function() {
      selectedIds.push($(this).val());
    });
    let formData = new FormData();
    formData.append('ids',selectedIds);
    detailsDataAjax('/order/create',formData,'post','orderinsertSuccess','Nan','Nan','Nan','Nan');
  }
  window.orderinsertSuccess = function(){
    window.location.href='/home/chackout';
  }

  window.usershownotise = function(){

    const notise_nav = document.getElementById('notise_nav');
    const notise_show = document.getElementById('notise_show');
    //const notise_br = document.getElementById('notise_br');


    $.ajax({
      url : '/notisefetch',
      type :'POST',
      processData: false,
      contentType: false,
       //  data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },

      success:function(response){

        if( response.notise.status === 1 ){
          notise_nav.style.display = 'block' ;
       //   notise_br.style.display = 'block' ;
        }else{
          notise_nav.style.display = 'none' ;
        //  notise_br.style.display = 'none' ;
        }
        notise_show.innerHTML        = `${response.notise.notise_name}`;
      },
      error:function(xhr,status,error){
        alert ('Error:'+ xhr.responseText);
        //alert('jakiul islam');
      }
    });
  }
  // usershownotise();
  window.addCart = function(productId,cartPrice){
    let formData = new FormData();
    formData.append('productId',productId);
    formData.append('cartPrice',cartPrice);
    sendDataAjax('/cart/create',formData,'post','FetchCarts','Nan','Nan','Nan','Nan');
  }
