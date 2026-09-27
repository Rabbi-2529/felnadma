@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
      <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
      <a href="#">Payments</a> 
      <a href="#" class="current">View Payments</a> 
    </div>
    <h1>Payment Methods</h1>
  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="icon"><i class="icon-th"></i></span>
            <h5>View Payment Methods</h5>
            <div style="margin: 3px;" class="pull-right">
              <a href="{{url('admin/add_payment')}}" class="btn btn-success">Add Payment Method</a>
            </div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Account Name</th>
                  <th>Account Number</th>
                  <th>Bank/Mobile</th>
                  <th>Type</th>
                  <th>Order</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payments as $key => $payment)
                <tr class="gradeX">
                  <td>{{$key + 1}}</td>
                  <td>{{$payment->account_name}}</td>
                  <td>{{$payment->account_number}}</td>
                  <td>
                    @if($payment->type == 'bank')
                      <span class="label label-info">{{$payment->bank_name}}</span>
                    @else
                      <span class="label label-success">
                        @if($payment->mobile_company == 'bkash') bKash
                        @elseif($payment->mobile_company == 'nagad') Nagad
                        @else Rocket
                        @endif
                      </span>
                    @endif
                  </td>
                  <td>
                    @if($payment->type == 'bank')
                      <span class="label label-primary">Bank Transfer</span>
                    @else
                      <span class="label label-warning">Mobile Banking</span>
                    @endif
                  </td>
                  <td>{{$payment->order_by}}</td>
                  <td>
                    @if($payment->status == 1)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td>{{$payment->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_payment/'.$payment->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_payment/'.$payment->id)}}" method="get" style="display: inline-table;">
                      @csrf
                      <button onclick="return confirm('Are You Sure To Delete?')" type="submit" class="btn btn-danger btn-mini">Delete</button>
                    </form>
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
@endsection