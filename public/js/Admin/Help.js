  $(document).ready(function(){
    $("#InsertHelpButton").click(function(){
      let formData = new FormData();
      formData.append('helpPage', tinymce.get('helpPage').getContent());
      sendDataAjax('/admin/help/store',formData,'post','helpIndex','Nan','InsertHelpButton','Help','HelpPageModel')
    });
  });
  
  //fetch Help
  function helpIndex(){
    
    $.ajax({
      url: "/admin/help/index",  
      type: "GET",
      dataType: "json",
      success: function(response) {
        let showHelpPage = document.getElementById('showHelpPage');
        $('#showHelpPage').html(''); 
        tinymce.get('helpPage').setContent(response.Help.page);
        showHelpPage.innerHTML = response.Help.page;
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
  helpIndex();
   