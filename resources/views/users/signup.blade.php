@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="{{ old('email') }}">
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
    <label for="confirm-password">Confirm password</label>
    <input type="password" id="confirm-password" name="password_confirmation">
    @if ($errors->has('password_confirmation'))
        <ul class="errorlist">
            <li>
                {{ $errors->first('password_confirmation') }}
            </li>
        </ul>
    @endif
    <input type="submit" value="Sign Up" name="Sign Up"> or <a href="{{ URL::route('signin') }}">Sign in</a>
  </form>
@endsection
