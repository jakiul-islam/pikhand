  window.sattingPage  = function(){
    window.originalContent1 = $("#userInfo").html();

    let  sattingPageShow  = document.getElementById('userInfo');
    sattingPageShow.innerHTML=`
      <div style='overflow:auto;'>
        <div style='font-size:22px; margin-top:10px;'>   <button onclick='settingback();' style='background:none; border:none; font-size:22px; display:inline;'><i class="bi bi-arrow-left"></i></button>
        <b> Setting</b>
      </div>
      <hr>
      <div onclick='AccountInfo(); ' style='margin-left:5px; font-size:20px; line-height:0.2;'>
        Account information
      </div>
      <hr>
      <div onclick='addressbook();' style='margin-left:5px; font-size:20px; line-height:0.2;'>
        Address book
      </div>
      <hr>
      <div style='margin-left: 5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>Country <br>
        <small style='color:#D0D0D0;'>bangladash is your corrent country</small>
      </div>
      <hr>
      <div style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
        Language
        <br>
        <small style='color:#D0D0D0;'>English</small>
      </div>
      <hr>
      <div onclick='Secirty()' style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
        Secirty
      </div>
      <br>
    `;
  }

  window.settingback = function() {
    $("#userInfo").html(originalContent1);
  };

  window.AccountInfo  = function(){
    window.settingorginal = $("#userInfo").html();
    let  accountinfoShow  = document.getElementById('userInfo');
      accountinfoShow.innerHTML=`
      <div style='overflow:auto;'>
        <div style='font-size:22px; margin-top:10px;'>
          <button onclick='backSettion();' style='background:none; border:none; font-size:22px; display:inline;'><i class='bi bi-arrow-left'></i></button>
          <b> Account information</b>
        </div>
        <hr>
        <div style='margin-left: 5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
          Phone number <br>
          <small id='phoneNumber' style='color:#D0D0D0;'>018......</small>
        </div>
        <hr>
        <div style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
          <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#name">
          Email
          </button>
          <br>
          <small style='color:#D0D0D0;'>No set</small>
        </div>
        <hr>
        <div style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
          <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#nameinfo">
          name
          </button>
          <br>
          <small id='usernameshow' style='color:#D0D0D0;'>No set</small>
        </div>
        <hr>
        <div style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
          <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#nameinfo">
          Date of birth
          </button>
          <br>
          <small id='userDateofbirth' style='color:#D0D0D0;'>No set</small>
        </div>
        <hr>
        <div style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
          <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#nameinfo">
          Gender
          </button>
          <br>
          <small id='usergender' style='color:#D0D0D0;'>No set</small>
        </div>
        <br>
      </div>
    `;
    fetchUserinfo();
  }


  window.addressbook  = function(){
    window.settingorginal = $("#userInfo").html();

    let  accountinfoShow  = document.getElementById('userInfo');
      accountinfoShow.innerHTML=`
      <div style='overflow:auto;'>
        <div style='font-size:22px; margin-top:10px;'>
          <button onclick='backSettion();' style='background:none; border:none; font-size:22px; display:inline;'><i class='bi bi-arrow-left'></i></button>
          <b> address book</b>
        </div>

        <hr>
        <div style='margin-left: 5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
         <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#address1">
          add address
          </button>
        </div>
        <hr>
          <div id='addressShow'>
          </div>
        <br>
      </div>
      `;
    fetchaddress();
  }


  window.Secirty  = function(){
    window.settingorginal = $("#userInfo").html();

    let  accountinfoShow  = document.getElementById('userInfo');
      accountinfoShow.innerHTML=`
      <div style='overflow:auto;'>
        <div style='font-size:22px; margin-top:10px;'>
          <button onclick='backSettion();' style='background:none; border:none; font-size:22px; display:inline;'><i class='bi bi-arrow-left'></i></button>
          <b>Secirty</b>
        </div>
        <hr>
        <div style='margin-left: 5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
         <button type="button" class="buttonText" data-bs-toggle="modal"
          data-bs-target="#changepassword">
          Change password
          </button>
        </div>
        <hr>
        <div style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1;'>
          <button type="button" class="buttonText" data-bs-toggle="modal"
          data-bs-target="#" onclick='forgotpassword();'>
           Forgot password
          </button>

        </div>
        <hr>

        <br>
      </div>
      `;
  }
    window.backSettion = function() {
    $("#userInfo").html(settingorginal);
  };

  window.otpBuD  = function(){
    const EmailOtpChack= document.getElementById('EmailOtpChack');

    let otp1 = document.getElementById('otp1');
    let otp2 = document.getElementById('otp2');
    let otp3 = document.getElementById('otp3');
    let otp4 = document.getElementById('otp4');
    let otp5 = document.getElementById('otp5');
    let otp6 = document.getElementById('otp6');

      if ( otp1.value.length === 1 && otp2.value.length === 1 &&  otp3.value.length === 1 && otp4.value.length === 1 && otp5.value.length === 1 && otp6.value.length === 1) {
        EmailOtpChack.disabled=false;
      }else{
        EmailOtpChack.disabled=true;
      }
  }
  //namebutton

  window.namebutton = function(){
    const namesavebutton = document.getElementById('namesavebutton');
    const nameInput      = document.getElementById('nameInput');
    const timeInput      = document.getElementById('timeInput');
    const genderInput    = document.getElementById('genderInput');

     if( nameInput.value.length  > 1 && timeInput.value.length  > 1 &&
      genderInput.value.length  > 1){
      namesavebutton.disabled=false;
    }else{
      namesavebutton.disabled=true;
    }
  }

  window.addressB = function(number){

    const a      = document.getElementById('a'+number);
    const b      = document.getElementById('b'+number);
    const c      = document.getElementById('c'+number);

    const Addressbutton = document.getElementById('Address'+number);
    if( a.value.length > 1 && b.value.length > 1 && c.value.length > 1 ){
      Addressbutton.disabled=false;
    }else{
      Addressbutton.disabled=true;
    }

  }

  //phone number chack
  window.phoneinsert = function(){
    const Emailset=document.getElementById('phonesend');
    const otpchack=document.getElementById('phobeotp');
    const EmailOtpChack= document.getElementById('phoneOtpChack');

    EmailOtpChack.style.display='block';
    EmailOtpChack.innerHTML=`verify 59`;

    Emailset.innerHTML=`otp resend`;
    otpchack.innerHTML=`
      <style>
        .otp-input{
          height: 35px;
          width: 35px;
          font-size:20px;
        }
      </style>
      <div style='margin-left:20px;'>
        <input type="text" id='otp1' inputmode="numeric" oninput='otpBuD()'  maxlength="1" class="otp-input" name="otp1">
        <input type="text" id='otp2' inputmode="numeric" oninput='otpBuD()'  maxlength="1" class="otp-input" name="otp2">
        <input type="text" id='otp3' inputmode="numeric" oninput='otpBuD()'  maxlength="1" class="otp-input" name="otp3">
        <input type="text" id='otp4' inputmode="numeric" oninput='otpBuD()'  maxlength="1" class="otp-input" name="otp4">
        <input type="text" id='otp5' inputmode="numeric" oninput='otpBuD()'  maxlength="1" class="otp-input" name="otp5">
        <input type="text" id='otp6' inputmode="numeric" oninput='otpBuD()'  maxlength="1" class="otp-input" name="otp6">
      </div>
      <br>
    `;


    //time set for verify button
    let timeLeft = 60; // seconds
    EmailOtpChack.disabled = false;
    EmailOtpChack.textContent = `verify (${timeLeft}s)`;
    const timer = setInterval(() => {
      timeLeft--;
      if (timeLeft > 0) {
        EmailOtpChack.textContent = `verify (${timeLeft}s)`;
      } else {
        clearInterval(timer);
        EmailOtpChack.disabled =true;
        EmailOtpChack.textContent = "Verify";
      }
    }, 1000);
    // end /time set for verify button

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
  }

  window.passandcpass = function(){
    const showpass = document.getElementById('showpass');
    const otpchack=document.getElementById('phobeotp');
    otpchack.style.display='none';
    showpass.innerHTML =`
      <div class="">
        <lavel>bivag</lavel><br>
        <input type="password" id="changepassword" oninput="password();" class="form-control " placeholder="what are you old"  aria-label="Username" aria-describedby="addon-wrapping">
      </div>
      <br>
      <div class="">
        <lavel>Enter gender </lavel><br>
        <input type="password" id='confirmpassword' oninput="password();"  class="form-control " placeholder="What is your gender" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    `;
  }

  window.showallpassfild = function(){
    window.originalchangepassword = $("#showallpassfild").html();
    let chackpasswordbutton = document.getElementById('chackpasswordbutton');
    let formData = new FormData();
    formData.append('userchangepassword', $('#userchangepassword').val());

    $.ajax({
      url : '/chackpasswordforchang',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        if(response.ststus === true){
          const showallpassfild=document.getElementById('showallpassfild');

          chackpasswordbutton.innerHTML=`
            <button class="btn btn-primary"  id='setnewpassword'
                onclick="setnewpassword()" disabled>new password</button>

          `;

          showallpassfild.innerHTML=`
            <lavel>New password</lavel><br>
            <div class="input-group mb-3">
              <input type="password" id="newpassword" oninput="chackpassword();"
              class="form-control " placeholder="Enter new password"  aria-label="Username"
              aria-describedby="addon-wrapping">
               <span class="input-group-text" onclick="eye('newpassword','newicone')" id="basic-addon2"><i class="bi
                bi-eye" id='newicone'></i></span>
            </div>
            <lavel>Confirm password </lavel><br>
            <div class="input-group mb-3">
              <input type="password" id='newconfirmpassword' oninput="chackpassword();"
              class="form-control " placeholder="Enter confirm password" aria-label="Username"
              aria-describedby="addon-wrapping">
              <span class="input-group-text" onclick="eye('newconfirmpassword','newconfirmicone')" id="basic-addon2"><i class="bi
                bi-eye" id='newconfirmicone'></i></span>
            </div>
            <span id="showalert">Password must be at least 8 characters.</span>
          `;
        }else{
          showalert( 'password chack faild try agin' , '#ffffff' ,'showallalert');
        }
      },
      error:function(xhr,status,error){
          showalert( 'password chack faild try agin' , '#ffffff' ,'showallalert');
      }
    });

  }

  //chackpassword

  window.setnewpassword = function(){
    let formData = new FormData();
    formData.append('newpassword', $('#newpassword').val());
    sendDataAjax('/setnewpassword',formData,'post','Nan','Nan','Nan','Nan','changepassword');
    $("#showallpassfild").html(originalchangepassword);
  }

  window.chackpassword = function(){
    let newpassword        =  $('#newpassword').val()
    let newconfirmpassword = $('#newconfirmpassword').val()
    let setnewpassword     = document.getElementById('setnewpassword');
    let showalert             = document.getElementById('showalert');
    if(newpassword.length > 7 && newconfirmpassword.length > 7 && newpassword===newconfirmpassword){
      setnewpassword.disabled=false
      showalert.style.display = 'none';
    }else{
      if(newconfirmpassword.length > 7 && newpassword!==newconfirmpassword){
        showalert.style.display = 'block';
        showalert.innerHTML=` newpassword and newconfirmpassword does not
        match.`;
      }
    }
  }
  // oll input faild
  window.oldpasswordinput = function(){
    let userchangepassword        =  $('#userchangepassword').val()
    let submitChangbutton     = document.getElementById('submitChangbutton');
    let showalert             = document.getElementById('showalert');
    if(userchangepassword.length > 7 ){
      submitChangbutton.disabled=false
    }
  }
  window.eye = function(passwordid,iconeid){
    const icone      = document.getElementById(iconeid);
    const password12   = document.getElementById(passwordid);

    if( password12.type === "password"){
      password12.type = "text";
      icone.classList.remove("bi-eye");
      icone.classList.add("bi-eye-slash");
    }else{
      password12.type = "password";
      icone.classList.remove("bi-eye-slash");
      icone.classList.add("bi-eye");
    }
  }
  window.insertaddress = function(){
    let address  = $('#a1').val() +'-->'+ $('#b1').val() +'-->'+ $('#c1').val() ;
    const selected = document.querySelector('input[name="home_office"]:checked');
    let formData = new FormData();
    formData.append('name', $('#addressname').val());
    formData.append('phone', $('#addressphone').val());
    formData.append('a1', address );
    formData.append('home_office', selected.value );

    sendDataAjax('/user/address/create',formData,'post','fetchaddress','Nan','Nan','Nan','address1');
  }
  //fetch address book
  window.fetchaddress = function(){

    $.ajax({
      url : '/user/address/index',
      type :'POST',
      processData: false,
      contentType: false,
     // data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        $('#addressShow').html('');
        response.user_address.forEach(function(address){
          $('#addressShow').append(`
            <div style='margin-left:5px; margin-top:-10px; margin-bottom:-10px; font-size:20px; line-height:1; position: relative;'>
              <small style='color:#D0D0D0;'>${address.name}</small><br>
              <small style='color:#D0D0D0;'>${address.phone_number}</small><br>
              <small style='color:#D0D0D0;'>${address.home_office} address : ${address.address}</small>
              <button style='background:none; border:none; position:absolute;
              right:5px; top:5px; ' onclick="addressdelete( '${address.id}' )"><i
              style='font-size:14px;' class='bi
                                bi-trash'></i></button>
            </div>
            <hr>
          `);
        });
      },
      error:function(xhr,status,error){
       // let response = JSON.parse(xhr.responseText);
       // alert(xhr.responseText);
      },
    });
  }
  //addressdelete section
  window.addressdelete = function( addressId ){
    let formData = new FormData();
    formData.append('addressId', addressId );
    sendDataAjax('/user/address/delete',formData,'post','fetchaddress','Nan','Nan','Nan','Nan');
  }
