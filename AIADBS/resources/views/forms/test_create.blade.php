@extends('main')

@section('head')

<!-- Select2 -->
<link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
              
              <li class="breadcrumb-item"><a href="/test" style=''>Tests</a></li>
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
        <div class="card card-white">
              <div class="card-header bg-white border-0">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal"  id="thisForm" action="\test" method="POST" onsubmit="return checkForm(this);">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <!-- form left side -->
                    <div class="col-8">
                      <div class="form-group row">
                        <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                          
                          <input type="text" required name="subject" class="form-control" id="subject">

                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="examination" class="col-sm-2 col-form-label">Examination</label>
                        <div class="col-sm-10">
                          
                          <select name="examination" id="examination" class="form-control">
                              <option value="Finals" >Final</option>
                              <option value="Finals" >Pre-final</option>
                              <option value="Finals" >Midterm</option>
                              <option value="Finals" >Prelim</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                          
                          <select name="course" id="course" class="form-control">
                            @foreach($courses as $course)
                            <option value="{{$course}}">{{$course}}</option>
                            @endforeach
                          </select>
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
                          <input  type="text" class="form-control" id="instructor"  name="instructor" disabled value="{{ Auth::user()->name }}"> 
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
                    <button id="button" class="btn btn-primary px-5 float-right" >Submit</button>
                  </div>
                  <div class="card-body">
                    <small class="text-danger">Please note that nothing should be before at number item.</small>
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
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  
  @php 
  $options = $subjects;
  
  @endphp

  <script>
    var items = @JSON($subjects);
    const array = [];
    $.each(items, function (index, item) { 
      array.push(item['name']);
    });
    
    $('#subject').autocomplete({ source: array });
  </script>
  <script type="text/javascript">

  var checkForm = function(form) {

  //
  // validate form field
  //
    $.get('');
    form.myButton.disabled = true;
    return true;
  };
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

