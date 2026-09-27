@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">{{$package->package_name}} Price info</a> <a href="#" class="current">View {{$package->package_name}} Price info</a> </div>
    <h1>{{$package->package_name}} Price info</h1>
  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view {{$package->package_name}} Price info</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('/admin/edit_price_info/'.$package->id)}}" class="btn btn-success">Edit Price</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>SI</th>
                  <th>SMS Type</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach($prices as $price)
                <tr class="gradeX">
                  <td style="width: 50px; text-align: center;">{{$i}}</td>
                  <td>{{$price->sms_type}} SMS</td>
                  <td>{{$price->price}}</td>
                </tr>
                <?php $i++;?>
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
