  $(document).ready(function() {
    $("#insertclose").click(function() {
      // Clear form fields and hide preview image
      $('#voucherCode').val('');
      $('#VouchersType').val('');
      $('#voucherAnount').val('');
      $('#minprice').val('');
      $('#usage_limit').val('');
      $('#start_at').val('');
      $('#end_at').val(''); // Don't forget this if you want to clear it too
    });
  });
    
  function InsertVoucher(){
    const voucherInsertButton =document.querySelector("#InsertVoucher");
    voucherInsertButton.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    voucherInsertButton.disabled = true;
   
    let formData = new FormData();
      formData.append('voucherCode', $('#voucherCode').val());
      formData.append('VouchersType', $('#VouchersType').val());
      formData.append('voucherAnount', $('#voucherAnount').val());
      formData.append('minprice', $('#minprice').val());
      formData.append('usage_limit', $('#usage_limit').val());
      formData.append('start_at', $('#start_at').val());
      formData.append('end_at', $('#end_at').val());

      
    $.ajax({
      url : '/admin/InsertVoucher',
      type :'POST',
      processData: false,
      contentType: false,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
              //  alert ("reagistation successfull");
          $('#voucherCode').val('');
          $('#VouchersType').val('');
          $('#voucherAnount').val('');
          $('#minprice').val('');
          $('#usage_limit').val('');
          $('#start_at').val('');
          $('#end_at').val('');

          voucherInsertButton.innerHTML = `insert voucher`;
          voucherInsertButton.disabled = false;
          var modal = bootstrap.Modal.getInstance($('#name')[0]);
          modal.hide();
          vouchersFetch();
          
          showalert( `Vouchers insert successfull` ,'green','maindiv');
          
          
        },
        error:function(xhr,status,error){
          voucherInsertButton.innerHTML = `insert voucher`;
          voucherInsertButton.disabled = false;
          alert ('Error:'+ xhr.responseText);
          
          console.log(xhr.responseText);
        }
    });
  }
  //index voucher
  function vouchersFetch(){
    $('.editor-modal').remove(); 
    $.ajax({
      url: "/admin/Fetchvoucher",  
      type: "GET",
      dataType: "json",
      success: function(response) {
        $('#allBrand').html(''); // পুরানো ডাটা মুছে ফেলবে
        $.each(response, function(index, voucher) {
          let vewlId = `vew${index}`;
          let editeId = `edite${index}`;
          let DelmodalId = `DelModal${index}`;
          $('#allBrand').append(`
            <tr>
              <td>${voucher.id}</td>
              <td>${voucher.code}</td>
              <td>${voucher.type}</td>
              <td>${voucher.amount}</td>
              <td>${voucher.min_order_amount}</td>
              <td>${voucher.usage_limit}</td>
              <td>${voucher.used_count}</td>
              <td>${voucher.starts_at}</td>
              <td>${voucher.ends_at}</td>
              <td><button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#${vewlId}">
                <i class='bi bi-eye'></i>
              </button>
              <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#${editeId}">
                <i class='bi bi-pencil-square'></i>
              </button>
              <button type="button" class="buttonText" data-bs-toggle="modal" data-bs-target="#${DelmodalId}">
                <i class='bi bi-trash'></i>
              </button></td>
            </tr>
          `);
          $('body').append(`
            <div class="modal fade editor-modal" id="${vewlId}" tabindex="-1" aria-labelledby="${vewlId}Label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="${vewlId}Label">catagory motels</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h1 class='text-center'>${voucher.code}</h1>
                    <p>id:${voucher.id}</p>
                    <p>${voucher.type}</p>
                    <p>${voucher.amount}</p>
                   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="modal fade editor-modal  editeModel" id="${editeId}" tabindex="-1" aria-labelledby="${editeId}Label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="${editeId}Label">etid
                    voucher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      
                    <div class="row input-div">
              <div class="col-12 col-md-6 col-lg-6 ">
                <label  id="addon-wrapping">code</label><br>
                <input type="text" value='${voucher.code}' required
                id="edit_voucherCode_${voucher.id}"class="form-control" placeholder="Vouchers code"
                aria-label="Username" aria-describedby="addon-wrapping">
              </div>
              <div class="col-12 col-md-6 col-lg-6 ">
                <label  id="addon-wrapping">vouchers type</label><br>
                <select type="text"  required id="edit_VouchersType_${voucher.id}"
                class="form-control "  >
                  <option value="">select one Vouchers type</option>
                  <option ${  voucher.type ==  'percentage'  ? 'selected'
                  : ''  } value="percentage">percentage</option>
                  <option ${  voucher.type ==  'fixed'  ? 'selected'
                  : ''  } value="fixed">fixed</option>
                </select>
              </div>
              <div class="col-12 col-md-6 col-lg-6 ">
                <label  id="addon-wrapping">amount</label><br>
                <input value='${voucher.amount}' type="number" id="edit_voucherAnount_${voucher.id}" required
                class="form-control " placeholder="voucher amount" aria-label="Username"
                aria-describedby="addon-wrapping">
              </div>
              <div class="col-12 col-md-6 col-lg-6 ">
                <label  id="addon-wrapping">min order amount</label><br>
                <input value='${voucher.min_order_amount}' type="number" id="edit_minprice_${voucher.id}" required
                class="form-control " placeholder="min order amount " aria-label="Username"
                aria-describedby="addon-wrapping">
              </div>
              <div class="col-12 col-md-6 col-lg-6 ">
                <label  id="addon-wrapping">usage limit</label><br>
                <input value='${voucher.usage_limit}' type="number" id="edit_usage_limit_${voucher.id}" required
                class="form-control " placeholder="usage limit" aria-label="Username"
                aria-describedby="addon-wrapping">
              </div>

              <div class="col-12 col-md-6 col-lg-6 ">
                <label   id="addon-wrapping">start time</label><br>
                <input value='${voucher.starts_at}' type="datetime-local" id="edit_start_at_${voucher.id}" required
                class="form-control " placeholder="vouchers stat time" aria-label="Username"
                aria-describedby="addon-wrapping">
              </div>
              <div class="col-12 col-md-6 col-lg-6 ">
                <label  id="addon-wrapping">end time</label><br>
                <input value='${voucher.ends_at}'
                type="datetime-local" id="edit_end_at_${voucher.id}" required
                class="form-control " placeholder="vouchers end time" aria-label="Username"
                aria-describedby="addon-wrapping">
              </div>
              <br>
            </div>
                  
                  </div>
               
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="editvoucher(
                    '${voucher.id}' );" id='EditeSaveButton_${voucher.id}'
                    class="btn
                    btn-primary editebutton${voucher.id}">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="modal fade deleteModel editor-modal" id="${DelmodalId}" tabindex="-1" aria-labelledby="${DelmodalId}Label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5"
                    id="${DelmodalId}Label">${voucher.code}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <input type='hidden' id='deleteId' value='${voucher.id}'>
                    <p>${voucher.code}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button"
                    onclick="deletevouchers('${voucher.id}')"
                    id="deletebutton" class="btn
                    btn-danger deletebutton${voucher.id}">delete</button>
                  </div>
                </div>
              </div>
            </div>
          `);
        });
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
        alert(xhr.responseText);
      }
    });
  }
  vouchersFetch();
  //voucher edit
  function editvoucher( voucherid ){
   
    const vouchereditbutton =document.querySelector("#EditeSaveButton_"+voucherid);
    vouchereditbutton.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    vouchereditbutton.disabled = true;
    
      let formData = new FormData();
        formData.append('edit_voucherid', voucherid );
        formData.append('edit_voucherCode', $('#edit_voucherCode_'+voucherid).val());
        formData.append('edit_VouchersType', $('#edit_VouchersType_'+voucherid).val());
        formData.append('edit_voucherAnount', $('#edit_voucherAnount_'+voucherid).val());
        formData.append('edit_minprice', $('#edit_minprice_'+voucherid).val());
        formData.append('edit_usage_limit', $('#edit_usage_limit_'+voucherid).val());
        formData.append('edit_start_at', $('#edit_start_at_'+voucherid).val());
        formData.append('edit_end_at', $('#edit_end_at_'+voucherid).val());


       $.ajax({
            url : '/admin/edite_voucher',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        success:function(response){
                //alert ("reagistation successfull");
                vouchereditbutton.innerHTML = `save change`;
                vouchereditbutton.disabled = false;
               var modal =
               bootstrap.Modal.getInstance(document.querySelector('.editeModel.show'));
                modal.hide();
                showalert( ' Vouchers insert successfull ' ,'#ffffff','maindiv');

               vouchersFetch();

        },
        error:function(xhr,status,error){
              prodectInsertButton.innerHTML = `save change`;
              prodectInsertButton.disabled = false;
              
                alert ('Error:'+ xhr.responseText);
                const response = JSON.parse(xhr.responseText);
               
                console.log(xhr.responseText);
            }
        });
       
  }
  //end voucher change function
  //delete voucher
  function deletevouchers( voicherid ){

    const prodectInsertButton =document.querySelector(".deletebutton"+voicherid);
    prodectInsertButton.innerHTML = `
      <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">Loading...</span>
    `;
    prodectInsertButton.disabled = true;
      
    const DeleteInputerror =document.querySelector("#editeInputerror");
   
    let formData = new FormData();
    formData.append('voicherid', voicherid);
    $.ajax({
            url : '/admin/deletevoucher',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
              prodectInsertButton.innerHTML = `delete`;
              prodectInsertButton.disabled  = false;
              var modal =
               bootstrap.Modal.getInstance(document.querySelector('.deleteModel.show'));
                modal.hide();
              vouchersFetch();
            },
          error:function(xhr,status,error){
            prodectInsertButton.innerHTML = `delete`;
            prodectInsertButton.disabled  = false;
            }
        });
       
  }