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
                  <h3 class="card-title"><b><i class="fas fa-file-signature"></i> เพิ่มข้อมูลสัญญาเช่าลูกค้า </b></h3>
                </div>

                <div class="card-body">
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
                        <label> เลขที่สัญญา </label>
                        <input type="text" class="form-control" name="contract_number" placeholder="กรุณาระบุเลขที่สัญญา" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> ประเภทสัญญา </label>
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
                        <label> วันที่จดมิเตอร์ (ตั้งแต่) </label>
                        <input type="text" class="form-control" name="cycle_meter_date_1" id="datepicker4" placeholder="ปี/เดือน/วัน" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> รอบวันที่จดมิเตอร์ (จนถึง) </label>
                        <input type="text" class="form-control" name="cycle_meter_date_2" id="datepicker5" placeholder="ปี/เดือน/วัน" autocomplete="off">
                      </div>
                    </div>
                  </div>

                </div> <!-- END card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right"> บันทึกข้อมูล </button>
                </div>
              </div>
            </div>
          </div>
      <!-- /.card -->
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
    })
    $('#datepicker4').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        // maxDate: today,
        autoclose: true,
        todayHighlight: true
    })
    $('#datepicker5').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        // maxDate: today,
        autoclose: true,
        todayHighlight: true
    });

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


@stop
