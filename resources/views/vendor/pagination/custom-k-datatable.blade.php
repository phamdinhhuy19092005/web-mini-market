@if ($paginator->hasPages())
        <ul class="k-datatable__pager-nav pagination">
            {{-- Nút First --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <button title="First" class="page-link" {{ $paginator->onFirstPage() ? 'disabled' : '' }}
                    onclick="window.location.href='{{ $paginator->url(1) }}'">
                    <i class="la la-angle-double-left" style="font-size: 14px;"></i>
                </button>
            </li>

            {{-- Nút Previous --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <button title="Previous" class="page-link" {{ $paginator->onFirstPage() ? 'disabled' : '' }}
                    onclick="window.location.href='{{ $paginator->previousPageUrl() }}'">
                    <i class="la la-angle-left" style="font-size: 14px;"></i>
                </button>
            </li>

            {{-- Các số trang --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <button class="page-link" data-page="{{ $page }}" title="{{ $page }}">
                                    {{ $page }}
                                </button>
                            </li>
                        @else
                            <li class="page-item">
                                <button class="page-link" onclick="window.location.href='{{ $url }}'"
                                    data-page="{{ $page }}" title="{{ $page }}">
                                    {{ $page }}
                                </button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Nút Next --}}
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <button title="Next" class="page-link" {{ $paginator->hasMorePages() ? '' : 'disabled' }}
                    onclick="window.location.href='{{ $paginator->nextPageUrl() }}'">
                    <i class="la la-angle-right" style="font-size: 14px;"></i> </button>
            </li>

            {{-- Nút Last --}}
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <button title="Last" class="page-link" {{ $paginator->hasMorePages() ? '' : 'disabled' }}
                    onclick="window.location.href='{{ $paginator->url($paginator->lastPage()) }}'">
                    <i class="la la-angle-double-right" style="font-size: 14px;"></i> </button>
            </li>
        </ul>
@endif
