@extends('main')

@section('content')

<div class="container py-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 ">
            <div class="card " >
                <div class="card-header bg-white border-0 text-center h1">{{ __('Register Educator') }}</div>

                <div class="card-body mh-100">
                    <form method="POST" action="{{ route('educator.register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" >{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" >{{ __('Username') }}</label>
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                        <option selected disabled></option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}" id="selected-department">{{$department->abbreviation}} - {{$department->name}}</option>
                                        @endforeach
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
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')


<script>
    $(document).ready(function(){

        $('#department').on('change' , function(){
            $('option:selected').each(function(){
                var subjects = @json($department_array);
                $.each(subjects[$(this).val()]['course'], function(key, value){
                    
                    $('#subject-list').append(`
                        <div class="list-group-item border-0 border-bottom">
                            <div class="form-check">
                                <input type="checkbox" name="subjects[]" class="form-check-input" value="${value['abbreviation']}" id="${value['abbreviation']}">
                                <label for="${value['abbreviation']}" class="form-check-label">${value['abbreviation']}</label>
                            </div>
                        </div>
                    `);
                });
            });
        });

        $('#name').on('keypress blur',function(){
        var array  =  $('#name').val().split(' ');
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
            $('#email').val((first + last+ firstN + lastN).toLowerCase());
        }
        });
    });
</script>

@endsection