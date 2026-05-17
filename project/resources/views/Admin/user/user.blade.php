<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Admin/User.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
 
  </head>

<body>
  @include("Admin.Include.header")
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
            <option  value="All">All user</option>
            <option  value="1">active</option>
            <option  value="0">unactive</option>
          </select>
        </div>
        <div class="col-md-6  fillter-input-div">
          <select value="All" id="selectcountry" onchange="index();" class="shadow-none fillter-input" aria-label="Default select example">
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
      <table class="table  table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">id</th>
            <th scope="col">number</th>
            <th scope="col">name</th>
            <th scope="col">country</th>
            <th scope="col">email</th>
            <th scope="col">login</th>
            <th scope="col">logout</th>
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
    <script src="{{ asset('js/Admin/common.js') }}"></script>
    <script src="{{ asset('js/Admin/user/user.js') }}"></script>
  </body>
</html>