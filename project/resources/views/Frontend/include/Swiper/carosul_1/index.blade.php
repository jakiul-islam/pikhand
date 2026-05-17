
  <!-- Demo styles -->
  <style>
    .allcatagory {
        display: flex;
        overflow-x: auto;
        overflow-y: hidden;
        gap: 10px;
        padding: 2px;
        height: 225px;
        border: 1px solid #ccc;
        margin-left:10px;
        margin-right:10px !important;
    }
    
    .column {
        flex: 0 0 auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .categroy-img {
        width: 150px;
        height: 100px;
        background-color: #eee;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
        text-decoration: none;
        color:#ffffff;
    }
    
    /* Scrollbar styling (optional) */
    .allcatagory::-webkit-scrollbar {
        height: 10px;
    }
    .allcatagory::-webkit-scrollbar-thumb {
      background: red;
      border-radius: 5px;
     
    }
    .carousel-img{
      height:500px !important;
    }
</style>

  <!-- Swiper -->
  <div>
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators" id='number_slide'>
      </div>
      <div class="carousel-inner" id='showofar'>
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
  </div> 
 <!-- catagory show section-->
  <h1 class='text-center'>ALL CATEGROY</h1>
    <div class="allcatagory" id="">
      
      @for ($i = 0; $i < count($Categoryall); $i += 2)
        @php
          $item1 = $Categoryall[$i];
          $item2 = $Categoryall[$i + 1] ?? null;
        @endphp
    
        <div class="column">
            <a style="cursor: pointer;" href="/category/{{ $item1->slug }}" class="categroy-img">
                <img src="/storage/{{ $item1->image }}" alt="{{ $item1->name }}" style="border-radius:5px; height:100%; width:100%;">
            <a href="/category/{{ $item1->slug }}" style='display:none;'
            class="categroy-img">{{ $item1->name }}</a>
            </a>
            @if ($item2)
                <a style="cursor: pointer;" href="/category/{{ $item2->slug }}" class="categroy-img">
                  <img src="/storage/{{ $item2->image }}" alt="{{ $item1->name }}" style="border-radius:5px; height:100%; width:100%;">
                  <a href="/category/{{ $item1->slug }}" style='position: absolute; left: -9999px;' class="categroy-img">{{ $item1->name }}</a>
                </a>
            @endif
        </div>
      @endfor
    </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    
   //Fetchservice service
    function fetchBannner(){
      $.ajax({
        url: "/fetchBannner",  
        type: "GET",
        dataType: "json",
        success: function(response) {
          $('#showofar').html('');
          $('#number_slide').html('');// পুরানো ডাটা মুছে ফেলবে
          $.each(response, function(index, bannerRow) {
            $('#number_slide').append(`
               <button type="button" data-bs-target="#carouselExampleIndicators"
               data-bs-slide-to="${index}" class='${index === 0 ? 'active' : ''}' aria-label="Slide ${index + 1}"></button>
            `)
            $('#showofar').append(`
              <div  class="carousel-item ${index === 0 ? 'active' : ''}">
                <img src="/storage/${bannerRow.image}" style='height:auto;' class="d-block w-100"
                     alt="${bannerRow.image}" class='carousel-img'>
              </div>
            `);
          });
        },
      });
    }
    fetchBannner();
  </script>
  