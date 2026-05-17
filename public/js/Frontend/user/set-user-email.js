  function emailinsert(){
    const Emailset=document.getElementById('Emailset');
    const otpchack=document.getElementById('otpchack');
 
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
    EmailOtpChack.disabled = true;
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
  
  //email chack
  function emailchack(){
     const Emailset    =document.getElementById('Emailset');
     const emailInsput =document.getElementById('emailInsput');
     const emailerror = document.getElementById('emailerror');
     const pattern1 = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
     if( emailInsput.value.length > 1 && pattern1.test(emailInsput.value)){
       Emailset.disabled =false;
       emailerror.style.display='none';
     }else{
       Emailset.disabled =true;
       if(emailInsput.value.length > 1){
         emailerror.style.display='block';
         emailerror.innerText=`Invalid email address`;
       }
     }
  }