<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Notejam: @yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/skeleton/1.2/base.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/skeleton/1.2/skeleton.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/skeleton/1.2/layout.css">
    <link rel="stylesheet" href="/css/style.css">

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
  <div class="container">
    <div class="sixteen columns">
      <div class="sign-in-out-block">
        @if(Auth::check())
          {{ Auth::user()->email }}:&nbsp; <a href="{{ URL::route('settings') }}">Account settings</a>&nbsp;&nbsp;&nbsp;<a href="{{ URL::route('signout') }}">Sign out</a>
        @else
          <a href="{{ URL::route('signup') }}">Sign up</a>&nbsp;&nbsp;&nbsp;<a href="{{ URL::route('signin') }}">Sign in</a>
        @endif
      </div>
    </div>
    <div class="sixteen columns">
      <h1 class="bold-header"><a href="{{ URL::route('list-notes') }}" class="header">note<span class="jam">jam:</span></a> <span> @yield('title')</span></h1>
    </div>
    <div class="three columns">
      @include('partials.pads')
    </div>
    <div class="thirteen columns content-area">
      @include('partials.alerts')
      @yield('content')
    </div>
    <hr class="footer" />
    <div class="footer">
      <div>Notejam: <strong>Laravel 5</strong> application</div>
      <div><a href="https://github.com/komarserjio/notejam">Github</a>, <a href="https://twitter.com/komarserjio">Twitter</a>, created by <a href="https://github.com/komarserjio/">Serhii Komar</a></div>
    </div>
  </div><!-- container -->
  <a href="https://github.com/komarserjio/notejam"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a>
</body>
</html>
