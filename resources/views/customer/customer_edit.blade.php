@extends('layouts.master')
@section('title','เแก้ไขข้อมูลลูกค้า')

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
            <li class="breadcrumb-item active"> เแก้ไขข้อมูลลูกค้า </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <!-- Main content -->
  <section class="content">
    <div class="container">

        <form method="POST" action="{{ route('customer.save') }}" enctype="multipart/form-data">
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
                        <!-- hidden = ID -->
                        <input type="hidden" class="form-control" name="id" value="{{ $edit_customer->id }}">

                        <input type="text" class="form-control" name="customer_code" maxlength="10" value="{{ $edit_customer->customer_code }}"
                               onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลขเท่านั้น !'); this.value='';}" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> เลขประจำตัวผู้เสียภาษี <font color="red"> * </font></label>
                        <input type="text" class="form-control" name="tax_identify" value="{{ $edit_customer->tax_identify }}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> ประเภท <font color="red"> * </font></label>
                        <select class="form-control" name="customer_type">
                            @foreach ($customer_type as $value)
                              <option value="{{ $value->id }}" {{ $edit_customer->customer_type == $value->id ? 'selected' : '' }}> {{ $value->customer_type }} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label> เครดิต (วัน) <font color="red"> * </font></label>
                        <select class="form-control" name="credit_term">
                            @foreach($credit_term as $key => $value)
                              <option value="{{ $key }}" {{ $edit_customer->credit_term == $key ? 'selected' : '' }}> {{ $value }} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> ชื่อลูกค้า / บริษัท <font color="red"> * </font></label>
                        <input type="text" class="form-control" name="customer_name" value="{{ $edit_customer->customer_name }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> ที่อยู่ / ที่ตั้ง </label>
                        <textarea class="form-control" name="address" rows="2" placeholder="โปรดระบุที่อยู่ / ที่ตั้ง"> {{ $edit_customer->address }} </textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> ภูมิภาค / โซน </label>
                        <select class="form-control" name="area_zone">
                            @foreach($region as $value)
                              <option value="{{ $value->id }}" {{ $edit_customer->area_zone == $value->id ? 'selected' : '' }}> {{ $value->region }} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3" id="province_div">
                      <div class="form-group">
                        <label> จังหวัด </label>
                          <select class="form-control" id="province_id" name="province_id">
                              @foreach($ref_province as $key => $value)
                                <option value="{{ $key }}" {{ $edit_customer->province_id == $key ? 'selected' : '' }}> {{ $value }} </option>
                              @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-md-3" id="district_div">
                      <div class="form-group district_id">
                        <label> เขต/อำเภอ </label>
                          <select class="form-control" id="district_id" name="district_id">
                            @foreach($ref_district as $key => $value)
                              <option value="{{ $key }}" {{ $edit_customer->district_id == $key ? 'selected' : '' }}> {{ $value }} </option>
                            @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-md-3" id="sub_district_div">
                      <div class="form-group sub_district_id">
                        <label> แขวง/ตำบล </label>
                          <select class="form-control" id="sub_district_id" name="sub_district_id" >
                            @foreach($ref_sub_district as $key => $value)
                              <option value="{{ $key }}" {{ $edit_customer->sub_district_id == $key ? 'selected' : '' }}> {{ $value }} </option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label> รหัสไปรษณีย์ </label>
                        <input type="text" class="form-control" name="zip_code" maxlength="5" value="{{ $edit_customer->zip_code }}">
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
                          <input type="text" class="form-control" name="contact" value="{{ $edit_customer->contact }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โทรศัพท์ </label>
                          <input type="text" class="form-control" name="telephone" value="{{ $edit_customer->telephone }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> E-mail </label>
                          <input type="email" class="form-control" name="customer_email" value="{{ $edit_customer->customer_email }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> LINE ID </label>
                          <input type="text" class="form-control" name="line" value="{{ $edit_customer->line }}">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ชื่อผู้ติดต่อ (ท่านที่ 2) <font color="red"> *ถ้ามี </font></label>
                          <input type="text" class="form-control" name="contact_2" value="{{ $edit_customer->contact_2 }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โทรศัพท์ </label>
                          <input type="text" class="form-control" name="telephone_2" value="{{ $edit_customer->telephone_2 }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> E-mail </label>
                          <input type="email" class="form-control" name="customer_email_2" value="{{ $edit_customer->customer_email_2 }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> LINE ID </label>
                          <input type="text" class="form-control" name="line_2" value="{{ $edit_customer->line_2 }}">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ชื่อผู้ติดต่อ (ท่านที่ 3) <font color="red"> *ถ้ามี </font></label>
                          <input type="text" class="form-control" name="contact_3" value="{{ $edit_customer->contact_3 }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> โทรศัพท์ </label>
                          <input type="text" class="form-control" name="telephone_3" value="{{ $edit_customer->telephone_3 }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> E-mail </label>
                          <input type="email" class="form-control" name="customer_email_3" value="{{ $edit_customer->customer_email_3 }}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> LINE ID </label>
                          <input type="text" class="form-control" name="line_3" value="{{ $edit_customer->line_3 }}">
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
                          <select class="form-control" name="location_billing" id="selectBoxaa" onchange="changeFunca();" >
                              @foreach($location as $key => $value)
                                <option value="{{ $key }}" {{ $edit_customer->location_billing == $key ? 'selected' : '' }}> {{ $value }} </option>
                              @endforeach
                          </select>
                          <br>
                          <!-- IF select สาขา Show input textboxesaa -->
                          <input type="text" class="form-control" name="location_branch_billing" value="{{ $edit_customer->location_branch_billing }}" id="textboxesaa" >
                      </div>
                    </div>
                    <br>

                  <!-- RADIO 1 [weekly_billing] -->
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary1" name="SelectboxPrimary" value="other">
                            <label for="radioPrimary1"> รายสัปดาห์ </label>
                              <select class="form-control" name="weekly_billing" id="otherAnswer" style="display:none;">
                                @foreach($weekly as $key => $value)
                                  <option value="{{ $key }}" {{ $edit_customer->weekly_billing == $key ? 'selected' : '' }}> {{ $value }} </option>
                                @endforeach
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
                                  <option value=""> - เลือกวันที่ - </option>
                                @foreach($monthly as $value)
                                  <option value="{{ $value->id }}" {{ $edit_customer->monthly_billing == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
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
                                    <option value=""> - เลือกวันที่ - </option>
                                  @foreach($monthly as $value)
                                    <option value="{{ $value->id }}" {{ $edit_customer->fixdate_billing_1 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
                                  @endforeach
                                </select>

                                <select class="form-control" name="fixdate_billing_2" id="otherAnswer10" style="display:none;">
                                    <option value=""> - เลือกวันที่ - </option>
                                  @foreach($monthly as $value)
                                    <option value="{{ $value->id }}" {{ $edit_customer->fixdate_billing_2 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
                                  @endforeach
                                </select>

                                <select class="form-control" name="fixdate_billing_3" id="otherAnswer11" style="display:none;">
                                    <option value=""> - เลือกวันที่ - </option>
                                  @foreach($monthly as $value)
                                    <option value="{{ $value->id }}" {{ $edit_customer->fixdate_billing_3 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
                                  @endforeach
                                </select>

                                <select class="form-control" name="fixdate_billing_4" id="otherAnswer12" style="display:none;">
                                    <option value=""> - เลือกวันที่ - </option>
                                  @foreach($monthly as $value)
                                    <option value="{{ $value->id }}" {{ $edit_customer->fixdate_billing_4 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
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
                          <input type="date" class="form-control" name="billing_date" value="{{ $edit_customer->billing_date }}">
                          <!-- <input type="text" class="form-control" name="billing_date" id="startDate" placeholder="จนถึง" autocomplete="off"> -->
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1"> ช่วงวันที่ (จนถึง) <font color="red"> * </font></label>
                          <input type="date" class="form-control" name="billing_date_2" value="{{ $edit_customer->billing_date_2 }}">
                          <!-- <input type="text" class="form-control" name="billing_date_2" id="endDate" placeholder="จนถึง" autocomplete="off"> -->
                        </div>
                      </div>
                    </div>


                    <hr>
            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                    <h5><label style="background-color: #96C0CE;"> วันที่รับเงิน </label></h5>

                    <div class="row">
                      <div class="col-md-4">
                        <label><font color="red"> สถานที่รับเงิน </font></label>
                          <select class="form-control" name="location_check" id="selectBoxbb" onchange="changeFuncnb();" >
                              @foreach($location as $key => $value)
                                <option value="{{ $key }}" {{ $edit_customer->location_check == $key ? 'selected' : '' }}> {{ $value }} </option>
                              @endforeach
                          </select>
                          <br>
                            <!-- IF select สาขา Show input textboxesbb -->
                            <input type="text" class="form-control" name="location_branch_check" placeholder="โปรดระบุสาขา" value="{{ $edit_customer->location_branch_check }}" id="textboxesbb" >
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
                                  @foreach($weekly as $key => $value)
                                    <option value="{{ $key }}" {{ $edit_customer->weekly_check == $key ? 'selected' : '' }}> {{ $value }} </option>
                                  @endforeach
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
                                      <option value=""> - เลือกวันที่ - </option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}" {{ $edit_customer->monthly_check == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
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
                                      <option value=""> - เลือกวันที่ - </option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}" {{ $edit_customer->fixdate_check_1 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
                                    @endforeach
                                  </select>

                                  <select class="form-control" name="fixdate_check_2" id="otherAnswer8" style="display:none;">
                                      <option value=""> - เลือกวันที่ - </option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}" {{ $edit_customer->fixdate_check_2 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
                                    @endforeach
                                  </select>

                                  <select class="form-control" name="fixdate_check_3" id="otherAnswer13" style="display:none;">
                                      <option value=""> - เลือกวันที่ - </option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}" {{ $edit_customer->fixdate_check_3 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
                                    @endforeach
                                  </select>

                                  <select class="form-control" name="fixdate_check_4" id="otherAnswer14" style="display:none;">
                                      <option value=""> - เลือกวันที่ - </option>
                                    @foreach($monthly as $value)
                                      <option value="{{ $value->id }}" {{ $edit_customer->fixdate_check_4 == $value->id ? 'selected' : '' }}> {{ $value->monthly }} </option>
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
                            <input type="date" class="form-control" name="check_date" value="{{ $edit_customer->check_date }}">
                            <!-- <input type="text" class="form-control" name="check_date" id="startDate2" placeholder="ตั้งแต่" autocomplete="off" > -->
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"> ช่วงวันที่ (จนถึง) <font color="red"> * </font></label>
                            <input type="date" class="form-control" name="check_date_2" value="{{ $edit_customer->check_date_2 }}">
                            <!-- <input type="text" class="form-control" name="check_date_2" id="endDate2" placeholder="จนถึง" autocomplete="off"> -->
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
                          <textarea class="form-control" name="remark" rows="3"> {{ $edit_customer->remark }} </textarea>
                        </div>
                      </div>

                    </div> <!-- END card-body -->

                      <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i>&nbsp; บันทึกข้อมูล </button>
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

    <!-- check_date -->
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
          //fixdate_check_1 || fixdate_check_2 || fixdate_check_3 || fixdate_check_4
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
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other7") {
                      $("#otherAnswer13").show();
                  } else {
                      $("#otherAnswer13").hide();
                  }
              });
          });
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other7") {
                      $("#otherAnswer14").show();
                  } else {
                      $("#otherAnswer14").hide();
                  }
              });
          });

          //fixdate_billing_1 || fixdate_billing_2 || fixdate_billing_3 || fixdate_billing_4
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
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other9") {
                      $("#otherAnswer11").show();
                  } else {
                      $("#otherAnswer11").hide();
                  }
              });
          });
          $(document).ready(function() {
              $("input[type='radio']").change(function() {
                  if ($(this).val() == "other9") {
                      $("#otherAnswer12").show();
                  } else {
                      $("#otherAnswer12").hide();
                  }
              });
          });
      </script>
      <!-- END check_date -->

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
@stop
