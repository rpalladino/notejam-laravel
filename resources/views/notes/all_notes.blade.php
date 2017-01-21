@extends('layouts.app')

@section('title', $title)

@section('content')
  <table class="notes">
     <tr>
       <th class="note">Note <a href="?order=name" class="sort_arrow" >&uarr;</a><a href="?order=-name" class="sort_arrow" >&darr;</a></th>
       <th>Pad</th>
       <th class="date">Last modified <a href="?order=updated" class="sort_arrow" >&uarr;</a><a href="?order=-updated" class="sort_arrow" >&darr;</a></th>
     </tr>
  @foreach($notes as $note)
     <tr>
         <td class="name"><a href="{{ URL::route('note', ['id' => $note->id]) }}">{{ $note->name }}</a></td>
         <td class="pad">No pad</td>
         <td class="hidden-text date">
             {{ $note->updated_at->diffForHumans() }}
         </td>
     </tr>
  @endforeach
   </table>
   <a href="{{ URL::route('create-note') }}" class="button">New note</a>
   {{ $notes->links() }}
 </div>
@endsection
