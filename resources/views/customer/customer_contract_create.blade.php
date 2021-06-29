@extends('layouts.master')
@section('title','เพิ่มข้อมูลสัญญาเช่า')

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
    <div class="container">
      <div class="row mb-2">
        <!-- <div class="col-sm-6">
          <h1>General Form</h1>
        </div> -->
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"> ข้อมูลหลัก </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('customer.contract') }}"> สัญญาเช่าลูกค้า </a></li>
            <li class="breadcrumb-item active"> เพิ่มข้อมูลสัญญา </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container">

      <form action="{{ route('customer_contract.insert') }}" method="POST">
        @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header" style="background-color: #FFF9F9;">
                  <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 1) </font> : ข้อมูลสัญญาเช่าลูกค้า </b></h3>
                </div>

                <div class="card-body">

                  <div class="row justify-content-end">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> สัญญาเลขที่ </label><font color="red"> * </font>
                        <input type="text" class="form-control" name="contract_number" placeholder="เลขที่สัญญา" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> รหัสลูกค้า </label>
                        <!-- hidden ID -->
                        <input type="hidden" class="form-control" name="id" value="{{ $data->id }}">
                        <input type="text" class="form-control" value="{{ $data->customer_code }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <label> ชื่อลูกค้า / บริษัท </label>
                        <input type="text" class="form-control" value="{{ $data->customer_name }}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> ประเภทสัญญา </label><font color="red"> * </font>
                          <select class="form-control" name="contract_type" required>
                              <option disabled="true" selected="true"> - กรุณาเลือก - </option>
                              @foreach($contract_types as $key => $value)
                                <option value="{{ $key }}"> {{ $value }} </option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> จำนวนเครื่อง </label><font color="red"> * </font>
                        <input type="text" class="form-control" name="number_of_machine" placeholder="กรุณาระบุจำนวน" maxlength="3"
                               onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> พนักงานขาย </label>
                          <select class="form-control" name="salesman_id" required>
                              <option disabled="true" selected="true"> - กรุณาเลือก - </option>
                              @foreach($saleman as $value)
                                <option value="{{ $value->id }}"> {{ $value->name_th." ".$value->lname_th }} </option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label> หมายเลขเครื่อง (S/N) </label>
                          <div class="select2-danger">
                            <select class="select2 select2-danger form-control" id="machine_dno_id" name="machine_dno_id[]"
                                    data-dropdown-css-class="select2-danger" multiple="multiple" required>
                            </select>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label> สถานที่ติดตั้งเครื่อง </label>
                        <textarea type="text" name="install_site" class="form-control" rows="2"></textarea>
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
                        <input type="text" class="form-control" name="carry_contract" id="datepicker1" placeholder="ปี/เดือน/วัน" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> วันที่เริ่มต้นสัญญา </label>
                        <input type="text" class="form-control" name="start_contract" id="datepicker2" placeholder="ปี/เดือน/วัน" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> วันที่สิ้นสุดสัญญา </label>
                        <input type="text" class="form-control" name="end_contract" id="datepicker3" placeholder="ปี/เดือน/วัน" autocomplete="off" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> วันที่จดมิเตอร์ (วัน) </label><font color="red"> * </font>
                        <select class="form-control" name="cycle_meter_date_1" required>
                            <option disabled="true" selected="true"> - กรุณาเลือก - </option>
                            @foreach($monthly as $value)
                              <option value="{{ $value->id }}"> {{ $value->monthly }} </option>
                            @endforeach
                        </select>
                        <!-- <input type="text" class="form-control" name="cycle_meter_date_1" id="startDate" placeholder="ตั้งแต่" autocomplete="off" > -->
                        <!-- <input type="text" class="form-control" name="cycle_meter_date_1" id="datepicker4" placeholder="ปี/เดือน/วัน" autocomplete="off" required> -->
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> ข้อมูลเพิ่มเติม </label>
                        <select class="form-control" name="cycle_meter_date_2" >
                            <option disabled="true" selected="true"> - กรุณาเลือก - </option>
                              <option value="ต้นเดือน"> ต้นเดือน </option>
                              <option value="กลางเดือน"> กลางเดือน </option>
                              <option value="ปลายเดือน"> ปลายเดือน </option>
                        </select>
                        <!-- <input type="text" class="form-control" name="cycle_meter_date_2" id="endDate" placeholder="จนถึง" autocomplete="off"> -->
                        <!-- <input type="text" class="form-control" name="cycle_meter_date_2" id="datepicker5" placeholder="ปี/เดือน/วัน" autocomplete="off"> -->
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
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
                            <input type="text" class="form-control" name="benefit_cost">
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
                                   onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>


                </div> <!-- END card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>&nbsp; บันทึกข้อมูล </button>
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
<!-- DatePicker Style -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<script>
  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  // --- Date-Range-Picker ---
      $('#startDate').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        iconsLibrary: 'fontawesome',
        // minDate: today,
        maxDate: function () {
            return $('#endDate').val();
        }
      });
      $('#endDate').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        iconsLibrary: 'fontawesome',
        minDate: function () {
            return $('#startDate').val();
        }
      });


    $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        // maxDate: today,
        autoclose: true,
        todayHighlight: true,
        // thaiyear: true
    })
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        // maxDate: today,
        autoclose: true,
        todayHighlight: true
    })
    $('#datepicker3').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        // maxDate: today,
        autoclose: true,
        todayHighlight: true
    });
    // $('#datepicker4').datepicker({
    //     uiLibrary: 'bootstrap4',
    //     format: 'yyyy/mm/dd',
    //     // maxDate: today,
    //     autoclose: true,
    //     todayHighlight: true
    // })
    // $('#datepicker5').datepicker({
    //     uiLibrary: 'bootstrap4',
    //     format: 'yyyy/mm/dd',
    //     // maxDate: today,
    //     autoclose: true,
    //     todayHighlight: true
    // })

