@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Why Choose Us</a> > <a href="#" class="current">Edit Why Choose Us</a> </div>
    <h1>Why Choose Us</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Why Choose Us</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_why_choose_us/'.$choose->id)}}" name="edit_why_choose_us" id="edit_why_choose_us" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{$choose->title}}" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" rows="6" style="width:350px;">{{$choose->description}}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <div class="controls">
                  <img src="{{asset('asset/images/'.$choose->image)}}" width="150px">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update Data" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
