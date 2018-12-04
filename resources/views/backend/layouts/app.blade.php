<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gentelella Alela! | </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel='stylesheet' href='{{asset('assets/includes/js/jquery-ui-1.12.1/jquery-ui.min.css')}}' type='text/css' media='all' />
    <!-- Font Awesome -->
    <link href="{{asset('assets/backend/vendor/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{asset('assets/backend/vendor/bootstrap-dialog/bootstrap-dialog.css')}}" rel="stylesheet">
    
    <link rel='stylesheet' id='carspot-select2-css' href='{{asset('assets/css/custom/styles.css')}}' type='text/css' media='all' />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"/>
    <link rel='stylesheet' id='carspot-select2-css' href='{{asset('assets/css/select2.min55fe.css')}}' type='text/css' media='all' />
    <script src="{{asset('assets/backend/vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
    /* it is used to do azax function in laravel. */  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>
    <!-- Custom Theme Style -->
	<style>
	.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
	</style>
    @yield('styles')
    <link href="{{asset('assets/backend/css/custom.min.css')}}" rel="stylesheet">
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('backend.partials._sidebar')
        @include('backend.partials._navbar')
        @yield('content')
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>
<div id="ajax-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static"><div class="modal-dialog"></div></div>
<div id="loading_modal" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 48px">
            <span class="fa fa-spinner fa-spin fa-3x"></span>
        </div>
    </div>
</div>
<!-- Bootstrap -->
<script src="{{asset('assets/backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script type='text/javascript' src='{{asset('assets/includes/js/jquery-ui-1.12.1/jquery-ui.min.js')}}'></script>
<script src="{{asset('assets/backend/vendor/nprogress/nprogress.js')}}"></script>
<script src="{{asset('assets/backend/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<script src="{{asset('assets/backend/vendor/bootstrap-dialog/bootstrap-dialog.js')}}"></script>
<script type='text/javascript' src='{{asset('assets/jQueryInputNumberMask/jquery.masknumber.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/select2.min55fe.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/js/ajaxupload.3.5.js')}}'></script>
<script type="text/javascript" src="{{asset('assets/DataTables-1.10.18/js/jquery.dataTables.min.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('assets/backend/js/custom.min.js')}}"></script>
@yield('scripts')
</body>
</html>
