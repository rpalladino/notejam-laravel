@extends('layouts.app')

@section('title', $note->name)

@section('content')
    @include('partials.note_form')
@endsection
