{{--
  Lead form modal posting to frontend.contentCallRequest (client_name, client_phone, client_text).
  Params: id, title, subtitle, icon, textLabel, textPlaceholder, textIcon, multiline (bool), submitLabel
--}}
<div class="modal fade modal-f" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="ico"><i class="{{ $icon ?? 'fas fa-envelope' }}"></i></div>
        <div>
          <h4 class="modal-title" id="{{ $id }}Label">{{ $title }}</h4>
          <p class="modal-sub">{{ $subtitle ?? "We'll get back to you within 24 hours" }}</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method="POST" action="{{ route('frontend.contentCallRequest') }}" data-bd-phone>
        @csrf
        <div class="modal-body">
          <div class="field">
            <label for="{{ $id }}_name">Full name <span class="req">*</span></label>
            <div class="input-icon">
              <input type="text" class="form-control" id="{{ $id }}_name" name="client_name" maxlength="100" autocomplete="name" required placeholder="Your full name">
              <i class="fas fa-user"></i>
            </div>
          </div>
          <div class="field">
            <label for="{{ $id }}_phone">Phone number <span class="req">*</span></label>
            <div class="input-icon">
              <input type="tel" class="form-control" id="{{ $id }}_phone" name="client_phone" inputmode="numeric" autocomplete="tel" maxlength="11" pattern="01[3-9][0-9]{8}" required placeholder="01XXXXXXXXX">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <div class="field-error">Enter a valid 11-digit Bangladeshi number (01XXXXXXXXX).</div>
          </div>
          <div class="field">
            <label for="{{ $id }}_text">{{ $textLabel }} <span class="req">*</span></label>
            <div class="input-icon {{ !empty($multiline) ? 'input-icon--top' : '' }}">
              @if(!empty($multiline))
              <textarea class="form-control" id="{{ $id }}_text" name="client_text" rows="4" maxlength="500" required placeholder="{{ $textPlaceholder }}"></textarea>
              @else
              <input type="text" class="form-control" id="{{ $id }}_text" name="client_text" maxlength="500" required placeholder="{{ $textPlaceholder }}">
              @endif
              <i class="{{ $textIcon ?? 'fas fa-comment' }}"></i>
            </div>
          </div>
          <label class="check-f mb-0">
            <input type="checkbox" required>
            <span>I agree to the <a href="{{ url('/terms') }}" target="_blank">terms and privacy policy</a></span>
          </label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-f btn-f--outline btn-f--sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn-f btn-f--primary btn-f--sm"><i class="fas fa-paper-plane"></i> {{ $submitLabel ?? 'Send message' }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
