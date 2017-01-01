<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Notejam: Sign Up</title>
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
        <a href="#">Sign up</a>&nbsp;&nbsp;&nbsp;<a href="#">Sign in</a>
      </div>
    </div>
    <div class="sixteen columns">
      <h1 class="bold-header"><a href="#" class="header">note<span class="jam">jam:</span></a> <span> Sign Up</span></h1>
    </div>
    <div class="thirteen columns content-area">
      <form class="offset-by-six sign-in" method="post">
        {{ csrf_field() }}
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <label for="confirm-password">Confirm password</label>
        <input type="password" id="confirm-password" name="confirm-password">
        <input type="submit" value="Sign Up" name="Sign Up"> or <a href='#'>Sign in</a>
      </form>
    </div>
    <hr class="footer" />
    <div class="footer">
      <div>Notejam: <strong>Django</strong> application</div>
      <div><a href="https://github.com/komarserjio/notejam">Github</a>, <a href="https://twitter.com/komarserjio">Twitter</a>, created by <a href="https://github.com/komarserjio/">Serhii Komar</a></div>
    </div>
  </div><!-- container -->
  <a href="https://github.com/komarserjio/notejam"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a>
</body>
</html>
