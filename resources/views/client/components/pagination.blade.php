@if ($paginator->hasPages())
    <div class="box-pagination">
        <ul>
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" {!! $paginator->onFirstPage() ? 'class="disabled"' : '' !!}>
                    <i class="fas fa-angle-double-left"></i>
                </a>
            </li>

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <a class="disabled">{{ $element }}</a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            <a href="{{ $url }}" class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            <li>
                <a href="{{ $paginator->nextPageUrl() }}" {!! $paginator->hasMorePages() ? '' : 'class="disabled"' !!}>
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </li>
        </ul>
    </div>
@endif
