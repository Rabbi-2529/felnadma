<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bulk SMS Service Admin Panel</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{asset('asset/css/admin/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('asset/css/admin/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('asset/css/admin/matrix-login.css')}}" />
    <link href="{{asset('asset/fonts/admin/css/font-awesome.css')}}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">
            @include('admin.partials.error_message')
            <form id="loginform" class="form-vertical" action="{{url('/admin')}}" method="post">
              {{csrf_field()}}
				        <div class="control-group normal_text"> <h3>Bulk SMS Service</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" placeholder="Username" required/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" required/>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <span><input type="submit" value="Login" class="btn btn-success"/></span>
                </div>
            </form>
        </div>

        <script src="{{asset('asset/js/admin/jquery.min.js')}}"></script>
        <script src="{{asset('asset/js/admin/matrix.login.js')}}"></script>
        <script src="{{asset('asset/js/admin/bootstrap.min.js')}}"></script>
    </body>

</html>
