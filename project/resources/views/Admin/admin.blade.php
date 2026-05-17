<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    @vite('resources/css/Admin/Common.css')
     <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body>
    @include("Admin.Include.header")
   <div class="main-contain">
       <div class="name-2">
          <h1>admin registration</h1>
          <h3 class="name-1">successfull</h3>
          <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#name">
            edit
          </button>
       </div>
       <div class="name-2">


       <!-- prodect show table -->
       <table class="table table-dark table-hover">
           <thead>
    <tr>
      <th scope="col">sr</th>
      <th scope="col">admin username</th>
      <th scope="col">delete</th>
      <th scope="col">active</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">

    <tr>
      <th scope="row"></th>
      <td></td>
      <td><a href="?"class="btn btn-primary">delete</a></td>
      <td>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault"></label>
        </div>
    </td>
    </tr>

  </tbody>
       </table>
              </div>
   </div>
   <!-- all model site -->

   <div class="modal fade" id="name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <label>username</label><br>
                <input type="text" class="form-control" id="adminname" required value=""><br>
                 <label>E-mail</label><br>
                <div class="input-group mb-3">
                  <input  type="email" id="adminemail" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
                <label>phone number</label><br>
                <div class="input-group mb-3">
                  <input  type="number"  id="adminphone" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
                 <label>password</label><br>
                <div class="input-group mb-3">
                  <input  type="password"  id="adminpassword" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <i class="bi bi-eye"></i>
                </div>
              </div>
              <div class="modal-footer">
                <button type="resat" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="insert_admin" class="btn btn-primary"
                >save</button>

              </div>
            </div>
          </div>
        </div>
    <script>
      $(document).ready(function(){
        $("#insert_admin").click(function(){
          const prodectInsertButton =document.querySelector("#insert_admin");
            prodectInsertButton.innerHTML = `
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Loading...</span>
            `;
            prodectInsertButton.disabled = true;

              let formData = new FormData();
              formData.append('adminname', $('#adminname').val());
              formData.append('adminemail', $('#adminemail').val());
              formData.append('adminphone', $('#adminphone').val());
              formData.append('adminpassword', $('#adminpassword').val());
            $.ajax({
              url : '/admin/insert_admin',
              type :'POST',
              processData: false,
              contentType: false,
              data: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              success:function(response){
                      //  alert ("reagistation successfull");
                  $('#adminname').val('');
                  $('#adminemail').val('');
                  $('#adminphone').val('');
                  $('#adminpassword').val(''); // Don't forget this if you want to clear it too
                  prodectInsertButton.innerHTML = `insert brand`;
                  prodectInsertButton.disabled = false;

                  var modal = bootstrap.Modal.getInstance($('#name')[0]);
                  modal.hide();
                  brandFetch();
                },
                error:function(xhr,status,error){
                  prodectInsertButton.innerHTML = `insert brand`;
                  prodectInsertButton.disabled = false;
                  alert ('Error:'+ xhr.responseText);
                  const response = JSON.parse(xhr.responseText);
                }
            });
          });
      });
    </script>
   <script>

       let input = document.getElementById("input");
       let img   = document.getElementById("img");

       img.onclick = function(){
           if(input.type == "password"){
               input.type = "text";
               img.src = "../Img/eye1.jpg";
           }else{
               input.type = "password";
               img.src = "../Img/eye.jpg";
           }
       }

   </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
