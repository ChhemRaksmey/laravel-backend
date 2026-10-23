@extends('components.layouts.app')

@push('styles')

@endpush

@section('contents')

    <div class="row">
        <div class="col-md-6">
            <h4 @class(['card-title'])>{{ $page_title ?? "" }}</h4>
        </div>
        <div class="col-md-6 text-end">
            <a class="btn btn-light waves-effect waves-light" type="button">
                <div class="fas fa-sync-alt"></div>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table -striped">
                        <thead>
                            <tr>
                                <th class="py-1 col-2 text-center">Account Name</th>
                                <th class="py-1 col-9">Full Name</th>
                                <th class="py-1 col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-1 text-center">COE</td>
                                <td class="py-1">Computer Equipment</td>
                                <td class="py-1 text-center">
                                    <div class="btn-group">
                                        <a aria-expanded="false" class="text-primary" data-bs-toggle="dropdown" type="button">
                                            <i class="mdi mdi-cogs"></i>
                                        </a>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="{{ route($page_route .'view', [ 'recid' => '12345' ]) }}">View</a>
                                            <a class="dropdown-item" href="{{ route($page_route .'edit', [ 'recid' => '12345' ]) }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route($page_route .'authorize', [ 'recid' => '12345' ]) }}">Authorize</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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