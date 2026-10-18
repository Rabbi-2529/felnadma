@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">SMS Service Pages</a> <a href="#" class="current">View SMS Service Pages</a> </div>
    <h1>SMS Service Pages</h1>
  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View SMS Service Pages</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_sms_service_page')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Order</th>
                  <th>Icon</th>
                  <th>Title</th>
                  <th>URL</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pages as $page)
                <tr class="gradeX">
                  <td style="width:50px;">{{$page->sort_order}}</td>
                  <td style="width:70px;">
                    @if(!empty($page->icon_image))
                      <img src="{{asset($page->iconImagePath())}}" alt="icon" width="40">
                    @elseif(!empty($page->icon_class))
                      <code>{{$page->icon_class}}</code>
                    @endif
                  </td>
                  <td style="width:250px;">{{$page->title}}</td>
                  <td><a href="{{ $page->url() }}" target="_blank">/bulk-sms-service/{{$page->slug}}</a></td>
                  <td>{!! $page->status ? '<span class="label label-success">Active</span>' : '<span class="label">Hidden</span>' !!}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_sms_service_page/'.$page->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <a href="{{url('admin/delete_sms_service_page/'.$page->id)}}" onclick="return confirm('Are You Sure To Delete?')" class="btn btn-danger btn-mini">Delete</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
