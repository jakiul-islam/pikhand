 window.userDeshboard = function(){
    fetchDataAjax('/user/session/chack','POST','userDeshboardData','Nan');
  }

  window.userDeshboardData = function ( response ){
    
    let  userDeshbordShow  = document.getElementById('userInfo');
    if(response.status){
      
      gestCartDataCreate();
      
      userDeshbordShow.innerHTML=`
      <div style='overflow-y:auto; overflow-x:hidden;'>
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div style="margin: 0;">
           <button onclick='backFromuserDeshbord();' style='background:none; border:none; font-size:22px;'><i class="bi bi-arrow-left"></i></button>
          </div>
          <div style="margin: 0;">
            <button onclick='sattingPage()' style='background:none; border:none; font-size:22px;'><i class="bi bi-gear"></i></button>
            <button id='loguotButton' onclick='Logout();' style='background:none; border:none; font-size:22px;'><i class="bi bi-box-arrow-right"></i></button>
          </div>
        </div>




      <div style="display: flex; align-items: center;">
        <div style="height: 70px; width: 70px; margin: 10px;  border-radius: 50%; position: relative;">
          <img src="/storage/" style='height:70px; width:70px; border-radius: 50%;' id='user_profile'>

          <div style='position: absolute; top: 55px; left: 55px; transform: translate(-50%, -50%);'>
            <div style='position:relative; '>
              <i class="bi bi-camera-fill" style=" color: red;"></i>
              <input type='file' id='profile_input' oninput='createUserProfile()' style='opacity: 0;  width:100%; position:absolute; transform: scale(3);'>
            </div>
          </div>
        </div>
        <div>
          <h2  id='UserName' style="line-height: 1; margin:0;">${response.user.name}</h2>
          <small id='UserEmail'>${response.user.email ? response.user.email :
          'N/A'}</small>
        </div>
      </div>


      <div>

        <div style="display: flex; justify-content: space-between; align-items: center;">
          <h3 style="margin: 3px;">My order</h3>
          <p style="margin: 3px;" onclick="Allordershow( 'All' );">All my order</p>
        </div>

        <div class="row">
          <div class="col-3" onclick="Allordershow( 'processing' );">
            <div class="text-center" ><i class="bi bi-credit-card-2-back" style='color:#FF5F5F; font-size:40px; line-height:0;'></i></div>
            <p class="text-center">To pay</p>
          </div>
          <div class="col-3" onclick="Allordershow( 'shipped' );" >
            <div class="text-center"><i class="bi bi-truck-front-fill "
            style='font-size:40px; line-height:0; color:#FF5F5F;'></i></div>
            <p class="text-center">To Ship</p>
          </div>
          <div class="col-3" onclick="Allordershow( 'review' );" >
            <div class="text-center"><i class="bi bi-layout-sidebar-reverse " style='color:#FF5F5F; font-size:40px; line-height:0;'></i></div>
            <p class="text-center">To review</p>
          </div>
          <div class="col-3" onclick="Allordershow( 'refunded' );" >
            <div class="text-center"><i class="bi bi-box-seam-fill" style='color:#FF5F5F; font-size:40px; line-height:0;'></i></div>
            <p class="text-center">To return</p>
          </div>
        </div>
      </div>

      <div class='' style=' height:auto; width:100%;'>
        <div class="row" style='margin:7px; padding:5px; background-color:#E7E7E7;
        border-radius:10px;'>
          <div class="col-3">
            <a class="text-center nav-link">
              <p style=' font-size:30px; line-height:0; margin-top:20px;'>💌</p>
              <p style='line-height:1;'>My massage</p>
            </a>
          </div>
          <div class="col-3">
            <a class="text-center nav-link">
              <p style=' font-size:30px; line-height:0; margin-top:20px;'>📦</p>
              <p style='line-height:1;'>By any 4</p>
            </a>
          </div>
           <div class="col-3">
            <a class="text-center nav-link" href='/All-PRODUCTS'>
              <p style=' font-size:30px; line-height:0; margin-top:20px;'>🏭</p>
              <p style='line-height:1;'>Market look</p>
            </a>
          </div>
          <div class="col-3">
            <a class="text-center nav-link" href='/affiliate'>
              <p style=' font-size:30px; line-height:0; margin-top:20px;'>🖇️</p>
              <p style='line-height:1;'>My affilete</p>
            </a>
          </div>
          <div class="col-3">
            <a class="text-center nav-link" href='/help'>
              <p style=' font-size:30px; line-height:0; margin-top:20px;'>🛠️</p>
              <p style='line-height:1;'>Halp center</p>
            </a>
          </div>
          <div class="col-3">
            <a class="text-center nav-link">
              <p style=' font-size:30px; line-height:0; margin-top:20px;'>☎️</p>
              <p style='line-height:1;'>Contoct costomer care</p>
            </a>
          </div>
           <div class="col-3">
            <a class="text-center nav-link" href='/feedback'>
              <p style=' font-size:30px; line-height:0; margin-top:20px;'>🎖️</i>
              <p style='line-height:1;'>My review</p>
            </a>
          </div>
          <div class="col-3">
            <a class="text-center nav-link" href='/payment-option'>
              <i class="bi bi-box-seam-fill" style=' font-size:30px; line-height:0;'></i>
              <p style='line-height:1;'>Payment option</p>
            </a>
          </div>

        </div>
      </div>

      </div>
      `;
      
     
      $("#loginOrnotFor").val(response.user.uuid); 
      let loginOrnotFor = document.getElementById("loginOrnotFor").value;


      console.log($("#loginOrnotFor").length);

      
      alert(useruuuid);
      alert(response.user.uuid);
      
      FetchCarts();
      
      var modal = bootstrap.Modal.getInstance($('#loginForm')[0]);
            modal.hide();
      
      var modalEl = document.getElementById('loginForm');
      var modal = bootstrap.Modal.getInstance(modalEl);
      
      if (modal && modal._isShown) {
          modal.hide();
      }
      
    }else{
      showalert('Internal server error ','#ffffff','showalert');
    }
  }
  //insert_profile
  window.createUserProfile = function (){
    let formData = new FormData();
    formData.append('profile_input', $('#profile_input')[0].files[0]);
    sendDataAjax('/user/profile/create',formData,'post','userDeshboard','Nan','Nan','Nan','Nan');
  }


  window.backFromuserDeshbord = function() {
    $("#userInfo").html(originalContent);
    let sessionDashbordLink = document.getElementById('sessionDashbordLink');
    let DashbordLink        = document.getElementById('DashbordLink');
    sessionDashbordLink.style.display='none';
    DashbordLink.style.display='block';

    DashbordLink.innerHTML= `<button class="justify-content-end btn
    btn-outline-success" style='margin-top:-10px;margin-bottom:5px;'
    onclick='userDeshboard();'> your profile </button>`;
  };
