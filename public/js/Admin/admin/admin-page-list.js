    function adminPage(){
      let formData = new FormData();
      formData.append('pageName', $('#pageName').val() );
      sendDataAjax("/admin/adminPage",formData,"POST",'AdminPageList','Nan','pageNameButton','insert','Nan');
    }
    // admin page insert
    function AdminPageList(){
      fetchDataAjax("/admin/FetchAdminPage","POST", 'getAdminPageName' ,'Nan' );
    }
    function  getAdminPageName( response ){
      
      let mainContain = document.getElementById('mainContain');
      window.originalContent1 = $("#mainContain").html();
      
      mainContain.innerHTML = `
        <button class="btn btn-outline-success" onclick="back()">Admin list</button>
        <button class="btn btn-outline-success"   onclick="accessControll( '4' )">Page list</button>
        <br>
        <input type='text' id='pageName' placeholder="Enter page url"> 
        <button id='pageNameButton' onclick='adminPage();'>insert</button> 
        <div class="name-2" id='ShowPageName'>
      `;
      
      
      
      $('#ShowPageName').html('');
      $.each(response.page,function(index , pageName){
        $('#ShowPageName').append(`
          <div class="container">
            <p style="margin-top:6px;">${pageName.pageName}</p>
            <div style='display:flex; align-item:center;'>
              <div style='display:inline-block;' class="form-check form-switch">
                <input onclick="statusUpadate( '${pageName.id}');"  id='Registration_switch${pageName.id}' ${pageName.status > 0 ?
                'checked' : ''} class="form-check-input shadow-none"
                style="margin-top:-1px;" type="checkbox"  role="switch"
                id="flexSwitchCheckDefault">
              </div>
              <button onclick="deleteAdminPage( '${pageName.id}');" class='buttonText'><i class='bi bi-trash'></i></button> 
              <button class='buttonText'><i class='bi bi-eye'></i></button> 
            </div>
          </div>
        `);
      });
    }
    
    //status   Upadate
    function statusUpadate( id ){
      var status = document.getElementById('Registration_switch'+id).checked ? 1 : 0;

      let formData = new FormData();
      formData.append('id', id );
      formData.append('statusValue', status );
      sendDataAjax("/admin/statusUpadate",formData,"POST",'Nan','Nan','Nan','Nan','Nan');
    }
    
    function deleteAdminPage( id ){
      let formData = new FormData();
      formData.append('id', id );
      sendDataAjax("/admin/deleteAdminPage",formData,"POST",'AdminPageList','Nan','Nan','Nan','Nan');
    }
    