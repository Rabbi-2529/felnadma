@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Reseller Feature Image</a> <a href="#" class="current">View Reseller Feature Image</a> </div>
    <h1>Reseller Feature Image</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Reseller Feature Image</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_reseller_image')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Feature Image</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($resellerImages as $resellerImage)
                <tr class="gradeX">
                  <td>
                    <img src="{{asset('asset/images/'.$resellerImage->image)}}" width="80px">
                  </td>
                  <td>{{$resellerImage->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_reseller_image/'.$resellerImage->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_reseller_image/'.$resellerImage->id)}}" method="get" style="display: inline-table;">
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
