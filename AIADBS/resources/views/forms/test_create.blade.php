@extends('main')

@section('head')
<!-- summernote -->
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<style>
  input{
    background: #fff!important;
    color: black!important;
  }
</style>
@endsection


@section('header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Test</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="/tests" style=''>Tests</a></li>
              <li class="breadcrumb-item active">Create Test</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- general form elements -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal"  id="thisForm" action="\test" method="POST">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <!-- form left side -->
                    <div class="col-8">
                      <div class="form-group row">
                        <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                          <input required type="text" class="form-control" id="subject" name="subject" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="examination" class="col-sm-2 col-form-label">Examination</label>
                        <div class="col-sm-10">
                          <input required type="text" class="form-control" id="examination" name="examination">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                          <input required type="text" class="form-control" id="course" name="course">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="set" class="col-sm-2 col-form-label">Set</label>
                        <div class="col-sm-10">
                          <input required type="text" class="form-control" id="set" name="set">
                        </div>
                      </div>
                    </div>
                    <!-- form right side -->
                    <div class="col-4">
                      <div class="form-group row">
                        <label for="dateGiven" class="col-sm-4 col-form-label">Date Given</label>
                        <div class="col-sm-8">
                          <input required type="date" class="form-control" name="dateGiven" id="dateGiven">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="instructor" class="col-sm-4 col-form-label">Instructor</label>
                        <div class="col-sm-8">
                          <input required type="text" class="form-control" id="instructor"  name="instructor" disabled value="{{ Auth::user()->name }}"> 
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="students" class="col-sm-5 col-form-label">No. of Students</label>
                        <div class="col-sm-7">
                          <input required type="number" class="form-control" id="students"  name="studentsNo"> 
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <button id="button" class="btn btn-info float-right" >Submit</button>
                  </div>
                  <div class="card-body">
                    <textarea id="" class="form-control" name="textarea" rows="22" placeholder="Paste your Questions here" required></textarea>
                </div>
                </div>
            </div>
              </form>
            </div>
            <!-- /.card -->
      </div>
    </section>
    <!-- /.content -->
@endsection


@section('script')
    <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <script>
   $(function () {
    // Summernote
    $('#summernote').summernote({
      placeholder:'Place your questions here.',
      height:500,
      toolbar:false,
      

    })

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  });
  </script>

  <script type="text/javascript">

    function paste(){
      
      if(true){
        document.getElementsByName("textArea").value  = "";
      }
    }


    function isQuestionString() {
      // Split the string into an array of lines
      var string = document.getElementsByName("textArea").value;
      var lines = string.split('\n');
      
      // Iterate over the lines
      for (var i = 0; i < lines.length; i++) {
        // Split the line into a number and a question using the period as a delimiter
        var parts = lines[i].split('.');
        var number = parts[0];
        var question = parts[1];
        
        // Strip leading and trailing whitespace from the number and question
        number = $.trim(number);
        question = $.trim(question);
        
        // Check if the number is a positive integer
        if (!$.isNumeric(number) || number < 1) {
          return false;
        }
        
        // Check if the question is a non-empty string
        if (typeof question !== 'string' || question === '') {
          return false;
        }
      }
      
      return true;
    }

// Test the function


  </script>
@endsection

