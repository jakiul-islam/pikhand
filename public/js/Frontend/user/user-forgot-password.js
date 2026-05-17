    //forgotpassword 
    function forgotpassword(){
      window.loginOrsignuppage = $("#userInfo").html();
      let forgotshow = document.getElementById('userInfo');
      let webLogoForUseScript = document.getElementById('webLogoForUseScript').value;
      forgotshow.innerHTML  =`
        <button onclick='loginback();' style=' background:none; border:none;
          width:60px;'><i style='font-size:25px;' class="bi
          bi-arrow-left"></i></button>
        
          <div style='height:auto; width:320px; overflow:auto; margin:auto; padding:10px; background-color:#C4E9FF;'>
            <img src="/storage/${webLogoForUseScript}" alt="Picklet Logo" class='logoCenter' >
            <br>
            <div id='showform'>
              <h6>Phone number</h6>
              <input id="forgotphone" type="text" style="width:100%; height:40px; font-size:18px;" >
              <p id="message" style="color: red; font-size: 14px;"></p>
              <button id='Forgotphonesend' onclick='showotp();' class='form-control' disabled>SEND OTP</button>
              <br>
              <div id="phoneotpshow"></div>
              <!-- <button class="btn btn-primary" style='display:none;' id='ForgotOtpChack' onclick="passandcpass();">send otp</button> -->
            </div>
          </div>
      `;
            
            //sdfsdjfhkjsdfhkjsdfsahfksjdfhk
        const forgotphone = document.querySelector("#forgotphone");
        const message = document.getElementById("message");
        const button = document.getElementById("Forgotphonesend");
      
        const iti = window.intlTelInput(forgotphone, {
          initialCountry: "auto",
          geoIpLookup: function(success) {
            fetch("https://ipapi.co/json")
              .then(res => res.json())
              .then(data => success(data.country_code))
              .catch(() => success("US"));
          },
          utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
      
        forgotphone.addEventListener("input", () => {
          if (iti.isValidNumber()) {
            message.textContent = "";
            button.disabled = false;
          } else {
            message.textContent = "Please enter a valid phone number.";
            button.disabled = true;
          }
        });
            
     }
     
    window.loginback = function() {
      $("#userInfo").html(loginOrsignuppage);
    };
     
    //showotp
    function showotp(){
        let forgotshow = document.getElementById('userInfo');
        let Forgotphonesend = document.getElementById('Forgotphonesend');
        Forgotphonesend.innerHTML = `
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        `;
        Forgotphonesend.disabled = true;
       
        let formData = new FormData();
        formData.append('forgotphone', $('#forgotphone').val());
        $.ajax({
          url : '/forgot/phonenumber/chack',
          type :'POST',
          processData: false,
          contentType: false,
          data: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          success:function(response){
            forgotshow.innerHTML =`
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
                <input type="number" id='forgototp1' inputmode="numeric"
                oninput='forgototpbutton()' style='' maxlength="1" class="otp-input"
                name="otp1">
                <input type="number" id='forgototp2' inputmode="numeric" oninput='forgototpbutton()'  maxlength="1" class="otp-input" name="otp2">
                <input type="number" id='forgototp3' inputmode="numeric" oninput='forgototpbutton()'  maxlength="1" class="otp-input" name="otp3">
                <input type="number" id='forgototp4' inputmode="numeric" oninput='forgototpbutton()'  maxlength="1" class="otp-input" name="otp4">
                <input type="number" id='forgototp5' inputmode="numeric" oninput='forgototpbutton()'  maxlength="1" class="otp-input" name="otp5">
                <input type="number" id='forgototp6' inputmode="numeric" oninput='forgototpbutton()'  maxlength="1" class="otp-input" name="otp6">
                <br>
               <h5 style='color:red;' id='showotperror'></h5>
                <input type='hidden' id='phoene_number' value='${response.number}'>
                <button type="submit" class='btn btn-success' id='verifyBtn' style='display:inline;' onclick='forgotOtpchack()' disabled >Verify</button>
                <button onclick='resendotp();' style='display:inline; background:none; border:none;'>Resend OTP <i class="bi bi-arrow-clockwise"></i></p>
              </div>`;
              Forgotphonesend.disabled = false;
              Forgotphonesend.innerHTML =`SEND OTP`;
              buttontimeset();
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
              let otpform = document.getElementById('otp-form');
              if(otpform){
                otpform.addEventListener('submit', function(e) {
                    e.preventDefault();
                    let otp = '';
                    inputs.forEach(input => otp += input.value);
                    alert('Entered OTP: ' + otp);
                    // এখানে আপনি ajax দিয়ে সার্ভারে otp পাঠাতে পারেন
                });
              }
          },
          
          error:function(xhr,status,error){
            let response = JSON.parse(xhr.responseText);
            
            showalert( response.message , '#ffffff' ,'showallalert');
          
          Forgotphonesend.disabled = false;
          Forgotphonesend.innerHTML =`SEND OTP`;
              

          console.log(response);
          
          },
        });
      }
      
    //forgotchack otp 
      
    function forgotOtpchack(){
        const phoneInput =$('#phoene_number').val()
        let userinfoshow = document.getElementById('userInfo');
        let showotperror = document.getElementById('showotperror');
        let otp  = $('#forgototp1').val() + $('#forgototp2').val() + $('#forgototp3').val() + $('#forgototp4').val() + $('#forgototp5').val() + $('#forgototp6').val() ;
    
        let formData = new FormData();
        formData.append('otp', otp );
        formData.append('phoneInput', phoneInput );
        
        
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
            let webLogoForUseScript =document.getElementById('webLogoForUseScript').value;
      
            userinfoshow.innerHTML=`
              <br>
              <div class='' style='height:auto; width:320px; margin:auto; padding:10px; background-color:#C4E9FF;  overflow: auto; '>
                <img src="/storage/${webLogoForUseScript}" alt="Picklet Logo"
                          class='logoCenter' >
                  <h5 style='margin:auto;'>SEt a new password</h5>
                  <br>
                  <input type='hidden' id='phoene_number' value='${response.number}'>
                  <p style="line-height:0px;">password</p>
                  <div class="input-group mb-3">
                    <input type="password" oninput="forgotallinput()"
                    id="password" class="form-control forgotpassword"
                    placeholder="Enter your password" aria-label="Recipient’s
                    username"
                    aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2"
                    onclick='eyechange(11);'><i class="bi bi-eye" id='icone'></i></span>
                  </div>
                   <div id="passworderror">
                   </div>
                  <p style="line-height:0px;">confirm password</p>
                  <div class="input-group mb-3">
                    <input type="password" id="cpassword"
                    oninput="forgotallinput()" class="form-control
                    cforgotpassword" placeholder="Enter your confirm password"
                    aria-label="Recipient’s username"
                    aria-describedby="basic-addon2">
                    <span class="input-group-text" onclick='eyechange(22)' id="basic-addon2"><i class="bi
                    bi-eye" id='cicone'></i></span>
                  </div>
                  <div id="cpassworderror">
                  </div>
                  <div id="senderror">
                  </div>
                  <p id="message" style="color: red; font-size: 14px;"></p>
                  <button id='forgotinfosend' onclick='insertnewpassword();' class='form-control' disabled>send</button>
                  <br>
                </div>
              <br>
            `;
          },
          error:function(xhr,status,error){
            let response = JSON.parse(xhr.responseText);
            showalert( 'otp does not metch' , '#ffffff' ,'showallalert');
          },
        });
      }
      
      
    function forgototpbutton(){
      let otpbtn = document.getElementById('verifyBtn');
      
      let otp1 = document.getElementById('forgototp1');
      let otp2 = document.getElementById('forgototp2');
      let otp3 = document.getElementById('forgototp3');
      let otp4 = document.getElementById('forgototp4');
      let otp5 = document.getElementById('forgototp5');
      let otp6 = document.getElementById('forgototp6');
      
      if (otp1.value.length === 1 && otp2.value.length === 1 &&  otp3.value.length === 1 && otp4.value.length === 1 && otp5.value.length === 1 && otp6.value.length === 1) {
        otpbtn.disabled=false;
      }else{
        otpbtn.disabled=true;
      }
    }
      
      
      
    function forgotallinput(){
      let password = document.querySelector('.forgotpassword');
      let cpassword = document.querySelector('.cforgotpassword');
      
      let passworderror = document.getElementById('passworderror');
      let cpassworderror = document.getElementById('cpassworderror');
      let forgotinfosend = document.getElementById('forgotinfosend');
      
     // const namec = name.value.trim();
    //  const namec = name.value.trim();
      
      if( password.value.length > 7 && cpassword.value.length > 7 && password.value === cpassword.value ){
        forgotinfosend.disabled = false ;
        
        emailerror.style.display='none';
        cpassworderror.style.display='none';
        
      }else{
         forgotinfosend.disabled = true ;
         
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
      
    function insertnewpassword(){
      const phoneInput =$('#phoene_number').val();
      const password = $('#password').val();
      
      let formData = new FormData();
        formData.append('phoneInput', phoneInput );
        formData.append('password', password );
        
      sendDataAjax('/insert/new/password',formData,'post','loginOrsignup','Nan','forgotinfosend','send','Nan');
    }