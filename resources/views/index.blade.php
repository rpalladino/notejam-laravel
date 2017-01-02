@extends('layouts.app')

@section('title', 'All Notes')

@section('content')
  @if (session('signup_success'))
    <div class="alert alert-success">
        {{ session('signup_success') }}
    </div>
  @endif
@endsection
