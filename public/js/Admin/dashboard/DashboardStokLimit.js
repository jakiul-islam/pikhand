    function productStokLimit(){
      window.originalContent = $("#Adminpagediv").html();
      fetchDataAjax('/admin/product/stok/limit','post','productStokLimitData','Nan');
    }
    function productStokLimitData(response){
      let Adminpagediv = document.getElementById('Adminpagediv');
      let allchart = document.getElementById('allchart');

      allchart.style.display     = 'none';
      Adminpagediv.style.display = 'block';

      Adminpagediv.innerHTML=`
        <h3 class='text-center'>stock limit</h3>
        <div style='overflow:auto;'>
          <table class="table table-hover">
          <thead class='table-dark '>
            <tr>
              <th scope="col">id</th>
              <th scope="col">name</th>
              <th scope="col">image</th>
              <th scope="col">stock</th>
              <th scope="col">price</th>
              <th scope="col">discount</th>
              <th scope="col">total_sales</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="ShowOrder">
          </tbody>
        </div>
      `;
          
          
      $('#ShowOrder').html('');// পুরানো ডাটা মুছে ফেলবে
      $.each(response.products, function(index, productsRow) {
        if(productsRow.stock < 20){
          $('#ShowOrder').append(`
            <tr class='${productsRow.stock < 5 ? 'table-danger' : ''}'>
              <td>${productsRow.id}</td>
              <td>${productsRow.name}</td>
              <td><img src='/storage/${productsRow.image}' height='100'></td>
              <td><input oninput="updateStockLimit('${productsRow.id}');"
              type='number' style='width:40px;' value='${productsRow.stock}' id='productStock${productsRow.id}'></td>
              <td>${productsRow.price}</td>
              <td>${productsRow.discount}</td>
              <td>${productsRow.total_sales}</td>
            </tr>
          `);
        }
      });
    }
   //update stockLimit 
 
  function updateStockLimit( productid ){
    let updateStok = document.getElementById('productStock'+productid).value;
    let formData = new FormData();
      formData.append('updateStok', updateStok);
      formData.append('productid', productid);
      
      sendDataAjax('/admin/product/update/stok/limit',formData,'post','Nan','Nan','Nan','Nan','Nan');
  }
  