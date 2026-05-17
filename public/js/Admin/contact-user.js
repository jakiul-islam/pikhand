      //insert contact us section
      function insertnotise(){
        let formData = new FormData();
        formData.append('mediaName', $('#mediaName').val());
        formData.append('mediaLink', $('#mediaLink').val());
        formData.append('mediaIdName', $('#mediaIdName').val());
        insertDate('/admin/insertnoise',formData,'post','fetchnotise','Nan','insertnoisebutton','insert notise','exampleModal');
      }