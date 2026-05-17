      //fetch notise
      function insertnotise(){
        let formData = new FormData();
        formData.append('notise_name', $('#notise_name').val());
        formData.append('notise_description', $('#notise_description').val());
        sendDataAjax('/admin/insertnoise',formData,'post','fetchnotise','Nan','insertnoisebutton','insert notise','exampleModal');
      }
      
      fetchnotise();
      //fetch notise
      function fetchnotise(){
        fetchDataAjax('/admin/notisefetch','post','notiseData','Nan');
      }
     // get notise Data from common FetchData function
      function  notiseData( response ){

        const notisName =document.getElementById("notisName");
        const notisDescription =document.getElementById("notisDescription");
        const notise_description =document.getElementById("notise_description");
        const notise_name =document.getElementById("notise_name");
        const showswitch  = document.getElementById('showswitch');
        
        notisName.innerText        = `${response.notise.title}`;
        notisDescription.innerHTML = `${response.notise.description}`;
        notise_description.value = `${response.notise.description}`;
        notise_name.value = `${response.notise.title}`;
        
        if( response.notise.is_active === 1 ){
          showswitch.checked = true ;
        }else{
          showswitch.checked = false ;
        }
      }
        
      showswitch.addEventListener('change', function () {
        let switchValue = this.checked ? 1 : 0;
        let formData = new FormData();
        formData.append('switchValue', switchValue );
        sendDataAjax('/admin/switchValue',formData,'post','Nan','Nan','Nan','Nan','Nan');
      });
