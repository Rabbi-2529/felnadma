@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Meta Tag</a> > <a href="#" class="current">Add Meta Tag</a> </div>
    <h1>Meta Tag</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Meta</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_meta_tag')}}" name="add_meta_tag" id="add_meta_tag" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Page</label>
                <div class="controls">
                  <select name="nav" style="width:364px;">
                    <option selected disabled>Select Page</option>
                    @foreach($navbar as $nav)
                      <option value="{{$nav->nav_route}}">{{$nav->nav_item}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Title</label>
                <div class="controls">
                  <input type="text" name="meta_title" id="meta_title" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <textarea name="meta_description" rows="6" style="width:350px;"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Keywords</label>
                <div class="controls">
                  <textarea name="meta_keywords" rows="6" style="width:350px;"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Image</label>
                <div class="controls">
                  <input type="file" name="meta_image" id="meta_image" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Meta Link</label>
                <div class="controls">
                  <input type="text" name="meta_link" id="meta_link" style="width:350px;">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Add Meta" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
