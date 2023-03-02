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
            if ($uri == 'databank'){
              $page = 'Data Bank';
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
                            <table id="example1" class="table table-bordered table-hover" data-filter-control="true" data-show-search-clear-button="true">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th data-filter-control="input">Subject</th>
                                <th data-filter-control="select">Examination</th>
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

                                  <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-center">
                                      @if($uri == 'analysis_list')
                                      
                                      <a href="analysis/create/{{$test->id}}"  class="dropdown-item" 
                                      data-toggle="tooltip" data-placement="top" title="Item Analysis"> 
                                        <i class="fas fa-chart-bar "></i>
                                        Item Analysis
                                      </a>
                                      <a href="analysis/{{$test->id}}" class="dropdown-item"
                                      data-toggle="tooltip" data-placement="top" title="Edit Item Analysis">
                                        <i class="fas fa-edit "></i>
                                        Edit Analysis
                                      </a>
                                      @endif

                                      @if($uri == 'print')
                                      <a href="print/show/{{$test->id}}" class="dropdown-item"
                                      data-toggle="tooltip" data-placement="top" title="Item Analysis">
                                        <i class="fas fa-print "></i>
                                        Item Analysis
                                      </a>
                                      @endif

                                      @if($uri == 'databank')
                                      <a href="databank/show/{{$test->id}}" class="dropdown-item"
                                      data-toggle="tooltip" data-placement="top" title="Items">
                                        <i class="far fa-copy "></i>
                                        Items 
                                      </a>
                                      @endif
                                      
                                      @if($uri == 'test')
                                      <a href="answer/create/{{$test->id}}"  class="dropdown-item" 
                                        data-toggle="tooltip" data-placement="top" title="Item Analysis"> 
                                          <i class="fas fa-chart-bar "></i>
                                          Answer the Test
                                      </a>
                                      <a href="test/show/{{$test->id}}" class="dropdown-item"
                                      data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fas fa-edit "></i>
                                        Edit
                                      </a>
                                      @endif
                                    </div>
                                  </div>
                                  
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
  $(document).ready(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "paging": true,
      "searching":true,
      "columnDefs": [{
            targets: [1, 2],
            searchable: true
        }, {
            targets: [2],
            select: true
        }]
      
      
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