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
            <h1 class="m-0">Item Analysis</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="/test" style=''>Tests</a></li>
              <li class="breadcrumb-item active">Item Analysis</li>

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
            <form action="/analysis" method="POST">
            @csrf
            <input type="hidden" name="nums" value="{{$tests->num_of_students}}">
                <div class="card ">
                    <div class="card-header">
                    <label for="">Select a Set:</label>
                    <select class="form-select" name="selectedSet" data-placeholder="Select a State" style="width: 25%;">
                        <option value="" disabled selected>None...</option>
                        @if(isset($sets))
                        @foreach($sets as $set)
                        <option value="{{$set->id}}">{{$set->set_name}}</option>
                        @endforeach
                        @endif
                    </select>
                    </div>
                    <div class="card-body">
                        <table class=" table-dark table-bordered table-striped text-center" style="width:100%;">
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
                        <input type="submit" value="Save" class="btn btn-primary float-right">
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
    @php
        $nums =  $tests->num_of_students;
        
    @endphp
<script>


        
    $("select").change(function(){
        var inputPHVal;
        var inputPLVal;
        var nums = getSample("{{$nums}}");



        $("option:selected").each(function(){
            var items = @json($setItems);
            var i = 1;
            $.each(items[$(this).val()],function(key, value){
                
                $("table tbody").append("<tr><th scope='row' style='width:4%;' name='table_id' value='"+value+"'>"+i+"</th><td tyle='width:7%;'><input type='number' min='0' max='"+nums+"' class='form-control' name='PH[]'  id=''></td><td tyle='width:7%;'><input type='number' min='0' max='"+nums+"' class='input-color-secondary form-control' name='PL[]'  id=''></td><td id='proPH"+i+"'></td><td id='proPL"+i+"'><td name='descIndex"+i+"'></td><td name='descRem"+i+"'></td></td><td name='diffIndex"+i+"'></td><td name='diffRem"+i+"'></td><td name='finalRem"+i+"'></td></tr>");
                i++;
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
            }else{ $(`td[name='finalRem${index}']`).css("color","#fff"); }
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
    });


    
</script>


@endsection