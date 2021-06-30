@extends('layouts.master')
@section('title','ข้อมูลเครื่อง')

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
      <div class="row mb-2 justify-content-md-center">
        <!-- <div class="col-sm-11"> -->
          <!-- <h1>General Form</h1> -->
        <!-- </div> -->
        <div class="col-sm-11">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"> ข้อมูลหลัก </a></li>
            <li class="breadcrumb-item active"> ข้อมูลเครื่อง </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col col-lg-11">

      <div class="row">
        <div class="col-md-12 text-center">
          <a href="{{ route('our.machine_copy_create') }}">
            <button type="button" class="btn btn-info float-right" style=" height: 50px; padding:10px 40px;">
              <i class="fas fa-plus-circle"></i>
                เพิ่มข้อมูลเครื่องใหม่
            </button>
          </a>

        </div>
      </div>
      <br>

      <!-- DATA TABLE 1 -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"> <i class="fas fa-print"></i> <b>ข้อมูลเครื่อง</b></h3>
            </div>

            <div class="card-body">
              <div class="table-responsive hover">
                <table id="example5" class="table table-bordered table-striped table-reponsive table-sm">
                  <thead class="text-nowrap" style="background-color: #F0F8FF;">
                    <tr>
                      <th class="text-center"> ลำดับ </th>
                      <th class="text-center"> ยี่ห้อ </th>
                      <th class="text-center"> รุ่น </th>
                      <th class="text-center"> Serial No. </th>
                      <th class="text-center"> หมายเลข DNO </th>
                      <th class="text-center"> B&W / Colour </th>
                      <th class="text-center"> ประเภทอุปกรณ์ </th>
                      <th class="text-center"> สถานะเครื่อง </th>
                      <th class="text-center"> Actions </th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($data_tbl1_machine as $value)
                      <tr>
                        <td class="text-center"> {{ $i }} </td>
                        <td> {{ $brands [$value->brands] }} </td>
                        <td> {{ $value->model }} </td>
                        <td class="text-center text-danger"> {{ $value->serial_no }} </td>
                        <td class="text-center text-primary"> {{ $value->dno_number }} </td>
                        <td class="text-center">
                          @if($value->type_color_x_bk =="Colour")
                            <span class="badge bg-danger badge-pill"> Colour </span>
                          @elseif($value->type_color_x_bk == "B&W")
                            <span class="badge bg-secondary badge-pill"> Black & White </span>
                          @endif
                        </td>
                        <td class="text-center"> {{ $type_of_machine [$value->type_of_machine] }} </td>
                        <td class="text-center">
                          @if($value->status == NULL)
                            <span class="badge bg-success badge-pill"> Active </span>
                          @elseif($value->status == "1")
                            <span class="badge bg-secondary badge-pill"> Inactive </span>
                          @endif
                        </td>
                        <td class="text-center">
                          <!-- Edit -->
                            <a href="{{ route('machine.edit',['id' => $value->id]) }}">
                              <button type="button" class="btn btn-warning btn-md" title="Edit">
                                <i class="fas fa-edit"></i>
                              </button>
                            </a>
                          <!-- END Edit -->

                          <!-- Delete -->
                            <button type="button" class="btn btn-danger btn-md" title="Delete" data-toggle="modal">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          <!-- END Delete -->
                        </td>


                            <!-- MODAL StatusModal -->
                            <div class="modal fade" id="ActiveModal{{ $value->id }}">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title"><b> สถานะของเครื่อง ( ID. <font color = "red"> {{$value->id}} </font>) </b></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">

                                      <p> <b>เลข ID สัญญา</b> : {{ $value->contract_id }} </p>
                                      <p> <b>เลขที่สัญญา</b> : {{ $value->contract_number }} </p>
                                      <p> <b><font color = "blue">วันที่เริ่มสัญญา</font></b> : {{ CmsHelper::DateThai($value->start_contract) }} </p>
                                      <p> <b><font color = "red">วันที่สิ้นสุดสัญญา</font></b> : {{ CmsHelper::DateThai($value->end_contract) }} </p>

                                    <hr>
                                      <p> <b>รหัสลูกค้า</b> : {{ $value->customer_code }} </p>
                                      <p> <b>ชื่อลูกค้า / บริษัท</b> : {{ $value->customer_name }} </p>

                                  </div> <!-- END modal-bodyl -->
                                </div>
                              </div>
                            </div>
                            <!-- END MODAL StatusModal -->

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
        </div> <!-- Col DataTable 1 -->
      </div> <!-- Row DataTable 1 -->
      <br>
      <hr>
      <br>



      <!-- DATA TABLE 2 (**มีสัญญาเช่าแล้ว) -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-danger card-outline">
            <div class="card-header">
              <h3 class="card-title"> <i class="fas fa-newspaper"></i> <b> ข้อมูลเครื่อง <font color = "red"> (**มีสัญญาเช่าแล้ว) </font></b></h3>
            </div>

            <div class="card-body">
              <div class="table-responsive hover">
                <table id="example6" class="table table-bordered table-striped table-reponsive table-sm">
                  <thead class="text-nowrap" style="background-color: #F0F8FF;">
                    <tr>
                      <th class="text-center"> ลำดับ </th>
                      <th class="text-center"> เลขที่สัญญา </th>
                      <th class="text-center"> ยี่ห้อ </th>
                      <th class="text-center"> รุ่น </th>
                      <th class="text-center"> Serial No. </th>
                      <th class="text-center"> หมายเลข DNO </th>
                      <th class="text-center"> B&W / Colour </th>
                      <th class="text-center"> ประเภทอุปกรณ์ </th>
                      <th class="text-center"> สถานะเครื่อง </th>
                      <th class="text-center"> Actions </th>
                    </tr>
                  </thead>

                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach($data_tbl2_machine as $value)
                      <tr>
                        <td class="text-center"> {{ $i }} </td>
                        <td class="text-center"> {{ $value->id }} </td>
                        <td> {{ $brands [$value->brands] }} </td>
                        <td> {{ $value->model }} </td>
                        <td class="text-center text-danger"> {{ $value->serial_no }} </td>
                        <td class="text-center text-primary"> {{ $value->dno_number }} </td>
                        <td class="text-center">
                          @if($value->type_color_x_bk =="Colour")
                            <span class="badge bg-danger badge-pill"> Colour </span>
                          @elseif($value->type_color_x_bk == "B&W")
                            <span class="badge bg-secondary badge-pill"> Black & White </span>
                          @endif
                        </td>
                        <td class="text-center"> {{ $type_of_machine [$value->type_of_machine] }} </td>
                        <td class="text-center">
                          @if($value->status == NULL)
                            <span class="badge bg-success badge-pill"> Active </span>
                          @elseif($value->status == "1")
                            <span class="badge bg-secondary badge-pill"> Inactive </span>
                          @endif
                        </td>
                        <td class="text-center">
                          <!-- Details -->
                            <button type="button" class="btn btn-info btn-md" title="Details" data-toggle="modal" data-target="#StatusModal{{ $value->id }}">
                              <i class="fas fa-bars"></i>
                            </button>
                          <!-- END Details -->
                        </td>


                            <!-- MODAL StatusModal -->
                            <div class="modal fade" id="StatusModal{{ $value->id }}">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title"><b> สถานะเครื่อง ( ID. <font color = "red"> {{$value->id}} </font>) </b></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">

                                      <p> <b>เลข ID สัญญา</b> : {{ $value->contract_id }} </p>
                                      <p> <b>เลขที่สัญญา</b> : {{ $value->contract_number }} </p>
                                      <p> <b><font color = "blue">วันที่เริ่มสัญญา</font></b> : {{ CmsHelper::DateThai($value->start_contract) }} </p>
                                      <p> <b><font color = "red">วันที่สิ้นสุดสัญญา</font></b> : {{ CmsHelper::DateThai($value->end_contract) }} </p>

                                    <hr>
                                      <p> <b>รหัสลูกค้า</b> : {{ $value->customer_code }} </p>
                                      <p> <b>ชื่อลูกค้า / บริษัท</b> : {{ $value->customer_name }} </p>

                                  </div> <!-- END modal-bodyl -->
                                </div>
                              </div>
                            </div>
                            <!-- END MODAL StatusModal -->


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
        </div> <!-- Col DataTable 2 -->
      </div> <!-- Row DataTable 2 -->


    </div>
    </div>
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
    $("#example5").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "searching": true,
      // "buttons": ["excel", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example6").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "searching": true,
      // "buttons": ["excel", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example7').DataTable({
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
    @if(Session::get('machines'))
     <?php Session::forget('machines'); ?>
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
      @if(Session::get('savemachines'))
       <?php Session::forget('savemachines'); ?>
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

@stop
