<form class="note" method="post">
  {{ csrf_field() }}

  <label for="name">Name</label>
  <input type="text" id="name" name="name" value="{{ $note->name }}">
  @include('partials.field_error', ['field' => 'name'])

  <label for="text">Note</label>
  <textarea id="text" name="text">{{ $note->text }}</textarea>
  @include('partials.field_error', ['field' => 'text'])

  <label for="list">Select Pad</label>
  <select id="list">
    <option value="0">--------</option>
    <option value="1">Business</option>
    <option value="2">Personal</option>
    <option value="3">Other</option>
  </select>

  <input type="submit" value="Save">
</form>
