  window.indexAllUser = function (){
    fetchDataAjax('/admin/message/alluser/index','post','indexAllUserData','Nan');
  }

indexAllUser()
   window.indexAllUserData = function ( response ){
     console.log(response);
   }