<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Exceptions\Handler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $answers = Answer::rightjoin('items', 'items.id', 'item_id')->whereIn('set_id', $id)->get();
        return ['answers' => $answers];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $test = DB::table('tests')->find($id);
        $sets = DB::table('sets')->where('test_id', '=', $id)->get();
        return view('forms.answer.create',['test' => $test, 'sets' => $sets]);
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
            $item_ids = $request->item_id;
            $answers = $request->answer;
            $answer_ids = $request->answer_id;
            $number_of_items = count($item_ids);
            for ($i=0; $i < $number_of_items; $i++) { 
                Answer::updateOrInsert(
                    [
                        'item_id' => $item_ids[$i],
                    ],
                    [
                        'answer' => $answers[$i]
                    ]
                );
            }
            return response()->json(['success' => 'Answers  was saved successfully.']);
        } catch (Exception $ex) {
           return response()->json( ['error' =>$ex->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
