@extends('layouts.app')

@section('title', 'All Notes')

@section('content')
  <table class="notes">
     <tr>
       <th class="note">Note <a href="#" class="sort_arrow" >&uarr;</a><a href="#" class="sort_arrow" >&darr;</a></th>
       <th>Pad</th>
       <th class="date">Last modified <a href="#" class="sort_arrow" >&uarr;</a><a href="#" class="sort_arrow" >&darr;</a></th>
     </tr>
  @foreach($notes as $note)
     <tr>
         <td><a href="#">{{ $note->name }}</a></td>
         <td class="pad">No pad</td>
         <td class="hidden-text date">
             {{ $note->created_at->diffForHumans() }}
         </td>
     </tr>
  @endforeach
   </table>
   <a href="{{ URL::route('create-note') }}" class="button">New note</a>
   <!-- <div class="pagination">
     <a href="#">1</a>
     2
     <a href="#">3</a>
     <a href="#">4</a>
   </div> -->
 </div>
@endsection
