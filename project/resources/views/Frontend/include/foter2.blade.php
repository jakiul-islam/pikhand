<style>
    @media (max-width:576px) {
   .midiam{
     display: none;
     margin-bottom:60px ;

   }
   .search-input{
    max-width:350px ;
    margin: auto;
    }
}
@media (max-width:992px) {

    .lage{
     display: none;
     position: relative;
     top: 100px;
   }
}
.link{
    text-decoration: none;
    color:#969696;
}
.link:hover{
    text-decoration: none;
    color:black;
}

.name{
    line-height: 0.4;
}
.rows{
    height: 20px;
    width: 100%;
    background-color:#35239B;

}
.row-1{
    height: 100%;
    width:2%;
    display: inline-block;
    padding: 0px;
}
.foter-nav{
    background-color: #35239B;
    width: 100%;
    padding-bottom:10px ;
}

@media (min-width: 576px) {
    .search-input{
    width: 50%;
    margin-left:25% ;
    }
}
.search-input{
  height: 36px;
  background-color: #FFFFFF;
  border-radius: 100px;

  position: relative;
}
.search-input button{
  color: black;
  position: absolute;
  right: 3px;
  top: 0px;
}
.search-input input[type='email']{
  position: absolute;
  left: 9px;
  top: -3px;
  width: 250px;
  outline: none;
  font-size: 20px;
  background: none;
}
.logosvg{
  display: flex;
  justify-content: center;
  align-items: center;
  margin-left: 40%;
}
</style>


<div class="foter-nav">
    <h1 class="text-center" id="newstitle" style="color:#FFFFFF;">The Southsea Deckchair Newsletter</h1>
    <p class="text-center" style="color:#FFFFFF;" id='newssubtitle'>New Releases • Seasonal Promotions • News</p>
    <div class="text-center search-input">
      <input class="search" id="subscribe_input" type="email" placeholder="Enter your email name" aria-label="default input example">
      <button class="search" onclick="subscribers();" id="subscribe_submit" >subscribe</button>
    </div>
</div>
<div class="rows">
    <div class="row-1" style="background-color:green;"></div>
    <div class="row-1" style="background-color:#FFFFFF; margin-left: 4%;"></div>
    <div class="row-1" style="background-color:#F4A6CE; margin:0px;"></div>
    <div class="row-1" style="background-color:#02A6CE; margin:0px;"></div>
    <div class="row-1" style="background-color:green;"></div>
    <div class="row-1" style="background-color:#FFFFFF; margin-left: 4%;"></div>
    <div class="row-1" style="background-color:#F4A6CE;width:8%;"></div>
    <div class="row-1" style="background-color:#02A6CE; width:8%;"></div>
    <div class="row-1" style="background-color:green; width:8%;"></div>
    <div class="row-1" style="background-color:#FFFFFF; margin-left: 4%;"></div>
    <div class="row-1" style="background-color:#F4A6CE; margin:0px;"></div>
    <div class="row-1" style="background-color:#02A6CE; margin:0px;"></div>
    <div class="row-1" style="background-color:#FFFFFF; margin-left: 4%; width:7%;"></div>
    <div class="row-1" style="background-color:#F4A6CE; width:7%;"></div>
    <div class="row-1" style="background-color:#02A6CE; width:7%;"></div>
    <div class="row-1" style="background-color:green;"></div>
    <div class="row-1" style="background-color:#FFFFFF; margin-left: 4%;"></div>
