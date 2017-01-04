@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
  @if (session('attempt-failed') || session('signed-out'))
    <div class="alert-area">
      @if (session('attempt-failed'))
        <div class="alert alert-error">Wrong password or email.</div>
      @endif
      @if (session('signed-out'))
        <div class="alert alert-success">You have signed out.</div>
      @endif
    </div>
  @endif
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
