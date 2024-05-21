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
            content: "Type";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(2):before {
            content: "From";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(3):before {
            content: "To";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(4):before {
            content: "Amount";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(5):before {
            content: "Status";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(6):before {
            content: "Created At";
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
{{--
<div class="card card-bordered card-full">
    <div class="card-inner">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title"><span class="mr-2">@lang('main.transaction_activities')</span></h6>
            </div>
            <div class="card-tools">
                <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#incoming"><span>@lang('main.incoming')</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#outgoing"><span>@lang('main.outgoing')</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#all"><span>@lang('main.all')</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-inner p-0 border-top">
        <div class="nk-tb-list nk-tb-orders">
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col nk-tb-orders-type"><span>Type</span></div>
                <div class="nk-tb-col" style="width:150px"><span>@lang('main.point_name')</span></div>
                <div class="nk-tb-col tb-col-sm" style="width:150px"><span>@lang('main.category')</span></div>
                <div class="nk-tb-col tb-col-xl"style="width:100px"><span>@lang('main.date')</span></div>
                <div class="nk-tb-col tb-col-xxl" style="width:100px"><span>@lang('main.check')</span></div>
                <div class="nk-tb-col tb-col-sm text-right" style="width:200px"><span>@lang('main.balance') USD</span></div>
                <div class="nk-tb-col text-right" style="width:200px"><span>@lang('main.balance') TMT</span></div>
            </div><!-- .nk-tb-item -->
        </div>
    </div><!-- .nk-tb-item -->
    <div class="tab-content mt-0">
        <div class="tab-pane active" id="all">
            @foreach ($transactions as $transaction)
                <div class="card-inner p-0 border-top">
                    <div class="nk-tb-list nk-tb-orders">
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-orders-type">
                                @if ($transaction->type == 'incoming')
                                    <em class="bg-success-dim icon-circle icon ni ni-arrow-down-left"></em>
                                @else
                                    <em class="bg-primary-dim icon-circle icon ni ni-arrow-up-right"></em>
                                @endif
                            </div>
                            <div class="nk-tb-col" style="width:150px">
                                <span class="tb-lead">{{ $transaction->point->name }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-xl" style="width:150px">
                                <span class="tb-sub">
                                    @if(auth()->user()->isRoleAuditor() && $transaction->category->is_private)
                                        ---
                                    @else
                                        {{ $transaction->category->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-xl" style="width:100px">
                                <span class="tb-sub">{{ $transaction->date->format('y/m/d') }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-xxl" style="width:100px">
                                <span class="tb-sub text-primary">{{ $transaction->check }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-sm text-right"  style="width:200px">
                                @if ($transaction->balance_usd)
                                    <span class="tb-sub tb-amount"><span>$</span>{{ number_format($transaction->balance_usd,2) }}</span>
                                @endif
                            </div>
                            <div class="nk-tb-col text-right"  style="width:200px">
                                @if ($transaction->balance_tmt)
                                    <span class="tb-sub tb-amount ">{{ number_format($transaction->balance_tmt,2) }}<span> m.</span></span>
                                @endif
                            </div>
                        </div><!-- .nk-tb-item -->
                    </div>
                </div><!-- .nk-tb-item -->
            @endforeach
        </div>
        <div class="tab-pane" id="incoming">
            @foreach ($incomings as $transaction)
                <div class="card-inner p-0 border-top">
                    <div class="nk-tb-list nk-tb-orders">
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-orders-type">
                                <em class="bg-success-dim icon-circle icon ni ni-arrow-down-left"></em>
                            </div>
                            <div class="nk-tb-col" style="width:150px">
                                <span class="tb-lead">{{ $transaction->point->name }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-xl" style="width:150px">
                                <span class="tb-sub">
                                    @if(auth()->user()->isRoleAuditor() && $transaction->category->is_private)
                                        ---
                                    @else
                                        {{ $transaction->category->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-xl" style="width:100px">
                                <span class="tb-sub">{{ $transaction->date->format('y/m/d') }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-xxl" style="width:100px">
                                <span class="tb-sub text-primary">{{ $transaction->check }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-sm text-right"  style="width:200px">
                                @if ($transaction->balance_usd)
                                    <span class="tb-sub tb-amount"><span>$</span>{{ number_format($transaction->balance_usd,2) }}</span>
                                @endif
                            </div>
                            <div class="nk-tb-col text-right"  style="width:200px">
                                @if ($transaction->balance_tmt)
                                    <span class="tb-sub tb-amount ">{{ number_format($transaction->balance_tmt,2) }}<span> m.</span></span>
                                @endif
                            </div>
                        </div><!-- .nk-tb-item -->
                    </div>
                </div><!-- .nk-tb-item -->
            @endforeach
        </div>
        <div class="tab-pane" id="outgoing">
            @foreach ($outgoings as $transaction)
                <div class="card-inner p-0 border-top">
                    <div class="nk-tb-list nk-tb-orders">
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-orders-type">
                                <em class="bg-primary-dim icon-circle icon ni ni-arrow-up-right"></em>
                            </div>
                            <div class="nk-tb-col" style="width:150px">
                                <span class="tb-lead">{{ $transaction->point->name }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-xl" style="width:150px">
                                <span class="tb-sub">
                                    @if(auth()->user()->isRoleAuditor() && $transaction->category->is_private)
                                        ---
                                    @else
                                        {{ $transaction->category->name }}
                                    @endif
                                </span>
                            </div>
                            <div class="nk-tb-col tb-col-xl" style="width:100px">
                                <span class="tb-sub">{{ $transaction->date->format('y/m/d') }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-xxl" style="width:100px">
                                <span class="tb-sub text-primary">{{ $transaction->check }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-sm text-right"  style="width:200px">
                                @if ($transaction->balance_usd)
                                    <span class="tb-sub tb-amount"><span>$</span>{{ number_format($transaction->balance_usd,2) }}</span>
                                @endif
                            </div>
                            <div class="nk-tb-col text-right"  style="width:200px">
                                @if ($transaction->balance_tmt)
                                    <span class="tb-sub tb-amount ">{{ number_format($transaction->balance_tmt,2) }}<span> m.</span></span>
                                @endif
                            </div>
                        </div><!-- .nk-tb-item -->
                    </div>
                </div><!-- .nk-tb-item -->
            @endforeach
        </div>
    </div><!-- .nk-tb-item -->
</div><!-- .card --> --}}

<div class="card card-bordered card-full">
    <div class="card-inner">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title"><span class="mr-2">Notifications</span></h6>
            </div>
            <div class="card-tools">
                <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#all"><span>All</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#income"><span>Income</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#withdraw"><span>Withdraw</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#failed"><span>Failed</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-inner p-0 border-top">
        <div class="card card-bordered">
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <table class="table">
                        <thead class="tb-tnx-head">
                            <tr class="tr">
                                <th class="th nk-tb-col">Type</th>
                                <th class="th">From</th>
                                <th class="th">To</th>
                                <th class="th">Amount</th>
                                <th class="th">Status</th>
                                <th class="th">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($transactions as $transaction)
                                <tr class="tr">
                                    <td class="td">
                                        @if ($transaction->type == 'income')
                                            <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                <em class="icon ni ni-arrow-down-right"></em>
                                            </div>
                                        @elseif ($transaction->type == 'withdraw')
                                            <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                <em class="icon ni ni-arrow-up-right"></em>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="td">
                                        <div class="data-col">
                                            @if (@$transaction->from_address)
                                            <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="from{{$transaction->id}}">
                                                {{ $transaction->from_address }}
                                                <span class="clipboard-init" data-clipboard-target="#from{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                    <em class="clipboard-icon icon ni ni-copy"></em>
                                                </span>
                                            </span>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </td>
                                    <td class="td">
                                        <div class="data-col">
                                            @if (@$transaction->to_address)
                                            <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="to{{$transaction->id}}">
                                                {{ $transaction->to_address }}
                                                <span class="clipboard-init" data-clipboard-target="#to{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                    <em class="clipboard-icon icon ni ni-copy"></em>
                                                </span>
                                            </span>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </td>
                                    <td class="td">
                                        {{ $transaction->amount }} USDT
                                    </td>
                                    <td class="td">
                                        <div class="tb-tnx-status">
                                            <span
                                                @if ($transaction->status == 'process')
                                                    class="badge badge-warning"
                                                @elseif ($transaction->status == 'success')
                                                    class="badge badge-success"
                                                @elseif ($transaction->status == 'fail')
                                                    class="badge badge-danger"
                                                @endif
                                            >
                                                {{ $transaction->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="td">
                                        @if ($transaction->created_at)
                                            {{ $transaction->created_at }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr><!-- .nk-tb-item  -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="income">
                    <table class="table">
                        <thead class="tb-tnx-head">
                            <tr class="tr">
                                <th class="th nk-tb-col">Type</th>
                                <th class="th">From</th>
                                <th class="th">To</th>
                                <th class="th">Amount</th>
                                <th class="th">Status</th>
                                <th class="th">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($transactions as $transaction)
                                @if ($transaction->type == 'income')
                                    <tr class="tr">
                                        <td class="td">
                                            @if ($transaction->type == 'income')
                                                <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                    <em class="icon ni ni-arrow-down-right"></em>
                                                </div>
                                            @elseif ($transaction->type == 'withdraw')
                                                <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                    <em class="icon ni ni-arrow-up-right"></em>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                @if (@$transaction->from_address)
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="from{{$transaction->id}}">
                                                    {{ $transaction->from_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#from{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                @if (@$transaction->to_address)
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="to{{$transaction->id}}">
                                                    {{ $transaction->to_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#to{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td">
                                            {{ $transaction->amount }} USDT
                                        </td>
                                        <td class="td">
                                            <div class="tb-tnx-status">
                                                <span
                                                    @if ($transaction->status == 'process')
                                                        class="badge badge-warning"
                                                    @elseif ($transaction->status == 'success')
                                                        class="badge badge-success"
                                                    @elseif ($transaction->status == 'fail')
                                                        class="badge badge-danger"
                                                    @endif
                                                >
                                                    {{ $transaction->status }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="td">
                                            @if ($transaction->created_at)
                                                {{ $transaction->created_at }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="withdraw">
                    <table class="table">
                        <thead class="tb-tnx-head">
                            <tr class="tr">
                                <th class="th nk-tb-col">Type</th>
                                <th class="th">From</th>
                                <th class="th">To</th>
                                <th class="th">Amount</th>
                                <th class="th">Status</th>
                                <th class="th">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($transactions as $transaction)
                                @if ($transaction->type == 'withdraw')
                                    <tr class="tr">
                                        <td class="td">
                                            @if ($transaction->type == 'income')
                                                <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                    <em class="icon ni ni-arrow-down-right"></em>
                                                </div>
                                            @elseif ($transaction->type == 'withdraw')
                                                <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                    <em class="icon ni ni-arrow-up-right"></em>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                @if (@$transaction->from_address)
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="from{{$transaction->id}}">
                                                    {{ $transaction->from_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#from{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                @if (@$transaction->to_address)
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="to{{$transaction->id}}">
                                                    {{ $transaction->to_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#to{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td">
                                            {{ $transaction->amount }} USDT
                                        </td>
                                        <td class="td">
                                            <div class="tb-tnx-status">
                                                <span
                                                    @if ($transaction->status == 'process')
                                                        class="badge badge-warning"
                                                    @elseif ($transaction->status == 'success')
                                                        class="badge badge-success"
                                                    @elseif ($transaction->status == 'fail')
                                                        class="badge badge-danger"
                                                    @endif
                                                >
                                                    {{ $transaction->status }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="td">
                                            @if ($transaction->created_at)
                                                {{ $transaction->created_at }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="failed">
                    <table class="table">
                        <thead class="tb-tnx-head">
                            <tr class="tr">
                                <th class="th nk-tb-col">Type</th>
                                <th class="th">From</th>
                                <th class="th">To</th>
                                <th class="th">Amount</th>
                                <th class="th">Status</th>
                                <th class="th">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($transactions as $transaction)
                                @if ($transaction->status == 'fail')
                                    <tr class="tr">
                                        <td class="td">
                                            @if ($transaction->type == 'income')
                                                <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                    <em class="icon ni ni-arrow-down-right"></em>
                                                </div>
                                            @elseif ($transaction->type == 'withdraw')
                                                <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                    <em class="icon ni ni-arrow-up-right"></em>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                @if (@$transaction->from_address)
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="from{{$transaction->id}}">
                                                    {{ $transaction->from_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#from{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                @if (@$transaction->to_address)
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="to{{$transaction->id}}">
                                                    {{ $transaction->to_address }}
                                                    <span class="clipboard-init" data-clipboard-target="#to{{$transaction->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        <td class="td">
                                            {{ $transaction->amount }} USDT
                                        </td>
                                        <td class="td">
                                            <div class="tb-tnx-status">
                                                <span
                                                    @if ($transaction->status == 'process')
                                                        class="badge badge-warning"
                                                    @elseif ($transaction->status == 'success')
                                                        class="badge badge-success"
                                                    @elseif ($transaction->status == 'fail')
                                                        class="badge badge-danger"
                                                    @endif
                                                >
                                                    {{ $transaction->status }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="td">
                                            @if ($transaction->created_at)
                                                {{ $transaction->created_at }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- .nk-tb-item -->
</div><!-- .card -->


{{-- <div class="card card-bordered card-full">
    <div class="card-inner">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title"><span class="mr-2">Notifications</span></h6>
            </div>
            <div class="card-tools">
                <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#all"><span>All</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#incoming"><span>Income</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#withdraw"><span>Withdraw</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#failed"><span>Failed</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content mt-0 border-top">
        <div class="tab-pane active" id="all">
            @foreach ($transactions as $transaction)
                <div class="tranx-item">
                    <div class="tranx-col">
                        <div class="tranx-info">
                            @if ($transaction->type == 'income')
                                <div class="nk-tnx-type-icon bg-success-dim text-success">
                                    <em class="icon ni ni-arrow-down-right"></em>
                                </div>
                            @elseif ($transaction->type == 'withdraw')
                                <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                    <em class="icon ni ni-arrow-up-right"></em>
                                </div>
                            @endif
                            <div class="tranx-data">
                                <div class="tranx-label">{{ $transaction->to_address }}</div>
                                <div class="tranx-date">{{ $transaction->created_at }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="tranx-col">
                        <div class="tranx-amount">
                            <div class="number">{{ $transaction->amount }} <span class="currency currency-btc">USDT</span></div>
                        </div>
                    </div>
                </div><!-- .nk-tranx-item -->
            @endforeach
        </div>
        <div class="tab-pane" id="incoming">
            @foreach ($transactions as $transaction)
                @if ($transaction->type == 'income')
                    <div class="tranx-item">
                        <div class="tranx-col">
                            <div class="tranx-info">
                                @if ($transaction->type == 'income')
                                    <div class="nk-tnx-type-icon bg-success-dim text-success">
                                        <em class="icon ni ni-arrow-down-right"></em>
                                    </div>
                                @elseif ($transaction->type == 'withdraw')
                                    <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                        <em class="icon ni ni-arrow-up-right"></em>
                                    </div>
                                @endif
                                <div class="tranx-data">
                                    <div class="tranx-label">{{ $transaction->to_address }}</div>
                                    <div class="tranx-date">{{ $transaction->created_at }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="tranx-col">
                            <div class="tranx-amount">
                                <div class="number">{{ $transaction->amount }} <span class="currency currency-btc">USDT</span></div>
                            </div>
                        </div>
                    </div><!-- .nk-tranx-item -->
                @endif
            @endforeach
        </div>
        <div class="tab-pane" id="withdraw">
            @foreach ($transactions as $transaction)
                <div class="tranx-item">
                    <div class="tranx-col">
                        <div class="tranx-info">
                            @if ($transaction->type == 'income')
                                <div class="nk-tnx-type-icon bg-success-dim text-success">
                                    <em class="icon ni ni-arrow-down-right"></em>
                                </div>
                            @elseif ($transaction->type == 'withdraw')
                                <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                    <em class="icon ni ni-arrow-up-right"></em>
                                </div>
                            @endif
                            <div class="tranx-data">
                                <div class="tranx-label">{{ $transaction->to_address }}</div>
                                <div class="tranx-date">{{ $transaction->created_at }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="tranx-col">
                        <div class="tranx-amount">
                            <div class="number">{{ $transaction->amount }} <span class="currency currency-btc">USDT</span></div>
                        </div>
                    </div>
                </div><!-- .nk-tranx-item -->
            @endforeach
        </div>
        <div class="tab-pane" id="failed">
            @foreach ($transactions as $transaction)
                <div class="tranx-item">
                    <div class="tranx-col">
                        <div class="tranx-info">
                            @if ($transaction->type == 'income')
                                <div class="nk-tnx-type-icon bg-success-dim text-success">
                                    <em class="icon ni ni-arrow-down-right"></em>
                                </div>
                            @elseif ($transaction->type == 'withdraw')
                                <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                    <em class="icon ni ni-arrow-up-right"></em>
                                </div>
                            @endif
                            <div class="tranx-data">
                                <div class="tranx-label">{{ $transaction->to_address }}</div>
                                <div class="tranx-date">{{ $transaction->created_at }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="tranx-col">
                        <div class="tranx-amount">
                            <div class="number">{{ $transaction->amount }} <span class="currency currency-btc">USDT</span></div>
                        </div>
                    </div>
                </div><!-- .nk-tranx-item -->
            @endforeach
        </div>
    </div><!-- .nk-tb-item -->
</div><!-- .card --> --}}
@endsection
