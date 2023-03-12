<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $department_id = $request->department_id;
            $course = Course::where('department_id', $department_id)->get();
            return response()->json($course,200);
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
            $course = new Course();
            $course->department_id = $request->department_id;
            $name = explode(" - ", $request->subject)[0];
            $abbr = explode(" - ", $request->subject)[1];
            $course->name = $name;
            $course->abbreviation = $abbr;
            $save = $course->save();
            if ($saved){
                $data = ['success' => 'Course save Successfully!'];
                return response()->json($data, 200);
            }else{
                $data = ['error' => 'Course save failed.'];
                return response()->json($data, 500);
            }
        
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course,Request $request)
    {
        //
        $course = $course->find($request->id);
        $course->delete();
    }
}
