@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#">Footer Link</a> > <a href="#" class="current">Edit Footer Link</a> </div>
    <h1>Footer Link</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Footer Link</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_footer_link/'.$footer->id)}}" name="edit_footer_link" id="edit_footer_link" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Parent Link</label>
                <div class="controls">
                  <select name="parent_id" style="width:364px;">
                    <option selected disabled>Select Parent Link</option>
                    @foreach($parentLinks as $parent)
                      <option value="{{$parent->id}}" {{$parent->id == $footer->parent_id ? 'selected' : ''}}>{{$parent->title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Footer Link Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{$footer->title}}" style="width:350px;">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Url</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{$footer->url}}" style="width:350px;">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update Footer Link" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
