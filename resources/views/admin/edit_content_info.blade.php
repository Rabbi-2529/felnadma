@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">content Info</a> > <a href="#" class="current">Edit content Info</a> </div>
    <h1>Content Info</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Content Info</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_content_info/'.$contentInfo->id)}}" name="edit_content_info" id="edit_content_info" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">content Info Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{$contentInfo->title}}" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">content Info Description</label>
                <div class="controls">
                  <textarea id="messageArea" name="description" rows="7" class="form-control ckeditor">{{$contentInfo->description}}</textarea>
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
                  <img src="{{asset('asset/images/'.$contentInfo->image)}}" width="150px">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update content Info" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
