  function fetchUserinfo(){
    let usernameshow = document.getElementById('usernameshow');
    let userDateofbirth = document.getElementById('userDateofbirth');
    let usergender = document.getElementById('usergender');
    let phoneNumber = document.getElementById('phoneNumber');
    
    $.ajax({
      url : '/user/info/index',
      type :'POST',
      processData: false,
      contentType: false,
    //  data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        if(response.namecount > 0){  
          $('#nameInput').val(response.name.name);
          usernameshow.innerHTML = `${response.name.name}`;
          phoneNumber.innerHTML = `${response.name.phone_number}`;
        }
        if(response.profilecount  > 0){
          $('#timeInput').val(response.profile.date_of_birth);
          userDateofbirth.innerText = response.profile.date_of_birth;
        }
        if(response.profilecount > 0){
          $('#genderInput').val(response.profile.gender);
          usergender.innerText = response.profile.gender;
        }
        
      },
      error:function(xhr,status,error){
        console.log(xhr.responseText);
      }
    });
  }
  //insert info 
  function insertUserinfo(){
    const prodectInsertButton =document.querySelector("#namesavebutton");
    prodectInsertButton.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    prodectInsertButton.disabled = true;
    let formData = new FormData();
    formData.append('nameInput', $('#nameInput').val());
    formData.append('timeInput', $('#timeInput').val());
    formData.append('genderInput', $('#genderInput').val());
    $.ajax({
      url : '/user/info/create',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        prodectInsertButton.innerHTML = `Save`;
        prodectInsertButton.disabled = false;
        var modal = bootstrap.Modal.getInstance($('#nameinfo')[0]);
        modal.hide();
        fetchUserinfo()
        showalert( `User informetion insert successfull`, '#ffffff','showallalert' );
      },
      error:function(xhr,status,error){
        prodectInsertButton.innerHTML = `Save`;
        prodectInsertButton.disabled = false;
        showalert( xhr.responseText, '#ffffff', 'showallalert' );
        
        const response = JSON.parse(xhr.responseText);
        console.log(xhr.responseText);
      }
    });
  }
  //fetch info 
  