<div class="d-sm-flex justify-content-between align-items-center mt-4 mb-2">
    <div class="visible-entries"></div>
    <nav class="site-pagination">
        @if ($paginator->hasPages())
        <ul class="pagination mb-0">
            @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            </li>
            @endif
            @foreach ($elements as $element)

            @if (is_string($element))
            <li class="disabled page-item"><a class="page-link" href="">{{ $element }}</a></li>
            @endif
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active my-active"><a class="page-link" href="#">{{ $page }}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach  
            
            @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
            @else
            <li class="page-item disabled"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
            @endif
        </ul>
        @endif
    </nav>
</div>


