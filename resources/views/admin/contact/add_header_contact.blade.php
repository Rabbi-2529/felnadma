@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#" Header>Contact</a> > <a href="#" class="current">Add Header Contact</a> </div>
    <h1 Header>Header Contact</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Header Contact Info</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_header_contact_info')}}" name="add_header_contact" id="add_header_contact" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Contact No</label>
                <div class="controls">
                  <input type="text" name="phone" id="phone" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Contact Email</label>
                <div class="controls">
                  <input type="email" name="email" id="email" style="width:350px;">
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
