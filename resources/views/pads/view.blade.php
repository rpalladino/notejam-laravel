@extends('notes.list')

@section('title')
    <a href="{{ URL::route('edit-pad', ['id' => $pad->id]) }}">{{ $pad->name }}</a> ({{ $pad->notes()->count() }})
@endsection
