@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#" Header>Contact Info</a> > <a href="#" class="current">Add Contact Info</a> </div>
    <h1 Header>Contact Info</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Contact Info</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_contact_info')}}" name="add_contact_info" id="add_contact_info" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Office Name</label>
                <div class="controls">
                  <input type="text" name="office_name" id="office_name" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Address</label>
                <div class="controls">
                  <textarea name="address" rows="4" style="width:350px;"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Mobile</label>
                <div class="controls">
                  <textarea name="mobile" rows="4" style="width:350px;"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Hotline</label>
                <div class="controls">
                  <textarea name="hotline" rows="4" style="width:350px;"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
                  <textarea name="phone" rows="4" style="width:350px;"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <textarea name="email" rows="4" style="width:350px;"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Skype</label>
                <div class="controls">
                  <input type="text" name="skype" id="skype" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Map URL</label>
                <div class="controls">
                  <textarea name="map_url" rows="4" style="width:350px;"></textarea>
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Add Contact Info" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
