<!DOCTYPE html>
<html lang="en">
<head>
<title>Felna SMS</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{asset('asset/css/admin/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/select2.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/matrix-media.css')}}" />
<link rel="stylesheet" href="{{asset('asset/fonts/admin/css/font-awesome.css')}}" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
  @include('admin.layout.admin_header')

  @include('admin.layout.admin_sidebar')

  @yield('content')

  @include('admin.layout.admin_footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.14.1/ckeditor.js"></script>
<script src="{{asset('asset/js/admin/jquery.min.js')}}"></script>
<script src="{{asset('asset/js/admin/bootstrap.min.js')}}"></script>
<script src="{{asset('asset/js/admin/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/js/admin/jquery.uniform.js')}}"></script>
<script src="{{asset('asset/js/admin/select2.min.js')}}"></script>
<script src="{{asset('asset/js/admin/jquery.validate.js')}}"></script>
<script src="{{asset('asset/js/admin/matrix.js')}}"></script>
<script src="{{asset('asset/js/admin/matrix.form_validation.js')}}"></script>
<script src="{{asset('asset/js/admin/matrix.tables.js')}}"></script>
<script src="{{asset('asset/js/admin/matrix.popover.js')}}"></script>
<script src="{{asset('asset/js/admin/bootstrap-wysihtml5.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    $( function() {
      $( "#expiry_date" ).datepicker({
        // minDate: 0,
        dateFormat: 'yy-mm-dd'
      });
    } );
  </script>

  <script type="text/javascript">
           CKEDITOR.replace( 'messageArea',
           {
            customConfig : 'config.js',
            toolbar : 'simple'
            })
  </script>

</body>
</html>
