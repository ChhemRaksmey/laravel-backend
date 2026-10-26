@extends('components.layouts.app')

@push('styles')

@endpush

@section('contents')

    <div class="row mb-3">
        <div class="col-md-6">
            <h4 @class(['card-title'])>{{ $page_title ?? "" }}</h4>
        </div>
        <div class="col-md-6 text-end">
            <a class="btn btn-sm btn-light waves-effect waves-light" type="button" href="{{ route($path_route, []) }}">
                <div class="fas fa-sync-alt"></div>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th class="py-1 col-3">Resources Name</th>
                                <th class="py-1 col-7">End-Point</th>
                                <th class="py-1 col-1 text-center">Status</th>
                                <th class="py-1 col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_list ?? [] as $item)
                                <tr>
                                    <td class="py-1">{{ $item->full_name }}</td>
                                    <td class="py-1">{{ $item->end_point }}</td>
                                    <td class="py-1 text-center">{{ $item->status }}</td>
                                    <td class="py-1 text-center">
                                        <div class="btn-group">
                                            <a aria-expanded="false" class="text-primary" data-bs-toggle="dropdown" type="button">
                                                <i class="mdi mdi-cogs"></i>
                                            </a>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="{{ route($path_route, [ 'client-action' => 'pgae_view', 'recid' => $item->recid ]) }}">View</a>
                                                <a class="dropdown-item" href="{{ route($path_route, [ 'client-action' => 'pgae_edit', 'recid' => $item->recid ]) }}">Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <h4 class="text-muted">There Are No Records to Display!</h4>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            @if(session('success'))
                toastr["success"]("{{ session('success') }}");
            @endif
        });
    </script>
@endpush