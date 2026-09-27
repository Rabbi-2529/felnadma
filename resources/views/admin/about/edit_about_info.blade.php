@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">About Info</a> > <a href="#" class="current">Edit About Info</a> </div>
    <h1>About Info</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit About Info</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_about_info/'.$about->id)}}" name="edit_about_info" id="edit_about_info" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Header Title</label>
                <div class="controls">
                  <input type="text" name="header_title" id="header_title" value="{{$about->header_title}}" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" rows="6" style="width:350px;">{{$about->description}}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Avout Cover Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <div class="controls">
                  <img src="{{asset('asset/images/'.$about->image)}}" width="150px">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Logo</label>
                <div class="controls">
                  <input type="file" name="logo" id="logo" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <div class="controls">
                  <img src="{{asset('asset/images/'.$about->logo)}}" width="150px">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update About Info" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
