  window.indexAllUser = function (){
    fetchDataAjax('/admin/message/alluser/index','post','indexAllUserData','Nan');
    
  }

  indexAllUser()
   window.indexAllUserData = function ( response ){

     let userList = document.getElementById('userList');
     
     
     $.each(response.messageAllUser, function(index, messages) {
          $('#userList').append(`
          
            <div class="user"  onclick="openChat( ${messages.user_id   !== null  ?  messages.user_id : messages.guest_uuid } )">

                <div class="avatar">
                    
                </div>

                <div class="user-info">
                    <div class="user-id">
                        ${messages.user_id   !== null  ?  messages.user.name : messages.guest_id }
                    </div>

                    <div class="last-message">
                        ${messages.Message}
                    </div>
                </div>

            </div>


          
          
          `);
      
      })


//admin
     
   }





    function openChat(userId) {



      let messages = document.getElementById('messages');
      messages.innerHTML = "";

          let formData = new FormData();
            formData.append('userId',userId);
            
            detailsDataAjax('/admin/index/user/message',formData,'POST','openCahtData','Nan','Nan','Nan','Nan');

    }


    window.openCahtData = function( response ){
          // Header change
        document.getElementById('chatUserId').innerText =
            'User ID: ' ;

        document.getElementById('chatAvatar').innerText =
          "jakiul islam"  ;



    $.each(response.userMessageIndex, function(index, MessageIndex) {

      
        // Example conversation
        $("#messages").append(`
            
            <div class="message received">
                ${MessageIndex.Message}sent
            </div>

        `);
    })
        // Active user
        document.querySelectorAll('.user').forEach(user => {
            user.classList.remove('active');
        });

let user = document.querySelectorAll('.user');

      
      //  if (user) {
     //       user.classList.add('active');
     //   }

    // Mobile chat
    document.getElementById('messenger')
        ?.classList.add('chat-open');
      
}





    function backToUsers() {

        document
            .getElementById('messenger')
            .classList.remove('chat-open');

    }


    function sendMessage() {

        const input =
            document.getElementById('messageInput');

        const message = input.value.trim();

        if (message === '') {
            return;
        }


            let formData = new FormData();
                formData.append('message',message);
                formData.append('sender',"user");   
        
                detailsDataAjax('/user/message/create',formData,'POST','messageFetch','Nan','Nan','Nan','Nan');






      
        const messageBox =
            document.getElementById('messages');

        const div =
            document.createElement('div');

        div.className = 'message sent';

        div.innerText = message;

        messageBox.appendChild(div);

        input.value = '';

        messageBox.scrollTop =
            messageBox.scrollHeight;
    }


    // Enter চাপলে message send
    document
        .getElementById('messageInput')
        .addEventListener('keydown', function(e) {

            if (e.key === 'Enter') {
                sendMessage();
            }

        });
