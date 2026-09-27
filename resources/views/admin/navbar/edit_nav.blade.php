@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#" Header>Navbar</a> > <a href="#" class="current">Edit Navbar</a> </div>
    <h1 Header> Navbar</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Nav Item</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit_nav/'.$nav->id)}}" name="edit_nav_item" id="edit_nav_item" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Nav Item</label>
                <div class="controls">
                  <input type="text" name="nav_item" id="nav_item" value="{{$nav->nav_item}}" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Route</label>
                <div class="controls">
                  <input type="text" name="nav_route" id="nav_route" value="{{$nav->nav_route}}" style="width:350px;">
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update Nav Item" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
