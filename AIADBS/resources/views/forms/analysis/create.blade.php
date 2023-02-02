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
            
            <form  id="mainForm" >
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-header-title float-start">
                            Print Section
                        </h3>
                        <div class="float-end w-25">
                            <select name="selectedSet" id="set" class="form-control">
                                <option value="" disable> Choose a Set...</option>
                                @foreach($sets as $set)
                                <option value="{{$set->id}}">{{$set->set_name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="nums" value="{{ $tests->num_of_students }}">
                        </div>
                    </div>
                    <div class="card-body" id="printMe">
                        
                        
                        
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
                                            <td class="font-weight-bold" >{{$tests->subject}}</td>
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
                                                <td style="width:50%;" id="samplePH" >PH= </td>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;"></td>
                                                <td style="width:50%;" id="samplePL" >PL= </td>
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
                                            <td contenteditable="true">Dean-{{ $educator[0]->abbreviation }} Dept.</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <br>
                            
                        
                    </div>
                    <div class="card-footer">
                        <button  class="btn btn-primary float-right px-3" >
                            <i class="fas fa-print"></i>
                            Save & Print
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
@endsection

@section('script')
    @php
        $nums =  $tests->num_of_students;
    @endphp

<script>
    
    
    

    

    function getSample(papers){
        var sample = 0;
        if (papers >= 50){
            sample = 0.27 * papers;
            
        }else{
            sample = papers/2
        }

        return sample.toFixed();
    }


    function getDiffIndex(PH, PL){
        return ((PH + PL)/2).toFixed(4);
    }

    function getDiffInter(index){
        if (index <= 0.2 ){
            return "difficult";
        }else if (index <= 0.75){
            return "average";
        }else if (index <= 1){
            return "easy";
        }else{ return "easy";}
    }

    function getDescIndex(PH, PL){
        return (PH - PL).toFixed(4);
    }
    function getDescInter(index){
        if (index >= 0.4){
            return "very good item";
        }else if ( index >= 0.3){
            return "reasonably good";
        }else if ( index >= 0.2){
            return "marginal";
        }else{ return "poor"; }
    }
    //=IF(Desc & Diff = "very good item"&"easy","revise",IF(Desc &Diff="reasonably good"&"easy","revise",
    //IF(Desc &Diff="marginal"&"easy","revise",IF(Desc &Diff="poor"&"easy","reject",
    //IF(Desc &Diff="poor"&"difficult","revise",IF(Desc &Diff="poor"&"average","revise",
    //IF(B17&C17=""&"","","retain")))))))
    
    function getFinalRemark(Desc,Diff){
        if ((Desc=="very good item") && (Diff == "easy")){
            return "revise";
        }else if ((Desc=="reasonably good") && (Diff == "easy")){
            return "revise";
        }else if ((Desc=="margninal") && (Diff == "easy")){
            return "revise";
        }else if((Desc=="poor") && (Diff == "easy")){
            return "reject";
        }else if((Desc=="poor") && (Diff == "difficult")){
            return "revise";
        }else if((Desc=="poor") && (Diff == "average")){
            return "revise";
        }else{ return "retain";}
    }

    function average(num, over){
        return ((num/over)*100).toFixed(2)
    }
</script>
<script>
    $("select").change(function(){
        var inputPHVal;
        var inputPLVal;
        var nums = getSample("{{$nums}}");


        
       
        
        

        $("option:selected").each(function(){
            
            var items = @json($setItems);
            var i = 1;
            $("table tbody[name='main']").empty();
            $.each(items[$(this).val()],function(key, value){
                $("table tbody[name='main']").append(`
                    <tr>
                        <th scope='row' style='width:4%;' name='table_id' value='${value}'>${i}</th>
                        <td tyle='width:7%;'>
                            <input type='number' min='0' max='${nums}' class='form-control' name='PH[]'  id='PH'>
                        </td>
                        <td tyle='width:7%;'>
                            <input type='number' min='0' max='${nums}' class='form-control' name='PL[]'  id='PL'>
                        </td>
                        <td id='proPH${i}'></td>
                        <td id='proPL${i}'></td>
                        <td name='descIndex${i}'></td>
                        <td name='descRem${i}'></td>
                        <td name='diffIndex${i}'></td>
                        <td name='diffRem${i}'></td>
                        <td name='finalRem${i}'></td>
                    </tr>
                `);
                i++;
            }); 
            $('#totalItems').text(i-1);

            $.ajax({
                type: "GET",
                url: `/showData/${this.value}`,
                dataType: "json",
                success: function (data) {
                    
                    console.log(data);
                    $('#samplePH').text("PH=  " + nums);
                    $('#samplePL').text("PL=  " + nums);
                    $('#noItems').text(data.sets[0].num_of_items);
                    var itemAvailable = (data.items).length;
                    if(itemAvailable > 0){
                        var i = 1;
                        const table = $("table tbody[name='main']");
                        table.empty();
                        $.each(data.items, function (key, value) { 
                            console.log(key, value);
                            $("table tbody[name='main']").append(`
                                <tr>
                                    <th scope='row' style='width:4%;' >${i}</th>
                                    <td tyle='width:7%;'>
                                        ${value['ph']}
                                    </td>
                                    <td tyle='width:7%;'>
                                        ${value['pl']}
                                    </td>
                                    <td id='proPH${i}'>${value['pro_ph'].toFixed(4)}</td>
                                    <td id='proPL${i}'>${value['pro_pl'].toFixed(4)}</td>
                                    <td name='descIndex${i}'>${value['desc_index'].toFixed(4)}</td>
                                    <td name='descRem${i}'>${getDescInter(value['desc_index'].toFixed(4))}</td>
                                    <td name='diffIndex${i}'>${value['diff_index'].toFixed(4)}</td>
                                    <td name='diffRem${i}'>${getDiffInter(value['diff_index'].toFixed(4))}</td>
                                    <td name='finalRem${i}'>${value['final_rem']}</td>
                                </tr>
                            `);
                            i++;
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
                        $("#diffPer").text(average($("td:contains('difficult')").length,numItems)+"%");
                        
                    }
                }
            });
        });

       
        
        $("input[name='PH[]']").on("input", function() {
            
            const value = parseInt(this.value);
            const min = parseInt(this.min);
            const max = parseInt(this.max);
            if (value < min) {
            this.value = min;
            } else if (value > max) {
            this.value = max;
            } 

            const index = $(this).index("input[name='PH[]']")+1;
            inputPHVal = this.value > 0 ? this.value : 0;
            
            var portion = inputPHVal/nums;
            $(`#proPH${index}`).text(portion.toFixed(4));
            if (($("input[name='PL[]']").val()) && ($("input[name='PH[]']").val())){
                var inPH = $(`#proPH${index}`).text();
                var inPL = $(`#proPL${index}`).text();
                
                analysis(inPH, inPL, index);
                
            }
        });

        $("input[name='PL[]']").on("input", function() {
            
            const value = parseInt(this.value);
            const min = parseInt(this.min);
            const max = parseInt(this.max);
            if (value < min) {
            this.value = min;
            } else if (value > max) {
            this.value = max;
            } 

            const index = $(this).index("input[name='PL[]']")+1;
            inputPLVal = this.value > 0 ? this.value : 0;
            
            var portion = inputPLVal/nums;
            $(`#proPL${index}`).text(portion.toFixed(4));
            
            if (($("input[name='PL[]']").val()) && ($("input[name='PH[]']").val())){
                
                var inPH = $(`#proPH${index}`).text();
                var inPL = $(`#proPL${index}`).text();
                
                analysis(inPH, inPL, index);
                
            }
        });

        function analysis(inPH, inPL, index){
            var PH = parseFloat(inPH);
            var PL = parseFloat(inPL)
            $(`td[name='descIndex${index}']`).text(getDescIndex(PH, PL));
            $(`td[name='diffIndex${index}']`).text(getDiffIndex(PH, PL));
            $(`td[name='descRem${index}']`).text(getDescInter($(`td[name='descIndex${index}']`).text()));
            $(`td[name='diffRem${index}']`).text(getDiffInter($(`td[name='diffIndex${index}']`).text()));
            $(`td[name='finalRem${index}']`).text(getFinalRemark($(`td[name='descRem${index}']`).text(),$(`td[name='diffRem${index}']`).text()));

            $("input[name='PL[]'],input[name='PH[]']").focusout(function (){
            if( $(`td[name='finalRem${index}']`).text()=="reject"){
                 $(`td[name='finalRem${index}']`).css("color","#ea4335"); 
            }else{ $(`td[name='finalRem${index}']`).css("color","#000"); }
            
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
            $("#diffPer").text(average($("td:contains('difficult')").length,numItems)+"%");
            });
                
        }   
        

        
        
        $("#mainForm").submit(function (e) { 
            e.preventDefault();
            console.log($("#mainForm").serialize());
            $.ajax({
                type: "POST",
                url: "{{ route('analysis.store') }}",
                data: $("#mainForm").serialize(),
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    
                    console.log(data);
                    
                }
            });
  
            doThis();
            printThis("printMe");
        });

        

        function doThis(){
            $("table tbody[name='main'] tr").each(function(){
                $("#PH").parent().html($("#PH").val());
                $("#PL").parent().html($("#PL").val());
            });
        }



        function printThis(divName){
            
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            
        }
    });

    
</script>
@endsection
