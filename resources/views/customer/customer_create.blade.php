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
<!-- iCheck for checkboxes inputs -->
<link rel="stylesheet" href="{{ asset('bower_components/icheck-bootstrap/icheck-bootstrap.min.css') }} ">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('bower_components/daterangepicker/daterangepicker.css') }}">
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

        <form method="POST" action="{{ route('customer.insert') }}" enctype="multipart/form-data">
          @csrf
        <!-- ส่วนที่ 1 -->
          <div class="row">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header" style="background-color: #FFF9F9;">
                  <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 1) </font> : รายละเอียดลูกค้า </b></h3>
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
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> เลขประจำตัวผู้เสียภาษี <font color="red"> * </font></label>
                        <input type="text" class="form-control" name="tax_identify" required>
                      </div>
                    </div>
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
                    <div class="col-md-2">
                      <div class="form-group">
                        <label> เครดิต (วัน) <font color="red"> * </font></label>
                        <select class="form-control" name="credit_term" required>
                            <option value="" disabled="true" selected="true"> - กรุณาเลือก - </option>
                            <option value="7"> 7  </option>
                            <option value="15"> 15 </option>
                            <option value="30"> 30 </option>
                            <option value="45"> 45 </option>
                            <option value="60"> 60 </option>
                            <option value="90"> 90 </option>
                            <option value="120"> 120 </option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> ชื่อลูกค้า / บริษัท <font color="red"> * </font></label>
                        <input type="text" class="form-control" name="customer_name" required>
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
                    <div class="col-md-2">
                      <div class="form-group">
                        <label> รหัสไปรษณีย์ </label>
                        <input type="text" class="form-control" name="zip_code" maxlength="5">
                      </div>
                    </div>
                  </div>

                </div> <!-- END card-body -->

              </div>
            </div>
          </div> <!-- END card -->



          <!-- ส่วนที่ 2 -->
            <div class="row">
              <div class="col-md-12">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #FFF9F9;">
                    <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 2) </font> : ชื่อผู้ติดต่อ/ผู้ประสาน </b></h3>
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ชื่อผู้ติดต่อ <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="contact" placeholder="บุคคลที่ 1" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โทรศัพท์ </label>
                          <input type="text" class="form-control" name="telephone">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> E-mail </label>
                          <input type="email" class="form-control" name="customer_email">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> LINE ID </label>
                          <input type="text" class="form-control" name="line">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ชื่อผู้ติดต่อ (ท่านที่ 2) <font color="red"> *ถ้ามี </font></label>
                          <input type="text" class="form-control" name="contact_2" placeholder="บุคคลที่ 2">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โทรศัพท์ </label>
                          <input type="text" class="form-control" name="telephone_2">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> E-mail </label>
                          <input type="email" class="form-control" name="customer_email_2" >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> LINE ID </label>
                          <input type="text" class="form-control" name="line_2" >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ชื่อผู้ติดต่อ (ท่านที่ 3) <font color="red"> *ถ้ามี </font></label>
                          <input type="text" class="form-control" name="contact_3" placeholder="บุคคลที่ 3">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โทรศัพท์ </label>
                          <input type="text" class="form-control" name="telephone_3" >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> E-mail </label>
                          <input type="email" class="form-control" name="customer_email_3" >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> LINE ID </label>
                          <input type="text" class="form-control" name="line_3" >
                        </div>
                      </div>
                    </div>
                  </div> <!-- END card-body -->

                </div>
              </div>
            </div> <!-- END card -->



          <!-- ส่วนที่ 3 -->
            <div class="row">
              <div class="col-md-12">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #FFF9F9;">
                    <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 3) </font> : วันที่วางบิล/วันที่รับเงิน </b></h3>
                  </div>

                  <div class="card-body">
                    <h5><label style="background-color: #96C0CE;"> วันที่วางบิล </label></h5>

                    <div class="row">
                      <div class="col-md-4">
                        <label><font color="blue"> สถานที่วางบิล </font></label>
                          <select class="form-control" name="location_billing" id="selectBoxaa" onchange="changeFunca();" required>
                            <option value="" disabled="true" selected="true" > - กรุณาเลือก -</option>
                            <option value="สำนักงานใหญ่"> สำนักงานใหญ่ </option>
                            <option value="สาขา"> สาขา </option>
                          </select>
                          <!-- <br> -->
                          <!-- IF select สาขา Show input textboxesaa -->
                          <input type="text" class="form-control" name="location_branch_billing" placeholder="โปรดระบุสาขา"
                                 style="display: none" id="textboxesaa" required>
                      </div>
                    </div>
                    <br>

                  <!-- RADIO 1 [weekly_billing] -->
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary1" name="SelectboxPrimary" value="other">
                            <label for="radioPrimary1">รายสัปดาห์</label>
                              <select class="form-control" name="weekly_billing" id="otherAnswer" style="display:none;">
                                  <option value=""> - กรุณาเลือก -</option>
                                  <option value="วันอาทิตย์"> วันอาทิตย์ </option>
                                  <option value="วันจันทร์"> วันจันทร์ </option>
                                  <option value="วันอังคาร"> วันอังคาร </option>
                                  <option value="วันพุธ"> วันพุธ </option>
                                  <option value="วันพฤหัสบดี"> วันพฤหัสบดี </option>
                                  <option value="วันศุกร์"> วันศุกร์ </option>
                                  <option value="วันเสาร์"> วันเสาร์ </option>
                              </select>
                          </div>

                        </div>
                      </div>
                    </div>

                  <!-- RADIO 2 [monthly_billing] -->
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary2" name="SelectboxPrimary" value="other2">
                            <label for="radioPrimary2">รายเดือน</label>
                                <select class="form-control" name="monthly_billing" id="otherAnswer2" style="display:none;">
                                  <option value=""> - กรุณาเลือก -</option>
                                  @foreach($monthly as $value)
                                    <option value="{{ $value->id }}"> {{ $value->monthly }} </option>
                                  @endforeach
                                </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary9" name="SelectboxPrimary" value="other9">
                            <label for="radioPrimary9"> กำหนดวันที่แน่นอน </label>
                                <select class="form-control" name="fixdate_billing_1" id="otherAnswer9" style="display:none;">
                                  <option value=""> - กรุณาเลือก -</option>
                                  @foreach($monthly as $value)
                                    <option value="{{ $value->id }}"> {{ $value->monthly }} </option>
                                  @endforeach
                                </select>

                                <select class="form-control" name="fixdate_billing_2" id="otherAnswer10" style="display:none;">
                                  <option value=""> - กรุณาเลือก -</option>
                                  @foreach($monthly as $value)
                                    <option value="{{ $value->id }}"> {{ $value->monthly }} </option>
                                  @endforeach
                                </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary3" name="SelectboxPrimary" value="other3">
                            <label for="radioPrimary3"> ช่วงวันที่ </label>
                            <!-- <a class="two small-box-footer" href="#">&nbsp;(คำอธิบาย) </a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ช่วงวันที่ (ตั้งแต่) <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="billing_date" id="startDate" placeholder="ตั้งแต่" autocomplete="off" >
                          <!-- <input type="text" class="clock1 form-control" name="billing_date" placeholder="เลือก ปี/เดือน/วัน" autocomplete="off"> -->
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ช่วงวันที่ (จนถึง) <font color="red"> * </font></label>
                          <input type="text" class="form-control" name="billing_date_2" id="endDate" placeholder="จนถึง" autocomplete="off">
                          <!-- <input type="text" class="clock2 form-control" name="billing_date_2" placeholder="เลือก ปี/เดือน/วัน" autocomplete="off"> -->
                        </div>
                      </div>
                    </div>


                    <hr>


                    <h5><label style="background-color: #96C0CE;"> วันที่รับเงิน </label></h5>

                    <div class="row">
                      <div class="col-md-4">
                        <label><font color="red"> สถานที่รับเงิน </font></label>
                          <select class="form-control" name="location_check" id="selectBoxbb" onchange="changeFuncnb();" required>
                              <option value="" disabled="true" selected="true" > - กรุณาเลือก -</option>
                              <option value="สำนักงานใหญ่"> สำนักงานใหญ่ </option>
                              <option value="สาขา"> สาขา </option>
                          </select>
                          <!-- <br> -->
                          <!-- IF select สาขา Show input textboxesbb -->
                          <input type="text" class="form-control" name="location_branch_check" placeholder="โปรดระบุสาขา"
                                 style="display: none" id="textboxesbb" required>
                      </div>
                    </div>
                    <br>

                    <!-- RADIO 3 [weekly_check] -->
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group clearfix">
                            <div class="icheck-danger d-inline">
                              <input type="radio" id="radioDanger4" name="SelectDanger" value="other4">
                              <label for="radioDanger4">รายสัปดาห์</label>
                                <select class="form-control" name="weekly_check" id="otherAnswer4" style="display:none;">
                                    <!-- <option value="" disabled="true" selected="true" > - กรุณาเลือก -</option> -->
                                    <option value=""> - กรุณาเลือก -</option>
                                    <option value="วันอาทิตย์"> วันอาทิตย์ </option>
                                    <option value="วันจันทร์"> วันจันทร์ </option>
                                    <option value="วันอังคาร"> วันอังคาร </option>
                                    <option value="วันพุธ"> วันพุธ </option>
                                    <option value="วันพฤหัสบดี"> วันพฤหัสบดี </option>
                                    <option value="วันศุกร์"> วันศุกร์ </option>
                                    <option value="วันเสาร์"> วันเสาร์ </option>
                                </select>
                            </div>

                          </div>
                        </div>
                      </div>

                    <!-- RADIO 4 [monthly_check] -->
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group clearfix">
                            <div class="icheck-danger d-inline">
                              <input type="radio" id="radioDanger5" name="SelectDanger" value="other5">
                              <label for="radioDanger5">รายเดือน</label>
                                  <select class="form-control" name="monthly_check" id="otherAnswer5" style="display:none;">
                                      <option value=""> - กรุณาเลือก -</option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}"> {{ $value->monthly }} </option>
                                    @endforeach
                                  </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group clearfix">
                            <div class="icheck-danger d-inline">
                              <input type="radio" id="radioDanger7" name="SelectDanger" value="other7">
                              <label for="radioDanger7"> กำหนดวันที่แน่นอน </label>
                                  <select class="form-control" name="fixdate_check_1" id="otherAnswer7" style="display:none;">
                                      <option value=""> - กรุณาเลือก -</option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}"> {{ $value->monthly }} </option>
                                    @endforeach
                                  </select>

                                  <select class="form-control" name="fixdate_check_2" id="otherAnswer8" style="display:none;">
                                      <option value=""> - กรุณาเลือก -</option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}"> {{ $value->monthly }} </option>
                                    @endforeach
                                  </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group clearfix">
                            <div class="icheck-danger d-inline">
                              <input type="radio" id="radioDanger6" name="SelectDanger" value="other6">
                              <label for="radioDanger6"> ช่วงวันที่ </label>
                              <!-- <a class="three small-box-footer" href="#">&nbsp;(คำอธิบาย) </a> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"> ช่วงวันที่ (ตั้งแต่) <font color="red"> * </font></label>
                            <input type="text" class="form-control" name="check_date" id="startDate2" placeholder="ตั้งแต่" autocomplete="off" >
                            <!-- <input type="text" class="clock3 form-control" name="check_date" placeholder="เลือก ปี/เดือน/วัน" autocomplete="off"> -->
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"> ช่วงวันที่ (จนถึง) <font color="red"> * </font></label>
                            <input type="text" class="form-control" name="check_date_2" id="endDate2" placeholder="จนถึง" autocomplete="off">
                            <!-- <input type="text" class="clock4 form-control" name="check_date_2" placeholder="เลือก ปี/เดือน/วัน" autocomplete="off"> -->
                          </div>
                        </div>
                      </div>
                  </div> <!-- END card-body -->

                </div>
              </div>
            </div> <!-- END card -->



            <!-- ส่วนที่ 4 -->
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow">
                    <div class="card-header" style="background-color: #FFF9F9;">
                      <h3 class="card-title"><b><i class="fas fa-plus-circle"></i> <font color="red"> (ส่วนที่ 4) </font> : เอกสารแนบและโน้ต </b></h3>
                    </div>

                    <div class="card-body">
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โน้ต </label>
                          <textarea class="form-control" name="remark" rows="3" placeholder="โน้ตอื่นๆ เพื่อใช้ในบริษัท"></textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-9">
                          <div class="form-group">
                            <label for="expInputFile"> อัพโหลดไฟล์ </label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="files" >
                                <label class="custom-file-label" for="expInputFile"> Upload File ขนาดไม่เกิน 5 Mb. </label>
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
              </div> <!-- END card -->

          </form>


    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop


