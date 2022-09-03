@if ($paginator->lastPage() > 1)
    <nav aria-label="Page navigation example">
        <ul class="pagination" style="justify-content: flex-end;">
            <li class="{{ ($paginator->currentPage() == 1) ? ' disabled page-item' : 'page-item' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}" aria-label="Previous">
                    <<
                </a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-label="Next">
                    >>
                </a>
            </li>
        </ul>
    </nav>
@endif