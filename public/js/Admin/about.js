        $(document).ready(function(){
          $("#InsertAbout").click(function(){
            const InsertAbout =document.querySelector("#InsertAbout");
            InsertAbout.innerHTML = `
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Loading...</span>
            `;
            InsertAbout.disabled = true;
        
        
              let formData = new FormData();
              formData.append('Aboutdescription', $('#Aboutdescription').val());
              
              
              
            $.ajax({
              url : '/admin/about/store',
              type :'POST',
              processData: false,
              contentType: false,
              data: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              success:function(response){
                  
                InsertAbout.innerHTML = `Insert about`;
                InsertAbout.disabled = false;
                var modal = bootstrap.Modal.getInstance($('#name')[0]);
                modal.hide();
                index();
                showalert( 'About page update successfull', '#ffffff',
                'ShowAlert' );
              },
                error:function(xhr,status,error){
                  InsertAbout.innerHTML = `Insert about`;
                  InsertAbout.disabled = false;
                  alert ('Error:'+ xhr.responseText);
                  const response = JSON.parse(xhr.responseText);
                  console.log(xhr.responseText);
                }
            });
          });
      });
        
        //fetch Help
        function index(){
          $.ajax({
            url: "/admin/about/index",  
            type: "GET",
            dataType: "json",
            success: function(response) {
              let showAboutPage = document.getElementById('showAboutPage');
              $('#showAboutPage').html(''); 
              showAboutPage.innerHTML = response.about.page;
              $('#Aboutdescription').val(response.about.page)
            },
            error: function (xhr, status, error) {
              console.log(xhr.responseText);
              alert(xhr.responseText);
            }
          });
        }
        index();
   