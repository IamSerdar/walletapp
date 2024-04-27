@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Create New User</h3>
                                <div class="nk-block-des text-soft">
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <form action="{{ route('users.store') }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="previous" value="{{url()->previous()}}">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-user"></em>
                                        </div>
                                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                                               class="form-control form-control-lg @error('username') is-invalid @enderror" placeholder="Enter Username" required>
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label class="form-label" for="role"><span>Role <span class="text-danger">*</span></span></label>
                                  <div class="form-control-wrap">
                                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" data-ui="lg" >
                                      <option disabled hidden selected></option>
                                      @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('role') }}</strong></span>
                                    @else
                                      <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                                    @endif
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-label-group">
                                      <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="form-control-wrap">
                                      <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                      </a>
                                      <input type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            id="password" name="password" placeholder="Enter Password" required>
                                      @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                      @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-label-group">
                                      <label class="form-label" for="withdraw_password">Withdraw Password</label>
                                    </div>
                                    <div class="form-control-wrap">
                                      <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="withdraw_password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                      </a>
                                      <input type="password" class="form-control form-control-lg {{ $errors->has('withdraw_password') ? ' is-invalid' : '' }}"
                                            id="withdraw_password" name="withdraw_password" placeholder="Enter Withdraw Password" required>
                                      @if ($errors->has('withdraw_password'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('withdraw_password') }}</strong></span>
                                      @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="balance" class="form-label">Balance <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="number" id="balance" name="balance" value="{{ old('balance') }}"
                                               class="form-control form-control-lg @error('balance') is-invalid @enderror" placeholder="Enter Balance" required>
                                        @if ($errors->has('balance'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('balance') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-5">
                                <div class="sp-plan-opt clone-file ml-4">
                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" name="status" id="status" checked>
                                    <label class="custom-control-label text-soft" for="status">@lang('main.status')</label>
                                    @error ('status')
                                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
@endsection
