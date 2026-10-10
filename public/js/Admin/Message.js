  window.indexAllUser = function (){
    fetchDataAjax('/admin/message/alluser/index','post','indexAllUserData','Nan');
  }

indexAllUser()
   window.indexAllUserData = function ( response ){

     let userList = document.getElementById('userList');
      $.each(response.message, function(index, messages) {
          $('#userList').append(`
          
            <div class="user active"  onclick="openChat( ${index} , 'Hello, how are you?')">

                <div class="avatar">
                    12 12
                </div>

                <div class="user-info">
                    <div class="user-id">
                        User ID: 12
                    </div>

                    <div class="last-message">
                        ${messages.Message}
                    </div>
                </div>

            </div>


          
          
          `);
      
      })

   }