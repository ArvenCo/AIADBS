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
                        <th>Update</th>
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
                            <div class="dropdown">
                                <a href="#" class="btn btn-secondary dropdown-toggle" 
                                role="button"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                </a>
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
    @foreach($departments as $department)
    <div class="modal fade" id="modal{{$department->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$department->name}} - {{$department->abbreviation}}</h1>
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
</div>

@endsection

@section('script')
    @include('forms.modules.datatable.scripts')


@endsection