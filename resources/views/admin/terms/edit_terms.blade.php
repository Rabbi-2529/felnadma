@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Terms & Conditions</a> > <a href="#" class="current">Edit Terms & Conditions</a> </div>
    <h1>Terms & Conditions</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Terms & Conditions</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_terms/'.$terms->id)}}" name="edit_terms" id="edit_terms" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Header Title</label>
                <div class="controls">
                  <input type="text" name="header_title" id="header_title" value="{{$terms->header_title}}" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Terms</label>
                <div class="controls">
                  <textarea name="terms" rows="6" style="width:350px;">{{$terms->terms}}</textarea>
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
                  <img src="{{asset('asset/images/'.$terms->image)}}" width="150px">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update Terms" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
