  function subscribers(){
    let subscribe_input = document.getElementById('subscribe_input');
    if(subscribe_input.value.length  < 1){
      showalert('enter your email' , '#ffffff' ,'showallalert');
      subscribe_submit.innerHTML = `subscribe`;
      subscribe_submit.disabled = false;
    }else{
      let formData = new FormData();
      formData.append('subscribe_input', $('#subscribe_input').val());
      sendDataAjax('/user/subscribe',formData,'post','Nan','Nan','subscribe_submit','subscribe','Nan');
    }
  }