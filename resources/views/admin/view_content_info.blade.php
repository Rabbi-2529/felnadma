@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Content Info</a> <a href="#" class="current">View content Info</a> </div>
    <h1>Content Info</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view content Info</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_content_info')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Content Title</th>
                  <th>Content Description</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contentInfos as $content)
                <tr class="gradeX">
                  <td style="width:250px;">{{$content->title}}</td>
                  <td style="width:300px;">{!! $content->description !!}</td>
                  <td>
                    <img src="{{asset('asset/images/'.$content->image)}}" alt="content" width="100px">
                  </td>
                  <td>{{$content->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_content_info/'.$content->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_content_info/'.$content->id)}}" method="get" style="display: inline-table;">
                      @method('DELETE')
                      @csrf
                      <button onclick="return confirm('Are You Sure To Delete?')" type="submit" class="btn btn-danger btn-mini">Delete</button>
                    </form>
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
