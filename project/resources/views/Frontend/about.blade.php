<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id='mata_title'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=''>
   <title></title>
   <link rel="stylesheet" href="{{ asset('css/about.css') }}">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
 
 </head>
 <body>
    @include("Frontend.include.header")
  
  
</head>
<body>

  <section class="about-section">
    <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='weblogo'>
    {!!$about->page!!}
    
    <!--
    <p>Welcome to <strong>YourShop</strong> — your trusted online store for quality products at the best prices. Founded in 2021, we started our journey with a mission to make online shopping simple, reliable, and enjoyable for everyone.</p>
    
    <p>Our goal is to bring you premium-quality items from trusted brands, ensuring fast delivery and top-notch customer support. We believe in honesty, transparency, and building long-term relationships with our customers.</p>

    <div class="values">
      <h2>Our Core Values</h2>
      <ul>
        <li>Customer Satisfaction</li>
        <li>Honesty & Integrity</li>
        <li>Quality Assurance</li>
        <li>Fast Delivery</li>
      </ul>
    </div>

    <div class="team">
      <h2>Meet Our Team</h2>
      <div class="team-members">
        <div class="member">
          <img src="https://via.placeholder.com/200x180" alt="Founder">
          <h3>Zakir Islam</h3>
          <p>Founder & CEO</p>
        </div>
        <div class="member">
          <img src="https://via.placeholder.com/200x180" alt="Manager">
          <h3>Sarah Khan</h3>
          <p>Operations Manager</p>
        </div>
      </div>
    </div>

    <div class="cta">
      <a href="/shop">Shop Now</a>
    </div>
    -->
  </section>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
      FetchCarts();
      usershownotise();
    </script>
    @include("Frontend.include.foter2")
    @include("Frontend.include.foter")
</body>