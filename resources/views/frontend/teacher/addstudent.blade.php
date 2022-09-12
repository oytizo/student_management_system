<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Add Student Info</h2>
                <form action="{{ Route('storestudent') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Student Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName1" aria-describedby="emailHelp"
                            placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCourse1">Course Name</label>
                        <input type="text" class="form-control" name="course_name" id="exampleInputCourse1" aria-describedby="emailHelp"
                            placeholder="Enter Course Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputContact1">Student Contact Number</label>
                        <input type="text" class="form-control" name="contact_no" id="exampleInputContact1" aria-describedby="emailHelp"
                            placeholder="Enter Contact Number">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>

</html>
