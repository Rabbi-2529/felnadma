@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Price</a> > <a href="#" class="current">Add Price Info</a> </div>
    <h1>Price</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Price Info</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_price_info')}}" name="add_price_info" id="add_price_info" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Package</label>
                <div class="controls">
                  <select name="package_id" id="package_id" style="width:363px;">
                    <option selected disabled>Select Package</option>
                    @foreach($packages as $package)
                      <option value="{{$package->id}}">{{$package->package_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type1" id="sms_type1" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price1" id="price1" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type2" id="sms_type2" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price2" id="price2" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type3" id="sms_type3" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price3" id="price3" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type4" id="sms_type4" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price4" id="price4" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type5" id="sms_type5" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price5" id="price5" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type6" id="sms_type6" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price6" id="price6" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type7" id="sms_type7" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price7" id="price7" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type8" id="sms_type8" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price8" id="price8" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type9" id="sms_type9" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price9" id="price9" placeholder="Price" style="width:160px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input type="text" name="sms_type10" id="sms_type10" placeholder="SMS Type" style="width:160px;margin-right: 13px;">
                    <input type="text" name="price10" id="price10" placeholder="Price" style="width:160px;">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Add Price" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
