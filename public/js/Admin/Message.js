  window.indexAllUser = function (){
    fetchDataAjax('/admin/message/alluser/index','post','indexAllUserData','Nan');
  }

indexAllUser()
   window.indexAllUserData = function ( response ){

     let userList = document.getElementById('userList');
      $.each(response.message, function(index, messages) {
          $('#userList').append(`
          
          
          
          
          `);
      
      })

   }