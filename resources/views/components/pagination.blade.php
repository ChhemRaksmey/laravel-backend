@props([
    'rows' => null
])

<div class="mt-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
    
    {{-- 1. Always show the text summary --}}
    <div class="text-muted small mb-2 mb-md-0">
        Showing <span class="fw-bold">{{ $rows->firstItem() ?? 0 }}</span> 
        to <span class="fw-bold">{{ $rows->lastItem() ?? 0 }}</span> 
        of <span class="fw-bold">{{ $rows->total() }}</span> 
        results
    </div>

    {{-- 2. Only show the links if there is more than 1 page --}}
    @if ($rows->hasPages())
        <div>
            {{ $rows->links('pagination::bootstrap-4') }}
        </div>
    @endif
    
</div>