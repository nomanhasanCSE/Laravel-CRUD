<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', ['students' => $students]);
    }
    
    public function create(){
        return view('students.create');
    }


    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'student_id' => 'required|unique:students,student_id', // Ensure student_id is unique
        'address' => 'required|string',
        'class' => 'required|integer|between:1,10',
        'section' => 'required|string|size:1',
    ]);

    // Create a new Student record with the validated data
    Student::create($validatedData);

    // Redirect back to the index page with a success message
    return redirect()->route('student.index')->with('success', 'Student created successfully.');
}

public function edit(Student $student){

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