</div>


    <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logosvg' >

    <p class="text-center" id="newssubtitle_2"></p>
    <!-- Accordion -->
    <div class="accordion d-lg-none d-md-none shadow-none"idd="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
            Category
          </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse ">
          <div class="accordion-body">
            @foreach ($Categoryall as $Categoryallrow)
              <a href='/category/{{ $Categoryallrow->slug }}' class="link">{{$Categoryallrow->name}}</a><br>
            @endforeach
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
            Subcategory
          </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
          <div class="accordion-body">
            @foreach ($Categoryall as $Categoryallrow)
              @foreach ($subcategoryall as $subcategoryallrow)
                @if ( $Categoryallrow->id === $subcategoryallrow->category_id )
                  <a href='/category/{{ $Categoryallrow->slug }}/{{$subcategoryallrow->slug}}'
                  class="link" >{{$subcategoryallrow->name}}</a><br>
                @endif
              @endforeach
            @endforeach
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
              Help & Support
            </button>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
            <div class="accordion-body">
              <a class="link" onclick="clickloader()" href="/about">about us</a><br>
              <a class="link" onclick="clickloader()" href="/help">help center</a><br>
              <a class="link" onclick="clickloader()" href="/policies">policies</a><br>
              <a class="link" onclick="clickloader()" href="/feedback">feedback</a><br>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-item">
          <p class="accordion-header ps-3">
              Social media links
          </p>
          <div class="accordion-body">
            <a class="link" href="tel: Unit 5, Victory Trading Estate Kiln Road, Portsmouth, PO3 5LP"><i class="bi bi-geo-alt"></i> Unit 5, Victory Trading Estate Kiln Road, Portsmouth, PO3 5LP</a><br>
            <a class="link" href="tel:jakiulislam@gmail.com"><i class="bi bi-envelope"></i> jakiulislam@gmail.com</a><br>
            <a class="link" href="tel:08801834426305"><i class="bi bi-telephone-forward"></i> 08801834426305</a><br>
          </div>
        </div>
      </div>
    </div>






  <div class="row midiam d-lg-none">
    <div class="col-md-6 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
          Category
        </p>
        <div class="accordion-body">
          @foreach ($Categoryall as $Categoryallrow)
            <a href='/category/{{ $Categoryallrow->slug }}' class="link">{{$Categoryallrow->name}}</a><br>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-md-6 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
          Subcategory
        </p>
        <div class="accordion-body">
          @foreach ($Categoryall as $Categoryallrow)
            @foreach ($subcategoryall as $subcategoryallrow)
              @if ( $Categoryallrow->id === $subcategoryallrow->category_id )
                <a href='/category/{{ $Categoryallrow->slug }}/{{$subcategoryallrow->slug}}'
                class="link" >{{$subcategoryallrow->name}}</a><br>
              @endif
            @endforeach
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-md-6 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
          Help & Support
        </p>
        <div class="accordion-body">
          <a class="link" onclick="clickloader()" href="/about">about us</a><br>
          <a class="link" onclick="clickloader()" href="/help">help center</a><br>
          <a class="link" onclick="clickloader()" href="/policies">policies</a><br>
          <a class="link" onclick="clickloader()" href="/feedback">feedback</a><br>
        </div>
      </div>
    </div>

    <div class="col-md-6 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
            Social media links
        </p>
        <div class="accordion-body">
          <a class="link" href=""><i class="bi bi-geo-alt"></i> Unit 5, Victory Trading Estate Kiln Road, Portsmouth, PO3 5LP</a><br>
          <a class="link" href=""><i class="bi bi-envelope"></i> jakiulislam@gmail.com</a><br>
          <a class="link" href="tel:01834426305"><i class="bi bi-telephone-forward"></i> 08801834426305</a><br>
        </div>
      </div>
    </div>
  </div>
  <div class="row lage">
    <div class="col-lg-3 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
          Category
        </p>
        <div class="accordion-body">
          @foreach ($Categoryall as $Categoryallrow)
            <a href='/category/{{ $Categoryallrow->slug }}' class="link">{{$Categoryallrow->name}}</a><br>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-3 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
          Subategory
        </p>
        <div class="accordion-body">
          @foreach ($Categoryall as $Categoryallrow)
            @foreach ($subcategoryall as $subcategoryallrow)
              @if ( $Categoryallrow->id === $subcategoryallrow->category_id )
                <a href='/category/{{ $Categoryallrow->slug }}/{{$subcategoryallrow->slug}}'
                class='abuttontext' style='font-size:5px;'>{{$subcategoryallrow->name}}</a>
              @endif
            @endforeach
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-3 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
          Help & Support
        </p>
        <div class="accordion-body">
          <a class="link" href="/about">about us</a><br>
          <a class="link" href="/shoping_info">shoping information</a><br>
          <a class="link" href="/policies">policies</a><br>
          <a class="link" href="/feedback">feedbeck</a><br>
       </div>
      </div>
    </div>

    <div class="col-lg-3 text-center">
      <div class="accordion-item">
        <p class="accordion-header ps-3">
            Social media links
        </p>
        <div class="accordion-body">
          <a class="link" href=""><i class="bi bi-geo-alt"></i> Unit 5, Victory Trading Estate Kiln Road, Portsmouth, PO3 5LP</a><br>
          <a class="link" href=""><i class="bi bi-envelope"></i> jakiulislam@gmail.com</a><br>
          <a class="link" href="tel:08801834426305"><i class="bi bi-telephone-forward"></i> 08801834426305</a><br>
        </div>
      </div>
    </div>
  </div>
    <p class="text-center" >© 2024 Southsea Deckchairs Limited. eCommerce</p>
    <p class="text-center" style="line-height:0.3;">by <b>Jakiul islam</b></p>
     <p class="text-center"><a class="link" href="">privice</a>   <a
     class="link" href="">Jakiul islam</a></p>
 <!--  <br><br>-->
 <script src="{{ asset('public/js/Frontend/subscribers.js') }}" ></script>
 <script src="{{ asset('public/js/Frontend/newsletter.js') }}" ></script>
