<?php
// config
$link_limit = 11; // maximum number of links
?>
@if ($paginator->lastPage() > 1)
    <nav class="main-pagination pagination-numbers" data-type="numbers">
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if($paginator->currentPage() == $i)
                <span aria-current="page" class="page-numbers current">{{ $i }}</span>
            @else
                <a class="page-numbers" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
        @endfor
    </nav>
@endif