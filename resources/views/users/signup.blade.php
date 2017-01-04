@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="{{ old('email') }}">
    @include('partials.field_error', ['field' => 'email'])
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    @include('partials.field_error', ['field' => 'password'])
    <label for="confirm-password">Confirm password</label>
    <input type="password" id="confirm-password" name="password_confirmation">
    @include('partials.field_error', ['field' => 'password_confirmation'])
    <input type="submit" value="Sign Up" name="Sign Up"> or <a href="{{ URL::route('signin') }}">Sign in</a>
  </form>
@endsection
