<?php
// config
$link_limit = 6; // maximum number of links (a little bit inaccurate, but will be ok for now)
$half_total_links = floor($link_limit / 2);
$from = $paginator->currentPage() - $half_total_links;
$to = $paginator->currentPage() + $half_total_links;
if ($paginator->currentPage() < $half_total_links) {
    $to += $half_total_links - $paginator->currentPage();
}
if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
}
?>

@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        <li class="{{ ($paginator->onFirstPage()) ? 'page-item disabled' : 'page-item ' }}">
            <a href="{{ $paginator->url(1) }}" class="page-link">First</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($from < $i && $i < $to)
                <li class="{{ ($paginator->currentPage() == $i) ? 'page-item active' : 'page-item ' }}">
                    <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endif
        @endfor
        @if($paginator->currentPage() + $half_total_links < $paginator->lastPage())
            <li class="page-item disabled">
                <a href="{{ $paginator->url($i) }}" class="page-link">...</a>
            </li>
            <li class="{{ ($paginator->lastPage() == $paginator->currentPage()) ? 'page-item active' : 'page-item ' }}">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">{{ $paginator->lastPage() }}</a>
            </li>
        @endif
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'page-item disabled' : 'page-item ' }}">
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">Last</a>
        </li>
    </ul>
@endif