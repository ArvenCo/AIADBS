@extends('main')

@section('head')
@include('forms.modules.datatable.head')
@endsection
          
@section('content')

<div class="content">
    <div class="card card-white">
        <div class="card-header">
            <a data-bs-toggle="modal" data-bs-target="#createModal"  class="btn btn-secondary px-2 float-end text-light">Add educator</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover " id="example1" data-filter-control="true" data-show-search-clear-button="true">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Educator</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($educators as $educator)
                    <tr>
                        <td style="width: 5% !important; white-space: nowrap !important;"> 
                            {{$educator->id}}
                        </td>
                        <td data-bs-toggle="modal" data-bs-target="#modal{{$educator->id}}">
                            {{$educator->name}}
                        </td>
                        <td style="width: 1% !important; white-space: nowrap !important;">
                            <a href="" class="btn btn-primary">
                                <i class="fas fa-user-edit"></i>
                            </a>
                        </td>
                    </tr>

                    
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<div id="modals">
    


    @foreach($educators as $educator)
    <div class="modal fade" id="modal{{$educator->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$educator->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Instructor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addInstructor"ethod="POST" action="{{ route('educator.register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="add-name" >{{ __('Name') }}</label>
                                <input id="add-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="add-email" >{{ __('Username') }}</label>
                                    <input id="add-email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>
                            <div class="form-group">
                                <span>Password already set to default: iameducator</span>
                            </div>
                        </div>
                        <div class="col-6">
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
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-select overflowx-auto" style="width:100% !important;">
                                    
                                    <!-- Ajax Content Generated HERE -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Assigned Courses</label>
                                <div id="subject-list" class="list-group border-0 mh-50 overflow-auto" style="max-height: 31vh !important;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <br>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8 ">
                            <button type="submit" class="btn btn-primary form-control">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            
        </div>
    </div>
</div>

@endsection

@section('script')

@include('forms.modules.datatable.scripts')
<script>
    // const myModal = document.getElementById('myModal');
    // const myInput = document.getElementById('myInput');

    // myModal.addEventListener('shown.bs.modal', () => {
    // myInput.focus()
    // })
</script>

<script>


   
    $(document).ready(function(){

        $('#add-name').on("keypress blur", function(){
            
            var array  =  $('#add-name').val().split(' ');
            if (array.length > 0) {
                var first = array[0];
                var last = "" ;
                
                if (array.length > 1){
                    last = array[array.length-1];
                }
                var firstN ="";
                if (first.length >0) firstN = first.length;
                var lastN ="" ;
                if (last.length > 0) lastN = last.length;
                $('#add-email').val((first + last+ firstN + lastN).toLowerCase());
            }
        });

        $('input[type="radio"]').on('change', function(){
            var office = $('input[name="education_office"]:checked').val();
        

            $.ajax({
                type: "get",
                url: `/getfunction/${office}`,
                dataType: "json",
                success: function (data){
                    console.log(data);
                    
                    $('#department').html(`
                        <option selected disabled>${office}</option>
                    `);
                    $.each(data['departments'], function(key, value){
                        
                        $('#department').append(`
                            <option value="${value.id}" id="selected-department">${value.name}</option>
                        `);
                    });
                    
                    $('#department').on('change' ,[subjects = data['department_array']], function(){
                        
                        
                        $('option:selected').each(function(){
                            
                            $('#subject-list').empty();
                            var index = 1;
                            $.each(subjects[$(this).val()]['course'], function(key, value){

                                $('#subject-list').append(`
                                    <div class="list-group-item border-0 border-bottom">
                                        <div class="form-check">
                                            <input type="checkbox" name="subjects[]" class="form-check-input" value="${value['abbreviation']}" id="${value['abbreviation']}">
                                            <label for="${value['abbreviation']}" class="form-check-label">${value['abbreviation']}</label>
                                        </div>
                                    </div>
                                `);
                                
                                index += 1;

                            });

                            
                            
                        });

                    });
                    
                },
                error: function(data){
                    console.error(data);
                }
            });            
        });

       
        
    });
</script>
@endsection