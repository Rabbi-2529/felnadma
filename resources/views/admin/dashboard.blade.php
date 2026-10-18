@extends('admin.layout.admin_master')

@section('content')
<?php
  $totalOrders = $totalOrders ?? 0;
  $pendingOrders = $pendingOrders ?? 0;
  $confirmedOrders = $confirmedOrders ?? 0;
  $todayOrders = $todayOrders ?? 0;
  $weekOrders = $weekOrders ?? 0;
  $monthOrders = $monthOrders ?? 0;
  $uniqueCustomers = $uniqueCustomers ?? 0;
  $otpSuccessRate = $otpSuccessRate ?? 0;
  $activePackages = $activePackages ?? 0;
  $servicePages = $servicePages ?? 0;
  $recentOrders = $recentOrders ?? collect();
  $recentOtp = $recentOtp ?? collect();
  $topPackages = $topPackages ?? collect();
  $orderTrend = $orderTrend ?? collect();

  $conversionRate = $totalOrders > 0 ? round($confirmedOrders / $totalOrders * 100) : 0;
  $trendMax = max(1, (int) $orderTrend->max('total'));
  $trendTotal = $orderTrend->sum('total');
  $topMax = max(1, (int) $topPackages->max('total_orders'));
  $statusClass = function ($status) {
    $status = strtolower((string) $status);
    return in_array($status, ['confirmed', 'verified', 'completed']) ? 'fd-status--ok'
      : (in_array($status, ['cancelled', 'canceled', 'failed', 'rejected']) ? 'fd-status--bad' : 'fd-status--wait');
  };
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="{{url('/admin/dashboard')}}" class="current"><i class="icon-home"></i> Dashboard</a></div>
  </div>

  <div class="container-fluid">

    {{-- Welcome --}}
    <section class="fd-hero">
      <div>
        <h2>Your bulk SMS business at a glance</h2>
        <p>
          @if($pendingOrders > 0)
            You have <strong>{{ $pendingOrders }} pending {{ \Illuminate\Support\Str::plural('order', $pendingOrders) }}</strong> waiting for confirmation.
          @else
            All caught up — no pending orders right now.
          @endif
          {{ $todayOrders }} new today.
        </p>
        <div class="fd-hero__actions">
          <a href="{{ url('/admin/view_order') }}"><i class="fa-solid fa-cart-shopping"></i> Review orders</a>
          <a href="{{ url('/admin/view_price_info') }}" class="is-ghost"><i class="fa-solid fa-tags"></i> Update rates</a>
        </div>
      </div>
      <div class="fd-bubbles" aria-hidden="true">
        <span class="fd-bubble fd-bubble--1"><i class="fa-solid fa-check-double"></i>{{ number_format($confirmedOrders) }} confirmed</span>
        <span class="fd-bubble fd-bubble--2"><i class="fa-solid fa-shield-halved"></i>OTP {{ $otpSuccessRate }}% verified</span>
        <span class="fd-bubble fd-bubble--3"><i class="fa-solid fa-users"></i>{{ number_format($uniqueCustomers) }} customers</span>
      </div>
    </section>

    {{-- KPIs --}}
    <div class="fd-kpis">
      <a class="fd-kpi fd-kpi--brand" href="{{ url('/admin/view_order') }}">
        <div class="fd-kpi__top"><span class="fd-kpi__label">Total orders</span><span class="fd-kpi__ico"><i class="fa-solid fa-cart-shopping"></i></span></div>
        <div class="fd-kpi__value">{{ number_format($totalOrders) }}</div>
        <div class="fd-kpi__note">{{ number_format($monthOrders) }} this month</div>
      </a>
      <a class="fd-kpi fd-kpi--amber" href="{{ url('/admin/filter_orders?status=pending') }}">
        <div class="fd-kpi__top"><span class="fd-kpi__label">Pending</span><span class="fd-kpi__ico"><i class="fa-solid fa-hourglass-half"></i></span></div>
        <div class="fd-kpi__value">{{ number_format($pendingOrders) }}</div>
        <div class="fd-kpi__note">Waiting for confirmation</div>
      </a>
      <a class="fd-kpi fd-kpi--sky" href="{{ url('/admin/filter_orders?status=confirmed') }}">
        <div class="fd-kpi__top"><span class="fd-kpi__label">Confirmed</span><span class="fd-kpi__ico"><i class="fa-solid fa-circle-check"></i></span></div>
        <div class="fd-kpi__value">{{ number_format($confirmedOrders) }}</div>
        <div class="fd-kpi__note">{{ $conversionRate }}% conversion</div>
      </a>
      <div class="fd-kpi fd-kpi--violet">
        <div class="fd-kpi__top"><span class="fd-kpi__label">Today</span><span class="fd-kpi__ico"><i class="fa-solid fa-bolt"></i></span></div>
        <div class="fd-kpi__value">{{ number_format($todayOrders) }}</div>
        <div class="fd-kpi__note">{{ number_format($weekOrders) }} this week</div>
      </div>
    </div>

    {{-- Trend + health --}}
    <div class="fd-grid">
      <div class="fd-card">
        <div class="fd-card__head">
          <h3><i class="fa-solid fa-chart-column"></i> Orders · last 14 days</h3>
          <a href="{{ url('/admin/view_order') }}">All orders →</a>
        </div>
        <div class="fd-card__body">
          <div class="fd-chart-sum">
            <div><small>Last 14 days</small><strong>{{ number_format($trendTotal) }}</strong></div>
            <div><small>Daily average</small><strong>{{ $orderTrend->count() ? round($trendTotal / $orderTrend->count(), 1) : 0 }}</strong></div>
          </div>
          <div class="fd-chart" role="img" aria-label="Orders per day for the last 14 days">
            @foreach($orderTrend as $day)
            <div class="fd-chart__col" title="{{ $day['label'] }}: {{ $day['total'] }} orders">
              <div class="fd-chart__bar {{ $day['total'] ? '' : 'is-zero' }}" style="height: {{ $day['total'] ? max(6, round($day['total'] / $trendMax * 150)) : 4 }}px">
                @if($day['total'])<span>{{ $day['total'] }}</span>@endif
              </div>
              <span class="fd-chart__label">{{ $day['label'] }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="fd-card">
        <div class="fd-card__head"><h3><i class="fa-solid fa-shield-halved"></i> OTP &amp; business health</h3></div>
        <div class="fd-card__body">
          <div class="fd-ring" style="--p: {{ $otpSuccessRate }}">
            <div class="fd-ring__inner"><div><strong>{{ $otpSuccessRate }}%</strong><small>OTP verified</small></div></div>
          </div>
          <ul class="fd-stat-list">
            <li><span><i class="fa-solid fa-users"></i>Customers</span><strong>{{ number_format($uniqueCustomers) }}</strong></li>
            <li><span><i class="fa-solid fa-percent"></i>Conversion rate</span><strong>{{ $conversionRate }}%</strong></li>
            <li><span><i class="fa-solid fa-box-open"></i>SMS packages</span><strong>{{ $activePackages }}</strong></li>
            <li><span><i class="fa-solid fa-comment-sms"></i>SMS service pages</span><strong>{{ $servicePages }}</strong></li>
          </ul>
        </div>
      </div>
    </div>

    {{-- Recent orders + top packages --}}
    <div class="fd-grid">
      <div class="fd-card">
        <div class="fd-card__head">
          <h3><i class="fa-solid fa-receipt"></i> Recent orders</h3>
          <a href="{{ url('/admin/view_order') }}">View all →</a>
        </div>
        <div class="fd-card__body fd-card__body--flush">
          @if($recentOrders->count())
          <table class="fd-table">
            <thead><tr><th>Order</th><th>Customer</th><th>Package</th><th>Status</th><th></th></tr></thead>
            <tbody>
              @foreach($recentOrders as $order)
              <tr>
                <td><strong>{{ $order->order_id ?? '#'.$order->id }}</strong><small>{{ optional($order->created_at)->format('d M, h:i A') }}</small></td>
                <td>{{ $order->client_name ?? 'N/A' }}<small>{{ $order->client_phone }}</small></td>
                <td>{{ $order->package_name ?? 'N/A' }}<small>{{ $order->client_district }}</small></td>
                <td><span class="fd-status {{ $statusClass($order->order_status) }}">{{ ucfirst($order->order_status ?? 'pending') }}</span></td>
                <td><a href="{{ url('/admin/order_details/'.$order->id) }}" class="btn btn-mini" title="View order"><i class="fa-solid fa-eye"></i></a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="fd-empty"><i class="fa-solid fa-inbox"></i>No orders yet</div>
          @endif
        </div>
      </div>

      <div class="fd-card">
        <div class="fd-card__head">
          <h3><i class="fa-solid fa-ranking-star"></i> Top packages</h3>
          <a href="{{ url('/admin/view_package') }}">Manage →</a>
        </div>
        <div class="fd-card__body">
          @if($topPackages->count())
          <div class="fd-pkg">
            @foreach($topPackages as $package)
            <div class="fd-pkg__row">
              <strong>{{ $package->package_name }}</strong>
              <span>{{ $package->total_orders }} {{ \Illuminate\Support\Str::plural('order', $package->total_orders) }}</span>
              <div class="fd-pkg__bar"><span style="width: {{ round($package->total_orders / $topMax * 100) }}%"></span></div>
            </div>
            @endforeach
          </div>
          @else
          <div class="fd-empty"><i class="fa-solid fa-chart-simple"></i>No package orders yet</div>
          @endif
        </div>
      </div>
    </div>

    {{-- OTP verifications --}}
    <div class="fd-card" style="margin-bottom:18px">
      <div class="fd-card__head">
        <h3><i class="fa-solid fa-key"></i> Latest OTP verifications</h3>
        <a href="{{ url('/admin/view_order') }}">View all →</a>
      </div>
      <div class="fd-card__body fd-card__body--flush">
        @if($recentOtp->count())
        <table class="fd-table">
          <thead><tr><th>Order</th><th>Customer</th><th>Phone</th><th>OTP status</th><th>Date</th></tr></thead>
          <tbody>
            @foreach($recentOtp as $otp)
            <tr>
              <td><strong>{{ $otp->order_id ?? '#'.$otp->id }}</strong></td>
              <td>{{ $otp->client_name ?? 'N/A' }}</td>
              <td>{{ $otp->client_phone ?? 'N/A' }}</td>
              <td><span class="fd-status {{ $statusClass($otp->otp_status) }}">{{ ucfirst($otp->otp_status ?? 'pending') }}</span></td>
              <td>{{ optional($otp->created_at)->format('d M Y, h:i A') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="fd-empty"><i class="fa-solid fa-shield-halved"></i>No OTP verifications yet</div>
        @endif
      </div>
    </div>

    {{-- Quick actions --}}
    <div class="fd-card" style="margin-bottom:10px">
      <div class="fd-card__head"><h3><i class="fa-solid fa-bolt"></i> Quick actions</h3></div>
      <div class="fd-card__body">
        <div class="fd-actions">
          <a class="fd-action" href="{{ url('/admin/view_order') }}"><i class="fa-solid fa-cart-shopping"></i> Orders</a>
          <a class="fd-action" href="{{ url('/admin/view_price_info') }}"><i class="fa-solid fa-tags"></i> SMS rates</a>
          <a class="fd-action" href="{{ url('/admin/add_sms_service_page') }}"><i class="fa-solid fa-comment-sms"></i> New SMS page</a>
          <a class="fd-action" href="{{ url('/admin/add_meta_tag') }}"><i class="fa-solid fa-hashtag"></i> Meta tags</a>
          <a class="fd-action" href="{{ url('/admin/add_article') }}"><i class="fa-solid fa-newspaper"></i> Add article</a>
          <a class="fd-action" href="{{ url('/admin/view_special_offer') }}"><i class="fa-solid fa-gift"></i> Special offer</a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
