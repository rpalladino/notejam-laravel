@extends('layouts.app')

@section('title', $note->name)

@section('content')
  <p class="hidden-text">Last edited {{ $note->updated_at->diffForHumans() }}</p>
  <div class="note">
    <p>
        {!! nl2br($note->text) !!}
    </p>
  </div>
  <a href="{{ URL::route('edit-note', ['id' => $note->id]) }}" class="button">Edit</a>
  <a href="#" class="delete-note">Delete it</a>
@endsection
