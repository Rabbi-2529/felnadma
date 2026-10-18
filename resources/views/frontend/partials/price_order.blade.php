{{-- Buy now order modals + OTP flow for the price cards. Expects $packages. --}}
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" media="print" onload="this.media='all'">
@endpush

{{-- ========== Order modals ========== --}}
@push('modals')
@foreach($packages as $package)
<div class="modal fade modal-f order-modal" id="buyPack{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="buyPackTitle{{ $package->id }}" aria-hidden="true" data-package="{{ $package->id }}" data-package-name="{{ $package->package_name }}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="ico"><i class="fas fa-cart-shopping"></i></div>
        <div>
          <h4 class="modal-title" id="buyPackTitle{{ $package->id }}">Complete your order</h4>
          <p class="modal-sub">{{ $package->package_name }}</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form id="orderForm{{ $package->id }}" novalidate>
        @csrf
        <div class="modal-body">
          <div class="steps" aria-hidden="true">
            <div class="step active" data-step="1"><div class="step-circle">1</div><span>Details</span></div>
            <div class="step-line"></div>
            <div class="step" data-step="2"><div class="step-circle">2</div><span>Verify</span></div>
            <div class="step-line"></div>
            <div class="step" data-step="3"><div class="step-circle">3</div><span>Done</span></div>
          </div>

          {{-- Step 1 --}}
          <div class="step-content" data-content="1">
            <div class="field">
              <label for="o_name{{ $package->id }}">Full name <span class="req">*</span></label>
              <div class="input-icon">
                <input type="text" class="form-control" id="o_name{{ $package->id }}" name="client_name" placeholder="Your full name" autocomplete="name" required>
                <i class="fas fa-user"></i>
              </div>
            </div>
            <div class="field">
              <label for="o_email{{ $package->id }}">Email address <span class="req">*</span></label>
              <div class="input-icon">
                <input type="email" class="form-control" id="o_email{{ $package->id }}" name="client_email" placeholder="you@company.com" autocomplete="email" required>
                <i class="fas fa-envelope"></i>
              </div>
            </div>
            <div class="field" data-field="phone">
              <label for="o_phone{{ $package->id }}">Phone number <span class="req">*</span></label>
              <div class="input-icon">
                <input type="tel" class="form-control" id="o_phone{{ $package->id }}" name="client_phone" placeholder="01XXXXXXXXX" inputmode="numeric" autocomplete="tel" maxlength="11" required>
                <i class="fas fa-mobile-alt"></i>
              </div>
              <div class="field-error">Enter a valid 11-digit Bangladeshi number (01XXXXXXXXX).</div>
              <span class="field-hint">We'll send a one-time code to this number.</span>
            </div>
            <div class="field">
              <label for="o_district{{ $package->id }}">District <span class="req">*</span></label>
              <select class="form-control district-select" name="client_district" id="o_district{{ $package->id }}" required>
                <option value="">Select your district</option>
              </select>
            </div>
            <div class="pkg-summary">
              <i class="fas fa-box"></i>
              <div>
                <small>Selected package</small>
                <strong>{{ $package->package_name }}</strong>
                <input type="hidden" name="package_name" value="{{ $package->package_name }}">
              </div>
            </div>
          </div>

          {{-- Step 2 --}}
          <div class="step-content" data-content="2" hidden>
            <div class="otp-box">
              <i class="fas fa-shield-halved"></i>
              <p>We've sent a 6-digit code to <strong class="js-phone-display"></strong></p>
            </div>
            <div class="field mb-0">
              <label for="o_otp{{ $package->id }}">Verification code</label>
              <input type="text" name="otp" id="o_otp{{ $package->id }}" class="form-control otp-input" placeholder="••••••" maxlength="6" inputmode="numeric" autocomplete="one-time-code" required>
            </div>
            <div class="otp-meta">
              <span class="otp-timer"><i class="fas fa-hourglass-half"></i> Code expires in <span class="timer js-timer">05:00</span></span>
              <span>
                <button type="button" class="link-btn js-resend">Resend code</button>
                <button type="button" class="link-btn js-change-phone">Change number</button>
              </span>
            </div>
          </div>

          {{-- Step 3 --}}
          <div class="step-content" data-content="3" hidden>
            <div class="success-box">
              <div class="check"><i class="fas fa-check"></i></div>
              <h3>Order placed successfully!</h3>
              <p>Thank you for choosing Felna DMA.</p>
              <div class="order-details">
                <div class="detail-row"><span>Order ID</span><strong class="js-order-id">—</strong></div>
                <div class="detail-row"><span>Package</span><strong>{{ $package->package_name }}</strong></div>
                <div class="detail-row"><span>Status</span><span class="status-badge">Pending confirmation</span></div>
              </div>
              <div class="note justify-content-center"><i class="fas fa-headset"></i><span>Our team will contact you shortly to confirm payment.</span></div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-f btn-f--outline btn-f--sm js-cancel" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn-f btn-f--outline btn-f--sm js-back" hidden><i class="fas fa-arrow-left"></i> Back</button>
          <button type="button" class="btn-f btn-f--accent btn-f--sm js-next">Continue <i class="fas fa-arrow-right"></i></button>
          <button type="submit" class="btn-f btn-f--primary btn-f--sm js-submit" hidden>Verify &amp; confirm <i class="fas fa-check"></i></button>
          <button type="button" class="btn-f btn-f--primary btn-f--sm js-done" data-dismiss="modal" hidden>Done</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
