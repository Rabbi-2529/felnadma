@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">About Info</a> <a href="#" class="current">View About Info</a> </div>
    <h1>About Info</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view About Info</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_about_info')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Cover Image</th>
                  <th>Logo</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($abouts as $about)
                <tr class="gradeX">
                  <td style="width:200px;">{{$about->header_title}}</td>
                  <td style="width:300px;">{{$about->description}}</td>
                  <td>
                    <img src="{{asset('asset/images/'.$about->image)}}" alt="about" width="80px">
                  </td>
                  <td>
                    <img src="{{asset('asset/images/'.$about->logo)}}" alt="about_text" width="80px">
                  </td>
                  <td>{{$about->created_at}}</td>
                  <td class="center">
                    <a href="{{url('/admin/edit_about_info/'.$about->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_about_info/'.$about->id)}}" method="get" style="display: inline-table;">
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
