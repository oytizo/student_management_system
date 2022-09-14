@extends('backend/master_template/master-template')

@Section('maincontent')


<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Add Student Info</h2>
        <a href="{{ Route('studentview') }}">Student Feed</a>
            <form action="{{ Route('updatestudents',$studentinfo->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Student Name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputName1" aria-describedby="emailHelp"
                        placeholder="Enter Name" value="{{ $studentinfo->name  }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputCourse1">Course Name</label>
                    <input type="text" class="form-control" name="course_name" id="exampleInputCourse1" aria-describedby="emailHelp"
                        placeholder="Enter Course Name" value="{{ $studentinfo->course_name  }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputContact1">Student Contact Number</label>
                    <input type="text" class="form-control" name="contact_no" id="exampleInputContact1" aria-describedby="emailHelp"
                        placeholder="Enter Contact Number" value="{{ $studentinfo->contact  }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email" value="{{ $studentinfo->email  }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>





@endsection