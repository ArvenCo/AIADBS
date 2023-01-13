@extends('main')

@section('header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Test</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="/test" style=''>Tests</a></li>
              <li class="breadcrumb-item active">Edit Test</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
@endsection


@section('content')
<section class="container">
    <div class="div container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-header-title">
                    Test Overview
                </h3>
            </div>
            <form action="/edittest/{{$tests->id}}" class="form-horizontal" method="POST">
                @csrf
            <div class="card-body">
                
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
                                    <a href="/test/{{$tests->id}}" class="btn btn-secondary">
                                        Add Set
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        <!-- End of Left Side -->

                        <!-- Start of Right Side -->
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
                            <div class="form-group row">
                                <label for="num_of_students" class="col-sm-4 col-form-label">No. of Students</label>
                                <div class="col-sm-8">
                                    <input type="number" name="num_of_students" id="num_of_students" class="form-control" value="{{$tests->num_of_students}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="form-check form-switch col-5 ">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Edit Test</label>
                                </div>
                            </div>
                            
                        </div>
                    </div>
               
            </div>
                <div class="card-footer row" >

                    <div class="row justify-content-end">
                        
                        
                        <input type="submit" id="testSubmit" value="Submit" class="btn btn-secondary col-1" disabled>
                    </div>
                </div>
            </form>
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
                            <th>Action</th>
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
   $("#flexSwitchCheckDefault").change(function() {
        if(this.checked) {
            //Do stuff
            $( "#subject" ).prop( "disabled", false );
            $( "#examination" ).prop( "disabled", false );
            $( "#course" ).prop( "disabled", false );
            $( "#date_given" ).prop( "disabled", false );
            $( "#num_of_students" ).prop( "disabled", false );
            $( "#testSubmit" ).prop( "disabled", false );

        }else{
            $( "#subject" ).prop( "disabled", true );
            $( "#examination" ).prop( "disabled", true );
            $( "#course" ).prop( "disabled", true );
            $( "#date_given" ).prop( "disabled", true );
            $( "#num_of_students" ).prop( "disabled", true );
            $( "#testSubmit" ).prop( "disabled", true );
        }
    });
    $("select").change(function (){
        $('option:selected').each(function (){
           
            var items = @json($items);
            $('table tbody').empty();
            $.each(items[$(this).val()],function (key,value){
                
                $('table tbody').append(`
                <tr class=" text-center">
                        <td>${value['id']}</td>
                        <td><textarea name="" id="" class="form-control border-0 bg-white"rows="5" style="resize:none;" disabled>${value['item_string']}</textarea></td>
                        <td>
                            <a href="" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-default${value['id']}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <div class="modal fade" id="modal-default${value['id']}">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    
                                    <form action="/item/${value['id']}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Item</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <textarea name="item" id="" class="form-control bg-white"rows="5" style="resize:none;">${value['item_string']}</textarea>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            
                        </td>
                    </tr>
                `);
            } );
        });
    });

</script>
@endsection