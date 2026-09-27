@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Reseller Header info</a> <a href="#" class="current">View Reseller Header info</a> </div>
    <h1>Reseller Header info</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Reseller Header info</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_reseller_header_info')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Header Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($resellerHeaders as $resellerHeader)
                <tr class="gradeX">
                  <td style="width:250px;">{{$resellerHeader->header_title}}</td>
                  <td style="width:300px;">{{$resellerHeader->description}}</td>
                  <td>
                    <img src="{{asset('asset/images/'.$resellerHeader->image)}}" width="80px">
                  </td>
                  <td>{{$resellerHeader->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_reseller_header_info/'.$resellerHeader->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_reseller_header_info/'.$resellerHeader->id)}}" method="get" style="display: inline-table;">
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
