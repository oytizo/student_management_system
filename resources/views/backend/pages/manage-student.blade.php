@extends('backend/master_template/master-template')

@Section('maincontent')


<div class="row">
    <div class="col-md-6 offset-md-1">
        <h3>Student Manage Table</h3>
        <a href="{{ Route('addstudentview') }}"><h2>add student</h2></a>
      <form action="">
        <table class="table border-1">
            <thead>
              <tr>
                <th>name</th>
                <th>contact</th>
                <th>email</th>
                <th>Action</th>
              </tr>
            </thead>
            <thead>
             @foreach ($studentinfo as $item)
             <tr>
              <td>{{ $item->name }}</td>
              <td>{{ $item->contact }}</td>
              <td>{{ $item->email }}</td>
              <td>
                <a href="{{ Route('editstudents',$item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ Route('deletestudents',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
             @endforeach
            </thead>
        </table>
      </form>
    </div>
</div>




@endsection