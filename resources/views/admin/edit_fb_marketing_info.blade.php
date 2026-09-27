@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">FB Marketing Info</a> > <a href="#" class="current">Edit FB Marketing Info</a> </div>
    <h1>FB Marketing Info</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit FB Marketing Info</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_fb_marketing_info/'.$fbMarketingInfo->id)}}" name="edit_fb_marketing_info" id="edit_fb_marketing_info" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">FB Marketing Info Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{$fbMarketingInfo->title}}" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">FB Marketing Info Description</label>
                <div class="controls">
                  <textarea id="messageArea" name="description" rows="7" class="form-control ckeditor">{{$fbMarketingInfo->description}}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Image (1519px x 400px)</label>
                <div class="controls">
                  <input type="file" name="image" id="image" style="width:350px;">
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <img src="{{asset('asset/images/'.$fbMarketingInfo->image)}}" width="150px">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update FB Marketing Info" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
