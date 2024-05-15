@extends('layouts.app')

@section('content')
    <div class="nk-block pt-0">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card card-bordered">
                    <div class="nk-wgw">
                        <div class="nk-wgw-inner text-center">
                            <h5 class="nk-wgw-title title text-danger">{{ now()->format('h:i:s') }}</h5>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div>
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
                        <a href="#" class="btn btn-danger" @if(count(auth()->user()->servicePayments))data-toggle="modal" data-target="#withdraw" @else data-toggle="modal" data-target="#emptyServicePayment" @endif>Withdraw</a>
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
                            <a href="{{ route('notifications') }}"><h5 class="nk-wgw-title title">Notifications</h5></a>
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

    <div class="modal fade" tabindex="-1" id="withdraw">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transactions.store') }}" class="form-validate is-alter" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="to_address">Address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="to_address"  name="to_address" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount</label>
                            <div class="form-control-wrap">
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
    </div>
@endsection
