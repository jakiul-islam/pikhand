<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/Admin/User.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  
  <style>
    .shipping-address{
      background-color:#E4E4E4 ;
      box-sizing: border-box;
      padding: 10px;
      display:flex;
      position: relative;
      
    }
  </style>
  
<body>
  @include("Admin.Include.Header")
  <div class="main-contain" id="maindiv">
    <div class="search-fillter">
      <div class="div-search">
        <input required class="form-control search shadow-none" id="search_input"
          oninput="index();"  type="text" placeholder="Iam looking for..." aria-label="default input example">
        <button class="submit-search"  type="submit"> <i class="bi bi-search"></i></button>
      </div>
      
    <input type="hidden" id="webLogo" value="{{$webInfo->logo}}">

      
      <div class="row">
        <div class="col-md-6  fillter-input-div">
          <select id="select" onchange="index();" class="shadow-none fillter-input" aria-label="Default select example">
            <option  value="All">All Payment</option>
            <option  value="pending">pending</option>
            <option  value="authorized">authorized</option>
            <option  value="paid">paid</option>
            <option  value="failed">failed</option>
            <option  value="refunded">refunded</option>
          </select>
        </div>
        <div class="col-md-6  fillter-input-div">
          <select id="selectMethod" onchange="index();" class="shadow-none fillter-input" aria-label="Default select example">
            <option  value="All">All Payment method</option>
            <option  value="cash_on_delivery">cash_on_delivery</option>
            <option  value="bkash">bkash</option>
            <option  value="nagads">nagads</option>
            <option  value="card">card</option>
            <option  value="stripe">stripe</option>
            <option  value="paypal">paypal</option>
          </select>
        </div>
        <div class="col-md-6  fillter-input-div">
          <input  type="datetime-local" id="time" oninput="index();" class=" shadow-none fillter-input">
        </div>
      </div>
    </div>



    <div class="name-2">
      <div style="overflow:auto;">
      <!-- prodect show table -->
      <table class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">id</th>
            <th scope="col">user name</th>
            <th scope="col">phone number</th>
            <th scope="col">order number</th>
            <th scope="col">amount</th>
            <th scope="col">currency</th>
            <th scope="col">method</th>
            <th scope="col">status</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider" id="showUser">
          
        </tbody>
      </table>
        <div id="paginationLinks"></div>
      </div>
    </div>
  </div>
   <!-- all model site -->
   
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/Admin/common.js') }}"></script>
    <script src="{{ asset('public/js/Admin/payment.js') }}"></script>
  </body>
</html>