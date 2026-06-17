<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
   
            <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
            <link rel="stylesheet" href="{{ asset('public/css/Admin/Order.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
<body>
  @include("Admin.Include.Header")
  <div class="main-contain" id="maindiv">
    <div class="search-fillter">
      <div class="div-search">
        <input required class="form-control search shadow-none" id="search_input" oninput="cartIndex();"  type="text" placeholder="Iam looking for..." aria-label="default input example">
        <button class="submit-search"  type="submit"> <i class="bi bi-search"></i></button>
      </div>



      <div class="row">
        <div class="col-md-6  fillter-input-div">
          <input  type="datetime-local" id="time" oninput="cartIndex();" class=" shadow-none fillter-input">
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
            <th scope="col">product name</th>
            <th scope="col">products image</th>
            <th scope="col">product price</th>
            <th scope="col">quantity</th>
            <th scope="col">status</th>
            <th scope="col">created</th>
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
   
      <script src="{{ asset('public/js/Admin/common.js') }} " ></script>
      <script src="{{ asset('public/js/Admin/Cart.js') }} " ></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
