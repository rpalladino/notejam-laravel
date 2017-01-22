@extends('layouts.app')

@section('title', $pad->name)

@section('content')
    <form class="pad" method="post">
        {{ csrf_field() }}
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $pad->name }}">
        @include('partials.field_error', ['field' => 'name'])
        <input type="submit" value="Save">

        <a href="{{ URL::route('delete-pad', ['id' => $pad->id]) }}" class="delete-note">Delete it</a>
    </form>
@endsection
