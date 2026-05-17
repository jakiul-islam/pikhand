  function show_on(){
    let show_prevus_search = document.getElementById('show_prevus_search');
    show_prevus_search.style.display = 'block';
    show_all_search_item();
  }
  
  function show_off(){
    let show_prevus_search = document.getElementById('show_prevus_search');
    show_prevus_search.style.display = 'none';
  }
 
 
  function show_all_search_item(){
    let show_prevus_search = document.getElementById('show_search');
    let search_input       = document.getElementById('search_input').value;
    let show_prevus_search1 = document.getElementById('show_prevus_search');
    
    if( search_input.length > 0 ){
      show_prevus_search1.style.display = 'block';
    }
    
    let formData = new FormData();
    formData.append('search_input', $('#search_input').val());
    
    $.ajax({
      url:"/search/item",
      type:"POST",
      processData:false,
      contentType:false,
      data: formData,
      headers:{
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success: function(response){
        $('#show_search').html('');
        
        response.topKeywords.forEach(function(topKeywordsrow,index) {
          $('#show_search').append(`
            <li class="nav-item">
              <a class="nav-link active" aria-current="page"
              href="/search?search_input=${topKeywordsrow.keyword}">${topKeywordsrow.keyword}</a>
            </li>
          `);
        });
        
        response.products.forEach(function(product,index) {
          $('#show_search').append(`
            <li class="nav-item">
              <a class="nav-link active" aria-current="page"
              href="/search?search_input=${product.name}">${product.name}</a>
            </li>
          `);
        });
        
        if( response.product_count < 1 && response.topKeywords_count < 1){
          show_prevus_search1.style.display = 'none';
        }
        
      },
      error:function(xhr,status,errors){
        // alert(xhr.responseText);
        console.log(xhr.responseText);
        
      }
    });
  }
  show_all_search_item();
  
  function chackinput(){
    let search_input       = document.getElementById('search_input').value;
    if( search_input.length === 0 ){
      let show_prevus_search1 = document.getElementById('show_prevus_search');
      show_prevus_search1.style.display = 'none';
    }
  }