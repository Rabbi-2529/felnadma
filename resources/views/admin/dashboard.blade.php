@extends('admin.layout.admin_master')

@section('content')
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="#" class="current">Dashboard</a>
        </div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
      
        <!-- Statistics Cards - Enhanced Grid -->
        <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin-bottom: 35px;">
            <div class="stat-card" onclick="window.location='{{ url('/admin/view_order') }}'" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; padding: 25px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <div class="stat-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="icon-shopping-cart" style="font-size: 30px; color: white;"></i>
                    </div>
                    <div class="stat-value" style="color: white; font-size: 36px; font-weight: bold;">
                        @php
                            $totalOrders = isset($totalOrders) ? $totalOrders : 0;
                        @endphp
                        {{ number_format($totalOrders) }}
                    </div>
                </div>
                <div class="stat-label" style="color: rgba(255,255,255,0.9); font-size: 16px; margin-top: 15px;">Total Orders</div>
            </div>

            <div class="stat-card" onclick="window.location='{{ url('/admin/view_order?status=pending') }}'" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 20px; padding: 25px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <div class="stat-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="icon-time" style="font-size: 30px; color: white;"></i>
                    </div>
                    <div class="stat-value" style="color: white; font-size: 36px; font-weight: bold;">
                        @php
                            $pendingOrders = isset($pendingOrders) ? $pendingOrders : 0;
                        @endphp
                        {{ number_format($pendingOrders) }}
                    </div>
                </div>
                <div class="stat-label" style="color: rgba(255,255,255,0.9); font-size: 16px; margin-top: 15px;">Pending Orders</div>
            </div>

            <div class="stat-card" onclick="window.location='{{ url('/admin/view_order?status=confirmed') }}'" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 20px; padding: 25px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <div class="stat-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="icon-check" style="font-size: 30px; color: white;"></i>
                    </div>
                    <div class="stat-value" style="color: white; font-size: 36px; font-weight: bold;">
                        @php
                            $confirmedOrders = isset($confirmedOrders) ? $confirmedOrders : 0;
                        @endphp
                        {{ number_format($confirmedOrders) }}
                    </div>
                </div>
                <div class="stat-label" style="color: rgba(255,255,255,0.9); font-size: 16px; margin-top: 15px;">Confirmed Orders</div>
            </div>

            <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 20px; padding: 25px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <div class="stat-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="stat-icon" style="background: rgba(255,255,255,0.2); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="icon-money" style="font-size: 30px; color: white;"></i>
                    </div>
                    <div class="stat-value" style="color: white; font-size: 36px; font-weight: bold;">
                        @php
                            $totalRevenue = isset($totalRevenue) ? $totalRevenue : 0;
                        @endphp
                        ${{ number_format($totalRevenue, 2) }}
                    </div>
                </div>
                <div class="stat-label" style="color: rgba(255,255,255,0.9); font-size: 16px; margin-top: 15px;">Total Revenue</div>
            </div>
        </div>

        <!-- Dashboard Grid - Modern Cards -->
        <div class="dashboard-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 30px; margin-bottom: 35px;">
            <!-- Recent Orders -->
            <div class="dashboard-card" style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); overflow: hidden; transition: all 0.3s ease;">
                <div class="card-header" style="background: white; padding: 20px 25px; border-bottom: 2px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748;"><i class="icon-list" style="margin-right: 8px; color: #667eea;"></i> Recent Orders</h3>
                    <a href="{{ url('/admin/view_order') }}" style="color: #667eea; text-decoration: none; font-size: 13px; font-weight: 500;">View All →</a>
                </div>
                <div class="card-body" style="padding: 0;">
                    @php
                        $recentOrders = isset($recentOrders) && count($recentOrders) > 0 ? $recentOrders : collect();
                    @endphp
                    
                    @if($recentOrders->count() > 0)
                        <div class="modern-table" style="overflow-x: auto;">
                            <table class="table" style="width: 100%; border-collapse: collapse;">
                                <thead style="background: #f8fafc;">
                                    <tr>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Order ID</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Customer</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Package</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Amount</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Status</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr style="border-bottom: 1px solid #edf2f7;">
                                        <td style="padding: 12px 15px;"><strong style="color: #2d3748;">{{ $order->order_id ?? '#' . $order->id }}</strong></td>
                                        <td style="padding: 12px 15px;">
                                            {{ $order->client_name ?? 'N/A' }}<br>
                                            <small style="color:#a0aec0;">{{ $order->client_phone ?? '' }}</small>
                                        </td>
                                        <td style="padding: 12px 15px; color: #4a5568;">{{ $order->package_name ?? 'N/A' }}</td>
                                        <td style="padding: 12px 15px; color: #4a5568;">${{ number_format($order->package_price ?? 0, 2) }}</td>
                                        <td style="padding: 12px 15px;">
                                            <span class="badge" style="background: {{ ($order->order_status ?? 'pending') == 'confirmed' ? '#48bb78' : '#ed8936' }}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                                {{ ucfirst($order->order_status ?? 'pending') }}
                                            </span>
                                        </td>
                                        <td style="padding: 12px 15px;">
                                            <a href="{{ url('/admin/order_details/'.$order->id) }}" style="color: #667eea; text-decoration: none;">
                                                <i class="icon-eye-open"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state" style="padding: 60px 20px; text-align: center;">
                            <i class="icon-inbox" style="font-size: 48px; color: #cbd5e0;"></i>
                            <p style="color: #a0aec0; margin: 15px 0;">No orders found in the system</p>
                            <a href="{{ url('/admin/view_order') }}" style="background: #667eea; color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 13px;">View All Orders</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- OTP Verifications -->
            <div class="dashboard-card" style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); overflow: hidden; transition: all 0.3s ease;">
                <div class="card-header" style="background: white; padding: 20px 25px; border-bottom: 2px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748;"><i class="icon-envelope" style="margin-right: 8px; color: #667eea;"></i> OTP Verifications</h3>
                    <a href="{{ url('/admin/view_order') }}" style="color: #667eea; text-decoration: none; font-size: 13px; font-weight: 500;">View All →</a>
                </div>
                <div class="card-body" style="padding: 0;">
                    @php
                        $recentOtp = isset($recentOtp) && count($recentOtp) > 0 ? $recentOtp : collect();
                    @endphp
                    
                    @if($recentOtp->count() > 0)
                        <div class="modern-table" style="overflow-x: auto;">
                            <table class="table" style="width: 100%; border-collapse: collapse;">
                                <thead style="background: #f8fafc;">
                                    <tr>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Order ID</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Customer</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Phone</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">OTP Code</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Status</th>
                                        <th style="padding: 15px; text-align: left; font-size: 13px; font-weight: 600; color: #4a5568;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOtp as $otp)
                                    <tr style="border-bottom: 1px solid #edf2f7;">
                                        <td style="padding: 12px 15px; color: #2d3748;">{{ $otp->order_id ?? '#' . $otp->id }}</td>
                                        <td style="padding: 12px 15px; color: #4a5568;">{{ $otp->client_name ?? 'N/A' }}</td>
                                        <td style="padding: 12px 15px; color: #4a5568;">{{ $otp->client_phone ?? 'N/A' }}</td>
                                        <td style="padding: 12px 15px;"><code style="background: #fef5e7; padding: 4px 8px; border-radius: 6px;">{{ $otp->otp_code ?? 'N/A' }}</code></td>
                                        <td style="padding: 12px 15px;">
                                            <span class="badge" style="background: {{ ($otp->otp_status ?? 'pending') == 'verified' ? '#48bb78' : '#ed8936' }}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                                                {{ ucfirst($otp->otp_status ?? 'pending') }}
                                            </span>
                                        </td>
                                        <td style="padding: 12px 15px; color: #718096;">{{ isset($otp->created_at) ? $otp->created_at->format('d M Y') : date('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state" style="padding: 60px 20px; text-align: center;">
                            <i class="icon-shield" style="font-size: 48px; color: #cbd5e0;"></i>
                            <p style="color: #a0aec0; margin: 15px 0;">No OTP verifications found</p>
                            <a href="{{ url('/order_request') }}" style="background: #667eea; color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 13px;">Create New Order</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="dashboard-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 30px; margin-bottom: 35px;">
            <!-- Popular Packages -->
            <div class="dashboard-card" style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); overflow: hidden;">
                <div class="card-header" style="background: white; padding: 20px 25px; border-bottom: 2px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748;"><i class="icon-gift" style="margin-right: 8px; color: #667eea;"></i> Popular Packages</h3>
                    <a href="{{ url('/admin/view_package') }}" style="color: #667eea; text-decoration: none; font-size: 13px; font-weight: 500;">Manage →</a>
                </div>
                <div class="card-body" style="padding: 0;">
                    @php
                        $topPackages = isset($topPackages) && count($topPackages) > 0 ? $topPackages : collect();
                    @endphp
                    
                    @if($topPackages->count() > 0)
                        <div style="padding: 20px;">
                            @foreach($topPackages as $package)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #edf2f7;">
                                <div>
                                    <strong style="color: #2d3748;">{{ $package->package_name ?? $package->name ?? 'N/A' }}</strong>
                                    <div style="font-size: 12px; color: #a0aec0; margin-top: 4px;">{{ $package->total_orders ?? $package->sales_count ?? '0' }} orders sold</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: bold; color: #2d3748;">${{ number_format($package->total_revenue ?? $package->revenue ?? 0, 2) }}</div>
                                    <div style="font-size: 12px;"><span style="background: #48bb78; color: white; padding: 2px 8px; border-radius: 12px;">Active</span></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state" style="padding: 60px 20px; text-align: center;">
                            <i class="icon-chart" style="font-size: 48px; color: #cbd5e0;"></i>
                            <p style="color: #a0aec0; margin: 15px 0;">No package data available</p>
                            <a href="{{ url('/admin/add_package') }}" style="background: #667eea; color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 13px;">Add New Package</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Statistics - Improved Design -->
            <div class="dashboard-card" style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); overflow: hidden;">
                <div class="card-header" style="background: white; padding: 20px 25px; border-bottom: 2px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748;"><i class="icon-stats" style="margin-right: 8px; color: #667eea;"></i> Quick Statistics</h3>
                    <i class="icon-calendar" style="color: #cbd5e0;"></i>
                </div>
                <div class="card-body" style="padding: 20px;">
                    @php
                        $todayOrders = isset($todayOrders) ? $todayOrders : 0;
                        $weekOrders = isset($weekOrders) ? $weekOrders : 0;
                        $monthOrders = isset($monthOrders) ? $monthOrders : 0;
                        $otpSuccessRate = isset($otpSuccessRate) ? $otpSuccessRate : 0;
                        $activePackages = isset($activePackages) ? $activePackages : 0;
                        $uniqueCustomers = isset($uniqueCustomers) ? $uniqueCustomers : 0;
                        $totalOrdersStat = isset($totalOrders) ? $totalOrders : 0;
                        $confirmedOrdersStat = isset($confirmedOrders) ? $confirmedOrders : 0;
                        $conversionRate = $totalOrdersStat > 0 ? round(($confirmedOrdersStat / $totalOrdersStat) * 100) : 0;
                    @endphp
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; padding: 20px; text-align: center; color: white;">
                                <div style="font-size: 28px; font-weight: bold;">{{ $todayOrders }}</div>
                                <div style="font-size: 13px; opacity: 0.9;">Today's Orders</div>
                            </div>
                        </div>
                        <div>
                            <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 15px; padding: 20px; text-align: center; color: white;">
                                <div style="font-size: 28px; font-weight: bold;">{{ $weekOrders }}</div>
                                <div style="font-size: 13px; opacity: 0.9;">This Week</div>
                            </div>
                        </div>
                        <div>
                            <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 15px; padding: 20px; text-align: center; color: white;">
                                <div style="font-size: 28px; font-weight: bold;">{{ $monthOrders }}</div>
                                <div style="font-size: 13px; opacity: 0.9;">This Month</div>
                            </div>
                        </div>
                        <div>
                            <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 15px; padding: 20px; text-align: center; color: white;">
                                <div style="font-size: 28px; font-weight: bold;">{{ $otpSuccessRate }}%</div>
                                <div style="font-size: 13px; opacity: 0.9;">OTP Success Rate</div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 25px; padding-top: 20px; border-top: 2px solid #f0f2f5;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                            <span style="color: #718096;">Active Packages</span>
                            <strong style="color: #2d3748; font-size: 18px;">{{ $activePackages }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                            <span style="color: #718096;">Total Customers</span>
                            <strong style="color: #2d3748; font-size: 18px;">{{ $uniqueCustomers }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #718096;">Conversion Rate</span>
                            <strong style="color: #2d3748; font-size: 18px;">{{ $conversionRate }}%</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Menu - Modern Grid -->
        <div class="quick-actions" style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 35px;">
            <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600; color: #2d3748;"><i class="icon-bolt" style="margin-right: 8px; color: #667eea;"></i> Quick Actions</h3>
            <div class="actions-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                <a href="{{ url('/admin/view_order') }}" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px; border-radius: 12px; text-align: center; text-decoration: none; transition: transform 0.3s ease; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <i class="icon-shopping-cart" style="font-size: 20px;"></i>
                    <span style="font-size: 13px;">View Orders</span>
                </a>
                <a href="{{ url('/admin/add_package') }}" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 12px; border-radius: 12px; text-align: center; text-decoration: none; transition: transform 0.3s ease; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <i class="icon-gift" style="font-size: 20px;"></i>
                    <span style="font-size: 13px;">Add Package</span>
                </a>
                <a href="{{ url('/admin/add_article') }}" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 12px; border-radius: 12px; text-align: center; text-decoration: none; transition: transform 0.3s ease; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <i class="icon-file" style="font-size: 20px;"></i>
                    <span style="font-size: 13px;">Add Article</span>
                </a>
                <a href="{{ url('/admin/add_slider') }}" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 12px; border-radius: 12px; text-align: center; text-decoration: none; transition: transform 0.3s ease; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <i class="icon-picture" style="font-size: 20px;"></i>
                    <span style="font-size: 13px;">Manage Slider</span>
                </a>
                <a href="{{ url('/admin/add_meta_tag') }}" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; padding: 12px; border-radius: 12px; text-align: center; text-decoration: none; transition: transform 0.3s ease; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <i class="icon-tag" style="font-size: 20px;"></i>
                    <span style="font-size: 13px;">Meta Tags</span>
                </a>
                <a href="{{ url('/admin/settings') }}" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #2d3748; padding: 12px; border-radius: 12px; text-align: center; text-decoration: none; transition: transform 0.3s ease; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                    <i class="icon-cog" style="font-size: 20px;"></i>
                    <span style="font-size: 13px;">Settings</span>
                </a>
            </div>
        </div>

        <!-- System Information - Improved -->
        <div class="dashboard-card" style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); overflow: hidden; margin-bottom: 30px;">
            <div class="card-header" style="background: white; padding: 20px 25px; border-bottom: 2px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748;"><i class="icon-info-sign" style="margin-right: 8px; color: #667eea;"></i> System Information</h3>
                <i class="icon-dashboard" style="color: #cbd5e0;"></i>
            </div>
            <div class="card-body" style="padding: 25px;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <div style="background: #f8fafc; padding: 15px; border-radius: 12px;">
                        <strong style="color: #2d3748;">Laravel Version:</strong>
                        <span style="color: #718096; margin-left: 10px;">{{ app()->version() }}</span>
                    </div>
                    <div style="background: #f8fafc; padding: 15px; border-radius: 12px;">
                        <strong style="color: #2d3748;">PHP Version:</strong>
                        <span style="color: #718096; margin-left: 10px;">{{ phpversion() }}</span>
                    </div>
                    <div style="background: #f8fafc; padding: 15px; border-radius: 12px;">
                        <strong style="color: #2d3748;">Server Time:</strong>
                        <span style="color: #718096; margin-left: 10px;">{{ now()->format('Y-m-d H:i:s') }}</span>
                    </div>
                    <div style="background: #f8fafc; padding: 15px; border-radius: 12px;">
                        <strong style="color: #2d3748;">Environment:</strong>
                        <span style="color: #718096; margin-left: 10px;">{{ app()->environment() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End-Action boxes-->
</div>
<!--end-main-container-part-->

<style>
    /* Hover effects */
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
    }
    
    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
    }
    
    /* Smooth transitions */
    .stat-card, .dashboard-card, .action-btn {
        transition: all 0.3s ease;
    }
    
    /* Table row hover */
    .modern-table tbody tr:hover {
        background: #f8fafc;
    }
    
    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr !important;
        }
        
        .stats-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<script>
    // Auto-refresh stats every 60 seconds (optional)
    setTimeout(function() {
        location.reload();
    }, 60000);
</script>
@endsection