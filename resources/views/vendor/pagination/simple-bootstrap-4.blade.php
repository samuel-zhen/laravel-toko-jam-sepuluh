@if ($paginator->hasPages())
    <div class="ui pagination menu">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="disabled item"><i class="angle left icon"></i> Prev</div>
        @else
            <a class="item" href="{{ $paginator->previousPageUrl() }}"><i class="angle left icon"></i> Prev</a>
        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="item" href="{{ $paginator->nextPageUrl() }}">Next <i class="angle right icon"></i></a>
        @else
            <div class="disabled item">Next <i class="angle right icon"></i></div>
        @endif
    </div>
@endif