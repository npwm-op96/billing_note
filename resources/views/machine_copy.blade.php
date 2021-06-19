@extends('layouts.master')
@section('title','ข้อมูลเครื่องพิมพ์ / อุปกรณ์')

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
            <li class="breadcrumb-item active"> ข้อมูลเครื่องพิมพ์ / อุปกรณ์ </li>
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
          <a href="{{ route('our.machine_copy_create') }}">
            <button type="button" class="btn btn-info float-right" style=" height: 50px; padding:10px 40px;">
              <i class="fas fa-plus-circle"></i>
                เพิ่มข้อมูลอุปกรณ์ใหม่
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
              <h3 class="card-title"> <i class="fas fa-id-card"></i> <b>ข้อมูลเครื่องพิมพ์ / อุปกรณ์</b></h3>
            </div>

            <div class="card-body">
              <div class="table-responsive hover">
                <table id="example5" class="table table-bordered table-striped table-reponsive table-sm">
                  <thead class="text-nowrap" style="background-color: #F0F8FF;">
                    <tr>
                      <th class="text-center"> ลำดับ </th>
                      <th class="text-center"> Serial No. </th>
                      <th class="text-center"> หมายเลข DNO </th>
                      <th class="text-center"> ยี่ห้อ </th>
                      <th class="text-center"> รุ่น </th>
                      <th class="text-center"> สถานะ DNO </th>
                      <th class="text-center"> ประเภทอุปกรณ์ </th>
                      <th class="text-center"> B&W / Colour </th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($data_machine as $value)
                      <tr>
                        <td class="text-center"> {{ $i }} </td>
                        <td class="text-center text-danger"> {{ $value->serial_no }} </td>
                        <td class="text-center text-primary"> {{ $value->dno_number }} </td>
                        <td class="text-center"> {{ $value->brands }} </td>
                        <td class="text-center"> {{ $value->model }} </td>
                        <td class="text-center"> {{ $value->dno_status }} </td>
                        <td class="text-center"> {{ $value->type_of_machine }} </td>
                        <td class="text-center">
                          @if($value->type_color_x_bk =="Colour")
                            <span class="badge bg-danger badge-pill"> Colour </span>
                          @elseif($value->type_color_x_bk == "B&W")
                            <span class="badge bg-secondary badge-pill"> Black & White </span>
                          @endif
                        </td>
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
    $("#example5").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "searching": true,
      // "buttons": ["excel", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example6').DataTable({
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
