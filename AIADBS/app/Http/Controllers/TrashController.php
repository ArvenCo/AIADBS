<?php

namespace App\Http\Controllers;

use App\Models\Trash;
use Illuminate\Http\Request;

class TrashController extends Controller
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
            $collection = $request->collection;
            $trash = new Trash();

            switch ($collection) {
                case 'Department':
                    $trash->department_id = $request->id;
                    break;
                
                case 'Subject':
                    $trash->subject_id = $request->id;
                    break;

                case 'Course':
                    $trash->course_id = $request->id;
                    break;
                default:
                    # code...
                    break;
            }
            $save = $trash->save();
            if ($save){
                return ['success' => $collection.' has been trashed.'];
            }
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trash  $trash
     * @return \Illuminate\Http\Response
     */
    public function show(Trash $trash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trash  $trash
     * @return \Illuminate\Http\Response
     */
    public function edit(Trash $trash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trash  $trash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trash $trash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trash  $trash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trash $trash)
    {
        //
    }
}
