@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Hidden Image</a> <a href="#" class="current">View Hidden Image</a> </div>
    <h1>Hidden Image</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Hidden Image</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_hidden_image')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Hidden Image</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($hidden_images as $image)
                <tr class="gradeX">
                  <td>
                    @if(!empty($image->image))
                    <img src="{{asset('asset/images/hidden/'.$image->image)}}" alt="image" width="80px">
                    @endif
                  </td>
                  <td>{{$image->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_hidden_image/'.$image->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_hidden_image/'.$image->id)}}" method="get" style="display: inline-table;">
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
