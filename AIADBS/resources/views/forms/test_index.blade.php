@extends('main')

@section('head')
<!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
          

@section('header')
        <!-- Content Header (Page header) -->
          <?php
            $uri = Request::route()->uri();
            $page;
            if ($uri == 'test'){
              $page = 'Test';
            }
            if ($uri == 'analysis_list'){
              $page = 'Analysisable Tests';
            }
            if ($uri == 'print'){
              $page = 'Printable analysis';
            }
          ?>
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
            <h1 class="m-0">{{$page}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{$page}}</li>

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
                    <div class="card card-white">
                        <div class="card-header  border-0">
                            <h3 class="card-title"></h3>
                            @if($uri == 'test')
                            <a href="test/create" class="btn btn-secondary float-right text-white" >Create Test</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
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
                            <tbody style=";">
                            @foreach($tests as $test)
                              <tr>
                                <td>{{$test->id}}</td>
                                <td>{{$test->subject}}</td>
                                <td>{{$test->examination}}</td>
                                <td>{{$test->course}}</td>
                                <td>{{$test->date_given}}</td>
                                <td>{{$test->num_of_students}}</td>
                                <td class="">
                                  @if($uri == 'analysis_list')
                                  <a href="analysis/create/{{$test->id}}"  class=" btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Analysis"> 
                                    <i class="nav-icon fas fa-file-alt text-white"></i>
                                    
                                  </a>
                                  <a href="analysis/{{$test->id}}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Analysis">
                                    <i class="fas fa-edit text-white"></i>
                                  </a>
                                  @endif
                                  @if($uri == 'print')
                                  <a href="print/show/{{$test->id}}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Print">
                                    <i class="fas fa-print text-white"></i>
                                  </a>
                                  @endif
                                  @if($uri == 'test')
                                  <a href="test/show/{{$test->id}}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit text-white"></i>
                                  </a>
                                  @endif
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