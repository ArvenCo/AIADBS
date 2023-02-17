@extends('main')

@section('head')

@endsection




@section('content')


    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <div class="input-group w-25 me-3 float-end">
                    <input type="text" class="form-control" name="search" id="search">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
            <div class="card-body">

                <div class="row gy-3">
                    <div class="col-12 mt-2 row d-flex justify-content-end">
                       <div class="col-2 text-center ">
                            <label for="select" class="mt-2">Choose a Remark</label>
                       </div>
                       <select name="" id="selector" class=" form-select w-25 col-3">
                            <option value="*">All</option>
                            <option value="retain">Retained</option>
                            <option value="revise">Revised</option>
                       </select>
                    </div>
                    <div class="col-12">
                        <textarea name="" class="form-control" id="item-container" rows="15" placeholder="items can be retrieve here..."></textarea>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function autosuggest() {
            var department;
            $.ajax({
                type: "get",
                url: "/get-educators-department/{{ Auth::user()->id }}",
                dataType: "json",
                success: function (data) {
                    department = data.educator[0]['department_id'];
                    console.log(department);

                    
                    $.ajax({
                        type: "get",
                        url: `/subjects-by/${department}`,
                        dataType: "json",
                        success: function (data) {
                            
                            // console.log(data.subjects);
                            var subjects = [];
                            $.each(data.subjects, function (index, value) { 
                                subjects.push(value.subject);
                            });
                        
                            $('#search').autocomplete({
                                source : subjects
                            });
                        },error: function(data){
                            console.error(data);
                        }
                    });
                },
                error: function(data){
                    console.error(data);
                }
            });
            
        }

        
        function searchItemBy(subject, returnValue) {
           return $.ajax({
                type: "get",
                url: "/search/subject/"+subject,
                dataType: "json",
                success: function (data) {
                    
                    returnValue(data);
                }
            });
        }

        $(document).ready(function () {
            autosuggest();
            
            
        });
        $('#search').change(function (e) { 
            e.preventDefault();
            $('#item-container').empty();
            searchItemBy(this.value, function (data){
                var i =1;
                if (data.length < 1) {
                    $('#item-container').text('No results found');
                    
                }
                $.each(data.items, function (index, value) { 
                    $('#item-container').append(i + ". " + value.item_string);
                    i+=1;
                });
            });
            
        });
        $('#selector').change(function (e) { 
            e.preventDefault();
            
            searchItemBy($('#search').val(), function (data){
                var i =1;
                $('#item-container').empty();
                $.each(data.items, function (index, value) { 
                    var remark = $('#selector').val()
                    if (remark == value.final_rem){
                        $('#item-container').append(i + ". " + value.item_string);
                        i+=1;
                    }
                    if(remark == "*"){
                        $('#item-container').append(i + ". " + value.item_string);
                        i+=1;
                    }
                    
                });
            });
            
        });
        
    </script>
@endsection