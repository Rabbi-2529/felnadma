@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Marketing Title & Image</a> <a href="#" class="current">View Marketing Title & Image</a> </div>
    <h1>Marketing Title & Image</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Marketing Title & Image</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_marketing_image')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($marketings as $marketing)
                <tr class="gradeX">
                  <td style="width:250px;">{{$marketing->title}}</td>
                  <td>
                    <img src="{{asset('asset/images/marketing/'.$marketing->image)}}" alt="marketing" width="100px">
                  </td>
                  <td>{{$marketing->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_marketing_image/'.$marketing->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_marketing_image/'.$marketing->id)}}" method="get" style="display: inline-table;">
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
