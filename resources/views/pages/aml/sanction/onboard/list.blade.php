@extends('components.layouts.app')

@push('styles')

@endpush

@section('contents')

    <form action="{{ route($path_route, [ 'client-action' => 'submit-search' ]) }}" method="get">

        <div class="row mb-3">
            <div class="col-md-6">
                <h4 @class(['card-title'])>{{ $page_title ?? "" }}</h4>
            </div>
            <div class="col-md-6 text-end">
                <button class="w-sm btn btn-light waves-effect waves-light" type="submit">
                    <i class="me-2 bx bx-filter-alt"></i> Screening
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label class="mb-1 form-label">Customer name</label>
                        <input name="searchName" class="form-control" value="" />
                    </div>
                    <div class="mb-3 col-md-2">
                        <label class="mb-1 form-label">Customer Type</label>
                        <select name="searchCustomerType" @class(['form-control', 'select2'])>
                            <option value="">None Define</option>
                            @foreach($list_customer_type as $item)
                                <option value="{{ $item->recid }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-2">
                        <label class="mb-1 form-label">Legal Document No</label>
                        <input name="searchLegalDocumentNo" class="form-control" value="" />
                    </div>
                    <div class="mb-3 col-md-2">
                        <label class="mb-1 form-label">Date Issue</label>
                        <div @class(['input-group']) id="picker-date-issue-group">
                            <input name="searchDateIssue" @class(['form-control']) data-date-autoclose="true" data-date-container="#picker-date-issue-group" data-date-format="yyyy M dd" data-provide="datepicker" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="mb-1 form-label">Nationality</label>
                        <select name="searchNationality" @class(['form-control', 'select2'])>
                            <option value="">None Define</option>
                            @foreach($list_countries as $item)
                                <option value="{{ $item->recid }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
    </form>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    @if(sizeof($data_list) > 0)

                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="py-1 col-1 text-center">Resource</th>
                                    <th class="py-1 col-3">Snaction Name</th>
                                    <th class="py-1 col-3">Nationality</th>
                                    <th class="py-1 col-2">Legal Document</th>
                                    <th class="py-1 col-1 text-center">Issue Date</th>
                                    <th class="py-1 col-1 text-center">Similar</th>
                                    <th class="py-1 col-1 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_list as $item)
                                    <tr>
                                        <td class="py-1 text-center">{{ $item->recid }}</td>
                                        <td class="py-1">{{ $item->recid }}</td>
                                        <td class="py-1">{{ $item->recid }}</td>
                                        <td class="py-1">{{ $item->recid }}</td>
                                        <td class="py-1 text-center">{{ date('Y M d') }}</td>
                                        <td class="py-1 text-center">
                                            <strong class="text-danger">90.00% HIGH</strong>
                                        </td>
                                        <td class="py-1 text-center">
                                            <a href="{{ route($path_route, [ 'client-action' => 'pgae_view', 'recid' => $item->recid ]) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <x-pagination :rows="$data_list" />

                    @else
                        <div colspan="3" class="text-center py-4">
                            <h4 class="text-muted">there no record to display !</h4>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            $(".select2").select2();

            $("#picker-date-issue").timepicker({
                showMeridian: !1,
                icons: { up: "mdi mdi-chevron-up", down: "mdi mdi-chevron-down" },
                appendWidgetTo: "#picker-date-issue-group",
            });

        });
    </script>
@endpush