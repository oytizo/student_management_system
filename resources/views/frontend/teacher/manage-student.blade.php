
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
 
    <div class="row">
        <div class="col-md-6 offset-md-1">
            <h3>Student Manage Table</h3>
            <a href="{{ Route('teacher_feed') }}">Teacher Feed</a>
          <form action="">
            <table class="table border-1">
                <thead>
                  <tr>
                    <th>name</th>
                    <th>Course Name</th>
                    <th>contact</th>
                    <th>email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <thead>
                 @foreach ($studentinfo as $item)
                 <tr>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->course_name }}</td>
                  <td>{{ $item->contact }}</td>
                  <td>{{ $item->email }}</td>
                  <td>
                    <a href="{{ Route('editstudent',$item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{ Route('deletestudent',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
                  </td>
                </tr>
                 @endforeach
                </thead>
            </table>
          </form>
        </div>
    </div>
    


  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>


