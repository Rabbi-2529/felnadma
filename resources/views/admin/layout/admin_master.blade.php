<?php
  // Pending orders badge, shared with the sidebar and top bar includes
  try {
    $faPendingOrders = \App\Model\Order::where('order_status', 'pending')->count();
  } catch (\Throwable $e) {
    $faPendingOrders = 0;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Felna SMS · Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="theme-color" content="#0b1324">
<link rel="stylesheet" href="{{asset('asset/css/admin/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/select2.css')}}" />
<link rel="stylesheet" href="{{asset('asset/css/admin/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('asset/fonts/admin/css/font-awesome.css')}}" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
{{-- Felna admin theme: must load last so it restyles the Matrix widgets --}}
<link rel="stylesheet" href="{{asset('asset/css/admin/felna-admin.css')}}?v={{ @filemtime(base_path('asset/css/admin/felna-admin.css')) }}" />
@stack('styles')
</head>
<body class="fa-admin">
  @include('admin.layout.admin_sidebar')

  @include('admin.layout.admin_header')

  @yield('content')

  @include('admin.layout.admin_footer')

  <div class="fa-overlay" data-fa-close></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.14.1/ckeditor.js"></script>
<script src="{{asset('asset/js/admin/jquery.min.js')}}"></script>
<script src="{{asset('asset/js/admin/bootstrap.min.js')}}"></script>
<script src="{{asset('asset/js/admin/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/js/admin/jquery.uniform.js')}}"></script>
<script>
  // matrix.form_validation.js and matrix.tables.js both call .uniform(); skip inputs that are already styled
  // so file inputs don't get two "Choose" buttons.
  (function ($) {
    var uniform = $.fn.uniform;
    $.fn.uniform = function (options) {
      return uniform.call(this.filter(function () {
        return !$(this).parent().is('.uploader, .checker > span, .radio > span, .selector');
      }), options);
    };
  })(jQuery);
</script>
<script src="{{asset('asset/js/admin/select2.min.js')}}"></script>
<script src="{{asset('asset/js/admin/jquery.validate.js')}}"></script>
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
    if (document.getElementById('messageArea')) {
      CKEDITOR.replace( 'messageArea',
      {
       customConfig : 'config.js',
       toolbar : 'simple'
       })
    }
  </script>

  <script>
    // Sidebar: collapsible sections + off-canvas menu on small screens
    (function () {
      var root = document.documentElement;
      document.querySelectorAll('.fa-nav__toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var item = btn.closest('.fa-nav__item');
          var open = !item.classList.contains('is-open');
          item.classList.toggle('is-open', open);
          btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
      });
      document.querySelectorAll('[data-fa-burger]').forEach(function (btn) {
        btn.addEventListener('click', function () { root.classList.toggle('fa-nav-open'); });
      });
      document.querySelectorAll('[data-fa-close]').forEach(function (el) {
        el.addEventListener('click', function () { root.classList.remove('fa-nav-open'); });
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
          root.classList.remove('fa-nav-open');
          document.querySelectorAll('.fa-user[open]').forEach(function (d) { d.removeAttribute('open'); });
        }
      });
      // Close the user menu when clicking elsewhere
      document.addEventListener('click', function (e) {
        document.querySelectorAll('.fa-user[open]').forEach(function (d) { if (!d.contains(e.target)) d.removeAttribute('open'); });
      });
      // Keep the active link in view inside a long sidebar
      var current = document.querySelector('.fa-nav .is-current, .fa-nav__item.is-active');
      if (current && current.scrollIntoView) current.scrollIntoView({ block: 'center' });
    })();
  </script>
  @stack('scripts')

</body>
</html>
