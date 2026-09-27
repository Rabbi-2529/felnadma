@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">SEO Info</a> > <a href="#" class="current">Edit SEO Info</a> </div>
    <h1>SEO Info</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit SEO Info</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_seo_info/'.$seoInfo->id)}}" name="edit_seo_info" id="edit_seo_info" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">SEO Info Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{$seoInfo->title}}" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">SEO Info Description</label>
                <div class="controls">
                  <textarea id="messageArea" name="description" rows="7" class="form-control ckeditor">{{$seoInfo->description}}</textarea>
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
                  <img src="{{asset('asset/images/'.$seoInfo->image)}}" width="150px">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update SEO Info" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
