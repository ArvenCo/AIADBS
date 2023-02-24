@extends('main')

@section('head')
@include('forms.modules.datatable.head')
@endsection
          
@section('content')

<div class="content">
    <div class="card card-white">
        <div class="card-header">
            <a href="/department/create" class="btn btn-secondary px-2 float-end text-light">Add Department</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover " id="example1" data-filter-control="true" data-show-search-clear-button="true">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Department</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td style="width: 5% !important; white-space: nowrap !important;"> 
                            {{$department->id}}
                        </td>
                        <td data-bs-toggle="modal" data-bs-target="#modal{{$department->id}}">
                            {{$department->name}} - {{$department->abbreviation}}
                        </td>
                        <td style="width: 1% !important; white-space: nowrap !important;">
                            <div class="dropdown ">
                                <a href="#" class="btn btn-outlined-secondary dropdown-toggle px-5 " 
                                role="button"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a href="#" class="dropdown-item">
                                        <i class="far fa-edit text-success"></i>
                                        Edit
                                    </a>
                                    <a href="#" onclick="subjectModal({{ $department->id }});" class="dropdown-item">
                                        <i class="fas fa-book text-primary"></i>
                                        Subjects
                                    </a>
                                    <a onclick="trashIt('{{ $department->id }}');"  class="dropdown-item">
                                        <i class="far fa-trash-alt text-danger"></i>
                                        Trash
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<div id="modals">
    <div class="modal fade" id="subject-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="subject-modal-title">Update Instructor</h5>
                    <button type="button" class="close" onclick="subjectModal('0')" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-subject" onsubmit="event.preventDefault();">
                        <input type="hidden" name="department_id" >
                        <div class="contaiener row gy-3">
                            <div class="col-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="subject" placeholder="Add Subject" id="subject-add">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" onclick="addSubject();">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 readonly">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control" name="" value="Sample Subject" id="">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" onclick="trashIt(0)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" onclick="subjectModal('0')" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    @include('forms.modules.datatable.scripts')
    
    
    
    <script>
        function GET(url){
            return $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (response) {
                    return response;
                }
            });
        }
        function POST(url, data){
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                }
            });
        }

        function getSubjects(id) {
             //GET list of subjects by department ID 
             var subjects = GET(`/subject/show/${id}`);
                subjects.then(function(data){
                    console.log(data);
                    
                    $('#form-subject div.readonly').remove();

                    var subject= data.subjects;
                    $.each(subject, function (index, value) { 
                       console.log(value.name);
                        const div = `
                            <div class="col-4 readonly">
                                <div class="input-group">
                                    <input type="text" readonly class="form-control" name="" value="${value.name}" id="">
                                    <div class="input-group-append">
                                        
                                        <button class="btn btn-outline-danger" onclick="trashIt(${value.id})">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `
                        $('#form-subject>div').append(div);
                    });
                });
        }

        function subjectModal(id) {
            
            if(id != 0){

                $('#form-subject input[name="department_id"]').val(id);

                //GET department by ID
                var department = GET('/department/show/'+id);
                department.then(function(data){
                    $('#subject-modal-title').html(data.name + ' - Subjects' );
                });

                getSubjects(id);
            }
            $('#subject-modal').modal('toggle');
        }

        function addSubject(){
            var subject = $('#subject-add').val();
            var data = $('#form-subject').serialize();
            POST('/subject/store', data);
            $('input[name="subject"]').val("");
            getSubjects($('#form-subject input[name="department_id"]').val());
           
        }


        function trashIt(id){
            POST('subject/destroy',{ id: id});
            getSubjects($('#form-subject input[name="department_id"]').val());
        }
        $(document).ready(function () {
            
        });
    </script>
@endsection