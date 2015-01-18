<DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AuthCentral</title>
    {{HTML::style('assets/css/bootstrap.min.css')}}
    {{HTML::style('assets/css/lighter.css')}}
    <style>
    	body {
  			padding-top: 50px;
  			height: 100%;
  			margin: 0;
			}

			.form-signin {
  padding-top: 50px;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
</head>
<body>
 <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">AuthCentral</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="/">Home</a></li>
          </ul>
          <ul class="nav navbar-nav pull-right">
            @if (Auth::check())
            <li><a href="{{ URL::to('panel') }}">Dashboard</a></li>
            @if (Auth::user()->admin)
            <li ><a href="/users">Users</a></li>
            @endif
            <li><a href="{{ URL::to('logout') }}">Log Out</a></li>
            @else
            <li><a href="{{ URL::to('login') }}">Log In</a></li>
            <li><a href="{{ URL::to('create') }}">Register</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>






@yield('body')

<footer>
      <div class="container clearfix">
        <p class="pull-left">
          Copyright © <?=date("Y") ?> Internet by Design Ltd
        </p>
        <p class="pull-right">
          Crafted in Laravel
        </p>
      </div> <!-- /.container -->
    </footer>
{{ HTML::script('http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}
{{ HTML::script('assets/js/bootstrap.min.js')}}
</body>
</html>
