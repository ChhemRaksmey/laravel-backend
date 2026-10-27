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
                        
                        <div class="mb-2 row">

                            <div class="mb-3 font-size-12 col-md-2">
                                <label class="mb-1 form-label">Resource ID</label>
                                <input disabled readonly class="form-control" value="{{ $data_master->recid }}" />
                            </div>

                            <div class="mb-3 font-size-12 col-md-8">
                                <label class="mb-1 form-label">Resource Name</label>
                                <input disabled readonly class="form-control" value="{{ $data_master->full_name }}" />
                            </div>

                            <div class="mb-3 font-size-12 col-md-2">
                                <label class="mb-1 form-label">Status</label>
                                <input disabled readonly class="form-control" value="{{ $data_master->status == 'Y' ? 'Active' : 'Disabled' }}" />
                            </div>

                            <div class="mb-3 font-size-12 col-md-12">
                                <label class="mb-1 form-label">End-Point</label>
                                <input disabled readonly class="form-control" value="{{ $data_master->end_point }}" />
                            </div>

                        </div>

                    </div>

                    <div @class(['tab-pane']) role="tabpanel" id="tab-frmCreate-audit">
                        <x-aduit />
                    </div>
                
                </div>
                
            </div>
        </div>

    </form>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){});
    </script>
@endpush