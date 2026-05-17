  Fetchfeedback()
  function starFill( starNumber  ){
    let showRattingNumber = document.getElementById('showRattingNumber');
    let starinput     = document.getElementById('star');
    for (let j = 1; j <= 5; j++) {
      let star = document.getElementById('star_'+j);
      star.classList.remove("bi-star-fill");
      star.classList.add("bi-star");
    }
    
    for (let i = 1; i <= starNumber; i++) {
      let star = document.getElementById('star_'+i);
      star.classList.remove("bi-star");
      star.classList.add("bi-star-fill");
      starinput.value= i ;
      
      if(starNumber == 1){
        showRattingNumber.innerText=`😞 Disappointed `;
      }else if( starNumber == 2 ){
        showRattingNumber.innerText=`😐 Needs Improvement `;
      }else if(starNumber == 3){
        showRattingNumber.innerText=`🙂 Okay`;
      }else if(starNumber == 4){
        showRattingNumber.innerText=`😊 Good Job`;
      }else{
         showRattingNumber.innerText=`🤩 Loved It!`;
      }
    }
  }
  function insertFeedback(){
    let name                        = document.getElementById('name').value;
    let email                       = document.getElementById('email').value;
    let star                        = document.getElementById('star').value;
    let message                     = document.getElementById('message').value;
    
    let formData = new FormData();
      formData.append('name', name );
      formData.append('email', email );
      formData.append('star', star );
      formData.append('message', message );
     sendDataAjax('/feedback/create',formData,'post','Fetchfeedback','Nan','Feedbackbutton','Submit Feedback','Nan');
  }

  //function LoginNumberValidation(){
  let login_number = document.getElementById('login_number');
  let LoginSubmit  = document.getElementById('LoginSubmit');
  let password     = document.getElementById('password');
    
  if(login_number){
    const iti = window.intlTelInput(login_number, {
    initialCountry: "auto",
      geoIpLookup: function(success) {
        fetch("https://ipapi.co/json")
          .then(res => res.json())
          .then(data => success(data.country_code))
          .catch(() => success("US"));
      },
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
  
    login_number.addEventListener("input", () => {
      if (iti.isValidNumber()) {
        message.textContent = "";
       // LoginSubmit.disabled = false;
      } else {
        message.textContent = "Please enter a valid phone number.";
        LoginSubmit.disabled = true;
      }
    });
  }
  // LoginNumberValidation();
 
  function feedbackuserLOgin(){
    const login_number =$('#login_number').val();
    const password = $('#password').val();
    let formData = new FormData();
      formData.append('login_number', login_number );
      formData.append('password', password );
      
      sendDataAjax('/user/login',formData,'post','feedbackuserLOginSuccess','Nan','LoginSubmit','LOGIN','Nan');
  }
  function feedbackuserLOginSuccess(){
    window.location.href='/feedback';
  }
  // fetch all feedback
     
  function Fetchfeedback(){
    let ShowFeedbackForm = document.getElementById('ShowFeedbackForm');
    let ShowAllFeedback = document.getElementById('ShowAllFeedback');
    let editFeedbackButton = document.getElementById('editFeedbackButton');
      $.ajax({
        url : '/feedback/index',
        type :'POST',
        processData: false,
        contentType: false,
        //data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          if(response.ThisUserFeedbackCount > 0){
            
            ShowAllFeedback.style.display='block';
            ShowFeedbackForm.style.display='none';
            editFeedbackButton.style.display='block';
            editFeedbackButton.innerText='Edit your feedback';
            
            
             $('#name').val(response.ThisUserFeedbackFetch.name);
            $('#email').val(response.ThisUserFeedbackFetch.email);
           // $('#star').val('response.ThisUserFeedbackFetch.ratingNumber');
            $('#message').val(response.ThisUserFeedbackFetch.massage);
            starFill( response.ThisUserFeedbackFetch.ratingNumber  );
            $('.showFeedback').html('');
            
            
            let yourstarrat = '';
              for (let i = 1; i <= response.ThisUserFeedbackFetch.ratingNumber; i++) {
                yourstarrat += "<i class='bi bi-star-fill'></i>";
              }
            
              let thisuserprofile = '';
              $.each(response.Allusersprofile, function(index, Allusersprofile) {
                if(response.ThisUserFeedbackFetch.user_id == Allusersprofile.user_id){
                  let profileSrc = Allusersprofile.profile_picture 
                    ? `/storage/${Allusersprofile.profile_picture}` 
                    : '/storage/logo/20251007_184157.jpg';
                    
                  thisuserprofile += `<img 
                    src="${profileSrc}" 
                    style="height:auto; width:auto; margin-top:10px;" 
                    class="img-fluid rounded-start" 
                    alt="...">`;
                }
              });
              
            
              $('.showFeedback').append(`
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
                      ${thisuserprofile ? thisuserprofile : `<img 
                         src='/storage/logo/20251007_184157.jpg'
                         style='height:auto; width:auto; margin-top:10px;'
                         class='img-fluid rounded-start' 
                         alt='...'>`}
                    </div>
                    <div class="col-10">
                      <div class="card-body" style='position:relative;'>
                        <p class="card-text product-name"
                        style='margin-top:-14px;'
                        data-product-id=""></p>
                        <p
                        style='line-height:0;'>you</p>
                        <p
                        style='line-height:1;'>${response.ThisUserFeedbackFetch.email}</p>
                        <p style='line-height:1; margin-top:-5px;'>
                          ${yourstarrat}${response.ThisUserFeedbackFetch.created_at}
                        </p>
                        <p style=' margin-top:-10px; margin-bottom:-10px;'>
                          ${response.ThisUserFeedbackFetch.massage.substring(0, 70)}...
                          <button class='buttonText see-more-btn' 
                            data-full="${response.ThisUserFeedbackFetch.massage}" 
                            data-short="${response.ThisUserFeedbackFetch.massage.substring(0, 70)}..."
                          >see more</button>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              `); 
          
            
            $.each(response.AllFeedback, function(index, feedback) {
              let starrat = '';
              for (let j = 1; j <= feedback.ratingNumber; j++) {
                starrat += "<i class='bi bi-star-fill'></i>";
              }
              
              let userprofile = '';
              $.each(response.Allusersprofile, function(index, Allusersprofile) {
                if(feedback.user_id == Allusersprofile.user_id){
                   let allprofileSrc = Allusersprofile.profile_picture 
                    ? `/storage/${Allusersprofile.profile_picture}` 
                    : '/storage/logo/20251007_184157.jpg';
                    
                  userprofile += `<img 
                    src="${allprofileSrc}" 
                    style="height:auto; width:auto; margin-top:10px;" 
                    class="img-fluid rounded-start" 
                    alt="...">`;
                }
              });
              
              
              $('.showFeedback').append(`
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
                    
                       ${userprofile
                        ? userprofile 
                        : `<img 
                             src='/storage/logo/20251007_184157.jpg'
                             style='height:auto; width:auto; margin-top:10px;'
                             class='img-fluid rounded-start' 
                             alt='...'>`}
                    </div>
                    <div class="col-10">
                      <div class="card-body" style='position:relative;'>
                        <p class="card-text product-name"
                        style='margin-top:-14px;'
                        data-product-id=""></p>
                        <p style='line-height:0;'>${feedback.name}</p>
                        <p style='line-height:1;'>${feedback.email}</p>
                        <p style='line-height:1; margin-top:-5px;'>
                          ${starrat}${feedback.created_at}
                        </p>
                        <p style=' margin-top:-10px; margin-bottom:-10px;'>
                          ${feedback.massage.substring(0, 70)}...
                          <button class='buttonText see-more-btn' 
                            data-full="${feedback.massage}" 
                            data-short="${feedback.massage.substring(0, 70)}..."
                          >see more</button>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              `); 
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
            if(ShowAllFeedback){
              ShowAllFeedback.style.display='block';
            }
            if(ShowAllFeedback){
              ShowFeedbackForm.style.display='block';
            }
            if(ShowAllFeedback){
              editFeedbackButton.style.display='none';
            }
          }
        },
        error:function(xhr,status,error){
          let response = JSON.parse(xhr.responseText);
         // showalert('Login failed, try again!' , '#ffffff' ,'showallalert');
        },
      });
  }
  
  function editFeedback(){
    let ShowFeedbackForm    = document.getElementById('ShowFeedbackForm');
    let editFeedbackButton  = document.getElementById('editFeedbackButton');
    if(ShowFeedbackForm.style.display == 'none'){
      editFeedbackButton.innerText='close';
      ShowFeedbackForm.style.display='block';
    }else{
      editFeedbackButton.innerText='Edit your feedback';
      ShowFeedbackForm.style.display='none';
    }
  }
    
  function FetchfeedbackForlogout(){
    $.ajax({
      url : '/feedback/index',
      type :'POST',
      processData: false,
      contentType: false,
      //data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        $('.loginshowFeedback').html('');
        $.each(response.AllFeedback, function(index, feedback) {
          let starrat = '';
          for (let j = 1; j <= feedback.ratingNumber; j++) {
            starrat += "<i class='bi bi-star-fill'></i>";
          }
          
          let logoutUserProfile = '';
          $.each(response.Allusersprofile, function(index, Allusersprofile) {
            if(feedback.user_id == Allusersprofile.user_id){
              let LogoutprofileSrc = Allusersprofile.profile_picture 
                ? `/storage/${Allusersprofile.profile_picture}` 
                : '/storage/logo/20251007_184157.jpg';
                
              logoutUserProfile += `<img 
                src="${LogoutprofileSrc}" 
                style="height:auto; width:auto; margin-top:10px;" 
                class="img-fluid rounded-start" 
                alt="...">`;
            }
          });
          
          
          $('.loginshowFeedback').append(`
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
                  ${logoutUserProfile
                    ? logoutUserProfile 
                    : `<img 
                         src='/storage/logo/20251007_184157.jpg'
                         style='height:auto; width:auto; margin-top:10px;'
                         class='img-fluid rounded-start' 
                         alt='...'>`}
                </div>
                <div class="col-10">
                  <div class="card-body" style='position:relative;'>
                    <p class="card-text product-name"
                    style='margin-top:-14px;'
                    data-product-id=""></p>
                    <p style='line-height:0;'>${feedback.name}</p>
                    <p style='line-height:1;'>${feedback.email}</p>
                    <p style='line-height:1; margin-top:-5px;'>
                      ${starrat}${feedback.created_at}
                    </p>
                    <p style=' margin-top:-10px; margin-bottom:-10px;'>
                      ${feedback.massage.substring(0, 70)}...
                      <button class='buttonText see-more-btn' 
                        data-full="${feedback.massage}" 
                        data-short="${feedback.massage.substring(0, 70)}..."
                      >see more</button>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          `); 
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
      error:function(xhr,status,error){
        let response = JSON.parse(xhr.responseText);
       // showalert('Login failed, try again!' , '#ffffff' ,'showallalert');
      },
    });
  }
  FetchfeedbackForlogout()
    