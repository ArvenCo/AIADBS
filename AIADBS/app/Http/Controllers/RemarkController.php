<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Remark;
use App\Models\Set;
use App\Models\Item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $tests = Test::find($id);
        $sets = Set::where('test_id',$id)->get();
        
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
        return view('forms.analysis', ['sets'=> $sets, 'setItems' => $setArray, 'tests' => $tests]);
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
        return redirect('/test')->with('success','Item analysis saved successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function show(Remark $remark, $id)
    {
        //
        $tests = Test::find($id);
        $sets = Set::where('test_id',$id)->get();
        

        $setItems = [];
        $itemRemark = [];

        foreach($sets as $set){
            $setId = $set->id;
            $items = Item::where('set_id' ,$setId)->get();
            $itemsArray = [];
            $itemMisc = [];    
            foreach ($items as $item){
                $data = [];
                $data = Remark::rightJoin('items','items.id','=','item_id')->where('item_id',$item->id)->get();
                $subset = $data->map(function($data){
                    return collect($data->toArray())
                    ->all();
                });
                
                $itemMisc = [
                    'ph' => $data->first()->ph,
                    'pl' => $data->first()->pl,
                    'pro_ph' => $data->first()->pro_ph,
                    'pro_pl' => $data->first()->pro_pl,
                    'desc_index' => $data->first()->desc_index,
                    'diff_index' => $data->first()->diff_index,
                    'desc_inter' => $this->getDescInter($data->first()->desc_index),
                    'diff_inter' => $this->getDiffInter($data->first()->diff_index),
                    'final_rem' => $data->first()->final_rem,
                ];
                
                $itemRemark[$item->item_number] = $subset;
                array_push($itemsArray ,$itemMisc);
                
            }

            $setItems[$setId] = $itemsArray;
            
            
        }
        //dd(['sets'=>$sets, 'setItems' => $setItems, 'tests' => $tests, 'itemRemark' => $itemRemark, 'itemsMisc' => $itemMisc]);
        return view('forms.analysis_print', ['sets'=>$sets, 'setItems' => $setItems, 'tests' => $tests]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remark  $remark
     * @return \Illuminate\Http\Response
     */
    public function edit(Remark $remark)
    {
        //  
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
