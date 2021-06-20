@extends('layouts.master')
@section('title','ข้อมูลลูกค้า')

<?php
  use App\CmsHelper as CmsHelper;
?>

@section('custom-css-script')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
    <div class="container-fluid">
      <div class="row mb-2">
        <!-- <div class="col-sm-6">
          <h1>General Form</h1>
        </div> -->
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"> ข้อมูลหลัก </a></li>
            <li class="breadcrumb-item active"> ข้อมูลลูกค้า </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12 text-center">
          <a href="{{ route('customer.create') }}">
            <button type="button" class="btn btn-info float-right" style=" height: 50px; padding:10px 40px;">
              <i class="fas fa-plus-circle"></i>
                เพิ่มข้อมูลลูกค้า
            </button>
          </a>

        </div>
      </div>
      <br>


      <!-- DATA TABLE -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"> <i class="fas fa-building"></i> <b>ข้อมูลลูกค้า / บริษัท</b></h3>
            </div>

            <div class="card-body">
              <div class="table-responsive hover">
                <table id="example1" class="table table-bordered table-striped table-reponsive table-sm">
                  <thead class="text-nowrap" style="background-color: #FFFAF0;">
                    <tr>
                      <th class="text-nowrap" style="text-align: center"> ลำดับ </th>
                      <th class="text-nowrap" style="text-align: center"> ชื่อลูกค้า / บริษัท </th>
                      <th class="text-nowrap" style="text-align: center"> รหัสลูกค้า </th>
                      <th class="text-nowrap" style="text-align: center"> ประเภท </th>
                      <!-- <th class="text-nowrap" style="text-align: center"> ข้อมูลการติดต่อ </th> -->
                      <th class="text-nowrap" style="text-align: center"> วันที่วางบิล </th>
                      <th class="text-nowrap" style="text-align: center"> วันที่รับเช็ค </th>
                      <th class="text-nowrap" style="text-align: center"> สถานะลูกค้า </th>
                      <th class="text-nowrap" style="text-align: center"> Action </th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                      @foreach($customer as $value)
                      <tr>
                        <td class="text-nowrap" style="text-align: center"> {{ $i }} </td>
                        <td> {{ $value->customer_name }} </td>
                        <td class="text-nowrap text-primary" style="text-align: center"> {{ $value->customer_code }} </td>
                        <td class="text-nowrap" style="text-align: center"> {{ CmsHelper::Get_Customer_type($value->customer_type)['customer_type'] }} </td>
                        <!-- <td class="text-nowrap" style="text-align: center"> {{-- $value->telephone --}} </td> -->
                        <td class="text-nowrap" style="text-align: center"> {{ CmsHelper::DateThai($value->billing_date) }} </td>
                        <td class="text-nowrap" style="text-align: center"> {{ CmsHelper::DateThai($value->check_date) }} </td>
                        <td class="text-nowrap" style="text-align: center">
                          @if($value->status == NULL)
                            <span class="badge bg-success badge-pill"> Active </span>
                          @elseif($value->status == "1")
                            <span class="badge bg-secondary badge-pill"> Inactive </span>
                          @endif
                          </td>

                        <td class="text-nowrap" style="text-align: center">
                          <!-- View -->
                          <button type="button" class="btn btn-info btn-md" title="Details" data-toggle="modal" data-target="#CustomerModal{{ $value->id }}">
                            <i class="fas fa-bars"></i>
                          </button>
                          <!-- END View -->

                          <!-- Details -->
                          <a href="{{ route('customer.edit', [ 'id' => $value->id ]) }}">
                            <button type="button" class="btn btn-warning btn-md" title="Edit">
                              <i class="fas fa-edit"></i>
                            </button>
                         </a>
                         <!-- END Details -->
                        </td>


                              <!-- MODAL -->
                              <div class="modal fade" id="CustomerModal{{ $value->id }}">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title"><b> ข้อมูลลูกค้า ( ID. <font color = "red"> {{$value->id}} </font>) </b></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">

                                      <p> <b>ชื่อลูกค้า / บริษัท</b> : {{$value->customer_name}} </p>
                                    <hr>
                                      <p> <b>รหัสลูกค้า</b> : {{ $value->customer_code }} </p>
                                    <hr>
                                      <p> <b>ประเภท</b> : {{ CmsHelper::Get_Customer_type($value->customer_type)['customer_type'] }} </p>
                                    <hr>
                                      <p> <b><font color = "red">วันที่วางบิล</font></b> : {{ CmsHelper::DateThai($value->billing_date) }} </p>
                                    <hr>
                                      <p> <b><font color = "blue">วันที่รับเช็ค</font></b> : {{ CmsHelper::DateThai($value->check_date) }} </p>
                                    <hr>
                                      <p> <b>ผู้ติดต่อ/ผู้ประสาน</b> : {{ $value->contact }} </p>
                                    <hr>
                                      <p> <b>ข้อมูลการติดต่อ</b> : {{ $value->telephone }} </p>
                                    <hr>
                                      <p> <b>ที่อยู่</b> : {{ $value->telephone }} </p>
                                      <hr>
                                        <p> <b>ผู้บันทึกข้อมูล</b> : {{ CmsHelper::Get_UserID($value->create_by)['create_by'] }} </p>

                                      <!-- <button type="button" class="btn btn-primary float-right"> บันทึกข้อมูล </button> -->
                                    </div>

                                    <!-- <div class="modal-footer"> -->
                                      <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                      <!-- <button type="button" class="btn btn-primary"> บันทึกข้อมูล </button> -->
                                    <!-- </div> -->
                                  </div>
                                </div>
                              </div>
                              <!-- END MODAL -->


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

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- INSERT success -->
    @if(Session::get('messages'))
     <?php Session::forget('messages'); ?>
      <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'บันทึกข้อมูลเรียบร้อยแล้ว',
            showConfirmButton: false,
            // confirmButtonColor: '#3085d6',
            timer: 2000
        })
      </script>
    @endif
    <!-- END INSERT success -->



@stop
