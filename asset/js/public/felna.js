/* Felna DMA — site-wide behaviour (requires jQuery + Bootstrap 4 bundle) */
(function ($) {
  'use strict';

  var doc = document.documentElement;

  /* ---------- Sticky header shadow ---------- */
  var header = document.getElementById('siteHeader');
  if (header) {
    var onScroll = function () { header.classList.toggle('is-scrolled', window.scrollY > 8); };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---------- Mobile navigation ---------- */
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('navMain');
  function setNav(open) {
    doc.classList.toggle('nav-open', open);
    if (toggle) {
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    }
  }
  if (toggle && nav) {
    toggle.addEventListener('click', function () { setNav(!doc.classList.contains('nav-open')); });
    nav.addEventListener('click', function (e) { if (e.target.closest('a, button')) setNav(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setNav(false); });
    window.addEventListener('resize', function () { if (window.innerWidth >= 1200) setNav(false); });
  }

  /* ---------- Warm up lazy images inside carousels after load ---------- */
  window.addEventListener('load', function () {
    document.querySelectorAll('.carousel img[loading="lazy"]').forEach(function (img) {
      img.loading = 'eager';
    });
  });

  /* ---------- Shared helpers ---------- */
  window.Felna = window.Felna || {};
  window.Felna.isBdPhone = function (value) { return /^01[3-9]\d{8}$/.test(value); };
  window.Felna.digitsOnly = function (input, max) {
    input.addEventListener('input', function () {
      var v = this.value.replace(/\D/g, '');
      if (max && v.length > max) v = v.slice(0, max);
      if (v !== this.value) this.value = v;
    });
  };
  function setFieldError(field, hasError) {
    if (field) field.classList.toggle('has-error', !!hasError);
  }
  window.Felna.setFieldError = setFieldError;

  /* ---------- Call request form (header modal) ---------- */
  var form = document.getElementById('callRequestForm');
  if (form) {
    var phone = document.getElementById('cr_phone');
    var name = document.getElementById('cr_name');
    var reason = document.getElementById('cr_reason');
    var details = document.getElementById('cr_details');
    var counter = document.getElementById('cr_counter');
    var hint = document.getElementById('cr_details_hint');
    var MAX = 70;
    var allowed = /[^A-Za-z0-9\s.,!?\-_()@#$%&*+=:;"'\/]/g;

    window.Felna.digitsOnly(phone, 11);

    phone.addEventListener('input', function () {
      var v = phone.value;
      phone.classList.toggle('is-valid', window.Felna.isBdPhone(v));
      if (v.length === 11) setFieldError(form.querySelector('[data-field="phone"]'), !window.Felna.isBdPhone(v));
      else setFieldError(form.querySelector('[data-field="phone"]'), false);
    });
    name.addEventListener('input', function () {
      name.classList.toggle('is-valid', name.value.trim().length >= 3);
      setFieldError(form.querySelector('[data-field="name"]'), false);
    });
    reason.addEventListener('change', function () {
      setFieldError(form.querySelector('[data-field="reason"]'), !reason.value);
    });

    var updateCounter = function () {
      var len = details.value.length;
      counter.textContent = len + ' / ' + MAX;
      counter.classList.toggle('is-warn', len >= MAX - 10 && len < MAX);
      counter.classList.toggle('is-max', len >= MAX);
    };
    var cleanDetails = function () {
      var cleaned = details.value.replace(allowed, '');
      if (cleaned !== details.value) {
        details.value = cleaned.slice(0, MAX);
        hint.style.color = '#dc2626';
        clearTimeout(cleanDetails.t);
        cleanDetails.t = setTimeout(function () { hint.style.color = ''; }, 1800);
      }
      if (details.value.length > MAX) details.value = details.value.slice(0, MAX);
      updateCounter();
    };
    details.addEventListener('input', cleanDetails);
    details.addEventListener('paste', function () { setTimeout(cleanDetails, 0); });
    updateCounter();

    form.addEventListener('submit', function (e) {
      var errors = [];
      if (!window.Felna.isBdPhone(phone.value.trim())) errors.push(['phone', phone]);
      if (name.value.trim().length < 3) errors.push(['name', name]);
      if (!reason.value) errors.push(['reason', reason]);

      ['phone', 'name', 'reason'].forEach(function (key) {
        setFieldError(form.querySelector('[data-field="' + key + '"]'), errors.some(function (x) { return x[0] === key; }));
      });

      if (errors.length) {
        e.preventDefault();
        errors[0][1].focus();
        return;
      }

      var btn = form.querySelector('button[type="submit"]');
      btn.disabled = true;
      btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    });

    $('#callRequ').on('shown.bs.modal', function () { phone.focus(); });
  }

  /* ---------- Generic phone inputs on page forms ---------- */
  document.querySelectorAll('form[data-bd-phone]').forEach(function (f) {
    var input = f.querySelector('input[type="tel"]');
    if (!input) return;
    var field = input.closest('.field');
    window.Felna.digitsOnly(input, 11);
    input.addEventListener('input', function () {
      input.classList.toggle('is-valid', window.Felna.isBdPhone(input.value));
      if (input.value.length === 11) setFieldError(field, !window.Felna.isBdPhone(input.value));
      else setFieldError(field, false);
    });
    f.addEventListener('submit', function (e) {
      if (!window.Felna.isBdPhone(input.value)) {
        e.preventDefault();
        setFieldError(field, true);
        input.focus();
        return;
      }
      var btn = f.querySelector('button[type="submit"]');
      if (btn && f.checkValidity()) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
      }
    });
  });
})(jQuery);
