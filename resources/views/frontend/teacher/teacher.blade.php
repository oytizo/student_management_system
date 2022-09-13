
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
      <h2>Teacher info</h2>

<ul>
  <li><a href="{{ Route('addstudent') }}">Add Student</a></li>
  <li><a href="{{ Route('viewstudent')  }}">View Student</a></li>
</ul>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn btn-success" class="nav-link"><i class="fa fa-power-off"></i>Logout</button>
  </form>
    </div>
  </div>
</div>


  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>


