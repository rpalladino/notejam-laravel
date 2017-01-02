@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
  <!--<div class="alert-area">-->
  <!--<div class="alert alert-error">Wrong password or email</div>-->
  <!--</div>-->
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Sign In"> or <a href="#signup">Sign up</a>
    <hr />
    <p><a href="#forgot-password" class="small-red">Forgot password?</a></p>
  </form>
@endsection
