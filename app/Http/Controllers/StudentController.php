<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassName;
use App\Models\Section;
use DB;

class StudentController extends Controller
{
   
    
    public function index()
    {
        $students = Student::all();
        $classes = \DB::table('class_names')->orderBy('name', 'ASC')->get();
        return view('students.index', ['students' => $students, 'classes' => $classes]);
    }

    public function create()
    {
        $classes = \App\Models\ClassName::orderBy('id', 'ASC')->get(); 
        return view('students.create', ['classes' => $classes]);
    }
  
    public function fetchSections(Request $request)
    {
        $data['sections'] = Section::where("class_id", $request->class_id)
                                ->get(["name", "id"]);
  
        return response()->json($data);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'student_id' => 'required|unique:students,student_id',
        'address' => 'required|string',
        'class_id' => 'required|exists:class_names,id',
        'section_id' => 'required|exists:sections,id',
    ]);

    Student::create($validatedData);

    return redirect()->route('student.index')->with('success', 'Student created successfully.');
}
public function search(Request $request)
{
    $query = $request->input('query');

    $students = Student::where('name', 'LIKE', "%$query%")
                ->orWhere('student_id', 'LIKE', "%$query%")
                ->get();

    return view('student.index', ['students' => $students]);
}

public function update(Student $student, Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'student_id' => 'required|unique:students,student_id,'.$student->id, 
        'address' => 'required|string',
        'class_id' => 'required|exists:class_names,id',
        'section_id' => 'required|exists:sections,id',
    ]);

    $student->update($validatedData);

    return redirect()->route('student.index')->with('success', 'Student updated successfully.');
}

public function edit(Student $student)
{
    $classes = \App\Models\ClassName::orderBy('id', 'ASC')->get(); 
    return view('students.edit', ['student' => $student,'classes' => $classes]);
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

