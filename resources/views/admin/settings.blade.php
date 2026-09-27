@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">
      Settings
    </a> </div>
    <h1>Admin Settings</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            @include('admin.partials.success_message')
            @include('admin.partials.error_message')
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Update Password</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{url('/admin/update_pass')}}" name="password_validate" id="password_validate" novalidate="novalidate">
                {{csrf_field()}}
                <div class="control-group">
                  <label class="control-label">Username</label>
                  <div class="controls">
                    <input type="text" value="{{$adminDetails->username}}" readonly/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Current Password</label>
                  <div class="controls">
                    <input type="password" name="current_pass" id="current_pass" />
                    <span id="check_status"></span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">New Password</label>
                  <div class="controls">
                    <input type="password" name="new_pass" id="new_pass" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm password</label>
                  <div class="controls">
                    <input type="password" name="confirm_pass" id="confirm_pass" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Submit" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
