@extends('components.layouts.app')

@push('styles')

@endpush

@section('contents')

    <form action="{{ route($path_route) }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <h4 @class(['card-title'])>{{ $page_title ?? "" }}</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route($path_route) }}" class="btn btn-sm btn-light waves-effect waves-light" type="submit">
                    <i class="dripicons-return"></i>
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                
                <ul @class(['nav', 'nav-pills']) role="tablist">
                    <li @class(['nav-item', 'waves-effect', 'waves-light']) role="presentation">
                        <a href="#tab-frmCreate-master" @class(['py-1', 'w-sm', 'text-center', 'nav-link', 'active']) data-bs-toggle="tab" role="tab" aria-selected="true">
                            <span @class(['d-none', 'd-sm-block'])>Master</span>
                        </a>
                    </li>
                    <li @class(['nav-item', 'waves-effect', 'waves-light']) role="presentation">
                        <a href="#tab-frmCreate-audit" @class(['py-1', 'w-sm', 'text-center', 'nav-link']) data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">
                            <span @class(['d-none', 'd-sm-block'])>Audit</span>
                        </a>
                    </li>
                </ul>

                <div @class(['tab-content', 'pt-3 pb-2', 'text-muted'])>

                    <div @class(['tab-pane', 'active']) role="tabpanel" id="tab-frmCreate-master">
                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Customer Type</label>
                            <div class="col-md-10">
                                <input disabled class="form-control" type="text" value="{{ $data_master->full_name }}" />
                            </div>
                        </div>

                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="py-1 col-10">Country Name</th>
                                    <th class="py-1 col-2 text-center">Risk Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data_list ?? [] as $item)
                                    <tr>
                                        <td class="py-1">{{ $item->full_name }}</td>
                                        <td class="py-1 text-center">
                                            <i class="text-primary dripicons-checkmark"></i>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4">
                                            <h4 class="text-muted">There Are No Records to Display!</h4>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                    <div @class(['tab-pane']) role="tabpanel" id="tab-frmCreate-audit">
                        <div class="row">
                            <div class="mb-1 col-md-3">Current Number: </div>
                            <div class="mb-1 col-md-9">Record Status:</div>
                            <div class="mb-1 col-md-12">Override 1:</div>
                            <div class="mb-1 col-md-12">Override 2:</div>
                            <div class="mb-1 col-md-12">Override 3:</div>
                            <div class="mb-1 col-md-3">Date Time: {{ date('Y M d H:i') }}</div>
                            <div class="mb-1 col-md-9">Inputter: (U9999) System Migrator User</div>
                            <div class="mb-1 col-md-3">Date Time: {{ date('Y M d H:i') }}</div>
                            <div class="mb-1 col-md-9">Authoriser 1: (U9999) System Migrator User</div>
                            <div class="mb-1 col-md-3">Date Time: {{ date('Y M d H:i') }}</div>
                            <div class="mb-1 col-md-9">Authoriser 2: (U9999) System Migrator User</div>
                        </div>
                    </div>
                
                </div>
                
            </div>
        </div>

    </form>

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