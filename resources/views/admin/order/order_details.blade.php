@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
      <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
      <a href="{{url('/admin/view_order')}}" class="current">Orders</a>
      <a href="#" class="current">Order Details</a> 
    </div>
    <h1>Order Details</h1>
  </div>
  
  <div class="container-fluid">
    <hr>
    
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="icon"><i class="icon-info-sign"></i></span>
            <h5>Order Information</h5>
          </div>
          <div class="widget-content">
            
            <div class="row-fluid" style="margin-bottom: 20px;">
              <div class="span6">
                <table class="table table-bordered">
                  <tr>
                    <th width="30%">Order ID:</th>
                    <td><strong>{{$order->order_id}}</strong></td>
                  </tr>
                  <tr>
                    <th>Customer Name:</th>
                    <td>{{$order->client_name}}</td>
                  </tr>
                  <tr>
                    <th>Email:</th>
                    <td>{{$order->client_email}}</td>
                  </tr>
                  <tr>
                    <th>Phone:</th>
                    <td>{{$order->client_phone}}</td>
                  </tr>
                  <tr>
                    <th>District:</th>
                    <td>{{$order->client_district}}</td>
                  </tr>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered">
                  <tr>
                    <th width="30%">Package:</th>
                    <td><strong>{{$order->package_name}}</strong></td>
                  </tr>
                  <tr>
                    <th>Order Status:</th>
                    <td>
                      <form action="{{url('/admin/update_order_status/'.$order->id)}}" method="POST" style="display: inline;">
                        @csrf
                        <select name="order_status" class="form-control" style="width: auto; display: inline-block;">
                          <option value="pending" {{$order->order_status == 'pending' ? 'selected' : ''}}>Pending</option>
                          <option value="confirmed" {{$order->order_status == 'confirmed' ? 'selected' : ''}}>Confirmed</option>
                          <option value="processing" {{$order->order_status == 'processing' ? 'selected' : ''}}>Processing</option>
                          <option value="completed" {{$order->order_status == 'completed' ? 'selected' : ''}}>Completed</option>
                          <option value="cancelled" {{$order->order_status == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-mini">Update</button>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <th>OTP Status:</th>
                    <td>
                      @if($order->otp_status == 'verified')
                        <span class="badge badge-success">Verified</span>
                      @else
                        <span class="badge badge-warning">Pending</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Created At:</th>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</td>
                  </tr>
                  <tr>
                    <th>Updated At:</th>
                    <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y H:i:s') }}</td>
                  </tr>
                </table>
              </div>
            </div>
            
            <!-- Order Timeline -->
            <div class="row-fluid">
              <div class="span12">
                <div class="widget-box">
                  <div class="widget-title">
                    <span class="icon"><i class="icon-time"></i></span>
                    <h5>Order Timeline</h5>
                  </div>
                  <div class="widget-content">
                    <ul class="timeline">
                      <li>
                        <div class="timeline-badge success">
                          <i class="icon-shopping-cart"></i>
                        </div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">Order Created</h4>
                            <p><small class="text-muted"><i class="icon-time"></i> {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</small></p>
                          </div>
                          <div class="timeline-body">
                            <p>Order was created with status: <strong>{{ ucfirst($order->order_status) }}</strong></p>
                          </div>
                        </div>
                      </li>
                      
                      @if($order->otp_status == 'verified')
                      <li>
                        <div class="timeline-badge info">
                          <i class="icon-ok"></i>
                        </div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">OTP Verified</h4>
                            <p><small class="text-muted"><i class="icon-time"></i> {{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y H:i:s') }}</small></p>
                          </div>
                          <div class="timeline-body">
                            <p>Customer successfully verified their phone number via OTP.</p>
                          </div>
                        </div>
                      </li>
                      @endif
                      
                      @if($order->order_status == 'confirmed')
                      <li>
                        <div class="timeline-badge warning">
                          <i class="icon-check"></i>
                        </div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">Order Confirmed</h4>
                            <p><small class="text-muted"><i class="icon-time"></i> {{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y H:i:s') }}</small></p>
                          </div>
                          <div class="timeline-body">
                            <p>Order has been confirmed and admin has been notified via SMS.</p>
                          </div>
                        </div>
                      </li>
                      @endif
                      
                      @if($order->order_status == 'processing')
                      <li>
                        <div class="timeline-badge primary">
                          <i class="icon-cog"></i>
                        </div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">Order Processing</h4>
                            <p><small class="text-muted"><i class="icon-time"></i> {{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y H:i:s') }}</small></p>
                          </div>
                          <div class="timeline-body">
                            <p>Order is being processed by the team.</p>
                          </div>
                        </div>
                      </li>
                      @endif
                      
                      @if($order->order_status == 'completed')
                      <li>
                        <div class="timeline-badge success">
                          <i class="icon-flag"></i>
                        </div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4 class="timeline-title">Order Completed</h4>
                            <p><small class="text-muted"><i class="icon-time"></i> {{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y H:i:s') }}</small></p>
                          </div>
                          <div class="timeline-body">
                            <p>Order has been completed successfully.</p>
                          </div>
                        </div>
                      </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Additional Information -->
            <div class="row-fluid">
              <div class="span12">
                <div class="widget-box">
                  <div class="widget-title">
                    <span class="icon"><i class="icon-info"></i></span>
                    <h5>Additional Information</h5>
                  </div>
                  <div class="widget-content">
                    <table class="table table-bordered">
                      <tr>
                        <th width="20%">IP Address:</th>
                        <td>{{$order->ip_address ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <th>User Agent:</th>
                        <td>{{$order->user_agent ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <th>OTP Code:</th>
                        <td>{{$order->otp_code ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <th>API Response:</th>
                        <td><pre>{{$order->api_response ?? 'N/A'}}</pre></td>
                      </tr>
                      <tr>
                        <th>Message Response:</th>
                        <td>{{$order->message_response ?? 'N/A'}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-actions">
              <a href="{{url('/admin/view_order')}}" class="btn btn-default">Back to Orders</a>
              <a href="{{url('/admin/delete_order/'.$order->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete Order</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Timeline Styles */
.timeline {
    list-style: none;
    padding: 0;
    position: relative;
}
.timeline:before {
    top: 0;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 3px;
    background-color: #eeeeee;
    left: 50%;
    margin-left: -1.5px;
}
.timeline > li {
    margin-bottom: 20px;
    position: relative;
}
.timeline > li:before,
.timeline > li:after {
    content: " ";
    display: table;
}
.timeline > li:after {
    clear: both;
}
.timeline > li > .timeline-panel {
    width: 46%;
    float: left;
    border: 1px solid #d4d4d4;
    border-radius: 2px;
    padding: 20px;
    position: relative;
    background: #fff;
    -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
}
.timeline > li > .timeline-badge {
    color: #fff;
    width: 50px;
    height: 50px;
    line-height: 50px;
    font-size: 1.4em;
    text-align: center;
    position: absolute;
    top: 16px;
    left: 50%;
    margin-left: -25px;
    background-color: #999999;
    z-index: 100;
    border-top-right-radius: 50%;
    border-top-left-radius: 50%;
    border-bottom-right-radius: 50%;
    border-bottom-left-radius: 50%;
}
.timeline > li.timeline-inverted > .timeline-panel {
    float: right;
}
.timeline > li.timeline-inverted > .timeline-panel:before {
    border-left-width: 0;
    border-right-width: 15px;
    left: -15px;
    right: auto;
}
.timeline > li.timeline-inverted > .timeline-panel:after {
    border-left-width: 0;
    border-right-width: 14px;
    left: -14px;
    right: auto;
}
.timeline-badge.primary {
    background-color: #2e6da4 !important;
}
.timeline-badge.success {
    background-color: #3f903f !important;
}
.timeline-badge.warning {
    background-color: #f0ad4e !important;
}
.timeline-badge.danger {
    background-color: #d9534f !important;
}
.timeline-badge.info {
    background-color: #5bc0de !important;
}
.badge {
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 11px;
}
.badge-success { background: #5cb85c; color: #fff; }
.badge-warning { background: #f0ad4e; color: #fff; }
.badge-info { background: #5bc0de; color: #fff; }
.badge-primary { background: #337ab7; color: #fff; }
.badge-danger { background: #d9534f; color: #fff; }
.form-control {
    width: 100%;
    padding: 6px 12px;
    border-radius: 4px;
    border: 1px solid #ccc;
}
pre {
    background: #f5f5f5;
    padding: 10px;
    border-radius: 4px;
    margin: 0;
}
</style>
@endsection