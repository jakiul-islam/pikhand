      //alert section
      window.showalert= function( alert1, color, id ){

        const Inputerror =document.getElementById(id);
        Inputerror.style = `
          position: fixed;
          bottom: 70px;
          z-index: 1300;
          background-color: rgba(0, 0, 0, 0.6);
          left:50%;
          transform: translateX(-50%);
          border-radius: 30px;
          display: block;
          padding-bottom: -10px;
          color:#ffffff;
        `;
        Inputerror.innerHTML=`
          <style>
            .alert_span{
              margin:10px;
            }
          </style>
          <p class='alert_span'>
            ${alert1}
          </p>
        `;

        setTimeout(() => {
          Inputerror.style.display = 'none';
        }, 3000);
      }

    // All fetch data
    window.fetchDataAjax = function( url, type , SuccessCollBack , ErrorCollBack ){

      $.ajax({
        url : url,
        type :type,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          if( SuccessCollBack !== 'Nan'){
            window[SuccessCollBack]( response );
          }
        },
        error:function(xhr,status,error){
          if( ErrorCollBack !== 'Nan'){
            window[ErrorCollBack]( xhr,status,error );
          }
          console.log(xhr.responseText);
        }
      });
    }
    //insert common function
    window.sendDataAjax = function( url,formData, type , SuccessCollBack , ErrorCollBack,  buttonId , buttonName , models){
      let pageNameButton = null;

      if(buttonId !== 'Nan'){
         pageNameButton =document.getElementById(buttonId);
        pageNameButton.innerHTML = `
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        `;
        pageNameButton.disabled = true;
      }

      $.ajax({
        url : url,
        type :type,
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          showalert( response.message,'#ffffff','showalert');
          if(SuccessCollBack !== 'Nan'){
            window[SuccessCollBack]( response );
          }
          if(models !== 'Nan'){
            var modal = bootstrap.Modal.getInstance($('#'+models)[0]);
            modal.hide();
          }
          if(buttonId !== 'Nan'){
            pageNameButton.innerHTML = buttonName;
            pageNameButton.disabled = false;
          }
        },
        error:function(xhr,status,error){
          if(ErrorCollBack !== 'Nan'){
            window[ErrorCollBack]( response );
          }
          if(buttonId !== 'Nan'){
            pageNameButton.innerHTML = buttonName;
            pageNameButton.disabled = false;
          }
          const response = JSON.parse(xhr.responseText);
          console.log(xhr.responseText);
          showalert( response.errors,'#ffffff','showalert');
        }
      });
    }
    //common deteils show function
    window.detailsDataAjax = function( url,formData, type , SuccessCollBack , ErrorCollBack,  buttonId , buttonName , models){

      let pageNameButton = null;
      if(buttonId !== 'Nan'){
        pageNameButton =document.getElementById(buttonId);
        pageNameButton.innerHTML = `
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        `;
        pageNameButton.disabled = true;
      }

      $.ajax({
        url : url,
        type :type,
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          if(SuccessCollBack !== 'Nan'){
            window[SuccessCollBack]( response );
          }
          if(models !== 'Nan'){
            var modal = bootstrap.Modal.getInstance($('#'+models)[0]);
            modal.hide();
          }
          if(buttonId !== 'Nan'){
            pageNameButton.innerHTML = buttonName;
            pageNameButton.disabled = false;
          }
        },
        error:function(xhr,status,error){
          if(ErrorCollBack !== 'Nan'){
            window[ErrorCollBack]( response );
          }
          if(buttonId !== 'Nan'){
            pageNameButton.innerHTML = buttonName;
            pageNameButton.disabled = false;
          // 
            const response = JSON.parse(xhr.responseText);
            console.log(xhr.responseText);
            showalert( response.errors,'#ffffff','showalert');
          }
        }
      });
    }


    window.timeFormet = function( diff ){
      //var diff = new Date().getTime() - new Date(FetchAdminRow.last_seen).getTime();
      var seconds = Math.floor(diff / 1000);
      var minutes = Math.floor(seconds / 60);
      var hours = Math.floor(minutes / 60);
      var days = Math.floor(hours / 24);

      var timeString = "";
      if (days > 0) {
          timeString += days + " day ";
      }
      if (hours % 24 > 0) {
          timeString += (hours % 24) + " hour ";
      }
      if (minutes % 60 > 0) {
          timeString += (minutes % 60) + " minutes ";
      }
      if (seconds % 60 > 0) {
        //  timeString += (seconds % 60) + " seconds ";
      }

      return timeString.trim();
    }

    // এডমিনের স্ট্যাটাস আপডেট করার জন্য জাভাস্ক্রিপ্ট ফাংশন
  /*
    setInterval(function() {
      let formData = new FormData();
      formData.append('pagenName', 'jssjsh');

      detailsDataAjax("/admin/update-last-seen-logout",formData,"POST",'Nan','Nan','Nan','save','Nan');
    }, 300000);
  */
    window.activeTimeUpdate = function(){
      let formData = new FormData();
      formData.append('pagenName', 'jssjsh');
      detailsDataAjax("/admin/update-last-seen-logout",formData,"POST",'Nan','Nan','Nan','save','Nan');
    }

 //   activeTimeUpdate();
