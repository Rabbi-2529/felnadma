@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#" SMS>Marketing Benefits</a> > <a href="#" class="current">Add SMS Marketing Benefits</a> </div>
    <h1 SMS>Marketing Benefits</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add SMS Marketing Benefits</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add_sms_marketing_benefits')}}" name="add_sms_marketing_benefits" id="add_sms_marketing_benefits" novalidate="novalidate">
              @csrf
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" style="width:350px;">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" rows="6" style="width:350px;"></textarea>
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Add Benefits" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
