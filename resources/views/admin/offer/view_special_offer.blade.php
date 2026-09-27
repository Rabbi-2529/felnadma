@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Special Offer</a> <a href="#" class="current">View Special Offer</a> </div>
    <h1>Special Offer</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Special Offer</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_special_offer')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>Current Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($offers as $offer)
                <tr class="gradeX">
                  <td style="width:250px;">{{$offer->title}}</td>
                  <td style="width:300px;">{{$offer->description}}</td>
                  <td>
                    @if(!empty($offer->image))
                    <img src="{{asset('asset/images/offer/'.$offer->image)}}" alt="offer" width="80px">
                    @endif
                  </td>
                  <td>{{$offer->created_at}}</td>
                  <td>
                    @if($offer->status == 0)
                      Deactive
                    @else
                      Active
                    @endif
                  </td>
                  <td class="center" style="width: 92px;">
                    @if($offer->status == 0)
                      <form action="{{url('/admin/active_offer/'.$offer->id)}}" method="post" style="display: inline-table;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-mini">Active</button>
                      </form>
                    @else
                     <form action="{{url('/admin/deactive_offer/'.$offer->id)}}" method="post" style="display: inline-table;">
                        @csrf
                      <button type="submit" class="btn btn-danger btn-mini">Deactive</button>
                    </form>
                    @endif
                    <a href="{{url('/admin/edit_special_offer/'.$offer->id)}}" class="btn btn-primary btn-mini">Edit</a>
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
