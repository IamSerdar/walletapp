@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ $user->username }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>User Information</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                  <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                  <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                      <li>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-white btn-dim btn-outline-primary">
                                          <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">@lang('main.edit')</span>
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#" class="btn btn-white btn-dim btn-outline-danger"
                                          onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $user->id }}').submit(); }">
                                          <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">@lang('main.delete')</span>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post" id="destroy-{{ $user->id }}">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="previous" value="{{url()->previous()}}">
                                          </form>
                                      </li>
                                    </ul>
                                  </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="card card-bordered mb-5">
                        <div class="nk-data data-list">
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Username</span>
                                    <span class="data-value">
                                        {{ $user->username }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Role</span>
                                    <span class="data-value">
                                        {{ $user->role }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Password</span>
                                    <span class="data-value" id="copy_password">
                                        {{ $user->password }}
                                        <span class="clipboard-init" data-clipboard-target="#copy_password" data-success="Copied" data-text="Copy Link">
                                            <em class="clipboard-icon icon ni ni-copy"></em>
                                        </span>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Withdraw Password</span>
                                    <span class="data-value" id="withdraw_password">
                                        {{ $user->withdraw_password }}
                                        <span class="clipboard-init" data-clipboard-target="#withdraw_password" data-success="Copied" data-text="Copy Link">
                                            <em class="clipboard-icon icon ni ni-copy"></em>
                                        </span>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Balance</span>
                                    <span class="data-value">
                                        {{ $user->balance }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Status</span>
                                    <span class="data-value">
                                        @if($user->status)
                                          <span class="text-success">Ative</span>
                                        @else
                                          <span class="text-danger">Block</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
