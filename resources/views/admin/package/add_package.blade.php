@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Package</a> > <a href="#" class="current">Add Package</a> </div>
    <h1>Package</h1>
  </div>
  <div class="container-fluid"><hr>
    @include('admin.partials.error_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Package</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_package')}}" name="add_package" id="add_package" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Package No</label>
                <div class="controls">
                  <input type="number" name="package_no" id="package_no" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Package Name</label>
                <div class="controls">
                  <input type="text" name="package_name" id="package_name" style="width:350px;">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Add Package" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
