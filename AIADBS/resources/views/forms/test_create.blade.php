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
                        <div class="col-sm-8">
                          
                          <select name="subject" id="subject" required class="form-control">
                            
                          </select>

                        </div>
                        <div class="col-sm-2">
                          <a href="#" class="btn btn-outline-secondary float-start" data-toggle="modal" data-target="#subjects-modal"><i class="fa fa-book" aria-hidden="true"></i></a>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="examination" class="col-sm-2 col-form-label">Examination</label>
                        <div class="col-sm-10">
                          
                          <select name="examination" id="examination" class="form-control">
                              <option value="Finals" >Final</option>
                              <option value="Pre-final" >Pre-final</option>
                              <option value="Midterm" >Midterm</option>
                              <option value="Prelim" >Prelim</option>
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
    <!-- .modal -->
    <div class="modal fade" id="subjects-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="user-subjects">
              
              <div class="row">
                
                

              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="save-subjects" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- /.modal -->
    

    <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
    
@endsection


@section('script')
    <!-- bs-custom-file-input -->
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  
  @php 
  $options = $subjects;
  $user_id = Auth::id();
  @endphp

  <script>
    function GET(url,data){
      return $.ajax({
        type: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (response) {
          return response
        }
      });
    }

    function POST(url,data){
      return $.ajax({
        type: "post",
        url: url,
        data: data,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          return response;
        }
      });
    }

    function saveUserSubjects(){
      
    }
    $(document).ready(function () {
      



      $('#save-subjects').click(function (e) {
        
        const subjects = POST('/user/subjects/save', $('#user-subjects').serialize());
        subjects.then(function (data) {
          alert(data)
        })

        

        e.preventDefault();
      });
      
      const user = GET('/educator/show',{id : $('#user_id').val()});
      user.then(function(data){
        



        const department_ids = data['department_ids'].split(', ');

        const courses = GET('/courses/show',{department_id: department_ids});
        courses.then(function (data){
        });
        const subjects = GET('/subjects/show',{department_id: department_ids});
        subjects.then(function (data){
          console.log(data);
          $('#user-subjects').empty();
          let html = ``;
          $.each(data, function (index, value){ 
              html += 
                `<div class="col-auto flex-shrink-1">
                  <div class="form-check">
                    <input type="checkbox" class=""  name="subjects[]" id="${value.id}" value="${value.name}">
                    <label class="form-check-label" for="${value.id}">${value.name}</label>
                  </div>
                </div>`;
             
          });
          $('#user-subjects').html(html);

          const userSubjects = GET('/educator/show',{id : $('#user_id').val()});
          userSubjects.then(function (data) {
            $('select#subject').empty();
            $('select#subject').html('<option value="" hidden selected>Choose a Subject</option>');
            $.each(data.subjects.split(', '), function (index, value) { 
              $('select#subject').append(`
                <option value=${value}>${value}</option>
              `);

              $("input[name='subjects[]']").each(function (index, element) {
                // element == this
                console.log(value);
                if (element.value == value) {
                  element.checked = true;
                }
              });
              
            });

          });
          
        });
        
        

        
      });

      

      
    });



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

