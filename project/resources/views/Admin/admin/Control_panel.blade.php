<html>
    <head>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            .login{
                position: absolute;
                top:50%;
                left: 50%;
                transform: translate(-50%,-50%);
                width: 500px;
                margin: 60px;
            }
            .login-f{
                padding: 30px;
            }
            .nav-link{
              margin-top: -15px;
              margin-left: -15px;
            } 
        </style>
        <title>
            e commerce login panal
        </title>
    </head>
    <body>
    
    

    
    
    <div class="login">
        <div class="shadow">
            <div class="login-f">
                <h4 align="center"><img src="storage/$webInfo->logo"></h4>
            <h2>Admin Login</h2>
              <form method="POST" action="{{ route('admin.login.submit') }}">
              <!--  action="{ route('admin.login.submit') }" -->
                
                  @csrf
                @if ($errors->any())
                  <div class="alert alert-danger" id="error-alert">
                    {{ $errors->first('email') }}
                  </div>
                @endif
                  <label>Email</label>
                  <input type="email" name="email" required  value="{{ old('email') }}"
                  class="form-control" placeholder="Ender your email">
                  <br>
                  <label>Password</label>
                  <div class="input-group mb-3">
                    <input type="password" id='password' name="password" required class="form-control" placeholder="Enter your password" aria-label="Recipient’s username" aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2" onclick='eyechange();'><i class="bi bi-eye" id='icone'></i></span>
                  </div>   
                  <a class="nav-link">Forgot password !!</a>
                  <button type="submit">Login</button>
              </form>
            </div>
    </div>
    </div>
    <!-- app password =pxgq uhzw fgst wzri
app password = pxgq uhzw fgst wzri -->
	      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      <script>
        
        window.addEventListener('pageshow', function(event) {
          if (event.persisted) {
            window.location.reload();
          }
        });
        
        
        function eyechange(){
          let password = document.getElementById('password');
          let icone    = document.getElementById('icone');
          
          if(password.type === 'password' ){
            password.type = 'text';
            icone.classList.remove("bi-eye");
            icone.classList.add("bi-eye-slash");
          }else{
            password.type = 'password';
            icone.classList.remove("bi-eye-slash");
            icone.classList.add("bi-eye");
          }
        }
        
        //alert time set 
        
        setTimeout(() => {
        const alert = document.getElementById('error-alert');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = 0;
            setTimeout(() => alert.remove(), 500); // Fade out শেষে এলিমেন্ট মুছে ফেলে
        }
    }, 3000);
        
      </script>
    </body>
</html>