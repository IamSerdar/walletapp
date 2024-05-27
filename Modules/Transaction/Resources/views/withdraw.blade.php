@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Withdraw</h3>
                                <div class="nk-block-des text-soft">
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <form action="{{ route('transactions.withdraw') }}" id="myForm"  class="form-validate is-alter" method="POST" enctype="multipart/form-data">
                        @csrf
                         @include('include._flash_messages')
                        <div class="form-group">
                            <div class="form-label-group">
                              <label class="form-label" for="password">Asset Password</label>
                            </div>
                            <div class="form-control-wrap">
                              <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                              </a>
                              <input type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    id="password" name="password"  value="{{ old('password') }}" placeholder="Enter your asset password" required>
                              @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="to_address">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="to_address"  name="to_address" value="{{ old('to_address') }}"
                                    placeholder="Please enter your TRC-20 (TRON) address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount</label>
                            <div class="form-control-wrap">
                                <div class="form-text-hint  p-0">
                                    <a href="#" id="maxButton"><span class="btn btn-primary">MAX</span></a>
                                </div>
                                <input type="number" class="form-control" name="amount" id="amount" max="{{auth()->user()->balance()}}" value="{{ old('amount') }}"
                                        placeholder="Amount" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('js')
    <script>
        document.getElementById('maxButton').addEventListener('click', function() {
            var amountValue = document.getElementById('amount').value;
            // Set the value of the amount input field to the retrieved value
            document.getElementById('amount').value = "{{ auth()->user()->balance() }}";
        });
    </script>
@endsection
