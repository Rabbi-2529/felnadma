<!--Header-part-->
<div id="header">
  <h3 style="color:#fff; padding-left:20px;"><a href="{{url('/admin/dashboard')}}">Felna SMS</a></h3>
</div>
<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="javascript:void(0)"><i class="icon icon-user"></i> <span class="text">Wellcome {{Session::get('adminSession')}}</span></a></li>
    <li class=""><a title="" href="{{url('/admin/settings')}}"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
    <li class=""><a title="" href="{{url('/logout')}}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
