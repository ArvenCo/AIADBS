@extends('main')

@section('head')
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none ;
        margin: 0;
    }



   
    </style>
    
@endsection


@section('header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Item Analysis Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="/analysis_list" style=''>Analysisable Tests</a></li>
              <li class="breadcrumb-item active">Item Analysis Edit</li>

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
                <div class="card-body">
                    <input type="hidden" name="test_id" value="{{$test_id}}">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group row">
                                <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" name="subject" id="subject" class="form-control" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="examination" class="col-sm-2 col-form-label">Examination</label>
                                <div class="col-sm-10">
                                    <input type="text" name="examination" id="examination" class="form-control" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course" class="col-sm-2 col-form-label">Course</label>
                                <div class="col-sm-10">
                                    <input type="text" name="course" id="course" class="form-control" value="" disabled>
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- End of Left Side -->

                        <!-- Start of Right Side -->
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="date_given" class="col-sm-4 col-form-label">Date Given</label>
                                <div class="col-sm-8">
                                    <input type="date" name="date_given" id="date_given" class="form-control" value=" " disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instructor" class="col-sm-4 col-form-label">Instructor</label>
                                <div class="col-sm-8">
                                    <input type="text" name="instructor" id="instructor" class="form-control" value="{{Auth::user()->name}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="num_of_students" class="col-sm-4 col-form-label">No. of Students</label>
                                <div class="col-sm-8">
                                    <input type="number" name="num_of_students" id="num_of_students" class="form-control" value=" " disabled>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
            
                </div>
            </div>
            
        
            <form action="/analysis/update" method="POST" onsubmit="return checkForm(this);">
                @csrf
                <input type="hidden" name="nums" value=" ">
                <div class="card ">
                    <div class="card-header">
                    <label for="">Select a Set:</label>
                    <select class="form-select" name="selectedSet" data-placeholder="Select a State" style="width: 25%;">
                        <option value="" disabled selected>None...</option>
                        
                    </select>
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
                            <tbody>

                            
                                

                            
                                <!-- <tr>
                                    <th scope="row" style="width:4%;">1</th>
                                    <td tyle="width:7%;">
                                        <input type="number" value="0" min="0" class="form-control" name="PH1"  id="">
                                    </td>
                                    <td tyle="width:7%;">
                                        <input type="number" value="0" min="0" class="form-control" name="PL1"  id="">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    

                    <div class="card-footer">
                        <input type="submit" value="Save" class="btn btn-primary float-right" >
                    </div>
                </div>
            </form>
            
        </div>
    </section>
   
@endsection

@section('script')
<!-- Select2 -->

<script>
    
</script>

<script src="../../plugins/select2/js/select2.full.min.js"></script>
   
<script>

    function GET(url,data){
        return $.ajax({
            type: "GET",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                return response;
            }
        });
    }

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
        });
                
        }   

        

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

        function loadTable(data){
            var nums = getSample($('input[name="num_of_students"]').val());
            var i = 1;
            $("table tbody").empty();
            $("table tbody").append(`<input type="hidden" name="nums" value="${nums}">`);
            $.each(data,function(key, value){
                $("table tbody").append(`
                    <tr>
                        
                        <th scope='row' style='width:4%;' >${i} <input type="hidden" name="id[]" value="${value.id}"></th>
                        <td tyle='width:7%;'><input type='number' min='0' max='${nums}' class='form-control' name='PH[]' value='${value['ph']}'  id=''></td>
                        <td tyle='width:7%;'><input type='number' min='0' max='${nums}' class='form-control' name='PL[]' value='${value['pl']}'  id=''></td>
                        <td id='proPH${i}'>${value['pro_ph']}</td>
                        <td id='proPL${i}'>${value['pro_pl']}</td>
                        <td name='descIndex${i}'>${value['desc_index'].toFixed(4)}</td>
                        <td name='descRem${i}'>${getDescInter(value['desc_index'].toFixed(4))}</td>
                        <td name='diffIndex${i}'>${value['diff_index'].toFixed(4)}</td>
                        <td name='diffRem${i}'>${getDiffInter(value['diff_index'].toFixed(4))}</td>
                        <td name='finalRem${i}'>${value['final_rem']}</td>
                    </tr>`);
                i++;
            });

            var j=1;
            $("table tbody tr").each(function (index, value){

                if( $(`td[name='finalRem${j}']`).text()=="reject"){
                    $(`td[name='finalRem${j}']`).css("color","#ea4335"); 
                }else{ $(`td[name='finalRem${j}']`).css("color","#000"); }
                j++;
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

        


        }



    $(document).ready(function () {
        var test = GET('/test/show/'+$('input[name="test_id"]').val(),{});
        test.then(function (response) {
            var data = response;
            $('input[name="subject"]').val(data.subject);
            $('input[name="examination"]').val(data.examination);
            $('input[name="course"]').val(data.course);
            $('input[name="date_given"]').val(data.date_given);
            $('input[name="num_of_students"]').val(data.num_of_students);
            
        });

        var sets = GET('/sets/index',{test_id:$('input[name="test_id"]').val()} );
        sets.then(function(response) {
            console.log(response);
            var data = response;
            var html ="";
            $.each(data, function (index, value) { 
                html += `<option value="${value.id}">${value.set_name}</option>`
            });
            $('select[name="selectedSet"]').append(html);
        })
    });

    var checkForm = function(form) {

        form.myButton.disabled = true;
        return true;
    };
        
    $("select").change(function(){
        var inputPHVal;
        var inputPLVal;
       

        $("option:selected").each(function(){
            var remarks = GET('/remarks/edit',{set_id : $(this).val()});
            remarks.then(function(response){
                
                loadTable(response);
                
            });
            
            



           
        });

        
        
        

        
    });


    
</script>


@endsection