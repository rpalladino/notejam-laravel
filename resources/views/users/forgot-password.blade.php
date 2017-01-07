@extends('layouts.user')

@section('title', 'Forgot password?')

@section('content')
  @if (session('password-generated'))
    <div class="alert-area">
      <div class="alert alert-success">New password sent to your email</div>
    </div>
  @endif
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    @include('partials.field_error', ['field' => 'email'])
    <input type="submit" value="Generate password">
  </form>
@endsection
