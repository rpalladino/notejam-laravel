<form class="note" method="post">
  {{ csrf_field() }}

  <label for="name">Name</label>
  <input type="text" id="name" name="name" value="{{ $note->name }}">
  @include('partials.field_error', ['field' => 'name'])

  <label for="text">Note</label>
  <textarea id="text" name="text">{{ $note->text }}</textarea>
  @include('partials.field_error', ['field' => 'text'])

  <label for="list">Select Pad</label>
  <select id="list" name="pad">
    <option value="0">--------</option>
    @foreach ($pads as $pad)
        <option value="{{ $pad->id }}"{{ ($pad->id === $note->pad_id) ? ' selected="selected"' : '' }}>
            {{ $pad->name }}
        </option>
    @endforeach
  </select>

  <input type="submit" value="Save">
</form>
