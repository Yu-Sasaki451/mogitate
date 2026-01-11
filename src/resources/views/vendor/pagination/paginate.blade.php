@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Pagination">
    <ul class="pager__list">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <li class="pager__item">
                <span class="pager__link pager__link--arrow pager__link--disabled" aria-disabled="true">‹</span>
            </li>
        @else
            <li class="pager__item">
                <a class="pager__link pager__link--arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                    ‹
                </a>
            </li>
        @endif

        {{-- Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="pager__item">
                    <span class="pager__gap">{{ $element }}</span>
                </li>
            @else
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pager__item">
                            <span class="pager__link pager__link--active" aria-current="page">{{ $page }}</span>
                        </li>
                    @else
                        <li class="pager__item">
                            <a class="pager__link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="pager__item">
                <a class="pager__link pager__link--arrow" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                    ›
                </a>
            </li>
        @else
            <li class="pager__item">
                <span class="pager__link pager__link--arrow pager__link--disabled" aria-disabled="true">›</span>
            </li>
        @endif
    </ul>
</nav>
@endif
