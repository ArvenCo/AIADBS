@extends('main')

@section('header')
@endsection

@section('content')
<section class="content">
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-header-title">
                    Hello World
                </h3>
            </div>
            <div class="card-body">
                <div class="form-horizontal row">
                    <div class="col-8">
                        <div class="form-group row">
                            <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
                            <div class="col-sm-10">
                                <p class="form-control" id="subject">{{$tests->subject}}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="examination" class="col-sm-2 col-form-label">Examination:</label>
                            <div class="col-sm-10">
                                <p class="form-control" id="examination">{{$tests->examination}}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course" class="col-sm-2 col-form-label">Course:</label>
                            <div class="col-sm-10">
                                <p class="form-control" id="course">{{$tests->course}}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="set" class="col-sm-2 col-form-label">Set: </label>
                            <div class="col-sm-10">
                                <select name="set" id="set" class="form-control">
                                    <option value="" disable> Choose a Set...</option>
                                    @foreach($sets as $set)
                                    <option value="{{$set->id}}">{{$set->set_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group row">
                            <label for="dateGiven" class="col-sm-2 col-form-label">Date Given:</label>
                            <div class="col-sm-10">
                                <p class="form-control" id="dateGiven">{{$tests->date_given}}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dateGiven" class="col-sm-2 col-form-label">Date Given:</label>
                            <div class="col-sm-10">
                                <p class="form-control" id="dateGiven">{{$tests->date_given}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@@endsection
