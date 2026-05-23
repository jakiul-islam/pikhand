    window.logininput = function(){
      let loginEmail = document.getElementById('loginEmail');
      let password = document.getElementById('loginPassword');
      let LoginSubmit = document.getElementById('LoginSubmit');

      if( loginEmail.value.length > 5 && password.value.length > 3){
        LoginSubmit.disabled = false ;
      }else{
        LoginSubmit.disabled =true;
      }
    }
    //user Login
    window.userLOgin = function(){


      const email =$('#loginEmail').val();
      const password = $('#loginPassword').val();
      let sessionDashbordLink  = document.getElementById('sessionDashbordLink');

      let formData = new FormData();
        formData.append('email', email );
        formData.append('password', password );
        detailsDataAjax('/user/login',formData,'post','userDeshboard','Nan','LoginSubmit','LOGIN','loginForm');
    }
    //logout user
    window.Logout = function (){
      fetchDataAjax('/user/logout','POST','LogoutSuccess','Nan');
    }
    window.LogoutSuccess = function(respons){
      location.reload();
    }
    window.backFormLogout = function() {
      $("#userInfo").html(originalContent);

        let sessionDashbordLink = document.getElementById('sessionDashbordLink');
        let DashbordLink        = document.getElementById('DashbordLink');
          sessionDashbordLink.style.display='none';
          DashbordLink.style.display='block';

          DashbordLink.innerHTML= `
            <button class="justify-content-end btn btn-outline-success"
                  style='margin-top:-10px;margin-bottom:5px;'
                  onclick='loginOrsignup();'> LOGIN/SIGNUP </button>
          `;
    };
