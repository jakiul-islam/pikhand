  window.indexAllUser = function (){
    $('.editor-modal').remove(); 
    fetchDataAjax('/admin/brand/index','post','brandData','Nan');
  }