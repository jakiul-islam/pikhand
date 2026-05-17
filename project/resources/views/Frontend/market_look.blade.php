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
    .allcatagory {
        display: flex;
        overflow-x: auto;
        overflow-y: hidden;
        gap: 10px;
        padding: 2px;
        height: auto;
        border: 1px solid #ccc;
        margin-left:10px ;
        
    }
    
    .column {
        flex: 0 0 auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    
    /* Scrollbar styling (optional) */
    .allcatagory::-webkit-scrollbar {
        height: 10px;
    }
    .allcatagory::-webkit-scrollbar-thumb {
      background: red;
      border-radius: 5px;
     
    }
    .card{
      width: 150px;
    }
</style>
  </head>
  <body>
    @include("Frontend.include.header")
      <div id="indexbody" class="row prodect">
        <h1  >Top Selling product-{{ $productcount }}</h1>
        <div class="row prodect" id=''>
          
          <div class="allcatagory" id="">
            @for ($i = 0; $i < count($posts); $i += 2)
              @php
                $item1 = $posts[$i];
                $item2 = $posts[$i + 1] ?? null;
              @endphp
    
              <div class="column">
                @php
                  $netprice  = $item1->price * ($item1->discount / 100 );
                  $cartPrice = $item1->price - $netprice;
                @endphp
                  <div class="card">
                    <a href='/product/{{ $item1->slug }}' class="abuttontext">
                     <img src="{{ asset('storage/'.$product->image) }}" 
                          onerror="this.onerror=null; this.src='{{ asset('storage/logo/file_000000007f10720b9cd7b85085a7673a.png') }}'" 
                          style='height:150px;' 
                          class="card-img-top p-img" 
                          alt="{{ $product->name }}"
                      >
                     
                      <div class="">
                        <h3 class="card-title" style="margin:5px; font-size:17px;">
                          <a href='/product/{{ $item1->slug }}'class="abuttontext">{{ Str::limit($item1->name, 20 )}}</a>
                        </h3>
                        <p style="margin-left: 5%; line-height:0.5;">
                          @php
                            $totalRating = 0;
                            $count = 0;
                          @endphp
                          @foreach ($rating as $ratingnumber)
                            @if( $item1->id === $ratingnumber->product_id)
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
                          {{$item1->total_sales}} sold
                        </p> 
                        <p style=' margin-left:5px;font-size:25px; line-height:0px;'>${{$cartPrice}}</p> 
                      </div>
                    </a>
                    <button class='btn btn-outline-dark' onclick="addCart(
                    {{$item1->id}},{{$cartPrice}});" style='height:30px; width:90%; margin:5%;
                    margin-top:0px; display:flex; align-item:center; justify-content:
                    center; '>add to card</button>
                  </div>
                  @if ($item2)
                    @php
                      $netprice  = $item2->price * ($item2->discount / 100 );
                      $cartPrice = $item2->price - $netprice;
                    @endphp
                    <div class="card">
                      <a href='/product/{{ $item2->slug }}' class="abuttontext">
                       <img src="{{ asset('storage/'.$product->image) }}" 
                            onerror="this.onerror=null; this.src='{{ asset('storage/logo/file_000000007f10720b9cd7b85085a7673a.png') }}'" 
                            style='height:150px;' 
                            class="card-img-top p-img" 
                            alt="{{ $product->name }}"
                        >
                       
                        <div class="">
                          <h3 class="card-title" style="margin:5px; font-size:17px;">
                            <a href='/product/{{ $item2->slug }}'class="abuttontext">{{ Str::limit($item2->name, 20 )}}</a>
                          </h3>
                          <p style="margin-left: 5%; line-height:0.5;">
                            @php
                              $totalRating = 0;
                              $count = 0;
                            @endphp
                            @foreach ($rating as $ratingnumber)
                            @if( $item2->id === $ratingnumber->product_id)
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
                            {{$item2->total_sales}} sold
                          </p> 
                          <p style=' margin-left:5px;font-size:25px; line-height:0px;'>${{$cartPrice}}</p> 
                        </div>
                      </a>
                      <button class='btn btn-outline-dark' onclick="addCart(
                      {{$item2->id}},{{$cartPrice}});" style='height:30px; width:90%; margin:5%;
                      margin-top:0px; display:flex; align-item:center; justify-content:
                      center; '>add to card</button>
                    </div>
                  @endif
              </div>
            @endfor
          </div>
             <div class="d-flex justify-content-center" style='
              margin-bottom:-20px; margin-top:10px;'>
              {{ $posts->links() }}
            </div> 
            
            
        @if($Todayproductcount > 0)
          <br>
          <h1>Today product-{{ $Todayproductcount }}</h1>
            <div class="allcatagory" id="">
            @for ($i = 0; $i < count($Todayproduct); $i += 2)
              @php
                $item1 = $Todayproduct[$i];
                $item2 = $Todayproduct[$i + 1] ?? null;
              @endphp
    
              <div class="column">
                @php
                  $netprice  = $item1->price * ($item1->discount / 100 );
                  $cartPrice = $item1->price - $netprice;
                @endphp
                  <div class="card">
                    <a href='/product/{{ $item1->slug }}' class="abuttontext">
                    <img src="{{ asset('storage/'.$product->image) }}" 
                        onerror="this.onerror=null; this.src='{{ asset('storage/logo/file_000000007f10720b9cd7b85085a7673a.png') }}'" 
                        style='height:150px;' 
                        class="card-img-top p-img" 
                        alt="{{ $product->name }}"
                    >
                     
                      <div class="">
                        <h3 class="card-title" style="margin:5px; font-size:17px;">
                          <a href='/product/{{ $item1->slug }}'class="abuttontext">{{ Str::limit($item1->name, 20 )}}</a>
                        </h3>
                        <p style="margin-left: 5%; line-height:0.5;">
                          @php
                            $totalRating = 0;
                            $count = 0;
                          @endphp
                          @foreach ($rating as $ratingnumber)
                            @if( $item1->id === $ratingnumber->product_id)
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
                          {{$item1->total_sales}} sold
                        </p> 
                        <p style=' margin-left:5px;font-size:25px; line-height:0px;'>${{$cartPrice}}</p> 
                      </div>
                    </a>
                    <button class='btn btn-outline-dark' onclick="addCart(
                    {{$item1->id}},{{$cartPrice}});" style='height:30px; width:90%; margin:5%;
                    margin-top:0px; display:flex; align-item:center; justify-content:
                    center; '>add to card</button>
                  </div>
                  @if ($item2)
                    @php
                      $netprice  = $item2->price * ($item2->discount / 100 );
                      $cartPrice = $item2->price - $netprice;
                    @endphp
                    <div class="card">
                      <a href='/product/{{ $item2->slug }}' class="abuttontext">
                       <img src="{{ asset('storage/'.$product->image) }}" 
                            onerror="this.onerror=null; this.src='{{ asset('storage/logo/file_000000007f10720b9cd7b85085a7673a.png') }}'" 
                            style='height:150px;' 
                            class="card-img-top p-img" 
                            alt="{{ $product->name }}"
                        >
                       
                        <div class="">
                          <h3 class="card-title" style="margin:5px; font-size:17px;">
                            <a href='/product/{{ $item2->slug }}'class="abuttontext">{{ Str::limit($item2->name, 20 )}}</a>
                          </h3>
                          <p style="margin-left: 5%; line-height:0.5;">
                            @php
                              $totalRating = 0;
                              $count = 0;
                            @endphp
                            @foreach ($rating as $ratingnumber)
                            @if( $item2->id === $ratingnumber->product_id)
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
                            {{$item2->total_sales}} sold
                          </p> 
                          <p style=' margin-left:5px;font-size:25px; line-height:0px;'>${{$cartPrice}}</p> 
                        </div>
                      </a>
                      <button class='btn btn-outline-dark' onclick="addCart(
                      {{$item2->id}},{{$cartPrice}});" style='height:30px; width:90%; margin:5%;
                      margin-top:0px; display:flex; align-item:center; justify-content:
                      center; '>add to card</button>
                    </div>
                  @endif
              </div>
            @endfor
          </div>
             <div class="d-flex justify-content-center" style='
              margin-bottom:-20px; margin-top:10px;'>
              {{ $Todayproduct->links() }}
            </div> 
        @endif
            
            
        </div>
      </div>
      <br>
      
     
    <div id='showallalert' class="alartdiv text-center"></div>
  </body>
  <script>
      FetchCarts();
      usershownotise();
    </script>
    @include("Frontend.include.foter2")
    @include("Frontend.include.foter")
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      
  </body>