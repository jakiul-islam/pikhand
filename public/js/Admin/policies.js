
        $(document).ready(function(){
          $("#InsertPolicies").click(function(){
            const InsertPolicies =document.querySelector("#InsertPolicies");
            InsertPolicies.innerHTML = `
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Loading...</span>
            `;
            InsertPolicies.disabled = true;
        
        
              let formData = new FormData();
              formData.append('Policiesdescription', $('#Policiesdescription').val());
              
              
              
            $.ajax({
              url : '/admin/policie/store',
              type :'POST',
              processData: false,
              contentType: false,
              data: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              success:function(response){
                  
                InsertPolicies.innerHTML = `Insert Policies`;
                InsertPolicies.disabled = false;
                var modal = bootstrap.Modal.getInstance($('#name')[0]);
                modal.hide();
                index();
              },
                error:function(xhr,status,error){
                  InsertPolicies.innerHTML = `Insert Policies`;
                  InsertPolicies.disabled = false;
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
            url: "/admin/policie/index",  
            type: "GET",
            dataType: "json",
            success: function(response) {
              let showPoliciesPage = document.getElementById('showPoliciesPage');
              $('#showPoliciesPage').html(''); 
              showPoliciesPage.innerHTML = response.policies.page;
              $('#Policiesdescription').val(response.policies.page)
            },
            error: function (xhr, status, error) {
              console.log(xhr.responseText);
              alert(xhr.responseText);
            }
          });
        }
        index();
   