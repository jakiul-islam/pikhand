   @include("Frontend.include.Preloader")

 <link rel="stylesheet" href="{{ asset('public/css/Header.css')}}">
  <link rel="stylesheet" href="{{ asset('public/css/Header-category.css')}}">
 
 
<!--  @import './Header.c hzzbbsdbdss';-->
<!--@import '.Header-category.css';-->


    <!--navber -->
  <nav class="navbar navbar-expand-sm fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler text-light shadow-none"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <!--  <i class="fa-solid fa-bars"></i> -->
        <i class="bi bi-list" style="font-size:2rem"></i>
      </button>
      <div class="name-div">
        <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logosvg' >
      </div>

      <!--  end carts offcanvas -->

      <div class="crad">

        <button class="text-button" style="color:#FFFFFF;" type="button"  data-bs-toggle="offcanvas" data-bs-target="#Notification" aria-controls="Notification">
          <div class="notification" onclick='notificationIndex()'>
            <i class="bi bi-bell-fill" style="font-size:1.3rem; color:red;"></i>
            <span class="badge" style="color:red;" id="notificationCount"></span>
          </div>
        </button>

        <button class="text-button" style="color:#FFFFFF;" type="button" data-bs-toggle="offcanvas" data-bs-target="#userInfo" aria-controls="userInfo">
          <i class="bi bi-person-fill-add" style="font-size:1.7rem;"></i> </button>

        <button class="text-button" style="color:#FFFFFF;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">

          <div class="notification">
            <i class="bi bi-cart" style="font-size:1.6rem; "></i>
            <span class="badge" id='countcarts'> </span>
          </div>

        </button>

      </div>
      <div class="input">
        <form method="GET" action="{{ route('search') }}" class="d-flex search-div" role="search">

          <input required name="search_input" class="form-control search shadow-none" id="search_input"
          oninput="show_all_search_item(); chackinput();" onclick="show_on();" type="text" placeholder="Iam looking for..."
          aria-label="default input example">
          <button class="submit search"  type="submit"> <i class="bi
          bi-search"></i></button>
        </form>
      </div>

      <div class="show-search-result" id="show_prevus_search">
         <div>
           <button class="btn btn-close" onclick="show_off();"></button>
            <ul class="navbar-nav" id="show_search">

            </ul>
         </div>
      </div>


      <!-- end nevItame offcanvas -->

      <!-- nav offcanvas start for Category-->
      <div style="width:300px; margin-left:-10px;" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header bg-dark">
          <h5 class="offcanvas-title text-light" id="offcanvasDarkNavbarLabel">Menu</h5>
          <button type="button" class="btn-close bg-light shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">




          <ul style="width:100%; overflow:auto;" class="navbar-nav" id="">
            <!-- usercategory -->

            @foreach ($Categoryall as $Categoryallrow)

              <li class="nav-item header-category" onclick=" subcategory( '{{ $Categoryallrow->id }}', '{{ $Categoryallrow->slug }}' ); " >
                <a class="nav-link active" aria-current="page" href="#">{{ $Categoryallrow->name }}</a>
                <p style="margin: 0;"><i class="bi bi-caret-down"  id='subbuttonicon_{{$Categoryallrow->id}}'></i></p>
              </li>
                <div style=''>
                  <div class='header-subcategory-container' id='subcategoryshow_{{$Categoryallrow->id}}' class='subcategory'>

                    @foreach ($subcategoryall as $subcategoryallrow)
                      @if ( $Categoryallrow->id === $subcategoryallrow->category_id )
                        <div  style='margin:4px; cursor:pointer;' id='{{$subcategoryallrow->name}}' >
                          <a onclick="clickloader()" href='/category/{{$Categoryallrow->slug}}/{{$subcategoryallrow->slug}}' class='abuttontext'>
                            {{$subcategoryallrow->name}}
                          </a>
                        </div>
                      @endif
                    @endforeach





                  </div>
                </div>


            @endforeach

            <li class="nav-item header-category" >
              <a class="buttontext"  href="/" onclick="clickloader()"
              style="text-decoration:none; color:black; font-size:25px;">home</a>
            </li>
          </ul>





        </div>
      </div>
      <!-- end nevItame offcanvas -->
    </div>
  </nav>

  <div style='height:120px; width:100%; overflow:auto;'>
    @foreach ($Categoryall as $Categoryallrow)
      @foreach ($subcategoryall as $subcategoryallrow)
        @if ( $Categoryallrow->id === $subcategoryallrow->category_id )
          <a href='/category/{{ $Categoryallrow->slug }}/{{$subcategoryallrow->slug}}'
          class='abuttontext' style='font-size:5px;'>{{$subcategoryallrow->name}}</a>
        @endif
      @endforeach
    @endforeach
  </div>


    <br class="br-di-nane">
    <nav class="navbar" style='background-color:#FF9696; height:30px;
    display:none;' id='notise_nav'>
      <div class="container-fluid" style='display: flex; justify-content: center;'>
        <h5 class='text-center' id='notise_show'
        style="color:black; margin-top:-6px;"></h5>
      </div>
    </nav>

    <div id="showalert"></div>


    <input type="hidden" id="webLogoForUseScript" value="{{$webInfo->logo}}">
  <!--   <br style='display:none;' id='notise_br'> -->



 @include("Frontend.include.userSetting")
 @include("Frontend.include.hederUser")
