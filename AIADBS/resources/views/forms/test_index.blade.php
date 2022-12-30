@extends('main')

@section('head')
<!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('header')
        <!-- Content Header (Page header) -->
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tests</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="#">Tests</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
@endsection

@section('content')
            <section class="content">
                <div class="content-fluid">
                    <div class="card">
                        <div class="card-header ">
                            <h3 class="card-title">DataTable with default features</h3>
                            <a href="test/create" class="btn btn-secondary float-right" >Crete Test</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-dark table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Examination</th>
                                <th>Course</th>
                                <th>Date Given</th>
                                <th>Number 
                                  of 
                                  Students</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody style="color:white;">
                            @foreach($tests as $test)
                              <tr>
                                <td>{{$test->id}}</td>
                                <td>{{$test->subject}}</td>
                                <td>{{$test->examination}}</td>
                                <td>{{$test->course}}</td>
                                <td>{{$test->date_given}}</td>
                                <td>{{$test->num_of_students}}</td>
                                <td>
                                  <a href="analysis/create/{{$test->id}}"  class="btn btn-info btn-xs"> 
                                    <i class="fas fa-chart-bar"></i>
                                  </a>
                                  <a href="" class="btn btn-info btn-xs">
                                    <i class="fas fa-print"></i>
                                  </a>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                            
                            <!-- <tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                            </tfoot> -->
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </section>
            
@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "paging": true
      //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
@endsection