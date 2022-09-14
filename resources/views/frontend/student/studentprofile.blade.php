
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
            <a href="{{ Route('student_feed') }}">Student Profile</a>
          <form action="">
            <table class="table border-1">
                <thead>
                  <tr>
                    <th>name</th>
                    <th>Course Name</th>
                    <th>contact</th>
                    <th>email</th>
                  </tr>
                </thead>
                <thead>
                 <tr>
                  <td>{{ $studentprofile->name }}</td>
                  <td>{{ $studentprofile->course_name }}</td>
                  <td>{{ $studentprofile->contact }}</td>
                  <td>{{ $studentprofile->email }}</td>
                </tr>
                </thead>
            </table>
          </form>
        </div>
    </div>
    


  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>


