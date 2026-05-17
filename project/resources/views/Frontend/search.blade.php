<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
 
    @php
      $page = request()->get('page', 1);
    @endphp
    <title>
      All Products{{ $page > 1 ? ' - Page ' . $page : '' }} | Picklet - Explore Our Full Range
    </title>
    <meta name="description" content="Browse all products{{ $page > 1 ? ' - Page ' . $page : '' }} available at Picklet. From electronics to fashion, find top-quality items at great prices with fast delivery. Discover your perfect pick today!">
    
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- swiper css link -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
      .alartdiv{
        position: fixed;
        bottom: 70px;
        z-index: 1300;
        background-color: rgba(0, 0, 0, 0.6);
        margin-left: 30%;
        border-radius: 30px;
        display: none;
        height: 37px;
        line-height: 0;
      }
    </style>
  </head>
  <body>
    @include("Frontend.include.header")
      <div id="indexbody" class="row prodect">
        <h1 class="text-center" >PRODUCTS-{{ $productcount }}</h1>
        <div class="row prodect" id=''>
          <!--   $cartPrice = number_format($product->price - $netprice); -->
          @foreach ($posts as $product)
            @php
              $netprice  = $product->price * ($product->discount / 100 );
              $cartPrice = $product->price - $netprice;
            @endphp
            <div class="col-6 col-md-3 col-lg-2">
              <div class="card">
                <a href='/product/{{ $product->slug }}' class="abuttontext">
                <img src="{{ asset('storage/'.$product->image) }}" 
                    onerror="this.onerror=null; this.src='{{ asset('storage/logo/file_000000007f10720b9cd7b85085a7673a.png') }}'" 
                    style='height:150px;' 
                    class="card-img-top p-img" 
                    alt="{{ $product->name }}"
                >                
                  
                  <div class="">
                    <h3 class="card-title" style="margin:5px; font-size:17px;">
                        <a href='/product/{{ $product->slug }}'class="abuttontext">{{ Str::limit($product->name, 20 )}}</a>
                    </h3>
                    <p style="margin-left: 5%; line-height:0.2;">
                      @php
                            $totalRating = 0;
                            $count = 0;
                          @endphp
                          @foreach ($rating as $ratingnumber)
                            @if( $product->id === $ratingnumber->product_id)
                              @php
                              $totalRating += $ratingnumber->rating;
                              $count++;
                              @endphp
                            @endif
                          @endforeach
                          @if($count > 0 )
                            <i class="bi bi-star-fill" style="color:#FFDA25;"></i>
                            {{ $count > 0 ? number_format($totalRating / $count, 1) : 0 }}
                            ({{  $count }})
                          @endif
                    </p> 
                    <p style=' margin-left:5px;font-size:25px; line-height:0px;'>${{$cartPrice}}</p> 
                  </div>
                </a>
                <button class='btn btn-outline-dark' onclick="addCart(
                {{$product->id}},{{$cartPrice}});" style='height:30px; width:90%; margin:5%;
                margin-top:0px; display:flex; align-item:center; justify-content:
                center; '>add to card</button>
              </div>
            </div>
          @endforeach
        </div>
        <input type="hidden" id="search_value" value="{{$search_input}}">
      </div>
      <div class="d-flex justify-content-center" style='height:100px; margin-bottom:-40px; margin-top:20px;'> {{ $posts->links() }}
      </div> 
    <div id='showallalert' class=" text-center"></div>
  </body>
  @include("Frontend.include.foter2");
  @include("Frontend.include.foter");
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
      FetchCarts();
      function search_value(){
        let search_value = document.getElementById('search_value').value;
        
         $('#search_input').val(search_value);
        
        //alert(search_value);
        
      }
      search_value();
      usershownotise();
      
    </script>
  </body>