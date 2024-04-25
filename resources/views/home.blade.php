@extends('layouts.app')

@section('content')

<!-- content @s -->
<div class="nk-content-wrap">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">@lang('main.welcome'), {{ auth()->user()->first_name }}</h3>
                <div class="nk-block-des text-soft">
                    <p>@lang('main.manage_dashboard')</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
</div>
@if(auth()->user()->isRoleEducator() && !auth()->user()->getGroupId())
    <div class="nk-content ">
        <div class="nk-block nk-block-middle wide-xs mx-auto">
            <div class="nk-block-content nk-error-ld text-center">
                <h3 class="nk-error-title text-danger">@lang('main.no_group_educator')</h3>
                <p class="nk-error-text">@lang('main.no_group_educator_description')</p>
            </div>
        </div><!-- .nk-block -->
    </div>
@endif
@endsection
@section('js')

@endsection
