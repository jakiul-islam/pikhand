      function insertMediaLinks(){
        let formData = new FormData();
        formData.append('mediaType', $('#mediaType').val());
        formData.append('mediaUrl', $('#mediaUrl').val());
        formData.append('mediaIcon', $('#mediaIcon').val());
        formData.append('mediaIdName', $('#mediaIdName').val());
        sendDataAjax('/admin/insertMediaLinks',formData,'post','fetchMediaLinks','Nan','mediaButton','Insert Media Links','mediaForm');
        
        $('#mediaType').val('');
        $('#mediaUrl').val('');
        $('#mediaIcon').val('');
        $('#mediaIdName').val('');
      }
      
      
      fetchMediaLinks();
      //fetch notise
      function fetchMediaLinks(){
        fetchDataAjax('/admin/fetchMediaLinks','post','MediaLinksData','Nan');
      }
     // get notise Data from common FetchData function
      function  MediaLinksData( response ){
        $('#allmedia').html('');
        response.media.forEach(function(mediaName ,index ){
          $('#allmedia').append(`
            <a href="${mediaName.url}">${mediaName.icon}
            ${mediaName.name}</a><br>
          `);
        });
      }
      