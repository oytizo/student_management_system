@extends('backend/master_template/master-template')

@Section('maincontent')


<div class="row">
    <div class="col-md-6 offset-md-1">
        <h3>Teacher Manage Table</h3>
      <a href="{{ Route('addteacherview') }}">Add Teacher</a>
      <form action="">
        <table class="table border-1">
            <thead>
              <tr>
                <th>name</th>
                <th>age</th>
                <th>contact</th>
                <th>email</th>
                <th>Action</th>
              </tr>
            </thead>
            <thead>
             @foreach ($teacherinfo as $item)
             <tr>
              <td>{{ $item->name }}</td>
              <td>{{ $item->age }}</td>
              <td>{{ $item->contact }}</td>
              <td>{{ $item->email }}</td>
              <td>
                <a href="{{ Route('editteacher',$item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ Route('deleteteacher',$item->id) }}" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
             @endforeach
            </thead>
        </table>
      </form>
    </div>
</div>




@endsection