@extends('layouts.master')
@section('title','แก้ไขข้อมูลเครื่อง')

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
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"> ข้อมูลหลัก </a></li>
            <li class="breadcrumb-item active"> แก้ไขข้อมูลเครื่อง </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container">

      <form action="{{ route('machine.save') }}" method="POST">
        @csrf

          <div class="row">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header" style="background-color: #F0F8FF;">
                  <h3 class="card-title"><b><i class="fas fa-file-signature"></i> เพิ่มข้อมูลเครื่องพิมพ์ / อุปกรณ์ </b></h3>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> ยี่ห้อ </label><font color="red"> * </font>
                          <!-- hidden = ID -->
                          <input type="hidden" class="form-control" name="id" value="{{ $edit_machine->id }}">

                          <select class="form-control" name="brands">
                            @foreach($brands as $value)
                              <option value="{{ $value->id }}" {{ $edit_machine->brands == $value->id ? 'selected' : '' }}> {{ $value->brands }} </option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> รุ่น </label><font color="red"> * </font>
                        <input type="text" class="form-control" name="model" value="{{ $edit_machine->model }}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> Serial No. </label><font color="red"> * </font>
                        <input type="text" class="form-control" name="serial_no" value="{{ $edit_machine->serial_no }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> หมายเลข DNO </label><font color="red"> * </font>
                        <input type="text" class="form-control" name="dno_number" value="{{ $edit_machine->dno_number }}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> Segment </label><font color="red"> * </font>
                        <select class="form-control" name="segment">
                            @foreach($segment as $value)
                              <option value="{{ $value->id }}" {{ $edit_machine->segment == $value->id ? 'selected' : '' }}> {{ $value->segment }} </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> B&W / Colour </label><font color="red"> * </font>
                          <select class="form-control" name="type_color_x_bk">
                            @foreach($type_color_x_bk as $key => $value)
                              <option value="{{ $key }}" {{ $edit_machine->type_color_x_bk == $key ? 'selected' : '' }}> {{ $value }} </option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> ประเภทอุปกรณ์ </label><font color="red"> * </font>
                          <select class="form-control" name="type_of_machine">
                            @foreach($type_of_machine as $key => $value)
                              <option value="{{ $key }}" {{ $edit_machine->type_of_machine == $key ? 'selected' : '' }}> {{ $value }} </option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label> โน้ตอื่นๆ </label><font color="red"> * (ถ้ามี) </font>
                        <textarea type="text" class="form-control" name="remark" rows="3"> {{ $edit_machine->remark }} </textarea>
                      </div>
                    </div>
                  </div>

                </div> <!-- END card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right" value="บันทึกข้อมูล">
                    <i class="fas fa-save"></i> &nbsp;แก้ไขข้อมูล
                  </button>

                  <!-- <button type="submit" class="btn btn-primary float-right"> แก้ไขข้อมูล </button> -->
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
