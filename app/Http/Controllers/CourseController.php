<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Course;
use DB;

class CourseController extends Controller
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
        $branches = branch::all();
        return view('courseadd',compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new course();
        $course->branch_id = $request->branchid;
        $course->cname = $request->cname;
        $course->save();
        return redirect('/courseshow');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        $courses = course::select('branches.bfull','courses.cname','courses.id')
                    ->join('branches','branches.id','courses.branch_id')
                    ->paginate(10);
        //dd($courses);
        return view('courseshow',compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $courses = branch::all();
         $branches = DB::table('courses')->select('branches.id as bid','branches.bfull','courses.cname','courses.id as cid')
                    ->join('branches','branches.id','courses.branch_id')
                    ->where(['courses.id'=>$id])->get()->first();
        //dd($courses,$branches);
        return view('courseedit',compact('courses','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = course::find($id);
        $course->branch_id = $request->branchid;
        $course->cname = $request->cname;
        $course->save();
        return redirect('/courseshow');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = course::find($id);
        $course->delete();

        return redirect('/courseshow');
    }
}
