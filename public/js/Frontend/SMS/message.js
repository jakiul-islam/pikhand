
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
        
                detailsDataAjax('/user/message/create',formData,'POST','messageFetch','Nan','Nan','Nan','Nan');

         // detailsDataAjax
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
  
  let chatBox = document.getElementById('chatBox');
  chatBox.innerHTML = "";
  fetchDataAjax('/user/message/index','post','messageData','Nan');
}

        setTimeout(function(){
    fetchDataAjax('/user/message/index','post','messageData','Nan');
    
  }, 500);

         window.messageData = function( response ){

          $.each(response.message, function(index, messages) {

     if(messages.Message == null){
          let botMsg = `<div style="align-self: flex-start; background: #f1f0f0; color: black; padding: 8px 12px; border-radius: 18px 18px 18px 0; max-width: 70%;">${messages.admin_note}</div>`;
            $("#chatBox").append(botMsg);
            $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
     }else{
         let userMsg = `<div style="align-self: flex-end; background: #0084ff; color: white; padding: 8px 12px; border-radius: 18px 18px 0 18px; max-width: 70%;">${messages.Message}</div>`;
         $("#chatBox").append(userMsg);
     }
  })
        }



      const toastTrigger = document.getElementById('liveToastBtn')
      const toastLiveExample = document.getElementById('liveToast')
      if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
          toastBootstrap.show()
        })
      }

      let mediaRecorder;
      let audioChunks = [];

      const inputField = document.getElementById('inputRecord');
      const audioPlayback = document.getElementById('audioPlayback');
      if(inputField){
        inputField.addEventListener('click', async () => {
          if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            alert('Your browser does not support audio recording');
            return;
          }

          try {
            // Request microphone access
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            // Create a new MediaRecorder instance
            mediaRecorder = new MediaRecorder(stream);
            // Collect audio data when available
            mediaRecorder.addEventListener('dataavailable', event => {
              audioChunks.push(event.data);
            });
            // When recording stops, create and play the audio
            mediaRecorder.addEventListener('stop', () => {
              const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
              const audioUrl = URL.createObjectURL(audioBlob);
              audioPlayback.src = audioUrl;
            });

            // Start recording
            mediaRecorder.start();
            inputField.placeholder = "Recording...";

            // Stop recording after 5 seconds (for demo purposes)
            setTimeout(() => {
              mediaRecorder.stop();
              inputField.placeholder = "Click to start recording";
            }, 5000);
          } catch (error) {
            console.error('Error accessing microphone:', error);
          }
        });
      }
  
