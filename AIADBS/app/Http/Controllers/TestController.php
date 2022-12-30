<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
class TestController extends Controller
{


    //CUSTOM FUNCTION(S)
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $test = Test::all();
        return view('forms.test_index', ['tests' =>$test]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('forms.test'); 
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //INSERT TO TESTS
        $userId = Auth::user()->id;
        
        $formData = $request;
        $test = Test::insertGetId([
            'subject' => $request->input('subject'),
            'examination' => $request->input('examination'),
            'course' => $request->input('course'),
            'date_given' => $request->input('dateGiven'),
            'num_of_students' => intval($request->input('studentsNo')),
            'user_id' => $userId,
            'created_at' => now()
        ]);
        
        //INSERT TO SETS
        // $TestId = Test::where('user_id', $userId )->lastInsertId();
        $items = $this->parseIndexedString($request->input('textarea'));
        
        $setId = DB::table('sets')->insertGetId([
            'set_name' => $request->input('set'),
            'num_of_items' => count($items),
            'test_id' => $test,
            'created_at' => now()
        ]);
        
        //INSERT TO ITEMS
        //$SetId = DB::table('sets')->lastInsertId();
        $index = 1;
        foreach ($items as $item){
            DB::table('items')->insert([
                'item_number' => $index,
                'item_string' => $item,
                'set_id' => $setId,
                'created_at' => now()
            ]);
            $index++;
        }
        return redirect()->back()->with('success','Mana bro.. Na sud na!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestRequest  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }



    //CUSTOM FUNCTIONS
    private function parseIndexedString($string){
        $lines = explode("\n", $string);
        $array = [];
        foreach ($lines as $line){

            list($number, $question) = explode('.', $line,2);
           

            $number = trim($number);
            
            if (is_numeric($number)){
                $question = trim($question);
                $number = intval($number);
                $array[$number - 1] = $question;
                
            }else{
                $indexArray = count($array) > 0 ? max(array_keys($array)):0;
                $inArray = $array[$indexArray];
                $array[$indexArray] = $inArray . "\n" . $line;
                continue;
            }
        }
        return $array;
    }
    
    




    
}
