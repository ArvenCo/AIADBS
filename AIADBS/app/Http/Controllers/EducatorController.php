<?php

namespace App\Http\Controllers;

use App\Models\Educator;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;

class EducatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $educators = Educator::rightjoin('users','users.id', '=', 'user_id')->where('users.role', '=', 'instructor')->get();
        return view('forms.admin.educator.index',['educators' => $educators]);
    }

    public function getDepartmentId($id){
        $departmentId = DB::table('educators')->where('user_id', '=', $id)->get();
        return ['educator' => $departmentId];
    }

    public function retrieveIt($id){

        try {
            $user = User::find($id);
            $user->password = Hash::make('iameducator');
            $saved = $user->save();
            if($saved){
                return response()->json(['success' => 'Account retrieved successfuly.'], 200);
            }else{
                return response()->json(['error' => 'Account retrieve failed.'], 500);
            }
        } catch (Exception $th) {
            //throw $th;
            return response()->json(['error' => $th], 500);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->id != 1 ){
            abort(403);
        }else{
            return view('forms.admin.educator.create',app('App\Http\Controllers\DepartmentController')->getDepartments());
        }   
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
     * @param  \App\Models\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        try{
            $educator = Educator::leftjoin('users', 'user_id', '=', 'users.id')
            ->where('user_id', '=', $request->id)
            ->select('educators.id as id', 'email', 'department_ids', 'name','courses', 'subjects', 'education_office')->first();
            return response()->json($educator, 200);
        }catch(Exception $ex){
            return response()->json($ex, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function edit(Educator $educator )
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $educator = Educator::find($request->id);
        $educator->department_ids = join(', ', $request->department);
        $educator->courses = join(', ', $request->courses);
        $educator->education_office = $request->education_office;
        $saved = $educator->save();
        if ($saved) {
            # code...
            return response()->json(['success'=>'Changes has been Saved'], 200);
        }else{
            return response()->json(['success'=>'Error Occur'], 500);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educator $educator)
    {
        //
    }
}
