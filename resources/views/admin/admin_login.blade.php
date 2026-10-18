<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign in · Felna SMS Admin</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="noindex, nofollow">
  <meta name="theme-color" content="#0b1324">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="{{asset('asset/css/admin/felna-admin.css')}}?v={{ @filemtime(base_path('asset/css/admin/felna-admin.css')) }}" />
</head>
<body class="fl-body">
  <div class="fl-wrap">
    {{-- Brand side --}}
    <section class="fl-art" aria-hidden="true">
      <div class="fa-brand">
        <span class="fa-brand__mark"><i class="fa-solid fa-comment-sms"></i></span>
        <span class="fa-brand__text"><strong>Felna SMS</strong><small>Admin panel</small></span>
      </div>

      <div>
        <h1>Run your <span>bulk SMS</span> business from one place.</h1>
        <p>Track orders and OTP verifications, update packages and rates, and manage every page of your website.</p>
        <div class="fl-phone">
          <div class="fl-phone__head"><span><i class="fa-solid fa-comment-sms"></i></span> Felna SMS</div>
          <p class="fl-msg">Your OTP is <b>482913</b>. Valid for 5 minutes.</p>
          <p class="fl-msg">New order: <b>Buy 100K+ SMS</b> · Dhaka</p>
          <p class="fl-msg">Campaign delivered to <b>12,480</b> numbers ✓</p>
        </div>
      </div>

      <div class="fl-stats">
        <div><strong>64</strong><small>Districts covered</small></div>
        <div><strong>24/7</strong><small>Support</small></div>
        <div><strong>API</strong><small>Ready</small></div>
      </div>
    </section>

    {{-- Form side --}}
    <main class="fl-form-side">
      <div class="fl-card">
        <h2>Welcome back</h2>
        <p>Sign in to your admin account to continue.</p>

        @if(Session::has('error_message'))
        <div class="fl-error" role="alert"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error_message') }}</div>
        @endif

        <form id="loginform" action="{{url('/admin')}}" method="post">
          {{csrf_field()}}
          <div class="fl-field">
            <label for="username">Username</label>
            <div class="fl-input">
              <i class="fa-solid fa-user"></i>
              <input type="text" id="username" name="username" placeholder="Enter your username" autocomplete="username" required autofocus>
            </div>
          </div>
          <div class="fl-field">
            <label for="password">Password</label>
            <div class="fl-input">
              <i class="fa-solid fa-lock"></i>
              <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required>
              <button type="button" id="togglePass" aria-label="Show password"><i class="fa-solid fa-eye"></i></button>
            </div>
          </div>
          <button type="submit" class="fl-submit">Sign in <i class="fa-solid fa-arrow-right"></i></button>
        </form>

        <p class="fl-foot">{{ date('Y') }} &copy; Felna SMS · <a href="{{ url('/') }}">Back to website</a></p>
      </div>
    </main>
  </div>

  <script>
    (function () {
      var btn = document.getElementById('togglePass');
      var input = document.getElementById('password');
      btn.addEventListener('click', function () {
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        btn.innerHTML = show ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
      });
      document.getElementById('loginform').addEventListener('submit', function () {
        var submit = this.querySelector('.fl-submit');
        submit.disabled = true;
        submit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Signing in...';
      });
    })();
  </script>
</body>
</html>
