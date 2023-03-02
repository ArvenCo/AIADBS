@extends('main')
@section('content')
    <div class="container pt-3 ">
        
        <div class="card">
            
            <div class="card-body">
                <h4 class="card-title">Test Information
                    <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                </h4>
                <p class="card-text"></p>
                
            <div class="row">
                    <div class="col-6">
                        <div class="form-group row">
                        <label for="subject" class="col-3 col-form-label text-end">Subject</label>
                        <div class="col-9">
                            <input type="text" id="subject" readonly class="form-control" 
                                value="{{ $test->subject }}" placeholder="" aria-describedby="helpId">                            
                        </div>
                        
                        </div>

                        <div class="form-group row">
                        <label for="examination" class="col-3 col-form-label text-end">Examination</label>
                        <div class="col-9">
                            <input type="text" id="examination" readonly class="form-control" 
                                value="{{ $test->examination }}" placeholder="" aria-describedby="helpId">
                        </div>
                        
                        </div>
                        <div class="form-group row">
                            <label for="course" class="col-3 col-form-label text-end">Course</label>
                            <div class="col-9">
                                <input type="text" id="course" readonly class="form-control" 
                                    value="course Sample" placeholder="" aria-describedby="helpId">
                            </div>
                            
                            
                        </div>
                        <div class="form-group row">
                            <label for="set" class="col-3 col-form-label text-end">Set</label>
                            <div class="col-9">
                                <select name="set" id="set" class="form-control">
                                    <option value="" hidden>Choose a Set</option>
                                    @foreach ($sets as $set)
                                    <option value="{{ $set->id }}">{{ $set->set_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                        <label for="dategiven" class="col-3 col-form-label text-end"> Date Given</label>
                        <div class="col-6">
                            <input readonly type="date" value="{{ $test->date_given }}" name="dategiven" id="dategiven" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        
                        </div>
                        <div class="form-group row">
                            <label for="instructor" class="col-3 col-form-label text-end">Instructor</label>
                            <div class="col-6">
                                <input readonly type="text" name="instructor" id="instructor" class="form-control" 
                                    value="{{ Auth::user()->name }}" placeholder="" aria-describedby="helpId">
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="num_students" class="col-3 col-form-label text-end">No. of Students</label>
                            <div class="col-6">
                                <input readonly type="text" name="num_students" id="num_students" class="form-control" 
                                    value="{{ $test->num_of_students }}" placeholder="" aria-describedby="helpId">
                            </div>
                            
                        </div>
                    </div>
            </div>
                
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary float-end" onclick="submit();" role="button">Save Answers</a>
            </div>
            <div class="card-body" >
                <form id="answers" action="#">
                    
                    <ul class="list-group" id="item-container">
                        
                    </ul>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('script')
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
           return $.ajax({
                type: "POST",
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

        function submit() {
           $('#answers').submit();
            
        }

        $('#answers').submit(function (e) { 
            e.preventDefault();
           
            var save =  POST('/answer/store', $('#answers').serialize());
            save.then(function (response) {
                console.log(response);
            });
            id = $('#set').find(':selected').val();
            loadItems(id);
            
        });
        
        function loadItems(id){
            var items = GET('/items/index/'+id);
            items.then(function (response) {
                
                var itemCollection = response.items;
                console.log(itemCollection);
                var i = 1;
                $.each(itemCollection, function (index, value) { 
                    const item = value;
                    
                    var content = `
                        <li class="list-group-item">
                            <p class="card-text">${i}. ${item.item_string}</p>
                            <div class="row d-flex justify-content-center">
                                <label for="answer${item.id}" class="col-1 col-form-label text-end">Answer</label>
                                <div class="col-10">
                                    <input type="hidden"  name="item_id[]" id="item_id" value="${item.id}">
                                    <input type="hidden"  name="answer_id[]" id="item_id" value="${item.answer_id != null ? 1 : 0 }">
                                    <input type="text" name="answer[]" id="answer${item.id}" class="form-control" value="${item.answer != null? item.answer : ""}">
                                </div>
                            </div>
                        </li>
                    `;
                    i++;

                        $('#item-container').append(content);
                    
                });
            });
        }
        

        $(document).ready(function () {

            $('#set').change(function (e) { 
                // e.preventDefault();
                id = $('#set').find(':selected').val();
                loadItems(id);
            });


            
        });
        
    
        
        
        
    </script>
@endsection