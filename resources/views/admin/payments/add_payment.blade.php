@extends('admin.layout.admin_master')

@section('content')

<div id="content">

  <div id="content-header">
    <div id="breadcrumb">
      <a href="index.html" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a>
      <a href="#">Payments</a>
      <a href="#" class="current">Add Payment Method</a>
    </div>

    <h1>Add Payment Method</h1>
  </div>

  <div class="container-fluid">
    <hr>

    <div class="row-fluid">
      <div class="span12">

        {{-- Validation errors --}}
        @if ($errors->any())
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Please fix the following:</strong>
            <ul style="margin:8px 0 0 18px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="widget-box">

          <div class="widget-title">
            <span class="icon">
              <i class="icon-info-sign"></i>
            </span>
            <h5>Add Payment Method</h5>
          </div>

          <div class="widget-content nopadding">

            <form
              class="form-horizontal"
              method="post"
              action="{{ url('/admin/add_payment') }}"
              name="basic_validate"
              novalidate="novalidate"
              enctype="multipart/form-data"
            >

              @csrf

              <div class="control-group">
                <label class="control-label">Account Name</label>
                <div class="controls">
                  <input type="text" name="account_name" value="{{ old('account_name') }}" required>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Account Number</label>
                <div class="controls">
                  <input type="text" name="account_number" value="{{ old('account_number') }}" required>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Bank Name / Mobile Company</label>
                <div class="controls">
                  <input type="text" name="bank_name" value="{{ old('bank_name') }}" required>
                </div>
              </div>

              <div class="control-group" id="routing_number_div">
                <label class="control-label">Routing Number</label>
                <div class="controls">
                  <input
                    type="text"
                    name="routing_number"
                    id="routing_number"
                    placeholder="Enter routing number"
                    value="{{ old('routing_number') }}"
                  >
                </div>
              </div>

              <div class="control-group" id="branch_name_div">
                <label class="control-label">Branch Name</label>
                <div class="controls">
                  <input
                    type="text"
                    name="branch_name"
                    id="branch_name"
                    placeholder="Enter branch name"
                    value="{{ old('branch_name') }}"
                  >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Payment Type</label>
                <div class="controls">
                  <select name="type" id="payment_type" required>
                    <option value="bank"   {{ old('type') == 'bank'   ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="mobile" {{ old('type') == 'mobile' ? 'selected' : '' }}>Mobile Banking</option>
                  </select>
                </div>
              </div>

              <div
                class="control-group"
                id="mobile_company_div"
                style="display:none;"
              >
                <label class="control-label">Mobile Company</label>
                <div class="controls">
                  <select name="mobile_company">
                    <option value="bkash"  {{ old('mobile_company') == 'bkash'  ? 'selected' : '' }}>bKash</option>
                    <option value="nagad"  {{ old('mobile_company') == 'nagad'  ? 'selected' : '' }}>Nagad</option>
                    <option value="rocket" {{ old('mobile_company') == 'rocket' ? 'selected' : '' }}>Rocket (DBBL)</option>
                  </select>
                </div>
              </div>

              {{-- ========== LOGO UPLOAD ========== --}}
              <div class="control-group">
                <label class="control-label">Logo (optional)</label>
                <div class="controls">
                  <input type="file" name="logo" id="logo" accept="image/*">
                  <span class="help-block" style="margin-top:6px;color:#888;">
                    JPG, PNG, WEBP or SVG. Max 2 MB. Stored in <code>asset/images/</code>.
                  </span>

                  <div id="logo_preview_wrap" style="display:none;margin-top:10px;">
                    <img id="logo_preview" src="" alt="Preview"
                         style="max-height:70px;max-width:160px;object-fit:contain;border:1px solid #ddd;border-radius:4px;padding:4px;background:#fff;">
                  </div>
                </div>
              </div>
              {{-- ========== /LOGO UPLOAD ========== --}}

              <div class="control-group">
                <label class="control-label">Order By</label>
                <div class="controls">
                  <input type="number" name="order_by" value="{{ old('order_by', 0) }}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                  <select name="status">
                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                  </select>
                </div>
              </div>

              <div class="form-actions">
                <input
                  type="submit"
                  value="Add Payment Method"
                  class="btn btn-success"
                >
              </div>

            </form>

          </div>

        </div>

      </div>
    </div>

  </div>

</div>

<script>
(function () {
  'use strict';

  var typeSel       = document.getElementById('payment_type');
  var mobileDiv     = document.getElementById('mobile_company_div');
  var routingDiv    = document.getElementById('routing_number_div');
  var branchDiv     = document.getElementById('branch_name_div');
  var routingInput  = document.getElementById('routing_number');
  var branchInput   = document.getElementById('branch_name');

  function toggleTypeFields() {
    if (typeSel.value === 'mobile') {
      mobileDiv.style.display  = 'block';
      routingDiv.style.display = 'none';
      branchDiv.style.display  = 'none';
      routingInput.value = '';
      branchInput.value  = '';
    } else {
      mobileDiv.style.display  = 'none';
      routingDiv.style.display = 'block';
      branchDiv.style.display  = 'block';
    }
  }

  typeSel.addEventListener('change', toggleTypeFields);
  toggleTypeFields(); // run on load (respects old() values)

  // ========== Logo preview ==========
  var logoInput = document.getElementById('logo');
  var previewWrap = document.getElementById('logo_preview_wrap');
  var previewImg  = document.getElementById('logo_preview');

  if (logoInput) {
    logoInput.addEventListener('change', function () {
      var file = this.files && this.files[0];
      if (!file) {
        previewWrap.style.display = 'none';
        previewImg.src = '';
        return;
      }
      var reader = new FileReader();
      reader.onload = function (e) {
        previewImg.src = e.target.result;
        previewWrap.style.display = 'block';
      };
      reader.readAsDataURL(file);
    });
  }
})();
</script>

@endsection