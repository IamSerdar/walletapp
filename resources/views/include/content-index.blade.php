<div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-between-md g-4">
        <div class="nk-block-head-content">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">@lang('main.list', ['name' => Str::headline($data['title'])])</h3>
                <div class="nk-block-des text-soft">
                    <p>@lang('main.sub_title', ['count' => $data['count'], 'name' => $data['title']])</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div>
        <div class="nk-block-head-content">
            <ul class="nk-block-tools gx-3">
                @if (($data['count'] > 1) && ($data['ordering']))
                    <li>
                      <a href="{{ route($data['path'].'.order') }}" class="btn btn-white btn-dim btn-outline-warning">
                        <em class="icon ni ni-list"></em><span class="d-none d-sm-inline-block">Saýhalla</span>
                      </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route(Str::lower($data['path']).'.create') }}" class="btn btn-white btn-dim btn-outline-primary">
                        <em class="icon ni ni-plus"></em><span class="d-none d-sm-inline-block">@lang('main.create_new')</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
