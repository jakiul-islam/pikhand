  <style>
    .textcenter{
      display: flex;
      height:190px; 
      width:100%; 
      background-color:green; 
      position: relative;
      flex-direction: column;  
      align-items: center;      
      justify-content: center;
    }
    .paymentsuccess{
      position:absolute;
      bottom:0px;
      font-size: 22px;
      color:#ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeInUp 1s ease forwards 1s;
    }
    .textcentertick {
      display: flex;
      flex-direction: column;  
      align-items: center;      
      justify-content: center;
      height:60px;
      width: 60px;
      border-radius: 50%;
      border:1.5px solid #ffffff;
      animation: pop 1.5s ease forwards, glow 1.5s ease-in-out infinite;
    }
    /* Pop effect */
    @keyframes pop {
      0% { transform: scale(0.5); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }
    /* Glow effect */
    @keyframes glow {
      0%, 100% { box-shadow: 0 0 5px #22c55e; }
      50% { box-shadow: 0 0 20px #22c55e; }
    }

    /* Fade-in with slide-up */
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
  <script>
    function CreditDebit(){
      let total_pricehid   = $('#total_pricehid').val();
      let Soping_cost   = $('#Soping_cost').val();
      let  Soping_costtotal_pricehid  = $('#Soping_costtotal_pricehid').val();
      
      window.history.pushState({}, '', `/chackout/payment/CreditDebit`);
          
      let formData = new FormData();
      formData.append('phoneNumber','jakiul');
          
      $.ajax({
        url : '/order/index',
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          let showpaymentpage = document.getElementById('showpaymentpage');
          showpaymentpage.innerHTML=`
            <style>
              .cardpans{
                margin:auto;
                height;auto;
                width:275px;
                border:solid 2px black;
                padding:20px;
              }
              .logosvg{
                height:60px;
                width:60px;
              }
            </style>
          
            <button style='background:none; border:none;'
            onclick='paymenSelectback();'><i style='font-size:25px;' class='bi
            bi-arrow-left'></i></button>
              <span style='font-size:20px;'> Credit/Debit Card</span>
              
            <div class='cardpans'>
              <p class='text-center'>
              </p>
            
              <label>Cardholder Name</label><br>
              <input type="text" name="card_name" required><br>
                
              <label>Card Number</label><br>
              <input type="text" name="card_number" maxlength="19" required><br>
                
              <label>Expiry Date</label><br>
              <input type="text" name="expiry" placeholder="MM/YY" required><br>
                
              <label>CVV</label><br>
              <input type="password" name="cvv" maxlength="4" required><br>
                
                <p id='total_price' style='color:#FFFFFF; line-height:0.5; margin-top:10px;'></p>
                <p id='dalevery_cost' style="color:#FFFFFF; line-height:0.5;" ></p>
                
                <div style='line-height:0.5; ' >
                  <p>subtotal price : $${response.fetch_order_table.subtotal}</p>
                  <p>Soping cost :$${response.fetch_order_table.shipping_cost}</p>
                  <p>total price :$${response.fetch_order_table.total}</p>
                </div>
              <button type="submit">Pay Now</button>
            
            </div>
  
            
            <br>
            <br>
            <br>
          `;
        },
        error:function(xhr,status,error){
            let response = JSON.parse(xhr.responseText);
            
           // console.log(xhr.responseText);
            
           // alert( xhr.responseText );
            
          
          },
      });
    }
    //BKash
    function BKash(){
      window.paymenSelect = $("#showpaymentpage").html();
      
      let formData = new FormData();
      formData.append('phoneNumber','jakiul');
        
      $.ajax({
        url : '/order/index',
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          let showpaymentpage = document.getElementById('showpaymentpage');
          showpaymentpage.innerHTML=`
            <style>
              .cardpans{
                margin:auto;
                height;auto;
                width:275px;
                border:solid 2px black;
                padding:20px;
              }
              .logosvg{
                height:60px;
                width:60px;
              }
            </style>
          
            <button style='background:none; border:none;'  onclick='paymenSelectback();'><i style='font-size:25px;' class='bi bi-arrow-left'></i></button>
              <span style='font-size:20px;'> BKash</span>
              
            <div class='cardpans'>
              <p class='text-center'>
              </p>
            
                <label>Amount:</label><br>
                <input type="number" name="amount" required><br>
              
                <label>Reference (Order ID):</label><br>
                <input type="text" name="reference" required><br>
              
                <label>Customer Name:</label><br>
                <input type="text" name="name"><br>
              
                <label>Email:</label><br>
                <input type="email" name="email"><br>
                
                
                <div style='line-height:0.5; ' >
                  <p>subtotal price : $${response.fetch_order_table.subtotal}</p>
                  <p>Soping cost :$${response.fetch_order_table.shipping_cost}</p>
                  <p>total price :$${response.fetch_order_table.total}</p>
                </div>
                
                
                
              <button type="submit">Pay Now</button>
            </div>
            
            
            <br>
            <br>
            <br>
          `;
        },
        error:function(xhr,status,error){
          let response = JSON.parse(xhr.responseText);
        },
      });
    }
    //Rocket
    function Rocket(){
      window.paymenSelect = $("#showpaymentpage").html();
      
      let formData = new FormData();
      formData.append('phoneNumber','jakiul');
      
      $.ajax({
        url : '/order/index',
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
      
      let showpaymentpage = document.getElementById('showpaymentpage');
        showpaymentpage.innerHTML=`
          <style>
            .cardpans{
              margin:auto;
              height;auto;
              width:275px;
              border:solid 2px black;
              padding:20px;
            }
            .logosvg{
              height:60px;
              width:60px;
            }
          </style>
        
          <button style='background:none; border:none;'  onclick='paymenSelectback();'><i style='font-size:25px;' class='bi bi-arrow-left'></i></button>
            <span style='font-size:20px;'> Rocket</span>
            
          <div class='cardpans'>
            <p class='text-center'>
            </p>
          
            <label>Cardholder Name</label><br>
            <input type="text" name="card_name" required><br>
              
            <label>Card Number</label><br>
            <input type="text" name="card_number" maxlength="19" required><br>
              
            <label>Expiry Date</label><br>
            <input type="text" name="expiry" placeholder="MM/YY" required><br>
              
            <label>CVV</label><br>
            <input type="password" name="cvv" maxlength="4" required><br>
              
              
              <div style='line-height:0.5; ' >
                <p>subtotal price : $${response.fetch_order_table.subtotal}</p>
                <p>Soping cost :$${response.fetch_order_table.shipping_cost}</p>
                <p>total price :$${response.fetch_order_table.total}</p>
              </div>
              
              
              
              
            <button type="submit">Pay Now</button>
          </div>
          
          
          <br>
          <br>
          <br>
        `;
         },
      error:function(xhr,status,error){
          let response = JSON.parse(xhr.responseText);
          
         // console.log(xhr.responseText);
          
         // alert( xhr.responseText );
          
        
        },
      });
    }
    //Nogad
    function Nogad(){
      window.paymenSelect = $("#showpaymentpage").html();
      
      let formData = new FormData();
      formData.append('phoneNumber','jakiul');
      
      $.ajax({
        url : '/order/index',
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
      
      let showpaymentpage = document.getElementById('showpaymentpage');
        showpaymentpage.innerHTML=`
          <style>
            .cardpans{
              margin:auto;
              height;auto;
              width:275px;
              border:solid 2px black;
              padding:20px;
            }
            .logosvg{
              height:60px;
              width:60px;
            }
          </style>
        
          <button style='background:none; border:none;'  onclick='paymenSelectback();'><i style='font-size:25px;' class='bi bi-arrow-left'></i></button>
            <span style='font-size:20px;'> Nogad</span>
            
          <div class='cardpans'>
            <p class='text-center'>
            </p>
          
            <label>Cardholder Name</label><br>
            <input type="text" name="card_name" required><br>
              
            <label>Card Number</label><br>
            <input type="text" name="card_number" maxlength="19" required><br>
              
            <label>Expiry Date</label><br>
            <input type="text" name="expiry" placeholder="MM/YY" required><br>
              
            <label>CVV</label><br>
            <input type="password" name="cvv" maxlength="4" required><br>
              
              
              
              <div style='line-height:0.5; ' >
                <p>subtotal price : $${response.fetch_order_table.subtotal}</p>
                <p>Soping cost :$${response.fetch_order_table.shipping_cost}</p>
                <p>total price :$${response.fetch_order_table.total}</p>
              </div>
              
              
              
            <button type="submit">Pay Now</button>
          </div>
          
          
          <br>
          <br>
          <br>
        `;
       },
      error:function(xhr,status,error){
          let response = JSON.parse(xhr.responseText);
          
         // console.log(xhr.responseText);
          
         // alert( xhr.responseText );
          
         
        },
      });
    }
    //Chash
    function cash_on_delivery(){
      window.paymenSelect = $("#showpaymentpage").html();
      
      window.history.pushState({}, '', `/chackout/payment/cash_on_delivery`);
      
      let formData = new FormData();
      

      formData.append('phoneNumber','jakiul');
      
      $.ajax({
        url : '/order/index',
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
        

        let showpaymentpage = document.getElementById('showpaymentpage');
        showpaymentpage.innerHTML=`
          <style>
            .cardpans{
              margin:auto;
              height;auto;
              width:275px;
              border:solid 2px black;
              padding:20px;
            }
            .logosvg{
              height:60px;
              width:60px;
            }
          </style>
        
          <button style='background:none; border:none;'  onclick='paymenSelectback();' ><i style='font-size:25px;' class='bi bi-arrow-left'></i></button>
            <span style='font-size:20px;'> Chash</span>
            
          <div class='cardpans'>
            <p class='text-center'>
            </p>
              <h6>User details :</h6>
              <p style='line-height:0.5;'>👤 Name:
              ${response.user_address.name}</p>
              <p style='line-height:0.5;'>📞 Phone: ${response.user_address.phone_number}</p>
              <p style=''>🏢 Office Address: ${response.user_address.address}</p>
              <br>
             <div style='line-height:0.5; ' >
                <p>Subtotal price : $${response.fetch_order_table.subtotal}</p>
                <p>Soping cost :$${response.fetch_order_table.shipping_cost}</p>
                <p>Total price :$${response.fetch_order_table.total}</p>
              </div>
              
              <input type='hidden' id='order_id'
              value='${response.fetch_order_table.id}'>
              
              <input type='hidden' id='order_total'
              value='${response.fetch_order_table.total}'>
              
             
              <input type='hidden' id='order_id' value='${response.fetch_order_table.id}'>
              
              
              
              
            <button type="submit" onclick='confirmOrder();'>confirm order</button>
          </div>
          
          
          <br>
          <br>
          <br>
        `;
         },
          error:function(xhr,status,error){
            let response = JSON.parse(xhr.responseText);
          
            //  console.log(xhr.responseText);
          
            alert( xhr.responseText );
          
        
        },
      });
    }
    
    window.paymenSelectback = function() {
      window.history.pushState({}, '', `/chackout/payment-mathod`);
      seclectpament();
    };

  </script>
  <script>
  function confirmOrder(){
    
    let formData = new FormData();
    formData.append('order_id',$('#order_id').val() );
    formData.append('order_total',$('#order_total').val() );
  
          
    $.ajax({
      url : '/cashondelivery',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        paymentsuccess();
      },
      error:function(xhr,status,error){
        let response = JSON.parse(xhr.responseText);
              
            //  console.log(xhr.responseText);
              
              alert( xhr.responseText );
              
            
      },
    });
  }
