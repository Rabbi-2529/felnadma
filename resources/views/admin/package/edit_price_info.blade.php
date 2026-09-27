@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Price</a> > <a href="#" class="current">Edit Price Info</a> </div>
    <h1>Price</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Price Info</h5>
          </div>
          <?php $packageID = ''; ?>
          @foreach($prices as $price)
          <?php $packageID = $price->package_id; ?>
          @endforeach

          @if(!empty($packageID))
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/update_price_info/'.$packageID)}}" name="edit_price_info" id="edit_price_info" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Package</label>
                <div class="controls">
                  <select name="package_id" id="package_id" style="width:363px;">
                    <option selected disabled>Select Package</option>
                    @foreach($packages as $package)
                      <option value="{{$package->id}}" {{$package->id == $packageID ? 'selected' : ''}}>{{$package->package_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <?php $i=1; ?>
              @foreach($prices as $price)
                <div class="control-group">
                  <div class="controls">
                      <input type="text" name="sms_type{{$i}}" id="sms_type{{$i}}" value="{{$price->sms_type}}" style="width:160px;margin-right: 13px;">
                      <input type="text" name="price{{$i}}" id="price{{$i}}" value="{{$price->price}}" style="width:160px;">
                  </div>
                </div>
                <?php $i++; ?>
              @endforeach
              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update Price" class="btn btn-success">
              </div>
            </form>
          </div>
          @else
          <div class="widget-content nopadding text-center">
            <h4>No Price Found</h4>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
