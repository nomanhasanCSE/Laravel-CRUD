<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassName;
// use App\Models\Section;
use DB;

class StudentController extends Controller
{
    // public function index()
    // {
    //     $students = Student::all();
    //     return view('students.index', ['students' => $students]);
    // }
    
    public function index()
    {
        $students = Student::all();
        $classes = \DB::table('class_names')->orderBy('name', 'ASC')->get();
        return view('students.index', ['students' => $students, 'classes' => $classes]);
    }
    public function create()
    {
        $classes = \App\Models\ClassName::orderBy('name')->get(); 
        return view('students.create', ['classes' => $classes]);
    }
    // public function fetchSections($class_id =null)
    // {
    //     $sections = \DB::table('sections')->where('class_id', $class_id)->get();
    //     return  response() ->json (['status' => 1,
    //     'sections' => $sections]);
    // }
    public function fetchSections($id)
{
    $sections = \App\Models\ClassName::findOrFail($id)->sections()->get();
    return response()->json(['status' => 1, 'sections' => $sections]);
}


    
    // public function create(){
    //     return view('students.create');
    // }


    public function store(Request $request)
    {
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'student_id' => 'required|unique:students,student_id', 
        'address' => 'required|string',
        'class' => 'required|integer|between:1,10',
        'section' => 'required|string|size:1',
    ]);

    
    Student::create($validatedData);

    return redirect()->route('student.index')->with('success', 'Student created successfully.');
}

public function edit(Student $student){
    return view('students.edit', ['student' => $student]);
}
public function update(Student $student, Request $request){
  
    $validatedData = $request->validate([
        'name' => 'required|string',
        'student_id' => 'required|unique:students,student_id,'.$student->id, 
        'address' => 'required|string',
        'class' => 'required|integer|between:1,10',
        'section' => 'required|string|size:1',
    ]);

    $student->update($validatedData);
 
    return redirect()->route('student.index')->with('success', 'Student updated successfully.');
}

public function remove(Student $student){
    $student->delete();
    return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
}
}

/*Alternative
    public function store(Request $request){
    //     //dd($request->class);
     $formData = $request->only(['name', 'student_id', 'address', 'class', 'section']);

   
     Student::create($formData);

     Redirect back to the index page with a success message
    return redirect()->route('student.index')->with('success', 'Student created successfully.');

    }*/

