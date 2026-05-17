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

  function sendratting(){
    let showstarinput   = document.getElementById('showstarinput').value;
    let Rattingtextarea = document.getElementById('Rattingtextarea').value;
    let myltipulImg     = document.getElementById('myltipulImg');
    let ProductId       = document.getElementById('ProductId').value;
    let previewContainer     = document.getElementById('previewContainer');
    
    let formData = new FormData();
    formData.append('showstarinput', showstarinput );
    formData.append('Rattingtextarea', Rattingtextarea );
    formData.append('ProductId', ProductId );
    for (let i = 0; i < myltipulImg.files.length; i++) {
      formData.append('myltipulImg[]', myltipulImg.files[i]);
    }
    sendDataAjax('/user/rating/create',formData,'post','Nan','Nan','addratingphotobutton','Send Your ratting','Nan');
  }
  raingIndex();
  
  function raingIndex(){
    let ProductId            = document.getElementById('ProductId').value;
    let show_rating          = document.getElementById('show_rating');
    let ratting_div          = document.getElementById('ratting_div');
    let previewContainer     = document.getElementById('previewContainer');
    
    let formData = new FormData();
    formData.append('ProductId', ProductId );

    $.ajax({
      url : "/user/rating/index",
      type:"POST",
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response) {
        if(response.ratingcount > 0){
          ratting_div.style.display='none';
          show_rating.innerHTML =  `
            <div class='rating-show-div'>
              <img id='userprofile' src='/storage/logo/20251007_184157.jpg'>
              <div>
                <h6 id='userName' ></h6>
                <span id='star_show'></span>
                <div>${response.rating.review.substring(0, 70)}...
                  <button class='buttonText see-more-btn' 
                    data-full="${response.rating.review}" 
                    data-short="${response.rating.review.substring(0, 70)}..."
                  >see more</button>
                </div>
                <div id='reviewImgDiv'></div>
              </div>
            </div>
            
          <button class="btn btn-success reviewseditbutton"
          onclick="editFormShow();"
          id="editFormShowbutton">Edit your reviews</button>
            
          `;
          
          let star_show = document.getElementById('star_show');
          for (let j = 1; j <= response.rating.rating; j++) {
            star_show.append(`
              ⭐  
            `);
          }
          star_show.append(`${response.rating.created_at}`);
          
          
          let userprofile = document.getElementById('userprofile');
          $.each(response.userProfile, function(index, profile) {
            if( profile.user_id == response.rating.user_id ){
              userprofile.src=`/storage/${profile.profile_picture}`;
            }
          })
        
          //this user name show 
          let userName = document.getElementById('userName');
          $.each(response.user, function(index, user) {
            if( user.id == response.rating.user_id ){
              userName.innerHTML=`${user.name}`;
            }
          })
        
          previewContainer.style.display = ' block';
          $('#previewContainer').html('');
          $.each(response.rating_img, function(index, img) {
              if( img.reviews_id == response.rating.id ){
                $('#reviewImgDiv').append(`
                  <img src='/storage/${img.img}'>
                `);
                
                $('#previewContainer').append(`
                  <img src='/storage/${img.img}'>
                `);
              }
            })
            
          let showstarinput   = document.getElementById('showstarinput').value;
          let Rattingtextarea = document.getElementById('Rattingtextarea').value;
          let myltipulImg     = document.getElementById('myltipulImg');
          
          $('#showstarinput').val(response.rating.rating);
          $('#Rattingtextarea').val(response.rating.review);
          starmous( response.rating.rating );
        }
        //all reviews show
        let starCount = 0;
        $.each(response.Allrating, function(index, Rating) {
          starCount += Rating.rating;
        })
          
        $('#show_rating').append(`
          <br>
          <br>
          <div class='ratingCount'>
            <h3>All review
            (${response.Allratingcount})</h3>
            <h3> ${  starCount / response.Allratingcount}  ⭐  </h3>
          </div>
        `);
        $.each(response.Allrating, function(index, Rating) {
          $('#show_rating').append(`
            <div class='rating-show-div'>
              <img id='userprofile${Rating.id}'
              src='/storage/logo/20251007_184157.jpg'>
              <div>
                <h6 id='userName${Rating.id}'></h6>
                <span id='star_show${Rating.id}'></span>
                <div>${Rating.review.substring(0, 70)}...
                  <button class='buttonText see-more-btn' 
                    data-full="${Rating.review}" 
                    data-short="${Rating.review.substring(0, 70)}..."
                  >see more</button>
                </div>
                <div id='reviewImgDiv${Rating.id}'></div>
              </div>
            </div>
          `)
          //user name 
          let AlluserName =
          document.getElementById('userName'+Rating.id);
          $.each(response.user, function(index, Alluser) {
            if( Alluser.id == Rating.user_id ){
              AlluserName.innerHTML=`${Alluser.name}`;
            }
          })
          //show star rating 
          let star_show = document.getElementById('star_show'+Rating.id);
          for (let j = 1; j <= Rating.rating; j++) {
            star_show.append(`
              ⭐  
            `);
          }
          star_show.append(`${ Rating.created_at}`);
          //all user profile 
          let Alluserprofile = document.getElementById('userprofile'+Rating.id);
          $.each(response.userProfile, function(index, Allprofile) {
            if( Allprofile.user_id == Rating.user_id ){
              Alluserprofile.src=`/storage/${Allprofile.profile_picture}`;
            }
          })
          //all ratimg img 
          $.each(response.rating_img, function(index, ratingimg) {
            if( ratingimg.reviews_id == Rating.id ){
              $('#reviewImgDiv'+Rating.id).append(`
                <img src='/storage/${ratingimg.img}'>
              `);
            }
          })
        })
        //full and short massage show 
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
        
      }
    }); 
  }

  
  
  function myltipulImg(){
    const files = event.target.files;
    const previewContainer =document.getElementById('previewContainer');
   // const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = "";
     previewContainer.style.display='block';
    if (files.length > 0) {
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {

                const wrapper = document.createElement('div');
            wrapper.style.position = 'relative';
            wrapper.style.display = 'inline-block';
          //  wrapper.style.margin = 'px';

            // image
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.height = '80px';
            img.style.width = '80px';
            img.style.border = "1px solid #ccc";
            img.style.borderRadius = "5px";

            // close button
            const closeBtn = document.createElement('span');
            closeBtn.innerHTML = '&times;'; // X sign
            closeBtn.style.position = 'absolute';
            closeBtn.style.top = '2px';
            closeBtn.style.right = '5px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.style.color = 'red';
            closeBtn.style.fontSize = '20px';
            closeBtn.style.fontWeight = 'bold';
            closeBtn.style.padding = '0 5px';

            // remove image on click
            closeBtn.addEventListener('click', function() {
                wrapper.remove();
            });

            // append
            wrapper.appendChild(img);
            wrapper.appendChild(closeBtn);
            previewContainer.appendChild(wrapper);
              
                  };
            reader.readAsDataURL(file);
        });
    }
  }
  
  function editFormShow(){
    let editFormShowbutton = document.getElementById('editFormShowbutton');
    let ratting_div = document.getElementById('ratting_div');
    
    editFormShowbutton.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    editFormShowbutton.disabled = true;
    
    if(ratting_div.style.display=='none'){
      ratting_div.style.display='block';
      editFormShowbutton.innerHTML = `Close`;
      editFormShowbutton.disabled = false;
    }else{
      ratting_div.style.display='none';
      editFormShowbutton.innerHTML = `Edit your reviews`;
      editFormShowbutton.disabled = false;
    }
  }
  