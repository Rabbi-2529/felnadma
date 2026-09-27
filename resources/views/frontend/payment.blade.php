@extends('frontend.layout.frontend_master')
<?php
  $bankLogoFor = function ($bank) {
      $name = strtolower($bank->bank_name);
      if (strpos($name, 'ab bank') !== false || strpos($name, 'abbl') !== false) return 'https://abbl.com/wp-content/themes/abbank/images/logo.png';
      if (strpos($name, 'agrani') !== false) return 'https://www.agranibank.org/style/images/agrani_plc_logo.png';
      if (strpos($name, 'prime bank') !== false) return 'https://www.primebank.com.bd/web/new_assets/assets/images/new-logo-en.png';
      if (strpos($name, 'brac') !== false) return 'https://www.bracbank.com/logo.svg';
      if (strpos($name, 'bank asia') !== false) return 'https://www.bankasia-bd.com/style/images/bank_asia_logo-2.png';
      if (strpos($name, 'dutch') !== false || strpos($name, 'dbb') !== false) return 'https://www.dutchbanglabank.com/img/logo.png';
      if (strpos($name, 'mutual') !== false || strpos($name, 'mbl') !== false) return 'https://www.mblbd.com/style/images/mbl_logo.jpg';
      if ($bank->logo && file_exists(base_path('asset/images/' . $bank->logo))) return \App\Support\Img::url('asset/images/' . $bank->logo);
      return null;
  };
  $mobileLogoFor = function ($mobile) {
      $company = strtolower($mobile->mobile_company);
      if ($company == 'bkash') return 'https://images.seeklogo.com/logo-png/47/1/bkash-logo-png_seeklogo-471379.png';
      if ($company == 'nagad') return 'https://www.tbsnews.net/sites/default/files/styles/amp_metadata_content_image_min_696px_wide/public/images/2019/10/07/nagad.jpg';
      if ($company == 'rocket' || strpos($company, 'dutch') !== false) return 'https://www.dutchbanglabank.com/img/logo.png';
      if ($mobile->logo && file_exists(base_path('asset/images/' . $mobile->logo))) return \App\Support\Img::url('asset/images/' . $mobile->logo);
      return null;
  };
  // Data for the "copy all" buttons
  $banksForCopy = $bankPayments->map(function ($b) {
      return $b->only(['bank_name', 'account_name', 'account_number', 'routing_number', 'branch_name']);
  })->values();
  $mobilesForCopy = $mobilePayments->map(function ($m) {
      return ['company' => ucfirst($m->mobile_company), 'account_name' => $m->account_name, 'account_number' => $m->account_number, 'reference' => $m->reference];
  })->values();
?>
@section('content')

<section class="page-hero page-hero--compact">
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow eyebrow--light"><i class="fas fa-lock"></i> Secure payment</span>
      <h1 class="page-hero__title">Make a payment</h1>
      <p class="page-hero__lead">Pay by bank transfer or mobile banking, then send us the receipt on WhatsApp for confirmation.</p>
      <div class="page-hero__actions">
        <a href="#bank-section" class="btn-f btn-f--light"><i class="fas fa-building-columns"></i> Bank transfer</a>
        <a href="#mobile-section" class="btn-f btn-f--ghost-light"><i class="fas fa-mobile-screen"></i> Mobile banking</a>
      </div>
    </div>
  </div>
</section>

