@extends('admin.layout.admin_master')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#"> Contact</a> <a href="#" class="current">View Contact Info</a> </div>
    <h1>Contact Info</h1>

  </div>
  <div class="container-fluid">
    <hr>
    @include('admin.partials.success_message')
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>

            <h5>view Contact Info</h5>
            <div style="margin: 3px;" class="pull-right"><a href="{{url('admin/add_contact_info')}}" class="btn btn-success">Add</a></div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Office Name</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>Hotline</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Skype</th>
                  <th>Map URL</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contacts as $contact)
                <tr class="gradeX">
                  <td style="width:90px;">{{$contact->office_name}}</td>
                  <td style="width:150px;">@parsedown($contact->address)</td>
                  <td>@parsedown($contact->mobile)</td>
                  <td>@parsedown($contact->hotline)</td>
                  <td>@parsedown($contact->phone)</td>
                  <td>@parsedown($contact->email)</td>
                  <td>{{$contact->skype}}</td>
                  <td style="width:250px;">{{Str::limit($contact->map_url, 80)}}</td>
                  <td>{{$contact->created_at}}</td>
                  <td class="center" style="width: 92px;">
                    <a href="{{url('/admin/edit_contact_info/'.$contact->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <form action="{{url('admin/delete_contact_info/'.$contact->id)}}" method="get" style="display: inline-table;">
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
