<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>jis food admin panale</title><!--bootstrap link-->  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('publc/css/Admin/Common.css') }}">
     <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <style>
      .input-div div{
        padding: 3px;
      }
      .input-div{
        box-sizing: border-box;
        padding: 5px;
      }
      .buttonText{
        background: none;
        border: nones;
        color:black;
      }
      .buttonText i{
        color:black;
      }
      .table{
        width: 200px;
        overflow: outo;
      }
      .alertdiv{
        position: fixed;
        bottom: 70px;
        z-index: 1300;
        background-color: rgba(0, 0, 0, 0.6);
        padding-top: 5px;
        border-radius: 30px;
        display: none;
        height: 37px;
        line-height: 0;
      }
    </style>
  </head>
    
  <body>
   @include("Admin.include.header")
    <div class="main-contain">
      <div class="name-2" >
        <h1>Insert vouchers</h1>
        <h3 class="name-1">
        </h3>
        <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#name">
            Insert vouchers 
        </button>
      </div>
       <!-- prodect show table -->
      <div style="width:100%; overflow:auto;">
        <table class="table  table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">code</th>
              <th scope="col">type</th>
              <th scope="col">amount</th>
              <th scope="col">min_order_amount</th>
              <th scope="col">usage_limit</th>
              <th scope="col">used_count</th>
              <th scope="col">start time</th>
              <th scope="col">end time</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <tbody class="table-group-divider " id="allBrand">
          </table>
          </tbody>
        </table>
      </div>
    </div>
    <div id="maindiv" class="alertdiv"> </div>
   <!-- all model site -->
   <!-- Modal -->
        <div class="modal fade" id="name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">insert
                vouchers</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row input-div">
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <label  id="vouchers-code">Vouchers code</label><br>
                      <input type="text" required id="voucherCode"class="form-control" placeholder="Vouchers code" aria-label="Vouchers code" aria-describedby="vouchers-code">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <label  id="vouchers-type">Vouchers type</label><br>
                      <select type="text"  required id="VouchersType" class="form-control " aria-label="vouchers type" aria-describedby="vouchers-type" >
                        <option value="" >select one Vouchers type</option>
                        <option value="percentage" >percentage</option>
                        <option value="fixed">fixed</option>
                      </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <label  id="Vouchers-amount">Vouchers amount</label><br>
                      <input type="number" id="voucherAnount" required
                      class="form-control " placeholder="voucher amount" aria-label="voucher amount"
                      aria-describedby="Vouchers-amount">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <label  id="Min-order-amount">Min order amount</label><br>
                      <input type="number" id="minprice" required
                      class="form-control " placeholder="Min order amount" aria-label="Min order amount"
                      aria-describedby="Min-order-amount">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <label  id="Usage-limit">Usage limit</label><br>
                      <input type="number" id="usage_limit" required
                      class="form-control " placeholder="Usage limit" aria-label="usage limit"
                      aria-describedby="Usage-limit">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <label  id="Start-time">Start time</label><br>
                      <input type="datetime-local" id="start_at" required
                      class="form-control " placeholder="vouchers stat time" aria-label="vouchers stat time"
                      aria-describedby="Start-time">
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <label  id="Vouchers-end-time">Vouchers end time</label><br>
                      <input type="datetime-local" id="end_at" required
                      class="form-control " placeholder="vouchers end time" aria-label="vouchers end time"
                      aria-describedby="Vouchers-end-time">
                    </div>
                    <br>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="InsertVoucher" onclick="InsertVoucher();" class="btn btn-primary"> Add vouchers</button>
              </div>
            </div>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/Admin/Voucher.js') }}"></script>
        <script src="{{ asset('js/Admin/common.js') }}"></script>
