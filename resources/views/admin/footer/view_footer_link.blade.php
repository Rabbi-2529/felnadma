@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Footer Link</a> <a href="#" class="current">View Footer Link</a> </div>
    <h1>Footer Link</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Footer Link</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_footer_link')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>SI</th>
                  <th>Parent Link</th>
                  <th>Link Title</th>
                  <th>Url</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach($footers as $footer)
                <tr class="gradeX">
                  <td style="width: 50px; text-align: center;">{{$i}}</td>
                  <td>{{$footer->parentLink->title}}</td>
                  <td>{{$footer->title}}</td>
                  <td>{{$footer->url}}</td>
                  <td>{{$footer->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_footer_link/'.$footer->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_footer_link/'.$footer->id)}}" method="get" style="display: inline-table;">
                      @method('DELETE')
                      @csrf
                      <button onclick="return confirm('Are You Sure To Delete?')" type="submit" class="btn btn-danger btn-mini">Delete</button>
                    </form>
                  </td>
                </tr>
                <?php $i++;?>
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
