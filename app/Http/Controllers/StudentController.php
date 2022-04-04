<?php

namespace App\Http\Controllers;

use App\{Student,Branch,Course};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
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
        $courses = course::all();
        $branches = branch::all();
        return view('studentregister',compact(['courses','branches']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
        'sname' => 'required|max:255',
        'fname' => 'required|max:255',
        'class' => 'required|max:255',
        'phnum' => 'required|numeric',
        'email' => 'required|email',
        'course_id' => 'required|numeric',
        'branch_id' => 'required|numeric',
        'image' => 'required|mimes:jpeg,png|max:2048',
        ]);


        $students = new Student();
        $students->sname = $request->sname;
        $students->fname = $request->fname;
        $students->class = $request->class;
        $students->phnum = $request->phnum;
        $students->email = $request->email;
        $students->course_id = $request->course_id;
        $students->branch_id = $request->branch_id;
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        //$extension = $request->file('image')->getClientOriginalExtension();
        //dd($imageName);
        $students->image = $imageName;
        $students->save();//dd($students->image);
        $request->image->move(public_path('posting'),$imageName);
        
        

        return redirect('studentregisterform')->with('success','Submitted Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        if($request->ajax())
        {//dd($request->input());
            $student_cols = $request->get('filters');
            if($student_cols)
            {
                $columns = explode(',', $student_cols);
                $student =  student::select('id','sname');
                foreach ($columns as $key => $value) {
                    $student->addselect($value);
                }
                $students = $student->paginate(10);
                return view('studentdetails_ajax',compact('students'));
            }
            else
            {
                $students =  student::select('id','sname')->paginate(10);
                return view('studentdetails_ajax',compact('students'));
            }
            //dd($students);
            //$student = json_decode($students);
            //echo gettype($student);dd($student);
        }
            $students =  student::select('id','sname')->paginate(10);
            return view('studentdetails',compact('students'));
        
        
    }

    public function ajax_show(Request $request)
    {     //dd($request->input());
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $search = $request->get('search');
            $search = str_replace(' ','%',$search);

            $students = student::where('sname','like','%'.$search.'%')
                                ->orwhere('fname','like','%'.$search.'%')
                                ->orderby($sort_by,$sort_type)
                                ->paginate(10);
            return view('studentdetails_ajax',compact('students'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::find($id);
        return view('studentedit',compact('students'));
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
         $students = Student::find($id);
         $students->sname = $request->sname;
         $students->fname = $request->fname;
         $students->class = $request->class;
         $students->phnum = $request->phnum;
         $students->email = $request->email;
         $students->save();
         
         return redirect('studentdetails');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $students = Student::find($id);
        $image = 'posting/'.$students->image;
        if(file_exists($image))
        {
            unlink($image);
        }
        $students->delete();

        return redirect('studentdetails')->with('deleted','Deleted Successfully!');
    }

    public function courses(Request $req)
    {
        $id = $req->id;
        $data['course'] = Course::where('branch_id',$id)->get();
        echo json_encode($data);
    }

    public function single_student(Request $request)
    {
        $id = $request->id;
        $student = student::where(['id'=>$id])->get()->first();
        //dd($student);
        return view('student_show',compact('student'));
    }
}
