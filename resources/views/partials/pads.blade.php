<h4 id="logo">My pads</h4>
<nav>
    <ul class="pads">
    @foreach ($pads as $pad)
        <li><a href="{{ URL::route('view-pad', ['id' => $pad->id]) }}">{{ $pad->name }}</a></li>
    @endforeach
    </ul>
    <hr />
    <a href="{{ URL::route('create-pad') }}">New pad</a>
</nav>
