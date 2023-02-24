@extends('main')

@section('content')

<div class="container py-5 h-100 " style="">
    <form action="/department" method="post" class="">
        @csrf
        <div class="card " style="height:100vh !important; ">
            <div class="card-header text-center bg-light border-0 h1">Register Department</div>
            <div class="card-body text-dark">
                <div class="row g-3 d-flex align-content-start h-100">
                    <div class="col-md-12 row">
                        <div class="col-md-7">
                            <div class="form-group ">
                                <label for="department" class="form-input-label">Department</label>
                                <input required type="text" name="department" placeholder="ex. College of Computing and Information Science - CCIS" id="department" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="education-form" >Education Office</label>
                            <div class="form-group" id="education-form">
                                <div class="form-check form-check-inline" >
                                    <input type="radio" name="education_office" value="DepEd" class="form-inline-check" id="DepEdRadio" required>
                                    <label for="DepEdRadio" class="form-check-label">DepEd</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="education_office" value="CHED" class="form-inline-check" id="CHEDRadio">
                                    <label for="CHEDRadio" class="form-check-label">CHED</label>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                    </div>
                    <div class="col-md-6 " style="height:78% !important;">
                        <h1 class="text-center h3">Course</h1>
                        <div class="input-group" >
                            <input required type="number" value="1" name="" id="course-row" class="form-control">
                            <a id="course-gen" class="btn btn-success">
                                <i class="nav-icon fas fa-plus"></i>
                            </a>
                        </div>

                            <a onclick="clearList('course')"class="btn btn-danger my-2 w-25">Clear</a>
        
                        <div id="course-list" class="list-group border-top border-bottom " style="height:70% !important; overflow-y: auto !important;">
                            <div id="1" class="list-group-item border-0">
                                <div class="input-group">
                                    <a id="1" onclick="remove('course',this.id)" class="btn btn-outline-danger text-center">
                                        <i class="nav-icon fas fa-minus"></i>
                                    </a>
                                    <input required type="text" name="course[]" id="" placeholder="ex. Bachelor of Science in Information Technology - BSIT" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="height:78% !important;">
                        <h1 class="text-center h3">Subject</h1>
                        <div class="input-group">
                            <input required type="number" value="1" name="" id="subject-row" class="form-control">
                            <a id="subject-gen" class="btn btn-success">
                                <i class="nav-icon fas fa-plus"></i>
                            </a>
                        </div>
                            <a onclick="clearList('subject')" class="btn btn-danger my-2 w-25">Clear</a>
                        <div id="subject-list" class="list-group border-0 " style="height:70% !important; overflow-y: auto !important;">
                            <div id="1" class="list-group-item border-0">
                                <div class="input-group">
                                    <a id="1" onclick="remove('subject',this.id)" class="btn btn-outline-danger text-center">
                                        <i class="nav-icon fas fa-minus"></i>
                                    </a>
                                    <input required type="text" name="subject[]" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-white border-0">
                <button  class="btn btn-primary form-control float-right"> Register </button>
            </div>
        </div>
    </form>
</div>


@endsection

@section('script')
<script>
    function clearList(container){
        $(`#${container}-list>div`).remove();
        
        var placeholder = "";
        if (container == 'course') placeholder = 'placeholder="ex. Bachelor of Science in Information Technology - BSIT"';
        $(`#${container}-list`).append(`
            <div id="1" class="list-group-item border-0">
                <div class="input-group">
                    <a id="1" onclick="removeThis(this.id)" class="btn btn-outline-danger text-center">
                        <i class="nav-icon fas fa-minus"></i>
                    </a>
                    <input required type="text" name="${container}[]" ${placeholder} id="" class="form-control">
                </div>
            </div>
        `);
    }
    function remove(container,$id) {
       
        $(`#${container}-list>div#`+$id).remove();
    }
    
    $(document).ready(function(){
        var subjectRow = 1
        $("#subject-gen").click(function(){
            var num = $('#subject-row').val();
            // $('#subject-list').empty();
            subjectRow += 1;
            for (var i = subjectRow; i < parseInt(num) + subjectRow; i++) {
                $('#subject-list').append(`
                    <div id="${i}" class="list-group-item border-0">
                        <div class="input-group">
                            <a id="${i}" onclick="remove('subject',this.id)" class="btn btn-outline-danger text-center">
                                <i class="nav-icon fas fa-minus"></i>
                            </a>
                            <input required type="text" name="subject[]"  id="" class="form-control">
                        </div>
                    </div>
                `);
            }
        });
        var courseRow = 1;
        $("#course-gen").click(function(){
            var num = $('#course-row').val();
            // $('#course-list').empty();
            courseRow += 1;
            for (var i = courseRow; i < parseInt(num)  + courseRow; i++) {
                $('#course-list').append(`
                    <div id="${i}" class="list-group-item border-0">
                        <div class="input-group">
                            <a id="${i}" onclick="remove('course',this.id)" class="btn btn-outline-danger text-center">
                                <i class="nav-icon fas fa-minus"></i>
                            </a>
                            <input required type="text" name="course[]" placeholder="ex. Bachelor of Science in Information Technology - BSIT" id="" class="form-control">
                        </div>
                    </div>
                `);
            }
        });
        
        
        
        $('#clear').click(function() {
            $('table tbody').empty();
        });

    });
</script>
@endsection
