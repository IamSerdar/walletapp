<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">{{ $data['title']->name ? $data['title']->name : $data['title']->first_name }}</h3>
            <div class="nk-block-des text-soft">
                <p>{{ $data['sub'] }}</p>
            </div>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
              <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
              <div class="toggle-expand-content" data-content="pageMenu">
                <ul class="nk-block-tools g-3">
                  <li>
                    <a href="{{ route($data['path'].'.edit', $data['title']->id) }}" class="btn btn-white btn-dim btn-outline-primary">
                      <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">@lang('main.edit')</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="btn btn-white btn-dim btn-outline-danger"
                      onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $data['title']->id }}').submit(); }">
                      <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">@lang('main.delete')</span>
                    </a>
                    <form action="{{ route($data['path'].'.destroy', $data['title']->id) }}" method="post" id="destroy-{{ $data['title']->id }}">
                        @method('delete')
                        @csrf
                      </form>
                  </li>
                </ul>
              </div>
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
