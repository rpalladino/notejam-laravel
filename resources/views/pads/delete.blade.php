@extends('layouts.app')

@section('title', $pad->name)

@section('content')
    <form class="pad" method="post">
        {{ csrf_field() }}
        <p>Are you sure you want to delete <strong>{{ $pad->name }}</strong> pad?</p>
        <input type="submit" value="Yes, I want to delete this pad" class="button red">
        <a href="{{ URL::previous() }}">Cancel</a>
    </form>
@endsection
