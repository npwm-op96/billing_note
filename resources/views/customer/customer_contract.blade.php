@extends('layouts.master')
@section('title','สัญญาเช่า')

<?php
  use App\CmsHelper as CmsHelper;
?>

@section('custom-css-script')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
            <li class="breadcrumb-item active"> สัญญาเช่า </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- <div class="row">
        <div class="col-md-12 text-center">
          <a href="{{-- route('customer_contract.create') --}}">
            <button type="button" class="btn btn-danger float-right" style=" height: 50px; padding:10px 40px;">
              <i class="fas fa-plus-circle"></i>
                เพิ่มข้อมูลสัญญา
            </button>
          </a>

        </div>
      </div>
      <br> -->


      <!-- DATA TABLE -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"> <i class="fas fa-building"></i> <b>สัญญาเช่า</b></h3>
            </div>

            <div class="card-body">
              <div class="table-responsive hover">
                <table id="example1" class="table table-bordered table-striped table-reponsive table-sm">
                  <thead class="text-nowrap" style="background-color: #FFF9F9;">
                    <tr>
                      <th class="text-center"> เลข ID </th>
                      <th class="text-center"> เลขที่สัญญา </th>
                      <th class="text-center"> รหัสลูกค้า </th>
                      <th class="text-center"> ชื่อลูกค้า / บริษัท </th>
                      <th class="text-center"> ประเภทสัญญา </th>
                      <th class="text-center"> วันที่ส่งเครื่อง </th>
                      <th class="text-center"> วันที่เริ่มต้นสัญญา </th>
                      <th class="text-center"> วันที่สิ้นสุดสัญญา </th>
                      <th class="text-center"> Action </th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($customer_contract as $value)
                      <tr>
                        <td class="text-center"> {{ $value->id }} </td>
                        <td class="text-center text-primary"> {{ $value->contract_number }} </td>
                        <td class="text-center"> {{ $value->customer_code }} </td>
                        <td> {{ $value->customer_name }} </td>
                        <td class="text-center">
                           @if($value->contract_type == "1")
                              <span class="badge badge-pill" style="background-color: #B0C4DE;"> {{ $contract_type [ $value->contract_type ] }} </span>
                           @elseif($value->contract_type == "2")
                              <span class="badge badge-pill" style="background-color: #B0C4DE;"> {{ $contract_type [ $value->contract_type ] }} </span>
                           @elseif($value->contract_type == "3")
                              <span class="badge badge-pill" style="background-color: #B0C4DE;"> {{ $contract_type [ $value->contract_type ] }} </span>
                           @elseif($value->contract_type == "4")
                              <span class="badge badge-pill" style="background-color: #B0C4DE;"> {{ $contract_type [ $value->contract_type ] }} </span>
                           @else <!-- status == Default -->
                               <span class="badge bg-danger badge-pill"> ยังไม่ได้ระบุ </span>
                           @endif
                        </td>
                        <td class="text-center"> {{ CmsHelper::DateThai($value->carry_contract) }} </td>
                        <td class="text-center"> {{ CmsHelper::DateThai($value->start_contract) }} </td>
                        <td class="text-center"> {{ CmsHelper::DateThai($value->end_contract) }} </td>
                        <td class="text-center">
                          <!-- Details -->
                              <button type="button" class="btn btn-info btn-md" title="Details" data-toggle="modal" data-target="#ContractModal{{ $value->id }}">
                                <i class="fas fa-bars"></i>
                              </button>
                          <!-- END Details -->

                          <!-- Edit -->
                            <a href="{{ route('customer_contract.edit', [ 'id' => $value->id ]) }}">
                              <button type="button" class="btn btn-warning btn-md" title="Edit">
                                <i class="fas fa-edit"></i>
                              </button>
                            </a>
                         <!-- END Edit -->

                         <!-- Delete -->
                           <button type="button" class="btn btn-danger btn-md" title="Delete" data-toggle="modal" data-target="#DeleteModalContract{{ $value->id }}">
                             <i class="fas fa-trash-alt"></i>
                           </button>
                         <!-- END Delete -->
                        </td>


                        <!-- MODAL for View -->
                        <div class="modal fade" id="ContractModal{{ $value->id }}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title"><b> ข้อมูลสัญญาเช่า ( ID. <font color = "red"> {{$value->id}} </font>) </b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">

                                  <p> <b>รหัสลูกค้า</b> : {{ $value->customer_code }} </p>
                                  <p> <b>ชื่อลูกค้า / บริษัท</b> : {{ $value->customer_name }} </p>
                                <hr>
                                  <p> <b>เลข ID สัญญา</b> : {{ $value->id }} </p>
                                  <p> <b> เลขที่สัญญา </b> : {{ $value->contract_number }} </p>
                                  <p> <b>ประเภทของสัญญา</b> : {{ $contract_type [$value->contract_type] }} </p>
                                  <p> <b> จำนวนเครื่อง </b> : {{ $value->number_of_machine }} </p>
                                  <p> <b><font color = "blue">วันที่เริ่มสัญญา</font></b> : {{ CmsHelper::DateThai($value->start_contract) }} </p>
                                  <p> <b><font color = "red">วันที่สิ้นสุดสัญญา</font></b> : {{ CmsHelper::DateThai($value->end_contract) }} </p>
                                  <p> <b> พนักงานขาย </b> : {{ CmsHelper::Get_UserID($value->salesman_id)['create_by'] }} </p>
                                <hr>
                                  <p> <b> ค่าเช่าเครื่อง </b> : {{ $value->rental_cost }}  บาท.</p>
                                  <p> <b> ค่าอุปกรณ์เสริม (FAX) </b> : {{ $value->utility_1 }} บาท.</p>
                                  <p> <b> ค่าอุปกรณ์เสริม (Printer) </b> : {{ $value->utility_2 }} บาท.</p>
                                <hr>
                                  <h4> A4 </h4>
                                    <p> <b> A4 ถ่ายเอกสารขาว-ดำ (ค่าบริการ สำเนาละ) </b> : {{ $value->a4_bk_service }} </p>
                                    <p> <b> A4 ถ่ายเอกสารสี (ค่าบริการ สำเนาละ) </b> : {{ $value->a4_color_service }} </p>
                                  <h4> A3 </h4>
                                    <p> <b> A3 ถ่ายเอกสารขาว-ดำ (ค่าบริการ สำเนาละ) </b> : {{ $value->a3_bk_service }} </p>
                                    <p> <b> A3 ถ่ายเอกสารสี (ค่าบริการ สำเนาละ) </b> : {{ $value->a3_color_service }} </p>
                                <hr>
                                  <p> <b> หักค่ากระดาษเสียให้ฟรีกับลูกค้า </b> : {{ $value->benefit_cost }} %</p>
                                  <p> <b> เงินประกันความเสียหาย </b> : {{ $value->insurance_cost }} บาท.</p>
                                <hr>
                                  <p> <b> *ผู้บันทึกข้อมูล </b> : {{ CmsHelper::Get_UserID($value->create_by)['create_by'] }} <font color = "red">( {{ CmsHelper::DateThai($value->created_at) }} | เวลา {{ CmsHelper::TimeThai($value->created_at) }} น. ) </font></p>

                                <!-- <button type="button" class="btn btn-primary float-right"> บันทึกข้อมูล </button> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- END MODAL for View -->



                        <!-- MODAL Delete -->
                        <div class="modal fade" id="DeleteModalContract{{ $value->id }}">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-body">
                                <br>
                                  <img class="mx-auto d-block" src="{{ asset('img/exclamation.png') }}" alt="exclamation" style="width:90px;">
                                <br>
                                  <h2 class="text-center"> ต้องการลบรายการนี้ใช่ไหม ? <br> ( ID. <font color = "red"> {{ $value->id }} </font>) </h2>
                                <br>
                                <div class="text-center">
                                  <!-- Cancel -->
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" role="button" aria-disabled="true">
                                      <i class="fas fa-times-circle"></i> Cancel
                                    </button>
                                  <!-- Confirms -->
                                  <a href="{{ route('customer_contract.delete',['id' => $value->id]) }}">
                                    <button type="button" class="btn btn-success" role="button" aria-disabled="true">
                                      <i class="fas fa-trash-alt"></i> Confirms
                                    </button>
                                  </a>

                                </div>
                              </div> <!-- END modal-bodyl -->
                            </div>
                          </div>
                        </div>
                        <!-- END MODAL Delete -->


                      </tr>
                      @php
                        $i++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> <!-- Col DataTable -->
      </div> <!-- Row DataTable -->


    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop


@section('custom-js-script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "searching": true,
      // "buttons": ["excel", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@stop


@section('custom-js')

<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- INSERT success -->
    @if(Session::get('contract'))
     <?php Session::forget('contract'); ?>
      <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'บันทึกข้อมูลเรียบร้อยแล้ว',
            showConfirmButton: false,
            // confirmButtonColor: '#3085d6',
            timer: 2200
        })
      </script>
    @endif
  <!-- END INSERT success -->

  <!-- EDIT success -->
    @if(Session::get('savecontract'))
     <?php Session::forget('savecontract'); ?>
      <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
            showConfirmButton: false,
            // confirmButtonColor: '#3085d6',
            timer: 2200
        })
      </script>
    @endif
  <!-- END EDIT success -->

  <!-- DELETE success -->
    @if(Session::get('deletecontract'))
     <?php Session::forget('deletecontract'); ?>
      <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'ลบข้อมูลเรียบร้อยแล้ว',
            showConfirmButton: false,
            // confirmButtonColor: '#3085d6',
            timer: 2200
        })
      </script>
    @endif
  <!-- END DELETE success -->

@stop
