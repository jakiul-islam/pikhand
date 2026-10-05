
        $("#messageInput").on("input", function(){
            let messageSubmitButton = document.getElementById('messageSubmitButton');
            let input = $(this).val();
            if(input.length > 0){
                messageSubmitButton.disabled = false;
                messageSubmitButton.style.background = '#091b80';
                messageSubmitButton.style.color = '#FFFFFF';
            }else{
                messageSubmitButton.disabled = true;
                messageSubmitButton.style.background = '#DAD1D1';
                messageSubmitButton.style.color = '#FFFFFF';
            }
        });
        
        
        $("#messageSubmitButton").on("click", function(){
          
          let messageSubmitButton = document.getElementById('messageSubmitButton');
            let messageInput = document.getElementById('messageInput');
           

             let messageInputValue = document.getElementById('messageInput').value;
             let formData = new FormData();
                formData.append('messageInput',messageInputValue);
                formData.append('sender',"user");   
        
                detailsDataAjax('/user/message/create',formData,'post','messageFetch','Nan','Nan','Nan','Nan');

          
            let text = $("#messageInput").val().trim();
            if(text === "") return;

            // 1. User এর মেসেজ দেখাও
            let userMsg = `<div style="align-self: flex-end; background: #0084ff; color: white; padding: 8px 12px; border-radius: 18px 18px 0 18px; max-width: 70%;">${text}</div>`;
            $("#chatBox").append(userMsg);

            // 2. Input খালি করো
            $("#messageInput").val("");

            // 3. নিচে Auto Scroll করো
            $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);

            // 4. Bot এর Reply (Demo)
            setTimeout(function(){
                let botMsg = `<div style="align-self: flex-start; background: #f1f0f0; color: black; padding: 8px 12px; border-radius: 18px 18px 18px 0; max-width: 70%;">আপনি বলেছেন: ${text}</div>`;
                $("#chatBox").append(botMsg);
                $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
            }, 500);
           
           
           messageInput.value="";
            messageSubmitButton.disabled = true;
            messageSubmitButton.style.background = '#DAD1D1';
            messageSubmitButton.style.color = '#FFFFFF';
        });



window.indexMessage = function(){
      fetchDataAjax('/user/message/index','post','messageData','Nan');
}

indexMessage();

window.messageData = function( response ){

console.log(response);

  
   let userMsg = `<div style="align-self: flex-end; background: #0084ff; color: white; padding: 8px 12px; border-radius: 18px 18px 0 18px; max-width: 70%;">${response.message}</div>`;
    $("#chatBox").append(userMsg);
}