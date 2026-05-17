<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id='mata_title'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=''>
    <link rel="stylesheet" href="{{ asset('css/Ratting.css') }}">
    <title></title>
   
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <a class="backbutton" href="/home"> <i class="bi bi-arrow-left"></i> </a>
    <!-- show product slider  -->
      
      @php
        $netprice  = $posts->price * ($posts->discount / 100 );
        $cartPrice = $posts->price - $netprice;
      @endphp
      
      
        <div class="prodect_ditels" id='product_detels_show'>
          <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators" id='number_slidep'>
                @foreach ( $productsimg as $index => $productImg)
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class='{{ $index === 0 ? 'active' : ''}}' aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner" id='showofarp'>
              
              
              @if(!empty($productsimg) && count($productsimg) > 0)
                @foreach ( $productsimg as $index => $productImg)
                  <div  class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="/storage/{{ $productImg->images ??
                      asset('/storage/logo/20251004_172547.png')  }}"
                      onerror="this.src='{{ asset('/storage/logo/20251004_172547.png')  }}'"
                      style='height:300px; ' class="d-block w-100"
                      alt="{{ $posts->name }}">
                  </div>
                @endforeach
              @else
                <div  class="carousel-item  active ">
                  <img src="/storage/{{ $posts->image ??
                      asset('/storage/logo/20251004_172547.png')  }}"
                      onerror="this.src='{{ asset('/storage/logo/20251004_172547.png')  }}'"
                      style='height:300px; ' class="d-block w-100"
                      alt="{{ $posts->name }}">
                  </div>
              @endif
              
              
              
              
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          
            <div>
              <p></p>
              <p>
              </p>
                <p class="price-mani2">price : ${{ $cartPrice }}</p><br>
                <br>
                  <div id='buttonshow'>
                  </div>
            </div>
              <br>
            <div class="accordion shadow-none" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   Prodect Description
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body" id='collapse1'>
                   
                   
                  <h1>{{ $posts->name }}</h1>
                  <p><strong>Discount:</strong> {{ $posts->discount }}%</p>
                  
                  <p><strong>Stock:</strong> 
                    @if ($posts->stock > 0)
                      In Stock ({{ $posts->stock }} items)
                    @else
                      <span style="color:red;">Out of Stock</span>
                    @endif
                  </p>
                  
                  <p>
                    <strong>Price:</strong> 
                    ${{ $cartPrice }} 
                    @if ($posts->price > $cartPrice)
                      <del>${{ $posts->price }}</del>
                    @endif
                  </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Prodect Specification
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body" id='collapse2'>
                    <h2>Product Summary</h2>
                    <div>
                      {!! $posts->short_description !!}
                    </div>
                    
                    <h2>Full Product Description</h2>
                    <div>
                      {!! $posts->long_description !!}
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item show">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Send Reviews
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div class="accordion-body " id='collapse3'>
                    <div class="ratting-div" id='ratting_div'>
                      <i class="bi bi-star" id="star-1" onmouseover="starmous( '1' );"></i>
                      <i class="bi bi-star" id="star-2" onmouseover="starmous( '2' );"></i>
                      <i class="bi bi-star" id="star-3" onmouseover="starmous( '3' );"></i>
                      <i class="bi bi-star" id="star-4" onmouseover="starmous( '4' );"></i>
                      <i class="bi bi-star" id="star-5" onmouseover="starmous( '5' );"></i>
                      <p id="showstarret"></p>
                      <input type="hidden" id="showstarinput">
                      <textarea style="width:100%;" rows="3" id="Rattingtextarea"></textarea>
                      <input type="hidden" id="ProductId" value="{{ $posts->id }}">
                      <br>
                        <div class="img-div-show">
                          <div id="previewContainer">
                            
                          </div>
                          <div class="img-input">
                            <i class="bi bi-camera-fill"></i>
                            <input type="file" onchange="myltipulImg();" id="myltipulImg" accept="image/*" multiple>
                          </div>
                        </div>
                      <br>
                      <button class="btn btn-success" onclick="sendratting();"
                      id="addratingphotobutton">Send Your ratting</button>
                    
                    </div>
                      <div id='show_rating'>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          
          
          
         
          
          
           <br>
      <div id='showalert' class=" text-center"></div>
      
      
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/Frontend/common/common.js')}}"></script>
    <script src="{{ asset('js/Frontend/ratting.js')}}"></script>
  </body>