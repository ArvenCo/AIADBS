<?php

namespace App\Http\Controllers;


use App\Models\Set;
use App\Models\Test;
use App\Models\Item;
use Illuminate\Http\Request;

use App\Exceptions\Handler;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $test_id = $request->test_id;
        $sets = Set::where('test_id', $test_id)->get();
        return response()->json($sets);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $test = Test::find($id);

        return view('forms.test_create_set',['test' => $test]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        try {
           $items = app('App\Http\Controllers\TestController')->parseIndexedString($request->textarea);
            
            $set = new Set();
            $set->set_name = $request->set;
            $set->num_of_items = count($items);
            $set->test_id = $request->test_id;
            $set->save();
            
        
            for ($i=0; $i < count($items); $i++) { 
                $item = new Item();
                $item->item_number = $i+1;
                $item->item_string = $items[$i];
                $item->set_id = $set->id;
                $item->save();
            }

            return back()->with(['success' => 'Set and its items Saved Succesfully', ]);
 
        } catch (Throwable $e) {
            return response()->json($e);;
             
        }
        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function edit(Set $set)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Set $set)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        //
    }
}
