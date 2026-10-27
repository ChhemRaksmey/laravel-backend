@extends('components.layouts.app')

@push('styles')

@endpush

@section('contents')

    <form action="{{ route($path_route, [ "recid" => $recid ]) }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <h4 @class(['card-title'])>{{ $page_title ?? "" }}</h4>
            </div>
            <div class="col-md-6 text-end">
                <button name="client-action" value="save_edit" class="btn btn-sm btn-outline-primary waves-effect waves-light" type="submit">
                    <i class="fas fa-check me-2"></i> Submit
                </button>
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
                                            <div class="text-center form-check form-check-primary">
                                                <label class="form-check-label">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="countries[{{ $item->recid }}]"
                                                        @checked(
                                                            old('countries')
                                                            ? array_key_exists($item->recid, old('countries'))
                                                            : in_array($item->recid, $ris_countries, true)
                                                        )
                                                    />
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4">
                                            <h4 class="text-muted">there no record to display !</h4>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

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
        $(document).ready(function(){
            $(".select2").select2();
        });
    </script>
@endpush