@if ($paginator->hasPages())
    <div class="pagination">
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{ $page }}
                    @else
                        <a href="{{ $url }}&amp;order={{ Request::get('order', App\Http\Controllers\Note\ListController::DEFAULT_SORT_ORDER)}}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>
@endif