(function ($) {
  'use strict';

  var SEND_OTP_URL = @json(route('order.sendOtp'));
  var CONFIRM_URL = @json(route('order.confirm'));
  var OTP_SECONDS = 300;
  var districts = [
    "Bagerhat","Bandarban","Barguna","Barisal","Bhola","Bogura","Brahmanbaria",
    "Chandpur","Chapainawabganj","Chattogram","Chuadanga","Comilla","Cox's Bazar",
    "Dhaka","Dinajpur","Faridpur","Feni","Gaibandha","Gazipur","Gopalganj",
    "Habiganj","Jamalpur","Jashore","Jhalakathi","Jhenaidah","Joypurhat",
    "Khagrachhari","Khulna","Kishoreganj","Kurigram","Kushtia","Lakshmipur",
    "Lalmonirhat","Madaripur","Magura","Manikganj","Meherpur","Moulvibazar",
    "Munshiganj","Mymensingh","Naogaon","Narail","Narayanganj","Narsingdi",
    "Natore","Netrokona","Nilphamari","Noakhali","Pabna","Panchagarh",
    "Patuakhali","Pirojpur","Rajbari","Rajshahi","Rangamati","Rangpur",
    "Satkhira","Shariatpur","Sherpur","Sirajganj","Sunamganj","Sylhet","Tangail","Thakurgaon"
  ];
  var csrf = $('meta[name="csrf-token"]').attr('content');

  function alertError(title, text) {
    Swal.fire({ icon: 'error', title: title, text: text, confirmButtonColor: '#059669' });
  }

  $('.order-modal').each(function () {
    var $modal = $(this);
    var packageName = $modal.data('package-name');
    var $form = $modal.find('form');
    var $phone = $form.find('input[name="client_phone"]');
    var $district = $form.find('.district-select');
    var $resend = $modal.find('.js-resend');
    var step = 1, timer = null, orderId = 'SMS' + Date.now();

    districts.forEach(function (d) { $district.append($('<option>').val(d).text(d)); });
    Felna.digitsOnly($phone[0], 11);
    $form.find('.otp-input').each(function () { Felna.digitsOnly(this, 6); });

    $phone.on('input', function () {
      var ok = Felna.isBdPhone(this.value);
      $(this).toggleClass('is-valid', ok);
      Felna.setFieldError($phone.closest('.field')[0], this.value.length === 11 && !ok);
    });

    function values() {
      return {
        name: $.trim($form.find('input[name="client_name"]').val()),
        email: $.trim($form.find('input[name="client_email"]').val()),
        phone: $.trim($phone.val()),
        district: $district.val()
      };
    }

    function goTo(n) {
      step = n;
      $modal.find('.step-content').each(function () { this.hidden = Number(this.getAttribute('data-content')) !== n; });
      $modal.find('.step').each(function () {
        var s = Number(this.getAttribute('data-step'));
        this.classList.toggle('active', s === n);
        this.classList.toggle('completed', s < n);
      });
      $modal.find('.js-cancel')[0].hidden = n === 3;
      $modal.find('.js-back')[0].hidden = n !== 2;
      $modal.find('.js-next')[0].hidden = n !== 1;
      $modal.find('.js-submit')[0].hidden = n !== 2;
      $modal.find('.js-done')[0].hidden = n !== 3;
      if (n === 2) setTimeout(function () { $form.find('.otp-input').trigger('focus'); }, 50);
    }

    function stopTimer() { if (timer) clearInterval(timer); timer = null; }

    function startTimer() {
      stopTimer();
      var left = OTP_SECONDS;
      var $t = $modal.find('.js-timer');
      $resend.prop('disabled', true);
      var tick = function () {
        var m = Math.floor(left / 60), s = left % 60;
        $t.text((m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s);
        if (left <= 0) {
          stopTimer();
          $t.text('expired');
          $resend.prop('disabled', false);
        }
        left--;
      };
      tick();
      timer = setInterval(tick, 1000);
    }

    function sendOtp() {
      var v = values();
      return fetch(SEND_OTP_URL + '?' + new URLSearchParams({
        _token: csrf,
        client_name: v.name,
        client_email: v.email,
        client_phone: v.phone,
        client_district: v.district,
        package_name: packageName
      })).then(function (res) { return res.json(); });
    }

    // Step 1 -> 2
    $modal.find('.js-next').on('click', function () {
      var v = values();
      if (!v.name || !v.email || !v.phone || !v.district) {
        alertError('Missing details', 'Please fill in all fields.');
        return;
      }
      if (!/^\S+@\S+\.\S+$/.test(v.email)) {
        alertError('Invalid email', 'Please enter a valid email address.');
        return;
      }
      if (!Felna.isBdPhone(v.phone)) {
        Felna.setFieldError($phone.closest('.field')[0], true);
        $phone.trigger('focus');
        return;
      }

      var $btn = $(this);
      var label = $btn.html();
      $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending code...');

      sendOtp().then(function (data) {
        $btn.prop('disabled', false).html(label);
        if (data.status === 'success') {
          $modal.find('.js-phone-display').text(v.phone);
          Swal.fire({ icon: 'success', title: 'Code sent!', text: data.message, timer: 1500, showConfirmButton: false });
          startTimer();
          goTo(2);
        } else {
          alertError('Could not send code', data.message);
        }
      }).catch(function () {
        $btn.prop('disabled', false).html(label);
        alertError('Network error', 'Please check your connection and try again.');
      });
    });

    // Back / change number
    $modal.find('.js-back, .js-change-phone').on('click', function () {
      stopTimer();
      $resend.prop('disabled', false);
      goTo(1);
    });

    // Resend (enabled once the timer runs out)
    $resend.on('click', function () {
      var $btn = $(this);
      $btn.prop('disabled', true).text('Sending...');
      sendOtp().then(function (data) {
        $btn.text('Resend code');
        if (data.status === 'success') {
          Swal.fire({ icon: 'success', title: 'New code sent', text: data.message, timer: 1500, showConfirmButton: false });
          startTimer();
        } else {
          $btn.prop('disabled', false);
          alertError('Could not send code', data.message);
        }
      }).catch(function () {
        $btn.prop('disabled', false).text('Resend code');
        alertError('Error', 'Failed to resend the code. Please try again.');
      });
    });

    // Step 2 -> 3
    $form.on('submit', function (e) {
      e.preventDefault();
      if (step !== 2) return;

      var otp = $.trim($form.find('.otp-input').val());
      if (otp.length !== 6) {
        alertError('Enter the code', 'Please enter the 6-digit code we sent you.');
        return;
      }

      var $submit = $modal.find('.js-submit');
      var label = $submit.html();
      $submit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Verifying...');

      var formData = new FormData(this);
      formData.append('order_id', orderId);

      fetch(CONFIRM_URL, { method: 'POST', body: formData, headers: { 'X-CSRF-TOKEN': csrf } })
        .then(function (res) { return res.json(); })
        .then(function (data) {
          $submit.prop('disabled', false).html(label);
          if (data.status === 'success') {
            stopTimer();
            $modal.find('.js-order-id').text(data.order_id || orderId);
            goTo(3);
          } else {
            alertError('Verification failed', data.message);
          }
        }).catch(function () {
          $submit.prop('disabled', false).html(label);
          alertError('Error', 'Please try again.');
        });
    });

    // Searchable district list
    $modal.on('shown.bs.modal', function () {
      if ($.fn.select2 && !$district.hasClass('select2-hidden-accessible')) {
        $district.select2({ placeholder: 'Search your district', allowClear: true, dropdownParent: $modal, width: '100%' });
      }
      if (step === 1) $form.find('input[name="client_name"]').trigger('focus');
    });

    // Reset when closed
    $modal.on('hidden.bs.modal', function () {
      stopTimer();
      $resend.prop('disabled', false).text('Resend code');
      $form[0].reset();
      $district.val('').trigger('change');
      $phone.removeClass('is-valid');
      Felna.setFieldError($phone.closest('.field')[0], false);
      orderId = 'SMS' + Date.now();
      goTo(1);
    });
  });
})(jQuery);
</script>
@endpush
