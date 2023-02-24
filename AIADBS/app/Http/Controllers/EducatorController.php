<?php

namespace App\Http\Controllers;

use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function show($id)
    {
        //
        try {
            //code...
            $user = DB::table('users')->rightjoin('educators', 'educators.user_id', '=', 'users.id')
            ->where('users.id', '=', $id)->select('users.id as id','name', 'email', 'subjects')->first();
            return ['user' => $user];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function edit(Educator $educator)
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
    public function update(Request $request, Educator $educator)
    {
        //
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
