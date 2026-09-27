@extends('admin.layout.admin_master')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> > <a href="#" class="current">View Articles</a> </div>
    <h1>View Articles</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Articles List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Page</th>
                  <th>Title</th>
                
                  <th>Description</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($articles as $article)
                <tr>
                  <td>{{$article->id}}</td>
                  <td>{{$article->page}}</td>
                  <td>{{$article->title}}</td>
                  
                  <td>{!! Str::limit($article->description, 100) !!}</td>
                  <td>{{$article->created_at}}</td>
                  <td>
                    <a href="{{url('/admin/edit_article/'.$article->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <a href="{{url('/admin/delete_article/'.$article->id)}}" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
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