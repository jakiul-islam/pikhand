<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id='mata_title'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=''>
   <title></title>
   
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- swiper css link -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
      .back{
        display: inline;
      }
      .showalert{
        background-color:#E4E4E4;
        color:#5270E4;
      }
      .dalevery{
        line-height:0;
      }
      .add-address{
        background: none;
        border:none;
        margin-left: 20%;
        line-height: 0;
      }
     .add-address-div{
      height: 60px;
      width:60px;
      border:1px solid black;
      margin:10px ;
      display: ;
     }
    .plessorderdiv{
      height: 60px;
      width: 100%;
      position: fixed;
      bottom: 0px;
    }
    
.trapezium {
    position: fixed;
    bottom: 0px;
    right: 0px;
    width: 50%;
    z-index: 100;
    height: 60px;
    background: black;
    clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);
    color: #ffffff;
}
.biler{
  line-height:0.5;
  margin-left: 5px;
}

    .shipping-address{
      background-color:#E4E4E4 ;
      box-sizing: border-box;
      margin: 4px;
      display:flex;
      position: relative;
    }
    </style>
    </head>
    <body>
    <div id='showpaymentpage'>
      <div style="margin-left:5px;">
        <a href="/" class='back'><i style='font-size:25px;' class='bi bi-arrow-left'></i></a>
        <p style='display:inline; margin-left:10px; 
        font-size:20px;' id='orderitemcount' onclick="fetchorderItem()">Checkout()</p>
      </div>
      <div class="showalert">
        <p class='text-center'>Claim voucher to enjoy Free Delivery !</p>
      </div>
      
      <div class="shipping-address" >
        <div><img style="height:50px; width:50px; margin:4px; border-radius:30px;" src="/storage/logo/location.jpeg"></div>
          <div class="" id="address_div" style=" margin-top:12px; margin-left:4px;">
            <h5 style="line-height:0.3;">jakiu islam <span style="color:#FFABFD;"> 01834426305 </span></h5>
            <p style="margin-bottom:-2px;"><span style="background-color:#FFABFD; padding:2px;
            border-radius:10px;"> Home </span>
            kdjgskdlfjgsdklfdfn-->ajdfjadf-->jhsadfkasdf-->hdszfas</p>
          </div>
          <div style="position:absolute; right:8px; top:53%; transform:translateY(-50%);"><i class="bi bi-chevron-right"></i></div>
      </div>
      <br>
   <!--  
     <div class='add-address-div'>
       <button class='add-address' onclick="addaddress();" data-bs-toggle="modal" data-bs-target="#address1"><i style="font-size:25px;" class="bi bi-plus"></i></button>
       <br>
       <small style="font-size:10px; line-height: 0;"> Add address</small>
     </div>
     <select class="useraddress" id='useraddressinsert' style="height:50px;  margin-left:5px;">
     </select>
     <br>
     <div id='showaddressadd' style='line-height:0.5;'></div>
     <br> -->
      
      
      
      
      <div class="biler">
        <p>biler to other address</p>
        <p id="email"></p>
        <p id='name'></p>
        <p id="phonenumber">01834426305</p>
      </div>
      <div id='showchackoutproduct'>
      </div>
      <br>
      <div id='allhiddeninput'></div>
      <div id='allhiddeninputaddress'></div>
      <br>
      <button class="trapezium" onclick="plassorder()">Place Order</button>
  
      <div>
        <div class="contener-fluid">
          <div class="plessorderdiv row">
            <div class="col-6" style="background-color:#479283;">
              <p id='total_price' style='color:#FFFFFF; line-height:0.5;
              margin-top:10px;'></p>
              <p id='dalevery_cost' style="color:#FFFFFF; line-height:0.5;" ></p>
            </div>
            <div class="col-6" style="background-color:#479283;">
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--address model -->
        <div class="modal fade" id="address1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Set frist address</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="">
                  <lavel>name </lavel><br>
                  <input type="text" id="addressname"   class="form-control " placeholder="What is your name" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>phone </lavel><br>
                  <input type="number" id="addressphone"   class="form-control " placeholder="What is your name" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>distric </lavel><br>
                  <input type="text" id="a1" oninput="addressB(1);"  class="form-control " placeholder="What is your name" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>bivag</lavel><br>
                  <input type="text" id="b1" oninput="addressB(1);" class="form-control " placeholder="what are you old"  aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>propoler name </lavel><br>
                  <input type="text" id='c1' oninput="addressB(1);"  class="form-control " placeholder="What is your gender" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <lavel>
                  <input type="radio" name="home_office" id='home_office'
                  value="home"> 
                  Home
                </lavel>
                <lavel>
                  <input type="radio" name="home_office" id='home_office'
                  value="Office"> 
                  Office
                </lavel>
              </div>
              <div class="modal-footer">
                <button type="button" onclick="showaddress();" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="insertaddress();" class="btn btn-primary" id='Address1' >Save</button>
              </div>
            </div>
          </div>
        </div>
      
      
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
      <script>
        function addaddress(){
          let useraddress = document.querySelector('.useraddress');
          useraddress.style.display = 'none';
          useraddress.id = 'useraddressins';
        }
        function showaddress(){
          let useraddress = document.querySelector('.useraddress');
          let showaddressadd = document.getElementById('showaddressadd');
          useraddress.style.display = 'block';
          useraddress.id = 'useraddressinsert';
          showaddressadd.style.display ='none';
        }
        
        function insertaddress(){
          
          let showaddressadd = document.getElementById('showaddressadd');
          let allhiddeninputaddress = document.getElementById('allhiddeninputaddress');
         
         let address  = $('#a1').val() +'-->'+ $('#b1').val() +'-->'+ $('#c1').val() ;
      
          let addressname  = $('#addressname').val();
          let addressphone = $('#addressphone').val();
          let home_office  = $('#home_office').val();
          
          showaddressadd.innerHTML =` 
            <p>Dalivery to : ${addressname}</p>
            <p>phone : ${addressphone}</p>
            <p>plass : ${home_office}</p>
            <p>${home_office} address : ${address}</p>
            
          `;
          
          allhiddeninputaddress.innerHTML = ` <input type='hidden' id='useraddressinsert' value='${addressname} ${addressphone}
             ${home_office} address : ${address}'> `;
          
          
          var modal = bootstrap.Modal.getInstance($('#address1')[0]);
          modal.hide();
        }
      </script>
      <script>
        function fetchorderItem(){
          let showchackoutproduct = document.getElementById('showchackoutproduct');
          let name = document.getElementById('name');
          let email= document.getElementById('email');
          let phoneNumber = document.getElementById('phonenumber');
          let useraddress = document.getElementById('useraddress');
         let total_price = document.getElementById('total_price');
         let dalevery_cost = document.getElementById('dalevery_cost');
         let allhiddeninput = document.getElementById('allhiddeninput');
         let address_div    =document.getElementById('address_div');
         
         
  
          $.ajax({
            url : '/index/order/item',
            type :'POST',
            processData: false,
            contentType: false,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
              
            if(response.user_address){ 
              address_div.innerHTML = `
                <h5 style="line-height:0.3;">${response.user_address.name} <span style="color:#FFABFD;"> 01834426305 </span></h5>
                <input type='hidden'id='addressIdinput'
                value='${response.user_address.id}'>
                <p style="margin-bottom:-2px;"><span style="background-color:#FFABFD; padding:2px;
                          border-radius:10px;"> ${response.user_address.home_office} </span>
                          ${response.user_address.address}</p>
             `; 
            }
              
              
              
              
            
              
              let price_voucher = response.chackoutproducts.reduce((sum, product) => sum +
              (parseFloat(product.product_price ) || 0),
              0).toFixed(1);
            
              let allpriceSoping_cost; 
            
              if(response.voucher_status === true){
                let price = price_voucher - response.voucher_show.amount;
                allpriceSoping_cost = parseFloat(price) + 70;
                
              }else{
                 allpriceSoping_cost = parseFloat(price_voucher) + 70;
                
              }
            
            
            
            total_price.innerText ='Total Price : $' + allpriceSoping_cost;
            
            
            
            
              dalevery_cost.innerText =`Shipping cost : 70 `;
              
             allhiddeninput.innerHTML = ` 
             <input type='hidden' id='total_pricehid' value='${allpriceSoping_cost}'>
             <input type='hidden' id='Soping_cost' value='70'>
             <input type='hidden' id='Soping_costtotal_pricehid' value='${allpriceSoping_cost}'>
             `;
              
              
              
              
              response.chackoutproducts.forEach(function(product,index) {
              
              
            
            
              //  let discountss    = `${ product.discount / 100 }`;
              // let discountprice = `${ product.unit_price * discountss }`;
              
                $('#showchackoutproduct').append(`
                  <div class="card mb-3" style='width:95%; margin:auto;'>
                    <div class="row g-0">
                      <div class="col-2">
                        <img id='product_img${index}' src="" style='height:100px; width:100%; margin:8px;  display:inline;' class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-10">
                        <div class="card-body" style='margin-top:-8px;
                        margin-bottom:-20px;'>
                          <p class="card-text"
                          id='productName_${product.product_id}'
                          style="line-height:1;"></p>
                          <p style='line-height:0;'>
                            Price:<span class="fw-bold
                            text-success">$${product.product_price}</span>
                            <span id='productprice_${product.product_id}'
                            class="text-muted" style="text-decoration:
                            line-through;"></span>
                          </p>
                          <p id='productDiscount_${product.product_id}' style='line-height:0.5;'>Discount:% </p>
                          <p style='line-height:0.5;'> Qty :${product.quantity} </p>
                          <p style='line-height:0.5;'>Total : $${ product.product_price * product.quantity}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                `);
              });
              
              email.innerHTML= `${response.user.email}`;
              name.innerHTML= `${response.user.name}`;
              phoneNumber.innerHTML= `${response.user.Phonenumber}`;
              //alert(response.user);
             // console.log(response.user.Phonenumber);
             
            
           // alert( response.product );
            
            
          response.product.forEach(function(product,index){
             let product_img = document.getElementById('product_img'+index);
             let productName = document.getElementById('productName_'+product.id);
             let productprice = document.getElementById('productprice_'+product.id);
             let productDiscount = document.getElementById('productDiscount_'+product.id);
             product_img.src=`/storage/${product.image}`;
             productName.innerHTML=`${product.name}`;
             productprice.innerHTML=`${product.price}`;
             productDiscount.innerHTML=`Discount:${product.discount}%`;

          }); 
             
             let orderitemcount =document.getElementById('orderitemcount');
            orderitemcount.innerHTML= `Checkout(${response.orderitemcount})`;
              
             
             
             
              response.user_address.forEach(function(address){
                $('.useraddress').append(`
                  <option value= " ${address.id} " style='width:50px;'>
                     ${address.name}
                    ${address.phone_number}
                    ${address.home_office} address : ${address.address}
                  </option>
                `);
              });
              
              
            },
            error:function(xhr,status,error){
              let response = JSON.parse(xhr.responseText);
              console.log(xhr.responseText);
              alert( xhr.responseText );
            },
          });
        }
        fetchorderItem();
      </script>
      <script>
      //chackout selectpayment
        $(document).ready(function() {
        
          let pathParts = window.location.pathname.split('/');
          if (pathParts.length === 3 && pathParts[1] === 'chackout' && pathParts[2]
          === 'payment-mathod') {
            seclectpament();
          }
        });
        //chackout payment-mathod
        $(document).ready(function() {
          let pathParts = window.location.pathname.split('/');
          if (pathParts.length === 4 && pathParts[1] === 'chackout' && pathParts[2]
          === 'payment' ) {
          
            let subcategoryid = decodeURIComponent(pathParts[3]);
            //subcategoryid();
           window[subcategoryid]();
          // alert(subcategoryid);
           
          }
        });
      </script>
      <script>
       function plassorder(){
         
         let useraddressinsert  = $('#addressIdinput').val()
         

         let formData = new FormData();
          
          formData.append('address', useraddressinsert );
          formData.append('total_pricehid', $('#total_pricehid').val());
          formData.append('Soping_cost', $('#Soping_cost').val());
          formData.append('Soping_costtotal_pricehid', $('#Soping_costtotal_pricehid').val() );
          
          $.ajax({
            url : '/order/pless',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
            seclectpament();
             window.history.pushState({}, '', `/chackout/payment-mathod`);
            },
            error:function(xhr,status,error){
              let response = JSON.parse(xhr.responseText);
              alert( xhr.responseText );
              
              console.log(xhr.responseText);
            },
          }); 
       }
      </script>
      <script>
      window.pleseorder = $("#showpaymentpage").html();
      
        function seclectpament(){
          let showpaymentpage = document.getElementById('showpaymentpage');

              showpaymentpage.innerHTML=`
              <style>
                .container {
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
                  width: 100%; 
                }
                .buttontext{
                  background:none;
                  border:none;
                }
              </style>
              
              <button style='background:none; border:none;'
              onclick='backplessorder()'><i style='font-size:25px;' class='bi
              bi-arrow-left'></i></button>
               <span style='font-size:20px;'> Select Payment mathord</span>
              <div>
                <div>
                  <div class="container">
                    <p>🪪 Credit/Debit Card</p>
                    <button onclick='CreditDebit()' class='buttontext'><i class="bi
                    bi-heart-arrow"></i></button>
                  </div>
                  <div class="container">
                    <p>Save BKash Account</p>
                    <button class='buttontext' onclick='BKash();'><i class="bi
                    bi-heart-arrow"></i></button>
                  </div>
                  <div class="container">
                    <p>Rocket</p>
                    <button class='buttontext' onclick='Rocket()'><i class="bi
                    bi-heart-arrow"></i></button>
                  </div>
                  <div class="container">
                    <p>Nogad</p>
                    <button class='buttontext' onclick='Nogad()'><i class="bi
                    bi-heart-arrow"></i></button>
                  </div>
                  <div class="container">
                    <p>Chash On delivery</p>
                    <button class='buttontext' onclick='cash_on_delivery()'><i class="bi
                    bi-heart-arrow"></i></button>
                  </div>
                </div>
               </div>
              `;
        }
      </script>
      <script>
        
        
        window.backplessorder = function() {
          window.history.pushState({}, '', `/home/chackout`);
          $("#showpaymentpage").html(pleseorder);
           fetchorderItem();
        };
      </script>
      @include("Frontend.all_payment_mathod")
    </body>