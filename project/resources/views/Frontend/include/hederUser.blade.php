    <div class="offcanvas offcanvas-end" tabindex="-1" id="userInfo" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header" style="background-color:#FF9696; height:45px;">
        <h5 class="offcanvas-title "
         id="offcanvasDarkNavbarLabel">my account</h5>
         <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body cart" style='height:100%; overflow:auto;'>
        <div class="row">
          <div class="col-7">
            welcome to js store
          </div>
          <div class="col-5" id="sessionDashbordLink">
            @if (session()->has('user_email'))
              <button class="justify-content-end btn btn-outline-success"
              style='margin-top:-10px;margin-bottom:5px;'
              onclick='userDeshboard();'>
                {{ session('name') }}
              </button>
              <input type='hidden' id="loginOrnotFor" value="session('user_uuid')">
            @else
              <button class="justify-content-end btn btn-outline-success" style='margin-top:-10px;margin-bottom:5px;' onclick="loginOrsignup()">LOGIN/SIGNUP</button>
            @endif
          </div>
          <div class="col-5" id="DashbordLink" style="display:none;">
          </div>
        </div>
        <div style="background-color:#DFDADC; height:7px; "></div>
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3"  id="userInfo">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/"> 🏠 Home</a>
          </li>
          <hr>
          <li class="nav-item">
            <button style="background:none; color:none;" class="nav-link "
            aria-current="page" onclick="Allordershow( 'All' );" > 📦 My
            order</button>
          </li>
          <hr>

          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="/feedback">  📝 Feedback</a>
          </li>
          <hr>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="/policies"> 📜 Policies</a>
          </li>
          <hr>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="/help">❓ Help</a>
          </li>
          <hr>

   <!--  <div style='height:100px; width:100%;' class="bg-tertiary">
            <button class='btn btn-outline-success' onclick="userinfo()" >sinup nuw</button>
          </div>-->
        </ul>
      </div>
    </div>
    <!-- Notification -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="Notification" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header" style="background-color:#FF9696; height:45px;">
        <h5 class="offcanvas-title "
         id="offcanvasDarkNavbarLabel">Notification</h5>
         <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body cart" style='height:100%; overflow:auto;'>



        <ul class="notification-list" id="notificationContainer">
          <!-- Unread notifications -->

            <h1>Notification not found</h1>

        </ul>






      </div>
    </div>




    <!-- cart offcanvas -->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header" style="background-color:#FF9696; height:45px;">
        <h5 class="offcanvas-title "
          id="offcanvasDarkNavbarLabel">All Product</h5>
        <button class="text-right" id='cartdeletebutton'
        onclick="cartsdelete()" style='background:none; border:none;
        position:absolute; right:40px; display:none;'><i class="bi bi-trash-fill
                      text-light" style="font-size:16px;" ></i></button>
        <button type="button" class="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

    <style>
    @media (min-width: 400px) {
      .cart{
          margin-top:-35px ;
      }
    }
    </style>

      <div class="offcanvas-body cart" style="height:65%; overflow:auto;">
        <ul   class="navbar-nav "
         id="cartsProdectshow">

        </ul>
        <div style="display:flex;">
          <input type="hidden" id='showPriceForVoucher'>
          <input id="Apply_voucher" type="text" placeholder="Enter your voucher code" style="margin:10px; width:90%;" id="voicher"
         class="form-control" >
         <button id='voucherapplybutton' onclick="voucherapply();"
         >Apply</button>
        </div>
      </div>

       <br>

       <div style='height:50px; width:100%; background-color:black;
       position:absolute; bottom:0px; color:#ffffff;'>
         <h5> <small id="showPrice" > price: </small></h5>
         <button type="button" onclick="orderinsert();"  id='chackoutbutton'
         style='display:none; position:absolute; right:6px; bottom:5px;'
         class="btn btn-success shadow-none" >chackout</button>
       </div>
       <!-- href='/home/chackout' -->
     </div>
   </div>



 <!--  end carts offcanvas -->
