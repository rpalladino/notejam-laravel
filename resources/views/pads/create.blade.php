@extends('layouts.app')

@section('title', 'New pad')

@section('content')
    <form class="pad" method="post">
        {{ csrf_field() }}
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        @include('partials.field_error', ['field' => 'name'])
        <input type="submit" value="Save">
    </form>
@endsection
