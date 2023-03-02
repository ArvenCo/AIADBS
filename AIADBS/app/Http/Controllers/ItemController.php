<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $items = Item::leftjoin('answers', 'item_id', '=', 'items.id')->where('set_id', '=', $id)->
        select('items.id as id', 'item_string', 'answers.id as answer_id','answer')->get();
        return ['items' => $items];
        
    }

    public function itemsBy($subject){
        $items = Item::rightjoin('sets','set_id', '=', 'sets.id')
        ->rightjoin('remarks', 'remarks.item_id', '=', 'items.id')
        ->rightjoin('tests', 'test_id', '=', 'tests.id')
        ->leftjoin('answers', 'answers.item_id', '=', 'items.id')
        ->where('subject', '=', $subject)
        ->select('item_string', 'final_rem','answer')->get();
        return ['items' => $items];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item,$id)
    {
        //
        Item::where('id',$id)
        ->update( ['item_string' => $request->input('item')]);
        return back()->withErrors(['success'=>'Item updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
