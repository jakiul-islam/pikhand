//all user index 
  window.indexAllUser = function (){
    fetchDataAjax('/admin/message/alluser/index','post','indexAllUserData','Nan');
  }
  indexAllUser()

window.indexAllUserData = function ( response ){
   let userList = document.getElementById('userList');
   $.each(response.messageAllUser, function(index, messages) {


     let id = messages.user_id !== null ? messages.user_id : messages.guest_uuid;


     
     $('#userList').append(`
      <div class="user"  onclick="openChat( '${id}' )">
        <div class="avatar">
        </div>
        <div class="user-info">
            <div class="user-id">
                ${messages.user_id   !== null  ?  messages.user.name : messages.guest_id }
            </div>

            <div class="last-message">
                 ${messages.Message == null ? messages.admin_note : messages.Message}
            </div>
        </div>
      </div>
    `);
  })
}
//open user chat 
function openChat(userId) {
  let messages = document.getElementById('messages');
    messages.innerHTML = "";
   let formData = new FormData();
      formData.append('userId',userId);
      detailsDataAjax('/admin/index/user/message',formData,'POST','openCahtData','Nan','Nan','Nan','Nan');
 }

window.openCahtData = function( response ){
  // Header change
  //document.getElementById('chatUserId').innerText =  `${ response.user !== null ? response.user.name : response[0].guest_id }`;
  // Pure JavaScript
  document.getElementById('chatUserId').innerText = `${response.user !== null ? response.user.name : response.userMessageIndex[0].guest_id}`;

  
  document.getElementById('chatAvatar').innerHTML = `<img class='avatar' src="/storage/${response.user !== null  ? response.user.user_profile[0].profile_picture : ''}" height='100'>`;

  let hiddenInput = document.getElementById('hiddenInput');
  hiddenInput.value = response.id_or_uuid;
  $.each(response.userMessageIndex, function(index, MessageIndex) {
    // Example conversation
    $("#messages").append(`
        <div class="message ${MessageIndex.Message == null ? 'sent' : 'received'} ">
            ${MessageIndex.Message == null ? MessageIndex.admin_note : MessageIndex.Message}
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
     indexAllUser();

  document
      .getElementById('messenger')
      .classList.remove('chat-open');


 }

function sendMessage() {
  
  const input = document.getElementById('messageInput');
  const message = input.value.trim();
  if (message === '') {
      return;
  }

  let hiddenInput = document.getElementById('hiddenInput');

  let formData = new FormData();
      formData.append('message',message);
      formData.append('userId',hiddenInput.value);

      detailsDataAjax('/admin/message/create',formData,'POST','indexAllUser','Nan','Nan','Nan','Nan');


  const messageBox =  document.getElementById('messages');

  const div = document.createElement('div');

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
