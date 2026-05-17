  function Allordershow( name  ){
    window.originalContent1 = $("#userInfo").html();
      let  sattingPageShow  = document.getElementById('userInfo');
      sattingPageShow.innerHTML=`
        <div style='overflow:auto;'>
          <div style="display: flex; align-items: center; margin-top:3px; ">
            <div>
             <button onclick='settingback();' style='background:none; border:none; font-size:22px; display:inline;'><i class="bi bi-arrow-left"></i></button>
            </div>
            <div>
              <div class="input-group flex-nowrap" style='border:solid black 1px ; border-radius:40px;'>
                <input type='search' required oninput="allorder( 'All' );" id="searchinput" style='background:none; border:none;'
                class="form-control shadow-none"  placeholder="prodect-name"
                aria-label="Username"  aria-describedby="addon-wrapping">
                <span class="input-group-text" style='background:none;border:none;' id="addon-wrapping">
                  <i class="bi bi-search"></i>
                </span>
               </div>
            </div>
          </div>
          
          <div style='display:flex; margin-top:15px; font-size:18px;'>
            <div style='margin:auto;' onclick="allorder('All');">
              <p style=''>All</p>
              <hr id='hr_All' style='margin-top:-12px; display:none;'>
            </div>
            <div style='margin:auto;'>
              <p style='' onclick="allorder( 'processing' );">To pay</p>
              <hr id='hr_processing'  style='margin-top:-12px; display:none;'>
            </div>
            <div style='margin:auto;'>
              <p style='' onclick="allorder( 'shipped' );">To ship</p>
              <hr id='hr_shipped'  style='margin-top:-12px; display:none;'>
            </div>
            <div style='margin:auto;'>
              <p style='' onclick='review();'>To review</p>
              <hr id='review'   style='margin-top:-12px; display:none;'>
            </div>
            <div style='margin:auto;'>
              <p style='' onclick="allorder( 'refunded' );">To return</p>
              <hr id='hr_refunded'  style='margin-top:-12px; display:none;'>
            </div>
          </div>
          <div id='showAllorderdata'></div>
        </div>
        `;
        
         allorder( name );
        
       // window[name]( name );
        
  }
  //user order info
  function allorder( name ){
    const searchinput = document.getElementById('searchinput').value;
  
    document.getElementById('hr_All').style.display='none';
    document.getElementById('hr_processing').style.display='none';
    document.getElementById('hr_shipped').style.display='none';
    document.getElementById('review').style.display='none';
    document.getElementById('hr_refunded').style.display='none';
    
    
    let formData = new FormData();
     formData.append('searchinput',$('#searchinput').val() );
  
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
        $('#showAllorderdata').html('');
        response.chackoutproducts.forEach(function(product,index) {
          if( name === 'All' ){
            document.getElementById('hr_'+name).style.display='block';
            $('#showAllorderdata').append(`
              <style>
                .buttontext{
                  background:none;
                  border:none;
                  color:#ffffff;
                  text-decoration:none;
                }
              </style>
              
                <div class="card mb-3" style='width:95%; margin:auto;'>
                  <div class="row g-0">
                    <div class="col-3">
                      <img data-product-id='product_img${product.product_id}' src=""
                              style='height:100px; width:auto;' class="img-fluid rounded-start"
                              alt="...">
                    </div>
                    <div class="col-9">
                      <div class="card-body" style='position:relative;'>
                        <p class="card-text product-name"
                        style='margin-top:-14px;'
                        data-product-id="${product.product_id}"></p>
                        <p style='line-height:0;'>$${product.unit_price}</p>
                        <p style='line-height:0.5;'>×${product.quantity} </p>
                        <p style='line-height:0.5; margin-bottom:-10px;'>${product.method}</p>
                        <div style=''>
                         <button style='background:none; border:none; position:absolute; top:10px; right:10px;'
                         onclick="ordermenu( '${index}' );"> <i class="bi
                         bi-three-dots-vertical"></i></button>
                           
                          <div id='showOrdermenu_${index}'
                          style='position:absolute; top:10px; right:40px;
                          line-height:1.1; background-color: rgba(0, 0, 0,
                          0.6); padding:8px; padding-top:5px;
                          border-radius:10px; display:none; color:#ffffff;'>
                            ${ product.method === 'shipped' ? 
                            `<a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratting</a>`:`` }
                            ${ product.method === 'processing' ? 
                            `<button class='buttontext'>cancel order</button> <br>
                            <a  class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratting</a>`:`` }
                            ${ product.method === 'pending' ? 
                            `<a class='buttontext' href='/home/chackout'  >chackout</a>
                            <br> 
                            <a   class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratitng</a>`:`` }
                            ${ product.method === 'completed' ? 
                            `<button class='buttontext' onclick='plassorder();'>return</button>
                            <br>
                            <a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratting</a>`:`` }
                            ${ product.method === 'refunded' ? 
                            `<button class='buttontext'>return</button> 
                            <br> 
                            <a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratting</a>`:`` }
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            `);
          }else if( product.method === name ){
            document.getElementById('hr_'+name).style.display='block';
            $('#showAllorderdata').append(`
              <style>
              .buttontext{
                background:none;
                border:none;
                color:#ffffff;
                text-decoration:none;
                margin-left:8px;
              }
              </style>
              
                <div class="card mb-3" style='width:95%; margin:auto;'>
                  <div class="row g-0">
                    <div class="col-3">
                      <img data-product-id='product_img${product.product_id}' src=""
                              style='height:100px; width:auto;' class="img-fluid rounded-start"
                              alt="...">
                    </div>
                    <div class="col-9">
                      <div class="card-body" style='position:relative;'>
                        <p class="card-text product-name"
                        style='margin-top:-14px;'
                        data-product-id="${product.product_id}"></p>
                        <p style='line-height:0;'>$${product.unit_price}</p>
                        <p style='line-height:0.5;'>×${product.quantity} </p>
                        <p style='line-height:0.5; margin-bottom:-10px;'>${product.method}</p>
                        <div style=''>
                         <button style='background:none; border:none; position:absolute; top:10px; right:10px;'
                         onclick="ordermenu( '${index}' );"> <i class="bi
                         bi-three-dots-vertical"></i></button>
                           
                          <div id='showOrdermenu_${index}'
                          style='position:absolute; top:10px; right:40px;
                          line-height:1.1; background-color: rgba(0, 0, 0,
                          0.6); padding:8px; padding-top:5px;
                          border-radius:10px; display:none; color:#ffffff;'>
                            ${ product.method === 'shipped' ? 
                            `<a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratting</a>`:`` }
                            ${ product.method === 'processing' ? 
                            `<button class='buttontext' onclick='' >cancel order</button> <br>
                            <a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratting</a>`:``
                            }
                            ${ product.method === 'pending' ? 
                            `<a class='buttontext' href='/home/chackout' >chackout</a> 
                            <br>
                            <a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>rating</a>`:``
                            }
                            ${ product.method === 'completed' ? 
                            `<button class='buttontext'>return</button> 
                            <br> <a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting/'>ratting</a>`:`` }
                            ${ product.method === 'refunded' ? 
                            `<button class='buttontext'>return</button> <br> <a class='buttontext' data-product-id='ratting_id${product.product_id}' href='/ratting'>ratting</a>`:`` }
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            `);
          }
        });
        response.product.forEach(function(product,index){
          document.querySelectorAll(`img[data-product-id="product_img${product.id}"]`).forEach(function(img) {
            img.src = `/storage/${product.image}`;
          });
          document.querySelectorAll(`.buttontext[data-product-id="ratting_id${product.id}"]`).forEach(function(alink)
          {
            alink.href = `/ratting/${product.slug}`;
          });
          document.querySelectorAll(`.product-name[data-product-id="${product.id}"]`).forEach(function(nameElement) {
            nameElement.innerHTML = `${product.name}`;
          });
            
        }); 
          
      },
      error:function(xhr,status,error){
        let response = JSON.parse(xhr.responseText);
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