</script>
<script>
  
  function paymentsuccess(){
    let formData = new FormData();
    formData.append('order_id',$('#order_id').val() );
    formData.append('order_total',$('#order_total').val() );
  
          
    $.ajax({
      url : '/user/order/info',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
      
        let showpaymentpage = document.getElementById('showpaymentpage');
        showpaymentpage.innerHTML=`
        <div class="textcenter" >
          <a href="/" class='back' style='position:absolute; left:20px;
          top:20px; color:#ffffff;'><i style='font-size:25px;' class='bi bi-arrow-left'></i></a>
          <div class="textcentertick"><i class="bi bi-check-lg" style="font-size:40px;"></i></div>
          <p class='paymentsuccess'>Payment Successfull</p>
        </div>
        <br>
        <div id='paymentditels'>
        <div>
        `;
            
             response.successorderItem.forEach(function(product,index) {
                $('#paymentditels').append(`
                  <div class="card mb-3" style='width:95%; margin:auto;'>
                    <div class="row g-0">
                      <div class="col-3">
                        <img id='product_img${index}' src=""
                                style='height:100px; width:100px; margin:10px;' class="img-fluid rounded-start"
                                alt="...">
                      </div>
                      <div class="col-9">
                        <div class="card-body"
                        style='margin-top:-10px; margin-bottom:-10px;'>
                          <p class="card-text" id='product_name${index}'
                          style=""></p>
                          <p style='line-height:0;'>$${product.unit_price}</p>
                          <p style='line-height:0.5;'>${product.discount}% </p>
                          <p style='line-height:0.5;'> quantity :${product.quantity} </p>
                          <p style='line-height:0.5;'>total price : $${product.total_price}</p>
                         
                        </div>
                      </div>
                    </div>
                  </div>
                `);
              });
              
          response.product.forEach(function(product,index){
            let product_img  = document.getElementById('product_img'+index);
            let product_name = document.getElementById('product_name'+index);
            product_img.src=`/storage/${product.image}`;
            product_name.innerHTML = product.name ;
          }); 
              
      },
      error:function(xhr,status,error){
        let response = JSON.parse(xhr.responseText);
        alert(xhr.responseText);
        console.log(xhr.responseText);
      },
    });
  }
</script>