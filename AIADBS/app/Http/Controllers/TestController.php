<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Set;
use App\Models\Item;
use App\Models\Answer;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use Illuminate\Routing\Route;

use Carbon\Carbon;


class TestController extends Controller
{


    //CUSTOM FUNCTION(S)




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = Auth::user();
        $test = Test::where('user_id', $user->id)->get();
        $uri = $request->route()->uri();



        return view('forms.test_index', ['tests' => $test, 'uri' => $uri]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $user = Auth::user();
        $educator_data = DB::table('educators')->where('user_id', $user->id)->get();
        $department_ids =  explode(', ',$educator_data->first()->department_ids);
        $subjects = DB::table('subjects')->where('department_id', $department_ids )->select('name')->get();
        $courses = explode(', ', $educator_data->first()->courses);
        return view('forms.test_create', ['courses' => $courses, 'subjects' => $subjects]);

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
        $request->validate([
            'textarea' => 'required|string'
        ]);
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
        foreach ($items as $item_string) {
            $exploded = explode("Answer:", $item_string);
            $item = DB::table('items')->insertGetId([
                'item_number' => $index,
                'item_string' => $exploded[0],
                'set_id' => $setId,
                'created_at' => now()
            ]);

            $answer = new Answer();
            $answer->item_id = $item;
            
            $answer->answer = count($exploded) != null ? $exploded[1] : null;
            $answer->save();
            $index++;
        }
        return redirect('analysis/create/0')->withErrors(['success' => 'Test has been created successfully.']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Test $test, $id)
    {
        //
        if ($request->ajax()) {
            $test = Test::find($id);
            return response()->json($test);
        }
        $test = $test->find($id);
        $sets = Set::select('id', 'set_name', 'num_of_items')->where('test_id', $id)->get();
        $setIds = $sets->pluck('id');
        $items = array();
        foreach ($setIds as $setId) {
            $item = Item::where('set_id', $setId)->get();
            $subset = $item->map(function ($item) {
                return collect($item->toArray())
                    ->only('id', 'item_number', 'item_string', 'set_id')
                    ->all();
            });
            $items[$setId] = $subset;
        }


        //dd($test,$sets,$items);
        return view('forms.test_show', ['tests' => $test, 'sets' => $sets, 'items' => $items]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test, Request $request, $id)
    {
        //
        $test->where('id', $id)->update([
            'subject' => $request->input('subject'),
            'examination' => $request->input('examination'),
            'course' => $request->input('course'),
            'date_given' => $request->input('date_given'),
            'num_of_students' => $request->input('num_of_students')
        ]);

        return back()->withErrors(['success' => 'Test "' . $request->input('subject') . '" has been edited successfully.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestRequest  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test, $id)
    {
        //
        $items = $this->parseIndexedString($request->input('textarea'));

        $setId = DB::table('sets')->insertGetId([
            'set_name' => $request->input('set'),
            'num_of_items' => count($items),
            'test_id' => $id,
            'created_at' => now()
        ]);

        $index = 1;
        foreach ($items as $item) {
            DB::table('items')->insert([
                'item_number' => $index,
                'item_string' => $item,
                'set_id' => $setId,
                'created_at' => now()
            ]);


            $index++;
        }
        return back()->withErrors(['success' => 'set "' . $request->input('set') . '" was successfully added.']);
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
    public function parseIndexedString($string)
    {
        $lines = explode("\n", $string);
        $array = [];
        foreach ($lines as $line) {

            list($number, $question) = explode('.', $line, 2);


            $number = trim($number);

            if (is_numeric($number)) {
                $question = trim($question);
                $number = intval($number);
                $array[$number - 1] = $question;

            } else {
                $indexArray = count($array) > 0 ? max(array_keys($array)) : 0;
                $inArray = $array[$indexArray];
                $array[$indexArray] = $inArray . "\n" . $line;
                continue;
            }
        }
        return $array;
    }







}