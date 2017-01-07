@extends('layouts.user')

@section('title', 'Sign In')

@section('content')
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    @include('partials.field_error', ['field' => 'email'])
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    @include('partials.field_error', ['field' => 'password'])
    <input type="submit" value="Sign In"> or <a href="{{ URL::route('signup') }}">Sign up</a>
    <hr />
    <p><a href="{{ URL::route('forgot-password') }}" class="small-red">Forgot password?</a></p>
  </form>
@endsection
