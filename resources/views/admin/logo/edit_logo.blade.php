@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
      <a href="index.html" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a> > 
      <a href="#">Logo</a> > 
      <a href="#" class="current">Edit Logo</a> 
    </div>
    <h1>Logo</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Logo</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit_logo/'.$logo->id) }}" enctype="multipart/form-data" novalidate="novalidate">
              @csrf
              
              {{-- Logo Upload --}}
              <div class="control-group">
                <label class="control-label">Logo</label>
                <div class="controls">
                  <input type="file" name="logo" id="logo" style="width:350px;">
                </div>
              </div>

              {{-- Logo Preview (clickable) --}}
              <div class="control-group">
                <div class="controls">
                  @if(!empty($logo->logo))
                    <a href="{{ asset('asset/images/logo_img/'.$logo->logo) }}" target="_blank">
                      <img src="{{ asset('asset/images/logo_img/'.$logo->logo) }}" width="150px">
                    </a>
                  @endif
                </div>
              </div>

              {{-- Logo Text Upload --}}
              <div class="control-group">
                <label class="control-label">Logo Text</label>
                <div class="controls">
                  <input type="file" name="logo_text" id="logo_text" style="width:350px;">
                </div>
              </div>

              {{-- Logo Text Preview (clickable) --}}
              <div class="control-group">
                <div class="controls">
                  @if(!empty($logo->logo_text))
                    <a href="{{ asset('asset/images/logo_img/'.$logo->logo_text) }}" target="_blank">
                      <img src="{{ asset('asset/images/logo_img/'.$logo->logo_text) }}" width="150px">
                    </a>
                  @endif
                </div>
              </div>

              <div style="margin-left: 181px;" class="form-actions">
                <input type="submit" value="Update Logo" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
