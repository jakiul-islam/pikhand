  function index(page = 1){
    let search_input    = document.getElementById('search_input').value;
    let select          = document.getElementById('select').value;
    let time            = document.getElementById('time').value;
   
    let formData = new FormData();
    formData.append('page', page);
    formData.append('search_input', search_input);
    formData.append('select', select);
    formData.append('time', time);
    
    detailsDataAjax('/admin/review/index',formData,'post','reviewIndexData','Nan','Nan','Nan','Nan');
  }
  index();
  function reviewIndexData(response){
    
    $('#showUser').html(''); // পুরানো ডাটা মুছে ফেলবে
    $.each(response.product_reviews.data, function(index, product_reviews) {
      let showUser = true;
      if(showUser){
        $('#showUser').append(`
          <tr>
            <td>${product_reviews.id}</td>
            <td>${product_reviews.user.name}</td>
            <td>${product_reviews.user.phone_number}</td>
            <td>${product_reviews.product.name}</td>
            <td id='ratingStar${product_reviews.id}' style='width:200px;'></td>
            <td>${product_reviews.title ? product_reviews.title : 'N/A'}</td>
            <td>${product_reviews.review.substring(0, 20)}</td>
            <td>${product_reviews.status}</td>
            <td>${product_reviews.created_at}</td>
            <td>${product_reviews.updated_at}</td>
            <td><button onclick="Reviewsdeteils( '${product_reviews.id}' )"><i class='bi bi-eye'></i></button>
            <button onclick="editeReviewinput( '${product_reviews.id}' )" ><i class='bi bi-pencil'></i></button>
          </tr>
        `);
        
        
        
        
        $('#ratingStar'+product_reviews.id).html(''); 
        
        for( let i = 1; product_reviews.rating >= i;  i ++ ) {
          $('#ratingStar'+product_reviews.id).append(`
            <i class='bi bi-star-fill' style='color:#efff24ff;'></i>
          `);
        };
      }
    });
    
    renderPagination(response.product_reviews);
    
    
  }
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
    

  function Reviewsdeteils( Reviewsid ){
    window.originalContent1 = $("#maindiv").html();
    let maindiv = document.getElementById('maindiv');
    let webLogo = document.getElementById('webLogo').value;
    
    
    let formData = new FormData();
      formData.append('Reviewsid', Reviewsid);

    
    $.ajax({
      url: "/admin/Reviewdeteils",  
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.ststus){
          
          maindiv.innerHTML=`
            <button class='buttonText' onclick='ordertable()'><i class='bi bi-arrow-left'></i></button>
            <img src='/storage/${webLogo}' style='margin:auto;
            display:flex; '>
            <div class='row'>
              <div class='col-md-6' class='orderdeteilsUserInfo' style='line-height:1;'>
                <h4 class='text-center'>User info</h4>
                <table>
                  <tr><td>name </td><td> : ${response.reviews_user.name}</td></tr>
                  <tr><td>number </td><td> : ${response.reviews_user.Phonenumber}</td></tr>
                  <tr><td>email </td><td> : ${ response.reviews_user.email ? response.reviews_user.email : 'N/A' }</td></tr>
                  <tr><td>country </td><td> : ${response.reviews_user.country}</td></tr>
                </table>
              </div>
              <div class='col-md-6' id='orderdeteilsUserInfo' class='orderdeteilsUserInfo' style='line-height:1;'>
                <h4 class='text-center'>product info</h4>
                <table>
                  <tr><td>name </td><td> : ${response.reviews_products.name}</td></tr>
                  <tr><td>price </td><td> : ${response.reviews_products.price}</td></tr>
                  <tr><td>discount </td><td> : ${ response.reviews_products.discount}</td></tr>
                  <tr><td>total_sales </td><td> : ${response.reviews_products.total_sales}</td></tr>
                  <tr><td>total reviews </td><td> : ${response.product_reviews_count}</td></tr>
                </table>
              </div>
              <div style='overflow:auto;' id='tableDiv'>
                <h4 class='text-center'>Review info</h4>
                <p id='reviewstar' style='line-height:0.3;'></p>
                <p style='line-height:0.3;'>title : ${response.product_reviews.title ? response.product_reviews.title : 'N/A'}</p>
                <p>${response.product_reviews.review ? response.product_reviews.review : 'N/A'}</p>
                <div id='reviewImgdiv'></div>
              </div>
            </div>
          `;
         
          $('#reviewstar').html(''); // পুরানো ডাটা মুছে ফেলবে
          
          for( let i = 1; response.product_reviews.rating >= i;  i ++ ) {
            $('#reviewstar').append(`
              <i class='bi bi-star-fill' style='color:#efff24ff;'></i>
            `);
          };
          
          $('#reviewImgdiv').html('');
          $.each(response.product_review_img, function(index, product_review_img) {
            $('#reviewImgdiv').append(`
              <img src='/storage/${product_review_img.img}' height='100'
              style='margin-top:10px;'>
            `);
          });
          
          
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  
  function editeReviewinput( Reviewsid ){
    window.originalContent1 = $("#maindiv").html();
    let maindiv = document.getElementById('maindiv');
    let webLogo = document.getElementById('webLogo').value;
    
    
    let formData = new FormData();
      formData.append('Reviewsid', Reviewsid);

    
    $.ajax({
      url: "/admin/Reviewdeteils",  
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.ststus){
          
          maindiv.innerHTML=`
            <button class='buttonText' onclick='ordertable()'><i class='bi bi-arrow-left'></i></button>
            <img src='/storage/${webLogo}' style='margin:auto; display:flex; '>
              <div class='row'>
                <div class="ratting-div" id='ratting_div'>
                  <i class="bi bi-star" id="star-1" onmouseover="starmous( '1' );"></i>
                  <i class="bi bi-star" id="star-2" onmouseover="starmous( '2' );"></i>
                  <i class="bi bi-star" id="star-3" onmouseover="starmous( '3' );"></i>
                  <i class="bi bi-star" id="star-4" onmouseover="starmous( '4' );"></i>
                  <i class="bi bi-star" id="star-5" onmouseover="starmous( '5' );"></i>
                  <p id="showstarret"></p>
                  <input type="hidden" id="showstarinput">
                  <textarea style="width:100%;" rows="3" id="Rattingtextarea">${response.product_reviews.review}</textarea>
                  <input type="hidden" id="reviewId" value="${response.product_reviews.id}">
                  <br>
                  <button class="btn btn-success" onclick="editereview();"
                  id="editrating">edit rating</button>
                  <div id='reviewImgdiv'></div>
                </div>
              </div>
            `;
          
          
          starmous( response.product_reviews.rating );
          
          
          $('#reviewImgdiv').html('');
          $.each(response.product_review_img, function(index, product_review_img) {
            $('#reviewImgdiv').append(`
              <div class='review_img'>
                <button id='img_delete${product_review_img.id}' class='img_delete' onclick="reviewImgdelete('${product_review_img.id}');">delete</button>
                <img id='img${product_review_img.id}' src='/storage/${product_review_img.img}' height='100'
                style='margin-top:10px;'>
              </div>
            `);
          });
          
          
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  
  //product reviews img
  function reviewImgdelete( id ){
    const img_delete =document.querySelector("#img_delete"+id);
    const img =document.querySelector("#img"+id);
    img_delete.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    img_delete.disabled = true;

 
    let formData = new FormData();
    formData.append('reviewId', id );


    $.ajax({
      url:"/admin/ReviewImgdelete",
      type:"POST",
      processData:false,
      contentType:false,
      data:formData,
      headers:{
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response){
        img_delete.innerHTML="delete";
        img_delete.disabled = false;
        img.style.display='none';
        img_delete.style.display='none';
        showalert( 'review img deleted successfull ' , '#ffffff', 'alert_div' );
      },
      error:function(xhr,status,errors){
        console.log(xhr.responseText);
        img_delete.innerHTML="delete";
        img_delete.disabled = false;
        showalert( 'Review edit failed!' , '#ffffff', 'alert_div' );
      }
    });
  }
  
  //edit review
  function editereview(){
    const editrating =document.querySelector("#editrating");
    editrating.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    editrating.disabled = true;

    let showstarinput   = document.getElementById('showstarinput').value;
    let Rattingtextarea = document.getElementById('Rattingtextarea').value;
    let reviewId       = document.getElementById('reviewId').value;

 
    let formData = new FormData();
    formData.append('showstarinput', showstarinput );
    formData.append('Rattingtextarea', Rattingtextarea );
    formData.append('reviewId', reviewId );


    $.ajax({
      url:"/admin/editReview",
      type:"POST",
      processData:false,
      contentType:false,
      data:formData,
      headers:{
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response){
        editrating.innerHTML="edit rating";
        editrating.disabled = false;
        showalert( 'review edit successfull ' , '#ffffff', 'alert_div' );
      },
      error:function(xhr,status,errors){
        console.log(xhr.responseText);
        editrating.innerHTML="edit rating";
        editrating.disabled = false;
        showalert( 'Review edit failed!' , '#ffffff', 'alert_div' );
      }
    });
  }
        
  function starmous( starnumber ){
    let showstarret =document.getElementById('showstarret');
    let showstarinput =document.getElementById('showstarinput');
  
    for (let j = 1; j <= 5; j++) {
      let star = document.getElementById('star-'+j);
      star.classList.remove("bi-star-fill");
      star.classList.add("bi-star");
    }
    
    for (let i = 1; i <= starnumber; i++) {
      let star = document.getElementById('star-'+i);
      star.classList.remove("bi-star");
      star.classList.add("bi-star-fill");
      showstarret.innerText=`Your ratting is ${i} star`;
      showstarinput.value= i ;
    }
  }

    window.ordertable = function() {
      $("#maindiv").html(originalContent1);
    };