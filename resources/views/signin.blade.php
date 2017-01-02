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
    @if ($errors->has('email'))
        <ul class="errorlist">
            <li>
                {{ $errors->first('email') }}
            </li>
        </ul>
    @endif
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    @if ($errors->has('password'))
        <ul class="errorlist">
            <li>
                {{ $errors->first('password') }}
            </li>
        </ul>
    @endif
    <input type="submit" value="Sign In"> or <a href="#signup">Sign up</a>
    <hr />
    <p><a href="#forgot-password" class="small-red">Forgot password?</a></p>
  </form>
@endsection