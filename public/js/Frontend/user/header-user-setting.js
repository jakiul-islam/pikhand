  window.originalContent = $("#userInfo").html();

    window.loginOrsignup = function(){
      let webLogoForUseScript = document.getElementById('webLogoForUseScript').value;

        let googleLoginUrl = "{{ route('auth.google') }}";



      const loginOrsignupBody =document.getElementById('userInfo');
      loginOrsignupBody.innerHTML =`
        <button onclick='back();' style=' background:none; border:none;
        width:60px;'><i style='font-size:25px;' class="bi
        bi-arrow-left"></i></button>

         <div style='height:auto; width:320px; overflow:auto; margin:auto; padding:10px; background-color:#C4E9FF;'>

            <img src="/storage/${webLogoForUseScript}" alt="Picklet Logo"
            class='logoCenter' >

            <div class="row">
              <div class="col-6 text-center" onclick='loginst();'>
                <p style='font-size:30px; line-height:0.4; margin-top:10px;'>LOGIN</p>
                <div style='height:3px; background-color:black;' id='Logindivbar'></div>
              </div>
              <div class="col-6 text-center"  onclick='signupst()'>
               <p style='font-size:30px; line-height:0.4; margin-top:10px;'>SIGNUP</p>
               <div style='height:3px; background-color:black; display:none;' id='signdivbar'></div>
              </div>
            </div>


            <br>
            <div id='showform'>

               <h6>email</h6>
                <input type='email' style='width:300px;' id='loginEmail' oninput='logininput();' class='form-control' placeholder='Enter your email name'>
                <h6>Password</h6>

                <div class="input-group mb-3">
                  <input type="password" id='loginPassword' oninput='logininput();' class="form-control" placeholder="Enter your password" aria-label="Recipient’s username" aria-describedby="basic-addon2">
                  <span class="input-group-text" id="basic-addon2"
                  onclick='eyechange(11);'><i class="bi bi-eye" id='icone'></i></span>
                </div>

                <p id="message" style="color: red; font-size: 14px;
                line-height:0;"></p><button class='buttonText'  onclick='forgotpassword();'>Forgot password ?</button>

                <button id='LoginSubmit' onclick='userLOgin();' class='form-control' disabled>LOGIN</button>

                <div class="row">
                  <div class="col-5"><hr></div>
                  <div class="col-2">or</div>
                  <div class="col-5"><hr></div>
                </div>

                <a href="auth/google" class="btn btn-success" style='width:300px; margin-top:  10px; '> 🌐  Login with google</a>
             <!--   <a href="auth/facebook" class="btn btn-success" style='width:300px; margin-top: 10px;'>  🅵 Login with facebook</a>
-->
                <br>


            </div>
          </div>

        `;

    }

    //back function

    window.back = function() {
      $("#userInfo").html(originalContent);

    };


    //loginst
     window.loginst = function(){
      const Logindivbar = document.getElementById('Logindivbar');
      const signdivbar = document.getElementById('signdivbar');
      const showform = document.getElementById('showform');

      Logindivbar.style.display='block';
      signdivbar.style.display='none';

      $("#showform").html(originalform);
    }


    window.eyechange = function(condition){
      if( condition==11){
        const icone      = document.getElementById('icone');
        const password   = document.getElementById('password');

        if( password.type === "password"){
          password.type = "text";
          icone.classList.remove("bi-eye");
          icone.classList.add("bi-eye-slash");
        }else{
          password.type = "password";
          icone.classList.remove("bi-eye-slash");
          icone.classList.add("bi-eye");
        }
      }else{
        const cicone     = document.getElementById('cicone');
        const cpassword  = document.getElementById('cpassword');

        if( cpassword.type === "password"){
          cpassword.type = "text";
          cicone.classList.remove("bi-eye");
          cicone.classList.add("bi-eye-slash");
        }else{
          cpassword.type = "password";
          cicone.classList.remove("bi-eye-slash");
          cicone.classList.add("bi-eye");
        }
      }
    }



