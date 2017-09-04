@if ($paginator->hasPages())

    @if ($paginator->onFirstPage())
    <a class="previous_link disabled" href="javascript:previous();" aria-label="previous">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </a>
      @else
        <a class="previous_link" href="{{ $paginator->previousPageUrl() }}" aria-label="previous">
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
    @endif

          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
              {{-- "Three Dots" Separator --}}
              @if (is_string($element))

                  <a class="page_link"  longdesc="0">{{ $element }}</a>
              @endif

              {{-- Array Of Links --}}
              @if (is_array($element))
                  @foreach ($element as $page => $url)
                      @if ($page == $paginator->currentPage())
                        <a class="page_link active_page"  longdesc="0">{{ $page }}</a>

                      @else
                          <a class="page_link " href="{{ $url }}" longdesc="1">{{ $page }}</a>

                      @endif
                  @endforeach
              @endif
          @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a class="next_link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>
    @else
    <a class="next_link disabled"  aria-label="Next">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>
    @endif

@endif

<?php /*
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
