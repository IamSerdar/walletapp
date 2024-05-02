@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ $transaction->user->username }}</h3>
                                <div class="nk-block-des text-soft">
                                    Edit Transaction Information
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <form action="{{ route('transactions.update', $transaction->id) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('patch')
                        <input type="hidden" name="previous" value="{{url()->previous()}}">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label class="form-label" for="user_id"><span>User <span class="text-danger">*</span></span></label>
                                  <div class="form-control-wrap">
                                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-ui="lg" data-search="on">
                                      <option disabled hidden selected></option>
                                      @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $transaction->user->id ? 'selected' : ''}} >{{ $user->username }}</option>
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
                                    <label for="from" class="form-label">From <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="from" name="from" value="{{ old('from') ?? $transaction->from }}"
                                               class="form-control form-control-lg @error('from') is-invalid @enderror" placeholder="Enter From" required>
                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('from') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="to" class="form-label">To <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" id="to" name="to" value="{{ old('from') ?? $transaction->to }}"
                                               class="form-control form-control-lg @error('to') is-invalid @enderror" placeholder="Enter To" required>
                                        @if ($errors->has('to'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('to') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label class="form-label" for="type"><span>Type <span class="text-danger">*</span></span></label>
                                  <div class="form-control-wrap">
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" data-ui="lg" >
                                      <option disabled hidden selected></option>
                                      @foreach ($types as $type)
                                        <option value="{{ $type }}" {{ $type == $transaction->type ? 'selected' : ''}} >{{ $type }}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('type') }}</strong></span>
                                    @else
                                      <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                                    @endif
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="number" id="amount" name="amount" value="{{ old('from') ?? $transaction->amount }}"
                                               class="form-control form-control-lg @error('amount') is-invalid @enderror" placeholder="Enter Amount" required>
                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('amount') }}</strong></span>
                                        @endif
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
