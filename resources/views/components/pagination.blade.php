@props([
    'paginator',
    'perPage' => request('perPage', 10),
    'route' => url()->current(),
])

<div class="d-flex justify-content-between align-items-center mt-3">

    <div class="text-muted">
        {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} de {{ $paginator->total() }}
    </div>

    <div>
        <a href="{{ $paginator->previousPageUrl() }}&perPage={{ $perPage }}" class="btn btn-sm btn-light {{ $paginator->onFirstPage() ? 'disabled' : '' }}">&lt;</a>
        <a href="{{ $paginator->nextPageUrl() }}&perPage={{ $perPage }}" class="btn btn-sm btn-light {{ $paginator->hasMorePages() ? '' : 'disabled' }}">&gt;</a>
    </div>
</div>
