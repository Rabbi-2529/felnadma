@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Meta Tag info</a> <a href="#" class="current">View Meta Tag info</a> </div>
    <h1>Meta Tag info</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Feature</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_meta_tag')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>URL</th>
                  <th>Meta Title</th>
                  <th>Description</th>
                  <th>Keywords</th>
                  <th>Meta link</th>
                  <th>Meta Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($metaTags as $metaTag)
                <tr class="gradeX">
                  <td style="width: 100px;">{{$metaTag->nav}}</td>
                  <td style="width: 150px;">{{$metaTag->meta_title}}</td>
                  <td>{{$metaTag->meta_description}}</td>
                  <td>{{$metaTag->meta_keywords}}</td>
                  <td>{{$metaTag->meta_link}}</td>
                  <td>
                    @if(!empty($metaTag->meta_image))
                    <img src="{{asset('asset/images/hidden/'.$metaTag->meta_image)}}" width="200px">
                    @endif
                  </td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_meta_tag/'.$metaTag->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_meta_tag/'.$metaTag->id)}}" method="get" style="display: inline-table;">
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
