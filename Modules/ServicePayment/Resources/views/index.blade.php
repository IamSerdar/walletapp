@extends('layouts.app')
@section('css')
<style>
    @media only screen and (max-width: 1000px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        /* Force table to not be like tables anymore */
        .table,
        .thead,
        .tbody,
        .th,
        .td,
        .tr {
            display: block !important;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        .tb-tnx-head .tr {
            position: absolute !important;
            top: -9999px !important;
            left: -9999px !important;
        }

        .tr {
            padding: 0px 10px;
            border: none !important;
            border-bottom: 10px solid #f5f6fa !important;
        }

        .td {
            /* Behave  like a "row" */
            border: none !important;
            border-bottom: 1px solid #eee !important;
            position: relative !important;
            padding-left: 50% !important;
        }

        .td:before {
            /* Now like a table header */
            position: absolute !important;
            /* Top/left values mimic padding */
            top: 6px !important;
            left: 6px !important;
            width: 45% !important;
            padding-right: 10px !important;
            white-space: nowrap !important;
        }

        .td:nth-of-type(1):before {
            content: "#";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(2):before {
            content: "User";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(3):before {
            content: "From";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(4):before {
            content: "To";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(5):before {
            content: "Amount";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(6):before {
            content: "Status";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(7):before {
            content: "Created At";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(8):before {
            content: "";
            color: black !important;
            font-weight: 700
        }
    }

    .w-data-input {
        width: 128px !important
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .w-data-input {
            width: 128px !important;
        }
    }

    @media screen and (min-device-width: 280px) and (max-device-width: 747px) {
        .w-data-input {
            width: 137px!important;
        }
    }


    @media screen and (min-device-width: 390px) and (max-device-width: 844px) {
        .w-data-input {
            width: 125px!important;
        }
    }

    @media screen and (min-width: 1024px){
        .wid250 {
            width: 250px!important;
        }
        .wid150 {2
            width: 150px!important;
        }
        .wid50 {
            width: 50px!important;
        }
    }

</style>
@endsection
@section('content')
<!-- content @s -->
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between-md g-4">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">Service Payments list</h3>
                                    <div class="nk-block-des text-soft">
                                        <p>There are {{ $count }} service accounts</p>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div>
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools gx-3">
                                    <li>
                                        <a href="{{ route('servicePayments.create') }}" class="btn btn-white btn-dim btn-outline-primary">
                                            <em class="icon ni ni-plus"></em><span class="d-none d-sm-inline-block">Create New</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('servicePayments.') }}" method="get" class="mb-3">
                        <div class="row g-1">
                          <div class="col-md-9">
                                <div class="form-group">
                                  <input type="text" name="search" class="form-control  form-control-lg" value="{{ request('search') }}" placeholder="@lang('main.search')" aria-label="search">
                                </div>
                          </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select class="form-select select2" id="status" name="status" data-ui="lg"
                                                    data-placeholder="Status" aria-label="status">
                                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                                            <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>Process</option>
                                            <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                                            <option value="fail" {{ request('status') == 'fail' ? 'selected' : '' }}>Fail</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                          <div class="col-md-1">
                            <button class="btn btn-primary btn-lg"><em class="icon ni ni-search"></em></button>
                          </div>
                        </div>
                    </form>
                    <div class="nk-block">
                        <div class="card card-bordered mb-2">
                            <table class="table">
                                <thead class="tb-tnx-head">
                                    <tr class="tr">
                                        <th class="th nk-tb-col">#</th>
                                        <th class="th">User</th>
                                        <th class="th">From</th>
                                        <th class="th">To</th>
                                        <th class="th">Amount</th>
                                        <th class="th">Status</th>
                                        <th class="th">Created At</th>
                                        <th class="th">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    @foreach ($servicePayments as $servicePayment)
                                    <tr class="tr">
                                        <td class="td">{{ $servicePayment->id }}</td>
                                        <td class="td">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $servicePayment->user->username }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="from{{$servicePayment->id}}">
                                                    {{ $servicePayment->from_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#from{{$servicePayment->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="to{{$servicePayment->id}}">
                                                    {{ $servicePayment->to_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#to{{$servicePayment->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="td">
                                            {{ $servicePayment->amount }}
                                        </td>
                                        <td class="td">
                                            <div class="tb-tnx-status">
                                                <span
                                                    @if ($servicePayment->status == 'process')
                                                        class="badge badge-warning"
                                                    @elseif ($servicePayment->status == 'success')
                                                        class="badge badge-success"
                                                    @elseif ($servicePayment->status == 'fail')
                                                        class="badge badge-danger"
                                                    @endif
                                                >
                                                    {{ $servicePayment->status }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="td">
                                            @if ($servicePayment->created_at)
                                                {{ $servicePayment->created_at }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="td">
                                            <ul class="nk-tb-actions gx-1">
                                                @if ($servicePayment->status == 'process')
                                                    <li class="nk-tb-action">
                                                        <a href="#" onclick="document.getElementById('servicePayment-{{ $servicePayment->id }}-success').submit();"
                                                            class="btn btn-trigger btn-icon link-cross link-eye mr-sm-n1" title="success"
                                                            data-status="success" data-collapse="false" >
                                                                <em class="icon ni ni-check-c"></em>
                                                        </a>
                                                        <form action="{{ route('servicePayments.change-status', ['service_payment_id' => $servicePayment->id, 'status' => 'success'])}}"
                                                                method="post" id="servicePayment-{{ $servicePayment->id }}-success">
                                                            @csrf
                                                            @method('post')
                                                        </form>
                                                    </li>
                                                    <li class="nk-tb-action">
                                                        <a href="#" onclick="document.getElementById('servicePayment-{{ $servicePayment->id }}-fail').submit();"
                                                            class="btn btn-trigger btn-icon link-cross link-eye mr-sm-n1" title="fail"
                                                            data-status="fail" data-collapse="false">
                                                                <em class="icon ni ni-cross-c"></em>
                                                        </a>
                                                        <form action="{{ route('servicePayments.change-status', ['service_payment_id' => $servicePayment->id, 'status' => 'fail'])}}"
                                                                method="post" id="servicePayment-{{ $servicePayment->id }}-fail">
                                                            @csrf
                                                            @method('post')
                                                        </form>
                                                    </li>
                                                    <li class="nk-tb-action">
                                                        <a href="{{ route('servicePayments.edit', $servicePayment->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <em class="icon ni ni-edit-alt"></em>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="nk-tb-action">
                                                        <a href="#" onclick="if (confirm('Do you want remove?')) { document.getElementById('destroy-{{ $servicePayment->id }}').submit(); }"
                                                            class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Poz">
                                                            <em class="icon ni ni-trash"></em>
                                                        </a>
                                                        <form action="{{ route('servicePayments.destroy', $servicePayment->id) }}" method="post" id="destroy-{{ $servicePayment->id }}">
                                                            @method('delete')
                                                            @csrf
                                                          </form>
                                                    </li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $servicePayments->appends(request()->input())->onEachSide(1)->render() !!}

                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
<!-- content @e -->
@endsection
