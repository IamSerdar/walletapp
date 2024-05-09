@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Create New Service Account</h3>
                                <div class="nk-block-des text-soft">
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <form action="{{ route('serviceAccounts.store') }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label class="form-label" for="user_id"><span>User <span class="text-danger">*</span></span></label>
                                  <div class="form-control-wrap">
                                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-ui="lg" data-search="on">
                                      <option disabled hidden selected></option>
                                      @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('user_id') }}</strong></span>
                                    @else
                                      <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                                    @endif
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                                               class="form-control form-control-lg @error('address') is-invalid @enderror" placeholder="Enter Address" required>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="file" class="form-label">QRCode <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="file" id="file" name="file" class="form-control form-control-lg @error('file') is-invalid @enderror"
                                            placeholder="Choose QRCode" required>
                                        @if ($errors->has('file'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
                                        @else
                                            <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
