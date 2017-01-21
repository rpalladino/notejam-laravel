@extends('layouts.app')

@section('title', $note->name)

@section('content')
    <form class="note" method="post">
        {{ csrf_field() }}
        <p>Are you sure you want to delete <strong>{{ $note->name }}</strong> note?</p>
        <input type="submit" value="Yes, I want to delete this note" class="button red">
        <a href="{{ URL::previous() }}">Cancel</a>
    </form>
@endsection
