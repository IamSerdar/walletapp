@extends('layouts.app')

@section('content')
    @if (auth()->user()->timer)
        <div class="nk-block pt-0">
            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="card card-bordered">
                        <div class="nk-wgw">
                            <div class="nk-wgw-inner text-center">
                                <h5 class="nk-wgw-title title text-danger" id="timer"></h5>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    @endif
    <div class="nk-block pt-2">
        <div class="row g-2">
            <div class="col-sm-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="card card-bordered">
                    <div class="card-header border-bottom"><b>Refund Account</b></div>
                    <div class="card-inner text-center">
                        <div class="user-account-main mb-2">
                            <h6 class="overline-title-alt">Account Balance</h6>
                            <a href="{{ route('notifications') }}" class="user-balance">{{ auth()->user()->balance() }} USDT</a>
                        </div>
                        <a href="{{ route('transactions.withdrawForm') }}" class="btn btn-danger"
                            @if(count(auth()->user()->servicePayments))
                                {{-- data-toggle="modal" data-target="#withdraw" --}}
                            @else
                                data-toggle="modal" data-target="#emptyServicePayment"
                            @endif>Withdraw</a>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-sm-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="card card-bordered">
                    <div class="card-header border-bottom"><b>Service Payment</b></div>
                    <div class="card-inner text-center">
                        <div class="user-account-main mb-2">
                            <h6 class="overline-title-alt">Account Balance</h6>
                            <a href="{{ route('notifications') }}" class="user-balance">{{ optional(auth()->user()->servicePayments)->sum('amount') }} USDT</a>
                        </div>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#deposit">Deposit</a>
                    </div>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div>
    <div class="nk-block pt-2">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card card-bordered">
                    <div class="nk-wgw">
                        <div class="nk-wgw-inner text-center">
                            <a href="{{ route('notifications') }}"><h5 class="nk-wgw-title title">Notifications <span class="badge badge-danger">{{ auth()->user()->transactions->count()}} </span></h5></a>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div>
    <div class="modal fade" tabindex="-1" id="deposit">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Service Payment</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="slider-item">
                        <div class="nk-feature nk-feature-center">
                            <div class="nk-feature-img">
                              <img class="round" src="{{ asset(optional(auth()->user()->serviceAccount)->getQRCode()) }}" srcset="" alt="img">
                            </div>
                            <div class="nk-refwg-url pt-4">
                                <div class="form-control-wrap">
                                    <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy</span></div>
                                    <input type="text" class="form-control copy-text" id="refUrl" value="{{ optional(auth()->user()->serviceAccount)->address }}">
                                </div>
                            </div>
                        </span>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="emptyServicePayment">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                        <h4 class="nk-modal-title">Service Payment is Empty!</h4>
                        <div class="nk-modal-text">
                            <p class="lead">Contact the administrator to pay for Service Payment</p>
                        </div>
                        <div class="nk-modal-action mt-5">
                            <a href="#" class="btn btn-lg btn-mw btn-light" data-dismiss="modal">Return</a>
                        </div>
                    </div>
                </div><!-- .modal-body -->
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" tabindex="-1" id="withdraw">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transactions.withdraw') }}" id="myForm"  class="form-validate is-alter" method="POST" enctype="multipart/form-data">
                        @csrf
                         @include('include._flash_messages')
                        <div class="form-group">
                            <div class="form-label-group">
                              <label class="form-label" for="withdraw_password">Accept Password</label>
                            </div>
                            <div class="form-control-wrap">
                              <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="withdraw_password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                              </a>
                              <input type="password" class="form-control form-control-lg {{ $errors->has('withdraw_password') ? ' is-invalid' : '' }}"
                                    id="withdraw_password" name="withdraw_password" placeholder="" required>
                              @if ($errors->has('withdraw_password'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('withdraw_password') }}</strong></span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="to_address">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="to_address"  name="to_address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount</label>
                            <div class="form-control-wrap">
                                <div class="form-text-hint  p-0">
                                    <a href="#" id="maxButton"><span class="btn btn-primary">MAX</span></a>
                                </div>
                                <input type="number" class="form-control" name="amount" id="amount" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
<script>

// document.getElementById('maxButton').addEventListener('click', function() {
//     var amountValue = document.getElementById('amount').value;
//     // Set the value of the amount input field to the retrieved value
//     document.getElementById('amount').value = "{{ auth()->user()->balance() }}";
// });

function getCurrentDatetimeFormatted() {
    const currentDatetime = new Date();
    const year = currentDatetime.getFullYear();
    const month = String(currentDatetime.getMonth() + 1).padStart(2, '0');
    const day = String(currentDatetime.getDate()).padStart(2, '0');
    const hours = String(currentDatetime.getHours()).padStart(2, '0');
    const minutes = String(currentDatetime.getMinutes()).padStart(2, '0');
    const seconds = String(currentDatetime.getSeconds()).padStart(2, '0');

    const formattedDatetime = `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;

    return formattedDatetime;
}
const url = "{{ route('timeout') }}";
const expireDate = "<?php echo auth()->user()->timer ?>";
if(expireDate){
    const date1 = new Date(expireDate.replace(' ', 'T'));
    const date2 = new Date(getCurrentDatetimeFormatted());

    const timestamp1 = date1.getTime();
    const timestamp2 = date2.getTime();

    const timeDiff = Math.abs(timestamp2 - timestamp1);

    let totalSeconds = Math.floor(timeDiff / 1000);

    document.getElementById('timer').innerHTML = formatTime(totalSeconds);

    const interval = setInterval(() => {
        totalSeconds -= 1;
        document.getElementById('timer').innerHTML = formatTime(totalSeconds);

        if (totalSeconds <= 0) {
            $.get(url).fail(function (err) {
                console.log(err);
            });
            location.reload();
            clearInterval(interval);
        }
    }, 1000);

    function formatTime(s) {
        const resultHours = Math.floor(s / 3600);
        const resultMinutes = Math.floor((s % 3600) / 60);
        const resultSeconds = Math.floor(s % 60);
        return `${resultHours.toString().padStart(2, '0')}:${resultMinutes.toString().padStart(2, '0')}:${resultSeconds.toString().padStart(2, '0')}`;
    }
}
</script>
@endsection
