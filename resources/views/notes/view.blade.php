@extends('layouts.app')

@section('title', $note->name)

@section('content')
  <p class="hidden-text">Last edited at {{ $note->updated_at->diffForHumans() }}</p>
  <div class="note">
    <p>
        {!! nl2br($note->text) !!}
    </p>
  </div>
  <button type="button">Edit</button>
  <a href="#" class="delete-note">Delete it</a>
@endsection
