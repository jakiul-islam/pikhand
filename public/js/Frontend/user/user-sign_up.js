  window.signupst = function(){
    window.originalform = $("#showform").html();
    const Logindivbar = document.getElementById('Logindivbar');
    const signdivbar = document.getElementById('signdivbar');
    const showform = document.getElementById('showform');
    Logindivbar.style.display='none';
    signdivbar.style.display='block';
    showform.innerHTML=`
      <input id="signupEmail" type="email" class='form-control' placeholder='Enter your email name' >
      <p id="message" style="color: red; font-size: 14px;"></p>
      <button id='sinupSubmit' onclick='sinupotp();' class='form-control' disabled>SIGNUP</button>
      <br>

      <div class="row">
        <div class="col-5"><hr></div>
        <div class="col-2">or</div>
        <div class="col-5"><hr></div>
      </div>

      <a href="auth/google" class="btn btn-success" style='width:300px; margin-top:  10px; '> 🌐  Login with google</a>
<!--     <a href="auth/facebook" class="btn btn-success" style='width:300px; margin-top: 10px;'>  🅵 Login with facebook</a>
     --> <br>
    `;

    let sinupSubmit = document.getElementById("sinupSubmit");
    let signupEmail = document.querySelector("#signupEmail");
    signupEmail.addEventListener("input", () => {

        const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(signupEmail.value);

       if (isValidEmail) {
         message.textContent = "";
         sinupSubmit.disabled = false;
       } else {
         message.textContent = "Please enter a valid email.";
         sinupSubmit.disabled = true;
        }
    });

  }

  window.sinupotp = function(){
    let userinfoshow = document.getElementById('userInfo');
    let message    = document.getElementById('message');
    let sinupSubmit =document.getElementById('sinupSubmit');

    sinupSubmit.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    sinupSubmit.disabled = true;

    let formData = new FormData();
    formData.append('email', $('#signupEmail').val());


    $.ajax({
      url : '/user/sinup',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){

        sinupSubmit.disabled = false;
        sinupSubmit.innerText = `SIGNUP`;
        userinfoshow.innerHTML=`
          <div style='height:auto; width:320px; margin:auto; padding:10px; background-color:#C4E9FF;'>
            <h1 style='margin:auto;'>phone varification</h1>
            <style>
              .otp-input{
                height: 35px;
                width: 35px;
                font-size:20px;

              }
            </style>
            <br>
            <input type="number" id='otp1' inputmode="numeric" oninput='otpbutton()' style='' maxlength="1" class="otp-input" name="otp1">
            <input type="number" id='otp2' inputmode="numeric" oninput='otpbutton()'  maxlength="1" class="otp-input" name="otp2">
            <input type="number" id='otp3' inputmode="numeric" oninput='otpbutton()'  maxlength="1" class="otp-input" name="otp3">
            <input type="number" id='otp4' inputmode="numeric" oninput='otpbutton()'  maxlength="1" class="otp-input" name="otp4">
            <input type="number" id='otp5' inputmode="numeric" oninput='otpbutton()'  maxlength="1" class="otp-input" name="otp5">
            <input type="number" id='otp6' inputmode="numeric" oninput='otpbutton()'  maxlength="1" class="otp-input" name="otp6">
            <br>
           <h5 style='color:red;' id='showotperror'></h5>
            <input type='hidden' id='otp_check_email' value='${response.email}'>
            <button type="submit" class='btn btn-success' id='verifyBtn' style='display:inline;' onclick='Otpchack()' disabled >Verify</button>
            <button style='display:inline; background:none; border:none;'
            onclick='resendotp();'>Resend OTP <i class="bi bi-arrow-clockwise"></i></p>
          </div>`;

          buttontimeset();

            // You can also add your OTP verification logic here
            // Example: send OTP request to server

          //input script code
          const inputs = document.querySelectorAll('.otp-input');
            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value === '' && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
           let otpform= document.getElementById('otp-form');
            if(otpform){
              otpform.addEventListener('submit', function(e) {
                e.preventDefault();
                let otp = '';
                inputs.forEach(input => otp += input.value);
                alert('Entered OTP: ' + otp);
                // এখানে আপনি ajax দিয়ে সার্ভারে otp পাঠাতে পারেন
              });
            }
          //input script code

      },

      error:function(xhr,status,error){
        let response = JSON.parse(xhr.responseText);
        sinupSubmit.disabled = false;
        sinupSubmit.innerText = `SIGNUP`;
        showalert( response.errors,'#ffffff','showalert');
        console.log(response);
      },
    });
  }

  //otp button time set
  window.buttontimeset = function(){
     //set time
    const btn = document.getElementById("verifyBtn");
    let timeLeft = 60; // seconds
    btn.disabled = true;
    btn.textContent = `verify (${timeLeft}s)`;
    const timer = setInterval(() => {
      timeLeft--;
      if (timeLeft > 0) {
        btn.textContent = `verify (${timeLeft}s)`;
      } else {
        clearInterval(timer);
          btn.disabled =true;
          btn.textContent = "Verify";
      }
    }, 1000);
  }

  window.otpbutton = function(){
    let otpbtn = document.getElementById('verifyBtn');

    let otp1 = document.getElementById('otp1');
    let otp2 = document.getElementById('otp2');
    let otp3 = document.getElementById('otp3');
    let otp4 = document.getElementById('otp4');
    let otp5 = document.getElementById('otp5');
    let otp6 = document.getElementById('otp6');

    if (otp1.value.length === 1 && otp2.value.length === 1 &&  otp3.value.length === 1 && otp4.value.length === 1 && otp5.value.length === 1 && otp6.value.length === 1) {
      otpbtn.disabled=false;
    }else{
      otpbtn.disabled=true;
    }
  }
  //otp chack

  window.Otpchack = function(){
      let email =$('#otp_check_email').val();
    //  alert(phoneInput);
      let userinfoshow = document.getElementById('userInfo');
      let showotperror = document.getElementById('showotperror');
      let verifyBtn = document.getElementById('verifyBtn');


      verifyBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
        <span role="status">Loading...</span>
      `;
      verifyBtn.disabled = true;




      let otp  = $('#otp1').val() + $('#otp2').val() + $('#otp3').val() + $('#otp4').val() + $('#otp5').val() + $('#otp6').val() ;

      let formData = new FormData();
      formData.append('otp', otp );
      formData.append('email', email );


      $.ajax({
        url : '/otpchack',
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          verifyBtn.innerHTML = `Verify`;
          verifyBtn.disabled = true;

          userinfoshow.innerHTML=`
            <div class='' style='height:auto; width:320px; margin:auto; padding:10px; background-color:#C4E9FF;  overflow: auto; '>
              <h5 style='margin-left:40%;'>sign up</h5>
              <br>
              <input type='hidden' id='userInfoEmail' value='${response.number}'>
              <p style="line-height:0px;">name</p>
              <input type='text' oninput="allinput()" placeholder="enter your name" class='form-control' id='username' >
              <br>
              <p style="line-height:0px;">password</p>
              <div class="input-group mb-3">
                <input type="password" oninput="allinput()" id="password" class="form-control" placeholder="enter your password" aria-label="Recipient’s username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"
                onclick='eyechange(11);'><i class="bi bi-eye" id='icone'></i></span>
              </div>
               <div id="passworderror">
               </div>
              <p style="line-height:0px;">confirm password</p>
              <div class="input-group mb-3">
                <input type="password" id="cpassword" oninput="allinput()" class="form-control"
                placeholder="enter your confirm password" aria-label="Recipient’s
                username" aria-describedby="basic-addon2">
                <span class="input-group-text" onclick='eyechange(22)' id="basic-addon2"><i class="bi
                bi-eye" id='cicone'></i></span>
              </div>
              <div id="cpassworderror">
              </div>
              <div id="senderror">
              </div>
              <p id="message" style="color: red; font-size: 14px;"></p>
              <button id='infosend' onclick='insertUserInfo();' disabled class='form-control'>send</button>
              <br>
            </div>
          <br>
          `;
        },
        error:function(xhr,status,error){
          verifyBtn.innerHTML = `Verify`;
          verifyBtn.disabled = true;
          let response = JSON.parse(xhr.responseText);
          console.log(response);
        },
      });
    }

  //resent otp
  window.resendotp = function(){
    const email =$('#otp_check_email').val()
    let userinfoshow = document.getElementById('userInfo');
    let showotperror = document.getElementById('showotperror');


    let formData = new FormData();
    formData.append('email', email );

    sendDataAjax('/resendotp',formData,'post','buttontimeset','Nan','Nan','Nan','Nan');
   }

  // allinput input
  window.allinput = function(){
    let password = document.getElementById('password');
    let name = document.getElementById('username');
    let cpassword = document.getElementById('cpassword');

    let passworderror = document.getElementById('passworderror');
    let cpassworderror = document.getElementById('cpassworderror');
    let infosend = document.getElementById('infosend');

   // const namec = name.value.trim();
  //  const namec = name.value.trim();

    if(name.value.length > 3 && password.value.length > 7 &&
    cpassword.value.length > 7 && password.value === cpassword.value ){
      infosend.disabled = false ;

      emailerror.style.display='none';
      cpassworderror.style.display='none';

    }else{
       infosend.disabled = true ;

      if(password.value.length > 0 && password.value.length < 7 ){
        passworderror.style.display='block';
        passworderror.innerHTML=`<p>password most be 8 characters long</li>`;
      }else{
        passworderror.style.display='none';
      }

      if( cpassword.value.length < 7 ){
        cpassworderror.style.display='none';
      }else if( password.value === cpassword.value ){
        cpassworderror.style.display='none';
      }else{
        cpassworderror.style.display='block';
        cpassworderror.innerHTML=`<p>password and confirm password does not match</li>`;
      }
    }
  }

  window.insertUserInfo = function(){
    const email =$('#userInfoEmail').val();
    const name = $('#username').val();
    const password = $('#password').val();

    let showotperror = document.getElementById('senderror');

    let formData = new FormData();
      formData.append('email', email );
      formData.append('name', name );
      formData.append('password', password );

      sendDataAjax('/userinfosend',formData,'post','userDeshboard','Nan','infosend','send','Nan');
  }
