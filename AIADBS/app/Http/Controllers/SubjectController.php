<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

use App\Exceptions\Handler;

class SubjectController extends Controller
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
    
    public function subjectsBy($department){
        $subjects = Subject::where('department_id','=' ,$department)->get();
        return ['subjects' => $subjects];
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
        try {
            $subject = new Subject;
            $subject->name = $request->subject;
            $subject->department_id = $request->department_id;
            $save = $subject->save();
            if ($save){
                $data = ['success' => 'Subject save Successfully!'];
                return response()->json($data, 200);
            }else{
                $data = ['error' => 'Subject save failed.'];
                return response()->json($data, 500);
            }
        } catch ( Exception $e) {
            return ['error' => $e->getMessage()];
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Request $request)
    {
        //
        $subjects = $subject->whereIn('department_id', $request->department_id)->get();
        return response()->json($subjects, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, Request $request)
    {
        //
        $subject = $subject->find($request->id);
        $delete = $subject->delete();
        if ($delete){
            $data = ['success' => 'Subject deleted Successfully!'];
            return response()->json($data, 200);
        }else{
            $data = ['error' => 'Subject delete failed.'];
            return response()->json($data, 500);
        }
    }
}
