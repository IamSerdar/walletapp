@extends('layouts.app')

@section('content')
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between-md g-4">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-content">
                                    @if ($employee)
                                        <h3 class="nk-block-title page-title">@lang('main.list', ['name' => __('main.employees')])</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>@lang('main.sub_title', ['count' => $count, 'name' => __('main.employee')])</p>
                                        </div>
                                    @else
                                        <h3 class="nk-block-title page-title">@lang('main.list', ['name' => __('main.children_and_parents')])</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>@lang('main.sub_title', ['count' => $count, 'name' => __('main.children_and_parents')])</p>
                                        </div>
                                    @endif
                                </div><!-- .nk-block-head-content -->
                            </div>
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools gx-3">
                                    <li>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-white btn-dim btn-outline-primary">
                                            <em class="icon ni ni-plus"></em><span class="d-none d-sm-inline-block">@lang('main.create_new')</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('users') }}" method="get" class="mb-3">
                        <input type="hidden" @if($employee) name="exceptRoles[]" @else name="roles[]" @endif value="parent" >
                        <input type="hidden" @if($employee) name="exceptRoles[]" @else name="roles[]" @endif value="child" >
                        <div class="row g-1">
                          <div class="col-11">
                            <div class="row g-1">
                              <div @if (auth()->user()->isRoleAdmin()) class="col-md-3" @else class="col-md-6" @endif>
                                <div class="form-group">
                                  <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="@lang('main.search')" aria-label="search">
                                </div>
                              </div>
                              @if (auth()->user()->isRoleAdmin())
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="form-control-wrap">
                                      <select class="form-select js-select2" id="garden_filter" name="garden_filter" data-search="on" data-placeholder="@lang('main.select_garden')" aria-label="garden_filter">
                                          <option @if(!old('garden_filter')) selected @endif>@lang('main.all')</option>
                                          @foreach ($gardens as $garden)
                                              <option value="{{ $garden->id }}" {{ request('garden_filter') == $garden->id ? 'selected' : '' }}> {{ $garden->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                      <div class="form-control-wrap">
                                        <select class="form-select js-select2" id="groups_filter" name="groups_filter[]" multiple data-placeholder="@lang('main.select_group')" aria-label="groups_filter">
                                            @if(is_numeric(request('garden_filter')))
                                                @foreach ($groups_filter as $group)
                                                    <option value="{{ $group->id }}" @if(in_array($group->id, request('groups_filter', []))) selected @endif> {{ $group->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                              @endif
                              <div class="col-md-2">
                                <div class="form-group">
                                  <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="roles_filter" name="roles_filter[]" multiple data-placeholder="@lang('main.role')" aria-label="roles_filter">
                                        @foreach ($roles as $role)
                                            @if (!$employee && ($role == 'parent' || $role == 'child'))
                                                <option value="{{ $role }}" @if(in_array($role, request('roles_filter', []))) selected @endif>@lang('main.'.$role)</option>
                                            @elseif($employee && ($role != 'parent' && $role != 'child'))
                                                <option value="{{ $role }}" @if(in_array($role, request('roles_filter', []))) selected @endif>@lang('main.'.$role)</option>
                                            @endif
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="status" name="status" data-placeholder="@lang('main.status')" aria-label="status">
                                      <option value="all" @if(!request('status') || request('status') == 'all') selected @endif>@lang('main.all')</option>
                                      <option value="true" @if(request('status') == "true") selected @endif>@lang('main.active')</option>
                                      <option value="false" @if(request('status')== "false" ) selected @endif>@lang('main.not_active')</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-1">
                            <button class="btn btn-primary">@lang('main.filter')</button>
                          </div>
                        </div>
                    </form>
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">

                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist is-compact">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span class="sub-text">@</span></div>
                                            <div class="nk-tb-col"><span class="sub-text">@lang('main.full_name')</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">@lang('main.phone')</span></div>
                                            @if (auth()->user()->isRoleAdmin())
                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">@lang('main.garden')</span></div>
                                            @endif
                                            <div class="nk-tb-col nk-tb-col-tools text-end"></div>
                                        </div><!-- .nk-tb-item -->
                                        @foreach ($models as $model)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col nk-tb-col-check"><span>{{ $model->username }}</span></div>
                                                <div class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar xs bg-primary">
                                                            @if ($model->avatar)
                                                            <span><img src="{{ $model->getImageUrl() }}" alt="avatar"></span>
                                                            @else
                                                                <span>{{ Str::upper($model->first_name[0]) }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="user-name">
                                                            <span >{{ $model->first_name }} {{ $model->last_name }} </span>
                                                            @if (!$model->status)<span class="text-danger"><em class="icon ni ni-cross-round"></em></span>@endif
                                                            <span class="tb-lead">@lang('main.'.$model->role)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    @if($model->phone)
                                                        <span>+993 {{ $model->phone }}</span>
                                                    @else
                                                        ------
                                                    @endif
                                                </div>
                                                @if (auth()->user()->isRoleAdmin())
                                                    <div class="nk-tb-col tb-col-md">
                                                        <span>
                                                            @if($model->gardenAdmin)
                                                                {{ $model->gardenAdmin->name }}
                                                            @else
                                                                @if(count($model->gardens))
                                                                    @foreach ($model->gardens as $garden)
                                                                        {{ $garden->name }} <br>
                                                                    @endforeach
                                                                @else
                                                                    ------
                                                                @endif
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li class="nk-tb-action">
                                                            <a href="{{ route('users.show', $model->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Gör">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action">
                                                            <a href="{{ route('users.edit', $model->id) }}"
                                                                class="btn btn-trigger btn-icon" data-toggle="tooltip"
                                                                data-placement="top" title="@lang('main.edit')">
                                                                <em class="icon ni ni-edit-alt"></em>
                                                            </a>
                                                        </li>
                                                        <li class="nk-tb-action">
                                                            <a href="#"
                                                                onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $model->id }}').submit(); }"
                                                                class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="@lang('main.delete')">
                                                                <em class="icon ni ni-trash"></em>
                                                            </a>
                                                            <form action="{{ route('users.destroy', $model->id) }}"
                                                                method="post" id="destroy-{{ $model->id }}">
                                                                @method('delete')
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        @endforeach
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->

                            </div><!-- .card-inner-group -->

                        </div><!-- .card -->
                        <div class="nk-block-head-content mt-2 mb-4">
                        {!! $models->appends(request()->input())->links() !!}
                        </div>
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
    <!-- content @e -->

    @if (count($errors) > 0)
    @section('js')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#modalForm').modal('show');
        });
    </script>
    @endsection
    @endif

    <!-- modal @s -->
    <div class="modal fade bd-example-modal-lg" id="modalForm">
        <div class="modal-dialog modal-lg" style="max-width: 1200px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('main.info', ['name' => $employee ? __('main.employees') : __('main.children_and_parents')]) }}</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.create') }}" class="form-validate is-alter" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @include('user::form')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal @e -->


@endsection
