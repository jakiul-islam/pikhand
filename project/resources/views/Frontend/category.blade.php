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
    <title>{{ $Category->meta_title }}| {{ $page > 1 ? ' - Page| ' . $page : '' }} picklet</title>
    <meta name="description" content="{{ $Category->meta_description }} |{{ $page > 1 ? ' - Page| ' . $page : '' }} picklet ">

    <!--  seo section -->
    <meta property="og:title" content="{{ $Category->name }} | picklet">
    <meta property="og:description" content="{{ Str::limit(strip_tags($Category->short_description), 150) }}">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ url()->current() }}">
    @php
        $itemList = [];

        foreach ($posts as $index => $product) {
            $itemList[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'item' => [
                    '@type' => 'Product',
                    'name' => $product->name,
                    'description' => strip_tags($product->short_description),
                    'image' => asset('storage/'.$product->image),
                    'sku' => $product->stock ?? 'N/A',
                    'offers' => [
                        '@type' => 'Offer',
                        'url' => route('product.details', $product->slug),
                        'priceCurrency' => 'USD',
                        'price' => $product->price,
                        'availability' => 'https://schema.org/InStock'
                    ]
                ]
            ];
        }
    @endphp

    <!--"https://schema.org/"-->
    <script type="application/ld+json">
    {!! json_encode([
        '@context'=> 'https://schema.org/',
        '@type'=> 'CollectionPage',
        "name"=> "{{ $Category->name }}",
        "description"=> "{{ strip_tags($Category->short_description) }}",
        "mainEntity"=> [
            '@type'=> 'ItemList',
            "itemListOrder"=> "https://schema.org/ItemListOrderAscending",
            'numberOfItems'=> '{{ count($posts) }}',
            "itemListElement"=> $itemList
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
    <!--"https://schema.org/"-->

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


<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#000000">


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
        <div class="d-flex justify-content-center" style='height:100px; margin-bottom:-40px; margin-top:20px;'>
          {{ $posts->links() }}
        </div>

        <h2>Product Summary</h2>
          <div>
            {!! $Category->short_description !!}
          </div>

        <h2>Full Product Description</h2>
          <div>
            {!! $Category->description !!}
          </div>

      </div>
      {{-- <button id="installBtn" style="display:none; padding:10px 15px; background:#000; color:#fff; border:none; border-radius:6px;">
  Install App
</button> --}}
    <div id='showallalert' class="alartdiv text-center"></div>
  </body>

<script>

// let deferredPrompt;
// const installBtn = document.getElementById('installBtn');

// window.addEventListener('beforeinstallprompt', (e) => {
//     e.preventDefault();
//     deferredPrompt = e;

//     // button show
//     installBtn.style.display = 'block';

//     installBtn.addEventListener('click', () => {
//         installBtn.style.display = 'none';
//         deferredPrompt.prompt();

//         deferredPrompt.userChoice.then((choiceResult) => {
//             if (choiceResult.outcome === 'accepted') {
//                 console.log('User accepted install');
//             } else {
//                 console.log('User dismissed install');
//             }
//             deferredPrompt = null;
//         });
//     });
// });








//     if ('serviceWorker' in navigator) {
//         navigator.serviceWorker.register('/sw.js');
//     }
</script>


   <script>

      FetchCarts();
      usershownotise();


    </script>
    @include("Frontend.include.foter2")
    @include("Frontend.include.foter")
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
