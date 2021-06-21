@extends('layouts.master')
@section('title','เพิ่มข้อมูลลูกค้าใหม่')

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

        <form action="{{ route('customer.insert') }}" method="POST">
          @csrf

            <div class="row">
              <div class="col-md-12">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #FFF9F9;">
                    <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> เพิ่มข้อมูลลูกค้าใหม่ </b></h3>
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> รหัสลูกค้า <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="customer_code" maxlength="10"
                                 onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" required>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ชื่อลูกค้า / บริษัท <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="customer_name" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ประเภท <font color="red"> * </font></label>
                          <select class="form-control" name="customer_type" required>
                              <option disabled="true" selected="true" > - กรุณาเลือก - </option>
                              @foreach ($customer_type as $value)
                                <option value="{{ $value->id }}"> {{ $value->customer_type }} </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โทรศัพท์ </label>
                          <input type="text" class="form-control" name="telephone" placeholder="โทรศัพท์" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> E-mail </label>
                          <input type="email" class="form-control" name="customer_email" placeholder="E-mail" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> LINE ID </label>
                          <input type="text" class="form-control" name="line" placeholder="Line">
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ภูมิภาค / โซน </label>
                          <select class="form-control" name="area_zone" required>
                              <option disabled="true" selected="true" > - กรุณาเลือก - </option>
                              @foreach ($region as $value)
                                <option value="{{ $value->id }}"> {{ $value->region }} </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3" id="province_div">
                        <div class="form-group">
                          <label> จังหวัด </label>
                            <a class="one small-box-footer" href="#"> (คำอธิบาย) </a>
                              <select class="form-control" id="province_id" name="province_id" required>
                                    <option value="" disabled="true" selected="true">กรุณาเลือก</option>
                                  @foreach($ref_province as $key => $value)
                                    <option value="{{ $key }}">{{$value}}</option>
                                  @endforeach
                              </select>
                        </div>
                      </div>

                      <div class="col-md-3" id="district_div">
                        <div class="form-group district_id">
                          <label> เขต/อำเภอ </label>
                          <select class="form-control" id="district_id" name="district_id" required>
                               <option value="" disabled="true" selected="true">กรุณาเลือก</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-3" id="sub_district_div">
                        <div class="form-group sub_district_id">
                          <label> แขวง/ตำบล </label>
                          <select class="form-control" id="sub_district_id" name="sub_district_id" required>
                              <option value="" disabled="true" selected="true">กรุณาเลือก</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ที่อยู่ / ที่ตั้ง </label>
                          <textarea class="form-control" name="address" rows="2" placeholder="โปรดระบุที่อยู่ / ที่ตั้ง"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ชื่อผู้ติดต่อ <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="contact" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> วันที่วางบิล (ตั้งแต่) <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="billing_date" id="datepicker1" placeholder="กรุณาเลือก ปี/เดือน/วัน" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> วันที่วางบิล (จนถึง) </label>
                          <input type="text" class="form-control" name="billing_date_2" id="datepicker2" placeholder="กรุณาเลือก ปี/เดือน/วัน" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> วันที่รับเช็ค <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="check_date" id="datepicker3" placeholder="กรุณาเลือก ปี/เดือน/วัน" autocomplete="off" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <strong> เครดิตลูกค้า </strong>
                          <div class="input-group">
                            <input type="text" class="form-control" name="credit_term" placeholder="จำนวนวัน" maxlength="3" onkeypress='validate(event)'>
                              <div class="input-group-append">
                                <div class="input-group-text"><i class="fas fa-calendar-day"></i></div>
                              </div>
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
    });
    $('#datepicker3').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy/mm/dd',
        // maxDate: today,
        autoclose: true,
        todayHighlight: true
    });
</script>
<!-- END DatePicker Style -->


<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
  document.querySelector(".one").addEventListener('click', function(){
    Swal.fire("Notice !!",
    "คุณจำเป็นต้องเลือกจังหวัดก่อนเสมอ <br> เพื่อให้ระบบฯ แสดงอำเภอและตำบลตามลำดับ.."
    );
  });
</script>

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
