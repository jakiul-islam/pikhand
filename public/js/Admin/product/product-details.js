  //product detels section  
  window.originalContent = $("#product_detels_show").html();
  function productDetails(productId , pageNumber){
    
    
    let product_detels_show =document.querySelector("#product_detels_show");
    let formData = new FormData();
    formData.append('productId', productId);
    $.ajax({
      url:"/admin/product/show",
      type:"POST",
      processData:false,
      contentType:false,
      data:formData,
      headers:{
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response){
        
        let product_img = '';
        //brands fatch
        response.product.product_img.forEach(function(img,index) {
          product_img += `
          <div  class="carousel-item ${index === 0 ? 'active' : ''}">
            <img src="/storage/${img.images}" style='height:300px;' class="d-block w-100"
             alt="...">
          </div>
        `;
        });
            
        let math = `${ response.product.price *
              (response.product.discount / 100) }`;
            
        product_detels_show.innerHTML=`
          <button onclick="back('${pageNumber}');" style='border:none;
          background:none;position:relative; top:-5px;'><i class='bi bi-arrow-left'
          style='font-size:25px;'></i></button>
          
          
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <div id="carouselExampleIndicators" style=' width:auto; margin: 0 auto;' class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  ${response.product.product_img.map((_, i) => `
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${i}"
                      class="${i === 0 ? 'active' : ''}" aria-current="${i === 0 ? 'true' : 'false'}" aria-label="Slide ${i + 1}"></button>
                  `).join('')}
                </div>
                <div class="carousel-inner">
                  ${product_img}
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <table>
                <tr>
                  <td>id</td>
                  <td>: ${response.product.id}</td>
                </tr>
                <div id='subcategory'></div>
                <tr>
                  <td>Name</td>
                  <td>: ${response.product.name}</td>
                </tr>
                <tr>
                  <td>slug</td>
                  <td>: ${response.product.slug}</td>
                </tr>
                <tr>
                  <td>mata_title</td>
                  <td>: ${response.product.mata_title}</td>
                </tr>
                <tr>
                  <td>price</td>
                  <td>: <del>${response.product.price}</del>   ${response.product.price - math } $</td>
                </tr>
                <tr>
                <td>discount</td>
                  <td> : ${response.product.discount} %</td>
                </tr>
                <tr>
                  <td>stock</td>
                  <td style="color:${response.product.stock < 10 ? 'red':''};"> : ${response.product.stock}</td>
                </tr>
                <tr>
                  <td>product_code</td>
                  <td> : ${response.product.product_code}</td>
                </tr> 
                <tr>
                  <td>color</td>
                  <td> : ${response.product.color}</td>
                </tr>
                <tr>
                  <td>total carts</td>
                  <td> : ${response.product.crats?.length || 0}</td>
                </tr>
                <tr>
                  <td>total orders</td>
                  <td> : ${response.product.order_item?.length || 0}</td>
                </tr>
                <tr>
                  <td>total reviews</td>
                  <td> : ${response.product.product_reviews?.length || 0}</td>
                </tr>
              </table>
            </div> 
            
            <div class="col-md-6 col-lg-4">
              <br>
              <h5 style='line-height:0;'>short description</h5>
                <p style='line-height:0;'>${response.product.short_description}</p>
              <h5 style='line-height:0;'>long description</h5>
                <p style='line-height:0;'>${response.product.long_description}</p>
            </div>
            <div class="col-md-6 col-lg-4">
              <p class="text-center">review section</p>
              <div id='reviewContainer'>
              
              </div>
            </div>
          </div>
        `;
            
            
        response.category_product.forEach(function(subcategory,index) {
          $('#subcategory').append(`
            <tr><td>subcategory</td><td> : ${subcategory.product_subcategories.name}</td></tr>
          `);
        });
        
        $.each(response.product_reviews, function(index, review_row) {
          
          let starrat = '';
          for (let j = 1; j <= review_row.rating; j++) {
            starrat += "<i style='color:#e8f411ff;' class='bi bi-star-fill'></i>";
          }
          
          $('#reviewContainer').append(`
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
                    <img src='/storage/${review_row.user.image}'
                         style='height:100px; width:auto; margin-top:10px;'
                         class='img-fluid rounded-start' 
                         alt='...'>
                </div>
                <div class="col-10">
                  <div class="card-body" style='position:relative;'>
                    <p class="card-text product-name" style='margin-top:-14px;' data-product-id="">
                    ${review_row.user.name}</p>
                    <p style=' margin-top:-15px;'><span>${starrat}</span>${review_row.created_at
                    ? review_row.created_at : 'N/A'}</p>
                    <p style=' margin-top:-10px;
                    margin-bottom:-10px;'>
                      ${review_row.review.substring(0,70)}...
                      <button class='buttonText see-more-btn' 
                        data-full="${review_row.review}" 
                        data-short="${review_row.review.substring(0,70)}"
                      >see more</button>
                    </p>
                    <div id='img_review_${review_row.id}'
                    class='mt-3'></div> 
                  </div>
                </div>
              </div>
            </div>
          `);
          
          $('#img_review_'+review_row.id).html('');
          $.each(review_row.product_review_img, function(index,review_img_row) {
              $('#img_review_'+review_img_row.id).append(`
                <img src='/storage/${review_img_row.img}' height='100'>
              `);
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
          
      },
      error:function(xhr,status,errors){
        alert(xhr.responseText);
        console.log(xhr.responseText);
      }
    });
  }
    