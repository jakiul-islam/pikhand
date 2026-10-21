  window.indexAllUser = function (){
    fetchDataAjax('/admin/message/alluser/index','post','indexAllUserData','Nan');
  }

indexAllUser()
   window.indexAllUserData = function ( response ){

     let userList = document.getElementById('userList');
     
     
     $.each(response.messageAllUser, function(index, messages) {
          $('#userList').append(`
          
            <div class="user"  onclick="openChat( ${index} , 'Hello, how are you?')">

                <div class="avatar">
                    ${messages.guest_id}
                </div>

                <div class="user-info">
                    <div class="user-id">
                        ${messages.guest_id}
                    </div>

                    <div class="last-message">
                        ${messages.guest_id}
                    </div>
                </div>

            </div>


          
          
          `);
      
      })

   }