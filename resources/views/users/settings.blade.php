@extends('layouts.user')

@section('title', 'Account Settings')

@section('content')
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="current-password">Current password</label>
    <input type="password" id="current-password" name="current_password">
    @include('partials.field_error', ['field' => 'current_password'])
    <label for="new-password">New password</label>
    <input type="password" id="new-password" name="new_password">
    @include('partials.field_error', ['field' => 'new_password'])
    <label for="confirm-new-password">Confirm new password</label>
    <input type="password" id="confirm-new-password" name="new_password_confirmation">
    @include('partials.field_error', ['field' => 'new_password_confirmation'])
    <input type="submit" value="Save">
  </form>
@endsection
