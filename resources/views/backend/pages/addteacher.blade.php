@extends('backend/master_template/master-template')

@Section('maincontent')
    <div class="row">
        <div class="col-md-6 offset-md-1">
            <h3>Add Teacher Record</h3>
            <div class="p-3">
                <a href="{{ Route('teacherview') }}">Manage Teacher</a>
            </div>
            <form action="{{ Route('addteacher') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" aria-describedby="emailHelp"
                        name="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputAge1">Age</label>
                    <input type="text" class="form-control" id="exampleInputAge1" aria-describedby="emailHelp"
                        name="age" placeholder="Enter Age">
                </div>
                <div class="form-group">
                    <label for="exampleInputContact1">Contact Number</label>
                    <input type="text" class="form-control" id="exampleInputContact1" aria-describedby="emailHelp"
                        name="contact_no" placeholder="Enter Contact Number">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                        placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
