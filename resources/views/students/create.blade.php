<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name ="_token" content = "{{csrf_token()}}">
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
   <!-- <H1 class="mx-5 mt-4":>Create a student</H1> -->

@if($errors->any())
    <div class="alert alert-danger text-center mt-4 w-50 mx-auto">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li class="fs-4">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center fs-2 fw-bolder bg-primary text-white">Student Form</div>
                <div class="card-body">
            
                    <form method="post" action= "{{route('student.store')}}">
                        @csrf
                        @method("post")
                        <div class="form-group fs-4">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder=" Please write your name here"class="form-control" required>
                        </div>

                        <div class="form-group fs-4">
                            <label for="student_id">Student ID:</label>
                            <input type="text" id="student_id" name="student_id" placeholder=" Please write your student ID here"class="form-control" required>
                        </div>
                        <div class="form-group fs-4">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" placeholder=" Please write your address here" class="form-control" required>
                        </div>
                        <div class="form-group fs-4">
                            <label for="class" class="form-label">Class:</label>
                            <select class="form-select" id="class" name="class_id" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group fs-4">
                            <label for="section" class="form-label">Section:</label>
                            <select class="form-select" id="section" name="section_id" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>
                        <!-- <div class="form-group fs-4">
                            <label for="section" class="form-label">Sectio:</label>
                            <select class="form-select" id="section" name="section" required>
                            <option value="">Select Section</option>
                            </select>
                        </div> -->
                        <!-- <div class="form-group fs-4">
                            <label for="class">Class:</label>
                            <select id="class" name="class" class="form-control" required>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div> -->

                        <!-- <div class="form-group fs-4">
                            <label for="section">Section:</label>
                            <select id="section" name="section" class="form-control" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                        
                            </select>
                        </div> -->

                        <button type="submit" class="btn btn-primary mt-3 fs-4 form-control">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#class').on('change', function() {
            var classId = $(this).val();
            if (classId) {
                $.ajax({
                    url: '{{ url("/student/fetchSections") }}/' + classId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                        if (response.status == 1 && response.sections.length > 0) {
                            $('#section').empty().append('<option value="">Select Section</option>');
                            $.each(response.sections, function(key, value) {
                                $("#section").append("<option value='" + value.id + "'>" + value.name + "</option>");
                            });
                        }
                    }
                });
            } else {
                $('#section').empty().append('<option value="">Select Section</option>');
            }
        });
    });
</script>



  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#class').on('change', function() {
            var class_id = $(this).val();
            if (class_id) {
                $.ajax({
                    url: '{{ url("/student/fetch-sections/") }}' + class_id,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        if (response['sections'].length > 0) {
                            $('#section').empty().append('<option value="">Select Section</option>');
                            $.each(response['sections'], function(key, value) {
                                $("#section").append("<option value='" + value['id'] + "'>" + value['name'] + "</option>");
                            });
                        }
                    }
                });
            } 
        });
    });
</script> -->


  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $ajax.Setup({
        header: {
            'X-CSRF-TOKEN':$('meta[name ="-token"]')
            .attr(.content')
        }
    }):
    $(document).ready(function() {
        $('#class').on('change', function() {
            var class_id = $(this).val();
            if (class_id) {
                $.ajax({
                    url: '{{url("/stdent/fetch-sections/")}}'+ class_id,
                    type ='post',
                    datatype ='json'
                    success: function(response) {
                        if (response ['sections'].length>0)
                        {   $('#section').find('option:not(:first)').remove();
                            $.each(response['sections'], function(key,value){
                            $("#section").append("<option id = '"+value['id']+"'}+"'>"+value['name']+"</option>") 
                            })
                        }

                        // $('#section').empty().append('<option value="">Select Section</option>');
                        // $.each(response, function(index, item) {
                        //     $('#section').append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    }
                });
            } 
</script> -->
</body>
</html>