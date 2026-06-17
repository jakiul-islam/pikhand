<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    @vite([
        'resources/css/Admin/common.css',
        'resources/css/Admin/Order.css'
    ])
      <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
      <link rel="stylesheet" href="{{ asset('public/css/Admin/product.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


  </head>
<body>
  @include("Admin.Include.Header")
  <div class="main-contain" id="maindiv">
    <div class="search-fillter">
      <div class="div-search">
        <input required class="form-control search shadow-none" id="search_input" oninput="orderIndex();"  type="text" placeholder="Iam looking for..." aria-label="default input example">
        <button class="submit-search"  type="submit"> <i class="bi bi-search"></i></button>
      </div>



      <div class="row">
        <div class="col-md-6  fillter-input-div">
          <select id="select" onchange="orderIndex();" class="shadow-none fillter-input" aria-label="Default select example">
            <option  value="All">All order</option>
            <option  value="pending">pending</option>
            <option  value="processing">processing</option>
            <option  value="shipped">shipped</option>
            <option  value="completed">completed</option>
            <option  value="refunded">refunded</option>
          </select>
        </div>

        <div class="col-md-6  fillter-input-div date-pleceHolder">
          <span id="datePleceHolder">Date & Time (Orders After)</span>
          <input  type="datetime-local" id="time" oninput="orderIndex(); pleceHolderSet();"class=" shadow-none fillter-input" >
        </div>
      </div>
    </div>


    <input type="hidden" id="webLogo" value="{{$webInfo->logo}}">
    <div class="name-2">
      <div style="overflow:auto;">
      <!-- prodect show table -->
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">id</th>
              <th scope="col">user name</th>
              <th scope="col">phone number</th>
              <th scope="col">number</th>
              <th scope="col">subtotal</th>
              <th scope="col">discount</th>
              <th scope="col">shipping_cost</th>
              <th scope="col">total</th>
              <th scope="col">payments method</th>
              <th scope="col">payments status</th>
              <th scope="col">status</th>
              <th scope="col">order time</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="showOrder">

          </tbody>
        </table>
        <div id="paginationLinks"></div>
      </div>
    </div>
  </div>

   <!-- all model site -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite([
        'resources/js/Admin/common.js',
        'resources/js/Admin/order/order.js'
    ])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
