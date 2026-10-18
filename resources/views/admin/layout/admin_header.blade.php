<?php
  $adminName = Session::get('adminSession') ?: 'Admin';
  $hour = (int) now()->format('G');
  $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
?>
<!--Top bar-->
<header class="fa-topbar">
  <button type="button" class="fa-burger" data-fa-burger aria-label="Open menu"><i class="fa-solid fa-bars"></i></button>
  <div class="fa-topbar__hello">
    <small>{{ $greeting }} 👋</small>
    <strong>{{ $adminName }}</strong>
  </div>

  <div class="fa-topbar__actions">
    <a class="fa-iconbtn" href="{{ url('/admin/view_order') }}" title="Orders">
      <i class="fa-solid fa-bell"></i>
      @if(!empty($faPendingOrders))
      <span class="fa-pill">{{ $faPendingOrders > 99 ? '99+' : $faPendingOrders }}</span>
      @endif
    </a>
    <a class="fa-chip-btn" href="{{ url('/') }}" target="_blank" rel="noopener" title="View website"><i class="fa-solid fa-arrow-up-right-from-square"></i> <span>View site</span></a>
    <details class="fa-user">
      <summary>
        <span class="fa-avatar">{{ mb_substr($adminName, 0, 1) }}</span>
        <span class="fa-user__name">{{ $adminName }}</span>
        <i class="fa-solid fa-chevron-down" style="font-size:10px;color:#94a3b8"></i>
      </summary>
      <div class="fa-user__menu">
        <a href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
        <a href="{{ url('/admin/settings') }}"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="{{ url('/logout') }}" class="is-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
      </div>
    </details>
  </div>
</header>
<!--close Top bar-->