@section('custom-js-script')
<!-- FILE INPUT -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>
<!-- END FILE INPUT -->


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
      $('#startDate2').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy/mm/dd',
      iconsLibrary: 'fontawesome',
      minDate: today,
      maxDate: function () {
          return $('#endDate2').val();
      }
    });
          $('#endDate2').datepicker({
              uiLibrary: 'bootstrap4',
              format: 'yyyy/mm/dd',
              iconsLibrary: 'fontawesome',
              minDate: function () {
                  return $('#startDate2').val();
              }
          });

</script>
<!-- END DatePicker Style -->


<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script type="text/javascript">
    document.querySelector(".one").addEventListener('click', function(){
      Swal.fire("Notification",
      "จำเป็นต้องเลือกจังหวัดก่อนเสมอ <br> เพื่อให้ระบบฯ แสดงอำเภอและตำบลตามลำดับ.."
      );
    });
  </script>
  <!-- <script type="text/javascript">
    document.querySelector(".two").addEventListener('click', function(){
      Swal.fire("Notification",
      "หากต้องการกำหนดวันที่แน่นอน เพียงวันเดียว <br> กรุณากรอกข้อมูลในหัวข้อ <b><font color='red'> วันที่วางบิล (ตั้งแต่)* </font></b> เท่านั้น"
      );
    });
  </script>
  <script type="text/javascript">
    document.querySelector(".three").addEventListener('click', function(){
      Swal.fire("Notification",
      "หากต้องการกำหนดวันที่แน่นอน เพียงวันเดียว <br> กรุณากรอกข้อมูลในหัวข้อ <b><font color='red'> วันที่รับเงิน (ตั้งแต่)* </font></b> เท่านั้น"
      );
    });
  </script> -->
