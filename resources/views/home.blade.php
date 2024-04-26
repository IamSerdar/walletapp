@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-between-md g-4">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">@lang('main.welcome'), {{ auth()->user()->username }}</h2>
                            <div class="nk-block-des">
                                <p>@lang('main.manage_dashboard')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

