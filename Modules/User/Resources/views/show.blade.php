@extends('layouts.app')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    @include('include.content-show', ['data' => ['sub' => __('main.info', ['name' => $model->first_name . ' ' . $model->last_name ]), 'title' => $model, 'path' => 'users']])
                    <div class="card card-bordered mb-5">
                        <div class="nk-data data-list" id="data_list">
                            @if ($model->avatar)
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Surat</span>
                                        <span class="data-value">
                                            <img src="{{ $model->getImageUrl() }}" alt="{{ $model->id }}" style="height: 60px">
                                        </span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="{{ $model->getImageUrl() }}" class="data-more" target="_blank"><em class="icon ni ni-forward-ios"></em></a></div>
                                </div>
                            @endif
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.first_name')</span>
                                    <span class="data-value">
                                        {{ $model->first_name }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.last_name')</span>
                                    <span class="data-value">
                                        {{ $model->last_name }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.middle_name')</span>
                                    <span class="data-value">
                                        {{ $model->middle_name }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.role')</span>
                                    <span class="data-value">
                                        @lang('main.'.$model->role) <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            @if (auth()->user()->isRoleAdmin())
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">@lang('main.garden')</span>
                                        <span class="data-value">
                                            @if (count($model->gardens))
                                                @foreach ($model->gardens as $garden)
                                                    {{ $garden->name }} <br>
                                                @endforeach
                                            @endif
                                        </span>
                                    </div>
                                    <div class="data-col data-col-end"></div>
                                </div>
                            @endif
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.group')</span>
                                        @isset ($model->group)
                                            <span class="data-value">
                                                {{ $model->group->name }} <br>
                                            </span>
                                        @endisset
                                    </div>
                                    <div class="data-col data-col-end"></div>
                                </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.username')</span>
                                    <span class="data-value">
                                        {{ $model->username }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.phone')</span>
                                    @isset ($model->phone)
                                        <span class="data-value">
                                           +993 {{ $model->phone }} <br>
                                        </span>
                                    @endisset
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            @if($model->role == 'parent')
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.children')</span>
                                    <span class="data-value">
                                        @foreach ($model->children as $item)
                                        {{ $item->first_name }}  {{ $item->last_name }} <br>
                                        @endforeach
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            @else
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.parent')</span>
                                    <span class="data-value">
                                        @foreach ($model->parents as $item)
                                        {{ $item->first_name }}  {{ $item->last_name }} <br>
                                        @endforeach
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            @endif
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.gender')</span>
                                    @isset ($model->gender)
                                    <span class="data-value">
                                        {{ __('main.'.$model->gender) }} <br>
                                    </span>
                                    @endisset
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.birthday')</span>
                                    <span class="data-value">
                                        {{ optional($model->birthday)->format('Y-m-d') }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.address')</span>
                                    <span class="data-value">
                                        {{ $model->address }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.work_year')</span>
                                    <span class="data-value">
                                        {{ $model->work_year }} <br>
                                    </span>
                                </div>
                                <div class="data-col data-col-end"></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">@lang('main.status')</span>
                                    <span class="data-value">
                                        @if($model->status)
                                          <span class="text-success">@lang('main.yes')</span>
                                        @else
                                          <span class="text-danger">@lang('main.no')</span>
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
    </div>
@endsection
