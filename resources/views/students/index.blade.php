<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=H1, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Laravel CRUD</title>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('student.index')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('student.create')}}">Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
    
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
 
<!-- <h1 class="mt-4 text-center fs-2 fw-bolde "> This is Home page</h1> -->

    @if(session('success'))
    <div class="alert alert-success text-center fs-2 fw-bolder mt-4 bg-primary text-white w-50 mx-auto mt-4">
        {{ session('success') }}
    </div>
@endif




<div class="container mt-5">
    <h2 class="text-center mb-4">List of Students</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Student ID</th>
                <th>Address</th>
                <th>Class</th>
                <th>Section ID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->class_id }}</td>
                    <td>{{ $student->section_id}}</td>
                    <td> <a href="{{route('student.edit',['student' => $student])}}">Edit</a>  </td>
                    <td> <form method="post" action="{{route('student.remove',['student' =>$student])}}">
                      @csrf
                      @method('delete')
                      <input type="submit" value="Delete" class="btn btn-danger"/>
                    </form></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</body>
</html>