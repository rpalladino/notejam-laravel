@extends('notes.list')

@section('title')
    {{ $pad->name }} ({{ $pad->notes()->count() }})
@endsection
