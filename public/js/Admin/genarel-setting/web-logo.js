      document.getElementById('Web_Iogo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('logoPreview');
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
      });
    
    //insert logo 
    
      function insertWebLogo(){
        let formData = new FormData();
        formData.append('webName', $('#webName').val());
        if( $('#Web_Iogo')[0].files[0] ){
          formData.append('Web_Iogo', $('#Web_Iogo')[0].files[0]);
        }

        sendDataAjax('/admin/insertWebLogo',formData,'post','fetchWebLogo','Nan','insertWebLogobutton','Insert logo','InsertLogo');
      }
        
      function fetchWebLogo(){
        fetchDataAjax('/admin/fetchweblogo','post','WebLogoData','Nan');
      }
      
      fetchWebLogo();
      
      function WebLogoData( response ){
        const webName =document.getElementById("webName");
        const logoPreview =document.getElementById("logoPreview");
        const WebNameshow =document.getElementById("WebNameshow");
        const WebLogoshow  = document.getElementById('WebLogoshow');
        
        webName.value             = `${response.name}`;
        logoPreview.src           = `/storage/${response.logo}`;
        WebNameshow.innerHTML     = `${response.name}`;
        WebLogoshow.src           = `/storage/${response.logo}`;
      }
    
    