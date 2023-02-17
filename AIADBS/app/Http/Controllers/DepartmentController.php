<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
  
        return view('forms.admin.department.index',$this->getDepartments());

    }
    
    public function getDepartmentsBy($office){
        $departments = Department::where('education_office','=',$office)->get();

        $department_array = array();
        
        foreach ($departments as $department ){
            $id = $department->id;

            $course_array = array();
            $courses = DB::table('courses')->where('department_id',$id)->get();
            foreach ($courses as $course){
                $data = array(
                    'id' => $course->id,
                    'name' => $course->name,
                    'abbreviation' => $course->abbreviation
                );
                array_push($course_array,$data);
            }

            $subject_array = array();
            $subjects = DB::table('subjects')->where('department_id',$id)->get();
            foreach( $subjects as $subject){
                $data = array(
                    'id' => $subject->id,
                    'name' => $subject->name,
                );
                
                array_push($subject_array,$data);
            }

            $department_array[$id] = array(  'course' => $course_array,'subject' =>$subject_array) ;
            
        }
        
        return ['departments' => $departments, 'department_array' => $department_array];
    }

    public function getDepartments()
    {
        $departments = Department::all();
       
        
        $department_array = array();

        foreach ($departments as $department ){
            $id = $department->id;

            $course_array = array();
            $courses = DB::table('courses')->where('department_id',$id)->get();
            foreach ($courses as $course){
                $data = array(
                    'id' => $course->id,
                    'name' => $course->name,
                    'abbreviation' => $course->abbreviation
                );
                array_push($course_array,$data);
            }

            $subject_array = array();
            $subjects = DB::table('subjects')->where('department_id',$id)->get();
            foreach( $subjects as $subject){
                $data = array(
                    'id' => $subject->id,
                    'name' => $subject->name,
                );
                
                array_push($subject_array,$data);
            }

            $department_array[$id] = array(  'course' => $course_array,'subject' =>$subject_array) ;
            
        }
        return ['departments' => $departments, 'department_array' => $department_array];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('forms.admin.department.create');
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
        
        $department = explode('-',  $request->input('department'));
        
        $name = $department[0];
        $abbreviation = $department[1];
        
        $department_id = Department::insertGetId([
           'name' => $name,
           'abbreviation' => $abbreviation,
           'education_office' => $request->education_office
        ]);
        

        
        if ($request->has('course')){
            $courses = request('course');
            foreach ($courses as $course){
                $data = explode('-', $course);
                $name = $data[0];
                $abbreviation = $data[1];
                DB::table('courses')->insert([
                    'name' => $name,
                    'abbreviation' => $abbreviation,
                    'department_id' => $department_id
                ]);
            }
        }
        

        
        if ($request->has('subject')){
            $subjects = request('subject');
            foreach ($subjects as $subject){
                DB::table('subjects')->insert([
                    'name' => $subject,
                    'department_id' => $department_id
                ]);
            }
        }

        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
