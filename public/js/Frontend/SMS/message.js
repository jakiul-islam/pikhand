$(document).ready(function(){
  $('#messageSubmitButton').click(function(){
     let messageInput = document.getElementById('messageInput').value;
     let formData = new FormData();
        formData.append('messageInput',messageInput);
        formData.append('sender',"user");   

        sendDataAjax('/user/message/create',formData,'post','messageFetch','Nan','Nan','Nan','Nan');

  })
})