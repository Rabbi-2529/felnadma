@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Customer Support info</a> <a href="#" class="current">View Customer Support info</a> </div>
    <h1>Customer Support info</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Customer Support info</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_customer_support_info')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Phone</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($supports as $support)
                <tr class="gradeX">
                  <td style="width:250px;">{{$support->title}}</td>
                  <td style="width:300px;">{{$support->description}}</td>
                  <td>{{$support->phone}}</td>
                  <td>
                    <img src="{{asset('asset/images/support/'.$support->image)}}" alt="offer" width="80px">
                  </td>
                  <td>{{$support->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_customer_support_info/'.$support->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_customer_support_info/'.$support->id)}}" method="get" style="display: inline-table;">
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
