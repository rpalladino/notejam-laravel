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
    <link rel="stylesheet" href="css/style.css">

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
      <h1 class="bold-header"><a href="#" class="header">note<span class="jam">jam:</span></a> <span> @yield('title')</span></h1>
    </div>
    <div class="three columns">
      <h4 id="logo">My pads</h4>
      <nav>
      <ul>
        <li><a href="#whatAndWhy">Business</a></li>
        <li><a href="#grid">Personal</a></li>
        <li><a href="#typography">Sport</a></li>
        <li><a href="#buttons">Diary</a></li>
        <li><a href="#forms">Drafts</a></li>
      </ul>
      <hr />
      <a href="#">New pad</a>
      </nav>
    </div>
    <div class="thirteen columns content-area">
      <div class="alert-area">
        <!--<div class="alert alert-success">Note is sucessfully saved</div>-->
        @if(session('signup_success'))
          <div class="alert alert-success">
            {{ session('signup_success') }}
          </div>
        @endif
      </div>
      <table class="notes">
        <tr>
          <th class="note">Note <a href="#" class="sort_arrow" >&uarr;</a><a href="#" class="sort_arrow" >&darr;</a></th>
          <th>Pad</th>
          <th class="date">Last modified <a href="#" class="sort_arrow" >&uarr;</a><a href="#" class="sort_arrow" >&darr;</a></th>
        </tr>
        <tr>
          <td><a href="#">My sport activites</a></td>
          <td class="pad">No pad</td>
          <td class="hidden-text date">Today at 10:51</td>
        </tr>
        <tr>
          <td><a href="#">February reports</a></td>
          <td class="pad"><a href="#">Pad</a></td>
          <td class="hidden-text date">Yesterday</td>
        </tr>
        <tr>
          <td><a href="#">Budget plan</a></td>
          <td class="pad"><a href="#">Pad</a></td>
          <td class="hidden-text date">2 days ago</td>
        </tr>
        <tr>
          <td><a href="#">Visit Agenda for all customers</a></td>
          <td class="pad"><a href="#">Pad</a></td>
          <td class="hidden-text date">02 Feb. 2013</td>
        </tr>
        <tr>
          <td><a href="#">Gifts</a></td>
          <td class="pad"><a href="#">Pad</a></td>
          <td class="hidden-text date">29 Jan. 2013</td>
        </tr>
        <tr>
          <td><a href="#">Calendar events</a></td>
          <td class="pad"><a href="#">Pad</a></td>
          <td class="hidden-text date">29 Jan. 2013</td>
        </tr>
        <tr>
          <td><a href="#">TV series</a></td>
          <td class="pad"><a href="#">Pad</a></td>
          <td class="hidden-text date">01 Dec. 2012</td>
        </tr>
        <tr>
          <td><a href="#">Daily post</a></td>
          <td class="pad"><a href="#">Pad</a></td>
          <td class="hidden-text date">28 Nov. 2012</td>
        </tr>
      </table>
      <a href="#" class="button">New note</a>
      <div class="pagination">
        <a href="#">1</a>
        2
        <a href="#">3</a>
        <a href="#">4</a>
      </div>
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
