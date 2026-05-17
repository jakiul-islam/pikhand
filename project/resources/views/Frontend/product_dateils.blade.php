<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id='mata_title'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=''>

    <!--seo  -->

    <title>{{ $posts->mata_title }} | picklet</title>
    <meta name="description" content="{{ Str::limit(strip_tags($posts->mata_description), 150) }}">

    <!--optional-->
    <meta property="og:title" content="{{ $posts->name }} | picklet">
    <meta property="og:description" content="{{ Str::limit(strip_tags($posts->short_description), 150) }}">
    <meta property="og:image" content="{{ asset('uploads/products/' . $posts->image) }}">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ url()->current() }}">
     @php
      $totalRating = 0;
      $count = 0;
      @endphp
      @foreach ($rating as $ratingnumber)
        @if( $posts->id === $ratingnumber->product_id)
          @php
          $totalRating += $ratingnumber->rating;
          $count++;
          @endphp
        @endif
      @endforeach
      @php
        $netprice  = $posts->price * ($posts->discount / 100 );
        $cartPrice = $posts->price - $netprice;
      @endphp


    <script type="application/ld+json">
    {!! json_encode([
      '@context'=> 'https://schema.org/',
      '@type'=> 'Product',
      "name"=> "{{ $posts->name }}",
      "image"=> [
        "{{ asset('uploads/products/' . $posts->image) }}"
      ],
      "description"=> "{{ strip_tags($posts->short_description) }}",
      "sku"=> "{{ $posts->stock }}",
      "offers"=> [
        '@type'=> 'Offer',
        "priceCurrency"=> "USD",
        "price"=> "{{ $cartPrice }}",
        "availability"=> "{{ $posts->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
      ],
      "aggregateRating"=> [
        '@type'=> 'AggregateRating',
        "ratingValue"=> "{{ $count > 0 ? number_format($totalRating / $count, 1) : 0 }}",
        "reviewCount"=> "({{  $count }})"
      ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
    </script>

    <!--seo  -->

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- swiper css link -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    @vite('resources/css/Product_details.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  </head>
  <body>
    @include("Frontend.include.header")
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

                <p class="price-mani2">price : ${{ $cartPrice }}</p><br>
                <br>
                  <div id='buttonshow'>
                    <button class="button" onclick="addCart(
                '{{ $posts->id }}' , '{{ $cartPrice }}' );"><i class="bi
                bi-cart-check"></i>
                Add to Cart</button>
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

                  <p style="margin-left: ; line-height:0.2;">
                        @if($count > 0 )
                         <strong>rating:</strong> <i class="bi bi-star-fill" style="color:#FFDA25;"></i>
                          {{ $count > 0 ? number_format($totalRating / $count, 1) : 0 }}
                          ({{  $count }})
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
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Prodect Reviews
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div class="accordion-body" id='collapse3'>
                    <div class="AllratingAndReview">
                  @if( $count > 0)
                      <h5>All ratting and review  ( {{$count}} )</h5>
                      <h5>{{ $count > 0 ? number_format($totalRating / $count, 1) : 0 }} <i class='bi
                      bi-star-fill' style="color:#FFDA25;"></i></h5>
                    </div>
                    @foreach ($rating as $ratingnumber)
                      @if( $posts->id === $ratingnumber->product_id)
                        <div class='show_rating_div'>
                          @foreach ($user_profile as $ratinguser)
                            @if($ratinguser->user_id  === $ratingnumber->user_id)
                              <img src="/storage/{{ $ratinguser->profile_picture ??
                                  asset('/storage/logo/20251004_172547.png')  }}"
                                  onerror="this.src='{{ asset('/storage/logo/20251004_172547.png')  }}'"
                                  style='height:50px; width:60px;'
                                  alt="{{ $posts->name }}">
                            @else
                              <img src="/storage/logo/20251007_184157.jpg "
                                  style='height:50px; width:60px;'
                                  alt="{{ $posts->name }}">
                            @endif

                          @endforeach
                          <div>

                            @foreach ($users as $userRow)
                              @if($userRow->id  === $ratingnumber->user_id)
                                <h4 class="reviewUserName">{{$userRow->name}}</h4>
                            @endif
                          @endforeach
                            <div class="rating-star">
                              @for($i=1; $i <= $ratingnumber->rating; $i++)
                                <i class="bi bi-star-fill" style="color:#FFDA25;
                                "></i>
                              @endfor
                              {{$ratingnumber->created_at}}
                             </div>
                              <div>
                                <div id="lessReviewText{{$ratingnumber->id}}"
                                style="display:block;">
                                  <h6 style="" class="reviewtext">{!!
                                    Str::limit($ratingnumber->review, 70 )!!}
                                  </h6>
                                    <button onclick="MoreAndLessReviewText( '{{$ratingnumber->id}}' )" class="reviewtextsee">see more</button>
                                </div>
                                <div style="display:none;"  id="MoreReviewText{{$ratingnumber->id}}" >
                                  <h6  class="reviewtext">{!! $ratingnumber->review
                                  !!}  </h6>
                                    <button onclick="MoreAndLessReviewText(
                                    '{{$ratingnumber->id}}' )"
                                    class="reviewtextsee">see less</button>

                                </div>
                              </div>
                            <div class="reviewImg">
                              @foreach( $product_review_img as $review_img)
                                @if($review_img->reviews_id === $ratingnumber->id)
                                  <img src="/storage/{{ $review_img->img ??
                                  asset('/storage/logo/20251004_172547.png')  }}"
                                  onerror="this.src='{{ asset('/storage/logo/20251004_172547.png')  }}'"
                                  style='height:70px; '
                                  alt="{{ $posts->name }}">
                                @endif
                              @endforeach
                            </div>
                          <!--  <div class="like-div">
                              <button class="buttontext"
                              onclick="likeAndDislike('{{$ratingnumber->id}}','like')"><i
                              class="bi
                              bi-hand-thumbs-up"
                              ></i></button>
                              (1)
                              <button class="buttontext" onclick="likeAndDislike('{{$ratingnumber->id}}','dislike')"><i class="bi bi-hand-thumbs-down"
                              ></i></button>
                              (3)
                            </div>-->
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @else
                    <h1 class="text-center">reviews not found</h1>
                  @endif
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>

      <div class="row prodect" id=''>
        <h1 class="text-center" >recomendetion product</h1>
        @foreach ($recomendition as $product)

        @php
          $netprice  = $product->price * ($product->discount / 100 );
          $cartPrice = $product->price - $netprice;
        @endphp
          <div class="col-6 col-md-3 col-lg-2">
            <div class="card">
              <a href='/product/{{ $product->slug }}' class="abuttontext">


               <img src="/storage/{{ $product->image ??
                  asset('/storage/logo/20251004_172547.png')  }}"
     onerror="this.src='{{ asset('/storage/logo/20251004_172547.png')  }}'"
     style='height:150px; ' class="card-img-top p-img"
     alt="{{ $product->name }}">


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

      <div class="d-flex justify-content-center" style='
    margin-bottom:-20px; margin-top:20px;'>
       {{ $recomendition->links() }}
        </div>

           <br>
      <div id='showallalert' class="alartdiv text-center"></div>
    <script>

      FetchCarts();
      usershownotise();

      function MoreAndLessReviewText( reviewid ){
        let lessReviewText = document.getElementById('lessReviewText'+reviewid);
        let MoreReviewText = document.getElementById('MoreReviewText'+reviewid);

        if(lessReviewText.style.display == 'block'){
          lessReviewText.style.display ='none';
          MoreReviewText.style.display ='block';
        }else{
          MoreReviewText.style.display ='none';
          lessReviewText.style.display ='block';
        }
      }

    </script>
      @include("Frontend.include.foter2")
      @include("Frontend.include.foter")
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
