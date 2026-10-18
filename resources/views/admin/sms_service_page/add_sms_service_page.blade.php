@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">SMS Service Pages</a> > <a href="#" class="current">Add SMS Service Page</a> </div>
    <h1>SMS Service Pages</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add SMS Service Page</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_sms_service_page')}}" name="add_sms_service_page" id="add_sms_service_page" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              @include('admin.sms_service_page._form')

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Add SMS Service Page" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
