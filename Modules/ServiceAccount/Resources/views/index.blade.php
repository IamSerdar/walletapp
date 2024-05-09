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
            content: "Address";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(4):before {
            content: "QRCode";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(5):before {
            content: "Created At";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(6):before {
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
                                    <h3 class="nk-block-title page-title">Service Accounts list</h3>
                                    <div class="nk-block-des text-soft">
                                        <p>There are {{ $count }} service accounts</p>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div>
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools gx-3">
                                    <li>
                                        <a href="{{ route('serviceAccounts.create') }}" class="btn btn-white btn-dim btn-outline-primary">
                                            <em class="icon ni ni-plus"></em><span class="d-none d-sm-inline-block">Create New</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered mb-2">
                            <table class="table">
                                <thead class="tb-tnx-head">
                                    <tr class="tr">
                                        <th class="th nk-tb-col">#</th>
                                        <th class="th">User</th>
                                        <th class="th">Address</th>
                                        <th class="th">QRCode</th>
                                        <th class="th">Created At</th>
                                        <th class="th">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    @foreach ($serviceAccounts as $serviceAccount)
                                    <tr class="tr">
                                        <td class="td">{{ $serviceAccount->id }}</td>
                                        <td class="td">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $serviceAccount->user->username }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="td">
                                            <div class="data-col">
                                                <span class="data-value" style="display: unset; transition: color .3s; width: 200px;" id="address{{$serviceAccount->id}}">
                                                    {{ $serviceAccount->address }}
                                                    <span class="clipboard-init" data-clipboard-target="#address{{$serviceAccount->id}}" data-success="Copied" data-text="Copy Link">
                                                        <em class="clipboard-icon icon ni ni-copy"></em>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="td">
                                            <a href="{{ $serviceAccount->getQRCode() }}" target="_blank">
                                                <img src="{{ $serviceAccount->getQRCode() }}" alt="serviceAccount-{{ $serviceAccount->id }}" style="height: 60px; width:60px">
                                            </a>
                                        </td>
                                        <td class="td">
                                            @if ($serviceAccount->created_at)
                                                {{ $serviceAccount->created_at }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="td">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action">
                                                    <a href="{{ route('serviceAccounts.edit', $serviceAccount->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit-alt"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action">
                                                    <a href="#" onclick="if (confirm('Do you want remove?')) { document.getElementById('destroy-{{ $serviceAccount->id }}').submit(); }"
                                                        class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Poz">
                                                        <em class="icon ni ni-trash"></em>
                                                    </a>
                                                    <form action="{{ route('serviceAccounts.destroy', $serviceAccount->id) }}" method="post" id="destroy-{{ $serviceAccount->id }}">
                                                        @method('delete')
                                                        @csrf
                                                      </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $serviceAccounts->appends(request()->input())->onEachSide(1)->render() !!}

                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
<!-- content @e -->
@endsection
