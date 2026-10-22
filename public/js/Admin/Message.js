  window.indexAllUser = function (){
    fetchDataAjax('/admin/message/alluser/index','post','indexAllUserData','Nan');
    
  }

  indexAllUser()
   window.indexAllUserData = function ( response ){

     let userList = document.getElementById('userList');
     
     
     $.each(response.messageAllUser, function(index, messages) {
          $('#userList').append(`
          
            <div class="user"  onclick="openChat( ${messages.user_id   !== null  ?  messages.user_id : messages.guest_id } , 'Hello, how are you?')">

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





    function openChat(userId, lastMessage) {

        // Header change
        document.getElementById('chatUserId').innerText =
            'User ID: ' + userId;

        document.getElementById('chatAvatar').innerText =
            userId;

        // Example conversation
        document.getElementById('messages').innerHTML = `
            
            <div class="message received">
                ${lastMessage}
            </div>

            <div class="message sent">
                Hello! How can I help you?
            </div>

        `;

        // Active user
        document.querySelectorAll('.user').forEach(user => {
            user.classList.remove('active');
        });

        event.currentTarget.classList.add('active');

        // Mobile
        document
            .getElementById('messenger')
            .classList.add('chat-open');
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
