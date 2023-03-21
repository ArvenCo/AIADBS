<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Remark;
use App\Models\Set;
use App\Models\Item;
use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RemarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $items = Remark::rightjoin('items', 'remarks.item_id', '=', 'items.id')
                ->rightjoin('sets', 'sets.id', '=', 'items.set_id')
                ->rightjoin('tests', 'tests.id', '=', 'test_id')
                ->get();

        return ['items' => $items];

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $user = Auth::user();
        $educator = Educator::where('user_id', $user->id)->get();
        $dep_ids = explode(', ',$educator->first()->department_ids);
        $educator = Educator::where('user_id', $user->id)->get();
        $departments = DB::table('departments')->whereIn('id', $dep_ids)->get();

        if ($id == '0'){
          $id = Test::latest('id')->where('user_id', '=', $user->id)->first()->id;
        }

        $tests = Test::find($id);
        $sets = Set::leftjoin('items','sets.id','=', 'items.set_id' )
        ->leftjoin('remarks', 'items.id', '=', 'remarks.item_id')
        ->where('test_id', '=', $id)
        ->select('sets.id','set_name',DB::raw('count(*) as total'))
        ->groupby('sets.id','set_name')->get();
        
        $setArray = [];
        foreach($sets as $set){
            $setId = $set->id;
            $items = Item::where('set_id' ,$setId)->get();
            $itemsArray = [];
            foreach ($items as $item){
                
                array_push($itemsArray ,$item->id);
            }

            $setArray[$setId] = $itemsArray;
        }
        
        return view('forms.analysis.create', ['sets'=> $sets, 'setItems' => $setArray, 'tests' => $tests,'educator'=>$educator, 'departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
          
      
        $numS = $this->getSample($request->input('nums'));
        $remark = new Remark; 
        $items = Item::where('set_id' ,$request->input('selectedSet'))->get();

        
        $phs = $request->input('PH');
        $pls = $request->input('PL');
        $index = 0;
        $data = [];
        foreach ($items as $item){

            $ph = $phs[$index];
            $pl = $pls[$index];
            $proPh = $ph/$numS;
            $proPl = $pl/$numS;

            $descIndex = number_format($this->getDescIndex($proPh, $proPl),4);
            $diffIndex = number_format($this->getDiffIndex($proPh, $proPl),4);
            
            $descInter = $this->getDescInter($descIndex);
            $diffInter = $this->getDiffInter($diffIndex);

            $finalRem = $this->getFinalRemark($descInter,$diffInter);

            $data[] = [
                'item_id' => $item->id,
                'ph' => $ph,
                'pl' => $pl,
                'pro_ph' => $proPh,
                'pro_pl' => $proPl,
                'desc_index' => $descIndex,
                'diff_index' => $diffIndex,
                'final_rem' => $finalRem,
                'created_at' => now()
            ];

            $index++;
        }
        Remark::insert($data);
        return $data;
        // return withErrors(['success'=>'Item analysis saved successfully.']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function showbank($id){
      
      
      $finalrems = ['revise', 'retain', 'reject'];
      $datas = Remark::rightjoin('items', 'remarks.item_id', '=', 'items.id')
        ->rightjoin('sets', 'sets.id', '=', 'items.set_id')
        ->where('test_id', '=', $id)
        ->select('item_string')
        ->get();
      $byremark  = array([]);
      foreach($datas as $data){
        

        dd($data->first()->item_string);
        

        
        
      }

      dd($byremark);

      
      
    }


    public function showData(Request $request, $id){

      $sets = Set::find($id)->leftjoin('tests','tests.id', '=', 'test_id')->get();

      $items = DB::table('items')
              ->rightjoin('remarks','items.id', '=', 'remarks.item_id')
              ->where('set_id', $id)->get(); 
      return ['items' => $items, 'sets' => $sets];
    }


    public function show(Request $request,Remark $remark, $id)
    {
        //
        
        $tests = Test::find($id);
        $sets = Set::rightjoin('items', 'sets.id','=', 'items.set_id')
        ->rightjoin('remarks', 'items.id', '=', 'remarks.item_id')
        ->where('test_id', '=', $id)
        ->select('sets.id','set_name',DB::raw('count(*) as total'))
        ->groupby('sets.id','set_name')
        ->get();
        

        $setItems = [];
        $itemRemark = [];
        $byremark = [];
        foreach($sets as $set){
            $setId = $set->id;
            $items = Item::where('set_id' ,$setId)->get();
            $itemsArray = [];
            $itemMisc = [];    
            foreach ($items as $item){
                $data = [];
                $data = Remark::rightJoin('items','items.id','=','item_id')
                ->rightjoin('answers', 'item_id', '=', 'items.id')
                ->where('item_id',$item->id)
                ->select('remarks.id as id','item_string','ph','pl','pro_ph','pro_pl','desc_index','diff_index','desc_inter','diff_inter','final_rem','answer',)->get();
                
                if ($data->isEmpty()) {
                  continue;
                }
                $itemMisc = [
                    'id' => $data->first()->id,
                    'item_string' => $data->first()->item_string,
                    'ph' => $data->first()->ph,
                    'pl' => $data->first()->pl,
                    'pro_ph' => $data->first()->pro_ph,
                    'pro_pl' => $data->first()->pro_pl,
                    'desc_index' => $data->first()->desc_index,
                    'diff_index' => $data->first()->diff_index,
                    'desc_inter' => $this->getDescInter($data->first()->desc_index),
                    'diff_inter' => $this->getDiffInter($data->first()->diff_index),
                    'final_rem' => $data->first()->final_rem,
                    'answer' => $data->first()->answer,
                ];
                
                array_push($itemsArray ,$itemMisc);
            }
            $setItems[$setId] = $itemsArray;
            
            
        }
        dd($setItems);
        $uri = $request->route()->uri();
        if($uri == "databank/show/{id}"){
          return view('forms.databank', ['sets'=>$sets, 'setItems' => $setItems, 'tests' => $tests]);
        }
        if ($uri == "analysis/{id}"){
          return view('forms.analysis_edit', ['sets'=>$sets, 'setItems' => $setItems, 'tests' => $tests]);
        }else{
          return view('forms.analysis_print', ['sets'=>$sets, 'setItems' => $setItems, 'tests' => $tests]);
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Remark $remark)
    {
        //
        
        if ($request->ajax()) {
          $set_id = $request->set_id;
          $remarks = Remark::leftjoin('items', 'items.id','=', 'item_id')->where('set_id', $set_id)
          ->select('remarks.id as id', 'item_id', 'ph', 'pl', 'pro_ph', 'pro_pl', 'desc_index', 'diff_index', 'final_rem')->get();
          return response()->json($remarks);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remark $remark)
    {
        //
        $numS = $this->getSample($request->input('nums'));
        
        $items = Item::where('set_id' ,$request->input('selectedSet'))->get();
        
        $ids = $request->input('id');
        $phs = $request->input('PH');
        $pls = $request->input('PL');
        $index = 0;
        $data = [];
        foreach ($items as $item){
            $id = $ids[$index];
            $ph = $phs[$index];
            $pl = $pls[$index];
            $proPh = $ph/$numS;
            $proPl = $pl/$numS;

            $descIndex = number_format($this->getDescIndex($proPh, $proPl),4);
            $diffIndex = number_format($this->getDiffIndex($proPh, $proPl),4);
            
            $descInter = $this->getDescInter($descIndex);
            $diffInter = $this->getDiffInter($diffIndex);

            $finalRem = $this->getFinalRemark($descInter,$diffInter);
            
            
            Remark::where('id', $id)->update([
                
              'ph' => $ph,
              'pl' => $pl,
              'pro_ph' => $proPh,
              'pro_pl' => $proPl,
              'desc_index' => $descIndex,
              'diff_index' => $diffIndex,
              'final_rem' => $finalRem,
              

          ]);
            $index++;
        }
        return back()->withErrors(['success'=>'Item analysis updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remark $remark)
    {
        //
    }



    //
    function getSample($papers) {
        $sample = 0;
        if ($papers >= 50) {
          $sample = 0.27 * $papers;
        } else {
          $sample = $papers / 2;
        }
      
        return intval($sample);
      }
      

      function getDescIndex($PH, $PL) {
        return number_format(($PH - $PL), 4);
      }
      
      function getDescInter($index) {
        if ($index >= 0.4) {
          return "very good item";
        } else if ($index >= 0.3) {
          return "reasonably good";
        } else if ($index >= 0.2) {
          return "marginal";
        } else {
          return "poor";
        }
      }
      


      function getDiffIndex($PH, $PL) {
        return number_format((($PH + $PL) / 2), 4);
      }

      function getDiffInter($index) {
        if ($index <= 0.2) {
          return "difficult";
        } else if ($index <= 0.75) {
          return "average";
        } else if ($index <= 1) {
          return "easy";
        } else {
          return "easy";
        }
      }

      function getFinalRemark($Desc, $Diff) {
        if (($Desc == "very good item") && ($Diff == "easy")) {
          return "revise";
        } else if (($Desc == "reasonably good") && ($Diff == "easy")) {
          return "revise";
        } else if (($Desc == "margninal") && ($Diff == "easy")) {
          return "revise";
        } else if (($Desc == "poor") && ($Diff == "easy")) {
          return "reject";
        } else if (($Desc == "poor") && ($Diff == "difficult")) {
          return "revise";
        } else if (($Desc == "poor") && ($Diff == "average")) {
          return "revise";
        } else {
          return "retain";
        }
      }
      
      
}
