      $(document).ready(function(){
        $("#insert_admin").click(function(){
          var fileInput = document.getElementById('profile');
          let formData = new FormData();
          
          formData.append('name', $('#name1').val());
          formData.append('email', $('#email').val());
          formData.append('phone', $('#phone').val());
          formData.append('password', $('#password').val());
          formData.append('profile', fileInput.files[0]);
          
          sendDataAjax("/admin/insert_admin",formData,"POST",'fetchAdminList','Nan','insert_admin','save','name');
            
        });
      });
      //fetch all admin list
      fetchAdminList();
      function  fetchAdminList(){
        fetchDataAjax("/admin/FetchAdminList","POST", 'fetchAdminListShow' ,'Nan' );
      }
    
    // show 
    function fetchAdminListShow( response ){
      $('#adminListShowTable').html('');
      $.each(response.FetchAdmin, function(index, FetchAdminRow){
        let action = '';
        if(response.usercount > 0){
          action = `
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" onclick="actionButton( '${FetchAdminRow.uuid}','${FetchAdminRow.status  == 1 ?  0 : 1 }' );" role="switch" id="switchCheckChecked${FetchAdminRow.id}" ${FetchAdminRow.status == 1 ? '   checked ' : '' } >
              </div>   
              <button onclick="AdminDatilsAndAccess('${FetchAdminRow.uuid}')"><i class='bi bi-check-circle'></i></button>
              <button onclick="deleteButton('${FetchAdminRow.uuid}')"><i class='bi bi-trash'></i></button>
            </td>
          `;
        }
        
        let is_Active = '';
        if(FetchAdminRow.last_seen && new Date().getTime() - new Date(FetchAdminRow.last_seen).getTime() < 5 * 60 * 1000){
          is_Active = `<div class='active-dot'></div>` ;
        }else{
          if( FetchAdminRow.last_seen ){
            if( new Date().getTime() - new Date(FetchAdminRow.last_seen).getTime() > 48 *60 * 60 * 1000 ){
              is_Active = FetchAdminRow.last_seen;
            }else{
              let UnactiveDate = new Date().getTime() - new Date(FetchAdminRow.last_seen).getTime() ;
              is_Active = timeFormet( UnactiveDate ) + ' ago';
            }
          }else{
            is_Active = `N/A`;
          }
        }
        
        
        
        $('#adminListShowTable').append(`
          <tr>
            <td>${FetchAdminRow.id}</td>
            <td>${FetchAdminRow.name}</td>
            <td>${FetchAdminRow.email}</td>
            <td>${FetchAdminRow.phone}</td>
            <td>${FetchAdminRow.role}</td>
            <td>${FetchAdminRow.last_login_at ? FetchAdminRow.last_login_at : 'N/A' }</td>
            <td>${is_Active}</td>
            <td>${FetchAdminRow.last_login_ip ? FetchAdminRow.last_login_ip : 'N/A' }</td>
            <td>${FetchAdminRow.status}</td>
            <td>${FetchAdminRow.created_at ? FetchAdminRow.created_at : 'N/A'}</td>
            <td>${FetchAdminRow.updated_at ? FetchAdminRow.updated_at : 'N/A'}</td>
            ${action}
          <tr>
        `);
      });
    }
    
    // admin active unactive
    function actionButton( uuid ,statusValue ){
      let formData = new FormData();
      formData.append('uuid', uuid);
      formData.append('statusValue', statusValue);
      
      sendDataAjax("/admin/actionButton",formData,"POST",'fetchAdminList','Nan','Nan','save','Nan');

    }
    // admin deleted
    function deleteButton( FetchAdminRow ){
      let formData = new FormData();
      formData.append('uuid', FetchAdminRow);
      sendDataAjax("/admin/AdminDelete",formData,"POST",'fetchAdminList','Nan','Nan','save','Nan');
    }
    //admin deteils and page access

    
    
    function AccessInAble( page , adminuuid ,id){
      var status = document.getElementById('accessSwitch'+id).checked ? 1 : 0;
      let formData = new FormData();
        formData.append('pagenName', page);
        formData.append('adminuuid', adminuuid);
        formData.append('status', status);
        

        
        sendDataAjax("/admin/AccessInAble",formData,"POST",'Nan','Nan','Nan','save','Nan');
    }
    
    window.back = function() {
      $("#mainContain").html(originalContent1);
    };

    // admin login password eye chang
      let input = document.getElementById("password");
      let eye   = document.getElementById("eye");
       
          eye.onclick = function(){
            if(input.type == "password"){
              input.type = "text";
              eye.classList.remove('bi-eye-slash');
              eye.classList.add('bi-eye');
            }else{
              input.type = "password";
              eye.classList.remove('bi-eye');
              eye.classList.add('bi-eye-slash');  
            }
       }
       
