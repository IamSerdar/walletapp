@extends('layouts.app')
@section('css')
<style>
    @media only screen and (max-width: 760px),
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
            content: "Username";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(3):before {
            content: "Role";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(4):before {
            content: "Created At";
            color: black !important;
            font-weight: 700
        }

        .td:nth-of-type(5):before {
            content: "Status";
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
                                    <h3 class="nk-block-title page-title">Users list</h3>
                                    <div class="nk-block-des text-soft">
                                        <p>There are {{ $count }} users</p>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div>
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools gx-3">
                                    <li>
                                        <a href="{{ route('users.create') }}" class="btn btn-white btn-dim btn-outline-primary">
                                            <em class="icon ni ni-plus"></em><span class="d-none d-sm-inline-block">Create New</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <form action="{{ route('users.') }}" method="get" class="mb-3">
                        <div class="row g-1">
                          <div class="col-11">
                                <div class="form-group">
                                  <input type="text" name="search" class="form-control  form-control-lg" value="{{ request('search') }}" placeholder="@lang('main.search')" aria-label="search">
                                </div>
                          </div>
                          <div class="col-md-1">
                            <button class="btn btn-primary btn-lg"><em class="icon ni ni-search"></em></button>
                          </div>
                        </div>
                    </form> --}}
                    <div class="nk-block">
                        <div class="card card-bordered mb-2">
                            <table class="table">
                                <thead class="tb-tnx-head">
                                    <tr class="tr">
                                        <th class="th nk-tb-col">#</th>
                                        <th class="th">Username</th>
                                        {{-- <th class="th">Role</th> --}}
                                        {{-- <th class="th">Password</th>
                                        <th class="th">Withdraw Password</th> --}}
                                        <th class="th">Created At</th>
                                        <th class="th">Status</th>
                                        <th class="th">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    @foreach ($users as $user)
                                    <tr class="tr">
                                        <td class="td">{{ $user->id }}</td>
                                        <td class="td">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $user->username }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="td">
                                            {{ $user->role }}
                                        </td> --}}
                                        {{-- <td class="td">
                                            @if ($user->password)
                                                {{ $user->password }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="td">
                                            @if ($user->withdraw_password)
                                                {{ $user->withdraw_password }}
                                            @else
                                                -
                                            @endif
                                        </td> --}}
                                        <td class="td">
                                            @if ($user->created_at)
                                                {{ $user->created_at }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="td">
                                            @if ($user->status)
                                                <span class="tb-status text-success">Active</span>
                                            @else
                                                <span class="tb-status text-danger">Block</span>
                                            @endif
                                        </td>
                                        <td class="td">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action">
                                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Show">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit-alt"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action">
                                                    <a href="#" onclick="if (confirm('Pozmak isleýanizmi?')) { document.getElementById('destroy-{{ $user->id }}').submit(); }"
                                                        class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="post" id="destroy-{{ $user->id }}">
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
                        {!! $users->appends(request()->input())->onEachSide(1)->render() !!}

                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
<!-- content @e -->
@endsection
