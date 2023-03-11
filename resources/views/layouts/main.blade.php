<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? config('app.name').' | '.$title : config('app.name') }}</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  @stack('css')
</head>
<body class="hold-transition{{ isset($login) ? ' login-page' : '' }}">
    @if(isset($login))
    <div class="login-box">
        @yield('content')
    </div>
    @else
    <div class="wrapper">
        @include('layouts.inc.navbar')
        @include('layouts.inc.sidebar')
        @yield('content')
        <footer class="main-footer">
            <strong>Copyright &copy; 2023
                 <a href="/">{{ config ('app.name') }}</a>. 
            </strong> 
            All rights reserved.
        </footer>
    </div>
    @endif
    @stack('modal')
<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script> 
    @stack('js')
</body>
</html>