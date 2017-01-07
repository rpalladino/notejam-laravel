@extends('layouts.user')

@section('title', 'Forgot password?')

@section('content')
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    @include('partials.field_error', ['field' => 'email'])
    <input type="submit" value="Generate password">
  </form>
@endsection
