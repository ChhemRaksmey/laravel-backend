@extends('components.layouts.app')

@push('styles')

@endpush

@section('contents')

    <form action="{{ route($page_route .'cancel') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <h4 @class(['card-title'])>{{ $page_title ?? "" }}</h4>
            </div>
            <div class="col-md-6 text-end">
                <button name="client-action" value="cancel" class="btn btn-light waves-effect waves-light" type="submit">
                    <i class="dripicons-return"></i>
                </button>
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
                        <div class="row">
                            <div class="mb-2 col-md-5">
                                <label class="mb-1 form-label">Asset Name</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-3">
                                <label class="mb-1 form-label">Account Name</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">Asset Code</label>
                                <input disabled="true" name="id_account" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">Legacy Code</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">Date Purchase</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">Date Expire</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">Cost (USD)</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">GDT Depreciation Method</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">GDT Depreciation Rate</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-2">
                                <label class="mb-1 form-label">GDT Exchange Rate</label>
                                <input disabled="true" name="" class="form-control">
                            </div>
                            <div class="mb-2 col-md-12">
                                <label class="mb-1 form-label">Narrative</label>
                                <textarea disabled="true" name="narrative" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
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