<!-- END SWEET ALERT -->



  <!-- Onclick radio button show -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- billing_date -->
    <script>
        $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "other") {
                    $("#otherAnswer").show();
                } else {
                    $("#otherAnswer").hide();
                }
            });
        });
        $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "other2") {
                    $("#otherAnswer2").show();
                } else {
                    $("#otherAnswer2").hide();
                }
            });
        });
        $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "other3") {
                    $("#otherAnswer3").show();
                } else {
                    $("#otherAnswer3").hide();
                }
            });
        });
    </script>
    <!-- END billing_date -->

    <!-- billing_date -->
      <script>
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other4") {
                      $("#otherAnswer4").show();
                  } else {
                      $("#otherAnswer4").hide();
                  }
              });
          });
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other5") {
                      $("#otherAnswer5").show();
                  } else {
                      $("#otherAnswer5").hide();
                  }
              });
          });
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other6") {
                      $("#otherAnswer6").show();
                  } else {
                      $("#otherAnswer6").hide();
                  }
              });
          });
          //fixdate_check_1  &&  fixdate_check_2
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other7") {
                      $("#otherAnswer7").show();
                  } else {
                      $("#otherAnswer7").hide();
                  }
              });
          });
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other7") {
                      $("#otherAnswer8").show();
                  } else {
                      $("#otherAnswer8").hide();
                  }
              });
          });
          //fixdate_billing_1  &&  fixdate_billing_2
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other9") {
                      $("#otherAnswer9").show();
                  } else {
                      $("#otherAnswer9").hide();
                  }
              });
          });
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other9") {
                      $("#otherAnswer10").show();
                  } else {
                      $("#otherAnswer10").hide();
                  }
              });
          });
      </script>
      <!-- END billing_date -->

  <!-- END Onclick radio button show -->


<script>
  function changeFunca() {
    var selectBox = document.getElementById("selectBoxaa");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  if (selectedValue=="สาขา"){
    $('#textboxesaa').show();
  }
  else {
    // alert("Error");
    $('#textboxesaa').hide();
    }
  }
</script>
<script>
  function changeFuncnb() {
    var selectBox = document.getElementById("selectBoxbb");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  if (selectedValue=="สาขา"){
    $('#textboxesbb').show();
  }
  else {
    // alert("Error");
    $('#textboxesbb').hide();
    }
  }
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
