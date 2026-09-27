@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
      <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
      <a href="#" class="current">View Orders</a> 
    </div>
    <h1>View Orders</h1>
  </div>
  
  <div class="container-fluid">
    <hr>
    
    <!-- Filter Section -->
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="icon"><i class="icon-filter"></i></span>
            <h5>Filter Orders</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span3">
                <select id="statusFilter" class="form-control">
                  <option value="all">All Orders</option>
                  <option value="pending">Pending</option>
                  <option value="confirmed">Confirmed</option>
                  <option value="processing">Processing</option>
                  <option value="completed">Completed</option>
                  <option value="cancelled">Cancelled</option>
                </select>
              </div>
              <div class="span3">
                <button id="filterBtn" class="btn btn-primary">Filter</button>
                <a href="{{url('/admin/export_orders')}}" class="btn btn-success">Export CSV</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Orders Table -->
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Orders List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="ordersTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Order ID</th>
                  <th>Customer Name</th>
                  <th>Phone</th>
                  <th>District</th>
                  <th>Package</th>
                  <th>Order Status</th>
                  <th>OTP Status</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->order_id}}</td>
                  <td>{{$order->client_name}}</td>
                  <td>{{$order->client_phone}}</td>
                  <td>{{$order->client_district}}</td>
                  <td>{{$order->package_name}}</td>
                  <td>
                    @if($order->order_status == 'pending')
                      <span class="badge badge-warning">Pending</span>
                    @elseif($order->order_status == 'confirmed')
                      <span class="badge badge-info">Confirmed</span>
                    @elseif($order->order_status == 'processing')
                      <span class="badge badge-primary">Processing</span>
                    @elseif($order->order_status == 'completed')
                      <span class="badge badge-success">Completed</span>
                    @elseif($order->order_status == 'cancelled')
                      <span class="badge badge-danger">Cancelled</span>
                    @endif
                   </td>
                  <td>
                    @if($order->otp_status == 'verified')
                      <span class="badge badge-success">Verified</span>
                    @else
                      <span class="badge badge-warning">Pending</span>
                    @endif
                   </td>
                  <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') }}</td>
                  <td>
                    <a href="{{url('/admin/order_details/'.$order->id)}}" class="btn btn-info btn-mini">View</a>
                    <a href="{{url('/admin/delete_order/'.$order->id)}}" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                   </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.badge {
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 11px;
}
.badge-warning { background: #f0ad4e; color: #fff; }
.badge-info { background: #5bc0de; color: #fff; }
.badge-primary { background: #337ab7; color: #fff; }
.badge-success { background: #5cb85c; color: #fff; }
.badge-danger { background: #d9534f; color: #fff; }
.form-control {
    width: 100%;
    padding: 6px 12px;
    border-radius: 4px;
    border: 1px solid #ccc;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Filter functionality
    $('#filterBtn').click(function() {
        var status = $('#statusFilter').val();
        
        $.ajax({
            url: "{{url('/admin/filter_orders')}}",
            type: 'GET',
            data: {status: status},
            success: function(response) {
                var tbody = $('#ordersTable tbody');
                tbody.empty();
                
                if(response.orders.length > 0) {
                    $.each(response.orders, function(key, order) {
                        var statusBadge = '';
                        switch(order.order_status) {
                            case 'pending':
                                statusBadge = '<span class="badge badge-warning">Pending</span>';
                                break;
                            case 'confirmed':
                                statusBadge = '<span class="badge badge-info">Confirmed</span>';
                                break;
                            case 'processing':
                                statusBadge = '<span class="badge badge-primary">Processing</span>';
                                break;
                            case 'completed':
                                statusBadge = '<span class="badge badge-success">Completed</span>';
                                break;
                            case 'cancelled':
                                statusBadge = '<span class="badge badge-danger">Cancelled</span>';
                                break;
                        }
                        
                        var otpBadge = order.otp_status == 'verified' ? 
                            '<span class="badge badge-success">Verified</span>' : 
                            '<span class="badge badge-warning">Pending</span>';
                        
                        var row = '<tr>' +
                            '<td>' + order.id + '</td>' +
                            '<td>' + order.order_id + '</td>' +
                            '<td>' + order.client_name + '</td>' +
                            '<td>' + order.client_phone + '</td>' +
                            '<td>' + order.client_district + '</td>' +
                            '<td>' + order.package_name + '</td>' +
                            '<td>' + statusBadge + '</td>' +
                            '<td>' + otpBadge + '</td>' +
                            '<td>' + new Date(order.created_at).toLocaleString() + '</td>' +
                            '<td>' +
                                '<a href="/admin/order_details/' + order.id + '" class="btn btn-info btn-mini">View</a> ' +
                                '<a href="/admin/delete_order/' + order.id + '" class="btn btn-danger btn-mini" onclick="return confirm(\'Are you sure?\')">Delete</a>' +
                            '</td>' +
                        '</tr>';
                        
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="10" class="text-center">No orders found</td></tr>');
                }
            }
        });
    });
});
</script>
@endsection