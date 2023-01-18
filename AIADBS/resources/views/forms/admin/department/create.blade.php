@extends('main')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-5 ">
            <div class="card">
                <div class="card-header bg-white border-0 text-center h1">{{ __('Register Department') }}</div>
                <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" name="department" id="department" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="form-label">No. of Subject</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="number" name="" id="subjectNum" class="form-control ">
                                    </div>
                                    <a id="genrows" class="btn btn-secondary col-3">Generate</a>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <table class="table w-100">
                                <a id="clear" class="btn btn-warning float-right">
                                    Clear Rows
                                </a>
                                <div class="bg-white border-0 text-center h3">Subjects</div>
                                <tbody>
                                   
                                </tbody>
                                <br>
                                <button class="btn btn-primary float-right">Register</button>
                            </table>
                            
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
        $("#genrows").click(function(){
            var num = $('#subjectNum').val();
            for (var i = 0; i < num; i++) {
                $('table tbody').append(`
                <tr>
                    <td><input type="text" name="subject[]" id="" class="form-control border-dark"></td>
                </tr>
                `);
            }
            
        });
        $('#clear').click(function() {
            $('table tbody').empty();
        });
    });
</script>
@endsection
