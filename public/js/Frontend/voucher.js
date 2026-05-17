  function voucherapply(){
    let showPrice = document.getElementById('showPrice');
    let voucherapplybutton = document.getElementById('voucherapplybutton');
    voucherapplybutton.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    voucherapplybutton.disabled = true;
    let priceinput = document.getElementById('showPriceForVoucher');
    if(priceinput.value.length  < 1){
      showalert('select your cart product' , '#ffffff' ,'showallalert');
      voucherapplybutton.innerHTML = `Apply`;
      voucherapplybutton.disabled = false;
    }else{
      let formData = new FormData();
      formData.append('Apply_voucher', $('#Apply_voucher').val());
      formData.append('showPriceForVoucher', $('#showPriceForVoucher').val());
      
      $.ajax({
        url : '/chack/voucher',
        type :'POST',
        processData: false,
        contentType: false,
        data: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success:function(response){
          voucherapplybutton.innerHTML = `Apply`;
          voucherapplybutton.disabled = false;
          if(response.status === true){
            let voucherapplyprice = $('#showPriceForVoucher').val()  -  response.result.amount;
            showPrice.innerHTML = 'price:$'+ voucherapplyprice;
          }else{
            showalert(response.result , '#ffffff' ,'showallalert');
          }
        },
        error:function(xhr,status,error){
          voucherapplybutton.innerHTML = `Apply`;
          voucherapplybutton.disabled = false;
          const response = JSON.parse(xhr.responseText);
          showalert( response.message , '#ffffff' ,'showallalert');
        }
      });
    }
  }