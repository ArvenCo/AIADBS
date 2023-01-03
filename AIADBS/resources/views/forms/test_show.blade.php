@extends('main')

@section('content')
<section class="container">
    <div class="div container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-header-title">
                    Test Overview
                </h3>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group row">
                                <label for="subject" class="col-sm-2 col-form-label">subject</label>
                                <div class="col-sm-10">
                                    <input type="text" name="subject" id="subject" class="form-control" value="{{$tests->subject}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="examination" class="col-sm-2 col-form-label">examination</label>
                                <div class="col-sm-10">
                                    <input type="text" name="examination" id="examination" class="form-control" value="{{$tests->examination}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course" class="col-sm-2 col-form-label">course</label>
                                <div class="col-sm-10">
                                    <input type="text" name="course" id="course" class="form-control" value="{{$tests->course}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course" class="col-sm-2 col-form-label">course</label>
                                <div class="col-sm-8">
                                    <select name="set" id="" class="form-control">
                                        <option value="">Select a Set...</option>
                                        @foreach($sets as $set)
                                        <option value="{{$set->id}}">{{$set->set_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <a href="" class="btn btn-secondary">
                                        Add Set
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        <!-- End of Left Side -->

                        <!-- Star of Right Side -->
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="date_given" class="col-sm-4 col-form-label">Date Given</label>
                                <div class="col-sm-8">
                                    <input type="date" name="date_given" id="date_given" class="form-control" value="{{$tests->date_given}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instructor" class="col-sm-4 col-form-label">instructor</label>
                                <div class="col-sm-8">
                                    <input type="text" name="instructor" id="instructor" class="form-control" value="{{Auth::user()->name}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="" class="btn btn-secondary float-right">
                    Edit Test
                </a>
            </div>
        </div>


        <div class="card">
            <form action="">
                <div class="card-header">
                    <h3 class="card-header-title">
                        Items
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table-bordered table-stripped" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Item #</th>
                                <th>Item String</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@section('script')



<script>
   
    $("select").change(function (){
        $('option:selected').each(function (){
           
            var items = @json($items);
           
            $.each(items[$(this).val()],function (key,value){
                $('table tbody').append(`
                <tr class=" text-center">
                        <td>${value['id']}</td>
                        <td><textarea name="" id="" class="form-control border-0 bg-white"rows="5" style="resize:none;" disabled>${value['item_string']}</textarea></td>
                        <td>
                            <a href="" class="btn btn-info btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                `);
            } );
            
           
        });
    });

</script>
@endsection