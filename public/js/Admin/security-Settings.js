  PasswordPolicies();
  function PasswordPolicies(){
    $.ajax({
      url : '/admin/password_policies_fetch',
      type :'POST',
      processData: false,
      contentType: false,
    //  data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        let showContain = document.getElementById('showContain');
        showContain.innerHTML=`
          <div class="container">
            <p style="margin-top:6px;">policy name</p>
            <input value="${response.password_policies.policy_name}" oninput="PasswordPoliciesupdate( 'policy_name','input' );" id='policy_name' style="margin-top:-1px; width:100px;" type="text">
          </div>
          <hr style="margin-top:-5px; margin-bottom:-0.2px; ">
          <div class="container">
            <p style="margin-top:6px;"> min length</p>
            <input value="${response.password_policies.min_length}" oninput="PasswordPoliciesupdate( 'min_length','input' );" id='min_length' style="margin-top:-1px; width:100px;" type="text">
          </div>
          <hr style="margin-top:-5px; margin-bottom:-0.3px;">
          <div class="container">
            <p style="margin-top:6px;">max length</p>
            <input value="${response.password_policies.max_length}" oninput="PasswordPoliciesupdate( 'max_length','input' );" id='max_length' style="margin-top:-1px; width:100px;" type="text">
          </div>
          <hr style="margin-top:-5px; margin-bottom:-0.3px;">
          <div class="container">
            <p style="margin-top:6px;">require uppercase</p>
            <div class="form-check form-switch">
              <input onclick="PasswordPoliciesupdate( 'require_uppercase','checkbox' );" id='require_uppercase' class="form-check-input shadow-none" style="margin-top:px;" type="checkbox" ${ response.password_policies.require_uppercase > 0 ? 'checked' : '' } role="switch" id="flexSwitchCheckDefault">
            </div>
          </div>
          <hr style="margin-top:-5px; margin-bottom:-0.3px;">
          <div class="container">
            <p style="margin-top:6px;">require numbers</p>
            <div class="form-check form-switch">
              <input onclick="PasswordPoliciesupdate( 'require_numbers','checkbox' );" id='require_numbers' class="form-check-input shadow-none" style="margin-top:px;" type="checkbox" ${ response.password_policies.require_numbers > 0 ? 'checked' : '' } role="switch" id="flexSwitchCheckDefault">
            </div>
          </div>
          <hr style="margin-top:-5px; margin-bottom:-0.3px;">
          <div class="container" style="margin-bottom: -12px;">
            <p style="margin-top:6px;">require special chars</p>
            <div class="form-check form-switch">
              <input onclick="PasswordPoliciesupdate( 'require_special_chars','checkbox' );" id='require_special_chars' class="form-check-input shadow-none" style="margin-top:px;"  type="checkbox" ${ response.password_policies.require_special_chars > 0 ? 'checked' : '' } role="switch" id="flexSwitchCheckDefault">
            </div>
          </div>
          <hr style="margin-top:-5px; margin-bottom:-0.3px;">
          <div class="container" style="margin-bottom: -12px;">
            <p style="margin-top:6px;">password expiration days</p>
            <input value="${response.password_policies.password_expiration_days}" oninput="PasswordPoliciesupdate( 'password_expiration_days','input' );" id='password_expiration_days' style="margin-top:-1px; width:100px;" type="text">
          </div>
          <hr style="margin-top:7px; margin-bottom:-0.3px;">
          <div class="container" style="margin-bottom: -12px;">
            <p style="margin-top:6px;">password history</p>
            <div class="form-check form-switch">
              <input onclick="PasswordPoliciesupdate( 'password_history','checkbox' );" id='password_history' class="form-check-input shadow-none" style="margin-top:px;"  type="checkbox" ${ response.password_policies.password_history > 0 ? 'checked' : '' } role="switch" id="flexSwitchCheckDefault">
            </div>
          </div>
        `;
      },
      error:function(xhr,status,error){
        alert ('Error:'+ xhr.responseText);
        const response = JSON.parse(xhr.responseText);
        console.log(xhr.responseText);
      }
    });
  }
  
  function PasswordPoliciesupdate( idName , inputName){
    let Name = document.getElementById(idName);
    
    let inputValue;
    
    if( inputName == 'input' ){
      inputValue =  Name.value;
    }else{
      inputValue  = Name.checked ? 1 : 0;
    }
    
    
    let formData = new FormData();
    formData.append('inputValue', inputValue);
    formData.append('idName', idName);

    $.ajax({
      url : '/admin/updatePasswordPolicies',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
      },
      error:function(xhr,status,error){
        console.log( xhr.responseText );
      }
    });
  }