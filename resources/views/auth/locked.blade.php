<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Management Information System">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Chrispin B. Zamoranos">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Lockscreen | I.M.S.</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('images/Logo.png')}}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::to('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('dist/css/adminlte.min.css') }}">
    {{-- message toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href=""><b>Inventory Management System</b> Lockscreen</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">{{Session::get('user')}}</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="{{ URL::to('storage/images/'.Session::get('image')) }}" alt="Villaviciosa Seal">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form method="POST" action="{{ route('login.unlock') }}" class="lockscreen-credentials">
      @csrf
      <div class="input-group">
        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
        
        <div class="input-group-append">
          <button type="submit" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
        <div class="form-control-icon">
          <i class="bi bi-shield-lock"></i>
      </div>

        
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
</div>
<!-- /.center -->

    <!-- jQuery -->
    <script src="{{ URL::to('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::to('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- message --}}
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>
</html>