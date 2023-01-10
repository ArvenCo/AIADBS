@extends('main')
@section('head')
<style>
    /* @media print{
        body *:not(#printMe):not(#printMe *){
            visibility:hidden;
        }
        #printMe{
            position: absolute;
            top:0;
            left:0;
        }
    } */
</style>
@endsection
@section('header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Print Analysis</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="/print" style=''>Printable analysis</a></li>
              <li class="breadcrumb-item active">Print Analysis</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
@endsection


@section('content')
    <section class="content">
        <div class="content-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-header-title">
                        Overview
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
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="dateGiven" class="col-sm-5 col-form-label">Date Given:</label>
                                <div class="col-sm-7">
                                    <p class="form-control" id="dateGiven">{{$tests->date_given}}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="students" class="col-sm-5 col-form-label">No. of Students:</label>
                                <div class="col-sm-7">
                                    <p class="form-control" id="students">{{$tests->num_of_students}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-white">
                <div class="card-header border-0">
                    <h3 class="card-header-title">
                        
                    </h3>
                </div>
                <div class="card-body" id="printMe">
                    <form action=""  class="bg-white" style="color:#fff;">
                    <br>
                        <div class="row">
                            <div class="col-4">
                                <img src="../../dist/img/logo/SMCC.png" alt="" class="float-right brand-image" style="height:90px;">
                            </div>
                            <div class="col-4">
                                <table class=" text-center">
                                    <tr>
                                        <td class="text-primary font-weight-bold">SAINT MICHAEL COLLEGE OF CARAGA</td>
                                    </tr>
                                    <tr>
                                        <td>Nasipit, Agusan del Norte</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">BASIC EDUCATION DEPARTMENT</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">COLLEGE DEPARTMENT</td>
                                    </tr>
                                    <tr> 
                                        <td>ITEM ANALYSIS</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{$tests->subject}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4">
                                <input type="hidden" class="form-control"name="wa oi gags tapol nmn jd">
                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-6 d-flex justify-content-center">
                                    <table class="" style="width:80%;">
                                        <tr>
                                            <td style="width:50%;">Examination:</td>
                                            <td style="width:50%;">{{$tests->examination}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;">Examiniee:</td>
                                            <td style="width:50%;" contenteditable="true">{{$tests->course}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6 d-flex justify-content-center">
                                    <table class="" style="width:80%;">
                                        <tr>
                                            <td style="width:50%;">Date Given:</td>
                                            <td style="width:50%;">{{$tests->date_given}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;">Name of Instructor:</td>
                                            <td style="width:50%;" contenteditable="true">{{Auth::user()->name}}</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-6 d-flex justify-content-center">
                                    <table class="" style="width:80%;">
                                        <tr>
                                            <td style="width:50%;">No. of Sample:</td>
                                            <td style="width:50%;" id="samplePH">PH= </td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;"></td>
                                            <td style="width:50%;" id="samplePL">PL= </td>
                                        </tr>
                                    </table>
                                    
                                </div>
                                
                                <div class="col-6 d-flex justify-content-center">
                                    <table class="" style="width:80%;">
                                        <tr>
                                            <td style="width:50%;">No. of Test Papers:</td>
                                            <td style="width:50%;">{{$tests->num_of_students}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;">No. of Items:</td>
                                            <td style="width:50%;" id="noItems"></td>
                                        </tr>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>                        
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex justify-content-center">
                                        <p>Note: PH & PL are obtain by multiplying the number of test papers by 0.27.</p>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                            </div>
                        </div>

                       
                        <div class="card-body">
                            <table class=" table-bordered table-striped text-center" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th rowspan=2 scope="col" style="width:4%;">#</th>
                                        <th colspan=2>Number Right</th>
                                        <th colspan=2>Proportion</th>
                                        <th colspan=2>Index of Descrimination</th>
                                        <th colspan=2>Item Difficulty</th>
                                        <th rowspan=2 scope="col" style="width:13%;">Final Remarks</th>
                                    </tr>
                                    <tr>
                                        
                                        <th scope="col" style="width:7%;">PH</th>
                                        <th scope="col" style="width:7%;">PL</th>
                                        <th scope="col" style="width:7%;">PH</th>
                                        <th scope="col" style="width:7%;">PL</th>
                                        <th scope="col" style="width:13%;">PH-PL</th>
                                        <th scope="col" style="width:13%;">Interpretation</th>
                                        <th scope="col" style="width:13%;">(PH-PL)/2</th>
                                        <th scope="col" style="width:13%;">Interpretation</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody name="main">

                                
                                    

                            
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="container row gy-2">
                            <div class="col-4 d-flex justify-content-center">
                                <table class="table-bordered" style="width:100%;">
                                    <tr>
                                        <td colspan=2  class="font-weight-bold">Statistics:</td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">No. of Retained items:</td>
                                        <td style="width:50%;" id="retained"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">No. of Revised items:</td>
                                        <td style="width:50%;" id="revised"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">No. of Rejected items:</td>
                                        <td style="width:50%;" id="rejected"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Total No. of Items:</td>
                                        <td style="width:50%;" id="totalItems"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <table class="table-bordered" style="width:100%;">
                                    <tr>
                                        <td colspan=2  class="font-weight-bold">Index of Discrimination</td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Very Good Item =</td>
                                        <td style="width:50%;" id="vgood"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Reasonably Good =</td>
                                        <td style="width:50%;" id="rgood"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Marginal =</td>
                                        <td style="width:50%;" id="marginal"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Poor =</td>
                                        <td style="width:50%;" id="poor"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <table class="table-bordered" style="width:100%;">
                                    <tr>
                                        <td colspan=2  class="font-weight-bold">Item Difficulty</td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Easy =</td>
                                        <td style="width:50%;" id="easy"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Average=</td>
                                        <td style="width:50%;" id="average"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Difficult =</td>
                                        <td style="width:50%;" id="difficult"></td>
                                    </tr>
                                   
                                </table>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <table class="table-bordered" style="width:100%;">
                                    <tr>
                                        <td colspan=2  class="font-weight-bold">Item Difficulty Percentage</td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Difficult</td>
                                        <td style="width:50%;" id="diffPer"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Average</td>
                                        <td style="width:50%;" id="averPer"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" class="text-right">Easy</td>
                                        <td style="width:50%;" id="easyPer"></td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="container row gxy-2">
                            <div class="col-6">
                                <table class="text-center" style="width:80%;">
                                    <tr>
                                        <td>Submitted by:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="font-weight-bold"><u>{{Auth::user()->name}}</u></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Teacher</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="text-center" style="width:80%;">
                                    <tr>
                                        <td>Submitted to:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="font-weight-bold" ><u contenteditable="true">Place name here</u></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td contenteditable="true">Program Head</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="text-center" style="width:80%;">
                                    <tr>
                                        <td>Noted By:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="font-weight-bold" ><u contenteditable="true">Place name here</u></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td contenteditable="true">Dean-CCIS Dept.</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <br>
                        
                    </form>

                </div>
                <div class="card-footer">
                    <a href="" class="btn btn-primary float-right" onclick="printThis('printMe')">
                        <i class="fas fa-print"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('script')
    
    @php
        $nums =  $tests->num_of_students;
        
    @endphp
<script>

    $("select").change(function(){
        
        $('option:selected').each(function(){
            
            var items = @json($setItems);
            var i = 1;
            if (items[$(this).val()].length == 0) return alert('No data available.')
            $("table tbody[name='main']").empty();
            $.each(items[$(this).val()],function(key, value){
                
                $("table tbody[name='main']").append("<tr id='tr"+i+"'><th scope='row' style='width:4%;' name='table_id' value='"+value+"'>"+i+"</th><td tyle='width:7%;'>"+value['ph']+"</td><td tyle='width:7%;'>"+value['pl']+"</td><td id='proPH"+i+"'>"+value['pro_ph']+"</td><td id='proPL"+i+"'>"+value['pro_pl']+"</td><td name='descIndex"+i+"'>"+value['desc_index'].toFixed(4)+"</td><td name='descRem"+i+"'>"+value['desc_inter']+"</td></td><td name='diffIndex"+i+"'>"+value['diff_index'].toFixed(4)+"</td><td name='diffRem"+i+"'>"+value['diff_inter']+"</td><td name='finalRem"+i+"'>"+value['final_rem']+"</td></tr>");
                i++;
            });
                $("#noItems").text(i-1);
                $('#totalItems').text(i-1);
                $("#samplePH").text("PH=    "+getSample("{{$nums}}"));
                $("#samplePL").text("PL=    "+getSample("{{$nums}}"));
            var j=1;
            var retained = 0;
            $("table tbody[name='main'] tr").each(function (index, value){

                if( $(`td[name='finalRem${j}']`).text()=="reject"){
                    $(`td[name='finalRem${j}']`).css("color","#ea4335"); 
                }else{ $(`td[name='finalRem${j}']`).css("color","#000"); }

                j++;
            });
            
            $("#retained").text($("td:contains('retain')").length);
            $("#revised").text($("td:contains('revise')").length);
            $("#rejected").text($("td:contains('reject')").length);

            $("#vgood").text($("td:contains('very good item')").length);
            $("#rgood").text($("td:contains('reasonably good')").length);
            $("#marginal").text($("td:contains('marginal')").length);
            $("#poor").text($("td:contains('poor')").length);

            $("#easy").text($("td:contains('easy')").length);
            $("#average").text($("td:contains('average')").length);
            $("#difficult").text($("td:contains('difficult')").length);
            var numItems = $("#noItems").text();
            $("#easyPer").text(average($("td:contains('easy')").length,numItems)+"%");
            $("#averPer").text(average($("td:contains('average')").length,numItems)+"%");
            $("#diffPer").text(average($("td:contains('difficult')").length,numItems)+"%");

            function average(num, over){
                return ((num/over)*100).toFixed(2)
            }
        });
   
        function getSample(papers){
            var sample = 0;
            if (papers >= 50){
                sample = 0.27 * papers;
                
            }else{
                sample = papers/2
            }
            return sample.toFixed();
        }
    });
    
    function printThis(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}

    
   
</script>


@endsection