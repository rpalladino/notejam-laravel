@extends('layouts.app')

@section('title')
    All Notes ({{ Request::user()->notes()->count() }})
@endsection

@section('content')
    @forelse($notes as $note)
        @if ($loop->first)
            <table class="notes">
                <tr>
                    <th class="note">Note <a href="?order=name" class="sort_arrow" >&uarr;</a><a href="?order=-name" class="sort_arrow" >&darr;</a></th>
                    <th>Pad</th>
                    <th class="date">Last modified <a href="?order=updated" class="sort_arrow" >&uarr;</a><a href="?order=-updated" class="sort_arrow" >&darr;</a></th>
                </tr>
        @endif
                <tr>
                    <td class="name"><a href="{{ URL::route('note', ['id' => $note->id]) }}">{{ $note->name }}</a></td>
                    <td class="pad">
                        @if ($note->pad)
                            {{ $note->pad->name }}
                        @else
                            No pad
                        @endif
                    </td>
                    <td class="hidden-text date">
                     {{ $note->updated_at->diffForHumans() }}
                    </td>
                </tr>
        @if ($loop->last)
            </table>
        @endif
    @empty
        <p class="empty">Create your first note.</p>
    @endforelse
        <a href="{{ URL::route('create-note') }}" class="button">New note</a>
        {{ $notes->links() }}
    </div>
@endsection
