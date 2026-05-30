<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Admin-Details.css') }}">
    
    <!-- icone link -->    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--bootstrap link-->  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body>
    @include("Admin.Include.Header")
    <div class="main-contain" id="mainContain">
      @if( $usercount > 0 )
      
        <button class="btn btn-outline-success" onclick="back()">Admin list</button>
        <button class="btn btn-outline-success"   onclick="AdminPageList()">Page list</button>
      
        <div class="name-2">
          <h1>admin registration</h1>
          <h3 class="name-1"></h3>
          <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#name">
            form
          </button>
        </div>
      @endif
      <h4 class="text-center">admin list</h4>
      <div class="name-2" style="overflow:auto;">
       <!-- prodect show table -->
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">id</th>
              <th scope="col">name</th>
              <th scope="col">email</th>
              <th scope="col">phone</th>
              <th scope="col">role</th>
              <th scope="col">last_login_at</th>
              <th scope="col">last_seen</th>
              <th scope="col">last_login_ip</th>
              <th scope="col">status</th>
              <th scope="col">created_at</th>
              <th scope="col">updated_at</th>
              @if( $usercount > 0 )
                <th scope="col">action</th>
              @endif
            </tr>
          </thead>
          <tbody class="table-group-divider" id="adminListShowTable">
            
          </tbody>
        </table>
      </div>
    </div>
    <div id="showalert"></div>

   <!-- all model site -->
   
        <div class="modal fade" id="name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <label>name</label><br>
                  <input  type="text" id="name1" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                 <label>E-mail</label><br>
                <div class="input-group mb-3">
                  <input  type="email" id="email" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
                <label>phone number</label><br>
                <div class="input-group mb-3">
                  <input  type="number"  id="phone" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
                <label>password</label><br>
                <div class="input-group mb-3">
                  <input  type="password"  id="password" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <i class="bi bi-eye" id="eye"></i>
                </div>
                <label>profile</label><br>
                <div class="input-group mb-3">
                  <input  type="file"  id="profile" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!--jQuery link-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script  src="{{ asset('js/Admin/common.js') }}"></script>
        <script  src="{{ asset('js/Admin/admin/admin-list.js') }}"></script>
        <script  src="{{ asset('js/Admin/admin/admin-page-list.js') }}"></script>
        <script  src="{{ asset('js/Admin/admin/admin-profile-details.js') }}"></script>
  </body>
</html>