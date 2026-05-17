    function AdminDatilsAndAccess( FetchAdminRow ){
      let formData = new FormData();
      formData.append('uuid', FetchAdminRow);
      detailsDataAjax("/admin/AdminDatilsAndAccess",formData,"POST",'AdminDatilsAndAccessRespons','Nan','Nan','save','Nan');
    }
    // respons 
    
    function AdminDatilsAndAccessRespons( respons ){
      let mainContain = document.getElementById('mainContain');
      window.originalContent1 = $("#mainContain").html();
      
      let is_Active = '';
        if(respons.admin.last_seen && new Date().getTime() - new Date(respons.admin.last_seen).getTime() < 5 * 60 * 1000){
          is_Active = `active now` ;
        }else{
          if( respons.admin.last_seen ){
            if( new Date().getTime() - new Date(respons.admin.last_seen).getTime() > 48 *60 * 60 * 1000 ){
              is_Active = respons.admin.last_seen;
            }else{
              let UnactiveDate = new Date().getTime() - new Date(respons.admin.last_seen).getTime() ;
              is_Active = timeFormet( UnactiveDate ) + ' ago';
            }
          }else{
            is_Active = `N/A`;
          }
        }
      
      
      
      mainContain.innerHTML = `
        <button class='buttonText' onclick='back()'><i class='bi bi-arrow-left'></i></button>
          <div class='admin-profile-container'>
            <img src=''>
            <div>
              <h2>${respons.admin.name}</h2><br>
              <span>${is_Active}</span>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-6 col-lg-6'> 
              <h4 class='text-center'>admin informetion</h4>
              <table>
                <tr><td>Email </td><td> : ${respons.admin.email}</td></tr>
                <tr><td>Role </td><td> : ${respons.admin.role}</td></tr>
                <tr><td>Phone </td><td> : ${respons.admin.phone}</td></tr>
              </table>
            </div>
            <div class='col-md-6 col-lg-6'> 
              <h4 class='text-center'>admin activity</h4>
              <table>
                <tr><td>Last seen </td><td> : ${respons.admin.last_seen ? respons.admin.last_seen : 'N/A'}</td></tr>
                <tr><td>Last_login_at </td><td> : ${respons.admin.last_login_at ? respons.admin.last_login_at : 'N/A'}</td></tr>
                <tr><td>Last_login_ip </td><td> : ${respons.admin.last_login_ip ? respons.admin.last_login_ip : 'N/A'}</td></tr>
                <tr><td>Status </td><td> : ${respons.admin.status ? respons.admin.status : 'N/A'}</td></tr>
                <tr><td>Created </td><td> : ${respons.admin.created_at ? respons.admin.created_at : 'N/A'}</td></tr>
              </table>
            </div>
          </div>
        <div class="name-2" id='ShowPageName'> <div>
        <div class="name-2" id='ShowAdminActivite'> <div>
      `;
      
      

      $('#ShowPageName').html('');
      $.each(respons.page,function(index , pageName){
       
       
        let IsChecked  = ''; 
        $.each(respons.access,function(index , accessRow){
          if(accessRow.pagename == pageName.pageName){
            IsChecked +=`
              checked
            `;
          }
        });
       
       
       
        $('#ShowPageName').append(`
          <div class="container">
            <p style="margin-top:6px;">${pageName.pageName}</p>
            <div class="button-div">
              <div class="form-check form-switch">
                <input onclick="AccessInAble( '${pageName.pageName}','${respons.admin.uuid}','${pageName.id}');" id='accessSwitch${pageName.id}' ${IsChecked} class="form-check-input shadow-none" style="margin-top:-1px;" type="checkbox" role="switch" id="flexSwitchCheckDefault">
              </div>
              <button class='buttonText'><i class='bi bi-eye'></i></button> 
            </div>
          </div>
        `);
      });
    }
    
    