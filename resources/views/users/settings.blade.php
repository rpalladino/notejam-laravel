@extends('layouts.app')

@section('content')
  @if (session('settings-changed'))
    <div class="alert-area">
      <div class="alert alert-success">Password is successfully changed</div>
    </div>
  @endif
  <form class="offset-by-six sign-in" method="post">
    {{ csrf_field() }}
    <label for="current-password">Current password</label>
    <input type="password" id="current-password" name="current_password">
    <label for="new-password">New password</label>
    <input type="password" id="new-password" name="new_password">
    <label for="confirm-new-password">Confirm new password</label>
    <input type="password" id="confirm-new-password" name="new_password_confirmation">
    <input type="submit" value="Save">
  </form>
@endsection