{{-- ========== Bank transfer ========== --}}
<section class="section section--muted" id="bank-section" aria-labelledby="bank-title">
  <div class="container">
    <div class="d-flex flex-wrap align-items-end justify-content-between mb-4" style="gap:1rem">
      <div class="section-head section-head--left mb-0">
        <span class="eyebrow"><i class="fas fa-building-columns"></i> Bank transfer</span>
        <h2 class="section-title mb-1" id="bank-title">Bank account details</h2>
        <p class="section-lead">Transfer to any of these accounts using your Order ID as the reference.</p>
      </div>
      @if($bankPayments->count())
      <button type="button" class="btn-f btn-f--outline btn-f--sm" data-copy-all="bank"><i class="fas fa-copy"></i> Copy all bank details</button>
      @endif
    </div>

    @if($bankPayments->count())
    <div class="pay-grid">
      @foreach($bankPayments as $bank)
      @php $logoUrl = $bankLogoFor($bank); @endphp
      <div class="pay-card">
        <div class="pay-card__head">
          <div class="pay-card__logo">
            @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="{{ $bank->bank_name }} logo" loading="lazy" decoding="async" referrerpolicy="no-referrer"
                 onerror="this.replaceWith(Object.assign(document.createElement('i'),{className:'fas fa-building-columns'}))">
            @else
            <i class="fas fa-building-columns"></i>
            @endif
          </div>
          <div>
            <h4>{{ $bank->bank_name }}</h4>
            <small>{{ $bank->account_type ?? 'Bank account' }}</small>
          </div>
        </div>
        <div class="pay-card__body">
          <div class="pay-row"><div><small>Account name</small><strong>{{ $bank->account_name }}</strong></div></div>
          <div class="pay-row">
            <div><small>Account number</small><strong>{{ $bank->account_number }}</strong></div>
            <button type="button" class="copy-btn" data-copy="{{ $bank->account_number }}"><i class="fas fa-copy"></i> Copy</button>
          </div>
          @if($bank->branch_name)
          <div class="pay-row">
            <div><small>Branch</small><strong>{{ $bank->branch_name }}</strong></div>
            <button type="button" class="copy-btn" data-copy="{{ $bank->branch_name }}"><i class="fas fa-copy"></i> Copy</button>
          </div>
          @endif
          @if($bank->routing_number)
          <div class="pay-row">
            <div><small>Routing number</small><strong>{{ $bank->routing_number }}</strong></div>
            <button type="button" class="copy-btn" data-copy="{{ $bank->routing_number }}"><i class="fas fa-copy"></i> Copy</button>
          </div>
          @endif
        </div>
        <div class="pay-card__foot">
          <button type="button" class="btn-f btn-f--dark btn-f--sm btn-f--block js-copy-bank"
                  data-account-name="{{ $bank->account_name }}"
                  data-account-number="{{ $bank->account_number }}"
                  data-routing-number="{{ $bank->routing_number }}"
                  data-branch-name="{{ $bank->branch_name }}"
                  data-bank-name="{{ $bank->bank_name }}">
            <i class="fas fa-copy"></i> Copy all details
          </button>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="note"><i class="fas fa-info-circle"></i><span>No bank payment methods are available right now.</span></div>
    @endif
  </div>
</section>

{{-- ========== Mobile banking ========== --}}
<section class="section" id="mobile-section" aria-labelledby="mobile-title">
  <div class="container">
    <div class="d-flex flex-wrap align-items-end justify-content-between mb-4" style="gap:1rem">
      <div class="section-head section-head--left mb-0">
        <span class="eyebrow"><i class="fas fa-mobile-screen"></i> Mobile banking</span>
        <h2 class="section-title mb-1" id="mobile-title">bKash, Nagad &amp; Rocket</h2>
        <p class="section-lead">Use "Send Money" to any of the numbers below.</p>
      </div>
      @if($mobilePayments->count())
      <button type="button" class="btn-f btn-f--outline btn-f--sm" data-copy-all="mobile"><i class="fas fa-copy"></i> Copy all mobile details</button>
      @endif
    </div>

    @if($mobilePayments->count())
    <div class="pay-grid">
      @foreach($mobilePayments as $mobile)
      @php $logoUrl = $mobileLogoFor($mobile); @endphp
      <div class="pay-card">
        <div class="pay-card__head">
          <div class="pay-card__logo">
            @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="{{ ucfirst($mobile->mobile_company) }} logo" loading="lazy" decoding="async" referrerpolicy="no-referrer"
                 onerror="this.replaceWith(Object.assign(document.createElement('i'),{className:'fas fa-mobile-screen'}))">
            @else
            <i class="fas fa-mobile-screen"></i>
            @endif
          </div>
          <div>
            <h4>{{ ucfirst($mobile->mobile_company) }}</h4>
            <small>Mobile banking</small>
          </div>
        </div>
        <div class="pay-card__body">
          <div class="pay-row">
            <div><small>Account number</small><strong style="font-size:1.15rem">{{ $mobile->account_number }}</strong></div>
            <button type="button" class="copy-btn" data-copy="{{ $mobile->account_number }}"><i class="fas fa-copy"></i> Copy</button>
          </div>
          <div class="pay-row"><div><small>Account name</small><strong>{{ $mobile->account_name }}</strong></div></div>
          @if($mobile->reference)
          <div class="pay-row"><div><small>Reference</small><strong>{{ $mobile->reference }}</strong></div></div>
          @endif
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="note"><i class="fas fa-info-circle"></i><span>No mobile banking methods are available right now.</span></div>
    @endif
  </div>
</section>

