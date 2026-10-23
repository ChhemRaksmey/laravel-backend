@props([
    'rows' => null
])

@if ($rows && $rows->total() > 0)
    <div class="mt-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
        
        <div class="text-muted small mb-2 mb-md-0">
            Showing <span class="fw-bold">{{ $rows->firstItem() ?? 0 }}</span> 
            to <span class="fw-bold">{{ $rows->lastItem() ?? 0 }}</span> 
            of <span class="fw-bold">{{ $rows->total() }}</span> 
            results
        </div>

        <div>
            {{ $rows->links('pagination::bootstrap-4') }}
        </div>
        
    </div>
@endif