</script>
<!-- END DatePicker Style -->

@stop


@section('custom-js')

<script>
    //format check event change button district and subdistrict
    $(document).ready(function(){
            $('#district_div').hide();
            $('#sub_district_div').hide();
            $(document).on('change','#province_id',function(){

               var province_id=$(this).val();
			         //console.log(cat_id);
               var div=$(this).parent();
               var op=" ";

               $.ajax({
                  type:'get',
                  url:'{!!URL::to('FindDistrict')!!}',
                  data:{'province_id':province_id},

                  success:function(ref_district){
                    //console.log('success');
                    console.log(ref_district);
                    op+='<option value="" disabled="true" selected="true">กรุณาเลือก</option>';
                    for(var i=0;i<ref_district.length;i++){
                      op+='<option value="'+ref_district[i].district_id+'">'+ref_district[i].district_name+'</option>';
                    }

                    $( "div.district_id" ).find('select').html(" ");
                    $( "div.district_id" ).find('select').append(op);
                    $('#district_div').show();
                  },
                  error:function(){

                  }
                });
            });
            $(document).on('change','#district_id',function () {
                  var district_id=$(this).val();
                  //console.log(district_id);
                  var a=$(this).parent();
                  var op="";
                  $.ajax({
                    type:'get',
                    url:'{!!URL::to('FindSubDistrict')!!}',
                    data:{'district_id':district_id},
                    success:function(ref_sub_district){
                      console.log(ref_sub_district);

                      op+='<option value="" disabled="true" selected="true">กรุณาเลือก</option>';
                      for(var i=0;i<ref_sub_district.length;i++){
                        op+='<option value="'+ref_sub_district[i].sub_district_id+'">'+ref_sub_district[i].sub_district_name+'</option>';
                      }

                    $( "div.sub_district_id" ).find('select').html(" ");
                    $( "div.sub_district_id" ).find('select').append(op);
                    $('#sub_district_div').show();
                    },
                    error:function(){
                    }
                  });
                });

        });

</script>

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
