@extends('layouts.app')

@section('content')
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
                        <a class="nav-link" data-toggle="tab" href="#incoming"><span>In</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#outgoing"><span>Out</span></a>
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
            <div class="tranx-item">
                <div class="tranx-col">
                    <div class="tranx-info">
                        <div class="nk-tnx-type-icon bg-success-dim text-success">
                            <em class="icon ni ni-arrow-down-right"></em>
                        </div>
                        <div class="tranx-data">
                            <div class="tranx-label">Buy Bitcoin</div>
                            <div class="tranx-date">Nov 12, 2019 11:34 PM</div>
                        </div>
                    </div>
                </div>
                <div class="tranx-col">
                    <div class="tranx-amount">
                        <div class="number">0.5384 <span class="currency currency-btc">BTC</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="outgoing">
            <div class="tranx-item">
                <div class="tranx-col">
                    <div class="tranx-info">
                        <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                            <em class="icon ni ni-arrow-up-right"></em>
                        </div>
                        <div class="tranx-data">
                            <div class="tranx-label">Buy Bitcoin</div>
                            <div class="tranx-date">Nov 12, 2019 11:34 PM</div>
                        </div>
                    </div>
                </div>
                <div class="tranx-col">
                    <div class="tranx-amount">
                        <div class="number">0.5384 <span class="currency currency-btc">BTC</span></div>
                    </div>
                </div>
            </div><!-- .nk-tranx-item -->
        </div>
        <div class="tab-pane" id="outgoing">
            <div class="tranx-item">
                <div class="tranx-col">
                    <div class="tranx-info">
                        <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                            <em class="icon ni ni-arrow-up-right"></em>
                        </div>
                        <div class="tranx-data">
                            <div class="tranx-label">Buy Bitcoin</div>
                            <div class="tranx-date">Nov 12, 2019 11:34 PM</div>
                        </div>
                    </div>
                </div>
                <div class="tranx-col">
                    <div class="tranx-amount">
                        <div class="number">0.5384 <span class="currency currency-btc">BTC</span></div>
                    </div>
                </div>
            </div><!-- .nk-tranx-item -->
        </div>
    </div><!-- .nk-tb-item -->
</div><!-- .card -->
@endsection
