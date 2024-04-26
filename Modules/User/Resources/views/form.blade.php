<div class="row g-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name" class="form-label"><span>@lang('main.first_name') <span class="text-danger">*</span></span></label>
            <div class="form-control-wrap">
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') ?? (isset($item) ? $item->first_name : null) }}"
                    class="form-control @error('first_name') is-invalid @enderror" placeholder="" required>
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('first_name') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="last_name" class="form-label"><span>@lang('main.last_name') <span class="text-danger">*</span></span></label>
            <div class="form-control-wrap">
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') ?? (isset($item) ? $item->last_name : null) }}"
                    class="form-control @error('last_name') is-invalid @enderror" placeholder="" required>
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('last_name') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="middle_name" class="form-label"><span>@lang('main.middle_name')</span></label>
            <div class="form-control-wrap">
                <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') ?? (isset($item) ? $item->middle_name : null) }}"
                    class="form-control @error('middle_name') is-invalid @enderror" placeholder="">
                @if ($errors->has('middle_name'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('middle_name') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="role"><span>@lang('main.select_role')  <span class="text-danger">*</span></span></label>
            <div class="form-control-wrap">
                <select id="role" name="role" class="form-select js-select2 @error('role') is-invalid @enderror">
                    @foreach ($roles as $role)
                        @if (!$employee && ($role == 'parent' || $role == 'child'))
                            <option value="{{ $role }}" {{ (isset($item) ? $item->role : old('role')) == $role ? 'selected' : '' }}>@lang('main.'.$role)</option>
                        @elseif($employee && ($role != 'parent' && $role != 'child'))
                            <option value="{{ $role }}" {{ (isset($item) ? $item->role : old('role')) == $role ? 'selected' : '' }}>@lang('main.'.$role)</option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('role'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('role') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone" class="form-label"><span>@lang('main.phone')</span></label>
            <div class="form-control-wrap">
                <input type="text" id="phone" name="phone" value="{{ old('phone') ?? (isset($item) ? $item->phone : null) }}"
                    class="form-control @error('phone') is-invalid @enderror" placeholder="">
                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="username" class="form-label"><span>@lang('main.username')</span></label>
            <div class="form-control-wrap">
                <input type="text" id="username" name="username" @isset($item) disabled @endisset value="{{ old('username') ?? (isset($item) ? $item->username : null) }}"
                    class="form-control @error('username') is-invalid @enderror" placeholder="">
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    @if (auth()->user()->isRoleAdmin())
        <div class="col-md-6 @if((isset($item) && ($item->role == 'child')) || $employee) @else d-none @endif"  id="col-garden">
            <div class="form-group">
                <label class="form-label" for="garden"><span>@lang('main.select_garden')  <span class="text-danger">*</span></span></label>
                <div class="form-control-wrap">
                    <select id="garden" name="garden_id" data-search="on" class="form-select js-select2 @error('garden_id') is-invalid @enderror" required >
                        <option @if(!old('garden_id')) selected @endif>-</option>
                        @foreach ($gardens as $garden)
                            <option value="{{ $garden->id }}" {{ old('garden_id') ?? (isset($item) && count($item->gardens) ? $item->gardens()->first()->id : null) == $garden->id ? 'selected' : '' }}> {{ $garden->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('garden_id'))
                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('garden_id') }}</strong></span>
                    @else
                        <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 @if((isset($item) && ($item->role == 'parent')) || (!isset($item) && !$employee)) @else d-none @endif"  id="col-garden-ids">
            <div class="form-group">
                <label class="form-label" for="garden_ids"><span>@lang('main.select_garden')  <span class="text-danger">*</span></span></label>
                <div class="form-control-wrap">
                    <select id="garden_ids" name="garden_ids[]" class="form-select js-select2 @error('garden_ids') is-invalid @enderror" required data-search="on" multiple>
                        @foreach ($gardens as $garden)
                            <option value="{{ $garden->id }}"  @if(in_array($garden->id, (isset($item) ? $parent_gardens : request('parent_gardens', [])) )) selected @endif> {{ $garden->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('garden_ids'))
                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('garden_ids') }}</strong></span>
                    @else
                        <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-6">
        <div class="form-group">
          <label class="form-label" for="gender"><span>@lang('main.gender')</span></label>
          <div class="form-control-wrap">
            <select class="form-select js-select2 @error('gender') is-invalid @enderror" id="gender" name="gender">
              <option disabled hidden selected></option>
              <option value="m" {{ (isset($item) ? $item->gender : old('gender')) == 'm' ? 'selected' : '' }}>@lang('main.m')</option>
              <option value="f" {{ (isset($item) ? $item->gender : old('gender')) == 'f' ? 'selected' : '' }}>@lang('main.f')</option>
            </select>
            @if ($errors->has('gender'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('gender') }}</strong></span>
            @else
              <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
            @endif
          </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="birthday" class="form-label">@lang('main.birthday')</label>
            <div class="form-control-wrap">
                <div class="form-icon form-icon-left">
                    <em class="icon ni ni-calendar"></em>
                </div>
                <input type="text" id="birthday" name="birthday" value="{{ old('birthday') ?? (isset($item) ? optional($item->birthday)->format('Y-m-d') : null) }}" data-date-format="yyyy-mm-dd"
                    class="form-control form-control-lg date-picker @error('birthday') is-invalid @enderror" placeholder="Doglan sene giriz">
                @if ($errors->has('birthday'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('birthday') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="address" class="form-label">@lang('main.address')</label>
            <div class="form-control-wrap">
                <input type="text" id="address" name="address" value="{{ old('address') ?? (isset($item) ? $item->address : null) }}"
                       class="form-control form-control-lg @error('address') is-invalid @enderror" placeholder="">
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('address') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="work_year" class="form-label">@lang('main.work_year')</label>
            <div class="form-control-wrap">
                <input type="number" id="work_year" name="work_year" value="{{ old('work_year') ?? (isset($item) ? $item->work_year : null) }}"
                       class="form-control form-control-lg @error('work_year') is-invalid @enderror" placeholder="">
                @if ($errors->has('work_year'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('work_year') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-label-group">
              <label class="form-label" for="password"><span>@lang('main.password') <span class="text-danger">*</span></span></label>
            </div>
            <div class="form-control-wrap">
              <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
              </a>
              <input type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                    id="password" name="password" placeholder="@lang('main.enter_password')" required value="{{ old('password') }}">
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
              @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="customFileLabel">@lang('main.choose_image')</label>
            <div class="form-control-wrap">
                <div class="form-file">
                    <input type="file" id="file" name="file" class="form-file-input @error('file') is-invalid @enderror" id="customFile">
                    <label class="form-file-label" for="customFile">@lang('main.choose_image')</label>
                </div>
                @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="sp-plan-opt clone-file ml-4 mt-5">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="status" id="status1"
                @if (isset($item))
                    @if ($item->status) checked @endif
                @else
                    checked
                @endif  >
                <label class="custom-control-label text-soft" for="status1">@lang('main.status')</label>
            </div>
        </div>
    </div>
    @if(!$employee)
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="parent_child_ids"><span id="parentChildName">
                    @if (isset($item) && $item->role == 'child')
                    @lang('main.select_parent')
                @elseif(isset($item) && $item->role == 'parent')
                    @lang('main.select_child')
                @else
                    @lang('main.select_child')
                @endif
                        </span></label>

                <div class="form-control-wrap">
                    <select id="parentChild" name="parent_child_ids[]" class="form-select js-select2 @error('parent_child_ids.0') is-invalid @enderror" multiple data-search="on">
                        @if((isset($parentChildren) && auth()->user()->isRoleDirector()) || isset($item))
                            @foreach ($parentChildren as $parentChild)
                                <option value="{{ $parentChild->id }}" @isset($item) @if(in_array($parentChild->id, $arr)) selected @endif @endisset> {{ $parentChild->first_name }} {{ $parentChild->last_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('parent_child_ids.0'))
                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('parent_child_ids.0') }}</strong></span>
                    @else
                        <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-6 @if(isset($item) && ($item->role == 'educator' || $item->role == 'child')) @else d-none @endif"  id="col-group" >
        <div class="form-group">
            <label class="form-label" for="group_id"><span>@lang('main.select_group')  </span></label>
            <div class="form-control-wrap">
                <select id="group" name="group_id" class="form-select js-select2 @error('group_id') is-invalid @enderror" data-search="on">
                    @if((isset($groups) && auth()->user()->isRoleDirector()) || (isset($item) && isset($groups)))
                        <option @if(!old('group_id')) selected @endif>-</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ (isset($item->group) ? $item->group->id : null) == $group->id ? 'selected' : '' }}> {{ $group->name }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('group_id'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('group_id') }}</strong></span>
                @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <button class="btn btn-lg btn-primary">@lang('main.submit')</button>
    </div>
</div>

@section('js')
<script>
    $(function () {

        const garden_filter = $('#garden_filter');
        const group_filter = $('#groups_filter');
        const url = "{{ route('garden.groups') }}" + "?garden_id=";
        if (garden_filter && garden_filter != undefined) {
            garden_filter.change(function () {
                $.get(url + $(this).val(), function (data) {
                    let option = '';
                    data.forEach(element => {
                      option += '<option value="' + element.id + '">' + element['name'] + '</option>';
                    })
                    group_filter.find('option')
                    .remove()
                    .end()
                    .append(option);
                }).fail(function (err) {
                    console.log(err);
                });
            });
        }

        const garden = $('#garden');
        const group = $('#group');
        if (garden && garden != undefined) {
            garden.change(function () {
                $.get(url + $(this).val()[0], function (data) {
                    let option = '<option  @if(!old('group_id')) selected @endif >-</option>';
                    data.forEach(element => {
                      option += '<option value="' + element.id + '">' + element['name'] + '</option>';
                    })
                    group.find('option')
                    .remove()
                    .end()
                    .append(option);
                }).fail(function (err) {
                    console.log(err);
                });
            });
        }


        const role = $('#role');
        const col_group = $('#col-group');
        const col_garden = $('#col-garden');
        const col_garden_ids = $('#col-garden-ids');
        role.change(function () {
            if ($(this).val() == 'educator' || $(this).val() == 'child') {
                col_group.removeClass('d-none');
                $(this).val() == 'child' ? document.getElementById('parentChildName').innerHTML = "{{ __('main.select_parent') }}" : null;
            } else {
                $(this).val() == 'parent' ? document.getElementById('parentChildName').innerHTML = "{{ __('main.select_child') }}" : null;
                col_group.addClass('d-none');
            }

            if($(this).val() == 'parent'){
                col_garden.addClass('d-none');
                col_garden_ids.removeClass('d-none');
            } else {
                col_garden_ids.addClass('d-none');
                col_garden.removeClass('d-none');
            }
            parentChild();
        });
        let garden_ids = $('#garden_ids');
        let garden_id = $('#garden');
        garden_id.change(function () {
            parentChild();
        });
        garden_ids.change(function () {
            parentChild();
        });
    });

    function parentChild() {

        let parentChild = $('#parentChild');
        let role = $('#role').val();
        let garden_ids = $('#garden_ids').val();
        let garden_id = $('#garden').val();
        selectedGarden = '';
        if (garden_ids) {
            garden_ids.forEach(element => {
                selectedGarden += '&garden_ids[]=' + element;
            });
        }
        if(role == 'child') selectedGarden = garden_id;

        selectedGarden = selectedGarden ? '&garden_ids[]=' + selectedGarden : '';
        let urlParentChild = "{{ route('parent.child') }}" + "?role=" + role + selectedGarden;
        $.get(urlParentChild, function (data) {
            let option = '';
            data.forEach(element => {
                if( ({{ isset($item) ? 1 : 1 }}) || (element.id != {{ isset($item) ? $item->id : 0}}) ){
                    option += '<option value="' + element.id + '">' + element['first_name'] + ' ' + element['last_name'] + '</option>';
                }
            })
            parentChild.find('option')
            .remove()
            .end()
            .append(option);
        }).fail(function (err) {
            console.log(err);
        });

    }
</script>
@endsection
<input type="hidden" name="previous" value="{{url()->previous()}}">