{{-- ========== Instructions ========== --}}
<section class="section section--muted section--tight">
  <div class="container">
    <div class="article-card">
      <h2 class="article-card__title"><i class="fas fa-clipboard-list text-brand"></i> Payment instructions</h2>
      <div class="row">
        <div class="col-md-6 mb-4">
          <h3 class="h5 mb-3">Bank transfer</h3>
          <ul class="check-list">
            <li>Log in to your bank account (mobile or internet banking)</li>
            <li>Add the bank account above as a payee</li>
            <li>Enter the exact payment amount</li>
            <li>Use your <strong>Order ID / invoice number</strong> as the reference</li>
            <li>Save the transaction receipt or a screenshot</li>
          </ul>
        </div>
        <div class="col-md-6 mb-4">
          <h3 class="h5 mb-3">Mobile banking</h3>
          <ul class="check-list">
            <li>Open your bKash, Nagad or Rocket app</li>
            <li>Choose "Send Money"</li>
            <li>Enter the number shown above</li>
            <li>Enter the exact amount</li>
            <li>Take a screenshot of the transaction</li>
          </ul>
        </div>
      </div>
      <div class="note note--warn">
        <i class="fas fa-triangle-exclamation"></i>
        <span><strong>Double-check the account number before sending.</strong> After paying, send the screenshot to
          <a href="https://wa.me/8801958666951" target="_blank" rel="noopener"><strong>01958666951</strong></a> on WhatsApp for confirmation.</span>
      </div>
      <div class="text-center mt-4">
        <button type="button" class="btn-f btn-f--primary" data-copy="https://www.felnadma.com/payment" data-copy-label="Payment link copied"><i class="fas fa-link"></i> Copy payment page link</button>
      </div>
    </div>
  </div>
</section>

@include('frontend.partials.article')

@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  var PAYMENT_LINK = 'https://www.felnadma.com/payment';
  var banks = @json($banksForCopy);
  var mobiles = @json($mobilesForCopy);

  function flash(btn) {
    if (!btn) return;
    var html = btn.innerHTML;
    btn.classList.add('is-copied');
    btn.innerHTML = '<i class="fas fa-check"></i> Copied';
    setTimeout(function () { btn.classList.remove('is-copied'); btn.innerHTML = html; }, 1600);
  }

  function copyText(text, btn) {
    var done = function () { flash(btn); };
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(text).then(done).catch(function () { fallback(text); done(); });
    } else {
      fallback(text);
      done();
    }
  }

  function fallback(text) {
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.setAttribute('readonly', '');
    ta.style.cssText = 'position:fixed;left:-9999px;top:0';
    document.body.appendChild(ta);
    ta.select();
    try { document.execCommand('copy'); } catch (e) {}
    document.body.removeChild(ta);
  }

  function bankText(b) {
    var t = 'Account Name: ' + b.account_name + '\nAccount Number: ' + b.account_number + '\n';
    if (b.routing_number) t += 'Routing Number: ' + b.routing_number + '\n';
    if (b.branch_name) t += 'Branch Name: ' + b.branch_name + '\n';
    return t + 'Bank Name: ' + b.bank_name + '\n';
  }

  document.addEventListener('click', function (e) {
    var single = e.target.closest('[data-copy]');
    if (single) { copyText(single.getAttribute('data-copy'), single); return; }

    var bankBtn = e.target.closest('.js-copy-bank');
    if (bankBtn) {
      var d = bankBtn.dataset;
      copyText('Payment Link: ' + PAYMENT_LINK + '\n\nBank Details\n=============\n' + bankText({
        account_name: d.accountName, account_number: d.accountNumber, routing_number: d.routingNumber,
        branch_name: d.branchName, bank_name: d.bankName
      }), bankBtn);
      return;
    }

    var all = e.target.closest('[data-copy-all]');
    if (all) {
      var text = 'Payment Link: ' + PAYMENT_LINK + '\n\n';
      if (all.getAttribute('data-copy-all') === 'bank') {
        text += 'BANK TRANSFER DETAILS\n=====================\n\n';
        banks.forEach(function (b) { text += bankText(b) + '\n-------------------------\n\n'; });
      } else {
        text += 'MOBILE BANKING DETAILS\n======================\n\n';
        mobiles.forEach(function (m) {
          text += 'Mobile Banking: ' + m.company + '\nAccount Name: ' + m.account_name + '\nAccount Number: ' + m.account_number + '\n';
          if (m.reference) text += 'Reference: ' + m.reference + '\n';
          text += '\n-------------------------\n\n';
        });
      }
      copyText(text, all);
    }
  });
})();
</script>
@endpush
