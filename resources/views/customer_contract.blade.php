@extends('layouts.master')
@section('title','สัญญาเช่าลูกค้า')

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
            <li class="breadcrumb-item"><a href="{{ route('our.home') }}"> ข้อมูลหลัก </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('customer.index') }}"> ข้อมูลลูกค้า </a></li>
            <li class="breadcrumb-item active"> สัญญาเช่าลูกค้า </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- DATA TABLE -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"> <i class="fas fa-building"></i> <b>สัญญาเช่าของลูกค้า</b></h3>
            </div>

            <div class="card-body">
              <div class="table-responsive hover">
                <table id="example1" class="table table-bordered table-striped table-reponsive table-sm">
                  <thead class="text-nowrap" style="background-color: #FFFAF0;">
                    <tr>
                      <th class="text-nowrap" style="text-align: center"> ลำดับ </th>
                      <th class="text-nowrap" style="text-align: center"> รหัสลูกค้า </th>
                      <th class="text-nowrap" style="text-align: center"> ชื่อลูกค้า / บริษัท </th>
                      <th class="text-nowrap" style="text-align: center"> เลขที่สัญญา </th>
                      <th class="text-nowrap" style="text-align: center"> ประเภทสัญญา </th>
                      <th class="text-nowrap" style="text-align: center"> วันที่ส่งเครื่อง </th>
                      <th class="text-nowrap" style="text-align: center"> วันที่สิ้นสุด </th>
                      <th class="text-nowrap" style="text-align: center"> Action </th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($customer_contract as $value)
                      <tr>
                        <td> {{ $i }} </td>
                        <td class="text-center"> {{ $value->customer_code }} </td>
                        <td> {{ $value->customer_name }} </td>
                        <td class="text-center text-primary"> {{ $value->contract_number }} </td>
                        <td class="text-center">
                           @if($value->contract_type == "1")
                           <span class="badge badge-pill" style="background-color: #ff851b;"> {{ $contract_type [ $value->contract_type ] }} </span>
                            @elseif($value->contract_type == "2")
                              <span class="badge badge-pill" style="background-color: #ff851b;"> {{ $contract_type [ $value->contract_type ] }} </span>
                            @else <!-- status == รอตรวจสอบ [Default] -->
                               <span class="badge bg-danger badge-pill"> ยังไม่ได้ระบุ </span>
                            @endif
                        </td>
                        <td class="text-center"> {{ CmsHelper::DateThai($value->start_contract) }} </td>
                        <td class="text-center"> {{ CmsHelper::DateThai($value->end_contract) }} </td>

                        <td class="text-nowrap" style="text-align: center">
                        <!-- Details -->
                        <button type="button" class="btn btn-warning btn-md" title="Details" data-toggle="modal" data-target="#AddModal">
                          <i class="fas fa-edit"></i>
                        </button>
                        <!-- END Details -->

                        </td>


                              <!-- MODAL -->
                              <div class="modal fade" id="AddModal">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Large Modal</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p>One fine body&hellip;</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
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

@stop


@section('custom-js')

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
