@extends('layouts.master')
@section('title','แก้ไขข้อมูลสัญญา')

<?php
  use App\CmsHelper as CmsHelper;
?>

@section('custom-css-script')
<!-- DatePicker Style -->
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.css') }}">
@stop


@section('custom-css')
@stop


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <!-- <div class="col-sm-6">
          <h1>General Form</h1>
        </div> -->
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"> ข้อมูลหลัก </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('customer.index') }}"> รายละเอียดลูกค้า </a></li>
            <li class="breadcrumb-item active"> เพิ่มข้อมูลลูกค้าใหม่ </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <!-- Main content -->
  <section class="content">
    <div class="container">

      <form action="{{ route('customer_contract.save') }}" method="POST">
        @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header" style="background-color: #FFF9F9;">
                  <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 1) </font> : ข้อมูลสัญญาเช่า </b></h3>
                </div>

                <div class="card-body">

                  <div class="row justify-content-end">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> เลขที่สัญญา </label><font color="red"> * </font>
                        <input type="text" class="form-control" name="contract_number" placeholder="เลขที่สัญญา" value="{{ $edit_contract->contract_number }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> รหัสลูกค้า </label>
                        <!-- hidden ID -->
                        <input type="hidden" class="form-control" name="id" value="{{ $edit_contract->id }}">

                        <input type="text" class="form-control" value="{{ $edit_contract->customer_code }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <label> ชื่อลูกค้า / บริษัท </label>
                        <input type="text" class="form-control" value="{{ $edit_contract->customer_name }}" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> ประเภทสัญญา </label><font color="red"> * </font>
                          <select class="form-control" name="contract_type" >
                              @foreach($contract_types as $key => $value)
                                <option value="{{ $key }}" {{ $edit_contract->contract_type == $key ? 'selected' : '' }}> {{ $value }} </option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> จำนวนเครื่อง </label><font color="red"> * </font>
                        <input type="text" class="form-control" name="number_of_machine" maxlength="3" value="{{ $edit_contract->number_of_machine }}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> พนักงานขาย </label>
                          <select class="form-control" name="salesman_id" >
                              @foreach($saleman as $value)
                                <option value="{{ $value->id }}" {{ $edit_contract->salesman_id == $value->id ? 'selected' : '' }} > {{ $value->name_th." ".$value->lname_th }} </option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

<!-- ddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label> หมายเลขเครื่อง (S/N) </label>
                          <div class="select2-danger">
                            <select class="select2 select2-danger form-control" id="machine_dno_id" name="machine_dno_id[]"
                                    data-dropdown-css-class="select2-danger" multiple="multiple">
                            </select>
                          </div>
                      </div>
                    </div>
                  </div>
<!-- ddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label> สถานที่ติดตั้งเครื่อง </label>
                        <textarea type="text" name="install_site" class="form-control" rows="2"> {{ $edit_contract->install_site }} </textarea>
                      </div>
                    </div>
                  </div>
                </div> <!-- END card-body -->

              </div>
            </div>
          </div>
      <!-- /.card 1 -->



      <!-- CARD 2 -->
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header" style="background-color: #FFF9F9;">
                  <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 2) </font> : ระยะเวลาสัญญา </b></h3>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> วันที่ส่งมอบเครื่อง </label>
                        <input type="date" class="form-control" name="carry_contract" placeholder="วัน/เดือน/ปี" autocomplete="off" value="{{ $edit_contract->carry_contract }}">
                        <!-- <input type="text" class="form-control" name="carry_contract" id="datepicker1" placeholder="ปี/เดือน/วัน" autocomplete="off" required> -->
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> วันที่เริ่มต้นสัญญา </label>
                        <input type="date" class="form-control" name="start_contract" placeholder="วัน/เดือน/ปี" autocomplete="off" value="{{ $edit_contract->start_contract }}">
                        <!-- <input type="text" class="form-control" name="start_contract" id="datepicker2" placeholder="ปี/เดือน/วัน" autocomplete="off" required> -->
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> วันที่สิ้นสุดสัญญา </label>
                        <input type="date" class="form-control" name="end_contract" placeholder="ปี/เดือน/วัน" autocomplete="off" value="{{ $edit_contract->end_contract }}">
                        <!-- <input type="text" class="form-control" name="end_contract" id="datepicker3" placeholder="ปี/เดือน/วัน" autocomplete="off" required> -->
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> วันที่จดมิเตอร์ (วัน) </label><font color="red"> * </font>
                        <select class="form-control" name="cycle_meter_date_1">
                            @foreach($monthly as $value)
                              <option value="{{ $value->id }}" {{ $edit_contract->cycle_meter_date_1 == $value->id ? 'selected' : '' }} > {{ $value->monthly }} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> ข้อมูลเพิ่มเติม </label>
                          <select class="form-control" name="cycle_meter_date_2" >
                            @foreach($data_other as $key => $value)
                              <option value="{{ $key }}" {{ $edit_contract->cycle_meter_date_2 == $key ? 'selected' : '' }}> {{ $value }} </option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                </div> <!-- END card-body -->
              </div>
            </div>
          </div>
      <!-- /.card 2 -->



      <!-- CARD 3 -->
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header" style="background-color: #FFF9F9;">
                  <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 3) </font> : อัตราค่าบริการ </b></h3>
                </div>

                <div class="card-body">

                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> ค่าเช่าเครื่องเดือนละ </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="rental_cost"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->rental_cost }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> ค่าอุปกรณ์เสริม (FAX) </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="utility_1"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->utility_1 }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> ค่าอุปกรณ์เสริม (Printer) </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="utility_2"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->utility_2 }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <hr>

                  <h3><b> A4 </b></h3>
                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> ถ่ายเอกสารขาว-ดำ <br>ค่าบริการ สำเนาละ </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="a4_bk_service"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->a4_bk_service }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> <font color="red"> ถ่ายเอกสารสี </font><br> ค่าบริการ สำเนาละ </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="a4_color_service"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->a4_color_service }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>


                  <h3><b> A3 </b></h3>
                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> ถ่ายเอกสารขาว-ดำ <br>ค่าบริการ สำเนาละ </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="a3_bk_service"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->a3_bk_service }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> <font color="red"> ถ่ายเอกสารสี </font><br> ค่าบริการ สำเนาละ </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="a3_color_service"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->a3_color_service }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>

                  <hr>


                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> หักค่ากระดาษเสียให้ฟรีกับลูกค้า </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="benefit_cost" value="{{ $edit_contract->benefit_cost }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label"> ค่าเงินประกันความเสียหาย </label>
                        <div class="col-md-4">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="insurance_cost"
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" value="{{ $edit_contract->insurance_cost }}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>


                </div> <!-- END card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i>&nbsp; บันทึกข้อมูล </button>
                </div>
              </div>
            </div>
          </div>
      <!-- /.card 3 -->

        </form>


    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop


@section('custom-js-script')
@stop


@section('custom-js')

<!-- Select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/i18n/th.js') }}"></script>
<script>
    //Initialize Select2 Elements
    $("#machine_dno_id").select2({

      language: "th",
      placeholder: "- กรุณาเลือกหมายเลข S/N -",
      minimumResultsForSearch: 5,
      ajax: {
       url: "{{ route('Select2.ajax.get.customer.contract') }}",
       type: "GET",
       dataType: 'json',
       delay: 250,
       data: function (params) {
        return {
          searchTerm: params.term // search term
        };
       },
       processResults: function (response) {
         return {
            results: response
         };
       },
       cache: true
      }
    });
</script>
<!-- END Select2 -->

@stop
